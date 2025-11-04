( function( blocks, element, components, editor ) {
    const { RichText, InspectorControls, InnerBlocks } = editor;
    const { createElement: el } = element;
    const { PanelBody, RangeControl, Button, ToggleControl, TextControl, SelectControl } = components;

    blocks.registerBlockType( 'modern-fse/pricing-table', {
        title: 'Pricing Table',
        icon: 'money',
        category: 'design',
        
        attributes: {
            plans: {
                type: 'array',
                default: []
            },
            columns: {
                type: 'number',
                default: 3
            },
            highlightedPlan: {
                type: 'number',
                default: -1
            }
        },

        edit: function( { attributes, setAttributes } ) {
            const { plans, columns, highlightedPlan } = attributes;

            function addPlan() {
                const newPlan = {
                    title: 'New Plan',
                    price: '29',
                    period: 'month',
                    features: ['Feature 1', 'Feature 2', 'Feature 3'],
                    buttonText: 'Get Started',
                    buttonUrl: '#',
                    isPopular: false
                };
                setAttributes( { plans: [...plans, newPlan] } );
            }

            function updatePlan(index, field, value) {
                const newPlans = plans.map((plan, i) => {
                    if (i === index) {
                        return { ...plan, [field]: value };
                    }
                    return plan;
                });
                setAttributes( { plans: newPlans } );
            }

            function updatePlanFeature(index, featureIndex, value) {
                const newPlans = plans.map((plan, i) => {
                    if (i === index) {
                        const newFeatures = [...plan.features];
                        newFeatures[featureIndex] = value;
                        return { ...plan, features: newFeatures };
                    }
                    return plan;
                });
                setAttributes( { plans: newPlans } );
            }

            function addFeature(index) {
                const newPlans = plans.map((plan, i) => {
                    if (i === index) {
                        return { ...plan, features: [...plan.features, 'New Feature'] };
                    }
                    return plan;
                });
                setAttributes( { plans: newPlans } );
            }

            function removeFeature(planIndex, featureIndex) {
                const newPlans = plans.map((plan, i) => {
                    if (i === planIndex) {
                        const newFeatures = plan.features.filter((_, j) => j !== featureIndex);
                        return { ...plan, features: newFeatures };
                    }
                    return plan;
                });
                setAttributes( { plans: newPlans } );
            }

            function removePlan(index) {
                const newPlans = plans.filter((_, i) => i !== index);
                setAttributes( { plans: newPlans } );
            }

            return el(
                'div',
                { className: 'pricing-table-block' },
                
                // Inspector Controls
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Pricing Settings' },
                        el( RangeControl, {
                            label: 'Number of Columns',
                            value: columns,
                            onChange: (value) => setAttributes( { columns: value } ),
                            min: 1,
                            max: 4
                        } ),
                        el( Button, {
                            onClick: addPlan,
                            isPrimary: true
                        }, 'Add New Plan' )
                    )
                ),

                // Block Content
                el( 'div', { 
                    className: `pricing-table-inner pricing-columns-${columns}` 
                },
                    plans.length === 0 ? 
                        el( 'div', { className: 'pricing-table-empty' },
                            el( 'p', {}, 'No pricing plans added yet.' ),
                            el( Button, {
                                onClick: addPlan,
                                isPrimary: true
                            }, 'Add First Plan' )
                        ) :
                        plans.map((plan, index) => 
                            el( 'div', { 
                                key: index,
                                className: `pricing-plan ${highlightedPlan === index ? 'highlighted' : ''}` 
                            },
                                // Popular Badge
                                el( ToggleControl, {
                                    label: 'Popular Plan',
                                    checked: plan.isPopular,
                                    onChange: (value) => updatePlan(index, 'isPopular', value)
                                } ),

                                // Plan Title
                                el( RichText, {
                                    tagName: 'h3',
                                    className: 'plan-title',
                                    value: plan.title,
                                    onChange: (value) => updatePlan(index, 'title', value),
                                    placeholder: 'Plan Title'
                                } ),

                                // Price
                                el( 'div', { className: 'plan-price-section' },
                                    el( TextControl, {
                                        label: 'Price',
                                        value: plan.price,
                                        onChange: (value) => updatePlan(index, 'price', value),
                                        placeholder: '29'
                                    } ),
                                    el( SelectControl, {
                                        label: 'Period',
                                        value: plan.period,
                                        options: [
                                            { label: 'Per Month', value: 'month' },
                                            { label: 'Per Year', value: 'year' },
                                            { label: 'One Time', value: 'once' }
                                        ],
                                        onChange: (value) => updatePlan(index, 'period', value)
                                    } )
                                ),

                                // Features List
                                el( 'div', { className: 'plan-features' },
                                    el( 'strong', {}, 'Features:' ),
                                    plan.features.map((feature, featureIndex) => 
                                        el( 'div', { 
                                            key: featureIndex,
                                            className: 'feature-row' 
                                        },
                                            el( TextControl, {
                                                value: feature,
                                                onChange: (value) => updatePlanFeature(index, featureIndex, value),
                                                placeholder: 'Feature description'
                                            } ),
                                            el( Button, {
                                                onClick: () => removeFeature(index, featureIndex),
                                                isDestructive: true,
                                                isSmall: true
                                            }, 'Remove' )
                                        )
                                    ),
                                    el( Button, {
                                        onClick: () => addFeature(index),
                                        isSmall: true
                                    }, 'Add Feature' )
                                ),

                                // Button
                                el( 'div', { className: 'plan-button-section' },
                                    el( TextControl, {
                                        label: 'Button Text',
                                        value: plan.buttonText,
                                        onChange: (value) => updatePlan(index, 'buttonText', value),
                                        placeholder: 'Get Started'
                                    } ),
                                    el( TextControl, {
                                        label: 'Button URL',
                                        value: plan.buttonUrl,
                                        onChange: (value) => updatePlan(index, 'buttonUrl', value),
                                        placeholder: '#'
                                    } )
                                ),

                                // Remove Plan Button
                                el( Button, {
                                    onClick: () => removePlan(index),
                                    isDestructive: true
                                }, 'Remove Plan' )
                            )
                        )
                )
            );
        },

        save: function( { attributes } ) {
            const { plans, columns, highlightedPlan } = attributes;

            return el(
                'div',
                { className: `pricing-table-block pricing-columns-${columns}` },
                el( 'div', { className: 'pricing-table-inner' },
                    plans.map((plan, index) => 
                        el( 'div', { 
                            key: index,
                            className: `pricing-plan ${highlightedPlan === index ? 'highlighted' : ''} ${plan.isPopular ? 'popular' : ''}` 
                        },
                            plan.isPopular && el( 'div', { className: 'popular-badge' }, 'الأكثر شيوعاً' ),
                            
                            el( RichText.Content, {
                                tagName: 'h3',
                                className: 'plan-title',
                                value: plan.title
                            } ),

                            el( 'div', { className: 'plan-price' },
                                el( 'span', { className: 'price-amount' }, plan.price ),
                                el( 'span', { className: 'price-period' }, 
                                    plan.period === 'month' ? '/شهر' : 
                                    plan.period === 'year' ? '/سنة' : 'مرة واحدة'
                                )
                            ),

                            el( 'ul', { className: 'plan-features' },
                                plan.features.map((feature, featureIndex) => 
                                    feature && el( 'li', { key: featureIndex }, feature )
                                )
                            ),

                            el( 'div', { className: 'plan-button' },
                                el( 'a', {
                                    href: plan.buttonUrl,
                                    className: 'button'
                                }, plan.buttonText )
                            )
                        )
                    )
                )
            );
        }
    } );
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor );