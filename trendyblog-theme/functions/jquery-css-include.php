<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	add_action( 'wp_enqueue_scripts', 'different_themes_scripts');
	
	function different_themes_scripts() { 
		global $wp_styles,$wp_scripts;
		$slider_enable = df_get_option(THEME_NAME."_slider_enable");
		$responsive = df_get_option(THEME_NAME."_responsive");
		$banner_type = df_get_option ( THEME_NAME."_banner_type" );

		//font settings	
		$_font_cyrillic_ex = df_get_option(THEME_NAME.'_font_cyrillic_ex');	
		$_font_cyrillic = df_get_option(THEME_NAME.'_font_cyrillic');	
		$_font_greek_ex = df_get_option(THEME_NAME.'_font_greek_ex');	
		$_font_greek = df_get_option(THEME_NAME.'_font_greek');	
		$_font_vietnamese = df_get_option(THEME_NAME.'_font_vietnamese');	
		$_font_latin_ex = df_get_option(THEME_NAME.'_font_latin_ex');	

		if($_font_cyrillic_ex=="on") {
			$_font_cyrillic_ex = ",cyrillic-ext";	
		} else {
			$_font_cyrillic_ex = false;
		}
		if($_font_cyrillic=="on") {
			$_font_cyrillic = ",cyrillic";	
		} else {
			$_font_cyrillic = false;
		}
		if($_font_greek_ex=="on") {
			$_font_greek_ex = ",greek-ext";	
		} else {
			$_font_greek_ex = false;
		}
		if($_font_greek=="on") {
			$_font_greek = ",greek";	
		} else {
			$_font_greek = false;
		}
		if($_font_vietnamese=="on") {
			$_font_vietnamese = ",vietnamese";	
		} else {
			$_font_vietnamese = false;
		}
		if($_font_latin_ex=="on") {
			$_font_latin_ex = ",latin-ext";	
		} else {
			$_font_latin_ex = false;
		}

		//include google fonts
		$google_fonts = array();
		for($i=1; $i<=5; $i++) {
			if(df_get_option(THEME_NAME."_google_font_".$i)) {
				$google_fonts[] = df_get_option(THEME_NAME."_google_font_".$i);	
			}
			
		}
		$google_fonts = array_unique($google_fonts);
		$i=1;
		foreach($google_fonts as $google_font) {
			$protocol = is_ssl() ? 'https' : 'http';
			if($google_font && $google_font!="Arial") {
				wp_enqueue_style( 'google-fonts-'.$i, $protocol."://fonts.googleapis.com/css?family=".str_replace(" ", "+", $google_font).":300,300italic,400,400italic,700,700italic&subset=latin".$_font_cyrillic_ex.$_font_cyrillic.$_font_greek_ex.$_font_greek.$_font_vietnamese.$_font_latin_ex);
			}
			$i++;
		}
		


		wp_enqueue_style("normalize", THEME_CSS_URL."normalize.css", Array());
		wp_enqueue_style("font-awesome", THEME_CSS_URL."fontawesome.css", Array());
		wp_enqueue_style("weather", THEME_CSS_URL."weather.css", Array());
		wp_enqueue_style("main-style", THEME_CSS_URL."style.css", Array());

		wp_enqueue_style("responsive-0", THEME_CSS_URL."responsive-0.css", Array(),'1.0', '(max-width:768px)');
		wp_enqueue_style("responsive-768", THEME_CSS_URL."responsive-768.css", Array(),'1.0', '(min-width:769px) and (max-width:992px)');
		wp_enqueue_style("responsive-992", THEME_CSS_URL."responsive-992.css", Array(),'1.0', '(min-width:993px) and (max-width:1200px)');
		wp_enqueue_style("responsive-1200", THEME_CSS_URL."responsive-1200.css", Array(),'1.0', '(min-width:1201px)');
		

		
		
		if($responsive!="on") {
			wp_enqueue_style("no-responsive", THEME_CSS_URL."no-responsive.css", Array(),'1.0');
		}
		//wp_enqueue_style('ie-only-styles', THEME_CSS_URL.'ie-ancient.css');
		//$wp_styles->add_data('ie-only-styles', 'conditional', 'lt IE 8');


		if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
			wp_enqueue_style('dynamic-css', admin_url('admin-ajax.php').'?action=df_dynamic_css');
		}

 		wp_enqueue_style("style", get_stylesheet_uri(), Array());

 		// js files
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-effects-slide");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-spinner");
		wp_enqueue_script("cookies" , THEME_JS_URL."admin/jquery.c00kie.js", Array('jquery'), "1.0", true);
		
		if ($banner_type && $banner_type != "off" ) {
			wp_enqueue_script("banner" , THEME_JS_URL."jquery.floating_popup.1.3.min.js", Array('jquery'), "1.0", true);
		}


		
		wp_enqueue_script("easing" , THEME_JS_URL."easing.min.js", Array('jquery'), '', true);
		wp_enqueue_script("smoothscroll" , THEME_JS_URL."smoothscroll.min.js", Array('jquery'), '', true);

		wp_enqueue_script("magnific" , THEME_JS_URL."magnific.min.js", Array('jquery'), '', true);
		wp_enqueue_script("bxslider" , THEME_JS_URL."bxslider.min.js", Array('jquery'), '', false);
		wp_enqueue_script("fitvids" , THEME_JS_URL."fitvids.min.js", Array('jquery'), '', false);
		wp_enqueue_script("viewportchecker" , THEME_JS_URL."viewportchecker.js", Array('jquery'), '', true);

		

		wp_enqueue_script(THEME_JS_URL."-scripts" , THEME_JS_URL."init.js", Array('jquery'), "", true);
		wp_enqueue_script("stickysidebar" , THEME_JS_URL."stickysidebar.min.js", Array('jquery'), "", true);

		if ( is_singular() ) wp_enqueue_script( "comment-reply" );

		wp_enqueue_script("df-scripts" , THEME_JS_URL."scripts.js", Array('jquery'), "1.0", true);
		wp_enqueue_script("scripts-wp" , THEME_JS_URL.THEME_NAME.".js", Array('jquery'), "1.0.0", true);
		
		if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
			wp_enqueue_script("dynamic-scripts" , admin_url('admin-ajax.php').'?action=df_dynamic_js', "1.0", true);
		}

		add_action( 'wp_head', function() {
		   echo '<!--[if lte IE 9]><script src="'.esc_url(THEME_JS_URL.'shiv.min.js').'"></script><![endif]-->';
		} );
		$post_type = get_post_type();
		if($post_type=="gallery") {
			$gallery_id =get_the_ID();
		} else { 
			$gallery_id = false;
		}
		
		wp_localize_script('jquery','df',
			array(
				'THEME_NAME' => THEME_NAME,
				'THEME_FULL_NAME' => THEME_FULL_NAME,
				'adminUrl' => admin_url("admin-ajax.php"),
				'gallery_id' => $gallery_id,
				'galleryCat' => get_query_var('gallery-cat'),
				'imageUrl' => THEME_IMAGE_URL,
				'cssUrl' => THEME_CSS_URL,
				'themeUrl' => THEME_URL,
				'pageurl' => esc_url( home_url( '/' ) )
			)
		);
		
	}
	
?>