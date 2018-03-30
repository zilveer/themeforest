<?php

class WPBakeryShortCode_testimonial_slider extends WPBakeryShortCodesContainer {

    /*
     * Thi methods returns HTML code for frontend representation of your shortcode.
     * You can use your own html markup.
     *
     * @param $atts - shortcode attributes
     * @param @content - shortcode content
     *
     * @access protected
     *
     * @return string
     */

    protected function content($atts, $content = null) {

	  	extract(shortcode_atts(array(
		"type" => 'mono',		
		), $atts));


		$out = '<div class="testimonials-slider-w flexslider ts-'.$type.'">';
		$out .= '<ul class="slides">';
		$out .= do_shortcode( $content );
		$out .= '</ul></div>';
	
	return $out;
}

}




vc_map( array(
    "name" => "Testimonial Slider",
    "base" => "testimonial_slider",
    "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
    "icon" => "webnus_testimonialslider",
    "as_parent" => array('only' => 'testimonial_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    
    "params" => array(
        // add params same as with any other content element
		 array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'webnus_framework' ),
			"param_name" => "type",
			"value" => array(
				"One"=>"mono",
				"Two"=>"di",
				"Three"=>"tri",
                "Four"=>"tetra",       
				"Five"=>"penta",		
			),
			"description" => esc_html__( "Select Image", 'webnus_framework')
		), 
    ),
    "js_view" => 'VcColumnView'
) );




?>