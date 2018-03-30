<?php

class WPBakeryShortCode_testimonial_item extends WPBakeryShortCode {

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
	 	
		'img'=>'http://',
		'text_content'=>'',
		'name'=>'Name',
		'subtitle' => '',
		), $atts));
		
		if(is_numeric($img)){
			
			$img = wp_get_attachment_url( $img );
			
		}
			
		$out = "<li>\n";
		$out .= "\t<div class=\"testimonial\">\n";		  
		$out .= "\t\t<div class=\"testimonial-content\">\n";		 
		$out .= "\t\t\t<h4><q>".$text_content."</q></h4>\n";			
		$out .= "\t\t\t<div class=\"testimonial-arrow\"></div>\n";			  
		$out .= "\t\t</div>\n";			  
		$out .= "\t\t<div class=\"testimonial-brand\">\n";
		if(!empty($img))
		$out .= "\t\t<img src=\"".$img."\" alt=\"".$name."\">\n";		
		$out .= "\t\t\t<h5><strong>".$name."</strong><br>\n";			
		$out .= "\t\t\t<em>".$subtitle."</em></h5>\n";			  
		$out .= "\t\t</div>\n";
		$out .= "\t</div>\n";
		$out .= "</li>\n";				
		
		return $out;
}

}
vc_map( array(
        "name" =>"Webnus Testimonial Item",
        "base" => "testimonial_item",
		"description" => "Testimonials slider",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_testimonialitem",
        "content_element" => true,
   		"as_child" => array('only' => 'testimonial_slider'), // Use only|except 
        'params'=>array(
							
					array(
							'type' => 'textfield',
							'heading' => __( 'Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name',
							'value'=>'Name',
							'description' => __( 'Enter the Testimonial Name', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'attach_image',
							'heading' => __( 'Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'http://',
							'description' => __( 'Testimonial Image', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Subtitle', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'subtitle',
							'value'=>'',
							'description' => __( 'Testimonial Subtitle', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea',
							'heading' => __( 'Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'text_content',
							'value' => '',
							'description' => __( 'Enter the Testimonial content text', 'WEBNUS_TEXT_DOMAIN')
					),
		),
		
        
    ) );


?>