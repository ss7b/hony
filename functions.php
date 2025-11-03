<?php

if(!function_exists('SweetNectar_theme_support')):
function SweetNectar_theme_support()
{
	add_theme_support('wp-block-styles');

	add_editor_style('style.css');
}
endif;
// enqueue style
add_action('after_setup_theme', 'SweetNectar_theme_support');

if (!function_exists('SweetNectar_theme_styles')) :
	function SweetNectar_theme_styles()
	{
		wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.3.2');
	}
endif;


add_action('wp_enqueue_scripts', 'SweetNectar_theme_styles');

require_once get_template_directory() . '/inc/patterns/hero.php';
require_once get_template_directory() . '/inc/patterns/footer.php';
