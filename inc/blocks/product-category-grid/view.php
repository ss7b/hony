<?php
/**
 * Template for displaying product category grid
 * 
 * @package Modern_FSE_Theme
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// التحقق من وجود ووكومرس
if (!class_exists('WooCommerce')) {
    echo '<p>يتطلب هذا البلوك إضافة WooCommerce</p>';
    return;
}

$attributes = $block->attributes;

// معلمات الاستعلام
$args = array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
    'number'     => $attributes['limit'],
    'orderby'    => $attributes['orderby'],
    'order'      => $attributes['order'],
);

// إذا كان الترتيب حسب العدد
if ($attributes['orderby'] === 'count') {
    $args['orderby'] = 'count';
}

$product_categories = get_terms($args);

if (empty($product_categories) || is_wp_error($product_categories)) {
    echo '<p>لم يتم العثور على فئات منتجات</p>';
    return;
}

$columns = isset($attributes['columns']) ? $attributes['columns'] : 4;
$layout_type = isset($attributes['layoutType']) ? $attributes['layoutType'] : 'grid';
$card_style = isset($attributes['cardStyle']) ? $attributes['cardStyle'] : 'normal';
$text_position = isset($attributes['textPosition']) ? $attributes['textPosition'] : 'below';
$hover_badge = isset($attributes['hoverBadge']) ? $attributes['hoverBadge'] : true;
$hover_effect = isset($attributes['hoverEffect']) ? $attributes['hoverEffect'] : 'lift';
$border_radius = isset($attributes['borderRadius']) ? $attributes['borderRadius'] : 12;
$show_badge_count = isset($attributes['showBadgeCount']) ? $attributes['showBadgeCount'] : true;
$badge_position = isset($attributes['badgePosition']) ? $attributes['badgePosition'] : 'bottom-right';
$space_between = isset($attributes['spaceBetween']) ? $attributes['spaceBetween'] : 20;
$auto_play = isset($attributes['autoPlay']) ? $attributes['autoPlay'] : true;
$auto_play_speed = isset($attributes['autoPlaySpeed']) ? $attributes['autoPlaySpeed'] : 3000;
$slider_speed = isset($attributes['sliderSpeed']) ? $attributes['sliderSpeed'] : 500;
$show_arrows = isset($attributes['showArrows']) ? $attributes['showArrows'] : true;
$show_dots = isset($attributes['showDots']) ? $attributes['showDots'] : true;
$loop = isset($attributes['loop']) ? $attributes['loop'] : true;
?>

<div class="product-category-grid-block" data-layout="<?php echo esc_attr($layout_type); ?>" data-card-style="<?php echo esc_attr($card_style); ?>" data-hover-effect="<?php echo esc_attr($hover_effect); ?>" data-hover-badge="<?php echo esc_attr($hover_badge ? 'true' : 'false'); ?>">
    <?php if ($layout_type === 'slider'): ?>
        <!-- Swiper Slider Layout -->
        <div class="swiper-container" 
            data-autoplay="<?php echo esc_attr($auto_play ? 'true' : 'false'); ?>"
            data-autoplay-speed="<?php echo esc_attr($auto_play_speed); ?>"
            data-slider-speed="<?php echo esc_attr($slider_speed); ?>"
            data-columns="<?php echo esc_attr($columns); ?>"
            data-space-between="<?php echo esc_attr($space_between); ?>"
            data-show-arrows="<?php echo esc_attr($show_arrows ? 'true' : 'false'); ?>"
            data-show-dots="<?php echo esc_attr($show_dots ? 'true' : 'false'); ?>"
            data-loop="<?php echo esc_attr($loop ? 'true' : 'false'); ?>">
            
            <div class="swiper-wrapper">
                <?php foreach ($product_categories as $category): 
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, $attributes['imageSize']) : wc_placeholder_img_src();
                    $category_url = get_term_link($category);
                    $card_classes = "category-card card-style-{$card_style} text-{$text_position}";
                ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url($category_url); ?>" class="<?php echo esc_attr($card_classes); ?>" style="border-radius: <?php echo esc_attr($border_radius); ?>px;">
                            <div class="category-image" style="border-radius: <?php echo esc_attr($border_radius); ?>px;">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy" />
                                
                                <?php if ($text_position === 'overlay'): ?>
                                    <div class="category-content overlay-content">
                                        <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                                        
                                        <?php if ($attributes['showDescription'] && $category->description): ?>
                                            <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 15)); ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if ($attributes['showCount']): ?>
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
                                
                                <?php if ($hover_badge): ?>
                                    <div class="hover-badge badge-<?php echo esc_attr($badge_position); ?>">
                                        <?php if ($show_badge_count): ?>
                                            <span class="badge-count"><?php echo esc_html($category->count); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($text_position !== 'overlay'): ?>
                                <div class="category-content">
                                    <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                                    
                                    <?php if ($attributes['showDescription'] && $category->description): ?>
                                        <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 15)); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if ($attributes['showCount']): ?>
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
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if ($show_arrows): ?>
                <button class="swiper-prev" type="button" aria-label="السابق">
                    <svg class="icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="swiper-next" type="button" aria-label="التالي">
                    <svg class="icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
        
        <?php if ($show_dots): ?>
            <div class="swiper-pagination"></div>
        <?php endif; ?>
        
    <?php else: ?>
        <!-- Grid Layout -->
        <div class="categories-grid columns-<?php echo esc_attr($columns); ?>">
            <?php foreach ($product_categories as $category): 
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, $attributes['imageSize']) : wc_placeholder_img_src();
                $category_url = get_term_link($category);
                $card_classes = "category-card card-style-{$card_style} text-{$text_position}";
            ?>
                <a href="<?php echo esc_url($category_url); ?>" class="<?php echo esc_attr($card_classes); ?>" style="border-radius: <?php echo esc_attr($border_radius); ?>px;">
                    <div class="category-image" style="border-radius: <?php echo esc_attr($border_radius); ?>px;">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy" />
                        
                        <?php if ($text_position === 'overlay'): ?>
                            <div class="category-content overlay-content">
                                <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                                
                                <?php if ($attributes['showDescription'] && $category->description): ?>
                                    <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 15)); ?></p>
                                <?php endif; ?>
                                
                                <?php if ($attributes['showCount']): ?>
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
                        
                        <?php if ($hover_badge): ?>
                            <div class="hover-badge badge-<?php echo esc_attr($badge_position); ?>">
                                <?php if ($show_badge_count): ?>
                                    <span class="badge-count"><?php echo esc_html($category->count); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($text_position !== 'overlay'): ?>
                        <div class="category-content">
                            <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                            
                            <?php if ($attributes['showDescription'] && $category->description): ?>
                                <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 15)); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($attributes['showCount']): ?>
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
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>