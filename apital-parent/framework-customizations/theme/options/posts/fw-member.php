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
                        'label' => __( 'Job Title', 'fw' ),
                        'desc'  => __( 'Member job title.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),

                    'fb'  => array(
                        'label' => __( 'Facebook Link', 'fw' ),
                        'desc'  => __( 'Member Facebook Link.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                    'tw'  => array(
                        'label' => __( 'Twitter Link', 'fw' ),
                        'desc'  => __( 'Member Twitter Link.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                    'lk'  => array(
                        'label' => __( 'LinkedIn Link', 'fw' ),
                        'desc'  => __( 'Member LinkedIn Link.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                    'rss'  => array(
                        'label' => __( 'Rss Link', 'fw' ),
                        'desc'  => __( 'Member Rss Link.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                ),
            )
        ),
    ),
);