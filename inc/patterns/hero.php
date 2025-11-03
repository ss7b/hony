<?php
add_action( 'init', 'mytheme_register_hero_patterns' );
function mytheme_register_hero_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // تسجيل فئة الأنماط
    register_block_pattern_category(
        'mytheme-headers',
        array( 'label' => __( 'Hero', 'mytheme' ) )
    );

    // تسجيل الأنماط الأربعة
    mytheme_register_hero_1();
    mytheme_register_hero_2();
    mytheme_register_hero_3();
    mytheme_register_hero_4();
}

// النمط الأول: Hero كلاسيكي مع خلفية متدرجة
function mytheme_register_hero_1() {
    $content = '<!-- wp:cover {"url":"https://example.com/hero-bg.jpg","dimRatio":0,"focalPoint":{"x":"0.50","y":"0.50"},"minHeight":80,"minHeightUnit":"vh","contentPosition":"center center","align":"full","style":{"spacing":{"padding":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-cover alignfull" style="padding-top:0px;padding-bottom:0px;min-height:80vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="https://example.com/hero-bg.jpg" style="object-position:50% 50%" data-object-fit="cover" data-object-position="50% 50%"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"72px","lineHeight":"1.1"}},"textColor":"white"} -->
    <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:72px;line-height:1.1">' . __( 'ابتكار غير عادي', 'mytheme' ) . '</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"24px"}},"textColor":"white"} -->
    <p class="has-text-align-center has-white-color has-text-color" style="font-size:24px">' . __( 'نقدم حلولاً مبتكرة تنقل عملك إلى المستوى التالي', 'mytheme' ) . '</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"vivid-cyan-blue","textColor":"white","style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"15px","bottom":"15px","left":"40px","right":"40px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-vivid-cyan-blue-background-color has-text-color has-background wp-element-button" style="border-radius:50px;padding-top:15px;padding-bottom:15px;padding-right:40px;padding-left:40px">' . __( 'ابدأ رحلتك', 'mytheme' ) . '</a></div>
    <!-- /wp:button -->

    <!-- wp:button {"textColor":"white","style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"15px","bottom":"15px","left":"40px","right":"40px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" style="border-radius:50px;padding-top:15px;padding-bottom:15px;padding-right:40px;padding-left:40px">' . __( 'اعرف المزيد', 'mytheme' ) . '</a></div>
    <!-- /wp:button --></div>
    <!-- /wp:buttons --></div>
    <!-- /wp:group --></div></div>
    <!-- /wp:cover -->';

    register_block_pattern(
        'mytheme/hero-classic',
        array(
            'title'       => __( 'Hero كلاسيكي - خلفية متدرجة', 'mytheme' ),
            'description' => __( 'تصميم Hero كلاسيكي مع خلفية وصورة، مناسب للصفحات الرئيسية', 'mytheme' ),
            'content'     => $content,
            'categories'  => array( 'mytheme-headers' ),
            'viewportWidth'=> 1200,
        )
    );
}

// النمط الثاني: Hero أنيق مع إحصائيات
function mytheme_register_hero_2() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0px","bottom":"0px"},"margin":{"top":"0px"}}},"backgroundColor":"foreground","textColor":"background","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background-color has-foreground-background-color has-text-color has-background" style="margin-top:0px;padding-top:0px;padding-bottom:0px"><!-- wp:spacer {"height":"80px"} -->
    <div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|80"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"60px","lineHeight":"1.1"}}} -->
    <h1 class="wp-block-heading" style="font-size:60px;line-height:1.1">' . __( 'نصنع المستقبل الرقمي', 'mytheme' ) . '</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"20px"}}} -->
    <p style="font-size:20px">' . __( 'نحن شركة رائدة في تقديم الحلول التقنية المتكاملة التي تحول الأفكار إلى واقع ملموس.', 'mytheme' ) . '</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons -->
    <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"background","textColor":"foreground","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"18px","bottom":"18px","left":"40px","right":"40px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-foreground-color has-background-background-color has-text-color has-background wp-element-button" style="border-radius:8px;padding-top:18px;padding-bottom:18px;padding-right:40px;padding-left:40px">' . __( 'اطلب استشارة', 'mytheme' ) . '</a></div>
    <!-- /wp:button --></div>
    <!-- /wp:buttons --></div>
    <!-- /wp:column -->

    <!-- wp:column {"verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
    <div class="wp-block-columns"><!-- wp:column -->
    <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"48px"}}} -->
    <h3 class="wp-block-heading has-text-align-center" style="font-size:48px">500+</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">' . __( 'مشروع ناجح', 'mytheme' ) . '</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:group --></div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"48px"}}} -->
    <h3 class="wp-block-heading has-text-align-center" style="font-size:48px">98%</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">' . __( 'عملاء سعداء', 'mytheme' ) . '</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:group --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"80px"} -->
    <div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
    <!-- /wp:group -->';

    register_block_pattern(
        'mytheme/hero-stats',
        array(
            'title'       => __( 'Hero أنيق - مع إحصائيات', 'mytheme' ),
            'description' => __( 'تصميم Hero أنيق مع عرض إحصائيات وألوان متناقضة', 'mytheme' ),
            'content'     => $content,
            'categories'  => array( 'mytheme-headers' ),
            'viewportWidth'=> 1200,
        )
    );
}

