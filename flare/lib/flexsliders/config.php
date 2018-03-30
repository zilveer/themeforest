<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * Table of contents:
 * 1. Theme options
 * 2. Custom post type - btp_flex_slider
 * 3. Entry options - meta fields related with btp_flex_slider
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ----------------------------------------------------------------------------- */
/* ---------->>> THEME OPTIONS <<<---------------------------------------------- */
/* ----------------------------------------------------------------------------- */



btp_theme_add_option_subgroup( 'flexslider', array( 'label' => __( 'Flex Sliders', 'btp_theme' ),	), 	'general', 3010 );

btp_theme_add_option( 'flexslider_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . sprintf( __( 'Set up the default configuration for all Flex Sliders, except those from <a href="%s">the flex Sliders</a> section.', 'btp_theme' ), network_admin_url( 'edit.php?post_type=btp_flexslider' ) ) . '</p>',		
	'group'			=> 'general',
	'subgroup'		=> 'flexslider',
	'position'		=> 90,
));
btp_theme_add_option( 'flexslider_animation', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Transition', 'btp_theme' ),
	'hint'			=> __( 'Transition effect', 'btp_theme' ),
	'default'		=> 'fade',
	'choices_cb'	=> 'btp_flexslider_get_fx_choices',
	'group'			=> 'general',
	'subgroup'		=> 'flexslider',
	'position'		=> 110,
));
btp_theme_add_option( 'flexslider_animation_duration', array(
	'view'			=> 'Range',
	'label'			=> __('Transition speed', 'btp_theme'),
    'hint'			=> __('Enter the number of seconds, e.g. 1.5', 'btp_theme'),
	'default'		=> 1,
	'min'			=> 0,
	'max'			=> 5,
	'step'			=> 0.1,
	'group'			=> 'general',
	'subgroup'		=> 'flexslider',
	'position'		=> 120,
));
btp_theme_add_option( 'flexslider_slideshow_speed', array(
	'view'			=> 'Range',
	'label'			=> __('Timeout', 'btp_theme'),
    'hint'			=>
		__( 'Time between slide transitions.', 'btp_theme' ) . '<br />' . 
		__( 'Enter the number of seconds, e.g. 4', 'btp_theme' ),
	'default'		=> 4,
	'min'			=> 0,
	'max'			=> 20,
	'step'			=> 0.1,
	'group'			=> 'general',
	'subgroup'		=> 'flexslider',
	'position'		=> 130
));




/* ----------------------------------------------------------------------------- */
/* ---------->>> POST TYPE <<<-------------------------------------------------- */
/* ----------------------------------------------------------------------------- */



/**
 * Registers custom post type "btp_flexslider"
 * 
 * If you want to modify some paremeters, hook into the btp_pre_register_post_type custom filter.
 */
function btp_flexslider_register_post_type() {
	$args = array(
		'label'		=> __('flex Sliders', 'btp_theme'),		
		'labels'	=> array(
			'name'					=> __( 'Flex Sliders', 'btp_theme' ),
			'singular_name' 		=> __( 'Flex Slider', 'btp_theme' ),
			'add_new' 				=> __( 'Add new', 'btp_theme' ),
			'all_items' 			=> __( 'All Flex Sliders', 'btp_theme' ),
			'add_new_item' 			=> __( 'Add new Flex Slider', 'btp_theme' ),
			'edit_item' 			=> __( 'Edit Flex Slider', 'btp_theme' ),
			'new_item' 				=> __( 'New Flex Slider', 'btp_theme' ),
			'view_item' 			=> __( 'View Flex Slider', 'btp_theme' ),
			'search_items' 			=> __( 'Search Flex Sliders', 'btp_theme' ),
			'not_found' 			=> __( 'No Flex Sliders found', 'btp_theme' ),
			'not_found_in_trash'	=> __( 'No Flex Sliders found in Trash', 'btp_theme' ),
			'parent_item_colon' 	=> __( 'Parent Flex Slider', 'btp_theme' ), 
			'menu_name'				=> __( 'Flex Sliders', 'btp_theme' ),
		),
		'public'				=> false,
		'publicly_queryable'	=> false,
		'exclude_from_search'	=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'hierarchical'			=> false,
		'supports'				=> array( 'title' ),
		'has_archive'			=> false, 				
		'rewrite'				=> false,
		'query_var'				=> false,
		'can_export'			=> true,
		'show_in_nav_menus'		=> false,
	);

	/* Apply custom filters (this way Child Themes can change some arguments) */
	$args = apply_filters( 'btp_pre_register_post_type', $args, 'btp_flexslider' );
	
	register_post_type( 'btp_flexslider', $args );
}
add_action( 'init', 'btp_flexslider_register_post_type' );



/* ----------------------------------------------------------------------------- */
/* ---------->>> ENTRY OPTIONSPOST TYPE <<<------------------------------------- */
/* ----------------------------------------------------------------------------- */



