<?php
/**
 * WPBakery Visual Composer shortcodes
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
        $color = $type = $size = $target = $href = $border_top = $include_button = $border_bottom = $title = $width = $position = $el_class = '';
        extract(shortcode_atts(array(
            'color' => 'btn',
            'include_button' => '',
            'size' => '',
            'target' => '',
            'type'	=> '',
            'href' => '',
            'shadow'		=> 'yes',
            'title' => __('Text on the button', "js_composer"),
            'position' => 'cta_align_right',
            'alt_background'	=> 'none',
            'width' => '1/1',
            'el_class' => '',
            'el_position' => '',
        ), $atts));
        $output = '';
        
        $border_class = '';
        
        if ($border_top == "yes") {
        $border_class .= 'border-top ';
        }
        if ($border_bottom == "yes") {
        $border_class .= 'border-bottom';
        }

		$width = wpb_translateColumnWidthToSpan($width);
        $el_class = $this->getExtraClass($el_class);
        
        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }

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
        
        if ($alt_background == "none" || $sidebars != "no-sidebars") {
        $output .= '<div class="wpb_impact_text wpb_content_element clearfix '.$width.' '.$position.$el_class.'">'. "\n";
        } else {
        $output .= '<div class="wpb_impact_text wpb_content_element clearfix alt-bg '.$alt_background.' '.$width.' '.$position.$el_class.'">'. "\n";
        }
        $output .= '<div class="impact-text-wrap clearfix">'. "\n";
        $output .= '<div class="wpb_call_text">'. wpb_js_remove_wpautop($content) . '</div>'. "\n";
        if ($include_button == "yes") {
        $output .= $button. "\n";
        }
        $output .= '</div>'. "\n";
        $output .= '</div> ' . $this->endBlockComment('.wpb_impact_text') . "\n";
		
		$output = $this->startRow($el_position) . $output . $this->endRow($el_position);
		
        return $output;
    }
}