<?php
/**
 * This file includes the initialization data for:
 * - Theme options
 * - Custom pages (mosly used for sliders)
 * - Menus
 * - Post Data
 * - Locales and translation
 * - Update notifier
 */

global $pexeto;

/*******************************************************************************
 * INIT OPTIONS
 ******************************************************************************/

if ( !defined( 'PEXETO_OPTIONS_PATH' ) )
	define( 'PEXETO_OPTIONS_PATH', 'options/' );
if ( !defined( 'PEXETO_OPTIONS_KEY' ) )
	define( 'PEXETO_OPTIONS_KEY', PEXETO_SHORTNAME.'_options' );

add_action( 'admin_menu', 'pexeto_add_options_menu' );
add_action( 'init', 'pexeto_init_options', 11 );
add_action( 'admin_notices', 'pexeto_print_options_notices' );
add_action( 'admin_bar_menu', 'pexeto_add_admin_bar_options_link', 1000 );


if ( !function_exists( 'pexeto_init_options_manager' ) ) {

	/**
	 * Inits the Options Manager object. Loads it to the global
	 * $pexeto->options_manager.
	 */
	function pexeto_init_options_manager() {
		global $pexeto;

		$pexeto->options_manager = new PexetoOptionsManager(
			PEXETO_OPTIONS_KEY,
			PEXETO_THEMENAME,
			PEXETO_IMAGES_URL,
			PEXETO_VERSION );
		$pexeto->options = $pexeto->options_manager->get_options_obj();
	}
}

pexeto_init_options_manager();


if ( !function_exists( 'pexeto_add_options_menu' ) ) {

	/**
	 * Add the main theme options page to the menu.
	 */
	function pexeto_add_options_menu() {
		global $pexeto;

		add_menu_page(
			PEXETO_THEMENAME,
			PEXETO_THEMENAME,
			'edit_theme_options',
			PEXETO_OPTIONS_PAGE,
			array( $pexeto->options_manager, 'print_options_page' ),
			PEXETO_LIB_URL.'images/pex_icon.png' );

		add_submenu_page(
			PEXETO_OPTIONS_PAGE,
			PEXETO_THEMENAME.' Options',
			PEXETO_THEMENAME.' Options',
			'edit_theme_options',
			PEXETO_OPTIONS_PAGE,
			array( $pexeto->options_manager, 'print_options_page' ) );
	}
}

if ( !function_exists( 'pexeto_add_admin_bar_options_link' ) ) {

	/**
	 * Adds a link to the Theme Options page in the admin bar.
	 */
	function pexeto_add_admin_bar_options_link() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			global $wp_admin_bar;
			$wp_admin_bar->add_menu( array( 'id' => 'pexeto_options',
					'title' =>PEXETO_THEMENAME.' Options',
					'href' => admin_url( '?page=pexeto_options' ) ) );
		}
	}
}

if ( !function_exists( 'pexeto_init_options' ) ) {

	/**
	 * Inits the options functionality. Loads the options files which will load
	 * the option fields to the global $pexeto->options object.
	 */
	function pexeto_init_options() {
		global $pexeto;

		//load the files that contain the options
		$options_files=array( 'general', 'posts', 'sliders', 'styles',
			'media', 'documentation' );
		foreach ( $options_files as $file ) {
			require_once PEXETO_OPTIONS_PATH.$file.'.php';
		}

		$pexeto->options->init();

	}
}


if ( !function_exists( 'pexeto_print_options_notices' ) ) {

	/**
	 * Prints the admin notices in the options page. Prints a notice when there
	 * is a new update of the theme available.
	 */
	function pexeto_print_options_notices() {
		global $pexeto;

		//print the update message if there is a new update available
		if ( isset( $_GET['page'] )
			&& $_GET['page']==PEXETO_OPTIONS_PAGE
			&& isset( $pexeto->update_notifier )
			&& $pexeto->update_notifier->is_new_version_available() ) {
			$pexeto->update_notifier->print_update_notification_message( true );
		}
	}
}

