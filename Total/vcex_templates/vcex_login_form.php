<?php
/**
 * Visual Composer Login Form
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever
if ( is_admin() ) {
    return;
}

// Required VC functions
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_login_form', $atts ) );

// Define output var
$output = '';

// Get classes
$add_classes = 'vcex-login-form clr';
if ( $classes ) {
	$add_classes .= vcex_get_extra_class( $classes );
}
if ( $css_animation ) {
	$add_classes .= vcex_get_css_animation( $css_animation );
}
if ( $css ) {
	$add_classes .= ' '. vc_shortcode_custom_css_class( $css );
}
if ( $text_color || $text_font_size ) {
	$wrap_style = vcex_inline_style( array(
		'color'     => $text_color,
		'font_size' => $text_font_size,
	) );
	$add_classes .= ' vcex-label-inherit-typo';
} else {
	$wrap_style = '';
}

// Check if user is logged in
if ( is_user_logged_in() && ! wpex_is_front_end_composer() ) :

	// Add logged in class
	$add_classes .= ' logged-in';

	$output .= '<div class="'. esc_html( $add_classes ) .'" '. vcex_get_unique_id( $unique_id ) .'>'. do_shortcode( $content ) .'</div>';


// If user is not logged in display login form
else :

	// Redirection URL
	if ( ! $redirect ) {
		$redirect = site_url( $_SERVER['REQUEST_URI'] );
	}

	$output .= '<div class="'. esc_html( $add_classes ) .'"'. $wrap_style . vcex_get_unique_id( $unique_id ) .'>';
		
		$output .= wp_login_form( array(
			'echo'           => false,
			'redirect'       => $redirect ? esc_url( $redirect ) : false,
			'form_id'        => 'vcex-loginform',
			'label_username' => $label_username ? $label_username : esc_html__( 'Username', 'total' ),
			'label_password' => $label_password ? $label_password : esc_html__( 'Password', 'total' ),
			'label_remember' => $label_remember ? $label_remember : esc_html__( 'Remember Me', 'total' ),
			'label_log_in'   => $label_log_in ? $label_log_in : esc_html__( 'Log In', 'total' ),
			'remember'       => 'true' == $remember ? true : false,
			'value_username' => NULL,
			'value_remember' => false,
		) );
		
		if ( 'true' == $register || 'true' == $lost_password ) :

			$output .= '<div class="vcex-login-form-nav clr">';
				
				if ( 'true' == $register ) :

					$label        = $register_label ? $register_label :  esc_html__( 'Register', 'total' );
					$register_url = $register_url ? $register_url : wp_registration_url();

					$output .= '<a href="'. esc_url( $register_url ) .'" title="'. esc_html( $label ) .'" class="vcex-login-form-register">'. esc_html( $label ) .'</a>';

				endif;
				
				if ( 'true' == $register && 'true' == $lost_password ) {
					$output .= '<span class="pipe">|</span>';
				}
				
				if ( 'true' == $lost_password ) :

					$label    = $lost_password_label ? $lost_password_label :  esc_html__( 'Lost Password?', 'total' );
					$redirect = get_permalink();

					$output .= '<a href="'. esc_url( wp_lostpassword_url( $redirect ) ) .'" title="'. esc_html( $label ) .'" class="vcex-login-form-lost">'. esc_html( $label ) .'</a>';
				endif;

			endif;

		$output .= '</div>';

	$output .= '</div>';

endif;

echo $output;