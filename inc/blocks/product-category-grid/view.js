( function() {
    // Initialize product category grid/slider
    function initProductCategoryGrid() {
        const blocks = document.querySelectorAll('.product-category-grid-block');
        
        blocks.forEach(function(block) {
            const layoutType = block.getAttribute('data-layout') || 'grid';
            
            if (layoutType === 'slider') {
                initSlider(block);
            }
        });
    }

    // Initialize slider functionality
    function initSlider(block) {
        const sliderContainer = block.querySelector('.slider-container');
        const slides = block.querySelectorAll('.slider-item');
        const prevArrow = block.querySelector('.prev-arrow');
        const nextArrow = block.querySelector('.next-arrow');
        const dots = block.querySelectorAll('.slider-dot');
        const autoPlay = block.getAttribute('data-autoplay') === 'true';
        const autoPlaySpeed = parseInt(block.getAttribute('data-autoplay-speed')) || 3000;
        const sliderSpeed = parseInt(block.getAttribute('data-slider-speed')) || 500;
        const columns = parseInt(block.getAttribute('data-columns')) || 4;
        
        let currentSlide = 0;
        let slideCount = Math.ceil(slides.length / columns);
        let autoPlayInterval;

        // Set CSS variable for columns
        sliderContainer.style.setProperty('--columns', columns);

        // Update slider position
        function updateSlider() {
            const slideWidth = 100 / columns;
            const translateX = -currentSlide * slideWidth;
            sliderContainer.style.transform = `translateX(${translateX}%)`;
            sliderContainer.style.transition = `transform ${sliderSpeed}ms ease`;
            
            updateDots();
            updateArrows();
        }

        // Update navigation dots
        function updateDots() {
            if (dots.length > 0) {
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }
        }

        // Update arrow states
        function updateArrows() {
            if (prevArrow) {
                prevArrow.disabled = currentSlide === 0;
            }
            if (nextArrow) {
                nextArrow.disabled = currentSlide >= slideCount - 1;
            }
        }

        // Go to specific slide
        function goToSlide(slideIndex) {
            currentSlide = Math.max(0, Math.min(slideIndex, slideCount - 1));
            updateSlider();
        }

        // Next slide
        function nextSlide() {
            if (currentSlide < slideCount - 1) {
                currentSlide++;
                updateSlider();
            } else {
                goToSlide(0); // Loop to start
            }
        }

        // Previous slide
        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            } else {
                goToSlide(slideCount - 1); // Loop to end
            }
        }

        // Auto play functionality
        function startAutoPlay() {
            if (autoPlay) {
                autoPlayInterval = setInterval(nextSlide, autoPlaySpeed);
            }
        }

        function stopAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
            }
        }

        // Event listeners for arrows
        if (nextArrow) {
            nextArrow.addEventListener('click', function() {
                stopAutoPlay();
                nextSlide();
                startAutoPlay();
            });
        }

        if (prevArrow) {
            prevArrow.addEventListener('click', function() {
                stopAutoPlay();
                prevSlide();
                startAutoPlay();
            });
        }

        // Event listeners for dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                stopAutoPlay();
                goToSlide(index);
                startAutoPlay();
            });
        });

        // Pause autoplay on hover
        if (autoPlay) {
            block.addEventListener('mouseenter', stopAutoPlay);
            block.addEventListener('mouseleave', startAutoPlay);
        }

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        block.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoPlay();
        });

        block.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
            startAutoPlay();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        }

        // Keyboard navigation
        block.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
            }
        });

        // Initialize
        updateSlider();
        startAutoPlay();

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                slideCount = Math.ceil(slides.length / columns);
                updateSlider();
            }, 250);
        });
    }

    // Initialize when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProductCategoryGrid);
    } else {
        initProductCategoryGrid();
    }

    // Add to global scope for potential external control
    window.ModernFSEProductGrid = {
        init: initProductCategoryGrid
    };
} )();