// النمط الثالث: Hero حديث مع فيديو خلفية
function mytheme_register_hero_3() {
    $content = '<!-- wp:cover {"url":"https://example.com/video-poster.jpg","dimRatio":30,"isDark":false,"minHeight":90,"minHeightUnit":"vh","contentPosition":"center center","align":"full","style":{"color":{"duotone":["#000000","#ffffff"]}}} -->
    <div class="wp-block-cover alignfull is-light" style="min-height:90vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="https://example.com/video-poster.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 5vw, 4.5rem)","lineHeight":"1.1"}},"textColor":"white"} -->
    <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:clamp(2.5rem, 5vw, 4.5rem);line-height:1.1">' . __( 'تجربة رقمية استثنائية', 'mytheme' ) . '</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"22px"}},"textColor":"white"} -->
    <p class="has-text-align-center has-white-color has-text-color" style="font-size:22px">' . __( 'نخلق تجارب رقمية لا تُنسى تجمع بين الجمال والأداء', 'mytheme' ) . '</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
    <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"backgroundColor":"white","textColor":"black","style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"50px","right":"50px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:50px;padding-top:20px;padding-bottom:20px;padding-right:50px;padding-left:50px">' . __( 'شاهد أعمالنا', 'mytheme' ) . '</a></div>
    <!-- /wp:button -->

    <!-- wp:button {"textColor":"white","style":{"border":{"radius":"50px","width":"2px"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"50px","right":"50px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" style="border-radius:50px;border-width:2px;padding-top:20px;padding-bottom:20px;padding-right:50px;padding-left:50px">' . __( 'تعرف علينا', 'mytheme' ) . '</a></div>
    <!-- /wp:button --></div>
    <!-- /wp:buttons -->

    <!-- wp:spacer {"height":"40px"} -->
    <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
    <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"small"} -->
    <p class="has-white-color has-text-color has-link-color has-small-font-size">' . __( 'موثوق من قبل أكثر من 1000 شركة حول العالم', 'mytheme' ) . '</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:group --></div>
    <!-- /wp:group --></div></div>
    <!-- /wp:cover -->';

    register_block_pattern(
        'mytheme/hero-modern',
        array(
            'title'       => __( 'Hero حديث - مع فيديو', 'mytheme' ),
            'description' => __( 'تصميم Hero حديث مع إمكانية إضافة فيديو خلفية وتصميم متجاوب', 'mytheme' ),
            'content'     => $content,
            'categories'  => array( 'mytheme-headers' ),
            'viewportWidth'=> 1200,
        )
    );
}

// النمط الرابع: Hero مبدع مع أشكال هندسية
function mytheme_register_hero_4() {
    $content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0px","bottom":"0px"},"margin":{"top":"0px"}},"color":{"background":"#0F172A"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-background" style="background-color:#0F172A;margin-top:0px;padding-top:0px;padding-bottom:0px"><!-- wp:spacer {"height":"100px"} -->
    <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%"><!-- wp:heading {"textColor":"white","style":{"typography":{"fontSize":"56px","lineHeight":"1.2"}}} -->
    <h1 class="wp-block-heading has-white-color has-text-color" style="font-size:56px;line-height:1.2">' . __( 'نحو مستقبل أكثر ذكاءً وإبداعاً', 'mytheme' ) . '</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"}},"textColor":"white"} -->
    <p class="has-white-color has-text-color" style="font-size:18px">' . __( 'نحن ندفع حدود الإمكانيات التقنية لنخلق عالماً أفضل للأجيال القادمة.', 'mytheme' ) . '</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
    <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"#3B82F6","textColor":"white","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-#3b82f6-background-color has-text-color has-background wp-element-button" style="border-radius:8px;padding-top:16px;padding-bottom:16px;padding-right:32px;padding-left:32px">' . __( 'ابدأ الآن', 'mytheme' ) . '</a></div>
    <!-- /wp:button -->

    <!-- wp:button {"style":{"border":{"radius":"8px","width":"2px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}}} -->
    <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" style="border-radius:8px;border-width:2px;padding-top:16px;padding-bottom:16px;padding-right:32px;padding-left:32px">' . __( 'شاهد الفيديو', 'mytheme' ) . '</a></div>
    <!-- /wp:button --></div>
    <!-- /wp:buttons --></div>
    <!-- /wp:column -->

    <!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
    <figure class="wp-block-image size-full"><img src="https://example.com/hero-visual.png" alt="' . __( 'تصميم مرئي', 'mytheme' ) . '"/></figure>
    <!-- /wp:image --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"100px"} -->
    <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
    <!-- /wp:group -->';

    register_block_pattern(
        'mytheme/hero-creative',
        array(
            'title'       => __( 'Hero مبدع - أشكال هندسية', 'mytheme' ),
            'description' => __( 'تصميم Hero مبدع مع تخطيط عمودي وألوان داكنة أنيقة', 'mytheme' ),
            'content'     => $content,
            'categories'  => array( 'mytheme-headers' ),
            'viewportWidth'=> 1200,
        )
    );
}