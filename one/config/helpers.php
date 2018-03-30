<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists( 'thb_page_password_protected' ) ) {
	/**
	 * Handle password-protected pages and posts.
	 */
	function thb_page_password_protected() {
		if ( post_password_required() ) {
			get_template_part('partials/partial-pass-protected');
			get_footer();
			die();
		}
	}

	add_action( 'thb_page_before', 'thb_page_password_protected' );
	add_action( 'thb_post_before', 'thb_page_password_protected' );
}

if( ! function_exists( 'thb_get_social_networks' ) ) {
	/**
	 * Get a list of the defined social networks available for the theme.
	 * Filters empty social networks.
	 *
	 * @return array
	 */
	function thb_get_social_networks() {
		$social_networks = thb_get_option('social_networks');

		if ( ! empty( $social_networks ) ) {
			$social_networks_array = array();

			foreach ( explode( ',', $social_networks ) as $social_network ) {
				if ( thb_get_social_network_url( $social_network ) != '' ) {
					$social_networks_array[] = $social_network;
				}
			}

			return $social_networks_array;
		}

		return array();
	}
}

if( ! function_exists( 'thb_get_social_network_url' ) ) {
	/**
	 * Get the URL of a specific social network service.
	 *
	 * @param string $social_network The social network key.
	 * @return string
	 */
	function thb_get_social_network_url( $social_network ) {
		return thb_get_option( $social_network );
	}
}

