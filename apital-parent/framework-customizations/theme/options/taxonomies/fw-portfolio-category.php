<?php if (!defined('FW')) die('Forbidden');
$portf_banner = fw_get_db_settings_option('portf_banner');

$subtitle = ($portf_banner['enable-portf-banner'] == 'yes') ? $portf_banner['yes']['portf-subtitle'] : '';

$options = array(
    'blog-subtitle' => array(
        'label' => __( 'Subtitle', 'fw' ),
        'desc'  => __( 'Add category subtitle.', 'fw' ),
        'type'  => 'text',
        'value' => $subtitle
    )
);