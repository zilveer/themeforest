<?php
/**
 * Visual Composer Newsletter Form
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
if ( ! function_exists( 'vc_map_get_attributes' ) ) {
	vcex_function_needed_notice();
	return;
}

// Define output var
$output = '';

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_newsletter_form', $atts ) );

// Vars
$provider = 'mailchimp';
$input_style = $submit_style = $submit_data = '';

// Wrapper classes
$wrap_classes = array( 'vcex-newsletter-form clr' );
if ( 'true' == $fullwidth_mobile ) {
	$wrap_classes[] = 'vcex-fullwidth-mobile';
}
if ( $classes ) {
	$wrap_classes[] = vcex_get_extra_class( $classes );
}
if ( $visibility ) {
	$wrap_classes[] = $visibility;
}
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}

// Input Style
$input_style = vcex_inline_style( array(
	'border'         => $input_border,
	'border_radius'  => $input_border_radius,
	'padding'        => $input_padding,
	'letter_spacing' => $input_letter_spacing,
	'height'         => $input_height,
	'background'     => $input_bg,
	'color'          => $input_color,
	'font_size'      => $input_font_size,
	'font_weight'    => $input_weight,
) );

// Submit Style
$submit_style = vcex_inline_style( array(
	'height'            => $submit_height,
	'line_height'       => $submit_height,
	'margin_top'        => $submit_height ? '-'. $submit_height/2 : '',
	'right'             => $submit_position_right,
	'border'            => $submit_border,
	'letter_spacing'    => $submit_letter_spacing,
	'padding'           => $submit_padding,
	'background'        => $submit_bg,
	'color'             => $submit_color,
	'font_size'         => $submit_font_size,
	'font_weight'       => $submit_weight,
	'border_radius'     => $submit_border_radius,
) );

// Submit classes
$submit_classes = 'vcex-newsletter-form-button';

// Submit Data
if ( $submit_hover_bg ) {
	$submit_data .= ' data-hover-background="'. $submit_hover_bg .'"';
	$submit_classes .= ' wpex-data-hover';
}
if ( $submit_hover_color ) {
	$submit_data .= ' data-hover-color="'. $submit_hover_color .'"';
}

// Load inline js for data hover
if ( $submit_hover_bg || $submit_hover_color ) {
	vcex_inline_js( array( 'data_hover' ) );
}

// Input Width
if ( $input_width ) {
	$input_width = ' style="width: '. $input_width .'"';
}

// Mailchimp
if ( $provider == 'mailchimp' ) :

	$output .= '<div class="'. implode( ' ', $wrap_classes ) .'"'. vcex_get_unique_id( $unique_id ) .'>';

		$output .= '<div id="mc_embed_signup" class="vcex-newsletter-form-wrap"'. $input_width .'>';
			
			$output .= '<form action="'. $mailchimp_form_action .'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>';
				
				$output .= "<input type=\"email\" value=\"". $placeholder_text ."\" onfocus=\"if(this.value==this.defaultValue)this.value='';\" onblur=\"if(this.value=='')this.value=this.defaultValue;\" name=\"EMAIL\" class=\"required email\" id=\"mce-EMAIL\"". $input_style .">";

				if ( $submit_text ) :

					$output .= '<button type="submit" value="" name="subscribe" id="mc-embedded-subscribe" class="'. $submit_classes .'"'. $submit_style . $submit_data .'>';
						$output .= $submit_text;
					$output .= '</button>';

				endif;

			$output .= '</form>';

		$output .= '</div>';

	$output .= '</div>';
	
endif;

echo $output;