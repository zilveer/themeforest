<?php
if(!class_exists('Theme')){
/**
 * Used for the theme's initialization.
 */
class Theme {
	
	/**
	 * Initializes the theme framework, loads the required files, and calls the
	 * functions needed to run the theme.
	 */
	function init($options) {
		/* Define theme's constants. */
		$this->constants($options);

		$this->base_function();

		/* Load theme's plugin. */
		$this->plugins();
		$this->theme_included_plugins();

		/* Add theme support. */
		add_action('after_setup_theme', array(&$this, 'supports'));

		/* keep striking sidebar after switch */
		add_action('after_switch_theme', array(&$this, 'after_switch_theme'), 9);

		/* Initialize the theme's widgets. */
		add_action('widgets_init',array(&$this, 'widgets'));

		add_action('init',array(&$this, '_init'));		
	}

	function _init(){

		require_once (THEME_HELPERS . '/sidebarGenerator.php');

		global $_sidebarGenerator;
		$_sidebarGenerator = new sidebarGenerator;

		$_sidebarGenerator->register_sidebar();	

		/* Add language support. */
		$this->language();
		
		/* Load theme's options. */
		$this->options();

		/* Load theme's functions. */
		$this->functions();
		
		/* Register theme's custom post type. */
		$this->types();
		
		/* Load theme's shortcodess. */
		$this->shortcodes();

		/* Load admin files. */
		$this->admin();

		add_action( 'admin_bar_menu', array(&$this,'admin_bar_menu') ,81);

	}
	
	/**
	 * Defines the constant paths for use within the theme.
	 */
	function constants($options) {
		define('THEME_NAME', $options['theme_name']);
		define('THEME_SLUG', $options['theme_slug']);
		define('THEME_VERSION', $options['theme_version']);
		define('THEME_DIR', get_template_directory());
		define('THEME_URI', get_template_directory_uri());
		
		define('THEME_FRAMEWORK', THEME_DIR . '/framework');
		define('THEME_INSTALLER', THEME_FRAMEWORK .'/admin/themeplugins');

		define('THEME_PLUGINS', THEME_FRAMEWORK . '/plugins');
		define('THEME_HELPERS', THEME_FRAMEWORK . '/helpers');
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		define('THEME_TYPES', THEME_FRAMEWORK . '/types');
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');
		define('THEME_SHORTCODES', THEME_FRAMEWORK . '/shortcodes');
		define('THEME_SLIDESHOW', THEME_FRAMEWORK . '/slideshow');
		
		define('THEME_FONT_URI', THEME_URI . '/fonts');
		define('THEME_FONT_DIR', THEME_DIR . '/fonts');
		
		define('THEME_ICONS_URI', THEME_URI . '/icons');
		define('THEME_ICONS_DIR', THEME_DIR . '/icons');

		define('THEME_FONTFACE_URI', THEME_URI . '/fontfaces');
		define('THEME_FONTFACE_DIR', THEME_DIR . '/fontfaces');
		
		define('THEME_INCLUDES', THEME_URI . '/includes');
		define('THEME_SECTIONS', THEME_DIR . '/sections');

		$upload_dir =  wp_upload_dir();
		$baseurl = set_url_scheme($upload_dir['baseurl']);
		//if (is_ssl()) $baseurl = str_replace( 'http://', 'https://', $url ); 
        
        define('THEME_CACHE_DIR', $upload_dir['basedir'] . '/'.THEME_SLUG);
        define('THEME_CACHE_URI', $baseurl . '/'.THEME_SLUG);
        
		// define('THEME_CACHE_DIR', THEME_DIR . '/cache');
		// define('THEME_CACHE_URI', THEME_URI . '/cache');
		
		define('THEME_IMAGES', THEME_URI . '/images');
		// if(is_multisite()){
		// 	global $blog_id;
		// 	define('THEME_CACHE_IMAGES_DIR', THEME_CACHE_DIR . '/images'.$blog_id);
		// 	define('THEME_CACHE_IMAGES_URI', THEME_CACHE_URI . '/images'.$blog_id);
		// }else{
			define('THEME_CACHE_IMAGES_DIR', THEME_CACHE_DIR . '/images');
			define('THEME_CACHE_IMAGES_URI', THEME_CACHE_URI . '/images');
		// }
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');
		
		define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
		define('THEME_ADMIN_TYPES', THEME_ADMIN . '/types');
		define('THEME_ADMIN_AJAX', THEME_ADMIN . '/ajax');
		define('THEME_ADMIN_ASSETS_URI', THEME_URI . '/framework/admin/assets');
		define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions');
		define('THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		define('THEME_ADMIN_OPTION_HELPS', THEME_ADMIN_OPTIONS . '/helps');
		define('THEME_ADMIN_METABOXES', THEME_ADMIN . '/metaboxes');
		define('THEME_ADMIN_DOCS', THEME_ADMIN . '/docs');
		define('THEME_ADMIN_SHORTCODES_DIR', THEME_ADMIN . '/shortcodes');
		define('THEME_ADMIN_SHORTCODES_URI', THEME_URI.'/framework/admin/shortcodes');
	}
	
	function base_function() {
		require_once (THEME_FUNCTIONS . '/common.php');
	}

	/**
	 * Add theme support.
	 */
	function supports() {
		if (function_exists('add_theme_support')) {
			global $wp_version;
			//add_theme_support('custom-header');
			//add_theme_support('custom-background');
			
			/*
			if ( function_exists('add_custom_background') ) {
				add_custom_background();
			}
			*/
			if ( function_exists( '_wp_render_title_tag' ) && version_compare(preg_replace("/[^0-9\.]/","",$wp_version), '4.4', '>=') ) {
				add_theme_support( 'title-tag' );
			}
			//This enables post-thumbnail support for a theme.
			//add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'slideshow'));
			add_theme_support('post-thumbnails');

			//This enables the naviagation menu ability. 
			add_theme_support('menus');

			register_nav_menus(array(
				'primary-menu' => __(THEME_NAME . ' Navigation', 'theme_admin' ), 
				'footer-menu' => __(THEME_NAME . ' Footer Menu', 'theme_admin' )
			));
			
			//This enables post and comment RSS feed links to head. This should be used in place of the deprecated automatic_feed_links.
			add_theme_support('automatic-feed-links');
			
			add_theme_support( 'html5', array(
				'search-form', 'comment-form', 'comment-list',
			) );
			//add_editor_style();
		}
	}
	
	/**
	 * Register the custom post type for the theme.
	 */
	function types() {
		require_once (THEME_TYPES . '/portfolio.php');
		require_once (THEME_TYPES . '/slideshow.php');

		$this->_register_type('Theme_Post_Type_Portfolio');
		$this->_register_type('Theme_Post_Type_Slideshow');
	}

	function _register_type($type_class){
		$num_args = func_num_args();
		if($num_args == 1){
			$type = new $type_class;
		}else{
			$args = array_slice( func_get_args(), 1 );
			$reflect  = new ReflectionClass($type_class);
			$type = $reflect->newInstanceArgs($args);
		}
		
		$type->init();
	}
	
	/**
	 * Loads the theme options.
	 */
	function options() {
		require_once (THEME_FUNCTIONS . '/options.php');

		global $theme_options;
		$theme_options = array();

		$option_files = apply_filters('theme_options', array(
			'general' => 'Theme_Options_Page_General',
			'background' => 'Theme_Options_Page_Background',
			'color' => 'Theme_Options_Page_Color',
			'font' => 'Theme_Options_Page_Font',
			'slideshow' => 'Theme_Options_Page_Slideshow',
			'sidebar' => 'Theme_Options_Page_Sidebar',
			'image' => 'Theme_Options_Page_Image',
			'media' => 'Theme_Options_Page_Media',
			'homepage' => 'Theme_Options_Page_Homepage',
			'blog' => 'Theme_Options_Page_Blog',
			'portfolio' => 'Theme_Options_Page_Portfolio',			
			'footer' => 'Theme_Options_Page_Footer',
			'advanced' => 'Theme_Options_Page_Advanced',
		));

		global $options_page_factory;
		$options_page_factory = new Theme_Options_Page_Factory();

		foreach($option_files as $file => $page_class){
			$page = include (THEME_ADMIN_OPTIONS . "/" . $file.'.php');
			$options_page_factory->register($page_class);
		}
	}

	/**
	 * Loads the core theme functions.
	 */
	function functions() {
		require_once (THEME_FUNCTIONS . '/head.php');
		require_once (THEME_FUNCTIONS . '/filter.php');
		require_once (THEME_FUNCTIONS . '/wpml-integration.php');
		require_once (THEME_FUNCTIONS . '/wpml-string.php');
		require_once (THEME_HELPERS . '/slideshowGenerator.php');
		
		if(class_exists( 'Woocommerce' )){
			require_once (THEME_FUNCTIONS . '/woocommerce.php');
		}

		slideshowGenerator::init();
	}
	
	/**
	 * Load plugins integrated in a theme.
	 */
	function plugins() {
		require_once (THEME_PLUGINS . '/breadcrumbs-plus/breadcrumbs-plus.php');
		require_once (THEME_PLUGINS . '/wp-pagenavi/wp-pagenavi.php');
		require_once (THEME_PLUGINS . '/google_font/google_font.php');

		if (!class_exists('Mobile_Detect')) {
			require_once (THEME_PLUGINS . '/mobile-detect/Mobile_Detect.php');
		}

	}
	
	/**
	 * Register theme's extra widgets.
	 */
	function widgets() {
		/* Load each widget file. */
		require_once (THEME_WIDGETS . '/subnav.php');
		require_once (THEME_WIDGETS . '/flickr.php');
		require_once (THEME_WIDGETS . '/twitter.php');
		require_once (THEME_WIDGETS . '/social.php');
		require_once (THEME_WIDGETS . '/recent.php');
		require_once (THEME_WIDGETS . '/popular.php');
		require_once (THEME_WIDGETS . '/related.php');
		require_once (THEME_WIDGETS . '/portfolio-images.php');
		require_once (THEME_WIDGETS . '/contactform.php');
		require_once (THEME_WIDGETS . '/contactinfo.php');
		require_once (THEME_WIDGETS . '/authors.php');
		require_once (THEME_WIDGETS . '/advertisement-125.php');
		require_once (THEME_WIDGETS . '/search.php');
		require_once (THEME_WIDGETS . '/portfolio.php');
		require_once (THEME_WIDGETS . '/related-portfolio.php');
		require_once (THEME_WIDGETS . '/gmap.php');
		
		/* Register each widget. */
		register_widget('Theme_Widget_SubNav');
		register_widget('Theme_Widget_Flickr');
		register_widget('Theme_Widget_Twitter');
		register_widget('Theme_Widget_Social');
		register_widget('Theme_Widget_Recent_Posts');
		register_widget('Theme_Widget_Popular_Posts');
		register_widget('Theme_Widget_Related_Posts');
		register_widget('Theme_Widget_Portfolio_Images');
		register_widget('Theme_Widget_Contact_Form');
		register_widget('Theme_Widget_Contact_Info');
		register_widget('Theme_Widget_Authors');
		register_widget('Theme_Widget_Advertisement_125');
		register_widget('Theme_Widget_Search');
		register_widget('Theme_Widget_Portfolios_List');
		register_widget('Theme_Widget_Related_Portfolios_List');
		register_widget('Theme_Widget_Gmap');

		//require_once (THEME_HELPERS . '/sidebarGenerator.php');

		//global $_sidebarGenerator;
		//$_sidebarGenerator = new sidebarGenerator;

		//$_sidebarGenerator->register_sidebar();
	}
	
	/**
	 * Register theme's shortcodes.
	 */
	function shortcodes() {
		require_once (THEME_SHORTCODES . '/columns.php');
		require_once (THEME_SHORTCODES . '/typography.php');
		require_once (THEME_SHORTCODES . '/dividers.php');
		require_once (THEME_SHORTCODES . '/tabs.php');
		require_once (THEME_SHORTCODES . '/boxes.php');
		require_once (THEME_SHORTCODES . '/images.php');
		require_once (THEME_SHORTCODES . '/buttons.php');
		require_once (THEME_SHORTCODES . '/tables.php');
		require_once (THEME_SHORTCODES . '/blog.php');
		require_once (THEME_SHORTCODES . '/portfolios.php');
		require_once (THEME_SHORTCODES . '/slideshow.php');
		require_once (THEME_SHORTCODES . '/widgets.php');
		require_once (THEME_SHORTCODES . '/media.php');
		require_once (THEME_SHORTCODES . '/lightbox.php');
		require_once (THEME_SHORTCODES . '/chart.php');
		require_once (THEME_SHORTCODES . '/sitemap.php');
		require_once (THEME_SHORTCODES . '/iframe.php');
		require_once (THEME_SHORTCODES . '/gallery.php');
		require_once (THEME_SHORTCODES . '/gmap.php');
		require_once (THEME_SHORTCODES . '/carousel.php');
		require_once (THEME_SHORTCODES . '/masonry.php');
		require_once (THEME_SHORTCODES . '/testimonials.php');
	}
	
	/**
	 * Load admin files.
	 */
	function admin() {
		if (is_admin()) {
			require_once (THEME_ADMIN . '/admin.php');
			$admin = new Theme_admin();
			$admin->init();
		}
	}

	function admin_bar_menu(){
		if(!theme_get_option('advanced','admin_bar_menu')){
			return;
		}
		if(!current_user_can('edit_theme_options')){
			return;
		}
		 global $wp_admin_bar;
		 $wp_admin_bar->add_menu( array(
			'parent' => false,
			'id' => THEME_SLUG,
			'title' => '<span class="ab-icon"></span><span class="ab-label">' . THEME_NAME . '</span>',
			'href' => admin_url('admin.php?page=theme_general')
		));
		$option_pages = apply_filters('theme_admin_bar_menu', array(
			'General'=>'theme_general',
			'Background'=>'theme_background',
			'Color'=>'theme_color',
			'Font'=>'theme_font',
			'Slider Show'=>'theme_slideshow',	
			'Sidebar'=>'theme_sidebar',
			'Image'=>'theme_image',
			'Media'=>'theme_media',
			'Homepage'=>'theme_homepage',
			'Blog'=>'theme_blog',
			'Portfolio'=>'theme_portfolio',
			'Footer'=>'theme_footer',
			'Advanced'=>'theme_advanced',
		));
		foreach($option_pages as $title => $page){
			$wp_admin_bar->add_menu( array(
				'parent' => THEME_SLUG,
				'id' => $page,
				'title' => $title,
				'href' => admin_url('admin.php?page='.$page)
			));
		}
	}


	/**
	 * Make theme available for translation
	 */
	function language(){
		$locale = get_locale();
		if (is_admin()) {
			load_theme_textdomain( 'theme_admin', THEME_ADMIN . '/languages' );
			$locale_file = THEME_ADMIN . "/languages/$locale.php";
		}else{
			load_theme_textdomain( 'striking-r', THEME_DIR . '/languages' );
			$locale_file = THEME_DIR . "/languages/$locale.php";
		}
		if ( is_readable( $locale_file ) ){
			require_once( $locale_file );
		}
	}

	function after_switch_theme($stylesheet){
		if($stylesheet === 'Striking'){
			remove_action('after_switch_theme',  '_wp_sidebars_changed');
		}
	}
	function theme_included_plugins() {
		if(is_admin()){	
			require_once (THEME_INSTALLER.'/class-tgm-plugin-activation.php');
			add_action( 'tgmpa_register', array(&$this,'theme_plugins'));
		}
	}
	function theme_plugins() {
		require_once (THEME_INSTALLER.'/theme-plugins.php');
		tgmpa( $plugins, $config );
	}
}
}
