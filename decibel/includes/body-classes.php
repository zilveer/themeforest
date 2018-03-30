<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_body_classes' ) ) {
	/**
	 * Add specific class to the body depending on theme options and page template
	 *
	 * @param array $classes
	 * @return array $classes
	 */
	function wolf_body_classes( $classes ) {

		global $wp_customize, $post;

		if ( isset( $wp_customize ) ) {
			$classes[] = 'is-customizer';
		}

		/**
		 * Check if VC is used
		 */
		$is_vc   = false;

		if ( is_object( $post ) ) {
			$pattern = get_shortcode_regex();
			if ( preg_match( "/$pattern/s", $post->post_content, $match ) ) {
				if ( 'vc_row' == $match[2] ) {
					$is_vc = true;
				}
			}
		}

		// $classes[] = 'do-transform';

		$classes[] = 'wolf';
		$classes[] = 'wolf-mailchimp';
		$classes[] = wolf_get_theme_slug();
		$classes[] = 'wolf-woocommerce-' . wolf_get_theme_option( 'woocommerce_layout' );

		/* Main Layout */
		$classes[] = wolf_get_theme_option( 'layout' ) . '-layout';

		/* Main Layout */
		$skin = ( wolf_get_theme_option( 'skin' ) ) ? wolf_get_theme_option( 'skin' ) : 'light';
		$classes[] = "skin-$skin";

		/* Menu */
		$classes[] = 'menu-' . wolf_get_theme_option( 'menu_style' );
		$classes[] = 'menu-' . wolf_get_theme_option( 'menu_position' );
		$classes[] = 'menu-' . wolf_get_theme_option( 'menu_skin' );

		if ( 'default' == wolf_get_theme_option( 'menu_position' ) ) {
			$classes[] = 'menu-' . wolf_get_theme_option( 'menu_width' );

			if ( 'wide' == wolf_get_theme_option( 'menu_width' ) ) {
				$classes[] = 'submenu-' . wolf_get_theme_option( 'submenu_align' );
			}
		}

		if ( 'logo-centered' == wolf_get_theme_option( 'menu_position' ) && wolf_get_theme_option( 'logo_overflow' ) ) {
			$classes[] = 'menu-logo-overflow';
		}

		$classes[] = 'menu-hover-' . wolf_get_theme_option( 'menu_hover_effect' );

		/* Secondary Menu */
		if ( wolf_get_theme_option( 'additional_toggle_menu' ) ) {
			$classes[] = 'is-secondary-menu';
		} else {
			$classes[] = 'no-secondary-menu';
		}

		/* Page header type */
		$header_post_id   = wolf_get_header_post_id();
		$page_header_type = wolf_get_theme_option( 'page_header_type' );
		$hide_title_area  = ( 'none' == wolf_get_theme_option( 'page_header_type' ) );

		if ( $header_post_id && get_post_meta( $header_post_id, '_page_header_type', true ) ) {
			$page_header_type = get_post_meta( $header_post_id, '_page_header_type', true );
			$hide_title_area  = ( 'none' == get_post_meta( $header_post_id, '_page_header_type', true ) );
		}

		if ( wolf_get_category_meta( 'page_header_type' ) ) {
			$page_header_type = wolf_get_category_meta( 'page_header_type' );
		}
		//$page_header_type = ( 'full' == $page_header_type ) ? 'big' : $page_header_type;

		$classes[] = "page-header-$page_header_type";

		/*if ( 'full' == get_post_meta( $header_post_id, '_page_header_type', true ) || 'full' == wolf_get_theme_option( 'page_header_type' ) ) {
			$classes[] = "page-header-full";
		}*/

		if ( $hide_title_area )
				$classes[] = 'no-title-area';
			else
				$classes[] = 'show-title-area';

		if ( 'left' == wolf_get_theme_option( 'menu_position' ) && $hide_title_area ) {
			$classes[] = 'left-menu-not-title-area';
		}

		if ( get_post_meta( $header_post_id, '_menu_absolute', true ) && $hide_title_area ) {
			$classes[] = 'is-home-header';
			$classes[] = 'force-absolute-menu';
		}

		/* Page template clean classes */
		if ( is_page_template( 'page-templates/full-width.php' ) || is_page_template( 'page-templates/page-with-comments.php' ) )
			$classes[] = 'page-full-width';

		if ( is_page_template( 'page-templates/small-width.php' ) )
			$classes[] = 'page-small-width';

		if ( is_page_template( 'page-templates/post-archives.php' ) )
			$classes[] = 'post-archives';

		if ( is_page_template( 'page-templates/page-sidebar-right.php' ) )
			$classes[] = 'page-sidebar-right';

		if ( is_page_template( 'page-templates/page-sidebar-left.php' ) )
			$classes[] = 'page-sidebar-left';

		if ( is_page_template( 'page-templates/coming-soon.php' ) )
			$classes[] = 'coming-soon';

		// Visual Composer Pages
		if ( 'default' == get_post_meta( get_the_ID(), '_wp_page_template', true ) ) {
			if (
				! is_search()
				&& ! wolf_is_portfolio()
				&& ! wolf_is_albums()
				&& ! wolf_is_blog()
				&& ! wolf_is_videos()
				&& ! wolf_is_plugins()
				&& ! wolf_is_themes()
				&& ! wolf_is_discography()
				&& ! wolf_is_woocommerce()
			) {
				if ( $is_vc ) {
					$classes[] = 'is-vc-page';
				} else {
					$classes[] = 'page-full-width';
				}
			}
		} elseif ( is_page_template( 'page-templates/home.php' ) && $is_vc ) {
			$classes[] = 'is-vc-page';
		}

		if ( wolf_get_theme_option( 'full_screen_header' ) && is_page_template( 'page-templates/home.php' ) && wolf_is_home_header() )
			$classes[] = 'full-window-header';

		if ( wolf_get_theme_option( 'sticky_menu' ) )
			$classes[] = 'is-sticky-menu';

		if ( wolf_get_theme_option( 'top_bar' ) )
			$classes[] = 'is-top-bar';
		else
			$classes[] = 'no-top-bar';

		if ( wolf_get_theme_option( 'fullwidth_menu' ) )
			$classes[] = 'is-fullwidth-menu';

		if (
			'yes' == wolf_get_theme_option( 'additional_toggle_menu' )
			&& 'side' == wolf_get_theme_option( 'additional_toggle_menu_type' )
			&& ( 'default' == wolf_get_theme_option( 'menu_position' ) || 'center' == wolf_get_theme_option( 'menu_position' ) || 'logo-centered' == wolf_get_theme_option( 'menu_position' ) )
		) {
			$classes[] = 'is-side-menu';
		}

		/* Add a class to hide the sidebar on mobile */
		if ( wolf_get_theme_option( 'blog_hide_sidebar_phone' ) )
			$classes[] = 'hide-sidebar-phone';

		/* No loader option class */
		if ( ! wolf_get_theme_option( 'loader' ) )
			$classes[] = 'no-loader';

		/* No transition option class */
		if ( ! wolf_get_theme_option( 'page_transition' ) )
			$classes[] = 'no-page-transition';

		/* Home Header Type */
		if (
			wolf_get_theme_option( 'home_header_type' )
			&& is_page_template( 'page-templates/home.php' ) || is_front_page()
		) {
			$classes[] = 'home-header-' . wolf_get_theme_option( 'home_header_type' );
		}

		if ( is_multi_author() )
			$classes[] = 'is-multi-author';

		if ( wolf_is_blog() ) {
			$classes[] = 'is-blog';
			$blog_type =  wolf_get_blog_layout();
			if ( 'masonry' == $blog_type )
				$classes[] = 'masonry';

			$classes[] = "blog-$blog_type";
			$classes[] = 'blog-' . wolf_get_theme_option( 'blog_width' );

			/* Infinite Scroll class */
			if ( wolf_get_theme_option( 'blog_infinite_scroll' ) )
				$classes[] = 'post-infinite-scroll';
		}

		if ( is_page_template( 'page-templates/home.php' ) || is_front_page() ) {
			$classes[] = 'is-theme-home';

			if ( wolf_is_home_header() )
				$classes[] = 'is-home-header';
			else
				$classes[] = 'no-home-header';

			if ( wolf_is_slider_in_home_header() )
				$classes[] = 'is-home-slider';
		}

		if ( get_post_meta( $header_post_id, '_hide_footer', true ) ) {
			$classes[] = 'no-footer';
		}

		if ( get_post_meta( $header_post_id, '_hide_menu', true ) ) {
			$classes[] = 'no-menu';
		}

		if ( ! is_page_template( 'page-templates/home.php' ) ) {

			/**
			 * Is header image ?
			 */
			$header_bg_type = get_post_meta( $header_post_id, '_header_bg_type', true );
			$header_bg_color = get_post_meta( $header_post_id, '_header_bg_color', true );
			$header_bg_img = get_post_meta( $header_post_id, '_header_bg_img', true );
			$header_bg_mp4 = get_post_meta( $header_post_id, '_header_video_bg_mp4', true );

			/* If category meta video bg */
			if (
				'image' == wolf_get_category_meta( 'header_bg_type' )
				&& ( wolf_get_category_meta( 'header_bg_img' ) || wolf_get_category_meta( 'header_bg_color' ) ) ) {
				$header_bg_type = 'image';
				$header_bg_img = wolf_get_category_meta( 'header_bg_img' );
			}

			/* If category meta video bg */
			if (
				'video' == wolf_get_category_meta( 'header_bg_type' )
				&& wolf_get_category_meta( 'header_video_bg_mp4' ) ) {
				$header_bg_type = 'video';
				$header_bg_mp4 = wolf_get_category_meta( 'header_video_bg_mp4' );
			}

			if ( $header_post_id && ! is_search() ) {

				if ( 'image' == $header_bg_type ) {

					if ( $header_bg_img || $header_bg_color ) {

						$classes[] = 'has-header-image';
					} else {

						$classes[] = 'no-header-image';
					}

				} elseif ( 'video' == $header_bg_type ) {

					if ( $header_bg_mp4 ) {

						$classes[] = 'has-header-image';
					} else {

						$classes[] = 'no-header-image';
					}
				}
			}

			/* is 404 header image? */
			if ( is_404() ) {
				if ( wolf_get_theme_option( '404_bg' ) ) {
					$classes[] = 'has-header-image';
				} else {
					$classes[] = 'no-header-image';
				}
			}
		}

		if ( wolf_is_portfolio() ) {

			if ( 'modern' != wolf_get_theme_option( 'work_type' ) && 'vertical' != wolf_get_theme_option( 'work_type' ) )
				$classes[] = 'masonry';

			$classes[] = 'work-' . wolf_get_theme_option( 'work_width' );
			$classes[] = 'work-' . wolf_get_theme_option( 'work_type' );
			$classes[] = 'work-' . wolf_get_theme_option( 'work_padding' );

			/* Infinite Scroll class */
			if ( wolf_get_theme_option( 'work_infinite_scroll' ) && 'masonry-horizontal' != wolf_get_theme_option( 'work_type' ) )
				$classes[] = 'work-infinite-scroll';

			if ( wolf_get_theme_option( 'work_isotope' ) && 'masonry-horizontal' != wolf_get_theme_option( 'work_type' ) )
				$classes[] = 'work-isotope';
		}

		if ( wolf_is_albums() ) {
			if ( 'modern' != wolf_get_theme_option( 'gallery_type' ) && 'vertical' != wolf_get_theme_option( 'gallery_type' ) )
				$classes[] = 'masonry';

			$classes[] = 'gallery-' . wolf_get_theme_option( 'gallery_type' );
			$classes[] = 'gallery-' . wolf_get_theme_option( 'gallery_width' );
			$classes[] = 'gallery-' . wolf_get_theme_option( 'gallery_padding' );

			if ( wolf_get_theme_option( 'gallery_infinite_scroll' ) )
				$classes[] = 'gallery-infinite-scroll';

			if ( wolf_get_theme_option( 'gallery_isotope' ) )
				$classes[] = 'gallery-isotope';
		}

		if ( wolf_is_video_search() ) {
			$classes[] = 'wolf-videos-search-results';
		}

		if ( wolf_is_videos() ) {
			$classes[] = 'masonry';
			$classes[] = 'video-' . wolf_get_theme_option( 'video_width' );
			$classes[] = 'video-' . wolf_get_theme_option( 'video_padding' );
			$classes[] = 'video-' . wolf_get_theme_option( 'video_type' );

			if ( wolf_get_theme_option( 'video_infinite_scroll' ) )
				$classes[] = 'video-infinite-scroll';

			if ( wolf_get_theme_option( 'video_isotope' ) )
				$classes[] = 'video-isotope';
		}

		if ( wolf_is_discography() ) {
			$classes[] = 'release-' . wolf_get_theme_option( 'release_width' );
			$classes[] = 'release-' . wolf_get_theme_option( 'release_padding' );
			$classes[] = 'release-' . wolf_get_theme_option( 'release_type' );
		}

		elseif ( is_singular( 'video' ) ) {
			$classes[] = 'video-' . wolf_get_theme_option( 'video_type' );
		}

		if ( is_singular( 'gallery' ) ) {
			if ( ! wolf_get_theme_option( 'gallery_comments' ) && ! wolf_get_theme_option( 'gallery_share' ) ) {
				$classes[] = 'single-gallery-no-padding-bottom';
			}
		}

		if ( is_singular( 'post' ) && 'sidebar' == wolf_get_single_blog_post_layout() )
			$classes[] = 'post-has-sidebar';

		return $classes;
	}
	add_filter( 'body_class', 'wolf_body_classes' );
}
