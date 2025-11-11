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
?>

<div class="product-category-grid-block">
    <div class="categories-grid columns-<?php echo esc_attr($columns); ?>">
        <?php foreach ($product_categories as $category): 
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, $attributes['imageSize']) : wc_placeholder_img_src();
            $category_url = get_term_link($category);
        ?>
            <a href="<?php echo esc_url($category_url); ?>" class="category-card">
                <div class="category-image">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy" />
                </div>
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
            </a>
        <?php endforeach; ?>
    </div>
</div>