<?php

/* ------------------------------------------------------------------------

	Class: R-Panel
	Ver. 2.0.2
	Copyright: Rascals Themes
	Web: http://rascals.eu

 ------------------------------------------------------------------------ */

class R_Panel {
	
	private $args;
	private $options;
	private $used_plugins = array( 'panel' );
	private $saved_options;
	private $cufon_fonts;
	private $admin_path;
	private $admin_uri;
	private $textdomain;
	private $defaults = array(
		'admin_path'  => '',
		'admin_uri'	 => '',
		'panel_logo' => '',
		'menu_name'   => 'Settings', 
		'page_name'   => 'panel-main.php',
		'sub_page_name' => '',
		'option_name' => 'panel_main_options',
		'admin_dir'   => '/admin/panel',
		'menu_icon'   => '',
		'dummy_data' => '',
		'textdomain' => 'admin_panel_class'
		);
	

	/* Contruct
	---------------------------------------------- */
	public function __construct( $args, $options ) {

		/* Set options and page variables */
		if ( isset( $args ) && is_array( $args ) ) {
			$this->args = array_merge( $this->defaults, $args );
		} else {
			$this->args = $args;
		}
		$this->options = $options;

		/* Textdomain */
		$this->textdomain = $args['textdomain'];

		/* Check used plugins and generate used plugins array */
		foreach ( $this->options as $plugins ) {
        	if ( isset( $plugins['plugins'] ) && is_array( $plugins['plugins'] ) ) {
        		foreach ( $plugins['plugins'] as $plugin )
        			$this->used_plugins[] = $plugin;
        	} 
        }
        if ( is_array( $this->used_plugins) && ! empty($this->used_plugins) ) {
    		$this->used_plugins = array_unique( $this->used_plugins );
    		// var_dump($this->used_plugins);
    	}
		
		/* Set paths */

		/* Set path */
		if ( $this->args['admin_path'] == '' ) {
			$_path = get_template_directory_uri();
		} else {
			$_path = '';
		}
		$this->admin_path = $_path . $this->args['admin_dir'];

		/* Set URI path */
		if ( $this->args['admin_uri'] == '' ) {
			$_path_uri = get_template_directory();
		} else {
			$_path_uri = '';
		}
		$this->admin_uri = $_path_uri . $this->args['admin_dir'];
		
		/* Icon */
		if ( $this->args['menu_icon'] == '' ) {
			$this->args['menu_icon'] = $this->admin_path . '/assets/images/panel/icon-config.png';
		} 

		/* Get saved options */
		$this->saved_options = get_option( $this->args['option_name'] );

		/* Call method to create the sidebar menu items */
		add_action( 'admin_menu', array( &$this, 'add_admin_menu' ) );

		/* --- Ajax Actions --- */
		add_action( 'wp_ajax_panel_save', array( &$this, 'panel_save' ) );

		if ( in_array( 'easy_link', $this->used_plugins ) )
			add_action( 'wp_ajax_easy_link_ajax', array( &$this, 'easy_link_ajax' ) );

		if ( in_array( 'add_image', $this->used_plugins ) )
			add_action('wp_ajax_thumb_generator', array( &$this, 'thumb_generator') );

		/* --- Functions --- */
		/* Include function */
		if ( ! function_exists( 'mr_image_resize' ) )
			include_once( $this->admin_uri . '/functions/mr-image-resize.php' );

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

	}
		

	/* Public function
	---------------------------------------------- */
	public function custom_options( $new_options ) {

		if ( is_array( $new_options ) ) {

			array_push( $this->options,  $new_options);
		}
	}

	/* Create the sidebar menu
	---------------------------------------------- */
	function add_admin_menu() {
	
		/* Theme Menu */
		if ( $this->args['sub_page_name'] != '' ) {

			// Sub page
			$panel_sub_page = add_submenu_page( $this->args['page_name'], $this->args['menu_name'], $this->args['menu_name'], 'manage_options', $this->args['sub_page_name'], array(&$this, 'init') );

			// Load the JS conditionally
        	add_action( 'load-' . $panel_sub_page, array( &$this, 'panel_scripts' )  );

		} else {

			// Main page
			$panel_page = add_menu_page( $this->args['menu_name'], $this->args['menu_name'], 'manage_options', $this->args['page_name'], array(&$this, 'init'), $this->args['menu_icon'], 99  );

        	// Load the JS conditionally
        	add_action( 'load-' . $panel_page, array( &$this, 'panel_scripts' )  );
		}
	 }
	

