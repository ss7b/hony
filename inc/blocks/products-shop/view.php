<?php
/**
 * Products Shop Block
 * 
 * @package blocktheme
 */

// Get attributes
$products_per_page = isset( $attributes['productsPerPage'] ) ? intval( $attributes['productsPerPage'] ) : 12;
$sort_by = isset( $attributes['sortBy'] ) ? sanitize_text_field( $attributes['sortBy'] ) : 'date';
$grid_columns = isset( $attributes['gridColumns'] ) ? intval( $attributes['gridColumns'] ) : 4;
$view_mode = isset( $attributes['viewMode'] ) ? sanitize_text_field( $attributes['viewMode'] ) : 'grid';

// Get from URL if set
if ( isset( $_GET['products_per_page'] ) ) {
	$products_per_page = intval( $_GET['products_per_page'] );
}
if ( isset( $_GET['sort_by'] ) ) {
	$sort_by = sanitize_text_field( $_GET['sort_by'] );
}

// Get current page
$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

// Set up query arguments
$orderby = 'date';
$order = 'DESC';

switch ( $sort_by ) {
	case 'price_asc':
		$orderby = 'meta_value_num';
		$order = 'ASC';
		break;
	case 'price_desc':
		$orderby = 'meta_value_num';
		$order = 'DESC';
		break;
	case 'name_asc':
		$orderby = 'title';
		$order = 'ASC';
		break;
	case 'name_desc':
		$orderby = 'title';
		$order = 'DESC';
		break;
	case 'popularity':
		$orderby = 'meta_value_num';
		$order = 'DESC';
		break;
	case 'rating':
		$orderby = 'meta_value_num';
		$order = 'DESC';
		break;
	case 'date':
	default:
		$orderby = 'date';
		$order = 'DESC';
		break;
}

// Query products
$args = array(
	'post_type' => 'product',
	'posts_per_page' => $products_per_page,
	'paged' => $paged,
	'orderby' => $orderby,
	'order' => $order,
);

$products_query = new WP_Query( $args );
$products = $products_query->posts;

// Get current URL for breadcrumbs
$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : false;
$shop_url = $shop_url ?: home_url( '/shop/' );
$current_page = __( 'Shop', 'blocktheme' );
?>

