<?php

/*
 * Copyright 2010 Matt Wiebe.
 *
 * This code is licensed under the GPL v2.0
 * http://www.opensource.org/licenses/gpl-2.0.php
 *
 * If you do something cool with it, let me know! http://somadesign.ca/contact/
 *
 * Version 1.3
 *
 * === Changelog ===
 *
 * 1.0
 *  - Initial release
 * 1.1
 *  - Added feed support in URL rewrites
 * 1.2
 *  - Removed redundant post_class code.
 *  - Removed redundant single post_type template code
 *  - Introduced directory support for template files
 * 1.3
 *  - Use the newer, more robust labels array to set defaults
 *  - Add possible support for adding post_type to nav_menus. Commented out by default since the 'show_in_nav_menus' $arg should provide for that, although it doesn't seem to work right now.
 *
 */

/**
 * SD_Register_Post_Type class
 *
 * @author Matt Wiebe
 * @link http://somadesign.ca
 *
 * @param string $post_type The post type to register
 * @param array $args The arguments to pass into @link register_post_type(). Some defaults provided to ensure the UI is available.
 * @param string $custom_plural The plural name to be used in rewriting (http://yourdomain.com/custom_plural/ ). If left off, an "s" will be appended to your post type, which will break some words. (person, box, ox. Oh, English.)
 **/

