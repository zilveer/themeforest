<?php
	add_action( 'get_header', 'orange_themes_scripts');
	
	function orange_themes_scripts() { 
		global $wp_styles;
		$color_skin = get_option(THEME_NAME."_color_skin");
		$banner_type = get_option ( THEME_NAME."_banner_type" );
		$layout = get_option ( THEME_NAME."_layout" );
		$google_font_1 = get_option(THEME_NAME."_google_font_1");
		$protocol = is_ssl() ? 'https' : 'http';
		
		
		wp_enqueue_style("style", get_template_directory_uri()."/style.css", Array());
		
		wp_enqueue_style("main-style", THEME_CSS_URL."style.css", Array());
		wp_enqueue_style("grid", THEME_CSS_URL."grid.css", Array());
		wp_enqueue_style("color-style", THEME_CSS_URL.$color_skin.".css", Array());
		wp_enqueue_style("responsive", THEME_CSS_URL."responsive.css", Array());
		wp_enqueue_style("icons", THEME_CSS_URL."icons.css", Array());
		wp_enqueue_style("fancybox", THEME_CSS_URL."fancybox.css", Array());
		
		if($google_font_1 && $google_font_1!="Default") {
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( 'google-fonts', $protocol."://fonts.googleapis.com/css?family=".str_replace(" ", "+", $google_font_1)."|' rel='stylesheet' type='text/css" );
		}
		
		
		if($layout=="boxed") {
			wp_enqueue_style("boxed-layout", THEME_CSS_URL."boxed-layout.css", Array());
		} else {
			wp_enqueue_style("wide-layout", THEME_CSS_URL."wide-layout.css", Array());
		}

		
		wp_enqueue_style("fonts", THEME_CSS_URL."fonts.php", Array());
		wp_enqueue_style("ot-dynamic-css", THEME_CSS_URL."dynamic-css.php", Array());
 
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("cookies" , THEME_JS_URL."admin/jquery.cookie.js", Array('jquery'), "1.0", true);
		
		if($banner_type) {
			wp_enqueue_script("banner" , THEME_JS_URL."jquery.floating_popup.1.3.min.js", Array('jquery'), "1.0", true);
		}

		wp_enqueue_script("menu" , THEME_JS_URL."jquery.menu.js", Array('jquery'), '', true);
		wp_enqueue_script("mobilemenu" , THEME_JS_URL."jquery.mobilemenu.js", Array('jquery'), '', true);
		wp_enqueue_script("fitvids" , THEME_JS_URL."jquery.fitvids.js", Array('jquery'), '', true);
		wp_enqueue_script("fancybox" , THEME_JS_URL."jquery.fancybox.js", Array('jquery'), '', true);
		wp_enqueue_script("easing" , THEME_JS_URL."jquery.easing.js", Array('jquery'), '', true);
		
		if (is_page_template ( 'template-contact.php' ) ) {
			wp_enqueue_script("contact" , THEME_JS_URL."jquery.contact.js", Array('jquery'), '', true);
		}
		
		if (is_page_template ( 'template-portfolio-3.php' ) || is_page_template ( 'template-portfolio-4.php' ) ) {
			wp_enqueue_script("isotope" , THEME_JS_URL."jquery.isotope.js", Array('jquery'), '', true);
			wp_enqueue_script("infinitescroll" , THEME_JS_URL."jquery.infinitescroll.min.js", Array('jquery'), '', true);
			wp_enqueue_script("portfolio" , THEME_JS_URL."jquery.portfolio.js", Array('jquery'), '', true);
		}
		
		wp_enqueue_script("flickr" , THEME_JS_URL."jquery.flickr.js", Array('jquery'), '');
		wp_enqueue_script("tabs" , THEME_JS_URL."jquery.tabs.js", Array('jquery'), '', true);
		wp_enqueue_script("tooltipster" , THEME_JS_URL."jquery.tooltipster.js", Array('jquery'), '', true);
		wp_enqueue_script("custom" , THEME_JS_URL."jquery.custom.js", Array('jquery'), '', true);

		
		wp_enqueue_script("scripts" , THEME_JS_URL."scripts.php", Array('jquery'), '', true);
	
		
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );


		wp_localize_script('custom','df',
			array(
				'adminUrl' => admin_url("admin-ajax.php"),
				'imageUrl' => THEME_IMAGE_URL,
				'cssUrl' => THEME_CSS_URL,
				'themeUrl' => THEME_URL
			)
		);
		
	}
	
?>