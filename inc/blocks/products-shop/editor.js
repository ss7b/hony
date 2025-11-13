( function() {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls, useBlockProps } = wp.blockEditor;
    const el = wp.element.createElement;
    const { PanelBody, RangeControl, SelectControl, ButtonGroup, Button, ToggleControl } = wp.components;

    registerBlockType( 'modern-fse/products-shop', {
        title: 'Products Shop',
        icon: 'store',
        category: 'woocommerce',
        
        edit: function( props ) {
            const { attributes, setAttributes } = props;
            const blockProps = useBlockProps();
            const { productsPerPage, sortBy, gridColumns, viewMode, sidebarEnabled, showPriceFilter, showCategoryFilter, showAttributeFilter, showRatingFilter, showBrandFilter, showSizeFilter, showTopRatedFilter, enablePagination } = attributes;

            return el(
                'div',
                blockProps,
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Display Settings' },
                        el( RangeControl, {
                            label: 'Products Per Page',
                            value: productsPerPage,
                            onChange: function( value ) {
                                setAttributes( { productsPerPage: value } );
                            },
                            min: 9,
                            max: 24,
                            step: 3
                        } ),
                        el( SelectControl, {
                            label: 'Sort By',
                            value: sortBy,
                            onChange: function( value ) {
                                setAttributes( { sortBy: value } );
                            },
                            options: [
                                { label: 'Latest', value: 'date' },
                                { label: 'Price: Low to High', value: 'price_asc' },
                                { label: 'Price: High to Low', value: 'price_desc' },
                                { label: 'Name: A to Z', value: 'name_asc' },
                                { label: 'Name: Z to A', value: 'name_desc' },
                                { label: 'Popularity', value: 'popularity' },
                                { label: 'Rating', value: 'rating' }
                            ]
                        } )
                    )
                ),
                el( PanelBody, { title: 'Layout Settings' },
                    el( RangeControl, {
                        label: 'Grid Columns',
                        value: gridColumns,
                        onChange: function( value ) {
                            setAttributes( { gridColumns: value } );
                        },
                        min: 2,
                        max: 4,
                        step: 1
                    } ),
                    el( 'label', {}, 'View Mode' ),
                    el( ButtonGroup, {},
                        el( Button, {
                            isPressed: viewMode === 'grid',
                            onClick: function() {
                                setAttributes( { viewMode: 'grid' } );
                            }
                        }, 'Grid' ),
                        el( Button, {
                            isPressed: viewMode === 'list',
                            onClick: function() {
                                setAttributes( { viewMode: 'list' } );
                            }
                        }, 'List' )
                    )
                ),
                el( PanelBody, { title: 'Sidebar Filters Settings' },
                    el( ToggleControl, {
                        label: 'Show Sidebar Filters',
                        help: sidebarEnabled ? 'Sidebar filters are visible' : 'Sidebar filters are hidden',
                        checked: sidebarEnabled,
                        onChange: function( value ) {
                            setAttributes( { sidebarEnabled: value } );
                        }
                    } ),
                    sidebarEnabled && el( 'div', { className: 'sidebar-filters-options' },
                        el( ToggleControl, {
                            label: 'Show Price Filter',
                            checked: showPriceFilter,
                            onChange: function( value ) {
                                setAttributes( { showPriceFilter: value } );
                            }
                        } ),
                        el( ToggleControl, {
                            label: 'Show Category Filter',
                            checked: showCategoryFilter,
                            onChange: function( value ) {
                                setAttributes( { showCategoryFilter: value } );
                            }
                        } ),
                        el( ToggleControl, {
                            label: 'Show Attribute Filter',
                            checked: showAttributeFilter,
                            onChange: function( value ) {
                                setAttributes( { showAttributeFilter: value } );
                            }
                        } ),
                        el( ToggleControl, {
                            label: 'Show Rating Filter',
                            checked: showRatingFilter,
                            onChange: function( value ) {
                                setAttributes( { showRatingFilter: value } );
                            }
                        } ),
                        el( ToggleControl, {
                            label: 'Show Brand Filter',
                            checked: showBrandFilter,
                            onChange: function( value ) {
                                setAttributes( { showBrandFilter: value } );
                            }
                        } ),
                        el( ToggleControl, {
                            label: 'Show Size Filter',
                            checked: showSizeFilter,
                            onChange: function( value ) {
                                setAttributes( { showSizeFilter: value } );
                            }
                        } ),
                        el( ToggleControl, {
                            label: 'Show Top Rated Filter',
                            checked: showTopRatedFilter,
                            onChange: function( value ) {
                                setAttributes( { showTopRatedFilter: value } );
                            }
                        } )
                    )
                ),
                el( PanelBody, { title: 'Pagination Settings' },
                    el( ToggleControl, {
                        label: 'Enable Pagination',
                        help: enablePagination ? 'Pagination is enabled' : 'Pagination is disabled',
                        checked: enablePagination,
                        onChange: function( value ) {
                            setAttributes( { enablePagination: value } );
                        }
                    } )
                ),
                el( 'div', { className: 'wp-block-modern-fse-products-shop' },
                    el( 'div', { className: 'products-shop-header' },
                        el( 'div', { className: 'breadcrumb' },
                            el( 'span', {}, 'Home' ),
                            el( 'span', {}, ' / ' ),
                            el( 'span', {}, 'Shop' )
                        )
                    ),
                    el( 'div', { className: 'shop-controls' },
                        el( 'div', { className: 'products-display' },
                            el( 'span', {}, 'Show: ' ),
                            [ 9, 12, 18, 24 ].map( function( count ) {
                                return el( 'button', {
                                    key: count,
                                    className: count === productsPerPage ? 'active' : '',
                                    onClick: function() {
                                        setAttributes( { productsPerPage: count } );
                                    }
                                }, count.toString() );
                            } )
                        ),
                        el( SelectControl, {
                            label: 'Sort',
                            value: sortBy,
                            onChange: function( value ) {
                                setAttributes( { sortBy: value } );
                            },
                            options: [
                                { label: 'Default Sorting', value: 'date' },
                                { label: 'Latest', value: 'date' },
                                { label: 'Price: Low to High', value: 'price_asc' },
                                { label: 'Price: High to Low', value: 'price_desc' }
                            ]
                        } )
                    ),
                    el( 'div', { 
                        className: 'products-grid preview-' + viewMode,
                        style: viewMode === 'grid' ? { gridTemplateColumns: 'repeat(' + gridColumns + ', 1fr)' } : {}
                    },
                        el( 'p', {}, 'Products will display here on the frontend' )
                    )
                )
            );
        },

        save: function() {
            return null;
        }
    } );
} )();
