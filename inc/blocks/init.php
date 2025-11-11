<?php

/**
 * Blocks Initialization for Modern FSE Theme
 * تسجيل وتحميل جميع البلوكات المخصصة
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تسجيل جميع البلوكات المخصصة
 */
function modern_fse_register_all_blocks()
{
    // قائمة البلوكات المخصصة
    $blocks = array(
        'testimonial',
        'team-member',
        'pricing-table',
        'counter',
        'progress-bar',
        'social-icons',
        'product-category-grid',
        'products-swiper'
    );

    foreach ($blocks as $block_name) {
        modern_fse_register_single_block($block_name);
    }
}
add_action('init', 'modern_fse_register_all_blocks');

/**
 * تسجيل بلوك واحد
 */
function modern_fse_register_single_block($block_name)
{
    $block_path = get_template_directory() . '/inc/blocks/' . $block_name;
    $block_url = get_template_directory_uri() . '/inc/blocks/' . $block_name;

    // التحقق من وجود ملف block.json
    if (!file_exists($block_path . '/block.json')) {
        error_log('Block JSON file not found: ' . $block_path . '/block.json');
        return;
    }

    // تسجيل البلوك مع render callback للبلوكات الديناميكية
    if ($block_name === 'product-category-grid') {
        register_block_type($block_path . '/block.json', array(
            'render_callback' => 'modern_fse_render_product_category_grid',
        ));
    } elseif ($block_name === 'products-swiper') {
        register_block_type($block_path . '/block.json', array(
            'render_callback' => 'modern_fse_render_products_swiper',
        ));
    } else {
        register_block_type($block_path . '/block.json');
    }

    // تسجيل النصوص الإضافية للواجهة الأمامية
    modern_fse_enqueue_block_frontend_assets($block_name, $block_path, $block_url);
}

/**
 * Render callback for Products Swiper Block
 */
