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

                // تحميل المنتجات عبر AJAX
                loadProductsViaAjax(block, button, tabPanel);

                // Dispatch custom event
                const event = new CustomEvent('tabChanged', {
                    detail: { tabIndex: index, tabButton: button, tabPanel: tabPanel }
                });
                block.dispatchEvent(event);
            });
        });

        // Set first tab as active by default and load its products
        if (tabButtons.length > 0) {
            tabButtons[0].classList.add('active');
            if (tabPanels.length > 0) {
                tabPanels[0].classList.add('active');
                // تحميل المنتجات للتبويب الأول (merge panel dataset with button dataset)
                const initialButton = tabButtons[0];
                const initialPanel = tabPanels[0];
                loadProductsViaAjax(block, initialButton, initialPanel);
            }
        }
    });

    /**
     * تحميل المنتجات عبر AJAX
     */
    function loadProductsViaAjax(block, button, tabPanel) {
        if (!tabPanel) tabPanel = block.querySelector('.tab-panel.active');
        if (!tabPanel) return;

        // إظهار مؤشر التحميل
        const productsGrid = tabPanel.querySelector('.products-grid');
        if (productsGrid) {
            productsGrid.style.opacity = '0.6';
            productsGrid.style.pointerEvents = 'none';
        }

        // read attributes (prefer button, fallback to panel, then block)
        const tabIndex = parseInt(button && button.getAttribute ? (button.getAttribute('data-tab-index') || tabPanel.getAttribute('data-tab-index')) : (tabPanel.getAttribute('data-tab-index'))) || 0;
        const tabType = (button && button.getAttribute ? (button.getAttribute('data-tab-type') || tabPanel.getAttribute('data-tab-type')) : (tabPanel.getAttribute('data-tab-type'))) || 'all';
    const categorySlug = (button && button.getAttribute ? (button.getAttribute('data-category-slug') || tabPanel.getAttribute('data-category-slug')) : (tabPanel.getAttribute('data-category-slug'))) || '';
    const categoryId = parseInt(button && button.getAttribute ? (button.getAttribute('data-category-id') || tabPanel.getAttribute('data-category-id')) : (tabPanel.getAttribute('data-category-id'))) || 0;
        const limit = parseInt(block.getAttribute('data-limit') || block.dataset.limit) || 8;
        const columns = parseInt(block.getAttribute('data-columns') || block.dataset.columns) || 4;
        const imageSize = block.getAttribute('data-image-size') || block.dataset.imageSize || 'medium';
        const showTitle = block.getAttribute('data-show-title') || block.dataset.showTitle || 'true';
        const showPrice = block.getAttribute('data-show-price') || block.dataset.showPrice || 'true';
        const showRating = block.getAttribute('data-show-rating') || block.dataset.showRating || 'true';
        const showAddToCart = block.getAttribute('data-show-add-to-cart') || block.dataset.showAddToCart || 'true';
        const showBadge = block.getAttribute('data-show-badge') || block.dataset.showBadge || 'true';
        const cardStyle = block.getAttribute('data-card-style') || block.dataset.cardStyle || 'hover-lift';
        const sortBy = block.getAttribute('data-sort-by') || block.dataset.sortBy || 'date';

        const formData = new FormData();
        formData.append('action', 'load_products_tab');
        formData.append('nonce', productsTabsAjax.nonce);
        formData.append('tab_index', tabIndex);
        formData.append('tab_type', tabType);
        formData.append('category_slug', categorySlug);
    formData.append('category_id', categoryId);
        formData.append('limit', limit);
        formData.append('columns', columns);
        formData.append('image_size', imageSize);
        formData.append('show_title', showTitle);
        formData.append('show_price', showPrice);
        formData.append('show_rating', showRating);
        formData.append('show_add_to_cart', showAddToCart);
        formData.append('show_badge', showBadge);
        formData.append('card_style', cardStyle);
        formData.append('sort_by', sortBy);

        // Request debug removed for production

        fetch(productsTabsAjax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.html) {
                // إستبدال المحتوى
                tabPanel.innerHTML = data.data.html;
                
                // إعادة تفعيل الـ WooCommerce scripts
                if (typeof jQuery !== 'undefined' && jQuery.fn.wc_cart_fragments) {
                    jQuery(document.body).trigger('wc_fragments_loaded');
                }

                // إزالة مؤشر التحميل
                if (productsGrid) {
                    productsGrid.style.opacity = '1';
                    productsGrid.style.pointerEvents = 'auto';
                }
            }
        })
        .catch(error => {
            console.error('Error loading products:', error);
            // إزالة مؤشر التحميل في حالة الخطأ
            if (productsGrid) {
                productsGrid.style.opacity = '1';
                productsGrid.style.pointerEvents = 'auto';
            }
        });
    }

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
