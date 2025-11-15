<?php
/**
 * Products Tabs Block Render
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تسجيل البلوك في init.php
 * أضف إلى قائمة البلوكات:
 * 'products-tabs'
 * 
 * وأضف الـ render callback:
 * elseif ($block_name === 'products-tabs') {
 *     register_block_type($block_path . '/block.json', array(
 *         'render_callback' => 'modern_fse_render_products_tabs',
 *     ));
 * }
 */

// تحديد الـ attributes بشكل مباشر - إذا تم استدعاء الدالة
if (!isset($attributes)) {
    $attributes = array();
}
    ob_start();

    // التحقق من وجود ووكومرس
    if (!class_exists('WooCommerce')) {
        echo '<div class="notice notice-warning"><p>يتطلب هذا البلوك إضافة WooCommerce</p></div>';
        echo ob_get_clean();
        exit;
    }

    // الحصول على الخصائص بقيم افتراضية
    $tabs = isset($attributes['tabs']) ? $attributes['tabs'] : [];
    $limit = isset($attributes['limit']) ? intval($attributes['limit']) : 8;
    $columns = isset($attributes['columns']) ? intval($attributes['columns']) : 4;
    $image_size = isset($attributes['imageSize']) ? $attributes['imageSize'] : 'medium';
    $show_title = isset($attributes['showTitle']) ? boolval($attributes['showTitle']) : true;
    $show_price = isset($attributes['showPrice']) ? boolval($attributes['showPrice']) : true;
    $show_rating = isset($attributes['showRating']) ? boolval($attributes['showRating']) : true;
    $show_add_to_cart = isset($attributes['showAddToCart']) ? boolval($attributes['showAddToCart']) : true;
    $card_style = isset($attributes['cardStyle']) ? $attributes['cardStyle'] : 'hover-lift';
    $tab_style = isset($attributes['tabStyle']) ? $attributes['tabStyle'] : 'modern';
    $animation_type = isset($attributes['animationType']) ? $attributes['animationType'] : 'fade';
    $animation_speed = isset($attributes['animationSpeed']) ? intval($attributes['animationSpeed']) : 300;
    $tab_position = isset($attributes['tabPosition']) ? $attributes['tabPosition'] : 'top';
    $sort_by = isset($attributes['sortBy']) ? sanitize_key($attributes['sortBy']) : 'date';
    $show_badge = isset($attributes['showBadge']) ? boolval($attributes['showBadge']) : true;

    // التحقق من وجود تبويبات
    if (empty($tabs) || !is_array($tabs)) {
        echo '<p class="no-tabs-found">لم يتم العثور على تبويبات</p>';
    } else {

    // معرّف فريد للبلوك
    $block_id = 'products-tabs-' . uniqid();

    ?>
    <div class="products-tabs-block" 
         id="<?php echo esc_attr($block_id); ?>"
         data-animation-type="<?php echo esc_attr($animation_type); ?>"
         data-animation-speed="<?php echo esc_attr($animation_speed); ?>"
         data-tab-position="<?php echo esc_attr($tab_position); ?>"
         data-card-style="<?php echo esc_attr($card_style); ?>"
         data-tab-style="<?php echo esc_attr($tab_style); ?>"
         data-limit="<?php echo esc_attr($limit); ?>"
         data-columns="<?php echo esc_attr($columns); ?>"
         data-image-size="<?php echo esc_attr($image_size); ?>"
         data-show-title="<?php echo esc_attr($show_title ? 'true' : 'false'); ?>"
         data-show-price="<?php echo esc_attr($show_price ? 'true' : 'false'); ?>"
         data-show-rating="<?php echo esc_attr($show_rating ? 'true' : 'false'); ?>"
         data-show-add-to-cart="<?php echo esc_attr($show_add_to_cart ? 'true' : 'false'); ?>"
         data-show-badge="<?php echo esc_attr($show_badge ? 'true' : 'false'); ?>"
         data-sort-by="<?php echo esc_attr($sort_by); ?>">

        <!-- Tab Navigation -->
        <div class="tabs-nav tab-style-<?php echo esc_attr($tab_style); ?> tab-position-<?php echo esc_attr($tab_position); ?>">
            <?php
            foreach ($tabs as $index => $tab) {
                $active_class = ($index === 0) ? 'active' : '';
                $tab_id = isset($tab['id']) ? sanitize_key($tab['id']) : 'tab-' . $index;
                $tab_name = isset($tab['name']) ? sanitize_text_field($tab['name']) : 'Tab ' . ($index + 1);
                $product_type = isset($tab['type']) ? sanitize_key($tab['type']) : 'all';
                $category_slug = isset($tab['categoryName']) ? sanitize_text_field($tab['categoryName']) : '';
                $category_id = isset($tab['categoryId']) ? intval($tab['categoryId']) : 0;
                ?>
                <button class="tab-button <?php echo esc_attr($active_class); ?>" 
                        data-tab-id="<?php echo esc_attr($tab_id); ?>"
                        data-tab-index="<?php echo esc_attr($index); ?>"
                        data-tab-type="<?php echo esc_attr($product_type); ?>"
                        data-category-slug="<?php echo esc_attr($category_slug); ?>">
                    <?php echo esc_html($tab_name); ?>
                </button>
                <?php
            }
            ?>
        </div>

        <!-- Tab Content -->
        <div class="tab-content-wrapper">
            <?php
            foreach ($tabs as $index => $tab) {
                $tab_id = isset($tab['id']) ? sanitize_key($tab['id']) : 'tab-' . $index;
                $active_class = ($index === 0) ? 'active' : '';
                $product_type = isset($tab['type']) ? sanitize_key($tab['type']) : 'all';
                $category_slug = isset($tab['categoryName']) ? sanitize_text_field($tab['categoryName']) : '';
                $category_id = isset($tab['categoryId']) ? intval($tab['categoryId']) : 0;

                // Data attributes for JS and AJAX fallback
                $panel_data = sprintf(
                        'data-tab-id="%s" data-tab-index="%d" data-tab-type="%s" data-category-slug="%s" data-category-id="%d" data-limit="%d" data-columns="%d" data-image-size="%s" data-show-title="%s" data-show-price="%s" data-show-rating="%s" data-show-add-to-cart="%s" data-show-badge="%s" data-card-style="%s" data-sort-by="%s"',
                    esc_attr($tab_id),
                    esc_attr($index),
                    esc_attr($product_type),
                    esc_attr($category_slug),
                    esc_attr($category_id),
                    esc_attr($limit),
                    esc_attr($columns),
                    esc_attr($image_size),
                    $show_title ? 'true' : 'false',
                    $show_price ? 'true' : 'false',
                    $show_rating ? 'true' : 'false',
                    $show_add_to_cart ? 'true' : 'false',
                    $show_badge ? 'true' : 'false',
                    esc_attr($card_style),
                    esc_attr($sort_by)
                );

                ?>
                <div class="tab-panel <?php echo esc_attr($active_class); ?>" <?php echo $panel_data; ?>>

                    <?php
                    // Build query for this tab
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $limit,
                    );

                    if ($product_type === 'best_selling') {
                        $args['orderby'] = 'meta_value_num';
                        $args['meta_key'] = 'total_sales';
                        $args['order'] = 'DESC';
                    } elseif ($product_type === 'category') {
                        // try slug first
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

                        // fallback to category id
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

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        echo '<div class="products-grid" style="grid-template-columns: repeat(' . esc_attr($columns) . ', 1fr);">';
                        while ($query->have_posts()) {
                            $query->the_post();
                            $product = wc_get_product(get_the_ID());
                            $product_id = get_the_ID();
                            if (!$product) continue;

                            $image_url = has_post_thumbnail($product_id) ? get_the_post_thumbnail_url($product_id, $image_size) : wc_placeholder_img_src();
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

                            ?>
                            <div class="product-card card-style-<?php echo esc_attr($card_style); ?>">
                                <div class="product-image">
                                    <a href="<?php echo esc_url(get_the_permalink($product_id)); ?>" title="<?php echo esc_attr(get_the_title($product_id)); ?>">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($product_id)); ?>" loading="lazy">
                                    </a>
                                    <?php if ($is_on_sale && !empty($badge_text) && $show_badge): ?>
                                        <span class="product-badge"><?php echo esc_html($badge_text); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <?php if ($show_title): ?>
                                        <a href="<?php echo esc_url(get_the_permalink($product_id)); ?>" class="product-title"><?php echo esc_html(get_the_title($product_id)); ?></a>
                                    <?php endif; ?>
                                    <?php if ($show_price): ?>
                                        <div class="product-price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
                                    <?php endif; ?>
                                    <?php if ($show_rating && function_exists('wc_get_rating_html')): ?>
                                        <div class="product-rating"><?php echo wp_kses_post(wc_get_rating_html($product->get_average_rating(), $product->get_review_count())); ?></div>
                                    <?php endif; ?>
                                    <?php if ($show_add_to_cart): ?>
                                        <div class="product-actions">
                                            <?php echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" data-quantity="%s" class="%s" %s>%s</a>', esc_url($product->add_to_cart_url()), esc_attr(isset($quantity) ? $quantity : 1), esc_attr(implode(' ', array_filter(array('add-to-cart-btn','button','product_type_' . $product->get_type(), $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',)))), $product->supports('ajax_add_to_cart') ? apply_filters('woocommerce_product_add_to_cart_handler', 'ajax', $product) : '', esc_html($product->add_to_cart_text())), $product); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                        echo '</div>';
                        wp_reset_postdata();
                    } else {
                        echo '<div class="empty-state"><div class="empty-state-icon">📦</div><p class="empty-state-text">' . __('لا توجد منتجات متاحة حالياً', 'modern-fse-theme') . '</p></div>';
                    }
                    ?>



                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <?php
    }
