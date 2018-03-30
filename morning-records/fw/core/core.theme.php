<?php
/**
 * Morning records Framework: Theme specific actions
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_core_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_core_theme_setup', 11 );
	function morning_records_core_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		
		// Custom header setup
		add_theme_support( 'custom-header', array('header-text'=>false));
		
		// Custom backgrounds setup
		add_theme_support( 'custom-background');
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add user menu
		add_theme_support('nav-menus');
		
		// WooCommerce Support
		add_theme_support( 'woocommerce' );
		
		// Editor custom stylesheet - for user
		add_editor_style(morning_records_get_file_url('css/editor-style.css'));	
		
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		load_theme_textdomain( 'morning-records', morning_records_get_folder_dir('languages') );


		/* Front and Admin actions and filters:
		------------------------------------------------------------------------ */

		if ( !is_admin() ) {
			
			/* Front actions and filters:
			------------------------------------------------------------------------ */
	
			// Filters wp_title to print a neat <title> tag based on what is being viewed
			if (floatval(get_bloginfo('version')) < "4.1") {
				add_action('wp_head',						'morning_records_wp_title_show');
				add_filter('wp_title',						'morning_records_wp_title_modify', 10, 2);
			}

			// Add main menu classes
			//add_filter('wp_nav_menu_objects', 			'morning_records_add_mainmenu_classes', 10, 2);
	
			// Prepare logo text
			add_filter('morning_records_filter_prepare_logo_text',	'morning_records_prepare_logo_text', 10, 1);
	
			// Add class "widget_number_#' for each widget
			add_filter('dynamic_sidebar_params', 			'morning_records_add_widget_number', 10, 1);
	
			// Enqueue scripts and styles
			add_action('wp_enqueue_scripts', 				'morning_records_core_frontend_scripts');
			add_action('wp_footer',		 					'morning_records_core_frontend_scripts_inline');
			add_action('morning_records_action_add_scripts_inline','morning_records_core_add_scripts_inline');

			// Prepare theme core global variables
			add_action('morning_records_action_prepare_globals',	'morning_records_core_prepare_globals');
		}

		// Frontend editor: Save post data
		add_action('wp_ajax_frontend_editor_save',		'morning_records_callback_frontend_editor_save');
		add_action('wp_ajax_nopriv_frontend_editor_save', 'morning_records_callback_frontend_editor_save');

		// Frontend editor: Delete post
		add_action('wp_ajax_frontend_editor_delete', 	'morning_records_callback_frontend_editor_delete');
		add_action('wp_ajax_nopriv_frontend_editor_delete', 'morning_records_callback_frontend_editor_delete');

		// Register theme specific nav menus
		morning_records_register_theme_menus();

		// Register theme specific sidebars
		morning_records_register_theme_sidebars();
	}
}




/* Theme init
------------------------------------------------------------------------ */

// Init theme template
function morning_records_core_init_theme() {
	if (morning_records_storage_get('theme_inited')===true) return;
	morning_records_storage_set('theme_inited', true);

	if (!is_admin()) morning_records_profiler_add_point(esc_html__('After WP INIT actions', 'morning-records'), false);

	// Load custom options from GET and post/page/cat options
	if (isset($_GET['set']) && $_GET['set']==1) {
		foreach ($_GET as $k=>$v) {
			if (morning_records_get_theme_option($k, null) !== null) {
				setcookie($k, $v, 0, '/');
				$_COOKIE[$k] = $v;
			}
		}
	}

	// Get custom options from current category / page / post / shop / event
	morning_records_load_custom_options();

	// Load skin
	$skin = morning_records_esc(morning_records_get_custom_option('theme_skin'));
	morning_records_storage_set('theme_skin', $skin);
	if ( file_exists(morning_records_get_file_dir('skins/'.($skin).'/skin.php')) ) {
		get_template_part(morning_records_get_file_slug('skins/'.($skin).'/skin.php'));
	}

	// Fire init theme actions (after skin and custom options are loaded)
	do_action('morning_records_action_init_theme');

	// Prepare theme core global variables
	do_action('morning_records_action_prepare_globals');

	// Fire after init theme actions
	do_action('morning_records_action_after_init_theme');
	morning_records_profiler_add_point(esc_html__('After Theme Init', 'morning-records'));
}


