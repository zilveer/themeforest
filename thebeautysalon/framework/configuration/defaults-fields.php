<?php
/** Elderberry Fields
  *
  * This file is used to separate out some common fields
  * to make sure the defaults file isn't clittered. Also,
  * these fields are retrieved via a function so we can
  * modify the default values and other properties on a
  * case by case basis.
  *
  * @package Elderberry
  * @subpackage The Vacation Rental Admin
  *
  **/

$eb_fields = array(
	'sidebar_content' => array(
		'guid' => 'sidebar_content',
		'control' => array(
			'type' => 'select',
			'options' => 'function',
			'function' => 'get_sidebars_array',
			'initial' => array(
				'-- Default Setting --' => 'default',
			),
			'default' => 'default',
			'allow_empty' => false
		),
		'label' => 'Sidebar to Show',
		'help'  => 'Select which sidebar you would like to show on this page. You can create multiple sidebars in the theme settings.'
	),
	'sidebar_position' => array(
		'guid' => 'sidebar_position',
		'control' => array(
			'type' => 'select',
			'options' => array(
				'Left' => 'left',
				'Right' => 'right',
			),
			'initial' => array(
				'-- Default Setting --' => 'default',
			),
			'default' => 'default',
			'allow_empty' => false
		),
		'label' => 'Sidebar Position',
		'help'  => 'Modify the placement of the sidebar on this page'
	),
	'show_sidebar' => array(
		'guid' => 'show_sidebar',
		'control' => array(
			'type' => 'select',
			'options' => array(
				'Yes' => 'yes',
				'No' => 'no',
			),
			'initial' => array(
				'-- Default Setting --' => 'default',
			),
			'default_value' => 'default',
			'allow_empty' => false,
		),
		'label' => 'Show Sidebar?',
		'help'  => 'If checked the page will be shown without a sidebar'
	),
	'boxed_content' => array(
		'guid' => 'boxed_content',
		'control' => array(
			'type' => 'select',
			'options' => array(
				'Yes' => 'yes',
				'No' => 'no',
			),
			'initial' => array(
				'-- Default Setting --' => 'default',
			),
			'default_value' => 'default',
			'allow_empty' => false,
		),
		'label' => 'Boxed Content',
		'help'  => 'Specify weather you would like the content to be boxed or not'
	),
	'boxed_comments' => array(
		'guid' => 'boxed_comments',
		'control' => array(
			'type' => 'select',
			'options' => array(
				'Yes' => 'yes',
				'No' => 'no',
			),
			'initial' => array(
				'-- Default Setting --' => 'default',
			),
			'default_value' => 'default',
			'allow_empty' => false,
		),
		'label' => 'Boxed Comments',
		'help'  => 'Specify weather you would like the comments to be boxed or not'
	),
	'columns' => array(
		'guid' => 'columns',
		'control' => array(
			'type' => 'select',
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'default' => '3',
			'allow_empty' => false
		),
		'label' => 'Number of Columns',
		'help'  => 'Select the number of columns to organize content in on this page'
	),
	'category' => array(
		'guid' => 'category',
		'control' => array(
			'fullwidth' => true,
			'type' => 'dualboxes',
			'options' => '', //RF_Framework::get_taxonomy_dropdown_list( 'category' ),
			'default' => '',
			'allow_empty' => true
		),
		'label' => 'Categories',
		'help'  => 'Select the categories to use on this page'
	),
	'pages' => array(
		'guid' => 'pages',
		'control' => array(
			'fullwidth' => true,
			'type' => 'dualboxes',
			'options' => '', //RF_Framework::get_page_dropdown_list( 'page_template-mashup.php' ),
			'default' => '',
			'allow_empty' => true
		),
		'label' => 'Pages',
		'help'  => 'Select the pages to use on this page'
	),
	'layout' => array(
		'guid' => 'layout',
		'control' => array(
			'type' => 'select',
			'options' => '', //RF_Framework::get_layout_dropdown_list( $parameter ),
			'default' => '',
			'allow_empty' => false
		),
		'label' => 'Layout',
		'help'  => 'Select the layout for posts on this page'
	),
	'show_title' => array(
		'guid' => 'show_title',
		'control' => array(
			'type' => 'checkbox',
			'boxes' => array(
				'Show the title for this page?' => 'yes',
			),
			'default' => 'yes',
			'allow_empty' => true,
			'empty_value' => 'no',
		),
		'label' => 'Show Page Title?',
		'help'  => 'If checked the page title will be hidden'
	),
	'show_content' => array(
		'guid' => 'show_content',
		'control' => array(
			'type' => 'checkbox',
			'boxes' => array(
				'Show post content for this page?' => 'yes',
			),
			'default' => 'yes',
			'allow_empty' => true,
			'empty_value' => 'no',
		),
		'label' => 'Show Post Content?',
		'help'  => 'If checked the page content will be hidden'
	),
	'show_thumbnail' => array(
		'guid' => 'show_thumbnail',
		'control' => array(
			'type' => 'checkbox',
			'boxes' => array(
				'Show the featured image for this page?' => 'yes',
			),
			'default' => 'yes',
			'allow_empty' => true,
			'empty_value' => 'no'
		),
		'label' => 'Show Featured Image?',
		'help'  => 'If checked the featured image will not be shown'
	),
	'show_meta' => array(
		'guid' => 'show_meta',
		'control' => array(
			'type' => 'checkbox',
			'boxes' => array(
				'Show the metadata for this page?' => 'yes',
			),
			'default' => 'yes',
			'allow_empty' => true,
			'empty_value' => 'no',
		),
		'label' => 'Show Metadata?',
		'help'  => 'If checked the page metadata(tag, categories, author, etc.) will be hidden'
	),
	'posts_per_page' => array(
		'guid' => 'posts_per_page',
		'control' => array(
			'type' => 'text',
			'default' => get_option( 'posts_per_page' ),
			'allow_empty' => false
		),
		'label' => 'Items Per Page',
		'help'  => 'Select how many items you want to show on each page. Adding 0 or -1 will retrieve all the posts without using nn'
	),
	'orderby' => array(
		'guid' => 'orderby',
		'control' => array(
			'type' => 'select',
			'options' => array(
				'Date Published' => 'date',
				'Title' => 'title',
				'Date Modified' => 'modified',
				'Random' => 'rand',
				'Comment Count' => 'comment_count',
				'Menu Order' => 'menu_order',
			),
			'default' => 'date',
			'allow_empty' => false
		),
		'label' => 'Order By',
		'help'  => 'Select how you want to order the posts'
	),
	'order' => array(
		'guid' => 'order',
		'control' => array(
			'type' => 'radio',
			'boxes' => array(
				'Ascending' => 'ASC',
				'Descending' => 'DESC',
			),
			'default' => 'DESC',
			'allow_empty' => false
		),
		'label' => 'Order Direction',
		'help'  => 'Select the direction of the item order'
	),
	'only_thumbnailed' => array(
		'guid' => 'only_thumbnailed',
		'control' => array(
			'type' => 'checkbox',
			'boxes' => array(
				'Only show items which have thumbnails' => 'yes',
			),
			'default' => 'no',
			'allow_empty' => true,
			'empty_value' => 'no'
		),
		'label' => 'Only With Images',
		'help'  => 'Check the box to make sure only items with featured images are shown'
	),

);
?>