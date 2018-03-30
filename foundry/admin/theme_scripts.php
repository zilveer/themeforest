<?php 

/**
 * Here is all the custom colours for the theme.
 * $handle is a reference to the handle used with wp_enqueue_style()
 */
if(!( function_exists('ebor_less_vars') )){ 
	function ebor_less_vars( $vars, $handle = 'ebor-theme-styles' ) {
		$vars['white']           = get_option('foundry_colour_white', '#fff');
		$vars['green']           = get_option('foundry_colour_green', '#47b475');
		$vars['red']             = get_option('foundry_colour_red', '#e31d3b');
		$vars['color-primary']   = get_option('foundry_colour_primary', '#47b475');
		$vars['bg-secondary']    = get_option('foundry_colour_secondary', '#f8f8f8');
		$vars['bg-dark']         = get_option('foundry_colour_dark', '#292929');
		$vars['darkgrey']        = get_option('foundry_colour_darkgrey', '#ccc');
		$vars['lightgrey']       = get_option('foundry_colour_lightgrey', '#666');
		$vars['lightblack']      = get_option('foundry_colour_lightblack', '#222');
		$vars['body-font']       = get_option('body_font', 'Open Sans');
		$vars['heading-font']    = get_option('heading_font', 'Raleway');
		$vars['logo-height']     = (int) get_option('logo_height','60') . '%';
		
		if( '' == $vars['body-font'] )
			$vars['body-font'] = 'sans-serif';
			
		if( '' == $vars['heading-font'] )
			$vars['heading-font'] = 'sans-serif';
		
	    return $vars;
	}
	add_filter( 'less_vars', 'ebor_less_vars', 10, 2 );
}

/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
if(!( function_exists('ebor_load_scripts') )){
	function ebor_load_scripts() {

		$protocol = is_ssl() ? 'https' : 'http';
		$body_font = get_option('body_font_url', $protocol . '://fonts.googleapis.com/css?family=Open+Sans:400,500,600');
		$heading_font = get_option('heading_font_url', $protocol . '://fonts.googleapis.com/css?family=Raleway:100,400,300,500,600,700');
		
		//Enqueue Fonts
		if( $body_font )
			wp_enqueue_style( 'ebor-body-font', esc_url($body_font) );
			
		if( $heading_font )
			wp_enqueue_style( 'ebor-heading-font', esc_url($heading_font) );
			
		//Enqueue Styles
		wp_enqueue_style( 'ebor-lato-font', $protocol . '://fonts.googleapis.com/css?family=Lato:300,400' );
		wp_enqueue_style( 'ebor-bootstrap', EBOR_THEME_DIRECTORY . 'style/css/bootstrap.css' );
		wp_enqueue_style( 'ebor-plugins', EBOR_THEME_DIRECTORY . 'style/css/plugins.css' );
		wp_enqueue_style( 'ebor-fonts', EBOR_THEME_DIRECTORY . 'style/css/fonts.css' );	
		wp_enqueue_style( 'ebor-theme-styles', EBOR_THEME_DIRECTORY . 'style/css/theme.less' );
		wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
		
		//Enqueue Scripts
		wp_enqueue_script( 'ebor-bootstrap', EBOR_THEME_DIRECTORY . 'style/js/bootstrap.min.js', array('jquery'), false, true  );
		wp_enqueue_script( 'ebor-plugins', EBOR_THEME_DIRECTORY . 'style/js/plugins.js', array('jquery'), false, true  );
		
		if( 'yes' == get_option('foundry_use_parallax', 'yes') ){
			wp_enqueue_script( 'ebor-parallax', EBOR_THEME_DIRECTORY . 'style/js/parallax.js', array('jquery'), false, true  );
		}
		
		wp_enqueue_script( 'ebor-scripts', EBOR_THEME_DIRECTORY . 'style/js/scripts.js', array('jquery'), false, true  );
		
		//Enqueue Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		//Add custom CSS ability
		$nav_height = get_option('nav_height','55');
		
		$custom_css = '
			.nav-bar {
				height: '. $nav_height .'px;
				max-height: '. $nav_height .'px;
				line-height: '. ($nav_height - 2) .'px;	
			}
			.nav-bar > .module.left > a {
				height: '. $nav_height .'px;
			}
			@media all and ( min-width: 992px ){
				.nav-bar .module, .nav-bar .module-group {
					height: '. $nav_height .'px;
				}
			}
			.widget-handle .cart .label {
				top: '. round($nav_height / 6) .'px;
			}
			.module.widget-handle.mobile-toggle {
				line-height: '. ($nav_height - 2) .'px;	
				max-height: '. $nav_height .'px;
			}
			.module-group.right .module.left:first-child {
				padding-right: '. get_option('nav_right_margin','32') .'px;
			}
			.menu > li ul {
				width: '. get_option('dropdown_width','200') .'px;
			}
			.mega-menu > li {
				width: '. get_option('dropdown_width','200') .'px !important;
			}
		';
		
		if( 'no' == get_option('show_breadcrumbs', 'yes') ){
			$custom_css .= '.breadcrumb.breadcrumb-2 { display: none; }';	
		}
		
		$custom_css .= get_option('custom_css');
		wp_add_inline_style( 'ebor-style', $custom_css );
		
		/**
		 * localize script
		 */
		$script_data = array( 
			'nav_height'         => $nav_height,
			'access_token'       => get_option('instagram_token', ''),
			'client_id'          => get_option('instagram_client', ''),
			'hero_animation'     => get_option('hero_animation','fade'),
			'hero_autoplay'      => get_option('hero_autoplay','false'),
			'hero_timer'         => get_option('hero_timer','3000'),
			'all_title'          => get_option('portfolio_all', 'All')
		);
		wp_localize_script( 'ebor-scripts', 'wp_data', $script_data );
	}
	add_action('wp_enqueue_scripts', 'ebor_load_scripts', 110);
}

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * 
 * @since version 1.0
 * @author TommusRhodus
 */
if(!( function_exists('ebor_admin_load_scripts') )){
	function ebor_admin_load_scripts(){
		wp_enqueue_style( 'ebor-theme-admin-css', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.css' );
		wp_enqueue_style( 'ebor-fonts', EBOR_THEME_DIRECTORY . 'style/css/fonts.css' );	
		wp_enqueue_script( 'ebor-theme-admin-js', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.js', array('jquery'), false, true  );
	}
	add_action('admin_enqueue_scripts', 'ebor_admin_load_scripts', 200);
}