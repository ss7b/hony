/**
 * النص الرئيسي للقالب
 */
document.addEventListener('DOMContentLoaded', function() {
	// تحسينات للتنقل المتنقل
	const mobileMenuToggle = document.querySelector('.wp-block-navigation__responsive-container-open');
	if (mobileMenuToggle) {
		mobileMenuToggle.addEventListener('click', function() {
			document.body.classList.toggle('mobile-menu-open');
		});
	}
	
	// تحسينات للأداء
	if ('loading' in HTMLImageElement.prototype) {
		const images = document.querySelectorAll('img[loading="lazy"]');
		images.forEach(img => {
			img.src = img.dataset.src;
		});
	}
});

// دعم RTL
if (document.dir === 'rtl') {
	document.documentElement.setAttribute('dir', 'rtl');
	document.documentElement.setAttribute('lang', 'ar');
}