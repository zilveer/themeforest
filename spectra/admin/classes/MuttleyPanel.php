<?php
/**
 * Muttley Framework
 * A simple, Wordpress Framework
 *
 * @package         MuttleyPanel
 * @author          Mariusz Rek
 * @copyright       2015 Muttley Framework
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}

if ( ! class_exists( 'MuttleyPanel' ) ) {
	class MuttleyPanel {
		
		protected $args;
		protected $extensions = array();
		protected $options;
		protected $saved_options;
		protected $used_plugins = array( 'panel' );
		protected $textdomain = 'noisa';
		protected $defaults = array(
			'admin_path'  => '',
			'admin_uri'	 => '',
			'panel_logo' => '',
			'menu_name'   => 'Settings', 
			'page_name'   => 'panel-main.php',
			'option_name' => 'panel_main_options',
			'admin_dir'   => '/admin/panel',
			'menu_icon'   => '',
			'dummy_data' => '',
			'admin_bar' => true
		);
		

		/**
         * Panel Constructor.
         *
         * @since       1.1.0
         * @access      public
         * @return      void
        */
		public function __construct( $args, $options ) {

			/* Set options and page variables */
			if ( isset( $args ) && is_array( $args ) ) {
				$this->args = array_merge( $this->defaults, $args );
			} else {
				$this->args = $args;
			}

			// Options
			$this->options = $options;

			/* Check used plugins and generate used plugins array */
			foreach ( $this->options as $plugins ) {
	        	if ( isset( $plugins['plugins'] ) && is_array( $plugins['plugins'] ) ) {
	        		foreach ( $plugins['plugins'] as $plugin )
	        			$this->used_plugins[] = $plugin;
	        	} 
	        }
	        if ( is_array( $this->used_plugins) && ! empty($this->used_plugins) ) {
	    		$this->used_plugins = array_unique( $this->used_plugins );
	    	}
			
			/* Set paths */

			/* Set path */
			if ( $this->args['admin_path'] == '' ) {
				$_path = get_template_directory_uri();
			} else {
				$_path = '';
			}
			$this->args['admin_path'] = $_path . $this->args['admin_dir'];

			/* Set URI path */
			if ( $this->args['admin_uri'] == '' ) {
				$_path_uri = get_template_directory();
			} else {
				$_path_uri = '';
			}
			$this->args['admin_uri'] = $_path_uri . $this->args['admin_dir'];

			/* Get saved options */
			$this->saved_options = get_option( $this->args['option_name'] );

			/* Add panel to admin bar */
			if ( $this->args['admin_bar'] ){
				add_action( 'admin_bar_menu', array( &$this, 'admin_bar'), 1000 );
			}
			
			if ( is_admin() ) {

				/* Icon */
				if ( $this->args['menu_icon'] == '' ) {
					$this->args['menu_icon'] = $this->args['admin_path'] . '/assets/images/panel/icon-config.png';
				} 

				/* Call method to create the sidebar menu items */
				add_action( 'admin_menu', array( &$this, 'add_admin_menu' ) );

				/* --- Ajax Actions --- */
				add_action( 'wp_ajax_panel_save', array( &$this, 'panel_save' ) );

				/* Import Dummy data */
				if ( $this->args[ 'dummy_data' ] != '' && $this->saved_options[ 'theme_name' ] == '' ) {

					/* Import items */
					$data = $this->args[ 'dummy_data' ];
					$func = 'base64' . '_decode';
					$data = $func( $data );
					$data = @unserialize( $data );
					if ( $data ) {
						update_option( $this->args['option_name'], $data );
					}
				}

				// Panel Scripts
				add_action( 'admin_enqueue_scripts', array( &$this, 'muttleypanel_enqueue' ) );

				/* --- Functions --- */
				/* Include function */
				if ( ! function_exists( 'mr_image_resize' ) ) {
					include_once( $this->args['admin_uri'] . '/functions/mr-image-resize.php' );
				}

				/* --- Extensions --- */
				foreach ( $this->options as $option ) {

					// Extension Class Name
					$class_name = 'MuttleyPanel_' . $option['type'];

					if ( ! method_exists( $this, $option['type'] ) ) {

						// Include Extensions
						$file = $option['type'] . '.php';
						if ( file_exists( $this->args['admin_uri'] . '/fields/' . $option['type'] . '/' . $file  ) ) {
							require_once( trailingslashit( $this->args['admin_uri'] ) . '/fields/' . $option['type'] . '/' . $file );
							if ( class_exists( $class_name ) ) {
								$this->extensions[$option['type']] = new $class_name( $option, $this->args, $this->saved_options );
							}
						}

					} 
				}

			}
		}


		/**
         * Display Admin Bar.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
        */
		function admin_bar() {

			global $wp_admin_bar;
			
			if ( ! is_super_admin() || ! is_admin_bar_showing() ) 
				return;

			/* Add the main siteadmin menu item */
			$wp_admin_bar->add_menu(
				array( 
					'id' => 'r_theme_settings', 
					'title' => __( 'Theme Options', 'noisa' ), 
					'href' => site_url() . '/wp-admin/admin.php?page=' . $this->args['page_name'] . '.php'
					)
				);
		
		}


		/**
         * Create sidebar menu.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
        */
		function add_admin_menu() {
		
			/* Theme Menu */

			// Main page
			$add_page_func = 'add'.'_menu'.'_page';
			$panel_page = $add_page_func( $this->args['menu_name'], $this->args['menu_name'], 'manage_options', $this->args['page_name'].'.php', array(&$this, 'init'), $this->args['menu_icon'], 99  );
		 }
		

		/**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
        */
		public function muttleypanel_enqueue() {

			/* Panel
			---------------------------------------------- */

			$current_screen = get_current_screen();
			$current_page = 'toplevel_page_'.$this->args['page_name'];

			if ( $current_screen->base === $current_page  ) {

				/* Thickbox */
			   	wp_enqueue_style('thickbox');
				wp_enqueue_script('thickbox');
				wp_enqueue_script('media-upload');

				/* Media */
				wp_enqueue_media();

				/* Nprogress */
				wp_enqueue_style( 'nprogress_css', $this->args['admin_path'] . '/assets/css/nprogress.css' );
				wp_enqueue_script( 'nprogress_js', $this->args['admin_path'] . '/assets/js/nprogress.js', false, false, true );

				/* Notify */
				wp_enqueue_script( 'notify_js', $this->args['admin_path'] . '/assets/js/jquery.notify.min.js', false, false, true);

				/* UI */
				wp_enqueue_style( 'MuttleyPanel_ui_css', $this->args['admin_path'] . '/assets/css/jquery-ui.css' );

				/* Panel stylesheet */
				wp_enqueue_style( 'MuttleyPanel_css', $this->args['admin_path'] . '/assets/css/panel.css' );

				/* Panel fonts */
				wp_enqueue_style( 'MuttleyPanel_font', $this->args['admin_path'] . '/assets/css/font-awesome.css' );
				
				/* Panel javascripts */
				wp_enqueue_script( 'MuttleyPanel_core', $this->args['admin_path'] . '/assets/js/core.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog', 'jquery-ui-widget', 'jquery-ui-sortable', 'jquery-ui-droppable', 'jquery-ui-slider', 'jquery-ui-draggable', 'jquery-ui-datepicker'), false, true );

				/* Panel Fields */
				wp_enqueue_script( 'MuttleyPanel_fields', $this->args['admin_path'] . '/assets/js/fields.js', false, false, true);
				$js_variables = array(
					'used_plugins' => array_values( $this->used_plugins )
				);
				wp_localize_script('MuttleyPanel_fields', 'muttleypanel_vars', $js_variables);

				/* Touch punch */
				wp_enqueue_script( 'touch_punch', $this->args['admin_path'] . '/assets/js/jquery.ui.touch-punch.min.js', false, false, true );
			}
	    }


		/**
         * Init Framework
         *
         * @since       1.0.0
         * @access      public
         * @return      void
        */
		function init() {

			if ( is_admin() ) {
				$this->display();
			}
		}	
		

		/**
         * Save options
         *
         * @since       1.1.0
         * @access      public
         * @return      void
        */
		function panel_save() {
		    $data = $_POST['data'];
			
			$new_options = array( );
			
			if ( isset( $data['save_options'] ) ) {
				
				if ( isset( $data['import'] ) && $data['import'] != '' ) {
					
					/* Import items */
					$func = 'base64' . '_decode';
					$data =  $func( $data['import'] );
					$data = @unserialize( $data );
					if ( ! $data ) {
						echo 'import_error';
						die();
					} else {
						update_option( $this->args['option_name'], $data );
					}
					update_option( $this->args['option_name'], $data );
					
				} else {
					foreach ( $this->options as $option ) {
						if ( isset( $option['id'] ) && is_array( $option['id'] ) ) {
							$items_count = count( $data[$option['array_name'] . '_hidden'] );
							for ( $items = $items_count; $items >= 0; $items-- ) {
		
								foreach ( $option['id'] as $item => $option_id ) {
									
									if ( isset( $data[$option_id['id']][ $items ] ) && $data[$option_id['id']][ $items ] !='' ) {
										$data_items = $data[ $option_id['id'] ][ $items ];
										$new_options[$option['array_name']][ $items ][$option_id['name']] = stripslashes( $data_items );
									}
								}
							}
		
						} else {
							if ( isset( $option['id'] ) && isset( $data[$option['id']] ) ) {

								// Multiple arrays
								if ( is_array( $data[$option['id']] ) ) {
								  $new_options[ $option['id'] ] = $data[$option['id']];
								} elseif ( $data[$option['id']] != '' ) {
								   $new_options[ $option['id'] ] = stripslashes( $data[$option['id']] );
								} elseif ( isset($option['std'] ) && $option['std'] != '' ) {
								   $new_options[ $option['id'] ] = stripslashes( $option['std'] );
								}
							}
						}
					}
				
				   update_option( $this->args['option_name'], $new_options );
				}
				
				$this->saved_options = $new_options;
				$func_encode = 'base64' . '_encode';
				$encode_export = $func_encode( serialize( $this->saved_options ) );
				$this->saved_options['export'] = $encode_export;
				
				/* Encode */
				echo json_encode( $this->saved_options );
			}
			die();
		}
		
		
		/**
         * Display framework fields
         *
         * @since       1.0.1
         * @access      public
         * @return      void
        */
		function display() {
			
			$this->saved_options = get_option( $this->args['option_name'] );

			/* Autosave */
			if ( isset($_REQUEST['autosave']) ) 
				$autosave = 'true';
			else 
				$autosave = 'false';

			/* Panel */
			echo '<div id="muttleypanel" data-autosave="' . $autosave . '">';

			/* Mobile top */
			echo '<div id="muttleypanel-top">';
			echo '<span id="show-res-nav" class="mobile-button"><i class="icon fa-bars"></i></span>';
			echo '<span id="_save_mobile" class="mobile-button"><i class="icon fa-save"></i></span>';
			echo '</div>';

			/* Sidebar */
			echo '<div id="muttleypanel-sidebar">';
			echo '<div id="muttleypanel-logo">';

			if ( isset( $this->saved_options['admin_logo'] ) && $this->get_image( $this->saved_options['admin_logo'] ) ) {
			    echo '<img src="' . $this->img_resize( '200', '144', $this->saved_options['admin_logo'] ) . '" alt="" />';
	        } elseif ( $this->args['panel_logo'] != '' ) {
				echo '<img src="' . $this->args['panel_logo'] . '" alt="Panel Logo" />';
	        } else { 
			    echo '<img src="' . $this->args['admin_path'] . '/assets/images/panel/logo.png" alt="Panel Logo" />';
			}

			echo '</div>' . "\n\n";
	  		echo '<div id="menu-container">' . "\n\n";
			echo '<ul class="muttleypanel-menu">' . "\n\n";
			
			/* Display menu */
			$sub = false;
	    	foreach ( $this->options as $option ) {
	    		
				if ( $option['type'] == 'open' && isset( $option['tab_name'] ) ) {
					echo '<li>'."\n";
					if ( isset( $option['icon'] ) ) {
						$icon = '<i class="fa icon fa-' . $option['icon'] . '"></i>';
					} else {
						$icon = '';
					}
					echo '<a class="muttleypanel-menu-level0" data-tab_id="' . $option['tab_id'] . '" href="#nav">' . $icon . '<span>' . $option['tab_name'] . '</span></a>' . "\n\n";
				}
				// sub
				if ( $option['type'] == 'sub_open' && isset( $option['sub_tab_name'] ) && $sub == false ) {
					echo '<ul class="muttleypanel-sub-menu">' . "\n";
					$sub = true;
				}

				if ( $option['type'] == 'sub_open' && isset( $option['sub_tab_name'] ) && $sub == true ) {
					echo '<li><a class="muttleypanel-menu-level1" data-tab_id="' . $option['sub_tab_id'] . '" href="#nav">' . $option['sub_tab_name'] . '</a></li>' . "\n";
					$sub = true;
				}
				
				if ( $option['type'] == 'close' && $sub == false ) {
					echo '</li>' . "\n";
				}
				
				if ( $option['type'] == 'close' && $sub == true) {
					echo '</ul>' . "\n\n";
					echo '</li>' . "\n";
					$sub = false;
				}
						
			}
	        echo '</ul>';
	        echo '</div>' . "\n";
			echo '<button class="_button" id="_save"><i class="icon fa-save"></i><span class="r-save-text">' . __( 'Save Settings', 'noisa' ) . '</span></button>';
			echo '</div>';
			
			/* Content */
			echo '<div id="muttleypanel-content">';

			/* Notices */
			echo '<div id="muttleypanel-notices" style="display:none"><div id="default"><h1>#{title}</h1><p>#{text}</p></div></div>';

			/* Form */
	    	echo '<form method="post" id="muttleypanel_form" action="#">';

			/* Display */
	      	foreach ( $this->options as $key => $option ) {	
					
				/*  Groups */
				if ( isset( $option['group_name'] ) ) {
					$group = '';
					foreach ( $option['group_name'] as $group_value ) {
					    $group .= ' group-' . $group_value;
					}
					$group .= ' main-group-' . $option['main_group'];
					$style = 'style="display:none"';
				} else { 
				  $group = '';
				  $style = '';
				}
				
				/* If not is tab */
				if ( $option['type'] != 'open' && $option['type'] != 'close' && $option['type'] != 'sub_open' && $option['type'] != 'sub_close' ) {
					$group_start = '<div class="' . $group . ' clearfix" ' . $style . '>';
					$group_end = '</div>';
				} else {
				    $group_start = '';
					$group_end = '';
				}
				
				$this->e_esc( $group_start );

				if ( method_exists( $this, $option['type'] ) ) {

					// Display Private Methods
					call_user_func( array( &$this, $option['type'] ), $option );

				} else {

					// Extensions
					$instance = $this->extensions[ $option['type'] ];
					$class_name = 'MuttleyPanel_' . $option['type'];

					if ( is_object( $instance ) ) {
						if ( class_exists( $class_name ) && $instance instanceof $class_name ) {
							$o = new $instance( $option, $this->args, $this->saved_options );
							$o->render();
						}
					}

				}

				$this->e_esc( $group_end );
			}

			unset( $this->extensions );
			
			echo '<input type="hidden" name="save_options" value="1"/>';
			echo '</form>';
			echo '</div>';
			echo '</div>';
		}


		/* Public Methods
		---------------------------------------------- */


		/* Add Custom Option
		---------------------------------------------- */
		public function custom_options( $new_options ) {

			if ( is_array( $new_options ) ) {

				array_push( $this->options,  $new_options );
			}
		}


		/* Get Option
		---------------------------------------------- */
		public function get_option( $option ) {

			if ( is_array( $this->saved_options ) ) {
				if ( isset( $this->saved_options[ $option ] ) ) {
					return $this->saved_options[ $option ];
				} else {
					return false;
				}
			} else {
				return false;
			}
		}


		/* Get Option Echo
		---------------------------------------------- */
		public function e_get_option( $option ) {

			if ( is_array( $this->saved_options ) ) {
				if ( isset( $this->saved_options[ $option ] ) ) {
					print $this->saved_options[ $option ];
				} else {
					return false;
				}
			} else {
				return false;
			}
		}


		/* ESC
		---------------------------------------------- */
		public function esc( $option ) {

			if ( is_string( $option ) ) {
				$option = preg_replace( array('/<(\?|\%)\=?(php)?/', '/(\%|\?)>/'), array('',''), $option );
			}

			return $option;
		}


		/* ESC Echo
		---------------------------------------------- */
		public function e_esc( $option ) {

			if ( is_string( $option ) ) {
				$option = preg_replace( array('/<(\?|\%)\=?(php)?/', '/(\%|\?)>/'), array('',''), $option );
			}

			print $option;
		}


		/* Image exist
		---------------------------------------------- */
		public function get_image( $img ) {

			// Check image src or image ID
			if ( is_numeric( $img ) ) {
		    	$image_att = wp_get_attachment_image_src( $img, 'full' );
			   	if ( $image_att[0] ) {
			   		return $image_att[0];
			   	} else { 
			   		return false;
			   	}
			}

			//define upload path & dir
		   	$upload_info = wp_upload_dir();
			$upload_dir = $upload_info['basedir'];
			$upload_url = $upload_info['baseurl'];

			// check if $img_url is local
			if( strpos( $img, $upload_url ) === false ) return false;

			//define path of image
			$rel_path = str_replace( $upload_url, '', $img );
			$img_path = $upload_dir . $rel_path;

			$image = @getimagesize( $img_path );
			if ( $image ) {
				return $img;
			} else {
				return false;
			}
		}


		/* Image resize
		---------------------------------------------- */
		public function img_resize( $width, $height, $src, $crop = 'c', $retina = false ) {

			$image = $this->get_image( $src );

			// If icon
		   	if ( strpos( $image, ".ico" ) !== false ) {
		   		return $image;
		   	}

		   	// If image src exists
			if ($image) {
				if ( function_exists( 'mr_image_resize' ) ) {
					return mr_image_resize( $image, $width, $height, true, $crop, $retina );
				} else {
					return $image;
				}
			}
			return false;
		}


		/* Get image by URL
		---------------------------------------------- */
		public function get_image_by_url( $image_url, $size = 'thumbnail' ) {
		 	global $wpdb;

		    $attachment_query = $wpdb->prepare(
		        "
		        SELECT
		            {$wpdb->posts}.id
		        FROM 
		            {$wpdb->posts}
		        WHERE
		            {$wpdb->posts}.post_type = 'attachment'
		        AND
		            {$wpdb->posts}.guid = %s
		        ",
		        $image_url

		    );

			$attachment = $wpdb->get_results( $attachment_query, ARRAY_N );
		    
			if ( is_array( $attachment ) && ! empty( $attachment ) ) {
				$attachment_url = wp_get_attachment_image_src( $attachment[0][0], $size );
				return $attachment_url[0];
			} else {
				return false;
			}
		}


		/* Private Methods
		---------------------------------------------- */

		/* Open Tab
		---------------------------------------------- */
		private function open( $value ) {
			echo '<div class="muttleypanel-tab muttleypanel-main-tab" id="' . $value['tab_id'] . '">';
			echo '<div class="muttleypanel-breadcrumb"><div>' .  $value['tab_name'] . '</div><div class="r-separator"><i class="fa fa-angle-right"></i></div><div></div></div>';

			/* Display description */
			if ( isset( $value['desc'] ) ) {
				echo '<div class="sub-desc">' . $value['desc'] . '</div>';
			}
		}
		

		/* Close Tab
		---------------------------------------------- */
		private function close( $value ) {
			echo '</div>';
		}
		

		/* Sub tab
		---------------------------------------------- */
		private function sub_open( $value ) {
			echo '<div class="muttleypanel-tab" id="' . $value['sub_tab_id'] . '">';
			
		}
		

		/* Sub Tab Close
		---------------------------------------------- */
		private function sub_close( $value ) {
			echo '</div>';
		}


		/* Export
		---------------------------------------------- */
		private function export( $value ) {	
			
			if ($this->saved_options != false && count($this->saved_options) > 0) {
				$func_encode = 'base64' . '_encode';
				$export = $func_encode( serialize( $this->saved_options ) );
			} else $export = '';
		    
			echo '<div class="box-row clearfix">';
				echo '<label >' . __( 'Export Data', 'noisa' ) . '</label>';
				echo '<div class="input-wrap">';
					echo '<textarea name="export" style="height:200px;overflow:auto">' . $export . '</textarea>';
				echo '</div>';
			echo '</div>';
		}
		

		/* Import
		---------------------------------------------- */
		private function import( $value ) {	
			
			echo '<div class="box-row clearfix">';
				echo '<div id="data-import-wrap" style="display:none">';
					echo '<label >' . __( 'Import Data', 'noisa' ) . '</label>';
					echo '<div class="input-wrap"></div>';
					echo '<div class="clear"></div>';
				echo '</div>';
				echo '<button class="_button data-import"><i class="fa fa-upload icon"></i>' . __( 'Import data', 'noisa' ) . '</button>';
				echo '<div class="help-box">';
					echo __( 'Click on "Import data" button and paste in the box above previously exported data, and press the save button.', 'noisa' );
				echo '</div>';
			echo '</div>';		
		}


		/* Hidden Field
		---------------------------------------------- */
		private function hidden_field( $value ) {
			echo '<input type="hidden" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . $value['value'] . '"/>';
		}
	}
}

?>