<?php
function jx_ievent_scripts() {  

		global $ievent_data;
	
		/*---------------- Register JS Script ------------------------*/		
		
		wp_register_script('ievent-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery','null',true);
		wp_register_script('ievent-respond', get_template_directory_uri() . '/vendor/respond.js', 'jquery','null',true);
		wp_register_script('ievent-appear', get_template_directory_uri() . '/vendor/jquery.appear.js', 'jquery','null',true);
		wp_register_script('ievent-prettyPhoto', get_template_directory_uri() . '/vendor/prettyPhoto/jquery.prettyPhoto.js', 'jquery','null',true);
		wp_register_script('ievent-isotope', get_template_directory_uri() . '/vendor/isotope/jquery.isotope.min.js', 'jquery','null',true);
		wp_register_script('ievent-flexslider', get_template_directory_uri() . '/vendor/flexslider/jquery.flexslider.js', 'jquery','null',true);
		wp_register_script('ievent-maginfic-popup', get_template_directory_uri() . '/vendor/magnific-popup/jquery.magnific-popup.min.js', 'jquery','null',true);
		wp_register_script('ievent-validate', get_template_directory_uri() . '/vendor/jquery.validate.js', 'jquery','null',true);		
		wp_register_script('ievent-modernizr', get_template_directory_uri() . '/vendor/modernizr.js', 'jquery','null',false);
		wp_register_script('ievent-plugins', get_template_directory_uri() . '/js/plugins.js', 'jquery','null',true);
		wp_register_script('ievent-theme', get_template_directory_uri() . '/js/theme.js', 'jquery','null',true);
		wp_register_script('ievent-form-validator', get_template_directory_uri() . '/vendor/form-validator/jquery.form-validator.min.js', 'jquery','null',true);
		wp_enqueue_script('google-maps','https://maps.googleapis.com/maps/api/js?key='.$ievent_data['google_map_key'].'', array(), null, false);	
		wp_register_script('ievent-google-recaptcha','https://www.google.com/recaptcha/api.js', array(), null, false);		


			
		/*---------------- Enqueue JS Script ------------------------*/
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('ievent-jquery-form');
		wp_enqueue_script('ievent-bootstrap');		
		wp_enqueue_script('ievent-respond');
		wp_enqueue_script('ievent-appear');
		wp_enqueue_script('ievent-prettyPhoto');
		wp_enqueue_script('ievent-isotope');
		wp_enqueue_script('ievent-flexslider');
		wp_enqueue_script('ievent-maginfic-popup');
		wp_enqueue_script('ievent-validate');	
		wp_enqueue_script('ievent-modernizr');
		wp_enqueue_script('ievent-google-maps');
		wp_enqueue_script('ievent-google-recaptcha');
		wp_enqueue_script('ievent-plugins');
		wp_enqueue_script('ievent-form-validator');
		wp_enqueue_script('ievent-theme');
			
		
		$ajaxurl = admin_url('admin-ajax.php');
		$ajax_nonce = wp_create_nonce('MailChimp');
		wp_localize_script( 'jquery-core', 'ajaxVars', array( 'ajaxurl' => $ajaxurl, 'ajax_nonce' => $ajax_nonce ) );
		
		if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    	}
		
}
function jx_ievent_styles()  
{  
	global $ievent_data;
	$theme_color=$ievent_data['theme_color'];
	$theme_base_color=esc_attr($ievent_data['theme_base_color']);
	
	/*---------------- Register CSS Styles ------------------------*/
	wp_register_style( 'ievent-skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1', 'all' );
	wp_register_style( 'ievent-dynamic', get_template_directory_uri() . '/css/dynamic_ievent.css', array(), '1', 'all' );
	wp_register_style( 'ievent-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css', array(), '1', 'all' );
	wp_register_style( 'ievent-theme-animate', get_template_directory_uri() . '/css/theme-animate.css', array(), '1', 'all' );
	wp_register_style( 'ievent-theme-elements', get_template_directory_uri() . '/css/theme-elements.css', array(), '1', 'all' );
	wp_register_style( 'ievent-theme-responsive', get_template_directory_uri() . '/css/theme-responsive.css', array(), '1', 'all' );
	wp_register_style( 'ievent-plugins', get_template_directory_uri() . '/css/plugins.css', array(), '1', 'all' );
	wp_register_style( 'ievent-magnific-popup', get_template_directory_uri() . '/vendor/magnific-popup/magnific-popup.css', array(), '1', 'all' );
	wp_register_style( 'ievent-flexslider', get_template_directory_uri() . '/vendor/flexslider/flexslider.css', array(), '1', 'all' );
	wp_register_style( 'ievent-prettyPhoto', get_template_directory_uri() . '/vendor/prettyPhoto/prettyPhoto.css', array(), '1', 'all' );
	wp_register_style( 'ievent-vc-style', get_template_directory_uri() . '/css/vc_style.css', array(), '1', 'all' );

	//Default Skin
	
	
	/*---------------- Enqueue CSS Styles ------------------------*/
	wp_enqueue_style( 'ievent-skeleton');	
	wp_enqueue_style( 'ievent-font-awesome' );
	wp_enqueue_style( 'ievent-theme-elements' );
	wp_enqueue_style( 'ievent-theme-responsive' ); 
	wp_enqueue_style( 'ievent-plugins' ); 
	wp_enqueue_style( 'ievent-magnific-popup' );	
	wp_enqueue_style( 'ievent-flexslider' );
	wp_enqueue_style( 'ievent-prettyPhoto' );
	wp_enqueue_style( 'ievent-vc-style' );
	
		
	//Default Skin
	if (($theme_color && $theme_color!="#EE163A") or ($theme_base_color && $theme_base_color!="#333") ):
		wp_enqueue_style( 'ieven-dynamic', get_template_directory_uri() . '/css/dynamic_ievent.css', array(), '1', 'all' );
	
	else:
		 wp_register_style( 'ievent-skin', get_template_directory_uri() . '/css/skins/pink.css', array(), '1', 'all' );
	endif;
	
	
	if (!wp_is_mobile()):
	wp_enqueue_style( 'theme-animate' );
	endif;
	
	function ie_style_sheets () {
	wp_register_style( 'ie8', get_template_directory_uri() . '/css/ie.css'  );
	$GLOBALS['wp_styles']->add_data( 'ie8', 'conditional', 'lte IE 9' );
	
	wp_register_style( 'ie6', get_template_directory_uri() . '/css/ie-6.css'  );
	$GLOBALS['wp_styles']->add_data( 'ie6', 'conditional', 'lt IE 7' );
	
	wp_register_style( 'ie7', get_template_directory_uri() . '/css/ie-7.css'  );
	$GLOBALS['wp_styles']->add_data( 'ie7', 'conditional', 'IE 7' );
	
	wp_register_style( 'ie8', get_template_directory_uri() . '/css/ie-8.css'  );
	$GLOBALS['wp_styles']->add_data( 'ie8', 'conditional', 'IE 8' );
	
	wp_enqueue_style( 'ie8' );
	wp_enqueue_style( 'ie7' );
	wp_enqueue_style( 'ie6' );
	}
	
	add_action ('wp_enqueue_scripts','ie_style_sheets');
	
		
	// Main Stylesheet
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' ); 

	
}  
add_action( 'wp_enqueue_scripts', 'jx_ievent_styles', 1 ); 
add_action( 'wp_enqueue_scripts', 'jx_ievent_scripts' );  

	//----------------------------------------------------------------------------
	//-----------Admin Colorpicker 
	//----------------------------------------------------------------------------
	add_action( 'admin_enqueue_scripts', 'jx_enqueue_color_picker' );
	function jx_enqueue_color_picker( $hook_suffix ) {
		// first check that $hook_suffix is appropriate for your admin page		
    	wp_enqueue_script( 'walker-menu', get_template_directory_uri().'/inc/menu-walker/walker_menu.js', false, true );
		wp_enqueue_style( 'walker-menu', get_template_directory_uri().'/inc/menu-walker/walker_menu.css', false, true );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css', array(), '1', 'all' );
		
	}	


add_action( 'init', 'jx_add_editor_styles' );
function jx_add_editor_styles() {
    add_editor_style( get_stylesheet_uri() );
}


?>