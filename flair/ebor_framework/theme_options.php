<?php 

add_action('customize_register', 'ebor_theme_customize');
function ebor_theme_customize($wp_customize) {

require_once('theme_options_classes.php');

/**
 * Ebor Framework
 * Login Section
 * @since version 1.0
 * @author TommusRhodus
 */
 
$wp_customize->add_section( 'site_settings', array(
	'title'          => 'Site Settings',
	'priority'       => 20
) );

$wp_customize->add_setting( 'use_preloader', array(
    'default' => 1,
    'type' => 'option'
) );

$wp_customize->add_control( 'use_preloader', array(
    'label' => __('Use Site Preloader?', 'flair'),
    'type' => 'checkbox',
    'section' => 'site_settings',
    'priority'       => 7,
) );

$wp_customize->add_setting( 'disable_ajax', array(
    'default' => 0,
    'type' => 'option'
) );

$wp_customize->add_control( 'disable_ajax', array(
    'label' => __('Disable AJAX (animated) post loading?', 'flair'),
    'type' => 'checkbox',
    'section' => 'site_settings',
    'priority'       => 2,
) );

/**
 * Ebor Framework
 * Login Section
 * @since version 1.0
 * @author TommusRhodus
 */

/**
 * Create Header Section
 */
$wp_customize->add_section( 'custom_login_section', array(
	'title'          => 'wp-login.php Logo',
	'priority'       => 29,
) );

/**
 * Custom Logo Default
 */
$wp_customize->add_setting('custom_login_logo', array(
    'default'  => '',
    'type' => 'option'

));

/**
 * Custom Logo Control
 */
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_login_logo', array(
    'label'    => __('Custom Login Logo Upload', 'ebor_starter'),
    'section'  => 'custom_login_section',
    'priority'       => 1
)));

$wp_customize->add_setting( 'flair_fixed_header', array(
    'default' => 0,
    'type' => 'option'
) );
$wp_customize->add_control( 'flair_fixed_header', array(
    'label' => 'Make header visible at all times?',
    'type' => 'checkbox',
    'section' => 'custom_logo_section',
) );

/**
 * END LOGIN LOGO SECTION
 */
 

/**
 * Create site settings section
 * @author TommusRhodus
 * @package loom
 * @since 1.0.0
 */
$wp_customize->add_section( 'demo_data', array(
	'title'          => 'Import Demo Data',
	'priority'       => 1,
) );

/**
 * Demo Data Defaults
 */
$wp_customize->add_setting( 'import', array(
    'default'        => ''
) );

/**
 * Demo Data Control
 */
$wp_customize->add_control( new Demo_Import_control( $wp_customize, 'import', array(
    'label'   => __('Import Demo Data', 'flair'),
    'section' => 'demo_data',
    'settings'   => 'import',
    'priority' => 1,
) ) );

/**
 * END DEMO DATA SECTION
 */


///////////////////////////////////////
//     BLOG SECTION                 //
/////////////////////////////////////
	
//CREATE CUSTOM STYLING SUBSECTION
$wp_customize->add_section( 'blog_settings', array(
	'title'          => 'Blog Settings',
	'priority'       => 35,
) );

$wp_customize->add_setting( 'blog_title', array(
    'default'        => 'Our Blog',
    'type' => 'option'
) );

$wp_customize->add_control( 'blog_title', array(
    'label' => __('Blog Page Title', 'kubb'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 1,
) );

$wp_customize->add_setting( 'blog_subtitle', array(
  'default'        => 'Success is no accident. It is hard work, <strong>perseverance</strong>, learning, sacrifice and most of all, <span class="colour"><strong>love</strong></span> of what you are doing or <span class="colour">learning</span> to do.',
  'type'           => 'option',
) );

$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'blog_subtitle', array(
  'label'   => __('Blog Subtitle', 'flair'),
  'section' => 'blog_settings',
  'settings'   => 'blog_subtitle',
  'priority' => 2
) ) );

//comments TITLE
$wp_customize->add_setting( 'comments_title', array(
    'default'        => 'Would you like to share your thoughts?',
    'type' => 'option'
) );

