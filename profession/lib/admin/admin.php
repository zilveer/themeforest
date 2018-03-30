<?php 

require_once('admin-class.php');
require_once('importer/importer.php');
require_once('importer/dummy-settings.php');

//Extended admin class
class Admin extends ThemeAdmin
{
	function Save_Options()
	{
		//Check for import dummy data option
		if( array_key_exists('import_dummy_data', $_POST) && 
		    $_POST['import_dummy_data'] == '1')
		{
			//Don't save anything just Import data
			$this->ImportDummyData($_POST['dummy_data_items']);
            
			echo 'OK';
			die();
			return;
		}
		
		parent::Save_Options();
	}
    
	function ImportDummyData($demo = 'standard')
	{
		$wp_import = new WP_Import();
		//$wp_import->fetch_attachments = true;
		ob_start();
		$wp_import->import(THEME_ADMIN.'/dummydata/'.$demo.'.xml');
		ob_end_clean();//Prevents sending output to client
		
		//Import dummy data
		update_option(OPTIONS_KEY, Get_Dummy_Options());
	}
    
	function px_enqueue_scripts()
	{
		wp_enqueue_script('jquery');  
		wp_enqueue_script('thickbox');  
		wp_enqueue_style('thickbox');  
		wp_enqueue_script('media-upload');
		wp_enqueue_script('hoverIntent');
		wp_enqueue_script('jquery-easing');
		wp_enqueue_style('nouislider');
		wp_enqueue_script('nouislider');
		wp_enqueue_style('colorpicker0');
		wp_enqueue_script('colorpicker0');
		wp_enqueue_style('chosen');
		wp_enqueue_script('chosen');
		wp_enqueue_style('theme-admin-css');
		wp_enqueue_script('theme-admin-script');
	}
}

new Admin();
require_once('sections.php');