<?php

/*------------------------------------
 * Add link for customize.php in admin bar
 *------------------------------------*/

if( current_user_can('edit_theme_options') ){
	add_action( 'admin_bar_menu', 'add_customize_link', 40 );
}

function add_customize_link($admin_bar) {
	$admin_bar->add_menu( array(
		'id'    => 'customize-link',
		'title' => __('Customize Theme','sleek'),
		'href'  => admin_url().'customize.php',
		'meta'  => array(
			'title' => __('Sleek Theme Customizer','sleek'),
		),
	));
}



/*------------------------------------
 * Enqueue additional styles and scripts
 *------------------------------------*/

add_action('customize_controls_enqueue_scripts', 'sleek_load_customize_controls_assets');
add_action('customize_controls_enqueue_scripts', 'sleek_load_bg_control');

function sleek_load_customize_controls_assets($hook_suffix){

	// Chosen jQuery
	wp_register_style('sleek_customize_control_chosen_style', THEME_ADMIN_URI . '/assets/chosen/chosen.min.css', array(), sleek_version(), 'all');
	wp_enqueue_style('sleek_customize_control_chosen_style');

	wp_register_script('sleek_customize_control_chosen_script', THEME_ADMIN_URI . '/assets/chosen/chosen.jquery.min.js', array('jquery'), sleek_version(), 'all', true);
	wp_enqueue_script('sleek_customize_control_chosen_script');

	// Sleek custom style
	wp_register_style('sleek_customize_control_custom_style', THEME_CUSTOMIZE_URI . '/assets/css/customize_control_custom_style.css', array(), sleek_version(), 'all');
	wp_enqueue_style('sleek_customize_control_custom_style');

	wp_enqueue_media();

	wp_register_script('sleek_customize_control_custom_script', THEME_CUSTOMIZE_URI . '/assets/js/customize_control_custom_script.js', array('jquery'), sleek_version(), 'all', true);
	wp_enqueue_script('sleek_customize_control_custom_script');
}

function sleek_load_bg_control($hook_suffix){
	wp_enqueue_style( 'wp-color-picker' );
}



/*------------------------------------
 * Define Theme Settings
 *------------------------------------*/

add_action( 'customize_register', 'sleek_theme_customize' );

function sleek_theme_customize($wp_customize) {



/*------------------------------------
 * Include custom controls
 *------------------------------------*/

include_once('customize_controls/category_dropdown.php');
include_once('customize_controls/bg_control.php');
include_once('customize_controls/font_control.php');



/*------------------------------------
 * General Settings
 *------------------------------------*/

$wp_customize->add_section( 'general_settings', array(
	'title'		=> __('General Settings', 'sleek'),
	'priority'	=> 35,
));

// Logo
$wp_customize->add_setting( 'logo', array(
	'default'	=> THEME_IMG_URI . '/logo.png',
	'transport'	=> 'postMessage',
	'sanitize-callback' => 'esc_url_raw'
));

$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize,
		'logo',
		array(
			'label'		=> __( 'Upload the logo', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'logo',
			'priority' 	=> 10,
		)
	)
);

// Favicon
$wp_customize->add_setting( 'favicon', array(
	'default'	=> THEME_IMG_URI . '/favicon.ico',
	'sanitize-callback' => 'esc_url_raw'
));

$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize,
		'favicon',
		array(
			'label'		=> __( 'Upload the favicon [16x16]', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'favicon',
			'priority' 	=> 13,
		)
	)
);

// Apple Touch Icon
$wp_customize->add_setting( 'touch', array(
	'default'	=> THEME_IMG_URI . '/touch.png',
	'sanitize-callback' => 'esc_url_raw'
));

$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize,
		'touch',
		array(
			'label'		=> __( 'Upload the apple touch icon [144x144]', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'touch',
			'priority' 	=> 16,
		)
	)
);

