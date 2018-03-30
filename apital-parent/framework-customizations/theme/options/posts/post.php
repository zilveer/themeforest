<?php if (!defined('FW')) die('Forbidden');
$post_banner = fw_get_db_settings_option('post_banner');
$subtitle = ($post_banner['enable-post-banner'] == 'yes') ? $post_banner['yes']['post-subtitle'] : '';

$options = array(
    'main' => array(
        'title' => false,
        'type'  => 'box',
        'priority' => 'high',
        'context' => 'normal',
        'options' => array(
            'media' => array(
                'title' => __('Media', 'fw'),
                'type'  => 'tab',
                'options' => array(
                    'media_type' => array(
                        'type'  => 'multi-picker',
                        'label' => false,
                        'desc'  => false,
                        'picker' => array(
                            'post_type' => array(
                                'type'  => 'select',
                                'label' => __('Post Media Type', 'fw'),
                                'desc'  => __('Select one of post media types.', 'fw'),
                                'choices' => array(
                                    'default' => __('Default (use featured image)', 'fw'),
                                    'audio' => __('Audio', 'fw'),
                                    'video' => __('Video', 'fw'),
                                    'gallery' => __('Gallery', 'fw')
                                ),
                            )
                        ),
                        'choices' => array(
                            'gallery' => array(
                                'images' => array(
                                    'type'  => 'multi-upload',
                                    'label' => __('Gallery', 'fw'),
                                    'desc'  => __('Upload gallery images', 'fw'),
                                    'images_only' => true,
                                )
                            ),
                            'video' => array(
                                'images' => array(
                                    'type'  => 'textarea',
                                    'label' => __('Video', 'fw'),
                                    'desc'  => __('Add video url from youtube or vimeo', 'fw'),
                                )
                            ),
                            'audio' => array(
                                'images' => array(
                                    'type'  => 'text',
                                    'label' => __('Audio', 'fw'),
                                    'desc'  => __('Add track link from soundcloud', 'fw'),
                                )
                            )
                        )
                    )
                ),
            ),
            'settings' => array(
                'title' => __('Settings', 'fw'),
                'type'  => 'tab',
                'options' => array(
                    'post-subtitle' => array(
                        'label' => __( 'Subtitle', 'fw' ),
                        'desc'  => __( 'Add post subtitle.', 'fw' ),
                        'type'  => 'text',
                        'value' => $subtitle
                    )
                ),
            )
        ),
    ),
);