// Prepare theme global variables
if ( !function_exists( 'morning_records_core_prepare_globals' ) ) {
	function morning_records_core_prepare_globals() {
		if (!is_admin()) {
			// Logo text and slogan
			morning_records_storage_set('logo_text', apply_filters('morning_records_filter_prepare_logo_text', morning_records_get_custom_option('logo_text')));
			morning_records_storage_set('logo_slogan', get_bloginfo('description'));
			
			// Logo image and icons from skin
			$logo        = morning_records_get_logo_icon('logo');
			$logo_side   = morning_records_get_logo_icon('logo_side');
			$logo_fixed  = morning_records_get_logo_icon('logo_fixed');
			$logo_footer = morning_records_get_logo_icon('logo_footer');
			morning_records_storage_set('logo', $logo);
			morning_records_storage_set('logo_icon',   morning_records_get_logo_icon('logo_icon'));
			morning_records_storage_set('logo_side',   $logo_side   ? $logo_side   : $logo);
			morning_records_storage_set('logo_fixed',  $logo_fixed  ? $logo_fixed  : $logo);
			morning_records_storage_set('logo_footer', $logo_footer ? $logo_footer : $logo);
	
			$shop_mode = '';
			if (morning_records_get_custom_option('show_mode_buttons')=='yes')
				$shop_mode = morning_records_get_value_gpc('morning_records_shop_mode');
			if (empty($shop_mode))
				$shop_mode = morning_records_get_custom_option('shop_mode', '');
			if (empty($shop_mode) || !is_archive())
				$shop_mode = 'thumbs';
			morning_records_storage_set('shop_mode', $shop_mode);
		}
	}
}


// Return url for the uploaded logo image or (if not uploaded) - to image from skin folder
if ( !function_exists( 'morning_records_get_logo_icon' ) ) {
	function morning_records_get_logo_icon($slug) {
		$mult = morning_records_get_retina_multiplier();
		$logo_icon = '';
		if ($mult > 1) 			$logo_icon = morning_records_get_custom_option($slug.'_retina');
		if (empty($logo_icon))	$logo_icon = morning_records_get_custom_option($slug);
		return $logo_icon;
	}
}