// Header Search
$wp_customize->add_setting( 'header_search', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'header_search',
		array(
			'label'		=> __( 'Use Search in Header', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'header_search',
			'type'		=> 'checkbox',
			'priority' 	=> 20,
		)
	)
);

// AJAX Load Pages
$wp_customize->add_setting( 'ajax_load_pages', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'ajax_load_pages',
		array(
			'label'		=> __( 'Load Pages with Ajax', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'ajax_load_pages',
			'type'		=> 'checkbox',
			'priority' 	=> 30
		)
	)
);

// AJAX Load Pages
$wp_customize->add_setting( 'init_load_animation', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'init_load_animation',
		array(
			'label'		=> __( 'Show Initial Preloader Animation', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'init_load_animation',
			'type'		=> 'checkbox',
			'priority' 	=> 35
		)
	)
);

// Open Graph
$wp_customize->add_setting( 'open_graph_use', array(
	'default'	=> true,
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'open_graph_use',
		array(
			'label'		=> __( 'Use Facebook Open Graph meta tags', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'open_graph_use',
			'type'		=> 'checkbox',
			'priority' 	=> 45,
		)
	)
);

// Copyright
$wp_customize->add_setting( 'copyright', array(
	'default'	=> 'Copyright, 2014',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'copyright',
		array(
			'label'		=> __( 'Copyright', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'copyright',
			'type'		=> 'text',
			'priority' 	=> 50,
		)
	)
);



// Sidebar title
$wp_customize->add_setting( 'sidebar_title', array(
	'default'	=> __('General', 'sleek'),
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

// header width control
$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'sidebar_title',
		array(
			'label'		=> __( 'Title for widgets tab in sidebar', 'sleek' ),
			'section'	=> 'general_settings',
			'settings'	=> 'sidebar_title',
			'priority' 	=> 60,
		)
	)
);


/*------------------------------------
 * Layout Settings
 *------------------------------------*/

$wp_customize->add_section( 'layout_settings', array(
	'title'		=> __('Layout Settings', 'sleek'),
	'priority'	=> 40,

));





// header width setting
$wp_customize->add_setting( 'header_width', array(
	'default'	=> '250',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

// header width control
$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'header_width',
		array(
			'label'		=> __( 'Set header width on desktop', 'sleek' ),
			'section'	=> 'layout_settings',
			'settings'	=> 'header_width',
			'priority' 	=> 10,
		)
	)
);



// Use sidebar
$wp_customize->add_setting( 'use_sidebar', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'use_sidebar',
		array(
			'label'		=> __( 'Use sidebar', 'sleek' ),
			'section'	=> 'layout_settings',
			'settings'	=> 'use_sidebar',
			'type'		=> 'checkbox',
			'priority' 	=> 20,
		)
	)
);



// Independent Sidebar
$wp_customize->add_setting( 'independent_sidebar', array(
	'default'	=> true,
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'independent_sidebar',
		array(
			'label'		=> __( 'Sidebar scrolls independently', 'sleek' ),
			'section'	=> 'layout_settings',
			'settings'	=> 'independent_sidebar',
			'type'		=> 'checkbox',
			'priority' 	=> 30,
		)
	)
);



// Comments in sidebar
$wp_customize->add_setting( 'comments_in_sidebar', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'comments_in_sidebar',
		array(
			'label'		=> __( 'Place Comments in Sidebar', 'sleek' ),
			'section'	=> 'layout_settings',
			'settings'	=> 'comments_in_sidebar',
			'type'		=> 'checkbox',
			'priority' 	=> 40,
		)
	)
);




// Sidebar width setting
$wp_customize->add_setting( 'sidebar_width', array(
	'default'	=> '304',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

// sidebar width control
$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'sidebar_width',
		array(
			'label'		=> __( 'Sidebar width.', 'sleek' ),
			'section'	=> 'layout_settings',
			'settings'	=> 'sidebar_width',
			'priority' 	=> 50,
		)
	)
);



