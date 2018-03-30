<?php

require_once('mediabox-strings.php');
require_once('defaults.php');

class ThemeAdmin
{
	function __construct() {
		$this->Activation();
		
		add_action("admin_menu", array( &$this, "Setup_Menus"));  
		add_action('admin_enqueue_scripts', array(&$this, 'Admin_Scripts'));
		add_action('admin_init', array(&$this, 'Admin_Init') ); 
		add_action('after_setup_theme', array(&$this, 'After_Setup') ); 
		add_action('wp_ajax_theme_save_options', array(&$this, 'Save_Options'));
	}
	
	function Save_Options()
	{
		$options = get_option( OPTIONS_KEY );
		
		foreach($options as $key => $value)
		{
			$newVal = isset($_POST[$key]) ? $_POST[$key] : '';
			$options[$key] = $newVal;
		}
		
		update_option(OPTIONS_KEY, $options);
		
		echo 'OK';
		die(); // this is required to return a proper result
	}
	
	function After_Setup()
	{
		//Initialize default options
		//delete_option(OPTIONS_KEY);
		$options  = get_option( OPTIONS_KEY );
		$defaults = Get_Default_Options();
		
		// Are our options saved in the DB?  
		if ( false !== $options ) 
		{
			$changed = false;
			//Add new keys if any
			foreach($defaults as $key => $value)
			{
				if(!array_key_exists($key, $options))
				{
					//Add default value
					$options[$key] = $value;
					$changed = true;
				}
			}
			
			//Check if any key removed from defaults
			foreach($options as $key => $value)
			{
				if(!array_key_exists($key, $defaults))
				{
					//Remove the option
					unset($options[$key]);
					$changed = true;
				}
			}
			
			if($changed)
				update_option(OPTIONS_KEY, $options);
			
			return;
		}
			
		// If not, we'll save our default options  
		add_option( OPTIONS_KEY, $defaults );
	}
	
	function Activation()
	{
		// Redirect To Theme Options Page on Activation
		if (isset($_GET['activated'])){
			wp_redirect(admin_url("admin.php?page=theme_settings"));
		}
	}
	
	function Setup_Menus() {  
		add_theme_page(THEME_NAME, 'Theme Settings', 'manage_options',  
		'theme_settings', array(&$this, 'Admin_Page'));  
	}
	
	function Admin_Init()
	{
		if(in_array($GLOBALS['pagenow'], array('media-upload.php', 'async-upload.php'))) {  
			// Now we'll replace the 'Insert into Post Button' inside Thickbox  
			add_filter( 'gettext', array(&$this, 'Replace_Thickbox_Text')  , 1, 3 ); 
		}
	}
	
	function Replace_Thickbox_Text($translated_text, $text, $domain)
	{
		if ('Insert into Post' == $text) { 
		
			$texts = Get_MediaBox_Strings();
			
			foreach($texts as $key => $value)
			{
				$referer = strpos( wp_get_referer(), $key ); 
			
				if ( $referer !== false ) { 
					return $value;  
				}
	
			}
			
		}
		
		return $translated_text; 
	}
	
	function Admin_Page()
	{
		$page = include(THEME_ADMIN . '/forms.php');
	}
	
	function Admin_Scripts()
	{
		if (!isset($_GET['page']) || $_GET['page'] != 'theme_settings' ) 
			return;
		
		$this->px_register_scripts();
		$this->px_enqueue_scripts();
	}
	
	function px_register_scripts()
	{
		wp_register_script('jquery-easing', THEME_JS_URI  .'/jquery.easing.1.3.js', array('jquery'), '1.3.0');
		
		wp_register_style( 'nouislider', THEME_ADMIN_URI . '/css/nouislider.css', false, '2.1.4', 'screen' );
		wp_register_script('nouislider', THEME_ADMIN_URI  .'/scripts/jquery.nouislider.min.js', array('jquery'), '2.1.4');
		//wp_enqueue_script('nouislider', THEME_ADMIN_URI  .'/scripts/jquery.nouislider.js', array('jquery'), '2.1.4');
		
		wp_register_style( 'colorpicker0', THEME_ADMIN_URI . '/css/colorpicker.css', false, '1.0.0', 'screen' );
		wp_register_script('colorpicker0', THEME_ADMIN_URI  .'/scripts/colorpicker.js', array('jquery'), '1.0.0');
		
		wp_register_style( 'chosen', THEME_ADMIN_URI . '/css/chosen.css', false, '1.0.0', 'screen' );
		wp_register_script('chosen', THEME_ADMIN_URI  .'/scripts/chosen.jquery.min.js', array('jquery'), '1.0.0');
		
		wp_register_style( 'theme-admin-css', THEME_ADMIN_URI . '/css/style.css', false, '1.0.0', 'screen' );
		wp_register_script('theme-admin-script', THEME_ADMIN_URI  .'/scripts/admin.js', array('jquery'), '1.0.0');
	}
	
	function px_enqueue_scripts()
	{

	}
	
}


?>