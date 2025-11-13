( function() {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls, useBlockProps } = wp.blockEditor;
    const el = wp.element.createElement;
    const { PanelBody, RangeControl, SelectControl, ButtonGroup, Button } = wp.components;

    registerBlockType( 'modern-fse/products-shop', {
        title: 'Products Shop',
        icon: 'store',
        category: 'woocommerce',
        
        edit: function( props ) {
            const { attributes, setAttributes } = props;
            const blockProps = useBlockProps();
            const { productsPerPage, sortBy, gridColumns, viewMode } = attributes;

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
