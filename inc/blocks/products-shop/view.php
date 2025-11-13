<?php

/**
 * Products Shop Block
 * 
 * @package blocktheme
 */

// Get attributes
$products_per_page = isset($attributes['productsPerPage']) ? intval($attributes['productsPerPage']) : 12;
$sort_by = isset($attributes['sortBy']) ? sanitize_text_field($attributes['sortBy']) : 'date';
$grid_columns = isset($attributes['gridColumns']) ? intval($attributes['gridColumns']) : 4;
$view_mode = isset($attributes['viewMode']) ? sanitize_text_field($attributes['viewMode']) : 'grid-4';
$sidebar_enabled = isset($attributes['sidebarEnabled']) ? boolval($attributes['sidebarEnabled']) : true;
$show_price_filter = isset($attributes['showPriceFilter']) ? boolval($attributes['showPriceFilter']) : true;
$show_category_filter = isset($attributes['showCategoryFilter']) ? boolval($attributes['showCategoryFilter']) : true;
$show_attribute_filter = isset($attributes['showAttributeFilter']) ? boolval($attributes['showAttributeFilter']) : true;
$show_rating_filter = isset($attributes['showRatingFilter']) ? boolval($attributes['showRatingFilter']) : true;
$show_brand_filter = isset($attributes['showBrandFilter']) ? boolval($attributes['showBrandFilter']) : true;
$show_size_filter = isset($attributes['showSizeFilter']) ? boolval($attributes['showSizeFilter']) : true;
$show_top_rated_filter = isset($attributes['showTopRatedFilter']) ? boolval($attributes['showTopRatedFilter']) : false;
$enable_pagination = isset($attributes['enablePagination']) ? boolval($attributes['enablePagination']) : true;

// Get from URL if set
if (isset($_GET['products_per_page'])) {
    $products_per_page = intval($_GET['products_per_page']);
}
if (isset($_GET['sort_by'])) {
    $sort_by = sanitize_text_field($_GET['sort_by']);
}
if (isset($_GET['view_mode'])) {
    $view_mode = sanitize_text_field($_GET['view_mode']);
    // Validate view_mode values
    $valid_modes = array('grid-2', 'grid-3', 'grid-4', 'list');
    if (! in_array($view_mode, $valid_modes, true)) {
        $view_mode = 'grid-4';
    }
}

// Extract grid columns from view_mode
if (strpos($view_mode, 'grid-') === 0) {
    $grid_columns = intval(substr($view_mode, 5));
}

// Get current page
$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

// Get filter parameters from URL
$filter_categories = isset($_GET['filter_categories']) ? sanitize_text_field($_GET['filter_categories']) : '';
$filter_price = isset($_GET['filter_price']) ? sanitize_text_field($_GET['filter_price']) : '';
$filter_attributes = isset($_GET['filter_attributes']) ? sanitize_text_field($_GET['filter_attributes']) : '';
$filter_ratings = isset($_GET['filter_ratings']) ? sanitize_text_field($_GET['filter_ratings']) : '';

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

