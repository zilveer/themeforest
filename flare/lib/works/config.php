<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1. Theme Options - related with module
 * 2. Custom post type - btp_work
 * 3. Custom taxonomies - btp_work_category and btp_work_tag
 * 4. Post Options - meta fields related with btp_work
 * 5. Taxonomy Options - meta fields related with btp_work_category and btp_work_tag
 */


/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );


 
/* ----------------------------------------------------------------------------- */
/* ---------->>> THEME OPTIONS <<<---------------------------------------------- */
/* ----------------------------------------------------------------------------- */
btp_theme_add_option_group( 'btpwork', array( 'label' => __( 'Works', 'btp_theme' ) ), 700 );

btp_theme_add_option_subgroup( 
	'index', 
	array( 
		'label' => __( 'Index', 'btp_theme' ),
	), 
	'btpwork', 
	100 
);
btp_theme_add_option_subgroup( 
	'archive', 
	array( 
		'label' => __( 'Archive', 'btp_theme' ),
	), 
	'btpwork', 
	200
);
btp_theme_add_option_subgroup( 
	'single', 
	array( 
		'label' => __( 'Single', 'btp_theme' ),		
	), 
	'btpwork', 
	300
);






// ----------------------------------------------------------------------
// Works > Index
// ----------------------------------------------------------------------
btp_theme_add_option( 'btp_work_index_default_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . __( 'Set up the options for the Work Index Page',  'btp_theme' ) . '</p>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 90,
));


