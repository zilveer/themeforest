<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

if(!class_exists('ET_Import')) {
	class ET_Import {

		private $import_url = 'http://8theme.com/import/classico_versions/';

		public function __construct() {
			
			add_action('wp_ajax_etheme_import_ajax', array($this, 'import_data'));

		}

		function import_data() {
		    //delete_option('demo_data_installed');die();

		    $demo_data_installed = get_option('demo_data_installed');	    
		        
		    $file = ET_BASE ."theme/assets/dummy/dummy.xml";

		    $version = '';
		    $pageid = 0;
		    $slider = false;

		    if(!empty($_POST['pageid'])) {
		    	$pageid = (int) $_POST['pageid'];
		    }
		    if(!empty($_POST['version'])) {
		    	$version = $_POST['version'];
		    }


			do_action('et_before_data_import');

			$slider_result = '';

			$xml_result = false;


	    	if( $version == 'base' && $demo_data_installed != 'yes' ) {

				$xml_result = $this->import_xml_file($file);

				$this->update_menus();

				$this->et_update_widgets($version);

				add_option('demo_data_installed', 'yes');

	    	} else {


	    		if($version == '') return;

				$slider_result = $this->import_slider_from_url($version);

				$this->update_home_page($pageid);

				$xml_result = $this->import_xml_from_url($version);

				$this->update_options($version);

				$this->et_update_widgets($version);
	    	}

	    	if($xml_result) {
	    		echo '<p>XML with dummy data has been successfully imported!</p>';
	    	} else {
	    		echo '<p>XML not imported.</p>';
	    	}

	    	if(isset($slider_result['success']) && $slider_result['success'] != '') {
	    		echo '<p>Revolutions slider has been successfully imported!</p>';
	    	}
				
			
			die();
		}


		function import_slider_from_url($version = 'base') {

			$folder = $this->import_url . $version;
			
			$sliderZip = $folder . '/slider.zip';

			$file_content = $this->get_remote_content($sliderZip);
			
			if($file_content) {

				$tmpZip = ET_BASE.'/framework/tmp/tempSliderZip.zip';
				
				file_put_contents($tmpZip, $file_content);
				
				return $this->import_slider($tmpZip);
			}
		}


		function import_slider($zip_file) {

			if(!class_exists('RevSlider')) return;

			$revapi = new RevSlider();
			
			ob_start();
			
			$slider_result = $revapi->importSliderFromPost(true, true, $zip_file);
			
			ob_end_clean();

			return $slider_result;

		}

		function import_xml_from_url($version) {
			$folder = $this->import_url . $version;

			$version_xml = $folder.'/data.xml';
			
			$slider_content = $this->get_remote_content($version_xml);
			
			if ( ! file_exists(PARENT_DIR.'/framework/tmp') ) {
				mkdir(PARENT_DIR.'/framework/tmp', 0777);
			} else {
				$output .= 'tmp directory already exist';
			}
			
			if($slider_content) {
				
				$tmpxml = ET_BASE.'/framework/tmp/version_data.xml';
				
				file_put_contents($tmpxml, $slider_content);

				return $this->import_xml_file($tmpxml);

			}
			return false;
		}


		function import_xml_file($file_url) {
			$result = false;

			// Load Importer API
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
				return;
			} 
				

			if(class_exists('WP_Importer')){
				
				try{

		        	ob_start();

					$importer = new WP_Import();

					$importer->fetch_attachments = true;

					$importer->import($file_url);

					$result = true;

					ob_end_clean();
					
					
				} catch (Exception $e) {
					$result = false;
					echo ("Error while importing");
				}


			}

			return $result;

		}

		function update_menus(){
			
			global $wpdb;
			
		    $menuname = 'menu';
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


		function update_home_page($pageid) {
			$home_id = get_page_by_title('Home');
			$blog_id = get_page_by_title('Blog');;
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $pageid );
		    update_option( 'page_for_posts', $blog_id->ID );
		}

		function get_remote_content($url) {

			$response = wp_remote_get($url);

			if( is_array($response) ) {
				$header = $response['headers']; // array of http header lines
				$body = $response['body']; // use the content
				return $body;
			}

			return false;
		}

		function update_options($version) {

			if(!class_exists('ReduxFrameworkInstances')) return;

			$folder = $this->import_url . $version;

			$options_file = $folder.'/options.txt';
			
			$new_options = $this->get_remote_content($options_file);

			if($new_options) {
				
				$new_options = json_decode($new_options, true);

				$redux = ReduxFrameworkInstances::get_instance( 'et_options' );

	            if ( isset ( $redux->validation_ran ) ) {
	                unset ( $redux->validation_ran );
	            }

	            $redux->set_options( $redux->_validate_options( $new_options ) );
			}
		}

		function et_update_widgets($version){

			$widgets 	= require ET_BASE . '/framework/widgets-import.php';

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
	}

	new ET_Import();

}