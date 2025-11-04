<?php
/**
 * Team Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_team_patterns' );
function modern_fse_register_team_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط فريق العمل
    register_block_pattern_category(
        'modern-fse-team',
        array( 'label' => __( 'Team-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_team_grid();
    modern_fse_register_team_circles();
    modern_fse_register_team_detailed();
}

// النمط الأول: Team Grid
function modern_fse_register_team_grid() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">فريقنا المتميز</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">تعرف على الفريق المحترف الذي يعمل وراء الكواليس لتحقيق نجاحك</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:image {"width":200,"height":200,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-1.jpg" alt="أحمد محمد" width="200" height="200" style="border-radius:100px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"textAlign":"center","level":3} -->
                    <h3 class="wp-block-heading has-text-align-center">أحمد محمد</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500"} -->
                    <p class="has-text-align-center has-secondary-500-color has-text-color has-link-color">مدير المشاريع</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:social-links {"className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
                    <ul class="wp-block-social-links is-style-logos-only">
                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                        <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:image {"width":200,"height":200,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-2.jpg" alt="سارة الخالد" width="200" height="200" style="border-radius:100px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"textAlign":"center","level":3} -->
                    <h3 class="wp-block-heading has-text-align-center">سارة الخالد</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500"} -->
                    <p class="has-text-align-center has-secondary-500-color has-text-color has-link-color">مصممة UI/UX</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:social-links {"className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
                    <ul class="wp-block-social-links is-style-logos-only">
                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                        <!-- wp:social-link {"url":"#","service":"dribbble"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:image {"width":200,"height":200,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-3.jpg" alt="خالد أحمد" width="200" height="200" style="border-radius:100px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"textAlign":"center","level":3} -->
                    <h3 class="wp-block-heading has-text-align-center">خالد أحمد</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500"} -->
                    <p class="has-text-align-center has-secondary-500-color has-text-color has-link-color">مطور ويب</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:social-links {"className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
                    <ul class="wp-block-social-links is-style-logos-only">
                        <!-- wp:social-link {"url":"#","service":"github"} /-->
                        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/team-grid',
        array(
            'title'       => __( 'Team Grid', 'modern-fse-theme' ),
            'description' => __( 'شبكة أعضاء الفريق بصور دائرية', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-team' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Team Circles
function modern_fse_register_team_circles() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">خبراؤنا</h2>
        <!-- /wp:heading -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":120,"height":120,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"60px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-4.jpg" alt="فاطمة ناصر" width="120" height="120" style="border-radius:60px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center">فاطمة ناصر</h4>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
                    <p class="has-text-align-center" style="font-size:0.875rem">خبيرة تسويق</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":120,"height":120,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"60px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-5.jpg" alt="يوسف سالم" width="120" height="120" style="border-radius:60px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center">يوسف سالم</h4>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
                    <p class="has-text-align-center" style="font-size:0.875rem">مستشار تقني</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group">
                    <!-- wp:image {"width":120,"height":120,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"60px"}}} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-6.jpg" alt="لمى كمال" width="120" height="120" style="border-radius:60px"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center">لمى كمال</h4>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
                    <p class="has-text-align-center" style="font-size:0.875rem">مديرة مبيعات</p>
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
        'modern-fse/team-circles',
        array(
            'title'       => __( 'Team Circles', 'modern-fse-theme' ),
            'description' => __( 'فريق عمل بصور دائرية صغيرة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-team' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Team Detailed
function modern_fse_register_team_detailed() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">فريق القيادة</h2>
        <!-- /wp:heading -->
        
        <!-- wp:media-text {"mediaPosition":"right","mediaId":0,"mediaLink":"' . esc_url( get_template_directory_uri() ) . '/assets/images/team-leader.jpg","mediaType":"image","verticalAlignment":"center"} -->
        <div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-center">
            <div class="wp-block-media-text__content">
                <!-- wp:heading {"level":3} -->
                <h3>د. محمد الشريف</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500"} -->
                <p class="has-secondary-500-color has-text-color has-link-color">المدير التنفيذي والرئيس</p>
                <!-- /wp:paragraph -->
                <!-- wp:paragraph -->
                <p>قائد فريق بخبرة تزيد عن 15 عاماً في مجال التكنولوجيا وإدارة المشاريع. حاصل على شهادة الدكتوراة في إدارة الأعمال من جامعة هارفارد.</p>
                <!-- /wp:paragraph -->
                <!-- wp:list -->
                <ul>
                    <!-- wp:list-item -->
                    <li>خبرة 15+ سنة في القيادة</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>إدارة فرق متعددة الجنسيات</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>تخصص في التحول الرقمي</li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->
                <!-- wp:social-links {"className":"is-style-logos-only"} -->
                <ul class="wp-block-social-links is-style-logos-only">
                    <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                    <!-- wp:social-link {"url":"#","service":"twitter"} /-->
                    <!-- wp:social-link {"url":"#","service":"facebook"} /-->
                </ul>
                <!-- /wp:social-links -->
            </div>
            <figure class="wp-block-media-text__media"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/team-leader.jpg" alt="د. محمد الشريف"/></figure>
        </div>
        <!-- /wp:media-text -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/team-detailed',
        array(
            'title'       => __( 'Team Detailed', 'modern-fse-theme' ),
            'description' => __( 'عضو فريق مفصل مع سيرة ذاتية', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-team' ),
            'viewportWidth' => 1200,
        )
    );
}