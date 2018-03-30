<?php


if(!function_exists('avia_find_layersliders'))
{
	function avia_find_layersliders($names_only = false)
	{
		// Get WPDB Object
	    global $wpdb;
	 
	    // Table name
	    $table_name = $wpdb->prefix . "layerslider";
	 
	    // Get sliders
	    $sliders = $wpdb->get_results( "SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY date_c ASC LIMIT 300" );
	 	
	 	if(empty($sliders)) return;
	 	
	 	if($names_only)
	 	{
	 		$new = array();
	 		foreach($sliders as $key => $item) 
		    {
		    	if(empty($item->name)) $item->name = __("(Unnamed Slider)","avia_framework");
		       $new[$item->name] = $item->id;
		    }
		    
		    return $new;
	 	}
	 	
	 	return $sliders;
	}
}


/********************************************************/
/* Action to import sample slider  - modified version          */
/********************************************************/

if(!function_exists('avia_remove_default_import'))
{
	add_action('admin_menu', 'avia_remove_default_import',1);
	
	function avia_remove_default_import()
	{
		if(isset($_GET['page']) && $_GET['page'] == 'layerslider' && isset($_GET['action']) && $_GET['action'] == 'import_sample') 
		{
			remove_action(	'admin_init' , 'layerslider_import_sample_slider');
			add_action(		'admin_init' , 'avia_import_sample_slider');
		}
	}
}



if(!function_exists('avia_import_sample_slider'))
{
	function avia_import_sample_slider() {
		
		// Base64 encoded, serialized slider export code
		$path = "avia-samples/";
		$sample_file = "sample_sliders.txt";
		$sample_slider = json_decode(base64_decode(file_get_contents(dirname(__FILE__)."/LayerSlider/{$path}{$sample_file}")), true);
		
		
		//echo"<pre>";
		//print_r(base64_encode(str_replace('avia-samples','sampleslider', base64_decode(file_get_contents(dirname(__FILE__).'/LayerSlider/sampleslider/sample_sliders2.txt'))))) ;
		//echo"<pre>";
		//die();
		

		// Iterate over the sliders
		foreach($sample_slider as $sliderkey => $slider) {
	
			// Iterate over the layers
			foreach($sample_slider[$sliderkey]['layers'] as $layerkey => $layer) {
	
				// Change background images if any
				if(!empty($sample_slider[$sliderkey]['layers'][$layerkey]['properties']['background'])) {
					$sample_slider[$sliderkey]['layers'][$layerkey]['properties']['background'] = $GLOBALS['lsPluginPath'].$path.basename($layer['properties']['background']);
				}
	
				// Change thumbnail images if any
				if(!empty($sample_slider[$sliderkey]['layers'][$layerkey]['properties']['thumbnail'])) {
					$sample_slider[$sliderkey]['layers'][$layerkey]['properties']['thumbnail'] = $GLOBALS['lsPluginPath'].$path.basename($layer['properties']['thumbnail']);
				}
	
				// Iterate over the sublayers
				if(isset($layer['sublayers']) && !empty($layer['sublayers'])) {
					foreach($layer['sublayers'] as $sublayerkey => $sublayer) {
		
						// Only IMG sublayers
						if($sublayer['type'] == 'img') {
							$sample_slider[$sliderkey]['layers'][$layerkey]['sublayers'][$sublayerkey]['image'] = $GLOBALS['lsPluginPath'].$path.basename($sublayer['image']);
						}
					}
				}
			}
		}
	
		// Get WPDB Object
		global $wpdb;
	
		// Table name
		$table_name = $wpdb->prefix . "layerslider";
	
		// Append duplicate
		foreach($sample_slider as $key => $val) {
	
			// Insert the duplicate
			$wpdb->query(
				$wpdb->prepare("INSERT INTO $table_name
									(name, data, date_c, date_m)
								VALUES (%s, %s, %d, %d)",
								$val['properties']['title'],
								json_encode($val),
								time(),
								time()
				)
			);
		}
	
	}
}


if(!function_exists('avia_layerslider_remove_setup_fonts'))
{
	add_action('layerslider_installed','avia_layerslider_remove_setup_fonts');
	
	function avia_layerslider_remove_setup_fonts()
	{
		 //remove google fonts from install
		update_option('ls-google-fonts', array());
	}
}


/**************************/
/* Include LayerSlider WP */
/**************************/
if(is_admin())
{	
	//dont call on plugins page so user can enable the plugin if he wants to
	if(isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) == "plugins.php" && (is_dir(WP_PLUGIN_DIR . '/LayerSlider') || is_dir(WPMU_PLUGIN_DIR . '/LayerSlider'))) return;
	
	add_action('init', 'avia_include_layerslider' , 1 );
	
}
else
{	
	add_action('wp', 'avia_include_layerslider' , 45 );
}

function avia_include_layerslider()
{	
	if(!is_admin() && !post_has_layerslider()) return;
	if(current_theme_supports('deactivate_layerslider')) return;
	
	// Path for LayerSlider WP main PHP file
	$layerslider = get_template_directory() . '/config-layerslider/LayerSlider/layerslider.php';
	$themeNice	 = substr(avia_backend_safe_string(THEMENAME),0,40);

	// Check if the file is available and the user didnt activate the layerslide plugin to prevent warnings
	if(file_exists($layerslider)) 
	{
		if(function_exists('layerslider')) //layerslider plugin is active
		{
			if(get_option("{$themeNice}_layerslider_activated", '0') == '0') 
			{
		        //import sample sliders
		 		avia_import_sample_slider();
		 		
		        // Save a flag that it is activated, so this won't run again
		        update_option("{$themeNice}_layerslider_activated", '1');
		    }
		}
		else //not active, use theme version instead
		{
		    // Include the file
		    include $layerslider;
		    
		    $GLOBALS['lsPluginPath'] 	= get_template_directory_uri() . '/config-layerslider/LayerSlider/';
		    $GLOBALS['lsAutoUpdateBox'] = false;
		 
		    // Activate the plugin if necessary
		    if(get_option("{$themeNice}_layerslider_activated", '0') == '0') {
		 
		        // Run activation script
		        layerslider_activation_scripts();
		        
		        //import sample sliders
		 		avia_import_sample_slider();
		 		
		        // Save a flag that it is activated, so this won't run again
		        update_option("{$themeNice}_layerslider_activated", '1');
		    }
	    }
	}
}





