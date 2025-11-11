<?php
/**
 * Test file to verify Products Tabs Block Registration
 */

// Load WordPress
require_once( dirname( __DIR__ ) . '/../../wp-load.php' );

echo "=== Products Tabs Block Status ===\n\n";

// Check if WooCommerce is active
if ( class_exists( 'WooCommerce' ) ) {
    echo "✓ WooCommerce is active\n";
} else {
    echo "✗ WooCommerce is NOT active\n";
}

// Check if block.json exists
$block_json_path = dirname( __FILE__ ) . '/inc/blocks/products-tabs/block.json';
if ( file_exists( $block_json_path ) ) {
    echo "✓ block.json file exists\n";
    $block_data = json_decode( file_get_contents( $block_json_path ), true );
    echo "  - Block Name: " . ( isset( $block_data['name'] ) ? $block_data['name'] : 'NOT FOUND' ) . "\n";
    echo "  - API Version: " . ( isset( $block_data['apiVersion'] ) ? $block_data['apiVersion'] : 'NOT FOUND' ) . "\n";
    echo "  - Category: " . ( isset( $block_data['category'] ) ? $block_data['category'] : 'NOT FOUND' ) . "\n";
} else {
    echo "✗ block.json file NOT found at: $block_json_path\n";
}

// Check registered blocks
$registered_block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
if ( isset( $registered_block_types['modern-fse/products-tabs'] ) ) {
    echo "✓ Block 'modern-fse/products-tabs' is REGISTERED\n";
    $block_type = $registered_block_types['modern-fse/products-tabs'];
    echo "  - Has Render Callback: " . ( $block_type->render_callback ? 'YES' : 'NO' ) . "\n";
    echo "  - Editor Script: " . ( isset( $block_type->editor_script_handles ) && !empty( $block_type->editor_script_handles ) ? 'YES' : 'NO' ) . "\n";
    echo "  - View Script: " . ( isset( $block_type->view_script_handles ) && !empty( $block_type->view_script_handles ) ? 'YES' : 'NO' ) . "\n";
    echo "  - Style: " . ( isset( $block_type->style_handles ) && !empty( $block_type->style_handles ) ? 'YES' : 'NO' ) . "\n";
} else {
    echo "✗ Block 'modern-fse/products-tabs' is NOT REGISTERED\n";
    echo "\n  Registered blocks:\n";
    foreach ( array_keys( $registered_block_types ) as $block_name ) {
        if ( strpos( $block_name, 'modern-fse' ) !== false ) {
            echo "  - $block_name\n";
        }
    }
}

echo "\n=== END ===\n";
?>
