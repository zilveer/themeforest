<?php

class SwiftPageBuilderShortcode_spb_revslider extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		    $width = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	"item_count"	=> '12',
	        	"revslider_shortcode" => '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
    		      		
    		$el_class = $this->getExtraClass($el_class);
            $width = spb_translateColumnWidthToSpan($width);
            
           	$output .= "\n\t".'<div class="spb_revslider_widget spb_content_element '.$width.$el_class.'">';            
            $output .= "\n\t\t".'<div class="spb_wrapper revslider-wrap">';
            $output .= "\n\t\t\t\t". return_slider($revslider_shortcode);
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

SPBMap::map( 'spb_revslider', array(
    "name"		=> __("Revolution Slider", "swiftframework"),
    "base"		=> "spb_revslider",
    "class"		=> "spb_revslider",
    "icon"      => "spb-icon-revslider",
    "params"	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Revolution Slider Alias", "swiftframework"),
            "param_name" => "revslider_shortcode",
            "value" => "",
            "description" => __("Enter the Revolution Slider alias here for the one that you wish to show. This can be found within the Revolution Slider Admin Panel.", "swiftframework")
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