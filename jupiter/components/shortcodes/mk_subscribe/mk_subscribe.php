<?php

global $mk_options;
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

if ( empty( trim( $mk_options['mailchimp_api_key'] ) ) )  {
	printf( __( 'Please add MailChimp API Key in <a href="%s" target="_blank">Theme Options > General > General Settings</a>', 'mk_framework' ), admin_url('admin.php?page=theme_options') );
}

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();

$subscribe_container = pq( '.mk-subscribe' );
$subscribe_container->attr('id', 'mk-subscribe-'.$id);
$subscribe_email = $subscribe_container->find('.mk-subscribe--email');
$subscribe_list_id = $subscribe_container->find('.mk-subscribe--list-id');
$subscribe_optin = $subscribe_container->find('.mk-subscribe--optin');
$subscribe_button = $subscribe_container->find('.mk-subscribe--button');
$subscribe_list_id->val($list_id);
$subscribe_optin->val($optin);
$subscribe_container->addClass($el_class);

$subscribe_container->addClass($subscribe_size.'-size');
$subscribe_email->attr('placeholder', $placeholder_text);
$subscribe_button->find('span')->html($button_text);

if ( $animation != '' ) {
	$subscribe_container->addClass(get_viewport_animation_class($animation));
}

/**
 * Custom CSS Output
 * ==================================================================================*/
Mk_Static_Files::addCSS('
	#mk-subscribe-'.$id.' .mk-subscribe--email,
	#mk-subscribe-'.$id.' .mk-subscribe--button {
		border-radius: '.$corner_radius.'px;
	}
	#mk-subscribe-'.$id.' .mk-subscribe--form-column {
		padding-right: '.$space_between.'px;
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email {
		background-color: '.$input_bg_color.';
		color: '.$input_placeholder_color.';
		border: '.$input_border_width.'px '.$input_border_style.' '.$input_border_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email::-webkit-input-placeholder {
		color: '.$input_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email:-ms-input-placeholder {
		color: '.$input_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email::-ms-input-placeholder {
		color: '.$input_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email::-moz-placeholder {
		color: '.$input_placeholder_color.';
		opacity: 1;
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email:focus {
		background-color: '.$input_focus_bg_color.';
		border: '.$input_border_width.'px '.$input_border_style.' '.$input_border_color.';
		color: '.$input_focus_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email:focus::-webkit-input-placeholder {
		color: '.$input_focus_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email:focus:-ms-input-placeholder {
		color: '.$input_focus_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email:focus::-ms-input-placeholder {
		color: '.$input_focus_placeholder_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--email:focus::-moz-placeholder {
		color: '.$input_focus_placeholder_color.';
		opacity: 1;
	}
	#mk-subscribe-'.$id.' .mk-subscribe--button {
		background-color: '.$btn_bg_color.';
		color: '.$btn_text_color.';
		border: '.$btn_border_width.'px '.$btn_border_style.' '.$btn_border_color.';
	}
	#mk-subscribe-'.$id.' .mk-subscribe--button:hover {
		background-color: '.$btn_hover_bg_color.';
		color: '.$btn_hover_text_color.';
		border: '.$btn_border_width.'px '.$btn_border_style.' '.$btn_hover_border_color.';
	}
', $id);

print $html;