btp_theme_add_option( 'btp_work_index_page', array(
	'view'			=> 'Choice',
	'label' 		=> __('Index Page', 'btp_theme'),
	'choices_cb'	=> 'btp_page_get_choices',
	'null'			=>'',
	'help'			=> 
		'<p>' . __( 'Few points about this page:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Page template will be ignored. Instead one of the below templates will be used.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Any content will be ignored.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'All other elements ( like title, sidebar, background, etc.  ) should work fine.', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 100,
));		
btp_theme_add_option( 'btp_work_index_template', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Template', 'btp_theme'),
	'default'		=> '4-columns',
	'choices_cb'	=> 'btp_work_get_archive_templates',
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - featured media', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Green - navigation', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 110,
));
btp_theme_add_option( 'btp_work_index_collection_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Collection options',  'btp_theme' ) . '</h3>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 115,
));
btp_theme_add_option( 'btp_work_index_posts_per_page', array(
	'label' 		=> __('Entries per page', 'btp_theme'),
	'default'		=> 16,
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 120,
));
btp_theme_add_option( 'btp_work_index_elem_title', array(
	'view'			=> 'Choice',
	'label'     	=> __('Title', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 130,
));
btp_theme_add_option( 'btp_work_index_elem_featured_media', array(
	'view'			=> 'Choice',
	'label'     	=> __('Featured media', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 140,
));
btp_theme_add_option( 'btp_work_index_elem_date', array(
	'view'			=> 'Choice',
	'label'     	=> __('Date', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 150,
));
btp_theme_add_option( 'btp_work_index_elem_comments_link', array(
	'view'			=> 'Choice',
	'label'     	=> __('Comments link', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 160,
));
btp_theme_add_option( 'btp_work_index_elem_summary', array(
	'view'			=> 'Choice',
	'label'     	=> __('Summary', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 170,
));
btp_theme_add_option( 'btp_work_index_elem_categories', array(
	'view'			=> 'Choice',
	'label'     	=> __('Categories', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 180,
));
btp_theme_add_option( 'btp_work_index_elem_tags', array(
	'view'			=> 'Choice',
	'label'     	=> __('Tags', 'btp_theme'),
	'default'		=> 'standard',	
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 190,
));
btp_theme_add_option( 'btp_work_index_elem_button_1', array(
	'view'			=> 'Choice',
	'label'     	=> __('Button', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'index',
	'position'		=> 200,
));


// ----------------------------------------------------------------------
// Works > Archive
// ----------------------------------------------------------------------
btp_theme_add_option( 'btp_work_category_rewrite_slug', array(
	'label' 		=> __( 'Work Category base', 'btp_theme' ),
	'hint'			=> __( 'This will be used as a part of the link.', 'btp_theme' ),
	'help'			=> 
		'<p>' . __( 'A few points about this option:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Use only lowercase letters, digits, hyphen and underscore', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Keep it unique across the whole site. No other page, category or tag should have the same slug.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'To see the changes you must go to <a href="%s">the Permalinks</a> section and click "Save changes" to flush rewrite rules.' ) . '</li>' .
		'</ul>', 
	'default'		=> 'work-category',
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 70,
));
btp_theme_add_option( 'btp_work_tag_rewrite_slug', array(
	'label' 		=> __( 'Work Tag base', 'btp_theme' ),
	'hint'			=> __( 'This will be used as a part of the link.', 'btp_theme' ),
	'help'			=> 
		'<p>' . __( 'A few points about this option:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Use only lowercase letters, digits, hyphen and underscore', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Keep it unique across the whole site. No other page, category or tag should have the same slug.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'To see the changes you must go to <a href="%s">the Permalinks</a> section and click "Save changes" to flush rewrite rules.' ) . '</li>' .
		'</ul>', 
	'default'		=> 'work-tag',
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 70,
));
btp_theme_add_option( 'btp_work_archive_default_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . __( 'Set up <strong>the default options</strong> for all Work Archive Pages: Work Category Archive, Work Tag Archive',  'btp_theme' ) . '</p>' .
		'<p>' . sprintf( __( 'Note, however, that <strong>you can override</strong> some of these options for each individual <a href="%s">work category</a> and <a href="%s">work tag</a>.',  'btp_theme' ), network_admin_url( 'edit-tags.php?taxonomy=btp_work_category&post_type=btp_work' ), network_admin_url( 'edit-tags.php?taxonomy=btp_work_tag&post_type=btp_work' ) ) . '</p>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 90,
));
btp_theme_add_option( 'btp_work_archive_template', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Template', 'btp_theme'),
	'default'		=> '4-columns',
	'choices_cb'	=> 'btp_work_get_archive_templates',
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - featured media', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Green - navigation', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 100,
));

btp_theme_add_option( 'btp_work_archive_elem_sidebar_1', array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Sidebar', 'btp_theme' ),
	'hint'			=> __( 'It makes sense only with a template that supports a sidebar.', 'btp_theme' ),	
	'default'		=> 'primary',
	'choices_cb'	=> 'btp_sidebar_get_choices',
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 104,
));
btp_theme_add_option( 'btp_work_archive_collection_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Collection options',  'btp_theme' ) . '</h3>',
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 105,
));
btp_theme_add_option( 'btp_work_archive_posts_per_page', array(
	'label' 		=> __('Entries per page', 'btp_theme'),
	'default'		=> 16,
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 110,
));
btp_theme_add_option( 'btp_work_archive_elem_title', array(
	'view'			=> 'Choice',
	'label'     	=> __('Title', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 120,
));
btp_theme_add_option( 'btp_work_archive_elem_featured_media', array(
	'view'			=> 'Choice',
	'label'     	=> __('Featured media', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 130,
));
btp_theme_add_option( 'btp_work_archive_elem_date', array(
	'view'			=> 'Choice',
	'label'     	=> __('Date', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 140,
));
btp_theme_add_option( 'btp_work_archive_elem_comments_link', array(
	'view'			=> 'Choice',
	'label'     	=> __('Comments link', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 150,
));
btp_theme_add_option( 'btp_work_archive_elem_categories', array(
	'view'			=> 'Choice',
	'label'     	=> __('Categories', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 160,
));
btp_theme_add_option( 'btp_work_archive_elem_tags', array(
	'view'			=> 'Choice',
	'label'     	=> __('Tags', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 170,
));
btp_theme_add_option( 'btp_work_archive_elem_summary', array(
	'view'			=> 'Choice',
	'label'     	=> __('Summary', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 180,
));
btp_theme_add_option( 'btp_work_archive_elem_button_1', array(
	'view'			=> 'Choice',
	'label'     	=> __('Button', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'archive',
	'position'		=> 190,
));



// ----------------------------------------------------------------------
// Works > Single
// ----------------------------------------------------------------------
btp_theme_add_option( 'btp_work_rewrite_slug', array(
	'label' 		=> __( 'Link base', 'btp_theme' ),
	'hint'			=> __( 'This will be used as a part of the permalink.', 'btp_theme' ),
	'help'			=> 
		'<p>' . __( 'A few points about this option:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Use only lowercase letters, digits, hyphen and underscore', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Keep it unique across the whole site. No other page, category or tag should have the same slug.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'To see the changes you must go to <a href="%s">the Permalinks</a> section and click "Save changes" to flush rewrite rules.' ) . '</li>' .
		'</ul>', 
	'default'		=> 'work',
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 80,
));
btp_theme_add_option( 'btp_work_single_default_options_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=> 
			'<p>' . __( 'Set up <strong>default options</strong> for all Single Work pages.', 'btp_theme' ) . '</p>' .
			'<p>' . sprintf( __( 'Note, however, that <strong>you can override</strong> some of these options for each individual <a href="%s">work</a>.',  'btp_theme' ), network_admin_url( 'edit.php?post_type=btp_work' ) ) . '</p>',	
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 90,
));
btp_theme_add_option( 'btp_work_single_template', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __( 'Template', 'btp_theme' ),
	'default'		=> 'three-fourths-sidebar-right',
	'choices_cb'	=> 'btp_work_get_single_templates',
	'group'			=> 'btpwork',
	'help'			=>
		'<p>' . __( 'Color legend:' , 'btp_theme') . '</p>' .
		'<ul>' .
			'<li>' . __( 'Dark grey - media box', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Light grey - other content', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Blue - sidebar', 'btp_theme' ) . '</li>' .
		'</ul>',
	'subgroup'		=> 'single',
	'position'		=> 100,
));
btp_theme_add_option( 'btp_work_single_elem_sidebar_1', array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Sidebar', 'btp_theme' ),
	'hint'			=> __( 'It makes sense only with a template that supports a sidebar.', 'btp_theme' ),	
	'default'		=> 'primary',
	'choices_cb'	=> 'btp_sidebar_get_choices',
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 108,
));
btp_theme_add_option( 'btp_work_single_elem_title', array(
	'view'			=> 'Choice',
	'label'     	=> __('Title', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	), 
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 110,
));
btp_theme_add_option( 'btp_work_single_elem_mediabox', array(
	'view'			=> 'Choice',
	'label'     	=> __( 'Media box', 'btp_theme' ),
	'help_cb'		=> 'btp_mediabox_get_help',
	'default'		=> 'list',
	'choices_cb'	=> 'btp_mediabox_get_choices',
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 120,
));
btp_theme_add_option( 'btp_work_single_elem_date', array(
	'view'			=> 'Choice',
	'label'     	=> __('Date', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 130,
));
btp_theme_add_option( 'btp_work_single_elem_comments_link', array(
	'view'			=> 'Choice',
	'label'     	=> __('Comments link', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 140,
));
btp_theme_add_option( 'btp_work_single_elem_categories', array(
	'view'			=> 'Choice',
	'label'     	=> __('Categories', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),	
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 150,
));
btp_theme_add_option( 'btp_work_single_elem_tags', array(
	'view'			=> 'Choice',
	'label'     	=> __('Tags', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 160,
));
btp_theme_add_option( 'btp_work_single_elem_related_works', array(
	'view'			=> 'Choice',
	'label'     	=> __('Related works', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'btpwork',
	'subgroup'		=> 'single',
	'position'		=> 200,
));




/* ----------------------------------------------------------------------------- */
/* ---------->>> CUSTOM POST TYPE <<<------------------------------------------- */
/* ----------------------------------------------------------------------------- */



/**
 * Registers custom post type "btp_work"
 * 
 * If you want to modify some paremeters, hook into the btp_pre_register_post_type custom filter.
 */
function btp_work_register_post_type() {
	$args = array(
		'label'		=> __('Works', 'btp_theme'),
		'labels'	=> array(
			'name'					=> __( 'Works', 'btp_theme' ),
			'singular_name' 		=> __( 'Work', 'btp_theme' ),
			'add_new' 				=> __( 'Add new', 'btp_theme' ),
			'all_items' 			=> __( 'All Works', 'btp_theme' ),
			'add_new_item' 			=> __( 'Add new Work', 'btp_theme' ),
			'edit_item' 			=> __( 'Edit Work', 'btp_theme' ),
			'new_item' 				=> __( 'New Work', 'btp_theme' ),
			'view_item' 			=> __( 'View Work', 'btp_theme' ),
			'search_items' 			=> __( 'Search Works', 'btp_theme' ),
			'not_found' 			=> __( 'No Works found', 'btp_theme' ),
			'not_found_in_trash'	=> __( 'No Works found in Trash', 'btp_theme' ),
			'parent_item_colon' 	=> __( 'Parent Work', 'btp_theme' ), 
			'menu_name'				=> __( 'Works', 'btp_theme' ),
		),
		'public'				=> true,
		'publicly_queryable'	=> true,
		'exclude_from_search'	=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'hierarchical'			=> false,
		'supports'				=> array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments', 'revisions'),
		'has_archive'			=> true, 				
		'rewrite'				=> array('slug' => 'work', 'with_front' => true),
		'query_var'				=> 'btp_work',
		'can_export'			=> true,
		'show_in_nav_menus'		=> true,
	);
	$slug = sanitize_title( btp_theme_get_option_value( 'btp_work_rewrite_slug' ) );
	if( strlen( $slug ) ) {
		$args[ 'rewrite' ][ 'slug' ] = $slug;
	}
	
	/* Apply custom filters (this way Child Themes can change some arguments) */
	$args = apply_filters( 'btp_pre_register_post_type', $args, 'btp_work' );
	
	register_post_type( 'btp_work', $args );
}
add_action( 'init', 'btp_work_register_post_type' );




/* ----------------------------------------------------------------------------- */
/* ---------->>> CUSTOM TAXONOMIES <<<------------------------------------------ */
/* ----------------------------------------------------------------------------- */



/**
 * Registers custom taxonomies "btp_work_category" and "btp_work_tag"
 * 
 * If you want to modify some paremeters, hook into the btp_pre_register_custonomy custom filter.
 */
function btp_work_register_taxonomies() {	
	/* Compose arguments for btp_work_category */
	$args = array(
        'label' 				=> __('Work Category', 'btp_theme'),
     	'labels'				=> array(
     		'name' 					=> __( 'Work Categories', 'btp_theme' ),
    		'singular_name' 		=> __( 'Work Category', 'btp_theme' ),
    		'search_items' 			=> __( 'Search Work Categories', 'btp_theme' ),
			'popular_items' 		=> __( 'Popular Work Categories', 'btp_theme' ),
    		'all_items' 			=> __( 'All Work Categories', 'btp_theme' ),
    		'parent_item' 			=> __( 'Parent Work Category', 'btp_theme' ),
    		'parent_item_colon' 	=> __( 'Parent Work Category:', 'btp_theme' ),
    		'edit_item' 			=> __( 'Edit Work Category', 'btp_theme' ), 
    		'update_item' 			=> __( 'Update Work Category', 'btp_theme' ),
    		'add_new_item' 			=> __( 'Add New Work Category', 'btp_theme' ),
    		'new_item_name' 		=> __( 'New Work Category', 'btp_theme' ),
			'menu_name' 			=> __( 'Work Categories', 'btp_theme' ),
     	),    	  
        'query_var' 			=> 'btp_work_category',     	
     	'rewrite' 				=> array('slug' => 'work-category', 'with_front' => true),
     	'public'				=> true,
     	'hierarchical' 			=> true,
     	'show_in_nav_menus'		=> true,
     	'show_ui'				=> true,
     	'show_tagcloud'			=> true,
	);	

	$slug = sanitize_title( btp_theme_get_option_value( 'btp_work_category_rewrite_slug' ) );
	if( strlen( $slug ) ) {
		$args[ 'rewrite' ][ 'slug' ] = $slug;
	}
	
	/* Apply custom filters (this way Child Themes can change some arguments) */
	$args = apply_filters( 'btp_pre_register_custonomy', $args, 'btp_work_category' );
	
	register_taxonomy( 'btp_work_category', array('btp_work'), $args );
	

	/* Compose arguments for btp_work_tag */
	$args = array(        	
        'label' 				=> __('Work Tag', 'btp_theme'),
     	'labels'				=> array(
     		'name' 					=> __( 'Work Tags', 'btp_theme' ),
    		'singular_name' 		=> __( 'Work Tag', 'btp_theme' ),
    		'search_items' 			=> __( 'Search Work Tags', 'btp_theme' ),
			'popular_items' 		=> __( 'Popular Work Tags', 'btp_theme' ),
    		'all_items' 			=> __( 'All Work Tags', 'btp_theme' ),
    		'parent_item' 			=> __( 'Parent Work Tag', 'btp_theme' ),
    		'parent_item_colon' 	=> __( 'Parent Work Tag:', 'btp_theme' ),
    		'edit_item' 			=> __( 'Edit Work Tag', 'btp_theme' ), 
    		'update_item' 			=> __( 'Update Work Tag', 'btp_theme' ),
    		'add_new_item' 			=> __( 'Add New Work Tag', 'btp_theme' ),
    		'new_item_name' 		=> __( 'New Work Tag', 'btp_theme' ),
			'menu_name' 			=> __( 'Work Tags', 'btp_theme' ),     				
     	),  
        'query_var' 			=> 'btp_work_tag',
     	'rewrite' 				=> array(
     		'slug' =>'work-tag', 
     		'with_front' => true
     	),
     	'public'				=> true,
     	'hierarchical' 			=> false,
     	'show_in_nav_menus'		=> true,
     	'show_ui'				=> true,
     	'show_tagcloud'			=> true,  		
     );  

	$slug = sanitize_title( btp_theme_get_option_value( 'btp_work_tag_rewrite_slug' ) );
	if( strlen( $slug ) ) {
		$args[ 'rewrite' ][ 'slug' ] = $slug;
	}

	/* Apply custom filters (this way Child Themes can change some arguments) */
	$args = apply_filters( 'btp_pre_register_taxonomy', $args, 'btp_work_tag' );
	
	register_taxonomy( 'btp_work_tag', array('btp_work'), $args );	
}
add_action( 'init', 'btp_work_register_taxonomies' );


add_taxonomy_support( 'btp_work_category', 'btp-backgrounds' );
add_taxonomy_support( 'btp_work_category', 'btp-sliders' );
add_taxonomy_support( 'btp_work_tag', 'btp-backgrounds' );
add_taxonomy_support( 'btp_work_tag', 'btp-sliders' );
 
 
/* ----------------------------------------------------------------------------- */
/* ---------->>> POST OPTIONS <<<----------------------------------------------- */
/* ----------------------------------------------------------------------------- */
add_post_type_support( 'btp_work', 'btp-backgrounds' );
add_post_type_support( 'btp_work', 'btp-sliders' );
add_post_type_support( 'btp_work', 'btp-relations' );



btp_entry_add_option( 'subtitle', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'title_linking', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'button_1_linking', array( 'apply' => array( 'btp_work' => true ) ) );



btp_entry_add_option( 'work_info', array(
	'apply'			=> array( 'btp_work' => true ),
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . sprintf( __( 'To set default, inherited values for some of these options go to <a href="%s">Theme Options > Works > Single</a>', 'btp_theme' ), network_admin_url( 'themes.php?page=theme-options#option-subgroup-work-single' ) ) . '</p>',
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 1,
)); 


btp_entry_add_option( 'work_template', array(
	'apply'			=> array( 'btp_work' => true ),
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
	'choices_cb'	=> 'btp_work_get_single_templates',
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 15,
)); 
 


btp_entry_add_option( 'elem_sidebar_1', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_title', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_breadcrumbs', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_date', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_comments_link', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_mediabox', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_categories', array( 'apply' => array( 'btp_work' => true ) ) );
btp_entry_add_option( 'elem_tags', array( 'apply' => array( 'btp_work' => true ) ) );



btp_entry_add_option( 'elem_related_works', array(
	'apply'			=> array( 'btp_work' => true ),
	'view'			=> 'Choice',	
	'label' 		=> __( 'Related works', 'btp_theme' ),
	'default'		=> '',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(		
		'standard'	=> __( 'show', 'btp_theme' ),			
		'none'		=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 140,
));

 
/* ----------------------------------------------------------------------------- */
/* ---------->>> TAXONOMY OPTIONS <<<------------------------------------------- */
/* ----------------------------------------------------------------------------- */

btp_term_add_option( 'template', array(
	'apply'			=> array( 'btp_work_category' => true, 'btp_work_tag' => true ),
	'view'			=> 'Image_Choice',
	'label' 		=> __( 'Template', 'btp_theme' ),
	'null'			=> get_template_directory_uri() . '/images/admin-assets/inherit.png',
	'choices_cb'	=> 'btp_work_get_archive_templates',
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 10,
));
btp_term_add_option( 'posts_per_page', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_sidebar_1', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_title', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_featured_media', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_date', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_comments_link', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_summary', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_categories', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_tags', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );
btp_term_add_option( 'elem_button_1', array( 'apply' => array( 'btp_work_category' => true, 'btp_work_tag' => true ) ) );



require_once( dirname(__FILE__) . '/functions.php' );
require_once( dirname(__FILE__) . '/shortcodes.php' );
require_once( dirname(__FILE__) . '/widgets.php' );
?>