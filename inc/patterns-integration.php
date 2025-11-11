/**
 * Enhanced Header & Footer Patterns Integration
 * تكامل محسّن لأنماط الهيدر والفوتر
 */

// تحميل أنماط CSS محسّنة للأنماط
function blocktheme_enqueue_pattern_styles() {
    wp_enqueue_style(
        'blocktheme-patterns-enhanced',
        get_template_directory_uri() . '/assets/css/patterns-enhanced.css',
        array(),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'blocktheme_enqueue_pattern_styles' );
add_action( 'admin_enqueue_scripts', 'blocktheme_enqueue_pattern_styles' );

// إضافة فئات مخصصة للأنماط في المحرر
function blocktheme_add_pattern_tags() {
    if ( function_exists( 'register_block_pattern_category' ) ) {
        // فئة للأنماط الحديثة
        register_block_pattern_category(
            'blocktheme-modern',
            array(
                'label'       => esc_html__( 'Modern Designs', 'blocktheme' ),
                'description' => esc_html__( 'Contemporary and modern block patterns', 'blocktheme' ),
            )
        );

        // فئة للأنماط التجارية
        register_block_pattern_category(
            'blocktheme-ecommerce',
            array(
                'label'       => esc_html__( 'E-commerce', 'blocktheme' ),
                'description' => esc_html__( 'Patterns designed for online stores', 'blocktheme' ),
            )
        );

        // فئة للأنماط الاحترافية
        register_block_pattern_category(
            'blocktheme-corporate',
            array(
                'label'       => esc_html__( 'Corporate', 'blocktheme' ),
                'description' => esc_html__( 'Professional patterns for businesses', 'blocktheme' ),
            )
        );

        // فئة للأنماط الإبداعية
        register_block_pattern_category(
            'blocktheme-creative',
            array(
                'label'       => esc_html__( 'Creative', 'blocktheme' ),
                'description' => esc_html__( 'Creative and innovative patterns', 'blocktheme' ),
            )
        );
    }
}
add_action( 'init', 'blocktheme_add_pattern_tags' );

// إضافة فئات CSS مخصصة للأنماط للتحكم الأفضل
function blocktheme_add_pattern_classes( $classes, $post ) {
    if ( 'wp_block' === get_post_type( $post ) ) {
        // إضافة معرف فريد لكل نمط
        $classes .= ' wp-pattern-' . $post->post_name;
        
        // إضافة فئات إضافية بناءً على نوع النمط
        if ( strpos( $post->post_name, 'header' ) !== false ) {
            $classes .= ' wp-block-pattern-header';
        } elseif ( strpos( $post->post_name, 'footer' ) !== false ) {
            $classes .= ' wp-block-pattern-footer';
        }
    }
    return $classes;
}
add_filter( 'post_class', 'blocktheme_add_pattern_classes', 10, 2 );

// إضافة نصائح في المحرر
function blocktheme_pattern_hints() {
    $screen = get_current_screen();
    if ( $screen && 'edit-wp_block' === $screen->id ) {
        echo '<div class="notice notice-info is-dismissible"><p>';
        echo '<strong>' . esc_html__( 'Pattern Tips:', 'blocktheme' ) . '</strong><br>';
        echo esc_html__( 'Use Header Modern + Footer Modern for general sites, Header E-commerce + Footer E-commerce for stores.', 'blocktheme' );
        echo '</p></div>';
    }
}
add_action( 'admin_notices', 'blocktheme_pattern_hints' );

// إعدادات مخزن مؤقت للأنماط
function blocktheme_cache_patterns() {
    // تخزين مؤقت للأنماط لـ 24 ساعة
    if ( false === get_transient( 'blocktheme_patterns_loaded' ) ) {
        // تنفيذ العمليات الثقيلة هنا إن وجدت
        set_transient( 'blocktheme_patterns_loaded', true, 24 * HOUR_IN_SECONDS );
    }
}
add_action( 'init', 'blocktheme_cache_patterns', 15 );

// إضافة معلومات تعريفية للأنماط
function blocktheme_add_pattern_metadata() {
    $patterns = array(
        'header-modern'     => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'header-minimal'    => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'header-centered'   => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'header-ecommerce'  => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl', 'search' ),
        ),
        'header-premium'    => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'header-corporate'  => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl', 'auth' ),
        ),
        'header-creative'   => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'footer-modern'     => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl', 'newsletter' ),
        ),
        'footer-simple'     => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'footer-minimal'    => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'footer-ecommerce'  => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl', 'shipping' ),
        ),
        'footer-premium'    => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl', 'contact' ),
        ),
        'footer-corporate'  => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
        'footer-creative'   => array(
            'viewport' => 1200,
            'responsive' => true,
            'supports' => array( 'dark-mode', 'rtl' ),
        ),
    );

    return apply_filters( 'blocktheme_pattern_metadata', $patterns );
}

