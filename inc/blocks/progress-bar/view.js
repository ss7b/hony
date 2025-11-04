( function() {
    // Progress bar animation function
    function animateProgressBar(element, target, duration) {
        const fillElement = element.querySelector('.progress-bar-fill');
        let startWidth = 0;
        const increment = target / (duration / 16);
        
        const timer = setInterval(function() {
            startWidth += increment;
            if (startWidth >= target) {
                fillElement.style.width = target + '%';
                clearInterval(timer);
            } else {
                fillElement.style.width = startWidth + '%';
            }
        }, 16);
    }

    // Initialize progress bars when they come into view
    function initProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar-block');
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const progressBar = entry.target;
                    const target = parseInt(progressBar.getAttribute('data-percentage'));
                    const duration = parseInt(progressBar.getAttribute('data-duration'));
                    animateProgressBar(progressBar, target, duration);
                    observer.unobserve(progressBar);
                }
            });
        }, { threshold: 0.5 });

        progressBars.forEach(function(progressBar) {
            observer.observe(progressBar);
        });
    }

    // Initialize when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProgressBars);
    } else {
        initProgressBars();
    }
} )();