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
    modern_fse_register_header_ecommerce();
    modern_fse_register_header_premium();
    modern_fse_register_header_corporate();
    modern_fse_register_header_creative();
    modern_fse_register_header_business();
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

// النمط الرابع: Header E-commerce
function modern_fse_register_header_ecommerce() {
    $content = '<!-- wp:group {"align":"full","layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"backgroundColor":"white"} -->
    <header class="wp-block-group alignfull has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap","alignItems":"center"}} -->
        <div class="wp-block-group">
            
            <!-- wp:site-logo {"width":160} /-->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
            <div class="wp-block-group">
                <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"fontSize":"medium"} -->
                <!-- wp:page-list /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right","gap":"var:preset|spacing|l"}} -->
            <div class="wp-block-group">
                <!-- wp:search {"label":"ابحث في المتجر","placeholder":"ابحث عن منتجات...","showLabel":false,"buttonPosition":"button","buttonText":"بحث","buttonUseIcon":true} /-->
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"secondary-600","textColor":"white","className":"is-style-fill"} -->
                    <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-secondary-600-background-color has-text-color has-background wp-element-button">🛒 السلة</a></div>
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
        'modern-fse/header-ecommerce',
        array(
            'title'       => __( 'Header E-commerce', 'modern-fse-theme' ),
            'description' => __( 'هيدر متخصص للمتاجر الإلكترونية مع بحث وسلة التسوق', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الخامس: Header Premium
function modern_fse_register_header_premium() {
    $content = '<!-- wp:group {"align":"full","layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","backgroundColor":"primary-900"} -->
    <header class="wp-block-group alignfull has-white-color has-primary-900-background-color has-text-color has-background has-link-color" style="padding-top:0;padding-bottom:0">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
            
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
                    <!-- wp:button {"backgroundColor":"white","textColor":"primary-900","className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-900-color has-white-background-color has-text-color has-background wp-element-button">اتصل بنا</a></div>
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
        'modern-fse/header-premium',
        array(
            'title'       => __( 'Header Premium', 'modern-fse-theme' ),
            'description' => __( 'هيدر فاخر مع خلفية داكنة عصرية', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط السادس: Header Corporate
function modern_fse_register_header_corporate() {
    $content = '<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"backgroundColor":"white"} -->
    <header class="wp-block-group has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
        <div class="wp-block-group">
            
            <!-- wp:columns -->
            <div class="wp-block-columns">
                <!-- wp:column {"width":"20%"} -->
                <div class="wp-block-column" style="flex-basis:20%">
                    <!-- wp:site-logo {"width":150} /-->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column {"width":"50%"} -->
                <div class="wp-block-column" style="flex-basis:50%">
                    <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"fontSize":"medium"} -->
                    <!-- wp:page-list /-->
                    <!-- /wp:navigation -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column {"width":"30%"} -->
                <div class="wp-block-column" style="flex-basis:30%">
                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right","gap":"var:preset|spacing|m"}} -->
                    <div class="wp-block-group">
                        <!-- wp:buttons -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"backgroundColor":"secondary-600","textColor":"white","className":"is-style-fill"} -->
                            <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-secondary-600-background-color has-text-color has-background wp-element-button">تسجيل</a></div>
                            <!-- /wp:button -->
                            <!-- wp:button {"backgroundColor":"primary","textColor":"white","className":"is-style-fill"} -->
                            <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">دخول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </header>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/header-corporate',
        array(
            'title'       => __( 'Header Corporate', 'modern-fse-theme' ),
            'description' => __( 'هيدر احترافي للمواقع الشركات مع أزرار تسجيل ودخول', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط السابع: Header Creative
function modern_fse_register_header_creative() {
    $content = '<!-- wp:group {"align":"full","layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}},"backgroundColor":"secondary-50"} -->
    <header class="wp-block-group alignfull has-secondary-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap","alignItems":"center"}} -->
        <div class="wp-block-group">
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
            <div class="wp-block-group">
                <!-- wp:site-logo {"width":140} /-->
                <!-- wp:site-tagline {"style":{"typography":{"fontSize":"0.875rem"}}} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right","gap":"var:preset|spacing|l"}} -->
            <div class="wp-block-group">
                <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"right","orientation":"horizontal"},"fontSize":"medium"} -->
                <!-- wp:page-list /-->
                <!-- /wp:navigation -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary-600","textColor":"white","className":"is-style-fill"} -->
                    <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-primary-600-background-color has-text-color has-background wp-element-button">ابدأ الآن</a></div>
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
        'modern-fse/header-creative',
        array(
            'title'       => __( 'Header Creative', 'modern-fse-theme' ),
            'description' => __( 'هيدر إبداعي مع خلفية فاتحة وتصميم عصري', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثامن: Header Business
function modern_fse_register_header_business() {
    $content = '<!-- wp:group {"metadata":{"categories":["modern-fse-header"],"patternName":"modern-fse/header-business","name":"Header Business"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|s","bottom":"var:preset|spacing|s"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignfull has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--s);padding-bottom:var(--wp--preset--spacing--s)"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"}},"border":{"width":"0px","style":"none","radius":"0px"}},"backgroundColor":"secondary-50","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
        <div class="wp-block-group alignfull has-secondary-50-background-color has-background" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","alignItems":"center"}} -->
        <div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:site-logo {"width":67} /-->

        <!-- wp:social-links -->
        <ul class="wp-block-social-links"><!-- wp:social-link {"url":"https://suhaildev.com/#contact","service":"whatsapp"} /-->

        <!-- wp:social-link {"url":"ب","service":"instagram"} /-->

        <!-- wp:social-link {"url":"س","service":"tiktok"} /-->

        <!-- wp:social-link {"url":"ب","service":"youtube"} /--></ul>
        <!-- /wp:social-links -->

        <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-600"}}},"color":"secondary-600","typography":{"fontSize":"0.875rem"}}} -->
        <p class="has-link-color" style="font-size:0.875rem">📞0505454645254 |</p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-600"}}},"color":"secondary-600","typography":{"fontSize":"0.875rem"}}} -->
        <p class="has-link-color" style="font-size:0.875rem">✉ mail@gmail.com</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:group -->

        <!-- wp:buttons -->
        <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary-600","textColor":"white","width":100,"className":"is-style-fill","style":{"spacing":{"padding":{"left":"var:preset|spacing|s","right":"var:preset|spacing|s","top":"var:preset|spacing|xs","bottom":"var:preset|spacing|xs"}}}} -->
        <div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-fill"><a class="wp-block-button__link has-white-color has-primary-600-background-color has-text-color has-background wp-element-button" style="padding-top:var(--wp--preset--spacing--xs);padding-right:var(--wp--preset--spacing--s);padding-bottom:var(--wp--preset--spacing--xs);padding-left:var(--wp--preset--spacing--s)">Request a Quote</a></div>
        <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
        <!-- /wp:group -->

        <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"width":"0px","style":"none","radius":"0px"}},"textColor":"white","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap","alignItems":"center"}} -->
        <div class="wp-block-group alignfull has-white-color has-text-color" style="border-style:none;border-width:0px;border-radius:0px;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:navigation {"textColor":"white","className":"has-white-color","fontSize":"medium","layout":{"type":"flex","justifyContent":"left","orientation":"horizontal"}} -->
        <!-- wp:page-list /-->
        <!-- /wp:navigation -->

        <!-- wp:group {"style":{"color":{"background":"#ffffff00"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
        <div class="wp-block-group has-background" style="background-color:#ffffff00;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:search {"label":"","buttonText":"Search"} /--></div>
        <!-- /wp:group --></div>
        <!-- /wp:group --></div>
        <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/header-business',
        array(
            'title'       => __( 'Header Business', 'modern-fse-theme' ),
            'description' => __( 'هيدر احترافي للشركات مع معلومات التواصل والشبكات الاجتماعية', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-header' ),
            'viewportWidth' => 1200,
        )
    );
}