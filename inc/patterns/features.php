<?php
/**
 * Features Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_features_patterns' );
function modern_fse_register_features_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط الميزات
    register_block_pattern_category(
        'modern-fse-features',
        array( 'label' => __( 'Features-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_features_three_column();
    modern_fse_register_features_grid();
    modern_fse_register_features_list();
}

// النمط الأول: Features Three Column
function modern_fse_register_features_three_column() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">ميزاتنا الرائعة</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">اكتشف مجموعة الميزات المميزة التي تجعل قالبنا الخيار الأمثل لمشروعك القادم</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"shadow":"medium"},"backgroundColor":"white"} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);box-shadow:var(--wp--preset--shadow--medium)">
                    <!-- wp:image {"width":"60px","height":"60px","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/icon-design.svg" alt="Design" width="60" height="60"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"level":3} -->
                    <h3>تصميم عصري</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>تصميم حديث وجذاب يتوافق مع أحدث اتجاهات التصميم العالمية</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"shadow":"medium"},"backgroundColor":"white"} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);box-shadow:var(--wp--preset--shadow--medium)">
                    <!-- wp:image {"width":"60px","height":"60px","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/icon-responsive.svg" alt="Responsive" width="60" height="60"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"level":3} -->
                    <h3>تصميم متجاوب</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>يتكيف التصميم مع جميع أحجام الشاشات من الجوال إلى الحواسيب</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"shadow":"medium"},"backgroundColor":"white"} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);box-shadow:var(--wp--preset--shadow--medium)">
                    <!-- wp:image {"width":"60px","height":"60px","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/icon-speed.svg" alt="Speed" width="60" height="60"/></figure>
                    <!-- /wp:image -->
                    <!-- wp:heading {"level":3} -->
                    <h3>أداء سريع</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>تحميل فائق السرعة يحسن تجربة المستخدم وترتيب SEO</p>
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
        'modern-fse/features-three-column',
        array(
            'title'       => __( 'Features Three Column', 'modern-fse-theme' ),
            'description' => __( 'قسم الميزات بثلاث أعمدة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-features' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Features Grid
function modern_fse_register_features_grid() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">لماذا تختارنا؟</h2>
        <!-- /wp:heading -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
                    <h3 style="font-size:1.5rem">🧩 بناء سريع</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>أنشئ موقعك في دقائق باستخدام أدوات السحب والإفلات</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
                    <h3 style="font-size:1.5rem">🎨 تصميم مرن</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>تخصيص كامل للألوان، الخطوط، والتخطيطات بدون كتابة كود</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
                    <h3 style="font-size:1.5rem">🚀 أداء متميز</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>تحميل فائق السرعة محسن لمحركات البحث وتجربة المستخدم</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
                    <h3 style="font-size:1.5rem">📱 متجاوب</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph -->
                    <p>يتكيف مع جميع الأجهزة من الجوال إلى الحواسيب المكتبية</p>
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
        'modern-fse/features-grid',
        array(
            'title'       => __( 'Features Grid', 'modern-fse-theme' ),
            'description' => __( 'شبكة ميزات مع أيقونات', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-features' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Features List
function modern_fse_register_features_list() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:columns {"verticalAlignment":"center"} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading -->
                <h2>كل ما تحتاجه في مكان واحد</h2>
                <!-- /wp:heading -->
                <!-- wp:list -->
                <ul>
                    <!-- wp:list-item -->
                    <li>بناء صفحات بدون كود</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>مكتبة أنماط جاهزة</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>تحرير كامل للموقع</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>تحسين لمحركات البحث</li>
                    <!-- /wp:list-item -->
                    <!-- wp:list-item -->
                    <li>دعم فني متكامل</li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">اكتشف المزيد</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/features-image.png" alt="Features"/></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/features-list',
        array(
            'title'       => __( 'Features List', 'modern-fse-theme' ),
            'description' => __( 'قائمة ميزات مع صورة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-features' ),
            'viewportWidth' => 1200,
        )
    );
}