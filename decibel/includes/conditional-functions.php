<?php
/**
 * Conditional functions
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_is_blog_index' ) ) {
	/**
	 * Check if we're on the blog index page
	 *
	 * @return bool
	 */
	function wolf_is_blog_index() {

		global $wp_query;

		return is_object( $wp_query ) && isset( $wp_query->queried_object ) && isset( $wp_query->queried_object->ID ) && $wp_query->queried_object->ID == get_option( 'page_for_posts' );
	}
}

if ( ! function_exists( 'wolf_is_blog' ) ) {
	/**
	 * Check if we're on a blog page
	 *
	 * @return bool
	 */
	function wolf_is_blog() {
		return ( wolf_is_blog_index() || is_archive() || ( ! get_option( 'page_for_posts' ) && is_home() ) );
	}
}

if ( ! function_exists( 'wolf_is_portfolio' ) ) {
	/**
	 * Check if we're on a portfolio page
	 *
	 * @return bool
	 */
	function wolf_is_portfolio() {

		return function_exists( 'wolf_portfolio_get_page_id' ) && is_page( wolf_portfolio_get_page_id() ) || is_tax( 'work_type' );
	}
}

if ( ! function_exists( 'wolf_is_albums' ) ) {
	/**
	 * Check if we're on a albums page
	 *
	 * @return bool
	 */
	function wolf_is_albums() {

		return function_exists( 'wolf_albums_get_page_id' ) && is_page( wolf_albums_get_page_id() ) || is_tax( 'gallery_type' );
	}
}

if ( ! function_exists( 'wolf_is_videos' ) ) {
	/**
	 * Check if we're on a videos page
	 *
	 * @return bool
	 */
	function wolf_is_videos() {

		return function_exists( 'wolf_videos_get_page_id' ) && is_page( wolf_videos_get_page_id() ) || is_tax( 'video_type' ) || is_tax( 'video_tag' );
	}
}

if ( ! function_exists( 'wolf_is_plugins' ) ) {
	/**
	 * Check if we're on a plugins page
	 *
	 * @return bool
	 */
	function wolf_is_plugins() {

		return function_exists( 'wolf_plugins_get_page_id' ) && is_page( wolf_plugins_get_page_id() ) || is_tax( 'plugin_cat' ) || is_tax( 'plugin_tag' );
	}
}

if ( ! function_exists( 'wolf_is_themes' ) ) {
	/**
	 * Check if we're on a themes page
	 *
	 * @return bool
	 */
	function wolf_is_themes() {

		return function_exists( 'wolf_themes_get_page_id' ) && is_page( wolf_themes_get_page_id() ) || is_tax( 'themes_cat' ) || is_tax( 'themes_tag' );
	}
}

if ( ! function_exists( 'wolf_is_demos' ) ) {
	/**
	 * Check if we're on a demos page
	 *
	 * @return bool
	 */
	function wolf_is_demos() {

		return function_exists( 'wolf_demos_get_page_id' ) && is_page( wolf_demos_get_page_id() ) || is_tax( 'demos_cat' ) || is_tax( 'demos_tag' );
	}
}

if ( ! function_exists( 'wolf_is_discography' ) ) {
	/**
	 * Check if we're on a discography page
	 *
	 * @return bool
	 */
	function wolf_is_discography() {

		return function_exists( 'wolf_discography_get_page_id' ) && is_page( wolf_discography_get_page_id() ) || is_tax( 'label' ) || is_tax( 'band' );
	}
}

if ( ! function_exists( 'wolf_is_home_header' ) ) {
	/**
	 * Check if home header is set
	 *
	 * @access public
	 * @return bool
	 */
	function wolf_is_home_header() {

		$header_type = wolf_get_theme_option( 'home_header_type' );

		if ( 'none' != $header_type ) {

			if ( 'standard' == $header_type && wolf_get_theme_option( 'header_bg_img' ) || wolf_get_theme_option( 'header_bg_color' ) )
				return true;

			if ( 'video' == $header_type && wolf_get_theme_option( 'video_header_bg_mp4' ) || wolf_get_theme_option( 'video_header_bg_webm' ) )
				return true;

			if ( 'wolf-slider' == $header_type )
				return true;

			if ( 'revslider' == $header_type )
				return true;

			if ( 0 < wolf_get_slide_loop()->post_count && 'featured-slider' == $header_type )
				return true;
		}
	}
}

if ( ! function_exists( 'wolf_is_slider_in_home_header' ) ) {
	/**
	 * Check if a slider shortcode is in the home header content
	 *
	 * @access public
	 * @return bool
	 */
	function wolf_is_slider_in_home_header() {

		$hero    = wolf_get_theme_option( 'home_header_content' );
		$pattern = get_shortcode_regex();

		if ( is_page_template( 'page-templates/home.php' ) ) {
			if ( $hero && preg_match( "/$pattern/s", $hero, $match ) ) {

				if ( preg_match( '/slider/i', $match[2], $match_slider ) ) {
					return true;
				}
			}
		}
	}
}

if ( ! function_exists( 'wolf_has_high_res_thumbnail' ) ) {
	/**
	 * Check the resolution of the video thumbnail
	 *
	 * @access public
	 * @param int post_id
	 * @return bool
	 */
	function wolf_has_high_res_thumbnail( $size = '', $wanted_width = 640, $wanted_height = 360, $post_id = null ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$attachment_id = get_post_thumbnail_id( $post_id );
		$image = wolf_get_url_from_attachment_id( $attachment_id, $size );
		$image = str_replace( esc_url( home_url() ) . '/', ABSPATH, $image );
		//debug( $image );
		if ( is_file( $image ) ) {
			list( $width, $height ) = getimagesize( $image );
			//debug( getimagesize( $image ) );
			if ( $wanted_width == $width && $wanted_height == $height ) {
				return true;
			}
		}
	}
}

if ( ! function_exists( 'wolf_should_display_sidebar' ) ) {
	/**
	 * Check if the main sidebar should be display
	 *
	 * @access public
	 * @return bool
	 */
	function wolf_should_display_sidebar() {

		return is_active_sidebar( 'sidebar-main' ) && 'sidebar' == wolf_get_blog_layout() && ! is_single()
		|| is_single() && 'sidebar' == wolf_get_single_blog_post_layout()
		|| is_search();
	}
}

if ( ! function_exists( 'wolf_is_woocommerce' ) ) {
	/**
	 * Check if we are on a woocommerce page
	 *
	 * @return bool
	 */
	function wolf_is_woocommerce() {

		if ( class_exists( 'Woocommerce' ) ) {

			if ( is_woocommerce() ) {
				return true;
			}

			if ( is_shop() ) {
				return true;
			}

			if ( is_checkout() || is_order_received_page() ) {
				return true;
			}

			if ( is_cart() ) {
				return true;
			}

			if ( is_account_page() ) {
				return true;
			}
		}
	}
}

if ( ! function_exists( 'wolf_is_video_search' ) ) {
	/**
	 * Check if we're on a video search results page
	 *
	 * @access public
	 * @return bool
	 */
	function wolf_is_video_search() {

		$video_search = 'grid' != wolf_get_theme_option( 'video_type' ) && is_search() && isset( $_GET['post-type'] ) && 'video' == $_GET['post-type'] && function_exists( 'wolf_videos_get_template_part' );
		return $video_search;
	}
}