<?php
	/*
	*
	*	Header Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

 	/* TOP BAR
 	================================================== */
 	if (!function_exists('sf_top_bar')) {
	function sf_top_bar() {

		// VARIABLES
		$options = get_option('sf_neighborhood_options');
		$tb_config = $options['tb_config'];
		$tb_left_text = $options['tb_left_text'];
		$tb_right_text = $options['tb_right_text'];
		$tb_search_text = $options['tb_search_text'];

		$show_sub = $options['show_sub'];
		$show_translation = $options['show_translation'];
		$show_account = $options['show_account'];
		$show_cart = $options['show_cart'];
		$ss_mobile = $options['ss_mobile'];

		$tb_output = $tb_menu_output = $tb_left_output = $tb_right_output = $swift_search_output = $ss_enable = '';

		if (isset($options['ss_enable'])) {
			$ss_enable = $options['ss_enable'];
		} else {
			$ss_enable = true;
		}


		// TOP BAR MENU OUTPUT
		$tb_menu_args = array(
			'echo'            => false,
			'theme_location' => 'top_bar_menu',
			'fallback_cb' => ''
		);
		$tb_menu_output .= '<nav class="top-menu clearfix">'. "\n";
		if(function_exists('wp_nav_menu')) {
			$tb_menu_output .= wp_nav_menu( $tb_menu_args );
		}
		$tb_menu_output .= '</nav>'. "\n";


		// TOP BAR SWIFT SEARCH OUTPUT
		if ($ss_enable) {
			$swift_search_output .= '<div class="tb-text"><a class="swift-search-link" href="#"><i class="fa-search-plus"></i><span>'.do_shortcode($tb_search_text).'</span></a></div>';
		}

		// TOP BAR LEFT OUTPUT
		if ($tb_config == "tb-1") {

			$tb_left_output = '<div class="tb-text clearfix">'. do_shortcode($tb_left_text). '</div>' . "\n";
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";

		} else if ($tb_config == "tb-2") {

			$tb_left_output = $tb_menu_output;
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";

		} else if ($tb_config == "tb-3") {

			$tb_left_output = '<div class="tb-text clearfix">'. do_shortcode($tb_left_text). '</div>' . "\n";
			$tb_right_output = $tb_menu_output;

		} else if ($tb_config == "tb-4") {

			$tb_left_output = sf_woo_links('top-menu', $tb_config);
			$tb_right_output = sf_aux_links('top-menu');

		} else if ($tb_config == "tb-5") {

			$tb_left_output = sf_woo_links('top-menu', $tb_config);
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";

		} else if ($tb_config == "tb-6") {

			$tb_left_output = sf_woo_links('top-menu', $tb_config);
			$tb_right_output = $tb_menu_output;

		} else if ($tb_config == "tb-7") {

			$tb_left_output = $swift_search_output;
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";

		} else if ($tb_config == "tb-8") {

			$tb_left_output = $swift_search_output;
			$tb_right_output = $tb_menu_output;

		} else if ($tb_config == "tb-9") {

			$tb_left_output = sf_aux_links('top-menu');
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";

		} else if ($tb_config == "tb-10") {

			$tb_left_output = '<div class="tb-text clearfix">'. do_shortcode($tb_left_text). '</div>' . "\n";
			$tb_right_output = sf_aux_links('top-menu');

		}


		// TOP BAR OUTPUT
		$tb_output .= '<div id="top-bar" class="'.$tb_config.'">'. "\n";
		if ($ss_mobile) {
		$tb_output .= '<div class="tb-ss hidden-desktop">'.$swift_search_output.'</div>'. "\n";
		}
		$tb_output .= '<div class="container">'. "\n";
		$tb_output .= '<div class="row">'. "\n";
		$tb_output .= '<div class="tb-left span6 clearfix">'. "\n";
		$tb_output .= $tb_left_output;
		$tb_output .= '</div> <!-- CLOSE .tb-left -->'. "\n";
		$tb_output .= '<div class="tb-right span6 clearfix">'. "\n";
		$tb_output .= $tb_right_output;
		$tb_output .= '</div> <!-- CLOSE .tb-right -->'. "\n";
		$tb_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$tb_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$tb_output .= '</div> <!-- CLOSE #top-bar -->'. "\n";


		// TOP BAR RETURN
		return $tb_output;
	}
	}

	/* HEADER
	================================================== */
	if (!function_exists('sf_header')) {
	function sf_header() {

		// VARIABLES
		$options = get_option('sf_neighborhood_options');
		$header_layout = $options['header_layout'];
		$show_cart = $options['show_cart'];
		$show_wishlist = $options['show_wishlist'];
		$disable_search = false;
		if (isset($options['disable_search'])) {
			$disable_search = $options['disable_search'];
		}
		$header_search_pt = "any";
		if (isset($options['header_search_pt'])) {
			$header_search_pt = $options['header_search_pt'];
		}
		$header_output = $main_menu = '';

		if ($header_layout == "header-1") {

		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="header-row row">'. "\n";
		$header_output .= '<div class="header-left span4">'.sf_woo_links('header-menu', 'logo-left').'</div>'. "\n";
		$header_output .= sf_logo('span4 logo-center');
		$header_output .= '<div class="header-right span4">'.sf_aux_links('header-menu', TRUE).'</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		$header_output .= '<div id="main-nav">'. "\n";
		$header_output .= sf_main_menu('main-navigation', 'full');
		$header_output .= '</div>'. "\n";

		} else if ($header_layout == "header-2") {

		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="header-row row">'. "\n";
		$header_output .= sf_logo('span4 logo-left');
		$header_output .= '<div class="header-right span8">'.sf_aux_links('header-menu').'</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		$header_output .= '<div id="main-nav">'. "\n";
		$header_output .= sf_main_menu('main-navigation', 'full');
		$header_output .= '</div>'. "\n";

		} else if ($header_layout == "header-3") {

		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="header-row row">'. "\n";
		$header_output .= '<div class="header-left span8">'.sf_aux_links('header-menu').'</div>'. "\n";
		$header_output .= sf_logo('span4 logo-right');
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		$header_output .= '<div id="main-nav">'. "\n";
		$header_output .= sf_main_menu('main-navigation', 'full');
		$header_output .= '</div>'. "\n";

		} else if ($header_layout == "header-4") {

		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="header-row row">'. "\n";
		$header_output .= sf_logo('span4 logo-left');
		$header_output .= '<div class="header-right span8">';
		$header_output .= '<nav class="std-menu">'. "\n";
		$header_output .= '<ul class="menu">'. "\n";
		if ($show_cart) {
		$header_output .= sf_get_cart();
		}
		if ( class_exists( 'YITH_WCWL_UI' ) &&  $show_wishlist)  {
		$header_output .= sf_get_wishlist();
		}
		if (!$disable_search) {
		$header_output .= '<li class="menu-search no-hover"><a href="#"><i class="fa-search"></i></a>'. "\n";
		$header_output .= '<ul class="sub-menu">'. "\n";
		$header_output .= '<li><div class="ajax-search-wrap"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="'.home_url().'/">';
		if ( $header_search_pt != "any" ) {
		    $header_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
		}
		$header_output .= '<input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div></li>'. "\n";
		$header_output .= '</ul>'. "\n";
		$header_output .= '</li>'. "\n";
		}
		$header_output .= '</ul>'. "\n";
		$header_output .= '</nav>'. "\n";
		$header_output .= sf_main_menu('main-navigation');
		$header_output .= '</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();

		} else {

		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="header-row row">'. "\n";
		$header_output .= sf_logo('span4 logo-right');
		$header_output .= '<div class="header-left span8">';
		$header_output .= sf_main_menu('main-navigation');
		$header_output .= '<nav class="std-menu">'. "\n";
		$header_output .= '<ul class="menu">'. "\n";
		if ($show_cart) {
		$header_output .= sf_get_cart();
		}
		if ( class_exists( 'YITH_WCWL_UI' ) &&  $show_wishlist)  {
		$header_output .= sf_get_wishlist();
		}
		if (!$disable_search) {
		$header_output .= '<li class="menu-search no-hover"><a href="#"><i class="fa-search"></i></a>'. "\n";
		$header_output .= '<ul class="sub-menu">'. "\n";
		$header_output .= '<li><div class="ajax-search-wrap"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="'.home_url().'/">';
		if ( $header_search_pt != "any" ) {
		    $header_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
		}
		$header_output .= '<input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div></li>'. "\n";
		$header_output .= '</ul>'. "\n";
		$header_output .= '</li>'. "\n";
		}
		$header_output .= '</ul>'. "\n";
		$header_output .= '</nav>'. "\n";
		$header_output .= '</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();

		}

		// HEADER RETURN
		return $header_output;

	}
	}

	if (!function_exists('sf_mini_header')) {
	function sf_mini_header() {

		$mini_header_output = '';

		$mini_header_output .= '<div id="mini-header">';
		$mini_header_output .= sf_main_menu('mini-navigation', 'full');
		$mini_header_output .= '</div>';

		return $mini_header_output;
	}
	}

	if (!function_exists('sf_mobile_search')) {
	function sf_mobile_search() {
		
		$options = get_option('sf_neighborhood_options');
		$mobile_search_output = '';
		$header_search_pt = "any";
		if (isset($options['header_search_pt'])) {
			$header_search_pt = $options['header_search_pt'];
		}

		$mobile_search_output .= '<form method="get" class="mobile-search-form container" action="'.home_url().'/"><input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" />';
		if ( $header_search_pt != "any" ) {
		    $mobile_search_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
		}
		$mobile_search_output .= '</form>';

		return $mobile_search_output;
	}
	}


	/* LOGO
	================================================== */
	if (!function_exists('sf_logo')) {
	function sf_logo($logo_class) {

		//VARIABLES
		global $woocommerce;
		$options = get_option('sf_neighborhood_options');
		$show_cart = $options['show_cart'];
		$logo = $retina_logo = "";
		if (isset($options['logo_upload'])) {
		$logo = $options['logo_upload'];
		}
		if (isset($options['retina_logo_upload'])) {
		$retina_logo = $options['retina_logo_upload'];
		}
		if ($logo == "") {
		$logo = get_template_directory_uri() . '/images/logo.png';
		}

		if ($retina_logo == "") {
		$retina_logo = $logo;
		}
		$logo_output = "";
		$logo_alt = get_bloginfo( 'name' );
		$logo_link_url = home_url();
		$disable_search = false;
		if (isset($options['disable_search'])) {
			$disable_search = $options['disable_search'];
		}

		$logos = array('logo', 'retina_logo');
		foreach ($logos as $this_logo) {
			if (stripos(${$this_logo}, 'http://') === 0) {
				${$this_logo} = substr(${$this_logo}, 5);
			}
		}

		// LOGO OUTPUT
		$logo_output .= '<div id="logo" class="'.$logo_class.' clearfix">'. "\n";
		$logo_output .= '<a class="logo-link" href="'.$logo_link_url.'">'. "\n";
		$logo_output .= '<img class="standard" src="'.$logo.'" alt="'.$logo_alt.'" />'. "\n";
		$logo_output .= '<img class="retina" src="'.$retina_logo.'" alt="'.$logo_alt.'" />'. "\n";
		$logo_output .= '</a>'. "\n";
		$logo_output .= '<a href="#" class="hidden-desktop show-main-nav"><i class="fa-align-justify"></i></a>'. "\n";
		if ($woocommerce && $show_cart) {
		$logo_output .= '<a href="'.$woocommerce->cart->get_cart_url().'" class="hidden-desktop mobile-cart-link"><i class="sf-cart"></i></a>'. "\n";
		}
		if (!$disable_search) {
		$logo_output .= '<a href="#" class="hidden-desktop mobile-search-link"><i class="fa-search"></i></a>'. "\n";
		}
		$logo_output .= '</div>'. "\n";


		// LOGO RETURN
		return $logo_output;
	}
	}


	/* MENU
	================================================== */
	if (!function_exists('sf_main_menu')) {
		function sf_main_menu($id, $layout = "") {
	
			// VARIABLES
			$options = get_option('sf_neighborhood_options');
			$show_cart = $options['show_cart'];
			$show_wishlist = $options['show_wishlist'];
			$disable_search = false;
			if (isset($options['disable_search'])) {
				$disable_search = $options['disable_search'];
			}
			$header_search_pt = "any";
			if (isset($options['header_search_pt'])) {
				$header_search_pt = $options['header_search_pt'];
			}
			$mobile_translation_enabled = false;
			if ( isset($options['enable_mobile_translation']) ) {
				$mobile_translation_enabled = $options['enable_mobile_translation'];
			}
			$menu_output = $menu_full_output = "";
			$main_menu_args = array(
				'echo'            => false,
				'theme_location' => 'main_navigation',
				'walker'         => new sf_mega_menu_walker,
				'fallback_cb' => ''
			);
			
			// MOBILE TRANSLATION OUTPUT
			$mobile_translation = "";
			if ( $mobile_translation_enabled ) {
				$mobile_translation = '<ul id="mobile-header-languages" class="header-languages sub-menu">'. "\n";
				if (function_exists( 'language_flags' )) {
					$mobile_translation .= language_flags();
				}
				$mobile_translation .= '</ul>'. "\n";
			}
	
			// MENU OUTPUT
			if ($id == "mini-navigation") {
				$menu_output .= '<nav id="'.$id.'" class="mini-menu clearfix">'. "\n";
			} else {
				$menu_output .= '<nav id="'.$id.'" class="std-menu clearfix">'. "\n";
			}
			
			if ( function_exists('wp_nav_menu') ) {
				$menu_output .= wp_nav_menu( $main_menu_args );
			}
			
			$menu_output .= $mobile_translation;
			
			$menu_output .= '</nav>'. "\n";
	
	
			// FULL WIDTH MENU OUTPUT
			if ($layout == "full") {
				$menu_full_output .= '<div class="container">'. "\n";
				$menu_full_output .= '<div class="row">'. "\n";
				$menu_full_output .= '<div class="span9">'. "\n";
				$menu_full_output .= $menu_output . "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '<div class="span3 header-right">'. "\n";
				if ($id == "mini-navigation") {
				$menu_full_output .= '<nav class="mini-menu">'. "\n";
				} else {
				$menu_full_output .= '<nav class="std-menu">'. "\n";
				}
				$menu_full_output .= '<ul class="menu">'. "\n";
				if (!$disable_search) {
				$menu_full_output .= '<li class="menu-search no-hover"><a href="#"><i class="fa-search"></i></a>'. "\n";
				$menu_full_output .= '<ul class="sub-menu">'. "\n";
				$menu_full_output .= '<li><div class="ajax-search-wrap"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="'.home_url().'/">';
				if ( $header_search_pt != "any" ) {
				    $menu_full_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
				}
				$menu_full_output .= '<input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div></li>'. "\n";
				$menu_full_output .= '</ul>'. "\n";
				$menu_full_output .= '</li>'. "\n";
				}
				if ($show_cart) {
				$menu_full_output .= sf_get_cart();
				}
				if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist)  {
				$menu_full_output .= sf_get_wishlist();
				}
				$menu_full_output .= '</ul>'. "\n";
				$menu_full_output .= '</nav>'. "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";
	
				$menu_output = $menu_full_output;
			}
	
	
			// MENU RETURN
			return $menu_output;
		}
	}

	/* WOO LINKS
	================================================== */
	if (!function_exists('sf_woo_links')) {
		function sf_woo_links($position, $config = "") {

			// VARIABLES
			$options = get_option('sf_neighborhood_options');
			$tb_search_text = $options['tb_search_text'];
			$woo_links_output = $ss_enable = "";

			if (isset($options['ss_enable'])) {
				$ss_enable = $options['ss_enable'];
			} else {
				$ss_enable = true;
			}

			// WOO LINKS OUTPUT
			$woo_links_output .= '<nav class="std-menu '.$position.'">'. "\n";
			$woo_links_output .= '<ul class="menu">'. "\n";
			if ( sf_woocommerce_activated() ) {
				if (is_user_logged_in()) {
					global $current_user;
					get_currentuserinfo();
					$woo_links_output .= '<li class="tb-welcome">' . __("Welcome", "swiftframework") . " " . $current_user->display_name . '</li>'. "\n";
				} else {
					$woo_links_output .= '<li class="tb-welcome">' . __("Welcome", "swiftframework") . '</li>'. "\n";
				}
			}
			if ($ss_enable) {
				if ($position == "top-menu") {
				$woo_links_output .= '<li class="tb-woo-custom clearfix"><a class="swift-search-link" href="#"><i class="fa-search-plus"></i><span>'.do_shortcode($tb_search_text).'</span></a></li>'. "\n";
				} else {
				$woo_links_output .= '<li class="hs-woo-custom clearfix"><a class="swift-search-link" href="#"><i class="fa-search-plus"></i><span>'.do_shortcode($tb_search_text).'</span></a></li>'. "\n";
				}
			}
			$woo_links_output .= '</ul>'. "\n";
			$woo_links_output .= '</nav>'. "\n";

			// RETURN
			return $woo_links_output;
		}
	}

	/* AUX LINKS
	================================================== */
	if (!function_exists('sf_aux_links')) {
		function sf_aux_links($position, $alt_version = FALSE) {

			// VARIABLES
			$login_url = wp_login_url();
			$logout_url = wp_logout_url( home_url() );
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
				$logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) );
			  	$login_url = get_permalink( $myaccount_page_id );
			  	if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
			    	$logout_url = str_replace( 'http:', 'https:', $logout_url );
					$login_url = str_replace( 'http:', 'https:', $login_url );
				}
			}
			$options = get_option('sf_neighborhood_options');
			$show_sub = $options['show_sub'];
			$show_translation = $options['show_translation'];
			$sub_code = $options['sub_code'];
			$show_account = $options['show_account'];
			$tb_search_text = __($options['tb_search_text'], "swiftframework");
			$aux_links_output = $ss_enable = "";

			if (isset($options['ss_enable'])) {
				$ss_enable = $options['ss_enable'];
			} else {
				$ss_enable = true;
			}

			// LINKS + SEARCH OUTPUT
			$aux_links_output .= '<nav class="std-menu '.$position.'">'. "\n";
			$aux_links_output .= '<ul class="menu">'. "\n";
			if ($show_sub) {
				$aux_links_output .= '<li class="parent"><a href="#">'. __("Subscribe", "swiftframework") .'</a>'. "\n";
				$aux_links_output .= '<ul class="sub-menu">'. "\n";
				$aux_links_output .= '<li><div id="header-subscribe" class="clearfix">'. "\n";
				$aux_links_output .= do_shortcode($sub_code) . "\n";
				$aux_links_output .= '</div></li>'. "\n";
				$aux_links_output .= '</ul>'. "\n";
				$aux_links_output .= '</li>'. "\n";
			}
			if ($show_translation) {
				$aux_links_output .= '<li class="parent aux-languages"><a href="#">'. __("Language", "swiftframework") .'</a>'. "\n";
				$aux_links_output .= '<ul id="header-languages" class="header-languages sub-menu">'. "\n";
				if (function_exists( 'language_flags' )) {
				$aux_links_output .= language_flags();
				}
				$aux_links_output .= '</ul>'. "\n";
				$aux_links_output .= '</li>'. "\n";
			}
			if ($show_account) {
				if (is_user_logged_in()) {
					$aux_links_output .= '<li><a href="'.wp_logout_url(home_url()).'">'. __("Sign Out", "swiftframework") .'</a></li>'. "\n";
					if ( $myaccount_page_id ) {
					$aux_links_output .= '<li><a href="'.get_permalink( $myaccount_page_id ).'" class="admin-link">'. __("My Account", "swiftframework") .'</a>'. "\n";
					} else {
					$aux_links_output .= '<li><a href="'.get_admin_url().'" class="admin-link">'. __("My Account", "swiftframework") .'</a>'. "\n";
					}
				} else {
					$aux_links_output .= '<li><a href="'.$login_url.'">'. __("Login", "swiftframework") .'</a>'. "\n";
				}
			}
			if (($position == "header-menu" && !$alt_version) && $ss_enable) {
			$aux_links_output .= '<li><a class="swift-search-link" href="#"><i class="fa-search-plus"></i><span>'.do_shortcode($tb_search_text).'</span></a></li>'. "\n";
			}
			$aux_links_output .= '</ul>'. "\n";
			$aux_links_output .= '</nav>'. "\n";


			// RETURN
			return $aux_links_output;

		}
	}

	if (!function_exists('sf_get_cart')) {
		function sf_get_cart() {

			$cart_output = "";

			// Check if WooCommerce is active
			if ( sf_woocommerce_activated() ) {

				global $woocommerce;

				$options = get_option('sf_neighborhood_options');
				$show_cart_count = false;
				if (isset($options['show_cart_count'])) {
					$show_cart_count = $options['show_cart_count'];
				}

				$cart_total = WC()->cart->get_cart_total();
				$cart_count = $woocommerce->cart->cart_contents_count;
				$cart_count_text = sf_product_items_text($cart_count);
				$price_display_suffix  = get_option( 'woocommerce_price_display_suffix' );
				
				if ($show_cart_count) {
					$cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="'.$woocommerce->cart->get_cart_url().'" title="'.__("View your shopping bag", "swiftframework").'"><i class="sf-cart"></i>'.$cart_total.' ('.$cart_count.')</a>';
				} else {
					$cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="'.$woocommerce->cart->get_cart_url().'" title="'.__("View your shopping bag", "swiftframework").'"><i class="sf-cart"></i>'.$cart_total.'</a>';

				}
	            $cart_output .= '<ul class="sub-menu">';
	            $cart_output .= '<li>';
				$cart_output .= '<div class="shopping-bag">';

	            if ( sizeof($woocommerce->cart->cart_contents)>0 ) {

	            	$cart_output .= '<div class="bag-header">'.$cart_count_text.' '.__('in the shopping bag', 'swiftframework').'</div>';

	            	$cart_output .= '<div class="bag-contents">';

	            	foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) {

	                    $_product     		 = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	                    $price 				 = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
	                    $product_title       = $_product->get_title();
	                    $product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;

	                    if ($_product->exists() && $cart_item['quantity']>0) {
	                        $cart_output .= '<div class="bag-product clearfix">';
	                      	$cart_output .= '<figure><a class="bag-product-img" href="'.get_permalink($cart_item['product_id']).'">'.$_product->get_image().'</a></figure>';
	                        $cart_output .= '<div class="bag-product-details">';
	                        $cart_output .= '<div class="bag-product-title"><a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_short_title, $_product) . '</a></div>';
	                        $cart_output .= '<div class="bag-product-price">'.__("Unit Price:", "swiftframework").'
	                        '.$price.'</div>';
	                        $cart_output .= '<div class="bag-product-quantity">'.__('Quantity:', 'swiftframework').' '.$cart_item['quantity'].'</div>';
	                        if ( $price_display_suffix ) {
	                        	$cart_output .= '<small class="woocommerce-price-suffix">'. $price_display_suffix . '</small>';
	                        }
	                        $cart_output .= '</div>';
	                        $cart_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'swiftframework') ), $cart_item_key );

	                        $cart_output .= '</div>';
	                	}
	                }

	                $cart_output .= '</div>';

	                $cart_output .= '<div class="bag-buttons">';

	                $cart_output .= '<a class="sf-roll-button bag-button" href="'.esc_url( $woocommerce->cart->get_cart_url() ).'"><span>'.__('View shopping bag', 'swiftframework').'</span><span>'.__('View shopping bag', 'swiftframework').'</span></a>';

	                $cart_output .= '<a class="sf-roll-button checkout-button" href="'.esc_url( $woocommerce->cart->get_checkout_url() ).'"><span >'.__('Proceed to checkout', 'swiftframework').'</span><span>'.__('Proceed to checkout', 'swiftframework').'</span></a>';

	               	$cart_output .= '</div>';

	            } else {

	           		$cart_output .= '<div class="bag-header">'.__("0 items in the shopping bag", "swiftframework").'</div>';

	           		$cart_output .= '<div class="bag-empty">'.__('Unfortunately, your shopping bag is empty.','swiftframework').'</div>';

	            	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

	            	$cart_output .= '<div class="bag-buttons">';

	            	$cart_output .= '<a class="sf-roll-button shop-button" href="'.esc_url( $shop_page_url ).'"><span>'.__('Go to the shop', 'swiftframework').'</span><span>'.__('Go to the shop', 'swiftframework').'</span></a>';

	            	$cart_output .= '</div>';

	            }

			    $cart_output .= '</div>';
	            $cart_output .= '</li>';
	            $cart_output .= '</ul>';
	            $cart_output .= '</li>';

	        }

			return $cart_output;

		}
	}

	if (!function_exists('sf_get_wishlist')) {
		function sf_get_wishlist() {

			global $wpdb, $yith_wcwl, $woocommerce;

			$wishlist_output = "";

			if ( is_user_logged_in() ) {
			    $user_id = get_current_user_id();
			}

			$count = array();

			if( is_user_logged_in() ) {
			    $count = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
			    $count = $count[0]['cnt'];
			} else {
			    $count[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
			    $count = $count[0]['cnt'];
			} 

			if (is_array($count)) {
				$count = 0;
			}

			$wishlist_output .= '<li class="parent wishlist-item"><a class="wishlist-link" href="'.$yith_wcwl->get_wishlist_url().'" title="'.__("View your wishlist", "swiftframework").'"><i class="fa-star"></i><span>'.$count.'</span></a>';
			$wishlist_output .= '<ul class="sub-menu">';
			$wishlist_output .= '<li>';
			$wishlist_output .= '<div class="wishlist-bag">';

			$current_page = 1;
			$limit_sql = '';
			$count_limit = 0;

			if( is_user_logged_in() )
			    { $wishlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ), ARRAY_A ); }
			else
			    { $wishlist = yith_getcookie( 'yith_wcwl_products' ); }
			
			$wishlist_title = get_option( 'yith_wcwl_wishlist_title' );
			if( !empty( $wishlist_title ) ) {
			$wishlist_output .= '<div class="bag-header">'.$wishlist_title.'</div>';
			}
			$wishlist_output .= '<div class="bag-contents">';

			$wishlist_output .= do_action( 'yith_wcwl_before_wishlist' );

	        if ( count( $wishlist ) > 0 ) :

	           	foreach( $wishlist as $values ) :

	                if ($count_limit < 4) {

		                if( !is_user_logged_in() ) {
		    				if( isset( $values['add-to-wishlist'] ) && is_numeric( $values['add-to-wishlist'] ) ) {
		    					$values['prod_id'] = $values['add-to-wishlist'];
		    					$values['ID'] = $values['add-to-wishlist'];
		    				} else {
		    					   if( isset($values['product_id']) ){
										$values['prod_id'] = $values['product_id'];
		    							$values['ID'] = $values['product_id'];   	
								   }else{
								   	   $values['ID'] = $values['prod_id'];   	
								   }
		    				}
		    			}

		                $product_obj = get_product( $values['prod_id'] );

		                if( $product_obj !== false && $product_obj->exists() ) :

		                $wishlist_output .= '<div id="wishlist-'.$values['ID'].'" class="bag-product clearfix prod-' .  $values['prod_id'] .'">';

		                if ( has_post_thumbnail($product_obj->id) ) {
		                	$image_link  		= wp_get_attachment_url( get_post_thumbnail_id($product_obj->id) );
		                	//$image = aq_resize( $image_link, 70, 70, true, false);

		                	$image      = wp_get_attachment_image_src( get_post_thumbnail_id( $product_obj->id ), 'thumbnail' );

		                	if ($image) {
		                		$wishlist_output .= '<figure><a class="bag-product-img" href="'.esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ).'"><img itemprop="image" src="'.$image[0].'" /></a></figure>';
		                	}
		                }

		                $wishlist_output .= '<div class="bag-product-details">';
		                $wishlist_output .= '<div class="bag-product-title"><a href="'.esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ).'">'. apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) .'</a></div>';

		                if( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
		                $wishlist_output .= '<div class="bag-product-price">'.apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price_excluding_tax() ), $values, '' ).'</div>';
		               	} else {
		               	$wishlist_output .= '<div class="bag-product-price">'.apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price() ), $values, '' ).'</div>';
		                }
		                $wishlist_output .= '</div>';
		                $wishlist_output .= '</div>';

		                endif;

						$count_limit++;
					}

	            endforeach;

	        else :
	            $wishlist_output .= '<div class="wishlist-empty">'. __( 'Your wishlist is currently empty.', 'swiftframework' ) .'</div>';
	        endif;

	        $wishlist_output .= '</div>';

			$wishlist_output .= '<div class="bag-buttons">';

			$wishlist_output .= '<a class="sf-roll-button shop-button" href="'.$yith_wcwl->get_wishlist_url().'"><span>'.__('Go to your wishlist', 'swiftframework').'</span><span>'.__('Go to your wishlist', 'swiftframework').'</span></a>';

			$wishlist_output .= '</div>';


	 		do_action( 'yith_wcwl_after_wishlist' );

			$wishlist_output .= '</div>';
			$wishlist_output .= '</li>';
			$wishlist_output .= '</ul>';
			$wishlist_output .= '</li>';

			return $wishlist_output;
		}
	}


	/* AJAX SEARCH
	================================================== */
	if (!function_exists('sf_ajaxsearch')) {
		function sf_ajaxsearch() {
			$search_term = trim($_POST['s']);

			$options = get_option('sf_neighborhood_options');
			$header_search_pt = "any";
			if (isset($options['header_search_pt'])) {
				$header_search_pt = $options['header_search_pt'];
			}

			$search_query_args = array(
				's' => $search_term,
				'post_type' => $header_search_pt,
				'post_status' => 'publish',
				'suppress_filters' => false,
				'numberposts' => -1
			);
			$search_query_args = http_build_query($search_query_args);
			$search_results = get_posts( $search_query_args );
			$count = count($search_results);
			$shown_results = 5;

			$search_results_ouput = "";

			if (!empty($search_results)) {

				$sorted_posts = $post_type = array();

				foreach ($search_results as $search_result) {
					$sorted_posts[$search_result->post_type][] = $search_result;
				    // Check we don't already have this post type in the post_type array
				    if (empty($post_type[$search_result->post_type])) {
				    	// Add the post type object to the post_type array
				        $post_type[$search_result->post_type] = get_post_type_object($search_result->post_type);
				    }
				}

				$i = 0;
				foreach ($sorted_posts as $key => $type) {
					$search_results_ouput .= '<div class="search-result-pt">';

					if ($header_search_pt == "any") {
				        if(isset($post_type[$key]->labels->name)) {
				            $search_results_ouput .= "<h6>".__($post_type[$key]->labels->name, "swiftframework")."</h6>";
				        } else if(isset($key)) {
				            $search_results_ouput .= "<h6>".$key."</h6>";
				        } else {
				            $search_results_ouput .= "<h6>".__("Other", "swiftframework")."</h6>";
				        }
			        }

			        foreach ($type as $post) {

			        	$img_icon = "";

			        	$post_format = get_post_format($post->ID);
			        	if ( $post_format == "" ) {
			        		$post_format = 'standard';
			        	}
			        	$post_type = get_post_type($post->ID);

			        	if ($post_type == "post") {
			        		if ($post_format == "quote" || $post_format == "status") {
			        			$img_icon = "fa-quote-left";
			        		} else if ($post_format == "image") {
			        			$img_icon = "fa-picture-o";
			        		} else if ($post_format == "chat") {
			        			$img_icon = "fa-comments-o";
			        		} else if ($post_format == "audio") {
			        			$img_icon = "fa-music";
			        		} else if ($post_format == "video") {
			        			$img_icon = "fa-film";
			        		} else if ($post_format == "link") {
			        			$img_icon = "fa-link";
			        		} else {
			        			$img_icon = "fa-pencil";
			        		}
			        	} else if ($post_type == "product") {
			        		$img_icon = "fa-shopping-cart";
			        	} else if ($post_type == "portfolio") {
			        		$img_icon = "fa-picture-o";
			        	} else if ($post_type == "team") {
			        		$img_icon = "fa-user";
			        	} else if ($post_type == "galleries") {
			        		$img_icon = "fa-picture-o";
			        	} else {
			        		$img_icon = "fa-file";
			        	}

			        	$post_title = get_the_title($post->ID);
			        	$post_permalink = get_permalink($post->ID);

			        	$image = get_the_post_thumbnail( $post->ID, 'thumbnail' );

			            $search_results_ouput .= '<div class="search-result">';

			        	if ($image) {
			        		$search_results_ouput .= '<div class="search-item-img"><a href="'.$post_permalink.'">'.$image.'</div>';
			        	} else {
			        		$search_results_ouput .= '<div class="search-item-img"><a href="'.$post_permalink.'" class="img-holder"><i class="'.$img_icon.'"></i></a></div>';
			        	}

			            $search_results_ouput .= '<div class="search-item-content">';
			            $search_results_ouput .= '<h5><a href="'.$post_permalink.'">'.$post_title.'</a></h5>';
			            $search_results_ouput .= '</div>';

			            $search_results_ouput .= '</div>';

			        	$i++;
			        	if ($i == $shown_results) break;
			        }

			       $search_results_ouput .= '</div>';
			        if ($i == $shown_results) break;
			    }

			    if ($count > 1) {

			    	$search_link = get_search_link( $search_term );
			    	
			    	if (strpos($search_link,'?') !== false) {
			    		$search_link .= '&post_type='. $header_search_pt;
			    	} else {
			    		$search_link .= '?post_type='. $header_search_pt;
			    	}
			    	
			    	$search_results_ouput .= '<a href="'.$search_link.'" class="all-results">'.sprintf(__("View all %d results", "swiftframework"), $count).'</a>';
			    }

			} else {

				$search_results_ouput .= '<div class="no-search-results">';
				$search_results_ouput .= '<h6>'.__("No results", "swiftframework").'</h6>';
				$search_results_ouput .= '<p>'.__("No search results could be found, please try another query.", "swiftframework").'</p>';
				$search_results_ouput .= '</div>';

			}

			echo $search_results_ouput;
			die();
		}
		add_action('wp_ajax_sf_ajaxsearch', 'sf_ajaxsearch');
		add_action('wp_ajax_nopriv_sf_ajaxsearch', 'sf_ajaxsearch');
	}

	if (!function_exists('sf_ajaxurl')) {
		function sf_ajaxurl() {
		?>
			<script type="text/javascript">
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			</script>
		<?php
		}
		add_action('wp_head','sf_ajaxurl');
	}



	 /* WISHLIST PRODUCT HTML
    ================================================== */
    if ( ! function_exists( 'sf_get_wishlist_product' ) ) {
        function sf_get_wishlist_product($product_id) {

			 $wishlist_output = "";
             $product_obj = get_product( $product_id );

             if ( $product_obj !== false && $product_obj->exists() ) {

                  $wishlist_output .= '<div id="wishlist-' . $product_id . '" class="bag-product clearfix">';

                  if ( has_post_thumbnail( $product_obj->id ) ) {
                      $image_link = wp_get_attachment_url( get_post_thumbnail_id( $product_obj->id ) );
                      $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $product_obj->id ), 'thumbnail' );

                      if ( $image ) {
                          $wishlist_output .= '<figure><a class="bag-product-img" href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $product_obj->id  ) ) ) . '"><img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" /></a></figure>';
                                }
                            }

                            $wishlist_output .= '<div class="bag-product-details">';
                            $wishlist_output .= '<div class="bag-product-title"><a href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $product_obj->id ) ) ) . '">' . apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) . '</a></div>';

                            if ( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
                                $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price_excluding_tax() ), '' ) . '</div>';
                            } else {
                                $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price() ), '' ) . '</div>';
                            }
                            $wishlist_output .= '</div>';
                            $wishlist_output .= '</div>';

                        }

			return $wishlist_output;


			}

	}

	/* WISHLIST UPDATE
	================================================== */
	if ( ! function_exists( 'sf_add_to_wishlist' ) ) {
        function sf_add_to_wishlist() {

           	if ( ! empty( $_REQUEST['product_id'] ) ) {
                $product_id = $_REQUEST['product_id'];
            }

            $wishlist_itens = array();
           	$wishlist_itens['whishlist_output'] = sf_get_wishlist_product($product_id);

            echo json_encode( $wishlist_itens );
            die();

	}
	add_action( 'wp_ajax_sf_add_to_wishlist', 'sf_add_to_wishlist' );
    add_action( 'wp_ajax_nopriv_sf_add_to_wishlist', 'sf_add_to_wishlist' );
	}
?>