function modern_fse_render_products_swiper($attributes, $content)
{
    ob_start();

    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        echo '<div class="notice notice-warning"><p>يتطلب هذا البلوك إضافة WooCommerce</p></div>';
        return ob_get_clean();
    }

    // Get attributes with defaults
    $product_type = isset($attributes['productType']) ? $attributes['productType'] : 'recent';
    $product_category = isset($attributes['productCategory']) ? $attributes['productCategory'] : 0;
    $limit = isset($attributes['limit']) ? intval($attributes['limit']) : 8;
    $columns = isset($attributes['columns']) ? intval($attributes['columns']) : 3;
    $image_size = isset($attributes['imageSize']) ? $attributes['imageSize'] : 'medium';
    $show_title = isset($attributes['showTitle']) ? boolval($attributes['showTitle']) : true;
    $show_description = isset($attributes['showDescription']) ? boolval($attributes['showDescription']) : false;
    $description_length = isset($attributes['descriptionLength']) ? intval($attributes['descriptionLength']) : 20;
    $show_rating = isset($attributes['showRating']) ? boolval($attributes['showRating']) : true;
    $show_price = isset($attributes['showPrice']) ? boolval($attributes['showPrice']) : true;
    $show_add_to_cart = isset($attributes['showAddToCart']) ? boolval($attributes['showAddToCart']) : true;
    $card_style = isset($attributes['cardStyle']) ? $attributes['cardStyle'] : 'standard';
    $autoplay = isset($attributes['autoPlay']) ? boolval($attributes['autoPlay']) : true;
    $autoplay_speed = isset($attributes['autoPlaySpeed']) ? intval($attributes['autoPlaySpeed']) : 5000;
    $slide_speed = isset($attributes['slideSpeed']) ? intval($attributes['slideSpeed']) : 800;
    $show_arrows = isset($attributes['showArrows']) ? boolval($attributes['showArrows']) : true;
    $show_dots = isset($attributes['showDots']) ? boolval($attributes['showDots']) : true;
    $space_between = isset($attributes['spaceBetween']) ? intval($attributes['spaceBetween']) : 20;
    $loop = isset($attributes['loop']) ? boolval($attributes['loop']) : true;
    $custom_css = isset($attributes['customCSS']) ? sanitize_text_field($attributes['customCSS']) : '';

    // Build WooCommerce query arguments
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Filter by product type
    if ($product_type === 'best_selling') {
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'total_sales';
        $args['order'] = 'DESC';
    } elseif ($product_type === 'category' && $product_category > 0) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $product_category,
            ),
        );
    }

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        echo '<p class="no-products-found">لم يتم العثور على منتجات</p>';
        return ob_get_clean();
    }

    // Unique ID for this block instance
    $block_id = 'products-swiper-' . uniqid();

    ?>
    <div class="products-swiper-block" id="<?php echo esc_attr($block_id); ?>">
        <div class="swiper-container" 
             data-autoplay="<?php echo esc_attr($autoplay ? 'true' : 'false'); ?>"
             data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>"
             data-slide-speed="<?php echo esc_attr($slide_speed); ?>"
             data-show-arrows="<?php echo esc_attr($show_arrows ? 'true' : 'false'); ?>"
             data-show-dots="<?php echo esc_attr($show_dots ? 'true' : 'false'); ?>"
             data-space-between="<?php echo esc_attr($space_between); ?>"
             data-loop="<?php echo esc_attr($loop ? 'true' : 'false'); ?>"
             data-columns="<?php echo esc_attr($columns); ?>"
             <?php if (!empty($custom_css)): ?>
                data-custom-css="<?php echo esc_attr($custom_css); ?>"
             <?php endif; ?>>
            
            <div class="swiper-wrapper">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    $product = wc_get_product(get_the_ID());
                    $product_id = get_the_ID();

                    if (!$product) {
                        continue;
                    }

                    // Get product image
                    $image_url = has_post_thumbnail($product_id)
                        ? get_the_post_thumbnail_url($product_id, $image_size)
                        : wc_placeholder_img_src();
                    ?>

                    <div class="swiper-slide">
                        <div class="product-card card-style-<?php echo esc_attr($card_style); ?>">
                            
                            <div class="product-image">
                                <a href="<?php echo esc_url(get_the_permalink($product_id)); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" 
                                         alt="<?php echo esc_attr(get_the_title($product_id)); ?>"
                                         loading="lazy">
                                </a>
                            </div>

                            <div class="product-info">
                                <?php if ($show_title): ?>
                                    <a href="<?php echo esc_url(get_the_permalink($product_id)); ?>" class="product-title">
                                        <?php echo esc_html(get_the_title($product_id)); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ($show_price): ?>
                                    <div class="product-price">
                                        <?php echo wp_kses_post($product->get_price_html()); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($show_rating && function_exists('wc_get_rating_html')): ?>
                                    <div class="product-rating">
                                        <?php echo wp_kses_post(wc_get_rating_html($product->get_average_rating(), $product->get_review_count())); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($show_description && !empty(get_the_excerpt($product_id))): ?>
                                    <p class="product-description">
                                        <?php echo esc_html(wp_trim_words(get_the_excerpt($product_id), $description_length)); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($show_add_to_cart): ?>
                                    <div class="product-actions">
                                        <?php
                                        echo apply_filters(
                                            'woocommerce_loop_add_to_cart_link',
                                            sprintf(
                                                '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                                                esc_url($product->add_to_cart_url()),
                                                esc_attr(isset($quantity) ? $quantity : 1),
                                                esc_attr(implode(' ', array_filter(array(
                                                    'button',
                                                    'product_type_' . $product->get_type(),
                                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                                                    'add-to-cart-btn'
                                                )))),
                                                $product->supports('ajax_add_to_cart') ? apply_filters('woocommerce_product_add_to_cart_handler', 'ajax', $product) : '',
                                                esc_html($product->add_to_cart_text())
                                            ),
                                            $product
                                        );
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>

            <?php if ($show_arrows): ?>
                <button class="swiper-prev" aria-label="المنتج السابق">‹</button>
                <button class="swiper-next" aria-label="المنتج التالي">›</button>
            <?php endif; ?>
        </div>

        <?php if ($show_dots): ?>
            <div class="swiper-pagination"></div>
        <?php endif; ?>

        <?php if (!empty($custom_css)): ?>
            <style id="products-swiper-custom-css-<?php echo esc_attr($block_id); ?>">
                #<?php echo esc_attr($block_id); ?> {
                    <?php echo wp_kses_post($custom_css); ?>
                }
            </style>
        <?php endif; ?>
    </div>

    <?php

    return ob_get_clean();
}

