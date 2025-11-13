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

	// Update products display
	function updateProductsDisplay(count) {
		const grid = document.querySelector('.products-grid');
		if (grid) {
			grid.classList.add('loading');
			setActiveDisplayButton(count);
			
			// Trigger AJAX or reload with new count
			const url = new URL(window.location);
			url.searchParams.set('products_per_page', count);
			window.history.pushState({}, '', url);
			
			// You can add AJAX call here if needed
			setTimeout(() => {
				grid.classList.remove('loading');
			}, 300);
		}
	}

	// Update products sort
	function updateProductsSort(sortBy) {
		const grid = document.querySelector('.products-grid');
		if (grid) {
			grid.classList.add('loading');
			
			// Trigger AJAX or reload with new sort
			const url = new URL(window.location);
			url.searchParams.set('sort_by', sortBy);
			window.history.pushState({}, '', url);
			
			// You can add AJAX call here if needed
			setTimeout(() => {
				grid.classList.remove('loading');
			}, 300);
		}
	}

	// Initialize with stored values from URL
	const params = new URLSearchParams(window.location.search);
	const storedCount = parseInt(params.get('products_per_page')) || 12;
	setActiveDisplayButton(storedCount);
});
