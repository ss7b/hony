document.addEventListener('DOMContentLoaded', function() {
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
			updateProductsSort(this.value);
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

	// Initialize with stored values from URL
	const params = new URLSearchParams(window.location.search);
	const storedCount = parseInt(params.get('products_per_page')) || 12;
	const storedViewMode = params.get('view_mode') || 'grid-4';
	setActiveDisplayButton(storedCount);
	setActiveViewModeButton(storedViewMode);
});
