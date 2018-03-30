<?php
global $wbc907_row_count;

$output = $el_class = $gap = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $p_top = $parallax_img = '';
extract(shortcode_atts(array(
    'el_class'      => '',
    'bg_image'      => '',
    'bg_color'      => '',
    'font_color'    => '',
    'padding'       => '',
    'margin_bottom' => '',
    'css'           => '',
    'text_align'    => '',
    'fancy_row'     => '',
    'band_height'   => '',
    'band_color'    => '',
    'border_color'  => '',
    'match_height'  => '',
    'vertical_center' => '',

    //row type
    'row_type'        => '',
    'type'            => '',
    'bg_select'       => '',
    'row_align'       => '',
    'no_innerpadding' => '',

    //Anchor
    'anchor' => '',

    //Full height
    'full_height' => '',

    //Parallax
    'parallax_img'      => '',
    'parallax_repeat'   => '',
    'parallax_speed'    => '',
    'parallax_overlay'  => '',
    'bg_image_postions' => '',
    'bg_image_attach'   => '',

    //video
    'cover_img'     => '',
    'ogv_url'       => '',
    'mp4_url'       => '',
    'webm_url'      => '',
    'video_overlay' => '',
    'video_mute'    => '',
    'video_quality' => '',

    //Youtube
    'youtube_url' => '',

    //padding
    'p_top'    => '',
    'p_bottom' => '',
    'p_left'   => '',
    'p_right'  => '',

    //margin
    'm_top'    => '',
    'm_bottom' => '',
    'm_left'   => '',
    'm_right'  => '',

    'gap' => '',
    'disable_element' => ''

), $atts));
// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$padding_array = array(
    'padding-top'    => $p_top,
    'padding-bottom' => $p_bottom,
    'padding-left'   => $p_left,
    'padding-right'  => $p_right,
    );

$margin_array = array(
    'margin-top'    => $m_top,
    'margin-bottom' => $m_bottom,
    'margin-left'   => $m_left,
    'margin-right'  => $m_right,
    );


$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = wbc907buildStyle($bg_image, $bg_color, $parallax_repeat, $font_color, $padding_array, $margin_array,'','', $border_color);

$add_data = '';

$add_html = '';

if (isset( $atts['gap'] ) && !empty( $atts['gap'] )) {
    $css_class .= ' vc_column-gap-'.$atts['gap'];
}

if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() || !wbc_check_inline() ) {
        $css_class .= ' vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    }
}

if(isset($full_height) && $full_height == 'yes'){
    $css_class .= ' full-height';
}

if(isset($no_innerpadding) && $no_innerpadding == 'yes'){
    $css_class .= ' no-inner-padding';
}

if(isset($match_height) && $match_height == 'yes'){
    $css_class .= ' wbc-eq-height';

    if(isset($vertical_center) && $vertical_center == 'yes'){
        $css_class .= ' wbc-vertical-center';
    }
}

if(isset($row_type) && $row_type == 'full_width'){
    $css_class .= ' full-width-section';
}
if(!empty($row_type)){
    $add_data .= 'id="'.uniqid("wbc-").'" ';
}

// Fancy Section
if($bg_select == 'bg_color_section' && !empty($fancy_row) && !empty($bg_color)){
    if(isset($fancy_row) && $fancy_row == 'down_arrow'){
        $border_add = '';
        if(!empty($border_color)){
            $border_add = vc_get_css_color( 'border-color', $border_color );
        }
        $add_html .= '<div class="arrow-down fancy-row" style="'.$border_add.'"></div>';
    }
}

if(!empty($border_color)){

    $css_class .= ' full-color-bg';
}
if($bg_select == 'bg_parallax' && !empty($parallax_img)){
    $css_class .= ' parallax-section';


    
    if( !empty( $parallax_speed ) && $parallax_speed > 0 ){
        $data_speed = $parallax_speed * 10 / 100;

        $bg_image_postions = '';
        $bg_image_attach   = '';

    }else{
        $data_speed = '0';
    }

    $style = wbc907buildStyle($parallax_img, $bg_color, $parallax_repeat, $font_color, $padding_array, $margin_array, $bg_image_postions, $bg_image_attach, $border_color);


    $add_data .= 'data-parallax-speed="'.$data_speed.'"';


}

// Parallax color overlay
if($bg_select == 'bg_parallax' && !empty($parallax_overlay)){
    $add_html .= '<div class="section-overlay" style="background-color:'.$parallax_overlay.';"></div>';
}

