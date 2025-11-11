<?php
/**
 * Banner Patterns for Block Theme
 * Including: Fixed Banners, Animated Banners, and Swiper Banners
 */

add_action( 'init', 'blocktheme_register_banner_patterns' );
function blocktheme_register_banner_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // Register banner pattern category
    register_block_pattern_category(
        'blocktheme-banners',
        array( 'label' => __( 'Banners', 'blocktheme' ) )
    );

    // Register all banner patterns
    blocktheme_register_fixed_banner_simple();
    blocktheme_register_fixed_banner_gradient();
    blocktheme_register_fixed_banner_with_image();
    blocktheme_register_animated_banner_slide();
    blocktheme_register_animated_banner_fade();
    blocktheme_register_animated_banner_pulse();
    blocktheme_register_swiper_banner_carousel();
    blocktheme_register_swiper_banner_gallery();
}

// ============================================
// FIXED BANNERS
// ============================================

// Fixed Banner - Simple
function blocktheme_register_fixed_banner_simple() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}},"color":{"background":"#1e40af"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#1e40af;padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)">
        
        <!-- wp:columns {"verticalAlignment":"center","layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            
            <!-- wp:column {"width":"70%"} -->
            <div class="wp-block-column" style="flex-basis:70%">
                
                <!-- wp:heading {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"},"color":{"text":"#ffffff"}}} -->
                <h2 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:1.5rem;font-weight:600">عرض خاص محدود الوقت!</h2>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#e0e7ff"}}} -->
                <p class="has-text-color" style="color:#e0e7ff">احصل على خصم 50% على جميع المنتجات المختارة</p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"30%","layout":{"type":"flex","justifyContent":"flex-end"}} -->
            <div class="wp-block-column" style="flex-basis:30%">
                
                <!-- wp:button {"backgroundColor":"white","textColor":"primary"} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">تسوق الآن</a></div>
                <!-- /wp:button -->
                
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'blocktheme/fixed-banner-simple',
        array(
            'title'       => __( 'Fixed Banner - Simple', 'blocktheme' ),
            'description' => __( 'بنر ثابت بسيط مع خلفية ملونة', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// Fixed Banner - Gradient
function blocktheme_register_fixed_banner_gradient() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}},"background":{"backgroundImage":{"url":"data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 1200 300%27%3E%3Cdefs%3E%3ClinearGradient id=%27grad%27 x1=%270%25%27 y1=%270%25%27 x2=%27100%25%27 y2=%27100%25%27%3E%3Cstop offset=%270%25%27 style=%27stop-color:%23667eea;stop-opacity:1%27 /%3E%3Cstop offset=%27100%25%27 style=%27stop-color:%23764ba2;stop-opacity:1%27 /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=%271200%27 height=%27300%27 fill=%27url(%23grad)%27/%3E%3C/svg%3E"}},"backgroundSize":"cover"},"color":{"background":"#667eea"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#667eea;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"900px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2rem","fontWeight":"700"},"color":{"text":"#ffffff"}}} -->
            <h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:2rem;font-weight:700">احصل على أفضل العروض</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#f3f4f6"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#f3f4f6">استمتع بخدماتنا المميزة مع ضمان الجودة والسرعة</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                
                <!-- wp:button {"backgroundColor":"white","textColor":"primary","style":{"border":{"radius":"8px"}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:8px">اكتشف المزيد</a></div>
                <!-- /wp:button -->
                
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'blocktheme/fixed-banner-gradient',
        array(
            'title'       => __( 'Fixed Banner - Gradient', 'blocktheme' ),
            'description' => __( 'بنر ثابت بخلفية متدرجة احترافية', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// Fixed Banner - With Image
function blocktheme_register_fixed_banner_with_image() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull">
        
        <!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-bg.jpg","dimRatio":30,"isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxxl","bottom":"var:preset|spacing|xxxl"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-cover alignfull is-light" style="padding-top:var(--wp--preset--spacing--xxxl);padding-bottom:var(--wp--preset--spacing--xxxl)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"}} -->
            <div class="wp-block-group">
                
                <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1.1"},"color":{"text":"#ffffff"}}} -->
                <h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:2.5rem;font-weight:800;line-height:1.1">تجربة تسوق لا تُنسى</h2>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#f3f4f6"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#f3f4f6">اكتشف مجموعة منتجاتنا الحصرية اليوم</p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
        </div></div>
        <!-- /wp:cover -->
        
    </div>
    <!-- /wp:group -->';

    register_block_pattern(
        'blocktheme/fixed-banner-with-image',
        array(
            'title'       => __( 'Fixed Banner - With Image', 'blocktheme' ),
            'description' => __( 'بنر ثابت مع صورة خلفية', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// ============================================
// ANIMATED BANNERS
// ============================================

// Animated Banner - Slide
function blocktheme_register_animated_banner_slide() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}},"color":{"background":"#10b981"},"custom":{"animation":"slideIn 0.6s ease-out"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#10b981;padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg);animation:slideIn 0.6s ease-out">
        
        <!-- wp:columns {"verticalAlignment":"center"} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            
            <!-- wp:column -->
            <div class="wp-block-column">
                
                <!-- wp:heading {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"},"color":{"text":"#ffffff"}}} -->
                <h2 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:1.5rem;font-weight:600">🚀 جديد! إطلاق منتجات حصرية</h2>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#d1fae5"}}} -->
                <p class="has-text-color" style="color:#d1fae5">تابعنا للحصول على آخر المستجدات والعروض الخاصة</p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column {"width":"25%","layout":{"type":"flex","justifyContent":"flex-end","alignItems":"center"}} -->
            <div class="wp-block-column" style="flex-basis:25%">
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    
                    <!-- wp:button {"backgroundColor":"white","textColor":"primary","style":{"border":{"radius":"6px"}}} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:6px">اكتشف</a></div>
                    <!-- /wp:button -->
                    
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:column -->
            
        </div>
        <!-- /wp:columns -->
        
    </div>
    <!-- /wp:group -->
    
    <style>
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    </style>';

    register_block_pattern(
        'blocktheme/animated-banner-slide',
        array(
            'title'       => __( 'Animated Banner - Slide', 'blocktheme' ),
            'description' => __( 'بنر متحرك بتأثير انزلاق من اليسار', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// Animated Banner - Fade
function blocktheme_register_animated_banner_fade() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}},"color":{"background":"#f59e0b"},"custom":{"animation":"fadeInScale 0.8s ease-out"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#f59e0b;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);animation:fadeInScale 0.8s ease-out">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2rem","fontWeight":"700"},"color":{"text":"#ffffff"}}} -->
            <h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:2rem;font-weight:700">⭐ تقييم 5 نجوم من العملاء</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#fef3c7"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#fef3c7">انضم إلى آلاف العملاء الراضين عن خدماتنا</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                
                <!-- wp:button {"backgroundColor":"white","textColor":"primary"} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">شارك رأيك</a></div>
                <!-- /wp:button -->
                
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    
    <style>
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    </style>';

    register_block_pattern(
        'blocktheme/animated-banner-fade',
        array(
            'title'       => __( 'Animated Banner - Fade', 'blocktheme' ),
            'description' => __( 'بنر متحرك بتأثير ظهور وتكبير', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// Animated Banner - Pulse
function blocktheme_register_animated_banner_pulse() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}},"color":{"background":"#ec4899"},"custom":{"animation":"pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#ec4899;padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg);animation:pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite">
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"style":{"typography":{"fontSize":"1.25rem","fontWeight":"600"},"color":{"text":"#ffffff"}}} -->
            <h2 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:1.25rem;font-weight:600">⏰ عرض اليوم فقط - ينتهي خلال ساعات!</h2>
            <!-- /wp:heading -->
            
            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                
                <!-- wp:button {"backgroundColor":"white","textColor":"primary","style":{"border":{"radius":"50px"}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:50px">اطلب الآن</a></div>
                <!-- /wp:button -->
                
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    
    <style>
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }
    </style>';

    register_block_pattern(
        'blocktheme/animated-banner-pulse',
        array(
            'title'       => __( 'Animated Banner - Pulse', 'blocktheme' ),
            'description' => __( 'بنر متحرك بتأثير نبض', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// ============================================
// SWIPER BANNERS
// ============================================

// Swiper Banner - Carousel
function blocktheme_register_swiper_banner_carousel() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
    <div class="wp-block-group alignfull">
        
        <!-- wp:html -->
        <div class="swiper-banner-carousel" style="position:relative;width:100%;height:400px;overflow:hidden;">
            <div class="swiper mySwiper" style="width:100%;height:100%;">
                <div class="swiper-wrapper">
                    
                    <!-- Slide 1 -->
                    <div class="swiper-slide" style="background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);display:flex;align-items:center;justify-content:center;color:white;text-align:center;padding:40px;">
                        <div>
                            <h2 style="font-size:2.5rem;font-weight:700;margin-bottom:10px;">العرض الأول</h2>
                            <p style="font-size:1.1rem;margin-bottom:20px;">اكتشف مجموعتنا الجديدة من المنتجات الحصرية</p>
                            <button style="background:white;color:#667eea;border:none;padding:10px 30px;border-radius:25px;font-weight:600;cursor:pointer;">تسوق الآن</button>
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="swiper-slide" style="background:linear-gradient(135deg, #10b981 0%, #059669 100%);display:flex;align-items:center;justify-content:center;color:white;text-align:center;padding:40px;">
                        <div>
                            <h2 style="font-size:2.5rem;font-weight:700;margin-bottom:10px;">خصم 50%</h2>
                            <p style="font-size:1.1rem;margin-bottom:20px;">استمتع بأفضل الأسعار على منتجاتك المفضلة</p>
                            <button style="background:white;color:#10b981;border:none;padding:10px 30px;border-radius:25px;font-weight:600;cursor:pointer;">استكشف</button>
                        </div>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="swiper-slide" style="background:linear-gradient(135deg, #f59e0b 0%, #d97706 100%);display:flex;align-items:center;justify-content:center;color:white;text-align:center;padding:40px;">
                        <div>
                            <h2 style="font-size:2.5rem;font-weight:700;margin-bottom:10px;">التوصيل المجاني</h2>
                            <p style="font-size:1.1rem;margin-bottom:20px;">اطلب الآن وتمتع بالتوصيل المجاني إلى منزلك</p>
                            <button style="background:white;color:#f59e0b;border:none;padding:10px 30px;border-radius:25px;font-weight:600;cursor:pointer;">اطلب</button>
                        </div>
                    </div>
                    
                </div>
                <div class="swiper-pagination" style="position:absolute;bottom:20px;width:100%;text-align:center;"></div>
                <div class="swiper-button-prev" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);z-index:10;"></div>
                <div class="swiper-button-next" style="position:absolute;right:20px;top:50%;transform:translateY(-50%);z-index:10;"></div>
            </div>
        </div>
        <!-- /wp:html -->
        
    </div>
    <!-- /wp:group -->
    
    <!-- Swiper JS and CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".mySwiper", {
            autoplay: { delay: 5000 },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            loop: true,
            effect: "slide",
            speed: 800,
        });
    });
    </script>';

    register_block_pattern(
        'blocktheme/swiper-banner-carousel',
        array(
            'title'       => __( 'Swiper Banner - Carousel', 'blocktheme' ),
            'description' => __( 'بنرات متعددة بنظام Swiper مع تأثيرات انزلاقية', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}

// Swiper Banner - Gallery
function blocktheme_register_swiper_banner_gallery() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}},"color":{"background":"#f9fafb"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#f9fafb;padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
        
        <!-- wp:html -->
        <div class="swiper-banner-gallery">
            <h2 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:40px;">معرض عروضنا الحصرية</h2>
            <div class="swiper gallerySwiper" style="width:100%;margin-bottom:20px;">
                <div class="swiper-wrapper">
                    
                    <!-- Gallery Slide 1 -->
                    <div class="swiper-slide" style="display:flex;align-items:center;justify-content:center;background:#e5e7eb;border-radius:12px;overflow:hidden;height:300px;">
                        <div style="text-align:center;color:#6b7280;">
                            <div style="font-size:3rem;margin-bottom:10px;">🛍️</div>
                            <h3 style="font-size:1.5rem;font-weight:600;">تسوق ذكية</h3>
                        </div>
                    </div>
                    
                    <!-- Gallery Slide 2 -->
                    <div class="swiper-slide" style="display:flex;align-items:center;justify-content:center;background:#dbeafe;border-radius:12px;overflow:hidden;height:300px;">
                        <div style="text-align:center;color:#1e40af;">
                            <div style="font-size:3rem;margin-bottom:10px;">⚡</div>
                            <h3 style="font-size:1.5rem;font-weight:600;">عروض سريعة</h3>
                        </div>
                    </div>
                    
                    <!-- Gallery Slide 3 -->
                    <div class="swiper-slide" style="display:flex;align-items:center;justify-content:center;background:#d1fae5;border-radius:12px;overflow:hidden;height:300px;">
                        <div style="text-align:center;color:#047857;">
                            <div style="font-size:3rem;margin-bottom:10px;">🎁</div>
                            <h3 style="font-size:1.5rem;font-weight:600;">هدايا مجانية</h3>
                        </div>
                    </div>
                    
                    <!-- Gallery Slide 4 -->
                    <div class="swiper-slide" style="display:flex;align-items:center;justify-content:center;background:#fef3c7;border-radius:12px;overflow:hidden;height:300px;">
                        <div style="text-align:center;color:#b45309;">
                            <div style="font-size:3rem;margin-bottom:10px;">⭐</div>
                            <h3 style="font-size:1.5rem;font-weight:600;">منتجات مميزة</h3>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="swiper-pagination" style="text-align:center;"></div>
        </div>
        <!-- /wp:html -->
        
    </div>
    <!-- /wp:group -->
    
    <!-- Swiper JS and CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".gallerySwiper", {
            autoplay: { delay: 4000 },
            pagination: { el: ".swiper-pagination", clickable: true },
            loop: true,
            effect: "fade",
            fadeEffect: { crossFade: true },
            speed: 600,
            slidesPerView: 1,
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                768: { slidesPerView: 3, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 20 }
            }
        });
    });
    </script>';

    register_block_pattern(
        'blocktheme/swiper-banner-gallery',
        array(
            'title'       => __( 'Swiper Banner - Gallery', 'blocktheme' ),
            'description' => __( 'معرض صور متحرك بنظام Swiper مع تأثيرات انتقالية', 'blocktheme' ),
            'content'     => $content,
            'categories'  => array( 'blocktheme-banners' ),
            'viewportWidth' => 1200,
        )
    );
}
