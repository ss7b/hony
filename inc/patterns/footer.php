<?php
/**
 * Footer Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_footer_patterns' );
function modern_fse_register_footer_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط الفوتر
    register_block_pattern_category(
        'modern-fse-footer',
        array( 'label' => __( 'Footers-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_footer_modern();
    modern_fse_register_footer_simple();
    modern_fse_register_footer_minimal();
}

// النمط الأول: Footer Modern
function modern_fse_register_footer_modern() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|m"}}},"backgroundColor":"secondary-900","textColor":"white","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull has-white-color has-secondary-900-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--m)">
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:site-logo {"width":120} /-->
                <!-- wp:site-tagline {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} /-->
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
                <p class="has-secondary-300-color has-text-color has-link-color">نقدم حلولاً رقمية مبتكرة تساعدك على النمو والازدهار في العصر الرقمي.</p>
                <!-- /wp:paragraph -->
                <!-- wp:social-links {"iconColor":"secondary-300","iconColorValue":"#cbd5e1","className":"is-style-logos-only"} -->
                <ul class="wp-block-social-links is-style-logos-only has-icon-color">
                    <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                    <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                    <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                </ul>
                <!-- /wp:social-links -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem"}}} -->
                <h3 style="font-size:1.125rem">روابط سريعة</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"الرئيسية","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"من نحن","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الخدمات","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"المشاريع","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"اتصل بنا","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem"}}} -->
                <h3 style="font-size:1.125rem">الخدمات</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"تطوير الويب","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"تصميم UI/UX","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"التسويق الرقمي","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"استضافة المواقع","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الدعم الفني","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem"}}} -->
                <h3 style="font-size:1.125rem">اشترك في النشرة البريدية</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
                <p class="has-secondary-300-color has-text-color has-link-color">احصل على آخر التحديثات والعروض الحصرية.</p>
                <!-- /wp:paragraph -->
                <!-- wp:jetpack/contact-form -->
                <div class="wp-block-jetpack-contact-form">
                    <!-- wp:jetpack/field-email {"label":"البريد الإلكتروني"} /-->
                    <!-- wp:jetpack/button {"element":"button","text":"اشترك","lock":{"remove":true}} -->
                    <div class="wp-block-jetpack-button">
                        <button type="submit">اشترك</button>
                    </div>
                    <!-- /wp:jetpack/button -->
                </div>
                <!-- /wp:jetpack/contact-form -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:separator {"style":{"color":{"background":"var:preset|color|secondary-700"}},"className":"is-style-wide"} -->
        <hr class="wp-block-separator has-text-color has-background has-secondary-700-background-color has-secondary-700-color is-style-wide"/>
        <!-- /wp:separator -->
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
            <p class="has-secondary-300-color has-text-color has-link-color">© 2024 جميع الحقوق محفوظة. شركة مثال.</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
            <p class="has-secondary-300-color has-text-color has-link-color"><a href="#">سياسة الخصوصية</a> · <a href="#">شروط الاستخدام</a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        
    </footer>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/footer-modern',
        array(
            'title'       => __( 'Footer Modern', 'modern-fse-theme' ),
            'description' => __( 'فوتر عصري مع أعمدة متعددة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Footer Simple
function modern_fse_register_footer_simple() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|l"}}},"backgroundColor":"secondary-50","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull has-secondary-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:site-logo {"width":100} /-->
                <!-- wp:site-tagline {"style":{"typography":{"fontSize":"0.875rem"}}} /-->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:navigation {"layout":{"type":"flex","justifyContent":"right","orientation":"horizontal"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"الرئيسية","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"من نحن","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"اتصل بنا","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:separator {"className":"is-style-wide"} -->
        <hr class="wp-block-separator is-style-wide"/>
        <!-- /wp:separator -->
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
            <p style="font-size:0.875rem">© 2024 جميع الحقوق محفوظة.</p>
            <!-- /wp:paragraph -->
            <!-- wp:social-links {"iconColor":"secondary-600","iconColorValue":"#475569","iconBackgroundColor":"white","iconBackgroundColorValue":"#ffffff","size":"has-small-icon-size","className":"is-style-default"} -->
            <ul class="wp-block-social-links has-small-icon-size has-icon-color has-icon-background-color is-style-default">
                <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                <!-- wp:social-link {"url":"#","service":"instagram"} /-->
            </ul>
            <!-- /wp:social-links -->
        </div>
        <!-- /wp:group -->
        
    </footer>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/footer-simple',
        array(
            'title'       => __( 'Footer Simple', 'modern-fse-theme' ),
            'description' => __( 'فوتر بسيط وأنيق', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Footer Minimal
function modern_fse_register_footer_minimal() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center","orientation":"vertical"}} -->
        <div class="wp-block-group">
            
            <!-- wp:site-logo {"width":80} /-->
            
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
            <p class="has-text-align-center" style="font-size:0.875rem">© 2024 جميع الحقوق محفوظة</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:social-links {"iconColor":"secondary-600","iconColorValue":"#475569","size":"has-small-icon-size","className":"is-style-logos-only"} -->
            <ul class="wp-block-social-links has-small-icon-size has-icon-color is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                <!-- wp:social-link {"url":"#","service":"github"} /-->
            </ul>
            <!-- /wp:social-links -->
            
        </div>
        <!-- /wp:group -->
        
    </footer>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/footer-minimal',
        array(
            'title'       => __( 'Footer Minimal', 'modern-fse-theme' ),
            'description' => __( 'فوتر بسيط جداً', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}