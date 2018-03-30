<?php ob_start();

if(! class_exists('BFL_Backup')) {

	class BFL_Backup {
		
		public function __construct () {
			if ( current_user_can( 'edit_theme_options' ) ) {
				add_action( 'admin_menu', array(&$this, 'add_page'));
			}
		}

		function add_page() {
			$backup_page = add_theme_page( 'Backup Options', 'Backup Options', 'edit_theme_options', 'bfl_backup', array(&$this, 'render_page') );
		}

		function render_page() {
			echo $this->option_header();
			echo $this->import();
			echo $this->export();
		}

		public function option_header() {

			$output = '<h2>' . __( 'Backup Manager', 'optionsframework' ) . '</h2>';
			$output .= '<p>' . sprintf(__( '<strong>Note!</strong> This is only to backup the settings within <strong>Appearance &rarr; Theme Options</strong>, for all other Theme settings, use Tools &rarr; Export.', 'optionsframework'), '<a href="https://github.com/devinsays/options-framework-theme">Devin</a>' ) . '</p>';
			return $output;
		}
		

		/*	
		 *	Import feature
		 */
		function import() {

			if (isset($_FILES["import"]) && check_admin_referer("bfl-backup-import")) {

				if ($_FILES["import"]["error"] > 0) 

					wp_die("Error happens");		

				else {


					$file_name = $_FILES["import"]["name"];

					$file_type = $_FILES["import"]["type"];

					

					$file_ext = strtolower(end(explode(".", $file_name)));

					$file_size = $_FILES["import"]["size"];

					if ( ($file_ext === "json") && ( $file_type === 'application/json' ) && ($file_size < 500000) ) {


						$url = wp_nonce_url('admin.php?page=bfl_backup', 'bfl-backup-import');

						$form_fields = array('import');
						$method = '';

						// Get file writing credentials
						if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_fields) ) ) {
							return true;
						}
						
						if ( ! WP_Filesystem($creds) ) {
							// our credentials were no good, ask the user for them again
							request_filesystem_credentials($url, $method, true, false, $form_fields);
							return true;
						}
						
						// Write the file if credentials are good
						$upload_dir = wp_upload_dir();
						$filename = trailingslashit($upload_dir['path']).'optionsframework_options.json';
							 
						// by this point, the $wp_filesystem global should be working, so let's use it to create a file
						global $wp_filesystem;
						
						if ( ! $wp_filesystem->move($_FILES['import']['tmp_name'], $filename, true) ) {
							echo 'Error saving file!';
							return;
						}
						
						$encode_options = $wp_filesystem->get_contents($filename);
											
						$options = json_decode($encode_options, true);

						if ($options !== FALSE){

							$optionsframework_settings = get_option( 'optionsframework' );

							// Gets the unique option id
							if ( isset( $optionsframework_settings['id'] ) ) {

								$option_name = $optionsframework_settings['id'];

							}
							
							if( get_option( $option_name ) !== false ) {

								$values =  $this->_extract_values($options);
								
								if ( isset( $values ) ) {

									update_option( $option_name, $values ); // Add option with default settings

								}

								echo '<div class="updated"><p>All options are restored successfully.</p></div>';
								$wp_filesystem->delete($filename);
							}
							
						}
					}	

					else {
						echo '<div class="error"><p>Invalid file or file size too big.</p></div>';
					}
						
				}

			}

			if (isset($_FILES["import_skins"]) && check_admin_referer("bfl-backup-import")) {

				if ($_FILES["import_skins"]["error"] > 0) 

					wp_die("Error happens");		

				else {


					$file_name = $_FILES["import_skins"]["name"];
					$file_type = $_FILES["import_skins"]["type"];

					$file_ext = strtolower(end(explode(".", $file_name)));

					$file_size = $_FILES["import_skins"]["size"];

					if ( ($file_ext === "json") && ( $file_type === 'application/json' ) && ($file_size < 500000) ) {


						$url = wp_nonce_url('admin.php?page=bfl_backup', 'bfl-backup-import');

						$form_fields = array('import_skins');
						$method = '';

						// Get file writing credentials
						if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_fields) ) ) {
							return true;
						}
						
						if ( ! WP_Filesystem($creds) ) {
							// our credentials were no good, ask the user for them again
							request_filesystem_credentials($url, $method, true, false, $form_fields);
							return true;
						}
						
						// Write the file if credentials are good
						$upload_dir = wp_upload_dir();
						$filename = trailingslashit($upload_dir['path']).'optionsframework_options.json';
							 
						// by this point, the $wp_filesystem global should be working, so let's use it to create a file
						global $wp_filesystem;
						
						if ( ! $wp_filesystem->move($_FILES['import_skins']['tmp_name'], $filename, true) ) {
							echo 'Error saving file!';
							return;
						}
						
						$encode_options = $wp_filesystem->get_contents($filename);
											
						$skins = json_decode($encode_options, true);

						if ($skins !== FALSE){

							$theme 				= strtolower( get_option('themeva_theme') );
							$skin_ids			= $skins['skin_ids'];
							$skin_data			= $skins['skin_data'];
		
							update_option( 'skins_'. $theme .'_ids', $skin_ids );
							
							foreach( $skin_data as $skin => $value )
							{
								update_option( 'skin_data_'. $skin, $value );
							}
						

							echo '<div class="updated"><p>All Skins have been restored successfully.</p></div>';
							$wp_filesystem->delete($filename);
							
							
						}
					}	

					else {
						echo '<div class="error"><p>Invalid file or file size too big.</p></div>';
					}
						
				}

			}			

			$output = '';
			$output .= '<div class="wrap">';
			$output .= '<div id="icon-tools" class="icon32"><br /></div>';
			$output .= '<h2>Import Theme Options</h2>';
			$output .= '<p>Click Browse button and choose a json file that you backup before.</p>';
			$output .= '<form method="post" enctype="multipart/form-data">';
			$output .= '<p class="submit">';
			$output .=  wp_nonce_field("bfl-backup-import", "_wpnonce", true, false);
			$output .= '<input type="file" name="import" />';
			$output .= '<input type="submit" class="button" name="submit" value="Restore Theme Options"/>';
			$output .= '</p>';
			$output .= '</form>';
			$output .= '</div>';

			$output .= '<div class="wrap">';
			$output .= '<div id="icon-tools" class="icon32"><br /></div>';
			$output .= '<h2>Import Skins</h2>';
			$output .= '<p>Click Browse button and choose a json file that you backup before.</p>';
			$output .= '<form method="post" enctype="multipart/form-data">';
			$output .= '<p class="submit">';
			$output .=  wp_nonce_field("bfl-backup-import", "_wpnonce", true, false);
			$output .= '<input type="file" name="import_skins" />';
			$output .= '<input type="submit" class="button" name="submit" value="Restore Skins"/>';
			$output .= '</p>';
			$output .= '</form>';
			$output .= '</div>';		

		  
		    return $output;
		}

		/*	
		 *	Export feature
		 */
		function export() {
			if (isset($_POST["export"])) { 

			  	check_admin_referer("bfl-backup-export"); 
					
				$blogname = str_replace(" ", "", get_option("blogname"));
				$date = date("m-d-Y");
				$json_name = $blogname."-".$date; // Namming the filename will be generated.
				
				$optionsframework_settings = get_option('optionsframework');

				$option_name = $optionsframework_settings['id'];

				$options = get_option($option_name);
				
				$json_file = json_encode($options); // Encode data into json data
				
				ob_clean();
				echo $json_file;
				header("Content-Type: application/json; charset=" . get_option( "blog_charset"));
				header("Content-Disposition: attachment; filename=$json_name.json");
				exit();
			}

			if (isset($_POST["export_skins"])) { 

			  	check_admin_referer("bfl-backup-export"); 
					
				$blogname 			= str_replace(" ", "", get_option("blogname"));
				$date 				= date("m-d-Y");
				$json_name 		= $blogname."-skins-".$date; // Namming the filename will be generated.
				$theme 				= strtolower( get_option('themeva_theme') );
				$skin_ids 			= get_option('skins_'. $theme .'_ids');
				$skin_ids_array 	= explode( ',' , $skin_ids );
				$skin_data 		= array();
				
				foreach( $skin_ids_array as $skin_id )
				{
					$skin_data[$skin_id] = get_option( 'skin_data_'. $skin_id );
				}

				$skins = array(
					'skin_ids'		=> $skin_ids,
					'skin_data' 	=> $skin_data,
				);
				
				$json_file = json_encode($skins); // Encode data into json data
				
				ob_clean();
				echo $json_file;
				header("Content-Type: application/json; charset=" . get_option( "blog_charset"));
				header("Content-Disposition: attachment; filename=$json_name.json");
				exit();
			}			
			
			$output = '';
			$output .= '<div class="wrap">';
			$output .= '<div id="icon-tools" class="icon32"><br /></div>';
			$output .= '<h2>Export Theme Options</h2>';
			$output .= '<p>When you click <tt>Backup Theme Options</tt> button, system will generate a JSON file for you to save on your computer.</p>';
			$output .= '<form method="post">';
			$output .= '<p class="submit">';
			$output .=  wp_nonce_field("bfl-backup-export", "_wpnonce", true, false);
			$output .= '<input type="submit" class="button" name="export" value="Backup Theme Options" />';
			$output .= '</p>';
			$output .= '</form>';
			$output .= '</div>';


			$output .= '<div class="wrap">';
			$output .= '<div id="icon-tools" class="icon32"><br /></div>';
			$output .= '<h2>Export Skin Data</h2>';
			$output .= '<p>When you click <tt>Backup Skins</tt> button, system will generate a JSON file for you to save on your computer.</p>';
			$output .= '<form method="post">';
			$output .= '<p class="submit">';
			$output .=  wp_nonce_field("bfl-backup-export", "_wpnonce", true, false);
			$output .= '<input type="submit" class="button" name="export_skins" value="Backup Skins" />';
			$output .= '</p>';
			$output .= '</form>';
			$output .= '</div>';			

		    return $output;
		}

		private function _extract_values($config) {

			$output = array();
			
			$optionsframework_settings = get_option('optionsframework');

			$option_name = $optionsframework_settings['id'];

			$options = get_option($option_name);

			foreach ( $options as $key => $value ) {
				
				if( array_key_exists($key, $config) ) {

					$output[$key] = $config[$key];
				}
				else {
					$output[$key] = $value;
				}
				
			}

			return $output;
		}
	}

	new BFL_Backup();
}