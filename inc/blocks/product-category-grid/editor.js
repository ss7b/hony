( function() {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls } = wp.blockEditor;
    const { createElement: el } = wp.element;
    const { PanelBody, RangeControl, SelectControl, ToggleControl, RadioControl } = wp.components;

    registerBlockType( 'modern-fse/product-category-grid', {
        title: 'Product Category Grid',
        icon: 'grid-view',
        category: 'woocommerce',
        
        attributes: {
            layoutType: {
                type: 'string',
                default: 'grid'
            },
            columns: {
                type: 'number',
                default: 4
            },
            limit: {
                type: 'number',
                default: 8
            },
            orderby: {
                type: 'string',
                default: 'name'
            },
            order: {
                type: 'string',
                default: 'asc'
            },
            showCount: {
                type: 'boolean',
                default: true
            },
            showDescription: {
                type: 'boolean',
                default: false
            },
            imageSize: {
                type: 'string',
                default: 'medium'
            },
            cardStyle: {
                type: 'string',
                default: 'normal'
            },
            textPosition: {
                type: 'string',
                default: 'below'
            },
            autoPlay: {
                type: 'boolean',
                default: true
            },
            autoPlaySpeed: {
                type: 'number',
                default: 3000
            },
            showArrows: {
                type: 'boolean',
                default: true
            },
            showDots: {
                type: 'boolean',
                default: true
            },
            sliderSpeed: {
                type: 'number',
                default: 500
            },
            hoverBadge: {
                type: 'boolean',
                default: true
            },
            hoverBadgeText: {
                type: 'string',
                default: 'عرض الفئة'
            },
            hoverEffect: {
                type: 'string',
                default: 'lift'
            },
            borderRadius: {
                type: 'number',
                default: 12
            },
            showBadgeCount: {
                type: 'boolean',
                default: true
            },
            badgePosition: {
                type: 'string',
                default: 'bottom-right'
            },
            spaceBetween: {
                type: 'number',
                default: 20
            },
            loop: {
                type: 'boolean',
                default: true
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { 
                layoutType,
                columns, 
                limit, 
                orderby, 
                order, 
                showCount, 
                showDescription, 
                imageSize,
                cardStyle,
                textPosition,
                autoPlay,
                autoPlaySpeed,
                showArrows,
                showDots,
                sliderSpeed,
                hoverBadge,
                hoverBadgeText,
                hoverEffect,
                borderRadius,
                showBadgeCount,
                badgePosition,
                spaceBetween,
                loop
            } = attributes;

            // عرض معاينة للشبكة في المحرر
            const renderPreview = () => {
                const previewItems = [];
                const itemsToShow = Math.min(limit, 8);
                const isOverlay = textPosition === 'overlay';
                
                for (let i = 0; i < itemsToShow; i++) {
                    const cardClass = `category-card preview-columns-${columns} card-style-${cardStyle} text-${textPosition}`;
                    
                    previewItems.push(
                        el( 'div', { 
                            className: cardClass,
                            key: i,
                            style: { borderRadius: borderRadius + 'px' }
                        },
                            el( 'div', { className: 'category-image preview-image', style: { borderRadius: borderRadius + 'px' } },
                                el( 'div', { className: 'image-placeholder' }, '📷' ),
                                hoverBadge && el( 'div', { className: `hover-badge badge-${badgePosition}` },
                                    showBadgeCount && el( 'span', { className: 'badge-count' }, `${i + 5}` )
                                ),
                                isOverlay && el( 'div', { className: 'category-content overlay-content' },
                                    el( 'h3', { className: 'category-name' }, `فئة المنتج ${i + 1}` ),
                                    showDescription && el( 'p', { className: 'category-description' }, 
                                        'وصف مختصر لفئة المنتج هنا...'
                                    ),
                                    showCount && el( 'span', { className: 'category-count' }, `${i + 5} منتجات` )
                                )
                            ),
                            !isOverlay && el( 'div', { className: 'category-content' },
                                el( 'h3', { className: 'category-name' }, `فئة المنتج ${i + 1}` ),
                                showDescription && el( 'p', { className: 'category-description' }, 
                                    'وصف مختصر لفئة المنتج هنا...'
                                ),
                                showCount && el( 'span', { className: 'category-count' }, `${i + 5} منتجات` )
                            )
                        )
                    );
                }

                return previewItems;
            };

            return el(
                'div',
                { className: 'product-category-grid-block' },
                
                // Inspector Controls
                el( InspectorControls, {},
                    // إعدادات التخطيط الأساسية
                    el( PanelBody, { title: 'إعدادات التخطيط' },
                        el( RadioControl, {
                            label: 'نوع العرض',
                            selected: layoutType,
                            options: [
                                { label: 'شبكة', value: 'grid' },
                                { label: 'سلايدر', value: 'slider' }
                            ],
                            onChange: (value) => setAttributes( { layoutType: value } )
                        } ),
                        layoutType === 'grid' && el( RangeControl, {
                            label: 'عدد الأعمدة',
                            value: columns,
                            onChange: (value) => setAttributes( { columns: value } ),
                            min: 2,
                            max: 6
                        } ),
                        layoutType === 'slider' && el( RangeControl, {
                            label: 'عدد العناصر المعروضة',
                            value: columns,
                            onChange: (value) => setAttributes( { columns: value } ),
                            min: 1,
                            max: 6
                        } ),
                        el( RangeControl, {
                            label: 'عدد الفئات المعروضة',
                            value: limit,
                            onChange: (value) => setAttributes( { limit: value } ),
                            min: 2,
                            max: 20
                        } )
                    ),

                    // إعدادات التصميم
                    el( PanelBody, { title: 'إعدادات التصميم' },
                        el( SelectControl, {
                            label: 'شكل البطاقة',
                            value: cardStyle,
                            options: [
                                { label: 'عادية', value: 'normal' },
                                { label: 'دائرية', value: 'circular' },
                                { label: 'مربعة', value: 'square' }
                            ],
                            onChange: (value) => setAttributes( { cardStyle: value } )
                        } ),
                        el( SelectControl, {
                            label: 'مكان النص',
                            value: textPosition,
                            options: [
                                { label: 'أسفل الصورة', value: 'below' },
                                { label: 'فوق الصورة', value: 'overlay' }
                            ],
                            onChange: (value) => setAttributes( { textPosition: value } )
                        } ),
                        el( RangeControl, {
                            label: 'نصف قطر الزاوية (px)',
                            value: borderRadius,
                            onChange: (value) => setAttributes( { borderRadius: value } ),
                            min: 0,
                            max: 50
                        } ),
                        el( SelectControl, {
                            label: 'تأثير الهوفر',
                            value: hoverEffect,
                            options: [
                                { label: 'رفع', value: 'lift' },
                                { label: 'تكبير', value: 'zoom' },
                                { label: 'مرح', value: 'scale' }
                            ],
                            onChange: (value) => setAttributes( { hoverEffect: value } )
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
                        } )
                    ),

                    // إعدادات الشارة (Hover Badge)
                    el( PanelBody, { title: 'إعدادات الشارة عند الهوفر' },
                        el( ToggleControl, {
                            label: 'إظهار الشارة عند الهوفر',
                            checked: hoverBadge,
                            onChange: (value) => setAttributes( { hoverBadge: value } )
                        } ),
                        hoverBadge && el( ToggleControl, {
                            label: 'إظهار عدد المنتجات في الشارة',
                            checked: showBadgeCount,
                            onChange: (value) => setAttributes( { showBadgeCount: value } )
                        } ),
                        hoverBadge && el( SelectControl, {
                            label: 'موضع الشارة',
                            value: badgePosition,
                            options: [
                                { label: 'أعلى يسار', value: 'top-left' },
                                { label: 'أعلى يمين', value: 'top-right' },
                                { label: 'أسفل يسار', value: 'bottom-left' },
                                { label: 'أسفل يمين', value: 'bottom-right' },
                                { label: 'المركز', value: 'center' }
                            ],
                            onChange: (value) => setAttributes( { badgePosition: value } )
                        } )
                    ),

                    // إعدادات السلايدر
                    layoutType === 'slider' && el( PanelBody, { title: 'إعدادات السلايدر' },
                        el( RangeControl, {
                            label: 'المسافة بين العناصر (px)',
                            value: spaceBetween,
                            onChange: (value) => setAttributes( { spaceBetween: value } ),
                            min: 0,
                            max: 50
                        } ),
                        el( ToggleControl, {
                            label: 'التكرار المتواصل',
                            checked: loop,
                            onChange: (value) => setAttributes( { loop: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'التشغيل التلقائي',
                            checked: autoPlay,
                            onChange: (value) => setAttributes( { autoPlay: value } )
                        } ),
                        autoPlay && el( RangeControl, {
                            label: 'سرعة التشغيل التلقائي (مللي ثانية)',
                            value: autoPlaySpeed,
                            onChange: (value) => setAttributes( { autoPlaySpeed: value } ),
                            min: 1000,
                            max: 10000,
                            step: 500
                        } ),
                        el( RangeControl, {
                            label: 'سرعة الانتقال (مللي ثانية)',
                            value: sliderSpeed,
                            onChange: (value) => setAttributes( { sliderSpeed: value } ),
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
                            label: 'إظهار النقاط',
                            checked: showDots,
                            onChange: (value) => setAttributes( { showDots: value } )
                        } )
                    ),

                    // إعدادات المحتوى
                    el( PanelBody, { title: 'إعدادات المحتوى' },
                        el( SelectControl, {
                            label: 'ترتيب حسب',
                            value: orderby,
                            options: [
                                { label: 'الاسم', value: 'name' },
                                { label: 'العدد', value: 'count' },
                                { label: 'الترتيب', value: 'menu_order' }
                            ],
                            onChange: (value) => setAttributes( { orderby: value } )
                        } ),
                        el( SelectControl, {
                            label: 'الاتجاه',
                            value: order,
                            options: [
                                { label: 'تصاعدي', value: 'asc' },
                                { label: 'تنازلي', value: 'desc' }
                            ],
                            onChange: (value) => setAttributes( { order: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار عدد المنتجات',
                            checked: showCount,
                            onChange: (value) => setAttributes( { showCount: value } )
                        } ),
                        el( ToggleControl, {
                            label: 'إظهار الوصف',
                            checked: showDescription,
                            onChange: (value) => setAttributes( { showDescription: value } )
                        } )
                    )
                ),

                // Block Preview
                el( 'div', { className: 'category-grid-preview' },
                    el( 'h3', { className: 'preview-title' }, 
                        `معاينة ${layoutType === 'grid' ? 'شبكة' : 'سلايدر'} فئات المنتجات`
                    ),
                    layoutType === 'slider' && el( 'div', { className: 'slider-controls-preview' },
                        showArrows && el( 'div', { className: 'slider-arrows-preview' },
                            el( 'button', { className: 'slider-arrow prev-arrow' }, '‹' ),
                            el( 'button', { className: 'slider-arrow next-arrow' }, '›' )
                        ),
                        showDots && el( 'div', { className: 'slider-dots-preview' },
                            el( 'span', { className: 'slider-dot active' } ),
                            el( 'span', { className: 'slider-dot' } ),
                            el( 'span', { className: 'slider-dot' } )
                        )
                    ),
                    el( 'div', { 
                        className: `categories-preview ${layoutType === 'grid' ? 'editor-grid' : 'editor-slider'} columns-${columns} layout-${layoutType}` 
                    }, renderPreview() )
                )
            );
        },

        save: function() {
            // البلوك سيتم عرضه ديناميكياً في الواجهة الأمامية
            return null;
        }
    } );
} )();