if( !function_exists('thb_is_enable_social_share') ) {
	/**
	 * Check if the social share option is checked
	 * @return boolean
	 */
	function thb_is_enable_social_share() {
		if ( thb_get_option( 'enable_social_share' ) == 1 ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_get_layout_width') ) {
	/**
	 * Get the layout_width option value
	 *
	 * @return string
	 */
	function thb_get_layout_width() {
		$thb_layout_width = thb_get_option('layout_width');
		$thb_layout_width = apply_filters( 'thb_get_layout_width', $thb_layout_width );

		if ( empty( $thb_layout_width ) ) {
			return 'layout-width-extended';
		}

		return $thb_layout_width;
	}
}

if( !function_exists('thb_is_layout_boxed') ) {
	/**
	 * Check if the layout width option is "boxed"
	 *
	 * @return boolean
	 */
	function thb_is_layout_boxed() {
		if ( thb_get_layout_width() === 'layout-width-boxed' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_layout_extended') ) {
	/**
	 * Check if the layout width option is "extended"
	 *
	 * @return boolean
	 */
	function thb_is_layout_extended() {
		if ( thb_get_layout_width() === 'layout-width-extended' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_get_header_layout') ) {
	/**
	 * Get the main theme header layout option value
	 *
	 * @return string
	 */
	function thb_get_header_layout() {
		$thb_header_layout = thb_get_option('header_layout');
		$thb_header_layout = apply_filters( 'thb_get_header_layout', $thb_header_layout );

		if ( empty( $thb_header_layout ) ) {
			return 'layout-a';
		}

		return $thb_header_layout;
	}
}

if( !function_exists('thb_is_header_layout_a') ) {
	/**
	 * Check if the header layout is "A"
	 *
	 * @return boolean
	 */
	function thb_is_header_layout_a() {
		if ( thb_get_header_layout() === 'layout-a' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_header_layout_b') ) {
	/**
	 * Check if the header layout is "B"
	 *
	 * @return boolean
	 */
	function thb_is_header_layout_b() {
		if ( thb_get_header_layout() === 'layout-b' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_get_page_header_alignment') ) {
	/**
	 * Get the page header alignment option value
	 *
	 * @return string
	 */
	function thb_get_page_header_alignment() {
		$thb_get_page_header_alignment = thb_get_post_meta( thb_get_page_ID(), 'one_page_header_alignment' );

		if( empty( $thb_get_page_header_alignment ) ) {
			return 'pageheader-alignment-left';
		}

		return apply_filters( 'thb_get_page_header_alignment', $thb_get_page_header_alignment );
	}
}

if( !function_exists('thb_get_page_header_layout') ) {
	/**
	 * Get the page header layout option value
	 *
	 * @return string
	 */
	function thb_get_page_header_layout() {
		$thb_get_page_header_layout = thb_get_post_meta( thb_get_page_ID(), 'one_page_header_layout' );
		$thb_get_page_header_layout = apply_filters( 'thb_get_page_header_layout', $thb_get_page_header_layout );

		if( empty( $thb_get_page_header_layout ) ) {
			$thb_get_page_header_layout = 'pageheader-layout-a';
		}

		return $thb_get_page_header_layout;
	}
}

if( !function_exists('thb_is_page_header_layout_a') ) {
	/**
	 * Check if the page header layout is "A"
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_a() {
		if ( thb_get_page_header_layout() === 'pageheader-layout-a' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_b') ) {
	/**
	 * Check if the page header layout is "B"
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_b() {
		if ( thb_get_page_header_layout() === 'pageheader-layout-b' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_c') ) {
	/**
	 * Check if the page header layout is "C"
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_c() {
		if ( thb_get_page_header_layout() === 'pageheader-layout-c' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_d') ) {
	/**
	 * Check if the page header layout is "D"
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_d() {
		if ( thb_get_page_header_layout() === 'pageheader-layout-d' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_e') ) {
	/**
	 * Check if the page header layout is "E"
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_e() {
		if ( thb_get_page_header_layout() === 'pageheader-layout-e' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_f') ) {
	/**
	 * Check if the page header layout is "F"
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_f() {
		if ( thb_get_page_header_layout() === 'pageheader-layout-f' ) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_extended') ) {
	/**
	 * Check if the page header layout is extended.
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_extended() {
		if (
			thb_is_page_header_layout_c() ||
			thb_is_page_header_layout_d() ||
			thb_is_page_header_layout_e() ||
			thb_is_page_header_layout_f()
		) {
			return true;
		}

		return false;
	}
}

if( !function_exists('thb_is_page_header_layout_extended_with_title') ) {
	/**
	 * Check if the page header layout is extended with the page title displayed on top of it.
	 *
	 * @return boolean
	 */
	function thb_is_page_header_layout_extended_with_title() {
		if (
			thb_is_page_header_layout_d() ||
			thb_is_page_header_layout_f()
		) {
			return true;
		}

		return false;
	}
}

if( ! function_exists( 'thb_is_portfolio_likes_active' ) ) {
	/**
	 * Check if likes have been activated for Portfolio items.
	 *
	 * @return boolean
	 */
	function thb_is_portfolio_likes_active() {
		return (int) thb_get_option( 'thb_portfolio_likes_active' ) == 1;
	}
}

if( ! function_exists( 'thb_is_blog_likes_active' ) ) {
	/**
	 * Check if likes have been activated for Blog posts.
	 *
	 * @return boolean
	 */
	function thb_is_blog_likes_active() {
		return (int) thb_get_option( 'thb_blog_likes_active' ) == 1;
	}
}

if( !function_exists('thb_get_blog_loop_layout') ) {
	/**
	 * Get the blog loop layout option value
	 *
	 * @return string
	 */
	function thb_get_blog_loop_layout() {
		$thb_get_blog_loop_layout = thb_get_post_meta( thb_get_page_ID(), 'one_blog_loop_layout' );

		if( empty( $thb_get_blog_loop_layout ) ) {
			return 'blog-loop-layout-a';
		}

		return $thb_get_blog_loop_layout;
	}
}

if( !function_exists('thb_get_project_short_description') ) {
	/**
	 * Get the project short description
	 *
	 * @return string
	 */
	function thb_get_project_short_description( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'project_short_description' );
	}
}

if( !function_exists('thb_get_project_url') ) {
	/**
	 * Get the project URL
	 *
	 * @return string
	 */
	function thb_get_project_url() {
		return thb_get_post_meta( thb_get_page_ID(), 'project_url' );
	}
}

if( !function_exists('thb_get_portfolio_layout') ) {
	/**
	 * Get the 'one_portfolio_layout' portfolio meta value
	 *
	 * @return string
	 */
	function thb_get_portfolio_layout( $layout = false ) {
		if ( $layout === false ) {
			$thb_get_portfolio_layout = thb_get_post_meta( thb_get_page_ID(), 'one_portfolio_layout' );
		}
		else {
			$thb_get_portfolio_layout = $layout;
		}

		if( empty( $thb_get_portfolio_layout ) ) {
			return 'thb-portfolio-grid-a';
		}

		return $thb_get_portfolio_layout;
	}
}

if( !function_exists('thb_is_portfolio_grid_a') ) {
	/**
	 * Check if the portfolio grid layout is A
	 * @return boolean
	 */
	function thb_is_portfolio_grid_a() {
		if ( thb_get_portfolio_layout() == 'thb-portfolio-grid-a' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_portfolio_grid_b') ) {
	/**
	 * Check if the portfolio grid layout is B
	 * @return boolean
	 */
	function thb_is_portfolio_grid_b() {
		if ( thb_get_portfolio_layout() == 'thb-portfolio-grid-b' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_portfolio_grid_c') ) {
	/**
	 * Check if the portfolio grid layout is C
	 * @return boolean
	 */
	function thb_is_portfolio_grid_c() {
		if ( thb_get_portfolio_layout() == 'thb-portfolio-grid-c' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_portfolio_grid_d') ) {
	/**
	 * Check if the portfolio grid layout is D
	 * @return boolean
	 */
	function thb_is_portfolio_grid_d() {
		if ( thb_get_portfolio_layout() == 'thb-portfolio-grid-d' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_get_portfolio_filter_alignment') ) {
	/**
	 * Get the 'one_portfolio_filter_alignment' portfolio meta value
	 *
	 * @return string
	 */
	function thb_get_portfolio_filter_alignment() {
		$thb_get_portfolio_filter_alignment = thb_get_post_meta( thb_get_page_ID(), 'one_portfolio_filter_alignment' );

		if( empty( $thb_get_portfolio_filter_alignment ) ) {
			return 'filter-alignment-left';
		}

		return $thb_get_portfolio_filter_alignment;
	}
}

if( !function_exists('thb_get_disable_work_image_link') ) {
	function thb_get_disable_work_image_link( $id = null ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'disable_work_image_link' );
	}
}

if( !function_exists('thb_get_single_work_layout') ) {
	/**
	 * Get the 'one_single_work_layout' single work meta value
	 *
	 * @return string
	 */
	function thb_get_single_work_layout( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		$thb_get_single_work_layout = thb_get_post_meta( $id, 'one_single_work_layout' );
		$thb_get_single_work_layout = apply_filters( 'thb_get_single_work_layout', $thb_get_single_work_layout );

		if( empty( $thb_get_single_work_layout ) ) {
			return 'thb-single-work-layout-a';
		}

		return $thb_get_single_work_layout;
	}
}

if( !function_exists('thb_is_single_work_layout_a') ) {
	/**
	 * Check if the single work layout is A
	 * @return boolean
	 */
	function thb_is_single_work_layout_a( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		if ( thb_get_single_work_layout( $id ) == 'thb-single-work-layout-a' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_single_work_layout_b') ) {
	/**
	 * Check if the single work layout is B
	 * @return boolean
	 */
	function thb_is_single_work_layout_b( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		if ( thb_get_single_work_layout( $id ) == 'thb-single-work-layout-b' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_single_work_layout_c') ) {
	/**
	 * Check if the single work layout is C
	 * @return boolean
	 */
	function thb_is_single_work_layout_c( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		if ( thb_get_single_work_layout( $id ) == 'thb-single-work-layout-c' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_thb_sticky_header') ) {
	/**
	 * Check if the sticky header option is active
	 * @return boolean
	 */
	function thb_is_thb_sticky_header() {
		$thb_sticky_header = thb_get_option( 'thb_sticky_header' ) == 1;
		$thb_sticky_header = apply_filters( 'thb_sticky_header', $thb_sticky_header );

		return (int) $thb_sticky_header;
	}
}

if( !function_exists('thb_is_disabled_fittext') ) {
	/**
	 * Check if the thb_disable_fittext option is active
	 * @return boolean
	 */
	function thb_is_disabled_fittext() {
		$thb_disable_fittext = thb_get_option( 'thb_disable_fittext' ) == 1;
		$thb_disable_fittext = apply_filters( 'thb_disable_fittext', $thb_disable_fittext );

		return (int) $thb_disable_fittext;
	}
}

if( !function_exists('thb_is_enabled_search') ) {
	/**
	 * Check if the thb_enable_search option is active
	 * @return boolean
	 */
	function thb_is_enabled_search() {
		$thb_enable_search = thb_get_option( 'thb_enable_search' ) == 1;
		$thb_enable_search = apply_filters( 'thb_enable_search', $thb_enable_search );

		return (int) $thb_enable_search;
	}
}

if ( ! function_exists( 'thb_one_get_header_skin' ) ) {
	/**
	 * Get the CSS skin class to be applies to the page-header-wrapper element, and the header.
	 *
	 * @return string
	 */
	function thb_one_get_header_skin() {
		$skin = '';
		$pagecontent_color = get_theme_mod('body_bg', '#ffffff');

		if ( thb_is_page_header_layout_extended() ) {
			$overlay_color = thb_get_post_meta( thb_get_page_ID(), 'header_background_overlay_color' );
			$header_background_color = thb_get_post_meta( thb_get_page_ID(), 'header_background_background_color' );
			$skin = 'thb-skin-' . thb_color_get_skin_from_comparison( $overlay_color, $header_background_color, $pagecontent_color );
		} else {
			$skin = thb_pagecontent_skin();
		}

		$skin = apply_filters( 'thb_one_get_header_skin', $skin );

		return $skin;
	}
}

if ( ! function_exists( 'thb_one_get_pageheader_skin' ) ) {
	/**
	 * Get the CSS skin class to be applies to the page-header-wrapper element, and the header.
	 *
	 * @return string
	 */
	function thb_one_get_pageheader_skin() {
		$skin = '';
		$pagecontent_color = get_theme_mod('body_bg', '#ffffff');

		if ( thb_is_page_header_layout_d() || thb_is_page_header_layout_f() ) {
			$overlay_color = thb_get_post_meta( thb_get_page_ID(), 'header_background_overlay_color' );
			$header_background_color = thb_get_post_meta( thb_get_page_ID(), 'header_background_background_color' );
			$skin = 'thb-skin-' . thb_color_get_skin_from_comparison( $overlay_color, $header_background_color, $pagecontent_color );
		} else {
			$skin = thb_pagecontent_skin();
		}

		return $skin;
	}
}

if ( ! function_exists( 'thb_one_pageheader_parallax' ) ) {
	/**
	 * Check if the page header has parallax.
	 *
	 * @return boolean
	 */
	function thb_one_pageheader_parallax() {
		return thb_get_post_meta( thb_get_page_ID(), 'one_page_header_parallax' ) == '1';
	}
}

if( ! function_exists('thb_logo') ) {
	/**
	 * Display a graphic logo or its textual counterpart.
	 */
	function thb_logo() {
		$logo             = apply_filters( 'thb_logo', thb_get_option( 'main_logo' ) );
		$logo_white       = apply_filters( 'thb_logo_white', thb_get_option( 'white_main_logo' ) );
		$logo_2x          = apply_filters( 'thb_logo_2x', thb_get_option( 'main_logo_retina' ) );
		$logo_2x_white    = apply_filters( 'thb_logo_2x_white', thb_get_option( 'white_main_logo_retina' ) );
		$logo_description = apply_filters( 'thb_logo_description', get_bloginfo( 'description' ) );

		$args = array(
			'logo'          => thb_image_get_size( $logo ),
			'logo_white'    => thb_image_get_size( $logo_white ),
			'logo_2x'       => thb_image_get_size( $logo_2x ),
			'logo_2x_white' => thb_image_get_size( $logo_2x_white ),
			'description'   => $logo_description,
		);

		if ( ! empty( $args['logo'] ) && ! empty( $args['logo_2x'] ) ) {
			$args['logo_metadata'] = wp_get_attachment_metadata( $logo );
		}

		thb_get_subtemplate( 'backpack/general', dirname(__FILE__), 'logo', $args );
	}
}

if ( ! function_exists( 'thb_thumbnails_open_post' ) ) {
	/**
	 * Check if post thumbnails in Blog loops should link to the post page instead
	 * of opening their image or lightbox.
	 *
	 * @param integer $id
	 * @return boolean
	 */
	function thb_thumbnails_open_post( $id = null ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'thumbnails_open_post' ) == '1';
	}
}

if( !function_exists('thb_get_subtitle_position') ) {
	function thb_get_subtitle_position( $id = null ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		$subtitle_position = thb_get_post_meta( $id, 'one_subtitle_position' );

		if ( empty( $subtitle_position ) ) {
			return 'subtitle-top';
		}

		return $subtitle_position;
	}
}

if( !function_exists('thb_is_subtitle_position_top') ) {
	/**
	 * Check if the subtitle position is top
	 * @return boolean
	 */
	function thb_is_subtitle_position_top() {
		if ( thb_get_subtitle_position() == 'subtitle-top' ) {
			return true;
		}
		return false;
	}
}

if( !function_exists('thb_is_subtitle_position_bottom') ) {
	/**
	 * Check if the subtitle position is bottom
	 * @return boolean
	 */
	function thb_is_subtitle_position_bottom() {
		if ( thb_get_subtitle_position() == 'subtitle-bottom' ) {
			return true;
		}
		return false;
	}
}