// Display logo image with text and slogan (if specified)
if ( !function_exists( 'morning_records_show_logo' ) ) {
	function morning_records_show_logo($logo_main=true, $logo_fixed=false, $logo_footer=false, $logo_side=false, $logo_text=true, $logo_slogan=true) {
		if ($logo_main===true)		$logo_main   = morning_records_storage_get('logo');
		if ($logo_fixed===true)		$logo_fixed  = morning_records_storage_get('logo_fixed');
		if ($logo_footer===true)	$logo_footer = morning_records_storage_get('logo_footer');
		if ($logo_side===true)		$logo_side   = morning_records_storage_get('logo_side');
		if ($logo_text===true)		$logo_text   = morning_records_storage_get('logo_text');
		if ($logo_slogan===true)	$logo_slogan = morning_records_storage_get('logo_slogan');
		if ($logo_main || $logo_fixed || $logo_footer || $logo_side || $logo_text) {
		?>
		<div class="logo">
			<a href="<?php echo esc_url(home_url('/')); ?>"><?php
				if (!empty($logo_main)) {
					$attr = morning_records_getimagesize($logo_main);
					echo '<img src="'.esc_url($logo_main).'" class="logo_main" alt=""'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				if (!empty($logo_fixed)) {
					$attr = morning_records_getimagesize($logo_fixed);
					echo '<img src="'.esc_url($logo_fixed).'" class="logo_fixed" alt=""'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				if (!empty($logo_footer)) {
					$attr = morning_records_getimagesize($logo_footer);
					echo '<img src="'.esc_url($logo_footer).'" class="logo_footer" alt=""'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				if (!empty($logo_side)) {
					$attr = morning_records_getimagesize($logo_side);
					echo '<img src="'.esc_url($logo_side).'" class="logo_side" alt=""'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				echo !empty($logo_text) ? '<div class="logo_text">'.trim($logo_text).'</div>' : '';
				echo !empty($logo_slogan) ? '<br><div class="logo_slogan">' . esc_html($logo_slogan) . '</div>' : '';
			?></a>
		</div>
		<?php 
		}
	} 
}


// Add menu locations
if ( !function_exists( 'morning_records_register_theme_menus' ) ) {
	function morning_records_register_theme_menus() {
		register_nav_menus(apply_filters('morning_records_filter_add_theme_menus', array(
			'menu_main'		=> esc_html__('Main Menu', 'morning-records'),
			'menu_user'		=> esc_html__('User Menu', 'morning-records'),
			'menu_footer'	=> esc_html__('Footer Menu', 'morning-records'),
			'menu_side'		=> esc_html__('Side Menu', 'morning-records')
		)));
	}
}


// Register widgetized area
if ( !function_exists( 'morning_records_register_theme_sidebars' ) ) {
	function morning_records_register_theme_sidebars($sidebars=array()) {
		if (!is_array($sidebars)) $sidebars = array();
		// Custom sidebars
		$custom = morning_records_get_theme_option('custom_sidebars');
		if (is_array($custom) && count($custom) > 0) {
			foreach ($custom as $i => $sb) {
				if (trim(chop($sb))=='') continue;
				$sidebars['sidebar_custom_'.($i)]  = $sb;
			}
		}
		$sidebars = apply_filters( 'morning_records_filter_add_theme_sidebars', $sidebars );
		morning_records_storage_set('registered_sidebars', $sidebars);
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$name) {
				register_sidebar( array_merge( array(
													'name'          => $name,
													'id'            => $id
												),
												morning_records_storage_get('widgets_args')
									)
				);
			}
		}
	}
}





/* Front actions and filters:
------------------------------------------------------------------------ */

//  Enqueue scripts and styles
if ( !function_exists( 'morning_records_core_frontend_scripts' ) ) {
	function morning_records_core_frontend_scripts() {
		
		// Modernizr will load in head before other scripts and styles
		// Use older version (from photostack)
		morning_records_enqueue_script( 'morning_records-core-modernizr-script', morning_records_get_file_url('js/photostack/modernizr.min.js'), array(), null, false );
		
		// Enqueue styles
		//-----------------------------------------------------------------------------------------------------
		
		// Prepare custom fonts
		$fonts = morning_records_get_list_fonts(false);
		$theme_fonts = array();
		$custom_fonts = morning_records_get_custom_fonts();
		if (is_array($custom_fonts) && count($custom_fonts) > 0) {
			foreach ($custom_fonts as $s=>$f) {
				if (!empty($f['font-family']) && !morning_records_is_inherit_option($f['font-family'])) $theme_fonts[$f['font-family']] = 1;
			}
		}
		// Prepare current skin fonts
		$theme_fonts = apply_filters('morning_records_filter_used_fonts', $theme_fonts);
		// Link to selected fonts
		if (is_array($theme_fonts) && count($theme_fonts) > 0) {
			$google_fonts = '';
			foreach ($theme_fonts as $font=>$v) {
				if (isset($fonts[$font])) {
					$font_name = ($pos=morning_records_strpos($font,' ('))!==false ? morning_records_substr($font, 0, $pos) : $font;
					if (!empty($fonts[$font]['css'])) {
						$css = $fonts[$font]['css'];
						morning_records_enqueue_style( 'morning_records-font-'.str_replace(' ', '-', $font_name).'-style', $css, array(), null );
					} else {
						$google_fonts .= ($google_fonts ? '%7C' : '')
							. (!empty($fonts[$font]['link']) ? $fonts[$font]['link'] : str_replace(' ', '+', $font_name).':300,300italic,400,400italic,600,600italic,700,700italic');
					}
				}
			}
			if ($google_fonts)
				morning_records_enqueue_style( 'morning_records-font-google_fonts-style', morning_records_get_protocol() . '://fonts.googleapis.com/css?family=' . $google_fonts . '&subset=' . morning_records_get_theme_option('fonts_subset'), array(), null );
		}
		
		// Fontello styles must be loaded before main stylesheet
		morning_records_enqueue_style( 'morning_records-fontello-style',  morning_records_get_file_url('css/fontello/css/fontello.css'),  array(), null);
		//morning_records_enqueue_style( 'morning_records-fontello-animation-style', morning_records_get_file_url('css/fontello/css/animation.css'), array(), null);

		// Main stylesheet
		morning_records_enqueue_style( 'morning_records-main-style', get_stylesheet_uri(), array(), null );
		
		// Animations
		if (morning_records_get_theme_option('css_animation')=='yes' && (morning_records_get_theme_option('animation_on_mobile')=='yes' || !wp_is_mobile()) && !morning_records_vc_is_frontend())
			morning_records_enqueue_style( 'morning_records-animation-style',	morning_records_get_file_url('css/core.animation.css'), array(), null );

		// Theme skin stylesheet
		do_action('morning_records_action_add_styles');
		
		// Theme customizer stylesheet and inline styles
		morning_records_enqueue_custom_styles();

		// Responsive
		if (morning_records_get_theme_option('responsive_layouts') == 'yes') {
			$suffix = morning_records_param_is_off(morning_records_get_custom_option('show_sidebar_outer')) ? '' : '-outer';
			morning_records_enqueue_style( 'morning_records-responsive-style', morning_records_get_file_url('css/responsive'.($suffix).'.css'), array(), null );
			do_action('morning_records_action_add_responsive');
			if (morning_records_get_custom_option('theme_skin')!='') {
				$css = apply_filters('morning_records_filter_add_responsive_inline', '');
				if (!empty($css)) wp_add_inline_style( 'morning_records-responsive-style', $css );
			}
		}

		// Disable loading JQuery UI CSS
		//global $wp_styles, $wp_scripts;
		//$wp_styles->done[]	= 'jquery-ui';
		//$wp_styles->done[]	= 'date-picker-css';
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//----------------------------------------------------------------------------------------------------------------------------
		
		// Load separate theme scripts
		morning_records_enqueue_script( 'superfish', morning_records_get_file_url('js/superfish.js'), array('jquery'), null, true );
		if (morning_records_get_theme_option('menu_slider')=='yes') {
			morning_records_enqueue_script( 'morning_records-slidemenu-script', morning_records_get_file_url('js/jquery.slidemenu.js'), array('jquery'), null, true );
			//morning_records_enqueue_script( 'morning_records-jquery-easing-script', morning_records_get_file_url('js/jquery.easing.js'), array('jquery'), null, true );
		}

		if ( is_single() && morning_records_get_custom_option('show_reviews')=='yes' ) {
			morning_records_enqueue_script( 'morning_records-core-reviews-script', morning_records_get_file_url('js/core.reviews.js'), array('jquery'), null, true );
		}

		morning_records_enqueue_script( 'morning_records-core-utils-script',	morning_records_get_file_url('js/core.utils.js'), array('jquery'), null, true );
		morning_records_enqueue_script( 'morning_records-core-init-script',	morning_records_get_file_url('js/core.init.js'), array('jquery'), null, true );	
		morning_records_enqueue_script( 'morning_records-theme-init-script',	morning_records_get_file_url('js/theme.init.js'), array('jquery'), null, true );	

		// Media elements library	
		if (morning_records_get_theme_option('use_mediaelement')=='yes') {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		} else {
			wp_deregister_style('mediaelement');
			wp_deregister_style('wp-mediaelement');
		}
		
		// Video background
		if (morning_records_get_custom_option('show_video_bg') == 'yes' && morning_records_get_custom_option('video_bg_youtube_code') != '') {
			morning_records_enqueue_script( 'morning_records-video-bg-script', morning_records_get_file_url('js/jquery.tubular.1.0.js'), array('jquery'), null, true );
		}

		// Google map
		if ( morning_records_get_custom_option('show_googlemap')=='yes' ) {
            $api_key = morning_records_get_theme_option('api_google');
            morning_records_enqueue_script( 'googlemap', morning_records_get_protocol().'://maps.google.com/maps/api/js'.($api_key ? '?key='.$api_key : ''), array(), null, true );
			morning_records_enqueue_script( 'morning_records-googlemap-script', morning_records_get_file_url('js/core.googlemap.js'), array(), null, true );
		}

			
		// Social share buttons
		if (is_singular() && !morning_records_storage_get('blog_streampage') && morning_records_get_custom_option('show_share')!='hide') {
			morning_records_enqueue_script( 'morning_records-social-share-script', morning_records_get_file_url('js/social/social-share.js'), array('jquery'), null, true );
		}

		// Comments
		if ( is_singular() && !morning_records_storage_get('blog_streampage') && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply', false, array(), null, true );
		}

		// Custom panel
		if (morning_records_get_theme_option('show_theme_customizer') == 'yes') {
			if (file_exists(morning_records_get_file_dir('core/core.customizer/front.customizer.css')))
				morning_records_enqueue_style(  'morning_records-customizer-style',  morning_records_get_file_url('core/core.customizer/front.customizer.css'), array(), null );
			if (file_exists(morning_records_get_file_dir('core/core.customizer/front.customizer.js')))
				morning_records_enqueue_script( 'morning_records-customizer-script', morning_records_get_file_url('core/core.customizer/front.customizer.js'), array(), null, true );	
		}
		
		//Debug utils
		if (morning_records_get_theme_option('debug_mode')=='yes') {
			morning_records_enqueue_script( 'morning_records-core-debug-script', morning_records_get_file_url('js/core.debug.js'), array(), null, true );
		}

		// Theme skin script
		do_action('morning_records_action_add_scripts');
	}
}

//  Enqueue Swiper Slider scripts and styles
if ( !function_exists( 'morning_records_enqueue_slider' ) ) {
	function morning_records_enqueue_slider($engine='all') {
		if ($engine=='all' || $engine=='swiper') {
			morning_records_enqueue_style(  'morning_records-swiperslider-style', 			morning_records_get_file_url('js/swiper/swiper.css'), array(), null );
			morning_records_enqueue_script( 'morning_records-swiperslider-script', 			morning_records_get_file_url('js/swiper/swiper.js'), array(), null, true );
			// jQuery version conflict with Revolution Slider
			//morning_records_enqueue_script( 'morning_records-swiperslider-script', 			morning_records_get_file_url('js/swiper/swiper.jquery.js'), array(), null, true );
		}
	}
}

//  Enqueue Photostack gallery
if ( !function_exists( 'morning_records_enqueue_polaroid' ) ) {
	function morning_records_enqueue_polaroid() {
		morning_records_enqueue_style(  'morning_records-polaroid-style', 	morning_records_get_file_url('js/photostack/component.css'), array(), null );
		morning_records_enqueue_script( 'morning_records-classie-script',		morning_records_get_file_url('js/photostack/classie.js'), array(), null, true );
		morning_records_enqueue_script( 'morning_records-polaroid-script',	morning_records_get_file_url('js/photostack/photostack.js'), array(), null, true );
	}
}

//  Enqueue Messages scripts and styles
if ( !function_exists( 'morning_records_enqueue_messages' ) ) {
	function morning_records_enqueue_messages() {
		morning_records_enqueue_style(  'morning_records-messages-style',		morning_records_get_file_url('js/core.messages/core.messages.css'), array(), null );
		morning_records_enqueue_script( 'morning_records-messages-script',	morning_records_get_file_url('js/core.messages/core.messages.js'),  array('jquery'), null, true );
	}
}

//  Enqueue Portfolio hover scripts and styles
if ( !function_exists( 'morning_records_enqueue_portfolio' ) ) {
	function morning_records_enqueue_portfolio($hover='') {
		morning_records_enqueue_style( 'morning_records-portfolio-style',  morning_records_get_file_url('css/core.portfolio.css'), array(), null );
		if (morning_records_strpos($hover, 'effect_dir')!==false)
			morning_records_enqueue_script( 'hoverdir', morning_records_get_file_url('js/hover/jquery.hoverdir.js'), array(), null, true );
	}
}

//  Enqueue Charts and Diagrams scripts and styles
if ( !function_exists( 'morning_records_enqueue_diagram' ) ) {
	function morning_records_enqueue_diagram($type='all') {
		if ($type=='all' || $type=='pie') morning_records_enqueue_script( 'morning_records-diagram-chart-script',	morning_records_get_file_url('js/diagram/chart.min.js'), array(), null, true );
		if ($type=='all' || $type=='arc') morning_records_enqueue_script( 'morning_records-diagram-raphael-script',	morning_records_get_file_url('js/diagram/diagram.raphael.min.js'), array(), 'no-compose', true );
	}
}

// Enqueue Theme Popup scripts and styles
// Link must have attribute: data-rel="popup" or data-rel="popup[gallery]"
if ( !function_exists( 'morning_records_enqueue_popup' ) ) {
	function morning_records_enqueue_popup($engine='') {
		if ($engine=='pretty' || (empty($engine) && morning_records_get_theme_option('popup_engine')=='pretty')) {
			morning_records_enqueue_style(  'morning_records-prettyphoto-style',	morning_records_get_file_url('js/prettyphoto/css/prettyPhoto.css'), array(), null );
			morning_records_enqueue_script( 'morning_records-prettyphoto-script',	morning_records_get_file_url('js/prettyphoto/jquery.prettyPhoto.min.js'), array('jquery'), 'no-compose', true );
		} else if ($engine=='magnific' || (empty($engine) && morning_records_get_theme_option('popup_engine')=='magnific')) {
			morning_records_enqueue_style(  'morning_records-magnific-style',	morning_records_get_file_url('js/magnific/magnific-popup.css'), array(), null );
			morning_records_enqueue_script( 'morning_records-magnific-script',morning_records_get_file_url('js/magnific/jquery.magnific-popup.min.js'), array('jquery'), '', true );
		} else if ($engine=='internal' || (empty($engine) && morning_records_get_theme_option('popup_engine')=='internal')) {
			morning_records_enqueue_messages();
		}
	}
}

//  Add inline scripts in the footer hook
if ( !function_exists( 'morning_records_core_frontend_scripts_inline' ) ) {
	//add_action('wp_footer', 'morning_records_core_frontend_scripts_inline');
	function morning_records_core_frontend_scripts_inline() {
		add_filter('style_loader_tag', 'morning_records_core_add_property_to_link', 10, 3);
		do_action('morning_records_action_add_scripts_inline');
	}
}

//  Add property="stylesheet" into all tags <link> in the footer
if (!function_exists('morning_records_core_add_property_to_link')) {
	//add_filter('style_loader_tag', 'morning_records_core_add_property_to_link', 10, 3);
	function morning_records_core_add_property_to_link($link, $handle='', $href='') {
		return str_replace('<link ', '<link property="stylesheet" ', $link);
	}
}

//  Add inline scripts in the footer
if (!function_exists('morning_records_core_add_scripts_inline')) {
	function morning_records_core_add_scripts_inline() {

		$msg = morning_records_get_system_message(true); 
		if (!empty($msg['message'])) morning_records_enqueue_messages();

		echo "<script type=\"text/javascript\">"
			
			. "if (typeof MORNING_RECORDS_STORAGE == 'undefined') var MORNING_RECORDS_STORAGE = {};"
			
			// AJAX parameters
			. "MORNING_RECORDS_STORAGE['ajax_url']			 = '" . esc_url(admin_url('admin-ajax.php')) . "';"
			. "MORNING_RECORDS_STORAGE['ajax_nonce']		 = '" . esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))) . "';"
			
			// Site base url
			. "MORNING_RECORDS_STORAGE['site_url']			= '" . get_site_url() . "';"
			
			// VC frontend edit mode
			. "MORNING_RECORDS_STORAGE['vc_edit_mode']		= " . (function_exists('morning_records_vc_is_frontend') && morning_records_vc_is_frontend() ? 'true' : 'false') . ";"
			
			// Theme base font
			. "MORNING_RECORDS_STORAGE['theme_font']		= '" . morning_records_get_custom_font_settings('p', 'font-family') . "';"
			
			// Theme skin
			. "MORNING_RECORDS_STORAGE['theme_skin']			= '" . esc_attr(morning_records_get_custom_option('theme_skin')) . "';"
			. "MORNING_RECORDS_STORAGE['theme_skin_color']		= '" . morning_records_get_scheme_color('text_dark') . "';"
			. "MORNING_RECORDS_STORAGE['theme_skin_bg_color']	= '" . morning_records_get_scheme_color('bg_color') . "';"
			
			// Slider height
			. "MORNING_RECORDS_STORAGE['slider_height']	= " . max(100, morning_records_get_custom_option('slider_height')) . ";"
			
			// System message
			. "MORNING_RECORDS_STORAGE['system_message']	= {"
				. "message: '" . addslashes($msg['message']) . "',"
				. "status: '"  . addslashes($msg['status'])  . "',"
				. "header: '"  . addslashes($msg['header'])  . "'"
				. "};"
			
			// User logged in
			. "MORNING_RECORDS_STORAGE['user_logged_in']	= " . (is_user_logged_in() ? 'true' : 'false') . ";"
			
			// Show table of content for the current page
			. "MORNING_RECORDS_STORAGE['toc_menu']		= '" . esc_attr(morning_records_get_custom_option('menu_toc')) . "';"
			. "MORNING_RECORDS_STORAGE['toc_menu_home']	= " . (morning_records_get_custom_option('menu_toc')!='hide' && morning_records_get_custom_option('menu_toc_home')=='yes' ? 'true' : 'false') . ";"
			. "MORNING_RECORDS_STORAGE['toc_menu_top']	= " . (morning_records_get_custom_option('menu_toc')!='hide' && morning_records_get_custom_option('menu_toc_top')=='yes' ? 'true' : 'false') . ";"
			
			// Fix main menu
			. "MORNING_RECORDS_STORAGE['menu_fixed']		= " . (morning_records_get_theme_option('menu_attachment')=='fixed' ? 'true' : 'false') . ";"
			
			// Use responsive version for main menu
			. "MORNING_RECORDS_STORAGE['menu_mobile']	= " . (morning_records_get_theme_option('responsive_layouts') == 'yes' ? max(0, (int) morning_records_get_theme_option('menu_mobile')) : 0) . ";"
			. "MORNING_RECORDS_STORAGE['menu_slider']     = " . (morning_records_get_theme_option('menu_slider')=='yes' ? 'true' : 'false') . ";"
			
			// Menu cache is used
			. "MORNING_RECORDS_STORAGE['menu_cache']	= " . (morning_records_get_theme_option('use_menu_cache')=='yes' ? 'true' : 'false') . ";"

			// Right panel demo timer
			. "MORNING_RECORDS_STORAGE['demo_time']		= " . (morning_records_get_theme_option('show_theme_customizer')=='yes' ? max(0, (int) morning_records_get_theme_option('customizer_demo')) : 0) . ";"

			// Video and Audio tag wrapper
			. "MORNING_RECORDS_STORAGE['media_elements_enabled'] = " . (morning_records_get_theme_option('use_mediaelement')=='yes' ? 'true' : 'false') . ";"
			
			// Use AJAX search
			. "MORNING_RECORDS_STORAGE['ajax_search_enabled'] 	= " . (morning_records_get_theme_option('use_ajax_search')=='yes' ? 'true' : 'false') . ";"
			. "MORNING_RECORDS_STORAGE['ajax_search_min_length']	= " . min(3, morning_records_get_theme_option('ajax_search_min_length')) . ";"
			. "MORNING_RECORDS_STORAGE['ajax_search_delay']		= " . min(200, max(1000, morning_records_get_theme_option('ajax_search_delay'))) . ";"

			// Use CSS animation
			. "MORNING_RECORDS_STORAGE['css_animation']      = " . (morning_records_get_theme_option('css_animation')=='yes' ? 'true' : 'false') . ";"
			. "MORNING_RECORDS_STORAGE['menu_animation_in']  = '" . esc_attr(morning_records_get_theme_option('menu_animation_in')) . "';"
			. "MORNING_RECORDS_STORAGE['menu_animation_out'] = '" . esc_attr(morning_records_get_theme_option('menu_animation_out')) . "';"

			// Popup windows engine
			. "MORNING_RECORDS_STORAGE['popup_engine']	= '" . esc_attr(morning_records_get_theme_option('popup_engine')) . "';"

			// E-mail mask
			. "MORNING_RECORDS_STORAGE['email_mask']		= '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$';"
			
			// Messages max length
			. "MORNING_RECORDS_STORAGE['contacts_maxlength']	= " . intval(morning_records_get_theme_option('message_maxlength_contacts')) . ";"
			. "MORNING_RECORDS_STORAGE['comments_maxlength']	= " . intval(morning_records_get_theme_option('message_maxlength_comments')) . ";"

			// Remember visitors settings
			. "MORNING_RECORDS_STORAGE['remember_visitors_settings']	= " . (morning_records_get_theme_option('remember_visitors_settings')=='yes' ? 'true' : 'false') . ";"

			// Internal vars - do not change it!
			// Flag for review mechanism
			. "MORNING_RECORDS_STORAGE['admin_mode']			= false;"
			// Max scale factor for the portfolio and other isotope elements before relayout
			. "MORNING_RECORDS_STORAGE['isotope_resize_delta']	= 0.3;"
			// jQuery object for the message box in the form
			. "MORNING_RECORDS_STORAGE['error_message_box']	= null;"
			// Waiting for the viewmore results
			. "MORNING_RECORDS_STORAGE['viewmore_busy']		= false;"
			. "MORNING_RECORDS_STORAGE['video_resize_inited']	= false;"
			. "MORNING_RECORDS_STORAGE['top_panel_height']		= 0;"
			
			. "</script>";
	}
}


