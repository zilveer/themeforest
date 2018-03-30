<?php

/* Button
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('js_button')) {
	function js_button($atts, $content = null) {
        $args = array(
            "color"     => "btn-default",
            "size"      => "",
            "align"     => "",
            "fullwidth" => "",
            "link"      => "",
            "el_class"  => "",
        );

        extract(shortcode_atts($args, $atts));

        if( !empty( $size ) ) {
            $size = ' ' . $size;
        }

        if( !empty( $el_class ) && !empty( $fullwidth ) ) {
            $el_class = ' ' . $el_class;
        }

        $link = ( $link == '||' ) ? '' : $link;
        $link = vc_build_link( $link );

        $use_link = false;
        
        if ( strlen( $link['url'] ) > 0 ) {
            $use_link = true;
            $a_href = $link['url'];
            $a_title = $link['title'];
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }

        $output = '<div class="text-' . $align . '">';

            if( !empty( $el_class ) ) {
                $output .= '<a class="btn ' . $color . $size . ' ' . $el_class . '"';
            } else {
                $output .= '<a class="btn ' . $color . $size . '"';
            }

            $output .= ' href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '</a>';

        $output .= '</div>';
            	    
	    return $output;
	}
}
add_shortcode('js_button', 'js_button');