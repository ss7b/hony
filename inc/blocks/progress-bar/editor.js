( function( blocks, element, components, editor ) {
    const { RichText, InspectorControls } = editor;
    const { createElement: el } = element;
    const { PanelBody, RangeControl, ToggleControl } = components;

    blocks.registerBlockType( 'modern-fse/progress-bar', {
        title: 'Progress Bar',
        icon: 'chart-bar',
        category: 'design',
        
        attributes: {
            percentage: {
                type: 'number',
                default: 75
            },
            title: {
                type: 'string',
                source: 'html',
                selector: '.progress-title'
            },
            showPercentage: {
                type: 'boolean',
                default: true
            },
            animationDuration: {
                type: 'number',
                default: 1500
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { percentage, title, showPercentage, animationDuration } = attributes;

            return el(
                'div',
                { className: 'progress-bar-block' },
                
                // Inspector Controls
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Progress Bar Settings' },
                        el( RangeControl, {
                            label: 'Percentage',
                            value: percentage,
                            onChange: (value) => setAttributes( { percentage: value } ),
                            min: 0,
                            max: 100
                        } ),
                        el( ToggleControl, {
                            label: 'Show Percentage',
                            checked: showPercentage,
                            onChange: (value) => setAttributes( { showPercentage: value } )
                        } ),
                        el( RangeControl, {
                            label: 'Animation Duration (ms)',
                            value: animationDuration,
                            onChange: (value) => setAttributes( { animationDuration: value } ),
                            min: 500,
                            max: 3000,
                            step: 100
                        } )
                    )
                ),

                // Block Content
                el( 'div', { className: 'progress-bar-inner' },
                    el( 'div', { className: 'progress-header' },
                        el( RichText, {
                            tagName: 'span',
                            className: 'progress-title',
                            value: title,
                            onChange: (value) => setAttributes( { title: value } ),
                            placeholder: 'Skill Name'
                        } ),
                        showPercentage && el( 'span', { className: 'progress-percentage' }, `${percentage}%` )
                    ),
                    el( 'div', { className: 'progress-bar-container' },
                        el( 'div', { 
                            className: 'progress-bar-fill',
                            style: { width: `${percentage}%` }
                        } )
                    )
                )
            );
        },

        save: function( { attributes } ) {
            const { percentage, title, showPercentage, animationDuration } = attributes;

            return el(
                'div', 
                { 
                    className: 'progress-bar-block',
                    'data-percentage': percentage,
                    'data-duration': animationDuration
                },
                el( 'div', { className: 'progress-bar-inner' },
                    el( 'div', { className: 'progress-header' },
                        title && el( RichText.Content, {
                            tagName: 'span',
                            className: 'progress-title',
                            value: title
                        } ),
                        showPercentage && el( 'span', { className: 'progress-percentage' }, `${percentage}%` )
                    ),
                    el( 'div', { className: 'progress-bar-container' },
                        el( 'div', { 
                            className: 'progress-bar-fill',
                            'data-width': percentage
                        } )
                    )
                )
            );
        }
    } );
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor );