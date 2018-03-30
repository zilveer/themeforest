<?php

/*********** Shortcode: Email Link ************************************************************/

$ABdevDND_shortcodes['email_dd'] = array(
	'attributes' => array(
		'email' => array(
			'description' => __('Email Address', 'dnd-shortcodes'),
		),
		'cloak' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('Cloak Email from Spam Bots', 'dnd-shortcodes'),
		),
		'icon' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('With Icon', 'dnd-shortcodes'),
		),
	),
	'description' => __('Email Link', 'dnd-shortcodes'),
	'info' => __('This shortcode will hide email address form spam bots using JavaScript method', 'dnd-shortcodes' )
);
function ABdevDND_email_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('email_dd'), $attributes));

	$icon_output=($icon!='0')?'<i class="ABdev_icon-emailalt"></i> ':'';

	if ($cloak!='1'){
		return '<a href="mailto:'.$email.'">'.$icon_output.''.$email.'</a>';
	}
	else{
		$email=explode('@',$email);
		return $icon_output.'<script>
			document.write (\'<A HREF="mai\')
			document.write (\'lto:'.$email[0].'\')
			document.write (\'&#64;\')
			document.write (\''.$email[1].'">'.$email[0].'\')
			document.write (\'&#64;\')
			document.write (\''.$email[1].'</A>\')
		</script>';
	}
}


