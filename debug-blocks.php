<?php
/**
 * Debug file to check if Products Tabs block is registered
 * ملف تشخيص للتحقق من تسجيل البلوك
 */

// لا تقم بتحرير هذا الملف - Delete after checking!

// تحقق من إذا كان الملف محمل في WordPress
if ( ! defined( 'ABSPATH' ) ) {
    echo "WordPress is not loaded!";
    exit;
}

// قائمة البلوكات المسجلة
$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

echo "<h2>Registered Blocks:</h2>";
echo "<pre>";
foreach ( $registered_blocks as $block ) {
    echo $block->name . "\n";
}
echo "</pre>";

// تحقق محدد من Products Tabs
if ( isset( $registered_blocks['modern-fse/products-tabs'] ) ) {
    echo "<h2 style='color:green'>✅ Products Tabs Block is REGISTERED!</h2>";
} else {
    echo "<h2 style='color:red'>❌ Products Tabs Block is NOT registered!</h2>";
}
?>