/**
 * render callback for product category grid
 */
function modern_fse_render_product_category_grid($attributes, $content)
{
    ob_start();
    
    // التحقق من وجود ووكومرس
    if (!class_exists('WooCommerce')) {
        echo '<div class="notice notice-warning"><p>يتطلب هذا البلوك إضافة WooCommerce</p></div>';
        return ob_get_clean();
    }

    // معلمات الاستعلام
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'number'     => isset($attributes['limit']) ? $attributes['limit'] : 8,
        'orderby'    => isset($attributes['orderby']) ? $attributes['orderby'] : 'name',
        'order'      => isset($attributes['order']) ? $attributes['order'] : 'asc',
    );

    // إذا كان الترتيب حسب العدد
    if (isset($attributes['orderby']) && $attributes['orderby'] === 'count') {
        $args['orderby'] = 'count';
    }

    $product_categories = get_terms($args);

    if (empty($product_categories) || is_wp_error($product_categories)) {
        echo '<p class="no-categories-found">لم يتم العثور على فئات منتجات</p>';
        return ob_get_clean();
    }

    $layoutType = isset($attributes['layoutType']) ? $attributes['layoutType'] : 'grid';
    $columns = isset($attributes['columns']) ? $attributes['columns'] : 4;
    $showCount = isset($attributes['showCount']) ? $attributes['showCount'] : true;
    $showDescription = isset($attributes['showDescription']) ? $attributes['showDescription'] : false;
    $imageSize = isset($attributes['imageSize']) ? $attributes['imageSize'] : 'medium';
    $cardStyle = isset($attributes['cardStyle']) ? $attributes['cardStyle'] : 'normal';
    $textPosition = isset($attributes['textPosition']) ? $attributes['textPosition'] : 'below';
    $autoPlay = isset($attributes['autoPlay']) ? $attributes['autoPlay'] : true;
    $autoPlaySpeed = isset($attributes['autoPlaySpeed']) ? $attributes['autoPlaySpeed'] : 3000;
    $showArrows = isset($attributes['showArrows']) ? $attributes['showArrows'] : true;
    $showDots = isset($attributes['showDots']) ? $attributes['showDots'] : true;
    $sliderSpeed = isset($attributes['sliderSpeed']) ? $attributes['sliderSpeed'] : 500;
    ?>
    
    <div class="product-category-grid-block" 
         data-layout="<?php echo esc_attr($layoutType); ?>"
         data-columns="<?php echo esc_attr($columns); ?>"
         data-autoplay="<?php echo esc_attr($autoPlay ? 'true' : 'false'); ?>"
         data-autoplay-speed="<?php echo esc_attr($autoPlaySpeed); ?>"
         data-slider-speed="<?php echo esc_attr($sliderSpeed); ?>">
        
        <?php if ($layoutType === 'slider'): ?>
            <div class="categories-slider">
                <div class="slider-container">
                    <?php foreach ($product_categories as $category): 
                        modern_fse_render_category_card($category, $cardStyle, $textPosition, $imageSize, $showDescription, $showCount, 'slider-item');
                    endforeach; ?>
                </div>
                
                <?php if ($showArrows || $showDots): ?>
                    <div class="slider-controls">
                        <?php if ($showArrows): ?>
                            <div class="slider-arrows">
                                <button class="slider-arrow prev-arrow" aria-label="السابق">‹</button>
                                <button class="slider-arrow next-arrow" aria-label="التالي">›</button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($showDots): ?>
                            <div class="slider-dots">
                                <?php 
                                $slide_count = ceil(count($product_categories) / $columns);
                                for ($i = 0; $i < $slide_count; $i++):
                                ?>
                                    <span class="slider-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></span>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="categories-grid columns-<?php echo esc_attr($columns); ?>">
                <?php foreach ($product_categories as $category): 
                    modern_fse_render_category_card($category, $cardStyle, $textPosition, $imageSize, $showDescription, $showCount, 'grid-item');
                endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php
    return ob_get_clean();
}

