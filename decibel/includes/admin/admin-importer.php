<?php
/**
 * Demo Importer
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WOLF_ENABLE_IMPORTER ) return;

if ( ! class_exists( 'Wolf_Demo_Data_Importer' ) ) {

	if ( ! defined('WP_LOAD_IMPORTERS') )
		define('WP_LOAD_IMPORTERS', true);

	require_once ABSPATH . 'wp-admin/includes/import.php';

	if ( ! class_exists( 'WP_Importer' ) ) {

		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

		if ( file_exists( $class_wp_importer ) ) {

			require_once( $class_wp_importer );
		}
	}

	if ( ! defined( 'WP_LOAD_IMPORTERS' ) )
		return;

	/** Display verbose errors */
	define( 'WOLF_IMPORT_DEBUG', false );

	// Load Importer API
	require_once( ABSPATH . 'wp-admin/includes/import.php' );

	if ( ! class_exists( 'WP_Importer' ) ) {
		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) )
			require( $class_wp_importer );
	}

	// include WXR file parsers
	require dirname( __FILE__ ) . '/importer/parsers.php';

	class Wolf_Demo_Data_Importer extends WP_Importer {

		var $tmp_dir;
		var $import_content = true;
		var $import_widgets = true;
		var $import_settings = true;

		function WP_Import() {}

		/**
		 * Importer Constructor
		 */
		public function import() {

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'admin_menu', array( $this, 'add_menu' ) );
			add_action( 'wolf_after_demo_data_import', array( $this, 'remove_tmpl_files' ) );
			add_action( 'wp_ajax_import_options_ajax', array( $this, 'import_options_ajax') );
			add_action( 'wp_ajax_process_post_ajax', array( $this, 'process_post_ajax') );
			add_action( 'wp_ajax_import_widgets_ajax', array( $this, 'import_widgets_ajax') );
			add_action( 'wp_ajax_import_settings_ajax', array( $this, 'import_settings_ajax') );
		}

		/**
		 * Add sub menu
		 */
		public function add_menu() {

			add_submenu_page( 'wolf-theme-options', __( 'Import', 'wolf' ), __( 'Import', 'wolf' ), 'manage_options', 'wolf-theme-import', array( $this, 'form' ) );
		}

		/**
		 * Get data from uploaded zip file
		 */
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
								$this->import_content = isset( $_POST['import_content'] );
								$this->import_widgets = isset( $_POST['import_widgets'] );
								$this->import_settings = isset( $_POST['import_settings'] );
								return $data;
							}

						} else {
							// error unknown
							$message = __( 'We couldn\'t import the demo data.' , 'wolf' );
							$message .= $this->fallback_error_message();
							wolf_admin_notice( $message, 'error' );
							return false;
						}
					}

				} else {
					// error no file
					$message = __( 'Please select a file to upload', 'wolf' );
					wolf_admin_notice( $message, 'error' );
					return false;
				}
			}
		}

		/**
		 * Import theme options
		 */
		public function import_options_ajax() {
			extract( $_POST );
			if ( isset( $_POST['data'] ) ) {
				$theme_options_name = 'wolf_theme_options_' . wolf_get_theme_slug();
				$data = $_POST['data'];
				//debug( $data );
				if ( array() != $data )
					update_option( $theme_options_name, $data );
				_e( 'Theme settings imported', 'wolf' );
				echo '<br>';
			}
			exit();
		}

		/**
		 * Process post
		 */
		public function process_post_ajax() {
			extract( $_POST );
			if ( isset( $_POST['post'] ) && isset( $_POST['base_url'] ) ) {
				// Don't break the JSON result
				error_reporting( 0 );
				// 5 minutes per post should be enough
				set_time_limit( 900 );

				$post = $_POST['post'];
				$base_url = $_POST['base_url'];
				$this->process_post( $post, $base_url );
			}
			exit();
		}

		/**
		 * Import Widgets
		 */
		public function import_widgets_ajax() {
			extract( $_POST );
			if ( isset( $_POST['data'] ) ) {
				// Don't break the JSON result
				error_reporting( 0 );
				$data = $_POST['data'];
				$this->import_widgets( $data );
				_e( 'Widgets imported', 'wolf' );
				echo '<br>';
			}
			exit();
		}

		/**
		 * Import various additional settings
		 */
		public function import_settings_ajax() {

			extract( $_POST );

			if ( isset( $_POST[ 'import_content' ] ) ) {

				if ( 'true' == $_POST['import_content'] ) {

					$this->set_reading_settings();
					$this->set_wolf_plugins_pages();
					_e( 'Page Settings Imported', 'wolf' );
					echo '<br>';

					$this->set_woocommerce_pages();

					$this->set_demo_menus();
					_e( 'Menu Imported', 'wolf' );
					echo '<br>';

					$this->set_permalink_structure();

					// finishing import
					// update incorrect/missing information in the DB
					$this->backfill_parents();
					$this->backfill_attachment_urls();
					$this->remap_featured_images();

					$this->remove_tmp_files(); // remove uploaded files
					$this->remove_temp_data(); // remove temporary data
				}

				_e( 'Finish', 'wolf' );

			}
			exit();
		}

		/**
		 * Form
		 */
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
				<?php
				// debug
				// if ( isset( $_POST['import-submit'] ) ) {
				// 	$data = $this->get_data();
				// 	$options_file = $data['options_file'];
				// 	$serialized_options = file_get_contents( $options_file );
				// 	//$file_content = strip_tags( stripslashes( $file_content ) );
				// 	//$serialized_options = preg_replace( '/\s+/', '', $file_content );
				// 	$unserialized_options_data = @unserialize( base64_decode( $serialized_options ) );
				// 	$json_data = json_encode( $unserialized_options_data );
				// 	debug( $json_data );
				// 	die();
				// }
				?>
				<h2><?php _e( 'Import Demo Data', 'wolf' ); ?></h2>
				<?php if ( $this->can_use_zip( false ) ) : ?>
					<?php if ( isset( $_POST['import-submit'] ) ) : ?>
						<?php // Progress Bar ?>
						<div id="progress-bar" style="position:relative;height:25px;margin-top:30px; margin-bottom:20px;">
							<div id="progress-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;"></div>
						</div>
						<script type="text/javascript">
							jQuery( document ).ready( function( $ ) {

								// Create the progress bar
								$( '#progress-bar' ).progressbar();
								$( '#progress-bar' ).progressbar( 'value', 0 );
								$( '#progress-bar-percent' ).html( '0%' );

								<?php
								// get data
								$data = $this->get_data();

								/*--------------------------------------------------------------------------------------------------------
								 * Options Data
								 *-------------------------------------------------------------------------------------------------------*/
								$theme_options_name = 'wolf_theme_options_' . wolf_get_theme_slug();
								$options_file = $data['options_file'];

								// File exists?
								if ( ! file_exists( $options_file ) ) {
									// no options file
									$data = 'no options file';
								}

								// Get file contents
								$file_content = file_get_contents( $options_file );

								if ( isset( $_POST[ 'import_settings' ] ) ) {
									$data = @unserialize( base64_decode( $file_content ) );
								} else {
									$data = 'no import_settings posted';
								}

								$json_data = json_encode( $data );

								if ( $this->import_settings ) :
								?>
								/**
								 * Import options
								 */
								jQuery.ajaxq( 'importQueue', {
									type: 'POST',
									cache: false,
									url: ajaxurl,
									data: {
										action: 'import_options_ajax',
										data : <?php echo $json_data; ?>
									},
									success: function( response ) {
										$( '#progress-bar' ).progressbar( 'value', 1 );
										$( '#progress-bar-percent' ).html( '1%' );
										$( '#ajax-result' ).append( response );
									},
									error: function( response ) {
										$( '#ajax-result' ).append( response );
									}
								} );

								<?php
								endif; // endif import options
								/*--------------------------------------------------------------------------------------------------------
								 * Content Data
								 *-------------------------------------------------------------------------------------------------------*/
								$data = $this->get_data();
								$content_data = $data['content_file'];
								$import_data = $this->parse( $content_data );

								/**
								 * Process Posts
								 */
								?>
								var count = 10,
									postTotal = <?php echo count( $import_data['posts'] ); ?> + 10;

								// Called after each insert post. Updates debug information and the progress bar.
								function processPostUpdateStatus( post, success, response ) {
									if ( 10 === count ) {
										$( '#ajax-result' ).append( '<?php _e( 'Importing posts and attachments, please wait', 'wolf' ); ?>...<br>' );
									}
									$( '#progress-bar' ).progressbar( 'value', ( ( count / postTotal ) * 100 ) );
									$( '#progress-bar-percent' ).html( Math.floor( ( count / postTotal ) * 100 ) + '%' );
									count = count + 1;
									$( '#ajax-result' ).append( response );
								}

								function processPost( post ) {
									jQuery.ajaxq( 'importQueue', {
										type: 'POST',
										cache: false,
										url: ajaxurl,
										data: {
											action: 'process_post_ajax',
											post: post,
											base_url : <?php echo json_encode( esc_url( $import_data['base_url'] ) ); ?>
										},
										success: function( response ) {
											processPostUpdateStatus( post, true, response );
											//console.log( response );
										},
										error: function( response ) {

										}
									} );
								}
								<?php
								if ( $this->import_content ) :
								/**
								 * Insert post one by one
								 */
								foreach ( $import_data['posts'] as $post ) {
									//if ( 'nav_menu_item' == $post['post_type'] ) // debug menu items
									?>
								processPost( <?php echo json_encode( $post ); ?> );
								<?php
							}
							endif; //  endif import content

							/*--------------------------------------------------------------------------------------------------------
							 * Widget Data
							 *-------------------------------------------------------------------------------------------------------*/
							$widget_data = file_get_contents( $data['widgets_file'] );
							if ( $this->import_widgets ) :
							?>
								/**
								 * Import Widgets
								 */
								jQuery.ajaxq( 'importQueue', {
									type: 'POST',
									cache: false,
									url: ajaxurl,
									data: {
										action: 'import_widgets_ajax',
										data :<?php echo $widget_data; ?>
									},
									success: function( response ) {
										$( '#progress-bar' ).progressbar( 'value', 97 );
										$( '#progress-bar-percent' ).html( '97%' );
										$( '#ajax-result' ).append( response );
									},
									error: function( response ) {

									}
								} );
								<?php
								endif;

								$do_import_content = ( $this->import_content ) ? 'true' : 'false';
								/*--------------------------------------------------------------------------------------------------------
								 * Settings Data
								 *-------------------------------------------------------------------------------------------------------*/
								?>
								/**
								 * Import settings
								 */
								jQuery.ajaxq( 'importQueue', {
									type: 'POST',
									cache: false,
									url: ajaxurl,
									data: {
										action: 'import_settings_ajax',
										import_content : <?php echo $do_import_content; ?>
									},
									success: function( response ) {
										$( '#progress-bar' ).progressbar( 'value', 100 );
										$( '#progress-bar-percent' ).html( "100% <?php _e( 'All done', 'wolf' ) ?> ;)" );
										$( '#ajax-result' ).append( response );
									},
									error: function( response ) {

									}
								} );

							} );
						</script>
						<?php // end Progress Bar ?>
					<?php endif; ?>
					<form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin.php?page=wolf-theme-import' ) ); ?>">
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
							<input name="import-submit" id="import-submit" class="button-primary" type="submit" value="<?php _e( 'Import', 'wolf' ); ?>">
						</p>
					</form>
					<div id="ajax-result"></div>
				<?php else : ?>
					<?php $this->can_use_zip( true ); ?>
				<?php endif; ?>
			</div><!-- .wrap -->
		<?php
		}

		/**
		 * Import widgets
		 *
		 * @param array $file_content
		 */
		public static function import_widgets( $file_content ) {

			global $wp_registered_sidebars;
			// Get file contents and decode
			//$data = json_decode( $file_content );
			$import_array = $file_content;

			$sidebars_data = $import_array[0];
			$widget_data = $import_array[1];
			$current_sidebars = get_option( 'sidebars_widgets' );
			$new_sidebars = array();
			$new_widgets = array();


			foreach ( $sidebars_data as $import_sidebar => $import_widgets ) {

				foreach ( $import_widgets as $import_widget ) {

					//if the sidebar exists
					if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) {

						$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
						$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
						$current_widget_data = get_option( 'widget_' . $title );
						$new_widget_name = self::get_new_widget_name( $title, $index );
						$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

						if ( ! empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
							while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
								$new_index++;
							}
						}
						$new_sidebars[$import_sidebar][] = $title . '-' . $new_index;
						if ( array_key_exists( $title, $new_widgets ) ) {

							$new_widgets[$title][$new_index] = $widget_data->title[$index];
							$multiwidget = $new_widgets[$title]['_multiwidget'];
							unset( $new_widgets[$title]['_multiwidget'] );
							$new_widgets[$title]['_multiwidget'] = $multiwidget;

						} else {

							$current_widget_data[$new_index] = $widget_data->title->index;
							$current_multiwidget = $current_widget_data['_multiwidget'];
							$new_multiwidget = isset($widget_data->title['_multiwidget']) ? $widget_data->title['_multiwidget'] : false;
							$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
							unset( $current_widget_data['_multiwidget'] );
							$current_widget_data['_multiwidget'] = $multiwidget;
							$new_widgets[$title] = $current_widget_data;
						}

					}
				}
			}


			// insert widgets only in empty sidebars
			foreach ( $wp_registered_sidebars as $index => $current_sidebar ) {
				if ( ! is_active_sidebar( $index ) ) {
					$wp_registered_sidebars[$index] = $new_sidebars[$index];
				}
			}

			if ( isset( $new_widgets ) && isset( $wp_registered_sidebars ) ) {
				update_option( 'sidebars_widgets', $wp_registered_sidebars );

				foreach ( $new_widgets as $title => $content ) {
					$content = apply_filters( 'widget_data_import', $content, $title );
					update_option( 'widget_' . $title, $content );
				}

				return true;
			}

			return false;
		}

		/**
		 * Get widget name
		 *
		 * @param string $widget_name
		 * @param string $widget_index
		 * @return string
		 */
		public static function get_new_widget_name( $widget_name, $widget_index ) {
			$current_sidebars = get_option( 'sidebars_widgets' );
			$all_widget_array = array( );
			foreach ( $current_sidebars as $sidebar => $widgets ) {
				if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
					foreach ( $widgets as $widget ) {
						$all_widget_array[] = $widget;
					}
				}
			}
			while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
				$widget_index++;
			}
			$new_widget_name = $widget_name . '-' . $widget_index;
			return $new_widget_name;
		}

		/**
		 * Set home and blog page
		 */
		public function set_reading_settings() {
			$home = get_page_by_title( 'Home' );
			$blog = get_page_by_title( 'Blog' );

			if ( ! $blog )
				$blog = get_page_by_title( 'News' );

			$o = array(
				'show_on_front' => 'page',
				'posts_per_page' => 8,
				'thread_comments' => 1,
				'thread_comments_depth ' => 2,
			);

			if ( $blog ) {
				$o['page_for_posts'] = $blog->ID;
			}

			if ( $home ) {
				$o['page_on_front'] = $home->ID;
			}

			foreach ( $o as $k => $v ) {
				update_option( $k, $v );
			}
		}

		/**
		 * Set wolf plugins pages
		 */
		public function set_wolf_plugins_pages() {
			$portfolio = get_page_by_title( 'Portfolio' );
			$albums = get_page_by_title( 'Albums' );
			$videos = get_page_by_title( 'Videos' );
			$discography = get_page_by_title( 'Discography' );

			if ( $portfolio ) {
				update_option( '_wolf_portfolio_page_id', $portfolio->ID );
			}

			if ( $albums ) {
				update_option( '_wolf_albums_page_id', $albums->ID );
			}

			if ( $videos ) {
				update_option( '_wolf_videos_page_id', $videos->ID );
			}

			if ( $discography ) {
				update_option( '_wolf_discography_page_id', $discography->ID );
			}
		}

		/**
		 * Set WooCommerce pages
		 */
		public function set_woocommerce_pages() {
			$o = array();
			$shop = get_page_by_title( 'Shop' );
			$cart = get_page_by_title( 'Cart' );
			$checkout = get_page_by_title( 'Checkout' );
			$user_account = get_page_by_title( 'My Account' );

			if ( ! $shop )
				$shop = get_page_by_title( 'Store' );

			if ( ! $shop )
				$shop = get_page_by_title( 'Welcome to our shop' );

			if ( $shop ) {
				$o['woocommerce_shop_page_id'] = $shop->ID;
			}

			if ( $cart ) {
				$o['woocommerce_cart_page_id'] = $cart->ID;
			}

			if ( $checkout ) {
				$o['woocommerce_checkout_page_id'] = $checkout->ID;
			}

			if ( $user_account ) {
				$o['woocommerce_myaccount_page_id'] = $user_account->ID;
			}

			foreach ( $o as $k => $v ) {
				update_option( $k, $v );
			}
		}

		/**
		 * Set menu locations
		 */
		public function set_demo_menus() {

			$menus = array(
				'primary' => 'Main Menu',
				'primary-left' => 'Main Menu Left',
				'primary-right' => 'Main Menu Right',
				'secondary' => 'Secondary Menu',
				'tertiary' => 'Bottom Menu',
			);

			foreach ( $menus as $id => $name ) {
				$menu = get_term_by( 'name', $name, 'nav_menu' );
				if ( is_object( $menu ) )
					$menu_data[$id] = $menu->term_id;
			}

			set_theme_mod( 'nav_menu_locations' , $menu_data );
		}

		/**
		 * Data key list
		 *
		 * processed_posts
		 * post_orphans
		 * missing_menu_items
		 * menu_item_orphans
		 * url_remap
		 * featured_images
		 */

		/**
		 * Store temporary data using the Wordpress options
		 */
		public function set_temp_data( $name, $key, $value ) {
			$array = get_option( $name );

			if ( $key )
				$array[ $key ] = $value;
			else
				$array[] = $value;

			update_option( $name, $array );
		}

		/**
		 * Get temporary data from  options
		 */
		public function get_temp_data( $name, $key = null ) {
			$array = get_option( $name );
			if ( is_array( $array ) && get_option( $name ) ) {
				if ( isset( $array[ $key ] ) && $key ) {
					return $array[ $key ];
				} elseif( ! $key ) {
					return $array;
				}
			} else {
				return array();
			}
		}

		/**
		 * Remove all temporary data options
		 */
		public function remove_temp_data() {
			delete_option( 'processed_posts' );
			delete_option( 'post_orphans' );
			delete_option( 'missing_menu_items' );
			delete_option( 'menu_item_orphans' );
			delete_option( 'url_remap' );
			delete_option( 'featured_images' );
		}

		/**
		 * Create post
		 */
		function process_post( $post, $base_url = '' ) {

			add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
			add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );

			// set very high max input var for menu items
			ini_set( 'max_input_vars', 300 );

			if ( ! post_type_exists( $post['post_type'] ) ) {
				if ( WOLF_IMPORT_DEBUG ) {
					printf( __( 'Failed to import &#8220;%s&#8221;: Invalid post type %s', 'wolf' ),
						esc_html($post['post_title']), esc_html($post['post_type']) );
					echo '<br />';
				}

				//continue;
			}

			//debug( $this->get_temp_data( 'processed_posts' ) );

			//if ( isset( $this->processed_posts[$post['post_id']] ) && ! empty( $post['post_id'] ) )
			if ( $this->get_temp_data( 'processed_posts', $post['post_id'] )  && ! empty( $post['post_id'] ) ) {
				//continue;
			}
				

			if ( $post['status'] == 'auto-draft' ) {
				//continue;
			}
					

			if ( 'nav_menu_item' == $post['post_type'] ) {

				$this->process_menu_item( $post );
				//continue;
			}

			$post_type_object = get_post_type_object( $post['post_type'] );

			$post_exists = post_exists( $post['post_title'], '', $post['post_date'] );
			if ( $post_exists && get_post_type( $post_exists ) == $post['post_type'] ) {

				if ( WOLF_IMPORT_DEBUG ) {
					//printf( __('%s &#8220;%s&#8221; already exists.', 'wolf'), $post_type_object->labels->singular_name, esc_html($post['post_title']) );
					//echo '<br />';
				}
				$comment_post_ID = $post_id = $post_exists;
			} else {

				$post_parent = (int) $post['post_parent'];
				if ( $post_parent ) {
					// if we already know the parent, map it to the new local ID
					if ( $this->get_temp_data( 'processed_posts', $post_parent ) ) {
						//$post_parent = $this->processed_posts[$post_parent];
						$post_parent = $this->get_temp_data( 'processed_posts', $post_parent );

						// otherwise record the parent for later
					} else {
						$this->set_temp_data( 'post_orphans', absint( $post['post_id'] ) , $post_parent );
						//$this->post_orphans[intval($post['post_id'])] = $post_parent;
						$post_parent = 0;
					}
				}

				// map the post author
				$author = (int) get_current_user_id();

				$postdata = array(
					'import_id' => $post['post_id'], 'post_author' => $author, 'post_date' => $post['post_date'],
					'post_date_gmt' => $post['post_date_gmt'], 'post_content' => $post['post_content'],
					'post_excerpt' => $post['post_excerpt'], 'post_title' => $post['post_title'],
					'post_status' => $post['status'], 'post_name' => $post['post_name'],
					'comment_status' => $post['comment_status'], 'ping_status' => $post['ping_status'],
					'guid' => $post['guid'], 'post_parent' => $post_parent, 'menu_order' => $post['menu_order'],
					'post_type' => $post['post_type'], 'post_password' => $post['post_password']
				);

				if ( 'attachment' == $postdata['post_type'] ) {
					$remote_url = ! empty($post['attachment_url']) ? $post['attachment_url'] : $post['guid'];

					// try to use _wp_attached file for upload folder placement to ensure the same location as the export site
					// e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
					$postdata['upload_date'] = $post['post_date'];
					if ( isset( $post['postmeta'] ) ) {
						foreach( $post['postmeta'] as $meta ) {
							if ( $meta['key'] == '_wp_attached_file' ) {
								if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) )
									$postdata['upload_date'] = $matches[0];
								break;
							}
						}
					}

					$comment_post_ID = $post_id = $this->process_attachment( $postdata, $remote_url, $base_url );
				} else {
					$comment_post_ID = $post_id = wp_insert_post( $postdata, true );
					if ( WOLF_IMPORT_DEBUG ) {
						//printf( __('%s &#8220;%s&#8221; imported.', 'wolf'), $post_type_object->labels->singular_name, esc_html($post['post_title']) );
						//echo '<br />';
					}
				}

				if ( is_wp_error( $post_id ) ) {
					if ( WOLF_IMPORT_DEBUG ) {
						printf( __( 'Failed to import %s &#8220;%s&#8221;', 'wolf' ),
							$post_type_object->labels->singular_name, esc_html($post['post_title']) );
						if ( WOLF_IMPORT_DEBUG )
							echo ': ' . $post_id->get_error_message();
						echo '<br />';
					}
					// continue;
				}

				if ( $post['is_sticky'] == 1 ) {
					stick_post( $post_id );
				}
					
			}

			// map pre-import ID to local ID
			//debug( intval( $post['post_id'] ) . ' = ' . (int) $post_id );
			$this->set_temp_data( 'processed_posts', intval( $post['post_id'] ), (int) $post_id );
			//debug( $this->get_temp_data( 'processed_posts' ) );

			// add categories, tags and other terms
			if ( ! empty( $post['terms'] ) ) {
				$terms_to_set = array();
				foreach ( $post['terms'] as $term ) {
					// back compat with WXR 1.0 map 'tag' to 'post_tag'
					$taxonomy = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
					$term_exists = term_exists( $term['slug'], $taxonomy );
					$term_id = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
					if ( ! $term_id ) {
						$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );
						if ( ! is_wp_error( $t ) ) {
							$term_id = $t['term_id'];
						} else {
							if ( WOLF_IMPORT_DEBUG ) {
								printf( __( 'Failed to import %s %s', 'wolf' ), esc_html($taxonomy), esc_html($term['name']) );
								echo ': ' . $t->get_error_message();
								echo '<br />';
							}
							continue;
						}
					}
					$terms_to_set[$taxonomy][] = intval( $term_id );
				}

				foreach ( $terms_to_set as $tax => $ids ) {
					$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
				}
				unset( $post['terms'], $terms_to_set );
			}

			// add/update comments
			if ( ! empty( $post['comments'] ) ) {
				$num_comments = 0;
				$inserted_comments = array();
				foreach ( $post['comments'] as $comment ) {
					$comment_id	= $comment['comment_id'];
					$newcomments[$comment_id]['comment_post_ID']      = $comment_post_ID;
					$newcomments[$comment_id]['comment_author']       = $comment['comment_author'];
					$newcomments[$comment_id]['comment_author_email'] = $comment['comment_author_email'];
					$newcomments[$comment_id]['comment_author_IP']    = $comment['comment_author_IP'];
					$newcomments[$comment_id]['comment_author_url']   = $comment['comment_author_url'];
					$newcomments[$comment_id]['comment_date']         = $comment['comment_date'];
					$newcomments[$comment_id]['comment_date_gmt']     = $comment['comment_date_gmt'];
					$newcomments[$comment_id]['comment_content']      = $comment['comment_content'];
					$newcomments[$comment_id]['comment_approved']     = $comment['comment_approved'];
					$newcomments[$comment_id]['comment_type']         = $comment['comment_type'];
					$newcomments[$comment_id]['comment_parent'] 	  = $comment['comment_parent'];
					$newcomments[$comment_id]['commentmeta']          = isset( $comment['commentmeta'] ) ? $comment['commentmeta'] : array();
					if ( isset( $this->processed_authors[$comment['comment_user_id']] ) )
						$newcomments[$comment_id]['user_id'] = $this->processed_authors[$comment['comment_user_id']];
				}
				ksort( $newcomments );

				foreach ( $newcomments as $key => $comment ) {
					// if this is a new post we can skip the comment_exists() check
					if ( ! $post_exists || ! comment_exists( $comment['comment_author'], $comment['comment_date'] ) ) {
						if ( isset( $inserted_comments[$comment['comment_parent']] ) )
							$comment['comment_parent'] = $inserted_comments[$comment['comment_parent']];
						$comment = wp_filter_comment( $comment );
						$inserted_comments[$key] = wp_insert_comment( $comment );

						foreach( $comment['commentmeta'] as $meta ) {
							$value = maybe_unserialize( $meta['value'] );
							add_comment_meta( $inserted_comments[$key], $meta['key'], $value );
						}

						$num_comments++;
					}
				}
				unset( $newcomments, $inserted_comments, $post['comments'] );
			}

			// add/update post meta
			if ( isset( $post['postmeta'] ) ) {
				foreach ( $post['postmeta'] as $meta ) {
					$key = apply_filters( 'import_post_meta_key', $meta['key'] );
					$value = false;

					// don't do author meta
					// if ( '_edit_last' == $key ) {
					// 	if ( isset( $this->processed_authors[intval($meta['value'])] ) )
					// 		$value = $this->processed_authors[intval($meta['value'])];
					// 	else
					// 		$key = false;
					// }

					if ( $key ) {
						// export gets meta straight from the DB so could have a serialized string
						if ( ! $value )
							$value = maybe_unserialize( $meta['value'] );

						add_post_meta( $post_id, $key, $value );
						do_action( 'import_post_meta', $post_id, $key, $value );

						// if the post has a featured image, take note of this in case of remap
						if ( '_thumbnail_id' == $key )
							//$this->featured_images[$post_id] = (int) $value;
							$this->set_temp_data( 'featured_images', $post_id, (int) $value );
					}
				}
			}
		}

		/**
		 * Attempt to create a new menu item from import data
		 *
		 * Fails for draft, orphaned menu items and those without an associated nav_menu
		 * or an invalid nav_menu term. If the post type or term object which the menu item
		 * represents doesn't exist then the menu item will not be imported (waits until the
		 * end of the import to retry again before discarding).
		 *
		 * Modified to be able to save menu items
		 * @see https://wordpress.org/support/topic/failure-to-import-post-meta-for-nav-menu-item
		 *
		 * @param array $item Menu item details from WXR file
		 */
		function process_menu_item( $post ) {

			// skip draft, orphaned menu items
			if ( 'draft' == $post['status'] )
				return;

			$menu_slug = false;

			// add categories, tags and other terms
			if ( ! empty( $post['terms'] ) ) {
				$term = $post['terms'][0];
				$taxonomy = 'nav_menu';
				$term_exists = term_exists( $term['slug'], $taxonomy );
				$term_id = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
				if ( ! $term_id ) {
					$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );

					if ( WOLF_IMPORT_DEBUG ) {
						//printf( __( 'Importing  %s %s', 'wolf' ), esc_html($taxonomy), esc_html($term['name']) );
						//echo '<br />';
					}

					if ( ! is_wp_error( $t ) ) {
						$term_id = $t['term_id'];
					} else {
						if ( WOLF_IMPORT_DEBUG ) {
							printf( __( 'Failed to import %s %s', 'wolf' ), esc_html($taxonomy), esc_html($term['name']) );
							echo ': ' . $t->get_error_message();
							echo '<br />';
						}
						//continue;
					}
				} else {
					if ( WOLF_IMPORT_DEBUG ) {
						// printf( __( 'Already exists %s %s', 'wolf' ), esc_html($taxonomy), esc_html($term['name']) );
						// echo '<br />';
					}
				}
			}

			if ( isset($post['terms']) ) {
				// loop through terms, assume first nav_menu term is correct menu
				foreach ( $post['terms'] as $term ) {
					if ( 'nav_menu' == $term['domain'] ) {
						$menu_slug = $term['slug'];
						break;
					}
				}
			}

			// no nav_menu term associated with this menu item
			if ( ! $menu_slug ) {
				if ( WOLF_IMPORT_DEBUG ) {
					_e( 'Menu item skipped due to missing menu slug', 'wolf' );
					echo '<br />';
				}
				return;
			}

			$menu_id = term_exists( $menu_slug, 'nav_menu' );
			if ( ! $menu_id ) {
				if ( WOLF_IMPORT_DEBUG ) {
					printf( __( 'Menu item skipped due to invalid menu slug: %s', 'wolf' ), esc_html( $menu_slug ) );
					echo '<br />';
				}
				return;
			} else {
				$menu_id = is_array( $menu_id ) ? $menu_id['term_id'] : $menu_id;
			}

			// Create an array to store all the post meta in
			$menu_item_meta = array();

			foreach ( $post['postmeta'] as $meta  ){
				$$meta['key'] = $meta['value'];
				$menu_item_meta[$meta['key']] = $meta['value'];
			}

			//if ( 'post_type' == $_menu_item_type && isset( $this->processed_posts[intval($_menu_item_object_id)] ) ) {
			if ( 'post_type' == $_menu_item_type && $this->get_temp_data( 'processed_posts', intval( $_menu_item_object_id ) ) ) {

				$_menu_item_object_id = $this->get_temp_data( 'processed_posts', intval( $_menu_item_object_id ) );

			} else if ( 'custom' != $_menu_item_type ) {
				// associated object is missing or not imported yet, we'll retry later
				//$this->missing_menu_items[] = $post;
				$this->set_temp_data( 'missing_menu_items' , null, $post );
				//debug( $this->get_temp_data( 'missing_menu_items' ) );
				//debug( $post );
				//echo "put in missing_menu_items<br>";
				return;
			}
			//echo "test";

			// if ( isset( $this->processed_menu_items[intval($_menu_item_menu_item_parent)] ) ) {
			if ( $this->get_temp_data( 'processed_menu_items', intval( $_menu_item_menu_item_parent ) ) ) {
				$_menu_item_menu_item_parent = $this->get_temp_data( 'processed_menu_items', intval( $_menu_item_menu_item_parent ) );
			} else if ( $_menu_item_menu_item_parent ) {
				//$this->menu_item_orphans[intval($post['post_id'])] = (int) $_menu_item_menu_item_parent;
				$this->set_temp_data( 'menu_item_orphans', intval($post['post_id']), (int) $_menu_item_menu_item_parent );
				$_menu_item_menu_item_parent = 0;
			}

			// wp_update_nav_menu_item expects CSS classes as a space separated string
			$_menu_item_classes = maybe_unserialize( $_menu_item_classes );
			if ( is_array( $_menu_item_classes ) )
				$_menu_item_classes = implode( ' ', $_menu_item_classes );


			// if hard coded URL
			if ( preg_match( '#http://.*wolfthemes.com#', $_menu_item_url, $matches ) ) {

				if ( isset( $matches[0] ) ) {
					$wolf_root_url = $matches[0];

					$site_url = home_url( '/' );
					$url_array = explode( '/', $_menu_item_url );

					if ( isset( $url_array[3] ) ) {
						$demo_slug = $url_array[3];

						$wolf_url = $wolf_root_url . '/' . $demo_slug . '/';
						$_menu_item_url = str_replace( $wolf_url, $site_url, $_menu_item_url );
					}
				}
			}

			$args = array(
				'menu-item-object-id' => $_menu_item_object_id,
				'menu-item-object' => $_menu_item_object,
				'menu-item-parent-id' => $_menu_item_menu_item_parent,
				'menu-item-position' => intval( $post['menu_order'] ),
				'menu-item-type' => $_menu_item_type,
				'menu-item-title' => $post['post_title'],
				'menu-item-url' => $_menu_item_url,
				'menu-item-description' => $post['post_content'],
				'menu-item-attr-title' => $post['post_excerpt'],
				'menu-item-target' => $_menu_item_target,
				'menu-item-classes' => $_menu_item_classes,
				'menu-item-xfn' => $_menu_item_xfn,
				'menu-item-status' => $post['status'],
			);

			$do_insert = true;

			/**
			 * Check if menu item already exists
			 */
			$existing_items = wp_get_nav_menu_items( $menu_id );

			foreach ( $existing_items as $existing_item ) {

				$exists = false;

				if ( 'custom' == $_menu_item_type ) {
					//debug( $existing_item );
					//debug( $args );
					$exists = $existing_item->title == $args['menu-item-title'];
				} else {
					$exists = $existing_item->object_id == $args['menu-item-object-id'];
				}

				if ( $exists ) {
					//if ( WOLF_IMPORT_DEBUG )
					//echo 'already exists<br>';

					$do_insert = false;
					break;
				}
			}

			//$do_insert = false;

			if ( $do_insert ) {

				$id = wp_update_nav_menu_item( $menu_id, 0, $args );

				if ( $id && ! is_wp_error( $id ) ) {
					//$this->processed_menu_items[intval($post['post_id'])] = (int) $id;
					$this->set_temp_data( 'processed_menu_items', intval( $post['post_id'] ), (int) $id );

					// Add Custom Meta not already covered by $args

					// Remove all default $args from $menu_item_meta array
					foreach ( $args as $a => $arg ) {
						unset( $menu_item_meta[ '_' . str_replace('-', '_', $a) ]);
					}
					// For some reason this doesn't follow the same naming convention so manually unset
					unset( $menu_item_meta['_menu_item_menu_item_parent'] );

					$menu_item_meta = array_diff_assoc( $menu_item_meta, $args );

					// update any other post meta
					if ( ! empty( $menu_item_meta ) ) foreach( $menu_item_meta as $key => $value ) {
						update_post_meta( (int) $id, $key, maybe_unserialize( $value ) );
					}
				}
			}
		}

		/**
		 * If fetching attachments is enabled then attempt to create a new attachment
		 *
		 * @param array $post Attachment post details from WXR
		 * @param string $url URL to fetch attachment from
		 * @return int|WP_Error Post ID on success, WP_Error otherwise
		 */
		function process_attachment( $post, $url, $base_url ) {
			//if ( ! $this->fetch_attachments )
			//	return new WP_Error( 'attachment_processing_error',
			//		__( 'Fetching attachments is not enabled', 'wolf' ) );

			// if the URL is absolute, but does not contain address, then upload it assuming base_site_url
			if ( preg_match( '|^/[\w\W]+$|', $url ) )
				$url = rtrim( $base_url, '/' ) . $url;

			$upload = $this->fetch_remote_file( $url, $post );
			if ( is_wp_error( $upload ) )
				return $upload;

			if ( $info = wp_check_filetype( $upload['file'] ) )
				$post['post_mime_type'] = $info['type'];
			else
				return new WP_Error( 'attachment_processing_error', __('Invalid file type', 'wolf') );

			$post['guid'] = $upload['url'];

			// as per wp-admin/includes/upload.php
			$post_id = wp_insert_attachment( $post, $upload['file'] );
			wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );

			// remap resized image URLs, works by stripping the extension and remapping the URL stub.
			if ( preg_match( '!^image/!', $info['type'] ) ) {
				$parts = pathinfo( $url );
				$name = basename( $parts['basename'], ".{$parts['extension']}" ); // PATHINFO_FILENAME in PHP 5.2

				$parts_new = pathinfo( $upload['url'] );
				$name_new = basename( $parts_new['basename'], ".{$parts_new['extension']}" );

				//$this->url_remap[$parts['dirname'] . '/' . $name] = $parts_new['dirname'] . '/' . $name_new;
				$this->set_temp_data( 'url_remap', $parts['dirname'] . '/' . $name, $parts_new['dirname'] . '/' . $name_new );
			}

			return $post_id;
		}

		/**
		 * Attempt to download a remote file attachment
		 *
		 * @param string $url URL of item to fetch
		 * @param array $post Attachment details
		 * @return array|WP_Error Local file location details on success, WP_Error otherwise
		 */
		function fetch_remote_file( $url, $post ) {
			// extract the file name and extension from the url
			$file_name = basename( $url );

			// get placeholder file in the upload dir with a unique, sanitized filename
			$upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
			if ( $upload['error'] )
				return new WP_Error( 'upload_dir_error', $upload['error'] );

			// fetch the remote url and write it to the placeholder file
			$headers = wp_get_http( $url, $upload['file'] );

			// request failed
			if ( ! $headers ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', __('Remote server did not respond', 'wolf') );
			}

			// make sure the fetch was successful
			if ( $headers['response'] != '200' ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', 'wolf'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
			}

			$filesize = filesize( $upload['file'] );

			//if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
			//	@unlink( $upload['file'] );
			//	return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'wolf') );
			//}

			if ( 0 == $filesize ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'wolf') );
			}

			$max_size = (int) $this->max_attachment_size();
			if ( ! empty( $max_size ) && $filesize > $max_size ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', sprintf(__('Remote file is too large, limit is %s', 'wolf'), size_format($max_size) ) );
			}

			// keep track of the old and new urls so we can substitute them later
			$this->set_temp_data( 'url_remap', $url, $upload['url'] );
			$this->set_temp_data( 'url_remap', $post['guid'], $upload['url'] ); // r13735, really needed?
			// keep track of the destination if the remote url is redirected somewhere else
			if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url )
				$this->set_temp_data( 'url_remap', $headers['x-final-location'], $upload['url'] );

			return $upload;
		}

		/**
		 * Attempt to associate posts and menu items with previously missing parents
		 *
		 * An imported post's parent may not have been imported when it was first created
		 * so try again. Similarly for child menu items and menu items which were missing
		 * the object (e.g. post) they represent in the menu
		 */
		function backfill_parents() {
			global $wpdb;

			// find parents for post orphans
			$post_orphans = $this->get_temp_data( 'post_orphans' );
			foreach ( $post_orphans as $child_id => $parent_id ) {

				$local_child_id = $local_parent_id = false;

				if ( $this->get_temp_data( 'processed_posts', $child_id ) )
					$local_child_id = $this->get_temp_data( 'processed_posts', $child_id );

				if ( $this->get_temp_data( 'processed_posts', $parent_id ) )
					$local_parent_id = $this->get_temp_data( 'processed_posts', $parent_id );

				if ( $local_child_id && $local_parent_id )
					$wpdb->update( $wpdb->posts, array( 'post_parent' => $local_parent_id ), array( 'ID' => $local_child_id ), '%d', '%d' );
			}

			// all other posts/terms are imported, retry menu items with missing associated object
			//$missing_menu_items = $this->missing_menu_items;
			$missing_menu_items = $this->get_temp_data( 'missing_menu_items' );

			foreach ( $missing_menu_items as $item ) {
				//echo 'retry missing<br>';
				$this->process_menu_item( $item );
			}

			// find parents for menu item orphans
			$menu_item_orphans = $this->get_temp_data( 'menu_item_orphans' );
			foreach ( $menu_item_orphans as $child_id => $parent_id ) {
				//echo 'retry missing menu_item_orphans';
				$local_child_id = $local_parent_id = 0;

				if ( $this->get_temp_data( 'processed_menu_items', $child_id ) )
					$local_child_id = $this->get_temp_data( 'processed_menu_items', $child_id );

				if ( $this->get_temp_data( 'processed_menu_items', $parent ) )
					$local_parent_id = $this->get_temp_data( 'processed_menu_items', $parent_id );

				if ( $local_child_id && $local_parent_id )
					update_post_meta( $local_child_id, '_menu_item_menu_item_parent', (int) $local_parent_id );
			}
		}

		/**
		 * Use stored mapping information to update old attachment URLs
		 */
		function backfill_attachment_urls() {
			global $wpdb;
			// make sure we do the longest urls first, in case one is a substring of another
			$url_remap = $this->get_temp_data( 'url_remap' );

			uksort( $url_remap, array(&$this, 'cmpr_strlen') );

			foreach ( $url_remap as $from_url => $to_url ) {
				// remap urls in post_content
				$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s)", $from_url, $to_url ) );
				// remap enclosure urls
				$result = $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key='enclosure'", $from_url, $to_url ) );
			}
		}

		/**
		 * Update _thumbnail_id meta to new, imported attachment IDs
		 */
		function remap_featured_images() {
			// cycle through posts that have a featured image

			$featured_images = $this->get_temp_data( 'featured_images' );

			foreach ( $featured_images as $post_id => $value ) {
				//if ( isset( $this->processed_posts[$value] ) ) {
				if ( $this->get_temp_data( 'processed_posts', $value ) ) {
					$new_id = $this->get_temp_data( 'processed_posts', $value );
					// only update if there's a difference
					if ( $new_id != $value )
						update_post_meta( $post_id, '_thumbnail_id', $new_id );
				}
			}
		}

		/**
		 * Parse a WXR file
		 *
		 * @param string $file Path to WXR file for parsing
		 * @return array Information gathered from the WXR file
		 */
		function parse( $file ) {
			$parser = new WXR_Parser();
			return $parser->parse( $file );
		}

		/**
		 * Set a custom permalink structure
		 */
		public function set_permalink_structure() {
			global $wp_rewrite;
			$wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%day%/%postname%/' );
			$wp_rewrite->flush_rules();
		}

		/**
		 * Enqueue progress bar script
		 */
		public function admin_enqueue_scripts() {
			if ( isset( $_GET['page'] ) && 'wolf-theme-import' ) {
				wp_enqueue_script( 'ajaxq', WOLF_THEME_URI . '/includes/admin/importer/js/ajaxq.js', 'jquery', '1.0.0', true );
				wp_enqueue_style( 'jquery-ui-progressbar-custom', WOLF_THEME_URI . '/includes/admin/importer/jquery-ui/redmond/jquery-ui-1.7.2.custom.css', array(), '1.7.2');
				wp_enqueue_script( 'jquery-ui-progressbar' );
			}
		}

		/**
		 * Remove temp files after importation
		 */
		public function remove_tmp_files() {
			wolf_clean_folder( WOLF_THEME_DIR . '/tmp' );
		}

		/**
		 * Error message
		 */
		public function fallback_error_message() {
			return sprintf( '<br>' . __( 'Please <a href="%s" target="_blank">check the documentation</a> to import the files using Wordpress importer plugin.', 'wolf' ), 'http://docs.wolfthemes.com/documentation/themes/' . wolf_get_theme_slug() );
		}

		/**
		 * Display error message if ZipArchive not available
		 *
		 * Check if the server allow unzipping archives
		 *
		 * @param bool $echo
		 * @return bool|string
		 */
		public function can_use_zip( $echo = false ) {

			if ( class_exists( 'ZipArchive' ) ) {

				$this->theme_dir = WOLF_THEME_DIR;
				$this->tmp_dir   = WOLF_THEME_DIR . '/tmp';

				if ( wolf_check_folder( $this->tmp_dir ) ) {
					return true;
				}
			} else {
				if ( $echo ) {
					echo '<br>';
					printf(
						__( '<em>You server configuration does not allow you to import content by uploading a zip. You need <strong>%s</strong> installed on your server.</em>', 'wolf' ),
						'ZipArchive'
					);
					echo $this->fallback_error_message();
				}
				return false;
			}
		}

		/**
		 * Decide if the given meta key maps to information we will want to import
		 *
		 * @param string $key The meta key to check
		 * @return string|bool The key if we do want to import, false if not
		 */
		function is_valid_meta_key( $key ) {
			// skip attachment metadata since we'll regenerate it from scratch
			// skip _edit_lock as not relevant for import
			if ( in_array( $key, array( '_wp_attached_file', '_wp_attachment_metadata', '_edit_lock' ) ) )
				return false;
			return $key;
		}

		/**
		 * Decide what the maximum file size for downloaded attachments is.
		 * Default is 0 (unlimited), can be filtered via import_attachment_size_limit
		 *
		 * @return int Maximum attachment file size to import
		 */
		function max_attachment_size() {
			return apply_filters( 'import_attachment_size_limit', 0 );
		}

		/**
		 * Added to http_request_timeout filter to force timeout at 2400 seconds during import
		 * @return int 2400
		 */
		function bump_request_timeout( $val ) {
			return 2400;
		}

		// return the difference in length between two strings
		function cmpr_strlen( $a, $b ) {
			return strlen( $b ) - strlen( $a );
		}

	} // end class
	$wolf_do_import_data = new Wolf_Demo_Data_Importer;
	$wolf_do_import_data->import();
} // end class check
