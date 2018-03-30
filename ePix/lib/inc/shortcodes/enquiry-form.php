<?php

	/* ------------------------------------
	:: ENQUIRY FORM
	------------------------------------*/
	
	function enquiry_form_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		  'emailto' => '',
		  'thankyou' => '',
		  'id' => '',
		 ), $atts ) );
		
		wp_deregister_script('contact-form');	
		wp_register_script('contact-form',get_template_directory_uri().'/js/contact.form.js',false,array('jquery'),true);
		wp_enqueue_script('contact-form');	  
		 
		ob_start(); 
		   
		contact_form(esc_attr($id),'','',esc_attr($emailto),esc_attr($thankyou));
		$output_string=ob_get_contents();
		ob_end_clean();
		   
		  return $output_string;
	}
	
	/* ------------------------------------
	:: ENQUIRY FORM MAP
	------------------------------------*/
	
	wpb_map( array(
		"name"		=> __("Enquiry Form", "js_composer"),
		"base"		=> "enquiry_form",
		"class"		=> "",
		"icon"		=> "icon-contact",
		"wrapper_class" => "",
		"controls"	=> "edit_popup_delete",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(		
			array(
				"type" => "textfield",
				"heading" => __("Email To Address", "js_composer"),
				"param_name" => "emailto",
				"value" => "",
				"description" => __("Enter the email address you wish emails to be sent to, default is admin email address.", "js_composer")
			),					
			array(
				"type" => "textarea",
				"class" => "messagebox_text",
				"heading" => __("Thankyou Text", "js_composer"),
				"param_name" => "thankyou",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"heading" => __("ID", "js_composer"),
				"param_name" => "id",
				"value" => "",
				"description" => __("Add an ID if you require multiple Contact Forms e.g. contact_two.", "js_composer")
			)
		),
	) );
	
	add_shortcode('enquiry_form', 'enquiry_form_shortcode');