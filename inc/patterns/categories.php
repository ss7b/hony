<?php
/**
 * Categories Patterns for Modern FSE Theme
 * أنماط لعرض التصنيفات للموقع العادي والمتجر
 */

add_action( 'init', 'modern_fse_register_categories_patterns' );
function modern_fse_register_categories_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة أنماط التصنيفات
    register_block_pattern_category(
        'modern-fse-categories',
        array( 'label' => __( 'Categories-c', 'modern-fse-theme' ) )
    );

    // تسجيل الأنماط
    modern_fse_register_categories_grid_blog();
    modern_fse_register_categories_grid_shop();
    modern_fse_register_categories_list_blog();
    modern_fse_register_categories_list_shop();
    modern_fse_register_categories_featured_blog();
    modern_fse_register_categories_featured_shop();
}

// النمط الأول: شبكة تصنيفات المدونة
function modern_fse_register_categories_grid_blog() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">تصنيفات المدونة</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">استكشف مقالاتنا من خلال التصنيفات المختلفة</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:query {"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"align":"wide"} -->
        <div class="wp-block-query alignwide">
            
            <!-- wp:post-template -->
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}},"border":{"radius":"12px"}},"backgroundColor":"primary-50","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-primary-50-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l)">
                
                <!-- wp:post-title {"level":3,"isLink":true,"textAlign":"center","style":{"typography":{"fontSize":"1.25rem","fontWeight":"600"}}} /-->
                
                <!-- wp:post-terms {"term":"category","textAlign":"center","separator":" • ","style":{"typography":{"fontSize":"0.875rem"}}} /-->
                
            </div>
            <!-- /wp:group -->
            <!-- /wp:post-template -->
            
        </div>
        <!-- /wp:query -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/categories-grid-blog',
        array(
            'title'       => __( 'Blog Categories Grid', 'modern-fse-theme' ),
            'description' => __( 'شبكة تصنيفات المدونة مع تصميم بطاقات', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-categories' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثاني: شبكة تصنيفات المتجر
function modern_fse_register_categories_grid_shop() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">فئات المتجر</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">استكشف منتجاتنا من خلال الفئات المختلفة</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:woocommerce/product-categories {"hasCount":true,"hasImage":true,"isDropdown":false,"align":"wide"} -->
        <div class="wp-block-woocommerce-product-categories alignwide">
            <ul class="wc-block-product-categories-list wc-block-product-categories-list--has-images">
                <!-- wp:woocommerce/product-category -->
                <li class="wc-block-product-categories-list-item">
                    <a href="#">
                        <img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/category-electronics.jpg" alt="الإلكترونيات" />
                        <span class="wc-block-product-categories-list-item__name">الإلكترونيات</span>
                        <span class="wc-block-product-categories-list-item__count">(24)</span>
                    </a>
                </li>
                <!-- /wp:woocommerce/product-category -->
                
                <!-- wp:woocommerce/product-category -->
                <li class="wc-block-product-categories-list-item">
                    <a href="#">
                        <img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/category-fashion.jpg" alt="الموضة" />
                        <span class="wc-block-product-categories-list-item__name">الموضة</span>
                        <span class="wc-block-product-categories-list-item__count">(18)</span>
                    </a>
                </li>
                <!-- /wp:woocommerce/product-category -->
                
                <!-- wp:woocommerce/product-category -->
                <li class="wc-block-product-categories-list-item">
                    <a href="#">
                        <img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/category-home.jpg" alt="المنزل" />
                        <span class="wc-block-product-categories-list-item__name">المنزل</span>
                        <span class="wc-block-product-categories-list-item__count">(15)</span>
                    </a>
                </li>
                <!-- /wp:woocommerce/product-category -->
            </ul>
        </div>
        <!-- /wp:woocommerce/product-categories -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/categories-grid-shop',
        array(
            'title'       => __( 'Shop Categories Grid', 'modern-fse-theme' ),
            'description' => __( 'شبكة فئات المتجر مع الصور وعدد المنتجات', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-categories' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الثالث: قائمة تصنيفات المدونة
function modern_fse_register_categories_list_blog() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column {"width":"30%"} -->
            <div class="wp-block-column" style="flex-basis:30%">
                <!-- wp:heading -->
                <h2>تصنيفات المدونة</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>تصفح مقالاتنا المنظمة حسب التصنيفات المختلفة</p>
                <!-- /wp:paragraph -->
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">عرض جميع المقالات</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"70%"} -->
            <div class="wp-block-column" style="flex-basis:70%">
                <!-- wp:query {"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"list"},"align":"wide"} -->
                <div class="wp-block-query alignwide">
                    
                    <!-- wp:post-template -->
                    <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                    <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
                        
                        <!-- wp:post-title {"level":3,"isLink":true,"fontSize":"medium"} /-->
                        
                        <!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-500"}}}},"textColor":"secondary-500","fontSize":"small"} /-->
                        
                    </div>
                    <!-- /wp:group -->
                    <!-- /wp:post-template -->
                    
                </div>
                <!-- /wp:query -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/categories-list-blog',
        array(
            'title'       => __( 'Blog Categories List', 'modern-fse-theme' ),
            'description' => __( 'قائمة تصنيفات المدونة مع التخطيط الجانبي', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-categories' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الرابع: قائمة تصنيفات المتجر
function modern_fse_register_categories_list_shop() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:columns {"verticalAlignment":"center"} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            
            <!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
                <!-- wp:heading -->
                <h2>فئات المنتجات</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>اكتشف مجموعات منتجاتنا المتنوعة والعالية الجودة</p>
                <!-- /wp:paragraph -->
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">تصفح جميع المنتجات</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
                <!-- wp:woocommerce/product-categories {"hasCount":true,"hasImage":false,"isDropdown":false,"align":"wide"} -->
                <div class="wp-block-woocommerce-product-categories alignwide">
                    <ul class="wc-block-product-categories-list">
                        <!-- wp:woocommerce/product-category -->
                        <li class="wc-block-product-categories-list-item">
                            <a href="#">
                                <span class="wc-block-product-categories-list-item__name">الإلكترونيات والأجهزة</span>
                                <span class="wc-block-product-categories-list-item__count">(42 منتج)</span>
                            </a>
                        </li>
                        <!-- /wp:woocommerce/product-category -->
                        
                        <!-- wp:woocommerce/product-category -->
                        <li class="wc-block-product-categories-list-item">
                            <a href="#">
                                <span class="wc-block-product-categories-list-item__name">الملابس والإكسسوارات</span>
                                <span class="wc-block-product-categories-list-item__count">(36 منتج)</span>
                            </a>
                        </li>
                        <!-- /wp:woocommerce/product-category -->
                        
                        <!-- wp:woocommerce/product-category -->
                        <li class="wc-block-product-categories-list-item">
                            <a href="#">
                                <span class="wc-block-product-categories-list-item__name">الأثاث والمنزل</span>
                                <span class="wc-block-product-categories-list-item__count">(28 منتج)</span>
                            </a>
                        </li>
                        <!-- /wp:woocommerce/product-category -->
                        
                        <!-- wp:woocommerce/product-category -->
                        <li class="wc-block-product-categories-list-item">
                            <a href="#">
                                <span class="wc-block-product-categories-list-item__name">الرياضة واللياقة</span>
                                <span class="wc-block-product-categories-list-item__count">(19 منتج)</span>
                            </a>
                        </li>
                        <!-- /wp:woocommerce/product-category -->
                    </ul>
                </div>
                <!-- /wp:woocommerce/product-categories -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/categories-list-shop',
        array(
            'title'       => __( 'Shop Categories List', 'modern-fse-theme' ),
            'description' => __( 'قائمة فئات المتجر مع التخطيط المنقسم', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-categories' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط الخامس: تصنيفات مميزة للمدونة
function modern_fse_register_categories_featured_blog() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">التصنيفات المميزة</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">اكتشف أهم مواضيعنا من خلال التصنيفات الأكثر شعبية</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"16px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"backgroundColor":"primary-500","textColor":"white"} -->
                <div class="wp-block-group has-primary-500-background-color has-white-color has-text-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">
                    <!-- wp:heading {"level":3,"textAlign":"center"} -->
                    <h3 class="wp-block-heading has-text-align-center">التقنية</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">أحدث المقالات في عالم التقنية والبرمجة</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem","fontWeight":"800"}}} -->
                    <p class="has-text-align-center" style="font-size:1.5rem;font-weight:800">24 مقال</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">استكشاف</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"16px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"backgroundColor":"secondary-500","textColor":"white"} -->
                <div class="wp-block-group has-secondary-500-background-color has-white-color has-text-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">
                    <!-- wp:heading {"level":3,"textAlign":"center"} -->
                    <h3 class="wp-block-heading has-text-align-center">التصميم</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">إبداعات التصميم وأحدث الاتجاهات</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem","fontWeight":"800"}}} -->
                    <p class="has-text-align-center" style="font-size:1.5rem;font-weight:800">18 مقال</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"secondary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-secondary-color has-white-background-color has-text-color has-background wp-element-button">استكشاف</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:group {"style":{"border":{"radius":"16px"},"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"backgroundColor":"accent-500","textColor":"white"} -->
                <div class="wp-block-group has-accent-500-background-color has-white-color has-text-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">
                    <!-- wp:heading {"level":3,"textAlign":"center"} -->
                    <h3 class="wp-block-heading has-text-align-center">التسويق</h3>
                    <!-- /wp:heading -->
                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">استراتيجيات التسويق الرقمي والنمو</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem","fontWeight":"800"}}} -->
                    <p class="has-text-align-center" style="font-size:1.5rem;font-weight:800">15 مقال</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"accent","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-accent-color has-white-background-color has-text-color has-background wp-element-button">استكشاف</a></div>
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
        'modern-fse/categories-featured-blog',
        array(
            'title'       => __( 'Featured Blog Categories', 'modern-fse-theme' ),
            'description' => __( 'تصنيفات مدونة مميزة مع تصميم بطاقات ملونة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-categories' ),
            'viewportWidth' => 1200,
        )
    );
}

