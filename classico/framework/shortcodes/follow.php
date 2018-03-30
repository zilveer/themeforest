<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Follow
// **********************************************************************// 

add_shortcode('follow','et_follow_shortcode');

function et_follow_shortcode($atts) {
    extract(shortcode_atts(array(
        'title'  => '',
        'size' => 'normal',
        'target' => '_blank',
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'google' => '',
        'pinterest' => '',
        'linkedin' => '',
        'tumblr' => '',
        'youtube' => '',
        'vimeo' => '',
        'rss' => '',
        'colorfull' => '',
        'class' => '',
    ), $atts));

    $class .= ' buttons-size-'.$size;

    if( $colorfull ) {
        $class .= ' icons-colorfull';
    }

    $target = 'target="' . $target . '"';

    $output = '';

    if (!empty($title)) {
        $output .= '<h4 class="widget-title"><span>' . esc_html($title) . '</span></h4>';
    }

    $output .= '<div class="et-follow-buttons '.$class.'">';

    if( $facebook ) {
        $output .= '<a href="'. esc_url( $facebook ) .'" class="follow-facebook" '.$target.'><i class="fa fa-facebook"></i></a>';
    }

    if( $twitter ) {
        $output .= '<a href="'. esc_url( $twitter ) .'" class="follow-twitter" '.$target.'><i class="fa fa-twitter"></i></a>';
    }

    if( $instagram ) {
        $output .= '<a href="'. esc_url( $instagram ) .'" class="follow-instagram" '.$target.'><i class="fa fa-instagram"></i></a>';
    }

    if( $google ) {
        $output .= '<a href="'. esc_url( $google ) .'" class="follow-google" '.$target.'><i class="fa fa-google"></i></a>';
    }

    if( $pinterest ) {
        $output .= '<a href="'. esc_url( $pinterest ) .'" class="follow-pinterest" '.$target.'><i class="fa fa-pinterest"></i></a>';
    }

    if( $linkedin ) {
        $output .= '<a href="'. esc_url( $linkedin ) .'" class="follow-linkedin" '.$target.'><i class="fa fa-linkedin"></i></a>';
    }

    if( $tumblr ) {
        $output .= '<a href="'. esc_url( $tumblr ) .'" class="follow-tumblr" '.$target.'><i class="fa fa-tumblr"></i></a>';
    }

    if( $youtube ) {
        $output .= '<a href="'. esc_url( $youtube ) .'" class="follow-youtube" '.$target.'><i class="fa fa-youtube"></i></a>';
    }

    if( $vimeo ) {
        $output .= '<a href="'. esc_url( $vimeo ) .'" class="follow-vimeo" '.$target.'><i class="fa fa-vimeo-square"></i></a>';
    }

    if( $rss ) {
        $output .= '<a href="'. esc_url( $rss ) .'" class="follow-rss" '.$target.'><i class="fa fa-rss"></i></a>';
    }

    $output .= '</div>';

    return $output;

}


// **********************************************************************// 
// ! Register New Element: Follow
// **********************************************************************//
add_action( 'init', 'et_register_vc_follow');
if(!function_exists('et_register_vc_follow')) {
    function et_register_vc_follow() {
        if(!function_exists('vc_map')) return;
        $params = array(
          'name' => '[8THEME] Social links',
          'base' => 'follow',
          'icon' => 'icon-wpb-etheme',
          'category' => 'Eight Theme',
          'params' => array(
            array(
              "type" => "textfield",
              "heading" => "Title",
              "param_name" => "title"
            ),
            array(
              "type" => "textfield",
              "heading" => "facebook",
              "param_name" => "facebook"
            ),
            array(
              "type" => "textfield",
              "heading" => "twitter",
              "param_name" => "twitter"
            ),
            array(
              "type" => "textfield",
              "heading" => "instagram",
              "param_name" => "instagram"
            ),
            array(
              "type" => "textfield",
              "heading" => "google",
              "param_name" => "google"
            ),
            array(
              "type" => "textfield",
              "heading" => "pinterest",
              "param_name" => "pinterest"
            ),
            array(
              "type" => "textfield",
              "heading" => "linkedin",
              "param_name" => "linkedin"
            ),
            array(
              "type" => "textfield",
              "heading" => "tumblr",
              "param_name" => "tumblr"
            ),
            array(
              "type" => "textfield",
              "heading" => "youtube",
              "param_name" => "youtube"
            ),
             array(
              "type" => "textfield",
              "heading" => "vimeo",
              "param_name" => "vimeo"
            ),
              array(
              "type" => "textfield",
              "heading" => "rss",
              "param_name" => "rss"
            ),
            array(
              "type" => "checkbox",
              "heading" => __("Colorfull icons", ET_DOMAIN),
              "param_name" => "colorfull",
            ),
            array(
              "type" => "dropdown",
              "heading" => __("Link Target", ET_DOMAIN),
              "param_name" => "target",
              "value" => array( __("Blank", ET_DOMAIN) => "_blank", __("Current window", ET_DOMAIN) => "_self")
            ),
            array(
              "type" => "dropdown",
              "heading" => __("Size", ET_DOMAIN),
              "param_name" => "size",
              "value" => array( __("Normal", ET_DOMAIN) => "normal", __("Large", ET_DOMAIN) => "large", __("Small", ET_DOMAIN) => "small"),
            ),

            array(
              "type" => "textfield",
              "heading" => "Extra class name",
              "param_name" => "class"
            ),

          )
    
        );  
    
        vc_map($params);
    }
}
?>