//  Enqueue Custom styles (main Theme options settings)
if ( !function_exists( 'morning_records_enqueue_custom_styles' ) ) {
	function morning_records_enqueue_custom_styles() {
		// Custom stylesheet
		$custom_css = '';	//morning_records_get_custom_option('custom_stylesheet_url');
		morning_records_enqueue_style( 'morning_records-custom-style', $custom_css ? $custom_css : morning_records_get_file_url('css/custom-style.css'), array(), null );
		// Custom inline styles
		wp_add_inline_style( 'morning_records-custom-style', morning_records_prepare_custom_styles() );
	}
}

// Add class "widget_number_#' for each widget
if ( !function_exists( 'morning_records_add_widget_number' ) ) {
	//add_filter('dynamic_sidebar_params', 'morning_records_add_widget_number', 10, 1);
	function morning_records_add_widget_number($prm) {
		if (is_admin()) return $prm;
		static $num=0, $last_sidebar='', $last_sidebar_id='', $last_sidebar_columns=0, $last_sidebar_count=0, $sidebars_widgets=array();
		$cur_sidebar = morning_records_storage_get('current_sidebar');
		if (empty($cur_sidebar)) $cur_sidebar = 'undefined';
		if (count($sidebars_widgets) == 0)
			$sidebars_widgets = wp_get_sidebars_widgets();
		if ($last_sidebar != $cur_sidebar) {
			$num = 0;
			$last_sidebar = $cur_sidebar;
			$last_sidebar_id = $prm[0]['id'];
			$last_sidebar_columns = max(1, (int) morning_records_get_custom_option('sidebar_'.($cur_sidebar).'_columns'));
			$last_sidebar_count = count($sidebars_widgets[$last_sidebar_id]);
		}
		$num++;
		$prm[0]['before_widget'] = str_replace(' class="', ' class="widget_number_'.esc_attr($num).($last_sidebar_columns > 1 ? ' column-1_'.esc_attr($last_sidebar_columns) : '').' ', $prm[0]['before_widget']);
		return $prm;
	}
}


