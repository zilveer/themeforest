<?php
//modified shortcodes for


function vc_centum_royal_slider($atts, $content ) {
    extract(shortcode_atts(array(
        'images' => ''
        ), $atts));

    $output = '<div class="basic-slider royalSlider rsDefault">';
        if(!empty($images)){
            $images = explode(',', $images);
            foreach ($images as $id) {
                $src = wp_get_attachment_url( $id );
                $image = get_post($id);
                $url = '';
                $caption = $image->post_excerpt;
                $output .= '<a href="'.$url.'">';
                if (!empty($caption)) {
                    $output .='<img class="rsImg" src="'.$src.'" alt="" /><span class="royal-caption">'.$caption.'</span>';    # code...
                } else {
                    $output .='<img class="rsImg" src="'.$src.'" alt="" />';
                }

                $output .= '</a>';
            }
        }


    $output .= '</div>';
    return $output;
}
add_shortcode('vc_centum_royal_slider', 'vc_centum_royal_slider');
?>