//video
if($bg_select == 'bg_video' && (!empty($ogv_url) || !empty($mp4_url))){

    // video color overlay
    if($bg_select == 'bg_video' && !empty($video_overlay)){
        $add_html .= '<div class="section-overlay" style="background-color:'.esc_attr($video_overlay).';"></div>';
    }elseif($bg_select == 'bg_video' && empty($video_overlay)){
        $add_html .= '<div class="section-overlay" style="background-color:transparent;"></div>';
    }

    $css_class .= ' video-section self-hosted';

    $poster_video_bg_image = '';
    $video_html = '';
    if(!empty($cover_img)) {


        $cover_img = wp_get_attachment_image_src( $cover_img, 'full' );

        $cover_img = $cover_img[0];

        $poster_video_bg_image = 'poster="'.$cover_img .'"';

        $video_html .= '<div class="mobile-video-image" style="background:url(\''.esc_attr($cover_img).'\');"></div>';
    }
    
    

    if(wp_script_is( 'wbc-mb-YTPlayer', 'enqueued' ) && !wp_script_is( 'wp-mediaelement', 'enqueued' )){
        
        wp_dequeue_script( 'wbc-mb-YTPlayer' );

        wp_enqueue_script('wp-mediaelement');
        wp_enqueue_style('wp-mediaelement');

        wp_enqueue_script('wbc-mb-YTPlayer');

    }else{

        wp_enqueue_script('wp-mediaelement');
        wp_enqueue_style('wp-mediaelement');
    }


    $video_html .= '<div class="wbc-video-bg">';

    $video_mute = (isset($video_mute) && $video_mute == 1) ? " muted " : " ";

    $video_html .= '<video class="video-background"'.$video_mute.'controls="controls" width="1700" height="970" '.$poster_video_bg_image.' preload="auto" loop autoplay>';

    if(!empty($mp4_url)) $video_html  .= '<source src="'.esc_attr( $mp4_url ).'" type="video/mp4">';
    if(!empty($webm_url)) $video_html .= '<source src="'.esc_attr( $webm_url ).'" type="video/webm">';
    if(!empty($ogv_url)) $video_html  .= '<source src="'.esc_attr( $ogv_url ).'" type="video/ogv">';

    $video_html .='</video>';
    $video_html .='</div>';

    $add_html .= $video_html;

}


//youtube
if($bg_select == 'bg_youtube_video' && !empty($youtube_url) ){
    $youtube_url = wbc907_get_video_type( $youtube_url );


    if( !empty( $video_overlay ) ){
        $add_html .= '<div class="section-overlay" style="background-color:'.esc_attr( $video_overlay ).';"></div>';
    }else{
        $add_html .= '<div class="section-overlay" style="background-color:transparent;"></div>';
    }

    $css_class .= ' video-section youtube-section';

    $poster_video_bg_image = '';
    $video_html = '';

    if(!empty($cover_img)) {

        $cover_img = wp_get_attachment_image_src($cover_img,'full');

        $cover_img = $cover_img[0];

        $poster_video_bg_image = 'poster="'.esc_attr( $cover_img ).'"';

        $video_html .= '<div class="mobile-video-image" style="background:url(\''.esc_attr( $cover_img ).'\');"></div>';
    }

    wp_enqueue_script( 'wbc-mb-YTPlayer' );
    $video_mute = (isset($video_mute) && $video_mute == 1) ? "true" : "false";
    $data_array = array(
            'video-id'  => $youtube_url ,
            'auto-play' => 'true',
            'loop'      => 'true',
            'controls'  => 'false',
            'quality'   => $video_quality, //or “small”, “medium”, “large”, “hd720”, “hd1080”, “highres”
            'mute'      => $video_mute,
        );

    $data_tags = ' ';
    foreach ($data_array as $key => $value) {

        if(!empty($value) || is_numeric($value)){
            $data_tags .='data-'.$key.'="'.$value.'" ';
        }
    }

    $video_html .= '<div id="'.uniqid().'" class="wbc-video-bg youtube-video" '.$data_tags.'>';

    


    $video_html .='</div>';

    $add_html .= $video_html;

}

if(($bg_select == 'bg_parallax' || $bg_select == 'bg_video' || $parallax_repeat == 'cover') && empty($parallax_repeat) || $parallax_repeat == 'cover'){
    $css_class .= ' bg-cover-stretch';
}

if(isset($fancy_row) && $fancy_row == 'bottom_band'){
    $band_style = '';

    if(isset($band_color) && !empty($band_color)){
        $band_style = vc_get_css_color( 'background-color', $band_color );
    }

    if(isset($band_height) && !empty($band_height) && is_numeric($band_height)){
        $band_style = $band_style.' height:'.$band_height.'px;';
    }

    $band_html = '<div class="wbc907-band" style="'.$band_style.'"></div>';

    $add_html .= $band_html;
}

$output .= '<div '.$add_data.' class="'.$css_class.'"'.$style.'>';

$output .= $add_html;

if(!empty($anchor)) $output .= '<span class="anchor-link" id="'.esc_attr( $anchor ).'"></span>';

if($type == 'container' && $row_type == 'full_width') $output .= '<div class="container"><div class="row row-inner">';

if(isset($row_align) && !empty($row_align) && $row_align != 'default' && isset($full_height) && $full_height == 'yes'){
    $output .= '<div class="wbc-table-align clearfix"><div class="wbc-table-cell-align clearfix '.esc_attr(str_replace('_', '-', $row_align)).'">';
}
$output .= wpb_js_remove_wpautop( $content );

if(isset($row_align) && !empty($row_align) && $row_align != 'default' && isset($full_height) && $full_height == 'yes'){
    $output .= '</div></div>';
}

if($type == 'container' && $row_type == 'full_width') $output .= '</div></div>';

$output .= '</div>'.$this->endBlockComment('row');

if($this->settings('base')==='vc_row' && ($row_type == 'full_width' || $row_type == 'standard')){
    $wbc907_row_count++;
}


echo !empty( $output ) ? $output : '';

?>