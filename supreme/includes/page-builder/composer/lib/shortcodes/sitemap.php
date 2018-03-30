<?php

class WPBakeryShortCode_sitemap extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $output = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));
        
        $sitemap = '[sf_sitemap]';
                
       	$el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $output .= "\n\t".'<div class="wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper sitemap-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_text_heading"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t". do_shortcode($sitemap);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

WPBMap::map( 'sitemap', array(
    "name"		=> __("Sitemap", "js_composer"),
    "base"		=> "sitemap",
    "class"		=> "",
    "icon"      => "icon-wpb-sitemap",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "js_composer"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
    	),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>