/*******************************************************************************
 * INIT CUSTOM PAGES
 * Custom pages are pages containing custom Pexeto functionality that allows you
 * easily add and manage custom post instances. For example, they are mostly used
 * for sliders where you can add quickly add images to the slider or create sets
 * of different sliders.
 ******************************************************************************/

//define the main constants that will be used
if ( !defined( 'PEXETO_NIVOSLIDER_POSTTYPE' ) )
	define( 'PEXETO_NIVOSLIDER_POSTTYPE', 'pexnivoslider' );
if ( !defined( 'PEXETO_CONTENTSLIDER_POSTTYPE' ) )
	define( 'PEXETO_CONTENTSLIDER_POSTTYPE', 'pexcontentslider' );
if ( !defined( 'PEXETO_SERVICES_POSTTYPE' ) )
	define( 'PEXETO_SERVICES_POSTTYPE', 'pexservice' );
if ( !defined( 'PEXETO_TESTIMONIALS_POSTTYPE' ) )
	define( 'PEXETO_TESTIMONIALS_POSTTYPE', 'pextestimonial' );
if ( !defined( 'PEXETO_PRICING_POSTTYPE' ) )
	define( 'PEXETO_PRICING_POSTTYPE', 'pexpricing' );
if ( !defined( 'PEXETO_SLIDER_TYPE' ) )
	define( 'PEXETO_SLIDER_TYPE', 'slider' );
if ( !defined( 'PEXETO_CUSTOM_PREFIX' ) )
	define( 'PEXETO_CUSTOM_PREFIX', PexetoCustomPageManager::custom_prefix );

$pexeto->align_options = array(
	array('id'=>'cc', 'css_val'=>'center center', 'name' => 'Center'),
	array('id'=>'ct', 'css_val'=>'center top', 'name' => 'Center - Top'),
	array('id'=>'cb', 'css_val'=>'center bottom', 'name' => 'Center - Bottom'),
	array('id'=>'lt', 'css_val'=>'left top', 'name' => 'Left - Top'),
	array('id'=>'lc', 'css_val'=>'left center', 'name' => 'Left - Center'),
	array('id'=>'lb', 'css_val'=>'left bottom', 'name' => 'Left - Bottom'),
	array('id'=>'rt', 'css_val'=>'right top', 'name' => 'Right - Top'),
	array('id'=>'rc', 'css_val'=>'right center', 'name' => 'Right - Center'),
	array('id'=>'rb', 'css_val'=>'right bottom', 'name' => 'Right - Bottom')
);

if(!function_exists('pexeto_get_align_value_by_id')){
	function pexeto_get_align_value_by_id($id){
		global $pexeto;
		foreach ($pexeto->align_options as $key => $option) {
			if($option['id']==$id){
				return $option['css_val'];
			}
		}
		return 'center center';
	}
}

