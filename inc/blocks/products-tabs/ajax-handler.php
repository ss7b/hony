<?php
/**
 * Products Tabs AJAX Handler
 * تحميل المنتجات ديناميكياً عند اختيار التبويب
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * AJAX handler لتحميل منتجات التبويب
 */
function modern_fse_load_products_tab()
{
    // التحقق من الـ nonce
    check_ajax_referer('products_tabs_nonce', 'nonce');

    // التحقق من وجود WooCommerce
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(['message' => 'WooCommerce غير مفعل']);
        return;
    }

    // الحصول على البيانات من AJAX
    $tab_index = isset($_POST['tab_index']) ? intval($_POST['tab_index']) : 0;
    $tab_type = isset($_POST['tab_type']) ? sanitize_key($_POST['tab_type']) : 'all';
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 8;
    
    // تسجيل البيانات المستقبلة
    $columns = isset($_POST['columns']) ? intval($_POST['columns']) : 4;
    $image_size = isset($_POST['image_size']) ? sanitize_key($_POST['image_size']) : 'medium';
    $show_title = isset($_POST['show_title']) ? boolval($_POST['show_title']) : true;
    $show_price = isset($_POST['show_price']) ? boolval($_POST['show_price']) : true;
    $show_rating = isset($_POST['show_rating']) ? boolval($_POST['show_rating']) : true;
    $show_add_to_cart = isset($_POST['show_add_to_cart']) ? boolval($_POST['show_add_to_cart']) : true;
    $show_badge = isset($_POST['show_badge']) ? boolval($_POST['show_badge']) : true;
    $card_style = isset($_POST['card_style']) ? sanitize_key($_POST['card_style']) : 'hover-lift';
    $sort_by = isset($_POST['sort_by']) ? sanitize_key($_POST['sort_by']) : 'date';

    // بناء معاملات الاستعلام
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
    );

    // تطبيق الترتيب
    switch ($sort_by) {
        case 'popularity':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
            break;
        case 'rating':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_wc_average_rating';
            $args['order'] = 'DESC';
            break;
        case 'price':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'ASC';
            break;
        case 'date':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    // تصفية حسب نوع المنتج
    if ($tab_type === 'best_selling') {
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'total_sales';
        $args['order'] = 'DESC';
    } elseif ($tab_type === 'category') {
        // محاولة البحث عن الفئة باستخدام الـ slug أولاً ثم ID كنسخة احتياطية
        if (!empty($category_slug)) {
            $category = get_term_by('slug', $category_slug, 'product_cat');
            if ($category && !is_wp_error($category)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $category->term_id,
                    ),
                );
            }
        }

        // fallback to category_id if provided or slug lookup failed
        if (empty($args['tax_query']) && $category_id > 0) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category_id,
                ),
            );
        }
    }

    // تنفيذ الاستعلام
    $query = new WP_Query($args);
    $html = '';

    if ($query->have_posts()) {
        $html .= '<div class="products-grid" style="grid-template-columns: repeat(' . esc_attr($columns) . ', 1fr); gap: 20px;">';

        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            $product_id = get_the_ID();

            if (!$product) {
                continue;
            }

            // الحصول على صورة المنتج
            $image_url = has_post_thumbnail($product_id)
                ? get_the_post_thumbnail_url($product_id, $image_size)
                : wc_placeholder_img_src();

            // التحقق من وجود خصم
            $is_on_sale = $product->is_on_sale();
            $badge_text = '';
            if ($is_on_sale && $show_badge) {
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                if ($regular_price && $sale_price) {
                    $discount = round((($regular_price - $sale_price) / $regular_price) * 100);
                    $badge_text = '-' . $discount . '%';
                }
            }

            $html .= '<div class="product-card card-style-' . esc_attr($card_style) . '">';
            
            // Product Image
            $html .= '<div class="product-image">';
            $html .= '<a href="' . esc_url(get_the_permalink($product_id)) . '" title="' . esc_attr(get_the_title($product_id)) . '">';
            $html .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title($product_id)) . '" loading="lazy">';
            $html .= '</a>';
            
            if ($is_on_sale && !empty($badge_text) && $show_badge) {
                $html .= '<span class="product-badge">' . esc_html($badge_text) . '</span>';
            }
            
            $html .= '</div>';

            // Product Info
            $html .= '<div class="product-info">';
            
            if ($show_title) {
                $html .= '<a href="' . esc_url(get_the_permalink($product_id)) . '" class="product-title">';
                $html .= esc_html(get_the_title($product_id));
                $html .= '</a>';
            }

            if ($show_price) {
                $html .= '<div class="product-price">';
                $html .= wp_kses_post($product->get_price_html());
                $html .= '</div>';
            }

            if ($show_rating) {
                $html .= '<div class="product-rating">';
                $html .= wp_kses_post(wc_get_rating_html($product->get_average_rating(), $product->get_review_count()));
                $html .= '</div>';
            }

            if ($show_add_to_cart) {
                $html .= '<div class="product-actions">';
                $html .= apply_filters(
                    'woocommerce_loop_add_to_cart_link',
                    sprintf(
                        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                        esc_url($product->add_to_cart_url()),
                        esc_attr(1),
                        esc_attr(implode(' ', array_filter(array(
                            'add-to-cart-btn',
                            'button',
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                        )))),
                        $product->supports('ajax_add_to_cart') ? apply_filters('woocommerce_product_add_to_cart_handler', 'ajax', $product) : '',
                        esc_html($product->add_to_cart_text())
                    ),
                    $product
                );
                $html .= '</div>';
            }

            $html .= '</div>';
            $html .= '</div>';
        }

        $html .= '</div>';
        wp_reset_postdata();

        wp_send_json_success(['html' => $html]);
    } else {
        wp_send_json_success([
            'html' => '<div class="empty-state" style="text-align: center; padding: 40px;"><p>📦 لا توجد منتجات متاحة حالياً</p></div>'
        ]);
    }

    wp_die();
}

add_action('wp_ajax_load_products_tab', 'modern_fse_load_products_tab');
add_action('wp_ajax_nopriv_load_products_tab', 'modern_fse_load_products_tab');
