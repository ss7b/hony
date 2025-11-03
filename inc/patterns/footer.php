<?php
add_action( 'init', 'hony_register_footer_patterns' );
function hony_register_footer_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة الأنماط
    register_block_pattern_category(
        'mytheme-footer',
        array( 'label' => __( 'Footer', 'mytheme' ) )
    );

    // تسجيل الأنماط الأربعة
    mytheme_register_footer_1();
}

// النمط الأول: Hero كلاسيكي مع خلفية متدرجة
function mytheme_register_footer_1() {
    $content = '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background-background-color has-background" style="margin-top:0;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">عسل طبيعي</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>نقدم لكم أفضل أنواع العسل الطبيعي المستخرج من أفضل المناحل في المنطقة.</p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"size":"has-small-icon-size","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-small-icon-size is-style-logos-only"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

<!-- wp:social-link {"url":"#","service":"facebook"} /-->

<!-- wp:social-link {"url":"#","service":"instagram"} /-->

<!-- wp:social-link {"url":"#","service":"youtube"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">روابط سريعة</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li><a href="#">الرئيسية</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">منتجاتنا</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">عن العسل</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">المدونة</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">اتصل بنا</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">منتجاتنا</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li><a href="#">عسل السدر</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">عسل الموالح</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">عسل البرسيم</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">عسل الزهور</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">عسل الجبال</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">اتصل بنا</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><i class="fas fa-phone"></i> +966 123 456 789</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><i class="fas fa-envelope"></i> info@naturalhoney.com</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
<hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">جميع الحقوق محفوظة &copy; 2023 عسل طبيعي</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->';

    register_block_pattern(
        'mytheme/footer-classic',
        array(
            'title'       => __( 'Footer  -  فوتر كلاسيكي', 'mytheme' ),
            'description' => __( 'تصميم footer كلاسيكي مع خلفية وصورة، مناسب للصفحات الرئيسية', 'mytheme' ),
            'content'     => $content,
            'categories'  => array( 'mytheme-footer' ),
            'viewportWidth'=> 1200,
        )
    );
}
