/**
 * Hero Slider Animation Effects
 * Manages the animation and interaction of hero slider with feature cards
 */

(function() {
  'use strict';

  // Initialize hero slider animations when DOM is ready
  function initHeroSlider() {
    const heroContainer = document.querySelector('.hero-slider-container');
    
    if (!heroContainer) {
      return;
    }

    // Intersection Observer for animating elements when they come into view
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          // Unobserve after animation
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe all feature cards
    const featureCards = document.querySelectorAll('.wp-block-column');
    featureCards.forEach((card, index) => {
      card.style.setProperty('--card-index', index);
      observer.observe(card);
    });

    // Add hover effects to buttons
    const buttons = document.querySelectorAll('.hero-cta-button, .hero-secondary-button');
    buttons.forEach((button) => {
      const link = button.querySelector('.wp-block-button__link');
      
      if (link) {
        button.addEventListener('mouseenter', () => {
          button.style.transform = 'translateY(-3px)';
        });

        button.addEventListener('mouseleave', () => {
          button.style.transform = 'translateY(0)';
        });
      }
    });

    // Observe the entire hero section for entrance animation
    observer.observe(heroContainer);
  }

  // Run initialization when DOM is fully loaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroSlider);
  } else {
    initHeroSlider();
  }

  // Re-initialize on blocks update (for Gutenberg editor)
  if (window.wp && window.wp.blocks) {
    window.wp.hooks.addAction(
      'blocks.afterBlockInsert',
      'heroSlider/reinitialize',
      initHeroSlider
    );
  }
})();
