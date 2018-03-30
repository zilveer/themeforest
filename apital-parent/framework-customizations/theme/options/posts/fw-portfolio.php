<?php if (!defined('FW')) die('Forbidden');
$post_banner = fw_get_db_settings_option('portf_post_banner');
$subtitle = ($post_banner['enable-portf_post-banner'] == 'yes') ? $post_banner['yes']['portf_post-subtitle'] : '';
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
                    'post-subtitle' => array(
                        'label' => __( 'Subtitle', 'fw' ),
                        'desc'  => __( 'Add post subtitle.', 'fw' ),
                        'type'  => 'text',
                        'value' => $subtitle
                    ),
                    'post-author' => array(
                        'label' => __( 'Author', 'fw' ),
                        'desc'  => __( 'Add project author.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                    'post-btn' => array(
                        'label' => __( 'Button Title', 'fw' ),
                        'desc'  => __( 'Add preview button title.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    ),
                    'post-preview' => array(
                        'label' => __( 'Preview Link', 'fw' ),
                        'desc'  => __( 'Add project preview URL.', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    )
                ),
            )
        ),
    ),
);