<?php
/**
 * Mental Theme settings
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

require_once( 'class-azl-settings-machine.php' ); // Theme settings class

/**
 * Get Mental Option from Theme Settings
 *
 * @param string $key option key
 * @param string $default default value
 * @param string $subkey subkey (for checklists, subarrays)
 *
 * @return string
 */
function get_mental_option( $key, $default = null, $subkey = '' )
{
	return Azl_Settings_Machine::instance()->get_option( $key, $default, $subkey );
}

/**
 * Function to get image tag with SVG images support
 *
 * @param $attachment_id
 * @param $size
 * @param $default_attachment_id
 *
 * @return string
 */
function get_mental_image( $attachment_id, $size = 'full', $default_attachment_id = '' )
{
	$image = wp_get_attachment_image( $attachment_id, $size );

	if ( empty( $image ) && $default_attachment_id ) {
		$image = wp_get_attachment_image( $default_attachment_id, $size );
	}

	$image = preg_replace( '/(width|height)="\d*"\s/', "", $image );

	return $image;
}


add_action( 'init', 'mental_admin_settings', 1 );
/**
 * Mental Theme Settings
 */
function mental_admin_settings() {

	$sm = new Azl_Settings_Machine( 'mental_settings' );
	$sm->set_title( __( 'Mentas Theme Settings', 'mental' ) )
	   ->set_copyright( __( 'Mentas theme by <a href="http://azelab.com/">azelab.com</a> | Join <a
                  href="https://www.facebook.com/azelabcom">azelab on Facebook</a>!', 'mental' ) )
	   ->set_metabox_post_types( array( 'page', 'post', 'gallery' ) );


	// =========================================================================
	// Home tab
	// =========================================================================

	$sm->add_tab( 'home', __( 'Home', 'mental' ), array(
		'logo' => array( 'title' => __( 'Logo', 'mental' ) ),
		'fav' => array( 'title' => __( 'Favicon and Apple icon', 'mental' ) ),
		'preloader' => array( 'title' => __( 'Page preloader', 'mental' ) ),
	) );

	// Logo

	$sm->add_option( 'logo', array(
		'tab'         => 'home',
		'section'     => 'logo',
		'label'       => __( 'Logo image:', 'mental' ),
		'description' => '',
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery')
	) );

	$sm->add_option( 'logo_invert', array(
		'tab'         => 'home',
		'section'     => 'logo',
		'label'       => __( 'Logo image inverted:', 'mental' ),
		'description' => __( 'Logo image for dark backgrounds', 'mental' ),
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery')
	) );

	$sm->add_option( 'logo_show_tagline', array(
		'tab'         => 'home',
		'section'     => 'logo',
		'label'       => __( 'Show tagline below logo:', 'mental' ),
		'description' => __( 'Check to show tagline below logo', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery')
	) );

	$sm->add_option( 'logo_column_size', array(
		'tab'         => 'home',
		'section'     => 'logo',
		'label'       => __( 'Top menu logo column size:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array('2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'),
		'default'     => '2',
		'show_on'     => array( 'global', 'page', 'post', 'gallery')
	) );

	// Fav

	$sm->add_option( 'fav_icon', array(
		'tab'         => 'home',
		'section'     => 'fav',
		'label'       => __( 'Favicon:', 'mental' ),
		'description' => '',
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'apple_icon', array(
		'tab'         => 'home',
		'section'     => 'fav',
		'label'       => __( 'Apple touch icon:', 'mental' ),
		'description' => '',
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	// Preloader

	$sm->add_option( 'preloader_show', array(
		'tab'         => 'home',
		'section'     => 'preloader',
		'label'       => __( 'Show page preloader:', 'mental' ),
		'description' => __( 'Check to show page preloader when page is loading', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'preloader_background_color', array(
		'tab' => 'home',
		'section' => 'preloader',
		'label'       => __( 'Preloader background color:', 'mental' ),
		'description' => __( 'Leave empty to use skin color' ),
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	// =========================================================================
	// Layout tab
	// =========================================================================

	$sm->add_tab( 'layout', __( 'Layout', 'mental' ), array(
		'general'   => array( 'title' => __( 'General', 'mental' ) ),
		'header'   => array( 'title' => __( 'Header', 'mental' ) ),
		'sidebar'  => array( 'title' => __( 'Sidebar', 'mental' ) ),
		'footer'   => array( 'title' => __( 'Footer', 'mental' ) ),
	) );

	// General

	$sm->add_option( 'container_width', array(
		'tab'         => 'layout',
		'section'     => 'general',
		'label'       => __( 'Container width:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'1200' => '1200px',
			'960'  => '960px'
		),
		'default'     => '1200',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'hide_title', array(
		'tab'         => 'layout',
		'section'     => 'general',
		'label'       => __( 'Hide page title:', 'mental' ),
		'description' => __( 'Check to hide title in page template', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'scroll_to_top', array(
		'tab'         => 'layout',
		'section'     => 'general',
		'label'       => __( 'Show scroll to top link:', 'mental' ),
		'description' => __( 'Check to show scroll up button', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'comments_show', array(
		'tab'         => 'layout',
		'section'     => 'general',
		'label'       => __( 'Show comments section:', 'mental' ),
		'description' => __( 'Check to show comments section', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

    $sm->add_option( 'border_w', array(
        'tab'         => 'layout',
        'section'     => 'general',
        'label'       => __( 'Enter border width:', 'mental' ),
        'description' => __( 'Enter border width, only number', 'mental' ),
        'type'        => 'text',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );

    $sm->add_option( 'border_color', array(
        'tab' => 'layout',
        'section' => 'general',
        'label'       => __( 'Border  color:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );


	// Header

	$sm->add_option( 'show_header', array(
		'tab'         => 'layout',
		'section'     => 'header',
		'label'       => __( 'Show header:', 'mental' ),
		'description' => __( 'Check if you want to show header', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'header_background_image', array(
		'tab'         => 'layout',
		'section'     => 'header',
		'label'       => __( 'Background image:', 'mental' ),
		'description' => __( 'You can select background image for header', 'mental' ),
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'header_parallax_image', array(
		'tab'         => 'layout',
		'section'     => 'header',
		'label'       => __( 'Background parallax image:', 'mental' ),
		'description' => __( 'Parallax background image for header', 'mental' ),
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'header_parallax_ratio', array(
		'tab'         => 'layout',
		'section'     => 'header',
		'label'       => __( 'Parralax ratio:', 'mental' ),
		'description' => __( 'How slower will background move compared to scroll', 'mental' ),
		'type'        => 'text',
		'default'     => '0.5',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'header_parallax_offset', array(
		'tab'         => 'layout',
		'section'     => 'header',
		'label'       => __( 'Parallax top offset:', 'mental' ),
		'description' => __( 'Change this value in pixels to move parallax picture vertically', 'mental' ),
		'type'        => 'text',
		'default'     => '-150',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Sidebar

	$sm->add_option( 'sidebar_show', array(
		'tab'         => 'layout',
		'section'     => 'sidebar',
		'label'       => __( 'Show Sidebar:', 'mental' ),
		'description' => __( 'Check to show sidebar', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'sidebar_show_on', array(
		'tab'         => 'layout',
		'section'     => 'sidebar',
		'label'       => __( 'Show Sidebar on specified pages:', 'mental' ),
		'description' => '',
		'type'        => 'checkbox_list',
		'checkboxes'  => array(
			'front'    => __( 'Show on Front page', 'mental' ),
			'archive'  => __( 'Show on Archive page', 'mental' ),
			'author'   => __( 'Show on Author page', 'mental' ),
			'category' => __( 'Show on Category page', 'mental' ),
			'search'   => __( 'Show on Search page', 'mental' ),
			'tag'      => __( 'Show on Tag page', 'mental' ),
			'404'      => __( 'Show on 404 Page', 'mental' ),
		),
		'default'     => array(
			'front'    => 'true',
			'archive'  => 'true',
			'author'   => 'true',
			'category' => 'true',
			'search'   => 'true',
			'tag'      => 'true',
			'404'      => 'true',
		),
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'sidebar_position', array(
		'tab'         => 'layout',
		'section'     => 'sidebar',
		'label'       => __( 'Sidebar position:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'left'  => __( 'Left side', 'mental' ),
			'right' => __( 'Right side', 'mental' ),
		),
		'default'     => 'right',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Footer

	$sm->add_option( 'footer_show', array(
		'tab'         => 'layout',
		'section'     => 'footer',
		'label'       => __( 'Show footer:', 'mental' ),
		'description' => __( 'Check to show footer', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'footer_parallax', array(
		'tab'         => 'layout',
		'section'     => 'footer',
		'label'       => __( 'Parallax effect:', 'mental' ),
		'description' => __( 'Check to use parralax effect on the footer', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'footer_columns', array(
		'tab'         => 'layout',
		'section'     => 'footer',
		'label'       => __( 'Footer columns count:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4'
		),
		'default'     => '4',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'ga_code', array(
		'tab'         => 'layout',
		'section'     => 'footer',
		'label'       => __( 'Insert tracking code:', 'mental' ),
		'description' => __( 'Enter your Google Analytics tracking code', 'mental' ),
		'type'        => 'textarea',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'footer_show_copyright', array(
		'tab'         => 'layout',
		'section'     => 'footer',
		'label'       => __( 'Show Copyright:', 'mental' ),
		'description' => __( 'Check to show copyright block', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'footer_copyright_text', array(
		'tab'         => 'layout',
		'section'     => 'footer',
		'label'       => __( 'Copyright text:', 'mental' ),
		'description' => __( 'Enter your copyright text', 'mental' ),
		'type'        => 'textarea',
		'default'     => '&#169; 2014 All rights reserved. Developed by <a href="http://azelab.com" target="_blank"><span>Azelab</span></a>',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// =========================================================================
	// Menu tab
	// =========================================================================

	$sm->add_tab( 'menu', __( 'Menu', 'mental' ), array(
		'top-menu' => array( 'title' => __( 'Top Menu', 'mental' ) ),
		'menubar'  => array( 'title' => __( 'Menu Bar', 'mental' ) ),
	) );

	// Top Menu

	$sm->add_option( 'show_topmenu', array(
		'tab'         => 'menu',
		'section'     => 'top-menu',
		'label'       => __( 'Show Top menu:', 'mental' ),
		'description' => __( 'Check if you want to show Top nenu', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'topmenu_stiky', array(
		'tab'     => 'menu',
		'section' => 'top-menu',
		'label'   => __( 'Top menu sticky:', 'mental' ),
		'description' => '',
		'type'    => 'select',
		'options' => array(
			'0' => __( 'Never', 'mental' ),
			'1' => __( 'Allways', 'mental' ),
			'2' => __( 'On scroll up', 'mental' ),
		),
		'default' => '1',
		'show_on' => array( 'global', 'page', 'post', 'gallery' )
	) );
	$sm->add_option( 'topmenu_stiky_on_scroll_top', array(
		'tab'         => 'menu',
		'section'     => 'top-menu',
		'label'       => __( 'Top menu sticky on scroll up:', 'mental' ),
		'description' => __( 'Check if you want top menu be on the top when scrolling up', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Menu Bar

	$sm->add_option( 'show_menubar', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Show Menubar:', 'mental' ),
		'description' => __( 'Check if you want to show Menubar', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_hide_handler', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Hide Menubar handler:', 'mental' ),
		'description' => __( 'Check if you want to hide Menubar handler on big screen (if selected \"Always opened on big screens\")', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_side', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Menubar Side:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'left'   => __( 'Left', 'mental' ),
			'right'   => __( 'Right', 'mental' ),
		),
		'default'     => 'left',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_open_style', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Menubar opening style:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'over_content'   => __( 'Over Content', 'mental' ),
			'push_content'   => __( 'Push Content', 'mental' ),
			'shrink_content' => __( 'Shrink Content', 'mental' ),
		),
		'default'     => 'over_content',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_opened_on_load', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Opened on page load:', 'mental' ),
		'description' => __( 'Check if you want menubar to be opened on page load', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_opened_for_big_screen', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Always opened on big screens:', 'mental' ),
		'description' => __( 'Check if you want menubar to be always opened on big screens (only with shrink content opening style)', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_menu_accodrion_type', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Menubar menu accordion type:', 'mental' ),
		'description' => __( 'Check if you want menubar menu work like accordion (when one item expanded, others close)', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_aboutus', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'About Us Block:', 'mental' ),
		'description' => '',
		'type'        => 'textarea',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'menubar_copyright', array(
		'tab'         => 'menu',
		'section'     => 'menubar',
		'label'       => __( 'Copyright text:', 'mental' ),
		'description' => '',
		'type'        => 'textarea',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );


	// =========================================================================
	// Gallery tab
	// =========================================================================

	$sm->add_tab( 'gallery', 'Gallery', array(
		'general' => array( 'title' => __( 'General Options', 'mental' ) ),
		'expanding' => array( 'title' => __( 'Expanding Preview', 'mental' ) ),
		'single'  => array( 'title' => __( 'Single post options', 'mental' ) )
	) );

	// General Options

	$sm->add_option( 'gallery_type', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Gallery type:', 'mental' ),
		'description' => __( 'Choose gallery type', 'mental' ),
		'type'        => 'select',
		'options'     => array(
			'expanding' => __( 'Expanding Gallery', 'mental' ),
			'normal'    => __( 'Normal Gallery', 'mental' ),
			'pinterest' => __( 'Pinterest Style', 'mental' ),
		),
		'default'     => 'expanding',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_fixed_items', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Gallery items ratio:', 'mental' ),
      'description' => __('Works only with gallery type Normal', 'mental'),
		'type'        => 'select',
		'options'     => array(
			'fixed'    => __( 'Fixed Ratio', 'mental' ),
			'original' => __( 'Original image Ratio', 'mental' ),
		),
		'default'     => 'gl-fixed-items',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_fixed_items_ratio', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Fixed items ratio value:', 'mental' ),
		'description' => __( 'Value in percents, means how big item\'s height compared to it\'s width', 'mental'),
		'type'        => 'text',
		'default'     => '67',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_items_per_page', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Items per page:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'3'  => '3', '4'  => '4', '5'  => '5', '6'  => '6', '7'  => '7', '8'  => '8', '9'  => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25',
		),
		'default'     => '8',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_columns_count', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Columns count:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
		'default'     => '4',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_load_on_scroll', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Load new items on scroll (infinite scroll):', 'mental' ),
		'description' => __( 'Check if you want new items to be loaded on page scroll or uncheck to click LOAD MORE button for it', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_placeholder', array(
		'tab'         => 'gallery',
		'section'     => 'general',
		'label'       => __( 'Default gallery image (placeholder):', 'mental' ),
		'description' => __('This image is used when gallery item has no featured image', 'mental'),
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	// Expanding preview

	$sm->add_option( 'gallery_preview_full_size', array(
		'tab'         => 'gallery',
		'section'     => 'expanding',
		'label'       => __( 'Show full size preview:', 'mental' ),
		'description' => __( 'Check to show in expanding preview full size preview without description and title', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_preview_show_zoom', array(
		'tab'         => 'gallery',
		'section'     => 'expanding',
		'label'       => __( 'Show zoom button:', 'mental' ),
		'description' => __( 'Check if you want to show zoom button in gallery previews', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_preview_show_readmore', array(
		'tab'         => 'gallery',
		'section'     => 'expanding',
		'label'       => __( 'Show Read more button:', 'mental' ),
		'description' => __( 'Check to show Read more button in expanding preview', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'gallery_preview_show_share', array(
		'tab'         => 'gallery',
		'section'     => 'expanding',
		'label'       => __( 'Show share links:', 'mental' ),
		'description' => __( 'Check to show share links in expanding preview', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	// Single page options

	$sm->add_option( 'gallery_single_type', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Single page type:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array(
			'description' => __( 'Page with description', 'mental' ),
			'full-1'      => __( 'Full size page with slider, style 1', 'mental' ),
			'full-2'      => __( 'Full size page with slider, style 2', 'mental' ),
			'full-thumbs' => __( 'Full size page with slider with thumbnails', 'mental' ),
			'full-video'  => __( 'Full size video page', 'mental' ),
		),
		'default'     => '4',
		'show_on'     => array( 'global', 'gallery' )
	) );

	$sm->add_option( 'gallery_single_show_top_section', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Show media section on the top:', 'mental' ),
		'description' => __( 'Depends on post format, featured image, post gallery or embed video will be shown in section above main post content, only for "Page with description version"', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'post' )
	) );

	$sm->add_option( 'gallery_single_show_info_column', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Show info column:', 'mental' ),
		'description' => __( 'Check to show info column in the right (Page with description type)', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'post' )
	) );

	$sm->add_option( 'gallery_single_full_show_around', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Show previous and next post\'s images and videos in the full size slider:', 'mental' ),
		'description' => __( 'This option will work only with "Full size page with slider" single item type', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'gallery' )
	) );

	$sm->add_option( 'gallery_single_full_show_controls_above_image', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Show navigation buttons above image:', 'mental' ),
		'description' => __( 'Check to show navigation buttons above image', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'gallery' )
	) );

	$sm->add_option( 'gallery_single_full_hide_title', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Hide title on Full size page mode:', 'mental' ),
		'description' => __( 'Check to нide title on Full size page mode:', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'gallery' )
	) );

	$sm->add_option( 'gallery_single_full_hide_social', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Hide social share buttons on Full size page mode:', 'mental' ),
		'description' => __( 'Check to нide social share buttons on Full size page mode:', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'gallery' )
	) );

	$sm->add_option( 'gallery_single_full_back2gal_show', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Show Back to gallery button', 'mental' ),
		'description' => __( 'Check to show back to gallery icon at the top right (Full size page with slider type)', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'gallery' )
	) );

	$sm->add_option( 'gallery_single_full_back2gal_link', array(
		'tab'         => 'gallery',
		'section'     => 'single',
		'label'       => __( 'Custom link for Back to gallery button', 'mental' ),
		'description' => __( 'Leave it empty to use referrer link', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global', 'gallery' )
	) );

	// =========================================================================
	// Blog tab
	// =========================================================================

   $sm->add_tab( 'blog', __( 'Blog', 'mental' ), array(
		'general' => array( 'title' => 'General Options' ),
		'single'  => array( 'title' => __( 'Single post options', 'mental' ) )
   ) );

	// General Options

	$sm->add_option( 'blog_type', array(
		'tab' => 'blog',
		'section' => 'general',
		'label'       => __( 'Blog type:', 'mental' ),
		'description' => __( 'Choose blog type', 'mental' ),
		'type'        => 'select',
		'options'     => array(
			'vertical' => __('Normal Blog', 'mental'),
			'masonry'  => __('Pinterest Style', 'mental'),
			'full'  => __('Full text', 'mental'),
		),
		'default'     => 'vertical',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'blog_items_per_page', array(
		'tab' => 'blog',
		'section' => 'general',
		'label'       => __( 'Items per page:', 'mental' ),
		'description' => '',
		'type'        => 'select',
		'options'     => array( '3'  => '3', '4'  => '4', '5'  => '5', '6'  => '6', '7'  => '7', '8'  => '8', '9'  => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25',
		),
		'default'     => '5',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'blog_masonry_columns', array(
		'tab' => 'blog',
		'section' => 'general',
		'label'       => __( 'Pinterest style columns:', 'mental' ),
		'description' => __( 'Columns count for Pinterest style layout', 'mental' ),
		'type'        => 'select',
		'options'     => array(
			'6' => '2',
			'4' => '3',
			'3' => '4'
		),
		'default'     => '3',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'blog_load_on_scroll', array(
		'tab' => 'blog',
		'section' => 'general',
		'label'       => __( 'Load new items on scroll (infinite scroll):', 'mental' ),
		'description' => __( 'Check if you want new items to be loaded on page scroll or uncheck to click LOAD MORE button for it', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global', 'page', 'post' )
	) );

	// Single post options

	$sm->add_option( 'blog_single_show_top_section', array(
		'tab' => 'blog',
		'section' => 'single',
		'label'       => __( 'Show media section on the top:', 'mental' ),
		'description' => __( 'Depends on post format, featured image, post gallery or embed video will be shown in section above main post content', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'post' )
	) );

	$sm->add_option( 'blog_single_show_related', array(
		'tab' => 'blog',
		'section' => 'single',
		'label'       => __( 'Show related posts:', 'mental' ),
		'description' => __( 'Check to show related posts', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global', 'post' )
	) );

	// =========================================================================
	// Social tab
	// =========================================================================

   $sm->add_tab( 'social', __( 'Social', 'mental' ), array(
		'general' => array( 'title' => __( 'General Options', 'mental' ) ),
		'seo'     => array( 'title' => __( 'Social Sharing', 'mental' ) ),
	) );

	// General Option

	$sm->add_option( 'hide_social_links', array(
		'tab' => 'social',
		'section' => 'general',
		'label'       => __( 'Hide social links:', 'mental' ),
		'description' => __( 'Check to hide social links in the page template', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '0',
		'show_on'     => array( 'global')
	) );

	$sm->add_option( 'social_links', array(
		'tab' => 'social',
		'section' => 'general',
		'label'       => __( 'Social links:', 'mental' ),
		'description' => __( 'You can type in any icon font classes, included to theme:
         <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a>,
         <a target="_blank" href="http://www.elegantthemes.com/blog/resources/elegant-icon-font">Elegant Icons</a>. For Font Awesome put fa before class name, e.x fa fa-twitter', 'mental' ),
		'type'        => 'social_links',
		'default'     => array(
			array( 'class' => 'fa fa-twitter', 'link' => '' ),
			array( 'class' => 'fa fa-facebook', 'link' => '' ),
			array( 'class' => 'fa fa-google-plus', 'link' => '' ),
			array( 'class' => 'fa fa-instagram', 'link' => '' ),
			array( 'class' => 'fa fa-pinterest', 'link' => '' ),
			array( 'class' => 'fa fa-tumblr', 'link' => '' ),
		),
		'show_on'     => array( 'global' )
	) );

	// Social SEO

	$sm->add_option( 'social_block_show', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Show social links block:', 'mental' ),
		'description' => __( 'Check to show social links block', 'mental' ),
		'type'        => 'checkbox',
		'default'     => '1',
		'show_on'     => array( 'global')
	) );

	$sm->add_option( 'social_links_show', array(
		'tab'         => 'social',
		'section'     => 'seo',
		'label'       => __( 'Show share links:', 'mental' ),
		'description' => '',
		'type'        => 'checkbox_list',
		'checkboxes'  => array(
			'twitter'    => __( 'Twitter', 'mental' ),
			'facebook'   => __( 'Facebook', 'mental' ),
			'googleplus' => __( 'Google Plus', 'mental' ),
			'pinterest'  => __( 'Pinterest', 'mental' ),
			'likedin'    => __( 'Likedin', 'mental' ),
			'vkontakte'  => __( 'Vkontakte', 'mental' ),
		),
		'default'     => array(
			'twitter'    => true,
			'facebook'   => true,
			'googleplus' => true,
			'pinterest'  => true,
			'likedin'    => true,
			'vkontakte'  => true,
		),
		'show_on'     => array( 'global' ),
	) );

	$sm->add_option( 'meta_fb_admins', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Facebook User ID:', 'mental' ),
		'description' => __( 'This is numeric User ID, you can find it using tools like <a href="http://findmyfacebookid.com/">findmyfacebookid.com</a>', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'meta_fb_page_url', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Facebook page URL:', 'mental' ),
		'description' => __( 'Example: https://www.facebook.com/yourname', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'meta_tw_site', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Twitter Site:', 'mental' ),
		'description' => __( 'Example: @publisher_handle', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'meta_tw_creator', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Twitter Creator:', 'mental' ),
		'description' => __( 'Example: @author_handle', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'meta_gp_author', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Google Plus author profile URL:', 'mental' ),
		'description' => __( 'Example: https://plus.google.com/[Google+_Profile]/posts', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'meta_gp_publisher', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Google Plus publisher profile URL:', 'mental' ),
		'description' => __( 'Example: https://plus.google.com/[Google+_Page_Profile]', 'mental' ),
		'type'        => 'text',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'meta_default_image', array(
		'tab' => 'social',
		'section' => 'seo',
		'label'       => __( 'Default Image:', 'mental' ),
		'description' => __( 'This image is used if the post/page being shared does not contain any images.', 'mental' ),
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

	// =========================================================================
	// Skins tab
	// =========================================================================

   $sm->add_tab( 'skins', __( 'Skins', 'mental' ), array(
		'presets' => array( 'title' => 'Skins Presets' ),
		'custom'  => array(
			'title' => __( 'Custom Colors', 'mental' ),
			'descr' => __( 'If you set this values, it will overwrite preset option. Leave empty fields to use defaults.', 'mental' ),
		),
		'menubar'  => array(
			'title' => __( 'Menubar Style', 'mental' ),
			'descr' => __( 'If you set this values, it will overwrite preset option. Leave empty fields to use defaults.', 'mental' ),
		),
		'css'     => array( 'title' => 'Custom CSS' ),
		'google_maps'     => array( 'title' => 'Google Maps customization' ),
	) );

	// Presets

	$sm->add_option( 'skins', array(
		'tab' => 'skins',
		'section' => 'presets',
		'label'       => __( 'Skins:', 'mental' ),
		'description' => '',
		'type'        => 'skins',
		'fields'     => array(
			'color_primary'            => __( 'Primary color', 'mental' ),
			'color_background_primary' => __( 'Primary background color', 'mental' ),
			'color_text_primary'       => __( 'Primary text color', 'mental' ),
			'color_secondary'          => __( 'Secondary color', 'mental' ),
			'color_tertiary'           => __( 'Tertiary color', 'mental' ),
			'color_quaternary'         => __( 'Quaternary color', 'mental' ),
			'color_menubar_background' => __( 'Menubar background color', 'mental' ),
			'color_menubar_handle'     => __( 'Menubar handle color', 'mental' ),
			'color_topmenu'            => __( 'Topmenu background color', 'mental' ),
			'color_topmenu_sticky'     => __( 'Topmenu background color when sticky', 'mental' ),
			'color_footer'             => __( 'Footer background color', 'mental' ),
			'color_footer_copyright'   => __( 'Footer copyright background color', 'mental' ),
		),
		'options' => array(
			'color_topmenu_sticky' => array('opacity' => true),
		),
		'default' => array(
			array( 'title'                    => 'Purple',
			       'color_primary'            => '#9d14c7',
			       'color_background_primary' => '#2d013a',
			       'color_text_primary'       => '',
			       'color_secondary'          => '#4c4052',
			       'color_tertiary'           => '#e3cfe8',
			       'color_quaternary'         => '#26330f',
			       'color_menubar_background'     => '#20002a',
			       'color_menubar_handle'     => '#20002a',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => ''
			),
			array( 'title'                    => 'Burgundy',
			       'color_primary'            => '#c71630',
			       'color_background_primary' => '#4e0101',
			       'color_text_primary'       => '',
			       'color_secondary'          => '#695353',
			       'color_tertiary'           => '#ffffff',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '#3d0000',
			       'color_menubar_handle'     => '#3d0000',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => '#570000'
			),
			array( 'title'                    => 'Blue',
			       'color_primary'            => '#a2c7fe',
			       'color_background_primary' => '',
			       'color_text_primary'       => '',
			       'color_secondary'          => '',
			       'color_tertiary'           => '',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '',
			       'color_menubar_handle'     => '',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => ''
			),
			array( 'title'                    => 'Cerulean',
			       'color_primary'            => '#2c90c8',
			       'color_background_primary' => '',
			       'color_text_primary'       => '',
			       'color_secondary'          => '',
			       'color_tertiary'           => '',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '',
			       'color_menubar_handle'     => '',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => ''
			),
			array( 'title'                    => 'Yellow',
			       'color_primary'            => '#fde925',
			       'color_background_primary' => '',
			       'color_text_primary'       => '',
			       'color_secondary'          => '',
			       'color_tertiary'           => '',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '',
			        'color_menubar_handle'     => '',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => ''
			),
			array( 'title'                    => 'Brown',
			       'color_primary'            => '#784107',
			       'color_background_primary' => '#2f1b06',
			       'color_text_primary'       => '',
			       'color_secondary'          => '#753f06',
			       'color_tertiary'           => '#fbd9b4',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '#281500',
			       'color_menubar_handle'     => '#281500',
                'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => '#261503'
			),
			array( 'title'                    => 'Orange',
			       'color_primary'            => '#ff9900',
			       'color_background_primary' => '',
			       'color_text_primary'       => '',
			       'color_secondary'          => '',
			       'color_tertiary'           => '',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '',
			       'color_menubar_handle'     => '',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => ''
			),
			array( 'title'                    => 'Light',
			       'color_primary'            => '#cacac9',
			       'color_background_primary' => '#f8f8f8',
			       'color_text_primary'       => '',
			       'color_secondary'          => '',
			       'color_tertiary'           => '',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '#e9e8e8',
			       'color_menubar_handle'     => '#e9e8e8',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => ''
			),
			array( 'title'                    => 'Pink',
			       'color_primary'            => '#f80fcf',
			       'color_background_primary' => '#4d0340',
			       'color_text_primary'       => '',
			       'color_secondary'          => '#a20386',
			       'color_tertiary'           => '#f7adea',
			       'color_quaternary'         => '',
			       'color_menubar_background'     => '#38012e',
			       'color_menubar_handle'     => '#38012e',
			       'color_topmenu'            => '',
			       'color_topmenu_sticky'     => '',
			       'color_footer'             => '',
			       'color_footer_copyright'   => '#3c0031'
			),
		),
		'show_on'     => array( 'global' )
	) );

	$sm->add_option( 'skin_preset', array(
		'tab' => 'skins',
		'section' => 'presets',
		'label'       => __( 'Select skin:', 'mental' ),
		'description' => '',
		'type'        => 'skin_select',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Custom Colors

    $sm->add_option( 'color_primary', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Primary color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_background_primary', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Primary background color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_text_primary', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Primary text color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_secondary', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Secondary color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_tertiary', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Tertiary color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_quaternary', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Quaternary color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

    $sm->add_option( 'color_menu_item', array(
        'tab' => 'skins',
        'section' => 'custom',
        'label'       => __( 'Color menu item:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );

    $sm->add_option( 'color_menu_hover', array(
        'tab' => 'skins',
        'section' => 'custom',
        'label'       => __( 'Color menu item hover:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );
    $sm->add_option( 'color_active_menu', array(
        'tab' => 'skins',
        'section' => 'custom',
        'label'       => __( 'Color menu item active:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );

    $sm->add_option( 'color_sbmenu_item', array(
        'tab' => 'skins',
        'section' => 'custom',
        'label'       => __( 'Color sub menu item:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );
    $sm->add_option( 'color_sbmenuh_item', array(
        'tab' => 'skins',
        'section' => 'custom',
        'label'       => __( 'Color sub menu item hover:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );
    $sm->add_option( 'bg_sbmenu', array(
        'tab' => 'skins',
        'section' => 'custom',
        'label'       => __( 'Submenu background color:', 'mental' ),
        'description' => '',
        'type'        => 'color',
        'default'     => '',
        'show_on'     => array( 'global', 'page', 'post', 'gallery' )
    ) );


	$sm->add_option( 'color_topmenu', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Topmenu background color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_topmenu_sticky', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Topmenu background color when sticky:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_topmenu_transparent', array(
			'tab' => 'skins',
			'section' => 'custom',
			'label'       => __( 'Topmenu background transparent:', 'mental' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
					'0'  => 'no', '1'  => 'yes'
			),
			'default'     => '0',
			'show_on'     => array( 'global', 'page', 'post' )
	) );

	$sm->add_option( 'color_footer', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Footer background color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_footer_copyright', array(
		'tab' => 'skins',
		'section' => 'custom',
		'label'       => __( 'Footer copyright background color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Menubar Styles

	$sm->add_option( 'color_menubar_background', array(
		'tab' => 'skins',
		'section' => 'menubar',
		'label'       => __( 'Menubar background color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_background_image', array(
		'tab' => 'skins',
		'section' => 'menubar',
		'label'       => __( 'Menubar background image:', 'mental' ),
		'description' => __( 'You can select background image for menubar', 'mental' ),
		'type'        => 'image',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_background_video', array(
		'tab' => 'skins',
		'section' => 'menubar',
		'label'       => __( 'Menubar background video:', 'mental' ),
		'description' => __( 'You can select background video for menubar. You can type several different video format URLs separated by comma', 'mental' ),
		'type'        => 'video',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'menubar_background_video_opacity', array(
		'tab' => 'skins',
		'section' => 'menubar',
		'label'       => __( 'Menubar background video opacity:', 'mental' ),
		'description' => __( '' ),
		'type'        => 'text',
		'default'     => '0.3',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'color_menubar_handle', array(
		'tab' => 'skins',
		'section' => 'menubar',
		'label'       => __( 'Menubar handle color:', 'mental' ),
		'description' => '',
		'type'        => 'color',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );
    

	// Custom CSS

	$sm->add_option( 'css_custom', array(
		'tab' => 'skins',
		'section' => 'css',
		'label'       => __( 'Custom CSS:', 'mental' ),
		'description' => '',
		'type'        => 'textarea',
		'default'     => '',
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Google Maps

	$sm->add_option( 'google_maps_styles', array(
		'tab' => 'skins',
		'section' => 'google_maps',
		'label'       => __( 'Google Maps custom JSON settings:', 'mental' ),
		'description' => __( 'Style Google Map any way you want using <a href="http://www.mapstylr.com/map-style-editor/" target="_blank">MapStylr</a> tool, and paste JSON code in the fiel above.', 'mental'),
		'type'        => 'textarea',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );


	// =========================================================================
	// Typography tab
	// =========================================================================

	$sm->add_tab( 'typography', __( 'Typography', 'mental' ), array(
		'load'  => array( 'title' => __( 'Web Fonts Loader', 'mental' ) , 'descr' => __('Web fonts loader descr', 'mental')),
		'general'  => array( 'title' => __( 'General Fonts', 'mental' ) ),
		'headings' => array( 'title' => __( 'Headings Fonts', 'mental' ) ),
		'other'    => array( 'title' => __( 'Other', 'mental' ) )
	) );

	// Load

	$sm->add_option( 'font_loader', array(
		'tab' => 'typography',
		'section' => 'load',
		'label'       => __( 'Load Fonts:', 'mental' ),
		'description' => '',
		'type'        => 'font_loader',
		'default'     => array(),
		'show_on'     => array( 'global' )
	) );

	// General

	$sm->add_option( 'font_primary', array(
		'tab' => 'typography',
		'section' => 'general',
		'label'       => __( 'Primary theme font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '14px',
			'style'  => '',
			'weight' => '300',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Headings

	$sm->add_option( 'font_h1', array(
		'tab' => 'typography',
		'section' => 'headings',
		'label'       => __( 'Heading 1 font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '30px',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'font_h2', array(
		'tab' => 'typography',
		'section' => 'headings',
		'label'       => __( 'Heading 2 font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '28px',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'font_h3', array(
		'tab' => 'typography',
		'section' => 'headings',
		'label'       => __( 'Heading 3 font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '24px',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'font_h4', array(
		'tab' => 'typography',
		'section' => 'headings',
		'label'       => __( 'Heading 4 font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '20px',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'font_h5', array(
		'tab' => 'typography',
		'section' => 'headings',
		'label'       => __( 'Heading 5 font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '18px',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'font_h6', array(
		'tab' => 'typography',
		'section' => 'headings',
		'label'       => __( 'Heading 6 font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '15px',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	// Other

	$sm->add_option( 'font_topmenu', array(
		'tab' => 'typography',
		'section' => 'other',
		'label'       => __( 'Top menu font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	$sm->add_option( 'font_menubar_menu', array(
		'tab' => 'typography',
		'section' => 'other',
		'label'       => __( 'Menubar menu font:', 'mental' ),
		'description' => '',
		'type'        => 'font',
		'default'     => array(
			'font'   => 'default',
			'size'   => '',
			'style'  => '',
			'weight' => '',
		),
		'show_on'     => array( 'global', 'page', 'post', 'gallery' )
	) );

	if ( class_exists( 'WooCommerce' ) ) {

		// =========================================================================
		// WooCommerce Tab
		// =========================================================================

		$sm->add_tab( 'woocommerce', __( 'WooCommerce', 'mental' ),  array(
			'shortcode' => array( 'title' => __( 'Products Gallery shortcode', 'mental' ) ),
            'cart' => array( 'title' => __( 'Shopping cart', 'mental' ) ),
		) );

		// Shortcode

		$sm->add_option( 'woo_gallery_items_per_page', array(
			'tab' => 'woocommerce',
			'section' => 'shortcode',
			'label'       => __( 'Items per page:', 'mental' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
				'3'  => '3', '4'  => '4', '5'  => '5', '6'  => '6', '7'  => '7', '8'  => '8', '9'  => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25',
			),
			'default'     => '8',
			'show_on'     => array( 'global', 'page', 'post' )
		) );

		$sm->add_option( 'woo_gallery_columns_count', array(
			'tab' => 'woocommerce',
			'section' => 'shortcode',
			'label'       => __( 'Columns count:', 'mental' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
				'3' => '3',
				'4' => '4',
				'5' => '5',
			),
			'default'     => '4',
			'show_on'     => array( 'global', 'page', 'post' )
		) );

        $sm->add_option( 'shopping_cart', array(
            'tab' => 'woocommerce',
            'section' => 'cart',
            'label'       => __( 'Show shopping cart:', 'mental' ),
            'description' => '',
            'type'        => 'checkbox',
            'default'     => '1',
            'show_on'     => array( 'global', 'page', 'post' )
        ) );


        $sm->add_option( 'cart_color', array(
            'tab' => 'woocommerce',
            'section' => 'cart',
            'label'       => __( 'Shopping cart color:', 'mental' ),
            'description' => '',
            'type'        => 'color',
            'default'     => '',
            'show_on'     => array( 'global', 'page', 'post', 'gallery' )
        ) );


		$sm->add_option( 'woo_gallery_load_on_scroll', array(
			'tab' => 'woocommerce',
			'section' => 'shortcode',
			'label'       => __( 'Load new items on scroll (infinite scroll):', 'mental' ),
			'description' => __( 'Check if you want new items to be loaded on page scroll or uncheck to click LOAD MORE button for it', 'mental' ),
			'type'        => 'checkbox',
			'default'     => '0',
			'show_on'     => array( 'global', 'page', 'post' )
		) );

	}

	// =========================================================================
	// Import / Export Tab
	// =========================================================================

	$sm->add_tab( 'import', __( 'Import/Export', 'mental' ), array(
		'general' => array( 'title' => __( 'Import / Export', 'mental' ) ),
	) );

	$sm->add_option( 'import', array(
		'tab'         => 'import',
		'section'     => 'general',
		'label'       => __( 'Import / Export:', 'mental' ),
		'description' => __( 'Copy and paste this data for export or paste and press update for import', 'mental' ),
		'type'        => 'import',
		'default'     => '',
		'show_on'     => array( 'global' )
	) );

} // function mental_admin_settings()
