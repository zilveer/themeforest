<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options            = array(
    'list_items' => array(
        'type'          => 'addable-popup',
        'label'         => __( 'List Items', 'fw' ),
        'desc'          => __( 'Add list items', 'fw' ),
        'template'      => '{{=item}}',
        'popup-options' => array(
            'sublist_group'  => array(
                'type'    => 'group',
                'options' => array(
                    'item'          => array(
                        'label' => __( 'Item', 'fw' ),
                        'desc'  => __( 'Enter an item in list', 'fw' ),
                        'type'  => 'text',
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
                                    'desc'  => __( 'Choose box icon', 'fw' )
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
                    ),

                    'sublist_items' => array(
                        'type'          => 'addable-popup',
                        'label'         => __( 'Sublist Items', 'fw' ),
                        'desc'          => __( 'Add sublist items', 'fw' ),
                        'template'      => '{{=subitem}}',
                        'popup-options' => array(
                            'subitem'        => array(
                                'label' => __( 'Sublist Item', 'fw' ),
                                'desc'  => __( 'Enter a sublist item', 'fw' ),
                                'type'  => 'text',
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
                                            'desc'  => __( 'Choose box icon', 'fw' )
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
                            ),
                        ),
                    ),
                )
            ),
        ),
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);