( function( blocks, element, components, editor ) {
    const { RichText, MediaUpload, InspectorControls } = editor;
    const { createElement: el } = element;
    const { PanelBody, RangeControl, Button } = components;

    blocks.registerBlockType( 'modern-fse/testimonial', {
        title: 'Testimonial',
        icon: 'format-quote',
        category: 'design',
        
        attributes: {
            content: {
                type: 'string',
                source: 'html',
                selector: '.testimonial-content'
            },
            author: {
                type: 'string',
                source: 'html',
                selector: '.testimonial-author'
            },
            position: {
                type: 'string',
                source: 'html',
                selector: '.testimonial-position'
            },
            avatarUrl: {
                type: 'string',
                source: 'attribute',
                selector: '.testimonial-avatar',
                attribute: 'src'
            },
            avatarAlt: {
                type: 'string',
                source: 'attribute',
                selector: '.testimonial-avatar',
                attribute: 'alt'
            },
            rating: {
                type: 'number',
                default: 5
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { content, author, position, avatarUrl, avatarAlt, rating } = attributes;

            function onChangeContent( newContent ) {
                setAttributes( { content: newContent } );
            }

            function onChangeAuthor( newAuthor ) {
                setAttributes( { author: newAuthor } );
            }

            function onChangePosition( newPosition ) {
                setAttributes( { position: newPosition } );
            }

            function onSelectImage( image ) {
                setAttributes( { 
                    avatarUrl: image.url,
                    avatarAlt: image.alt 
                } );
            }

            function onChangeRating( newRating ) {
                setAttributes( { rating: newRating } );
            }

            function onRemoveImage() {
                setAttributes( { 
                    avatarUrl: '',
                    avatarAlt: '' 
                } );
            }

            return el(
                'div',
                { className: 'testimonial-block' },
                
                // Inspector Controls
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Testimonial Settings' },
                        el( RangeControl, {
                            label: 'Rating',
                            value: rating,
                            onChange: onChangeRating,
                            min: 1,
                            max: 5
                        } )
                    )
                ),

                // Block Content
                el( 'div', { className: 'testimonial-inner' },
                    
                    // Avatar
                    el( 'div', { className: 'testimonial-avatar-section' },
                        ! avatarUrl ? 
                            el( MediaUpload, {
                                onSelect: onSelectImage,
                                type: 'image',
                                render: function( { open } ) {
                                    return el( Button, {
                                        onClick: open,
                                        className: 'button button-large'
                                    }, 'Upload Avatar' );
                                }
                            } ) :
                            el( 'div', { className: 'testimonial-avatar-wrapper' },
                                el( 'img', {
                                    src: avatarUrl,
                                    alt: avatarAlt,
                                    className: 'testimonial-avatar'
                                } ),
                                el( Button, {
                                    onClick: onRemoveImage,
                                    className: 'remove-image-button is-link is-destructive'
                                }, 'Remove' )
                            )
                    ),

                    // Content
                    el( 'div', { className: 'testimonial-content-section' },
                        el( RichText, {
                            tagName: 'p',
                            className: 'testimonial-content',
                            value: content,
                            onChange: onChangeContent,
                            placeholder: 'Add testimonial content...'
                        } ),

                        // Rating Stars
                        el( 'div', { className: 'testimonial-rating' },
                            Array.from( { length: 5 }, function( _, i ) {
                                return el( 'span', {
                                    className: 'star ' + ( i < rating ? 'filled' : 'empty' ),
                                    key: i
                                }, '★' );
                            } )
                        ),

                        // Author Info
                        el( 'div', { className: 'testimonial-author-info' },
                            el( RichText, {
                                tagName: 'h4',
                                className: 'testimonial-author',
                                value: author,
                                onChange: onChangeAuthor,
                                placeholder: 'Author name'
                            } ),
                            el( RichText, {
                                tagName: 'p',
                                className: 'testimonial-position',
                                value: position,
                                onChange: onChangePosition,
                                placeholder: 'Author position'
                            } )
                        )
                    )
                )
            );
        },

        save: function( { attributes } ) {
            const { content, author, position, avatarUrl, avatarAlt, rating } = attributes;

            return el(
                'div',
                { className: 'testimonial-block' },
                el( 'div', { className: 'testimonial-inner' },
                    
                    // Avatar
                    avatarUrl && el( 'div', { className: 'testimonial-avatar-section' },
                        el( 'img', {
                            src: avatarUrl,
                            alt: avatarAlt,
                            className: 'testimonial-avatar'
                        } )
                    ),

                    // Content
                    el( 'div', { className: 'testimonial-content-section' },
                        content && el( 'p', { 
                            className: 'testimonial-content' 
                        }, content ),

                        // Rating Stars
                        el( 'div', { className: 'testimonial-rating' },
                            Array.from( { length: 5 }, function( _, i ) {
                                return el( 'span', {
                                    className: 'star ' + ( i < rating ? 'filled' : 'empty' ),
                                    key: i
                                }, '★' );
                            } )
                        ),

                        // Author Info
                        el( 'div', { className: 'testimonial-author-info' },
                            author && el( 'h4', { 
                                className: 'testimonial-author' 
                            }, author ),
                            position && el( 'p', { 
                                className: 'testimonial-position' 
                            }, position )
                        )
                    )
                )
            );
        }
    } );
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor );