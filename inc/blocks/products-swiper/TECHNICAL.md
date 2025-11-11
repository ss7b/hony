/**
 * Products Swiper Block - Technical Documentation
 * 
 * This file provides technical details about the Products Swiper block implementation
 */

# التوثيق التقني - بلوك Products Swiper

## 🏗️ البنية المعمارية

### الملفات الرئيسية

#### 1. block.json
- يحتوي على معلومات البلوك الأساسية
- يحدد جميع الخصائص (attributes)
- يحدد النصوص والأنماط المرتبطة
- يحدد الدعم والمحاذاة

#### 2. editor.js
- يعرّف واجهة المحرر باستخدام WordPress Block Editor API
- ينشئ عناصر التحكم (Inspector Controls)
- يعرض معاينة في المحرر
- يستخدم WordPress Data API للبيانات

#### 3. view.js
- يتعامل مع تهيئة Swiper في الواجهة الأمامية
- يقرأ البيانات من عناصر data-* في HTML
- ينشئ نسخة جديدة من Swiper لكل بلوك
- يدعم CSS المخصص

#### 4. style.css
- أنماط الواجهة الأمامية
- التصاميم المختلفة للبطاقات
- الاستجابة الكاملة
- أنماط Swiper (الأسهم والنقاط)

#### 5. editor.css
- أنماط محرر WordPress
- معاينة البلوك في المحرر
- تنسيق عناصر التحكم

## 📊 نظام الخصائص (Attributes)

```javascript
{
  // نوع المنتج: recent, best_selling, category
  productType: "string" (default: "recent")
  
  // معرف التصنيف (عند اختيار category)
  productCategory: "number" (default: 0)
  
  // عدد المنتجات المعروضة
  limit: "number" (default: 8)
  
  // عدد الأعمدة
  columns: "number" (default: 3)
  
  // حجم الصورة: thumbnail, medium, large, full
  imageSize: "string" (default: "medium")
  
  // عناصر المحتوى
  showTitle: "boolean" (default: true)
  showDescription: "boolean" (default: false)
  descriptionLength: "number" (default: 20)
  showRating: "boolean" (default: true)
  showPrice: "boolean" (default: true)
  showAddToCart: "boolean" (default: true)
  
  // تصميم البطاقة: standard, elevated, minimal, modern
  cardStyle: "string" (default: "standard")
  
  // إعدادات Swiper
  autoPlay: "boolean" (default: true)
  autoPlaySpeed: "number" (default: 5000)
  slideSpeed: "number" (default: 800)
  showArrows: "boolean" (default: true)
  showDots: "boolean" (default: true)
  spaceBetween: "number" (default: 20)
  loop: "boolean" (default: true)
  
  // CSS مخصص
  customCSS: "string" (default: "")
}
```

## 🎛️ واجهة المحرر (Editor)

### مجموعات التحكم (Inspector Panels)

1. **إعدادات المنتجات**
   - اختيار نوع المنتج
   - اختيار التصنيف (إذا كان مطلوباً)
   - تحديد عدد المنتجات

2. **إعدادات التخطيط**
   - عدد الأعمدة
   - المسافة بين المنتجات
   - حجم الصورة
   - تصميم البطاقة

3. **إعدادات المحتوى**
   - إظهار/إخفاء البيانات المختلفة

4. **إعدادات السلايدر**
   - التشغيل التلقائي
   - السرعات
   - الأسهم والنقاط

5. **CSS مخصص**
   - حقل نصي لإدخال CSS مخصص

## 🔄 دورة الحياة (Lifecycle)

### عند التحميل
1. يتم تحميل مكتبة Swiper من CDN
2. يتم البحث عن جميع عناصر `.swiper-container`
3. يتم تهيئة Swiper مع البيانات المخزنة

### عند الحفظ
1. يتم حفظ جميع الخصائص كـ JSON
2. يتم عرض البلوك ديناميكياً على الواجهة الأمامية

### عند التحديث
1. يتم إعادة تحديث المعاينة في المحرر فوراً
2. يتم الاحتفاظ بحالة البلوك

