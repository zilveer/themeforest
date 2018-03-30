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

require_once 'options/theme-customizer-options.php';

/*******************************************************************************
 * INIT CUSTOMIZER
 ******************************************************************************/

if(!function_exists('pexeto_init_theme_customizer')){

	function pexeto_init_theme_customizer(){
		global $pexeto;

		$options = pexeto_get_customizer_options();

		$pexeto->customizer = new PexetoThemeCustomizer($options, PEXETO_LIB_URL.'js/');
	}
}

pexeto_init_theme_customizer();


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
			'none' );

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
		$options_files=array( 'general', 'header', 'footer', 'posts', 'sliders', 'styles',
			'media' );
		if(PEXETO_WOOCOMMERCE_ACTIVE){
			$options_files[]='woocommerce';
		}
		$options_files[]='documentation';

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
if ( !defined( 'PEXETO_FULLPAGESLIDER_POSTTYPE' ) )
	define( 'PEXETO_FULLPAGESLIDER_POSTTYPE', 'pexfullslider' );
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

if ( !function_exists( 'pexeto_define_custom_pages' ) ) {

	/**
	 * Defines all the custom pafes that will be used in the theme. Loads them
	 * into the global $pexeto->custom_pages.
	 */
	function pexeto_define_custom_pages() {
		global $pexeto;

		$opacity_options = array();
		for($i=1; $i>=0.1; $i-=0.1){
			$opacity_options[]=array('id'=>strval($i), 'name'=>strval($i));
		}

		$fullpage_hide = array(
			'textimg' => array('text_layout', 'images', 'slide_video_mp4', 'slide_video_webm', 'slide_video_ogg', 'mobile_background_image'),
			'text'=>array('image_layout', 'images', 'content_image', 'slide_video_mp4', 'slide_video_webm', 'slide_video_ogg', 'mobile_background_image'),
			'slider'=>array('text_layout', 'image_layout', 'slide_background_image', 'background_color',
				'slide_title', 'slide_description', 'content_image', 'button_text', 'button_link', 'button_link_open', 'slide_style',
				'title_color','title_text_style[]','title_font','title_font_size',
				'description_color','description_text_style[]','description_font','description_font_size', 'button_color',
				'slide_video_mp4', 'slide_video_webm', 'slide_video_ogg', 'mobile_background_image', 'bg_align'),
			'video'=>array('image_layout', 'images', 'slide_background_image', 'content_image', 'bg_align'),
			'default_style'=>array('title_color','title_text_style[]','title_font','title_font_size',
				'description_color','description_text_style[]','description_font','description_font_size', 'button_color', 'button_link_open', 'bg_align')
		);

		$content_hide = array(
			'default_style'=>array('bg_align', 'bg_style', 'title_font','title_font_size','title_text_style[]','subtitle_font','subtitle_font_size',
				'subtitle_text_style[]','description_font','description_font_size','description_text_style[]','button_one_color',
				'button_two_color', 'but_one_link_open', 'but_two_link_open')
		);

		foreach ($fullpage_hide as $layout=>$hide_options) {
			foreach ($hide_options as $key=>$option) {
				$hide_options[$key]=PEXETO_CUSTOM_PREFIX.$option;
			}
			$fullpage_hide[$layout] = implode(',', $hide_options);
		}

		foreach ($content_hide as $layout=>$hide_options) {
			foreach ($hide_options as $key=>$option) {
				$hide_options[$key]=PEXETO_CUSTOM_PREFIX.$option;
			}
			$content_hide[$layout] = implode(',', $hide_options);
		}

		$font_options = pexeto_get_font_options();
		$style_options = array(
						array('id'=>'italic', 'name'=>'Italic'),
						array('id'=>'bold', 'name'=>'Bold'),
						array('id'=>'uppercase', 'name'=>'Uppercase')
					);

		$align_options = PexetoCustomCssGenerator::$align_options;

		//define the custom pages - this is the main array that defines the structure of each of the custom pages
		$pexeto->custom_pages=array( 

		
			PEXETO_FULLPAGESLIDER_POSTTYPE=>
			new PexetoCustomPage( PEXETO_FULLPAGESLIDER_POSTTYPE, array(
				array('id'=>'slide_type', 'name'=>'Slide Type', 'type'=>'select', 'two-column'=>'first', 'options'=>array(
						array('id' => 'text', 'name'=>'Text Only', 'hide'=>$fullpage_hide['text']),
						array('id' => 'textimg', 'name'=>'Text + Content Image', 'hide'=>$fullpage_hide['textimg']),
						array('id' => 'slider', 'name' => 'Image Slider', 'hide'=>$fullpage_hide['slider']),
						array('id' => 'video', 'name' => 'Video Background', 'hide'=>$fullpage_hide['video'])
					)),
				array('id'=>'text_layout', 'name'=>'Layout', 'type'=>'select', 'two-column'=>'last-one', 'options'=>$align_options),
				array('id'=>'image_layout', 'name'=>'Layout', 'type'=>'select', 'two-column'=>'last', 'options'=>array(
						array('id'=>'left', 'name'=> 'Image left - Text right'),
						array('id'=>'right', 'name'=> 'Image right - Text left'),
						array('id'=>'top', 'name'=> 'Image top - Text bottom'),
						array('id'=>'bottom', 'name'=> 'Image bottom - Text top')
					)),
				array( 'id'=>'slide_video_mp4', 'type'=>'videoupload', 'name'=>'Video MP4', 'two-column'=>'first' ),
				array( 'id'=>'slide_video_webm', 'type'=>'videoupload', 'name'=>'Video WebM', 'two-column'=>'last' ),
				array( 'id'=>'slide_video_ogg', 'type'=>'videoupload', 'name'=>'Video Ogg (optional)', 'two-column'=>'first' ),
				array( 'id'=>'mobile_background_image', 'type'=>'upload', 'name'=>'Mobile Devices Background Image', 'two-column'=>'last' ),
				array( 'id'=>'slide_background_image', 'type'=>'upload', 'name'=>'Background Image', 'two-column'=>'first' ),
				array( 'id'=>'background_color', 'type'=>'colorpick', 'name'=>'Background Color', 'two-column'=>'last' ),
				array( 'id'=>'images', 'type'=>'multiupload', 'name'=>'Images', 'required'=>true),
				array( 'id'=>'slide_title', 'type'=>'text', 'name'=>'Slide Title', 'two-column'=>'first' ),
				array( 'id'=>'slide_description', 'type'=>'textarea', 'name'=>'Slide Description', 'two-column'=>'last' ),
				array( 'id'=>'content_image', 'type'=>'upload', 'name'=>'Content Image' ),
				array( 'id'=>'button_text', 'type'=>'text', 'name'=>'Button text', 'two-column'=>'first' ),
				array( 'id'=>'button_link', 'type'=>'text', 'name'=>'Button link', 'two-column'=>'last' ),
				array( 'id'=>'slide_style', 'type'=>'select', 'name'=>'Slide Settings', 'options'=>array(
						array('id'=>'default', 'name'=> 'Default Settings', 'hide'=>$fullpage_hide['default_style']),
						array('id'=>'custom', 'name'=> 'Custom Settings')
					)),
				array('id'=>'bg_align', 'name'=>'Background Image Alignment', 'type'=>'select', 'options'=>$align_options),
				array('id'=>'title_color', 'name'=>'Title Color', 'type'=>'colorpick', 'default'=>'ffffff', 'two-column'=>'first'),
				array('id'=>'title_text_style', 'name'=>'Title Text Style', 'type'=>'checkbox', 'two-column'=>'last', 'options'=>$style_options),
				array('id'=>'title_font', 'name'=>'Title Font', 'type'=>'select', 'options'=>$font_options, 'two-column'=>'first'),
				array('id'=>'title_font_size', 'name'=>'Title Font Size', 'type'=>'text', 'default'=>'40', 'suffix'=>'px', 'two-column'=>'last'),
				array('id'=>'description_color', 'name'=>'Description Color', 'default'=>'ffffff', 'type'=>'colorpick', 'two-column'=>'first'),
				array('id'=>'description_text_style', 'name'=>'Description Text Style', 'type'=>'checkbox', 'two-column'=>'last', 'options'=>$style_options),
				array('id'=>'description_font', 'name'=>'Description Font', 'type'=>'select', 'options'=>$font_options, 'two-column'=>'first'),
				array('id'=>'description_font_size', 'name'=>'Description Font Size', 'default'=>'14', 'type'=>'text', 'suffix'=>'px', 'two-column'=>'last'),
				array( 'id'=>'button_color', 'type'=>'colorpick', 'name'=>'Button Color', 'two-column'=>'first' ),
				array( 'id'=>'button_link_open', 'type'=>'select', 'name'=>'Open Button Link In', 'options'=>array(array('id'=>'same', 'name'=>'Same tab / window'), array('id'=>'new', 'name'=>'New tab / window')), 'two-column'=>'last' )

				), 'Fullscreen Slider', true, PEXETO_OPTIONS_PAGE, 
				//preview data
				array(
					'condition'=>'slide_type',
					'text'=>array('slide_background_image', 'slide_type', 'slide_title'),
					'textimg'=>array('content_image', 'slide_background_image', 'slide_type', 'slide_title'),
					'slider'=>array('slide_type', 'images'),
					'video'=>array('slide_type', 'slide_title')
					)
				, 'data', '', false ),


				PEXETO_CONTENTSLIDER_POSTTYPE=>
			new PexetoCustomPage( PEXETO_CONTENTSLIDER_POSTTYPE, array(
					array( 'id'=>'layout', 'type'=>'select', 'name'=>'Slide Layout', 'two-column'=>'first', 'options'=>array(
						array('id'=>'centered', 'name'=>'Centered Text', 'hide'=>PEXETO_CUSTOM_PREFIX.'image_url,'.PEXETO_CUSTOM_PREFIX.'video_url'), 
						array('id'=>'img-text', 'name'=>'Image left - Text right', 'hide'=>PEXETO_CUSTOM_PREFIX.'video_url'),
						array('id'=>'text-img', 'name'=>'Image right - Text left', 'hide'=>PEXETO_CUSTOM_PREFIX.'video_url'),
						array('id'=>'video-text', 'name'=>'YouTube video left - text right', 'hide'=>PEXETO_CUSTOM_PREFIX.'image_url'),
						array('id'=>'text-video', 'name'=>'YouTube video right - text left', 'hide'=>PEXETO_CUSTOM_PREFIX.'image_url'),
						)),
					array( 'id'=>'animation', 'type'=>'select', 'name'=>'Slide Animation', 'two-column'=>'last', 'options'=>array(
						array('id'=>'random', 'name'=>'Random'),
						array('id'=>'slideLeft', 'name'=>'Slide Left'),
						array('id'=>'slideRight', 'name'=>'Slide Right'),
						array('id'=>'slideUp', 'name'=>'Slide Up'),
						array('id'=>'slideDown', 'name'=>'Slide Down'))),
					array( 'id'=>'bg_color', 'type'=>'colorpick', 'name'=>'Custom Slide Background Color', 'two-column'=>'first'),
					array( 'id'=>'text_color', 'type'=>'colorpick', 'name'=>'Custom Slide Text Color', 'two-column'=>'last'),
					array( 'id'=>'bg_image_url', 'type'=>'upload', 'name'=>'Background Image', 'two-column'=>'first'),
					array( 'id'=>'bg_image_opacity', 'type'=>'select', 'name'=>'Background Image Opacity', 'options'=>$opacity_options, 'two-column'=>'last', 'std'=>'0.5'),
					array( 'id'=>'image_url', 'type'=>'upload', 'name'=>'Main Image (optional)'),
					array( 'id'=>'video_url', 'type'=>'text', 'video'=>true, 'name'=>'YouTube Video URL', 'desc'=>'example: http://www.youtube.com/watch?v=YE7VzlLtp-4'),
					array( 'id'=>'small_title', 'type'=>'text', 'name'=>'Small Title', 'two-column'=>'first'),
					array( 'id'=>'main_title', 'type'=>'text', 'name'=>'Main Title', 'two-column'=>'last' ),
					array( 'id'=>'description', 'type'=>'textarea', 'name'=>'Description' ),
					array( 'id'=>'but_one_text', 'type'=>'text', 'name'=>'Button one text', 'two-column'=>'first' ),
					array( 'id'=>'but_one_link', 'type'=>'text', 'name'=>'Button one link', 'two-column'=>'last' ),
					array( 'id'=>'but_two_text', 'type'=>'text', 'name'=>'Button two text', 'two-column'=>'first' ),
					array( 'id'=>'but_two_link', 'type'=>'text', 'name'=>'Button two link', 'two-column'=>'last' ),
					array( 'id'=>'slide_style', 'type'=>'select', 'name'=>'Slide Settings', 'options'=>array(
						array('id'=>'default', 'name'=> 'Default Settings', 'hide'=>$content_hide['default_style']),
						array('id'=>'custom', 'name'=> 'Custom Settings')
					)),
					array('id'=>'bg_align', 'name'=>'Background Image Alignment', 'type'=>'select', 'options'=>$align_options, 'two-column'=>'first'),
					array('id'=>'bg_style', 'name'=>'Background Style', 'type'=>'select', 'options'=>array(array('id'=>'default','name'=>'Parallax Cover'), array('id'=>'cover','name'=>'Cover'), array('id'=>'contain','name'=>'Contain')), 'two-column'=>'last'),
					array('id'=>'title_font', 'name'=>'Main Title Font', 'type'=>'select', 'options'=>$font_options, 'three-column'=>'first'),
					array('id'=>'title_font_size', 'name'=>'Main Title Font Size', 'type'=>'text', 'default'=>'60', 'suffix'=>'px', 'three-column'=>'second'),
					array('id'=>'title_text_style', 'name'=>'Main Title Text Style', 'type'=>'checkbox', 'three-column'=>'last', 'options'=>$style_options, 'default'=>'bold,uppercase'),
					array('id'=>'subtitle_font', 'name'=>'Small Title Font', 'type'=>'select', 'options'=>$font_options, 'three-column'=>'first'),
					array('id'=>'subtitle_font_size', 'name'=>'Small Title Font Size', 'type'=>'text', 'default'=>'15', 'suffix'=>'px', 'three-column'=>'second'),
					array('id'=>'subtitle_text_style', 'name'=>'Small Title Text Style', 'type'=>'checkbox', 'three-column'=>'last', 'options'=>$style_options, 'default'=>'uppercase'),
					array('id'=>'description_font', 'name'=>'Description Font', 'type'=>'select', 'options'=>$font_options, 'three-column'=>'first'),
					array('id'=>'description_font_size', 'name'=>'Description Font Size', 'default'=>'14', 'type'=>'text', 'suffix'=>'px', 'three-column'=>'second'),
					array('id'=>'description_text_style', 'name'=>'Description Text Style', 'type'=>'checkbox', 'three-column'=>'last', 'options'=>$style_options),
					array( 'id'=>'button_one_color', 'type'=>'colorpick', 'name'=>'Button One Color', 'two-column'=>'first' ),
					array( 'id'=>'but_one_link_open', 'type'=>'select', 'name'=>'Button One Open Link In', 'options'=>array(array('id'=>'same', 'name'=>'Same tab / window'), array('id'=>'new', 'name'=>'New tab / window')), 'two-column'=>'last' ),
					array( 'id'=>'button_two_color', 'type'=>'colorpick', 'name'=>'Button Two Color', 'two-column'=>'first'),
					array( 'id'=>'but_two_link_open', 'type'=>'select', 'name'=>'Button Two Open Link In', 'options'=>array(array('id'=>'same', 'name'=>'Same tab / window'), array('id'=>'new', 'name'=>'New tab / window')), 'two-column'=>'last' ),
				), 'Content Slider', true, PEXETO_OPTIONS_PAGE, array('image_url','bg_image_url','video_url', 'main_title', 'description'), PEXETO_SLIDER_TYPE, 'slider-content.php', false ),


			PEXETO_NIVOSLIDER_POSTTYPE=>
			new PexetoCustomPage( PEXETO_NIVOSLIDER_POSTTYPE, array(
					array( 'id'=>'image_url', 'type'=>'upload', 'name'=>'Image', 'required'=>true ),
					array( 'id'=>'image_link', 'type'=>'text', 'name'=>'Image Link', 'two-column'=>'first' ),
					array( 'id'=>'image_link_open', 'type'=>'select', 'name'=>'Open link in', 'options'=>array(array('id'=>'same', 'name'=>'Same tab / window'), array('id'=>'new', 'name'=>'New tab / window')), 'two-column'=>'last' ),
					array( 'id'=>'description', 'type'=>'textarea', 'name'=>'Image Description' )
				), 'Fade Slider', true, PEXETO_OPTIONS_PAGE, array('image_url'), PEXETO_SLIDER_TYPE, 'slider-nivo.php', true ),

			PEXETO_SERVICES_POSTTYPE=>
			new PexetoCustomPage( PEXETO_SERVICES_POSTTYPE, array(
					array( 'id'=>'box_title', 'type'=>'text', 'name'=>'Title' ),
					array( 'id'=>'box_image', 'type'=>'upload', 'name'=>'Image' ),
					array( 'id'=>'box_link', 'type'=>'text', 'name'=>'Link', 'two-column'=>'first' ),
					array( 'id'=>'box_link_open', 'type'=>'select', 'name'=>'Open link in', 'options'=>array(array('id'=>'same', 'name'=>'Same tab / window'), array('id'=>'new', 'name'=>'New tab / window')), 'two-column'=>'last' ),
					array( 'id'=>'box_desc', 'type'=>'textarea', 'name'=>'Description' )
				), 'Services Boxes', true, PEXETO_OPTIONS_PAGE, array('box_image', 'box_title', 'box_desc'), 'data', '', false, 'Services Box Set' ),

			PEXETO_TESTIMONIALS_POSTTYPE=>
			new PexetoCustomPage( PEXETO_TESTIMONIALS_POSTTYPE, array(
					array( 'id'=>'name', 'type'=>'text', 'name'=>'Person Name', 'required'=>true ),
					array( 'id'=>'testimonial', 'type'=>'textarea', 'name'=>'Testimonial', 'required'=>true ),
					array( 'id'=>'image', 'type'=>'upload', 'name'=>'Person Image' ),
					array( 'id'=>'occupation', 'type'=>'text', 'name'=>'Occupation' ),
					array( 'id'=>'organization', 'type'=>'text', 'name'=>'Organization' ),
					array( 'id'=>'organization_link', 'type'=>'text', 'name'=>'Organization Link' ),

					
				), 'Testimonials', true, PEXETO_OPTIONS_PAGE, array('image', 'name', 'testimonial'), 'data', '', false, 'Testimonials Set' ),

			PEXETO_PRICING_POSTTYPE=>
			new PexetoCustomPage( PEXETO_PRICING_POSTTYPE, array(
					array( 'id'=>'item_title', 'type'=>'text', 'name'=>'Item Title', 'required'=>true, 'two-column'=>'first' ),
					array( 'id'=>'highlight', 'type'=>'checkbox', 'name'=>'Highlight Item', 'options'=>array(array('id'=>'true', 'name'=>'Highlight')), 'two-column'=>'last'),
					array( 'id'=>'price', 'type'=>'text', 'name'=>'Item Price', 'two-column'=>'first' ),
					array( 'id'=>'price_period', 'type'=>'text', 'name'=>'Price Period', 'default'=>'per month', 'two-column'=>'last' ),
					array( 'id'=>'currency', 'type'=>'text', 'name'=>'Currency', 'default'=>'$', 'two-column'=>'first' ),
					array( 'id'=>'currency_position', 'type'=>'select', 'name'=>'Currency Position', 'options'=>array(array('id'=>'left', 'name'=>'Left ($99)'), array('id'=>'right', 'name'=>'Right (99$)')), 'two-column'=>'last' ),
					array( 'id'=>'description', 'type'=>'textarea', 'name'=>'Item Features', 'desc'=>'Add each feature on a new line, example:<br/>Feature One<br/>Feature Two<br/>Feature Three' ),
					array( 'id'=>'button_text', 'type'=>'text', 'name'=>'Button text', 'three-column'=>'first' ),
					array( 'id'=>'button_link', 'type'=>'text', 'name'=>'Button link', 'three-column'=>'second' ),
					array( 'id'=>'button_link_open', 'type'=>'select', 'name'=>'Open link in', 'options'=>array(array('id'=>'same', 'name'=>'Same tab / window'), array('id'=>'new', 'name'=>'New tab / window')), 'three-column'=>'last' ),
				), 'Pricing Tables', true, PEXETO_OPTIONS_PAGE, array('item_title', 'price'), 'data', '', false, 'Pricing Table' ),
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
	define( 'PEXETO_UPDATE_XML_FILE', 'http://pexeto.com/updates/story.xml' );
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
	            'name'      => 'WooCommerce',
	            'slug'      => 'woocommerce',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Story Recent Posts Widget',
	            'slug'      => 'story-recent-posts',
	            'source'    => get_template_directory() . '/plugins/story-recent-posts.zip',
	            'required'  => false
	        ),
	        array(
	            'name'      => 'Simple Google Map',
	            'slug'      => 'simple-google-map',
	            'required'  => false
	        ),
	        array(
	            'name'      => 'Story Portfolio Items Widget',
	            'slug'      => 'story-portfolio-items',
	            'source'    => get_template_directory() . '/plugins/story-portfolio-items.zip',
	            'required'  => false
	        )
	    );

		$theme_text_domain = 'pexeto';

		$config = array(
		    'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_slug'       => 'themes.php', 				// Default parent menu slug
			'menu'         		=> 'tgmpa-install-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> ''
	    );
	 
	    tgmpa( $plugins, $config );
	}
}



