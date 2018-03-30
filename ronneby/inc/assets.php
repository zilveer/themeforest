<?php
/**
 * Scripts and stylesheets
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!function_exists('dfd_kadabra_scripts')) {
	/**
	 * Enqueue front scripts and styles
	 * @global obj $woocommerce
	 */
	function dfd_kadabra_scripts() {
		global $dfd_ronneby;
		
		$dfd_multisite_file_option = dfd_get_multisite_option();

		/*
		 * Css styles
		 */
		wp_register_script('dfd_queryloader2', get_template_directory_uri() . '/assets/js/jquery.queryloader2.min.js', array('jquery'), '2', false, true);
		
		//wp_register_style('dfd_preloader_style', get_template_directory_uri() . '/assets/css/preloader'.$dfd_multisite_file_option.'.css', false, null);
		wp_register_style('dfd_site_style', get_template_directory_uri() . '/assets/css/app'.$dfd_multisite_file_option.'.css', false, null);
		
		if ( class_exists( 'Vc_Manager', false ) ) {
			wp_register_style('dfd_vc_custom_style', get_template_directory_uri() . '/assets/css/visual-composer'.$dfd_multisite_file_option.'.css', false, null);			
			wp_enqueue_style('dfd_vc_custom_style');
		}
		
		wp_register_style('dfd_mobile_responsive', get_template_directory_uri() . '/assets/css/mobile-responsive.css', false, null);
		wp_register_style('dfd-multislider-css', get_template_directory_uri() . '/assets/css/multislider.css', false, null);
		
		//wp_enqueue_style('dfd_preloader_style');
		wp_enqueue_style('dfd_site_style');
		
		/**
		 * Check if WooCommerce is active
		 * */
		if (is_plugin_active('woocommerce/woocommerce.php')) {
			$woocommerce_css_file = get_template_directory_uri() . '/assets/css/woocommerce'.$dfd_multisite_file_option.'.css';
			
			if(isset($dfd_ronneby['dfd_woocommerce_templates_path']) && $dfd_ronneby['dfd_woocommerce_templates_path'] == '_old')
				$woocommerce_css_file = get_template_directory_uri() . '/assets/css/woocommerce_old'.$dfd_multisite_file_option.'.css';
			
			wp_register_style('dfd_wocommerce_style', $woocommerce_css_file, false, null);
			wp_enqueue_style('dfd_wocommerce_style');

			/*global $woocommerce;
			if (intval($woocommerce->version) >= 2) {
				wp_deregister_script('wc-add-to-cart');
				wp_deregister_script('wc-add-to-cart-variation');
				wp_register_script('wc-add-to-cart', get_template_directory_uri() . '/assets/js/woocommerce/add-to-cart.js', array( 'jquery' ), $woocommerce->version, true, true);
				wp_register_script('wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/woocommerce/add-to-cart-variation.js', array( 'jquery' ), $woocommerce->version, true, true);
			}*/
		}
		
		/**
		 * Check if Go Pricing is active
		 * */
		if (is_plugin_active('go_pricing/go_pricing.php')) { // go_pricing_skin
			wp_register_style('dfd_go_pricing_skin', get_template_directory_uri() . '/assets/css/go_pricing_skin'.$dfd_multisite_file_option.'.css', false, null);
			wp_enqueue_style('dfd_go_pricing_skin');
		}
		
		/**
		 * Check if MasterSlider is not active
		 * */
		/*
		if (is_plugin_active('masterslider/masterslider.php') === false ) { // enable masterslider default styles for jquery plugin
			wp_register_style('dfd_masterslider_default', get_template_directory_uri() . '/assets/css/masterslider.css', false, null);
			wp_enqueue_style('dfd_masterslider_default');
		}
		*/
		/**
		 * mobile responsive
		 */
		if (isset($dfd_ronneby['mobile_responsive']) && strcmp($dfd_ronneby['mobile_responsive'],'1') === 0) {
			wp_enqueue_style('dfd_mobile_responsive');
		}

		//wp_enqueue_style('crum_effects', get_template_directory_uri() . '/assets/css/animate-custom.css', false, null);
		/* Bbpress styles */
		if(is_plugin_active('bbpress/bbpress.php')) {
			wp_enqueue_style('crum_bbpress', get_template_directory_uri() . '/assets/css/bbpress'.$dfd_multisite_file_option.'.css', false, null);
		}
		if(class_exists('BuddyPress')) {
			wp_enqueue_style('dfd_buddypress', get_template_directory_uri() . '/assets/css/bbpress'.$dfd_multisite_file_option.'.css', false, null);
		}
		wp_enqueue_style('isotope_style', get_template_directory_uri() . '/assets/css/jquery.isotope.css', false, null);
		wp_deregister_style('prettyphoto');
		wp_deregister_style('woocommerce_prettyPhoto_css');
		wp_enqueue_style('prettyphoto_style', get_template_directory_uri() . '/assets/css/prettyPhoto.css', false, null);
		/*********** ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ *********/
		//wp_enqueue_style('flexslider_style', get_template_directory_uri() . '/assets/css/flexslider.css', false, null);
		
		//wp_enqueue_style('dfd_options_values', get_template_directory_uri() . '/assets/css/custom-styles.css', false, null);

		wp_enqueue_style( 'main-style', get_stylesheet_uri(), false, null );
		
		if(is_multisite()) {
			$uploads = wp_upload_dir();
			$aq_uploads_dir = trailingslashit($uploads['baseurl']);
			wp_enqueue_style('dfd_theme_options', $aq_uploads_dir . 'options.css', false, null);
		} else {
			wp_enqueue_style('dfd_theme_options', get_template_directory_uri() . '/css/options.css', false, null);
		}
		
		/* RTL support */
		if(is_rtl()) {
			wp_enqueue_style('dfd_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false, null);
		}

		/*
		 * JS register
		 */
		//wp_register_script('headroom', get_template_directory_uri() . '/assets/js/headroom.min.js', false, null, true);
		wp_register_script('dfd_slide_parallax', get_template_directory_uri() . '/assets/js/jquery.slide_parallax.js', false, null, true);

		wp_register_script('smooth-scroll', get_template_directory_uri() . '/assets/js/jquery.smoothscroll.js', false, null, true);
		wp_deregister_script('isotope');
		wp_register_script('isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', false, null, true);
		wp_register_script('isotope_recenworks', get_template_directory_uri() . '/assets/js/jquery.isotope.recentworks.js', false, null, true);
		wp_register_script('isotope-run-2col', get_template_directory_uri() . '/assets/js/jquery.isotope.2col.run.js', false, null, true);
		wp_register_script('isotope-run-3col', get_template_directory_uri() . '/assets/js/jquery.isotope.3col.run.js', false, null, true);
		wp_register_script('isotope-run-4col', get_template_directory_uri() . '/assets/js/jquery.isotope.4col.run.js', false, null, true);
		wp_register_script('masonry', get_template_directory_uri() . '/assets/js/jquery.masonry.min.js', true, null, true);
		//wp_deregister_script('flexslider');
		//wp_register_script('flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', false, null, false);
		//wp_register_script('jcarousel', get_template_directory_uri() . '/assets/js/jquery.jcarousel.min.js', false, null, false);
		if (!wp_script_is('themepunchtools') && !wp_script_is('revslider-jquery.themepunch.plugins.min')) {
			wp_register_script('hammer', get_template_directory_uri() . '/assets/js/hammer.min.js', false, null, true);
		}
		//wp_register_script('jCarouselSwipe', get_template_directory_uri() . '/assets/js/jCarouselSwipe.min.js', array('jcarousel', 'crum_foundation'), null, false);
		
		/*Gallery post type scripts*/
		wp_register_script('dfd-isotope-gallery', get_template_directory_uri() . '/assets/js/jquery.isotope.gallery.js', false, null, true);
		wp_register_script('dfd-carousel-gallery', get_template_directory_uri() . '/assets/js/jquery.carousel.gallery.js', false, null, true);
		wp_register_script('dfd-gallery-module-isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.gallery-module.js', false, null, true);
		
		wp_register_script('gmaps', '//maps.googleapis.com/maps/api/js?key=AIzaSyAdY8R5lQPdDO_ffF9WADgbYVsYmpfv3Vw', false, null, false, true);
		//wp_register_script('gmaps', '//maps.googleapis.com/maps/api/js?key=AIzaSyD4Eo5QyWFHRsNeCo8fOw-gS2fT0joxu8k', false, null, false, true);
		wp_register_script('gmap3', get_template_directory_uri() . '/assets/js/gmap3.min.js', false, null, true, true);
		wp_deregister_script('prettyphoto');
		wp_deregister_script('prettyPhoto');

		//wp_register_script('feature-image-box-transform', get_template_directory_uri() . '/assets/js/jquery.feature-image-box-transform.js', false, null, true);

		wp_register_script('woocommerce_hack', get_template_directory_uri() . '/assets/js/woocommerce_hack.js', false, null, true);

		wp_register_script('dropdown', get_template_directory_uri() . '/assets/js/dropdown.js', false, null, true);

//		wp_register_script('colpick', get_template_directory_uri() . '/stylechanges/colpick/js/colpick.js', false, null, true);

		// Audioplayer
		wp_register_script('js-audio', get_template_directory_uri().'/assets/js/audioplayer.min.js', false, null, true);
		//wp_register_script('js-audio-run', get_template_directory_uri().'/assets/js/audioplayer.run.js', false, null, true);
		
		// Video Player
		//wp_register_script('dfd_self_hosted_videos_js', '//vjs.zencdn.net/c/video.js');
		//wp_register_style('dfd_self_hosted_videos_css', '//vjs.zencdn.net/c/video-js.css');
		wp_register_style('dfd_zencdn_video_css', '//vjs.zencdn.net/c/video-js.css', false, null);
		wp_register_script('dfd_zencdn_video_js', '//vjs.zencdn.net/c/video.js', false, null);
		
		// Facebook Widget
		wp_register_script('dfd_facebook_widget_script', get_template_directory_uri().'/assets/js/widget-facebook.js', false, null, true);

		wp_register_script('mega_menu', get_template_directory_uri().'/assets/js/jquery.mega-menu.min.js', false, null, true);
		if(is_rtl()) {
			wp_register_script('mega_menu_run', get_template_directory_uri().'/assets/js/jquery.mega-menu.run.rtl.min.js', false, null, true);
		} else {
			wp_register_script('mega_menu_run', get_template_directory_uri().'/assets/js/jquery.mega-menu.run.js', false, null, true);
		}
		//wp_register_script('dl_menu', get_template_directory_uri().'/assets/js/jquery.dlmenu.min.js', false, '1.0.1', true, true);
		
		// keyframe
		
		// ajax pagination
		wp_register_script('ajax-pagination', get_template_directory_uri().'/assets/js/ajax-pagination.js', array('jquery'), null, true);
		wp_register_script('dfd-lazy-load', get_template_directory_uri().'/assets/js/ajax-lazy-load.js', array('jquery'), null, true);
		
		//slick slider
		wp_deregister_script('ult-slick');
		wp_register_script('jquery.knob', get_template_directory_uri().'/assets/js/jquery.knob.js', array('jquery'), null, true);
		wp_register_script('dfd.onepagescroll', get_template_directory_uri().'/assets/js/jquery.onepagescroll.js', array('jquery'), null, true);
		wp_register_script('fullscreenvideo', get_template_directory_uri().'/assets/js/full-screen-video.js', array('jquery'), null, true);
		wp_register_script('dfd-tweenlite', get_template_directory_uri().'/assets/js/TweenLite.min.js', array('jquery'), null, true);
		wp_register_script('dfd-easepack', get_template_directory_uri().'/assets/js/EasePack.min.js', array('jquery'), null, true);
		wp_register_script('dfd-rAF', get_template_directory_uri().'/assets/js/rAF.min.js', array('jquery'), null, true);
		wp_register_script('dfd-particleground', get_template_directory_uri().'/assets/js/jquery.particleground.min.js', array('jquery'), null, true);
		wp_register_script('dfd-particleground-old', get_template_directory_uri().'/assets/js/jquery.particleground.old.min.js', array('jquery'), null, true);
		wp_register_script('dfd-three', get_template_directory_uri().'/assets/js/three.min.js', array('jquery'), null, true);
		wp_register_script('dfd-projector', get_template_directory_uri().'/assets/js/projector.min.js', array('jquery'), null, true);
		wp_register_script('dfd-canvas-renderer', get_template_directory_uri().'/assets/js/canvas-renderer.min.js', array('jquery'), null, true);
		wp_register_script('dfd-multislider', get_template_directory_uri().'/assets/js/jquery.multiscroll.min.js', array('jquery'), null, false);
		wp_register_script('dfd-sly', get_template_directory_uri().'/assets/js/sly.min.js', array('jquery'), null, false);
		wp_register_script('dfd-tween-max', get_template_directory_uri().'/assets/js/TweenMax.min.js', array('jquery'), null, true);
		wp_register_script('dfd-panr', get_template_directory_uri().'/assets/js/jquery.panr.min.js', array('jquery'), null, false);
		wp_register_script('dfd-scrolling-news', get_template_directory_uri().'/assets/js/jquery.slick.news.js', array('jquery'), null, false);
		wp_register_script('dfd-jparallax', get_template_directory_uri().'/assets/js/jquery.parallax.js', array('jquery'), null, false);
		wp_register_script('dfd-typed', get_template_directory_uri().'/assets/js/typed.min.js', array('jquery'), null, false);
		//wp_register_script('masterslider', get_template_directory_uri().'/assets/js/masterslider.min.js', array('jquery'), null, true);
		//wp_register_script('vague', get_template_directory_uri().'/assets/js/vague.js', array('jquery'), null, true);
		//wp_register_script('htmltocanvas', get_template_directory_uri().'/assets/js/html2canvas.js', array('jquery'), null, true);
		//wp_register_script('pixastic', get_template_directory_uri().'/assets/js/pixastic.custom.js', array('jquery'), null, true);

		/**
		 * Enqueue Preloader
		 */
		
		/*
		 * JS enquene
		 */
		wp_enqueue_script('jquery');
		if (isset($dfd_ronneby['site_preloader_enabled']) && strcmp($dfd_ronneby['site_preloader_enabled'],'1')===0) {
			wp_enqueue_style( 'dfd_preloader_indicator', get_template_directory_uri() . '/assets/css/site-preloader'.$dfd_multisite_file_option.'.css', false, null );
			wp_enqueue_script('dfd_queryloader2');
		}
		if(!isset($dfd_ronneby['dev_mode']) || $dfd_ronneby['dev_mode'] != 'on') {
			wp_register_script('dfd_js_plugins', get_template_directory_uri() . '/assets/js/plugins.min.js', false, null, true);
			wp_enqueue_script('dfd_js_plugins');
		} else {
			wp_register_script('crum_foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', false, null, true);
			wp_register_script('crum_effects', get_template_directory_uri() . '/assets/js/animation.js', false, null, true);
			wp_register_script('mmenu', get_template_directory_uri().'/assets/js/jquery.sidr.min.js', false, null, true);
			wp_register_script('keyframes', get_template_directory_uri().'/assets/js/jquery.keyframes.min.js', array('jquery'), null, true);
			//wp_register_script('jquery-migrate', get_template_directory_uri().'/assets/js/jquery.migrate.min.js', array('jquery'), null, true);
			wp_register_script('slick', get_template_directory_uri().'/assets/js/jquery.slick.min.js', array('jquery'), null, true);
			wp_register_script('dfd_scrollTo', get_template_directory_uri().'/assets/js/jquery.scrollTo.min.js', array('jquery'), null, true);
			wp_register_script('jquery.easing', get_template_directory_uri().'/assets/js/jquery.easing.min.js', array('jquery'), null, true);
			wp_register_script('dfd-folio-hover', get_template_directory_uri().'/assets/js/jquery.hoverdir.min.js', array('jquery'), null, true);
			wp_register_script('dfd-folio-hover-init', get_template_directory_uri().'/assets/js/jquery.hoverdir.init.min.js', array('jquery'), null, true);
			wp_register_script('dfd-chaffle', get_template_directory_uri().'/assets/js/jquery.chaffle.js', array('jquery'), null, true);
			wp_register_script('prettyphoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', false, null, true, true);
			wp_register_script('qr_code', get_template_directory_uri() . '/assets/js/qrcode.min.js', false, null, true);
			//wp_register_script('custom-share', get_template_directory_uri() . '/assets/js/jquery.sharrre-1.3.5.min.js', array('jquery'), null, true);
			wp_register_script('custom-share', get_template_directory_uri() . '/assets/js/rrssb.js', array('jquery'), null, true);
			wp_register_script('vertical_js', get_template_directory_uri() . '/assets/js/vertical.min.js', false, null, true);
			wp_register_script('dropkick', get_template_directory_uri() . '/assets/js/jquery.dropkick-min.js', false, null, true);
			wp_register_script('crum_main', get_template_directory_uri() . '/assets/js/app.js', false, null, true);
			
			wp_enqueue_script('crum_foundation');
			wp_enqueue_script('keyframes');

			wp_enqueue_script('crum_effects');

			//wp_enqueue_script('jquery-migrate');
			wp_enqueue_script('slick');
			wp_enqueue_script('dfd_scrollTo');
			wp_enqueue_script('jquery.easing');
			wp_enqueue_script('custom-share');
			wp_enqueue_script('vertical_js');
			wp_enqueue_script('dropkick');
			wp_enqueue_script('prettyphoto');

			//wp_enqueue_script('dl_menu');
			wp_enqueue_script('mmenu');

			wp_enqueue_script('dfd-folio-hover');

			wp_enqueue_script('dfd-folio-hover-init');

			wp_enqueue_script('dfd-chaffle');

			wp_enqueue_script('crum_main');
		}
		
		//wp_enqueue_script('headroom');

		//wp_enqueue_script('flexslider');
		//wp_enqueue_script('jcarousel');
		wp_enqueue_script('hammer');
		//wp_enqueue_script('jCarouselSwipe');
		
		
		//wp_enqueue_script('masterslider');
		//wp_enqueue_script('vague');
		//wp_enqueue_script('htmltocanvas');
		//wp_enqueue_script('pixastic');



		if (!isset($dfd_ronneby['scroll_animation']) || strcmp($dfd_ronneby['scroll_animation'],'off')!==0) {
			wp_enqueue_script('smooth-scroll');
		}

		

		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			wp_enqueue_script('dropdown');
			wp_enqueue_script('woocommerce_hack');
		}
		
		wp_register_script('dfd-masonry-2cols-run', get_template_directory_uri() . '/assets/js/jquery.masonry.2cols.run.js', true, null, true);
		wp_register_script('dfd-masonry-3cols-run', get_template_directory_uri() . '/assets/js/jquery.masonry.3cols.run.js', true, null, true);
		wp_register_script('dfd-masonry-4cols-run', get_template_directory_uri() . '/assets/js/jquery.masonry.4cols.run.js', true, null, true);
		wp_register_script('dfd-grid-2cols-run', get_template_directory_uri() . '/assets/js/jquery.grid.2cols.run.js', true, null, true);
		wp_register_script('dfd-grid-3cols-run', get_template_directory_uri() . '/assets/js/jquery.grid.3cols.run.js', true, null, true);
		wp_register_script('dfd-grid-4cols-run', get_template_directory_uri() . '/assets/js/jquery.grid.4cols.run.js', true, null, true);
		wp_register_script('dfd-masonry-4cols-fw-run', get_template_directory_uri() . '/assets/js/jquery.masonry.4cols-fw.run', true, null, true);
		wp_register_script('dfd-masonry-mini-3cols-run', get_template_directory_uri() . '/assets/js/jquery.masonry.mini.3cols.run.js', true, null, true);
		wp_register_script('dfd-masonry-mini-4cols-run', get_template_directory_uri() . '/assets/js/jquery.masonry.mini.4cols.run.js', true, null, true);
		wp_register_script('dfd-isotope-enable', get_template_directory_uri() . '/assets/js/jquery.isotope.enable.js', true, null, true);
		wp_register_script('dfd-isotope-1col-enable', get_template_directory_uri() . '/assets/js/jquery.isotope.1col.enable.js', true, null, true);
		wp_register_script('dfd-isotope-4cols-enable', get_template_directory_uri() . '/assets/js/jquery.isotope-4cols.enable.js', true, null, true);
		wp_register_script('dfd-isotope-porfolio-inside', get_template_directory_uri() . '/assets/js/jquery.isotope.porfolio-inside.js', true, null, true);
		wp_register_script('dfd-isotope-portfolio', get_template_directory_uri() . '/assets/js/jquery.isotope.porfolio.js', true, null, true);
		wp_register_script('dfd-isotope-news-module', get_template_directory_uri() . '/assets/js/jquery.isotope.news-module.js', true, null, true);
		wp_register_script('dfd-isotope-blog', get_template_directory_uri() . '/assets/js/jquery.isotope.blog.js', true, null, true);
		//wp_register_script('dfd-columns-isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.columns.js', true, null, true);
		
		
		wp_register_script('dfd-isotope-news-carousel', get_template_directory_uri() . '/assets/js/jquery.carousel.news-module.js', true, null, true);
		
		// deprecated
		wp_register_script('dfd-masonry-enable', get_template_directory_uri() . '/assets/js/jquery.masonry.enable.js', true, null, true);
		
		if (is_singular('my-product')) {
			wp_enqueue_script('isotope');
			wp_enqueue_script('dfd-isotope-porfolio-inside');
		}
		
		# Load script/styles for page templates
		if (is_page()) {
			$curr_page_template = basename(get_page_template());

			switch($curr_page_template) {
				
				/*
				case 'page-contacts.php':
					wp_enqueue_script('gmaps');
					wp_enqueue_script('gmap3');
					//wp_enqueue_script('qr_code');
					break;
				*/

				case 'tmp-posts-masonry-2.php':
				case 'tmp-posts-masonry-2-left-side.php':
				case 'tmp-posts-masonry-2-side.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-masonry-2cols-run');
					break;
				
				case 'tmp-posts-grid-2.php':
				case 'tmp-posts-grid-2-left-side.php':
				case 'tmp-posts-grid-2-right-sidebar.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-grid-2cols-run');
					break;

				case 'tmp-posts-masonry-3-left-sidebar.php':
				case 'tmp-posts-masonry-3-left-sidebar-fullwidth.php':
				case 'tmp-posts-masonry-3-right-sidebar.php':
				case 'tmp-posts-masonry-3-right-sidebar-fullwidth.php':
				case 'tmp-posts-masonry-3.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-masonry-3cols-run');
					break;
				
				case 'tmp-posts-grid-3.php':
				case 'tmp-posts-grid-3-left-sidebar.php':
				case 'tmp-posts-grid-3-right-sidebar.php':
				case 'tmp-posts-grid-3-left-sidebar-fullwidth.php':
				case 'tmp-posts-grid-3-right-sidebar-fullwidth.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-grid-3cols-run');
					break;
				
				case 'tmp-posts-masonry-4.php':
				case 'tmp-posts-masonry-4-fullwidth.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-masonry-4cols-run');
					break;
				
				case 'tmp-posts-grid-4.php':
				case 'tmp-posts-grid-4-fullwidth.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-grid-4cols-run');
					break;

				case 'tmp-portfolio-masonry-full-width-bordered-title.php':
				case 'tmp-portfolio-masonry-full-width.php':
				case 'tmp-portfolio-masonry-full-width-bordered.php':
				case 'tmp-portfolio-masonry-1.php':
				case 'tmp-portfolio-masonry-1-bordered.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-isotope-enable');
					break;
				
				case 'tmp-portfolio-template-1-sorting.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-isotope-1col-enable');
					break;

				case 'tmp-portfolio-masonry-full-width-4-cols.php':
				case 'tmp-portfolio-masonry-full-width-bordered-4-cols.php':
				case 'tmp-portfolio-masonry-full-width-bordered-4-cols-title.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-isotope-4cols-enable');
					break;

				case 'tmp-portfolio-template-2mini-left-sidebar.php':
				case 'tmp-portfolio-template-2mini.php':
				case 'tmp-portfolio-template-2excerpt.php':
				case 'tmp-portfolio-template-2.php':
				case 'tmp-portfolio-grid-2-mini.php':
				case 'tmp-portfolio-template-2-left-sidebar.php':
				case 'tmp-portfolio-template-2-right-sidebar.php':
				case 'tmp-portfolio-masonry-template-2.php':
				case 'tmp-portfolio-masonry-template-2-left-sidebar.php':
				case 'tmp-portfolio-masonry-template-2-right-sidebar.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('isotope-run-2col');
					break;
				case 'tmp-portfolio-template-3excerpt.php':
				case 'tmp-portfolio-template-3.php':
				case 'tmp-portfolio-template-3-left-sidebar.php':
				case 'tmp-portfolio-template-3-right-sidebar.php':
				case 'tmp-portfolio-template-3mini-left-sidebar.php':
				case 'tmp-portfolio-template-3mini.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('isotope-run-3col');
					break;
				case 'tmp-portfolio-template-4mini.php':
				case 'tmp-portfolio-template-4excerpt.php':
				case 'tmp-portfolio-template-4.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('isotope-run-4col');
					break;

				case 'tmp-portfolio-masonry_mini.php':
				case 'tmp-portfolio-masonry_excerpt.php':
				case 'tmp-portfolio-masonry.php':
				case 'tmp-portfolio-masonry-sidebar_mini.php':
				case 'tmp-portfolio-masonry-left-sidebar_mini.php':
				case 'tmp-portfolio-masonry-sidebar_excerpt.php':
				case 'tmp-portfolio-masonry-left-sidebar_excerpt.php':
				case 'tmp-portfolio-masonry-sidebar.php':
				case 'tmp-portfolio-masonry-left-sidebar.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-masonry-mini-3cols-run');
					break;

				case 'tmp-portfolio-masonry-4mini.php':
				case 'tmp-portfolio-masonry-4excerpt.php':
				case 'tmp-portfolio-masonry-4.php':
					wp_enqueue_script('isotope');
					wp_enqueue_script('dfd-masonry-mini-4cols-run');
					break;
				case 'tmp-one-page-scroll.php':
					wp_enqueue_script('dfd.onepagescroll');
					break;
			}
		}
		
		if (function_exists('post_like_scripts')) {
			post_like_scripts();
		}
		
		if(isset($dfd_ronneby['enable_wordpress_heartbeat']) && $dfd_ronneby['enable_wordpress_heartbeat'] == 'off') {
			wp_deregister_script('heartbeat');
		}


	}
}