/* Configuration metabox */
btp_entry_add_option_group( 'flexsliderconfig', array( 'label' => __( 'Configuration', 'btp_theme' ), ), 10 );
btp_entry_add_option_subgroup( 'main', array( 'label' => __( 'Main', 'btp_theme' ) ), 'flexsliderconfig', 10 );

btp_entry_add_option( 'flexslider_layout', array(
	'apply'			=> array( 'btp_flexslider' => true ),
	'view'			=> 'Image_Choice',
	'label' 		=> __( 'Layout', 'btp_theme' ),
	'default'		=> 'wide',
	'choices_cb'	=> 'btp_flexslider_get_layout_choices',
	'group'			=> 'flexsliderconfig',
	'subgroup'		=> 'main',
	'position'		=> 90,
));
btp_entry_add_option( 'flexslider_shadow', array(
	'apply'			=> array( 'btp_flexslider' => true ),
	'view'			=> 'Choice',
	'label' 		=> __( 'Shadow', 'btp_theme' ),
	'default'		=> 'none',
	'choices'		=> array(
		''			=> 'none',
		'shadow-1'	=> 'shadow-1',
		'shadow-2'	=> 'shadow-2',
	),
	'group'			=> 'flexsliderconfig',
	'subgroup'		=> 'main',
	'position'		=> 95,
));
btp_entry_add_option( 'flexslider_animation', array(
	'apply'			=> array( 'btp_flexslider' => true ),
	'view'			=> 'Choice',
	'label' 		=> __( 'Transition', 'btp_theme' ),
	'hint'			=> __( 'Transition effect', 'btp_theme' ),
	'default'		=> 'fade',
	'choices_cb'	=> 'btp_flexslider_get_fx_choices',
	'group'			=> 'flexsliderconfig',
	'subgroup'		=> 'main',
	'position'		=> 100,
));
btp_entry_add_option( 'flexslider_animation_duration', array(
	'apply'			=> array( 'btp_flexslider' => true ),
	'view'			=> 'Range',
	'label' 		=> __( 'Transition speed', 'btp_theme' ),
	'default'		=> 1,
	'min'			=> 0,
	'max'			=> 5,
	'step'			=> 0.1,
	'group'			=> 'flexsliderconfig',
	'subgroup'		=> 'main',
	'position'		=> 110,
));
btp_entry_add_option( 'flexslider_slideshow_speed', array(
	'apply'			=> array( 'btp_flexslider' => true ),
	'view'			=> 'Range',
	'label' 		=> __( 'Pause time', 'btp_theme' ),
	'hint'			=>
		__( 'Time between slide transitions.', 'btp_theme' ) . '<br />' . 
		__( 'Enter the number of seconds, e.g. 4', 'btp_theme' ),
	'default'		=> 4,
	'min'			=> 0,
	'max'			=> 10,
	'step'			=> 0.1,
	'group'			=> 'flexsliderconfig',
	'subgroup'		=> 'main',
	'position'		=> 130,
));
btp_entry_add_option( 'flexslider_slideshow', array(
    'apply'			=> array( 'btp_flexslider' => true ),
    'view'			=> 'Choice',
    'label' 		=> __( 'Autoplay', 'btp_theme' ),
    'choices'		=> array(
        'on'		=> 'on',
        'off'       => 'off',
    ),
    'default'		=> 'on',
    'group'			=> 'flexsliderconfig',
    'subgroup'		=> 'main',
    'position'		=> 140,
));
btp_entry_add_option( 'flexslider_shadow', array(
    'apply'			=> array( 'btp_flexslider' => true ),
    'view'			=> 'Choice',
    'label' 		=> __( 'Shadow', 'btp_theme' ),
    'default'		=> 'none',
    'choices'		=> array(
        ''			=> 'none',
        'shadow-1'	=> 'shadow-1',
        'shadow-2'	=> 'shadow-2',
    ),
    'group'			=> 'flexsliderconfig',
    'subgroup'		=> 'main',
    'position'		=> 95,
));


/* flex Slider Slides metabox */
btp_entry_add_option_group( 'flexsliderslides', array( 'label' => __( 'Flex Slider Slides', 'btp_theme' ), ), 20);
btp_entry_add_option_subgroup( 'main', array( 'label' => __( 'Main', 'btp_theme' ) ), 'flexsliderslides', 100 );

btp_entry_add_option( 'flexslider_slides', array(
	'apply'			=> array( 'btp_flexslider' => true ),
	'view'			=> 'flex_Slides',
	'model'			=> 'flex_Slides',
	'label' 		=> __( 'Flex Slides', 'btp_theme' ),
	'group'			=> 'flexsliderslides',
	'subgroup'		=> 'main',
	'position'		=> 10,
));

require_once( dirname(__FILE__) . '/functions.php' );
?>