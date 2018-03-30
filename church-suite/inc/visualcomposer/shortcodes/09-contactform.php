<?php
vc_map( array(
    'name' =>'Webnus ContactForm',
    'base' => 'contactform',
    "icon" => "webnus_contactform",
	"description" => "Contact form",
    'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
    'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Form type', 'webnus_framework' ),
			'param_name' => 'type',
			'value' => array('Vertical'=>'1','Horizontal'=>'2'),
			'description' => esc_html__( 'You can choose among these pre-designed types.', 'webnus_framework'),
		),

		array(
			'heading'		=> esc_html__( 'E-mail Address', 'webnus_framework' ),
			'type'			=> 'textfield',
			'param_name'	=> 'email_address',
			'value'			=> '',
			'description'	=> wp_kses( __( 'Which email would you like the contacts to be sent, if left empty the information will be sent to Admin email address by default.', 'webnus_framework'), array( 'span' => array( 'style' => array() ), 'br' => array() ) ),
		),

		array(
			'heading'		=> esc_html__( 'Captcha authentication?', 'webnus_framework' ),
			'type'			=> 'checkbox',
			'param_name'	=> 'captcha',
			'value'			=> array( esc_html__( 'Enable', 'webnus_framework' ) => 'enable' ),
			'description'	=> wp_kses( __( 'If you like to use captcha, please enable it and then <span style="color:#FF932E;">go to Theme Options > General and fill "reCaptcha Site Key" and "reCaptcha Secret Key" fields.</span><br>Note: essential tips are available in Theme Options to fill all fields.', 'webnus_framework'), array( 'span' => array( 'style' => array() ), 'br' => array() ) ),
		),

)));
?>