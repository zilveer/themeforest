<?php
/**
 * Wordpress Azelab Importer class
 *
 * @author: Vedmant <vedmant@gmail.com>
 * @version: 1.0.0
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

if ( class_exists( 'WP_Import' ) ) {
	/**
	 * Class Azl_Importer
	 */
	class Azl_Importer extends WP_Import {

		/*
		 * $required_plugin - required plugin , for correct import functionality
		 */
		public $required_plugin = array(
			'LayerSlider/layerslider.php',
			'contact-form-7/wp-contact-form-7.php',
			'revslider/revslider.php'
		);

		var $posts_per_step = 50;

		/* ========================================================================= *\
			Initialization
		\* ========================================================================= */

		/**
		 * Hook into the appropriate actions when the class is constructed.
		 */
		function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
			add_action( 'admin_menu', array( $this, 'register_menu_page' ) );

			add_action( 'wp_ajax_azl_import_init', array( $this, 'ajax_init') );
			add_action( 'wp_ajax_azl_import_import_posts', array( $this, 'ajax_import_posts') );
			add_action( 'wp_ajax_azl_import_import_settings', array( $this, 'ajax_import_settings') );
			add_action( 'wp_ajax_azl_import_finish', array( $this, 'ajax_finish') );
		}

		/* ========================================================================= *\
			Plugin callbacks
		\* ========================================================================= */


		function scripts($hook) {
			if ( 'tools_page_azl_import' != $hook ) {
				return;
			}
			wp_enqueue_script( 'azl_importer', get_template_directory_uri() . '/includes/importer/assets/azl_importer.js', array('jquery'), '1.0', true );
		}

		/**
		 * Add menu item
		 */
		function register_menu_page() {
			add_submenu_page( 'tools.php', 'Import demo data', 'Import demo data', 'manage_options', 'azl_import', array( $this, 'show_import_page' ) );
		}

		/**
		 * Render page
		 */
		function show_import_page() {
			$files = $this->scan_dir_demo_content_zip_folder( true );
			?>
			<div class="wrap">
				<h2><?php _e( 'Azelab demo data Import', 'mental' ); ?></h2>

					<div class="updated fade error notice is-dismissible">
						<p>
							<?php _e( 'WARNING: Importing demo content will fill your site with sliders, pages, posts, theme options, widgets, sidebars and other settings. This will copy the live demo site. Please make sure you have the Layer Slider, Contact Form plugins installed and activated. Clicking "Start Import" button will replace your current theme options, sliders and widgets. It can also take a minute to complete.', 'mental' ); ?>
						</p>
					</div>

					<h3 class="title"><?php _e( 'Settings', 'mental' ); ?></h3>
					<table class="form-table">
						<tbody>
						<tr>
							<th scope="row"><?php _e( 'Demo data:', 'mental' ); ?></th>
							<td>
								<select name="import_file" id="azl_importer_import_file">
									<?php foreach( $files as $name => $file ): ?>
										<option value="<?php echo esc_attr( $file ); ?>"><?php echo esc_html( $name ); ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						</tbody>
					</table>

					<a href="#" class="button button-primary" id="azl_import_start"><?php _e( 'Start import', 'mental' ); ?></a>

					<pre id="azl_importer_log"></pre>

			</div>
		<?php
		}

		/* ========================================================================= *\
			Ajax queries
		\* ========================================================================= */

		function ajax_init()
		{
			ob_start();

			$import_file = sanitize_file_name( $_POST['import_file'] );

			// Unpack zip archive
			$zip_path = $this->unzip_demo_content( $import_file );
			if ( ! $zip_path ) wp_die( json_encode( array(
				'result' => 'error', 'mgs' => __( 'Can\'t extract import archive', 'azl' )
			) ) );

			$this->remove_menus();

			// Get posts count and steps count
			$wp_xml_file = $this->get_import_wp_file( $zip_path );
			$import_data = $this->parse( $wp_xml_file );
			$steps_count = ceil( count( $import_data['posts'] ) / $this->posts_per_step );

			// Fill steps
			$steps = array();
			for($i = 1; $i <= $steps_count; $i++) {
				$steps[] = array(
					'action'    => 'azl_import_import_posts',
					'message'   => sprintf( __( 'Importing posts, step %d of %d ... ', 'azl' ), $i, $steps_count),
					'post_data' => array( 'step' => $i, 'steps' => $steps_count ),
				);
			}

			$steps[] = array(
				'action'    => 'azl_import_import_settings',
				'message'   => __( 'Importing Wordpress and Theme settings ... ', 'azl' ),
			);

			$steps[] = array(
				'action'    => 'azl_import_finish',
				'message'   => __( 'Finishing importing ... ', 'azl' ),
			);

			ob_end_clean();

			wp_die( json_encode( array(
				'result' => 'ok',
				'msg' => __( 'Done', 'azl' ),
				'steps' => $steps
			) ) );
		}


		function ajax_import_posts()
		{
			ob_start();

			$import_file = sanitize_file_name( $_POST['import_file'] );
			$zip_path = $this->get_content_dir( $import_file );

			$step = (int) $_POST['step'];
			$steps = (int) $_POST['steps'];

			$wp_xml_file = $this->get_import_wp_file( $zip_path );

			$this->fetch_attachments = true;
			$this->import( $wp_xml_file, $step, $steps );
			$import_msgs = ob_get_clean();

			wp_die( json_encode( array(
				'result' => 'ok',
				'msg' => __( 'Done', 'azl' ),
				'import_msgs' => $import_msgs,
			) ) );
		}

		function ajax_import_settings()
		{
			ob_start();

			$import_file = sanitize_file_name( $_POST['import_file'] );
			$zip_path = $this->get_content_dir( $import_file );

			// Import Themes Settings
			$this->import_theme_settings( $zip_path );

			// Import Widgets Data
			$this->import_widgets( $zip_path );

			// Import Layerslider Data
			$this->import_layerslider( $zip_path );

			// Import rev slider
			$this->import_rev_slider();

			// Import Menu locations
			$this->import_menu_locations( $zip_path );

			// Import WP Options
			$this->import_wp_options( $zip_path );

			// Setup Woocommerce pages
			$this->setup_woocommerce_pages();

			ob_get_clean();

			wp_die( json_encode( array(
				'result' => 'ok',
				'msg' => __( 'Done', 'azl' ),
			) ) );
		}



		function ajax_finish()
		{
			ob_start();

			$import_file = sanitize_file_name( $_POST['import_file'] );
			$zip_path = $this->get_content_dir( $import_file );

			// Delete extracted arcive folder and files
			$scanned_directory = array_diff( scandir( $zip_path ), array( '..', '.' ) );
			foreach ( $scanned_directory as $file ) {
				unlink($zip_path.$file);
			}
			rmdir($zip_path);

			ob_end_clean();

			wp_die( json_encode( array(
				'result' => 'ok',
				'msg' =>  __( 'All done.', 'azl' ) . ' <a href="' . site_url() . '">' . __( 'Have fun!', 'azl' ) . '</a>',
			) ) );

		}


		/* ========================================================================= *\
			Checks before import
		\* ========================================================================= */


		/**
		 * checking activated plugin, before start import
		 *
		 * @param array $plugins
		 *
		 * @return bool
		 */
		function check_activated_plugins( $plugins = array() ) {
			if ( ! $plugins ) {
				$plugins = $this->required_plugin;
			}
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			foreach ( $plugins as $plugin ) {
				if ( ! is_plugin_active( $plugin ) ) {
					return false;
				}
			}

			return true;
		}


		/* ========================================================================= *\
			Overriding WP_Import class functions
		\* ========================================================================= */

		/**
		 * The main controller for the actual import stage for pages, posts, etc
		 *
		 * @param string $file Path to the WXR file for importing
		 */
		function import( $file, $stepNumber = 1, $numberOfSteps = 1 ) {
			add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
			add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );

			$this->import_start( $file );

			$this->get_author_mapping();

			wp_suspend_cache_invalidation( true );

			$this->process_categories();
			$this->process_tags();
			$this->process_terms();

			//the processing of posts is stepped
			$this->process_posts( $stepNumber, $numberOfSteps );
			wp_suspend_cache_invalidation( false );

			// we do this only on the last step
			if ( $stepNumber == $numberOfSteps ) {
			//	// we process the menus because there are problems when the pages, posts, etc that don't first exist
				$this->process_menus();
			}

			// update incorrect/missing information in the DB
			$this->backfill_parents();
			$this->backfill_attachment_urls();
			$this->remap_featured_images();

			$this->import_end();
		}

		/**
		 * Create new posts based on import information
		 * Posts marked as having a parent which doesn't exist will become top level items.
		 * Doesn't create a new post if: the post type doesn't exist, the given post ID
		 * is already noted as imported or a post with the same title and date already exists.
		 * Note that new/updated terms, comments and meta are imported for the last of the above.
		 */
		function process_posts( $stepNumber = 1, $numberOfSteps = 1 ) {
			$this->posts = apply_filters( 'wp_import_posts', $this->posts );

			//get the total number of posts (actual posts, pages, custom posts, menus, etc)
			$numberOfPosts = count( $this->posts );

			//calculate the offset and the length for the current step
			$stepLength = (int) ( $numberOfPosts / $numberOfSteps );
			$length     = ( $stepNumber - 1 ) * $stepLength + $stepLength;

			//for the last step we take all that remained
			if ( $stepNumber == $numberOfSteps ) {
				$length = 99999;
			}

			//get only the posts for the current step
			$currentPosts = array_slice( $this->posts, 0, $length );

			foreach ( $currentPosts as $post ) {
				$post = apply_filters( 'wp_import_post_data_raw', $post );

				if ( ! post_type_exists( $post['post_type'] ) ) {
					printf( __( 'Failed to import "%s": Invalid post type %s', 'rosa_txtd' ), esc_html( $post['post_title'] ), esc_html( $post['post_type'] ) );
					echo '<br />';
					do_action( 'wp_import_post_exists', $post );
					continue;
				}

				if ( isset( $this->processed_posts[ $post['post_id'] ] ) && ! empty( $post['post_id'] ) ) {
					continue;
				}

				if ( $post['status'] == 'auto-draft' ) {
					continue;
				}

				if ( 'nav_menu_item' == $post['post_type'] ) {
					//we will add the menus at the end of the last step
					//$this->process_menu_item( $post );
					continue;
				}

				$post_type_object = get_post_type_object( $post['post_type'] );

				$post_exists = post_exists( $post['post_title'], '', $post['post_date'] );
				if ( $post_exists && get_post_type( $post_exists ) == $post['post_type'] ) {
					//printf( __('%s &#8220;%s&#8221; already exists.', 'rosa_txtd'), $post_type_object->labels->singular_name, esc_html($post['post_title']) );
					//echo '<br />';

					//save it for later check if it exists - it may be unattached to it's parent
					$post_parent = (int) $post['post_parent'];
					if ( $post_parent ) {
						// if we already know the parent, map it to the new local ID
						if ( isset( $this->processed_posts[ $post_parent ] ) ) {
							$post_parent = $this->processed_posts[ $post_parent ];
							// otherwise record the parent for later
						} else {
							$this->post_orphans[ intval( $post['post_id'] ) ] = $post_parent;
							$post_parent                                      = 0;
						}
					}

					$comment_post_ID = $post_id = $post_exists;
				} else {
					$post_parent = (int) $post['post_parent'];
					if ( $post_parent ) {
						// if we already know the parent, map it to the new local ID
						if ( isset( $this->processed_posts[ $post_parent ] ) ) {
							$post_parent = $this->processed_posts[ $post_parent ];
							// otherwise record the parent for later
						} else {
							$this->post_orphans[ intval( $post['post_id'] ) ] = $post_parent;
							$post_parent                                      = 0;
						}
					}

					// map the post author
					$author = sanitize_user( $post['post_author'], true );
					if ( isset( $this->author_mapping[ $author ] ) ) {
						$author = $this->author_mapping[ $author ];
					} else {
						$author = (int) get_current_user_id();
					}

					$postdata = array(
						'import_id'      => $post['post_id'],
						'post_author'    => $author,
						'post_date'      => $post['post_date'],
						'post_date_gmt'  => $post['post_date_gmt'],
						'post_content'   => $post['post_content'],
						'post_excerpt'   => $post['post_excerpt'],
						'post_title'     => $post['post_title'],
						'post_status'    => $post['status'],
						'post_name'      => $post['post_name'],
						'comment_status' => $post['comment_status'],
						'ping_status'    => $post['ping_status'],
						'guid'           => $post['guid'],
						'post_parent'    => $post_parent,
						'menu_order'     => $post['menu_order'],
						'post_type'      => $post['post_type'],
						'post_password'  => $post['post_password']
					);

					$original_post_ID = $post['post_id'];
					$postdata         = apply_filters( 'wp_import_post_data_processed', $postdata, $post );

					if ( 'attachment' == $postdata['post_type'] ) {
						$remote_url = ! empty( $post['attachment_url'] ) ? $post['attachment_url'] : $post['guid'];

						// try to use _wp_attached file for upload folder placement to ensure the same location as the export site
						// e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
						$postdata['upload_date'] = $post['post_date'];
						if ( isset( $post['postmeta'] ) ) {
							foreach ( $post['postmeta'] as $meta ) {
								if ( $meta['key'] == '_wp_attached_file' ) {
									if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) ) {
										$postdata['upload_date'] = $matches[0];
									}
									break;
								}
							}
						}

						$comment_post_ID = $post_id = $this->process_attachment( $postdata, $remote_url );
					} else {
						$comment_post_ID = $post_id = wp_insert_post( $postdata, true );
						do_action( 'wp_import_insert_post', $post_id, $original_post_ID, $postdata, $post );
					}

					if ( is_wp_error( $post_id ) ) {
						printf( __( 'Failed to import %s "%s"', 'rosa_txtd' ), $post_type_object->labels->singular_name, esc_html( $post['post_title'] ) );
						if ( defined( 'IMPORT_DEBUG' ) && IMPORT_DEBUG ) {
							echo ': ' . $post_id->get_error_message();
						}
						echo '<br />';
						continue;
					}

					if ( $post['is_sticky'] == 1 ) {
						stick_post( $post_id );
					}
				}

				// map pre-import ID to local ID
				$this->processed_posts[ intval( $post['post_id'] ) ] = (int) $post_id;

				if ( ! isset( $post['terms'] ) ) {
					$post['terms'] = array();
				}

				$post['terms'] = apply_filters( 'wp_import_post_terms', $post['terms'], $post_id, $post );

				// add categories, tags and other terms
				if ( ! empty( $post['terms'] ) ) {
					$terms_to_set = array();
					foreach ( $post['terms'] as $term ) {
						// back compat with WXR 1.0 map 'tag' to 'post_tag'
						$taxonomy    = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
						$term_exists = term_exists( $term['slug'], $taxonomy );
						$term_id     = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
						if ( ! $term_id ) {
							$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );
							if ( ! is_wp_error( $t ) ) {
								$term_id = $t['term_id'];
								do_action( 'wp_import_insert_term', $t, $term, $post_id, $post );
							} else {
								printf( __( 'Failed to import %s %s', 'rosa_txtd' ), esc_html( $taxonomy ), esc_html( $term['name'] ) );
								if ( defined( 'IMPORT_DEBUG' ) && IMPORT_DEBUG ) {
									echo ': ' . $t->get_error_message();
								}
								echo '<br />';
								do_action( 'wp_import_insert_term_failed', $t, $term, $post_id, $post );
								continue;
							}
						}
						$terms_to_set[ $taxonomy ][] = intval( $term_id );
					}

					foreach ( $terms_to_set as $tax => $ids ) {
						$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
						do_action( 'wp_import_set_post_terms', $tt_ids, $ids, $tax, $post_id, $post );
					}
					unset( $post['terms'], $terms_to_set );
				}

				if ( ! isset( $post['comments'] ) ) {
					$post['comments'] = array();
				}

				$post['comments'] = apply_filters( 'wp_import_post_comments', $post['comments'], $post_id, $post );

				// add/update comments
				if ( ! empty( $post['comments'] ) ) {
					$num_comments      = 0;
					$inserted_comments = array();
					foreach ( $post['comments'] as $comment ) {
						$comment_id                                         = $comment['comment_id'];
						$newcomments[ $comment_id ]['comment_post_ID']      = $comment_post_ID;
						$newcomments[ $comment_id ]['comment_author']       = $comment['comment_author'];
						$newcomments[ $comment_id ]['comment_author_email'] = $comment['comment_author_email'];
						$newcomments[ $comment_id ]['comment_author_IP']    = $comment['comment_author_IP'];
						$newcomments[ $comment_id ]['comment_author_url']   = $comment['comment_author_url'];
						$newcomments[ $comment_id ]['comment_date']         = $comment['comment_date'];
						$newcomments[ $comment_id ]['comment_date_gmt']     = $comment['comment_date_gmt'];
						$newcomments[ $comment_id ]['comment_content']      = $comment['comment_content'];
						$newcomments[ $comment_id ]['comment_approved']     = $comment['comment_approved'];
						$newcomments[ $comment_id ]['comment_type']         = $comment['comment_type'];
						$newcomments[ $comment_id ]['comment_parent']       = $comment['comment_parent'];
						$newcomments[ $comment_id ]['commentmeta']          = isset( $comment['commentmeta'] ) ? $comment['commentmeta'] : array();
						if ( isset( $this->processed_authors[ $comment['comment_user_id'] ] ) ) {
							$newcomments[ $comment_id ]['user_id'] = $this->processed_authors[ $comment['comment_user_id'] ];
						}
					}
					ksort( $newcomments );

					foreach ( $newcomments as $key => $comment ) {
						// if this is a new post we can skip the comment_exists() check
						if ( ! $post_exists || ! comment_exists( $comment['comment_author'], $comment['comment_date'] ) ) {
							if ( isset( $inserted_comments[ $comment['comment_parent'] ] ) ) {
								$comment['comment_parent'] = $inserted_comments[ $comment['comment_parent'] ];
							}
							$comment                   = wp_filter_comment( $comment );
							$inserted_comments[ $key ] = wp_insert_comment( $comment );
							do_action( 'wp_import_insert_comment', $inserted_comments[ $key ], $comment, $comment_post_ID, $post );

							foreach ( $comment['commentmeta'] as $meta ) {
								$value = maybe_unserialize( $meta['value'] );
								add_comment_meta( $inserted_comments[ $key ], $meta['key'], $value );
							}

							$num_comments ++;
						}
					}
					unset( $newcomments, $inserted_comments, $post['comments'] );
				}

				if ( ! isset( $post['postmeta'] ) ) {
					$post['postmeta'] = array();
				}

				$post['postmeta'] = apply_filters( 'wp_import_post_meta', $post['postmeta'], $post_id, $post );

				// add/update post meta
				if ( ! empty( $post['postmeta'] ) ) {
					foreach ( $post['postmeta'] as $meta ) {
						$key   = apply_filters( 'import_post_meta_key', $meta['key'], $post_id, $post );
						$value = false;

						if ( '_edit_last' == $key ) {
							if ( isset( $this->processed_authors[ intval( $meta['value'] ) ] ) ) {
								$value = $this->processed_authors[ intval( $meta['value'] ) ];
							} else {
								$key = false;
							}
						}

						if ( $key ) {
							// export gets meta straight from the DB so could have a serialized string
							if ( ! $value ) {
								$value = maybe_unserialize( preg_replace( '!s:(\d+):"(.*?)";!es', "'s:'.strlen('$2').':\"$2\";'", stripslashes( $meta['value'] ) ) );
							}

							add_post_meta( $post_id, $key, $value );
							do_action( 'import_post_meta', $post_id, $key, $value );

							// if the post has a featured-classic image, take note of this in case of remap
							if ( '_thumbnail_id' == $key ) {
								$this->featured_images[ $post_id ] = (int) $value;
							}
						}
					}
				}
			}
			unset( $currentPosts );
		}

		/**
		 * Create new menu items based on import information
		 * Posts marked as having a parent which doesn't exist will become top level items.
		 * Doesn't create a new post if: the post type doesn't exist, the given post ID
		 * is already noted as imported or a post with the same title and date already exists.
		 * Note that new/updated terms, comments and meta are imported for the last of the above.
		 */
		function process_menus() {
			$this->posts = apply_filters( 'wp_import_posts', $this->posts );
			foreach ( $this->posts as $post ) {
				$post = apply_filters( 'wp_import_post_data_raw', $post );

				if ( isset( $this->processed_posts[ $post['post_id'] ] ) && ! empty( $post['post_id'] ) ) {
					continue;
				}

				if ( $post['status'] == 'auto-draft' ) {
					continue;
				}

				if ( 'nav_menu_item' == $post['post_type'] ) {
					$this->process_menu_item( $post );
				}
			}
		}

		/**
		 * Performs post-import cleanup of files and the cache
		 */
		function import_end() {
			unset( $this->posts );
			wp_import_cleanup( $this->id );

			wp_cache_flush();
			foreach ( get_taxonomies() as $tax ) {
				delete_option( "{$tax}_children" );
				_get_term_hierarchy( $tax );
			}

			wp_defer_term_counting( false );
			wp_defer_comment_counting( false );

			//echo '<p>' . __( 'All done.', 'rosa_txtd' ) . ' <a href="' . admin_url() . '">' . __( 'Have fun!', 'rosa_txtd' ) . '</a>' . '</p>';
			//echo '<p>' . __( 'Remember to update the passwords and roles of imported users.', 'rosa_txtd' ) . '</p>';

			do_action( 'import_end' );
		}


		/* ========================================================================= *\
			Other data import functions
		\* ========================================================================= */

		/**
		 * Import Menu locations
		 *
		 * @param $zip_path
		 *
		 * @return bool
		 */
		public function import_menu_locations( $zip_path ) {

			$locations = json_decode( file_get_contents( $zip_path . 'menu_locations.json' ), true );

			if( ! $locations ) return false;

			$save_locations = array();
			foreach($locations as $location => $menu_slug) {
				$menu_term = get_term_by( 'slug', $menu_slug, 'nav_menu' );
				$save_locations[$location] = $menu_term->term_id;
			}

			set_theme_mod( 'nav_menu_locations', $locations );

			return true;
		}

		/**
		 * Import WP options
		 *
		 * @param $zip_path
		 *
		 * @return bool
		 */
		function import_wp_options( $zip_path ) {
			$options = json_decode( file_get_contents( $zip_path . 'wp_options.json' ), true );

			if( ! $options ) return false;

			foreach($options as $key => $value) {
				update_option($key, $value);
			}

			return true;
		}

		/**
		 * Import Themes Settings
		 *
		 * @param $zip_path
		 */
		function import_theme_settings( $zip_path ) {
			$settings = file_get_contents( $zip_path . 'theme_settings.data' );
			Azl_Settings_Machine::instance()->import_data( $settings );
		}

		function setup_woocommerce_pages()
		{
			if( ! class_exists('Woocommerce') ) return false;
			// Set pages
			$woopages = array(
				'woocommerce_shop_page_id' => 'Shop',
				'woocommerce_cart_page_id' => 'Cart',
				'woocommerce_checkout_page_id' => 'Checkout',
				'woocommerce_pay_page_id' => 'Checkout &#8594; Pay',
				'woocommerce_thanks_page_id' => 'Order Received',
				'woocommerce_myaccount_page_id' => 'My Account',
				'woocommerce_edit_address_page_id' => 'Edit My Address',
				'woocommerce_view_order_page_id' => 'View Order',
				'woocommerce_change_password_page_id' => 'Change Password',
				'woocommerce_logout_page_id' => 'Logout',
				'woocommerce_lost_password_page_id' => 'Lost Password'
			);
			foreach($woopages as $woo_page_name => $woo_page_title) {
				$woopage = get_page_by_title( $woo_page_title );
				if(isset( $woopage ) && $woopage->ID) {
					update_option($woo_page_name, $woopage->ID); // Front Page
				}
			}

			return true;
		}

		/**
		 * Import Widgets Data
		 *
		 * @param $zip_path
		 *
		 * @return bool|WP_Error
		 */
		function import_widgets( $zip_path ) {

			$this->clear_widgets(); // clear all current widgets , before import current widget data

			$widgets_data = json_decode( file_get_contents( $zip_path . 'widgets.json' ), true );

			foreach ( $widgets_data as $k => $v ) {
				foreach ( $v as $key => $val ) {
					if ( is_array( $val ) ) {
						foreach ( $val as $val_key => $val_value ) {
							$arr[ $key ][ $val_key ] = 'on';
						}
					}
				}
			}

			$widgets      = $arr;
			$sidebar_data = $widgets_data[0];
			$widget_data  = $widgets_data[1];

			foreach ( $sidebar_data as $title => $sidebar ) {
				$count = count( $sidebar );
				for ( $i = 0; $i < $count; $i ++ ) {
					$widget               = array();
					$widget['type']       = trim( substr( $sidebar[ $i ], 0, strrpos( $sidebar[ $i ], '-' ) ) );
					$widget['type-index'] = trim( substr( $sidebar[ $i ], strrpos( $sidebar[ $i ], '-' ) + 1 ) );

					if ( ! isset( $widgets[ $widget['type'] ][ $widget['type-index'] ] ) ) {
						unset( $sidebar_data[ $title ][ $i ] );
					}
				}
				$sidebar_data[ $title ] = array_values( $sidebar_data[ $title ] );
			}
			foreach ( $widgets as $widget_title => $widget_value ) {
				foreach ( $widget_value as $widget_key => $widget_value ) {
					if( isset( $widget_data[ $widget_title ][ $widget_key ] ) ) {
						$widgets[ $widget_title ][ $widget_key ] = $widget_data[ $widget_title ][ $widget_key ];
					}
				}
			}
			$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

			return ( $this->import_widget_data( $sidebar_data ) ) ? true : new WP_Error( 'widget_import_submit', 'Unknown Error' );
		}

		/**
		 * Performs widgets importing
		 *
		 * @param $import_array
		 *
		 * @return bool
		 */
		function import_widget_data( $import_array ) {
			global $wp_registered_sidebars;

			$sidebars_data    = $import_array[0];
			$widget_data      = $import_array[1];
			$current_sidebars = get_option( 'sidebars_widgets' );
			$new_widgets      = array();

			// Add all registered sidebars
			foreach ( $wp_registered_sidebars as $sidebar => $params ) {
				if( ! isset( $current_sidebars[ $sidebar ] ) ) {
					$current_sidebars[ $sidebar ] = array();
				}
			}

			foreach ( $sidebars_data as $import_sidebar => $import_widgets ) {
				foreach ( $import_widgets as $import_widget ) {
					//if the sidebar exists
					if ( isset( $current_sidebars[ $import_sidebar ] ) ) {
						$title               = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
						$index               = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
						$current_widget_data = get_option( 'widget_' . $title );
						$new_widget_name     = $this->get_new_widget_name( $title, $index );
						$new_index           = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

						if ( ! empty( $new_widgets[ $title ] ) && is_array( $new_widgets[ $title ] ) ) {
							while ( array_key_exists( $new_index, $new_widgets[ $title ] ) ) {
								$new_index ++;
							}
						}
						$current_sidebars[ $import_sidebar ][] = $title . '-' . $new_index;
						if ( array_key_exists( $title, $new_widgets ) ) {
							$new_widgets[ $title ][ $new_index ] = $widget_data[ $title ][ $index ];
							$multiwidget                         = $new_widgets[ $title ]['_multiwidget'];

							unset( $new_widgets[ $title ]['_multiwidget'] );

							$new_widgets[ $title ]['_multiwidget'] = $multiwidget;

						} else {

							$current_widget_data[ $new_index ] = $widget_data[ $title ][ $index ];
							$current_multiwidget               = isset( $current_widget_data['_multiwidget'] ) ? $current_widget_data['_multiwidget'] : false;
							$new_multiwidget                   = isset( $widget_data[ $title ]['_multiwidget'] ) ? $widget_data[ $title ]['_multiwidget'] : false;
							$multiwidget                       = ( $current_multiwidget != $new_multiwidget ) ? $current_multiwidget : 1;

							unset( $current_widget_data['_multiwidget'] );

							$current_widget_data['_multiwidget'] = $multiwidget;
							$new_widgets[ $title ]               = $current_widget_data;
						}
					}
				}
			}

			if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
				update_option( 'sidebars_widgets', $current_sidebars );

				foreach ( $new_widgets as $title => $content ) {
					$content = apply_filters( 'widget_data_import', $content, $title );
					update_option( 'widget_' . $title, $content );
				}

				return true;
			}

			return false;
		}

		/**
		 * Get new widget name
		 *
		 * $widget_name - widget name
		 * $widget_index - widget index
		 */
		function get_new_widget_name( $widget_name, $widget_index ) {
			$current_sidebars = get_option( 'sidebars_widgets' );
			$all_widget_array = array();
			foreach ( $current_sidebars as $sidebar => $widgets ) {
				if ( ! empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
					foreach ( $widgets as $widget ) {
						$all_widget_array[] = $widget;
					}
				}
			}

			while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
				$widget_index ++;
			}

			$new_widget_name = $widget_name . '-' . $widget_index;

			return $new_widget_name;
		}

		/**
		 * Import Layerslider Data
		 *
		 * @param $zip_path - path to import unzip archive folder
		 *
		 * @return bool
		 */
		public function import_layerslider( $zip_path ) {

			if ( ! class_exists( 'LS_ImportUtil' ) ) { // if LayerSlider doesn't exist
				$wp_layerslider = ABSPATH . '/wp-content/plugins/LayerSlider/classes/class.ls.importutil.php';
				if ( ! file_exists( $wp_layerslider ) ) return false;
				require_once $wp_layerslider;
			}

			ob_start();
			new LS_ImportUtil( $zip_path . 'layerslider.json' );
			ob_end_clean();

			return true;
		}

		public function import_rev_slider(){

			if ( class_exists( 'RevSlider' ) ) {
				$wpc_slider_array = array( get_template_directory()."/includes/importer/revslider/slider-1.zip", get_template_directory()."/includes/importer/revslider/slider-2.zip", get_template_directory()."/includes/importer/revslider/slider-3.zip", get_template_directory()."/includes/importer/revslider/slider-4.zip");
				$slider = new RevSlider();
				foreach($wpc_slider_array as $wpc_slider){
					$slider->importSliderFromPost(true,true,$wpc_slider);  
				}
			}

		}


		/* ========================================================================= *\
			Remove data functions
		\* ========================================================================= */

		/**
		 * Remove all current menus
		 */
		function remove_menus() {
			$menu_list = get_terms('nav_menu');

			foreach($menu_list as $menu) {
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				foreach($menu_items as $menu_item) {
					wp_delete_post($menu_item->ID);
				}
				wp_delete_term( $menu->term_id, 'nav_menu' );
			}
		}

		/**
		 * Clear all current widgets
		 */
		function clear_widgets() {
			$sidebars = wp_get_sidebars_widgets();
			//$inactive = isset( $sidebars['wp_inactive_widgets'] ) ? $sidebars['wp_inactive_widgets'] : array();

			//unset( $sidebars['wp_inactive_widgets'] );

			foreach ( $sidebars as $sidebar => $widgets ) {
				//if( is_array($inactive) && is_array($widgets) ) {
				//	$inactive = array_merge( $inactive, $widgets );
				//}
				$sidebars[ $sidebar ] = array();
			}

			//$sidebars['wp_inactive_widgets'] = $inactive;
			$sidebars['wp_inactive_widgets'] = array();
			wp_set_sidebars_widgets( $sidebars );
		}


		/* ========================================================================= *\
			Helping funcitons
		\* ========================================================================= */

		/**
		 * Get WP import XML file based on some conditions
		 *
		 * @param $zip_path  path to import unzip archive folder
		 *
		 * @return string
		 */
		function get_import_wp_file( $zip_path ) {
			if ( $this->check_activated_plugins( array( 'woocommerce/woocommerce.php' ) )
			     && file_exists( $zip_path . 'wp_with_woo.xml' ) ) {
				$file_name = 'wp_with_woo.xml';
			} else {
				$file_name = 'wp_without_woo.xml';
			}

			return $zip_path.$file_name;
		}

		/**
		 * Get all import arcives
		 *
		 * @param bool $admin_select if = true , return array to admin import page
		 *
		 * @return array
		 */
		public function scan_dir_demo_content_zip_folder( $admin_select = false ) {
			$files             = array();
			$directory         = get_template_directory() . '/includes/importer/demo_content_zip';
			$scanned_directory = array_diff( scandir( $directory ), array( '..', '.' ) );

			if ( $scanned_directory ) {
				if ( ! $admin_select ) {
					foreach ( $scanned_directory as $zip_file ) {
						if ( strpos( $zip_file, '.zip' ) !== false ) {
							$files[ substr( $zip_file, 0, - 4 ) ] = $zip_file;
						}
					}
				} else {
					foreach ( $scanned_directory as $zip_file ) {
						if ( strpos( $zip_file, '.zip' ) !== false ) {
							$zip_file           = substr( $zip_file, 0, - 4 );
							$files[ $zip_file ] = $zip_file;
						}
					}
				}
			}

			return $files;
		}


		/**
		 * Get extract content dir
		 *
		 * @param $import_file
		 *
		 * @return string
		 */
		function get_content_dir( $import_file )
		{
			$base_extract_folder = get_template_directory() . '/includes/importer/demo_content/';
			$this->make_dir( $base_extract_folder );

			$content_dir = $base_extract_folder.$import_file;

			return $content_dir . '/';
		}

		/**
		 * Get content zip file path
		 *
		 * @param $import_file
		 *
		 * @return string
		 */
		function get_zip_path( $import_file )
		{
			$zip_path = get_template_directory() . '/includes/importer/demo_content_zip/' . $import_file . '.zip';

			return $zip_path;
		}

		/**
		 * Unzip demo content archive
		 *
		 * @param $import_file
		 *
		 * @return bool|string
		 */
		function unzip_demo_content( $import_file ) {

			$extract_to = $this->get_content_dir( $import_file );
			$this->make_dir( $extract_to );

			$zip_path = $this->get_zip_path( $import_file );

			$zip = new ZipArchive;

			if ( $zip->open( $zip_path ) === true ) {
				for ( $i = 0; $i < $zip->numFiles; $i ++ ) {
					$file_name = $zip->getNameIndex( $i );
					$zip->extractTo( $extract_to, array( $file_name ) );
					chmod( $extract_to . $file_name, 0777 );
				}
				$zip->close();

				return $extract_to;
			}

			return false;
		}

		/**
		 * Create folder
		 *
		 * @param $path
		 */
		public function make_dir( $path ) {
			if ( ! file_exists( $path ) ) {
				mkdir( $path );
			}
		}

		/**
		 * Delete unzip arcive dir and files
		 */
		public function del_dir( $dir ) {
			$files = array_diff( scandir( $dir ), array( '.', '..' ) );
			foreach ( $files as $file ) {
				( is_dir( "$dir/$file" ) ) ? $this->del_dir( "$dir/$file" ) : unlink( "$dir/$file" );
			}

			return rmdir( $dir );
		}


	} // End Class

}