//commentstitle
$wp_customize->add_control( 'comments_title', array(
    'label' => __('Comments Title', 'flair'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 5,
) );

//blog read more
$wp_customize->add_setting( 'blog_read_more', array(
    'default'        => 'Read More',
    'type' => 'option'
) );

//blog read more
$wp_customize->add_control( 'blog_read_more', array(
    'label' => __('Blog "Read More" Text', 'flair'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 6,
) );

//blog continue
$wp_customize->add_setting( 'author_details_title', array(
    'default'        => 'About the author',
    'type' => 'option'
) );

//blog continue
$wp_customize->add_control( 'author_details_title', array(
    'label' => __('SINGLE - Author Details Title', 'flair'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 6,
) );

//blog author
$wp_customize->add_setting( 'blog_author', array(
    'default' => 1,
    'type' => 'option'
) );

//blog author
$wp_customize->add_control( 'blog_author', array(
    'label' => __('META - SINGLE - Show post author details?', 'flair'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 13,
) );
	
$wp_customize->add_setting( 'show_sidebar', array(
    'default' => 1,
    'type' => 'option'
) );
$wp_customize->add_control( 'show_sidebar', array(
    'label' => __('ARCHIVES - Show Sidebar?', 'flair'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 15,
) );

$wp_customize->add_setting( 'single_show_sidebar', array(
    'default' => 1,
    'type' => 'option'
) );
$wp_customize->add_control( 'single_show_sidebar', array(
    'label' => __('SINGLE POST - Show Sidebar?', 'flair'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 20,
) );
	
///////////////////////////////////////
//     PORTFOLIO SECTION            //
/////////////////////////////////////
	
//CREATE CUSTOM STYLING SUBSECTION
$wp_customize->add_section( 'portfolio_settings', array(
	'title'          => 'Portfolio Settings',
	'priority'       => 36,
) ); 

$wp_customize->add_setting( 'portfolio_related_title', array(
    'default' => 'Related Works',
    'type' => 'option'
) );

$wp_customize->add_control( 'portfolio_related_title', array(
    'label' => __('SINGLE - Related Work Title', 'flair'),
    'type' => 'text',
    'section' => 'portfolio_settings',
    'priority'       => 1,
) );

$wp_customize->add_setting( 'only_lightbox', array(
    'default' => 0,
    'type' => 'option'
) );
$wp_customize->add_control( 'only_lightbox', array(
    'label' => 'GLOBAL - Portfolio clicks will only show lightbox?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
    'priority'       => 3,
) );

$wp_customize->add_setting( 'portfolio_lightbox', array(
    'default' => 1,
    'type' => 'option'
) );
$wp_customize->add_control( 'portfolio_lightbox', array(
    'label' => 'GLOBAL - Show lightbox option on portfolio item hover?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
    'priority'       => 4,
) );

//portfolio date
$wp_customize->add_setting( 'portfolio_date', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio date
$wp_customize->add_control( 'portfolio_date', array(
    'label' => 'META - SINGLE - Show project date?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio categories
$wp_customize->add_setting( 'portfolio_categories', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio categories
$wp_customize->add_control( 'portfolio_categories', array(
    'label' => 'META - SINGLE - Show project categories?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio client
$wp_customize->add_setting( 'portfolio_client', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio client
$wp_customize->add_control( 'portfolio_client', array(
    'label' => 'META - SINGLE - Show project client?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio url
$wp_customize->add_setting( 'portfolio_url', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio url
$wp_customize->add_control( 'portfolio_url', array(
    'label' => 'META - SINGLE - Show project URL?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio url
$wp_customize->add_setting( 'portfolio_share', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio url
$wp_customize->add_control( 'portfolio_share', array(
    'label' => 'SINGLE - Show Social Share Buttons',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//disable ajax
$wp_customize->add_setting( 'portfolio_related', array(
    'default' => 1,
    'type' => 'option'
) );

//disable ajax
$wp_customize->add_control( 'portfolio_related', array(
    'label' => 'SINGLE - Show related posts?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
    'priority' => 4
) );

	

/**
 * Create colors section
 * @author TommusRhodus
 * @package loom
 * @since 1.0.0
 */

$wp_customize->add_setting('highlight_colour', array(
    'default'           => '#E84E41',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'highlight_colour', array(
    'label'    => __('Key Colour (Highlight)', 'flair'),
    'section'  => 'colors',
    'priority' => 100,
)));

$wp_customize->add_setting('footer_colour', array(
    'default'           => '#2E3138',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_colour', array(
    'label'    => __('Footer Background Colour', 'flair'),
    'section'  => 'colors',
    'priority' => 130,
)));

/**
 *  END COLOURS SECTION
 */


///////////////////////////////////////
//     CUSTOM LOGO SECTION          //
/////////////////////////////////////
	
//CREATE CUSTOM LOGO SUBSECTION
$wp_customize->add_section( 'custom_logo_section', array(
	'title'          => 'Header Settings & Logo',
	'priority'       => 30,
) );

//CUSTOM LOGO SETTINGS
$wp_customize->add_setting('custom_logo', array(
    'default'  => get_template_directory_uri() . '/style/images/logo.png',
    'type' => 'option'

));

//CUSTOM LOGO
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
    'label'    => __('Custom Logo Upload', 'flair'),
    'section'  => 'custom_logo_section',
    'priority'       => 1
)));

//CUSTOM RETINA LOGO SETTINGS
$wp_customize->add_setting('custom_logo_retina', array(
    'default'  => get_template_directory_uri() . '/style/images/logo@2x.png',
    'type' => 'option'

));

//CUSTOM RETINA LOGO
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo_retina', array(
    'label'    => __('Retina Logo - Needs @2x on the file e.g logo@2x.png', 'flair'),
    'section'  => 'custom_logo_section',
    'priority'       => 1
)));

//logo alt text
$wp_customize->add_setting( 'custom_logo_alt_text', array(
    'default'        => 'Alt Text',
    'type' => 'option'
) );

//logo alt text
$wp_customize->add_control( 'custom_logo_alt_text', array(
    'label' => __('Custom Logo Alt Text', 'flair'),
    'type' => 'text',
    'section' => 'custom_logo_section',
) );

/**
 * Ebor Framework
 * Custom Favicons
 * @since version 1.0
 * @author TommusRhodus
 */
 
 /**
  * Create the Favicon Section
  */
 $wp_customize->add_section( 'favicon_settings', array(
 	'title'          => 'Favicons',
 	'priority'       => 30,
 ) );

/**
 * Custom Favicon Defaults
 */
$wp_customize->add_setting('custom_favicon', array(
	'default' => '',
	'type' => 'option'
));

/**
 * Custom Favicon Upload Control
 */
$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'custom_favicon', array(
	'label'    => __('Custom Favicon Upload', 'ebor_starter'),
	'section'  => 'favicon_settings',
	'settings' => 'custom_favicon',
	'priority'       => 21,
)));

/**
 * Custom Favicon Defaults
 */
$wp_customize->add_setting('mobile_favicon', array(
    'default' => '',
    'type' => 'option'
));

/**
 * Custom Favicon Upload Control
 */
$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'mobile_favicon', array(
    'label'    => __('Non-Retina Mobile Favicon Upload', 'ebor_starter'),
    'section'  => 'favicon_settings',
    'settings' => 'mobile_favicon',
    'priority'       => 22,
)));

/**
 * Custom Favicon Defaults
 */
$wp_customize->add_setting('72_favicon', array(
    'default' => '',
    'type' => 'option'
));

/**
 * Custom Favicon Upload Control
 */
$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, '72_favicon', array(
    'label'    => __('iPad Favicon (72x72px)', 'ebor_starter'),
    'section'  => 'favicon_settings',
    'settings' => '72_favicon',
    'priority'       => 23,
)));

/**
 * Custom Favicon Defaults
 */
$wp_customize->add_setting('114_favicon', array(
   'default' => '',
   'type' => 'option'
));

/**
 * Custom Favicon Upload Control
 */
$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, '114_favicon', array(
   'label'    => __('Retina iPhone Favicon (114x114px)', 'ebor_starter'),
   'section'  => 'favicon_settings',
   'settings' => '114_favicon',
   'priority'       => 24,
)));

/**
 * Custom Favicon Defaults
 */
$wp_customize->add_setting('144_favicon', array(
	'default' => '',
	'type' => 'option'
));

/**
 * Custom Favicon Upload Control
 */
$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, '144_favicon', array(
	'label'    => __('Retina iPad Favicon (144x144px)', 'ebor_starter'),
	'section'  => 'favicon_settings',
	'settings' => '144_favicon',
	'priority'       => 25,
)));

///////////////////////////////////////
//     CUSTOM CSS SECTION           //
/////////////////////////////////////

//CREATE CUSTOM CSS SUBSECTION
$wp_customize->add_section( 'custom_css_section', array(
	'title'          => 'Custom CSS',
	'priority'       => 200,
) ); 
      
$wp_customize->add_setting( 'custom_css', array(
  'default'        => '',
  'type'           => 'option',
) );

$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'custom_css', array(
  'label'   => __('Custom CSS', 'flair'),
  'section' => 'custom_css_section',
  'settings'   => 'custom_css',
) ) );


///////////////////////////////////////
//     FOOTER SETTINGS             //
/////////////////////////////////////
	
//CREATE CUSTOM CSS SUBSECTION
$wp_customize->add_section( 'footer_section', array(
	'title'          => 'Footer Settings',
	'priority'       => 40,
) );

//copyright text
$wp_customize->add_setting( 'copyright', array(
    'default'        => 'Configure this message in "Appearance" => "Customise new" => "Footer"',
    'type' => 'option'
) );

//copyright text
$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'copyright', array(
    'label'   => __('SubFooter Copyright Text', 'flair'),
    'section' => 'footer_section',
    'settings'   => 'copyright',
    'priority' => 1,
) ) );


///////////////////////////////////////
//     GOOGLE API SECTION           //
/////////////////////////////////////

//CREATE CUSTOM CSS SUBSECTION
$wp_customize->add_section( 'gmap_api_section', array(
    'title'          => 'Google API Settings',
    'priority'       => 200,
) ); 
      
$wp_customize->add_setting( 'ebor_gmap_api', array(
  'default'        => '',
  'type'           => 'option',
) );

$wp_customize->add_control( 'ebor_gmap_api', array(
    'label' => __('Google API Key', 'loom'),
    'type' => 'text',
    'section' => 'gmap_api_section',
    'priority' => 4,
) );
      	
}