/**
 * Render individual category card
 */
function modern_fse_render_category_card($category, $cardStyle, $textPosition, $imageSize, $showDescription, $showCount, $itemClass = '') {
    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
    $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, $imageSize) : wc_placeholder_img_src();
    $category_url = get_term_link($category);
    
    if (is_wp_error($category_url)) {
        return;
    }
    
    $card_class = "category-card card-style-{$cardStyle} text-{$textPosition} {$itemClass}";
    $isOverlay = $textPosition === 'overlay';
    ?>
    
    <a href="<?php echo esc_url($category_url); ?>" class="<?php echo esc_attr($card_class); ?>">
        <div class="category-image">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy" />
            <?php if ($isOverlay): ?>
                <div class="category-content overlay-content">
                    <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                    
                    <?php if ($showDescription && !empty($category->description)): ?>
                        <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 15)); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($showCount): ?>
                        <span class="category-count">
                            <?php 
                            printf(
                                _n('%d منتج', '%d منتجات', $category->count, 'modern-fse-theme'),
                                $category->count
                            ); 
                            ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (!$isOverlay): ?>
            <div class="category-content">
                <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                
                <?php if ($showDescription && !empty($category->description)): ?>
                    <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 15)); ?></p>
                <?php endif; ?>
                
                <?php if ($showCount): ?>
                    <span class="category-count">
                        <?php 
                        printf(
                            _n('%d منتج', '%d منتجات', $category->count, 'modern-fse-theme'),
                            $category->count
                        ); 
                        ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </a>
    
    <?php
}

/**
 * تحميل النصوص والأنماط الإضافية للواجهة الأمامية
 */
function modern_fse_enqueue_block_frontend_assets($block_name, $block_path, $block_url)
{
    // تحميل JavaScript للواجهة الأمامية
    $view_js_path = $block_path . '/view.js';
    $view_js_url = $block_url . '/view.js';

    if (file_exists($view_js_path)) {
        wp_register_script(
            'modern-fse-' . $block_name . '-view',
            $view_js_url,
            array(),
            MODERN_FSE_THEME_VERSION,
            true
        );
    }

    // تحميل CSS الإضافي للواجهة الأمامية
    $view_css_path = $block_path . '/view.css';
    $view_css_url = $block_url . '/view.css';

    if (file_exists($view_css_path)) {
        wp_register_style(
            'modern-fse-' . $block_name . '-view',
            $view_css_url,
            array(),
            MODERN_FSE_THEME_VERSION
        );
    }

    // تحميل CSS الرئيسي للبلوك
    $style_css_path = $block_path . '/style.css';
    $style_css_url = $block_url . '/style.css';

    if (file_exists($style_css_path)) {
        wp_register_style(
            'modern-fse-' . $block_name . '-style',
            $style_css_url,
            array(),
            MODERN_FSE_THEME_VERSION
        );
    }
}

/**
 * تحميل جميع نصوص البلوكات عند الحاجة
 */
