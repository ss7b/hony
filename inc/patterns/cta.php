<?php
/**
 * CTA Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_cta_patterns' );
function modern_fse_register_cta_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط الدعوة للإجراء
    register_block_pattern_category(
        'modern-fse-cta',
        array( 'label' => __( 'Call to Action-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_cta_simple();
    modern_fse_register_cta_background();
    modern_fse_register_cta_split();
}

// النمط الأول: CTA Simple
function modern_fse_register_cta_simple() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}},"color":{"background":"var:preset|color|primary-50"}}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:var(--wp--preset--color--primary-50);padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center"} -->
            <h2 class="wp-block-heading has-text-align-center">مستعد لبدء مشروعك القادم؟</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">انضم إلى آلاف العملاء الراضين عن خدماتنا وابدأ رحلتك نحو النجاح</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">ابدأ الآن مجانًا</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/cta-simple',
        array(
            'title'       => __( 'CTA Simple', 'modern-fse-theme' ),
            'description' => __( 'قسم دعوة للإجراء بسيط', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-cta' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: CTA with Background
function modern_fse_register_cta_background() {
    $content = '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/cta-bg.jpg","dimRatio":50,"isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}}} -->
    <div class="wp-block-cover alignfull is-light" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-50 has-background-dim"></span><div class="wp-block-cover__inner-container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#ffffff"}}} -->
            <h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff">حان وقت التغيير</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#ffffff">لا تنتظر أكثر، ابدأ رحلتك نحو النجاح اليوم</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">احجز استشارة مجانية</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
    </div></div>
    <!-- /wp:cover -->';

    register_block_pattern(
        'modern-fse/cta-background',
        array(
            'title'       => __( 'CTA with Background', 'modern-fse-theme' ),
            'description' => __( 'دعوة للإجراء مع صورة خلفية', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-cta' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: CTA Split
function modern_fse_register_cta_split() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:columns {"verticalAlignment":"center"} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading -->
                <h2>جاهز للانطلاق؟</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>الالاف من العملاء حول العالم يثقون بنا لتحقيق أحلامهم الرقمية</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">اشترك الآن</a></div>
                    <!-- /wp:button -->
                    <!-- wp:button {"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">تواصل معنا</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/cta-split',
        array(
            'title'       => __( 'CTA Split', 'modern-fse-theme' ),
            'description' => __( 'دعوة للإجراء منقسمة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-cta' ),
            'viewportWidth' => 1200,
        )
    );
}