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
                    'job'   => array(
                        'label' => __( 'Job', 'fw' ),
                        'desc'  => __( 'Add job title.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                ),
            )
        ),
    ),
);