function modern_fse_enqueue_block_assets()
{
    $blocks = array(
        'testimonial',
        'team-member',
        'pricing-table',
        'counter',
        'progress-bar',
        'social-icons',
        'product-category-grid',
        'products-swiper'
    );

    foreach ($blocks as $block_name) {
        // تحميل JavaScript إذا كان مسجل
        if (wp_script_is('modern-fse-' . $block_name . '-view', 'registered')) {
            wp_enqueue_script('modern-fse-' . $block_name . '-view');
        }

        // تحميل CSS إذا كان مسجل
        if (wp_style_is('modern-fse-' . $block_name . '-view', 'registered')) {
            wp_enqueue_style('modern-fse-' . $block_name . '-view');
        }

        // تحميل CSS الرئيسي للبلوك
        if (wp_style_is('modern-fse-' . $block_name . '-style', 'registered')) {
            wp_enqueue_style('modern-fse-' . $block_name . '-style');
        }
    }

    // تحميل Swiper إذا كان البلوك الجديد مستخدماً
    global $post;
    if ($post && has_block('modern-fse/products-swiper', $post->ID)) {
        if (!wp_script_is('swiper', 'registered')) {
            wp_register_script(
                'swiper',
                'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
                array(),
                '11.0.0',
                true
            );
        }

        if (!wp_style_is('swiper', 'registered')) {
            wp_register_style(
                'swiper',
                'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
                array(),
                '11.0.0'
            );
        }

        wp_enqueue_script('swiper');
        wp_enqueue_style('swiper');
    }
}
add_action('wp_enqueue_scripts', 'modern_fse_enqueue_block_assets');

/**
 * تحميل نصوص المحرر للبلوكات
 */
function modern_fse_enqueue_block_editor_assets()
{
    $blocks = array(
        'testimonial',
        'team-member',
        'pricing-table',
        'counter',
        'progress-bar',
        'social-icons',
        'product-category-grid',
        'products-swiper'
    );

    foreach ($blocks as $block_name) {
        $editor_js_path = get_template_directory() . '/inc/blocks/' . $block_name . '/editor.js';
        $editor_js_url = get_template_directory_uri() . '/inc/blocks/' . $block_name . '/editor.js';

        // تحميل JavaScript للمحرر إذا كان موجوداً
        if (file_exists($editor_js_path)) {
            wp_enqueue_script(
                'modern-fse-' . $block_name . '-editor',
                $editor_js_url,
                array('wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-i18n'),
                MODERN_FSE_THEME_VERSION,
                true
            );
        }

        // تحميل CSS للمحرر
        $editor_css_path = get_template_directory() . '/inc/blocks/' . $block_name . '/editor.css';
        $editor_css_url = get_template_directory_uri() . '/inc/blocks/' . $block_name . '/editor.css';

        if (file_exists($editor_css_path)) {
            wp_enqueue_style(
                'modern-fse-' . $block_name . '-editor',
                $editor_css_url,
                array('wp-edit-blocks'),
                MODERN_FSE_THEME_VERSION
            );
        }
    }

    // تمرير البيانات إلى JavaScript للمحرر
    wp_localize_script('modern-fse-product-category-grid-editor', 'modern_fse_blocks', array(
        'woocommerce_active' => class_exists('WooCommerce'),
    ));
}
add_action('enqueue_block_editor_assets', 'modern_fse_enqueue_block_editor_assets');

/**
 * وظيفة مساعدة للتحقق من وجود بلوك
 */
function modern_fse_block_exists($block_name)
{
    $block_path = get_template_directory() . '/inc/blocks/' . $block_name;
    return file_exists($block_path . '/block.json');
}

/**
 * الحصول على قائمة البلوكات المتاحة
 */
