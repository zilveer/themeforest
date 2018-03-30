<?php
/*
 * Plugin Name:   cbnet Really Simple CAPTCHA Comments
 * Plugin URI:    http://www.chipbennett.net/wordpress/plugins/cbnet-really-simple-captcha-comments/
 * Description:   Comment form CAPTCHA using  Really Simple CAPTCHA plugin
 * Version:       1.0.3
 * Author:        chipbennett
 * Author URI:    http://www.chipbennett.net/
 *
 * License:       GNU General Public License, v2 (or newer)
 * License URI:  http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * Thanks to Takayuki Miyoshi fordeveloping the Really Simple CAPTCHA
 * plugin. Hopefully this plugin will provide some inspiration for others
 * to incorporate Really Simple CAPTCHA into their own plugins.
 */
 
// Add Really Simple CAPTCHA to the comment form, using the comment_form_after_fields hook.
// http://wordpress.org/extend/plugins/really-simple-captcha/
function cbnet_comment_captcha() { 

if ( ( ! is_user_logged_in() ) && ( class_exists('ReallySimpleCaptcha') ) ) {
	// Instantiate the ReallySimpleCaptcha class, which will handle all of the heavy lifting
	$cbnet_comment_captcha = new ReallySimpleCaptcha();
	
	// ReallySimpleCaptcha class option defaults.
	// For now, these are here merely for reference.
	// Changing these values will hav no impact.
	// If you want to configure these options, see "Set Really Simple CAPTCHA Options", below
	// TODO: Add admin page to allow configuration of options.
	$cbnet_comment_captcha_defaults = array(
		'chars' => 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789',
		'char_length' => '4',
		'img_size' => array( '72', '24' ),
		'fg' => array( '0', '0', '0' ),
		'bg' => array( '255', '255', '255' ),
		'font_size' => '16',
		'font_char_width' => '15',
		'img_type' => 'png',
		'base' => array( '6', '18'),
	);
	
/************************************************************
 * All configurable options are below  *
 ************************************************************/
	
	// Set Really Simple CAPTCHA Options
	$cbnet_comment_captcha->chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
	$cbnet_comment_captcha->char_length = '5';
	$cbnet_comment_captcha->img_size = array( '95', '40' );
	$cbnet_comment_captcha->fg = array( '0', '0', '0' );
	$cbnet_comment_captcha->bg = array( '255', '255', '255' );
	$cbnet_comment_captcha->font_size = '20';
	$cbnet_comment_captcha->font_char_width = '15';
	$cbnet_comment_captcha->img_type = 'png';
	$cbnet_comment_captcha->base = array( '13', '25' );
	
	// Set Comment Form Options
	$cbnet_comment_captcha_form_label = __( 'Anti-Spam', 'gdl_front_end' );
	
/************************************************************
 * Nothing else to edit.  No configurable options below this point.  *
 ************************************************************/
	
	// Generate random word and image prefix
	$cbnet_comment_captcha_word = $cbnet_comment_captcha->generate_random_word();
	$cbnet_comment_captcha_prefix = mt_rand();
	// Generate CAPTCHA image
	$cbnet_comment_captcha_image_name = $cbnet_comment_captcha->generate_image($cbnet_comment_captcha_prefix, $cbnet_comment_captcha_word);
	// Define values for comment form CAPTCHA fields
	$cbnet_comment_captcha_image_url =  GOODLAYERS_PATH . '/include/plugin/really-simple-captcha/tmp/';
	$cbnet_comment_captcha_image_src = $cbnet_comment_captcha_image_url . $cbnet_comment_captcha_image_name;
	$cbnet_comment_captcha_image_width = $cbnet_comment_captcha->img_size[0];
	$cbnet_comment_captcha_image_height = $cbnet_comment_captcha->img_size[1];
	$cbnet_comment_captcha_field_size = $cbnet_comment_captcha->char_length;
	// Output the comment form CAPTCHA fields
?>
	<p class="comment-form-captcha">
		<img src="<?php echo $cbnet_comment_captcha_image_src; ?>" alt="captcha" width="<?php echo $cbnet_comment_captcha_image_width; ?>" height="<?php echo $cbnet_comment_captcha_image_height; ?>" />
		<input type="text" name="comment_captcha_code" id="comment_captcha_code" value="" size="<?php echo $cbnet_comment_captcha_field_size; ?>" />
		<input type="hidden" name="comment_captcha_prefix" id="comment_captcha_prefix" value="<?php echo $cbnet_comment_captcha_prefix; ?>" />
		<label for="captcha_code"><?php echo $cbnet_comment_captcha_form_label; ?></label>
		<span class="required">*</span>
		<div class="clear"></div>
	</p>
<?php 
	}
}
add_action( 'comment_form_after_fields' , 'cbnet_comment_captcha' );

function cbnet_check_comment_captcha( $comment_data  ) {	
if ( ( ! is_user_logged_in() ) && ( $comment_data['comment_type'] == '' ) && ( class_exists('ReallySimpleCaptcha') ) ) { 
	$cbnet_comment_captcha = new ReallySimpleCaptcha();
	// This variable holds the CAPTCHA image prefix, which corresponds to the correct answer
	$cbnet_comment_captcha_prefix = $_POST['comment_captcha_prefix'];
	// This variable holds the CAPTCHA response, entered by the user
	$cbnet_comment_captcha_code = $_POST['comment_captcha_code'];
	// This variable will hold the result of the CAPTCHA validation. Set to 'false' until CAPTCHA validation passes
	$cbnet_comment_captcha_correct = false; 
	// Validate the CAPTCHA response
	$cbnet_comment_captcha_check = $cbnet_comment_captcha->check( $cbnet_comment_captcha_prefix, $cbnet_comment_captcha_code );
	// Set to 'true' if validation passes, and 'false' if validation fails
	$cbnet_comment_captcha_correct = $cbnet_comment_captcha_check;
	// clean up the tmp directory
	$cbnet_comment_captcha->remove($cbnet_comment_captcha_prefix);
	$cbnet_comment_captcha->cleanup();
	// If CAPTCHA validation fails (incorrect value entered in CAPTCHA field) don't process the comment.
	if ( ! $cbnet_comment_captcha_correct ) {
		wp_die('You have entered an incorrect CAPTCHA value. Click the BACK button on your browser, and try again.');
		break;
	} 
	// if CAPTCHA validation passes (correct value entered in CAPTCHA field), process the comment as per normal
	return $comment_data;
	} else {
		return $comment_data;
	}
} 
add_filter('preprocess_comment', 'cbnet_check_comment_captcha', 0);