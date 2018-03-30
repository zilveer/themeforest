<?php
/**
 * Shortcodes in the TinyMCE
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Adds button to mce
if ( wpex_get_mod( 'editor_shortcodes_enable', true ) && is_admin() ) {
	if ( ! function_exists( 'total_shortcodes_add_mce_button' ) ) {
		function total_shortcodes_add_mce_button() {
			// check user permissions
			if ( ! current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
				return;
			}
			// check if WYSIWYG is enabled
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', 'total_shortcodes_add_tinymce_plugin' );
				add_filter( 'mce_buttons', 'total_shortcodes_register_mce_button' );
			}
		}
	}
	add_action( 'admin_head', 'total_shortcodes_add_mce_button' );
}

// Loads js for the Button
if ( ! function_exists( 'total_shortcodes_add_tinymce_plugin' ) ) {
	function total_shortcodes_add_tinymce_plugin( $plugin_array ) {
		$plugin_array['total_shortcodes_mce_button'] = WPEX_FRAMEWORK_DIR_URI .'shortcodes/tinymce.js';
		return $plugin_array;
	}
}

// Registers new button
if ( ! function_exists( 'total_shortcodes_register_mce_button' ) ) {
	function total_shortcodes_register_mce_button( $buttons ) {
		array_push( $buttons, 'total_shortcodes_mce_button' );
		return $buttons;
	}
}

/**
 * Allow shortcodes in widgets
 *
 * @since Total 1.3.3
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Fixes spacing issues with shortcodes
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_fix_shortcodes' ) ) {
	function wpex_fix_shortcodes( $content ){
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr( $content, $array) ;
		return $content;
	}
}
add_filter( 'the_content', 'wpex_fix_shortcodes' );

/**
 * Searchform shortcode
 *
 * @since Total 3.5.0
 */
if ( ! function_exists( 'wpex_searchform_shortcode' ) && ! shortcode_exists( 'searchform' ) ) {
	function wpex_searchform_shortcode() {
		return get_search_form();
	}
	add_shortcode( 'searchform', 'wpex_searchform_shortcode' );
}

/**
 * Year shortcode
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_year_shortcode' ) ) {
	function wpex_year_shortcode() {
		return date('Y');
	}
}
add_shortcode( 'current_year', 'wpex_year_shortcode' );

/**
 * Font Awesome Shortcode
 *
 * @since Total 1.3.2
 */
if ( ! function_exists( 'wpex_font_awesome_shortcode' ) ) {

	function wpex_font_awesome_shortcode( $atts ) {

		extract( shortcode_atts( array (
			'icon'          => '',
			'link'          => '',
			'link_title'    => '',
			'margin_right'  => '',
			'margin_left'   => '',
			'margin_top'    => '',
			'margin_bottom' => '',
			'color'         => '',
			'size'          => '',
			'link'          => '',
		), $atts ) );

		// Sanitize vars
		$link       = $link ? esc_url( $link ) : '';
		$link_title = $link_title ? esc_attr( $link_title ) : '';

		// Generate inline styles
		$style = array();
		if ( $color ) {
			$style[] = 'color: #'. str_replace( '#', '', $color ) .';';
		}
		if ( $margin_left ) {
			$style[] = 'margin-left: '. intval( $margin_left ) .'px;';
		}
		if ( $margin_right ) {
			$style[] = 'margin-right: '. intval( $margin_right ) .'px;';
		}
		if ( $margin_top ) {
			$style[] = 'margin-top: '. intval( $margin_top ) .'px;';
		}
		if ( $margin_bottom ) {
			$style[] = 'margin-bottom: '. intval( $margin_bottom ) .'px;';
		}
		if ( $size ) {
			$style[] = 'font-size: '. intval( $size ) .'px;';
		}
		$style = implode( '', $style );

		if ( $style ) {
			$style = wp_kses( $style, array() );
			$style = ' style="' . esc_attr( $style) . '"';
		}

		// Display icon with link
		if ( $link ) {
			$output = '<a href="'. $link .'" title="'. $link_title .'"><span class="fa fa-'. $icon .'" '. $style .'></span></a>';
		}

		// Display icon without link
		else {
			$output = '<span class="fa fa-'. $icon .'" '. $style .'></span>';
		}

		// Return shortcode output
		return $output;

	}

}
add_shortcode( 'font_awesome', 'wpex_font_awesome_shortcode' );

/**
 * Login Link
 *
 * @since Total 1.3.2
 */
if ( ! function_exists( 'wpex_wp_login_url_shortcode' ) ) {

	function wpex_wp_login_url_shortcode( $atts ) {

		extract( shortcode_atts( array(
			'login_url'       => '',
			'url'             => '',
			'text'            => esc_html__( 'Login', 'total' ),
			'logout_text'     => esc_html__( 'Log Out', 'total' ),
			'target'          => '',
			'logout_redirect' => '',
		), $atts, 'wp_login_url' ) );

		// Target
		if ( 'blank' == $target ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}

		// Define login url
		if ( $url ) {
			$login_url = $url;
		} elseif ( $login_url ) {
			$login_url = $login_url;
		} else {
			$login_url = wp_login_url();
		}

		// Logout redirect
		if ( ! $logout_redirect ) {
			$permalink = get_permalink();
			if ( $permalink ) {
				$logout_redirect = $permalink;
			} else {
				$logout_redirect = home_url( '/' );
			}
		}

		// Logged in link
		if ( is_user_logged_in() ) {
			return '<a href="'. wp_logout_url( $logout_redirect ) .'" title="'. esc_attr( $logout_text ) .'" class="wpex-logout">'. strip_tags( $logout_text ) .'</a>';
		}

		// Non-logged in link
		else {
			return '<a href="'. esc_url( $login_url ) .'" title="'. esc_attr( $text ) .'" class="wpex-login" '. $target .'>'. strip_tags( $text ) .'</a>';
		}

	}

}
add_shortcode( 'wp_login_url', 'wpex_wp_login_url_shortcode' );