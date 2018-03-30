<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 * 1. Quote
 * 2. Highlight
 * 3. List
 * 4. Fancybox
 * 5. Tooltip
 * 6. Drop Caps
 * 7. Buttons
 * 8. Contact Form
 *
 */

/* ---------------------------------------------------------------- */
/* 1. Quote
/* ---------------------------------------------------------------- */

function mpcth_quote_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'background' => '',
		'color' => ''
	), $atts));
	
	$return = '<p class="mpcth-sc-quote" style="background: ' . $background . '; color: ' . $color . ';"><span class="mpcth-sc-quote-mark mpcth-sc-icon-quote"></span>' . $content . '</p>';

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('quote', 'mpcth_quote_shortcode');

/* ---------------------------------------------------------------- */
/* 2. Highlight
/* ---------------------------------------------------------------- */

function mpcth_highlight_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'background' => '',
		'color' => ''
	), $atts));
	
	$return = '<span class="mpcth-sc-highlight" style="background: ' . $background . '; color: ' . $color . ';">' . $content . '</span>';

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('highlight', 'mpcth_highlight_shortcode');

/* ---------------------------------------------------------------- */
/* 3. List
/* ---------------------------------------------------------------- */

function mpcth_list_shortcode($atts, $content = null) {
	$GLOBALS['item_count'] = 0;
	$GLOBALS['items'] = '';

	do_shortcode($content);
	
	extract(shortcode_atts(array(), $atts,$content));

	$return = '<ul class="mpcth-sc-list">';

	if(is_array($GLOBALS['items'])) {
		foreach($GLOBALS['items'] as $item) {
			$return .= '<li class="mpcth-sc-list-item" style="color: ' . $item['color'] . '"><span class="mpcth-sc-list-icon mpcth-sc-icon-' . $item['type'] . '" style="color: ' . $item['icon_color'] . '"></span>' . trim($item['content']) . '</li>';
		}	
	}
	
	$return .= '</ul>';

	$return = parse_shortcode_content($return);
	return $return;
} 
add_shortcode('list', 'mpcth_list_shortcode');

function mpcth_list_item_shortcode($atts, $content) {
	extract(shortcode_atts(array (
		'type' => '',
		'color' => '',
		'icon_color' => ''
	), $atts));
	
	$index = $GLOBALS['item_count'];
	$GLOBALS['items'][$index] = array(
		'type' => sprintf($type, $GLOBALS['item_count']),
		'color' => sprintf($color, $GLOBALS['item_count']),
		'icon_color' => sprintf($icon_color, $GLOBALS['item_count']),
		'content' => $content
	);
	$GLOBALS['item_count']++;
}
add_shortcode('l_item', 'mpcth_list_item_shortcode');

/* ---------------------------------------------------------------- */
/* 4. Fancybox
/* ---------------------------------------------------------------- */

function mpcth_fancybox_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'src' => '',
		'caption' => ''
	), $atts));

	$type = '';
	$src_type = strtolower($src);
	
	$search = preg_match('/.(jpg|jpeg|gif|png|bmp)/', $src_type);
	if($search == 1) {
		$type = 'mpcth-image';
		$search = 0;
	}
	
	$search = preg_match('/.(vimeo)./', $src_type);
	if($search == 1) {
		$type = 'mpcth-vimeo-video';
		$search = 0;
	}
	
	$search = preg_match('/.(youtube)/', $src_type);
	if($search == 1) {
		$type = 'mpcth-youtube-video';
		$search = 0;
	}
	
	$search = preg_match('/.(swf)/', $src_type);
	if($search == 1) {
		$type = 'mpcth-swf';
		$search = 0;
	}
	
	if($type == '') {
		$type = 'mpcth-iframe'; 
	}

	$return = '<a class="mpcth-sc-fancybox ' . $type . '" href="' . $src . '" title="' . $caption . '">' . $content . '</a>';

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('fancybox', 'mpcth_fancybox_shortcode');

/* ---------------------------------------------------------------- */
/* 5. Tooltip
/* ---------------------------------------------------------------- */

function mpcth_tooltip_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'message' => ''
	), $atts));
	
	$return = '<span class="mpcth-sc-tooltip-wrap"><span class="mpcth-sc-tooltip">' . $message . '</span>' . $content . '</span>';

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('tooltip', 'mpcth_tooltip_shortcode');

/* ---------------------------------------------------------------- */
/* 6. Drop Caps
/* ---------------------------------------------------------------- */

function mpcth_dropcaps_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'background' => '',
		'color' => '',
		'size' => 'normal' 
	), $atts));
	
	$return = '<span class="mpcth-sc-dropcaps mpcth-sc-dropcaps-size-' . $size . '" style="background: ' . $background . '; color: ' . $color . ';">' . $content . '</span>';

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('dropcaps', 'mpcth_dropcaps_shortcode');

/* ---------------------------------------------------------------- */
/* 7. Buttons
/* ---------------------------------------------------------------- */

function mpcth_button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'background' => '',
		'hover_background' => '',
		'color' => '',
		'hover_color' => '',
		'icon' => '',
		'url' => '',
		'id' => ''
	), $atts));
	
	if($id == '') $id = mpcth_random_ID();

	$return = '<style>';
		$return .= '#custom_button_' . $id . ' { ';
			$return .= 'background: ' . $background . ' !important; ';
			$return .= 'color: ' . $color . ' !important;';
		$return .= '}' . "\n";
		$return .= '#custom_button_' . $id . ':hover { ';
			$return .= 'background: ' . $hover_background . ' !important; ';
			$return .= 'color: ' . $hover_color . ' !important;';
		$return .= '}';
	$return .= '</style>';
	$return .= '<a href="' . $url . '" id="custom_button_' . $id . '" class="mpcth-sc-button">' . ($icon != '' ? '<span class="mpcth-sc-button-icon mpcth-sc-icon-' . $icon . '"></span>' : '') . $content . '</a>';

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('button', 'mpcth_button_shortcode');

