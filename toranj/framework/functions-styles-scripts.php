<?php
/**
 *  Register and enqueue styels and scripts
 *
 * @package toranj
 * @author owwwlab
 */


/**
 * ----------------------------------------------------------------------------------------
 * include other scripts and styles
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_add_styles_and_scripts' ) ) {

	function owlab_add_styles_and_scripts() {

		// Adds support for pages with threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Register scripts
		wp_register_script('images-loaded', 		OWLAB_SCRIPTS . '/vendors/imagesloaded.pkgd.min.js', 			array(),THEME_VERSION, true);
		wp_register_script('history-js', 			OWLAB_SCRIPTS . '/vendors/jquery.history.js', 					array('jquery'),THEME_VERSION, true);
		wp_register_script('tweenmax', 				OWLAB_SCRIPTS . '/vendors/TweenMax.min.js', 					array(),THEME_VERSION, true);
		wp_register_script('owl-carousel', 			OWLAB_SCRIPTS . '/jquery.owwwlab-DoubleCarousel.js',			array('jquery','images-loaded','tweenmax'),THEME_VERSION, true);
		wp_register_script('owl-videobg', 			OWLAB_SCRIPTS . '/jquery.owwwlab-video.js',						array('jquery','images-loaded','tweenmax'),THEME_VERSION, true);
		wp_register_script('nicescroll', 			OWLAB_SCRIPTS . '/vendors/jquery.nicescroll.min.js',			array('jquery'),THEME_VERSION, true);
		wp_register_script('nicescroll-rtl', 		OWLAB_SCRIPTS . '/vendors/jquery.nicescroll-rtl.js',			array('jquery'),THEME_VERSION, true);
		wp_register_script('magnific', 				OWLAB_SCRIPTS . '/vendors/jquery.magnific-popup.js', 			array('jquery'),THEME_VERSION, true);
		wp_register_script('media-player', 			OWLAB_SCRIPTS . '/vendors/mediaelement-and-player.min.js', 		array('jquery'),THEME_VERSION, true);
		wp_register_script('inview', 				OWLAB_SCRIPTS . '/vendors/jquery.inview.min.js', 				array('jquery'),THEME_VERSION, true);
		wp_register_script('smooth-scroll', 		OWLAB_SCRIPTS . '/vendors/smoothscroll.js', 					array('jquery'),THEME_VERSION, true);
		wp_register_script('rslider', 				OWLAB_SCRIPTS . '/vendors/responsiveslides.min.js', 			array('jquery'),THEME_VERSION, true);
		wp_register_script('classycompare', 		OWLAB_SCRIPTS . '/vendors/jquery.classycompare.js', 			array('jquery'),THEME_VERSION, true);
		wp_register_script('touchswip', 			OWLAB_SCRIPTS . '/vendors/jquery.touchSwipe.min.js', 			array('jquery'),THEME_VERSION, true);
		wp_register_script('theme-custom-js', 		OWLAB_SCRIPTS . '/custom.js', 									array( 'jquery' ),THEME_VERSION, true );
		wp_register_script('tj-dropdown', 			OWLAB_SCRIPTS . '/vendors/jquery.dropdown.js', 					array('jquery'),THEME_VERSION, true);
		wp_register_script('lazyload', 				OWLAB_SCRIPTS . '/vendors/jquery.lazyload.min.js', 				array('jquery'),THEME_VERSION, true);
		wp_register_script('modernizr', 			'//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), false, false);
		wp_register_script('jquery-easing', 		OWLAB_SCRIPTS . '/vendors/jquery.easing.min.js', 				array('jquery'),THEME_VERSION, true);
		wp_register_script('owlab_masterslider', 	OWLAB_SCRIPTS . '/vendors/masterslider.min.js', 				array('jquery','jquery-easing'),THEME_VERSION, true);


		// Load the custom scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('images-loaded');
		//wp_enqueue_script('isotope');
		//wp_enqueue_script('isotope-masonry');
		wp_enqueue_script('history-js');
		wp_enqueue_script('tweenmax');
		wp_enqueue_script('owl-kenburn');
		wp_enqueue_script('owl-carousel');
		wp_enqueue_script('owl-videobg');
		if(is_rtl()){ wp_enqueue_script('nicescroll-rtl'); } else { wp_enqueue_script('nicescroll'); }
		wp_enqueue_script('magnific');
		wp_enqueue_script('media-player');
		wp_enqueue_script('inview');
		wp_enqueue_script('smooth-scroll');
		wp_enqueue_script('rslider');
		wp_enqueue_script('classycompare');
		wp_enqueue_script('touchswip');
		wp_enqueue_script('tj-dropdown');
		wp_enqueue_script('lazyload');



		// Load the stylesheets
		wp_register_style( 'bootstrap-style', OWLAB_CSS . '/vendors/bootstrap.css',array(),THEME_VERSION);
		wp_register_style( 'bootstrap-rtl-style', OWLAB_CSS . '/rtl/bootstrap-rtl.css',array(),THEME_VERSION);
		wp_register_style( 'font-faces', OWLAB_CSS . '/fonts/font-faces.css',array(),THEME_VERSION);
		wp_register_style( 'font-awesome', OWLAB_CSS . '/vendors/font-awesome.css',array(),THEME_VERSION);
		wp_register_style( 'magnific', OWLAB_CSS . '/vendors/magnific-popup.css',array(),THEME_VERSION);
		wp_register_style( 'media-element', OWLAB_CSS . '/vendors/mediaelementplayer.css',array(),THEME_VERSION);
		wp_register_style( 'rslider', OWLAB_CSS . '/vendors/responsiveslides.css',array(),THEME_VERSION);
		wp_register_style( 'classycompare', OWLAB_CSS . '/vendors/jquery.classycompare.css',array(),THEME_VERSION);
		wp_register_style( 'theme-style', OWLAB_CSS . '/style.css',array(),THEME_VERSION);
		wp_register_style( 'theme-shop', OWLAB_CSS . '/toranj-woocommerce.css',array(),THEME_VERSION);
		wp_register_style( 'theme-rtl-style', OWLAB_CSS . '/rtl/rtl.css',array(),THEME_VERSION);
		wp_register_style( 'theme-dark-sidebar', OWLAB_CSS . '/styles/dark-sidebar.css',array(),THEME_VERSION);
		wp_register_style( 'owlab-masterslider', OWLAB_CSS . '/vendors/masterslider.css',array(),THEME_VERSION);
		wp_register_style( 'owlab-masterslider-custom', OWLAB_CSS . '/toranj-msslider.css',array(),THEME_VERSION);


		//load  googlr map scripts ony for specific page
		if ( is_page_template( 'template-contact.php') )
		{

			$google_map_api_key = 'AIzaSyC_pY2xP2spfwhjVQPMWvvAMWm7aQlr794';
			if( function_exists('ot_get_option') )
			{
				$google_map_api_key = ot_get_option('toranj_googlemap_apikey','AIzaSyC_pY2xP2spfwhjVQPMWvvAMWm7aQlr794');
			}

			$language = get_bloginfo( 'language' );
			wp_register_script('google-map-api', "http://maps.google.com/maps/api/js?v=3&key=$google_map_api_key" , array( 'jquery' ),false,true );
			wp_register_script( 'owlab-gmap3', OWLAB_SCRIPTS . '/vendors/gmap3.min.js', array('jquery'),false,true );
			wp_enqueue_script('google-map-api');
			wp_enqueue_script( 'owlab-gmap3' );
		}

		// RTL bootstrap?
		if( is_rtl() ){
			wp_enqueue_style('bootstrap-rtl-style');
		}else{
			wp_enqueue_style('bootstrap-style');
		}



		wp_enqueue_style( 'font-awesome');
		wp_enqueue_style( 'magnific');
		wp_enqueue_style( 'media-element');
		wp_enqueue_style( 'rslider');
		wp_enqueue_style( 'classycompare');
		wp_enqueue_style( 'theme-style');
		wp_enqueue_style( 'theme-shop');

		if( is_rtl() ){
			wp_enqueue_style('theme-rtl-style');
		}

		if( function_exists('ot_get_option') ){
			if (ot_get_option('dark_sidebar') == 'on')
			{
				wp_enqueue_style('theme-dark-sidebar');
			}
		}





	}

	add_action( 'wp_enqueue_scripts', 'owlab_add_styles_and_scripts' );
}


/**
 * ----------------------------------------------------------------------------------------
 * include jquery
 * ----------------------------------------------------------------------------------------
 */
