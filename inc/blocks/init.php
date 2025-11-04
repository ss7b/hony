<?php
/**
 * Blocks Initialization for Modern FSE Theme
 * تسجيل وتحميل جميع البلوكات المخصصة
 */

// منع الوصول المباشر
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * تسجيل جميع البلوكات المخصصة
 */
function modern_fse_register_all_blocks() {
    
    // قائمة البلوكات المخصصة
    $blocks = array(
        'testimonial',
        'team-member', 
        'pricing-table',
        'counter',
        'progress-bar',
        'social-icons'
    );
    
    foreach ( $blocks as $block_name ) {
        modern_fse_register_single_block( $block_name );
    }
}
add_action( 'init', 'modern_fse_register_all_blocks' );

/**
 * تسجيل بلوك واحد
 */
function modern_fse_register_single_block( $block_name ) {
    
    $block_path = get_template_directory() . '/inc/blocks/' . $block_name;
    $block_url = get_template_directory_uri() . '/inc/blocks/' . $block_name;
    
    // التحقق من وجود ملف block.json
    if ( ! file_exists( $block_path . '/block.json' ) ) {
        return;
    }
    
    // تسجيل البلوك
    register_block_type( $block_path . '/block.json', array(
        'render_callback' => null, // نستخدم نظام البلوكات القياسي
    ) );
    
    // تسجيل النصوص الإضافية للواجهة الأمامية
    modern_fse_enqueue_block_frontend_assets( $block_name, $block_path, $block_url );
}

/**
 * تحميل النصوص والأنماط الإضافية للواجهة الأمامية
 */
function modern_fse_enqueue_block_frontend_assets( $block_name, $block_path, $block_url ) {
    
    // تحميل JavaScript للواجهة الأمامية
    $view_js_path = $block_path . '/view.js';
    $view_js_url = $block_url . '/view.js';
    
    if ( file_exists( $view_js_path ) ) {
        wp_register_script(
            'modern-fse-' . $block_name . '-view',
            $view_js_url,
            array(),
            MODERN_FSE_THEME_VERSION,
            true
        );
    }
    
    // تحميل CSS الإضافي للواجهة الأمامية
    $view_css_path = $block_path . '/view.css';
    $view_css_url = $block_url . '/view.css';
    
    if ( file_exists( $view_css_path ) ) {
        wp_register_style(
            'modern-fse-' . $block_name . '-view',
            $view_css_url,
            array(),
            MODERN_FSE_THEME_VERSION
        );
    }
}

/**
 * تحميل جميع نصوص البلوكات عند الحاجة
 */
function modern_fse_enqueue_block_assets() {
    
    $blocks = array(
        'testimonial',
        'team-member',
        'pricing-table', 
        'counter',
        'progress-bar',
        'social-icons'
    );
    
    foreach ( $blocks as $block_name ) {
        
        // تحميل JavaScript إذا كان مسجل
        if ( wp_script_is( 'modern-fse-' . $block_name . '-view', 'registered' ) ) {
            wp_enqueue_script( 'modern-fse-' . $block_name . '-view' );
        }
        
        // تحميل CSS إذا كان مسجل
        if ( wp_style_is( 'modern-fse-' . $block_name . '-view', 'registered' ) ) {
            wp_enqueue_style( 'modern-fse-' . $block_name . '-view' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'modern_fse_enqueue_block_assets' );

/**
 * تحميل نصوص المحرر للبلوكات
 */
function modern_fse_enqueue_block_editor_assets() {
    
    $blocks = array(
        'testimonial',
        'team-member',
        'pricing-table',
        'counter',
        'progress-bar', 
        'social-icons'
    );
    
    foreach ( $blocks as $block_name ) {
        
        $editor_js_path = get_template_directory() . '/inc/blocks/' . $block_name . '/editor.js';
        $editor_js_url = get_template_directory_uri() . '/inc/blocks/' . $block_name . '/editor.js';
        
        // تحميل JavaScript للمحرر إذا كان موجوداً
        if ( file_exists( $editor_js_path ) ) {
            wp_enqueue_script(
                'modern-fse-' . $block_name . '-editor',
                $editor_js_url,
                array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
                MODERN_FSE_THEME_VERSION,
                true
            );
        }
    }
}
add_action( 'enqueue_block_editor_assets', 'modern_fse_enqueue_block_editor_assets' );

/**
 * وظيفة مساعدة للتحقق من وجود بلوك
 */
function modern_fse_block_exists( $block_name ) {
    $block_path = get_template_directory() . '/inc/blocks/' . $block_name;
    return file_exists( $block_path . '/block.json' );
}

/**
 * الحصول على قائمة البلوكات المتاحة
 */
function modern_fse_get_available_blocks() {
    return array(
        'testimonial' => array(
            'name' => 'Testimonial',
            'description' => 'عرض آراء وتقييمات العملاء',
            'icon' => 'format-quote'
        ),
        'team-member' => array(
            'name' => 'Team Member', 
            'description' => 'عرض معلومات عضو الفريق',
            'icon' => 'groups'
        ),
        'pricing-table' => array(
            'name' => 'Pricing Table',
            'description' => 'جدول الأسعار والخطط',
            'icon' => 'money'
        ),
        'counter' => array(
            'name' => 'Counter',
            'description' => 'عداد أرقام متحرك',
            'icon' => 'plus'
        ),
        'progress-bar' => array(
            'name' => 'Progress Bar',
            'description' => 'شريط تقدم متحرك',
            'icon' => 'chart-bar'
        ),
        'social-icons' => array(
            'name' => 'Social Icons',
            'description' => 'أيقونات التواصل الاجتماعي',
            'icon' => 'share'
        )
    );
}