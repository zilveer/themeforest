<?php

add_action('init', 'sg_register_post_types');

function sg_register_post_types()
{
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => __('Portfolio', SG_TDN),
			'singular_name' => __('Portfolio Post', SG_TDN),
			'add_new' => __('Add New', SG_TDN),
			'add_new_item' => __('Add New Portfolio Post', SG_TDN),
			'edit' => __('Edit', SG_TDN),
			'edit_item' => __('Edit Portfolio Post', SG_TDN),
			'new_item' => __('New Portfolio Post', SG_TDN),
			'view' => __('View Portfolio', SG_TDN),
			'view_item' => __('View Portfolio Post', SG_TDN),
			'search_items' => __('Search Portfolio Posts', SG_TDN),
			'not_found' => __('No portfolio posts found', SG_TDN),
			'not_found_in_trash' => __('No portfolio posts in Trash', SG_TDN),
			'parent' => __('Parent Portfolio', SG_TDN),
		),
		'public' => true,
		'menu_position' => 5,
		'supports' => array('title', 'editor'),
		'rewrite' => array('slug' => _sg('General')->getPortfolioSlug(), 'with_front' => false)
	));
	
	register_taxonomy('portfolio_category', 'portfolio', array('label' => __('Portfolio Categories', SG_TDN), 'hierarchical' => false, 'rewrite' => array('slug' => _sg('General')->getPortfolioCSlug())));
	register_taxonomy('portfolio_tag', 'portfolio', array('label' => __('Portfolio Tags', SG_TDN), 'hierarchical' => false, 'rewrite' => array('slug' => _sg('General')->getPortfolioTSlug())));
	
	register_post_type('our-team', array(
		'labels' => array(
			'name' => __('Our Team', SG_TDN),
			'singular_name' => __('Our Team Post', SG_TDN),
			'add_new' => __('Add New', SG_TDN),
			'add_new_item' => __('Add New Our Team Post', SG_TDN),
			'edit' => __('Edit', SG_TDN),
			'edit_item' => __('Edit Our Team Post', SG_TDN),
			'new_item' => __('New Our Team Post', SG_TDN),
			'view' => __('View Our Team', SG_TDN),
			'view_item' => __('View Our Team Post', SG_TDN),
			'search_items' => __('Search Our Team Posts', SG_TDN),
			'not_found' => __('No our team posts found', SG_TDN),
			'not_found_in_trash' => __('No our team posts in Trash', SG_TDN),
			'parent' => __('Parent', SG_TDN),
		),
		'public' => true,
		'menu_position' => 6,
		'supports' => array('title', 'editor'),
		'rewrite' => array('slug' => 'our-team', 'with_front' => false)
	));
	
	register_taxonomy('our-team_category', 'our-team', array('label' => __('Team Categories', SG_TDN), 'hierarchical' => false));
	
	register_post_type('extra', array(
		'labels' => array(
			'name' => __('Extras', SG_TDN),
			'singular_name' => __('Extra Post', SG_TDN),
			'add_new' => __('Add New', SG_TDN),
			'add_new_item' => __('Add New Extra Post', SG_TDN),
			'edit' => __('Edit', SG_TDN),
			'edit_item' => __('Edit Extra Post', SG_TDN),
			'new_item' => __('New Extra Post', SG_TDN),
			'view' => __('View Extras', SG_TDN),
			'view_item' => __('View Extra Post', SG_TDN),
			'search_items' => __('Search Extra Posts', SG_TDN),
			'not_found' => __('No extra posts found', SG_TDN),
			'not_found_in_trash' => __('No extra posts in Trash', SG_TDN),
			'parent' => __('Parent', SG_TDN),
		),
		'public' => true,
		'menu_position' => 7,
		'supports' => array('title', 'editor'),
		'rewrite' => array('slug' => 'extra', 'with_front' => false)
	));
	
	register_taxonomy('extra_category', 'extra', array('label' => __('Extra Categories', SG_TDN), 'hierarchical' => false));
	
	if (get_option(SG_SLUG . 'sgp-general-changed')) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		delete_option(SG_SLUG . 'sgp-general-changed');
	}
}