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
        'product-category-grid'
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
    } else {
        register_block_type($block_path . '/block.json');
    }

    // تسجيل النصوص الإضافية للواجهة الأمامية
    modern_fse_enqueue_block_frontend_assets($block_name, $block_path, $block_url);
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
        'product-category-grid'
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
        'product-category-grid'
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