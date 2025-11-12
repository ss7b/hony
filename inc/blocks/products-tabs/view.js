document.addEventListener('DOMContentLoaded', function() {
    // Initialize all product tabs blocks
    const tabsBlocks = document.querySelectorAll('.products-tabs-block');

    tabsBlocks.forEach(block => {
        const tabButtons = block.querySelectorAll('.tab-button');
        const tabPanels = block.querySelectorAll('.tab-panel');
        const animationType = block.dataset.animationType || 'fade';
        const animationSpeed = parseInt(block.dataset.animationSpeed) || 300;

        tabButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                tabButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');

                // Get tab panel and merge datasets (panel values as fallback)
                const tabPanel = tabPanels[index];
                const tabData = Object.assign({}, tabPanel.dataset || {}, button.dataset || {});
                
                // إزالة الـ active class من جميع الـ panels
                tabPanels.forEach(panel => {
                    panel.classList.remove('active');
                    panel.style.animation = 'none';
                });

                // إضافة active class للـ panel الحالي
                tabPanel.classList.add('active');

                // حل الـ animation
                void tabPanel.offsetWidth;
                tabPanel.style.animation = `tabAnimation-${animationType} ${animationSpeed}ms ease-in-out`;

                // No AJAX: all tabs are rendered server-side. Just activate the panel.

                // Dispatch custom event
                const event = new CustomEvent('tabChanged', {
                    detail: { tabIndex: index, tabButton: button, tabPanel: tabPanel }
                });
                block.dispatchEvent(event);
            });
        });

        // Set first tab as active by default
        if (tabButtons.length > 0) {
            tabButtons[0].classList.add('active');
            if (tabPanels.length > 0) {
                tabPanels[0].classList.add('active');
            }
        }
    });

    // No AJAX loading function required when all tabs are rendered server-side.

    // Smooth scroll to products on tab change
    document.addEventListener('tabChanged', function(e) {
        try {
            const tabPanel = e && e.detail ? e.detail.tabPanel : null;
            const blockEl = tabPanel && tabPanel.closest ? tabPanel.closest('.products-tabs-block') : null;
            if (blockEl) {
                blockEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        } catch (err) {
            // ignore
        }
    });

    // Add hover effects to product cards (guard against non-Element targets)
    document.addEventListener('mouseenter', function(e) {
        try {
            let node = e.target;
            // climb to an Element if event target is a text node
            while (node && node.nodeType !== 1) node = node.parentNode;
            const card = node && node.closest ? node.closest('.product-card') : null;
            if (card) card.style.transform = 'translateY(-8px)';
        } catch (err) {
            // ignore
        }
    }, true);

    document.addEventListener('mouseleave', function(e) {
        try {
            let node = e.target;
            while (node && node.nodeType !== 1) node = node.parentNode;
            const card = node && node.closest ? node.closest('.product-card') : null;
            if (card) card.style.transform = 'translateY(0)';
        } catch (err) {
            // ignore
        }
    }, true);

    // Lazy load images in tabs
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('.products-tabs-block img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
});
