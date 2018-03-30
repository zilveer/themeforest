<?php

/**
	Portfolio Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_portfolio
		@version 1.2
**/

// air_portfolio
class air_portfolio extends Air {

	protected static
		// Option name
		$option_name = 'air-portfolio',
		// Options
		$options;

	/**
		Initialize module
			@public
	**/
	static function init() {
		// Get options
		self::$options = get_option(self::$option_name);
		
		// Set default options, if necessary
		if ( self::$options == FALSE ) {
			update_option(self::$option_name,'');
		}
		
		// Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		// Enable Portfolio
		if ( self::get_option('portfolio-enable') ) {
			self::register_type_and_taxonomy();
		}
	}

	/**
		Get module option
			@public
	**/
	static function get_option($key,$default=FALSE) {
		if ( isset(self::$options[$key]) && self::$options[$key] )
			return self::$options[$key];
		else
			return $default;
	}

	/**
		Admin init
			@public
	**/
	static function admin_init() {
		// Register settings
		register_setting(self::$option_name.'-settings', self::$option_name,
			'AirValidate::init_module');
	}

	/**
		Enable portfolio
			@private
	**/
	static function register_type_and_taxonomy() {
		// Label
		$label = self::get_option('label','Portfolio');

		// Portfolio archive
		$has_archive = self::get_option('has_archive')?TRUE:FALSE;

		// Get rewrite slugs
		$slug_type = self::get_option('portfolio-rewrite-type', 'portfolio');
		$slug_taxonomy = self::get_option('portfolio-rewrite-taxonomy', 'category');

		// Set rewrite args
		if ( self::$vars['PERMALINKS'] ) {
			// Taxonomy rewrite
			if ( $slug_type && $slug_taxonomy ) {
				$rewrite_taxonomy = array(
					'slug'		 => $slug_type.'/'.$slug_taxonomy,
					'with_front' => FALSE
				);
			}

			// Post type rewrite
			if ( $slug_type ) {
				$rewrite_type = array(
					'slug' 		 => $slug_type,
					'with_front' => FALSE
				);
			}
		}

		// Register Taxonomy
		register_taxonomy('portfolio_category',array('portfolio'),
			array(
				'hierarchical'	=> TRUE,
				'public'		=> TRUE,
				'rewrite'		=> isset($rewrite_taxonomy)?$rewrite_taxonomy:FALSE
			)
		);

		// Register post type
		register_post_type('portfolio',
			array(
				'labels'		=> array(
					'name'					=> $label,
					'add_new'				=> _x('Add New','air'),
					'add_new_item'			=> __('Add New Item','air'),
					'edit_item'				=> __('Edit Item','air'),
					'new_item'				=> __('New Item','air'),
					'all_items'				=> __('Portfolio','air'),
					'view_item'				=> __('View Item','air'),
					'search_items'			=> __('Search Items','air'),
					'not_found'				=> __('No items found','air'),
					'not_found_in_trash'	=> __('No items found in Trash','air'), 
					'parent_item_colon'		=> '',
					'menu_name'				=> 'Portfolio'
				),
				'public'		=> TRUE,
				'has_archive'	=> $has_archive,
				'supports'		=> array('title','editor','excerpt','author','thumbnail','comments'),
				'rewrite'		=> isset($rewrite_type)?$rewrite_type:FALSE,
				'menu_position'	=> 20,
				'taxonomies'	=> array('portfolio_category')
			)
		);
	}

	/**
		Get category list
			@public

	**/
	static function get_category_list($sep=', ') {
		global $post;
		$terms = get_the_terms($post->ID,'portfolio_category');
		if ( $terms && !isset($terms->errors) ) {
			foreach($terms as $term) {
				$cats[] = $term->name;
			}
		}
		return isset($cats)?implode($sep,$cats):FALSE;
	}

	/**
		Get category slugs
			@public

	**/
	static function get_category_slugs($sep=' ') {
		global $post;
		$terms = get_the_terms($post->ID,'portfolio_category');
		if ( $terms && !isset($terms->errors) ) {
			foreach($terms as $term) {
				$cats[] = $term->slug;
			}
		}
		return isset($cats)?implode($sep,$cats):FALSE;
	}

	/**
		Isotope Menu
			@public
	**/
	static function isotope_menu($category=FALSE) {
		// Get terms
		if ( $category ) {
			$terms = get_terms('portfolio_category',
				array(
					'child_of' => $category
				)
			);
		} else {
			$terms = get_terms('portfolio_category');
		}
		// Define menu
		$menu = '';
		// Loop through terms
		if ( $terms && !isset($terms->errors) ) {
			foreach ( $terms as $term ) {
				$menu .= '<li><a href="#" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
			}
		}
		// Print menu
		echo $menu;
	}

	/**
		Meta Category Dropdown
			@public
	**/
	static function meta_category_dropdown() {
		// Get terms
		$terms = get_terms('portfolio_category');
		// Build dropdown choices
		$choices = array(__('All','air'));
		if ( $terms && !isset($terms->errors) ) {
			foreach ( $terms as $term ) {
				$choices[$term->term_id] = $term->name;
			}
		}
		return $choices;
	}

}

// Initialize module
air_portfolio::init();
