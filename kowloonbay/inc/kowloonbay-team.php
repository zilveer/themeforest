<?php

/* KowloonBay Team: create post type */
add_action('init', 'kowloonbay_team_register_post_type');
function kowloonbay_team_register_post_type()
{
	// Register team
	$team = array(
		'show_ui' => true,
		'show_in_menu' => true,
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-groups',
		'query_var' => 'team',
		'rewrite' => array('slug' => 'team'),
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes'
		),
		'labels' => array(
			'name' => 'Team',
			'singular_name' => 'Team Member',
			'add_new' => 'Add New Team Member',
			'add_new_item' => 'Add New Team Member',
			'edit_item' => 'Edit Team Member',
			'new_item' => 'New Team Member',
			'view_item' => 'View Team Member',
			'search_items' => 'Search Team Members',
			'not_found' => 'No Team Members Found',
			'not_found_in_trash' => 'No Team Members Found In Trash'
		),
	);

	register_post_type( 'kowloonbay_team', $team );
}