// Show <title> tag under old WP (version < 4.1)
if ( !function_exists( 'morning_records_wp_title_show' ) ) {
	// add_action('wp_head', 'morning_records_wp_title_show');
	function morning_records_wp_title_show() {
		?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
	}
}

// Filters wp_title to print a neat <title> tag based on what is being viewed.
if ( !function_exists( 'morning_records_wp_title_modify' ) ) {
	// add_filter( 'wp_title', 'morning_records_wp_title_modify', 10, 2 );
	function morning_records_wp_title_modify( $title, $sep ) {
		global $page, $paged;
		if ( is_feed() ) return $title;
		// Add the blog name
		$title .= get_bloginfo( 'name' );
		// Add the blog description for the home/front page.
		if ( is_home() || is_front_page() ) {
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description )
				$title .= " $sep $site_description";
		}
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'morning-records' ), max( $paged, $page ) );
		return $title;
	}
}

// Add main menu classes
if ( !function_exists( 'morning_records_add_mainmenu_classes' ) ) {
	// add_filter('wp_nav_menu_objects', 'morning_records_add_mainmenu_classes', 10, 2);
	function morning_records_add_mainmenu_classes($items, $args) {
		if (is_admin()) return $items;
		if ($args->menu_id == 'mainmenu' && morning_records_get_theme_option('menu_colored')=='yes' && is_array($items) && count($items) > 0) {
			foreach($items as $k=>$item) {
				if ($item->menu_item_parent==0) {
					if ($item->type=='taxonomy' && $item->object=='category') {
						$cur_tint = morning_records_taxonomy_get_inherited_property('category', $item->object_id, 'bg_tint');
						if (!empty($cur_tint) && !morning_records_is_inherit_option($cur_tint))
							$items[$k]->classes[] = 'bg_tint_'.esc_attr($cur_tint);
					}
				}
			}
		}
		return $items;
	}
}


