<?php
/**
 * Header Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_header_patterns' );
function modern_fse_register_header_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط الهيدر
    register_block_pattern_category(
        'modern-fse-header',
        array( 'label' => __( 'Headers-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_header_modern();
    modern_fse_register_header_minimal();
    modern_fse_register_header_centered();
}

// النمط الأول: Header Modern
function modern_fse_register_header_modern() {
    $content = '<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"backgroundColor":"white"} -->
    <header class="wp-block-group has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group">
                <!-- wp:site-logo {"width":180} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
            <div class="wp-block-group">
                <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"fontSize":"medium"} -->
                <!-- wp:page-list /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
            <div class="wp-block-group">
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","className":"is-style-fill"} -->
                    <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">اتصل بنا</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    </header>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/header-modern',
        array(
            'title'       => __( 'Header Modern', 'modern-fse-theme' ),
            'description' => __( 'هيدر عصري مع شعار وقائمة تنقل وأزرار', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Header Minimal
function modern_fse_register_header_minimal() {
    $content = '<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
    <header class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-group">
            
            <!-- wp:site-logo {"width":120} /-->
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group">
                <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"right","orientation":"horizontal"},"fontSize":"small"} -->
                <!-- wp:page-list {"isNavigationChild":true,"showSubmenuIcon":true} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    </header>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/header-minimal',
        array(
            'title'       => __( 'Header Minimal', 'modern-fse-theme' ),
            'description' => __( 'هيدر بسيط وأنيق', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Header Centered
function modern_fse_register_header_centered() {
    $content = '<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
    <header class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center","orientation":"vertical"}} -->
        <div class="wp-block-group">
            
            <!-- wp:site-logo {"width":150,"className":"is-style-default"} /-->
            
            <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"fontSize":"medium"} -->
            <!-- wp:page-list /-->
            <!-- /wp:navigation -->
            
        </div>
        <!-- /wp:group -->

    </header>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/header-centered',
        array(
            'title'       => __( 'Header Centered', 'modern-fse-theme' ),
            'description' => __( 'هيدر مركزي مع شعار وقائمة في المنتصف', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}