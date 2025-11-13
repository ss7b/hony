<?php

/**
 * AJAX Handler for Products Shop Filters
 * 
 * @package blocktheme
 */

// Hook into WP init to register AJAX actions
add_action('wp_ajax_filter_products', 'blocktheme_filter_products');
add_action('wp_ajax_nopriv_filter_products', 'blocktheme_filter_products');

function blocktheme_filter_products() {
    // Clean output buffer to prevent any extra output
    ob_clean();
    
    // Debug log
    error_log('Filter products AJAX called');
    error_log('POST data: ' . print_r($_POST, true));
    
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'blocktheme_filter_nonce')) {
        error_log('Nonce verification failed');
        wp_send_json_error('Invalid nonce');
    }

    error_log('Nonce verified successfully');

    // Get filter parameters
    $products_per_page = isset($_POST['products_per_page']) ? intval($_POST['products_per_page']) : 12;
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $sort_by = isset($_POST['sort_by']) ? sanitize_text_field($_POST['sort_by']) : 'date';
    
    $filter_categories = isset($_POST['filter_categories']) ? sanitize_text_field($_POST['filter_categories']) : '';
    $filter_price = isset($_POST['filter_price']) ? sanitize_text_field($_POST['filter_price']) : '';
    $filter_attributes = isset($_POST['filter_attributes']) ? sanitize_text_field($_POST['filter_attributes']) : '';
    $filter_ratings = isset($_POST['filter_ratings']) ? sanitize_text_field($_POST['filter_ratings']) : '';
    $filter_brands = isset($_POST['filter_brands']) ? sanitize_text_field($_POST['filter_brands']) : '';
    $filter_sizes = isset($_POST['filter_sizes']) ? sanitize_text_field($_POST['filter_sizes']) : '';
    $filter_top_rated = isset($_POST['filter_top_rated']) ? sanitize_text_field($_POST['filter_top_rated']) : '';

    // Set up query arguments
    $orderby = 'date';
    $order = 'DESC';

    switch ($sort_by) {
        case 'price_asc':
            $orderby = 'meta_value_num';
            $order = 'ASC';
            break;
        case 'price_desc':
            $orderby = 'meta_value_num';
            $order = 'DESC';
            break;
        case 'name_asc':
            $orderby = 'title';
            $order = 'ASC';
            break;
        case 'name_desc':
            $orderby = 'title';
            $order = 'DESC';
            break;
        case 'popularity':
            $orderby = 'meta_value_num';
            $order = 'DESC';
            break;
        case 'rating':
            $orderby = 'meta_value_num';
            $order = 'DESC';
            break;
        case 'date':
        default:
            $orderby = 'date';
            $order = 'DESC';
            break;
    }

    // Initialize query args
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $products_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'tax_query' => array(),
        'meta_query' => array(),
    );

    // Add category filter
    if (!empty($filter_categories)) {
        $category_ids = array_filter(array_map('intval', explode(',', $filter_categories)));
        if (!empty($category_ids)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category_ids,
                'operator' => 'IN',
            );
        }
    }

    // Add price filter
    if (!empty($filter_price)) {
        $price_range = explode(',', $filter_price);
        if (count($price_range) === 2) {
            $min_price = intval($price_range[0]);
            $max_price = intval($price_range[1]);
            
            $args['meta_query'][] = array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            );
        }
    }

    // Add rating filter
    if (!empty($filter_ratings)) {
        $rating_ids = array_filter(array_map('intval', explode(',', $filter_ratings)));
        if (!empty($rating_ids)) {
            $min_rating = min($rating_ids);
            $args['meta_query'][] = array(
                'key' => '_wc_average_rating',
                'value' => $min_rating,
                'compare' => '>=',
                'type' => 'NUMERIC',
            );
        }
    }

    // Add attribute filter
    if (!empty($filter_attributes)) {
        $attr_values = explode(',', $filter_attributes);
        foreach ($attr_values as $attr_value) {
            $attr_value = sanitize_text_field(trim($attr_value));
            if (!empty($attr_value)) {
                $term_obj = get_term_by('slug', $attr_value);
                if ($term_obj && strpos($term_obj->taxonomy, 'pa_') === 0) {
                    $args['tax_query'][] = array(
                        'taxonomy' => $term_obj->taxonomy,
                        'field' => 'slug',
                        'terms' => $attr_value,
                        'operator' => 'IN',
                    );
                }
            }
        }
    }

    // Add brand filter
    if (!empty($filter_brands)) {
        $brand_ids = array_filter(array_map('intval', explode(',', $filter_brands)));
        if (!empty($brand_ids)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_brand',
                'field' => 'term_id',
                'terms' => $brand_ids,
                'operator' => 'IN',
            );
        }
    }

    // Add size filter
    if (!empty($filter_sizes)) {
        $size_slugs = array_filter(array_map('sanitize_text_field', explode(',', $filter_sizes)));
        if (!empty($size_slugs)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'pa_size',
                'field' => 'slug',
                'terms' => $size_slugs,
                'operator' => 'IN',
            );
        }
    }

    // Add top rated filter
    if (!empty($filter_top_rated) && $filter_top_rated === 'top-rated') {
        $args['meta_query'][] = array(
            'key' => '_wc_average_rating',
            'value' => 4,
            'compare' => '>=',
            'type' => 'NUMERIC',
        );
    }

    // Set query relationships
    if (!empty($args['tax_query'])) {
        $args['tax_query']['relation'] = 'AND';
    }

    if (!empty($args['meta_query'])) {
        $args['meta_query']['relation'] = 'AND';
    }

    // Query products
    $products_query = new WP_Query($args);
    $products = $products_query->posts;
    
    // Debug logging
    error_log('Query args: ' . json_encode($args));
    error_log('Products found: ' . count($products));
    error_log('Total posts: ' . $products_query->found_posts);
    error_log('Max num pages: ' . $products_query->max_num_pages);
    error_log('Current paged: ' . $paged);

    // Build HTML response
    $html = '';

    if (!empty($products)) {
        foreach ($products as $product) {
            $product_obj = wc_get_product($product->ID);
            if (!$product_obj) continue;

            $html .= '<div class="product-item">';
            $html .= '<div class="product-grid-wrapper">';
            $html .= '<div class="product-image">';
            $html .= $product_obj->get_image('woocommerce_thumbnail');
            $html .= '</div>';
            $html .= '<div class="product-content">';
            $html .= '<h3 class="product-title"><a href="' . esc_url(get_permalink($product->ID)) . '">' . esc_html($product->post_title) . '</a></h3>';
            $html .= '<div class="product-price">' . wp_kses_post($product_obj->get_price_html()) . '</div>';
            
            $rating = $product_obj->get_average_rating();
            if ($rating > 0) {
                $html .= '<div class="product-rating"><span class="stars" style="width: ' . ($rating / 5) * 100 . '%"></span><span class="rating-text">(' . esc_html($rating) . ')</span></div>';
            }
            
            $html .= '<div class="product-button">';
            $html .= apply_filters('woocommerce_loop_add_to_cart_link', sprintf(
                '<a href="%s" data-quantity="1" class="button product_type_simple add_to_cart_button" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>',
                esc_url($product_obj->add_to_cart_url()),
                esc_attr($product_obj->get_id()),
                esc_attr($product_obj->get_sku()),
                esc_attr(sprintf(__('Add "%s" to your cart', 'blocktheme'), $product->post_title)),
                esc_html($product_obj->add_to_cart_text())
            ), $product_obj);
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
    } else {
        $html .= '<div class="no-products">' . __('No products found', 'blocktheme') . '</div>';
    }

    // Build pagination HTML
    $pagination_html = '';
    if ($products_query->max_num_pages > 1) {
        $pagination_html = paginate_links(array(
            'total' => $products_query->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'prev_text' => __('&laquo; Previous', 'blocktheme'),
            'next_text' => __('Next &raquo;', 'blocktheme'),
            'echo' => false,
        ));
    }

    // Send response
    $response_data = array(
        'html' => $html,
        'pagination' => $pagination_html,
        'total_pages' => $products_query->max_num_pages,
        'total_posts' => $products_query->found_posts,
        'current_page' => $paged,
    );
    
    error_log('Response data: ' . json_encode($response_data));
    wp_send_json($response_data);
    wp_die();
}
?>
