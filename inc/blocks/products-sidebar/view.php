<?php
/**
 * Products Sidebar Filters Block - Frontend Render
 *
 * @package blocktheme
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

// Extract attributes
$show_categories = isset( $attributes['showCategories'] ) ? (bool) $attributes['showCategories'] : true;
$show_price_range = isset( $attributes['showPriceRange'] ) ? (bool) $attributes['showPriceRange'] : true;
$show_rating = isset( $attributes['showRating'] ) ? (bool) $attributes['showRating'] : true;
$show_on_sale = isset( $attributes['showOnSale'] ) ? (bool) $attributes['showOnSale'] : true;
$show_in_stock = isset( $attributes['showInStock'] ) ? (bool) $attributes['showInStock'] : true;

// Get product categories
$categories = get_terms( array(
	'taxonomy' => 'product_cat',
	'hide_empty' => true,
	'orderby' => 'name',
	'order' => 'ASC',
) );

// Get price range from products
$price_products = new WP_Query( array(
	'post_type' => 'product',
	'posts_per_page' => -1,
	'fields' => 'ids',
) );

$min_price = PHP_INT_MAX;
$max_price = 0;
foreach ( $price_products->posts as $product_id ) {
	$product = wc_get_product( $product_id );
	if ( $product ) {
		$price = (float) $product->get_price();
		if ( $price < $min_price ) {
			$min_price = $price;
		}
		if ( $price > $max_price ) {
			$max_price = $price;
		}
	}
}

if ( $min_price === PHP_INT_MAX ) {
	$min_price = 0;
}

// Get URL parameters for active filters
$selected_categories = isset( $_GET['product_cat'] ) ? array_map( 'sanitize_text_field', (array) $_GET['product_cat'] ) : array();
$selected_min_price = isset( $_GET['min_price'] ) ? intval( $_GET['min_price'] ) : 0;
$selected_max_price = isset( $_GET['max_price'] ) ? intval( $_GET['max_price'] ) : 10000;
$selected_rating = isset( $_GET['min_rating'] ) ? intval( $_GET['min_rating'] ) : 0;
$show_on_sale_filter = isset( $_GET['on_sale'] ) ? true : false;
$show_in_stock_filter = isset( $_GET['in_stock'] ) ? true : false;

$block_id = 'products-sidebar-' . uniqid();
?>

<aside class="wp-block-modern-fse-products-sidebar" id="<?php echo esc_attr( $block_id ); ?>" data-block-id="<?php echo esc_attr( $block_id ); ?>">
	<div class="sidebar-inner">
		<!-- Filter Header -->
		<div class="sidebar-header">
			<h3 class="sidebar-title"><?php esc_html_e( 'Filters', 'blocktheme' ); ?></h3>
			<button class="reset-filters-btn" data-block-id="<?php echo esc_attr( $block_id ); ?>" type="button">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M3 6h18M8 6v12M16 6v12M5 6l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M10 11v6M14 11v6"></path>
				</svg>
				<?php esc_html_e( 'Reset', 'blocktheme' ); ?>
			</button>
		</div>

		<form class="filters-container" id="filtersForm-<?php echo esc_attr( $block_id ); ?>" data-block-id="<?php echo esc_attr( $block_id ); ?>">
			<!-- Categories Filter -->
			<?php if ( $show_categories && ! is_wp_error( $categories ) && ! empty( $categories ) ) : ?>
				<div class="filter-group" data-filter="categories">
					<button type="button" class="filter-header">
						<h4 class="filter-title">
							<span><?php esc_html_e( 'Categories', 'blocktheme' ); ?></span>
							<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</h4>
					</button>
					<div class="filter-content">
						<?php foreach ( $categories as $category ) : ?>
							<label class="filter-checkbox">
								<input type="checkbox" 
									class="filter-input category-filter" 
									name="product_cat[]" 
									value="<?php echo esc_attr( $category->slug ); ?>"
									data-filter-type="category"
									<?php echo in_array( $category->slug, $selected_categories ) ? 'checked' : ''; ?>>
								<span class="checkbox-label">
									<span class="label-text"><?php echo esc_html( $category->name ); ?></span>
									<span class="count">(<?php echo esc_html( $category->count ); ?>)</span>
								</span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Price Range Filter -->
			<?php if ( $show_price_range ) : ?>
				<div class="filter-group" data-filter="price">
					<button type="button" class="filter-header">
						<h4 class="filter-title">
							<span><?php esc_html_e( 'Price Range', 'blocktheme' ); ?></span>
							<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</h4>
					</button>
					<div class="filter-content">
						<div class="price-range-wrapper">
							<div class="price-inputs">
								<input type="number" 
									name="min_price"
									class="filter-input price-input min-price" 
									placeholder="<?php esc_attr_e( 'Min', 'blocktheme' ); ?>"
									value="<?php echo esc_attr( $selected_min_price ); ?>"
									min="0"
									max="<?php echo esc_attr( intval( $max_price ) ); ?>"
									data-filter-type="price">
								<span class="price-separator">-</span>
								<input type="number" 
									name="max_price"
									class="filter-input price-input max-price" 
									placeholder="<?php esc_attr_e( 'Max', 'blocktheme' ); ?>"
									value="<?php echo esc_attr( $selected_max_price ); ?>"
									min="0"
									max="<?php echo esc_attr( intval( $max_price ) ); ?>"
									data-filter-type="price">
							</div>
							<div class="price-display">
								<strong><?php echo wp_kses_post( wc_price( $selected_min_price ?: 0 ) ); ?></strong> 
								<span class="separator">—</span> 
								<strong><?php echo wp_kses_post( wc_price( $selected_max_price ?: $max_price ) ); ?></strong>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!-- Rating Filter -->
			<?php if ( $show_rating ) : ?>
				<div class="filter-group" data-filter="rating">
					<button type="button" class="filter-header">
						<h4 class="filter-title">
							<span><?php esc_html_e( 'Rating', 'blocktheme' ); ?></span>
							<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</h4>
					</button>
					<div class="filter-content">
						<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
							<label class="filter-checkbox">
								<input type="radio" 
									class="filter-input rating-filter" 
									name="min_rating"
									value="<?php echo esc_attr( $i ); ?>"
									data-filter-type="rating"
									<?php echo $selected_rating === $i ? 'checked' : ''; ?>>
								<span class="checkbox-label">
									<span class="stars">
										<?php for ( $s = 0; $s < 5; $s++ ) : ?>
											<span class="star <?php echo $s < $i ? 'filled' : ''; ?>">★</span>
										<?php endfor; ?>
									</span>
									<span class="rating-text"><?php echo esc_html( $i ); ?> <?php esc_html_e( 'Star & Up', 'blocktheme' ); ?></span>
								</span>
							</label>
						<?php endfor; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- On Sale Filter -->
			<?php if ( $show_on_sale ) : ?>
				<div class="filter-group" data-filter="on_sale">
					<button type="button" class="filter-header">
						<h4 class="filter-title">
							<span><?php esc_html_e( 'Discounts', 'blocktheme' ); ?></span>
							<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</h4>
					</button>
					<div class="filter-content">
						<label class="filter-checkbox">
							<input type="checkbox" 
								name="on_sale"
								class="filter-input on-sale-filter"
								value="1"
								data-filter-type="on_sale"
								<?php echo $show_on_sale_filter ? 'checked' : ''; ?>>
							<span class="checkbox-label">
								<span class="badge sale-badge">SALE</span>
								<?php esc_html_e( 'On Sale Only', 'blocktheme' ); ?>
							</span>
						</label>
					</div>
				</div>
			<?php endif; ?>

			<!-- In Stock Filter -->
			<?php if ( $show_in_stock ) : ?>
				<div class="filter-group" data-filter="in_stock">
					<button type="button" class="filter-header">
						<h4 class="filter-title">
							<span><?php esc_html_e( 'Stock', 'blocktheme' ); ?></span>
							<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<polyline points="6 9 12 15 18 9"></polyline>
							</svg>
						</h4>
					</button>
					<div class="filter-content">
						<label class="filter-checkbox">
							<input type="checkbox" 
								name="in_stock"
								class="filter-input in-stock-filter"
								value="1"
								data-filter-type="in_stock"
								<?php echo $show_in_stock_filter ? 'checked' : ''; ?>>
							<span class="checkbox-label">
								<span class="badge stock-badge">✓</span>
								<?php esc_html_e( 'In Stock Only', 'blocktheme' ); ?>
							</span>
						</label>
					</div>
				</div>
			<?php endif; ?>
		</form>

		<!-- Active Filters Display -->
		<div class="active-filters-display" id="activeFilters-<?php echo esc_attr( $block_id ); ?>"></div>

		<!-- Loading Indicator -->
		<div class="filter-loading-indicator" id="filterLoading-<?php echo esc_attr( $block_id ); ?>">
			<div class="spinner"></div>
			<span><?php esc_html_e( 'Filtering...', 'blocktheme' ); ?></span>
		</div>
	</div>
</aside>

<?php
// Localize AJAX data for JavaScript
wp_localize_script( 'modern-fse-products-sidebar-view', 'productsFiltersAjax', array(
	'ajaxUrl' => admin_url( 'admin-ajax.php' ),
	'nonce' => wp_create_nonce( 'products-filters-nonce' ),
) );