if ( ! class_exists('SD_Register_Post_Type') ) {

	class SD_Register_Post_Type {

		private $post_type;
		private $post_slug;
		private $args;
		private $post_type_object;
		private $callback_limit;

		private $defaults = array(
			'show_ui' => true,
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail')
		);

		private function set_defaults() {
			$plural = ucwords( $this->post_slug );
			$post_type = ucwords( $this->post_type );

			$this->defaults['labels'] = array(
				'name' => $plural,
				'singular_name' => $post_type,
				'add_new_item' => 'Add New ' . $post_type,
				'edit_item' => 'Edit ' . $post_type,
				'new_item' => 'New ' . $post_type,
				'view_item' => 'View ' . $post_type,
				'search_items' => 'Search ' . $plural,
				'not_found' => 'No ' . $plural . ' found',
				'not_found_in_trash' => 'No ' . $plural . ' found in Trash'
			);
		}

		public function __construct( $post_type = null, $args = array(), $custom_plural = false, $callback_limit = '' ) {
			if ( ! $post_type ) {
				return;
			}

			// meat n potatoes
			$this->post_type = $post_type;
			$this->callback_limit = $callback_limit;

			// do we have a rewrite slug?
			if(isset($args['rewrite']) && is_array($args['rewrite']) && isset($args['rewrite']['slug']) && is_string($args['rewrite']['slug'])) {
				$this->post_slug = $args['rewrite']['slug'];
			} else {
				$args['rewrite'] = array();
				$this->post_slug = $args['rewrite']['slug'] = ( $custom_plural ) ? $custom_plural : $post_type . 's';
			}

			// a few extra defaults. Mostly for labels. Overridden if proper $args present.
			$this->set_defaults();
			// sort out those $args
			$this->args = wp_parse_args($args, $this->defaults);

			// magic man
			$this->add_actions();
			$this->add_filters();

		}

		public function add_actions() {
			add_action( 'init', array($this, 'register_post_type') );
			add_action( 'template_redirect', array($this, 'context_fixer') );
			if (!empty($this->callback_limit))
				add_action( 'option_posts_per_page', $this->callback_limit, 12);
		}

		public function add_filters() {
			add_filter( 'generate_rewrite_rules', array($this, 'add_rewrite_rules') );
			add_filter( 'template_include', array($this, 'template_include') );
			add_filter( 'body_class', array($this, 'body_classes') );
			add_filter( 'wp_title', array($this, 'title_fixer'), 10, 3 );
		}

		public function post_limits() {

		}

		public function context_fixer() {
			if ( get_query_var( 'post_type' ) == $this->post_type ) {
				global $wp_query;
				$wp_query->is_home = false;
			}
		}

		public function add_rewrite_rules( $wp_rewrite ) {

			$new_rules = array();
			$new_rules[$this->post_slug . '/page/?([0-9]{1,})/?$'] = 'index.php?post_type=' . $this->post_type . '&paged=' . $wp_rewrite->preg_index(1);
			$new_rules[$this->post_slug . '/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&feed=' . $wp_rewrite->preg_index(1);
			$new_rules[$this->post_slug . '/?$'] = 'index.php?post_type=' . $this->post_type;

			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&day=' . $wp_rewrite->preg_index(3) .'&feed=' . $wp_rewrite->preg_index(4);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&day=' . $wp_rewrite->preg_index(3) .'&feed=' . $wp_rewrite->preg_index(4);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&day=' . $wp_rewrite->preg_index(3) .'&paged=' . $wp_rewrite->preg_index(4);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&day=' . $wp_rewrite->preg_index(3);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&feed=' . $wp_rewrite->preg_index(3);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&feed=' . $wp_rewrite->preg_index(3);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2) .'&paged=' . $wp_rewrite->preg_index(3);
			$new_rules[$this->post_slug . '/([0-9]{4})/([0-9]{1,2})/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&monthnum=' . $wp_rewrite->preg_index(2);
			$new_rules[$this->post_slug . '/([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&feed=' . $wp_rewrite->preg_index(2);
			$new_rules[$this->post_slug . '/([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&feed=' . $wp_rewrite->preg_index(2);
			$new_rules[$this->post_slug . '/([0-9]{4})/page/?([0-9]{1,})/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1) .'&paged=' . $wp_rewrite->preg_index(2);
			$new_rules[$this->post_slug . '/([0-9]{4})/?$'] = 'index.php?post_type=' . $this->post_type . '&year=' . $wp_rewrite->preg_index(1);

			$wp_rewrite->rules = array_merge($new_rules, $wp_rewrite->rules);
			return $wp_rewrite;
		}

		public function register_post_type() {
			register_post_type( $this->post_type, $this->args );
		}

		public function template_include( $template ) {

			$attachment_parent_post_type = false;
			if( is_attachment() ) {
				global $wp_query;
				$attachment = $wp_query->get_queried_object();
				$attachment_parent_post_type = get_post_type( $attachment->post_parent );
			}

			// update to helper class for registering WordPress custom post types
			if ( !is_search() && (get_post_type() == $this->post_type || $attachment_parent_post_type == $this->post_type) ) {

				$template_name = basename( $template, '.php' );

				if( is_single() ) { // single post

					$templates = array();

					if( is_attachment() ) { // attachment

						$mime_type = get_post_mime_type();

						$templates = array(
							$this->post_type . '/' . $mime_type . '.php',
							$this->post_type . '/attachment.php'
						);

					}

					$template = locate_template( array_merge( $templates, array(
						$this->post_type . '/single.php', // just in case $template_name != single.php
						$this->post_type . '/' . $template_name . '.php',
						$this->post_type . '/index.php',
						$this->post_type . '.php',
						$template_name . '.php'
					) ) );

				} elseif( is_tax() ) { // taxonomy archive

					$taxonomy = get_query_var('taxonomy');
					$term = get_query_var('term');

					$page_num = ( get_query_var('paged') )?get_query_var('paged'):1;

					$template = locate_template( array(
						$this->post_type . '/taxonomy-' . $taxonomy . '-' . $term . '-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '/taxonomy-' . $taxonomy . '-' . $term . '.php',
						$this->post_type . '/taxonomy-' . $taxonomy  . '-page' . $page_num . '.php',//look for page version of archive
						$this->post_type . '/taxonomy-' . $taxonomy  . '.php',
						$this->post_type . '/taxonomy-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '/taxonomy.php',
						$this->post_type . '/archive-page' . $page_num . '.php', // just in case $template_name != archive.php, look for page version of archive
						$this->post_type . '/archive.php', // just in case $template_name != archive.php
						$this->post_type . '/' . $template_name . '-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '/' . $template_name . '.php',
						$this->post_type . '/index-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '/index.php',
						$this->post_type . '-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '.php',
						$template_name . '.php'
					) );

				} else { //everything else, including index

					$page_num = ( get_query_var('paged') )?get_query_var('paged'):1;

					$template = locate_template( array(
						$this->post_type . '/' . $template_name . '-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '/' . $template_name . '.php',
						$this->post_type . '/index-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '/index.php',
						$this->post_type . '-page' . $page_num . '.php', //look for page version of archive
						$this->post_type . '.php',
						$template_name . '.php'
					) );

				}

			}

			return $template;
		}

		public function body_classes( $c ) {
			if ( get_query_var('post_type') === $this->post_type ) {
				$c[] = $this->post_type;
				$c[] = 'type-' . $this->post_type;
			}
			return $c;
		}

		public function title_fixer($title, $sep, $seplocation) {
			if (($post_type = is_custom_post()) && ($post_type->name == $this->post_type)) {
				$title = $post_type->label;
				$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

				$prefix = '';
				if ( !empty($title) )
					$prefix = " $sep ";

				// Determines position of the separator and direction of the breadcrumb
				if ( 'right' == $seplocation ) { // sep on right, so reverse the order
					$title_array = explode( $t_sep, $title );
					$title_array = array_reverse( $title_array );
					$title = implode( " $sep ", $title_array ) . $prefix;
				} else {
					$title_array = explode( $t_sep, $title );
					$title = $prefix . implode( " $sep ", $title_array );
				}

				return $title;
			}
		}


	} // end SD_Register_Post_Type class

	/**
	 * A helper function for the SD_Register_Post_Type class. Because typing "new" is hard.
	 *
	 * @author Matt Wiebe
	 * @link http://somadesign.ca
	 *
	 * @uses SD_Register_Post_Type class
	 * @param string $post_type The post type to register
	 * @param array $args The arguments to pass into @link register_post_type(). Some defaults provided to ensure the UI is available.
	 * @param string $custom_plural The plural name to be used in rewriting (http://yourdomain.com/custom_plural/ ). If left off, an "s" will be appended to your post type, which will break some words. (person, box, ox. Oh, English.)
	 **/

	if ( ! function_exists( 'sd_register_post_type' ) && class_exists( 'SD_Register_Post_Type' ) ) {
		function sd_register_post_type( $post_type = null, $args=array(), $custom_plural = false, $callback_limit = '' ) {
			$custom_post = new SD_Register_Post_Type( $post_type, $args, $custom_plural, $callback_limit );
		}
	}

}

function is_post_type($post_type = '', $item = '') {
	global $wp_query;
	$type_obj = $wp_query->get_queried_object();
	$post_type = (array) $post_type;

	if( in_array( $type_obj->post_type, $post_type ) && empty( $item ) )
		return true;

	if( in_array( $type_obj->post_type, $post_type ) ) {
		$item = (array) $item;

		if ( in_array( $type_obj->ID, $item ) )
			return true;
		if ( in_array( $type_obj->post_title, $item ) )
			return true;
		if ( in_array( $type_obj->post_name, $item ) )
			return true;
	}

	return false;
}

// Enable excerpts for pages...
function enable_page_excerpts() {
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_page_excerpts');


// Add custom fields for posts
function custom_add_save($postID){
	global $_theme_custom_fields;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $postID;
	} else {
		// called after a post or page is saved and not on autosave
		if($parent_id = wp_is_post_revision($postID)){
			$postID = $parent_id;
		}

		$fields = array('side_bar', 'bottom_bar', 'layout', 'target_link', 'video_link');

		foreach($fields as $field_name) {
//		foreach($_theme_custom_fields as $field_name) {
			if (isset($_POST[$field_name]))
				if (!empty($_POST[$field_name])){
					update_custom_meta($postID, $_POST[$field_name], $field_name);
				} else {
					update_custom_meta($postID, '', $field_name);
				}
		}
	}

}
add_action('save_post', 'custom_add_save');

function update_custom_meta($postID, $new_value, $field_name) {
	// To create new meta
	if(!get_post_meta($postID, $field_name)){
		add_post_meta($postID, $field_name, $new_value);
	} else {
		// or to update existing meta
		update_post_meta($postID, $field_name, $new_value);
	}
}

?>
