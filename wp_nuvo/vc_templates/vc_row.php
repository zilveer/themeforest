<?php
$output = $el_class = '';
extract(shortcode_atts(array(
            'el_class' => '',
            'dt_id' => '',
            'type' => '',
            'css' => '',
            'row_effect_backgound' => '',
            'row_responsive_large'=>'',
            'row_responsive_medium'=>'',
            'row_responsive_small'=>'',
            'row_responsive_extra_small'=>'',
            'font_color' => '',
            'row_link_color' => '',
            'row_head_color' => '',
            'row_link_color_hover' => '',
            'full_width' => '',
            'same_height' => '',
            'bg_video_color' => '#FFF',
            'bg_video_transparent' => '0',
            'bg_video_src_mp4' => '',
            'bg_video_src_ogv' => '',
            'bg_video_src_webm' => '',
            'animation' => '',
            'parallax_speed' => '',
            'enable_parallax' => ''
                ), $atts));
/* script */
wp_enqueue_style('js_composer_front');
wp_enqueue_script('wpb_composer_front_js');
wp_enqueue_style('js_composer_custom_css');

/* one page id */
if($dt_id){
    $dt_id = " id='$dt_id'";
}
$effect_backgound = '';
if($row_effect_backgound) {
    $effect_backgound .= '<div class="effect-backgound-top"><span></span></div><div class="effect-backgound-bottom"><span></span></div>';
}
$row_effect_backgound_class = '';
if($row_effect_backgound) {
    $row_effect_backgound_class .= " row-effect-backgound";
}
$data_image_height = null;

    $el_class = $this->getExtraClass($el_class);
/* Responsive */
    $responsive = '';
    if($row_responsive_large){
        $responsive .= ' hidden-lg';
    }
    if($row_responsive_medium){
        $responsive .= ' hidden-md';
    }
    if($row_responsive_small){
        $responsive .= ' hidden-sm';
    }
    if($row_responsive_extra_small){
        $responsive .= ' hidden-xs';
    }
/* Full Container */
    global $post;
    $post_full_width = get_post_meta($post->ID, 'cs_blog_layout', true);
    $cl_full_width = 'no-container';
    $enable_container = '';
    $main_full_width = '';
    if($post_full_width != 'boxed'){
        if ($full_width == 'true') {
            $cl_full_width = 'no-container';
        } else {
            $enable_container = $cl_full_width = 'container';
        }
    }
    if ($full_width == 'true') {
        $cl_full_width .= ' cs-row-fullwidth';
        $main_full_width = ' cs-row-fullwidth-wrap';
    } else {
        $cl_full_width .= ' cs-row-container';
        $main_full_width = ' cs-row-container-wrap';
    }
/* row class */
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_row clearfix ' . $el_class . $responsive . $row_effect_backgound_class . $main_full_width . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
/* Link Color */
    $link_style = "";
    $class_link = vc_shortcode_custom_css_class( $css, '.' );
    if($row_link_color || $row_link_color_hover || $row_head_color){
    	$link_style .= '<style type="text/css">';
        if($row_head_color){
            $link_style .= "".$class_link." h1,".$class_link." h2,".$class_link." h3,".$class_link." h4,".$class_link." h5,".$class_link." h6 {color: $row_head_color}";
        }
    	if($row_link_color){
    		$link_style .= "".$class_link." a{color: $row_link_color}";
    	}
    	if($row_link_color_hover){
    		$link_style .= "".$class_link." a:hover{color: $row_link_color_hover}";
    	}
    	$link_style .= '</style>';
    }
/* Text Color */
    $style = "";
    if($font_color){
    	$style = " style='color: $font_color'";
    }
/* Custom BG */
if ($type) {
    $stripe_classes = array();
    $stripe_classes[] = $type;
    /* class same height */
    if ($same_height != false && $same_height != 1) {
        $stripe_classes[] = 'ww-same-height';
    }
    /* video BG */
    $bg_video = '';
    $bg_video_args = array();
    if ($bg_video_src_mp4) {
        $bg_video_args['mp4'] = $bg_video_src_mp4;
    }
    if ($bg_video_src_ogv) {
        $bg_video_args['ogv'] = $bg_video_src_ogv;
    }
    if ($bg_video_src_webm) {
        $bg_video_args['webm'] = $bg_video_src_webm;
    }
    if (!empty($bg_video_args)) {
        $attr_strings = array(
            'loop',
            'muted',
            'preload="auto"',
            'autoplay'
        );
        $bg_video .= sprintf('<div class="stripe-video-bg"><video data-ratio="1.7777777777777777" onloadeddata="javascript:{jQuery(this).attr(\'data-ratio\',this.videoWidth/this.videoHeight)}" class="video-parallax" %s controls="controls">', join(' ', $attr_strings));
        $source = '<source type="%s" src="%s" />';
        foreach ($bg_video_args as $video_type => $video_src) {
            $video_type = wp_check_filetype($video_src, wp_get_mime_types());
            $bg_video .= sprintf($source, $video_type['type'], esc_url($video_src));
        }
        $bg_video .= '</video></div>';
        $bg_video .= '<div class="ww-video-bg" style="background:'.$bg_video_color.' ; opacity :'.$bg_video_transparent.';"></div>';

        $stripe_classes[] = 'stripe-video-wrap';
    }
    $data_attr = '';
    if ($enable_parallax) {
        $parallax_speed = floatval($parallax_speed);
        if (!$parallax_speed) {
            $parallax_speed = 0.5;
        }
        $stripe_classes[] = 'stripe-parallax-bg';
        $data_attr = ' data-stellar-background-ratio="' . $parallax_speed . '"' .$data_image_height;
    }
    if (!empty($css_class)) {
        $stripe_classes[] = $css_class;
    }
    $output .= '<div'.$dt_id.' class="' . esc_attr(implode(' ', $stripe_classes)) . '"' . $data_attr  . '>';
    $output .= $bg_video;
} else {
    $stripe_classes = array();
    if ($same_height != false && $same_height != 1) {
        $stripe_classes[] = 'ww-same-height';
    }
    if (!empty($css_class)) {
        $stripe_classes[] = $css_class;
    }
    $output .= "<div$dt_id";
    if (count($stripe_classes) > 0) {
        $output .= ' class="' . esc_attr(implode(' ', $stripe_classes)) . '"';
    }
    $output .= ">";
}

/* class animation for row */
if ($animation) {
    $css_class .= " {$animation} animate-element";
}
/* div parallax */
$output .= '' . $effect_backgound . '';
$output .= '<div class="ww-parallax-bg" style="background:'.$bg_video_color.' ; opacity :'.$bg_video_transparent.';"></div>';
$output .= '<div class="'. esc_attr($cl_full_width) . ' stripe-video-content " '.$style.'>';
/* add div row if rows = container*/
if($enable_container == 'container'){ $output .= '<div class="row">'; }
/* content */
$output .= wpb_js_remove_wpautop($content);
/* end div row */
if($enable_container == 'container'){ $output .= '</div>'; }

$output .= '</div>';
$output .= '</div>' . $this->endBlockComment('row');
$output .= $link_style;
echo $output;
