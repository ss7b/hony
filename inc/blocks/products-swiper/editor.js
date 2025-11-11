( function() {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls } = wp.blockEditor;
    const { createElement: el } = wp.element;
    const { PanelBody, RangeControl, SelectControl, ToggleControl, RadioControl, TextControl } = wp.components;
    const { useSelect } = wp.data;

    registerBlockType( 'modern-fse/products-swiper', {
        title: 'Products Swiper',
        icon: 'carousel',
        category: 'woocommerce',
        
        attributes: {
            productType: {
                type: 'string',
                default: 'recent'
            },
            productCategory: {
                type: 'number',
                default: 0
            },
            limit: {
                type: 'number',
                default: 8
            },
            columns: {
                type: 'number',
                default: 3
            },
            imageSize: {
                type: 'string',
                default: 'medium'
            },
            showTitle: {
                type: 'boolean',
                default: true
            },
            showDescription: {
                type: 'boolean',
                default: false
            },
            descriptionLength: {
                type: 'number',
                default: 20
            },
            showRating: {
                type: 'boolean',
                default: true
            },
            showPrice: {
                type: 'boolean',
                default: true
            },
            showAddToCart: {
                type: 'boolean',
                default: true
            },
            cardStyle: {
                type: 'string',
                default: 'standard'
            },
            autoPlay: {
                type: 'boolean',
                default: true
            },
            autoPlaySpeed: {
                type: 'number',
                default: 5000
            },
            slideSpeed: {
                type: 'number',
                default: 800
            },
            showArrows: {
                type: 'boolean',
                default: true
            },
            showDots: {
                type: 'boolean',
                default: true
            },
            spaceBetween: {
                type: 'number',
                default: 20
            },
            loop: {
                type: 'boolean',
                default: true
            },
            customCSS: {
                type: 'string',
                default: ''
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { 
                productType,
                productCategory,
                limit, 
                columns, 
                imageSize,
                showTitle,
                showDescription,
                descriptionLength,
                showRating,
                showPrice,
                showAddToCart,
                cardStyle,
                autoPlay,
                autoPlaySpeed,
                slideSpeed,
                showArrows,
                showDots,
                spaceBetween,
                loop,
                customCSS
            } = attributes;

            // معاينة للمنتجات
            const renderPreview = () => {
                const previewItems = [];
                const itemsToShow = Math.min(limit, 6);
                
                for (let i = 0; i < itemsToShow; i++) {
                    const cardClass = `swiper-slide product-card card-style-${cardStyle}`;
                    
                    previewItems.push(
                        el( 'div', { 
                            className: cardClass,
                            key: i,
                            style: { width: `calc(100% / ${columns} - ${spaceBetween}px)` }
                        },
                            el( 'div', { className: 'product-image' },
                                el( 'div', { className: 'image-placeholder' }, '🛍️' )
                            ),
                            el( 'div', { className: 'product-info' },
                                showTitle && el( 'h3', { className: 'product-title' }, `المنتج ${i + 1}` ),
                                showPrice && el( 'span', { className: 'product-price' }, 'السعر: 500 ر.س' ),
                                showRating && el( 'div', { className: 'product-rating' }, 
                                    '★★★★★ (12)'
                                ),
                                showDescription && el( 'p', { className: 'product-description' }, 
                                    'وصف مختصر للمنتج...'
                                ),
                                showAddToCart && el( 'button', { className: 'add-to-cart-btn' }, 
                                    'أضف إلى السلة'
                                )
                            )
                        )
                    );
                }

                return previewItems;
            };

            return el(
                'div',
                { className: 'products-swiper-block-editor' },
                
                // Inspector Controls
                el( InspectorControls, {},
                    // إعدادات المنتجات
                    el( PanelBody, { title: 'إعدادات المنتجات' },
                        el( RadioControl, {
                            label: 'نوع المنتجات',
                            selected: productType,
                            options: [
                                { label: 'منتجات حديثة', value: 'recent' },
                                { label: 'منتجات الأكثر مبيعا', value: 'best_selling' },
                                { label: 'منتجات حسب التصنيف', value: 'category' }
                            ],
                            onChange: (value) => setAttributes( { productType: value } )
                        } ),
                        productType === 'category' && el( SelectControl, {
                            label: 'اختر التصنيف',
                            value: productCategory,
                            options: [
                                { label: 'كل التصنيفات', value: 0 },
                                { label: 'إلكترونيات', value: 1 },
                                { label: 'الملابس', value: 2 },
                                { label: 'أثاث', value: 3 }
                            ],
                            onChange: (value) => setAttributes( { productCategory: parseInt(value) } )
                        } ),
                        el( RangeControl, {
                            label: 'عدد المنتجات المعروضة',
                            value: limit,
                            onChange: (value) => setAttributes( { limit: value } ),
                            min: 1,
                            max: 50
                        } )
                    ),

                    // إعدادات التخطيط
                    el( PanelBody, { title: 'إعدادات التخطيط' },
                        el( RangeControl, {
                            label: 'عدد الأعمدة (في السطر الواحد)',
                            value: columns,
                            onChange: (value) => setAttributes( { columns: value } ),
                            min: 1,
                            max: 6
                        } ),
                        el( RangeControl, {
                            label: 'المسافة بين المنتجات (px)',
                            value: spaceBetween,
                            onChange: (value) => setAttributes( { spaceBetween: value } ),
                            min: 0,
                            max: 50,
                            step: 5
                        } ),
                        el( SelectControl, {
                            label: 'حجم الصورة',
                            value: imageSize,
                            options: [
                                { label: 'صغير', value: 'thumbnail' },
                                { label: 'متوسط', value: 'medium' },
                                { label: 'كبير', value: 'large' },
                                { label: 'كامل', value: 'full' }
                            ],
                            onChange: (value) => setAttributes( { imageSize: value } )
                        } ),
                        el( SelectControl, {
                            label: 'تصميم البطاقة',
                            value: cardStyle,
                            options: [
                                { label: 'عادي', value: 'standard' },
                                { label: 'مرتفع', value: 'elevated' },
                                { label: 'بسيط', value: 'minimal' },
                                { label: 'عصري', value: 'modern' }
                            ],
                            onChange: (value) => setAttributes( { cardStyle: value } )
                        } )
                    ),

                    // إعدادات المحتوى
                    el( PanelBody, { title: 'إعدادات المحتوى' },
                        el( ToggleControl, {
                            label: 'إظهار اسم المنتج',
                            checked: showTitle,
                            onChange: (value) => setAttributes( { showTitle: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار السعر',
                            checked: showPrice,
                            onChange: (value) => setAttributes( { showPrice: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار التقييم',
                            checked: showRating,
                            onChange: (value) => setAttributes( { showRating: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار الوصف',
                            checked: showDescription,
                            onChange: (value) => setAttributes( { showDescription: value } )
                        } ),
                        showDescription && el( RangeControl, {
                            label: 'عدد الكلمات في الوصف',
                            value: descriptionLength,
                            onChange: (value) => setAttributes( { descriptionLength: value } ),
                            min: 5,
                            max: 50
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار زر إضافة السلة',
                            checked: showAddToCart,
                            onChange: (value) => setAttributes( { showAddToCart: value } )
                        } )
                    ),

                    // إعدادات السلايدر
                    el( PanelBody, { title: 'إعدادات السلايدر' },
                        el( ToggleControl, {
                            label: 'التشغيل التلقائي',
                            checked: autoPlay,
                            onChange: (value) => setAttributes( { autoPlay: value } )
                        } ),
                        autoPlay && el( RangeControl, {
                            label: 'سرعة التشغيل التلقائي (ميلي ثانية)',
                            value: autoPlaySpeed,
                            onChange: (value) => setAttributes( { autoPlaySpeed: value } ),
                            min: 1000,
                            max: 15000,
                            step: 500
                        } ),
                        el( RangeControl, {
                            label: 'سرعة الانتقال (ميلي ثانية)',
                            value: slideSpeed,
                            onChange: (value) => setAttributes( { slideSpeed: value } ),
                            min: 200,
                            max: 2000,
                            step: 100
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار الأسهم',
                            checked: showArrows,
                            onChange: (value) => setAttributes( { showArrows: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار نقاط التنقل',
                            checked: showDots,
                            onChange: (value) => setAttributes( { showDots: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'التكرار المستمر',
                            checked: loop,
                            onChange: (value) => setAttributes( { loop: value } )
                        } )
                    ),

                    // إعدادات CSS المخصصة
                    el( PanelBody, { title: 'CSS مخصص' },
                        el( TextControl, {
                            label: 'CSS إضافي',
                            value: customCSS,
                            onChange: (value) => setAttributes( { customCSS: value } ),
                            multiline: true,
                            help: 'أضف أي CSS إضافي هنا (بدون <style> tags)'
                        } )
                    )
                ),

                // Block Preview
                el( 'div', { className: 'products-swiper-preview' },
                    el( 'h3', { className: 'preview-title' }, 'معاينة عرض المنتجات' ),
                    el( 'div', { className: 'slider-controls-preview' },
                        showArrows && el( 'div', { className: 'slider-arrows' },
                            el( 'button', { className: 'arrow prev-arrow' }, '‹' ),
                            el( 'button', { className: 'arrow next-arrow' }, '›' )
                        ),
                        showDots && el( 'div', { className: 'slider-dots' },
                            el( 'span', { className: 'dot active' } ),
                            el( 'span', { className: 'dot' } ),
                            el( 'span', { className: 'dot' } )
                        )
                    ),
                    el( 'div', { 
                        className: `swiper-preview columns-${columns}`,
                        style: { gap: `${spaceBetween}px` }
                    }, renderPreview() )
                )
            );
        },

        save: function() {
            return null;
        }
    } );
} )();
