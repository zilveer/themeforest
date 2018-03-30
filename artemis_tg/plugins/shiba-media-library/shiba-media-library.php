<?php
/*
Plugin Name: Shiba Media Library
Plugin URI: http://shibashake.com/wordpress-theme/media-library-plus-plugin
Description: This plugin enhances the existing WordPress Media Library; allowing you to easily attach and reattach images as well as link an image to multiple galleries by using tags.
Version: 3.8.3
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

define( 'SHIBA_MLIB_VERSION', '3.8.2' );
define( 'SHIBA_MLIB_RELEASE_DATE', date_i18n( 'F j, Y', 1410931000 ) );
define( 'SHIBA_MLIB_DIR', get_template_directory() . '/plugins/shiba-media-library/' );
define( 'SHIBA_MLIB_URL', get_template_directory_uri() . '/plugins/shiba-media-library/' );

define( 'SHIBA_MLIB_OPTIONS', 'shiba_mlib_options' );  // shiba_media_options
define( 'SHIBA_MLIB_CUSTOM_TYPES', 'shiba_mlib_custom_types' );

if (!class_exists("Shiba_Media_Library")) :


class Shiba_Media_Library {
	public static $default_settings = 
		array( 	
			  	'shortcode' => '[gallery]',
				);
		
	var $add, $manage, $upload, $tag_metabox, $ajax, $helper, $qedit, $media_table;
	var $permalink_obj, $manager;
	var $options, $post_types, $options_page;
	var $query_args='';
	var $debug = FALSE;
	
	function __construct() {	
		global $wp_rewrite;
		$version = get_bloginfo('version');

		if (!class_exists("Shiba_Media_Permalink"))
			require('shiba-mlib-permalink.php');
		$this->permalink_obj = new Shiba_Media_Permalink();	
		
		if (is_admin()) {
			if (!class_exists("Shiba_Media_Library_Helper"))
				require(SHIBA_MLIB_DIR . 'shiba-mlib-helper.php');
			$this->helper = new Shiba_Media_Library_Helper();	
			
			if (!class_exists("Shiba_Media_Library_Options"))
				require(SHIBA_MLIB_DIR . 'shiba-mlib-options.php');
			$this->options_page = new Shiba_Media_Library_Options();	
		}	

		$this->init_options();

		add_action('admin_init', array($this,'admin_init') );
		add_action('init', array($this,'init') );
		register_activation_hook( __FILE__, array($this,'activate' ) );
		register_deactivation_hook( __FILE__, array($this,'deactivate' ) );
	}

	function network_propagate($pfunction, $networkwide) {
		global $wpdb;

		if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function 
			// for each blog id
			if ($networkwide) {
				$old_blog = $wpdb->blogid;
				// Get all blog ids
				$blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);
					call_user_func($pfunction, $networkwide);
				}
				switch_to_blog($old_blog);
				return;
			}	
		} 
		call_user_func($pfunction, $networkwide);
	}

	function activate($networkwide) {
		$this->network_propagate(array($this, '_activate'), $networkwide);
	}

	function deactivate($networkwide) {
		$this->network_propagate(array($this, '_deactivate'), $networkwide);
	}

	function new_blog($blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		global $wpdb;
		if (is_plugin_active_for_network('shiba-media-lirbary/shiba-media-library.php')) {
			$old_blog = $wpdb->blogid;
			switch_to_blog($blog_id);
			$this->_activate(TRUE);
			switch_to_blog($old_blog);
		}
	}
		
	function _activate($networkwide) {
		// Activate gallery permalink
		$this->permalink_obj->activate();
				
    	global $wp_rewrite;
		if ($networkwide) {
			$this->permalink_obj->init();
			$gallery_structure = get_option('gallery_structure');			
			$this->permalink_obj->add_rewrite_rules($gallery_structure, EP_NONE);
		} else {
			$this->permalink_obj->init();			
			$wp_rewrite->flush_rules();	
		}
		
		$this->helper->get_custom_types();
	}

	function _deactivate($networkwide) {
    	global $wp_rewrite;		
		if ($networkwide) {
			$this->permalink_obj->init();
			$gallery_structure = get_option('gallery_structure');			
			$this->permalink_obj->remove_rewrite_rules($gallery_structure, EP_NONE);
		} else {
			$wp_rewrite->add_permastruct( 'gallery', '');
			$wp_rewrite->flush_rules();	
		}	
	}
	
	function init_options() {
		// assign default mlib options
		$this->options = get_option(SHIBA_MLIB_OPTIONS);
		if (!is_array($this->options)) {
			update_option( SHIBA_MLIB_OPTIONS, Shiba_Media_Library::$default_settings );
			$this->options = Shiba_Media_Library::$default_settings;
		}
		$this->options = array_merge(Shiba_Media_Library::$default_settings, $this->options);
		return $this->options;
	}

	function init_post_types() {
		$this->post_types = array();
		if (!is_array($this->post_types)) $this->post_types = $this->helper->get_custom_types();
		$this->post_types = array_merge(
			array( 	'attachment' 	=> 'Attachments'),
			$this->post_types );
		$this->post_types = apply_filters('shiba_mlib_post_types', $this->post_types);
	}
	
	function is_option($option) {
		return (isset($this->options[$option]) && $this->options[$option]);		
	}

	function admin_init() {

		// Get all supported post types
		$this->init_post_types();

		if (!class_exists("Shiba_Tag_Metabox"))
			require(SHIBA_MLIB_DIR.'shiba-tag-metabox.php');
		$this->tag_metabox = new Shiba_Tag_Metabox();	

		if (!class_exists("Shiba_Media_Ajax"))
			require(SHIBA_MLIB_DIR.'shiba-mlib-ajax.php');
		$this->ajax = new Shiba_Media_Ajax();	

		// Add expanded media manager
		if (!class_exists("Shiba_Media_Manager"))
			require(SHIBA_MLIB_DIR.'shiba-media-manager.php');
		$this->manager = new Shiba_Media_Manager();

		// Filters for all admin pages
		add_filter('attachment_fields_to_edit', array($this,'attachment_fields_to_edit'), 10, 2);
		add_filter('attachment_fields_to_save', array($this,'attachment_fields_to_save'), 10, 2);
		
	}


	/*
	 * Media Plus initialization functions for general blog pages
	 *
	 * Handles drawing of gallery objects, as well as how to get gallery object 
	 * contents using get_posts or query_posts.
	 *
	 */

	function init() {		
		// mplus get_posts function [allows gallery objects to do grouping with tags]
		add_action('pre_get_posts', array($this,'get_posts_init') );		
		$this->permalink_obj->init();	
					
		if (is_admin()) return;

		// Functions to properly show a gallery object in your blog
		add_filter('the_content', array($this,'process_gallery_content') );

		// From Shiba Gallery plugin
		add_filter('shiba_get_attachment_link', array($this,'filter_attachment_link'), 10, 2);
	}
	
	
	function print_debug($input) {
		if ($this->debug) {
			if (is_object($input) || is_array($input))
				trigger_error(print_r($input, TRUE));
			else	
				trigger_error($input);
//			echo "<!-- $str -->\n";
		}
	}


	function substring($str, $startPattern, $endPattern) {
			
		$pos = strpos($str, $startPattern);
		if($pos === false) return '';
	 
		$pos = $pos + strlen($startPattern);
		$len = strpos($str, $endPattern, $pos) - $pos;
	 
		$data = substr($str, $pos , $len);
		return $data;
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
			'label' => __('Tags'),
			'helps' => __('Associate tags with image attachments to easily include them in multiple image galleries.')
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
			$theme = wp_get_theme();
			if ($theme['Name'] == 'Twenty Ten') { ?>
                <style>
				#content .gallery { margin: 0 0 36px 0; }
				</style>
            <?php }    
			$shortcode = ($this->is_option('shortcode')) ? stripcslashes($this->options['shortcode']) : '[gallery]';
			$new_content = "<div class='gallery-main' style='text-align:center;'>\n";
			$new_content .= $shortcode;
			$new_content .= "\n</div>\n";
			if ($this->is_option('show_description'))
				$new_content .= $content;
			return apply_filters('the_gallery_content', $new_content);
		} 
		return $content;	
	}


	/*
	 * get_posts
	 *
	 * Key gallery object functionality is encapsulated here. 
	 * Get all objects (attachments, posts, pages, and galleries) with tags contained 
	 * by the gallery, and add that to the get_posts results.
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
			$idStr = "{$wpdb->posts}.post_parent";
			if (strpos($where, $idStr) === FALSE)
				$idStr = "{$wpdb->posts}.ID IN";
			$id_clause = $idStr . $this->substring($where, $idStr, " AND");
			$where = str_replace($id_clause, "({$id_clause} OR ({$wpdb->term_taxonomy}.taxonomy = 'post_tag' AND {$wpdb->terms}.slug IN ({$this->query_args['tag_str']})) ) AND {$wpdb->posts}.id <> {$this->query_args['id']}", $where);
			
			$this->print_debug($where);
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

		remove_filter('posts_where', array($this, 'posts_where'), 10, 2);		
		remove_filter('posts_join', array($this, 'posts_join'), 10, 2);		
		remove_filter('posts_request', array($this, 'posts_request'), 10, 2);		

		return $request;
	}
			
	function get_posts_init($qobj) {
//		$qobj->query_vars['suppress_filters'] = FALSE;	
		
		$num_images = 0;
		
		if (defined('DOING_AJAX')) return;
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

		// Check if gallery has associated ids metadata
		$ids = get_post_meta($objID, 'shiba_gallery_ids', TRUE);
		if (is_array($ids)) {
			$qobj->set('post__in', $ids);
			$qobj->set('post_parent', '');
		}

		$id = $objID;
		// Get which object type(s) the gallery should contain
		$gallery_type = get_post_meta($obj->ID, '_gallery_type', TRUE);
		if (!$gallery_type) $gallery_type = 'attachment';
		
		// Add gallery tag objects to query	
		$qobj->query_vars['suppress_filters'] = FALSE;	
				
		add_filter('posts_where', array($this, 'posts_where'), 10, 2);		
		add_filter('posts_join', array($this, 'posts_join'), 10, 2);		
		add_filter('posts_request', array($this, 'posts_request'), 10, 2);		

		$this->query_args = compact('id', 'tag_str','gallery_type');
	}
	

	
} // End Shiba_Library class	

endif;

if (class_exists("Shiba_Media_Library")) {
    $shiba_mlib = new Shiba_Media_Library();	
}	
?>