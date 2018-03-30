<?php
/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes V 1.0
 **/
 global $page_handle;
class kingsize_shortcodes_tinymce {
	
	var $pluginname = 'kingsize_shortcode';
	var $path = '';
	var $internalVersion = 1;
	
	function kingsize_shortcodes_tinymce()  {
		
		// Setring path to editor_plugin.js
		$this->path = get_template_directory_uri() . '/lib/tinymce/';	
		
		// Inherit the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );

		// init process of tinyMCE button control
		add_action('init', array (&$this, 'addTinyMcebuttons') );
	}
	
	function addTinyMcebuttons() {
		global $page_handle;
	
		//  if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;
		
		// for Rich Editor mode only
		if ( get_user_option('rich_editing') == 'true') {
		 // || strstr($svr_uri, $page_handle) 
			$svr_uri = $_SERVER['REQUEST_URI'];
			if ( strstr($svr_uri, 'post.php') || strstr($svr_uri, 'post-new.php') || strstr($svr_uri, 'page.php') || strstr($svr_uri, 'page-new.php')) {
				add_filter("mce_external_plugins", array (&$this, 'add_tinymce_plugin' ), 5);
				add_filter('mce_buttons', array (&$this, 'register_Tinymce_button' ), 5);
			}
		}
	}
	
	function register_Tinymce_button($buttons) {
	
		array_push($buttons, 'separator', $this->pluginname );
	
		return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array) {
		if(isset($_GET['post_type'])) {
			$post_type_get = $_GET['post_type'];
		}
		$post_id = $_GET['post'];
		$post = get_post($post_id);
		$post_type = $post->post_type;
		
		if($post_type == 'page' || $post_type == 'page' || $post_type == 'galleries' || $post_type == 'portfolio' || $post_type == 'download'){
			$plugin_array[$this->pluginname] =  $this->path . 'editor_plugin.js';
		}
		
		if($post_type == 'post'){
			$plugin_array[$this->pluginname] =  $this->path . 'editor_plugin.js';
		}
		
		return $plugin_array;
	}
	
	function change_tinymce_version($version) {
			$version = $version + $this->internalVersion;
		return $version;
	}
	
}

$svr_uri = $_SERVER['REQUEST_URI'];
if ( strstr($svr_uri, 'post.php') || strstr($svr_uri, 'post-new.php') || strstr($svr_uri, 'page.php') || strstr($svr_uri, 'page-new.php')) {
//creating object of the kingsize_shortcodes_tinymce and registering the shortcode button
	$tinymce_button = new kingsize_shortcodes_tinymce();
}
?>
