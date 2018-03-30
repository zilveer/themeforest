<?php 

add_action('wp_ajax_etheme_import_ajax', 'etheme_import_data');
if (!function_exists('etheme_import_data')) :
	function etheme_import_data() {
	    //delete_option('demo_data_installed');die();

		$version = $_POST['version'];
		$home_id = $_POST['home_id'];

		// Load Importer API
		require_once ABSPATH . 'wp-admin/includes/import.php';
		$importerError = false;
	    $demo_data_installed = get_option('demo_data_installed');
		
		//check if wp_importer, the base importer class is available, otherwise include it
		if ( !class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ) 
				require_once($class_wp_importer);
			else 
				$importerError = true;
		}
		//$file = get_template_directory() ."/framework/dummy/version_data.xml";
	    
		
		if($importerError !== false) {
			echo ("The Auto importing script could not be loaded. Please use the wordpress importer and import the XML file that is located in your themes folder manually.");
		} else {
			
			if(class_exists('WP_Importer')){
				try{
					
					if ($version != 'ecommerce') {

						$versionsUrl = 'http://8theme.com/import/' . ETHEME_DOMAIN . '_versions/';
	                	$folder = $versionsUrl.''.$version;
	                 	et_update_slider($folder,$version);
	                 	et_create_file($folder);
	                 	etheme_update_options($folder);
	                 	$file = PARENT_DIR.'/framework/tmp/version_data.xml';
	                } 

	                if ( $demo_data_installed != 'yes' && $version == 'ecommerce') {
	                	$folder = '';
	                	et_update_slider($folder,$version);
						$file = get_template_directory() ."/framework/dummy/Dummy.xml";
						et_update_widgets($version);
						
					}


	                if (isset($file) && !empty($file)) {
	                	$importer = new WP_Import();
	    				$importer->fetch_attachments = true;
	    				$importer->import($file);
	                } 
	                
					et_update_pages($version,$home_id);
					etheme_update_menus();

	                die('Success');
						
				} catch (Exception $e) {
					echo ("Error while importing");
				}

			}
			
		}

		die();
	}
endif;

if (!function_exists('et_update_pages')) :
	function et_update_pages($version,$home_id){
		if ($version == 'ecommerce') {
			global $options_presets;

			$theme_version = et_get_versions_option();
			$Content_theme_version = $theme_version[$version]['content'];

			//Update Theme Optinos
			$new_options = json_decode(base64_decode($Content_theme_version),true);
			update_option( 'option_tree', $new_options );

			$home_id = get_page_by_title('Home Page');
			$blog_id = get_page_by_title('Blog');;
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id->ID );
			update_option( 'page_for_posts', $blog_id->ID );
			add_option('demo_data_installed', 'yes');

		} else {

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id );

		}		
	}	
endif;

if (!function_exists('etheme_update_options')) :
	function etheme_update_options($folder) {

		$output = '';
	  	
		if ( ! file_exists(PARENT_DIR.'/framework/tmp') ) {
			mkdir(PARENT_DIR.'/framework/tmp', 0777);
		} else {
			$output .= 'tmp directory already exist';
		}
		
		$options_txt = $folder.'/options.txt';
		
		$new_options = et_get_remote_content($options_txt);
		
		if($new_options) {
			
			$tmpxml = PARENT_DIR.'/framework/tmp/options.txt';
			
			$new_options = json_decode(base64_decode($new_options),true);
			
			update_option( 'option_tree', $new_options );

			$output .= '<div class="updated">';
				$output .= "Theme Options updated!";
			$output .= "</div>";
		}

		echo $output;
	}
endif;


if (!function_exists('et_update_slider')) :
	function et_update_slider($folder,$version){
		$output ='';

		$sliderZip = $folder.'/slider.zip';
		$sldier_content = et_get_remote_content($sliderZip);
			
		if($sldier_content && class_exists('RevSlider')) {
			$tmpZip = PARENT_DIR.'/framework/tmp/tempSliderZip.zip';

			mkdir(PARENT_DIR.'/framework/tmp', 0777);
			
			file_put_contents($tmpZip, $sldier_content);
			
			$revapi = new RevSlider();
			
			$_FILES["import_file"]["tmp_name"] = $tmpZip;
			
			ob_start();
			
			$slider_result = $revapi->importSliderFromPost();
			mkdir(PARENT_DIR.'/framework/tmp', 0777);
			
			ob_end_clean();
			
			
			if($slider_result['success']) {
				$output .= '<div class="rev-slider-result updated">';
					$output .= "Revolution slider installed successfully!";
				$output .= "</div>";
			}
		}
			
		$sliderZip2 = $folder.'/slider2.zip';
		$slider_content = et_get_remote_content($sliderZip2);
			
		if($slider_content && class_exists('RevSlider')) {
			$tmpZip = PARENT_DIR.'/framework/tmp/tempSliderZip.zip';
			mkdir(PARENT_DIR.'/framework/tmp', 0777);
			file_put_contents($tmpZip, $slider_content);
			
			$revapi = new RevSlider();
			
			$_FILES["import_file"]["tmp_name"] = $tmpZip;
			
			ob_start();
			
			$slider_result = $revapi->importSliderFromPost();
			mkdir(PARENT_DIR.'/framework/tmp', 0777);
			
			ob_end_clean();
			
			
			if($slider_result['success']) {
				$output .= '<div class="rev-slider-result updated">';
					$output .= "Revolution slider installed successfully!";
				$output .= "</div>";
			}
		}

		if ($version == 'ecommerce') {

			$tmpZip = PARENT_DIR.'/framework/dummy/tempSliderZip.zip';
			$revapi = new RevSlider();

			$_FILES["import_file"]["tmp_name"] = $tmpZip;
					
			ob_start();
				$slider_result = $revapi->importSliderFromPost();
			ob_end_clean();

			if($slider_result['success']) {
				$output .= '<div class="rev-slider-result updated">';
					$output .= "Revolution slider installed successfully!";
				$output .= "</div>";
			}
		}
		echo $output;
	}
