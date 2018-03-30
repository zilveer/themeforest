<?php

add_action('add_meta_boxes', 'stag_metabox_page_colors');

function stag_metabox_page_colors(){

  $meta_box = array(
    'id' => 'stag-metabox-page-colors',
    'title' => __('Custom Header Settings', 'stag'),
    'description' => __('Here you can customize custom title, custom subtitle and background settings for this post/page.', 'stag'),
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => __('Custom Title', 'stag'),
        'desc' => __('Choose title this post/page.', 'stag'),
        'id' => '_stag_custom_title',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Custom Sub Title', 'stag'),
        'desc' => __('Choose sub title this post/page.', 'stag'),
        'id' => '_stag_custom_subtitle',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Background Image', 'stag'),
        'desc' => __('Choose background image for this post/page.', 'stag'),
        'id' => '_stag_custom_background',
        'type' => 'images',
        'std' => __('Upload Images', 'stag'),
        'multiple' => "true"
        ),
      array(
        'name' => __('Background Opacity', 'stag'),
        'desc' => __('Choose background image opacity for this post/page e.g. 50 for 50% opacity. This will override the default opacity, which is 5%.', 'stag'),
        'id' => '_stag_custom_background_opacity',
        'type' => 'text',
        'std' => ''
        ),
      array(
        'name' => __('Background Color', 'stag'),
        'desc' => __('Choose background color for this post/page.', 'stag'),
        'id' => '_stag_custom_background_color',
        'type' => 'color',
        'std' => '',
        'val' => ''
        ),
      )
    );
  stag_add_meta_box($meta_box);
  $meta_box['page'] = 'portfolio';
  stag_add_meta_box($meta_box);
  $meta_box['page'] = 'post';
  stag_add_meta_box($meta_box);
}

/* Output the Colors for Posts */
function stag_custom_page_colors_output($content){
    $output = "/* Custom Page Background Colors and Images */\n";
    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'page')
    );
    if( empty($posts) ) return $content;

    foreach($posts as $post){
        $postid = $post->ID;
        $bgColor = get_post_meta($postid, '_stag_custom_background_color', true);
        $opacity = get_post_meta($postid, '_stag_custom_background_opacity', true);
        $opacityVal = intval($opacity)/100;

        if( !empty( $bgColor ) ) $output .= "#custom-background-{$postid} { background-color: {$bgColor} !important; }\n";
        if( !empty( $opacity ) ) $output .= "#custom-background-{$postid} .backstretch { opacity: {$opacityVal}; filter: progid:DXImageTransform.Microsoft.Alpha(Opacity={$opacity}) }\n";

    }


    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => array('post', 'portfolio'))
    );
    if( empty($posts) ) return $content;

    foreach($posts as $post){
        $postid = $post->ID;
        $bgColor = get_post_meta($postid, '_stag_custom_background_color', true);
        $opacity = get_post_meta($postid, '_stag_custom_background_opacity', true);
        $opacityVal = intval($opacity)/100;

        if( !empty( $bgColor ) ) $output .= "#custom-background-{$postid} { background-color: {$bgColor} !important; }\n";
        if( !empty( $opacity ) ) $output .= "#custom-background-{$postid} .backstretch { opacity: {$opacityVal}; filter: progid:DXImageTransform.Microsoft.Alpha(Opacity={$opacity}) }\n";

    }

    $content .= $output."\n\n";
    return $content;

}

add_action( 'stag_custom_styles', 'stag_custom_page_colors_output', 20);
