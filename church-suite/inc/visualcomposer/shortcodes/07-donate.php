<?php
$cf7 = '';
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || defined( 'WPCF7_PLUGIN' ) ) {
	$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
}
	$contact_forms = array();
	if ( $cf7 ) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[ $cform->post_title ] = $cform->ID;
		}
	} else {
		$contact_forms[ esc_html__( 'No contact forms found', 'js_composer' ) ] = 0;
	}

vc_map( array(
        "name" =>"Donate Button",
        "base" => "donate",
        "description" => "Donate Button",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_button",
        "params" => array(
						array(
						"type" => "textarea",
						"heading" => esc_html__( "Content", 'webnus_framework' ),
						"param_name" => "donate_content",
						"value"=>'',
						"description" => esc_html__( "Button Text Content", 'webnus_framework')
						),
												
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Select contact form', 'js_composer' ),
							'param_name' => 'id',
							'value' => $contact_forms,
							'description' => esc_html__( 'Choose a created form by contact form 7', 'js_composer' )
						),

						array(
						"type" => "dropdown",
						"heading" => esc_html__( "Color", 'webnus_framework' ),
						"param_name" => "color",
						"value" => array(
							"Green"=>"green",
							"Red"=>"red",
							"Blue"=>"blue",
							"Gray"=>"gray",
							"Dark gray"=>"dark-gray",
							"Cherry"=>"cherry",
							"Orchid"=>"orchid",
							"Pink"=>"pink",
							"Orange"=>"orange",
							"Teal"=>"teal",
							"SkyBlue"=>"skyblue",
							"Jade"=>"jade",
							"White"=>"white",
							"Black"=>"black",
						),
						"description" => esc_html__( "Button Color", 'webnus_framework')
						),
												
						array(
						"type" => "dropdown",
						"heading" => esc_html__( "Size", 'webnus_framework' ),
						"param_name" => "size",
						"value" => array(
							"Small"=>"small",
							"Medium"=>"medium",
							"Large"=>"large",
							
						),
						"description" => esc_html__( "Button Size", 'webnus_framework')
						),

						array(
						"type" => "dropdown",
						"heading" => esc_html__( "Bordered?", 'webnus_framework' ),
						"param_name" => "border",
						"value"=>array('Normal'=>'false','Bordered'=>'true'),
						"description" => esc_html__( "Is button bordered?", 'webnus_framework')
						),
						array(
						"type" => "iconfonts",
						"heading" => esc_html__( "Icon", 'webnus_framework' ),
						"param_name" => "icon",
						"value"=>'',
						"description" => esc_html__( "Select Button Icon", 'webnus_framework')
						),
				
        ),
		
        
    ) );


?>