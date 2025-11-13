/* Debug: Check if sidebar block is loading */

document.addEventListener('DOMContentLoaded', function() {
	const sidebar = document.querySelector('.wp-block-blocktheme-products-sidebar');
	if (sidebar) {
		console.log('✅ Products Sidebar Block loaded successfully');
		console.log('Sidebar element:', sidebar);
	} else {
		console.warn('⚠️ Products Sidebar Block not found on page');
	}

	const filterHeaders = document.querySelectorAll('.filter-header');
	if (filterHeaders.length > 0) {
		console.log(`✅ Found ${filterHeaders.length} filter headers`);
	}
});
