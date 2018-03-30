<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_member' ) ) {
	/**
	 * Team Member shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_member( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_team_member', $atts );
		}

		global $team_member_socials, $ti_icons;

		extract( shortcode_atts( array(
			'photo' => '',
			'link' => '',
			'image_style' => '',
			'alignment' => '',
			'name' => '',
			'title_tag' => 'h3',
			'role' => '',
			'tagline' => '',
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$image_style = sanitize_text_field( $image_style );
		$name = sanitize_text_field( $name );
		//$tagline = sanitize_text_field( $tagline );
		$role = sanitize_text_field( $role );
		$alignment = esc_attr( $alignment );
		$animation = sanitize_text_field( $animation );
		$animation_delay = absint( $animation_delay );
		$inline_style = sanitize_text_field( $inline_style );
		$class = esc_attr( $class );
		$title_tag = esc_attr( $title_tag );

		$link = vc_build_link( $link );
		$url = esc_url( $link['url'] );
		$target = $link['target'];
		$title = $link['title'];

		foreach ( $team_member_socials as $social ) {
			$default_atts[ $social ] = '';
		}

		$size = 'classic-thumb';

		if ( 'square' == $image_style || 'round' == $image_style )
			$size = '1x1';

		if ( 'portrait' == $image_style )
			$size = 'portrait';

		$style = '';
		$class .= "team-member-container text-$alignment";

		if ( 'round' == $image_style )
			$class .= " round";

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class'$style>";

		$photo = ( $photo ) ? wolf_get_url_from_attachment_id( $photo, $size ) : '';

		if ( $photo ) {
			$output .= "<div class='team-member-photo'>";
	
			if ( 'http://' != $url && $url ) {
				$output .= '<a href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" target="' . esc_attr( $target ) . '">';
			}

			$output .= "<img src='$photo' alt='team-member'>";

			if ( 'http://' != $url && $url )  $output .= '</a>';

			$output .= "</div>";
		}


		$headings_array = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
		$title_tag = ( in_array( $title_tag, $headings_array ) ) ? $title_tag : 'h3';

		if ( $name )
			$output .= "<$title_tag class='team-member-name'>$name</$title_tag>";

		if ( $role )
			$output .= "<span class='team-member-role'>$role</span>";

		if ( $tagline )
			$output .= "<div class='team-member-tagline'><p>$tagline</p></div>";

		$output .= '<div class="team-member-social-container">';

		foreach ( $team_member_socials as $social ) {
			if ( ! empty( $atts[$social] ) ) {
				$prefix = ( in_array( 'ti-' . $social, array_keys( $ti_icons ) ) ) ? 'ti' : 'fa fa';
				$output .= "<a href='" . $atts[$social] . "' class='$prefix-$social' title='$social' target='_blank'></a>";
			}
		}

		$output .= '</div>';

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wolf_team_member', 'wolf_shortcode_member' );
}
