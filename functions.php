<?php
/**
 * Modern FSE Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// تعريف ثوابت المسارات
define( 'MODERN_FSE_THEME_VERSION', '1.0.0' );
define( 'MODERN_FSE_THEME_PATH', get_template_directory() );
define( 'MODERN_FSE_THEME_URL', get_template_directory_uri() );

/**
 * إعدادات القالب الأساسية
 */
function modern_fse_theme_setup() {
	// دعم الترجمة
	load_theme_textdomain( 'modern-fse-theme', MODERN_FSE_THEME_PATH . '/languages' );
	
	// دعم الوسائل المميزة
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'automatic-feed-links' );
	
	// دعم Full Site Editing
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-units' );
	
	// دعم Style Variations
	add_theme_support( 'editor-style-variations' );
	
	// إضافة أنماط المحرر
	add_editor_style( 'assets/css/editor-style.css' );
	
	// تسجيل قوائم التنقل
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'modern-fse-theme' ),
		'footer'  => __( 'Footer Menu', 'modern-fse-theme' ),
	) );
}
add_action( 'after_setup_theme', 'modern_fse_theme_setup' );

/**
 * تسجيل Style Variations
 */
function modern_fse_theme_register_style_variations() {
	$style_variations_path = MODERN_FSE_THEME_PATH . '/styles';
	
	if ( is_dir( $style_variations_path ) ) {
		$variations = array();
		$files = glob( $style_variations_path . '/*.json' );
		
		foreach ( $files as $file ) {
			$variation_data = json_decode( file_get_contents( $file ), true );
			if ( is_array( $variation_data ) ) {
				$variations[] = $variation_data;
			}
		}
		
		if ( ! empty( $variations ) ) {
			wp_enqueue_style( 
				'modern-fse-theme-style-variations',
				MODERN_FSE_THEME_URL . '/assets/css/style-variations.css',
				array(),
				MODERN_FSE_THEME_VERSION
			);
		}
	}
}
add_action( 'after_setup_theme', 'modern_fse_theme_register_style_variations' );

/**
 * إضافة CSS مخصص لأنماط التصميم
 */
function modern_fse_theme_enqueue_style_variations_css() {
	$css = "
		/* أنماط إضافية لل Style Variations */
		
		/* Dark Mode تحسينات */
		.is-style-dark-mode .wp-block-cover.has-background-dim {
			background-blend-mode: overlay;
		}
		
		/* Minimal أنماط */
		.is-style-minimal .wp-block-group {
			border: 1px solid #e5e5e5;
		}
		
		/* Warm & Cozy تأثيرات */
		.is-style-warm-cozy .wp-block-button__link:hover {
			transform: translateY(-2px);
			transition: all 0.3s ease;
		}
		
		/* Corporate محاذاة */
		.is-style-corporate .wp-block-columns {
			align-items: center;
		}
		
		/* Creative تأثيرات */
		.is-style-creative .wp-block-image:hover {
			transform: scale(1.02);
			transition: transform 0.3s ease;
		}
	";
	
	wp_add_inline_style( 'modern-fse-theme-style', $css );
}
add_action( 'wp_enqueue_scripts', 'modern_fse_theme_enqueue_style_variations_css' );

/**
 * تسجيل المساحات الجانبية
 */
function modern_fse_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'modern-fse-theme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here.', 'modern-fse-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'modern_fse_theme_widgets_init' );

/**
 * تحميل النماط والنصوص
 */
function modern_fse_theme_scripts() {
	// النماط الرئيسية
	wp_enqueue_style( 
		'modern-fse-theme-style', 
		get_stylesheet_uri(), 
		array(), 
		MODERN_FSE_THEME_VERSION 
	);
	
	// تحميل خطوط Google Fonts
	wp_enqueue_style(
		'modern-fse-theme-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap',
		array(),
		MODERN_FSE_THEME_VERSION
	);
	
	// النصوص الرئيسية
	wp_enqueue_script(
		'modern-fse-theme-script',
		MODERN_FSE_THEME_URL . '/assets/js/main.js',
		array(),
		MODERN_FSE_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'modern_fse_theme_scripts' );

/**
 * دعم WooCommerce
 */
function modern_fse_theme_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'modern_fse_theme_woocommerce_support' );