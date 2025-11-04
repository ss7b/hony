<?php
/**
 * Contact Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_contact_patterns' );
function modern_fse_register_contact_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط الاتصال
    register_block_pattern_category(
        'modern-fse-contact',
        array( 'label' => __( 'Contact-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_contact_form();
    modern_fse_register_contact_split();
    modern_fse_register_contact_simple();
}

// النمط الأول: Contact Form
function modern_fse_register_contact_form() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">اتصل بنا</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">نحن هنا لمساعدتك! اترك رسالتك وسنعود إليك في أقرب وقت ممكن.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|m"}}} -->
                <div class="wp-block-group">
                    <!-- wp:heading {"level":3} -->
                    <h3>معلومات الاتصال</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>نحن دائماً متاحون للرد على استفساراتك ومساعدتك في تحقيق أهدافك.</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|m"}}} -->
                    <div class="wp-block-group">
                        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group">
                            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
                            <p style="font-size:1.125rem;font-weight:600">📍 العنوان</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                        <!-- wp:paragraph -->
                        <p>شارع الملك فهد، الرياض، المملكة العربية السعودية</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|m"}}} -->
                    <div class="wp-block-group">
                        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group">
                            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
                            <p style="font-size:1.125rem;font-weight:600">📞 الهاتف</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                        <!-- wp:paragraph -->
                        <p>+966 11 123 4567</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|m"}}} -->
                    <div class="wp-block-group">
                        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group">
                            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
                            <p style="font-size:1.125rem;font-weight:600">✉️ البريد الإلكتروني</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                        <!-- wp:paragraph -->
                        <p>info@example.com</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3} -->
                <h3>أرسل رسالة</h3>
                <!-- /wp:heading -->
                <!-- wp:jetpack/contact-form -->
                <div class="wp-block-jetpack-contact-form">
                    <!-- wp:jetpack/field-name {"required":true,"label":"الاسم الكامل"} /-->
                    <!-- wp:jetpack/field-email {"required":true,"label":"البريد الإلكتروني"} /-->
                    <!-- wp:jetpack/field-textarea {"required":true,"label":"الرسالة"} /-->
                    <!-- wp:jetpack/button {"element":"button","text":"إرسال الرسالة","lock":{"remove":true}} -->
                    <div class="wp-block-jetpack-button">
                        <button type="submit">إرسال الرسالة</button>
                    </div>
                    <!-- /wp:jetpack/button -->
                </div>
                <!-- /wp:jetpack/contact-form -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/contact-form',
        array(
            'title'       => __( 'Contact Form', 'modern-fse-theme' ),
            'description' => __( 'نموذج اتصال مع معلومات التواصل', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-contact' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Contact Split
function modern_fse_register_contact_split() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:media-text {"mediaPosition":"right","mediaId":0,"mediaLink":"' . esc_url( get_template_directory_uri() ) . '/assets/images/contact-map.jpg","mediaType":"image","verticalAlignment":"center"} -->
        <div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-center">
            <div class="wp-block-media-text__content">
                <!-- wp:heading -->
                <h2>تواصل معنا</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>نحن هنا للإجابة على جميع استفساراتك ومساعدتك في رحلتك الرقمية.</p>
                <!-- /wp:paragraph -->
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|l"}}} -->
                <div class="wp-block-group">
                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group">
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem","fontWeight":"600"}}} -->
                        <p style="font-size:1.25rem;font-weight:600">📍 مكتبنا</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                    <!-- wp:paragraph -->
                    <p>الرياض، المملكة العربية السعودية<br>المبنى التجاري، الطابق الرابع</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|l"}}} -->
                <div class="wp-block-group">
                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group">
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem","fontWeight":"600"}}} -->
                        <p style="font-size:1.25rem;font-weight:600">🕒 أوقات العمل</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                    <!-- wp:paragraph -->
                    <p>الأحد - الخميس: 8:00 ص - 5:00 م<br>الجمعة والسبت: مغلق</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">اتصل بنا الآن</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <figure class="wp-block-media-text__media"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/contact-map.jpg" alt="خريطة الموقع"/></figure>
        </div>
        <!-- /wp:media-text -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/contact-split',
        array(
            'title'       => __( 'Contact Split', 'modern-fse-theme' ),
            'description' => __( 'قسم اتصال منقسم مع خريطة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-contact' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Contact Simple
function modern_fse_register_contact_simple() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">ابقَ على تواصل</h2>
        <!-- /wp:heading -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem"}}} -->
                    <p class="has-text-align-center" style="font-size:3rem">📧</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center">البريد الإلكتروني</h4>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">info@example.com</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem"}}} -->
                    <p class="has-text-align-center" style="font-size:3rem">📞</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center">الهاتف</h4>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">+966 11 123 4567</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem"}}} -->
                    <p class="has-text-align-center" style="font-size:3rem">💬</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center">الدردشة المباشرة</h4>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">متاحة 24/7</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/contact-simple',
        array(
            'title'       => __( 'Contact Simple', 'modern-fse-theme' ),
            'description' => __( 'طرق اتصال بسيطة مع أيقونات', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-contact' ),
            'viewportWidth' => 1200,
        )
    );
}