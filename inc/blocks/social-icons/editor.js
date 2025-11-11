( function() {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls } = wp.blockEditor;
    const { createElement: el } = wp.element;
    const { PanelBody, Button, SelectControl, TextControl, ToggleControl } = wp.components;

    const socialPlatforms = [
        { value: 'facebook', label: 'Facebook', icon: '📘', color: '#1877F2' },
        { value: 'twitter', label: 'Twitter', icon: '🐦', color: '#1DA1F2' },
        { value: 'instagram', label: 'Instagram', icon: '📷', color: '#E4405F' },
        { value: 'linkedin', label: 'LinkedIn', icon: '💼', color: '#0A66C2' },
        { value: 'youtube', label: 'YouTube', icon: '📺', color: '#FF0000' },
        { value: 'whatsapp', label: 'WhatsApp', icon: '💬', color: '#25D366' },
        { value: 'tiktok', label: 'TikTok', icon: '🎵', color: '#000000' },
        { value: 'snapchat', label: 'Snapchat', icon: '👻', color: '#FFFC00' }
    ];

    registerBlockType( 'modern-fse/social-icons', {
        title: 'Social Icons',
        icon: 'share',
        category: 'design',
        
        attributes: {
            icons: {
                type: 'array',
                default: []
            },
            alignment: {
                type: 'string',
                default: 'center'
            },
            size: {
                type: 'string',
                default: 'medium'
            },
            style: {
                type: 'string',
                default: 'default'
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { icons, alignment, size, style } = attributes;

            function addIcon() {
                const newIcon = {
                    platform: 'facebook',
                    url: '',
                    label: 'Follow us on'
                };
                setAttributes( { icons: [...icons, newIcon] } );
            }

            function updateIcon(index, field, value) {
                const newIcons = icons.map((icon, i) => {
                    if (i === index) {
                        return { ...icon, [field]: value };
                    }
                    return icon;
                });
                setAttributes( { icons: newIcons } );
            }

            function removeIcon(index) {
                const newIcons = icons.filter((_, i) => i !== index);
                setAttributes( { icons: newIcons } );
            }

            function getPlatformIcon(platform) {
                const platformData = socialPlatforms.find(p => p.value === platform);
                return platformData ? platformData.icon : '🔗';
            }

            return el(
                'div',
                { className: `social-icons-block alignment-${alignment} size-${size} style-${style}` },
                
                // Inspector Controls
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Social Icons Settings' },
                        el( SelectControl, {
                            label: 'Alignment',
                            value: alignment,
                            options: [
                                { label: 'Left', value: 'left' },
                                { label: 'Center', value: 'center' },
                                { label: 'Right', value: 'right' }
                            ],
                            onChange: (value) => setAttributes( { alignment: value } )
                        } ),
                        el( SelectControl, {
                            label: 'Size',
                            value: size,
                            options: [
                                { label: 'Small', value: 'small' },
                                { label: 'Medium', value: 'medium' },
                                { label: 'Large', value: 'large' }
                            ],
                            onChange: (value) => setAttributes( { size: value } )
                        } ),
                        el( SelectControl, {
                            label: 'Style',
                            value: style,
                            options: [
                                { label: 'Default', value: 'default' },
                                { label: 'Circle', value: 'circle' },
                                { label: 'Square', value: 'square' }
                            ],
                            onChange: (value) => setAttributes( { style: value } )
                        } ),
                        el( Button, {
                            onClick: addIcon,
                            isPrimary: true
                        }, 'Add Social Icon' )
                    )
                ),

                // Block Content
                el( 'div', { className: 'social-icons-inner' },
                    icons.length === 0 ? 
                        el( 'div', { className: 'social-icons-empty' },
                            el( 'p', {}, 'No social icons added yet.' ),
                            el( Button, {
                                onClick: addIcon,
                                isPrimary: true
                            }, 'Add First Icon' )
                        ) :
                        el( 'div', { className: 'social-icons-list' },
                            icons.map((icon, index) => 
                                el( 'div', { 
                                    key: index,
                                    className: 'social-icon-item' 
                                },
                                    el( 'div', { className: 'social-icon-preview' },
                                        el( 'span', { className: 'social-icon' }, 
                                            getPlatformIcon(icon.platform)
                                        )
                                    ),
                                    el( 'div', { className: 'social-icon-controls' },
                                        el( SelectControl, {
                                            label: 'Platform',
                                            value: icon.platform,
                                            options: socialPlatforms,
                                            onChange: (value) => updateIcon(index, 'platform', value)
                                        } ),
                                        el( TextControl, {
                                            label: 'URL',
                                            value: icon.url,
                                            onChange: (value) => updateIcon(index, 'url', value),
                                            placeholder: 'https://...'
                                        } ),
                                        el( Button, {
                                            onClick: () => removeIcon(index),
                                            isDestructive: true
                                        }, 'Remove' )
                                    )
                                )
                            )
                        )
                )
            );
        },

        save: function( { attributes } ) {
            const { icons, alignment, size, style } = attributes;

            function getPlatformIcon(platform) {
                const platformData = socialPlatforms.find(p => p.value === platform);
                return platformData ? platformData.icon : '🔗';
            }

            return el(
                'div',
                { className: `social-icons-block alignment-${alignment} size-${size} style-${style}` },
                el( 'div', { className: 'social-icons-inner' },
                    el( 'div', { className: 'social-icons-list' },
                        icons.map((icon, index) => 
                            icon.url && el( 'a', {
                                key: index,
                                href: icon.url,
                                className: 'social-icon-link',
                                target: '_blank',
                                rel: 'noopener noreferrer',
                                'aria-label': `Visit our ${icon.platform}`
                            },
                                el( 'span', { className: 'social-icon' }, 
                                    getPlatformIcon(icon.platform)
                                )
                            )
                        )
                    )
                )
            );
        }
    } );
} )();