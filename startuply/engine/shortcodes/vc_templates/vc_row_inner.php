<?php
$output = $vsc_id = $full_width = $vsc_parallax = $vsc_bg_image = $vsc_bg_position = $vsc_bg_repeat = $vsc_bg_size = $vsc_bg_color = $vsc_text_scheme = $vsc_class = $vsc_youtube_url = $video_url = $video_raster = $css = $bg_image = $bg_color = $vsc_bg_gradient = $vsc_custom_style = '';
extract(shortcode_atts(array(
    'vsc_id'               => '',
    'vsc_bg_image'         => '',
    'full_width'           => false,
    'vsc_parallax'         => false,
    'vsc_bg_position'      => 'center center',
    'vsc_bg_repeat'        => '',
    'vsc_bg_size'          => 'cover',
    'vsc_bg_color'         => '',
    'options'               => '',
    'vsc_text_scheme'      => 'lighter-overlay',
    'vsc_class'            => '',
    'vsc_youtube_url'      => '',
    'vsc_youtube_options'  => 'left',
    'vsc_youtube_controls' => '',
    'video_raster'         => '',
    'el_class'             => '',
    'css'                  => '',
    //start v1.4.1 compatibility code
    'bg_color'             => '',
    'bg_image'             => '',
    'vsc_bg_gradient'     => '',
    'vsc_row_type'         => ''
), $atts));

wp_enqueue_script( 'wpb_composer_front_js' );

    $rnd_id = vsc_random_id(3);
    $token = wp_generate_password(5, false, false);

    // youtube video bg
    if ( $vsc_youtube_url != '' ) {
        wp_enqueue_script('vsc-yotube-video-bg', get_template_directory_uri().'/js/lib/jquery-ytp.js', array('jquery'), '1.0', true );
        wp_localize_script( 'vsc-yotube-video-bg', 'vsc_vbg_' . $token, array( 'id' => $rnd_id) );
    }

    $video_autoplay = '';
    $vsc_youtube_options = explode( ',', $vsc_youtube_options );
    if ( in_array( 'autoplay', $vsc_youtube_options ) ) $video_autoplay = 'false';
    else $video_autoplay = 'true';
    if ( in_array( 'sound', $vsc_youtube_options ) ) $video_mute = 'true';
    else $video_mute = 'false';

    $video_bg = '';
    $video_controls = '';

    if(empty($vsc_id)) {
        $vsc_id = 'vsc_row_' .  vsc_random_id(10);
    }

    $vsc_vid = '#'.$vsc_id;

    if ( $vsc_youtube_url != '' ) {
        $boolv = 'false';
        if($video_raster != '') {
            $boolv = 'true';
        }

        $video_bg = 'data-property="{videoURL: \'' . $vsc_youtube_url . '\', containment: \'' .$vsc_vid. '\', autoPlay:' .$video_autoplay. ', realfullscreen: true, stopMovieOnBlur: false, addRaster: '.$boolv.', showControls: false, mute:'.$video_mute.', startAt:0, opacity:1, gaTrack: false}"';
        $video_url = 'data-video-url="' . $vsc_youtube_url . '" ';
        $video_controls = ' data-controls="' .$vsc_youtube_controls. '" data-autoplay="' .$video_autoplay. '" data-mute="' .$video_mute. '"';
        wp_enqueue_script('ui-slider', array('jquery'), true);
    }

    //start v1.4.1 compatibility code
    if( !empty($bg_color) && empty($vsc_bg_color) ) $vsc_bg_color = $bg_color;
    if( !empty($bg_image) && empty($vsc_bg_image) ) $vsc_bg_image = $bg_image;

