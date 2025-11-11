( function() {
    'use strict';

    function initProductCategoryGrids() {
        const blocks = document.querySelectorAll('.product-category-grid-block');
        
        blocks.forEach(function(block) {
            const layoutType = block.getAttribute('data-layout') || 'grid';
            
            if (layoutType === 'slider') {
                initSwiperSlider(block);
            }
        });
    }

    function initSwiperSlider(block) {
        const container = block.querySelector('.swiper-container');
        
        if (!container) return;

        // الحصول على البيانات من خصائص البيانات
        const autoplay = container.dataset.autoplay === 'true';
        const autoplaySpeed = parseInt(container.dataset.autoplaySpeed) || 5000;
        const slideSpeed = parseInt(container.dataset.sliderSpeed) || 800;
        const showArrows = container.dataset.showArrows === 'true';
        const showDots = container.dataset.showDots === 'true';
        const spaceBetween = parseInt(container.dataset.spaceBetween) || 20;
        const loop = container.dataset.loop === 'true';
        const columns = parseInt(container.dataset.columns) || 3;

        // إعدادات Swiper
        const swiperOptions = {
            slidesPerView: 1,
            spaceBetween: spaceBetween,
            autoplay: autoplay ? {
                delay: autoplaySpeed,
                disableOnInteraction: false,
            } : false,
            speed: slideSpeed,
            loop: loop,
            breakpoints: {
                480: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: Math.min(2, columns)
                },
                1024: {
                    slidesPerView: Math.min(3, columns)
                },
                1440: {
                    slidesPerView: columns
                }
            }
        };

        // إضافة الأسهم
        if (showArrows) {
            const prevArrow = block.querySelector('.swiper-prev');
            const nextArrow = block.querySelector('.swiper-next');
            
            if (prevArrow && nextArrow) {
                swiperOptions.navigation = {
                    prevEl: prevArrow,
                    nextEl: nextArrow,
                };
            }
        }

        // إضافة النقاط
        if (showDots) {
            const paginationEl = block.querySelector('.swiper-pagination');
            
            if (paginationEl) {
                swiperOptions.pagination = {
                    el: paginationEl,
                    clickable: true,
                    type: 'bullets',
                };
            }
        }

        // تهيئة Swiper إذا كانت المكتبة متاحة
        if (typeof Swiper !== 'undefined') {
            new Swiper(container, swiperOptions);
        } else {
            console.warn('Swiper library is not loaded');
        }
    }

    // Initialize when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProductCategoryGrids);
    } else {
        initProductCategoryGrids();
    }

    // Add to global scope for potential external control
    window.ModernFSEProductGrid = {
        init: initProductCategoryGrids
    };
} )();