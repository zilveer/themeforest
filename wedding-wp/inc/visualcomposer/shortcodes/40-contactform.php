<?php
vc_map( array(
    'name' =>'Webnus ContactForm',
    'base' => 'contactform',
    "icon" => "webnus_contactform",
	"description" => "Contact form",
    'category' => esc_html__( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
    'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Form type', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'type',
			'value' => array('Vertical'=>'1','Horizontal'=>'2'),
			'description' => esc_html__( 'You can choose among these pre-designed types.', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'heading'		=> esc_html__( 'E-mail Address', 'WEBNUS_TEXT_DOMAIN' ),
			'type'			=> 'textfield',
			'param_name'	=> 'email_address',
			'value'			=> '',
			'description'	=> wp_kses( __( 'Which email would you like the contacts to be sent, if left empty the information will be sent to Admin email address <span style="color:#FF932E;">"' . get_option( 'admin_email' ) . '"</span> by default.', 'WEBNUS_TEXT_DOMAIN'), array( 'span' => array( 'style' => array() ), 'br' => array() ) ),
		),

		array(
			'heading'		=> esc_html__( 'Captcha authentication?', 'WEBNUS_TEXT_DOMAIN' ),
			'type'			=> 'checkbox',
			'param_name'	=> 'captcha',
			'value'			=> array( esc_html__( 'Enable', 'WEBNUS_TEXT_DOMAIN' ) => 'enable' ),
			'description'	=> wp_kses( __( 'If you like to use captcha, please enable it and then <span style="color:#FF932E;">go to Theme Options > General and fill "reCaptcha Site Key" and "reCaptcha Secret Key" fields.</span><br>Note: essential tips are available in Theme Options to fill all fields.', 'WEBNUS_TEXT_DOMAIN'), array( 'span' => array( 'style' => array() ), 'br' => array() ) ),
		),

)));
?>