// Sidebar width setting for big screens
$wp_customize->add_setting( 'sidebar_width_big', array(
	'default'	=> '401',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

// sidebar width control
$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'sidebar_width_big',
		array(
			'label'		=> __( 'Sidebar width for big screens (1400px +).', 'sleek' ),
			'section'	=> 'layout_settings',
			'settings'	=> 'sidebar_width_big',
			'priority' 	=> 60,
		)
	)
);




/*------------------------------------
 * Style Settings
 *------------------------------------*/

$wp_customize->add_panel( 'style_settings', array(
	'title'		=> __('Style Settings', 'sleek'),
	'priority'	=> 45,
	'sanitize-callback' => ''
));



/* Colors
 *------------------------------------*/

$wp_customize->add_section( 'color_settings', array(
	'title'		=> __('Colors', 'sleek'),
	'panel'		=> 'style_settings',
	'priority'	=> 10,
	'description' => __('If Live Preview doesn\'t react to color changes, save new settings and reload to see updates.','sleek'),
	'sanitize-callback' => ''
));

// Primary Color
$wp_customize->add_setting( 'color_primary', array(
	'default' => '#FF4D4D',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_primary',
		array(
			'label'		=> __( 'Color: Primary', 'sleek' ),
			'description' => __('Main accent color. Used for links, buttons and accented elements.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_primary',
			'priority' 	=> 10
		)
	)
);

// White
$wp_customize->add_setting( 'color_white', array(
	'default'	=> '#FFFFFF',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_white',
		array(
			'label'		=> __( 'Color: White', 'sleek' ),
			'description' => __('Main white color. Used for post backgrounds, image overlaid font-color, hover on various elements.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_white',
			'priority' 	=> 20
		)
	)
);

// Grey Pale
$wp_customize->add_setting( 'color_grey_pale', array(
	'default'	=> '#f5f5f5',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_grey_pale',
		array(
			'label'		=> __( 'Color: Pale Grey', 'sleek' ),
			'description' => __('Used as a background on comments in main content area, highlighted text/paragraph and code blocks.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_grey_pale',
			'priority' 	=> 25
		)
	)
);

// Grey Light
$wp_customize->add_setting( 'color_grey_light', array(
	'default'	=> '#cecece',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_grey_light',
		array(
			'label'		=> __( 'Color: Light Grey', 'sleek' ),
			'description' => __('Used for post meta info, widget titles and styled textual elements/labels.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_grey_light',
			'priority' 	=> 30
		)
	)
);

// Sidebar Grey
$wp_customize->add_setting( 'color_grey_sidebar', array(
	'default'	=> '#aaaaaa',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_grey_sidebar',
		array(
			'label'		=> __( 'Color: Dark Background Text', 'sleek' ),
			'description' => __('Main font color on dark backgrounds. Primary used for sidebar text.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_grey_sidebar',
			'priority' 	=> 35
		)
	)
);

// Grey
$wp_customize->add_setting( 'color_grey', array(
	'default'	=> '#777777',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_grey',
		array(
			'label'		=> __( 'Color: Text', 'sleek' ),
			'description' => __('Main body-font color. Used mostly for typography.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_grey',
			'priority' 	=> 40
		)
	)
);

// Black
$wp_customize->add_setting( 'color_black', array(
	'default'	=> '#3F3F53',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,
		'color_black',
		array(
			'label'		=> __( 'Color: Black', 'sleek' ),
			'description' => __('Main black color. Used for titles, bolding, various links, buttons and hovers.', 'sleek'),
			'section'	=> 'color_settings',
			'settings'	=> 'color_black',
			'priority' 	=> 50
		)
	)
);



/* Backgrounds
 *------------------------------------*/

$wp_customize->add_section( 'bg_settings', array(
	'title'		=> __('Backgrounds', 'sleek'),
	'panel'		=> 'style_settings',
	'priority'	=> 20,
	'sanitize-callback' => ''
));

// Header Bg
$wp_customize->add_setting( 'bg_header', array(
	'default'	=> '#f5f5f5',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Bg_Control($wp_customize,
		'bg_header',
		array(
			'label'		=> __( 'Background: Header', 'sleek' ),
			'section'	=> 'bg_settings',
			'settings'	=> 'bg_header',
			'priority' 	=> 60
		)
	)
);

// Header Bg Light/Dark
$wp_customize->add_setting( 'bg_header_dark', array(
	'default'	=> false,
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'bg_header_dark',
		array(
			'label'		=> __( 'Header is dark', 'sleek' ),
			'section'	=> 'bg_settings',
			'settings'	=> 'bg_header_dark',
			'type'		=> 'checkbox',
			'priority' 	=> 65
		)
	)
);

// Content Bg
$wp_customize->add_setting( 'bg_content', array(
	'default'	=> '#ffffff',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Bg_Control($wp_customize,
		'bg_content',
		array(
			'label'		=> __( 'Background: Main Content', 'sleek' ),
			'section'	=> 'bg_settings',
			'settings'	=> 'bg_content',
			'priority' 	=> 70
		)
	)
);

// Sidebar Bg
$wp_customize->add_setting( 'bg_sidebar', array(
	'default'	=> '#23222d',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Bg_Control($wp_customize,
		'bg_sidebar',
		array(
			'label'		=> __( 'Background: Sidebar', 'sleek' ),
			'section'	=> 'bg_settings',
			'settings'	=> 'bg_sidebar',
			'priority' 	=> 80
		)
	)
);

// Sidebar Bg Light/Dark
$wp_customize->add_setting( 'bg_sidebar_dark', array(
	'default'	=> true,
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'bg_sidebar_dark',
		array(
			'label'		=> __( 'Sidebar is dark', 'sleek' ),
			'section'	=> 'bg_settings',
			'settings'	=> 'bg_sidebar_dark',
			'type'		=> 'checkbox',
			'priority' 	=> 80
		)
	)
);

// Masonry & Newspaper Bg
$wp_customize->add_setting( 'bg_masonry', array(
	'default'	=> '#f5f5f5',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Bg_Control($wp_customize,
		'bg_masonry',
		array(
			'label'		=> __( 'Background: Masonry & Newspaper', 'sleek' ),
			'section'	=> 'bg_settings',
			'settings'	=> 'bg_masonry',
			'priority' 	=> 90
		)
	)
);



/*------------------------------------
 * Typography Settings
 *------------------------------------*/

$wp_customize->add_section( 'typography_settings', array(
	'title'		=> __('Typography', 'sleek'),
	'panel' 	=> 'style_settings',
	'priority'	=> 30,
	'description'	=> __('Choose Font Family, style, and font size / line height','sleek')
));



// Font: Body
$wp_customize->add_setting( 'font_body', array(
	'default'	=> 'Source Sans Pro|300|16|1.4',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_body',
		array(
			'label'		=> __( 'Main Body', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_body',
			'priority' 	=> 10,
		)
	)
);

// Font: Navigation
$wp_customize->add_setting( 'font_navigation', array(
	'default'	=> 'Montserrat|regular|16|1',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_navigation',
		array(
			'label'		=> __( 'Navigation', 'sleek' ),
			'description' => __('Font used for header navigation, widget titles, post-meta and styled labels.', 'sleek'),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_navigation',
			'priority' 	=> 20,
		)
	)
);

// Font: Custom Heading
$wp_customize->add_setting( 'font_custom_heading', array(
	'default'	=> 'Montserrat|regular|20|1',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_custom_heading',
		array(
			'label'		=> __( 'Custom Heading', 'sleek' ),
			'description' => __('Font used for "custom heading" shortcode.', 'sleek'),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_custom_heading',
			'priority' 	=> 30,
		)
	)
);

// Font: H1
$wp_customize->add_setting( 'font_h1', array(
	'default'	=> 'Source Sans Pro|200|52|1.05',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_h1',
		array(
			'label'		=> __( 'H1', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_h1',
			'priority' 	=> 40,
		)
	)
);

// Font: H2
$wp_customize->add_setting( 'font_h2', array(
	'default'	=> 'Source Sans Pro|200|42|1.3',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_h2',
		array(
			'label'		=> __( 'H2', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_h2',
			'priority' 	=> 50,
		)
	)
);

// Font: H3
$wp_customize->add_setting( 'font_h3', array(
	'default'	=> 'Source Sans Pro|300|32|1.4',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_h3',
		array(
			'label'		=> __( 'H3', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_h3',
			'priority' 	=> 60,
		)
	)
);

// Font: H4
$wp_customize->add_setting( 'font_h4', array(
	'default'	=> 'Source Sans Pro|300|28|1.4',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_h4',
		array(
			'label'		=> __( 'H4', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_h4',
			'priority' 	=> 70,
		)
	)
);

// Font: H5
$wp_customize->add_setting( 'font_h5', array(
	'default'	=> 'Source Sans Pro|300|22|1.4',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_h5',
		array(
			'label'		=> __( 'H5', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_h5',
			'priority' 	=> 80,
		)
	)
);

// Font: H6
$wp_customize->add_setting( 'font_h6', array(
	'default'	=> 'Source Sans Pro|300|18|1.4',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Font_Control($wp_customize,
		'font_h6',
		array(
			'label'		=> __( 'H6', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'font_h6',
			'priority' 	=> 90,
		)
	)
);

// Character Set for Google Fonts
$wp_customize->add_setting( 'character_sets', array(
	'default'	=> 'latin',
	'transport'	=> 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'character_sets',
		array(
			'label'		=> __( 'Character Sets', 'sleek' ),
			'description' => __( 'Comma separated list of font character sets to be included in the font-embedding. <strong>Example: latin,latin-ext,greek,vietnamese</strong>', 'sleek' ),
			'section'	=> 'typography_settings',
			'settings'	=> 'character_sets',
			'type'		=> 'text',
			'priority' 	=> 100,
		)
	)
);



/*------------------------------------
 * Posts and Blogging Settings
 *------------------------------------*/

$wp_customize->add_panel( 'blogging_settings', array(
	'title'		=> __('Posts and Blogging Settings', 'sleek'),
	'priority'	=> 60,
));

$wp_customize->add_section( 'blogging_settings_home', array(
	'title'		=> __('Homepage', 'sleek'),
	'description'=> __('Settings for main - Latest Posts page.', 'sleek'),
	'panel'	 	=> 'blogging_settings',
	'priority'	=> 10,
));





/* Blog Home Use Sidebar
 *------------------------------------*/

// Use Sidebar
$wp_customize->add_setting( 'blog_home_sidebar_use', array(
	'default'	=> 'default',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_sidebar_use',
		array(
			'label'		=> __( 'Use Sidebar', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_sidebar_use',
			'type'		=> 'select',
			'choices'	=> array(
				'default' 	=> __( 'Default (Use Layout Setting)', 'sleek' ),
				'true' 		=> __( 'Yes (Override Layout Setting)', 'sleek' ),
				'false' 	=> __( 'No (Override Layout Setting)', 'sleek' )
			),
			'priority' 	=> 5,
		)
	)
);




/* Display
 *------------------------------------*/

// Posts Display Type
$wp_customize->add_setting( 'blog_home_display_style', array(
	'default'	=> 'list',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_display_style',
		array(
			'label'		=> __( 'Posts: Display Style', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_display_style',
			'type'		=> 'select',
			'choices'	=> array(
				'list'  	=> __( 'List', 'sleek' ),
				'masonry' 	=> __( 'Masonry', 'sleek' ),
				'newspaper' => __( 'Newspaper', 'sleek' )
			),
			'priority' 	=> 10,
		)
	)
);

// Posts Pagination
$wp_customize->add_setting( 'blog_home_pagination', array(
	'default'	=> 'pagination',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_pagination',
		array(
			'label'		=> __( 'Posts: Pagination Type', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_pagination',
			'type'		=> 'select',
			'choices'	=> array(
				'pagination'=> __( 'Classic Pagination', 'sleek'),
				'load_more' => __( 'Load More Button', 'sleek'),
				'auto' 		=> __( 'Auto Load More', 'sleek'),
				'off' 		=> __( 'No Pagination', 'sleek' )
			),
			'priority' 	=> 20,
		)
	)
);

// Featured Category
$wp_customize->add_setting( 'featured_category', array(
	'default'	=> '0',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Category_Dropdown_Control($wp_customize,
		'featured_category',
		array(
			'label'		=> __( 'Featured Posts: Category to use', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'featured_category',
			'priority' 	=> 30,
		)
	)
);

// Featured Count
$wp_customize->add_setting( 'featured_count', array(
	'default'	=> '4',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'featured_count',
		array(
			'label'		=> __( 'Featured Posts: Count (0 = no limit)', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'featured_count',
			'type'		=> 'text',
			'priority' 	=> 40,
		)
	)
);

// Featured Display Style
$wp_customize->add_setting( 'featured_style', array(
	'default'	=> 'carousel',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'featured_style',
		array(
			'label'		=> __( 'Featured Posts: Display Style', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'featured_style',
			'type'		=> 'select',
			'choices'	=> array(
				'carousel'		=> __( 'Carousel', 'sleek'),
				'slider'		=> __( 'Slider', 'sleek'),
				'slider_overlay'=> __( 'Slider Overlay', 'sleek' )
			),
			'priority' 	=> 50,
		)
	)
);

// Exclude Featured Posts
$wp_customize->add_setting( 'featured_exclude', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'featured_exclude',
		array(
			'label'		=> __( 'Exclude Featured Posts from main blog list', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'featured_exclude',
			'type'		=> 'checkbox',
			'priority' 	=> 55,
		)
	)
);



/* Posts Title
 *------------------------------------*/

// Posts Title
$wp_customize->add_setting( 'blog_home_posts_title', array(
	'default'	=> '',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_posts_title',
		array(
			'label'		=> __( 'Posts: Title', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_posts_title',
			'type'		=> 'text',
			'priority' 	=> 60,
		)
	)
);

// Posts Title Above
$wp_customize->add_setting( 'blog_home_posts_title_above', array(
	'default'	=> '',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_posts_title_above',
		array(
			'label'		=> __( 'Posts: Title Above', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_posts_title_above',
			'type'		=> 'text',
			'priority' 	=> 70,
		)
	)
);




/* Blog Home Title Header
 *------------------------------------*/

// Use Title Header
$wp_customize->add_setting( 'blog_home_title_header_use', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_title_header_use',
		array(
			'label'		=> __( 'Use Title Header', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_title_header_use',
			'type'		=> 'checkbox',
			'priority' 	=> 80,
		)
	)
);

// Title
$wp_customize->add_setting( 'blog_home_title', array(
	'default'	=> 'Latest Posts',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_title',
		array(
			'label'		=> __( 'Title Header: Title', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_title',
			'type'		=> 'text',
			'priority' 	=> 90,
		)
	)
);

// Title Above
$wp_customize->add_setting( 'blog_home_title_above', array(
	'default'	=> '',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_title_above',
		array(
			'label'		=> __( 'Title Header: Title Above', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_title_above',
			'type'		=> 'text',
			'priority' 	=> 100,
		)
	)
);

// Description
$wp_customize->add_setting( 'blog_home_description', array(
	'default'	=> '',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_description',
		array(
			'label'		=> __( 'Title Header: Description', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_description',
			'type'		=> 'text',
			'priority' 	=> 110,
		)
	)
);

// Header Background
$wp_customize->add_setting( 'blog_home_background', array(
	'default'	=> '',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new Bg_Control($wp_customize,
		'blog_home_background',
		array(
			'label'		=> __( 'Title Header: Background', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_background',
			'priority' 	=> 120,
		)
	)
);

// Header Background Darkness
$wp_customize->add_setting( 'blog_home_background_light', array(
	'default'	=> false,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'blog_home_background_light',
		array(
			'label'		=> __( 'Title Header: Background is Light', 'sleek' ),
			'section'	=> 'blogging_settings_home',
			'settings'	=> 'blog_home_background_light',
			'type'		=> 'checkbox',
			'priority' 	=> 130,
		)
	)
);





/* Archives
 *------------------------------------*/

$wp_customize->add_section( 'blogging_settings_archive', array(
	'title'		=> __('Archives', 'sleek'),
	'description'=> __('Settings for Tag, Category, Date and Author pages.', 'sleek'),
	'panel'	 	=> 'blogging_settings',
	'priority'	=> 20,
));

// Use Sidebar
$wp_customize->add_setting( 'archive_sidebar_use', array(
	'default'	=> 'default',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'archive_sidebar_use',
		array(
			'label'		=> __( 'Use Sidebar', 'sleek' ),
			'section'	=> 'blogging_settings_archive',
			'settings'	=> 'archive_sidebar_use',
			'type'		=> 'select',
			'choices'	=> array(
				'default' 	=> __( 'Default (Use Layout Setting)', 'sleek' ),
				'true' 		=> __( 'Yes (Override Layout Setting)', 'sleek' ),
				'false' 	=> __( 'No (Override Layout Setting)', 'sleek' )
			),
			'priority' 	=> 10,
		)
	)
);

// Archive Display Type
$wp_customize->add_setting( 'archive_display_style', array(
	'default'	=> 'list',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'archive_display_style',
		array(
			'label'		=> __( 'Archive: Display Style', 'sleek' ),
			'section'	=> 'blogging_settings_archive',
			'settings'	=> 'archive_display_style',
			'type'		=> 'select',
			'choices'	=> array(
				'list'  	=> __( 'List', 'sleek' ),
				'masonry' 	=> __( 'Masonry', 'sleek' ),
				'newspaper' => __( 'Newspaper', 'sleek' )
			),
			'priority' 	=> 20,
		)
	)
);

// Archive Pagination
$wp_customize->add_setting( 'archive_pagination', array(
	'default'	=> 'pagination',
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'archive_pagination',
		array(
			'label'		=> __( 'Archive: Pagination Type', 'sleek' ),
			'section'	=> 'blogging_settings_archive',
			'settings'	=> 'archive_pagination',
			'type'		=> 'select',
			'choices'	=> array(
				'pagination'=> __( 'Classic Pagination', 'sleek' ),
				'load_more' => __( 'Load More Button', 'sleek' ),
				'auto' 		=> __( 'Auto Load More', 'sleek' ),
				'off' 		=> __( 'No Pagination', 'sleek' )
			),
			'priority' 	=> 30,
		)
	)
);



/* Single Post Settings
 *------------------------------------*/

$wp_customize->add_section( 'blogging_settings_single', array(
	'title'		=> __('Single Posts', 'sleek'),
	'panel'	 	=> 'blogging_settings',
	'priority'	=> 30,
));

// Post Navigation
$wp_customize->add_setting( 'post_navigation', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_navigation',
		array(
			'label'		=> __( 'Show Post Navigation (Previous-Next)', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_navigation',
			'type'		=> 'checkbox',
			'priority' 	=> 10,
		)
	)
);

// Post Navigation from Category
$wp_customize->add_setting( 'post_navigation_category', array(
	'default'	=> false,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_navigation_category',
		array(
			'label'		=> __( 'Post Navigation is filtered to the posts of the same category only.', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_navigation_category',
			'type'		=> 'checkbox',
			'priority' 	=> 15,
		)
	)
);

// Post Tags
$wp_customize->add_setting( 'post_tags', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_tags',
		array(
			'label'		=> __( 'Show Tags', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_tags',
			'type'		=> 'checkbox',
			'priority' 	=> 20,
		)
	)
);

// Share This
$wp_customize->add_setting( 'post_share', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_share',
		array(
			'label'		=> __( 'Show Share Block', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_share',
			'type'		=> 'checkbox',
			'priority' 	=> 30,
		)
	)
);

// Post Author Block
$wp_customize->add_setting( 'post_author', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_author',
		array(
			'label'		=> __( 'Show Author Block', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_author',
			'type'		=> 'checkbox',
			'priority' 	=> 40,
		)
	)
);

// Post Related
$wp_customize->add_setting( 'post_related', array(
	'default'	=> true,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_related',
		array(
			'label'		=> __( 'Show Related Posts', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_related',
			'type'		=> 'checkbox',
			'priority' 	=> 50,
		)
	)
);

// Post Related
$wp_customize->add_setting( 'post_centralized', array(
	'default'	=> false,
	'transport'	=> 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'post_centralized',
		array(
			'label'		=> __( 'Horizontally center post elements', 'sleek' ),
			'section'	=> 'blogging_settings_single',
			'settings'	=> 'post_centralized',
			'type'		=> 'checkbox',
			'priority' 	=> 60,
		)
	)
);






/*------------------------------------
 * Advanced Settings
 *------------------------------------*/

$wp_customize->add_section( 'advanced', array(
	'title'		=> __('Advanced Settings', 'sleek'),
	'priority'	=> 70,
));



// Custom CSS
$wp_customize->add_setting( 'custom_css', array(
	'default'	=> '',
	'transport'	=> 'refresh',
	'sanitize-callback' => 'esc_textarea'
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'custom_css',
		array(
			'label'		=> __( 'Custom CSS', 'sleek' ),
			'section'	=> 'advanced',
			'settings'	=> 'custom_css',
			'type'		=> 'textarea',
			'priority' 	=> 10
		)
	)
);



// Embed Google Maps js
$wp_customize->add_setting( 'embed_gmaps_js', array(
	'default' => true,
	'transport' => 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'embed_gmaps_js',
		array(
			'label' => __( 'Embed GoogleMaps js', 'sleek' ),
			'description'=> __( 'Uncheck this field if you\'re not going to use Google Maps, so that unnecessary javascript is not loaded.' , 'sleek' ),
			'section' => 'advanced',
			'settings' => 'embed_gmaps_js',
			'type' => 'checkbox',
			'priority' => 20,
		)
	)
);



// Display pingbacks and trackbacks with comments
$wp_customize->add_setting( 'display_pingbacks', array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'display_pingbacks',
		array(
			'label' => __( 'Display pingbacks', 'sleek' ),
			'description'=> __( 'Check this field if you wish to display pingbacks and trackbacks along with the comments in the comments area.' , 'sleek' ),
			'section' => 'advanced',
			'settings' => 'display_pingbacks',
			'type' => 'checkbox',
			'priority' => 30,
		)
	)
);



// Google API
$wp_customize->add_setting( 'google_api', array(
	'default' => '',
	'transport' => 'postMessage',
	'sanitize-callback' => ''
));

$wp_customize->add_control(
	new WP_Customize_Control($wp_customize,
		'google_api',
		array(
			'label' => __( 'Google API', 'sleek' ),
			'description'=> __( 'If you have your own Google API key you wish to use for Google features brought in the theme, enter it here.' , 'sleek' ),
			'section' => 'advanced',
			'settings' => 'google_api',
			'type' => 'text',
			'priority' => 40,
		)
	)
);





/*------------------------------------
 * Call Theme Customize Preview Script
 *------------------------------------*/

if ( $wp_customize->is_preview() && !is_admin() ){
	add_action( 'customize_preview_init', 'sleek_theme_customize_preview');
}

function sleek_theme_customize_preview() {
	wp_enqueue_script('theme_customize_preview_script',
		THEME_FRAMEWORK_URI . '/theme_customize/theme_customize_preview.js',
		array( 'jquery','customize-preview' ),
		sleek_version(),
		true
	);
}



// end sleek_theme_customize
}
