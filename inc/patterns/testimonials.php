<?php
/**
 * Testimonials Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_testimonials_patterns' );
function modern_fse_register_testimonials_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط آراء العملاء
    register_block_pattern_category(
        'modern-fse-testimonials',
        array( 'label' => __( 'Testimonials-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_testimonials_grid();
    modern_fse_register_testimonials_carousel();
}

// النمط الأول: Testimonials Grid
function modern_fse_register_testimonials_grid() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">ماذا يقول عملاؤنا</h2>
        <!-- /wp:heading -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"border":{"radius":"12px"}},"backgroundColor":"secondary-50"} -->
                <div class="wp-block-group has-secondary-50-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l)">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","fontStyle":"normal","fontWeight":"500"}}} -->
                    <p style="font-size:1.125rem;font-style:normal;font-weight:500">"القوالب الجاهزة ساعدتني في إنشاء موقعي خلال ساعات قليلة!"</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group">
                        <!-- wp:image {"width":48,"height":48,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"24px"}}} -->
                        <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/avatar-1.jpg" alt="Ahmed" width="48" height="48" style="border-radius:24px"/></figure>
                        <!-- /wp:image -->
                        <!-- wp:group -->
                        <div class="wp-block-group">
                            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-900"}}}},"textColor":"secondary-900","fontSize":"small"} -->
                            <p class="has-secondary-900-color has-text-color has-link-color has-small-font-size">أحمد محمد</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500","fontSize":"small"} -->
                            <p class="has-secondary-500-color has-text-color has-link-color has-small-font-size">مدير تسويق</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"border":{"radius":"12px"}},"backgroundColor":"secondary-50"} -->
                <div class="wp-block-group has-secondary-50-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l)">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","fontStyle":"normal","fontWeight":"500"}}} -->
                    <p style="font-size:1.125rem;font-style:normal;font-weight:500">"الدعم الفني كان سريعًا ومحترفًا في حل جميع استفساراتي."</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group">
                        <!-- wp:image {"width":48,"height":48,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"24px"}}} -->
                        <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/avatar-2.jpg" alt="Sarah" width="48" height="48" style="border-radius:24px"/></figure>
                        <!-- /wp:image -->
                        <!-- wp:group -->
                        <div class="wp-block-group">
                            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-900"}}}},"textColor":"secondary-900","fontSize":"small"} -->
                            <p class="has-secondary-900-color has-text-color has-link-color has-small-font-size">سارة الخالد</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500","fontSize":"small"} -->
                            <p class="has-secondary-500-color has-text-color has-link-color has-small-font-size">مصممة UI/UX</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/testimonials-grid',
        array(
            'title'       => __( 'Testimonials Grid', 'modern-fse-theme' ),
            'description' => __( 'شبكة آراء العملاء', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-testimonials' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Testimonials Carousel
function modern_fse_register_testimonials_carousel() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">ثقة العملاء</h2>
        <!-- /wp:heading -->
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}},"border":{"radius":"16px"}},"backgroundColor":"primary-50"} -->
            <div class="wp-block-group has-primary-50-background-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem","fontStyle":"italic"}}} -->
                <p class="has-text-align-center" style="font-size:1.25rem;font-style:italic">"لقد ساعدني هذا القالب في تحويل فكرتي إلى واقع ملموس في وقت قياسي. الدعم الفني ممتاز والتحديثات مستمرة."</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:group {"layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|m"}}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":60,"height":60,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"30px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/avatar-3.jpg" alt="Customer" width="60" height="60" style="border-radius:30px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:group -->
                    <div class="wp-block-group">
                        <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary-900"}}}},"textColor":"primary-900","fontSize":"medium"} -->
                        <p class="has-text-align-center has-primary-900-color has-text-color has-link-color has-medium-font-size">محمد السعيد</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary-700"}}}},"textColor":"primary-700","fontSize":"small"} -->
                        <p class="has-text-align-center has-primary-700-color has-text-color has-link-color has-small-font-size">رائد أعمال</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/testimonials-carousel',
        array(
            'title'       => __( 'Testimonials Carousel', 'modern-fse-theme' ),
            'description' => __( 'عرض شرائح لآراء العملاء', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-testimonials' ),
            'viewportWidth' => 1200,
        )
    );
}