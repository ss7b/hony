( function( blocks, element, components, editor ) {
    const { RichText, InspectorControls } = editor;
    const { createElement: el } = element;
    const { PanelBody, RangeControl, TextControl, SelectControl } = components;

    blocks.registerBlockType( 'modern-fse/counter', {
        title: 'Counter',
        icon: 'plus',
        category: 'design',
        
        attributes: {
            number: {
                type: 'number',
                default: 100
            },
            title: {
                type: 'string',
                source: 'html',
                selector: '.counter-title'
            },
            duration: {
                type: 'number',
                default: 2000
            },
            prefix: {
                type: 'string',
                default: ''
            },
            suffix: {
                type: 'string',
                default: '+'
            },
            icon: {
                type: 'string',
                default: '📊'
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { number, title, duration, prefix, suffix, icon } = attributes;

            return el(
                'div',
                { className: 'counter-block' },
                
                // Inspector Controls
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Counter Settings' },
                        el( RangeControl, {
                            label: 'Target Number',
                            value: number,
                            onChange: (value) => setAttributes( { number: value } ),
                            min: 1,
                            max: 1000000
                        } ),
                        el( RangeControl, {
                            label: 'Animation Duration (ms)',
                            value: duration,
                            onChange: (value) => setAttributes( { duration: value } ),
                            min: 500,
                            max: 5000,
                            step: 100
                        } ),
                        el( TextControl, {
                            label: 'Prefix',
                            value: prefix,
                            onChange: (value) => setAttributes( { prefix: value } ),
                            placeholder: 'e.g., $'
                        } ),
                        el( TextControl, {
                            label: 'Suffix',
                            value: suffix,
                            onChange: (value) => setAttributes( { suffix: value } ),
                            placeholder: 'e.g., +, %'
                        } ),
                        el( TextControl, {
                            label: 'Icon',
                            value: icon,
                            onChange: (value) => setAttributes( { icon: value } ),
                            placeholder: 'Emoji or text'
                        } )
                    )
                ),

                // Block Content
                el( 'div', { className: 'counter-inner' },
                    el( 'div', { className: 'counter-icon' }, icon ),
                    el( 'div', { className: 'counter-number-preview' },
                        el( 'span', { className: 'counter-prefix' }, prefix ),
                        number,
                        el( 'span', { className: 'counter-suffix' }, suffix )
                    ),
                    el( RichText, {
                        tagName: 'h3',
                        className: 'counter-title',
                        value: title,
                        onChange: (value) => setAttributes( { title: value } ),
                        placeholder: 'Counter Title'
                    } )
                )
            );
        },

        save: function( { attributes } ) {
            const { number, title, duration, prefix, suffix, icon } = attributes;

            return el(
                'div', 
                { 
                    className: 'counter-block',
                    'data-target': number,
                    'data-duration': duration
                },
                el( 'div', { className: 'counter-inner' },
                    icon && el( 'div', { className: 'counter-icon' }, icon ),
                    el( 'div', { className: 'counter-number' },
                        prefix && el( 'span', { className: 'counter-prefix' }, prefix ),
                        el( 'span', { className: 'counter-value' }, '0' ),
                        suffix && el( 'span', { className: 'counter-suffix' }, suffix )
                    ),
                    title && el( RichText.Content, {
                        tagName: 'h3',
                        className: 'counter-title',
                        value: title
                    } )
                )
            );
        }
    } );
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor );