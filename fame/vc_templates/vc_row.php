<?php
$output = $el_class = $css_animation = $block_classes = $style = $data_attr = '';
$bg_color = $bg_image = $bg_position = $bg_repeat = $bg_cover = $font_color = $side_padding = '';
$padding = $full_width = $full_width_content = $parallax = $parallax_type = $parallax_speed = $margin_bottom = '';
$bg_video_ogv = $bg_video_mp4 = $bg_video_webm = $bg_video_overlay = $bg_video = $video_poster = $bg_video_position = '';
$bg_video_parallax = '';


$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//	'el_class'          => '',
//	'bg_color'          => '',
//	'bg_image'          => '',
//	'bg_position'       => '',
//	'bg_repeat'         => '',
//	'bg_cover'          => '',
//    'font_color'        => '',
//	'padding'           => '',
//	'side_padding'      => '',
//    'margin_bottom'     => '',
//    'full_width'        => '',
//    'full_width_content'=> '',
//	'parallax'          => '',
//	'parallax_type'     => '',
//	'parallax_speed'    => '1',
//    'css_animation'     => '',
//    'css'               => '',
//    'bg_video_ogv'      => '',
//    'bg_video_mp4'      => '',
//    'bg_video_webm'     => '',
//    'bg_video_overlay'  => '',
//    'bg_video_position' => '',
//    'bg_video_parallax' => 'none',
//), $atts));
wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$is_inner_row = $this->settings['base'] === 'vc_row_inner';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row vc_row-fluid '.$el_class.($is_inner_row? vc_shortcode_custom_css_class($css, ' ') : ''), $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);


if ( strlen($font_color) ) {
    $style .= 'color:'.$font_color.';';
}
if ( strlen($bg_color) ) {
    $style .= 'background-color:'.$bg_color.';';
}
if ( strlen($bg_image) ) {
    $image = wp_get_attachment_image_src( $bg_image, 'full' );
    $image = $image[0];
    $style .= 'background-image:url('.esc_url($image).');';
}
if ( strlen($bg_position) ) {
    $values = str_split($bg_position);
    $translation = array(
        'c' => 'center',
        'l' => 'left',
        'r' => 'right',
        't' => 'top',
        'b' => 'bottom',
    );

    $style .= 'background-position:'.$translation[$values[0]].' '.$translation[$values[1]].';';
}
if ( strlen($bg_repeat) ) {
    $style .= 'background-repeat: ' . $bg_repeat.';';
}
if ( $full_width === '1' ) {
    $block_classes .= $this->getExtraClass('a13_full-row');
    if($full_width_content === '1' ) {
        $block_classes .= $this->getExtraClass('a13_full-content');
    }
}
if ( strlen($padding) ) {
    $style .= 'padding-top:'.((int)$padding).'px;padding-bottom:'.((int)$padding).'px;';
}
if ( strlen($side_padding) ) {
    $style .= 'padding-left:'.((int)$side_padding).'px;padding-right:'.((int)$side_padding).'px;';
}
if ( strlen($margin_bottom) ) {
    $style .= 'margin-bottom:'.((int)$margin_bottom).'px;';
}
if ( $bg_cover === '1' ) {
    $style .= 'background-size:cover;';
}
if ( $parallax === '1' ) {
    $block_classes .= $this->getExtraClass('a13-parallax');
    $data_attr .= ' data-a13-parallax-type="'.$parallax_type.'" data-a13-parallax-speed="'.((float)$parallax_speed).'"';
}



//background video params
$bg_video_sources = array();

if ( $bg_video_mp4 ) {
    $bg_video_sources['mp4'] = $bg_video_mp4;
}
if ( $bg_video_ogv ) {
    $bg_video_sources['ogv'] = $bg_video_ogv;
}
if ( $bg_video_webm ) {
    $bg_video_sources['webm'] = $bg_video_webm;
}

if ( sizeof($bg_video_sources) ) {
    $block_classes .= $this->getExtraClass('a13_with_bg_video');

    //used parallax?
    if($bg_video_parallax !== 'none'){
        $block_classes .= $this->getExtraClass('a13-parallax-video');
        $data_attr .= ' data-a13-parallax-video-type="'.$bg_video_parallax.'"';
        //we change bg_video_position to prepare good style for moving
        $bg_video_position = $bg_video_parallax === 'tb'? 'top' : 'bottom';
    }

    if ( strlen($bg_image) ) {
        $video_poster = ' poster="'.esc_url($image).'"';
    }

    $bg_video .= '<video muted="muted" loop="loop" autoplay="" preload="auto"'.$video_poster.' class="a13-bg-video video-position-'.$bg_video_position.'">';

    $source = '<source type="%s" src="%s" />';
    foreach ( $bg_video_sources as $video_type=>$video_src ) {
        $video_type = wp_check_filetype( $video_src, wp_get_mime_types() );
        $bg_video .= sprintf( $source, $video_type['type'], esc_url( $video_src ) );

    }

    $bg_video .= '</video>';

    $overlay_style = $bg_video_overlay === 'none'? '' : ' style="background-image: url('.$bg_video_overlay.');"';
    $bg_video .= '<div class="a13_bg_video_overlay"'.$overlay_style.'></div>';
}


if ( strlen($style) ) {
    $block_classes .= $el_class;
    $style = ' style="'.esc_attr($style) . '"';
    $output .= '<div class="a13_row_container'.esc_attr($block_classes).'"'.$data_attr.$style.'>';
    $output .= $bg_video;
}



$output .= '<div class="'.$css_class.'">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');


if ( strlen($style) ) {
    $output .= '</div>';
}

echo $output;