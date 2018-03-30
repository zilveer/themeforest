<?php
	global $different_themes_managment, $options;
	$different_themes_managment = new DifferentThemesManagment(THEME_FULL_NAME, THEME_NAME);


	//load the files that contain the options
	$options_files=array('general', 'style', 'slider', 'sidebar', 'documentation');
	foreach($options_files as $file){
		get_template_part(THEME_ADMIN_INCLUDES.$file);
	}


	$options = $different_themes_managment->get_options();


	function theme_configuration() {
		
		global $different_themes_managment;

		$different_themes_managment->print_heading("get more from Different Themes!");
		$different_themes_managment->print_options();
		$different_themes_managment->print_footer();
	}

	add_action('admin_menu', 'theme_menu');

	function theme_menu() {

		/* fix for not working menu after import
		if ( isset( $_GET['theme_mods'] ) && $_GET['theme_mods'] == 'delete' ) {
			delete_option("theme_mods_".THEME_NAME."-theme");
		}
		*/
		//management setting import/export
		if ( isset( $_GET['df-export'] ) && $_GET['df-export'] == 'download' ) {

			if($_GET['df-export-type']=="management") {
				$pageType = "management panel ";
			} else if($_GET['df-export-type']=="pagebuilder") {
				$pageType = get_the_title($_GET['post'])." ";
			}

			$exportfile = THEME_NAME.' export '.$pageType.date('Y-m-d').' at '.date('H.i.s').'.json';
			
			if($_GET['df-export-type']=="management") {
				$data = get_option('DifferentThemesManagementSettings');
			} else if($_GET['df-export-type']=="pagebuilder") {
				$data = get_post_meta( $_GET['post'], "_".THEME_NAME."_pagebuilder_layout", true );	
			}

		    // Set the headers to force a download
		    header('Content-type: application/force-download');
		    header('Content-Disposition: attachment; filename="'.str_replace(' ', '_', $exportfile).'"');


			die(base64_encode(json_encode($data)));
		}

		if ( isset( $_GET['df-export'] ) && $_GET['df-export'] == 'upload' ) {
			
			// Check export file if any
			if(isset($_FILES['df_import']['tmp_name'])) {
				$data = base64_decode(file_get_contents($_FILES['df_import']['tmp_name']));

				if(!$parsed = json_decode($data, true)) {
					$parsed = unserialize($data);
				}

				
				if($_GET['df-export-type']=="management") {
					if(is_array($parsed)) {
						update_option('DifferentThemesManagementSettings',$parsed);
					}
					
				} else if($_GET['df-export-type']=="pagebuilder") {
					$parsed = json_decode(stripslashes($data));
					update_post_meta( $_GET['post'], "_".THEME_NAME."_pagebuilder_layout",$parsed );	
				}

				
			}

		}
		add_menu_page(THEME_FULL_NAME.' Management', THEME_FULL_NAME.' Management', 'administrator', 'theme-configuration', 'theme_configuration',get_template_directory_uri().'/images/control-panel-images/logo-differentthemes-2.png');

	}

	
?>