	/* Admin scripts
	---------------------------------------------- */
	function panel_scripts() {
		

		/* Footer Content
		---------------------------------------------- */
		add_action( 'admin_footer', array( &$this, 'panel_footer' ) );


		/* Plugins
		---------------------------------------------- */

		// Code editor
		if ( in_array( 'code_editor', $this->used_plugins ) ) {

			wp_enqueue_style( 'code_mirror_css', $this->admin_path . '/assets/js/code_mirror/lib/codemirror.css', false, '2013-11-01', 'screen' );
			
			wp_enqueue_script( 'code_mirror', $this->admin_path . '/assets/js/code_mirror/lib/codemirror.js', array( 'jquery' ), '2013-11-01' );
			wp_enqueue_script( 'code_mirror_js_css', $this->admin_path . '/assets/js/code_mirror/mode/css/css.js', array( 'jquery' ), '2013-11-01', true );
			wp_enqueue_script( 'code_mirror_js_javascript', $this->admin_path . '/assets/js/code_mirror/mode/javascript/javascript.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Multiselect
		if ( in_array( 'multiselect', $this->used_plugins ) ) {
			wp_enqueue_style( 'multiselect_css', $this->admin_path . '/assets/css/multi-select.css', false, '2013-11-01', 'screen' );
			wp_enqueue_script( 'multiselect_js', $this->admin_path . '/assets/js/jquery.multi-select.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Easy Link
		if ( in_array( 'easy_link', $this->used_plugins ) ) {
			wp_enqueue_style( 'easy_link_css', $this->admin_path . '/assets/css/easy_link.css', false, '2013-11-01', 'screen' );
			wp_enqueue_script( 'easy_link_js', $this->admin_path . '/assets/js/easy_link.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Background Generator
		if ( in_array( 'bg_generator', $this->used_plugins ) ) {
			wp_enqueue_script( 'bg_generator_js', $this->admin_path . '/assets/js/bg_generator.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Video Generator
		if ( in_array( 'video', $this->used_plugins ) ) {
			wp_enqueue_script( 'video_generator_js', $this->admin_path . '/assets/js/video_generator.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Iframe Generator
		if ( in_array( 'iframe_generator', $this->used_plugins ) ) {
			wp_enqueue_script( 'iframe_generator_js', $this->admin_path . '/assets/js/iframe_generator.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Colorpicker
		if ( in_array( 'colorpicker', $this->used_plugins ) ) {
			wp_enqueue_script( 'wp-color-picker' );
    		wp_enqueue_style( 'wp-color-picker' );
		}

		// toggleSwitch
		if ( in_array( 'switch_button', $this->used_plugins ) ) {
			wp_enqueue_script( 'toggleswitch_js', $this->admin_path . '/assets/js/jquery-ui.toggleSwitch.js', array( 'jquery' ), '2013-11-01', true );
		}

		// Cufon Fonts
		if ( in_array( 'cufon_fonts', $this->used_plugins ) ) {
			// var_dump($this->options);
			$cufon_path = null;
			$cufon_path_uri = null;
			foreach ($this->options as $font_path) {
				if ( isset( $font_path['cufon_path'] ) ) {
					$cufon_path = $font_path['cufon_path'];
				}
				if ( isset( $font_path['cufon_path_uri'] ) ) {
					$cufon_path_uri = $font_path['cufon_path_uri'];
				}
			}
			
			if ( isset( $cufon_path ) && isset( $cufon_path_uri ) ) {

				wp_enqueue_script( 'cufon_fonts_js', $this->admin_path . '/assets/js/cufon-yui.js', array( 'jquery' ), '2013-11-01', false );

				$i = 0;
				if ( is_dir( $cufon_path ) ) {
					if ( $open_dir = opendir( $cufon_path ) ) {
						while ( ( $font = readdir($open_dir ) ) !== false ) {
							if ( stristr( $font, '.js' ) !== false ) {
								$font_content = file_get_contents( $cufon_path . $font );
								if ( preg_match( '/font-family":"(.*?)"/i', $font_content, $match ) ) {
									wp_enqueue_script('panel_cufon_font' . $i , $cufon_path_uri . $font , array('jquery'), '2013-11-01');
									$this->cufon_fonts[$i]['name'] = $match[1];
									$this->cufon_fonts[$i]['file_name'] = $font;
									$this->cufon_fonts[$i]['file_path'] = $cufon_path_uri . $font;
								}
								$i++;
							}
						}
					}
				}
			}

		}


		/* Panel
		---------------------------------------------- */

		/* Thickbox */
	   	wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');


		/* Nprogress */
		wp_enqueue_style( 'nprogress_css', $this->admin_path . '/assets/css/nprogress.css', false, '2013-11-01', 'screen' );
		wp_enqueue_script( 'nprogress_js', $this->admin_path . '/assets/js/nprogress.js', array( 'jquery' ), '2013-11-01', true );

		/* Notify */
		wp_enqueue_script( 'notify_js', $this->admin_path . '/assets/js/jquery.notify.min.js', array( 'jquery' ), '2013-11-01', true );

		/* UI */
		wp_enqueue_style( 'ui_css', $this->admin_path . '/assets/css/jquery-ui.css', false, '2013-11-01', 'screen' );

		/* Panel stylesheet */
		wp_enqueue_style( 'panel_css', $this->admin_path . '/assets/css/panel.css', false, '2013-11-01', 'screen' );

		/* Panel fonts */
		wp_enqueue_style( 'panel_font', $this->admin_path . '/assets/css/font-awesome.css', false, '2013-11-01', 'screen' );
		
		/* Panel javascripts */
		wp_enqueue_script( 'panel_js', $this->admin_path . '/assets/js/panel.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog', 'jquery-ui-widget', 'jquery-ui-sortable', 'jquery-ui-droppable', 'jquery-ui-slider', 'jquery-ui-draggable', 'jquery-ui-datepicker'), '2013-11-01', true );

		$js_variables = array(
			'used_plugins' => array_values( $this->used_plugins )
		);
		wp_localize_script('panel_js', 'panel_vars', $js_variables);

		/* Touch punch */
		wp_enqueue_script( 'touch_punch', $this->admin_path . '/assets/js/jquery.ui.touch-punch.min.js', array( 'jquery' ), '2013-11-01', true );
    }


	/* Admin Footer
	---------------------------------------------- */
    function panel_footer() {
	
		// Easy Link
		if ( in_array( 'easy_link', $this->used_plugins ) ) {
			$this->easy_link_box();
		}

		// Background Generator
		if ( in_array( 'bg_generator', $this->used_plugins ) ) {
			$this->bg_generator_box();
		}

		// Iframe Generator
		if ( in_array( 'iframe_generator', $this->used_plugins ) ) {
			$this->iframe_generator_box();
		}

		// Cufon Fonts 
		if ( in_array( 'cufon_fonts', $this->used_plugins ) ) {
			if ( isset( $this->cufon_fonts ) ) {
				$i = 0;
				$fonts_script = "<script type='text/javascript'>\njQuery(document).ready(function($) {\n";
																							
				foreach ( $this->cufon_fonts as $font ) {
					$fonts_script .= stripslashes( "Cufon.replace('#cufon-font-$i', { fontFamily: '" . $font['name'] . "' });\n" );
					$i++;
				}
				echo $fonts_script . "});\n</script>";
			}
		}
		
    }


	/* Initialize
	---------------------------------------------- */
	function init() {
		$this->display();
	}
	

	/* Save Options
	---------------------------------------------- */
	function panel_save() {
	    $data = $_POST['data'];
		
		$new_options = array( );
		
		if ( isset( $data['save_options'] ) ) {
			
			if ( isset( $data['import'] ) && $data['import'] != '' ) {
				
				/* Import items */
				$data = base64_decode($data['import'] );
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
			//$this->saved_options['logo'] = '';
			
			$encode_export = base64_encode( serialize( $this->saved_options ) );
			$this->saved_options['export'] = $encode_export;
			
			/* Encode */
			//print_r($this->saved_options );
			$response = json_encode( $this->saved_options );
			echo $response;
		}
		die();
	}
	
	
	/* Display
	---------------------------------------------- */
	private function display() {
		
		$this->saved_options = get_option( $this->args['option_name'] );

		/* Autosave */
		if ( isset($_REQUEST['autosave']) ) 
			$autosave = 'true';
		else 
			$autosave = 'false';

		/* Panel */
		echo '<div id="panel" data-autosave="' . $autosave . '">';

		/* Mobile top */
		echo '<div id="panel-top">';
		echo '<span id="show-res-nav" class="mobile-button"><i class="icon fa-bars"></i></span>';
		echo '<span id="_save_mobile" class="mobile-button"><i class="icon fa-save"></i></span>';
		echo '</div>';

		/* Sidebar */
		echo '<div id="panel-sidebar">';
		echo '<div id="panel-logo">';

		if ( isset( $this->saved_options['admin_logo'] ) && r_image_exists( $this->saved_options['admin_logo'] ) ) {
		    echo '<img src="' . $this->image_resize( '200', '144', $this->saved_options['admin_logo'] ) . '" alt="" />';
        } elseif ( $this->args['panel_logo'] != '' ) {
			echo '<img src="' . $this->args['panel_logo'] . '" alt="Panel Logo" />';
        } else { 
		    echo '<img src="' . $this->admin_path . '/assets/images/panel/logo.png" alt="Panel Logo" />';
		}

		echo '</div>' . "\n\n";
  		echo '<div id="menu-container">' . "\n\n";
		echo '<ul class="panel-menu">' . "\n\n";
		
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
				echo '<a class="panel-menu-level0" data-tab_id="' . $option['tab_id'] . '" href="#nav">' . $icon . '<span>' . $option['tab_name'] . '</span></a>' . "\n\n";
			}
			// sub
			if ( $option['type'] == 'sub_open' && isset( $option['sub_tab_name'] ) && $sub == false ) {
				echo '<ul class="panel-sub-menu">' . "\n";
				$sub = true;
			}

			if ( $option['type'] == 'sub_open' && isset( $option['sub_tab_name'] ) && $sub == true ) {
				echo '<li><a class="panel-menu-level1" data-tab_id="' . $option['sub_tab_id'] . '" href="#nav">' . $option['sub_tab_name'] . '</a></li>' . "\n";
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
		echo '<button class="_button" id="_save"><i class="icon fa-save"></i><span class="r-save-text">' . _x( 'Save Settings', 'Admin Panel Class', $this->textdomain ) . '</span></button>';
		echo '</div>';
		
		/* Content */
		echo '<div id="panel-content">';

		/* Notices */
		echo '<div id="panel-notices" style="display:none"><div id="default"><h1>#{title}</h1><p>#{text}</p></div></div>';

		/* Form */
    	echo '<form method="post" id="r_panel_form" action="#">';

		/* Display */
      	foreach ( $this->options as $option ) {	
			if ( method_exists( $this, $option['type'] ) ) {
				
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
				
				echo $group_start;
				call_user_func( array( &$this, $option['type'] ), $option );
				echo $group_end;
			}
		}
		
		echo '<input type="hidden" name="save_options" value="1"/>';
		echo '</form>';
		echo '</div>';
		echo '</div>';
	}
	
	
	/* Helper Functions
	---------------------------------------------- */


	/* Image exist
	---------------------------------------------- */
	private function image_exists( $img ) {

		// Check image src or image ID
		if ( is_numeric( $img ) ) {
	    	$image_att = wp_get_attachment_image_src( $img, 'full' );
		   	if ( $image_att[0] )
		   		return $image_att[0];
		   	else 
		   		return false;
		}

		//define upload path & dir
	   	$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];

		// check if $img_url is local
		if( strpos( $img, $upload_url ) === false ) return false;

		//define path of image
		$rel_path = str_replace( $upload_url, '', $img);
		$img_path = $upload_dir . $rel_path;

		$image = @getimagesize( $img_path );
		if ( $image ) return $img;
		else return false;

	}


	/* Image resize
	---------------------------------------------- */
	private function image_resize( $width, $height, $src, $crop = 'c', $retina = false ) {

		$image = $this->image_exists( $src );

		// If icon
	   	if ( strpos( $src, ".ico" ) !== false )
	   		return $src;

	   	// If image src exists
		if ($image) {
			if ( function_exists( 'mr_image_resize' ) )
				return mr_image_resize( $image, $width, $height, true, $crop, $retina );
			else 
				return $id;
		}
		return false;
	}


	/* Open Tab
	---------------------------------------------- */
	private function open( $value ) {
		echo '<div class="panel-tab panel-main-tab" id="' . $value['tab_id'] . '">';
		echo '<div class="panel-breadcrumb"><div>' .  $value['tab_name'] . '</div><div class="r-separator"><i class="fa fa-angle-right"></i></div><div></div></div>';

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
		echo '<div class="panel-tab" id="' . $value['sub_tab_id'] . '">';
		
	}
	

	/* Sub Tab Close
	---------------------------------------------- */
	private function sub_close( $value ) {
		echo '</div>';
	}


	/* Input: Text
	---------------------------------------------- */
	private function text( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . htmlspecialchars( $value['std'] ) . '" class="r-input"/>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Textarea
	---------------------------------------------- */
	private function textarea( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		if ( isset( $value['tinymce'] ) && $value['tinymce'] == 'true') {
			echo '<div class="custom-tiny-editor" style="padding:0;border:none" data-id="'.$value['id'].'">';
			wp_editor( $value['std'], $value['id'], $settings = array() );
		    echo '</div>';
		} else {
			echo '<textarea id="' . $value['id'] . '" name="' . $value['id'] . '" style="height:' . $value['height'] . 'px" >' . $value['std'] . '</textarea>';
		}
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Code editor
	---------------------------------------------- */
	private function code_editor( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<textarea id="' . $value['id'] . '" name="' . $value['id'] . '" style="height:' . $value['height'] . 'px" >' . $value['std'] . '</textarea>';

		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Switch Button
	---------------------------------------------- */
	private function switch_button( $value ) {	
	
		if ( isset( $this->saved_options[ $value['id'] ] ) ) $value['std'] = $this->saved_options[ $value['id'] ];
		if ( isset( $value['group']) && $value['group'] != '' ) {
			$group_class = 'switch-group';
			$group_id = $value['group'];
		} else {
			$group_class = '';
			$group_id = '';
		}

		/* Row */
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" class="switch-label">' . $value['name'] . '</label>';
		}

		echo '<div class="switch-wrap">';
		echo '<select class="' . $group_class . '" name="' . $value['id'] . '" id="' . $value['id'] . '" data-highlight="true" data-main-group="main-group-' . $group_id . '">';

		if ($value['std'] == 'on') {
			$selected = 'selected';
		} else {
			$selected = '';
		}
        echo '<option value="on" ' . $selected . '>On</option>';
        if ($value['std'] == 'off') {
        	$selected = 'selected';
        } else { 
        	$selected = '';
        }
        echo '<option value="off" ' . $selected . '>Off</option>';
      	echo '</select>';
		echo '</div>';

		/* Help */
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';

		echo '</div>';
	}


	/* Input: Range
	---------------------------------------------- */
	private function range($value) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="range">';
		echo '<div class="range-slider"></div>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" class="range-input" value="' . $value['std'] . '"';

		if ( isset( $value['min'] ) ) {
			echo ' data-min="' . $value['min'] . '"';
		} else {
			echo ' data-min="0"';
		}
		if ( isset( $value['max'] ) ) {
			echo ' data-max="' . $value['max'] . '"';
		} else {
			echo ' data-max="100"';
		}
		if ( isset( $value['step'] ) ) {
			echo ' data-step="' . $value['step'] . '"';
		} else {
			echo ' data-step="1"';
		}
		echo '/>';
		if ( isset( $value['unit'] ) && $value['unit']) {
			echo '<span class="range-unit">' . $value['unit'] . '</span>';
		}
		echo '</div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	

	/* Input: Select
	---------------------------------------------- */
	private function select( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) $value['std'] = $this->saved_options[ $value['id'] ];
		
		if ( isset( $value['group'] ) && $value['group'] != '' ) {
			$group_class = 'select-group';
			$group_id = $value['group'];
		} else {
			$group_class = '';
			$group_id = '';
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" size="1" data-main-group="main-group-' . $group_id . '" class="' . $group_class . '">';
		if (isset( $value['options'] ) ) {
			foreach ( $value['options'] as $option ) {
				if ( isset( $value['std'] ) && $value['std'] == $option['value'] ) $selected = 'selected="selected"';
				else $selected = '';
				echo "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
			}
		}
		echo '</select>';
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Multiple Select
	---------------------------------------------- */
	private function multiselect( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) $value['std'] = $this->saved_options[ $value['id'] ];
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<select name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" size="6"  class="multiselect">';
		if (isset( $value['options'] ) ) {
			foreach ( $value['options'] as $option ) {
				if ( isset( $value['std'] ) && in_array( $option['value'], $value['std'] )) $selected = 'selected="selected"';
				else $selected = '';
				echo "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
			}
		}
		echo '</select>';
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Categories
	---------------------------------------------- */	
	private function categories( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		} 
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" size="1" >';
		$selected = '';

		if (isset( $value['options'] ) ) {
			foreach ( $value['options'] as $option ) {
				if ( isset( $value['std'] ) && $value['std'] == $option['name'] ) $selected = 'selected="selected"';
				echo '<option ' . $selected . ' value="' . $option['value'] . '">' . $option['name'] . '</option>';
			}
		}
		
		foreach ( ( get_categories() ) as $category) {
			
			if ( $category->term_id == $value['std'] ) $selected = 'selected="selected"';
			else $selected = '';
			echo "<option $selected value=\"" . $category->term_id . "\">" . $category->name . "</option>" . "\n";
		}
		
		echo '</select>';
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	

	/* Input: Pages
	---------------------------------------------- */
	private function pages( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" size="1">';

		if (isset( $value['options'] ) ) {
			foreach ( $value['options'] as $option ) {
				if ( isset( $value['std'] ) && $value['std'] == $option['name'] ) $selected = 'selected="selected"';
				else $selected = '';
				echo '<option ' . $selected . ' value="' . $option['value'] . '">' . $option['name'] . '</option>';
			}
		}
		
		$pages = get_pages(); 
		if ( isset( $pages ) && is_array( $pages ) ) {
			foreach ( $pages as $page ) {
			  if ( $page->ID == $value['std'] ) $selected = 'selected="selected"';
			  else $selected = '';
			  $option = '<option ' . $selected . ' value="' . $page->ID . '">';
			  $option .= $page->post_title;
			  $option .= '</option>';
			  echo $option;
			}
		}
		
		echo '</select>';
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	

	/* Input: Taxonomy
	---------------------------------------------- */	
	private function taxonomy($value) {
		
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" size="1">';
		$selected = '';

		if (isset( $value['options'] ) ) {
			foreach ( $value['options'] as $option ) {
				if ( isset( $value['std'] ) && $value['std'] == $option['name'] ) $selected = 'selected="selected"';
				echo '<option ' . $selected . ' value="' . $option['value'] . '">' . $option['name'] . '</option>';
			}
		}
		
		$args = array(
					  'hide_empty' => false
		 );
		
		if ( taxonomy_exists( $value['taxonomy'] ) ) {
			$taxonomies = get_terms( $value['taxonomy'], $args );
			
			foreach ( $taxonomies as $taxonomy ) {
				
				if ( isset( $value['std'] ) && $taxonomy->name == $value['std'] ) $selected = 'selected="selected"';
				else $selected = '';
				echo "<option $selected value=\"" . $taxonomy->name . "\">" . $taxonomy->name . "</option>" . "\n";
			}
		}
		
		echo '</select>';
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Easy Link
	---------------------------------------------- */
	private function easy_link( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . htmlspecialchars( $value['std'] ) . '" class="link-input" />';
		echo '<div class="clear"></div>';
		echo '<button class="_button easy-link"><i class="icon fa fa-external-link"></i>' . _x( 'Insert Link', 'Admin Panel Class', $this->textdomain ) . '</button>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	

	/* Easy link */
	function easy_link_ajax() {
		
		$pagenum = $_POST['page_num'];
	    $args = array();
	    $args['pagenum'] = $pagenum;
		
		if ( isset ($_POST['s'] ) && $_POST['s'] != '') $args['s'] = stripslashes( $_POST['s'] );
		
		$results = $this->easy_link_query( $args );
		if ( ! isset( $results ) ) die();
		
	    $output = '';
		if ( ! empty( $results ) ) {
			foreach ( $results as $i => $result ) {

				if ( $i % 2 == 0 ) 
					$odd = 'class="odd"';
				else 
					$odd ='';

			  	$output .= '<li ' . $odd . '><span class="link-title">' . $result['title'] . '</span><span class="link-info">' . $result['info'] . '</span><span class="permalink r-hidden">' . $result['permalink'] . '</span><span class="link-id r-hidden">' . $result['ID'] . '</span></li>';
			}
		} else {
			$output = 'end pages';
		}

	    echo $output;
	    exit;
	}

	/* Query function */
	private function easy_link_query( $args = array() ) {
		$pts = get_post_types( array( 'public' => true ), 'objects' );
		$pt_names = array_keys( $pts );

		$query = array(
			'post_type' => $pt_names,
			'suppress_filters' => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'post_date',
			'posts_per_page' => 20,
		);

		$args['pagenum'] = isset( $args['pagenum'] ) ? absint( $args['pagenum'] ) : 1;

		if ( isset( $args['s'] ) )
			$query['s'] = $args['s'];

		$query['offset'] = $args['pagenum'] > 1 ? $query['posts_per_page'] * ( $args['pagenum'] - 1 ) : 0;

		// Do main query.
		$get_posts = new WP_Query;
		$posts = $get_posts->query( $query );

		// Check if any posts were found.
		if ( ! $get_posts->post_count )
			return false;

		// Build results.
		$results = array();
		foreach ( $posts as $post ) {
			if ( 'post' == $post->post_type )
				$info = mysql2date('Y/m/d', $post->post_date );
			else
				$info = $pts[ $post->post_type ]->labels->singular_name;

			$results[] = array(
				'ID' => $post->ID,
				'title' => trim( esc_html( strip_tags( get_the_title( $post ) ) ) ),
				'permalink' => get_permalink( $post->ID ),
				'info' => $info,
			);
		}

		return $results;
	}
 
	/* Box Function  */
	private function easy_link_box() {
	  
		echo '<div id="_easy_link" style="display:none">';
		echo '<input type="hidden" autofocus="autofocus" />';
		echo '<div id="link-search-wrap">';
		echo '<label for="link_search">';
		echo '<span>' . _x( 'Search', 'Admin Panel Class', $this->textdomain ) . '</span>';
		echo '<input type="text" id="link_search" name="link_search" tabindex="60" autocomplete="off" value="" />';
		echo '</label>';
		echo '<input type="hidden" id="link_target" name="link_target" value=""/>';
		echo '<img class="ajax-loader" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="Ajax loader" />';
		echo '</div>';
		echo '<div id="link-results">';
		echo '<ul>';
		echo '</ul>';
		echo '</div>';
		echo '</div>';
	}


	/* Add image
	---------------------------------------------- */
	private function add_image( $value ) {
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		// Set button title
		if ( isset( $value['button_title'] ) && $value['button_title'] ) { 
			$button_title = $value['button_title'];
		} else { 
		 	$button_title = _x( 'Add File', 'Admin Panel Class', $this->textdomain );
		}

		// ID
		if ( isset( $value['by_id'] ) && $value['by_id'] == true ) { 
			$by_id = true;
			$input_type = 'hidden';
			$get_url = 'false';
		} else { 
		 	$by_id = false;
		 	$input_type = 'text';
		 	$get_url = 'true';
		}

		// Set message
		if ( isset( $value['msg'] ) && $value['msg'] ) { 
			$msg = $value['msg'];
		} else { 
		 	$msg = _x( 'Currently you don\'t have images, you can add them by clicking on the button below.', 'Admin Panel Class', $this->textdomain );
		}

		if ( ! isset( $value['std'] ) || $value['std'] == '' ) {
			$display = 'block';
			$del_display = 'none';
			$theme_path = false;
		} else {
			if ( strpos( $value['std'], 'THEME_PATH' ) !== false )
				$theme_path = true;
			else
				$theme_path = false;
			$del_display = 'inline-block';
			$display = 'none';
		}

		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label>' . $value['name'] . '</label>';
		}

		// Input
		echo '<input type="' . $input_type . '" value="' . $value['std'] . '" id="' . $value['id'] . '" name="' . $value['id'] . '" class="image-input"/>';
		echo '<div class="image-holder" data-width="' . $value['width'] . '" data-height="' . $value['height'] . '" data-crop="' . $value['crop'] . '" data-get_url="' . $get_url . '">';

		/* Image preview */
		if ( isset( $value['std'] ) && $value['std'] != '' && $theme_path == false ) {

				// By ID
				if ( $by_id ) {

					// Get image data
					$image = wp_get_attachment_image_src( $value['std'] );
				} else {
					$image = $this->image_exists( $value['std'] );
				}

				// If image exists
				if ( $image ) {
					echo '<img src="' . $this->image_resize($value['width'], $value['height'], $value['std'], 'c') . '" alt=" ' . $value['std'] . ' ">';
				} else {
					$display = 'block';
					$del_display = 'none';
				}

		}
		echo '</div>';

		// Message
		echo '<div class="msg-dotted" style="display:' . $display . '">' . $msg . '</div>';

		if ( $theme_path == true )
			echo '<p class="msg msg-info">' . _x( 'You are using an image only for a preview. Select new image and save settings.', 'Admin Panel Class', $this->textdomain ) . '</p>';

		echo '<p class="msg msg-error" style="display:none">' . _x( 'The link is incorrect or the image does not exist.', 'Admin Panel Class', $this->textdomain ) . '</p>';
			
		// Button
		echo '<button class="_button upload-image" style="display:' . $display . '"><i class="fa icon fa-plus"></i>' . $button_title . '</button>';

		echo '<button class="_button ui-button-delete delete-image" style="display:' . $del_display . '"><i class="fa icon fa-trash-o"></i>' . _x( 'Remove', 'Admin Panel Class', $this->textdomain ) . '</button>';

		// Ajax loader
		echo '<img class="ajax-loader" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="Loading..." style="display:none" />';
		

		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}

	/* Thumb Generator */
	function thumb_generator() {

		$id = $_POST['id'];
		$width = $_POST['width'];
		$height = $_POST['height'];
		$crop = $_POST['crop'];
		
		// Check image exists
		$img = $this->image_exists($id);
		
		// If icon
	   	if ( strpos( $img, ".ico" ) !== false ) {
	   		echo $img;
	   		exit();
	   	}

		if ($img)
			echo $this->image_resize($width, $height, $id, $crop);
		else
			echo 'error';
		exit;
	}


	/* Sortable List
	---------------------------------------------- */
	private function sortable_list( $value ) {	
		
		echo '<div class="box-row clearfix">';
		
		if ( isset($value['button_text']) && $value['button_text'] != '' ) {
		    $button_text = $value['button_text'];
		 } else {
		    $button_text = _x( 'Add New Item', 'Admin Panel Class', $this->textdomain );
		}
		
		//echo '<pre>';
		//print_r($this->saved_options[$value['array_name']] );
		//echo '</pre>';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label >' . $value['name'] . '</label>';
		}

		echo '<div class="clear"></div>';
		
		/* Hidden items */
		echo '<div class="new-item" style="display:none">';
		echo '<ul>';
		echo '<li>';
		echo '<span class="delete-item"><i class="fa fa-times"></i></span>';
		echo '<span class="drag-item"><i class="fa fa-arrows-alt"></i></span>';
		echo '<div class="content">';
		echo '<input type="hidden" value="" name="' . $value['array_name'] . '_hidden[]"/>';
		foreach ( $value['id'] as $count => $item ) {
		    echo '<label>' . $item['label'] . '</label>';
			echo '<input type="text" value="" name="' . $item['id'] . '[]"/>';
		}
		echo '</div>';
		echo '</li>';
		echo '</ul>';
		echo '</div>';
		
		if ( $value['sortable'] == true ) 
			$sort = 'sortable';
		else 
			$sort = '';

		if ( isset( $this->saved_options[$value['array_name']] ) && is_array( $this->saved_options[$value['array_name']] ) )
		  $list_class = $value['array_name'];
		else 
		  $list_class = '';

		echo '<ul class="sortable-list ' . $list_class . ' ' . $sort .'">';
			
		if ( isset( $this->saved_options[$value['array_name']] ) && is_array( $this->saved_options[$value['array_name']] ) ) {
			foreach ( $this->saved_options[$value['array_name']] as $items ) {
				echo '<li>';
				echo '<span class="delete-item"><i class="fa fa-times"></i></span>';
				echo '<span class="drag-item"><i class="fa fa-arrows-alt"></i></span>';
				echo '<div class="content">';
				echo '<input type="hidden" value="" name="' . $value['array_name'] . '_hidden[]"/>';
				foreach ( $value['id'] as $count => $item ) {
					echo '<label>' . $item['label'] . '</label>';
					if ( isset($items[$item['name']] ) ) {
					    echo '<input type="text" class="input" value="' . htmlentities($items[$item['name']]) . '" name="' . $item['id'] . '[]"/>';
					} else {
					    echo '<input type="text" class="input" value="" name="' . $item['id'] . '[]"/>';
					}
				}
				echo '</div>';
				echo '</li>';
			}
		}
		echo '</ul>';
        echo '<div class="clear"></div>';
		echo '<button class="_button add-new-item"><i class="icon fa-plus"></i>' . $button_text . '</button>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	


	/* Input: Datepicker
	---------------------------------------------- */
	private function datepicker( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="datepicker-wrap input-group">';
		echo '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . htmlspecialchars( $value['std'] ) . '" class="datepicker-input"/>';
		echo '</div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Color
	---------------------------------------------- */
	private function color( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="clear"></div>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . $value['std'] . '" class="colorpicker-input" />';
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	

	/* Background Generator
	---------------------------------------------- */
	private function bg_generator( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="clear"></div>';
		if ( !isset( $value['std'] ) || $value['std'] == '' ) {
			$display_i = 'display:none;';
			$display_d = 'display:none;';
			$display_g = 'display:inline-block;';
		}
		else {
			$display_i = 'display:block;';
			$display_d = 'display:inline-block;';
			$display_g = 'display:none;';
		}
		echo '<div class="bg-generator-wrap" style="' . $display_i  . '"><input type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" class="bg-generator-input" value="' . stripslashes($value['std']) . '" /></div>';
		echo '<button class="_button generate-bg" style="' . $display_g . '"><i class="fa icon fa-magic"></i>' . _x('Generate Background', 'Admin Panel Class', $this->textdomain ) . '</button>';
		
		echo '<button class="_button ui-button-delete delete-bg" style="' . $display_d . '"><i class="fa icon fa-trash-o"></i>' . _x('Remove', 'Admin Panel Class', $this->textdomain ) . '</button>';
		
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Background Generator Box */
	private function bg_generator_box() {
	  
	    echo '<div id="_bg-generator" style="display:none">';
	    echo '<input type="hidden" autofocus="autofocus" />';

		/* Backround type */
		echo '<div class="dialog-row">
		      <label for="bg-type">' . _x('Background Type', 'Admin Panel Class', $this->textdomain ) . '</label>
		      <select name="bg_type" id="bg-type" size="1" class="bg-type">
			  <option value="empty"></option>
		      <option value="none">None</option>
			  <option value="color">Color</option>
			  <option value="image">Image</option>
			  </select>
	          <p class="help-box">' . _x('Select background type.', 'Admin Panel Class', $this->textdomain ) . '</p>
			  </div>';
		
		/* Color */
		echo '
		<div class="color-group" style="display:none">
		<div class="dialog-row">
		<label for="bg-color">' . _x('Color', 'Admin Panel Class', $this->textdomain ) . '</label>
		<label for="bg-color-transparent" class="checkbox-label">' . _x('Transparent: ', 'Admin Panel Class', $this->textdomain ) . ' <input type="checkbox" id="bg-color-transparent" name="bg_color_transparent" value="" /></label>
		<div class="clear"></div>
		<input type="text" id="bg-color" name="bg_color" value="#ffffff" class="colorpicker-input"/>
		<div class="clear"></div>
		<p class="help-box">' . _x('Select background color.', 'Admin Panel Class', $this->textdomain ) . '</p>
		</div>
		</div>';
		
		/* File */
		$hidden_class = 'r-hidden';
		echo '
		<div class="dialog-row file-group" style="display:none">
		
		<div class="dialog-row">
		<label for="bg-file">' . _x('File URL ', 'Admin Panel Class', $this->textdomain ) . '</label>
		<input type="text" id="bg-file" name="bg_file" value="http://" class="image-input" onBlur="if (this.value == \'\') this.value = \'http://\'" onFocus="if (this.value == \'http://\') this.value = \'\';"/>
		
		<div class="image-holder" data-width="150" data-height="80" data-crop="80" data-get_url="true">
		
		</div>

		<p class="msg msg-error" style="display:none">' . _x( 'The link is incorrect or the image does not exist.', 'Admin Panel Class', $this->textdomain ) . '</p>

		<button class="_button upload-image"><i class="fa icon fa-plus"></i>' . _x( 'Add File', 'Admin Panel Class', $this->textdomain ) . '</button>
		<button class="_button ui-button-delete delete-image" style="display:none"><i class="fa icon fa-trash-o"></i>' . _x( 'Remove', 'Admin Panel Class', $this->textdomain ) . '</button>
		<img class="ajax-loader" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="Loading..." style="display:none" />
		<p class="help-box">' . _x('Enter image URL for your background.', 'Admin Panel Class', $this->textdomain ) . '</p>
		</div>
		<div class="dialog-row">
		<label for="bg-pos">' . _x('Position', 'Admin Panel Class', $this->textdomain ) . '</label>
		      <select name="bg_pos" id="bg-pos" size="1" class="bg-pos">
		      <option value="left top">left top</option>
			  <option value="left center">left center</option>
			  <option value="left bottom">left bottom</option>
			  <option value="right top">right top</option>
			  <option value="right center">right center</option>
			  <option value="right bottom">right bottom</option>
			  <option value="center top">center top</option>
			  <option value="center center">center center</option>
			  <option value="center bottom">center bottom</option>
			  <option value="custom">custom position</option>
			  </select>
	          <p class="help-box">' . _x('The first value is the horizontal position and the second value is the vertical. The top left corner is 0 0. Units can be pixels (0px 0px) or any other CSS units. If you specify only one value, the other value will be 50%. You can mix % and positions', 'Admin Panel Class', $this->textdomain ) . '</p>
		</div>
		
		<div class="dialog-row custom-pos-group" style="display:none">
		<label for="bg-custom-pos">' . _x('Custom', 'Admin Panel Class', $this->textdomain ) . '</label>
		<input type="text" id="bg-custom-pos" name="bg_custom_pos" value="50% 50%" class="image-input"/>
		</div>
		
		<div class="dialog-row">
		<label for="bg-repeat">' . _x('Repeat', 'Admin Panel Class', $this->textdomain ) . '</label>
		      <select name="bg_repeat" id="bg-repeat" size="1" class="bg-repeat">
		      <option value="repeat">repeat</option>
			  <option value="repeat-x">repeat-x</option>
			  <option value="repeat-y">repeat-y</option>
			  <option value="no-repeat">no-repeat</option>
			  </select>
	          <p class="help-box">' . _x('The background-repeat property sets if/how a background image will be repeated. <br/> <strong>repeat</strong> - The background image will be repeated both vertically and horizontally. This is default <br/> <strong>repeat-x</strong> - The background image will be repeated only horizontally <br/> <strong>repeat-y</strong> - The background image will be repeated only vertically <br/> <strong>no-repeat</strong> - The background-image will not be repeated', 'Admin Panel Class', $this->textdomain ) . '</p>
		</div>
		
		<div class="dialog-row">
		<label for="bg-att">' . _x('Attachment', 'Admin Panel Class', $this->textdomain ) . '</label>
		      <select name="bg_attt" id="bg-att" size="1" class="bg-att">
		      <option value="scroll">scroll</option>
			  <option value="fixed">fixed</option>
			  </select>
	          <p class="help-box">' . _x('The background-attachment property sets whether a background image is fixed or scrolls with the rest of the page.', 'Admin Panel Class', $this->textdomain ) . '</p>
		</div>
		
		
		</div>';
		
	    echo '</div>';

	}


	/* Iframe Generator
	---------------------------------------------- */
	private function iframe_generator( $value ) {
		
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}

		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="clear"></div>';
		
      	if ( isset($value['std']) && $value['std'] != '' ) {
      		$display_i = 'display:block;';
			$display_g = 'display:none;';
			$display_d = 'display:inline-block;';
		} else { 
			$display_i = 'display:none;';
			$display_g = 'display:inline-block;';
			$display_d = 'display:none;';
		}

		echo '<div class="iframe-generator-wrap" style="' . $display_i . '">';
		echo '<input type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" class="iframe-generator-input" value="' . stripslashes( $value['std'] ) . '" />';
		echo '</div>';

		echo '<button class="_button generate-iframe" style="' . $display_g . '"><i class="fa icon fa-magic"></i>' . _x('Generate Iframe', 'Admin Panel Class', $this->textdomain ) . '</button>';
		
		echo '<button class="_button ui-button-delete delete-iframe" style="' . $display_d . '"><i class="fa icon fa-trash-o"></i>' . _x('Remove', 'Admin Panel Class', $this->textdomain ) . '</button>';

		echo '<p class="msg msg-error" style="display:none;">' . _x( 'Error: Content does not contain the iframe.', 'Admin Panel Class', $this->textdomain ) . '</p>';
		
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
		
	}
	
	/* Iframe Generator Box */
	private function iframe_generator_box() {
	  
		echo '<div id="_iframe-generator" style="display:none">';
		echo '<input type="hidden" autofocus="autofocus" />';
		echo 
			'<div class="dialog-row">
			<label for="iframe-content">' . _x( 'Iframe Code', 'Admin Panel Class', $this->textdomain ) . '
			</label>';
		echo '<textarea id="iframe-content" name="iframe_content"></textarea>';
		echo '<p class="help-box">' . _x( 'Paste Iframe code here..', 'Admin Panel Class', $this->textdomain ) . '</p></div>';
		echo '</div>';

	}
	

	/* Input: Video
	---------------------------------------------- */
	private function video( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		if ( isset( $value['std'] ) && $value['std'] != '' ) {

			echo '<div class="_video" data-type="' . $value['video_type'] . '" data-id="' . $value['std'] . '" data-width="' . $value['video_width'] . '" data-height="' . $value['video_height'] . '" data-align="left" data-params="' .  $value['params'] . '" data-cover="" style="width:' . $value['video_width'] . 'px;height:' . $value['video_height'] . 'px;"></div>';
		}
		echo '<div class="video-wrap input-group">';
		echo '<span class="input-group-addon"><i class="fa fa-' . $value['video_type'] . '-square"></i></span>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . htmlspecialchars( $value['std'] ) . '" class="video-input"/>';
		echo '</div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Cufon Fonts */	
	function cufon_fonts( $value ) {	
		
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}

		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label>' . $value['name'] . '</label>';
		}

		$i = 0;
		$saved_fonts = explode( '|', $value['std'] );
		
		echo '<div class="hidden" id="cufon-id">' . $value['id'] . '</div>';

		if ( isset($this->cufon_fonts) ) {

        	echo '<ul id="cufon-list">';
		
		//print_r($saved_fonts);
		
			foreach ( $this->cufon_fonts as $font ) {
				
				if ( $i % 2 == 0 ) 
					$classes = 'odd';
				else 
					$classes = '';
				
				/* Get saved fonts */
				if ( is_array( $saved_fonts ) ) {
					foreach ( $saved_fonts as $save_font ) {
						if ( $save_font == $font['file_name'] ) {
							$classes .= ' selected';
						}
					}
				}
				
				echo '<li class="' . $classes . '">';
				echo '<h3 id="cufon-font-' . $i . '">' . $font['name'] . '</h3>';
				echo '<div class="hidden cufon-file-name">' . $font['file_name'] . '</div>';
				echo '<div class="hidden cufon-font-name">' . $font['name'] . '</div>';
				echo '</li>';
				$i++;
			}
		
			echo '</ul>';
		}
		echo '<input id="cufon-fonts" type="hidden" name="' . $value['id'] . '" value="' . $value['std'] . '" />';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}
	
	/* Cufon code */
	function cufon_code( $value ) {	
	
		if ( isset( $this->saved_options[$value['id']] ) ) {
			$value['std'] = $this->saved_options[$value['id']];
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="cufon-code" >' . $value['name'] . '</label>';
		}
		echo '<textarea id="cufon-code" name="' . $value['id'] . '" style="height:' . $value['height'] . 'px">' . $value['std'] . '</textarea>';
		echo '<div id="cufon-tags"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}

	
	/* Export
	---------------------------------------------- */
	private function export( $value ) {	
		
		if ($this->saved_options != false && count($this->saved_options) > 0) {
			$export = base64_encode(serialize($this->saved_options) );
		} else $export = '';
	    
		echo '<div class="box-row clearfix">';
			echo '<label >' . _x( 'Export Data', 'Admin Panel Class', $this->textdomain ) . '</label>';
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
				echo '<label >' . _x( 'Import Data', 'Admin Panel Class', $this->textdomain ) . '</label>';
				echo '<div class="input-wrap"></div>';
				echo '<div class="clear"></div>';
			echo '</div>';
			echo '<button class="_button data-import"><i class="fa fa-upload icon"></i>' . _x( 'Import data', 'Admin Panel Class', $this->textdomain ) . '</button>';
			echo '<div class="help-box">';
				echo _x( 'Click on "Import data" button and paste in the box above previously exported data, and press the save button.', 'Admin Panel Class', $this->textdomain );
			echo '</div>';
		echo '</div>';		
	}


	/* Hidden Field
	---------------------------------------------- */
	private function hidden_field( $value ) {
		echo '<input type="hidden" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . $value['value'] . '"/>';
	}
}
?>