// if ( ! function_exists( 'owlab_jquery_enqueue' ) ) {
// 	function owlab_jquery_enqueue() {
// 	   wp_deregister_script('jquery');
// 	   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
// 	   wp_enqueue_script('jquery');
// 	}

// 	if (!is_admin()) {
// 		add_action("wp_enqueue_scripts", "owlab_jquery_enqueue", 11);
// 	}
// }



/**
 * ----------------------------------------------------------------------------------------
 * extera hooks to we_head()
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owwlab_wp_head_hook') ){
	function owlab_wp_head_hook(){

		// fonts
		// enqueue fonts
		$font_face = ot_get_option('toranj_body_font','none');

		if (  $font_face != 'none'){
			$font = ot_get_option('toranj_body_font','Raleway');
			$font = str_replace('+', ' ', $font);
			echo "<link href='http://fonts.googleapis.com/css?family=$font:100,200,300,400,600,700,900,b' rel='stylesheet' type='text/css'>";
			echo "<style id='toranj_body_font_styles'>body,.thin-text,.tj-hover-3 .tj-overlay .subtitle,.tj-hover-2 .tj-overlay .subtitle,.tj-hover-1 .tj-overlay .subtitle,.page-side .title .second-part,.tj-circle-hover .tj-overlay .details .subtitle,.tj-hover-3 .tj-overlay .subtitle,.double-title span,.product-categories .children li a,.product-categories .children li span,.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,.shop-post-head .add_to_cart_button, .shop-post-head .added_to_cart,.product-categories .children li a, .product-categories .children li span,.product-categories,.cd-dropdown > span,.cd-dropdown ul li span,h1,h2,h3,h4,h5,.page-side .title,.double-title,.project-title,.cap-compact .cap-title,.side-title,.tj-hover-3 .tj-overlay .title,.blog-grid .post-header,#post-header .header-content .post-title,.contact-detail h5,.widget-title,.cap-lg .cap-title,.vertical-services .service-details .title,.call-to-action .action-title,.cap-elegant .cap-des,.team-item .team-content .title,.vertical-services .service-details .title,.owl-slide .owl-caption .title,.owl-slide .owl-caption .title, .owl-caption i,.contact-detail h5,.wpb_toggle,.cap-toranj .cap-title,.team-members .left-side .item .team-title,.team-members .left-side .item .team-title span,h3.shop-post-title a{font-family:$font;}</style>";

		}else{
			wp_enqueue_style( 'font-faces');
		}

		$font_size = ot_get_option('toranj_body_font_size' ,array(14,'px'));

		echo "<style>
			body{font-size:".$font_size[0].$font_size[1].";}
		</style>";

		//handel rtl option for js
		if ( is_rtl() )
		{
			echo "<script>window.owlabrtl =  true;</script>";
		}else{
			echo "<script>window.owlabrtl =  false;</script>";
		}

		//handel ajax for portfolio
		if( function_exists('ot_get_option') ){
			if (ot_get_option('owlabUseAjax') == 'on')
			{
				echo "<script>window.owlabUseAjax =  true;</script>";
			}

			echo "<script>window.owlabAccentColor = '".ot_get_option('color_accent')."';</script>";
		}

		//google map zoom options
		$gmap_maxzoom = ot_get_option('toranj_gmap_max_zoom',20);
		$gmao_initialzoom = ot_get_option('toranj_gmap_initial_zoom',15);
		echo "<script>
			window.toranjGmapMaxZoom =  ".$gmap_maxzoom.";
			window.toranjGmapInitialZoom =  ".$gmao_initialzoom.";
		</script>";

		// add ajax url to page
		echo "<script>window.tjAjaxUrl = '". get_bloginfo('wpurl') ."/wp-admin/admin-ajax.php';</script>";


	}

	add_action( 'wp_head', 'owlab_wp_head_hook' );
}

/**
 * ----------------------------------------------------------------------------------------
 * Inject custome styles
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_custom_css') ){
	function owlab_custom_css() {

	  	$styles='';
	   	if ( function_exists( 'ot_get_option' ) ){
	   		$styles .= '
	   			::selection{
					background-color:'.ot_get_option('color_accent').';
	   			}
	   			::-moz-selection{
	   				background-color:'.ot_get_option('color_accent').';
	   			}
	   			.btn-toranj,
	   			.back-to-top:hover,
				.back-to-top:focus,
				#back-to-top:hover,
				#back-to-top:focus,
				.lined:after,
				.bordered:after,
				#navigation li.current-menu-item a:before,
				#navigation li.current-menu-parent >a:before,
				#navigation .nav-prev>a:before,
				#portfolio-nav li a:hover i,
				#portfolio-nav li a:focus i,
				.grid-filters:after,
				.tj-hover-3 .tj-overlay .title:after,
				#ascrail2000-hr> div,
				#blog-more:hover,
				#blog-more:focus,
				.section-title:after,
				.team-item .team-content .subtitle:after,
				.team-socials li a:hover i,.team-socials li a:focus i,
				.skill-item .bar,
				.ib-center .ib-icon,
				.cap-lg .cap-des:after,
				.ms-staff-carousel .ms-staff-info h4:after,
				.ms-skin-toranj  .ms-slide .ms-slide-vpbtn:hover,
				.ms-skin-toranj  .ms-video-btn:hover,
				.tj-mp-action:hover i, .tj-mp-action:focus i, .tj-mp-close:hover i, .tj-mp-close:focus i,
				#menu-toggle,#menu-toggle:after, #menu-toggle:before,
				.portfolio-nav li a:hover i,
				.portfolio-nav li a:focus i,
				.bordered:after, .bordered-fine:after,
				.team-members .content-carousel .item .info:before,
				#menu-toggle, #menu-toggle:after, #menu-toggle:before,
				#commentform #submit,
				.team-members .left-side .item .info:before,
				.widget .widgettitle:after,
				.tj-hover-1 .tj-overlay:after,
				.tj-hover-5.colorbg:after,
				.cap-toranj .cap-title:after,
				.tj-ms-skin .ms-slide .ms-slide-vpbtn:hover, .tj-ms-skin .ms-video-btn:hover,
				.post-password-form input[type="submit"], .widget_search input[type="submit"],
				#navigation li.current-menu-item a:before, #navigation li.current-menu-parent >a:before, #navigation .nav-prev>a:before,
				.dark-template .tj-password i,
				#social-sharing-trigger,
				#social-sharing .sharing-icon
	   			{
	   				background-color:'.ot_get_option('color_accent').';
	   			}
	   			.btn-toranj:hover,
	   			.btn-toranj:focus,
	   			.btn-toranj:active,
	   			.btn-toranj.active,
	   			.woocommerce span.onsale, .woocommerce-page span.onsale,
	   			.shop-post-title a::after,
	   			#social-sharing-trigger:hover,
	   			#social-sharing-trigger:focus
	   			{
	   				background-color:'.ot_get_option('color_accent_2').';
	   			}
	   			a,
	   			ul.list-iconed-circle i,
				ul.list-iconed-square i,
				#menu-icon,
				.page-title .title span,
				.tj-form label,
				#portfolio-nav li a,
				.fixed-filter .select-filter i,
				ul.list-items .list-label,
				.vertical-carousel .vcarousel-next a,
				.vertical-carousel .vcarousel-prev a,
				.vertical-carousel .vcarousel-counter,
				.blog-minimal-s #blog-list .post-meta,
				.blog-minimal #blog-list .post-meta,
				#blog-more,
				#post-body #post-side a:hover,
				#post-body #post-side a:focus,
				.colored,
				.team-socials li a,
				.vertical-services li i,
				.accordion .item.active .head a,
				.accordion .item .head a:hover,
				.accordion .item .head a:focus,
				.tabs .tabs-head li.active a,
				.tabs .tabs-head li:hover a,
				.tabs .tabs-head li:focus a,
				.owl-caption a:hover i,
				.owl-caption a:focus i,
				.ms-skin-toranj .ms-nav-next,
				.ms-skin-toranj .ms-nav-prev,
				.ms-skin-toranj .tj-ms-counter,
				.tj-ms-gallery .ms-thumb-list,
				.ms-skin-toranj  .ms-slide .ms-slide-vpbtn,
				.ms-skin-toranj  .ms-video-btn,
				.ms-skin-toranj  .ms-slide .ms-slide-vpbtn:after,
				.ms-skin-toranj  .ms-video-btn:after,
				.ms-skin-toranj .tj-controlls-vmode .tj-ms-counter,
				.grid-filters-wrapper .select-filter i,
				.btn-toranj.alt,
				.icon-box .ib-icon,
				.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
				.tj-ms-skin .ms-nav-next, .tj-ms-skin .ms-nav-prev,
				.tj-ms-skin .tj-controlls-vmode .tj-ms-counter,
				.tj-ms-skin .ms-slide .ms-slide-vpbtn,
				.tj-ms-skin .ms-video-btn,
				.cart-contents,
				.woocommerce .star-rating, .woocommerce-page .star-rating,
				.woocommerce .star-rating, .woocommerce-page .star-rating,
				.woocommerce .star-rating::before, .woocommerce-page .star-rating::before,
				.blog-grid .sticky-span,
				.tj-playbtn,
				.tj-ms-skin .tj-ms-counter,
				.tj-ms-skin .ms-slide .ms-slide-vpbtn:after, .tj-ms-skin .ms-video-btn:after,
				#inner-bar
				{
	   				color:'.ot_get_option('color_accent').';
	   			}
	   			.ib-center .ib-icon{
	   				color:#fff;
	   			}
	   			a:hover,a:focus,
	   			.page-side .title .second-part,
	   			.blog-list .post-header a:hover,
	   			.blog-list .post-header a:focus,
	   			.blog-list .post-meta span a:hover,
	   			.blog-list .post-meta span a:focus,
	   			.widget-recent-posts .date,
	   			.portfolio-nav li a,
	   			.contact-detail h5{
	   				color:'.ot_get_option('color_accent_2').';
	   			}
	   			.btn-toranj.alt,
	   			.btn-toranj,
	   			.back-to-top,
				#back-to-top,
				ul.list-iconed-circle i,
				ul.list-iconed-square i,
				#portfolio-nav li a i,
				#blog-more,
				.team-socials li a i,
				.vertical-services li,
				.vertical-services li i,
				.icon-box .ib-icon,
				.cap-compact,
				.cap-compact.cap-reverse,
				.ms-skin-toranj .ms-slide .ms-slide-vpbtn,
				.ms-skin-toranj .ms-video-btn,
				.tj-mp-action i,
				.portfolio-nav li a i,
				.btn-toranj:hover, .btn-toranj:focus, .btn-toranj:active, .btn-toranj.active,
				.tj-ms-skin .ms-slide .ms-slide-vpbtn, .tj-ms-skin .ms-video-btn,
				blockquote,
				#commentform #submit,
				.post-password-form input[type="submit"], .widget_search input[type="submit"]
	   			{
	   				border-color:'.ot_get_option('color_accent').';
	   			}
	   			.btn-toranj.alt:hover{
	   				color:#fff;
	   			}

	   			.regular-page{
	   				background-color:'.ot_get_option('light_page_bcolor').';
	   			}

	   			#main-content.dark-template,
	   			.regular-page-dark{
	   				background-color:'.ot_get_option('dark_page_bcolor').';
	   			}

	   			.page-side{
	   				background-color:'.ot_get_option('dark_sidebar_bcolor').';
	   			}

	   			.page-main,
	   			#main-content .nicescroll-rails,
	   			#ajax-folio-loader
	   			{
	   				background-color:'.ot_get_option('dark_main_bcolor').';
	   			}

	   			#side-bar{
	   				background-color:'.ot_get_option('side_bar_bcolor').';
	   			}

	   			#inner-bar{
	   				background-color:'.ot_get_option('inner_bar_bcolor').';
	   			}

	   			'.ot_get_option('custom_css').'


	   		}
	   		';

	   	}

	    echo '<style type="text/css" id="toranj-custom-styles">'.preg_replace('/\s\s+/', " ", $styles).'</style>';
	}
	add_action('wp_head', 'owlab_custom_css');
}



/**
 * ----------------------------------------------------------------------------------------
 * Inject analytics
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_analytics') ){
	function owlab_analytics() {
		if ( function_exists( 'ot_get_option' ) ){
			echo ot_get_option( 'etc_analytics_code' );
		}
	}
	add_action('wp_head', 'owlab_analytics');
}



/**
 * ----------------------------------------------------------------------------------------
 * inject favicon
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_favicon') ){
	function owlab_favicon() {
		if ( function_exists( 'ot_get_option' ) ){
			$favicon = '<link rel="icon" type="image/png" href="'. ot_get_option('etc_fav_icon').'">';
			echo $favicon;
		}
	}
	add_action('wp_head', 'owlab_favicon');
}

/**
 * ----------------------------------------------------------------------------------------
 * include last bits
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_latest_enqueue' ) ) {

	function owlab_latest_enqueue() {

		global $template;
		
	   	wp_deregister_script('isotope');
	   	wp_dequeue_script('isotope');
		wp_register_script('isotope', OWLAB_SCRIPTS . '/vendors/isotope.pkgd.min.js', array(),THEME_VERSION,true);
		wp_enqueue_script('isotope');

	   	wp_deregister_script( 'waypoints' );
		wp_dequeue_script('waypoints');
		wp_register_script( 'waypoints', OWLAB_SCRIPTS . '/vendors/waypoints.min.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( "waypoints" );

		//deregister vc js
		wp_register_script('owwwlab_wpb_composer_front_js', OWLAB_SCRIPTS . '/vc/js_composer_front.js', array('jquery'),THEME_VERSION,true);
		wp_enqueue_script('owwwlab_wpb_composer_front_js');

		//we are going to need masterslider js one way or another
		if ( ! wp_script_is( 'masterslider-core', 'enqueued' ))
		{
			if ( basename($template) == "single-owlabbulkg.php" ){
				wp_enqueue_script( 'owlab_masterslider' );
				wp_enqueue_style( 'owlab-masterslider' );
				wp_enqueue_style( 'owlab-masterslider-custom' );
			}
			
		}


	   	//after that load custom js
	   	wp_enqueue_script('theme-custom-js');
	}

	if (!is_admin()) {
		add_action("wp_enqueue_scripts", "owlab_latest_enqueue", 99999);
	}
}
