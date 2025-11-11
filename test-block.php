<?php
/**
 * Quick Debug Page
 * افتح هذا الرابط في المتصفح للتحقق:
 * http://yoursite.com/wp-content/themes/blocktheme/test-block.php
 */

// تحميل WordPress
require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php' );

// التحقق من البلوك المسجل
$blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

echo "<h1>Registered Blocks</h1>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Block Name</th><th>Title</th><th>Category</th></tr>";

foreach ( $blocks as $block ) {
    $name = $block->name;
    $title = isset( $block->settings['title'] ) ? $block->settings['title'] : 'N/A';
    $category = isset( $block->settings['category'] ) ? $block->settings['category'] : 'N/A';
    
    if ( strpos( $name, 'modern-fse' ) !== false ) {
        $highlight = ' style="background-color: #ffffcc;"';
    } else {
        $highlight = '';
    }
    
    echo "<tr{$highlight}><td><strong>{$name}</strong></td><td>{$title}</td><td>{$category}</td></tr>";
}

echo "</table>";

// التحقق المحدد
if ( isset( $blocks['modern-fse/products-tabs'] ) ) {
    echo "<h2 style='color: green;'>✅ Products Tabs Block is REGISTERED!</h2>";
    $block = $blocks['modern-fse/products-tabs'];
    echo "<pre>";
    print_r( $block );
    echo "</pre>";
} else {
    echo "<h2 style='color: red;'>❌ Products Tabs Block is NOT REGISTERED!</h2>";
}
?>
