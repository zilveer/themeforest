<?php

wp_enqueue_script( 'wpb_composer_front_js' );

extract(shortcode_atts(array(
    'el_class'              => '',
    'layout_structure'      => 'full',
    'bg_color'              => '',
    'border_color'          => '',
    'bg_image'              => '',
    'bg_image_portrait'     => '',
    'blend_mode'            => 'none',
    'bg_repeat'             => 'repeat',
    'bg_gradient'           => 'false',
    'gr_start'              => '#fff',
    'gr_end'                => '',
    'section_layout'        => 'full',
    'section_id'            => '',
    'sidebar'               => '',
    'bg_stretch'            => '',
    'attachment'            => 'scroll',
    'top_shadow'            => 'false',
    'bg_position'           => 'left top',
    'enable_3d'             => 'false',
    'speed_factor'          => '0.3',
    'min_height'            => 100,
    'margin_bottom'         => 0,
    'padding_top'           => '10',
    'padding_bottom'        => '10',
    'skip_arrow'            => 'false',
    'skip_arrow_skin'       => 'light',
    'video_opacity'         => '0.6',
    'bg_video'              => 'no',
    'video_source'          => 'self',
    'mp4'                   => '',
    'webm'                  => '',
    'ogv'                   => '',
    'poster_image'          => '',
    'stream_host_website'   => 'youtube',
    'stream_video_id'       => '',
    'stream_sound'          => 'false',
    'full_width'            => 'false',
    'video_mask'            => 'false',
    'video_loop'            => 'true',
    'visibility'            => '',
    'video_color_mask'      => '',
    'intro_effect'          => 'false',
    'animation'             => '',
    'full_height'           => '',
    'js_vertical_centered'  => 'false',
    'has_top_shape_divider' => 'false',
    'top_shape_style'       => 'diagonal-top',
    'top_shape_size'        => 'big',
    'top_shape_color'       => '#fff',
    'top_shape_bg_color'    => '',
    'top_shape_el_class'    => '',
    'has_bottom_shape_divider' => 'false',
    'bottom_shape_style'    => 'diagonal-bottom',
    'bottom_shape_size'     => 'big',
    'bottom_shape_color'    => '#fff',
    'bottom_shape_bg_color' => '',
    'bottom_shape_el_class' => '',

), $atts));

$output = $gradient_output = $bg_stretch_class = $top_shadow_css = $backgroud_image = $video_color_mask_css = $video_output = $page_intro_class = $overlay_opacity_ie = $bgAttachment = '';

// Wrong name chosen for parallax! sorry :(
$parallax = $enable_3d;


/*
Used for dynamic css
*/
$id = Mk_Static_Files::shortcode_id();



/*
Shape divider attributes passed to components/shape-divider.php
*/
$top_shape_atts = array(
    'style'                 => $top_shape_style,
    'size'                  => $top_shape_size,
    'shape_color'           => $top_shape_color,
    'bg_color'              => $top_shape_bg_color,
    'el_class'              => $top_shape_el_class,
);

$bottom_shape_atts = array(
    'style'                 => $bottom_shape_style,
    'size'                  => $bottom_shape_size,
    'shape_color'           => $bottom_shape_color,
    'bg_color'              => $bottom_shape_bg_color,
    'el_class'              => $bottom_shape_el_class,
);

/*
Video background attributes passed to components/video-background.php
*/
$video_atts = array(
    'video_source'          => $video_source,
    'bg_video'              => $bg_video,
    'poster_image'          => $poster_image,
    'video_loop'            => $video_loop,
    'mp4'                   => $mp4,
    'webm'                  => $webm,
    'ogv'                   => $ogv,
    'stream_host_website'   => $stream_host_website,
    'stream_video_id'       => $stream_video_id,
    'parallax'              => $parallax,
    'speed_factor'          => $speed_factor,
);

/*
Page Section overlay attributes passed to components/overlay.php
*/
$overlay_atts = array(
    'layout_structure'  => $layout_structure,
    'video_mask'        => $video_mask,
    'video_color_mask'  => $video_color_mask,
    'video_opacity'     => $video_opacity,
);


/*
Smooth scroll script must be loaded for intro effect option
*/
if($intro_effect == 'true') {
    wp_dequeue_script('SmoothScroll');
}


/*
@bart : what this condition for?
*/
if($intro_effect != 'false') {
    $visibility = '';
}


/*
Page section must have an ID for scripts tp funtion, if left blank by user we will add by default.
*/
if(!empty($section_id)) {
    $section_id = 'id="'.$section_id.'"';
} else {
    $section_id = 'id="page-section-'.$id.'"';
}


/*
Page Section background layer attributes passed to components/background-layer.php
*/
$layer_atts = array(
    'layout_structure' => $layout_structure,
    'parallax' => $parallax,
    'speed_factor' => $speed_factor,
    'id' => $id,
    'attachment' => $attachment,
    'blend_mode' => $blend_mode,
    'bg_image' => $bg_image,
    'bg_image_portrait' => $bg_image_portrait,
    'bg_color' => $bg_color,
    'bg_stretch' => $bg_stretch,
    'top_shadow' => $top_shadow
);

/*
Page Section Layout Structure : Full container attributes passed to components/layout-structure__full.php
*/
$layout_structure_full_atts = array(
    'layout_structure' => $layout_structure,
    'full_width' => $full_width,
    'content' => $content,
    'section_layout' => $section_layout,
    'sidebar' => $sidebar,
    );



/*
Page Section Layout Structure : Half container attributes passed to components/layout-structure__half.php
*/
$layout_structure_half_atts = array(
    'layout_structure'      => $layout_structure,
    'content'               => $content,
    'video_source'          => $video_source,
    'bg_video'              => $bg_video,
    'poster_image'          => $poster_image,
    'video_loop'            => $video_loop,
    'mp4'                   => $mp4,
    'webm'                  => $webm,
    'ogv'                   => $ogv,
    'stream_host_website'   => $stream_host_website,
    'stream_video_id'       => $stream_video_id,
    'parallax'              => $parallax,
    'speed_factor'          => $speed_factor,
    'bg_image' => $bg_image,
    'bg_image_portrait' => $bg_image_portrait,
);

Mk_Static_Files::addAssets('mk_page_section');