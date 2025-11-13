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
);

$products_query = new WP_Query($args);
$products = $products_query->posts;

// Get current URL for breadcrumbs
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : false;
$shop_url = $shop_url ?: home_url('/shop/');
$current_page = __('Shop', 'blocktheme');
?>

<div class="wp-block-modern-fse-products-shop">

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
</div>

<?php wp_reset_postdata(); ?>