wp_localize_script( 'vsc-custom-parallax', 'vsc_parallax_' . $token, array( 'id' => $rnd_id) );

    if ( !empty($el_class) ) $vsc_class = $el_class;
    $vsc_class = $this->getExtraClass($vsc_class);

    $style = '';
    $parallax_bg = '';
    if ( !empty($vsc_bg_image) && ($vsc_parallax == true) ) {
        $parallax_bg = 'parallax-bag-'.$rnd_id;
    }

    $bgv_class = '';
    if ( $vsc_youtube_url != '' ) {
        $bgv_class .= 'ytp-player-'.$rnd_id;
    }

    // BG Image
    $has_image = false;
    if((int)$vsc_bg_image > 0 && ($image_url = wp_get_attachment_url( $vsc_bg_image, 'large' )) !== false) {
        $has_image = true;
        $style .= "background-image: url(".$image_url.");";
    }

	// if($vsc_bg_size == '') {$vsc_bg_size = 'cover';}
 //    if($vsc_bg_position == '') {$vsc_bg_position = 'center center';}

    if($has_image) {
        if($vsc_bg_repeat === 'no-repeat' || $vsc_bg_repeat == '') {
            $style .= "background-repeat:no-repeat;";
            $style .= "-webkit-background-size: ".$vsc_bg_size.";-moz-background-size: ".$vsc_bg_size.";-o-background-size: ".$vsc_bg_size.";background-size: ".$vsc_bg_size.";";

        } elseif($vsc_bg_repeat === 'repeat-x') {
            $style .= "background-repeat:repeat-x;";
        } elseif($vsc_bg_repeat === 'repeat-y') {
            $style .= 'background-repeat: repeat-y;';
        } elseif($vsc_bg_repeat === 'repeat') {
            $style .= 'background-repeat: repeat;';
        }
        if ($vsc_parallax){
            $style .= 'background-attachment: fixed;'; //this is controlled through parallax checkbox!
        }
        $style .= 'background-position: '.$vsc_bg_position.';';
    }

    $output_id = 'id="'.$vsc_id.'"';

    if ( !empty($vsc_bg_gradient) ) {
        $searchReplaceArray = array(
            "<br />" => "",
            "<br/>" => "",
            "\n" => "",
            "\r" => ""
        );

        $vsc_bg_gradient = str_replace( array_keys($searchReplaceArray), array_values($searchReplaceArray), $vsc_bg_gradient );
        $vsc_custom_style = ".vsc_custom_" . $vsc_id . "_" . time() . "{" . $vsc_bg_gradient . "}";
    }

    $css_classes = array(
        'vc_row',
        'wpb_row', //deprecated
        'vc_inner',
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );

    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
    //$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, get_row_css_class() . ' '. $vsc_text_scheme . $vsc_class . ' row-element' . ( ( $this->settings( 'base' ) === 'vc_row_inner' ) ? ' vsc_inner ' : '' ) . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base']);

    if ($vsc_text_scheme == 'darker-overlay') {
        $css_class .= ' light';
    } else {
        $css_class .= ' dark';
    }

    if ( $full_width == false ) {
        //start v1.4.1 compatibility code
        if($vsc_row_type == 'in_container'){
            $css_class .= ' container';
        } else if($vsc_row_type == 'fullwidth'){
            $css_class .= ' row';
            $full_width == 'stretch_row';
        } else {
            $css_class .= ' container';
        }
    } else if ( $full_width == 'stretch_row' ) {
        $css_class .= ' row';
    } else if ( $full_width == 'stretch_row_content' ) {
        $css_class .= ' clearfix';
    } else if ( $full_width == 'stretch_row_content_no_spaces' ) {
        $css_class .= ' row';
    }

    $options = explode( ',', $options );
    if ( in_array( 'window_height', $options ) ) $css_class .= ' window_height';
    if ( in_array( 'centered', $options ) ) $css_class .= ' centered-content';

    $output .= '<div '.$output_id.' '.$video_url.$video_bg.$video_controls.' class="' . $parallax_bg . ' ' . $bgv_class . ' ' . $css_class . '" style="' . $style . '"  data-token="' . $token . '">';
        if ( !empty($vsc_bg_color) || !empty($vsc_custom_style) ) {
            $output .= '<div class="row-overlay clearfix ' . vc_shortcode_custom_css_class( $vsc_custom_style, ' ' ) . '" ' . ( ( !empty($vsc_bg_color) ) ? ' style="background-color: ' . $vsc_bg_color . ';"' : '' ) . '></div>';
        }

        if ( $full_width == 'stretch_row' ) $output .= '<div class="container">';

        $output .= wpb_js_remove_wpautop($content);

        if ( $full_width == 'stretch_row' ) $output .= '</div>';

    $output .= '</div>';

    if ( !empty($vsc_custom_style) ) {
        $output .= '<style type="text/css" scoped>' . $vsc_custom_style . '</style>';
    }

    $output .= $this->endBlockComment('row');

echo $output;
