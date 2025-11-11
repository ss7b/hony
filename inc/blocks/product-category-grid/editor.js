( function( blocks, element, components, editor ) {
    const { InspectorControls } = editor;
    const { createElement: el } = element;
    const { PanelBody, RangeControl, SelectControl, ToggleControl, RadioControl } = components;

    blocks.registerBlockType( 'modern-fse/product-category-grid', {
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
                sliderSpeed
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
                            key: i
                        },
                            el( 'div', { className: 'category-image preview-image' },
                                el( 'div', { className: 'image-placeholder' }, '📷' ),
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

                    // إعدادات السلايدر
                    layoutType === 'slider' && el( PanelBody, { title: 'إعدادات السلايدر' },
                        el( ToggleControl, {
                            label: 'تشغيل التلقائي',
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
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor );