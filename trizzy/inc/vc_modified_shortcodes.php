<?php
//modified shortcodes for

function vc_trizzy_image_caption_box( $atts ) {
        extract(shortcode_atts(array(
            'title' => 'Men\'s Shirts',
            'subtitle' => '25% Off Summer Styles',
            'image'=> '',
            'url'=> '',
            'target'=> '',
           
            ), $atts));
    $image = wp_get_attachment_url( $image );
$alt    = esc_attr( get_the_title( $image ) );
     if($target) {
        $output = '<a target="'.$target.'" href="'.$url.'" class="img-caption" >';
    } else {
        $output = '<a href="'.$url.'" class="img-caption" >';
    }
      $output .= '<figure>
                <img src="'.$image.'" alt="'.$alt.'" />
                <figcaption>
                    <h3>'.$title.'</h3>
                    <span>'.$subtitle.'</span>
                </figcaption>
            </figure>
        </a>';

    return $output;
}
add_shortcode('vc_image_caption_box', 'vc_trizzy_image_caption_box');

function vc_trizzy_clients_carousel($atts, $content ) {
    extract(shortcode_atts(array(
        'width' => 'sixteen',
        'logos' => ''
        ), $atts));

    $output = '';
    $width_arr = array(
        'sixteen' => 16, 'fifteen' => 15, 'fourteen' => 14, 'thirteen' => 13, 'twelve' => 12, 'eleven' => 11, 'ten' => 10, 'nine' => 9,
        'eight' => 8, 'seven' => 7, 'six' => 6, 'five' => 5, 'four' => 4, 'three' => 3
        );
    $randID = rand(1, 99); // Get unique ID for carousel
    if(empty($width)) { $width = "sixteen"; }
    $carousel_width = $width_arr[$width] - 2;
    $carousel_key_width = array_search ($carousel_width, $width_arr);
    $output .= '
    <!-- Navigation / Left -->
    <div class="one carousel column alpha"><div id="showbiz_left_'.$randID.'" class="sb-navigation-left-alt sb-navigation-left-'.$randID.'"><i class="fa fa-angle-left"></i></div></div>

    <!-- ShowBiz Carousel -->
    <div id="our-clients" class="showbiz-container '.$carousel_key_width.' carousel columns" >

    <!-- Portfolio Entries -->
    <div class="showbiz our-clients" data-left="#showbiz_left_'.$randID.'" data-right="#showbiz_right_'.$randID.'">
    <div class="overflowholder"><ul>';
    if(!empty($logos)){
        $logos = explode(',', $logos);
        foreach ($logos as $logo) {
            $logosrc = wp_get_attachment_url( $logo );
            $output .= '<li><img src="'.$logosrc.'" alt="client-logo"></li>';
        }
    }
    $output .='</ul><div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    <!-- Navigation / Right -->
    <div class="one carousel column omega"><div id="showbiz_right_'.$randID.'" class="sb-navigation-right-alt sb-navigation-right-'.$randID.'"><i class="fa fa-angle-right"></i></div></div></div>';
    return $output;
}
add_shortcode('vc_clients_carousel', 'vc_trizzy_clients_carousel');


function vc_trizzy_royal_slider($atts, $content ) {
    extract(shortcode_atts(array(
        'images' => ''
        ), $atts));

    $output = '<div class="basic-slider royalSlider rsDefault">';
        if(!empty($images)){
            $images = explode(',', $images);
            foreach ($images as $id) {
                $src = wp_get_attachment_url( $id );
                $alt    = esc_attr( get_the_title( $id ) );
                $image = get_post($id);
                $url = '';
                $caption = $image->post_excerpt;
                $output .= '<a href="'.$url.'">';
                if (!empty($caption)) {
                    $output .='<img class="rsImg" src="'.$src.'" alt="'.$alt.'" /><span class="royal-caption">'.$caption.'</span>';    # code...
                } else {
                    $output .='<img class="rsImg" src="'.$src.'" alt="'.$alt.'" />';
                }

                $output .= '</a>';
            }
        }


    $output .= '</div>';
    return $output;
}
add_shortcode('vc_trizzy_royal_slider', 'vc_trizzy_royal_slider');
?>