<?php

class WPBakeryShortCode_showcase_layerslider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $width = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	"item_count"	=> '12',
	        	"revslider_shortcode"		=> '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
    		   	
 			$items .= '[rev_slider '.$revslider_shortcode.']';
      		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
           	$output .= "\n\t".'<div class="wpb_showcase_widget wpb_content_element '.$width.$el_class.'">';            
            $output .= "\n\t\t".'<div class="wpb_wrapper showcase-wrap">';
            $output .= "\n\t\t\t\t".do_shortcode($items);
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'showcase_layerslider', array(
    "name"		=> __("Revolution Slider", "js_composer"),
    "base"		=> "showcase_layerslider",
    "class"		=> "wpb_showcase_layerslider",
    "icon"      => "icon-wpb-showcase-layer",
    "params"	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Revolution Slider Alias", "js_composer"),
            "param_name" => "revslider_shortcode",
            "value" => "",
            "description" => __("Enter the Revolution Slider alias here for the one that you wish to show. This can be found within the Revolution Slider Admin Panel.", "js_composer")
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