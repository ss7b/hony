<?php
/**
 * Pricing Patterns for Modern FSE Theme
 */

add_action( 'init', 'modern_fse_register_pricing_patterns' );
function modern_fse_register_pricing_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط الأسعار
    register_block_pattern_category(
        'modern-fse-pricing',
        array( 'label' => __( 'Pricing-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_pricing_three_tiers();
    modern_fse_register_pricing_simple();
    modern_fse_register_pricing_comparison();
}

// النمط الأول: Pricing Three Tiers
function modern_fse_register_pricing_three_tiers() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">خطط الأسعار</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">اختر الخطة التي تناسب احتياجاتك وابدأ رحلتك نحو النجاح</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"shadow":"medium"},"backgroundColor":"white"} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);box-shadow:var(--wp--preset--shadow--medium)">
                    <!-- wp:heading {"textAlign":"center","level":3} -->
                    <h3 class="wp-block-heading has-text-align-center">الأساسية</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
                    <p class="has-text-align-center" style="font-size:2.5rem;font-weight:800">$19<span style="font-size:1rem;font-weight:400">/شهرياً</span></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:list -->
                    <ul>
                        <!-- wp:list-item -->
                        <li>5 صفحات ويب</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>1GB مساحة تخزين</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>دعم عبر البريد الإلكتروني</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>نطاق فرعي مجاني</li>
                        <!-- /wp:list-item -->
                    </ul>
                    <!-- /wp:list -->
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">ابدأ الآن</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"shadow":"large"},"backgroundColor":"primary","textColor":"white"} -->
                <div class="wp-block-group has-primary-background-color has-white-color has-text-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);box-shadow:var(--wp--preset--shadow--large)">
                    <!-- wp:heading {"textAlign":"center","level":3} -->
                    <h3 class="wp-block-heading has-text-align-center">المحترفة</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
                    <p class="has-text-align-center" style="font-size:2.5rem;font-weight:800">$49<span style="font-size:1rem;font-weight:400">/شهرياً</span></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:list -->
                    <ul>
                        <!-- wp:list-item -->
                        <li>20 صفحة ويب</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>5GB مساحة تخزين</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>دعم فني سريع</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>نطاق مخصص</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>شهادة SSL مجانية</li>
                        <!-- /wp:list-item -->
                    </ul>
                    <!-- /wp:list -->
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary"} -->
                        <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">ابدأ الآن</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"shadow":"medium"},"backgroundColor":"white"} -->
                <div class="wp-block-group has-white-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);box-shadow:var(--wp--preset--shadow--medium)">
                    <!-- wp:heading {"textAlign":"center","level":3} -->
                    <h3 class="wp-block-heading has-text-align-center">المؤسسات</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
                    <p class="has-text-align-center" style="font-size:2.5rem;font-weight:800">$99<span style="font-size:1rem;font-weight:400">/شهرياً</span></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:list -->
                    <ul>
                        <!-- wp:list-item -->
                        <li>صفحات ويب غير محدودة</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>50GB مساحة تخزين</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>دعم فني مخصص</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>نطاقات متعددة</li>
                        <!-- /wp:list-item -->
                        <!-- wp:list-item -->
                        <li>أدوات تحليل متقدمة</li>
                        <!-- /wp:list-item -->
                    </ul>
                    <!-- /wp:list -->
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">ابدأ الآن</a></div>
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
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/pricing-three-tiers',
        array(
            'title'       => __( 'Pricing Three Tiers', 'modern-fse-theme' ),
            'description' => __( 'ثلاثة مستويات أسعار مع خطة مميزة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-pricing' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: Pricing Simple
function modern_fse_register_pricing_simple() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">خطة واحدة بسيطة</h2>
        <!-- /wp:heading -->
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"},"style":{"border":{"radius":"16px"},"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}},"shadow":"large"},"backgroundColor":"primary-50"} -->
        <div class="wp-block-group has-primary-50-background-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);box-shadow:var(--wp--preset--shadow--large)">
            
            <!-- wp:heading {"textAlign":"center","level":3} -->
            <h3 class="wp-block-heading has-text-align-center">الخطة الشاملة</h3>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem","fontWeight":"800"}}} -->
            <p class="has-text-align-center" style="font-size:3rem;font-weight:800">$29<span style="font-size:1.25rem;font-weight:400">/شهرياً</span></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:list -->
            <ul>
                <!-- wp:list-item -->
                <li>صفحات ويب غير محدودة</li>
                <!-- /wp:list-item -->
                <!-- wp:list-item -->
                <li>10GB مساحة تخزين</li>
                <!-- /wp:list-item -->
                <!-- wp:list-item -->
                <li>نطاق مخصص مجاني</li>
                <!-- /wp:list-item -->
                <!-- wp:list-item -->
                <li>شهادة SSL مجانية</li>
                <!-- /wp:list-item -->
                <!-- wp:list-item -->
                <li>دعم فني 24/7</li>
                <!-- /wp:list-item -->
                <!-- wp:list-item -->
                <li>نسخ احتياطي يومي</li>
                <!-- /wp:list-item -->
            </ul>
            <!-- /wp:list -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">اشترك الآن</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
            
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
            <p class="has-text-align-center" style="font-size:0.875rem">لا توجد التزامات طويلة الأجل - إلغاء في أي وقت</p>
            <!-- /wp:paragraph -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/pricing-simple',
        array(
            'title'       => __( 'Pricing Simple', 'modern-fse-theme' ),
            'description' => __( 'خطة أسعار واحدة بسيطة وشاملة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-pricing' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: Pricing Comparison
function modern_fse_register_pricing_comparison() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">مقارنة الخطط</h2>
        <!-- /wp:heading -->
        
        <!-- wp:table -->
        <figure class="wp-block-table">
            <table>
                <thead>
                    <tr>
                        <th>الميزة</th>
                        <th>الأساسية</th>
                        <th>المحترفة</th>
                        <th>المؤسسات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>عدد الصفحات</td>
                        <td>5</td>
                        <td>20</td>
                        <td>غير محدود</td>
                    </tr>
                    <tr>
                        <td>مساحة التخزين</td>
                        <td>1GB</td>
                        <td>5GB</td>
                        <td>50GB</td>
                    </tr>
                    <tr>
                        <td>النطاق</td>
                        <td>فرعي</td>
                        <td>مخصص</td>
                        <td>متعدد</td>
                    </tr>
                    <tr>
                        <td>الدعم الفني</td>
                        <td>بريد إلكتروني</td>
                        <td>سريع</td>
                        <td>مخصص</td>
                    </tr>
                    <tr>
                        <td>السعر الشهري</td>
                        <td>$19</td>
                        <td>$49</td>
                        <td>$99</td>
                    </tr>
                </tbody>
            </table>
        </figure>
        <!-- /wp:table -->
        
        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">الأساسية</a></div>
            <!-- /wp:button -->
            <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
            <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">المحترفة</a></div>
            <!-- /wp:button -->
            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">المؤسسات</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/pricing-comparison',
        array(
            'title'       => __( 'Pricing Comparison', 'modern-fse-theme' ),
            'description' => __( 'جدول مقارنة بين الخطط المختلفة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-pricing' ),
            'viewportWidth' => 1200,
        )
    );
}