// النمط السادس: تصنيفات مميزة للمتجر
function modern_fse_register_categories_featured_shop() {
    $content = '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)">
        
        <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">الفئات المميزة</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">اكتشف أفضل مجموعات المنتجات في متجرنا</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/category-electronics-large.jpg","dimRatio":50,"isDark":false,"style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-cover is-light" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-50 has-background-dim"></span><div class="wp-block-cover__inner-container" >
                    
                    <!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"}}} -->
                    <h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;">الإلكترونيات</h3>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"}}} -->
                    <p class="has-text-align-center has-text-color" style="color:#ffffff">أحدث الأجهزة والتقنيات</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">تسوق الآن</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                    
                </div></div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/category-fashion-large.jpg","dimRatio":50,"isDark":false,"style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-cover is-light" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-50 has-background-dim"></span><div class="wp-block-cover__inner-container">
                    
                    <!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"}}} -->
                    <h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff">الموضة</h3>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"}}} -->
                    <p class="has-text-align-center has-text-color" style="color:#ffffff">أحدث صيحات الموضة</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">تسوق الآن</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                    
                </div></div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/category-home-large.jpg","dimRatio":50,"isDark":false,"style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-cover is-light" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-50 has-background-dim"></span><div class="wp-block-cover__inner-container">
                    
                    <!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"}}} -->
                    <h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff">المنزل</h3>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"}}} -->
                    <p class="has-text-align-center has-text-color" style="color:#ffffff">ديكورات وأثاث راقي</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">تسوق الآن</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                    
                </div></div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'modern-fse/categories-featured-shop',
        array(
            'title'       => __( 'Featured Shop Categories', 'modern-fse-theme' ),
            'description' => __( 'فئات متجر مميزة مع صور خلفية جذابة', 'modern-fse-theme' ),
            'content'     => $content,
            'categories'  => array( 'modern-fse-categories' ),
            'viewportWidth' => 1200,
        )
    );
}