<?php
/**
 * Products Patterns for Modern FSE Theme
 * أنماط لعرض المنتجات بشكل ديناميكي
 */

add_action( 'init', 'modern_fse_register_products_patterns' );
function modern_fse_register_products_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط المنتجات
    register_block_pattern_category(
        'modern-fse-products',
        array( 'label' => __( 'Products', 'modern-fse-theme' ) )
    );

    modern_fse_register_products_hover_template();
}

// النمط: منتجات مع أزرار هوفر ديناميكية
function modern_fse_register_products_hover_template() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|lg"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--lg)">أحدث المنتجات</h2>
        <!-- /wp:heading -->
        
        <!-- wp:woocommerce/all-products {"columns":3,"rows":3,"align":"wide","layout":{"type":"grid","columnCount":3}} -->
        <div class="wp-block-woocommerce-all-products alignwide">
            
            <!-- wp:woocommerce/product-template {"align":"wide","layout":{"type":"grid","columnCount":3}} -->
            <div class="wp-block-woocommerce-product-template alignwide">
                
                <!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"bottom":"var:preset|spacing|lg"}},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"},"className":"product-item-wrapper"} -->
                <div class="wp-block-group product-item-wrapper" style="margin-bottom:var(--wp--preset--spacing--lg)">
                    
                    <!-- wp:woocommerce/product-image {"showSaleBadge":true,"saleBadgeAlign":"left","imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"height":"300px","style":{"layout":{"selfStretch":"fit","flexSize":null},"spacing":{"margin":{"bottom":"0"}}},"className":"product-image-hover"} -->
                    <div class="wp-block-woocommerce-product-image product-image-hover">
                        
                        <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"10px"},"position":{"type":"absolute","top":"50%","left":"50%","transform":"translate(-50%, -50%)"},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"className":"product-hover-buttons"} -->
                        <div class="wp-block-group product-hover-buttons" style="top:50%;left:50%;transform:translate(-50%, -50%)">
                            
                            <!-- View Button - Dynamic -->
                            <!-- wp:woocommerce/product-button {"text":"عرض المنتج","showPrice":false,"backgroundColor":"primary","textColor":"background","style":{"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"25px","right":"25px"}}},"className":"view-product-button"} /-->
                            
                            <!-- Like Button -->
                            <!-- wp:button {"backgroundColor":"background","textColor":"primary","style":{"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"25px","right":"25px"}}},"className":"like-product-button"} -->
                            <div class="wp-block-button like-product-button">
                                <a class="wp-block-button__link has-background-color has-background-background-color has-text-color has-primary-color has-link-color" href="#" style="border-radius:0px;padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:25px">
                                    ❤️ إعجاب
                                </a>
                            </div>
                            <!-- /wp:button -->
                            
                        </div>
                        <!-- /wp:group -->
                        
                    </div>
                    <!-- /wp:woocommerce/product-image -->

                    <!-- Product Title -->
                    <!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.5rem","top":"1rem"}},"typography":{"fontSize":"1.1rem","lineHeight":"1.3"}},"fontSize":"medium","__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

                    <!-- Product Price -->
                    <!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","fontSize":"small","style":{"typography":{"fontWeight":"600"}}} /-->

                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:woocommerce/product-template -->
            
        </div>
        <!-- /wp:woocommerce/all-products -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/products-hover-template',
        array(
            'title'       => __( 'Products with Hover Buttons', 'modern-fse-theme' ),
            'description' => __( 'عرض المنتجات مع أزرار العرض والإعجاب التي تظهر عند التمرير', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-products' ),
            'viewportWidth' => 1200,
        )
    );
}




