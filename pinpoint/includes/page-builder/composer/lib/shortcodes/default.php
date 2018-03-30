<?php
/**
 */

/* This shortcode is used for columns and text containers output
---------------------------------------------------------- */

class WPBakeryShortCode_VC_Column_text extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $pb_margin_bottom = $pb_border_bottom = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'pb_margin_bottom' => 'no',
        	'pb_border_bottom' => 'no',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $el_class .= ' wpb_text_column';
        
        if ($pb_margin_bottom == "yes") {
        $el_class .= ' pb-margin-bottom';
        }
        if ($pb_border_bottom == "yes") {
        $el_class .= ' pb-border-bottom';
        }

        $output .= "\n\t".'<div class="wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper clearfix">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_text_heading">'.$title.'</h3></div>' : '';
        $output .= "\n\t\t\t".do_shortcode($content);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}


class WPBakeryShortCode_box extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $type = $pb_margin_bottom = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'type'	=> '',
        	'pb_margin_bottom' => 'no',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $el_class .= ' wpb_box_text';
        $el_class .= ' '.$type;
        
        if ($pb_margin_bottom == "yes") {
        $el_class .= ' pb-margin-bottom';
        }

        $output .= "\n\t".'<div class="wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_text_heading">'.$title.'</h3></div>' : '';
        $output .= "\n\t\t\t";
        $output .= '<div class="box-content-wrap">'.do_shortcode($content).'</div>';
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}



class WPBakeryShortCode_divider extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $with_line = $type = $text = '';
        extract(shortcode_atts(array(
            'with_line' => '',
            'type'		=> '',
            'text' => ''
        ), $atts));
        $output = '';
        if ($type == "go_to_top") {
        $output .= '<div class="wpb_divider '. $type .' wpb_content_element ">';
        $output .= '<a class="animate-top" href="#">'. $text .'</a>';
        } else if ($type == "go_to_top_icon1") {
        $output .= '<div class="wpb_divider '. $type .' wpb_content_element ">';
        $output .= '<a class="animate-top" href="#"><i class="icon-arrow-up"></i></a>';
        } else if ($type == "go_to_top_icon2") {
        $output .= '<div class="wpb_divider '. $type .' wpb_content_element ">';
        $output .= '<a class="animate-top" href="#">'. $text .'<i class="icon-arrow-up"></i></a>';
        } else { 
        $output .= '<div class="wpb_divider '. $type .' wpb_content_element ">';
        }
        $output .= '</div>'.$this->endBlockComment('divider')."\n";
        return $output;
    }
}


class WPBakeryShortCode_blank_spacer extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $height = '';
        extract(shortcode_atts(array(
            'height' => ''
        ), $atts));
        
        $output = '';
        $output .= '<div class="blank_spacer" style="height:'.$height.';">';
        $output .= '</div>'.$this->endBlockComment('divider')."\n";
        return $output;
    }
}


class WPBakeryShortCode_VC_Text_separator extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $title = $title_align = $el_class = '';
        extract(shortcode_atts(array(
            'title' => __("Title", "js_composer"),
            'title_align' => 'separator_align_center',
            'el_class' => ''
        ), $atts));
        $output = '';
        $extra = '';

        $output .= '<div class="vc_text_separator wpb_content_element '.$title_align.' '.$el_class.'"><div>'.$title.'</div></div>'.$this->endBlockComment('separator')."\n";

        return $output;
    }
}

class WPBakeryShortCode_VC_Message extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $color = '';
        extract(shortcode_atts(array(
            'color' => 'alert-info',
        ), $atts));
        $output = '';
        if ($color == "alert-block") $color = "";

        $output .= '<div class="alert wpb_content_element '.$color.'"><div class="messagebox_text">'.wpb_js_remove_wpautop($content).'</div></div>'.$this->endBlockComment('alert box')."\n";
        //$output .= '<div class="wpb_vc_messagebox message '.$color.'"><div class="messagebox_text">'.wpb_js_remove_wpautop($content).'</div></div>';
        return $output;
    }
}



class WPBakeryShortCode_VC_Toggle extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $title = $el_class = $open = null;
        extract(shortcode_atts(array(
            'title' => __("Click to toggle", "js_composer"),
            'el_class' => '',
            'open' => 'false',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));
        $output = '';
        
        $width = wpb_translateColumnWidthToSpan($width);

        $el_class = $this->getExtraClass($el_class);
        $open = ( $open == 'true' ) ? ' wpb_toggle_title_active' : '';
        $el_class .= ( $open == ' wpb_toggle_title_active' ) ? ' wpb_toggle_open' : '';
        $output .= '<div class="toggle-wrap '.$width.'">';
        $output .= '<div class="wpb_toggle'.$open.'">'.$title.'</div><div class="wpb_toggle_content'.$el_class.'">'.wpb_js_remove_wpautop($content).'</div>'.$this->endBlockComment('toggle')."\n";
        $output .= '</div>';
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

class WPBakeryShortCode_VC_Widget_sidebar extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $el_position = $title = $width = $el_class = $sidebar_id = '';
        extract(shortcode_atts(array(
            'el_position' => '',
            'title' => '',
            'width' => '1/1',
            'el_class' => '',
            'sidebar_id' => ''
        ), $atts));
        if ( $sidebar_id == '' ) return null;

        $output = '';
        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        ob_start();
        dynamic_sidebar($sidebar_id);
        $sidebar_value = ob_get_contents();
        ob_end_clean();

        $sidebar_value = trim($sidebar_value);
        $sidebar_value = (substr($sidebar_value, 0, 3) == '<li' ) ? '<ul>'.$sidebar_value.'</ul>' : $sidebar_value;
        //
        $output .= "\n\t".'<div class="wpb_widgetised_column wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading wpb_widgetised_column_heading">'.$title.'</h3>' : '';
        $output .= "\n\t\t\t".$sidebar_value;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}