/*******************************************************************************
 * DEMO IMPORTER
 ******************************************************************************/

if(!function_exists('pexeto_init_demo_importer')){

	/**
	 * Inits the one click demo import functionality.
	 */
	function pexeto_init_demo_importer(){
		global $pexeto;

		$demos = array(
			'main'=>array('id'=>'main', 'title'=>'Main Demo', 'frontpage'=>'full-page-slider', 'menus'=>array('pexeto_main_menu'=>'story-main-menu', 'pexeto_footer_menu'=>'story-footer-menu')),
			'lifestyle' => array('id'=>'lifestyle', 'title'=>'Health & Lifestyle', 'frontpage'=>'home', 'menus'=>array('pexeto_main_menu'=>'main')),
			'photography'=>array('id'=>'photography', 'title'=>'Photography', 'frontpage'=>'home', 'menus'=>array('pexeto_main_menu'=>'main', 'pexeto_footer_menu'=>'main')),
			'restaurant'=>array('id'=>'restaurant', 'title'=>'Food & Restaurant', 'frontpage'=>'home', 'menus'=>array('pexeto_main_menu'=>'main', 'pexeto_footer_menu'=>'main')),
			'vintage'=>array('id'=>'vintage', 'title'=>'Vintage', 'frontpage'=>'home', 'menus'=>array('pexeto_main_menu'=>'story-main-menu', 'pexeto_footer_menu'=>'story-footer-menu')),
			'agency'=>array('id'=>'agency', 'title'=>'Agency', 'frontpage'=>'home', 'menus'=>array('pexeto_main_menu'=>'main', 'pexeto_footer_menu'=>'main')),
			'business'=>array('id'=>'business', 'title'=>'Creative Business', 'frontpage'=>'home', 'menus'=>array('pexeto_main_menu'=>'main-menu', 'pexeto_footer_menu'=>'main-menu'))
		);
		$demo_folder = get_template_directory().'/includes/demo-data';
		$demo_folder_url = get_template_directory_uri().'/includes/demo-data';
		$map_widgets = array('widget_story_portfolio_items', 'widget_story_recent_posts');

		$pexeto->demo_import_manager = new PexetoImportManager($demos, $demo_folder, $demo_folder_url, PEXETO_OPTIONS_PAGE, PEXETO_OPTIONS_KEY, $map_widgets);
	}
}

if(is_admin()){
	pexeto_init_demo_importer();
}


