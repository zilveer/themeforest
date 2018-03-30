<?php

/*** Video Post Format ***/

$video_post_format_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Video Post Format', 'hue'),
        'name'  => 'post_format_video_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_video_type_meta',
        'type'          => 'select',
        'label'         => esc_html__('Video Type', 'hue'),
        'description'   => esc_html__('Choose video type', 'hue'),
        'parent'        => $video_post_format_meta_box,
        'default_value' => 'youtube',
        'options'       => array(
            'youtube' => esc_html__('Youtube', 'hue'),
            'vimeo'   => esc_html__('Vimeo', 'hue'),
            'self'    => esc_html__('Self Hosted', 'hue')
        ),
        'args'          => array(
            'dependence' => true,
            'hide'       => array(
                'youtube' => '#mkd_mkd_video_self_hosted_container',
                'vimeo'   => '#mkd_mkd_video_self_hosted_container',
                'self'    => '#mkd_mkd_video_embedded_container'
            ),
            'show'       => array(
                'youtube' => '#mkd_mkd_video_embedded_container',
                'vimeo'   => '#mkd_mkd_video_embedded_container',
                'self'    => '#mkd_mkd_video_self_hosted_container'
            )
        )
    )
);

$mkd_video_embedded_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $video_post_format_meta_box,
        'name'            => 'mkd_video_embedded_container',
        'hidden_property' => 'mkd_video_type_meta',
        'hidden_value'    => 'self'
    )
);

$mkd_video_self_hosted_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $video_post_format_meta_box,
        'name'            => 'mkd_video_self_hosted_container',
        'hidden_property' => 'mkd_video_type_meta',
        'hidden_values'   => array('youtube', 'vimeo')
    )
);


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_video_id_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video ID', 'hue'),
        'description' => esc_html__('Enter Video ID', 'hue'),
        'parent'      => $mkd_video_embedded_container,

    )
);


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_video_image_meta',
        'type'        => 'image',
        'label'       => esc_html__('Video Image', 'hue'),
        'description' => esc_html__('Upload video image', 'hue'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_video_webm_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video WEBM', 'hue'),
        'description' => esc_html__('Enter video URL for WEBM format', 'hue'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_video_mp4_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video MP4', 'hue'),
        'description' => esc_html__('Enter video URL for MP4 format', 'hue'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_video_ogv_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video OGV', 'hue'),
        'description' => esc_html__('Enter video URL for OGV format', 'hue'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);