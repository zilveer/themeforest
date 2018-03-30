<?php if (!defined('FW')) die('Forbidden');
$blog_banner = fw_get_db_settings_option('blog_banner');

$subtitle = ($blog_banner['enable-blog-banner'] == 'yes') ? $blog_banner['yes']['blog-subtitle'] : '';

$options = array(
    'blog-subtitle' => array(
        'label' => __( 'Subtitle', 'fw' ),
        'desc'  => __( 'Add category subtitle.', 'fw' ),
        'type'  => 'text',
        'value' => $subtitle
    )
);