// Save post data from frontend editor
if ( !function_exists( 'morning_records_callback_frontend_editor_save' ) ) {
	function morning_records_callback_frontend_editor_save() {

		if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
		$response = array('error'=>'');

		parse_str($_REQUEST['data'], $output);
		$post_id = $output['frontend_editor_post_id'];

		if ( morning_records_get_theme_option("allow_editor")=='yes' && (current_user_can('edit_posts', $post_id) || current_user_can('edit_pages', $post_id)) ) {
			if ($post_id > 0) {
				$title   = stripslashes($output['frontend_editor_post_title']);
				$content = stripslashes($output['frontend_editor_post_content']);
				$excerpt = stripslashes($output['frontend_editor_post_excerpt']);
				$rez = wp_update_post(array(
					'ID'           => $post_id,
					'post_content' => $content,
					'post_excerpt' => $excerpt,
					'post_title'   => $title
				));
				if ($rez == 0) 
					$response['error'] = esc_html__('Post update error!', 'morning-records');
			} else {
				$response['error'] = esc_html__('Post update error!', 'morning-records');
			}
		} else
			$response['error'] = esc_html__('Post update denied!', 'morning-records');
		
		echo json_encode($response);
		die();
	}
}

// Delete post from frontend editor
if ( !function_exists( 'morning_records_callback_frontend_editor_delete' ) ) {
	function morning_records_callback_frontend_editor_delete() {

		if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();

		$response = array('error'=>'');
		
		$post_id = $_REQUEST['post_id'];

		if ( morning_records_get_theme_option("allow_editor")=='yes' && (current_user_can('delete_posts', $post_id) || current_user_can('delete_pages', $post_id)) ) {
			if ($post_id > 0) {
				$rez = wp_delete_post($post_id);
				if ($rez === false) 
					$response['error'] = esc_html__('Post delete error!', 'morning-records');
			} else {
				$response['error'] = esc_html__('Post delete error!', 'morning-records');
			}
		} else
			$response['error'] = esc_html__('Post delete denied!', 'morning-records');

		echo json_encode($response);
		die();
	}
}


// Prepare logo text
if ( !function_exists( 'morning_records_prepare_logo_text' ) ) {
	function morning_records_prepare_logo_text($text) {
		$text = str_replace(array('[', ']'), array('<span class="theme_accent">', '</span>'), $text);
		$text = str_replace(array('{', '}'), array('<strong>', '</strong>'), $text);
		return $text;
	}
}
?>