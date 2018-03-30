<?php
/**
 * Core functions
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Allow Shortcodes in Text Widget
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

if ( ! function_exists( 'wolf_gravatar' ) ) {
	/**
	 * Custom Default Avatar
	 *
	 * @param array $avatar_defaults
	 * @return array
	 */
	function wolf_gravatar( $avatar_defaults ) {

		/* Get avatar URL  from theme options */
		$wolf_theme_options = get_option( 'wolf_theme_options_' . wolf_get_theme_slug() );
		$custom_avatar_id = ( isset( $wolf_theme_options['custom_avatar'] ) ) ? $wolf_theme_options['custom_avatar'] : null;

		if ( $custom_avatar_id ) {
			$custom_avatar =esc_url( wolf_get_url_from_attachment_id( $custom_avatar_id, 'avatar' ) );
			$avatar_defaults[$custom_avatar] = __( 'Custom avatar', 'wolf' );
		}

		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'wolf_gravatar' );
}

if ( ! function_exists( 'wolf_favicons' ) ) {
	/**
	 * Add favicons (images/favicons)
	 *
	 * @return string
	 */
	function wolf_favicons() {
		$favicon     = ( wolf_get_theme_option( 'favicon' ) ) ? wolf_get_theme_option( 'favicon' ) : wolf_get_theme_uri( '/images/favicons/favicon.ico' );
		$favicon_57  = ( wolf_get_theme_option( 'favicon_57' ) ) ? wolf_get_url_from_attachment_id( wolf_get_theme_option( 'favicon_57' ) ) : wolf_get_theme_uri( '/images/favicons/touch-icon-57x57.png' );
		$favicon_72  = ( wolf_get_theme_option( 'favicon_72' ) ) ? wolf_get_url_from_attachment_id( wolf_get_theme_option( 'favicon_72' ) ) : wolf_get_theme_uri( '/images/favicons/touch-icon-72x72.png' );
		$favicon_114 = ( wolf_get_theme_option( 'favicon_114' ) ) ? wolf_get_url_from_attachment_id( wolf_get_theme_option( 'favicon_114' ) ) : wolf_get_theme_uri( '/images/favicons/touch-icon-114x114.png' );
		?>
		<!-- Favicons -->
		<link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>">
		<link rel="apple-touch-icon" href="<?php echo esc_url( $favicon_57 ); ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $favicon_72 ); ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $favicon_114 ); ?>">
		<?php
	}
	add_action( 'wolf_meta_head', 'wolf_favicons' );
}

if ( ! function_exists( 'wolf_custom_login_logo' ) ) {
	/**
	 * Custom Login Logo Option
	 *
	 * @return int
	 */
	function wolf_custom_login_logo() {

		$login_logo_id = wolf_get_theme_option( 'login_logo' );

		if ( $login_logo_id )
			echo '<style  type="text/css"> h1 a { background-image:url(' . wolf_get_url_from_attachment_id( $login_logo_id, 'avatar' ) .' )  !important; } </style>';
	}
	add_action( 'login_head',  'wolf_custom_login_logo' );
}

if ( ! function_exists( 'wolf_credits' ) ) {
	/**
	 * Copyright/site info text
	 */
	function wolf_credits() {

		$footer_text = wolf_get_theme_option( 'copyright_textbox' );

		if ( $footer_text ) {

			echo '<div class="site-infos text-center clearfix">';
			echo wp_kses(
				$footer_text,
				array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				)
			);
			echo '</div>';
		}
	}
	add_action( 'wolf_site_info', 'wolf_credits' );
}

if ( ! function_exists( 'wolf_output_js_from_options' ) ) {
	/**
	 * Output js code in the page footer
	 *
	 * @return string
	 */
	function wolf_output_js_from_options() {

		$js_code = wolf_get_theme_option( 'js_code' );

		if ( $js_code ) {
			echo '<!-- Custom JS -->';
			echo stripslashes( $js_code );
		}
	}
	add_action( 'wolf_body_end', 'wolf_output_js_from_options' );
}

if ( ! function_exists( 'wolf_remove_more_jump_link' ) ) {
	/**
	 * Avoid page jump when clicking on more link
	 *
	 * @param string $link
	 * @return string $link
	 */
	function wolf_remove_more_jump_link( $link )  {
		$offset = strpos( $link, '#more-' );
		$end    = null;
		if ( $offset ) {
			$end = strpos( $link, '"',$offset );
		}
		if ( $end ) {
			$link = substr_replace( $link, '', $offset, $end-$offset );
		}
		return $link;
	}
	add_filter( 'the_content_more_link', 'wolf_remove_more_jump_link' );
}

if ( ! function_exists( 'wolf_get_blog_url' ) ) {
	/**
	 * Get the blog page URL
	 *
	 * @return string
	 */
	function wolf_get_blog_url() {
		if ( $posts_page_id = get_option( 'page_for_posts' ) ) {
			return home_url( get_page_uri( $posts_page_id ) );
		} else {
			return home_url();
		}
	}
}

if ( ! function_exists( 'wolf_get_blog_id' ) ) {
	/**
	 * Get the blog page URL
	 *
	 * @return string
	 */
	function wolf_get_blog_id() {
		if ( $posts_page_id = get_option( 'page_for_posts' ) ) {
			return $posts_page_id;
		}
	}
}

if ( ! function_exists( 'wolf_format_number' ) ) {
	/**
	 * Format number : 1000 -> 1K
	 *
	 * @param int $n
	 * @return string
	 */
	function wolf_format_number( $n ){

		$s   = array( 'K', 'M', 'G', 'T' );
		$out = '';
		while ( $n >= 1000 && count( $s ) > 0) {
			$n   = $n / 1000.0;
			$out = array_shift( $s );
		}
		return round( $n, max( 0, 3 - strlen( (int)$n ) ) ) ." $out";
	}
}