endif;


if (!function_exists('et_create_file')) :
	function et_create_file($folder){

		$version_xml = $folder.'/version_data.xml';
						
		$version_content = et_get_remote_content($version_xml);

		if($version_content) {

			$tmpxml = PARENT_DIR.'/framework/tmp/version_data.xml';
			
			file_put_contents($tmpxml, $version_content);
			
			
		}
	}
endif;


if (!function_exists('etheme_update_menus')) :
	function etheme_update_menus(){
		
		global $wpdb;
		
	    $menuname = 'Main Menu';
		$bpmenulocation = 'main-menu';
		$mobilemenulocation = 'mobile-menu';
		
		$tablename = $wpdb->prefix.'terms';
		$menu_ids = $wpdb->get_results(
		    "
		    SELECT term_id
		    FROM ".$tablename." 
		    WHERE name= '".$menuname."'
		    "
		);
		
		// results in array 
		foreach($menu_ids as $menu):
		    $menu_id = $menu->term_id;
		endforeach; 

	    if( !has_nav_menu( $bpmenulocation ) ){
	        $locations = get_theme_mod('nav_menu_locations');
	        $locations[$bpmenulocation] = $menu_id;
	        $locations[$mobilemenulocation] = $menu_id;
	        set_theme_mod( 'nav_menu_locations', $locations );
	    }
	        
	}
endif;


if (!function_exists('et_get_remote_content')) :
	function et_get_remote_content($url) {

		$response = wp_remote_get($url);

		if( is_array($response) ) {
			$header = $response['headers']; // array of http header lines
			$body = $response['body']; // use the content
			return $body;
		}

		return false;
	}
endif;


if (!function_exists('et_update_widgets')) :

function et_update_widgets($version){

	$widgets 	= require apply_filters('et_file_url', PARENT_DIR . '/framework/widgets-import.php');

	$active_widgets = get_option( 'sidebars_widgets' );
	$widgets_counter = 1;

	foreach ($widgets[$version] as $area => $params) {

		if (! empty( $active_widgets[$area] ) && $params['flush']) {
			unset($active_widgets[ $area ]);
		}

		foreach ($params['widgets'] as $widget => $args) {

			$active_widgets[ $area ][] = $widget . '-' . $widgets_counter;
			$widget_content = get_option( 'widget_' . $widget );
			$widget_content[ $widgets_counter ] = $args;
			update_option(  'widget_' . $widget, $widget_content );
			$widgets_counter ++;
		}
	}

	update_option( 'sidebars_widgets', $active_widgets );

	}

endif;


add_action('wp_ajax_etheme_import_home_ajax', 'etheme_import_homepages');

if (!function_exists('etheme_import_homepages')) :
	
	function etheme_import_homepages($version){

	$version = $_POST['home_version'];
	$home_id = $_POST['home_version_id'];

	require_once ABSPATH . 'wp-admin/includes/import.php';
	$importerError = false;
	
	//check if wp_importer, the base importer class is available, otherwise include it
	if ( !class_exists( 'WP_Importer' ) ) {
		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) ) 
			require_once($class_wp_importer);
		else 
			$importerError = true;
	}
    
	
	if($importerError !== false) {
		echo ("The Auto importing script could not be loaded. Please use the wordpress importer and import the XML file that is located in your themes folder manually.");
	} else {
		
		if(class_exists('WP_Importer')){
			try{

				$versionsUrl = 'http://8theme.com/import/' . ETHEME_DOMAIN . '_versions/';
            	$folder = $versionsUrl.''.$version;

            	
				et_update_slider($folder,$version);

				et_create_file($folder);

				$file = PARENT_DIR.'/framework/tmp/version_data.xml';

				if (isset($file) && !empty($file)) {
					$importer = new WP_Import();
					$importer->fetch_attachments = true;
					$importer->import($file);
				}
				
				et_update_pages($version,$home_id);

                
                die('Success!');
					
			} catch (Exception $e) {
				echo ("Error while importing");
			}

		}
		
	}

	die();

	}

endif;