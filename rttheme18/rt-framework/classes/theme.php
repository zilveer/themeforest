<?php
#-----------------------------------------
#	RT-Theme theme.php
#	version: 1.2
#-----------------------------------------

#
#	Site Class
#
 
class RTThemeSite extends RTTheme {
 
	function theme_init(){ 

		//Loading Theme Scripts
		add_action('wp_enqueue_scripts', array(&$this,'load_scripts'));

		//Loading Theme Styles
		add_action('wp_enqueue_scripts', array(&$this,'load_styles'),10);

		//Loading Theme Colors 
		add_action('wp_enqueue_scripts', array(&$this,'load_color_styles'),30);		

		//Loading WP Main CSS
		add_action('wp_enqueue_scripts', array(&$this,'load_wp_css'),40);		

		//Loading html5_shiv
		add_action('wp_head', array(&$this,'add_html5_shiv'));  

		//Loading html5_shiv
		add_action('wp_head', array(&$this,'add_ie9_filter'));  
	}  


	#
	# Loading Theme Scripts
	#

	function load_scripts(){
		wp_enqueue_script('modernizr', RT_THEMEURI  . '/js/modernizr.min.js', 1, "", false  );
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-easing', RT_THEMEURI  . '/js/jquery.easing.1.3.js', array('jquery'), "", "true" ); 
		wp_enqueue_script('jquery-tools', RT_THEMEURI  . '/js/jquery.tools.min.js', array('jquery') , "", "true" );	 
		
		wp_enqueue_script('waypoints', RT_THEMEURI  . '/js/waypoints.min.js', array('jquery'), "", "true"  );
		wp_enqueue_script('mediaelement-and-player', RT_THEMEURI  . '/js/video_player/mediaelement-and-player.min.js', array('jquery'), "", "true"  );  
		wp_enqueue_script('jackbox', RT_THEMEURI  . '/js/lightbox/js/jackbox-packed.min.js', array('jquery'), "", "true"  );  	
		wp_enqueue_script('colortip-js', RT_THEMEURI  . '/js/colortip-1.0-jquery.js', array('jquery'), "", "true"  );  	 
		wp_enqueue_script('flex-slider', RT_THEMEURI . '/js/jquery.flexslider.js', array(), "", "true" ); 
		wp_enqueue_script('rt-theme-scripts', RT_THEMEURI  . '/js/script.js', 10000, "", "true" );  

		//ajax url depended WPML plugin
		$ajax_url = function_exists('icl_object_id') ? admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE.'') : admin_url('admin-ajax.php');

		//localize js params
		$js_params = array(
			'ajax_url' => $ajax_url,
			'rttheme_template_dir' => RT_THEMEURI,
			'sticky_logo' => get_option( RT_THEMESLUG."_show_sticky_logo" ),
			'content_animations' => get_option( RT_THEMESLUG."_content_animations" ),
			'page_loading' => get_option( RT_THEMESLUG."_page_loading" )
		);

		wp_localize_script( 'rt-theme-scripts', 'rt_theme_params', $js_params );


		 //thread comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}	


	
	#
	# Loading Theme Styles
	#
	
	function load_styles(){ 

		wp_register_style('normalize', RT_THEMEURI . '/css/normalize.css');
		wp_register_style('theme-framework', RT_THEMEURI . '/css/rt-css-framework.css');
		wp_register_style('theme-style-all', RT_THEMEURI . '/css/style.css');  
		wp_register_style('fontello', rt_locate_media_file( '/css/fontello/css/fontello.css' )); 
		wp_register_style('jackbox', RT_THEMEURI . '/js/lightbox/css/jackbox.min.css');		 

		wp_enqueue_style('normalize');
 		wp_enqueue_style('theme-framework');
		wp_enqueue_style('fontello');  
		wp_enqueue_style('jackbox');
		wp_enqueue_style('theme-style-all');   
		wp_enqueue_style('jquery-owl-carousel', RT_THEMEURI . '/css/owl.carousel.css'); 	  
		wp_enqueue_style('flex-slider-css', RT_THEMEURI . '/css/flexslider.css');   
		wp_enqueue_style('progression-player', RT_THEMEURI . '/js/video_player/progression-player.css');		   
		wp_enqueue_style('progression-skin-minimal-light', RT_THEMEURI . '/js/video_player/skin-minimal-light.css');		    
		wp_enqueue_style('isotope-css', RT_THEMEURI . '/css/isotope.css');		 
		wp_enqueue_style('jquery-colortip', RT_THEMEURI . '/css/colortip-1.0-jquery.css');
		wp_enqueue_style('animate', RT_THEMEURI . '/css/animate.css');		

 		/* ie fixes */
		wp_register_style('theme-ie7',RT_THEMEURI . '/css/ie7.css');
		$GLOBALS['wp_styles']->add_data( 'theme-ie7', 'conditional', 'IE 7' );
		wp_enqueue_style('theme-ie7');

		wp_register_style('theme-ltie9',RT_THEMEURI . '/css/before_ie9.css');
		$GLOBALS['wp_styles']->add_data( 'theme-ltie9', 'conditional', 'lt IE 9' );
		wp_enqueue_style('theme-ltie9'); 
	}

	#
	# Loading Theme Color Styles
	#
	
	function load_color_styles(){ 
		$style_file = get_option( RT_THEMESLUG."_18_style");
		$style_file  =  ! empty( $style_file ) ? $style_file : "orange";

		wp_register_style('theme-skin',RT_THEMEURI . '/css/'.$style_file.'-style.css'); //skins
		wp_enqueue_style('theme-skin');  
	}

	#
	# Loading WP Main CSS
	#	
	function load_wp_css(){ 
		wp_register_style('theme-style', get_bloginfo( 'stylesheet_url' )); //WP default stylesheet  
		wp_enqueue_style('theme-style'); 
	}

	#
	#  HTML5 SHIV
	# 
	function add_html5_shiv(){ echo '<!--[if lt IE 9]><script src="'.RT_THEMEURI  . '/js/html5shiv.js"></script><![endif]-->';}


	#
	#  IE 9 FILTER
	# 
	function add_ie9_filter(){ echo '<!--[if gte IE 9]> <style type="text/css"> .gradient { filter: none; } </style> <![endif]-->';} 

}


?>