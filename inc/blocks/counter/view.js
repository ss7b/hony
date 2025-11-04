( function() {
    // Counter animation function
    function animateCounter(element, target, duration) {
        let start = 0;
        const increment = target / (duration / 16);
        const counterElement = element.querySelector('.counter-value');
        
        const timer = setInterval(function() {
            start += increment;
            if (start >= target) {
                counterElement.textContent = Math.floor(target);
                clearInterval(timer);
            } else {
                counterElement.textContent = Math.floor(start);
            }
        }, 16);
    }

    // Initialize counters when they come into view
    function initCounters() {
        const counters = document.querySelectorAll('.counter-block');
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    const duration = parseInt(counter.getAttribute('data-duration'));
                    animateCounter(counter, target, duration);
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(function(counter) {
            observer.observe(counter);
        });
    }

    // Initialize when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCounters);
    } else {
        initCounters();
    }
} )();