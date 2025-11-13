document.addEventListener('DOMContentLoaded', function() {
	// Get AJAX URL from WordPress
	const ajaxUrl = typeof blockthemeAjax !== 'undefined' ? blockthemeAjax.ajaxUrl : '/wp-admin/admin-ajax.php';
	const nonce = typeof blockthemeAjax !== 'undefined' ? blockthemeAjax.nonce : '';

	// Initialize with stored values from URL
	const params = new URLSearchParams(window.location.search);
	let currentProductsPerPage = parseInt(params.get('products_per_page')) || 12;
	const currentViewMode = params.get('view_mode') || 'grid-4';
	const currentSortBy = params.get('sort_by') || 'date';

	// Display options buttons
	const displayButtons = document.querySelectorAll('.products-display button');
	displayButtons.forEach(button => {
		button.addEventListener('click', function(e) {
			e.preventDefault();
			const count = parseInt(this.textContent);
			updateProductsDisplay(count);
		});
	});

	// View mode toggle buttons (Grid and List options)
	const viewModeButtons = document.querySelectorAll('.view-mode-toggle button');
	viewModeButtons.forEach(button => {
		button.addEventListener('click', function(e) {
			e.preventDefault();
			const viewMode = this.dataset.viewMode;
			updateViewMode(viewMode);
		});
	});

	// Mobile show select dropdown
	const showSelect = document.querySelector('.mobile-show-control select');
	if (showSelect) {
		showSelect.addEventListener('change', function() {
			updateProductsDisplay(parseInt(this.value));
		});
	}

	// Sort dropdown
	const sortSelect = document.querySelector('.sort-control select');
	if (sortSelect) {
		sortSelect.addEventListener('change', function() {
			currentSortBy = this.value;
			updateProductsSort(this.value);
		});
	}

	// Sidebar Filters - Category Filter
	const categoryCheckboxes = document.querySelectorAll('.category-filter-checkbox');
	categoryCheckboxes.forEach(checkbox => {
		checkbox.addEventListener('change', function() {
			applyFilters();
		});
	});

	// Sidebar Filters - Price Filter
	const priceMinInput = document.querySelector('.price-min');
	const priceMaxInput = document.querySelector('.price-max');
	if (priceMinInput && priceMaxInput) {
		priceMinInput.addEventListener('input', function() {
			updatePriceDisplay();
			applyFilters();
		});
		priceMaxInput.addEventListener('input', function() {
			updatePriceDisplay();
			applyFilters();
		});
	}

	// Sidebar Filters - Attribute Filter
	const attributeCheckboxes = document.querySelectorAll('.attribute-filter-checkbox');
	attributeCheckboxes.forEach(checkbox => {
		checkbox.addEventListener('change', function() {
			applyFilters();
		});
	});

	// Sidebar Filters - Rating Filter
	const ratingCheckboxes = document.querySelectorAll('.rating-filter-checkbox');
	ratingCheckboxes.forEach(checkbox => {
		checkbox.addEventListener('change', function() {
			applyFilters();
		});
	});

	// Sidebar Filters - Brand Filter
	const brandCheckboxes = document.querySelectorAll('.brand-filter-checkbox');
	brandCheckboxes.forEach(checkbox => {
		checkbox.addEventListener('change', function() {
			applyFilters();
		});
	});

	// Sidebar Filters - Size Filter
	const sizeCheckboxes = document.querySelectorAll('.size-filter-checkbox');
	sizeCheckboxes.forEach(checkbox => {
		checkbox.addEventListener('change', function() {
			applyFilters();
		});
	});

	// Sidebar Filters - Top Rated Filter
	const topRatedCheckbox = document.querySelector('.top-rated-filter-checkbox');
	if (topRatedCheckbox) {
		topRatedCheckbox.addEventListener('change', function() {
			applyFilters();
		});
	}

	// Clear Filters Button
	const clearFiltersBtn = document.querySelector('.clear-filters-btn');
	if (clearFiltersBtn) {
		clearFiltersBtn.addEventListener('click', function() {
			clearAllFilters();
		});
	}

	// Set active display button
	function setActiveDisplayButton(count) {
		displayButtons.forEach(button => {
			button.classList.remove('active');
			if (parseInt(button.textContent) === count) {
				button.classList.add('active');
			}
		});
	}

	// Set active view mode button
	function setActiveViewModeButton(viewMode) {
		viewModeButtons.forEach(button => {
			button.classList.remove('active');
			if (button.dataset.viewMode === viewMode) {
				button.classList.add('active');
			}
		});
	}

	// Update price display
	function updatePriceDisplay() {
		const minPrice = priceMinInput.value;
		const maxPrice = priceMaxInput.value;
		const minPriceDisplay = document.querySelector('.min-price');
		const maxPriceDisplay = document.querySelector('.max-price');
		if (minPriceDisplay) minPriceDisplay.textContent = minPrice;
		if (maxPriceDisplay) maxPriceDisplay.textContent = maxPrice;
	}

	// Apply filters via AJAX
	function applyFilters() {
		// Re-query elements in case they've changed
		const categoryCheckboxes = document.querySelectorAll('.category-filter-checkbox');
		const attributeCheckboxes = document.querySelectorAll('.attribute-filter-checkbox');
		const ratingCheckboxes = document.querySelectorAll('.rating-filter-checkbox');
		const brandCheckboxes = document.querySelectorAll('.brand-filter-checkbox');
		const sizeCheckboxes = document.querySelectorAll('.size-filter-checkbox');
		const topRatedCheckbox = document.querySelector('.top-rated-filter-checkbox');
		const priceMinInput = document.querySelector('.price-min');
		const priceMaxInput = document.querySelector('.price-max');

		const selectedCategories = Array.from(categoryCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.dataset.catId);
		
		const selectedAttributes = Array.from(attributeCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.value);
		
		const selectedRatings = Array.from(ratingCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.value);
		
		const selectedBrands = Array.from(brandCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.dataset.brandId);
		
		const selectedSizes = Array.from(sizeCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.value);
		
		const isTopRated = topRatedCheckbox && topRatedCheckbox.checked ? 'top-rated' : '';
		
		const minPrice = priceMinInput ? priceMinInput.value : 0;
		const maxPrice = priceMaxInput ? priceMaxInput.value : 10000;

		// Prepare AJAX data
		const ajaxData = {
			action: 'filter_products',
			nonce: nonce,
			products_per_page: currentProductsPerPage,
			paged: 1,
			sort_by: currentSortBy,
			filter_categories: selectedCategories.length > 0 ? selectedCategories.join(',') : '',
			filter_attributes: selectedAttributes.length > 0 ? selectedAttributes.join(',') : '',
			filter_ratings: selectedRatings.length > 0 ? selectedRatings.join(',') : '',
			filter_brands: selectedBrands.length > 0 ? selectedBrands.join(',') : '',
			filter_sizes: selectedSizes.length > 0 ? selectedSizes.join(',') : '',
			filter_top_rated: isTopRated,
			filter_price: (minPrice > 0 || maxPrice < 10000) ? minPrice + ',' + maxPrice : '',
		};

		// Update URL
		const url = new URL(window.location);
		if (selectedCategories.length > 0) {
			url.searchParams.set('filter_categories', selectedCategories.join(','));
		} else {
			url.searchParams.delete('filter_categories');
		}
		if (selectedAttributes.length > 0) {
			url.searchParams.set('filter_attributes', selectedAttributes.join(','));
		} else {
			url.searchParams.delete('filter_attributes');
		}
		if (selectedRatings.length > 0) {
			url.searchParams.set('filter_ratings', selectedRatings.join(','));
		} else {
			url.searchParams.delete('filter_ratings');
		}
		if (selectedBrands.length > 0) {
			url.searchParams.set('filter_brands', selectedBrands.join(','));
		} else {
			url.searchParams.delete('filter_brands');
		}
		if (selectedSizes.length > 0) {
			url.searchParams.set('filter_sizes', selectedSizes.join(','));
		} else {
			url.searchParams.delete('filter_sizes');
		}
		if (isTopRated) {
			url.searchParams.set('filter_top_rated', isTopRated);
		} else {
			url.searchParams.delete('filter_top_rated');
		}
		if (minPrice > 0 || maxPrice < 10000) {
			url.searchParams.set('filter_price', minPrice + ',' + maxPrice);
		} else {
			url.searchParams.delete('filter_price');
		}
		window.history.pushState({}, '', url.toString());

		// Make AJAX request
		fetch(ajaxUrl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: new URLSearchParams(ajaxData)
		})
		.then(response => response.json())
		.then(data => {
			if (data.html) {
				const container = document.querySelector('.products-container');
				if (container) {
					container.innerHTML = data.html;
					// Re-attach event listeners if needed
					attachAddToCartListeners();
				}
			}
			// Update pagination
			if (data.pagination) {
				const paginationContainer = document.querySelector('.products-pagination');
				if (paginationContainer) {
					paginationContainer.innerHTML = data.pagination;
					// Re-attach pagination listeners
					attachPaginationListeners();
				}
			}
		})
		.catch(error => console.error('Error:', error));
	}

	// Clear all filters
	function clearAllFilters() {
		const categoryCheckboxes = document.querySelectorAll('.category-filter-checkbox');
		const attributeCheckboxes = document.querySelectorAll('.attribute-filter-checkbox');
		const ratingCheckboxes = document.querySelectorAll('.rating-filter-checkbox');
		const brandCheckboxes = document.querySelectorAll('.brand-filter-checkbox');
		const sizeCheckboxes = document.querySelectorAll('.size-filter-checkbox');
		const topRatedCheckbox = document.querySelector('.top-rated-filter-checkbox');
		const priceMinInput = document.querySelector('.price-min');
		const priceMaxInput = document.querySelector('.price-max');

		categoryCheckboxes.forEach(cb => cb.checked = false);
		attributeCheckboxes.forEach(cb => cb.checked = false);
		ratingCheckboxes.forEach(cb => cb.checked = false);
		brandCheckboxes.forEach(cb => cb.checked = false);
		sizeCheckboxes.forEach(cb => cb.checked = false);
		if (topRatedCheckbox) topRatedCheckbox.checked = false;
		if (priceMinInput) priceMinInput.value = 0;
		if (priceMaxInput) priceMaxInput.value = 10000;
		updatePriceDisplay();
		
		const url = new URL(window.location);
		url.searchParams.delete('filter_categories');
		url.searchParams.delete('filter_attributes');
		url.searchParams.delete('filter_ratings');
		url.searchParams.delete('filter_brands');
		url.searchParams.delete('filter_sizes');
		url.searchParams.delete('filter_top_rated');
		url.searchParams.delete('filter_price');
		window.history.pushState({}, '', url.toString());

		applyFilters();
	}

	// Update products display
	function updateProductsDisplay(count) {
		const container = document.querySelector('.products-container');
		if (container) {
			container.classList.add('loading');
			setActiveDisplayButton(count);
			
			// Update URL and reload
			const url = new URL(window.location);
			url.searchParams.set('products_per_page', count);
			window.location.href = url.toString();
		}
	}

	// Update view mode
	function updateViewMode(viewMode) {
		const container = document.querySelector('.products-container');
		if (container) {
			container.classList.add('loading');
			setActiveViewModeButton(viewMode);
			
			// Update URL and reload
			const url = new URL(window.location);
			url.searchParams.set('view_mode', viewMode);
			window.location.href = url.toString();
		}
	}

	// Update products sort
	function updateProductsSort(sortBy) {
		const container = document.querySelector('.products-container');
		if (container) {
			container.classList.add('loading');
			
			// Update URL and reload
			const url = new URL(window.location);
			url.searchParams.set('sort_by', sortBy);
			window.location.href = url.toString();
		}
	}

	// Attach event listeners for add to cart buttons
	function attachAddToCartListeners() {
		// WooCommerce will re-initialize these automatically
		if (typeof jQuery !== 'undefined' && jQuery.fn.wc_add_to_cart_params) {
			jQuery(document.body).trigger('added_to_cart');
		}
	}

	// Initialize with stored values from URL
	const storedCount = parseInt(params.get('products_per_page')) || 12;
	const storedViewMode = params.get('view_mode') || 'grid-4';
	setActiveDisplayButton(storedCount);
	setActiveViewModeButton(storedViewMode);
	
	// Update currentProductsPerPage
	currentProductsPerPage = storedCount;

	// Restore filter selections from URL
	const storedCategories = params.get('filter_categories');
	const storedAttributes = params.get('filter_attributes');
	const storedRatings = params.get('filter_ratings');
	const storedPrice = params.get('filter_price');

	if (storedCategories) {
		const catIds = storedCategories.split(',');
		categoryCheckboxes.forEach(cb => {
			if (catIds.includes(cb.dataset.catId)) {
				cb.checked = true;
			}
		});
	}

	if (storedAttributes) {
		const attrs = storedAttributes.split(',');
		attributeCheckboxes.forEach(cb => {
			if (attrs.includes(cb.value)) {
				cb.checked = true;
			}
		});
	}

	if (storedRatings) {
		const ratings = storedRatings.split(',');
		ratingCheckboxes.forEach(cb => {
			if (ratings.includes(cb.value)) {
				cb.checked = true;
			}
		});
	}

	if (storedPrice) {
		const [minPrice, maxPrice] = storedPrice.split(',');
		if (priceMinInput) priceMinInput.value = minPrice;
		if (priceMaxInput) priceMaxInput.value = maxPrice;
		updatePriceDisplay();
	}

	// Attach pagination listeners on initial page load
	attachPaginationListeners();

	// Attach pagination listeners
	function attachPaginationListeners() {
		const paginationLinks = document.querySelectorAll('.products-pagination a, .products-pagination .page-numbers');
		paginationLinks.forEach(link => {
			// Skip elements without href attribute
			const href = link.getAttribute('href');
			if (!href) {
				return; // Skip current page span
			}
			
			link.addEventListener('click', function(e) {
				e.preventDefault();
				
				// Extract page number from href
				let pageNum = 1;
				const linkHref = this.getAttribute('href');
				
				if (linkHref) {
					// Try to extract from URL pattern like ?paged=2, &paged=2, or /page/2/
					const pagedMatch = linkHref.match(/[\?&]paged=(\d+)/);
					if (pagedMatch) {
						pageNum = parseInt(pagedMatch[1]);
					} else {
						const pageMatch = linkHref.match(/\/page\/(\d+)/);
						if (pageMatch) {
							pageNum = parseInt(pageMatch[1]);
						}
					}
					
					// Debug logging
					console.log('Pagination link clicked:', linkHref, 'Page num:', pageNum);
				}
				
				loadPage(pageNum);
			});
		});
	}

	// Load specific page
	async function loadPage(pageNum) {
		// Validate page number
		if (!pageNum || pageNum < 1) {
			pageNum = 1;
		}

		console.log('Loading page:', pageNum);

		const categoryCheckboxes = document.querySelectorAll('.category-filter-checkbox');
		const attributeCheckboxes = document.querySelectorAll('.attribute-filter-checkbox');
		const ratingCheckboxes = document.querySelectorAll('.rating-filter-checkbox');
		const brandCheckboxes = document.querySelectorAll('.brand-filter-checkbox');
		const sizeCheckboxes = document.querySelectorAll('.size-filter-checkbox');
		const topRatedCheckbox = document.querySelector('.top-rated-filter-checkbox');
		const priceMinInput = document.querySelector('.price-min');
		const priceMaxInput = document.querySelector('.price-max');

		const selectedCategories = Array.from(categoryCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.dataset.catId);
		const selectedAttributes = Array.from(attributeCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.value);
		const selectedRatings = Array.from(ratingCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.value);
		const selectedBrands = Array.from(brandCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.dataset.brandId);
		const selectedSizes = Array.from(sizeCheckboxes)
			.filter(cb => cb.checked)
			.map(cb => cb.value);
		const isTopRated = topRatedCheckbox && topRatedCheckbox.checked ? 'top-rated' : '';
		const minPrice = priceMinInput ? priceMinInput.value : 0;
		const maxPrice = priceMaxInput ? priceMaxInput.value : 10000;

		const ajaxData = {
			action: 'filter_products',
			nonce: nonce,
			products_per_page: currentProductsPerPage,
			paged: pageNum,
			sort_by: currentSortBy,
			filter_categories: selectedCategories.length > 0 ? selectedCategories.join(',') : '',
			filter_attributes: selectedAttributes.length > 0 ? selectedAttributes.join(',') : '',
			filter_ratings: selectedRatings.length > 0 ? selectedRatings.join(',') : '',
			filter_brands: selectedBrands.length > 0 ? selectedBrands.join(',') : '',
			filter_sizes: selectedSizes.length > 0 ? selectedSizes.join(',') : '',
			filter_top_rated: isTopRated,
			filter_price: (minPrice > 0 || maxPrice < 10000) ? minPrice + ',' + maxPrice : '',
		};

		console.log('AJAX data:', ajaxData);

		try {
			const response = await fetch(ajaxUrl, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams(ajaxData)
			});

			console.log('AJAX response status:', response.status, response.ok);
			console.log('AJAX response headers:', response.headers);
			console.log('AJAX URL:', ajaxUrl);
			
			if (!response.ok) {
				throw new Error('Network response was not ok: ' + response.status);
			}
			
			// Clone the response to read it without consuming the stream
			const clonedResponse = response.clone();
			const text = await clonedResponse.text();
			console.log('AJAX response text length:', text.length);
			console.log('AJAX response text:', text.substring(0, 500));
			
			const data = await response.json();
			console.log('AJAX response data:', data);
			
			if (!data) {
				throw new Error('Response data is null or undefined');
			}
			
			if (data.html) {
				const container = document.querySelector('.products-container');
				if (container) {
					container.innerHTML = data.html;
					attachAddToCartListeners();
					// Scroll to products
					const scrollTarget = container.closest('.wp-block-modern-fse-products-shop') || container;
					window.scrollTo({
						top: scrollTarget.offsetTop - 100,
						behavior: 'smooth'
					});
				}
			}
			if (data.pagination) {
				const paginationContainer = document.querySelector('.products-pagination');
				if (paginationContainer) {
					paginationContainer.innerHTML = data.pagination;
					attachPaginationListeners();
				}
			}
		} catch (error) {
			console.error('Error loading page:', error);
			alert('حدث خطأ في تحميل الصفحة. يرجى المحاولة مجددا. التفاصيل: ' + error.message);
		}
	}
});

