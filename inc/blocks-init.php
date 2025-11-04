<?php
// blocks-init.php
function modern_fse_register_blocks() {
    $blocks = array(
        'testimonial',
        'team-member', 
        'pricing-table',
        'counter',
        'progress-bar',
        'social-icons'
    );
    
    foreach ($blocks as $block) {
        $block_path = get_template_directory() . '/inc/blocks/' . $block;
        
        if (file_exists($block_path . '/init.php')) {
            require_once $block_path . '/init.php';
        }
    }
}
add_action('init', 'modern_fse_register_blocks');

function modern_fse_enqueue_block_assets() {
    $blocks = array(
        'testimonial',
        'team-member',
        'pricing-table', 
        'counter',
        'progress-bar',
        'social-icons'
    );
    
    foreach ($blocks as $block) {
        $view_js_path = get_template_directory() . '/inc/blocks/' . $block . '/view.js';
        $view_js_url = get_template_directory_uri() . '/inc/blocks/' . $block . '/view.js';
        
        if (file_exists($view_js_path)) {
            wp_enqueue_script(
                'modern-fse-' . $block . '-view',
                $view_js_url,
                array('wp-element', 'wp-blocks', 'wp-editor'),
                MODERN_FSE_THEME_VERSION,
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'modern_fse_enqueue_block_assets');