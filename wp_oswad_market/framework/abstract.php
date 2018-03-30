<?php 
$theme_options_default = null;
class EWAbstractTheme 
{
	protected $options = array();
	protected $arrFunctions = array();
	protected $arrWidgets = array();
	protected $arrIncludes = array();
	public function __construct($options){
		$this->initArrFunctions();
		$this->initArrWidgets();
		$this->initArrIncludes();
	}

	protected function init(){
		////// Active theme
		$this->hookActive($this->options['theme_slug'], array($this,'activeTheme'));
		
		
		$this->initIncludes();
		
		///// After Setup theme
		add_action( 'after_setup_theme', array($this,'wpdancesetup'));
		
		/* Fix bbp_setup_current_user was called incorrectly */
		if( class_exists('bbPress') ){
			remove_action( 'set_current_user', 'bbp_setup_current_user',10);
			add_action( 'set_current_user', create_function('','do_action( "bbp_setup_current_user" );'),10);
		}
		
		////// deactive theme
		$this->hookDeactive($this->options['theme_slug'], array($this,'deactiveTheme'));
		
		add_action('wp_enqueue_scripts',array($this,'addScripts'));
		
		add_action('wp_enqueue_scripts',array($this,'add_custom_style'),1000000);
		
		add_action('wp_enqueue_scripts', array($this, 'add_right_to_left_style'), 999999);
		
		add_action( 'wp_enqueue_scripts', array($this,'register_google_font') );
		
		///// Create Custom Post Type
		$this->iniPostTypes();
		
		
		$this->initFunctions();
		$this->initWidgets();
		//$this->initSidebars();
		
		/* Disable VC Frontend Editor */
		if( function_exists('vc_disable_frontend') ){
			vc_disable_frontend();
		}
		
		/* if login to admin, generate admin panel for theme */
		require_once THEME_ADMIN.'/admin.php';
			if(file_exists(THEME_EXTENDS_ADMIN.'/admin.php')){
				require_once THEME_EXTENDS_ADMIN.'/admin.php';
				$classNameAdmin = 'AdminTheme'.strtoupper(substr(THEME_SLUG,0,strlen(THEME_SLUG)-1));
			}
			else{
				$classNameAdmin = 'AdminTheme';
			}
			$panel = new $classNameAdmin();
	}
	
	protected function initArrFunctions(){
		$this->arrFunctions = array('custom_functions','main','global_var','preview_mod','ads','quicksand','slide','markup_categories','lightbox_control',
		'breadcrumbs','sidebar','twitter_update','feed_burner','excerpt','theme_control','pagination','filter_theme','posted_in_on',
		'video','comment','theme_sidebar','logo_function','wdmenus','woo-cart','woo-product','woo-hook','woo-wishlist','woo-account','custom_term','vc_generator');
	}
	
	
	protected function initArrWidgets(){
		$this->arrWidgets = array('flickr','recent_post_slider','customrecent','about','emads','custompages','twitterupdate','multitab');
	}
	
	protected function initArrIncludes(){
		$this->arrIncludes = array('twitteroauth','mobile_detect');
	}
	
	public function wpdancesetup() {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );


