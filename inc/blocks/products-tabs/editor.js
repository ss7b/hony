(function() {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls, useBlockProps } = wp.blockEditor;
    const el = wp.element.createElement;
    const { PanelBody, RangeControl, SelectControl, ToggleControl, TextControl, Button, Notice } = wp.components;
    const { useState, useEffect } = wp.element;

    registerBlockType('modern-fse/products-tabs', {
        title: 'Products Tabs',
        category: 'woocommerce',
        icon: 'list-view',
        
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const blockProps = useBlockProps();
            const [tabCount, setTabCount] = useState(attributes.tabs?.length || 2);
            const [categories, setCategories] = useState([]);

            const cardStyles = [
                { label: 'Hover Lift', value: 'hover-lift' },
                { label: 'Shadow', value: 'shadow' },
                { label: 'Border', value: 'border' },
                { label: 'Gradient', value: 'gradient' },
                { label: 'Overlay', value: 'overlay' }
            ];

            const tabStyles = [
                { label: 'Modern', value: 'modern' },
                { label: 'Classic', value: 'classic' },
                { label: 'Flat', value: 'flat' },
                { label: 'Underline', value: 'underline' },
                { label: 'Pills', value: 'pills' }
            ];

            const animationTypes = [
                { label: 'Fade', value: 'fade' },
                { label: 'Slide Left', value: 'slide-left' },
                { label: 'Slide Right', value: 'slide-right' },
                { label: 'Zoom', value: 'zoom' },
                { label: 'Bounce', value: 'bounce' }
            ];

            const tabPositions = [
                { label: 'Top', value: 'top' },
                { label: 'Left', value: 'left' },
                { label: 'Bottom', value: 'bottom' },
                { label: 'Right', value: 'right' }
            ];

            const sortOptions = [
                { label: 'Latest', value: 'date' },
                { label: 'Most Popular', value: 'popularity' },
                { label: 'Highest Rated', value: 'rating' },
                { label: 'Price', value: 'price' }
            ];

            const displayModes = [
                { label: 'Grid', value: 'grid' },
                { label: 'List', value: 'list' },
                { label: 'Carousel', value: 'carousel' }
            ];

            const updateTab = (index, key, value) => {
                const newTabs = [...attributes.tabs];
                newTabs[index] = { ...newTabs[index], [key]: value };
                setAttributes({ tabs: newTabs });
            };

            // Update tab category by id and keep slug/name for compatibility
            const updateTabCategory = (index, categoryId) => {
                const newTabs = [...attributes.tabs];
                const cat = categories.find(c => parseInt(c.id) === parseInt(categoryId));
                newTabs[index] = { 
                    ...newTabs[index], 
                    categoryId: parseInt(categoryId) || 0,
                    categoryName: cat ? cat.slug : ''
                };
                setAttributes({ tabs: newTabs });
            };

            const addTab = () => {
                const newTab = {
                    id: 'tab-' + (tabCount + 1),
                    name: 'Tab ' + (tabCount + 1),
                    type: 'all',
                    categoryId: 0,
                    categoryName: ''
                };
                setAttributes({ tabs: [...attributes.tabs, newTab] });
                setTabCount(tabCount + 1);
            };

            // Fetch product categories for the select dropdown
            useEffect(() => {
                // Try REST API first
                if (typeof wp !== 'undefined' && wp.apiFetch) {
                    wp.apiFetch({ path: '/wp/v2/product_cat?per_page=100' })
                        .then((res) => {
                            if (Array.isArray(res)) setCategories(res);
                        })
                        .catch(() => {
                            // fallback to data store
                            try {
                                wp.data.dispatch('core').fetchEntityRecords('taxonomy', 'product_cat', { per_page: 100 }).then(() => {
                                    const cats = wp.data.select('core').getEntityRecords('taxonomy', 'product_cat', { per_page: 100 }) || [];
                                    setCategories(cats);
                                });
                            } catch (e) {}
                        });
                } else if (typeof wp !== 'undefined' && wp.data && wp.data.dispatch) {
                    wp.data.dispatch('core').fetchEntityRecords('taxonomy', 'product_cat', { per_page: 100 }).then(() => {
                        const cats = wp.data.select('core').getEntityRecords('taxonomy', 'product_cat', { per_page: 100 }) || [];
                        setCategories(cats);
                    }).catch(() => {});
                }
            }, []);

            const removeTab = (index) => {
                const newTabs = attributes.tabs.filter((_, i) => i !== index);
                setAttributes({ tabs: newTabs });
            };

            return el(
                wp.element.Fragment,
                null,
                el(
                    'div',
                    blockProps,
                    el(
                        'div',
                        { style: { padding: '20px', background: '#f9fafb', borderRadius: '8px', border: '2px solid #e5e7eb' } },
                        el('h2', { style: { color: '#6366f1', margin: '0 0 15px 0' } }, '📊 Products Tabs Block'),
                        el('p', { style: { color: '#666', margin: '0' } }, 'تبويبات المنتجات مع تأثيرات حركية وخيارات متقدمة'),
                        el(
                            'div',
                            { style: { marginTop: '15px', padding: '10px', background: '#fff', borderRadius: '4px' } },
                            'عدد التبويبات: ' + (attributes.tabs?.length || 0)
                        )
                    )
                ),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: '📑 إدارة التبويبات', initialOpen: true },
                        el('p', { style: { color: '#666', fontSize: '13px' } }, 'أضف أو حرر التبويبات'),
                        attributes.tabs?.map((tab, index) => 
                            el(
                                'div',
                                { key: index, style: { padding: '12px', background: '#f5f5f5', marginBottom: '10px', borderRadius: '4px', border: '2px solid #ddd', borderLeft: '4px solid #6366f1' } },
                                el('p', { style: { margin: '0 0 10px 0', fontWeight: 'bold', color: '#333' } }, 'تبويب #' + (index + 1)),
                                el(
                                    TextControl,
                                    {
                                        label: 'اسم التبويب',
                                        value: tab.name,
                                        onChange: (value) => updateTab(index, 'name', value),
                                        placeholder: 'مثال: جميع المنتجات'
                                    }
                                ),
                                el(
                                    SelectControl,
                                    {
                                        label: 'نوع المنتجات',
                                        value: tab.type,
                                        options: [
                                            { label: 'جميع المنتجات', value: 'all' },
                                            { label: 'الأكثر مبيعاً', value: 'best_selling' },
                                            { label: 'فئة معينة', value: 'category' }
                                        ],
                                        onChange: (value) => updateTab(index, 'type', value)
                                    }
                                ),
                                tab.type === 'category' && el(
                                    'div',
                                    { style: { background: '#fff', padding: '10px', borderRadius: '4px', marginTop: '10px', border: '1px solid #e0e0e0' } },
                                    el(
                                        SelectControl,
                                        {
                                            label: 'اختر الفئة (Category)',
                                            value: tab.categoryId || 0,
                                            options: [
                                                { label: '— اختر الفئة —', value: 0 }
                                            ].concat(categories.map(c => ({ label: c.name, value: c.id }))),
                                            onChange: (value) => updateTabCategory(index, value)
                                        }
                                    ),
                                    el('p', { style: { margin: '8px 0 0 0', fontSize: '12px', color: '#666', fontStyle: 'italic' } }, 'ملاحظة: اختر الفئة من القائمة. سيُخزّن النظام معرّف الفئة (ID) ليضمن فلترة دقيقة.')
                                ),
                                el(
                                    'div',
                                    { style: { display: 'flex', gap: '8px', marginTop: '12px' } },
                                    el(
                                        Button,
                                        {
                                            isDestructive: true,
                                            isSmall: true,
                                            onClick: () => removeTab(index)
                                        },
                                        '🗑️ حذف'
                                    )
                                )
                            )
                        ),
                        el(
                            Button,
                            {
                                isPrimary: true,
                                onClick: addTab,
                                style: { marginTop: '10px', width: '100%' }
                            },
                            '+ إضافة تبويب جديد'
                        )
                    ),
                    el(
                        PanelBody,
                        { title: '🎨 إعدادات العرض', initialOpen: false },
                        el(
                            RangeControl,
                            {
                                label: 'عدد الأعمدة',
                                value: attributes.columns,
                                onChange: (value) => setAttributes({ columns: value }),
                                min: 1,
                                max: 6
                            }
                        ),
                        el(
                            RangeControl,
                            {
                                label: 'عدد المنتجات',
                                value: attributes.limit,
                                onChange: (value) => setAttributes({ limit: value }),
                                min: 1,
                                max: 100
                            }
                        ),
                        el(
                            SelectControl,
                            {
                                label: 'حجم الصورة',
                                value: attributes.imageSize,
                                options: [
                                    { label: 'صغير', value: 'thumbnail' },
                                    { label: 'متوسط', value: 'medium' },
                                    { label: 'كبير', value: 'large' },
                                    { label: 'كامل', value: 'full' }
                                ],
                                onChange: (value) => setAttributes({ imageSize: value })
                            }
                        ),
                        el(
                            SelectControl,
                            {
                                label: 'طريقة العرض',
                                value: attributes.displayMode,
                                options: displayModes,
                                onChange: (value) => setAttributes({ displayMode: value })
                            }
                        ),
                        el(
                            SelectControl,
                            {
                                label: 'ترتيب حسب',
                                value: attributes.sortBy,
                                options: sortOptions,
                                onChange: (value) => setAttributes({ sortBy: value })
                            }
                        )
                    ),
                    el(
                        PanelBody,
                        { title: '🎯 إعدادات النمط', initialOpen: false },
                        el(
                            SelectControl,
                            {
                                label: 'نمط البطاقة',
                                value: attributes.cardStyle,
                                options: cardStyles,
                                onChange: (value) => setAttributes({ cardStyle: value })
                            }
                        ),
                        el(
                            SelectControl,
                            {
                                label: 'نمط التبويبات',
                                value: attributes.tabStyle,
                                options: tabStyles,
                                onChange: (value) => setAttributes({ tabStyle: value })
                            }
                        ),
                        el(
                            SelectControl,
                            {
                                label: 'موضع التبويبات',
                                value: attributes.tabPosition,
                                options: tabPositions,
                                onChange: (value) => setAttributes({ tabPosition: value })
                            }
                        ),
                        el(
                            RangeControl,
                            {
                                label: 'زاوية الحدود (px)',
                                value: attributes.borderRadius,
                                onChange: (value) => setAttributes({ borderRadius: value }),
                                min: 0,
                                max: 50
                            }
                        ),
                        el(
                            RangeControl,
                            {
                                label: 'المسافة بين المنتجات (px)',
                                value: attributes.spacing,
                                onChange: (value) => setAttributes({ spacing: value }),
                                min: 5,
                                max: 50
                            }
                        )
                    ),
                    el(
                        PanelBody,
                        { title: '✨ إعدادات الحركة', initialOpen: false },
                        el(
                            SelectControl,
                            {
                                label: 'نوع التأثير',
                                value: attributes.animationType,
                                options: animationTypes,
                                onChange: (value) => setAttributes({ animationType: value })
                            }
                        ),
                        el(
                            RangeControl,
                            {
                                label: 'سرعة الحركة (ميلي ثانية)',
                                value: attributes.animationSpeed,
                                onChange: (value) => setAttributes({ animationSpeed: value }),
                                min: 100,
                                max: 2000,
                                step: 100
                            }
                        ),
                        el(
                            ToggleControl,
                            {
                                label: 'تفعيل تأثيرات التحويم',
                                checked: attributes.hoverEffect,
                                onChange: (value) => setAttributes({ hoverEffect: value })
                            }
                        )
                    ),
                    el(
                        PanelBody,
                        { title: '📦 إعدادات المنتجات', initialOpen: false },
                        el(
                            ToggleControl,
                            {
                                label: 'إظهار اسم المنتج',
                                checked: attributes.showTitle,
                                onChange: (value) => setAttributes({ showTitle: value })
                            }
                        ),
                        el(
                            ToggleControl,
                            {
                                label: 'إظهار السعر',
                                checked: attributes.showPrice,
                                onChange: (value) => setAttributes({ showPrice: value })
                            }
                        ),
                        el(
                            ToggleControl,
                            {
                                label: 'إظهار التقييم',
                                checked: attributes.showRating,
                                onChange: (value) => setAttributes({ showRating: value })
                            }
                        ),
                        el(
                            ToggleControl,
                            {
                                label: 'إظهار زر الإضافة للسلة',
                                checked: attributes.showAddToCart,
                                onChange: (value) => setAttributes({ showAddToCart: value })
                            }
                        ),
                        el(
                            ToggleControl,
                            {
                                label: 'إظهار شارة الخصم',
                                checked: attributes.showBadge,
                                onChange: (value) => setAttributes({ showBadge: value })
                            }
                        ),
                        el(
                            ToggleControl,
                            {
                                label: 'تفعيل Lazy Loading',
                                checked: attributes.enableLazyLoad,
                                onChange: (value) => setAttributes({ enableLazyLoad: value })
                            }
                        )
                    )
                )
            );
        },

        save: function() {
            return null;
        }
    });
})();