## 🔌 Hooks و Filters

### WordPress Hooks

```php
// تسجيل البلوك
register_block_type(
    get_template_directory() . '/inc/blocks/products-swiper/block.json',
    array(
        'render_callback' => 'modern_fse_render_products_swiper',
    )
);

// تحميل النصوص
add_action('wp_enqueue_scripts', 'modern_fse_enqueue_block_assets');
add_action('enqueue_block_editor_assets', 'modern_fse_enqueue_block_editor_assets');
```

### WooCommerce Filters

```php
// عرض إضافة إلى السلة
apply_filters('woocommerce_loop_add_to_cart_link', ...)

// معالجة الإضافة إلى السلة
apply_filters('woocommerce_product_add_to_cart_handler', 'ajax', $product)
```

## 🛠️ تخصيص البلوك

### إضافة نوع منتج جديد

تعديل في `editor.js`:
```javascript
options: [
    { label: 'منتجات حديثة', value: 'recent' },
    { label: 'منتجات الأكثر مبيعا', value: 'best_selling' },
    { label: 'منتجات حسب التصنيف', value: 'category' },
    { label: 'منتجات مميزة', value: 'featured' } // جديد
]
```

تعديل في `init.php` في `modern_fse_render_products_swiper()`:
```php
} elseif ($product_type === 'featured') {
    $args['meta_query'] = array(
        array(
            'key' => '_featured',
            'value' => 'yes',
            'compare' => '='
        )
    );
}
```

### إضافة تصميم بطاقة جديد

تعديل في `editor.js`:
```javascript
options: [
    { label: 'عادي', value: 'standard' },
    { label: 'مرتفع', value: 'elevated' },
    { label: 'بسيط', value: 'minimal' },
    { label: 'عصري', value: 'modern' },
    { label: 'تصميمي', value: 'designer' } // جديد
]
```

إضافة في `style.css`:
```css
.products-swiper-block .product-card.card-style-designer {
    /* أنماط مخصصة */
}
```

## 🚀 تحسينات الأداء

### Lazy Loading
- الصور تستخدم `loading="lazy"`
- التحميل يتم عند الحاجة فقط

### تحميل مشروط
- Swiper يتم تحميله فقط إذا كان البلوك موجوداً
- CSS و JS تحميل ذكي

### Caching
- يمكن استخدام caching للاستعلامات
- WooCommerce caching يعمل تلقائياً

## 📈 SEO و Accessibility

### Accessibility
- استخدام `aria-label` على الأسهم
- نصوص بديلة للصور
- ألوان متباينة كافية

### SEO
- الروابط الديناميكية تشير إلى صفحات المنتج
- النصوص الوصفية للصور
- أسماء معمولة بشكل صحيح

## 🔒 الأمان

### Escaping و Sanitization
- `esc_url()` للروابط
- `esc_attr()` للخصائص
- `esc_html()` للنصوص
- `wp_kses_post()` للـ HTML المعقد
- `sanitize_text_field()` للإدخال

## 📦 التوزيع والنشر

### المتطلبات
```json
{
  "wordpress": ">=5.8",
  "woocommerce": ">=5.0",
  "php": ">=7.2"
}
```

### التثبيت
1. انسخ المجلد `products-swiper` إلى `inc/blocks/`
2. قم بتحديث `inc/blocks/init.php`
3. امسح الذاكرة المؤقتة
4. البلوك سيظهر في محرر WordPress

## 🐛 Debugging

### في المحرر
استخدم Console في متصفح Chrome:
```javascript
// البحث عن جميع بلوكات Swiper
document.querySelectorAll('.swiper-container')

// التحقق من بيانات Swiper
Swiper instances array
```

### في الواجهة الأمامية
```php
// تفعيل Debug Mode
define('WP_DEBUG', true);

// التحقق من الاستعلام
var_dump($query);
```

## 📝 التغييرات والإصدارات

### الإصدار 1.0.0
- الإصدار الأول
- دعم كامل ل WooCommerce
- 4 تصاميم مختلفة
- إعدادات Swiper المتقدمة