		// This theme supports a variety of post formats.
		//add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );	
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );		
		//add_theme_support( 'custom-header', $args ) ;
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		$defaults = array(
			'default-color'          => '',
			'default-image'          => get_template_directory_uri()."/images/default-background.png",
			// 'wp-head-callback'       => 'head_callback_on_bg',
			// 'admin-head-callback'    => '',
			// 'admin-preview-callback' => ''
		);
		
		global $wp_version;
		
		add_theme_support( 'custom-background', $defaults );
				
		add_theme_support( 'woocommerce' );	
		if ( ! isset( $content_width ) ) $content_width = 960;
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'wpdance', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'wpdance' )
		) );
		register_nav_menus( array(
			'mobile' => __( 'Mobile Navigation', 'wpdance' ),
		) );

		// Your changeable header business starts here
		if ( ! defined( 'HEADER_TEXTCOLOR' ) )
			define( 'HEADER_TEXTCOLOR', '' );

		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		if ( ! defined( 'HEADER_IMAGE' ) )
			define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to wpdance_header_image_width and wpdance_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'wpdance_header_image_width', 940 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'wpdance_header_image_height', 198 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 940 pixels wide by 198 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See wpdance_admin_header_style(), below.


		// ... and thus ends the changeable header business.
		
		$detect = new Mobile_Detect;
		$_is_tablet = $detect->isTablet();
		$_is_mobile = $detect->isMobile() && !$_is_tablet;
		define( 'WD_IS_MOBILE', $_is_mobile );
		define( 'WD_IS_TABLET', $_is_tablet );
	}
	
	protected function constant($options){
		define('DS',DIRECTORY_SEPARATOR);	
		define('THEME_NAME', $options['theme_name']);
		define('THEME_SLUG', $options['theme_slug'].'_');
		
		define('THEME_DIR', get_template_directory());
		
		define('THEME_CACHE', get_template_directory().DS.'cache_theme'.DS);
		
		define('THEME_URI', get_template_directory_uri());
		define('THEME_FRAMEWORK_JS_URI', THEME_URI.'/framework/js');
		define('THEME_FRAMEWORK_CSS_URI', THEME_URI.'/framework/css');
		define('THEME_ADMIN_URI', THEME_URI.'/framework/admin');
		
		define('THEME_FRAMEWORK', THEME_DIR . '/framework');
		
		define('THEME_PLUGINS', THEME_FRAMEWORK . '/plugins');
		define('THEME_HELPERS', THEME_FRAMEWORK . '/helpers');
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');
		define('THEME_SHORTCODES', THEME_FRAMEWORK . '/shortcodes');
		define('THEME_INCLUDES', THEME_FRAMEWORK . '/includes');
		define('THEME_TYPES', THEME_FRAMEWORK . '/types');
		
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');
		
		define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
			
		define('ENABLED_FONT', false);
		define('ENABLED_COLOR', false);
		define('ENABLED_PREVIEW', false);
		define('SITE_LAYOUT', 'wide');
		
		define('USING_CSS_CACHE', true);
		
	}
	
	protected function iniPostTypes(){
		
		// require_once THEME_TYPES."/testimonials.php";
		// require_once THEME_TYPES."/feature.php";
		//require_once THEME_TYPES."/slide.php";		 
	}
	
	protected function initFunctions(){
		foreach($this->arrFunctions as $function){
			if(file_exists(THEME_EXTENDS_FUNCTIONS."/{$function}.php"))
				require_once THEME_EXTENDS_FUNCTIONS."/{$function}.php";
			else	
				require_once THEME_FUNCTIONS."/{$function}.php";
		}
	}
	
	
	
	protected function initWidgets(){
		foreach($this->arrWidgets as $widget){
			if(file_exists(THEME_EXTENDS_WIDGETS."/{$widget}.php"))
				require_once THEME_EXTENDS_WIDGETS."/{$widget}.php";
			else	
				require_once THEME_WIDGETS."/{$widget}.php";
		}
		add_action( 'widgets_init', array($this,'loadWidgets'));
	}
	
	protected function initIncludes(){
		foreach($this->arrIncludes as $include){
			if(file_exists(THEME_EXTENDS_INCLUDES."/{$include}.php"))
				require_once THEME_EXTENDS_INCLUDES."/{$include}.php";
			else	
				require_once THEME_INCLUDES."/{$include}.php";
		}
	}
	
	public function loadWidgets(){
		foreach($this->arrWidgets as $widget)
			register_widget( 'WP_Widget_'.ucfirst($widget) );
	}
	protected function loadOptions(){
		if(file_exists(THEME_EXTENDS_INCLUDES."/options.php"))
			require_once THEME_EXTENDS_INCLUDES."/options.php";
		else	
			require_once THEME_INCLUDES."/options.php";
	}
	
	public function activeTheme(){
		//Single Image
		update_option( 'shop_single_image_size', array('height'=>'480', 'width' => '480', 'crop' => 1 ));
		//Thumbnail Image
		update_option( 'shop_thumbnail_image_size', array('height'=>'100', 'width' => '100', 'crop' => 1 ));
		//Catalog Image
		update_option( 'shop_catalog_image_size', array('height'=>'210', 'width' => '210', 'crop' => 1 ));
	
		$this->loadOptions();
		global $theme_options_default,$wpdb;
		foreach($theme_options_default as $key => $value){
			update_option(THEME_SLUG.$key, $value);
		}

	}
	
	public function hookActive($code, $function){
		$optionKey="theme_is_activated_" . $code;
		if(!get_option($optionKey)) {
			call_user_func($function);
			update_option($optionKey , 1);
		}
	}
	
	public function deactiveTheme(){
	
	}
	
	/**
	 * @desc registers deactivation hook
	 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
	 * @param callback $function : Function to call when theme gets deactivated.
	 */
	public function hookDeactive($code, $function) {
		// store function in code specific global
		$GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;

		// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
		$fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

		// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
		// Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
		// Your theme can perceive this hook as a deactivation hook.)
		add_action("switch_theme", $fn);
	}
	
	public function add_custom_style(){
		$upload_dir = wp_upload_dir();
		$filename = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ','',THEME_NAME)) . '.css';
		if( is_ssl() ){
			$filename = str_replace('http://', 'https://', $filename);
		}
		$filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ','',THEME_NAME)) . '.css';

		if( file_exists( $filename_dir ) ){
			wp_enqueue_style(THEME_SLUG.'dynamic_css', $filename);
		}		
	}
	
	function add_right_to_left_style(){
		global $smof_data;
		/* ===================================== CSS FOR RIGHT TO LEFT ====================================== */
		if( isset($smof_data['wd_enable_right_to_left']) && $smof_data['wd_enable_right_to_left'] == 1 ){
			wp_register_style( 'wd-rtl', THEME_CSS.'/wd-rtl.css');
			wp_enqueue_style('wd-rtl');
		}
	}
	
	function load_gg_fonts( $wd_font_name = "" ) {
		if( isset($wd_font_name) && strlen( $wd_font_name ) > 0 ){
			$font_name_id = str_replace('+', '-', strtolower($wd_font_name));
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( THEME_SLUG."{$font_name_id}", "{$protocol}://fonts.googleapis.com/css?family={$wd_font_name}" );		
		}
	}
	
	function register_google_font(){
		global $smof_data;
		$body_font = esc_attr( str_replace( " ", "+", $smof_data['wd_body_font_googlefont'] ) );
		$body_second_font = esc_attr( str_replace( " ", "+", $smof_data['wd_body_second_font_googlefont'] ) );
		$menu_font = esc_attr( str_replace( " ", "+", $smof_data['wd_menu_font_googlefont'] ) );
		$sub_menu_font = esc_attr( str_replace( " ", "+", $smof_data['wd_sub_menu_font_googlefont'] ) );
		$price_font = esc_attr( str_replace( " ", "+", $smof_data['wd_price_font_googlefont'] ) );
		
		if( absint($smof_data['wd_body_font_googlefont_enable']) == 0 && strcmp($body_font,'none') != 0 )
			$this->load_gg_fonts(trim($body_font));
		if( absint($smof_data['wd_body_second_font_googlefont_enable']) == 0 && strcmp($body_second_font,'none') != 0 )
			$this->load_gg_fonts(trim($body_second_font));
		if( absint($smof_data['wd_menu_font_googlefont_enable']) == 0 && strcmp($menu_font,'none') != 0 )
			$this->load_gg_fonts(trim($menu_font));
		if( absint($smof_data['wd_sub_menu_font_googlefont_enable']) == 0 && strcmp($sub_menu_font,'none') != 0 )
			$this->load_gg_fonts(trim($sub_menu_font));
		if( absint($smof_data['wd_price_font_googlefont_enable']) == 0 && strcmp($price_font,'none') != 0 )
			$this->load_gg_fonts(trim($price_font));
	}
	
	public function addScripts(){
		global $is_IE, $smof_data;

		
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( THEME_SLUG.'open-sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300" );
		wp_enqueue_style( THEME_SLUG.'roboto-condensed',"$protocol://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,400,700,300" );
		
		wp_enqueue_style( strtolower(str_replace(' ','',THEME_NAME)), get_stylesheet_uri() ); 
		
		wp_register_script( 'TweenMax', THEME_FRAMEWORK_JS_URI.'/TweenMax.js',false,false,true);
		wp_enqueue_script('TweenMax');			
		
		wp_enqueue_script('jquery');	
		wp_register_script( 'bootstrap', THEME_JS.'/bootstrap.js',false,false,true);
		wp_enqueue_script('bootstrap');		
		
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-mouse");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-effects-core");
		
		
		/* Fix Composer CSS Not Loaded */
		wp_enqueue_style('js_composer_front');
		
		if( isset($smof_data['wd_preview_panel']) ){
			if( (int) $smof_data['wd_preview_panel'] == 1){
				wp_register_style( 'colorpicker', THEME_CSS.'/colorpicker.css');
				wp_enqueue_style('colorpicker');		
				wp_register_script( 'bootstrap-colorpicker', THEME_JS.'/bootstrap-colorpicker.js',false,false,true);
				wp_enqueue_script('bootstrap-colorpicker');	
			}
		}
		else{
			wp_register_style( 'colorpicker', THEME_CSS.'/colorpicker.css');
			wp_enqueue_style('colorpicker');		
			wp_register_script( 'bootstrap-colorpicker', THEME_JS.'/bootstrap-colorpicker.js',false,false,true);
			wp_enqueue_script('bootstrap-colorpicker');	
		}
		
		wp_register_script( 'jquery.touchSwipe', THEME_FRAMEWORK_JS_URI.'/jquery.touchSwipe.js',false,false,true);
		wp_enqueue_script('jquery.touchSwipe');
		
		
		/*if( isset( $smof_data['wd_nicescroll'] ) ){
			if( (int) $smof_data['wd_nicescroll'] == 1 ){
				wp_register_script( 'jquery.nicescroll', THEME_FRAMEWORK_JS_URI.'/jquery.nicescroll.js',false,false,false);
				wp_enqueue_script('jquery.nicescroll');
			}
		}
		else{
			wp_register_script( 'jquery.nicescroll', THEME_FRAMEWORK_JS_URI.'/jquery.nicescroll.js',false,false,false);
			wp_enqueue_script('jquery.nicescroll');
		}*/
		
		
		/* Start Fancy Box
		wp_register_style( 'fancybox_css', THEME_CSS.'/jquery.fancybox.css');
		wp_enqueue_style('fancybox_css');		
		 End Fancy Box */
		
		if( isset($smof_data['wd_header_layout']) && $smof_data['wd_header_layout'] == 'v3' ){
			wp_register_style( 'select2', THEME_FRAMEWORK_CSS_URI.'/select2.css');
			wp_enqueue_style('select2');
			
			wp_register_script( 'select2', THEME_FRAMEWORK_JS_URI.'/select2.js',false,false,false);
			wp_enqueue_script('select2');
		}
		

		wp_register_script( 'include-script', THEME_FRAMEWORK_JS_URI.'/include-script.js',false,false,true);
		wp_enqueue_script('include-script');
		wp_register_style( 'bootstrap-theme.css', THEME_CSS.'/bootstrap-theme.css');
		wp_enqueue_style('bootstrap-theme.css');	
		wp_register_style( 'bootstrap', THEME_CSS.'/bootstrap.css');
		wp_enqueue_style('bootstrap');			
		wp_register_style( 'font-awesome', THEME_FRAMEWORK_CSS_URI.'/font-awesome.css');
		wp_enqueue_style('font-awesome');	
		wp_register_style( 'base', THEME_CSS.'/base.css');
		wp_enqueue_style('base');
		wp_register_style( 'responsive', THEME_CSS.'/responsive.css');
		wp_enqueue_style('responsive');

		wp_register_style( 'owl.carousel', THEME_CSS.'/owl.carousel.css');
		wp_enqueue_style('owl.carousel');		
		wp_register_script( 'jquery.owlCarousel', THEME_JS.'/owl.carousel.min.js',false,false,true);
		wp_enqueue_script('jquery.owlCarousel');	
		

		if(is_singular('product')){
			
			if( isset($smof_data['wd_prod_cloudzoom']) ){
				if( (int) $smof_data['wd_prod_cloudzoom'] == 1 ){
					wp_register_script( 'jquery.cloud-zoom', THEME_JS.'/cloud-zoom.1.0.2.js',false,false,true);
					wp_enqueue_script('jquery.cloud-zoom');		
				}
			}
			else{
				wp_register_script( 'jquery.cloud-zoom', THEME_JS.'/cloud-zoom.1.0.2.js',false,false,true);
				wp_enqueue_script('jquery.cloud-zoom');		
			}
		}else{
			wp_register_script( 'jquery.prettyPhoto', THEME_JS.'/jquery.prettyPhoto.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto');	
			wp_register_script( 'jquery.prettyPhoto.init', THEME_JS.'/jquery.prettyPhoto.init.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto.init');
		}
		
		
		
	}
}
?>