// دالة للحصول على قائمة الأنماط المتاحة
function blocktheme_get_available_patterns() {
    $patterns = array(
        'headers' => array(
            'modern'     => esc_html__( 'Header Modern', 'blocktheme' ),
            'minimal'    => esc_html__( 'Header Minimal', 'blocktheme' ),
            'centered'   => esc_html__( 'Header Centered', 'blocktheme' ),
            'ecommerce'  => esc_html__( 'Header E-commerce', 'blocktheme' ),
            'premium'    => esc_html__( 'Header Premium', 'blocktheme' ),
            'corporate'  => esc_html__( 'Header Corporate', 'blocktheme' ),
            'creative'   => esc_html__( 'Header Creative', 'blocktheme' ),
        ),
        'footers' => array(
            'modern'     => esc_html__( 'Footer Modern', 'blocktheme' ),
            'simple'     => esc_html__( 'Footer Simple', 'blocktheme' ),
            'minimal'    => esc_html__( 'Footer Minimal', 'blocktheme' ),
            'ecommerce'  => esc_html__( 'Footer E-commerce', 'blocktheme' ),
            'premium'    => esc_html__( 'Footer Premium', 'blocktheme' ),
            'corporate'  => esc_html__( 'Footer Corporate', 'blocktheme' ),
            'creative'   => esc_html__( 'Footer Creative', 'blocktheme' ),
        ),
    );

    return apply_filters( 'blocktheme_available_patterns', $patterns );
}

// تسجيل الدعم للوضع الليلي
function blocktheme_add_dark_mode_support() {
    add_theme_support( 'dark-mode' );
}
add_action( 'after_setup_theme', 'blocktheme_add_dark_mode_support' );

// تحسين الأداء - تقليل استدعاءات قاعدة البيانات
function blocktheme_optimize_patterns() {
    // تخزين مؤقت لقائمة الأنماط
    if ( is_admin() ) {
        wp_cache_set( 'blocktheme_patterns_list', blocktheme_get_available_patterns(), 'blocktheme', 3600 );
    }
}
add_action( 'init', 'blocktheme_optimize_patterns', 20 );

// إضافة واجهة مستخدم للاختيار السريع (اختياري)
function blocktheme_quick_pattern_selector() {
    if ( is_admin() && current_user_can( 'edit_posts' ) ) {
        $patterns = blocktheme_get_available_patterns();
        // يمكن إضافة واجهة هنا لاختيار الأنماط بسرعة
    }
}
add_action( 'admin_init', 'blocktheme_quick_pattern_selector' );

// إضافة بيانات JSON-LD لتحسين SEO (اختياري)
function blocktheme_add_pattern_schema() {
    $patterns = array(
        '@context' => 'https://schema.org',
        '@type'    => 'CollectionPage',
        'name'     => get_bloginfo( 'name' ),
        'hasPart'  => array(),
    );

    $available = blocktheme_get_available_patterns();
    foreach ( $available as $type => $items ) {
        foreach ( $items as $id => $name ) {
            $patterns['hasPart'][] = array(
                '@type' => 'CreativeWork',
                'name'  => $name,
                'id'    => $id,
            );
        }
    }

    return wp_json_encode( $patterns );
}

// إنشاء خطاف مخصص لتصفية الأنماط
function blocktheme_filter_patterns( $patterns ) {
    return apply_filters( 'blocktheme_filter_patterns', $patterns );
}
