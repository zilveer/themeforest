<?php 

add_action('wp_ajax_etheme_import_ajax', 'etheme_import_data');

function etheme_import_data() {
    //delete_option('demo_data_installed');die();
    
	// Load Importer API
	require_once ABSPATH . 'wp-admin/includes/import.php';
	$importerError = false;
    $demo_data_installed = get_option('demo_data_installed');
    
    if($demo_data_installed == 'yes') die();

    mkdir(PARENT_DIR.'/framework/tmp', 0777);
    
        
    $file = get_template_directory() ."/framework/dummy/Dummy.xml";
   
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
	
		do_action('et_before_data_import');
		
		if(class_exists('WP_Importer')){
			try{
                
                if($demo_data_installed != 'yes') {
    				$importer = new WP_Import();
    				$importer->fetch_attachments = true;
    				$importer->import($file);
    				etheme_update_menus();
    				et_update_widgets();
                }
			                
			                	
				$versionsUrl = 'http://8theme.com/import/' . ETHEME_DOMAIN . '_versions/';
				$ver = 'base';
				$folder = $versionsUrl.''.$ver;
				
				$sliderZip = $folder.'/slider.zip';
				$sldier_content = et_get_remote_content($sliderZip);
				
				if($sldier_content && class_exists('RevSlider')) {
					$tmpZip = PARENT_DIR.'/framework/tmp/tempSliderZip.zip';
					
					file_put_contents($tmpZip, $sldier_content);
					
					$revapi = new RevSlider();
					
					$_FILES["import_file"]["tmp_name"] = $tmpZip;
					
					ob_start();
					
					$slider_result = $revapi->importSliderFromPost();
					mkdir(PARENT_DIR.'/framework/tmp', 0777);
					
					ob_end_clean();
				}
	
	
				etheme_update_options();
			    
                die('Success!');
				
				
				
			} catch (Exception $e) {
				echo ("Error while importing");
			}

		}
		
	}
		
	
	die();
}


add_action('wp_ajax_etheme_install_version', 'etheme_install_version');

function etheme_install_version() {
 	$output = '';
	require_once ABSPATH . 'wp-admin/includes/import.php';
	$importerError = false;
	if(empty($_POST['ver'])) die();
	mkdir(PARENT_DIR.'/framework/tmp', 0777);
	$versionsUrl = 'http://8theme.com/import/' . ETHEME_DOMAIN . '_versions/';
	$ver = $_POST['ver'];
	$folder = $versionsUrl.''.$ver;
	
	$sliderZip = $folder.'/slider.zip';
	$sldier_content = et_get_remote_content($sliderZip);
	
	if($sldier_content && class_exists('RevSlider')) {
		$tmpZip = PARENT_DIR.'/framework/tmp/tempSliderZip.zip';
		
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
	
	
	$version_xml = $folder.'/version_data.xml';
	
	$version_content = et_get_remote_content($version_xml);
	
	if($version_content) {
		
		$tmpxml = PARENT_DIR.'/framework/tmp/version_data.xml';
		
		file_put_contents($tmpxml, $version_content);
		
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
					$importer = new WP_Import();
					$importer->fetch_attachments = true;
					$importer->import($tmpxml);
					
					update_option( 'show_on_front', 'page' );
					update_option( 'page_on_front', $_POST['home_id'] );
					
					$output .= '<div class="updated">';
						$output .= "Version page installed successfully!";
					$output .= "</div>";
				} catch (Exception $e) {
					echo ("Error while importing");
				}
			}
		}
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

	die($output);
}

function etheme_update_options() {
    global $options_presets;
	$home_id = get_page_by_title('Home');
	$blog_id = get_page_by_title('Blog');;
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $home_id->ID );
    update_option( 'page_for_posts', $blog_id->ID );
    //add_option('demo_data_installed', 'yes');
    
    
    // Update Theme Optinos
    //$new_options = json_decode(base64_decode($options_presets[$style]),true);
	//update_option( 'option_tree', $new_options );
}

function et_get_remote_content($url) {

	$response = wp_remote_get($url);

	if( is_array($response) ) {
		$header = $response['headers']; // array of http header lines
		$body = $response['body']; // use the content
		return $body;
	}

	return false;
}

function etheme_update_menus(){
	
	global $wpdb;
	
    $menuname = 'main menu';
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


if (!function_exists('et_update_widgets')) :

function et_update_widgets(){

	$version = 'ecommerce';

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
