<?php

class SwiftPageBuilderShortcode_sitemap extends SwiftPageBuilderShortcode {

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
        $width = spb_translateColumnWidthToSpan($width);

        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper sitemap-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4>' : '';
        $output .= "\n\t\t\t". do_shortcode($sitemap);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'sitemap', array(
    "name"		=> __("Sitemap", "swiftframework"),
    "base"		=> "sitemap",
    "class"		=> "",
    "icon"      => "spb-icon-sitemap",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swiftframework"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
    	),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swiftframework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
        )
    )
) );

?>