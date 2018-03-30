<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/shortcodes/tinymce/tinymce.php
 * @file	 	1.0
 */
?>
<?php
class add_scgen {

	var $pluginname = 'scgen';
	var $path = '';
	var $internalVersion = 100;

	function add_scgen()  {

		// Set path to editor_plugin.js
		$this->path = get_template_directory_uri() . '/library/shortcodes/tinymce/';

		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );

		// init process for button control
		add_action('init', array (&$this, 'addbuttons') );
	}

	function addbuttons() {
		//global $page_handle;

		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
			return;

		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {

			$svr_uri = $_SERVER['REQUEST_URI'];
			if ( strstr($svr_uri, 'post.php') || strstr($svr_uri, 'post-new.php') || strstr($svr_uri, 'page.php') || strstr($svr_uri, 'page-new.php') /*|| strstr($svr_uri, $page_handle)*/ ) {
				add_filter("mce_external_plugins", array (&$this, 'add_tinymce_plugin' ), 5);
				add_filter('mce_buttons_4', array (&$this, 'register_button' ), 5);
				add_filter('mce_external_languages', array (&$this, 'add_tinymce_langs_path'));
			}
		}
	}

	function register_button($buttons) {

		//array_push($buttons, 'separator', $this->pluginname );
		array_push($buttons, '', $this->pluginname );

		return $buttons;
	}

	function add_tinymce_plugin($plugin_array) {
		global $page_handle;
		$svr_uri = $_SERVER['REQUEST_URI'];

		if(isset($_GET['post_type'])) {
			$post_type_get = $_GET['post_type'];
		}
		if(!isset($_GET['post'])) $_GET['post']='';
		$post_id = $_GET['post'];
		$post = get_post($post_id);
		$post_type = $post->post_type;

		$plugin_array[$this->pluginname] =  $this->path . 'editor_plugin.js';


		return $plugin_array;
	}

	function add_tinymce_langs_path($plugin_array) {
		// Load the TinyMCE language file
		$plugin_array[$this->pluginname] = get_template_directory_uri() . '/library/shortcodes/tinymce/langs.php';
		return $plugin_array;
	}

	function change_tinymce_version($version) {
			$version = $version + $this->internalVersion;
		return $version;
	}

}

$tinymce_button = new add_scgen ();

function custom_colors() {
   echo '<style type="text/css">
           .mceIcon.mce_scgen{background:url(' .get_template_directory_uri() . '/library/admin/assets/images/shortcodes.png) no-repeat !important;}
         </style>';
}

add_action('admin_head', 'custom_colors');