/* ---------------------------------------------------------------- */
/* 8. Contact Form
/* ---------------------------------------------------------------- */

function mpcth_contact_shortcode($atts, $content = null) {
	global $mpcth_options;

	$email_label	= __('Email', 'mpcth');
	$message_label	= __('Message', 'mpcth');
	$author_label	= __('Author', 'mpcth');
	$send_label		= __('Send Message', 'mpcth');

	$email_required = get_option('require_name_email');
	if($email_required == '1')
		$email_label .= '*';

	wp_enqueue_script('mpcth-contact-form-js', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/mpcth-contact-form.js', array('jquery'), '1.0');
	wp_localize_script('mpcth-contact-form-js', 'cfdata', array(
		'email_label'		=> $email_label,
		'message_label'		=> $message_label,
		'author_label'		=> $author_label,
		'send_label'		=> $send_label,
		'target_email'		=> $mpcth_options['mpcth_contact_email'],
		'email_required'	=> $email_required,
		'empty_input_msg'	=> __('Please input value!', 'mpcth'),
		'email_error_msg'	=> __('Please provide valid author', 'mpcth'),
		'message_error_msg'	=> __('Please provide valid email', 'mpcth'),
		'author_error_msg'	=> __('Your message must be at least 5 characters long', 'mpcth'),
		'from_text'			=> __('My blog - ', 'mpcth').get_bloginfo('title'),
		'subject_text'		=> __('Message from ', 'mpcth'),
		'header_text'		=> __('From: ', 'mpcth'),
		'body_name_text'	=> __('Name: ', 'mpcth'),
		'body_email_text'	=> __('Email: ', 'mpcth'),
		'body_msg_text'		=> __('Message: ', 'mpcth'),
		'success_msg'		=> __('Email successfully send!', 'mpcth'),
		'error_msg'			=> __('There was an error. Please try again.', 'mpcth')
	) );

	$return = '';
	$return .=
		// '<form action="'.get_permalink().'" id="mpcth_contact_form" method="post">'.
		'<form action="'.MPC_THEME_ROOT.'/mpc-wp-boilerplate/php/mpcth-contact-form.php'.'" id="mpcth_contact_form" method="post">'.
			'<p class="mpcth-cf-form-author">'.
				'<input type="text" name="author_cf" id="author_cf" value="'.$author_label.'*'.'" class="requiredField comments_form author_cf" tabindex="1" onfocus="if(this.value==\''.$author_label.'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$author_label.'*\';"/>'.
			'</p>'.
			'<p class="mpcth-cf-form-email">'.
				'<input type="text" name="email_cf" id="email_cf" value="'.$email_label.'" class="'.($email_required == '1' ? 'requiredField' : '').' comments_form email email_cf" tabindex="2" onfocus="if(this.value==\''.$email_label.'\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$email_label.'\';"/>'.
			'</p>'.
			'<p class="mpcth-cf-form-message">'.
				'<textarea name="message_cf" id="message_cf" rows="1" cols="1" class="requiredField comments_form text_f message_cf" tabindex="3" onfocus="if(this.value==\''.$message_label.'*\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$message_label.'*\';">'.$message_label.'*'.'</textarea>'.
			'</p>'.
			'<p class="mpcth-cf-buttons">'.
				'<input name="submit" type="submit" id="submit" tabindex="4" value="'.$send_label.'" class="mpcth-cf-send"/>'.
				'<input type="hidden" name="submitted" id="submitted" value="true" />'.
			'</p>'.
			'<p class="mpcth-cf-check">'.
				'<input type="text" name="checking" id="checking" class="checking" value="" style="display: none;"/>'.
			'</p>'.
			'<div class="clear"></div>'.
		'</form>'; 

	$return = parse_shortcode_content($return);
	return $return;
}
add_shortcode('mpc_contact_form', 'mpcth_contact_shortcode');

if(function_exists('wpb_map'))
	wpb_map( array(
		'name' => __('Contact Form', 'mpcth'),
		'base' => 'mpc_contact_form',
		'class' => '',
		'icon' => 'icon-wpb-comments',
		'controls' => 'size_delete',
		'show_settings_on_create' => false,
		'category' => __('Content', 'mpcth')
	) );

/* ---------------------------------------------------------------- */
/* Parse shortcode content
/* ---------------------------------------------------------------- */

function parse_shortcode_content($content) {
   /* Parse nested shortcodes and add formatting. */
	$content = trim(do_shortcode(shortcode_unautop($content)));

	/* Remove '' from the start of the string. */
	if (substr($content, 0, 4) == '')
		$content = substr($content, 4);

	/* Remove '' from the end of the string. */
	if (substr($content, -3, 3) == '')
		$content = substr($content, 0, -3);

	/* Remove any instances of ''. */
	$content = str_replace(array('<p></p>'), '', $content);
	$content = str_replace(array('<p>  </p>'), '', $content);

	return $content;
}

function mpcth_color_creator($colour, $per) {
	$colour = substr($colour, 1);
	$rgb = '';
	$per = $per / 100 * 255;

	if($per < 0) {
		$per = abs($per);
		for ($x=0;$x<3;$x++) {
			$c = hexdec(substr($colour,(2*$x),2)) - $per;
			$c = ($c < 0) ? 0 : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
		}
	} else {
		for ($x=0;$x<3;$x++) {
			$c = hexdec(substr($colour,(2*$x),2)) + $per;
			$c = ($c > 255) ? 'ff' : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
		}
	}
	return '#'.$rgb;
}

function mpcth_random_ID($length = 15) {
	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}