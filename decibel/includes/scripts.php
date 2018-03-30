<?php
/**
 * Enqueue Scripts
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_enqueue_scripts' ) ) {
	/**
	 * Register theme scripts for the theme
	 *
	 * We will use the wp_enqueue_scripts function in framework/wolf-core.php to enqueue scripts
	 *
	 */
	function wolf_enqueue_scripts() {

		$theme_slug = wolf_get_theme_slug();

		// Ensure to overwrite scripts enqueued by a plugin
		wp_dequeue_script( 'flexslider' );
		wp_deregister_script( 'flexslider' );
		wp_dequeue_script( 'swipebox' );
		wp_deregister_script( 'swipebox' );
		wp_dequeue_script( 'fancybox' );
		wp_deregister_script( 'fancybox' );
		wp_dequeue_script( 'isotope' );
		wp_deregister_script( 'isotope' );
		wp_dequeue_script( 'imagesloaded' );
		wp_deregister_script( 'imagesloaded' );

		// Modernizr
		wp_enqueue_script( 'modernizr', WOLF_THEME_URI . '/js/lib/modernizr.js', '', '2.8.3', false );

		// Register scripts
		wp_register_script( 'infinite-scroll', WOLF_THEME_URI . '/js/lib/jquery.infinitescroll.min.js', 'jquery', '2.0.2', true );

		// Countdown
		wp_register_script( 'countdown', WOLF_THEME_URI . '/js/lib/jquery.countdown.min.js', 'jquery', '2.0.1', true );
		wp_register_script( 'theme-countdown', WOLF_THEME_URI . '/js/countdown.js', 'jquery', WOLF_THEME_VERSION, true );

		// Enqueue theme scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'wp-mediaelement' ); // enqueue WP media

		// Check lightbox option
		if ( 'swipebox' == wolf_get_theme_option( 'lightbox' ) ) {

			wp_enqueue_script( 'swipebox', WOLF_THEME_URI . '/js/lib/jquery.swipebox.min.js', 'jquery', '1.3.0.2', true );

		} elseif ( 'fancybox' == wolf_get_theme_option( 'lightbox' ) ) {

			wp_enqueue_script( 'fancybox', WOLF_THEME_URI . '/js/lib/jquery.fancybox.pack.js', 'jquery', '2.1.5', true );
			wp_enqueue_script( 'fancybox-media', WOLF_THEME_URI . '/js/lib/jquery.fancybox-media.min.js', 'jquery', '1.0.6', true );
		}

		// Parallax fallback for IE ( haParallax that uses translate doesn't work well )
		if ( wolf_is_ie() ) {
			wp_enqueue_script( 'parallax-bg', WOLF_THEME_URI . '/js/lib/jquery.parallax.min.js', 'jquery', '1.1.3', true );
		}

		// Register theme specific scripts
		if ( wolf_get_theme_option( 'js_min' ) ) {

			wp_register_script( 'infinite-scroll-blog', WOLF_THEME_URI . '/js/min/jquery.infinitescroll-blog.min.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_register_script( 'gallery', WOLF_THEME_URI . '/js/min/jquery.gallery.min.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_register_script( 'item-masonry', WOLF_THEME_URI . '/js/min/jquery.item-masonry.min.js', 'jquery', WOLF_THEME_VERSION, true );

			$tmp= WOLF_THEME_VERSION;
			//$tmp = time();
			wp_enqueue_script( "$theme_slug", WOLF_THEME_URI . '/js/min/app.min.js', 'jquery', "$tmp", true );
			wp_register_script( $theme_slug . '-one-page', WOLF_THEME_URI . '/js/jquery.one-page.js', 'jquery', WOLF_THEME_VERSION, true );

		} else {
			wp_register_script( 'infinite-scroll-blog', WOLF_THEME_URI . '/js/jquery.infinitescroll-blog.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_register_script( 'gallery', WOLF_THEME_URI . '/js/jquery.gallery.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_register_script( 'item-masonry', WOLF_THEME_URI . '/js/jquery.item-masonry.js', 'jquery', WOLF_THEME_VERSION, true );

			//wp_enqueue_script( 'nicescroll', WOLF_THEME_URI . '/js/lib/jquery.nicescroll.min.js', 'jquery', '3.5.4', true );

			wp_enqueue_script( 'isotope', WOLF_THEME_URI . '/js/lib/isotope.pkgd.min.js', 'jquery', '2.0.1', true );
			wp_enqueue_script( 'imageloaded', WOLF_THEME_URI . '/js/lib/imagesloaded.pkgd.min.js', 'jquery', '3.1.8', true );

			wp_enqueue_script( 'wow', WOLF_THEME_URI . '/js/lib/wow.min.js', 'jquery', '1.0.1', true );
			wp_enqueue_script( 'waypoints', WOLF_THEME_URI . '/js/lib/waypoints.min.js', 'jquery', '1.6.2', true );
			wp_enqueue_script( 'flexslider', WOLF_THEME_URI . '/js/lib/jquery.flexslider.min.js', 'jquery', '2.2.2', true );
			wp_enqueue_script( 'owlcarousel', WOLF_THEME_URI . '/js/lib/owl.carousel.min.js', array( 'jquery' ), '2.0.0', true );

			wp_enqueue_script( 'parallax', WOLF_THEME_URI . '/js/lib/jquery.haParallax.js', 'jquery', '1.0.0', true );
			wp_enqueue_script( 'counterup', WOLF_THEME_URI . '/js/lib/jquery.counterup.min.js', 'jquery', '1.0', true );
			wp_enqueue_script( 'cookie', WOLF_THEME_URI . '/js/lib/jquery.memo.min.js', 'jquery', '1.0', true );

			wp_enqueue_script( 'fittext', WOLF_THEME_URI . '/js/lib/jquery.fittext.js', array( 'jquery' ), '1.2', true );
			wp_enqueue_script( 'wolf-slider', WOLF_THEME_URI . '/js/jquery.wolfSlider.js', array( 'jquery' ), WOLF_THEME_VERSION, true );

			wp_enqueue_script( 'carousels', WOLF_THEME_URI . '/js/jquery.carousels.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_enqueue_script( 'viewsnlikes', WOLF_THEME_URI . '/js/jquery.likesnviews.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_enqueue_script( 'youtube-video-bg', WOLF_THEME_URI . '/js/youtube-video-bg.js', 'jquery', WOLF_THEME_VERSION, true );

			$tmp= WOLF_THEME_VERSION;
			//$tmp = time();
			wp_enqueue_script( "$theme_slug", WOLF_THEME_URI . '/js/jquery.functions.js', 'jquery', "$tmp", true );

			wp_register_script( $theme_slug . '-one-page', WOLF_THEME_URI . '/js/jquery.one-page.js', 'jquery', WOLF_THEME_VERSION, true );
		}

		wp_register_script( 'packery', WOLF_THEME_URI . '/js/lib/packery-mode.pkgd.min.js', 'jquery', '0.1.0', true );

		if ( wolf_get_theme_option( 'one_page_menu' ) ) {
			wp_enqueue_script( $theme_slug . '-one-page' );
		}

		// Check the current post type for the ones that uses masonry
		$current_post_type = array();

		if ( wolf_is_blog() ) {

			$current_post_type = array(
				'postType' => 'post',
				'name' => 'blog',
				'trigger' => wolf_get_theme_option( 'blog_infinite_scroll_trigger' ),
			);

		} elseif ( wolf_is_portfolio() ) {

			$current_post_type = array(
				'postType' => 'work',
				'name' => 'work',
				'trigger' => wolf_get_theme_option( 'work_infinite_scroll_trigger' ),
			);

		} elseif ( wolf_is_videos() ) {

			$current_post_type = array(
				'postType' => 'video',
				'name' => 'videos',
				'trigger' => wolf_get_theme_option( 'video_infinite_scroll_trigger' ),
			);

		} elseif ( wolf_is_albums() ) {
			$current_post_type = array(
				'postType' => 'gallery',
				'name' => 'albums',
				'trigger' => wolf_get_theme_option( 'gallery_infinite_scroll_trigger' ),
			);

		} elseif ( function_exists( 'wolf_is_plugins' ) && wolf_is_plugins() ) {
			$current_post_type = array(
				'postType' => 'plugin',
				'name' => 'plugins',
			);

		} elseif ( function_exists( 'wolf_is_themes' ) && wolf_is_themes() ) {
			$current_post_type = array(
				'postType' => 'theme',
				'name' => 'themes',
			);

		} elseif ( function_exists( 'wolf_is_demos' ) && wolf_is_demos() ) {
			$current_post_type = array(
				'postType' => 'demo',
				'name' => 'demos',
			);
		}

		// Add JS global variables
		wp_localize_script(
			"$theme_slug", 'WolfThemeParams', array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'siteUrl' => esc_url( home_url( '/' ) ),
				'accentColor' => get_theme_mod( 'accent_color' ),
				'headerPercent' => 0 != wolf_get_theme_option( 'home_header_height' ) ? wolf_get_theme_option( 'home_header_height' ) : 80,
				'breakPoint' => wolf_get_theme_option( 'breakpoint', 10000 ),
				'lightbox' => wolf_get_theme_option( 'lightbox', 'swipebox' ),
				'videoLightbox' => wolf_get_theme_option( 'video_lightbox' ),
				'footerUncover' => wolf_get_theme_option( 'footer_uncover' ),
				'headerUncover' => wolf_get_theme_option( 'header_uncover' ),
				'sliderEffect' => wolf_get_theme_option( 'slider_effect', 'slide' ),
				'sliderAutoplay' => wolf_get_theme_option( 'slider_autoplay' ),
				'sliderSpeed' => wolf_get_theme_option( 'slider_speed', 5000 ),
				'sliderPause' => wolf_get_theme_option( 'slider_pause' ),
				'infiniteScroll' => wolf_get_theme_option( 'blog_infinite_scroll' ),
				'infiniteScrollMsg' => __( 'Loading...', 'wolf' ),
				'infiniteScrollEndMsg' => __( 'No more post to load', 'wolf' ),
				'loadMoreMsg' => __( 'Load More', 'wolf' ),
				'infiniteScrollEmptyLoad' => wolf_get_theme_uri( '/images/empty.gif' ),
				'newsletterPlaceholder' => __( 'Your email', 'wolf' ),
				'isHomeSlider' => wolf_is_slider_in_home_header(),
				'heroFadeWhileScroll' => wolf_get_theme_option( 'hero_fade_while_scroll' ),
				'heroParallax' => 'parallax' == wolf_get_theme_option( 'hero_effect' ) || 'video' == wolf_get_theme_option( 'home_header_type' ),
				'homeHeaderType' => wolf_get_theme_option( 'home_header_type' ),
				'isHome' => is_page_template( 'page-templates/home.php' ),
				'blogWidth' => wolf_get_theme_option( 'blog_width' ),
				'menuPosition' => wolf_get_theme_option( 'menu_position' ),
				'modernMenu' => ( 'modern' == wolf_get_theme_option( 'menu_position' ) ),
				'currentPostType' => $current_post_type,
				'enableParallaxOnMobile' => wolf_get_theme_option( 'enable_parallax_on_mobile' ),
				'enableAnimationOnMobile' => wolf_get_theme_option( 'enable_animation_on_mobile' ),
				'doPageTransition' => wolf_get_theme_option( 'no_page_transition' ) || wolf_is_ie() ? false : true,
				'doBackToTopAnimation' => wolf_get_theme_option( 'no_back_to_top_animation' ) ? false : true,
				'onePageMenu' => wolf_get_theme_option( 'one_page_menu' ) ? true : false,
				'onePagePage' => get_permalink( wolf_get_theme_option( 'one_page_menu' ) ),
				'isOnePageOtherPage' => get_the_ID() != wolf_get_theme_option( 'one_page_menu' ),
				'isStickyMenu' => wolf_get_theme_option( 'sticky_menu' ),
				'addMenuType' => wolf_get_theme_option( 'additional_toggle_menu_type' ),
				'workType' => wolf_get_theme_option( 'work_type' ),
				'isTopbar' => wolf_get_theme_option( 'top_bar' ),
				'menuStyle' => wolf_get_theme_option( 'menu_style' ),
				'years' => __( 'Years', 'wolf' ),
				'months' => __( 'Months', 'wolf' ),
				'weeks' => __( 'Weeks', 'wolf' ),
				'days' => __( 'Days', 'wolf' ),
				'hours' => __( 'Hours', 'wolf' ),
				'minutes' => __( 'Minutes', 'wolf' ),
				'seconds' => __( 'Seconds', 'wolf' ),
				'replyTitle' => __( 'Share your thoughts', 'wolf' ),
				'doWoocommerceLightbox' => 'no' == get_option( 'woocommerce_enable_lightbox' ),
				'leftMenuTransparency' => wolf_get_theme_option( 'left_menu_transparency' ),
				'layout' => wolf_get_theme_option( 'layout' ),
				'HomeHeaderVideoBgType' => wolf_get_theme_option( 'video_header_bg_type' ),
				'language' => get_locale(),
			)
		);

		// Dequeue plugin scripts
		wp_dequeue_script( 'wolf-portfolio' );
		wp_deregister_script( 'wolf-portfolio' );
		wp_dequeue_script( 'wolf-albums' );
		wp_deregister_script( 'wolf-albums' );
		wp_dequeue_script( 'wolf-videos' );
		wp_deregister_script( 'wolf-videos' );

		// Enqueue scripts conditionaly for the blog
		if ( 'masonry' == wolf_get_blog_layout() && wolf_is_blog() ) {


			if ( wolf_get_theme_option( 'blog_infinite_scroll' ) ) {
				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'infinite-scroll' );
			}

			wp_enqueue_script( 'item-masonry' );
		}

		if ( wolf_is_portfolio() && 'modern' != wolf_get_theme_option( 'work_type' ) && 'vertical' != wolf_get_theme_option( 'work_type' ) ) {

			if ( wolf_get_theme_option( 'work_infinite_scroll' ) && 'masonry-horizontal' != wolf_get_theme_option( 'work_type' ) ) {

				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'infinite-scroll' );
			}

			if ( 'masonry-horizontal' == wolf_get_theme_option( 'work_type' ) ) {
				wp_enqueue_script( 'packery' );
			}

			wp_enqueue_script( 'item-masonry' );
		}

		if ( wolf_is_albums() && 'modern' != wolf_get_theme_option( 'gallery_type' ) && 'vertical' != wolf_get_theme_option( 'gallery_type' ) ) {
			if ( wolf_get_theme_option( 'gallery_infinite_scroll' ) ) {
				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'infinite-scroll' );
			}
			wp_enqueue_script( 'item-masonry' );
		}

		if ( wolf_is_videos() ) {

			if ( wolf_get_theme_option( 'video_infinite_scroll' ) ) {

				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'infinite-scroll' );
			}

			wp_enqueue_script( 'item-masonry' );
		}

		// Enqueue scripts conditionaly for the gallery
		if ( is_singular( 'gallery' ) ) {
			wp_enqueue_script( 'imageloaded' );
			wp_enqueue_script( 'isotope' );
			wp_enqueue_script( 'gallery' );
		}

		// loads the javascript required for threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'wolf_enqueue_scripts' );
} // end function check
