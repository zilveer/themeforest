<?php if (!defined('FW')) die('Forbidden');

$options = array(
    'main' => array(
        'title' => false,
        'type'  => 'box',
        'priority' => 'high',
        'context' => 'normal',
        'options' => array(
            'settings' => array(
                'title' => __('Settings', 'fw'),
                'type'  => 'tab',
                'options' => array(
                    'page_inner_banner' => array(
                        'type'  => 'multi-picker',
                        'label' => false,
                        'desc'  => false,
                        'picker' => array(
                            'enable-page-banner' => array(
                                'type'  => 'switch',
                                'value' => 'no',
                                'label' => __('Enable Inner Banner', 'fw'),
                                'desc'  => __('Enable page inner banner', 'fw'),
                                'left-choice' => array(
                                    'value' => 'no',
                                    'label' => __('No', 'fw'),
                                ),
                                'right-choice' => array(
                                    'value' => 'yes',
                                    'label' => __('Yes', 'fw'),
                                ),
                            )
                        ),
                        'choices' => array(
                            'yes' => array(
                                'page-subtitle' => array(
                                    'label' => __( 'Subtitle', 'fw' ),
                                    'desc'  => __( 'Add page subtitle.', 'fw' ),
                                    'type'  => 'text',
                                    'value' => ''
                                ),
                                'enable-page-breadcrumbs' => array(
                                    'type'  => 'switch',
                                    'value' => 'yes',
                                    'label' => __('Enable Breadcrumbs', 'fw'),
                                    'desc'  => __('Enable page breadcrumbs.', 'fw'),
                                    'left-choice' => array(
                                        'value' => 'no',
                                        'label' => __('No', 'fw'),
                                    ),
                                    'right-choice' => array(
                                        'value' => 'yes',
                                        'label' => __('Yes', 'fw'),
                                    ),
                                ),
                            )
                        )
                    ),
                ),
            )
        ),
    ),
);