if ( !function_exists( 'pexeto_define_custom_pages' ) ) {

	/**
	 * Defines all the custom pafes that will be used in the theme. Loads them
	 * into the global $pexeto->custom_pages.
	 */
	function pexeto_define_custom_pages() {
		global $pexeto;

		$opacity_options = array();
		for($i=0.1; $i<=1; $i+=0.1){
			$opacity_options[]=array('id'=>$i, 'name'=>$i);
		}

		//define the custom pages - this is the main array that defines the structure of each of the custom pages
		$pexeto->custom_pages=array( PEXETO_NIVOSLIDER_POSTTYPE=>
			new PexetoCustomPage( PEXETO_NIVOSLIDER_POSTTYPE, array(
					array( 'id'=>'image_url', 'type'=>'upload', 'name'=>'Image URL', 'required'=>true ),
					array( 'id'=>'image_link', 'type'=>'text', 'name'=>'Image Link' ),
					array( 'id'=>'description', 'type'=>'textarea', 'name'=>'Image Description' )
				), 'Nivo Slider', true, PEXETO_OPTIONS_PAGE, 'image_url', PEXETO_SLIDER_TYPE, 'slider-nivo.php', true ),

			PEXETO_CONTENTSLIDER_POSTTYPE=>
			new PexetoCustomPage( PEXETO_CONTENTSLIDER_POSTTYPE, array(
					array( 'id'=>'layout', 'type'=>'select', 'name'=>'Slide Layout', 'two-column'=>'first', 'options'=>array(
						array('id'=>'centered', 'name'=>'Centered Text', 'hide'=>PEXETO_CUSTOM_PREFIX.'image_url,'.PEXETO_CUSTOM_PREFIX.'video_url'), 
						array('id'=>'img-text', 'name'=>'Image with text on the right', 'hide'=>PEXETO_CUSTOM_PREFIX.'video_url'),
						array('id'=>'text-img', 'name'=>'Image with text on the left', 'hide'=>PEXETO_CUSTOM_PREFIX.'video_url'),
						array('id'=>'video-text', 'name'=>'YouTube video with text on the right', 'hide'=>PEXETO_CUSTOM_PREFIX.'image_url'),
						array('id'=>'text-video', 'name'=>'YouTube video with text on the left', 'hide'=>PEXETO_CUSTOM_PREFIX.'image_url'),
						)),
					array( 'id'=>'animation', 'type'=>'select', 'name'=>'Slide Animation', 'two-column'=>'last', 'options'=>array(
						array('id'=>'random', 'name'=>'Random'),
						array('id'=>'slideLeft', 'name'=>'Slide Left'),
						array('id'=>'slideRight', 'name'=>'Slide Right'),
						array('id'=>'slideUp', 'name'=>'Slide Up'),
						array('id'=>'slideDown', 'name'=>'Slide Down'))),
					array( 'id'=>'bg_color', 'type'=>'colorpick', 'name'=>'Custom Slide Background Color', 'two-column'=>'first'),
					array( 'id'=>'text_color', 'type'=>'colorpick', 'name'=>'Custom Slide Text Color', 'two-column'=>'second'),
					array( 'id'=>'bg_image_url', 'type'=>'upload', 'name'=>'Background Image URL', 'two-column'=>'first'),
					array( 'id'=>'bg_image_opacity', 'type'=>'select', 'name'=>'Background Image Opacity', 'options'=>$opacity_options, 'two-column'=>'second', 'std'=>'0.5'),
					array('id'=>'bg_align', 'name'=>'Background Image Alignment', 'type'=>'select', 'options'=>$pexeto->align_options, 'two-column'=>'first'),
					array('id'=>'bg_style', 'name'=>'Background Style', 'type'=>'select', 'options'=>array(array('id'=>'default','name'=>'Parallax Cover'), array('id'=>'cover','name'=>'Cover'), array('id'=>'contain','name'=>'Contain')), 'two-column'=>'last'),
					array( 'id'=>'image_url', 'type'=>'upload', 'name'=>'Main Image URL (optional)'),
					array( 'id'=>'video_url', 'type'=>'text', 'name'=>'YouTube Video URL', 'desc'=>'example: http://www.youtube.com/watch?v=YE7VzlLtp-4'),
					array( 'id'=>'small_title', 'type'=>'text', 'name'=>'Small Title' ),
					array( 'id'=>'main_title', 'type'=>'text', 'name'=>'Main Title' ),
					array( 'id'=>'description', 'type'=>'textarea', 'name'=>'Description' ),
					array( 'id'=>'but_one_text', 'type'=>'text', 'name'=>'Button one text', 'two-column'=>'first' ),
					array( 'id'=>'but_one_link', 'type'=>'text', 'name'=>'Button one link', 'two-column'=>'last' ),
					array( 'id'=>'but_two_text', 'type'=>'text', 'name'=>'Button two text', 'two-column'=>'first' ),
					array( 'id'=>'but_two_link', 'type'=>'text', 'name'=>'Button two link', 'two-column'=>'last' )
				), 'Content Slider', true, PEXETO_OPTIONS_PAGE, 'image_url|bg_image_url|v:video_url', PEXETO_SLIDER_TYPE, 'slider-content.php', true ),

			PEXETO_SERVICES_POSTTYPE=>
			new PexetoCustomPage( PEXETO_SERVICES_POSTTYPE, array(
					array( 'id'=>'box_title', 'type'=>'text', 'name'=>'Title', 'required'=>true ),
					array( 'id'=>'box_image', 'type'=>'upload', 'name'=>'Image URL' ),
					array( 'id'=>'box_link', 'type'=>'text', 'name'=>'Link' ),
					array( 'id'=>'box_desc', 'type'=>'textarea', 'name'=>'Description' )
				), 'Services Boxes', true, PEXETO_OPTIONS_PAGE, 'box_image', 'data', '', false, 'Services Box Set' ),

			PEXETO_TESTIMONIALS_POSTTYPE=>
			new PexetoCustomPage( PEXETO_TESTIMONIALS_POSTTYPE, array(
					array( 'id'=>'name', 'type'=>'text', 'name'=>'Person Name', 'required'=>true ),
					array( 'id'=>'testimonial', 'type'=>'textarea', 'name'=>'Testimonial', 'required'=>true ),
					array( 'id'=>'image', 'type'=>'upload', 'name'=>'Person Image' ),
					array( 'id'=>'occupation', 'type'=>'text', 'name'=>'Occupation' ),
					array( 'id'=>'organization', 'type'=>'text', 'name'=>'Organization' ),
					array( 'id'=>'organization_link', 'type'=>'text', 'name'=>'Organization Link' ),

					
				), 'Testimonials', true, PEXETO_OPTIONS_PAGE, 'image', 'data', '', false, 'Testimonials Set' ),

			PEXETO_PRICING_POSTTYPE=>
			new PexetoCustomPage( PEXETO_PRICING_POSTTYPE, array(
					array( 'id'=>'item_title', 'type'=>'text', 'name'=>'Item Title', 'required'=>true, 'two-column'=>'first' ),
					array( 'id'=>'highlight', 'type'=>'select', 'name'=>'Item Style', 'options'=>array(array('id'=>'default', 'name'=>'Default'), array('id'=>'highlight', 'name'=>'Highlight')), 'two-column'=>'last'),
					array( 'id'=>'price', 'type'=>'text', 'name'=>'Item Price', 'two-column'=>'first' ),
					array( 'id'=>'price_period', 'type'=>'text', 'name'=>'Price Period', 'default'=>'per month', 'two-column'=>'last' ),
					array( 'id'=>'currency', 'type'=>'text', 'name'=>'Currency', 'default'=>'$', 'two-column'=>'first' ),
					array( 'id'=>'currency_position', 'type'=>'select', 'name'=>'Currency Position', 'options'=>array(array('id'=>'left', 'name'=>'Left ($99)'), array('id'=>'right', 'name'=>'Right (99$)')), 'two-column'=>'last' ),
					array( 'id'=>'description', 'type'=>'textarea', 'name'=>'Item Features', 'desc'=>'Add each feature on a new line, example:<br/>Feature One<br/>Feature Two<br/>Feature Three' ),
					array( 'id'=>'button_text', 'type'=>'text', 'name'=>'Button text', 'two-column'=>'first' ),
					array( 'id'=>'button_link', 'type'=>'text', 'name'=>'Button link', 'two-column'=>'second' ),
				), 'Pricing Tables', true, PEXETO_OPTIONS_PAGE, 'none', 'data', '', false, 'Pricing Table' )
		);
	}
}

