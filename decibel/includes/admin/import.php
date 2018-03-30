<?php
/*
Plugin Name: Wolf One-click importer
Plugin URI: http://wolfthemes.com
Description: Import everything.
Author: WpWolf
Author URI: http://wolfthemes.com
Version: 1.0
Text Domain: wolf
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Demo_Data_Importer' ) ) {

	class Wolf_Demo_Data_Importer {

		public function __construct() {

			add_action( 'admin_menu', array( $this, 'add_menu' ) );
			add_action( 'wolf_after_demo_data_import', array( $this, 'remove_tmpl_files' ) );
		}

		public function remove_tmpl_files() {

			if ( isset( $_GET['page'] ) && 'wolf-theme-import' ) {

				if ( $this->get_data() ) {
					//var_dump( $this->tmp_dir );
					wolf_clean_folder( $this->tmp_dir );
					$message = __( 'Done', 'wolf' );
					wolf_admin_notice( $message, 'updated' );
				}
			}
		}

		public function fallback_error_message() {
			return sprintf( __( 'Please <a href="%s" target="_blank">check the documentation</a> to import the files using Wordpress importer plugin.', 'wolf' ), 'http://docs.wolfthemes.com/documentation/themes/' . wolf_get_theme_slug() );
		}

		/**
		 * Display upload form
		 *
		 * Check if the server allow unzipping archives
		 *
		 * @return string
		 */
		public function do_update_zip() {

			if ( class_exists( 'ZipArchive' ) ) {

				$this->theme_dir = WOLF_THEME_DIR;
				$this->tmp_dir   = WOLF_THEME_DIR . '/tmp';

				if ( wolf_check_folder( $this->tmp_dir ) ) {
					$this->do_import();
				}
			} else {
				echo '<br>';
				printf(
					__( '<em>You server configuration does not allow you to import content by uploading a zip.
						You need %s installed on your server.</em>', 'wolf' ),
					'ZipArchive'
				);
				echo $this->fallback_error_message();
			}
		}

		/**
		 * Add Panel Page
		 */
		public function add_menu() {

			add_submenu_page( 'wolf-theme-options', __( 'Import', 'wolf' ), __( 'Import', 'wolf' ), 'manage_options', 'wolf-theme-import', array( $this, 'form' ) );
		}

		public function do_import() {

			if ( isset( $_GET['page'] ) && 'wolf-theme-import' ) {

				if ( $this->get_data() ) {
					$theme_options_name = 'wolf_theme_options_' . wolf_get_theme_slug();
					$data = $this->get_data();
					$options_file = $data['options_file'];
					$widgets_file = $data['widgets_file'];
					$content_file = $data['content_file'];
					$import_content = $data['import_content'];
					$import_widgets = $data['import_widgets'];
					$import_settings = $data['import_settings'];

					$menus = array(
						'primary' => 'Main Menu',
						'primary-left' => 'Main Menu Left',
						'primary-right' => 'Main Menu Right',
						'secondary' => 'Secondary Menu',
						'tertiary' => 'Bottom Menu',
					);

					if ( ! class_exists( 'Radium_Theme_Importer' ) )
						require_once( 'importer/importer.php' );

					//var_dump( $this->get_data() );

					$do_import = new Radium_Theme_Importer(
						$theme_options_name,
						$options_file,
						$widgets_file,
						$content_file,
						$menus,
						$import_content,
						$import_widgets,
						$import_settings
					);
				}
			}
		}

		public function get_data() {

			$data = array();

			if ( isset( $_POST['import-submit'] ) ) {

				if ( ! empty( $_FILES['import-zip']['name'] ) ) {

					$options_file = null;
					$widgets_file = null;
					$content_file = null;
					$file_content = null;
					$tmp_dir = WOLF_THEME_TMP_DIR;
					$file = $_FILES['import-zip'];
					$ext = pathinfo( $file['name'], PATHINFO_EXTENSION );
					$folder_name = str_replace( '.' . $ext, '', $file['name'] );

					if ( 'zip' != $ext  ) {
						// error not zip file
						$message = __( 'It seems that you are trying to upload the wrong file. It must be a zip archive containing the demo data files.', 'wolf' );
						wolf_admin_notice( $message, 'error' );
					} else {

						// Go
						$zip = new ZipArchive;
						if ( $zip->open( $file['tmp_name'] ) === TRUE ) {

							$zip->extractTo( $tmp_dir );
							$zip->close();

							$tmp_folder_path = $tmp_dir . '/' . $folder_name;

							// get text file
							foreach ( glob( $tmp_folder_path . '/*.txt' ) as $filename ) {
								$options_file = $filename;
								break;
							}

							// get json file
							foreach ( glob( $tmp_folder_path . '/*.json' ) as $filename ) {
								$widgets_file = $filename;
								break;
							}

							// get content file
							foreach ( glob( $tmp_folder_path . '/*.xml' ) as $filename ) {
								$content_file = $filename;
								break;
							}

							if ( ! $options_file || ! $widgets_file || ! $content_file ) {
								// error no files in zip
								$message = __( 'We couldn\'t find the right files in the archives. Please be sure that you have selected the right zip file.' , 'wolf' );
								wolf_admin_notice( $message, 'error' );

							} else {
								// all good, return the data in an array
								$data['options_file'] = $options_file;
								$data['widgets_file'] = $widgets_file;
								$data['content_file'] = $content_file;
								$data['import_content'] = isset( $_POST['import_content'] );
								$data['import_widgets'] = isset( $_POST['import_widgets'] );
								$data['import_settings'] = isset( $_POST['import_settings'] );
								$data['tmp_folder_path'] = $tmp_folder_path;
								return $data;
							}

						} else {
							// error unknown
							$message = __( 'We couldn\'t import the demo data.' , 'wolf' );
							$message .= $this->fallback_error_message();
							wolf_admin_notice( $message, 'error' );
						}
					}

				} else {
					// error no file
					$message = __( 'Please select a file to upload', 'wolf' );
					wolf_admin_notice( $message, 'error' );
				}
			}
		}

		public function form() {
			?>
			<style type="text/css">
				.import-wrap label{
					font-weight: 700;
				}

				.import-infos{
					margin-bottom: 30px;
				}

				.import-infos ul{
					margin: 0 0 30px;
					padding-left: 20px;
					list-style-position: inside;
					list-style-type: square;
				}

				.import-infos .important{
					font-weight: 700;
					font-size: 16px;
				}

				.import-action{
					margin-top: 30px;
				}

				#import-loader{
					margin-left: 5px;
					display: none;
				}

				.woocommerce-message,
				.wolf-plugin-admin-notice{
					display: none;
				}
			</style>
			<div class="wrap import-wrap">
				<?php $this->do_update_zip() ?>
				<h2><?php _e( 'Import Demo Data', 'wolf' ); ?></h2>
				<div class="import-infos">


					<p class="tie_message_hint important">
						<?php
							_e( 'It may take up to 10 minutes or more depending on your server performance.<br>', 'wolf' );
							printf(
								__( 'It is recommended to <a href="%s" target="_blank">read the theme documentation</a> before attempting to upload the demo content.',
								'wolf' ),
								'http://docs.wolfthemes.com/documentation/themes/' . wolf_get_theme_slug() . '#import'
							);
						?>
					</p>
				</div>
				<form method="post" enctype="multipart/form-data" action="<?php echo admin_url( 'admin.php?page=wolf-theme-import' ); ?>">
					<p>
						<label for="import-zip"><?php _e( 'Zip file', 'wolf' ); ?></label><br>
						<input type="file" name="import-zip">
					</p>
					<p>
						<label for="import-content">
						<input type="checkbox" name="import_content" checked="checked">
						<?php _e( 'Import content', 'wolf' ); ?>
						</label>
					</p>
					<p>
						<label for="import-settings">
						<input type="checkbox" name="import_settings" checked="checked">
						<?php _e( 'Import options', 'wolf' ); ?>
						</label>
					</p>
					<p>
						<label for="import-widgets">
						<input type="checkbox" name="import_widgets" checked="checked">
						<?php _e( 'Import widgets', 'wolf' ); ?>
						</label>
					</p>
					<p class="import-action">
						<input onclick="document.getElementById('import-loader').style.display = 'inline-block';" name="import-submit" class="button-primary" type="submit" value="<?php _e( 'Import', 'wolf' ); ?>">
						<img id="import-loader" src="<?php echo admin_url( 'images/loading.gif' ); ?>">
					</p>
				</form>
			</div><!-- .wrap -->
			<?php
		}

	} // end class
	$wolf_do_import_data = new Wolf_Demo_Data_Importer;
} // end class check