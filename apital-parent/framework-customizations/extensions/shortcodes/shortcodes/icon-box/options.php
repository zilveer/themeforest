<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'icon_box' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'divider_type'  => array(
                'type'  => 'select',
                'value' => '',
                'label' => __('Icon Box Type', 'fw'),
                'desc'  => __('Select icon box type', 'fw'),
                'choices' => array(
                    'type1' => __('Default', 'fw'),
                    'type2' => __('Icon List', 'fw'),
                    'type3' => __('Minimal', 'fw'),
                    'type4' => __('Big Icon', 'fw'),
                    'type5' => __('Carousel Slider', 'fw')
                ),
            )
        ),
        'choices' => array(
            'type1' => array(
                'title'          => array(
                    'type'  => 'text',
                    'label' => __( 'Title', 'fw' ),
                    'desc'  => __( 'Enter icon box title', 'fw' )
                ),
                'desc'          => array(
                    'type'   => 'textarea',
                    'label' => __( 'Description', 'fw' ),
                    'desc'  => __( 'Enter icon box short description', 'fw' )
                ),

                'icon_box' => array(
                    'type'  => 'multi-picker',
                    'label' => false,
                    'desc'  => false,
                    'picker' => array(
                        'icon_type'       => array(
                            'label'   => __( 'Icon Type', 'fw' ),
                            'desc'    => __( 'Choose icon type', 'fw' ),
                            'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                            'type'    => 'radio',
                            'value'   => 'awesome',
                            'choices' => array(
                                'awesome' => __( 'Font Awesome', 'fw' ),
                                'custom' => __( 'Custom Icon Class', 'fw' )
                            )
                        ),
                    ),
                    'choices' => array(
                        'awesome' => array(
                            'icon'          => array(
                                'type'  => 'icon',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Choose icon', 'fw' )
                            ),
                        ),
                        'custom' => array(
                            'icon'          => array(
                                'type'  => 'text',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Add custom icon class', 'fw' )
                            ),
                        )
                    )
                )

            ),
            'type2' => array(
                'title'          => array(
                    'type'  => 'text',
                    'label' => __( 'Title', 'fw' ),
                    'desc'  => __( 'Enter icon box title', 'fw' )
                ),
                'list'          => array(
                    'type'  => 'addable-option',
                    'label' => __( 'List', 'fw' ),
                    'desc'  => __( 'Add icon box list', 'fw' ),
                    'option' => array( 'type' => 'text' ),
                ),

                'icon_box' => array(
                    'type'  => 'multi-picker',
                    'label' => false,
                    'desc'  => false,
                    'picker' => array(
                        'icon_type'       => array(
                            'label'   => __( 'Icon Type', 'fw' ),
                            'desc'    => __( 'Choose icon type', 'fw' ),
                            'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                            'type'    => 'radio',
                            'value'   => 'awesome',
                            'choices' => array(
                                'awesome' => __( 'Font Awesome', 'fw' ),
                                'custom' => __( 'Custom Icon Class', 'fw' )
                            )
                        ),
                    ),
                    'choices' => array(
                        'awesome' => array(
                            'icon'          => array(
                                'type'  => 'icon',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Choose icon', 'fw' )
                            ),
                        ),
                        'custom' => array(
                            'icon'          => array(
                                'type'  => 'text',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Add custom icon class', 'fw' )
                            ),
                        )
                    )
                )

            ),
            'type3' => array(
                'title'          => array(
                    'type'  => 'text',
                    'label' => __( 'Title', 'fw' ),
                    'desc'  => __( 'Enter icon box title', 'fw' )
                ),
                'desc'          => array(
                    'type'   => 'textarea',
                    'label' => __( 'Description', 'fw' ),
                    'desc'  => __( 'Enter icon box short description', 'fw' )
                ),

                'icon_box' => array(
                    'type'  => 'multi-picker',
                    'label' => false,
                    'desc'  => false,
                    'picker' => array(
                        'icon_type'       => array(
                            'label'   => __( 'Icon', 'fw' ),
                            'desc'    => __( 'Choose icon type', 'fw' ),
                            'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                            'type'    => 'radio',
                            'value'   => 'awesome',
                            'choices' => array(
                                'awesome' => __( 'Font Awesome', 'fw' ),
                                'custom' => __( 'Custom Icon Class', 'fw' )
                            )
                        ),
                    ),
                    'choices' => array(
                        'awesome' => array(
                            'icon'          => array(
                                'type'  => 'icon',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Choose icon', 'fw' )
                            ),
                        ),
                        'custom' => array(
                            'icon'          => array(
                                'type'  => 'text',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Add custom icon class', 'fw' )
                            ),
                        )
                    )
                )

            ),
            'type4' => array(
                'title'          => array(
                    'type'  => 'text',
                    'label' => __( 'Title', 'fw' ),
                    'desc'  => __( 'Enter icon box title', 'fw' )
                ),
                'desc'          => array(
                    'type'   => 'textarea',
                    'label' => __( 'Description', 'fw' ),
                    'desc'  => __( 'Enter icon box short description', 'fw' )
                ),

                'icon_box' => array(
                    'type'  => 'multi-picker',
                    'label' => false,
                    'desc'  => false,
                    'picker' => array(
                        'icon_type'       => array(
                            'label'   => __( 'Icon Type', 'fw' ),
                            'desc'    => __( 'Choose icon type', 'fw' ),
                            'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                            'type'    => 'radio',
                            'value'   => 'awesome',
                            'choices' => array(
                                'awesome' => __( 'Font Awesome', 'fw' ),
                                'custom' => __( 'Custom Icon Class', 'fw' )
                            )
                        ),
                    ),
                    'choices' => array(
                        'awesome' => array(
                            'icon'          => array(
                                'type'  => 'icon',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Choose icon', 'fw' )
                            ),
                        ),
                        'custom' => array(
                            'icon'          => array(
                                'type'  => 'text',
                                'label' => __( '', 'fw' ),
                                'desc'  => __( 'Add custom icon class', 'fw' )
                            ),
                        )
                    )
                )

            ),
            'type5' => array(

                'carousel' => array(
                    'type'  => 'addable-box',
                    'value' => '',
                    'label' => __('Carousel', 'fw'),
                    'desc'  => __('Add icon boxes', 'fw'),
                    'template' => '{{=title}}',
                    'box-options' => array(
                        'title'          => array(
                            'type'  => 'text',
                            'label' => __( 'Title', 'fw' ),
                            'desc'  => __( 'Enter icon box title', 'fw' )
                        ),
                        'desc'          => array(
                            'type'  => 'textarea',
                            'label' => __( 'Description', 'fw' ),
                            'desc'  => __( 'Enter icon box short description', 'fw' )
                        ),
                        'icon_box' => array(
                            'type'  => 'multi-picker',
                            'label' => false,
                            'desc'  => false,
                            'picker' => array(
                                'icon_type'       => array(
                                    'label'   => __( 'Icon Type', 'fw' ),
                                    'desc'    => __( 'Choose icon type', 'fw' ),
                                    'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                                    'type'    => 'radio',
                                    'value'   => 'awesome',
                                    'choices' => array(
                                        'awesome' => __( 'Font Awesome', 'fw' ),
                                        'custom' => __( 'Custom Icon Class', 'fw' )
                                    )
                                ),
                            ),
                            'choices' => array(
                                'awesome' => array(
                                    'icon'          => array(
                                        'type'  => 'icon',
                                        'label' => __( '', 'fw' ),
                                        'desc'  => __( 'Choose icon', 'fw' )
                                    ),
                                ),
                                'custom' => array(
                                    'icon'          => array(
                                        'type'  => 'text',
                                        'label' => __( '', 'fw' ),
                                        'desc'  => __( 'Add custom icon class', 'fw' )
                                    ),
                                )
                            )
                        )
                    ),
                )
            ),
        )
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);