// Query products
$args = array(
    'post_type' => 'product',
    'posts_per_page' => $products_per_page,
    'paged' => $paged,
    'orderby' => $orderby,
    'order' => $order,
    'tax_query' => array(), // Initialize tax query
    'meta_query' => array(), // Initialize meta query
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

// Add rating filter (reviews rating)
if (!empty($filter_ratings)) {
    $rating_ids = array_filter(array_map('intval', explode(',', $filter_ratings)));
    if (!empty($rating_ids)) {
        // Convert ratings to meta_value range
        $min_rating = min($rating_ids);
        $args['meta_query'][] = array(
            'key' => '_wc_average_rating',
            'value' => $min_rating,
            'compare' => '>=',
            'type' => 'NUMERIC',
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

// Add attribute filter
if (!empty($filter_attributes)) {
    $attr_values = explode(',', $filter_attributes);
    foreach ($attr_values as $attr_value) {
        $attr_value = sanitize_text_field(trim($attr_value));
        if (!empty($attr_value)) {
            // Try to find which taxonomy this term belongs to
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

// Handle tax_query relationship
if (!empty($args['tax_query'])) {
    $args['tax_query']['relation'] = 'AND';
}

// Handle meta_query relationship
if (!empty($args['meta_query'])) {
    $args['meta_query']['relation'] = 'AND';
}

$products_query = new WP_Query($args);
$products = $products_query->posts;

// Get current URL for breadcrumbs
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : false;
$shop_url = $shop_url ?: home_url('/shop/');
$current_page = __('Shop', 'blocktheme');
?>

<div class="wp-block-modern-fse-products-shop <?php echo $sidebar_enabled ? 'with-sidebar' : 'no-sidebar'; ?>">

    <!-- Breadcrumb Navigation with Mobile Show Option -->
    <div class="products-shop-breadcrumb-wrapper">
        <div class="products-shop-breadcrumb">
            <a href="<?php echo esc_url(home_url()); ?>"><?php _e('Home', 'blocktheme'); ?></a>
            <span class="separator"> / </span>
            <span class="current"><?php echo esc_html(__('Shop', 'blocktheme')); ?></span>
        </div>
        
        <!-- Mobile Show Option -->
        <div class="mobile-show-control">
            <span class="show-label"><?php _e('Show:', 'blocktheme'); ?></span>
            <select class="show-select" data-current-show="<?php echo esc_attr($products_per_page); ?>">
                <?php foreach (array(9, 12, 18, 24) as $count) : ?>
                    <option value="<?php echo esc_attr($count); ?>" <?php selected($products_per_page, $count); ?>>
                        <?php echo esc_html($count); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Main Wrapper for Sidebar and Content -->
    <div class="products-shop-wrapper <?php echo $sidebar_enabled ? 'with-sidebar' : 'full-width'; ?>">

        <!-- Sidebar Filters (if enabled) -->
        <?php if ($sidebar_enabled) : ?>
        <aside class="shop-sidebar products-filters-sidebar">
            <!-- Price Filter -->
            <?php if ($show_price_filter) : ?>
            <div class="filter-widget price-filter-widget">
                <h3 class="filter-title"><?php _e('Filter by Price', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <div class="price-slider-wrapper">
                        <input type="range" class="price-min" min="0" max="10000" value="0" />
                        <input type="range" class="price-max" min="0" max="10000" value="10000" />
                    </div>
                    <div class="price-display">
                        <span class="price-from">$<span class="min-price">0</span></span>
                        <span class="price-separator">-</span>
                        <span class="price-to">$<span class="max-price">10000</span></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Category Filter -->
            <?php if ($show_category_filter) : ?>
            <div class="filter-widget category-filter-widget">
                <h3 class="filter-title"><?php _e('Filter by Category', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <ul class="category-list">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'number' => 10,
                        ));
                        if ($categories && ! is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                echo '<li><label><input type="checkbox" class="category-filter-checkbox" value="' . esc_attr($category->slug) . '" data-cat-id="' . esc_attr($category->term_id) . '" /> ' . esc_html($category->name) . ' (' . intval($category->count) . ')</label></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- Attribute Filter -->
            <?php if ($show_attribute_filter) : ?>
            <div class="filter-widget attribute-filter-widget">
                <h3 class="filter-title"><?php _e('Filter by Attribute', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <ul class="attribute-list">
                        <?php
                        $attributes = wc_get_attribute_taxonomies();
                        if ($attributes) {
                            foreach ($attributes as $attr) {
                                $taxonomy = 'pa_' . $attr->attribute_name;
                                $terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => true));
                                if ($terms && ! is_wp_error($terms)) {
                                    echo '<li><strong>' . esc_html($attr->attribute_label) . '</strong><ul>';
                                    foreach ($terms as $term) {
                                        echo '<li><label><input type="checkbox" class="attribute-filter-checkbox" value="' . esc_attr($term->slug) . '" data-taxonomy="' . esc_attr($taxonomy) . '" /> ' . esc_html($term->name) . '</label></li>';
                                    }
                                    echo '</ul></li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- Rating Filter -->
            <?php if ($show_rating_filter) : ?>
            <div class="filter-widget rating-filter-widget">
                <h3 class="filter-title"><?php _e('Filter by Rating', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <ul class="rating-list">
                        <?php for ($i = 5; $i >= 1; $i--) : ?>
                            <li>
                                <label>
                                    <input type="checkbox" class="rating-filter-checkbox" value="<?php echo esc_attr($i); ?>" />
                                    <span class="stars">
                                        <?php for ($j = 1; $j <= 5; $j++) : ?>
                                            <span class="star <?php echo $j <= $i ? 'filled' : ''; ?>">★</span>
                                        <?php endfor; ?>
                                    </span>
                                    <span class="rating-text"><?php echo esc_html($i) . '+'; ?></span>
                                </label>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- Brand Filter -->
            <?php if ($show_brand_filter) : ?>
            <div class="filter-widget brand-filter-widget">
                <h3 class="filter-title"><?php _e('Filter by Brand', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <ul class="brand-list">
                        <?php
                        // Get product brands (could be a taxonomy or custom field)
                        $brands = get_terms(array(
                            'taxonomy' => 'product_brand',
                            'hide_empty' => true,
                            'number' => 15,
                        ));
                        if ($brands && !is_wp_error($brands)) {
                            foreach ($brands as $brand) {
                                echo '<li><label><input type="checkbox" class="brand-filter-checkbox" value="' . esc_attr($brand->slug) . '" data-brand-id="' . esc_attr($brand->term_id) . '" /> ' . esc_html($brand->name) . ' (' . intval($brand->count) . ')</label></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- Size Filter -->
            <?php if ($show_size_filter) : ?>
            <div class="filter-widget size-filter-widget">
                <h3 class="filter-title"><?php _e('Filter by Size', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <ul class="size-list">
                        <?php
                        // Get sizes from the pa_size attribute
                        $sizes = get_terms(array(
                            'taxonomy' => 'pa_size',
                            'hide_empty' => true,
                        ));
                        if ($sizes && !is_wp_error($sizes)) {
                            foreach ($sizes as $size) {
                                echo '<li><label><input type="checkbox" class="size-filter-checkbox" value="' . esc_attr($size->slug) . '" data-size-id="' . esc_attr($size->term_id) . '" /> ' . esc_html($size->name) . '</label></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- Top Rated Products Filter -->
            <?php if ($show_top_rated_filter) : ?>
            <div class="filter-widget top-rated-filter-widget">
                <h3 class="filter-title"><?php _e('Top Rated Products', 'blocktheme'); ?></h3>
                <div class="filter-content">
                    <label class="top-rated-label">
                        <input type="checkbox" class="top-rated-filter-checkbox" value="top-rated" />
                        <?php _e('Show Top Rated Only', 'blocktheme'); ?>
                    </label>
                </div>
            </div>
            <?php endif; ?>

            <!-- Clear Filters Button -->
            <button class="clear-filters-btn"><?php _e('Clear All Filters', 'blocktheme'); ?></button>
        </aside>
        <?php endif; ?>

        <!-- Main Content Area -->
        <div class="products-shop-main">

    <!-- Shop Controls Header -->
    <div class="products-shop-header">
        <!-- Display Options (visible on medium and large screens) -->
        <div class="shop-controls">
            <div class="products-display">
                <span class="display-label"><?php _e('Show:', 'blocktheme'); ?></span>
                <?php foreach (array(9, 12, 18, 24) as $count) : ?>
                    <button class="display-option <?php echo $count === $products_per_page ? 'active' : ''; ?>"
                        data-count="<?php echo esc_attr($count); ?>">
                        <?php echo esc_html($count); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- View Mode Toggle (Grid/List Icons) -->
            <div class="view-mode-toggle">
                <!-- Grid View Options (Full on desktop, only Grid 2 on mobile) -->
                <div class="view-mode-group">
                    <button class="view-mode-btn grid-2-btn <?php echo $view_mode === 'grid-2' ? 'active' : ''; ?>"
                        data-view-mode="grid-2"
                        title="<?php _e('Grid 2 Columns', 'blocktheme'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                            <rect x="3" y="3" width="8" height="8"></rect>
                            <rect x="13" y="3" width="8" height="8"></rect>
                            <rect x="3" y="13" width="8" height="8"></rect>
                            <rect x="13" y="13" width="8" height="8"></rect>
                        </svg>
                    </button>
                    <button class="view-mode-btn grid-3-btn desktop-only <?php echo $view_mode === 'grid-3' ? 'active' : ''; ?>"
                        data-view-mode="grid-3"
                        title="<?php _e('Grid 3 Columns', 'blocktheme'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                            <rect x="2" y="3" width="6" height="8"></rect>
                            <rect x="9" y="3" width="6" height="8"></rect>
                            <rect x="16" y="3" width="6" height="8"></rect>
                            <rect x="2" y="13" width="6" height="8"></rect>
                            <rect x="9" y="13" width="6" height="8"></rect>
                            <rect x="16" y="13" width="6" height="8"></rect>
                        </svg>
                    </button>
                    <button class="view-mode-btn grid-4-btn desktop-only <?php echo $view_mode === 'grid-4' ? 'active' : ''; ?>"
                        data-view-mode="grid-4"
                        title="<?php _e('Grid 4 Columns', 'blocktheme'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                            <rect x="3" y="3" width="5" height="5"></rect>
                            <rect x="11" y="3" width="5" height="5"></rect>
                            <rect x="3" y="11" width="5" height="5"></rect>
                            <rect x="11" y="11" width="5" height="5"></rect>
                        </svg>
                    </button>
                </div>

                <!-- Separator (desktop only) -->
                <div class="view-mode-separator desktop-only"></div>

                <!-- List View Option -->
                <button class="view-mode-btn list-btn <?php echo $view_mode === 'list' ? 'active' : ''; ?>"
                    data-view-mode="list"
                    title="<?php _e('List View', 'blocktheme'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Sort Dropdown -->
            <div class="sort-control">
                <select class="sort-select" data-current-sort="<?php echo esc_attr($sort_by); ?>">
                    <option value="date" <?php selected($sort_by, 'date'); ?>>
                        <?php _e('Default Sorting', 'blocktheme'); ?>
                    </option>
                    <option value="date" <?php selected($sort_by, 'date'); ?>>
                        <?php _e('Latest', 'blocktheme'); ?>
                    </option>
                    <option value="price_asc" <?php selected($sort_by, 'price_asc'); ?>>
                        <?php _e('Price: Low to High', 'blocktheme'); ?>
                    </option>
                    <option value="price_desc" <?php selected($sort_by, 'price_desc'); ?>>
                        <?php _e('Price: High to Low', 'blocktheme'); ?>
                    </option>
                    <option value="name_asc" <?php selected($sort_by, 'name_asc'); ?>>
                        <?php _e('Name: A to Z', 'blocktheme'); ?>
                    </option>
                    <option value="name_desc" <?php selected($sort_by, 'name_desc'); ?>>
                        <?php _e('Name: Z to A', 'blocktheme'); ?>
                    </option>
                    <option value="popularity" <?php selected($sort_by, 'popularity'); ?>>
                        <?php _e('Popularity', 'blocktheme'); ?>
                    </option>
                    <option value="rating" <?php selected($sort_by, 'rating'); ?>>
                        <?php _e('Rating', 'blocktheme'); ?>
                    </option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Grid/List -->
    <div class="products-container view-<?php echo esc_attr($view_mode); ?>"
        data-view-mode="<?php echo esc_attr($view_mode); ?>"
        data-columns="<?php echo esc_attr($grid_columns); ?>"
        style="<?php echo strpos($view_mode, 'grid-') === 0 ? 'display: grid; grid-template-columns: repeat(' . intval($grid_columns) . ', 1fr);' : ''; ?>">
        <?php if ($products_query->have_posts()) : ?>
            <?php foreach ($products as $product) : ?>
                <?php
                $product_obj = wc_get_product($product->ID);
                if (! $product_obj) continue;
                ?>
                <div class="product-item product-view-<?php echo esc_attr($view_mode); ?>">
                    <?php if ($view_mode === 'list') : ?>
                        <!-- List View -->
                        <div class="product-list-wrapper">
                            <div class="product-image-left">
                                <?php echo wp_kses_post($product_obj->get_image('woocommerce_thumbnail')); ?>
                            </div>
                            <div class="product-content-right">
                                <h3 class="product-title">
                                    <a href="<?php echo esc_url(get_permalink($product->ID)); ?>">
                                        <?php echo esc_html($product->post_title); ?>
                                    </a>
                                </h3>
                                <div class="product-meta">
                                    <div class="product-category">
                                        <?php
                                        $categories = get_the_terms($product->ID, 'product_cat');
                                        if ($categories && ! is_wp_error($categories)) {
                                            echo esc_html($categories[0]->name);
                                        }
                                        ?>
                                    </div>
                                    <div class="product-price">
                                        <?php echo wp_kses_post($product_obj->get_price_html()); ?>
                                    </div>
                                </div>
                                <p class="product-description">
                                    <?php echo wp_kses_post(wp_trim_words($product->post_excerpt ?: $product->post_content, 20)); ?>
                                </p>
                                <div class="product-footer">
                                    <div class="product-rating">
                                        <?php
                                        $rating = $product_obj->get_average_rating();
                                        if ($rating > 0) :
                                        ?>
                                            <span class="stars" style="width: <?php echo ($rating / 5) * 100; ?>%"></span>
                                            <span class="rating-text">(<?php echo esc_html($rating); ?>)</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-button">
                                        <?php echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" data-quantity="1" class="button product_type_simple add_to_cart_button" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>', esc_url($product_obj->add_to_cart_url()), esc_attr($product_obj->get_id()), esc_attr($product_obj->get_sku()), esc_attr(sprintf(__('Add "%s" to your cart', 'blocktheme'), $product->post_title)), esc_html($product_obj->add_to_cart_text())), $product_obj); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Grid View -->
                        <div class="product-grid-wrapper">
                            <div class="product-image">
                                <?php echo wp_kses_post($product_obj->get_image('woocommerce_thumbnail')); ?>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title">
                                    <a href="<?php echo esc_url(get_permalink($product->ID)); ?>">
                                        <?php echo esc_html($product->post_title); ?>
                                    </a>
                                </h3>
                                <div class="product-price">
                                    <?php echo wp_kses_post($product_obj->get_price_html()); ?>
                                </div>
                                <div class="product-rating">
                                    <?php
                                    $rating = $product_obj->get_average_rating();
                                    if ($rating > 0) :
                                    ?>
                                        <span class="stars" style="width: <?php echo ($rating / 5) * 100; ?>%"></span>
                                        <span class="rating-text">(<?php echo esc_html($rating); ?>)</span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-button">
                                    <?php echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" data-quantity="1" class="button product_type_simple add_to_cart_button" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>', esc_url($product_obj->add_to_cart_url()), esc_attr($product_obj->get_id()), esc_attr($product_obj->get_sku()), esc_attr(sprintf(__('Add "%s" to your cart', 'blocktheme'), $product->post_title)), esc_html($product_obj->add_to_cart_text())), $product_obj); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="no-products">
                <?php _e('No products found', 'blocktheme'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($products_query->max_num_pages > 1) : ?>
        <div class="products-pagination">
            <?php
            echo wp_kses_post(paginate_links(array(
                'total' => $products_query->max_num_pages,
                'current' => $paged,
                'format' => '?paged=%#%',
                'prev_text' => __('&laquo; Previous', 'blocktheme'),
                'next_text' => __('Next &raquo;', 'blocktheme'),
            )));
            ?>
        </div>
    <?php endif; ?>
        </div><!-- End .products-shop-main -->
    </div><!-- End .products-shop-wrapper -->
</div><!-- End .wp-block-modern-fse-products-shop -->

<script>
    // Pass AJAX URL and nonce to JavaScript
    window.blockthemeAjax = {
        ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
        nonce: '<?php echo wp_create_nonce('blocktheme_filter_nonce'); ?>'
    };
</script>

<?php wp_reset_postdata(); ?>