function modern_fse_get_available_blocks()
{
    return array(
        'testimonial' => array(
            'name' => 'Testimonial',
            'description' => 'عرض آراء وتقييمات العملاء',
            'icon' => 'format-quote',
            'category' => 'design'
        ),
        'team-member' => array(
            'name' => 'Team Member',
            'description' => 'عرض معلومات عضو الفريق',
            'icon' => 'groups',
            'category' => 'design'
        ),
        'pricing-table' => array(
            'name' => 'Pricing Table',
            'description' => 'جدول الأسعار والخطط',
            'icon' => 'money',
            'category' => 'design'
        ),
        'counter' => array(
            'name' => 'Counter',
            'description' => 'عداد أرقام متحرك',
            'icon' => 'plus',
            'category' => 'design'
        ),
        'progress-bar' => array(
            'name' => 'Progress Bar',
            'description' => 'شريط تقدم متحرك',
            'icon' => 'chart-bar',
            'category' => 'design'
        ),
        'social-icons' => array(
            'name' => 'Social Icons',
            'description' => 'أيقونات التواصل الاجتماعي',
            'icon' => 'share',
            'category' => 'design'
        ),
        'product-category-grid' => array(
            'name' => 'Product Category Grid',
            'description' => 'عرض شبكة فئات المنتجات',
            'icon' => 'grid-view',
            'category' => 'woocommerce'
        ),
        'products-swiper' => array(
            'name' => 'Products Swiper',
            'description' => 'عرض المنتجات في Swiper مع خيارات متقدمة',
            'icon' => 'carousel',
            'category' => 'woocommerce'
        )
    );
}

/**
 * إضافة فئات بلوكات مخصصة
 */
function modern_fse_add_block_categories($categories)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'woocommerce',
                'title' => __('WooCommerce', 'modern-fse-theme'),
                'icon' => null,
            ),
            array(
                'slug' => 'modern-fse',
                'title' => __('Modern FSE', 'modern-fse-theme'),
                'icon' => null,
            ),
        )
    );
}
add_filter('block_categories_all', 'modern_fse_add_block_categories');

/**
 * التحقق من اعتماديات البلوكات
 */
function modern_fse_check_block_dependencies()
{
    $dependencies = array();
    
    // التحقق من وجود ووكومرس للبلوكات المعتمدة عليه
    if (!class_exists('WooCommerce')) {
        $dependencies[] = array(
            'block' => 'product-category-grid',
            'plugin' => 'WooCommerce',
            'plugin_name' => 'WooCommerce',
            'download_url' => 'https://wordpress.org/plugins/woocommerce/'
        );
    }
    
    return $dependencies;
}

/**
 * عرض تنبيهات الاعتماديات في لوحة التحكم
 */
function modern_fse_admin_block_notices()
{
    $dependencies = modern_fse_check_block_dependencies();
    
    if (!empty($dependencies) && current_user_can('install_plugins')) {
        foreach ($dependencies as $dependency) {
            ?>
            <div class="notice notice-warning is-dismissible">
                <p>
                    <?php
                    printf(
                        __('بلوك %s يتطلب إضافة %s. %s', 'modern-fse-theme'),
                        '<strong>' . $dependency['block'] . '</strong>',
                        '<strong>' . $dependency['plugin_name'] . '</strong>',
                        '<a href="' . $dependency['download_url'] . '" target="_blank">' . __('تحميل الإضافة', 'modern-fse-theme') . '</a>'
                    );
                    ?>
                </p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'modern_fse_admin_block_notices');

/**
 * تعطيل البلوكات إذا لم تكن الاعتماديات متوفرة
 */
function modern_fse_disable_blocks_without_dependencies()
{
    $dependencies = modern_fse_check_block_dependencies();
    
    foreach ($dependencies as $dependency) {
        unregister_block_type('modern-fse/' . $dependency['block']);
    }
}
add_action('init', 'modern_fse_disable_blocks_without_dependencies', 100);

/**
 * تحميل الترجمة للبلوكات
 */
function modern_fse_load_block_textdomain()
{
    load_theme_textdomain('modern-fse-theme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'modern_fse_load_block_textdomain');