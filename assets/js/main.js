/**
 * Modern FSE Theme - Main JavaScript File
 * النص الرئيسي للقالب مع تحسينات للأداء
 */

( function( $ ) {
    'use strict';

    /**
     * كائن التهيئة الرئيسي
     */
    const ModernFSE = {

        /**
         * التهيئة عند تحميل الصفحة
         */
        init: function() {
            this.mobileNavigation();
            this.smoothScrolling();
            this.lazyLoading();
            this.animations();
            this.forms();
        },

        /**
         * تحسينات التنقل المتنقل
         */
        mobileNavigation: function() {
            const mobileMenuToggle = document.querySelector( '.wp-block-navigation__responsive-container-open' );
            const mobileMenuClose = document.querySelector( '.wp-block-navigation__responsive-container-close' );
            
            if ( mobileMenuToggle ) {
                mobileMenuToggle.addEventListener( 'click', function() {
                    document.body.classList.add( 'mobile-menu-open' );
                } );
            }
            
            if ( mobileMenuClose ) {
                mobileMenuClose.addEventListener( 'click', function() {
                    document.body.classList.remove( 'mobile-menu-open' );
                } );
            }
        },

        /**
         * التمرير السلس للروابط
         */
        smoothScrolling: function() {
            const links = document.querySelectorAll( 'a[href*="#"]' );
            
            links.forEach( link => {
                link.addEventListener( 'click', function( e ) {
                    const href = this.getAttribute( 'href' );
                    
                    if ( href === '#' ) return;
                    
                    const target = document.querySelector( href );
                    if ( target ) {
                        e.preventDefault();
                        target.scrollIntoView( {
                            behavior: 'smooth',
                            block: 'start'
                        } );
                    }
                } );
            } );
        },

        /**
         * تحسين تحميل الصور
         */
        lazyLoading: function() {
            if ( 'loading' in HTMLImageElement.prototype ) {
                const images = document.querySelectorAll( 'img[loading="lazy"]' );
                images.forEach( img => {
                    if ( img.dataset.src ) {
                        img.src = img.dataset.src;
                    }
                    if ( img.dataset.srcset ) {
                        img.srcset = img.dataset.srcset;
                    }
                } );
            } else {
                // Fallback for older browsers
                const script = document.createElement( 'script' );
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
                document.body.appendChild( script );
            }
        },

        /**
         * التحكم في الحركات والتفعيلات
         */
        animations: function() {
            // تفعيل الحركات عند التمرير
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver( function( entries ) {
                entries.forEach( entry => {
                    if ( entry.isIntersecting ) {
                        entry.target.classList.add( 'animated' );
                    }
                } );
            }, observerOptions );
            
            // مراقبة العناصر التي تحتاج حركة
            const animatedElements = document.querySelectorAll( '.fade-in, .slide-up, .zoom-in' );
            animatedElements.forEach( el => observer.observe( el ) );
        },

        /**
         * تحسينات النماذج
         */
        forms: function() {
            const forms = document.querySelectorAll( 'form' );
            
            forms.forEach( form => {
                form.addEventListener( 'submit', function( e ) {
                    const submitButton = this.querySelector( 'button[type="submit"], input[type="submit"]' );
                    
                    if ( submitButton ) {
                        submitButton.disabled = true;
                        submitButton.textContent = submitButton.dataset.loading || 'جاري الإرسال...';
                    }
                } );
            } );
        }
    };

    /**
     * التهيئة عند تحميل DOM
     */
    document.addEventListener( 'DOMContentLoaded', function() {
        ModernFSE.init();
    } );

    /**
     * دعم RTL
     */
    if ( document.dir === 'rtl' ) {
        document.documentElement.setAttribute( 'dir', 'rtl' );
        document.documentElement.setAttribute( 'lang', 'ar' );
    }

} )( jQuery );