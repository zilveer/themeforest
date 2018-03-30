<?php
/*
Plugin Name: Shiba Media Library
Plugin URI: http://shibashake.com/wordpress-theme/media-library-plus-plugin
Description: This plugin enhances the existing WordPress Media Library; allowing you to easily attach and reattach images as well as link an image to multiple galleries by using tags.
Version: 3.3
Author: ShibaShake
Author URI: http://shibashake.com
*/


/*  Copyright 2009  ShibaShake 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

// Pre-2.6 compatibility
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );


define( 'SHIBA_MLIB_DIR', get_template_directory() . '/plugins/shiba-media-library' ); 
define( 'SHIBA_MLIB_URL', get_template_directory_uri() . '/plugins/shiba-media-library' );


if (!class_exists("Shiba_Media_Library")) :


class Shiba_Media_Library {
	var $add, $manage, $upload, $tag_metabox, $ajax, $helper;
	var $options, $options_page;
	var $query_args='';
	var $permalink_obj;
	var $debug;
	
	function Shiba_Media_Library() {	
		global $wp_rewrite;
		$version = get_bloginfo('version');
		$this->debug = FALSE;

		require('shiba-mlib-permalink.php');
		if (class_exists("Shiba_Media_Permalink")) {
			$this->permalink_obj = new Shiba_Media_Permalink();	
		}
		
		if (is_admin()) {
			require(SHIBA_MLIB_DIR . '/shiba-mlib-helper.php');
			if (class_exists("Shiba_Media_Library_Helper")) {
				$this->helper = new Shiba_Media_Library_Helper();	
				add_action('admin_menu', array(&$this->helper,'add_pages') );
			}		
		}	

		$this->options = get_option('shiba_mlib_options');
		if (!is_array($this->options)) $this->options = $this->init_options();

		add_action('admin_init', array(&$this,'admin_init') );
		add_action('init', array(&$this,'init_general') );
		register_activation_hook( __FILE__, array(&$this,'activate' ) );
		register_deactivation_hook( __FILE__, array(&$this,'deactivate' ) );
	}
	
	function activate() {
		global $wpdb;

		if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function for each blog id
			if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
				$old_blog = $wpdb->blogid;
				// Get all blog ids
				$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);
					$this->_activate();
				}
				switch_to_blog($old_blog);
				return;
			}	
		} 
		$this->_activate();		
	}

	function deactivate() {
		global $wpdb;

		if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function for each blog id
			if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
				$old_blog = $wpdb->blogid;
				// Get all blog ids
				$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);
					$this->_deactivate();
				}
				switch_to_blog($old_blog);
				return;
			}	
		} 
		$this->_deactivate();		
	}


	function new_blog($blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		global $wpdb;
		if (is_plugin_active_for_network('shiba-media-lirbary/shiba-media-library.php')) {
			$old_blog = $wpdb->blogid;
			switch_to_blog($blog_id);
			$this->_activate();
			switch_to_blog($old_blog);
		}
	}
		
	function _activate() {
		$this->init_options();
		// Activate gallery permalink
		$this->permalink_obj->activate();
				
    	global $wp_rewrite;
		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
			$this->permalink_obj->init();
			$gallery_structure = get_option('gallery_structure');			
			$this->permalink_obj->add_rewrite_rules($gallery_structure, EP_NONE);
		} else {
			$this->permalink_obj->init();			
			$wp_rewrite->flush_rules();	
		}	
	}

	function _deactivate() {
    	global $wp_rewrite;		
		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
			$this->permalink_obj->init();
			$gallery_structure = get_option('gallery_structure');			
			$this->permalink_obj->remove_rewrite_rules($gallery_structure, EP_NONE);
		} else {
			$wp_rewrite->add_permastruct( 'gallery', '');
			$wp_rewrite->flush_rules();	
		}	
	}
	
	function init_options() {
			// Make sure all required option values are filled - with defaults if necessary
		static $default_options = array(	'shortcode' => '[gallery]' );
		$options = get_option('shiba_mlib_options');
		if (!is_array($options)) $options = array();
		$options = array_merge($default_options, $options);
		update_option('shiba_mlib_options', $options);		
		return $options;
	}

	function admin_init() {

		require(SHIBA_MLIB_DIR.'/shiba-tag-metabox.php');
		if (class_exists("Shiba_Tag_Metabox"))
			$this->tag_metabox = new Shiba_Tag_Metabox();	

		require(SHIBA_MLIB_DIR.'/shiba-mlib-ajax.php');
		if (class_exists("Shiba_Media_Ajax"))
			$this->ajax = new Shiba_Media_Ajax();	
		
		$this->helper->admin_init();
			
		// Filters for all admin pages
		add_filter('attachment_fields_to_edit', array(&$this,'attachment_fields_to_edit'), 10, 2);
		add_filter('attachment_fields_to_save', array(&$this,'attachment_fields_to_save'), 10, 2);

		// Register gallery permalink option in settings menu
		add_settings_field(	'gallery_structure', "Gallery Structure", array(&$this->permalink_obj, 'show_gallery_structure'), 
							'permalink', 'optional',
							array('label_for' => 'gallery_structure') );
		// This is a way to hook into a call to permalink save - for the case where only gallery base has changed
		add_filter('iis7_supports_permalinks', array(&$this->permalink_obj, 'set_gallery_structure') );
		// Need this to capture the case where permalink structure has changed
		add_action('permalink_structure_changed', array(&$this->permalink_obj, 'set_gallery_structure') );

		// AJAX support functions
		// Add attachment tags to tag box
		add_filter('sanitize_title', array(&$this->ajax,'tag_box_title')); // for below 3.1  
		add_filter('sanitize_key', array(&$this->ajax,'tag_box_title')); // for 3.1  
	}

	

	
	/*
	 * Media Plus initialization functions for general blog pages
	 *
	 * Handles drawing of gallery objects, as well as how to get gallery object contents using get_posts or query_posts.
	 *
	 */

	function init_general() {		
		// mplus get_posts function [allows gallery objects to do grouping with tags]
		add_action('pre_get_posts', array(&$this,'get_posts_init') );		
		$this->permalink_obj->init();	
					
		if (is_admin()) return;

		// Functions to properly show a gallery object in your blog
		add_filter('the_content', array(&$this,'process_gallery_content') );

		// From Shiba Gallery plugin
		add_filter('shiba_get_attachment_link', array(&$this,'filter_attachment_link'), 10, 2);
	}
	
	
	function print_debug($str) {
		if ($this->debug)
			echo "<!-- $str -->\n";
	}


	function substring($str, $startPattern, $endPattern) {
			
		$pos = strpos($str, $startPattern);
		if($pos === false) {
			return "";
		}
	 
		$pos = $pos + strlen($startPattern);
		$temppos = $pos;
		$pos = strpos($str, $endPattern, $pos);
		$datalength = $pos - $temppos;
	 
		$data = substr($str, $temppos , $datalength);
		return $data;
	}



	
	/*
	 * Allow tags for attachments.
	 *
	 */
 
	// Get tag string for a given post id
	 function get_post_tags_string($postID) {
		$tags = wp_get_object_terms( $postID, 'post_tag' );
	
		$tagStr = '';
		if (count($tags)) {
			$tagStr = "{$tags[0]->name}";
			for ($i = 1; $i < count($tags); $i++) 
				$tagStr .= ",{$tags[$i]->name}";
		}
			
		return $tagStr;	
	}
	
	// Get tag-slug string for a given post id - this is required for get_posts
	 function get_post_tags_slug($postID) {
		$tags = wp_get_object_terms( $postID, 'post_tag' );
	
		$tagStr = '';
		if (count($tags)) {
			$tagStr = "'{$tags[0]->slug}'";
			for ($i = 1; $i < count($tags); $i++) 
				$tagStr .= ",'{$tags[$i]->slug}'";
		}
			
		return $tagStr;	
	}


	 
	/*
	 * Tag field menu expansions.
	 *
	 */
 
	// Add tag field for attachment edit menu
	function attachment_fields_to_edit( $form_fields, $post ) {
		$tags = $this->get_post_tags_string($post->ID);
	
		$form_fields['tags'] = array(
			'value' => $tags,
			'label' => __('Attachment Tags', THEMEDOMAIN),
			'helps' => __('Associate tags with image attachments to easily include them in multiple image galleries.', THEMEDOMAIN)
		);
		return $form_fields;
	}
	
	// Save tag field from attachment edit menu
	function attachment_fields_to_save($post, $attachment) {
		$tags = esc_attr($_POST['attachments'][$post['ID']]['tags']);
	
		$tag_arr = explode(',', $tags);
		wp_set_object_terms( $post['ID'], $tag_arr, 'post_tag' );
		return $post;
	}
	

	/*
	 * Display Gallery Objects
	 *
	 * Allows the display of gallery objects similar to attachment objects.
	 * The native WordPress 'gallery' shortcode is used here to display galleries.
	 *
	 */
	
	function process_gallery_content($content) {
		global $post;
		if (is_object($post) && ($post->post_type == 'gallery')) {
			// Fix Twenty Ten theme
			if (get_current_theme() == 'Twenty Ten') { ?>
                <style>
				#content .gallery { margin: 0 0 36px 0; }
				</style>
            <?php }    
			$shortcode = (isset($this->options['shortcode'])) ? stripcslashes($this->options['shortcode']) : '[gallery]';
			$new_content = "<div class='gallery-main' style='text-align:center;'>\n";
			$new_content .= $shortcode;
			$new_content .= "\n</div>\n";
			if (isset($this->options['show_description']) && $this->options['show_description'])
				$new_content .= $content;
			return apply_filters('the_gallery_content', $new_content);
		} 
		return $content;	
	}


	/*
	 * get_posts
	 *
	 * Key gallery object functionality is encapsulated here. 
	 * Get all objects (attachments, posts, pages, and galleries) with tags contained by the gallery, 
	 * and add that to the get_posts results.
	 *
	 */
	
	function posts_where($where, $query) {
		global $wpdb;
		if (!is_array($this->query_args)) return $where;
		
		// Replace post_type
		if (isset($this->query_args['gallery_type']) && $this->query_args['gallery_type']) {
			$type_clause = "{$wpdb->posts}.post_type" . $this->substring($where, "{$wpdb->posts}.post_type", " AND");
			$status_clause = "{$wpdb->posts}.post_status" . $this->substring($where, "{$wpdb->posts}.post_status", " AND");
			
			switch ($this->query_args['gallery_type']) {
			case 'any':
				$where = str_replace($type_clause, "1 = 1", $where);
				break;
			default:	
				$where = str_replace($type_clause, "{$wpdb->posts}.post_type = '{$this->query_args['gallery_type']}'", $where);
			}	
			if ($this->query_args['gallery_type'] != 'attachment') {
				$where = str_replace("AND (post_mime_type LIKE 'image/%')", "", $where);
				$where = str_replace ("{$wpdb->posts}.post_status = 'inherit'", "{$wpdb->posts}.post_status <> 'trash'", $where);
			}	
		}

		if (isset($this->query_args['tag_str']) && $this->query_args['tag_str']) {
			// get id substring
			$id_clause = "{$wpdb->posts}.post_parent" . $this->substring($where, "{$wpdb->posts}.post_parent", " AND");
			$where = str_replace($id_clause, "({$id_clause}OR ({$wpdb->term_taxonomy}.taxonomy = 'post_tag' AND {$wpdb->terms}.slug IN ({$this->query_args['tag_str']})) ) AND {$wpdb->posts}.id <> {$this->query_args['id']}", $where);
		}
		return $where;
	}
	
	function posts_join($join, $query) {
		global $wpdb;
		if (!is_array($this->query_args)) return $join;
		if (!isset($this->query_args['tag_str']) || !$this->query_args['tag_str']) return $join;

		// Must use left join here so that attachments with no tags will also be included
		$join .= "LEFT JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id) LEFT JOIN {$wpdb->term_taxonomy} ON ({$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id) LEFT JOIN {$wpdb->terms} ON ({$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id)";
		return $join;
	}

	function posts_request($request, $query) {
		if (!is_array($this->query_args)) return $request;
		$request = str_replace("SELECT", "SELECT DISTINCT", $request);

		remove_filter('posts_where', array(&$this, 'posts_where'), 10, 2);		
		remove_filter('posts_join', array(&$this, 'posts_join'), 10, 2);		
		remove_filter('posts_request', array(&$this, 'posts_request'), 10, 2);		

		return $request;
	}
			
	function get_posts_init($qobj) {
//		$qobj->query_vars['suppress_filters'] = FALSE;	
		
		$num_images = 0;
		if ($qobj->query_vars['post__in']) // only include specified posts
			return;

		if ($qobj->query_vars['p'])  { // looking for single post		
			$tmp_obj = get_post(absint($qobj->query_vars['p']));
			if (!$tmp_obj) return;
			$qobj->query_vars['post_type'] = $tmp_obj->post_type;
			return;
		}	
						
		//Only process gallery objects
		$objID = $qobj->get('post_parent');
		if (!$objID) return;
		$obj = get_post($objID);
		if (!$obj || !$obj->post_type || !($obj->post_type == 'gallery')) return;

		// Get gallery object tags
		$tag_str = $this->get_post_tags_slug($objID);
		$id = $objID;
		// Get which object type(s) the gallery should contain
		$gallery_type = get_post_meta($obj->ID, '_gallery_type', TRUE);
		if (!$gallery_type) $gallery_type = 'attachment';
		
		// Add gallery tag objects to query	
		$qobj->query_vars['suppress_filters'] = FALSE;	
				
		add_filter('posts_where', array(&$this, 'posts_where'), 10, 2);		
		add_filter('posts_join', array(&$this, 'posts_join'), 10, 2);		
		add_filter('posts_request', array(&$this, 'posts_request'), 10, 2);		

		$this->query_args = compact('id', 'tag_str','gallery_type');
	}
	


	function javascript_redirect($location) {
		// redirect after header here can't use wp_redirect($location);
		?>
		  <script type="text/javascript">
		  <!--
		  window.location= <?php echo "'" . $location . "'"; ?>;
		  //-->
		  </script>
		<?php
		exit;
	}
	 
	function filter_attachment_link($link, $id) {
		return preg_replace('/<br\s*?\/+>/', '', $link);
	}
	
} // End Shiba_Library class	

endif;

if (class_exists("Shiba_Media_Library")) {
    $shiba_mlib = new Shiba_Media_Library();	
}	
?>