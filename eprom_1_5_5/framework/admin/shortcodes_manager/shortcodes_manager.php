<?php

class R_ShortcodesManager {
	
	var $pluginname = 'shortcodes_manager';
	var $path = '';
	var $version = 100;
	
	function __construct()  {
		
		/* Set path */
		$this->path = get_template_directory_uri() . '/framework/admin/shortcodes_manager/';	
		
		/* Modify the version when tinyMCE plugins are changed. */
		add_filter('tiny_mce_version', array(&$this, 'change_tinymce_version') );

		/* --- Scripts --- */
		add_action( 'load-post.php', array( &$this, 'scripts' ) );
		add_action( 'load-post-new.php', array( &$this, 'scripts' ) );

		/* Addd editor button */
		add_action('init', array(&$this, 'add_butons'));

		add_filter('wp_fullscreen_buttons', array(&$this, 'add_fullscreen_buttons'));
	}
	

	/* Admin scripts
	---------------------------------------------- */
	function scripts() {
		wp_enqueue_script( 'shortcodes_manager_scripts', $this->path . 'shortcodes_manager_scripts.js', array( 'jquery' ), '2013-11-01', true );

	}

	function add_butons() {

		/* Check user permissions */
		if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;
		
		/* Add buttons only in Rich Editor mode */
		if (get_user_option('rich_editing') == 'true') {
		   	add_filter('mce_external_plugins', array(&$this, 'add_tinymce_plugin'), 5);
			add_filter('mce_buttons', array(&$this, 'register_button'), 5);
			add_filter('mce_external_languages', array(&$this, 'add_tinymce_langs_path'));	
		}
	}
	
	function register_button($buttons) {
		array_push($buttons, 'separator', $this->pluginname);
		return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array) {
		$plugin_array[$this->pluginname] =  $this->path . 'shortcodes_manager_win.js';
		return $plugin_array;
	}
	
	function add_tinymce_langs_path($plugin_array) {	
		$plugin_array[$this->pluginname] = ADMIN . '/shortcodes_manager/shortcodes_manager_langs.php';
		return $plugin_array;
	}
	
	function change_tinymce_version($version) {
			$version = $version + $this->version;
		return $version;
	}


	function add_fullscreen_buttons($buttons){
		// add a separator
		$buttons[] = 'separator';
		// format: title, onclick, show in both editors
		$buttons[$this->pluginname] = array(
			// Title of the button
			'title' => __('Shortcodes Manager', SHORT_NAME),
			// Command to execute
			'onclick' => "tinyMCE.execCommand('mceshortcodes_manager');",
			// Show on visual AND html mode
			'both' => false
		);
		return $buttons;
	}
		
	
}

$shortcode_manager = new R_ShortcodesManager();