pexeto_define_custom_pages();


/*******************************************************************************
 * INIT MENUS
 ******************************************************************************/

add_action( 'init', 'pexeto_register_menus' );
add_theme_support( 'menus' );


if ( !function_exists( 'pexeto_register_menus' ) ) {
	/**
	 * Register the main menu for the theme.
	 */
	function pexeto_register_menus() {
		register_nav_menus(
			array(
				'pexeto_main_menu' => __( PEXETO_THEMENAME.' Theme Main Menu', 'pexeto_admin' ),
				'pexeto_footer_menu' => __( PEXETO_THEMENAME.' Theme Footer Menu', 'pexeto_admin')
			) );
	}
}


if ( !function_exists( 'pexeto_no_menu' ) ) {
	/**
	 * Displays some directions in the main menu section when a menu has not be
	 * created and set.
	 */
	function pexeto_no_menu() {
		echo 'Go to Appearance &raquo; Menus to create and set a menu';
	}
}

if ( !function_exists( 'pexeto_no_footer_menu' ) ) {

	/**
	 * Callback for an empty footer menu. Does not display anything.
	 */
	function pexeto_no_footer_menu() {
		return;
	}
}


/*******************************************************************************
 * INIT POST DATA
 ******************************************************************************/

//add custom post formats support
add_theme_support( 'post-formats', array( 'gallery', 'video', 'aside', 'quote' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );


/*******************************************************************************
 * LOCALE AND TRANSLATION
 ******************************************************************************/


add_filter( 'locale', 'pexeto_set_locale' );
if(!function_exists('pexeto_set_locale')){
	function pexeto_set_locale($locale) {
		$pexeto_locale = pexeto_option('locale');
		if($pexeto_locale){
			return $pexeto_locale;
		}else{
			return $locale;
		}
	}
}

add_action('after_setup_theme', 'pexeto_load_textdomain');
if(!function_exists('pexeto_load_textdomain')){
	function pexeto_load_textdomain(){
		$path = pexeto_option('load_translation') == 'child' ?
			get_stylesheet_directory() :
			get_template_directory();

	    load_theme_textdomain( 'pexeto', $path . '/lang' );
	}
}


/*******************************************************************************
 * UPDATE NOTIFIER
 ******************************************************************************/

// Set the remote notifier XML file containing the latest version of the theme and changelog
if ( !defined( 'PEXETO_UPDATE_XML_FILE' ) )
	define( 'PEXETO_UPDATE_XML_FILE', 'http://pexeto.com/updates/porcelain.xml' );
// Set the time interval for the remote XML cache in the database (21600 seconds = 6 hours)
if ( !defined( 'PEXETO_UPDATE_CACHE_INTERVAL' ) )
	define( 'PEXETO_UPDATE_CACHE_INTERVAL', 21600 );
if ( !defined( 'PEXETO_UPDATE_PAGE_NAME' ) )
	define( 'PEXETO_UPDATE_PAGE_NAME', 'pexeto_update' );

if ( !function_exists( 'pexeto_init_update_notfier' ) ) {
	function pexeto_init_update_notfier() {
		global $pagenow, $pexeto;
		if ( is_admin() && $pagenow!='update-core.php' ) {
			$pexeto->update_notifier = new PexetoUpdateNotifier(
				PEXETO_THEMENAME,
				PEXETO_SHORTNAME,
				PEXETO_UPDATE_XML_FILE,
				PEXETO_UPDATE_CACHE_INTERVAL,
				PEXETO_UPDATE_PAGE_NAME,
				admin_url().'admin.php?page='.PEXETO_OPTIONS_PAGE
			);
			$pexeto->update_notifier->init();
		}
	}
}

pexeto_init_update_notfier();



/*******************************************************************************
 * BUNDLED PLUGINS
 ******************************************************************************/


add_action( 'tgmpa_register', 'pexeto_register_plugins' );

/**
 * Uses the TGM Plugin Activation class to add message in the admin panel
 * to install the recommended/required for this theme plugins.
 */
if(!function_exists('pexeto_register_plugins')){
	function pexeto_register_plugins(){
		$plugins = array(
	 		array(
	            'name'      => 'WP-PageNavi',
	            'slug'      => 'wp-pagenavi',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Pexeto Recent Posts Widget',
	            'slug'      => 'pexeto-recent-posts',
	            'source'    => get_template_directory() . '/plugins/pexeto-recent-posts.zip',
	            'required'  => false
	        ),
	        array(
	            'name'      => 'Simple Google Map',
	            'slug'      => 'simple-google-map',
	            'required'  => false
	        ),
	        array(
	            'name'      => 'Pexeto Portfolio Items Widget',
	            'slug'      => 'pexeto-portfolio-items',
	            'source'    => get_template_directory() . '/plugins/pexeto-portfolio-items.zip',
	            'required'  => false
	        )
	    );

		$theme_text_domain = 'pexeto';

		$config = array(
		    'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'tgmpa-install-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> ''
	    );
	 
	    tgmpa( $plugins, $config );
	}
}
