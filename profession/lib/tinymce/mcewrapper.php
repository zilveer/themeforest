<?php 

define('MCE_PATH', THEME_LIB . '/tinymce');
define('MCE_URI', THEME_LIB_URI . '/tinymce');

class MceWrapper
{
	function __construct()
	{
		$this->Initialize();
	}
	
	function Initialize()
	{
		add_action('admin_init', array( &$this, 'RegisterHead' ));
		add_action('init', array( &$this, 'InitEditor' ));
		//add_action('admin_print_scripts', array( &$this, 'Quicktags' ));
	}
	
	function RegisterHead($hook)
	{
		// css
		wp_enqueue_style( 'px-popup-font', 'http://fonts.googleapis.com/css?family=Ubuntu|Muli', false, '1.0', 'all' );
		wp_enqueue_style( 'px-popup', MCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// JavaScript
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script( 'jquery-livequery', MCE_URI . '/scripts/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'px-popup', MCE_URI . '/scripts/popup.js', false, '1.0', false );
	}
	
	function InitEditor()
	{
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array( &$this, 'AddPlugins' ) );
			add_filter( 'mce_buttons', array( &$this, 'RegisterButtons' ) );
		}
	}
	
	function AddPlugins( $plugin_array )
	{
		global $wp_version;
		
		$plugin = '';
		
		if(floatval($wp_version) >= 3.9)
			$plugin = '/plugin-mce4.js';
		else
			$plugin = '/plugin.js';
		
		$plugin_array['pxShortcodes'] = MCE_URI . $plugin;
		
		return $plugin_array;
	}
	
	function RegisterButtons( $buttons )
	{
		array_push( $buttons, "|", 'px_button' );
		return $buttons;
	}
	
}

//Run only on 'post' page
if(in_array($GLOBALS['pagenow'], array('post.php', 'post-new.php')))
	new MceWrapper();	// execute