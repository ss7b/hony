<?php
/**
 * Hero Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_hero_patterns' );
function modern_fse_register_hero_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط البطل
    register_block_pattern_category(
        'modern-fse-hero',
        array( 'label' => __( 'Hero Sections-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_hero_centered();
    modern_fse_register_hero_split();
    modern_fse_register_hero_minimal();
    modern_fse_register_hero_slider_with_features();
}

// النمط الأول: Hero Centered
function modern_fse_register_hero_centered() {
    $content = '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-bg.jpg","dimRatio":20,"isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-cover alignfull is-light" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim"></span><div class="wp-block-cover__inner-container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 5vw, 4rem)","fontWeight":"800","lineHeight":"1.1"}}} -->
            <h1 class="wp-block-heading has-text-align-center" style="font-size:clamp(2.5rem, 5vw, 4rem);font-weight:800;line-height:1.1">ابني موقعك الأحلام بتقنيات حديثة</h1>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"}}} -->
            <p class="has-text-align-center" style="font-size:1.25rem">قالب ووردبريس عصير يدعم Full Site Editing مع تصميم مرن يناسب جميع احتياجاتك</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"primary","textColor":"white","className":"is-style-fill"} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">ابدأ الآن</a></div>
                <!-- /wp:button -->
                <!-- wp:button {"className":"is-style-outline"} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">اعرف المزيد</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->

    </div></div>
    <!-- /wp:cover -->';

    register_block_pattern(
        'modern-fse/hero-centered',
        array(
            'title'       => __( 'Hero Centered', 'modern-fse-theme' ),
            'description' => __( 'قسم بطل مركزي مع صورة خلفية', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-hero' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Hero Split Layout
function modern_fse_register_hero_split() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
        <div class="wp-block-columns alignwide are-vertically-aligned-center">
            
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center">
                
                <!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 5vw, 4rem)","fontWeight":"800","lineHeight":"1.1"}}} -->
                <h1 style="font-size:clamp(2.5rem, 5vw, 4rem);font-weight:800;line-height:1.1">تصميم مواقع احترافية بسهولة فائقة</h1>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem"}}} -->
                <p style="font-size:1.25rem">استخدم قالبنا الحديث لإنشاء مواقع شركات، متاجر إلكترونية، مدونات، وعروض تقديمية احترافية.</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:list -->
                <ul>
                    <!-- wp:list-item -->
                    <li>تصميم متجاوب مع جميع الأجهزة</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>تحميل سريع وأداء عالي</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>دعم كامل للغة العربية</li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">ابدأ التجربة</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center">
                <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-image.png" alt="Hero Image"/></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/hero-split',
        array(
            'title'       => __( 'Hero Split Layout', 'modern-fse-theme' ),
            'description' => __( 'قسم بطل بتصميم منقسم مع نص وصورة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-hero' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Hero Minimal
function modern_fse_register_hero_minimal() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2rem, 4vw, 3rem)","fontWeight":"700","lineHeight":"1.2"}}} -->
            <h1 class="wp-block-heading has-text-align-center" style="font-size:clamp(2rem, 4vw, 3rem);font-weight:700;line-height:1.2">البساطة هي الأناقة الحقيقية</h1>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">تصميم بسيط وأنيق يحقق الغرض دون تعقيد</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-outline"} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">استكشف المزيد</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/hero-minimal',
        array(
            'title'       => __( 'Hero Minimal', 'modern-fse-theme' ),
            'description' => __( 'قسم بطل بسيط وأنيق', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-hero' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الرابع: Hero Slider مع بطاقات المميزات
function modern_fse_register_hero_slider_with_features() {
    $content = '
    <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","inherit":false}} -->
        <div class="wp-block-group alignfull hero-features-container" style="padding-top:0;padding-bottom:0">

            <!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-bg.jpg","dimRatio":30,"isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}},"layout":{"type":"constrained"}},"className":"hero-slider-container"} -->
            <div class="wp-block-cover alignfull is-light hero-slider-container" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container">

                <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"},"className":"hero-slider-content"} -->
                <div class="wp-block-group hero-slider-content">

                    <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 5vw, 4rem)","fontWeight":"800","lineHeight":"1.1"},"animation":{"type":"fadeInUp","duration":0.8}},"className":"hero-slider-title"} -->
                    <h1 class="wp-block-heading has-text-align-center hero-slider-title" style="font-size:clamp(2.5rem, 5vw, 4rem);font-weight:800;line-height:1.1">أهلا بكم في Hony Exports</h1>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"},"animation":{"type":"fadeInUp","duration":0.8,"delay":0.2}},"className":"hero-slider-subtitle"} -->
                    <p class="has-text-align-center hero-slider-subtitle" style="font-size:1.25rem">جودة معتمدة على مدار السنة، في التوقيت المناسب</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"className":"hero-slider-buttons"} -->
                    <div class="wp-block-buttons hero-slider-buttons">
                        <!-- wp:button {"backgroundColor":"primary","textColor":"white","className":"is-style-fill hero-cta-button"} -->
                        <div class="wp-block-button is-style-fill hero-cta-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">تواصل معنا</a></div>
                        <!-- /wp:button -->
                        <!-- wp:button {"className":"is-style-outline hero-secondary-button"} -->
                        <div class="wp-block-button is-style-outline hero-secondary-button"><a class="wp-block-button__link wp-element-button">عرفنا أكثر</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div></div>
            <!-- /wp:cover -->

            <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}},"backgroundColor":"white"},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull features" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl);background-color:white">

                <!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":"var:preset|spacing|xl"}}} -->
                <div class="wp-block-columns alignwide are-vertically-aligned-center">

                    <!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"border":{"radius":"var:preset|spacing|m"},"backgroundColor":"secondary-50","boxShadow":"0 4px 6px rgba(0, 0, 0, 0.1)"}} -->
                    <div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);border-radius:0.5rem;background-color:var(--wp--preset--color--secondary-50);box-shadow:0 4px 6px rgba(0, 0, 0, 0.1)">

                        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem","fontWeight":"700"},"color":{"text":"primary-600"}}} -->
                        <p class="has-text-align-center has-primary-600-color has-text-color" style="font-size:3rem;font-weight:700">100%</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="font-size:1.5rem;font-weight:600">جودة معتمدة</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"secondary-600"},"typography":{"fontSize":"0.95rem"}}} -->
                        <p class="has-text-align-center has-secondary-600-color has-text-color" style="font-size:0.95rem">معايير عالية في كل عملية إنتاج</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"border":{"radius":"var:preset|spacing|m"},"backgroundColor":"secondary-50","boxShadow":"0 4px 6px rgba(0, 0, 0, 0.1)"}} -->
                    <div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);border-radius:0.5rem;background-color:var(--wp--preset--color--secondary-50);box-shadow:0 4px 6px rgba(0, 0, 0, 0.1)">

                        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem","fontWeight":"700"},"color":{"text":"success-500"}}} -->
                        <p class="has-text-align-center has-success-500-color has-text-color" style="font-size:3rem;font-weight:700">24/7</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="font-size:1.5rem;font-weight:600">طازة دائمة</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"secondary-600"},"typography":{"fontSize":"0.95rem"}}} -->
                        <p class="has-text-align-center has-secondary-600-color has-text-color" style="font-size:0.95rem">توفير المنتجات الطازة على مدار الساعة</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"border":{"radius":"var:preset|spacing|m"},"backgroundColor":"secondary-50","boxShadow":"0 4px 6px rgba(0, 0, 0, 0.1)"}} -->
                    <div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);border-radius:0.5rem;background-color:var(--wp--preset--color--secondary-50);box-shadow:0 4px 6px rgba(0, 0, 0, 0.1)">

                        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem","fontWeight":"700"},"color":{"text":"accent-500"}}} -->
                        <p class="has-text-align-center has-accent-500-color has-text-color" style="font-size:3rem;font-weight:700">∞</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="font-size:1.5rem;font-weight:600">مرونة عالية</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"secondary-600"},"typography":{"fontSize":"0.95rem"}}} -->
                        <p class="has-text-align-center has-secondary-600-color has-text-color" style="font-size:0.95rem">تكيف مستمر مع احتياجات السوق</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

            </div>
            <!-- /wp:group -->

        </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/hero-slider-features',
        array(
            'title'       => __( 'Hero Slider with Features', 'modern-fse-theme' ),
            'description' => __( 'قسم بطل مع سلايدر والنصوص مع بطاقات المميزات الثلاث أدناه', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-hero' ),
            'viewportWidth' => 1200,
        )
    );
}