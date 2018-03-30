<?php
/**
 * Swift Page Builder shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

//class WPBakeryShortCode_VC_Button extends WPBakeryShortCode {
//
//    protected function content($atts, $content = null) {
//        $color = $size = $icon = $target = $href = $el_class = $title = '';
//        extract(shortcode_atts(array(
//            'color' => 'btn',
//            'size' => '',
//            'icon' => 'none',
//            'target' => '_self',
//            'href' => '',
//            'el_class' => '',
//            'title' => __('Text on the button', "js_composer")
//        ), $atts));
//        $output = '';
//        $a_class = '';
//
//        if ( $el_class != '' ) {
//            $tmp_class = explode(" ", $el_class);
//            if ( in_array("prettyphoto", $tmp_class) ) {
//                wp_enqueue_script( 'prettyphoto' );
//                wp_enqueue_style( 'prettyphoto' );
//                $a_class .= ' prettyphoto'; $el_class = str_ireplace("prettyphoto", "", $el_class);
//            }
//            if ( in_array("pull-right", $tmp_class) && $href != '' ) { $a_class .= ' pull-right'; $el_class = str_ireplace("pull-right", "", $el_class); }
//            if ( in_array("pull-left", $tmp_class) && $href != '' ) { $a_class .= ' pull-left'; $el_class = str_ireplace("pull-left", "", $el_class); }
//        }
//
//        if ( $target == 'same' || $target == '_self' ) { $target = ''; }
//        $target = ( $target != '' ) ? ' target="'.$target.'"' : '';
//
//        $color = ( $color != '' ) ? ' '.$color : '';
//        $size = ( $size != '' ) ? ' '.$size : '';
//        $icon = ( $icon != '' && $icon != 'none' ) ? ' '.$icon : '';
//        $i_icon = ( $icon != '' ) ? ' <i class="icon"> </i>' : '';
//
//        $el_class = $this->getExtraClass($el_class);
//
//        $output .= '<button class="btn wpb_button '.$color.$size.$icon.$el_class.'">'.$title.$i_icon.'</button>';
//
//        if ( $href != '' ) {
//            $output = '<a class="wpb_button_a'.$a_class.'" title="'.$title.'" href="'.$href.'"'.$target.'>' . $output . '</a>';
//        }
//
//        return $output . $this->endBlockComment('button') . "\n";
//    }
//}

class WPBakeryShortCode_impact_text extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $color = $type = $size = $target = $href = $border_top = $include_button = $border_bottom = $title = $position = $el_class = '';
        extract(shortcode_atts(array(
            'color' => 'btn',
            'include_button' => '',
            'size' => '',
            'target' => '',
            'type'	=> '',
            'href' => '',
            'border_top' => '',
            'border_bottom' => '',
            'title' => __('Text on the button', "js_composer"),
            'position' => 'cta_align_right',
            'el_class' => ''
        ), $atts));
        $output = '';
        
        $border_class = '';
        
        if ($border_top == "yes") {
        $border_class .= 'border-top ';
        }
        if ($border_bottom == "yes") {
        $border_class .= 'border-bottom';
        }

        $el_class = $this->getExtraClass($el_class);

        if ( $target == 'same' || $target == '_self' ) { $target = '_self'; }
        if ( $target != '' ) { $target = $target; }

        $size = ( $size != '' ) ? ' '.$size : '';

        $a_class = '';
        if ( $el_class != '' ) {
            $tmp_class = explode(" ", $el_class);
            if ( in_array("prettyphoto", $tmp_class) ) {
                wp_enqueue_script( 'prettyphoto' );
                wp_enqueue_style( 'prettyphoto' );
                $a_class .= ' prettyphoto'; $el_class = str_ireplace("prettyphoto", "", $el_class);
            }
        }
        
        $button = '';
        
        if (($type == "squarearrow") || ($type == "slightlyroundedarrow") || ($type == "roundedarrow")) {
        	$button = '<a class="wpb_button sf-button'.$size.' '. $color .' '. $type .'" href="'.$href.'" target="'.$target.'"><span>' . $title . '</span><span class="arrow"></span></a>';
        } else {
        	$button = '<a class="wpb_button sf-button'.$size.' '. $color .' '. $type .'" href="'.$href.'" target="'.$target.'"><span>' . $title . '</span></a>';
        }

        $output .= '<div class="wpb_impact_text wpb_content_element clearfix '.$position.$el_class.' '.$border_class.'">';
        $output .= '<div class="wpb_call_text">'. wpb_js_remove_wpautop($content) . '</div>';
        if ($include_button == "yes") {
        $output .= $button;
        }
        $output .= '</div> ' . $this->endBlockComment('.wpb_impact_text') . "\n";

        return $output;
    }
}