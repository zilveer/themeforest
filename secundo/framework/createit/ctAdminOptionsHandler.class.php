<?php

/**
 * Admin options handler
 * @author alex
 */
class ctAdminOptionsHandler {

	/**
	 * Creates admin handler
	 */
	public function __construct() {
	}

	/**
	 * Inits events
	 */

	public function init() {
		add_action( 'login_head', array( $this, 'handleLoginLogoOption' ) );

		add_filter( 'pre_option_page_on_front', array( $this, 'handlePreOptionPageOnFront' ) );
		add_filter( 'pre_option_show_on_front', array( $this, 'handlePreOptionShowOnFront' ) );
		add_filter( 'pre_option_page_for_posts', array( $this, 'handlePreOptionPageForPosts' ) );
		add_filter( 'pre_option_posts_per_page', array( $this, 'handlePreOptionPostsPerPage' ) );

	}

	/**
	 * Handles login logo options
	 */

	public static function handleLoginLogoOption() {
		if ( ! ct_options_initialized() ) {
			return;
		}


		if (function_exists('ct_get_context_option')){
			if ( $logo = esc_url( ct_get_context_option( 'general_login_logo' ) ) ) {
				$additional = '';
				if ( $height = ct_get_context_option( 'general_login_logo_height' ) ) {
					$width = 'width:' . ((int)ct_get_context_option( 'general_login_logo_width' )) . 'px';
					if ( ct_get_context_option( 'general_login_logo_width' ) > 320 ) {
						$width = 'width:100%;-webkit-background-size: 100%;background-size: 100%;';
					}

					$additional = 'height:' . ((int)$height) . 'px;' . $width;
				}
				echo '<style type="text/css">';
				echo '.login h1 a { background: url(' . esc_url($logo) . ') center center no-repeat;' . $additional . '}';
				echo '</style>';
			}
		}else{
			if ( $logo = esc_url( ct_get_option( 'general_login_logo' ) ) ) {
				$additional = '';
				if ( $height = ct_get_option( 'general_login_logo_height' ) ) {
					$width = 'width:' . ((int)ct_get_option( 'general_login_logo_width' )) . 'px';
					if ( ct_get_option( 'general_login_logo_width' ) > 320 ) {
						$width = 'width:100%;-webkit-background-size: 100%;background-size: 100%;';
					}

					$additional = 'height:' . ((int)$height) . 'px;' . $width;
				}
				echo '<style type="text/css">';
				echo '.login h1 a { background: url(' . esc_url($logo) . ') center center no-repeat;' . $additional . '}';
				echo '</style>';
			}
		}

	}

	/**
	 * Handles main page setting
	 * @see Settings -> Reading -> Static page -> Front page
	 */

	public static function handlePreOptionPageOnFront( $value ) {
		if ( ! ct_options_initialized() ) {
			return $value;
		}
		if ( ct_has_option( 'pages_home_page' ) ) {
			$value = ct_get_option( 'pages_home_page' );
		} else {
			return $value;
		}


		//WPML
		if ( function_exists( 'icl_object_id' ) ) {
			$value = icl_object_id( $value, 'page', true );
		}

		return $value;
	}

	/**
	 * Handles main page setting
	 * @see Settings -> Reading -> Static page -> Posts page
	 */

	public static function handlePreOptionPageForPosts( $v ) {
		if ( ! ct_options_initialized() ) {
			return $v;
		}

		if ( ct_has_option( 'posts_index_page' ) ) {
			$value = ct_get_option( 'posts_index_page' );
		} else {
			return $v;
		}


		//WPML
		if ( function_exists( 'icl_object_id' ) ) {
			$value = icl_object_id( $value, 'page', true );
		}


		return $value != '' ? $value : $v;
	}


	/**
	 * Handles main page setting
	 * @see Settings -> Reading -> Static page
	 */

	public static function handlePreOptionShowOnFront( $value ) {
		if ( ! ct_options_initialized() ) {
			return $value;
		}

		if ( ! ct_has_option( 'pages_home_page' ) || ! ct_has_option( 'posts_index_page' ) ) {
			return $value;
		} else {
			$page_on_front  = absint( ct_get_option( 'pages_home_page' ) );
			$page_for_posts = absint( ct_get_option( 'posts_index_page' ) );
		}


		if ( ! $page_on_front && ! $page_for_posts ) {
			return 'posts';
		}

		if ( $page_on_front === $page_for_posts ) {
			return 'posts';
		}

		return 'page';
	}

	/**
	 * @param $v
	 *
	 * @return int
	 */
	public static function handlePreOptionPostsPerPage( $v ) {
		if ( ! ct_options_initialized() ) {
			return $v;
		}

		if ( ct_has_option( 'posts_index_per_page' ) ) {
			$pp = absint( ct_get_option( 'posts_index_per_page' ) );
		} else {
			return $v;
		}

		if ( - 1 === $pp || $pp > 0 ) {
			return $pp;
		} else {
			return $v;
		}
	}


}