/**
 * Enqueue the Souce sans font.
 */
function dfd_kadabra_enq_fonts() {
	//wp_enqueue_style('dfd_font_montserrat', "http://fonts.googleapis.com/css?family=Montserrat:400,700");
	//wp_enqueue_style('dfd_font_source_sans_pro', "http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700");
	if (is_admin()) {
		//wp_enqueue_style('dfd_font_open_sans', "//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800");
	}
}

if (!function_exists('dfd_kadabra_admin_css')) {
	/**
	 * Enqueue admin scripts and styles
	 */
	function dfd_kadabra_admin_css() {
		wp_register_style('crum-admin-style', get_template_directory_uri() . '/assets/css/admin-panel.css');
		wp_enqueue_style('crum-admin-style');
	}
}

if (!function_exists('dfd_custom_page_style')) {
	function dfd_custom_page_style() {
		global $dfd_ronneby;
		//if(is_page()) {
			global $post;
			
			if (!isset($post) || empty($post) || !is_object($post)) return;
			
			$p_bg_color = get_post_meta( $post->ID, 'crum_page_custom_bg_color', true );
			$p_bg_image = get_post_meta( $post->ID, 'crum_page_custom_bg_image', true );
			$p_bg_fixed = get_post_meta( $post->ID, 'crum_page_custom_bg_fixed', true );
			$p_bg_repeat = get_post_meta( $post->ID, 'crum_page_custom_bg_repeat', true );
			?>
			<style type="text/css">
				body {
					<?php if ((strcmp($p_bg_color,'#')!==0) && !empty($p_bg_color) && (strcmp($p_bg_color,'#ffffff')!==0)): ?>
						background-color: <?php echo esc_attr($p_bg_color); ?> !important;
					<?php endif; ?>

					<?php if(!empty($p_bg_image)): ?>
						background-image: <?php echo "url('{$p_bg_image}')"; ?> !important;
						background-position: center 0 !important;
					<?php endif; ?>

					<?php if(!empty($p_bg_repeat)): ?>
						background-repeat: <?php echo esc_attr($p_bg_repeat); ?> !important;
					<?php endif; ?>

					<?php if ($p_bg_fixed): ?>
						background-attachment: fixed !important;
					<?php endif; ?>
				}
			</style>
		<?php
		//}
	}
}

if (!function_exists('dfd_print_head_js')) {
	function dfd_print_head_js() {
		global $dfd_ronneby;
		if(isset($dfd_ronneby['head_custom_js']) && !empty($dfd_ronneby['head_custom_js'])) {
			?>
			<script type="text/javascript">
				<?php echo $dfd_ronneby['head_custom_js'] ?>
			</script>
		<?php
		}
	}
}
