<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 1. Post options - meta fields related with post
 * 2. Taxonomy options - meta fields related with category and tag
 * 3. Shortcodes
 * 4. Widgets     
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ----------------------------------------------------------------------------- */
/* ---------->>> THEME OPTIONS <<<---------------------------------------------- */
/* ----------------------------------------------------------------------------- */

btp_theme_add_option_group( 'post', array( 'label' => __( 'Posts', 'btp_theme' ) ), 600 );
btp_theme_add_option_subgroup( 
	'index', 
	array( 
		'label' => __( 'Index', 'btp_theme' ),
	), 
	'post', 
	100
);
btp_theme_add_option_subgroup( 
	'archive', 
	array( 
		'label' => __( 'Archive', 'btp_theme' ),			
	), 
	'post', 
	200
);
btp_theme_add_option_subgroup( 
	'single', 
	array( 
		'label' => __( 'Single', 'btp_theme' ),		
	), 
	'post', 
	300 
);

// ----------------------------------------------------------------------
// Posts > Index
// ----------------------------------------------------------------------
btp_theme_add_option( 'post_index_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . __( 'Set up the options for the Post Index Page (Blog Page)',  'btp_theme' ) . '</p>',
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 80,
));
btp_theme_add_option( 'post_index_page', array(
	'view'			=> 'Choice',
	'label' 		=> __('Index Page', 'btp_theme'),
	'choices_cb'	=> 'btp_page_get_choices',
	'null'			=> '',
	'help'			=> 
		'<p>' . __( 'Few points about this page:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Page template will be ignored. Instead one of the below templates will be used.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Any content will be ignored.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'All other elements ( like title, sidebar, background, etc.  ) should work fine.', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 90,
));	
btp_theme_add_option( 'post_index_template', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Template', 'btp_theme'),
	'default'		=> '1-column-sidebar-right',
	'choices_cb'	=> 'btp_post_get_archive_templates',
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - featured media', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 100,
));
btp_theme_add_option( 'post_index_collection_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Collection options',  'btp_theme' ) . '</h3>',
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 105,
));
btp_theme_add_option( 'post_index_posts_per_page', array(
	'label' 		=> __('Entries per page', 'btp_theme'),
	'default'		=> 10,
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 110,
));
btp_theme_add_option( 'post_index_elem_title', array(
	'view'			=> 'Choice',
	'label'     	=> __('Title', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 120,
));
btp_theme_add_option( 'post_index_elem_featured_media', array(
	'view'			=> 'Choice',
	'label'     	=> __('Featured media', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 130,
));
btp_theme_add_option( 'post_index_elem_date', array(
	'view'			=> 'Choice',
	'label'     	=> __('Date', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 140,
));
btp_theme_add_option( 'post_index_elem_author', array(
	'view'			=> 'Choice',
	'label'     	=> __('Author', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 150,
));
btp_theme_add_option( 'post_index_elem_comments_link', array(
	'view'			=> 'Choice',
	'label'     	=> __('Comments link', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 160,
));
btp_theme_add_option( 'post_index_elem_summary', array(
	'view'			=> 'Choice',
	'label'     	=> __('Summary', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 170,
));
btp_theme_add_option( 'post_index_elem_categories', array(
	'view'			=> 'Choice',
	'label'     	=> __('Categories', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 180,
));
btp_theme_add_option( 'post_index_elem_tags', array(
	'view'			=> 'Choice',
	'label'     	=> __('Tags', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 190,
));
btp_theme_add_option( 'post_index_elem_button_1', array(
	'view'			=> 'Choice',
	'label'     	=> __('Button', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'index',
	'position'		=> 200,
));



// ----------------------------------------------------------------------
// Posts > Archive
// ----------------------------------------------------------------------
btp_theme_add_option( 'post_archive_default_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . __( 'Set up the options for all Blog Archive pages: Category Archive, Tag Archive, Date Archive, Author Archive',  'btp_theme' ) . '</p>',
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 80,
));
btp_theme_add_option( 'post_archive_template', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Template', 'btp_theme'),
	'default'		=> '1-column-sidebar-right',
	'choices_cb'	=> 'btp_post_get_archive_templates',
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - featured media', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .			
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 100,
));

btp_theme_add_option( 'post_archive_elem_sidebar_1', array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Sidebar', 'btp_theme' ),
	'hint'			=> __( 'Only matters if you selected a template with sidebar support.', 'btp_theme' ),
	'default'		=> 'primary',
	'choices_cb'	=> 'btp_sidebar_get_choices',
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 102,
));
btp_theme_add_option( 'post_archive_collection_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Collection options',  'btp_theme' ) . '</h3>',
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 105,
));
btp_theme_add_option( 'post_archive_posts_per_page', array(
	'label' 		=> __('Entries per page', 'btp_theme'),
	'default'		=> 10,
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 110,
));
btp_theme_add_option( 'post_archive_elem_title', array(
	'view'			=> 'Choice',
	'label'     	=> __('Title', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 120,
));
btp_theme_add_option( 'post_archive_elem_featured_media', array(
	'view'			=> 'Choice',
	'label'     	=> __('Featured media', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 130,
));
btp_theme_add_option( 'post_archive_elem_date', array(
	'view'			=> 'Choice',
	'label'     	=> __('Date', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 140,
));
btp_theme_add_option( 'post_archive_elem_author', array(
	'view'			=> 'Choice',
	'label'     	=> __('Author', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 150,
));
btp_theme_add_option( 'post_archive_elem_comments_link', array(
	'view'			=> 'Choice',
	'label'     	=> __('Comments link', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 160,
));
btp_theme_add_option( 'post_archive_elem_summary', array(
	'view'			=> 'Choice',
	'label'     	=> __('Summary', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 170,
));
btp_theme_add_option( 'post_archive_elem_categories', array(
	'view'			=> 'Choice',
	'label'     	=> __('Categories', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 180,
));
btp_theme_add_option( 'post_archive_elem_tags', array(
	'view'			=> 'Choice',
	'label'     	=> __('Tags', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 190,
));
btp_theme_add_option( 'post_archive_elem_button_1', array(
	'view'			=> 'Choice',
	'label'     	=> __('Button', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'post',
	'subgroup'		=> 'archive',
	'position'		=> 200,
));



// ----------------------------------------------------------------------
// Posts > Single
// ----------------------------------------------------------------------
btp_theme_add_option( 'post_single_default_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . __( 'Set up <strong>default options</strong> for all Single Post pages.', 'btp_theme' ) . '</p>' .
		'<p>' . __( 'Note, however, that <strong>you can override</strong> some of these options for each individual post.',  'btp_theme' ) . '</p>',
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 80,
));
btp_theme_add_option( 'post_single_template', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __( 'Template', 'btp_theme' ),
	'default'		=> 'three-fourths-sidebar-right',
	'choices_cb'	=> 'btp_post_get_single_templates',
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - media box', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 100,
));
btp_theme_add_option( 'post_single_elem_sidebar_1', array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Primary sidebar', 'btp_theme' ),
	'hint'			=> __( 'Only matters if you selected a template with sidebar support.', 'btp_theme' ),
	'default'		=> 'primary',
	'choices_cb'	=> 'btp_sidebar_get_choices',
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 102,
));
btp_theme_add_option( 'post_single_elem_title', array(
	'view'			=> 'Choice',
	'label'     	=> __('Title', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 110,
));
btp_theme_add_option( 'post_single_elem_mediabox', array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Media box', 'btp_theme' ),
	'help_cb'		=> 'btp_mediabox_get_help',
	'default'		=> 'list',
	'choices_cb'	=> 'btp_mediabox_get_choices',
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 120,
));
btp_theme_add_option( 'post_single_elem_date', array(
	'view'			=> 'Choice',
	'label'     	=> __('Date', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 130,
));
btp_theme_add_option( 'post_single_elem_author', array(
	'view'			=> 'Choice',
	'label'     	=> __('Author', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 140,
));
btp_theme_add_option( 'post_single_elem_comments_link', array(
	'view'			=> 'Choice',
	'label'     	=> __('Comments link', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 150,
));
btp_theme_add_option( 'post_single_elem_categories', array(
	'view'			=> 'Choice',
	'label'     	=> __('Categories', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 160,
));
btp_theme_add_option( 'post_single_elem_tags', array(
	'view'			=> 'Choice',
	'label'     	=> __('Tags', 'btp_theme'),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 170,
));
btp_theme_add_option( 'post_single_elem_about_author', array(
	'view'			=> 'Choice',
	'label'     	=> __('About author', 'btp_theme'),
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'default'		=> 'standard',
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 180,
));
btp_theme_add_option( 'post_single_elem_related_posts',	array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Related posts', 'btp_theme' ),
	'default'		=> 'standard',
    'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'post',
	'subgroup'		=> 'single',
	'position'		=> 190,
));




/* ----------------------------------------------------------------------------- */
/* ---------->>> POST OPTIONS <<<----------------------------------------------- */
/* ----------------------------------------------------------------------------- */

add_post_type_support( 'post', 'btp-sliders' );
add_post_type_support( 'post', 'btp-relations' );


btp_entry_add_option( 'subtitle', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'title_linking', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'button_1_linking', array( 'apply' => array( 'post' => true ) ) );


btp_entry_add_option( 'post_info', array(
	'apply'			=> array( 'post' => true ),
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . sprintf( __( 'To set default, inherited values for some of these options go to <a href="%s">Theme Options > Posts > Single</a>', 'btp_theme' ), network_admin_url( 'themes.php?page=theme-options#option-subgroup-post-single' ) ) . '</p>',
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 1,
)); 
btp_entry_add_option( 'post_template', array(
	'apply'			=> array( 'post' => true ),
	'view'			=> 'Image_Choice',	
	'label' 		=> __( 'Template', 'btp_theme' ),
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - media box', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',	
	'null'			=> get_template_directory_uri() . '/images/admin-assets/inherit.png',
	'choices_cb'	=> 'btp_post_get_single_templates',
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 15,
)); 


btp_entry_add_option( 'elem_sidebar_1', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_title', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_breadcrumbs', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_date', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_author', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_comments_link', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_mediabox', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_categories', array( 'apply' => array( 'post' => true ) ) );
btp_entry_add_option( 'elem_tags', array( 'apply' => array( 'post' => true ) ) );

btp_entry_add_option( 'elem_related_posts', array(
	'apply'			=> array( 'post' => true ),
	'view'			=> 'Choice',	
	'label' 		=> __( 'Related posts', 'btp_theme' ),
	'default'		=> '',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(		
		'standard'		=> __( 'show', 'btp_theme' ),			
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 140,
));



/* ----------------------------------------------------------------------------- */
/* ---------->>> TAXONOMY OPTIONS <<<------------------------------------------- */
/* ----------------------------------------------------------------------------- */




add_taxonomy_support( 'category', 'btp-sliders' );
add_taxonomy_support( 'post_tag', 'btp-sliders' );
 



require_once( dirname(__FILE__) . '/functions.php' );
require_once( dirname(__FILE__) . '/shortcodes.php' );
require_once( dirname(__FILE__) . '/widgets.php' );

?>