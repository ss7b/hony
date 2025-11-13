( function() {
	const { registerBlockType } = wp.blocks;
	const { InspectorControls, useBlockProps } = wp.blockEditor;
	const { createElement: el } = wp.element;
	const { PanelBody, ToggleControl } = wp.components;

	registerBlockType( 'modern-fse/products-sidebar', {
		title: 'Products Sidebar Filters',
		icon: 'filter',
		category: 'woocommerce',

		edit: function( props ) {
			const { attributes, setAttributes } = props;
			const blockProps = useBlockProps( {
				className: 'wp-block-modern-fse-products-sidebar products-sidebar-editor'
			} );

			return el(
				wp.element.Fragment,
				null,
				el(
					'div',
					blockProps,
					el(
						'div',
						{ style: { padding: '20px', background: '#f9fafb', borderRadius: '8px', border: '2px solid #e5e7eb' } },
						el( 'h2', { style: { color: '#0066cc', margin: '0 0 15px 0' } }, '🔍 Products Sidebar Filters' ),
						el( 'p', { style: { color: '#666', margin: '0' } }, 'شريط جانبي متقدم لفلترة المنتجات' )
					)
				),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: '⚙️ Filter Settings', initialOpen: true },
						el(
							ToggleControl,
							{
								label: 'Show Categories',
								checked: attributes.showCategories || true,
								onChange: ( value ) => setAttributes( { showCategories: value } )
							}
						),
						el(
							ToggleControl,
							{
								label: 'Show Price Range',
								checked: attributes.showPriceRange || true,
								onChange: ( value ) => setAttributes( { showPriceRange: value } )
							}
						),
						el(
							ToggleControl,
							{
								label: 'Show Rating',
								checked: attributes.showRating || true,
								onChange: ( value ) => setAttributes( { showRating: value } )
							}
						),
						el(
							ToggleControl,
							{
								label: 'Show On Sale',
								checked: attributes.showOnSale || true,
								onChange: ( value ) => setAttributes( { showOnSale: value } )
							}
						),
						el(
							ToggleControl,
							{
								label: 'Show In Stock',
								checked: attributes.showInStock || true,
								onChange: ( value ) => setAttributes( { showInStock: value } )
							}
						),
						el(
							ToggleControl,
							{
								label: 'Show Brands',
								checked: attributes.showBrands || false,
								onChange: ( value ) => setAttributes( { showBrands: value } )
							}
						)
					)
				)
			);
		},

		save: function() {
			return null;
		}
	} );
} )();
