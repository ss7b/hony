( function() {
    // Interactive features for frontend
    document.addEventListener( 'DOMContentLoaded', function() {
        const testimonials = document.querySelectorAll( '.testimonial-block' );
        
        testimonials.forEach( function( testimonial ) {
            // Add any frontend interactivity here
            testimonial.addEventListener( 'mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            } );
            
            testimonial.addEventListener( 'mouseleave', function() {
                this.style.transform = 'translateY(0)';
            } );
        } );
    } );
} )();