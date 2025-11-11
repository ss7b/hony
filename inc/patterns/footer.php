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
    modern_fse_register_footer_ecommerce();
    modern_fse_register_footer_premium();
    modern_fse_register_footer_corporate();
    modern_fse_register_footer_creative();
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

// النمط الرابع: Footer E-commerce
function modern_fse_register_footer_ecommerce() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|l"}}},"backgroundColor":"secondary-900","textColor":"white","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull has-white-color has-secondary-900-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:site-logo {"width":120} /-->
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
                <p class="has-secondary-300-color has-text-color has-link-color">متجرك الموثوق للتسوق الإلكتروني</p>
                <!-- /wp:paragraph -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|secondary-400"}}}},"textColor":"secondary-400"} -->
                <p class="has-secondary-400-color has-text-color has-link-color" style="font-size:0.875rem">جودة عالية وأسعار منافسة مع ضمان الرضا 100%</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">تسوق</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"المنتجات","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"العروض","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الأقسام","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الرسائل والشحنات","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">خدمة العملاء</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"الأسئلة الشائعة","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الشحن والتوصيل","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"السياسات","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"اتصل بنا","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">معلومات</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
                <p class="has-secondary-300-color has-text-color has-link-color" style="font-size:0.875rem">
                    📍 العنوان: مصر<br>
                    📞 الهاتف: +20 1234567890<br>
                    📧 البريد: info@store.com<br>
                    ⏰ الدعم: 24/7
                </p>
                <!-- /wp:paragraph -->
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
            <p class="has-secondary-300-color has-text-color has-link-color">© 2024 جميع الحقوق محفوظة. متجرك الإلكتروني.</p>
            <!-- /wp:paragraph -->
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","gap":"var:preset|spacing|s"}} -->
            <div class="wp-block-group">
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
                <p class="has-secondary-300-color has-text-color has-link-color"><a href="#">سياسة الخصوصية</a> · <a href="#">شروط الاستخدام</a> · <a href="#">سياسة الاسترجاع</a></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:social-links {"iconColor":"secondary-300","iconColorValue":"#cbd5e1","className":"is-style-logos-only"} -->
        <ul class="wp-block-social-links is-style-logos-only has-icon-color">
            <!-- wp:social-link {"url":"#","service":"facebook"} /-->
            <!-- wp:social-link {"url":"#","service":"twitter"} /-->
            <!-- wp:social-link {"url":"#","service":"instagram"} /-->
            <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
        </ul>
        <!-- /wp:social-links -->
        
    </footer>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/footer-ecommerce',
        array(
            'title'       => __( 'Footer E-commerce', 'modern-fse-theme' ),
            'description' => __( 'فوتر متخصص للمتاجر الإلكترونية مع معلومات الشحن والدعم', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الخامس: Footer Premium
function modern_fse_register_footer_premium() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|l"}}},"backgroundColor":"primary-900","textColor":"white","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull has-white-color has-primary-900-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column {"width":"40%"} -->
            <div class="wp-block-column" style="flex-basis:40%">
                <!-- wp:site-logo {"width":130} /-->
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary-300"}}}},"textColor":"primary-300"} -->
                <p class="has-primary-300-color has-text-color has-link-color">نحن متخصصون في تقديم حلول عالية الجودة تتجاوز التوقعات وتحقق النتائج المطلوبة.</p>
                <!-- /wp:paragraph -->
                <!-- wp:social-links {"iconColor":"white","iconColorValue":"#ffffff","size":"has-large-icon-size","className":"is-style-logos-only"} -->
                <ul class="wp-block-social-links has-large-icon-size has-icon-color is-style-logos-only">
                    <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                    <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                    <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                </ul>
                <!-- /wp:social-links -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"20%"} -->
            <div class="wp-block-column" style="flex-basis:20%">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem"}}} -->
                <h3 style="font-size:1.125rem">روابط سريعة</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"الرئيسية","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"من نحن","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الخدمات","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"المشاريع","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"المدونة","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"20%"} -->
            <div class="wp-block-column" style="flex-basis:20%">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem"}}} -->
                <h3 style="font-size:1.125rem">الخدمات</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"استشارات","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"تطوير","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"تصميم","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"دعم","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"20%"} -->
            <div class="wp-block-column" style="flex-basis:20%">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem"}}} -->
                <h3 style="font-size:1.125rem">اتصل بنا</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|primary-300"}}}},"textColor":"primary-300"} -->
                <p class="has-primary-300-color has-text-color has-link-color" style="font-size:0.875rem">
                    📧 <a href="mailto:info@example.com">info@example.com</a><br>
                    📞 <a href="tel:+20123456789">+20 123456789</a>
                </p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:separator {"style":{"color":{"background":"var:preset|color|primary-700"}},"className":"is-style-wide"} -->
        <hr class="wp-block-separator has-text-color has-background has-primary-700-background-color has-primary-700-color is-style-wide"/>
        <!-- /wp:separator -->
        
        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|primary-300"}}}},"textColor":"primary-300"} -->
        <p class="has-text-align-center has-primary-300-color has-text-color has-link-color" style="font-size:0.875rem">© 2024 جميع الحقوق محفوظة · <a href="#">سياسة الخصوصية</a> · <a href="#">شروط الاستخدام</a></p>
        <!-- /wp:paragraph -->
        
    </footer>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/footer-premium',
        array(
            'title'       => __( 'Footer Premium', 'modern-fse-theme' ),
            'description' => __( 'فوتر فاخر مع تصميم احترافي ومحتوى غني', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط السادس: Footer Corporate
function modern_fse_register_footer_corporate() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|m"}}},"backgroundColor":"secondary-100","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull has-secondary-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--m)">
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:site-logo {"width":150} /-->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
                <p style="font-size:0.875rem">شركة متخصصة في الحلول الرقمية المتقدمة</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">عن الشركة</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"من نحن","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"رؤيتنا","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الفريق","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">العملاء</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"حلول المؤسسات","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"حلول الشركات الناشئة","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الإستشارات","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">الموارد</h3>
                <!-- /wp:heading -->
                <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                <!-- wp:navigation-link {"label":"المدونة","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الأسئلة الشائعة","url":"#","kind":"custom"} /-->
                <!-- wp:navigation-link {"label":"الدعم","url":"#","kind":"custom"} /-->
                <!-- /wp:navigation -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem"}}} -->
                <h3 style="font-size:1rem">اتصل بنا</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
                <p style="font-size:0.875rem">
                    📧 <a href="mailto:contact@company.com">contact@company.com</a><br>
                    📞 <a href="tel:+20123456789">+20 123456789</a><br>
                    📍 مصر، القاهرة
                </p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:separator {"className":"is-style-wide"} -->
        <hr class="wp-block-separator is-style-wide"/>
        <!-- /wp:separator -->
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
            <p style="font-size:0.875rem">© 2024 جميع الحقوق محفوظة.</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
            <p style="font-size:0.875rem"><a href="#">سياسة الخصوصية</a> | <a href="#">شروط الاستخدام</a> | <a href="#">خريطة الموقع</a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        
    </footer>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/footer-corporate',
        array(
            'title'       => __( 'Footer Corporate', 'modern-fse-theme' ),
            'description' => __( 'فوتر احترافي للشركات والمؤسسات', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط السابع: Footer Creative
function modern_fse_register_footer_creative() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|l"}}},"backgroundColor":"secondary-900","textColor":"white","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group alignfull has-white-color has-secondary-900-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--l)">
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","alignItems":"flex-start"}} -->
        <div class="wp-block-group">
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","orientation":"vertical"}} -->
            <div class="wp-block-group">
                <!-- wp:site-logo {"width":150} /-->
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
                <p class="has-secondary-300-color has-text-color has-link-color">استراتيجيتنا هي الإبداع والابتكار في كل مشروع</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","gap":"var:preset|spacing|l"}} -->
            <div class="wp-block-group">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","gap":"var:preset|spacing|s"}} -->
                <div class="wp-block-group">
                    <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.95rem"}}} -->
                    <h4 style="font-size:0.95rem">منتجاتنا</h4>
                    <!-- /wp:heading -->
                    <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                    <!-- wp:navigation-link {"label":"المنصة الرئيسية","url":"#","kind":"custom"} /-->
                    <!-- wp:navigation-link {"label":"الأدوات","url":"#","kind":"custom"} /-->
                    <!-- wp:navigation-link {"label":"التقارير","url":"#","kind":"custom"} /-->
                    <!-- /wp:navigation -->
                </div>
                <!-- /wp:group -->
                
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","gap":"var:preset|spacing|s"}} -->
                <div class="wp-block-group">
                    <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.95rem"}}} -->
                    <h4 style="font-size:0.95rem">المجتمع</h4>
                    <!-- /wp:heading -->
                    <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                    <!-- wp:navigation-link {"label":"المدونة","url":"#","kind":"custom"} /-->
                    <!-- wp:navigation-link {"label":"الفعاليات","url":"#","kind":"custom"} /-->
                    <!-- wp:navigation-link {"label":"المجتمع","url":"#","kind":"custom"} /-->
                    <!-- /wp:navigation -->
                </div>
                <!-- /wp:group -->
                
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","gap":"var:preset|spacing|s"}} -->
                <div class="wp-block-group">
                    <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.95rem"}}} -->
                    <h4 style="font-size:0.95rem">الدعم</h4>
                    <!-- /wp:heading -->
                    <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"typography":{"fontSize":"0.875rem"}},"fontSize":"small"} -->
                    <!-- wp:navigation-link {"label":"مركز المساعدة","url":"#","kind":"custom"} /-->
                    <!-- wp:navigation-link {"label":"اتصل بنا","url":"#","kind":"custom"} /-->
                    <!-- wp:navigation-link {"label":"الأمان","url":"#","kind":"custom"} /-->
                    <!-- /wp:navigation -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- wp:separator {"style":{"color":{"background":"var:preset|color|secondary-700"}},"className":"is-style-wide"} -->
        <hr class="wp-block-separator has-text-color has-background has-secondary-700-background-color has-secondary-700-color is-style-wide"/>
        <!-- /wp:separator -->
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-300"}}}},"textColor":"secondary-300"} -->
            <p class="has-secondary-300-color has-text-color has-link-color">© 2024 جميع الحقوق محفوظة.</p>
            <!-- /wp:paragraph -->
            <!-- wp:social-links {"iconColor":"secondary-300","iconColorValue":"#cbd5e1","size":"has-small-icon-size","className":"is-style-logos-only"} -->
            <ul class="wp-block-social-links has-small-icon-size has-icon-color is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"facebook"} /-->
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
        'modern-fse/footer-creative',
        array(
            'title'       => __( 'Footer Creative', 'modern-fse-theme' ),
            'description' => __( 'فوتر إبداعي مع تصميم حديث ومرن', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-footer' ),
            'viewportWidth' => 1200,
        )
    );
}