<div class="wp-block-modern-fse-products-shop">
	
	<!-- Breadcrumb Navigation -->
	<div class="products-shop-breadcrumb">
		<a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Home', 'blocktheme' ); ?></a>
		<span class="separator"> / </span>
		<span class="current"><?php echo esc_html( __( 'Shop', 'blocktheme' ) ); ?></span>
	</div>

	<!-- Shop Controls Header -->
	<div class="products-shop-header">
		<!-- Display Options (visible on medium and large screens) -->
		<div class="shop-controls">
			<div class="products-display">
				<span class="display-label"><?php _e( 'Show:', 'blocktheme' ); ?></span>
				<?php foreach ( array( 9, 12, 18, 24 ) as $count ) : ?>
					<button class="display-option <?php echo $count === $products_per_page ? 'active' : ''; ?>" 
							data-count="<?php echo esc_attr( $count ); ?>">
						<?php echo esc_html( $count ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<!-- Sort Dropdown -->
			<div class="sort-control">
				<select class="sort-select" data-current-sort="<?php echo esc_attr( $sort_by ); ?>">
					<option value="date" <?php selected( $sort_by, 'date' ); ?>>
						<?php _e( 'Default Sorting', 'blocktheme' ); ?>
					</option>
					<option value="date" <?php selected( $sort_by, 'date' ); ?>>
						<?php _e( 'Latest', 'blocktheme' ); ?>
					</option>
					<option value="price_asc" <?php selected( $sort_by, 'price_asc' ); ?>>
						<?php _e( 'Price: Low to High', 'blocktheme' ); ?>
					</option>
					<option value="price_desc" <?php selected( $sort_by, 'price_desc' ); ?>>
						<?php _e( 'Price: High to Low', 'blocktheme' ); ?>
					</option>
					<option value="name_asc" <?php selected( $sort_by, 'name_asc' ); ?>>
						<?php _e( 'Name: A to Z', 'blocktheme' ); ?>
					</option>
					<option value="name_desc" <?php selected( $sort_by, 'name_desc' ); ?>>
						<?php _e( 'Name: Z to A', 'blocktheme' ); ?>
					</option>
					<option value="popularity" <?php selected( $sort_by, 'popularity' ); ?>>
						<?php _e( 'Popularity', 'blocktheme' ); ?>
					</option>
					<option value="rating" <?php selected( $sort_by, 'rating' ); ?>>
						<?php _e( 'Rating', 'blocktheme' ); ?>
					</option>
				</select>
			</div>
		</div>
	</div>

	<!-- Products Grid/List -->
	<div class="products-container view-<?php echo esc_attr( $view_mode ); ?>" style="<?php echo $view_mode === 'grid' ? 'display: grid; grid-template-columns: repeat(' . intval( $grid_columns ) . ', 1fr);' : ''; ?>">
		<?php if ( $products_query->have_posts() ) : ?>
			<?php foreach ( $products as $product ) : ?>
				<?php
				$product_obj = wc_get_product( $product->ID );
				if ( ! $product_obj ) continue;
				
				// Determine product badges
				$badges = array();
				if ( $product_obj->is_on_sale() ) {
					$badges[] = 'sale';
				}
				if ( $product_obj->is_featured() ) {
					$badges[] = 'featured';
				}
				// Check if product was added recently (within 7 days)
				$post_date = strtotime( $product->post_date );
				if ( $post_date > strtotime( '-7 days' ) ) {
					$badges[] = 'new';
				}
				?>
				<div class="product-item product-view-<?php echo esc_attr( $view_mode ); ?>"><?php if ( ! empty( $badges ) ) : ?>
					<div class="product-badges">
						<?php foreach ( $badges as $badge ) : ?>
							<span class="badge badge-<?php echo esc_attr( $badge ); ?>" title="<?php echo esc_attr( ucfirst( $badge ) ); ?>">
								<?php
								switch ( $badge ) {
									case 'sale':
										echo '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v6h6L3.5 10.5 1 8V2zm17 3h5v13c0 1.1-.9 2-2 2h-11v-2h10V5z"/></svg>';
										echo __( 'Sale', 'blocktheme' );
										break;
									case 'featured':
										echo '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2l-2.81 6.63L2 9.24l5.46 4.73L5.82 21z"/></svg>';
										echo __( 'Featured', 'blocktheme' );
										break;
									case 'new':
										echo '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>';
										echo __( 'New', 'blocktheme' );
										break;
								}
								?>
							</span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
					<?php if ( $view_mode === 'list' ) : ?>
						<!-- List View -->
						<div class="product-list-wrapper">
							<div class="product-image-left">
								<?php echo wp_kses_post( $product_obj->get_image( 'woocommerce_thumbnail' ) ); ?>
								<?php if ( $product_obj->is_on_sale() ) : ?>
									<div class="sale-badge-overlay sale-badge-small">
										<span class="sale-discount">
											<?php
											$regular_price = $product_obj->get_regular_price();
											$sale_price = $product_obj->get_sale_price();
											if ( $regular_price && $sale_price ) {
												$discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
												echo '-' . intval( $discount ) . '%';
											} else {
												echo __( 'Sale', 'blocktheme' );
											}
											?>
										</span>
									</div>
								<?php endif; ?>
							</div>
							<div class="product-content-right">
								<h3 class="product-title">
									<a href="<?php echo esc_url( get_permalink( $product->ID ) ); ?>">
										<?php echo esc_html( $product->post_title ); ?>
									</a>
								</h3>
								<div class="product-meta">
									<div class="product-category">
										<?php 
										$categories = get_the_terms( $product->ID, 'product_cat' );
										if ( $categories && ! is_wp_error( $categories ) ) {
											echo esc_html( $categories[0]->name );
										}
										?>
									</div>
									<div class="product-meta-icons-list">
										<?php if ( $product_obj->get_stock_status() === 'instock' ) : ?>
											<span class="icon-badge-small in-stock" title="<?php _e( 'In Stock', 'blocktheme' ); ?>">
												<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
											</span>
										<?php endif; ?>
										<?php if ( $product_obj->get_average_rating() > 4 ) : ?>
											<span class="icon-badge-small top-rated" title="<?php _e( 'Top Rated', 'blocktheme' ); ?>">
												<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2l-2.81 6.63L2 9.24l5.46 4.73L5.82 21z"/></svg>
											</span>
										<?php endif; ?>
									</div>
									<div class="product-price">
										<?php echo wp_kses_post( $product_obj->get_price_html() ); ?>
									</div>
								</div>
								<p class="product-description">
									<?php echo wp_kses_post( wp_trim_words( $product->post_excerpt ?: $product->post_content, 20 ) ); ?>
								</p>
								<div class="product-footer">
									<div class="product-rating">
										<?php
										$rating = $product_obj->get_average_rating();
										$review_count = $product_obj->get_review_count();
										if ( $rating > 0 ) :
											?>
											<div class="stars-wrapper">
												<span class="stars" style="width: <?php echo ( $rating / 5 ) * 100; ?>%"></span>
											</div>
											<span class="rating-text"><?php echo esc_html( $rating ); ?>/5 (<?php echo intval( $review_count ); ?>)</span>
										<?php endif; ?>
									</div>
									<div class="product-button">
										<?php echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" data-quantity="1" class="button product_type_simple add_to_cart_button" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>', esc_url( $product_obj->add_to_cart_url() ), esc_attr( $product_obj->get_id() ), esc_attr( $product_obj->get_sku() ), esc_attr( sprintf( __( 'Add "%s" to your cart', 'blocktheme' ), $product->post_title ) ), esc_html( $product_obj->add_to_cart_text() ) ), $product_obj ); ?>
									</div>
								</div>
							</div>
						</div>
					<?php else : ?>
						<!-- Grid View -->
						<div class="product-grid-wrapper">
							<div class="product-image">
								<?php echo wp_kses_post( $product_obj->get_image( 'woocommerce_thumbnail' ) ); ?>
								<?php if ( $product_obj->is_on_sale() ) : ?>
									<div class="sale-badge-overlay">
										<span class="sale-discount">
											<?php
											$regular_price = $product_obj->get_regular_price();
											$sale_price = $product_obj->get_sale_price();
											if ( $regular_price && $sale_price ) {
												$discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
												echo '-' . intval( $discount ) . '%';
											} else {
												echo __( 'Sale', 'blocktheme' );
											}
											?>
										</span>
									</div>
								<?php endif; ?>
							</div>
							<div class="product-content">
								<h3 class="product-title">
									<a href="<?php echo esc_url( get_permalink( $product->ID ) ); ?>">
										<?php echo esc_html( $product->post_title ); ?>
									</a>
								</h3>
								<div class="product-meta-icons">
									<?php if ( $product_obj->get_stock_status() === 'instock' ) : ?>
										<span class="icon-badge in-stock" title="<?php _e( 'In Stock', 'blocktheme' ); ?>">
											<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
										</span>
									<?php endif; ?>
									<?php if ( $product_obj->get_average_rating() > 4 ) : ?>
										<span class="icon-badge top-rated" title="<?php _e( 'Top Rated', 'blocktheme' ); ?>">
											<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2l-2.81 6.63L2 9.24l5.46 4.73L5.82 21z"/></svg>
										</span>
									<?php endif; ?>
									<?php if ( $product_obj->is_on_sale() ) : ?>
										<span class="icon-badge on-sale" title="<?php _e( 'Sale', 'blocktheme' ); ?>">
											<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.85 12.65h-8.5v2.15h8.5z M18 8h-7c-.5 0-1 .5-1 1v3c0 .5.5 1 1 1h7c.5 0 1-.5 1-1V9c0-.5-.5-1-1-1zm0 4h-7V9h7v3zM7 13H6v2h1v-2zm0-6H6v5h1V7z M11 6H7c-.5 0-1 .5-1 1s.5 1 1 1h4c.5 0 1-.5 1-1s-.5-1-1-1z"/></svg>
										</span>
									<?php endif; ?>
								</div>
								<div class="product-price">
									<?php echo wp_kses_post( $product_obj->get_price_html() ); ?>
								</div>
								<div class="product-rating">
									<?php
									$rating = $product_obj->get_average_rating();
									$review_count = $product_obj->get_review_count();
									if ( $rating > 0 ) :
										?>
										<div class="stars-wrapper">
											<span class="stars" style="width: <?php echo ( $rating / 5 ) * 100; ?>%"></span>
										</div>
										<span class="rating-text"><?php echo esc_html( $rating ); ?>/5 (<?php echo intval( $review_count ); ?>)</span>
									<?php endif; ?>
								</div>
								<div class="product-button">
									<?php echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" data-quantity="1" class="button product_type_simple add_to_cart_button" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>', esc_url( $product_obj->add_to_cart_url() ), esc_attr( $product_obj->get_id() ), esc_attr( $product_obj->get_sku() ), esc_attr( sprintf( __( 'Add "%s" to your cart', 'blocktheme' ), $product->post_title ) ), esc_html( $product_obj->add_to_cart_text() ) ), $product_obj ); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="no-products">
				<?php _e( 'No products found', 'blocktheme' ); ?>
			</div>
		<?php endif; ?>
	</div>

	<!-- Pagination -->
	<?php if ( $products_query->max_num_pages > 1 ) : ?>
		<div class="products-pagination">
			<?php
			echo wp_kses_post( paginate_links( array(
				'total' => $products_query->max_num_pages,
				'current' => $paged,
				'format' => '?paged=%#%',
				'prev_text' => __( '&laquo; Previous', 'blocktheme' ),
				'next_text' => __( 'Next &raquo;', 'blocktheme' ),
			) ) );
			?>
		</div>
	<?php endif; ?>
</div>

<?php wp_reset_postdata(); ?>
