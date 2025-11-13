/**
 * Products Sidebar Filters - Frontend Script
 * Handles real-time product filtering and displays results
 */

(function() {
	'use strict';

	// Debounce function for AJAX calls
	function debounce(func, wait) {
		let timeout;
		return function executedFunction(...args) {
			const later = () => {
				clearTimeout(timeout);
				func(...args);
			};
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
		};
	}

	// Initialize filters on page load
	document.addEventListener('DOMContentLoaded', function() {
		const sidebars = document.querySelectorAll('.wp-block-modern-fse-products-sidebar');
		
		sidebars.forEach(function(sidebar) {
			initializeSidebar(sidebar);
		});

		// Listen for filter events to update products
		document.addEventListener('productsFiltered', function(e) {
			displayFilteredProducts(e.detail);
		});
	});

	/**
	 * Initialize sidebar filters
	 */
	function initializeSidebar(sidebar) {
		const blockId = sidebar.getAttribute('data-block-id');
		if (!blockId) return;

		const form = sidebar.querySelector('form[data-block-id="' + blockId + '"]');
		if (!form) return;

		// Set up filter headers (collapsible)
		setupFilterHeaders(sidebar);

		// Set up filter inputs
		setupFilterInputs(sidebar, blockId);

		// Set up reset button
		setupResetButton(sidebar, blockId);
	}

	/**
	 * Setup collapsible filter headers
	 */
	function setupFilterHeaders(sidebar) {
		const headers = sidebar.querySelectorAll('.filter-header');
		
		headers.forEach(function(header) {
			header.addEventListener('click', function(e) {
				e.preventDefault();
				
				const content = this.nextElementSibling;
				const filterGroup = this.closest('.filter-group');
				
				// Toggle active class
				filterGroup.classList.toggle('active');
				
				// Toggle content visibility
				if (content) {
					content.style.display = content.style.display === 'none' ? '' : 'none';
				}
			});
		});

		// Open first filter by default
		const firstGroup = sidebar.querySelector('.filter-group');
		if (firstGroup) {
			firstGroup.classList.add('active');
		}
	}

	/**
	 * Setup filter input listeners
	 */
	function setupFilterInputs(sidebar, blockId) {
		const inputs = sidebar.querySelectorAll('.filter-input');
		const debouncedFilter = debounce(function() {
			applyFilters(sidebar, blockId);
		}, 300);

		inputs.forEach(function(input) {
			if (input.type === 'number') {
				input.addEventListener('change', debouncedFilter);
				input.addEventListener('keyup', debouncedFilter);
			} else if (input.type === 'radio') {
				input.addEventListener('change', debouncedFilter);
			} else if (input.type === 'checkbox') {
				input.addEventListener('change', debouncedFilter);
			}
		});
	}

	/**
	 * Setup reset button
	 */
	function setupResetButton(sidebar, blockId) {
		const resetBtn = sidebar.querySelector('[data-block-id="' + blockId + '"].reset-filters-btn');
		if (!resetBtn) return;

		resetBtn.addEventListener('click', function(e) {
			e.preventDefault();
			
			// Reset all inputs
			const form = sidebar.querySelector('form[data-block-id="' + blockId + '"]');
			if (form) {
				// Reset checkboxes
				form.querySelectorAll('input[type="checkbox"]').forEach(function(input) {
					input.checked = false;
				});

				// Reset radio buttons
				form.querySelectorAll('input[type="radio"]').forEach(function(input) {
					input.checked = false;
				});

				// Reset number inputs to default
				const minPrice = form.querySelector('.min-price');
				const maxPrice = form.querySelector('.max-price');
				if (minPrice) minPrice.value = '0';
				if (maxPrice) maxPrice.value = '10000';

				// Update price display
				updatePriceDisplay(sidebar);

				// Clear active filters
				displayActiveFilters(sidebar, blockId, {});

				// Apply filters
				applyFilters(sidebar, blockId);
			}
		});
	}

	/**
	 * Apply filters and fetch results via AJAX
	 */
	function applyFilters(sidebar, blockId) {
		if (!window.productsFiltersAjax) {
			console.error('AJAX data not initialized');
			return;
		}

		const form = sidebar.querySelector('form[data-block-id="' + blockId + '"]');
		if (!form) return;

		// Show loading indicator
		showLoadingIndicator(sidebar, blockId);

		// Collect filter data
		const formData = new FormData(form);
		const filterData = {
			action: 'filter_products',
			nonce: window.productsFiltersAjax.nonce,
			categories: [],
			min_price: 0,
			max_price: 10000,
			min_rating: 0,
			on_sale: false,
			in_stock: false
		};

		// Parse form data
		form.querySelectorAll('input:checked').forEach(function(input) {
			if (input.name === 'product_cat[]') {
				filterData.categories.push(input.value);
			}
		});

		const minPrice = form.querySelector('.min-price');
		if (minPrice && minPrice.value) {
			filterData.min_price = parseInt(minPrice.value);
		}

		const maxPrice = form.querySelector('.max-price');
		if (maxPrice && maxPrice.value) {
			filterData.max_price = parseInt(maxPrice.value);
		}

		const ratingInput = form.querySelector('input[name="min_rating"]:checked');
		if (ratingInput) {
			filterData.min_rating = parseInt(ratingInput.value);
		}

		const onSaleInput = form.querySelector('input[name="on_sale"]:checked');
		filterData.on_sale = onSaleInput ? true : false;

		const inStockInput = form.querySelector('input[name="in_stock"]:checked');
		filterData.in_stock = inStockInput ? true : false;

		// Display active filters
		displayActiveFilters(sidebar, blockId, filterData);

		// Send AJAX request
		fetch(window.productsFiltersAjax.ajaxUrl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: new URLSearchParams(filterData)
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				// Update products display
				displayFilteredProducts({
					products: data.data.products,
					count: data.data.count,
					blockId: blockId
				});
			} else {
				console.error('Filter error:', data.message);
				showErrorMessage(sidebar, blockId, data.message || 'خطأ في الفلترة');
			}
		})
		.catch(error => {
			console.error('AJAX error:', error);
			showErrorMessage(sidebar, blockId, 'خطأ في الاتصال بالخادم');
		})
		.finally(() => {
			hideLoadingIndicator(sidebar, blockId);
		});
	}

	/**
	 * Display filtered products
	 */
	function displayFilteredProducts(data) {
		// Find the products container (should be adjacent to sidebar)
		let productsContainer = document.querySelector('.products-container');
		
		if (!productsContainer) {
			// If no container, create one
			const sidebar = document.querySelector('[data-block-id="' + data.blockId + '"]');
			if (!sidebar) return;
			
			const parent = sidebar.closest('.wp-block-columns, .wp-block-group, [class*="block"]');
			if (parent) {
				productsContainer = document.createElement('div');
				productsContainer.className = 'products-container filtered-products';
				parent.appendChild(productsContainer);
			}
		}

		if (!productsContainer) return;

		// Build products HTML
		let productsHTML = '';

		if (data.products && data.products.length > 0) {
			productsHTML += '<div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem;">';
			
			data.products.forEach(function(product) {
				const onSaleBadge = product.on_sale ? '<span class="product-badge on-sale">خصم</span>' : '';
				const stockStatus = product.in_stock ? '' : '<span class="product-badge out-of-stock">غير متاح</span>';
				
				productsHTML += `
					<div class="product-card" style="border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; transition: all 0.3s;">
						<div class="product-image" style="position: relative; overflow: hidden; background: #f5f5f5; height: 250px;">
							${onSaleBadge}
							${stockStatus}
							<img src="${escapeHtml(product.image)}" alt="${escapeHtml(product.name)}" style="width: 100%; height: 100%; object-fit: cover;">
						</div>
						<div class="product-info" style="padding: 1.5rem;">
							<h3 class="product-title" style="margin: 0 0 0.5rem 0; font-size: 14px; font-weight: 600;">
								<a href="${escapeHtml(product.permalink)}" style="color: #333; text-decoration: none;">${escapeHtml(product.name)}</a>
							</h3>
							<div class="product-rating" style="margin: 0.5rem 0; color: #ffc107;">
								${'★'.repeat(Math.round(product.rating))}${'☆'.repeat(5 - Math.round(product.rating))}
								<small style="color: #999;">(${product.rating.toFixed(1)})</small>
							</div>
							<div class="product-price" style="margin: 0.75rem 0; font-size: 16px; font-weight: bold; color: #0066cc;">
								${formatPrice(product.price)}
								${product.on_sale && product.sale_price ? `<span style="text-decoration: line-through; color: #999; margin-left: 0.5rem; font-size: 14px;">${formatPrice(product.regular_price)}</span>` : ''}
							</div>
							<a href="${escapeHtml(product.permalink)}?add-to-cart=${product.id}" class="add-to-cart-btn" style="display: block; text-align: center; padding: 0.75rem; background: #0066cc; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-weight: 600; margin-top: 1rem; transition: all 0.3s;">
								أضف إلى السلة
							</a>
						</div>
					</div>
				`;
			});

			productsHTML += '</div>';
		} else {
			productsHTML = '<div style="padding: 2rem; text-align: center; color: #999;">لا توجد منتجات متطابقة مع هذه المعايير</div>';
		}

		// Update container
		productsContainer.innerHTML = '<div style="padding: 1rem 0;"><strong>عدد المنتجات: ' + data.count + '</strong></div>' + productsHTML;
		
		// Scroll to products container
		setTimeout(function() {
			productsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}, 300);
	}

	/**
	 * Display active filters
	 */
	function displayActiveFilters(sidebar, blockId, filters) {
		const container = sidebar.querySelector('#activeFilters-' + blockId);
		if (!container) return;

		const activeFilters = [];

		// Collect active filters
		if (filters.categories && filters.categories.length > 0) {
			filters.categories.forEach(function(cat) {
				activeFilters.push({
					label: cat,
					type: 'category',
					value: cat
				});
			});
		}

		if (filters.min_price > 0 || filters.max_price < 10000) {
			activeFilters.push({
				label: formatPrice(filters.min_price) + ' - ' + formatPrice(filters.max_price),
				type: 'price',
				value: 'price'
			});
		}

		if (filters.min_rating > 0) {
			activeFilters.push({
				label: filters.min_rating + ' ★ & Up',
				type: 'rating',
				value: 'rating'
			});
		}

		if (filters.on_sale) {
			activeFilters.push({
				label: 'On Sale',
				type: 'on_sale',
				value: 'on_sale'
			});
		}

		if (filters.in_stock) {
			activeFilters.push({
				label: 'In Stock',
				type: 'in_stock',
				value: 'in_stock'
			});
		}

		// Render active filters
		if (activeFilters.length > 0) {
			let html = '<div class="active-filters-list">';
			
			activeFilters.forEach(function(filter) {
				html += '<span class="active-filter-tag filter-' + filter.type + '">' +
					filter.label +
					'<button type="button" class="remove-filter" data-filter-type="' + filter.type + '" data-filter-value="' + filter.value + '">×</button>' +
					'</span>';
			});
			
			html += '</div>';
			container.innerHTML = html;

			// Setup remove filter buttons
			container.querySelectorAll('.remove-filter').forEach(function(btn) {
				btn.addEventListener('click', function(e) {
					e.preventDefault();
					removeFilter(sidebar, blockId, this.getAttribute('data-filter-type'), this.getAttribute('data-filter-value'));
				});
			});
		} else {
			container.innerHTML = '';
		}
	}

	/**
	 * Remove individual filter
	 */
	function removeFilter(sidebar, blockId, filterType, filterValue) {
		const form = sidebar.querySelector('form[data-block-id="' + blockId + '"]');
		if (!form) return;

		if (filterType === 'category') {
			const checkbox = form.querySelector('input[name="product_cat[]"][value="' + filterValue + '"]');
			if (checkbox) checkbox.checked = false;
		} else if (filterType === 'price') {
			const minPrice = form.querySelector('.min-price');
			const maxPrice = form.querySelector('.max-price');
			if (minPrice) minPrice.value = '0';
			if (maxPrice) maxPrice.value = '10000';
			updatePriceDisplay(sidebar);
		} else if (filterType === 'rating') {
			form.querySelectorAll('input[name="min_rating"]').forEach(function(input) {
				input.checked = false;
			});
		} else if (filterType === 'on_sale') {
			const checkbox = form.querySelector('input[name="on_sale"]');
			if (checkbox) checkbox.checked = false;
		} else if (filterType === 'in_stock') {
			const checkbox = form.querySelector('input[name="in_stock"]');
			if (checkbox) checkbox.checked = false;
		}

		applyFilters(sidebar, blockId);
	}

	/**
	 * Update price display
	 */
	function updatePriceDisplay(sidebar) {
		const minInput = sidebar.querySelector('.min-price');
		const maxInput = sidebar.querySelector('.max-price');
		const display = sidebar.querySelector('.price-display');

		if (minInput && maxInput && display) {
			const minVal = minInput.value || '0';
			const maxVal = maxInput.value || '10000';
			display.innerHTML = '<strong>' + formatPrice(minVal) + '</strong> <span class="separator">—</span> <strong>' + formatPrice(maxVal) + '</strong>';
		}
	}

	/**
	 * Format price for display
	 */
	function formatPrice(price) {
		return '$' + parseFloat(price).toFixed(2);
	}

	/**
	 * Escape HTML
	 */
	function escapeHtml(text) {
		const map = {
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;',
			'"': '&quot;',
			"'": '&#039;'
		};
		return text.replace(/[&<>"']/g, function(m) {
			return map[m];
		});
	}

	/**
	 * Show loading indicator
	 */
	function showLoadingIndicator(sidebar, blockId) {
		const indicator = sidebar.querySelector('#filterLoading-' + blockId);
		if (indicator) {
			indicator.style.display = 'flex';
		}
	}

	/**
	 * Hide loading indicator
	 */
	function hideLoadingIndicator(sidebar, blockId) {
		const indicator = sidebar.querySelector('#filterLoading-' + blockId);
		if (indicator) {
			indicator.style.display = 'none';
		}
	}

	/**
	 * Show error message
	 */
	function showErrorMessage(sidebar, blockId, message) {
		const indicator = sidebar.querySelector('#filterLoading-' + blockId);
		if (indicator) {
			indicator.innerHTML = '<span style="color: #ff4444;">' + escapeHtml(message) + '</span>';
			indicator.style.display = 'flex';
			setTimeout(function() {
				indicator.style.display = 'none';
			}, 3000);
		}
	}

})();
