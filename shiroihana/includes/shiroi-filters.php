<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Recognized Sidebars
============================================================================= */

if( ! function_exists( 'shiroi_recognized_sidebars' ) ) {

	function shiroi_recognized_sidebars( $sidebars ) {
		$recognized = array();
		foreach( $sidebars as $id => $sidebar ) {
			if( ! preg_match( '/^footer_widget_area_/', $id ) ) {
				$recognized[ $id ] = $sidebar;
			}
		}
		return $recognized;
	}
}
add_filter( 'ot_recognized_sidebars', 'shiroi_recognized_sidebars' );

/* ==========================================================================
	Filter Recognized Social Profiles
============================================================================= */

if( ! function_exists( 'shiroi_ot_type_select_choices_social_profiles_icon' ) ):

function shiroi_ot_type_select_choices_social_profiles_icon( $field_choices, $field_id ) {

	if( preg_match( '/^social_profiles_icon_\d+$/', $field_id ) ) {
		$field_choices = array();
		foreach( (array) shiroi_socicon_choices() as $value => $label ) {
			$label = ucfirst( $label );
			$field_choices[] = compact( 'value', 'label' );
		}
	}
	return $field_choices;
}
endif;
add_filter( 'ot_type_select_choices', 'shiroi_ot_type_select_choices_social_profiles_icon', 10, 2 );

/* ==========================================================================
	https://schema.org integration filter for `comments_popup_link`
============================================================================= */

if( ! function_exists( 'shiroi_comments_popup_link_attributes' ) ):

function shiroi_comments_popup_link_attributes( $attributes ) {
	return 'itemprop="discussionUrl"';
}
endif;
add_filter( 'comments_popup_link_attributes', 'shiroi_comments_popup_link_attributes' );

/* ==========================================================================
	Link Pages Link
============================================================================= */

if( ! function_exists( 'shiroi_link_pages_link' ) ):

function shiroi_link_pages_link( $link ) {
	return '<li>' . $link . '</li>';
}
endif;
add_filter( 'wp_link_pages_link', 'shiroi_link_pages_link' );

/* ==========================================================================
	Excerpts
============================================================================= */

if( ! function_exists( 'shiroi_excerpt_more' ) ):

function shiroi_excerpt_more( $excerpt_more ) {
	return '&hellip;';
}
endif;
add_filter( 'excerpt_more', 'shiroi_excerpt_more' );

/* ==========================================================================
	`the_content_more_link`
============================================================================= */

if( ! function_exists( 'shiroi_the_content_more_link' ) ):

function shiroi_the_content_more_link( $more_link ) {
	$more_link = preg_replace( '|#more-[0-9]+|', '', $more_link );
	return '<div class="more-link-wrap">' . $more_link . '</div>';
}
endif;
add_filter( 'the_content_more_link', 'shiroi_the_content_more_link' );

/* ==========================================================================
	Body Class
============================================================================= */

if( ! function_exists( 'shiroi_body_class' ) ):

function shiroi_body_class( $classes ) {

	/* Responsive breakpoint */
	$breakpoint = Youxi()->option->get( 'responsive_breakpoint' );
	if( 768 == $breakpoint ) {
		$classes[] = 'mq-768';
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'shiroi_body_class' );
