<?php

/* ------------------------------------------------------------------------

	Class: R-Metabox
	Ver. 2.0.2
	Copyright: Rascals Themes
	Web: http://rascals.eu

 ------------------------------------------------------------------------ */

global $r_metabox_fired;

$r_metabox_fired = true;

class R_Metabox {
	
	private $options;
	private $box;
	private $admin_path;
	private $admin_uri;
	private $textdomain;
	

	/* Contruct
	---------------------------------------------- */
	public function __construct( $options, $box ) {

		global $r_metabox_fired;

 		/* Set options */
		$this->options = $options;
		$this->box = $box;

		/* Textdomain */
		$this->textdomain = 'metabox_class';
		if ( isset( $box['textdomain'] ) )
			$this->textdomain = $box['textdomain'];

    	/* Set paths */

		/* Set path */
		if ( $this->box['admin_path'] == '' ) {
			$_path = get_template_directory_uri();
		} else {
			$_path = '';
		}
		$this->admin_path = $_path . $this->box['admin_dir'];

		/* Set URI path */
		if ( $this->box['admin_uri'] == '' ) {
			$_path_uri = get_template_directory();
		} else {
			$_path_uri = '';
		}
		$this->admin_uri = $_path_uri . $this->box['admin_dir'];


		/* --- Scripts --- */
		add_action( 'load-post.php', array( &$this, 'scripts' ) );
		add_action( 'load-post-new.php', array( &$this, 'scripts' ) );


		/* --- Ajax Actions --- */

		/* Easy Link */
		add_action( 'wp_ajax_easy_link_ajax', array( &$this, 'easy_link_ajax' ) );

		/* Thumb Generator */
		add_action( 'wp_ajax_thumb_generator', array( &$this, 'thumb_generator') );

		/* Media Manager - Get data of single item */
		add_action( 'wp_ajax_mm_editor', array( &$this, 'mm_editor') );

		/* Media Manager - Save data of single item */
		add_action( 'wp_ajax_mm_editor_save', array( &$this, 'mm_editor_save') );

		/* Media Manager - Actions */
		add_action( 'wp_ajax_mm_actions', array( &$this, 'mm_actions') );


		/* --- Class Actions --- */

		/* init */
		add_action( 'admin_menu', array( &$this, 'init' ) );

		/* Save post */
		add_action( 'save_post', array( &$this, 'save_postdata' ) );


		/* --- Functions --- */

		/* Resize function */
		if ( ! function_exists( 'mr_image_resize' ) )
			include_once( $this->admin_uri . '/functions/mr-image-resize.php' );

	}


	/* Initialize
	---------------------------------------------- */
	function init() {	
		$this->create();
	}


	/* Admin scripts
	---------------------------------------------- */
	function scripts() {
		global $post;

		/* Get screen object */
		$screen = get_current_screen();
		$page = false;

		/* Checking if a box is also to be displayed on the page */
		if ( in_array( 'page', $this->box['page'] ) )
			$page = true;

		if ( in_array( $screen->post_type, $this->box['page'] ) ) {

			/* Add scripts only on page */
			if ( $page ) {

				// If page exist
				if ( isset( $_GET['post'] ) ) 
					$template_name = get_post_meta( $_GET['post'], '_wp_page_template', true );
		        else 
		        	$template_name = '';

		        if ( $template_name == 'default' || $template_name == '' ) 
		        	$template_name = 'default';

		        // Display a box on the page with selected template
		        if ( in_array( $template_name, $this->box['template'] ) )
		        	$this->add_scripts();
		        
			} else {
				$this->add_scripts();
			}

		}

	}

	private function add_scripts() {

		global $r_metabox_fired;

		/* --- Helper Content --- */

		/* Admin footer */
		if ( $r_metabox_fired ) {
			add_action( 'admin_footer', array( &$this, 'panel_footer' ) );
			$r_metabox_fired = false;
		}


		/* --- Styles and Javascripts --- */

		/* Multiselect */
		wp_enqueue_style( 'multiselect_css', $this->admin_path . '/assets/css/multi-select.css', false, '2013-11-01', 'screen' );
		wp_enqueue_script( 'multiselect_js', $this->admin_path . '/assets/js/jquery.multi-select.js', array( 'jquery' ), '2013-11-01', true );

		/* Media Manager */
		wp_enqueue_style( 'r_media_manager_css', $this->admin_path . '/assets/css/media_manager.css', false, '2013-11-01', 'screen' );
		wp_enqueue_script( 'r_media_manager_js', $this->admin_path . '/assets/js/media_manager.js', array( 'jquery' ), '2013-11-01', true );

		/* Easy Link */
		wp_enqueue_style( 'easy_link_css', $this->admin_path . '/assets/css/easy_link.css', false, '2013-11-01', 'screen' );
		wp_enqueue_script( 'easy_link_js', $this->admin_path . '/assets/js/easy_link.js', array( 'jquery' ), '2013-11-01', true );

		/* Background Generator */
		wp_enqueue_script( 'bg_generator_js', $this->admin_path . '/assets/js/bg_generator.js', array( 'jquery' ), '2013-11-01', true );

		wp_enqueue_script( 'video_generator_js', $this->admin_path . '/assets/js/video_generator.js', array( 'jquery' ), '2013-11-01', true );


		/* Iframe Generator */
		wp_enqueue_script( 'iframe_generator_js', $this->admin_path . '/assets/js/iframe_generator.js', array( 'jquery' ), '2013-11-01', true );

		/* Colorpicker */
		wp_enqueue_script( 'wp-color-picker' );
    	wp_enqueue_style( 'wp-color-picker' );

		/* toggleSwitch */
		wp_enqueue_script( 'toggleswitch_js', $this->admin_path . '/assets/js/jquery-ui.toggleSwitch.js', array( 'jquery' ), '2013-11-01', true );

		/* Thickbox */
	   	wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');

		/* UI */
		wp_enqueue_style( 'ui_css', $this->admin_path . '/assets/css/jquery-ui.css', false, '2013-11-01', 'screen' );

		/* Metabox stylesheet */
		wp_enqueue_style( 'metabox_css', $this->admin_path . '/assets/css/metabox.css', false, '2013-11-01', 'screen' );

		/* Metabox fonts */
		wp_enqueue_style( 'metabox_font', $this->admin_path . '/assets/css/font-awesome.css', false, '2013-11-01', 'screen' );

		/* Metabox javascripts */
		wp_enqueue_script( 'metabox_js', $this->admin_path . '/assets/js/metabox.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog', 'jquery-ui-widget', 'jquery-ui-sortable', 'jquery-ui-droppable', 'jquery-ui-slider', 'jquery-ui-draggable', 'jquery-ui-datepicker'), '2013-11-01', true );

	}


	/* Admin Footer
	---------------------------------------------- */
    function panel_footer() {

		/* Easy Link */
		$this->easy_link_box();

		/* Background Generator */
		$this->bg_generator_box();

		/* Iframe Generator */
		$this->iframe_generator_box();

		/* Media Manager - Edit single item */
		$this->mm_editor_box();

		/* Media Manager - Media explorer */
		$this->mm_explorer_box();
		
		
    }


	/* Create metabox
	---------------------------------------------- */
	private function create() {
		if ( function_exists( 'add_meta_box' ) && is_array( $this->box['template'] ) ) {
			foreach ( $this->box['template'] as $template ) {
				if ( isset( $_GET['post'] ) ) $template_name = get_post_meta( $_GET['post'], '_wp_page_template', true );
		        else $template_name = '';
		
				if ( $template == 'default' && $template_name == '' ) $template_name = 'default';
				else if ($template == 'post') $template = '';
				
				if ( $template == $template_name ) {
					if ( is_array( $this->box['page'] ) ) {
						foreach ( $this->box['page'] as $area ) {	
							if ( $this->box['callback'] == '' ) $this->box['callback'] = 'display';
							
							add_meta_box ( 	
								$this->box['id'], 
								$this->box['title'],
								array( &$this, $this->box['callback'] ),
								$area, $this->box['context'], 
								$this->box['priority']
							);  
						}
					}  
				}
			}
		}
	}


	/* Save metabox
	---------------------------------------------- */
	function save_postdata()  {

		if ( isset( $_POST['post_ID'] ) ) {
			
			$post_id = $_POST['post_ID'];
			
			foreach ( $this->options as $option ) {
				
				/* Verify */
				if ( isset( $_POST[$this->box['id'] . '_noncename'] ) && ! wp_verify_nonce( $_POST[$this->box['id'] . '_noncename'], plugin_basename(__FILE__) ) ) {	
					return $post_id;
				}
				
				if ( 'page' == $_POST['post_type'] ) {
					if ( ! current_user_can( 'edit_page', $post_id ) )
						return $post_id;
				} else {
					if ( ! current_user_can( 'edit_post', $post_id ) )
						return $post_id;
				}
				

				if ( is_array( $option['id'] ) ) {
					foreach ( $option['id'] as $option_id ) {
						if ( isset( $_POST[ $option_id['id'] ] ) ) {
						    $data = $_POST[ $option_id['id'] ];

							if ( get_post_meta( $post_id , $option_id['id'] ) == '' )
								add_post_meta( $post_id, $option_id['id'], $data, true );
							
							elseif ( $data != get_post_meta( $post_id , $option_id['id'], true ) )
								update_post_meta( $post_id, $option_id['id'], $data );
							
							elseif ( $data == '' )
								delete_post_meta( $post_id , $option_id['id'], get_post_meta( $post_id , $option_id['id'], true ) );
					    }
					}
				} else {
					if ( isset( $_POST[ $option['id'] ] ) ) {
						$data = $_POST[ $option['id'] ];

						if ( get_post_meta( $post_id, $option['id']) == '' )
							add_post_meta( $post_id, $option['id'], $data, true );
						
						elseif ( $data != get_post_meta( $post_id, $option['id'], true ) )
							update_post_meta( $post_id, $option['id'], $data );
						
						elseif ( $data == '' )
							delete_post_meta( $post_id, $option['id'], true );
					}
				}
			}
		}
	}


	/* Display metabox
	---------------------------------------------- */
	function display() {	
	
		global $post;
        $count = 1;
		$css_class = '';
		$array_size = count( $this->options );

		foreach ( $this->options as $option ) {
			if ( method_exists( $this, $option['type'] ) ) {
				
				if ( is_array( $option['id'] ) ) {
					foreach ( $option['id'] as $i => $option_id ) {
						$meta_box_value = get_post_meta( $post->ID, $option_id['id'], true );
						if ( isset( $meta_box_value ) && $meta_box_value != '' ) $option['id'][$i]['std'] = $meta_box_value;
						if ( ! isset( $option_id['std'] ) ) $option['id'][$i]['std'] = '';
					}
	
					//var_dump( $option['id'] )
					
			    } else {
					$meta_box_value = get_post_meta( $post->ID, $option['id'], true );
					if ( isset( $meta_box_value ) && $meta_box_value != '' ) $option['std'] = $meta_box_value;
					if ( !isset( $option['std'] ) ) $option['std'] = '';
			    }
				
				/* Groups */
				if ( isset( $option['group_name'] ) ) {
					$group = '';
					foreach ( $option['group_name'] as $group_value ) {

						// strip out all whitespace
						$group_value = preg_replace( '/\s/', '_', $group_value );

						// convert the string to all lowercase
						$group_value = strtolower( $group_value );
					    $group .= ' group-' . $group_value;
					}
					$group .= ' main-group-' . $option['main_group'];
					$style = 'style="display:none"';
				} else { 
					$group = '';
					$style = '';
				}
				
				echo '<div class="r-metabox ' . $group . '" ' . $style . '>';
				call_user_func( array( &$this, $option['type'] ), $option );
				echo '</div>';
				
				$count++;
			}
		}
		
		/* Security field */
		echo'<input type="hidden" name="' . $this->box['id'] . '_noncename" id="' . $this->box['id'] . '_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';  

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


	/* Input: Text
	---------------------------------------------- */
	private function text( $value ) {	
		
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
	private function range( $value ) {	
		
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
		if ( isset( $value['options'] ) ) {
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


	/* Select Image
	---------------------------------------------- */
	private function select_image( $value ) {	
	
		if ( isset( $value['group'] ) && $value['group'] != '' ) {
			$group_class = 'image-group';
			$group_id = $value['group'];
		} else {
			$group_class = '';
			$group_id = '';
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}

		echo '<input type="hidden" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . $value['std'] . '" class="select-image-input"/>';

		echo '<ul data-main-group="main-group-' . $group_id . '" class="select-image ' . $group_class . '">';
		
		foreach( $value['images'] as $image ) {
			
			if ( $value['std'] == $image['id'] ) 
				$selected = 'class="selected-image"';
			else 
				$selected = '';
			echo '<li><img src="' . $image['image'] . '" alt="' . $image['image'] . '" data-image_id="' . $image['id'] . '" ' . $selected . ' /></li>';
		}
		
		echo '</ul>';
		
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Array Select
	---------------------------------------------- */
	private function array_select( $value ) {	
	
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		if ( ! empty( $value['options'] ) && is_array( $value['options'] ) ) {
			echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" size="1" >';
			if ( isset( $value['options'] ) ) {
				foreach ( $value['options'] as $option ) {
					if ( isset( $value['std'] ) && $value['std'] == $option['value'] ) $selected = 'selected="selected"';
					else $selected = '';
					echo "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
				}
			}

			if ( isset( $value['array'] ) && isset( $value['key'] ) ) {
				$custom_array = $value['array'];
				$key = $value['key'];
				if ( is_array( $custom_array ) ) {
					foreach ( $custom_array as $array ) {
						if ( $value['std'] == $array[$key] ) $selected = 'selected="selected"';
						else $selected = '';
						echo "<option $selected value=\"" . $array[$key] . "\">" . $array[$key] . "</option>" . "\n";
					}
				}
			}

			echo '</select>';
		}
		echo '<div class="clear"></div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Multiple Select
	---------------------------------------------- */
	private function multiselect( $value ) {	
		
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


	/* Input: Multiple taxonomy
	---------------------------------------------- */
	private function multi_taxonomy( $value ) {	
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}

		if ( ! isset( $value['term'] ) ) $term = 'name';
		else $term = $value['term'];

		// var_dump($value['std']);
		echo '<select name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" size="6"  class="multiselect">';
		if (isset( $value['options'] ) ) {
			foreach ( $value['options'] as $option ) {
				if ( isset( $value['std'] ) && in_array( $option['value'], $value['std'] )) $selected = 'selected="selected"';
				else $selected = '';
				echo "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
			}
		}

		$args = array(
					  'hide_empty' => false
		 );
		
		if ( taxonomy_exists( $value['taxonomy'] ) ) {
			$taxonomies = get_terms( $value['taxonomy'], $args );
			
			foreach ( $taxonomies as $taxonomy ) {
				
				if ( in_array( $taxonomy->$term, $value['std'] ) ) $selected = 'selected="selected"';
				else $selected = '';
				echo "<option $selected value=\"" . $taxonomy->$term . "\">" . $taxonomy->name . "</option>" . "\n";
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
	
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . htmlspecialchars( $value['std'] ) . '" class="link-input" />';
		echo '<div class="clear"></div>';
		echo '<button class="_button easy-link"><i class="icon fa fa-external-link"></i>' . _x( 'Insert Link', 'Metabox Class', $this->textdomain ) . '</button>';
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

			  	$output .= '<li ' . $odd . '><span class="link-title">' . $result['title'] . '</span><span class="link-info">' . $result['info'] . '</span><span class="permalink mm-hidden">' . $result['permalink'] . '</span><span class="link-id mm-hidden">' . $result['ID'] . '</span></li>';
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
		echo '<span>' . _x( 'Search', 'Metabox Class', $this->textdomain ) . '</span>';
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
		
		// Set button title
		if ( isset( $value['button_title'] ) && $value['button_title'] ) { 
			$button_title = $value['button_title'];
		} else { 
		 	$button_title = _x( 'Add File', 'Metabox Class', $this->textdomain );
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

		/* Set image crop */
		if ( isset( $value['id'][1]['id'] ) && isset( $value['id'][1]['std'] ) )
			$preview_crop = $value['id'][1]['std'];
		else 
			$preview_crop = 'c';

		// Set message
		if ( isset( $value['msg'] ) && $value['msg'] ) { 
			$msg = $value['msg'];
		} else { 
		 	$msg = _x( 'Currently you don\'t have images, you can add them by clicking on the button below.', 'Metabox Class', $this->textdomain );
		}

		if ( ! isset( $value['id'][0]['std'] ) || $value['id'][0]['std'] == '' ) {
			$display = 'block';
			$del_display = 'none';
			$crop_display = 'none';
			$theme_path = false;
		} else {

			if ( strpos( $value['id'][0]['std'], 'THEME_PATH' ) !== false )
				$theme_path = true;
			else
				$theme_path = false;

			$del_display = 'inline-block';
			$crop_display = 'table';
			$display = 'none';
		}
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label>' . $value['name'] . '</label>';
		}

		// Input
		echo '<input type="' . $input_type . '" value="' . $value['id'][0]['std'] . '" id="' . $value['id'][0]['id'] . '" name="' . $value['id'][0]['id'] . '" class="image-input"/>';
		echo '<div class="image-holder" data-width="' . $value['width'] . '" data-height="' . $value['height'] . '" data-crop="' . $value['crop'] . '" data-get_url="' . $get_url . '">';

		/* Image preview */
		if ( isset( $value['id'][0]['std'] ) && $value['id'][0]['std'] != '' && $theme_path == false ) {

				// By ID
				if ( $by_id ) {

					// Get image data
					$image = wp_get_attachment_image_src( $value['id'][0]['std'] );
				} else {
					$image = $this->image_exists( $value['id'][0]['std'] );
				}

				// If image exists
				if ( $image ) {
					echo '<img src="' . $this->image_resize($value['width'], $value['height'], $value['id'][0]['std'], $preview_crop) . '" alt=" ' . $value['id'][0]['std'] . ' ">';
				} else {
					$display = 'block';
					$del_display = 'none';
					$crop_display = 'none';
				}

		}
		echo '</div>';

		/* Crop */
		if ( isset( $value['id'][1]['id'] ) && $theme_path == false ) {
	  
			echo '<div class="image-crop-wrap input-group" style="display:' . $crop_display . '">';
			echo '<span class="input-group-addon"><i class="fa fa-crop"></i></span>';
			echo '<select name="' . $value['id'][1]['id'] . '" id="' . $value['id'][1]['id'] . '" size="1" class="image-crop" >';
			$options = array(
				array('name' => 'Center', 'value' => 'c'),
				array('name' => 'Top', 'value' => 't'),
				array('name' => 'Top right', 'value' => 'tr'),
				array('name' => 'Top left', 'value' => 'tl'),
				array('name' => 'Bottom', 'value' => 'b'),
				array('name' => 'Bottom right', 'value' => 'br'),
				array('name' => 'Bottom left', 'value' => 'bl'),
				array('name' => 'Left', 'value' => 'l'),
				array('name' => 'Right', 'value' => 'r')
				);
			foreach ( $options as $option ) {
				
				if ( $value['id'][1]['std'] == $option['value'] ) $selected = 'selected="selected"';
				else $selected = '';
				echo "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
			}
			echo '</select></div>';
		}

		// Message
		echo '<div class="msg-dotted" style="display:' . $display . '">' . $msg . '</div>';

		if ( $theme_path == true )
			echo '<p class="msg msg-info">' . _x( 'You are using an image only for a preview. Select new image and save settings.', 'Metabox Class', $this->textdomain ) . '</p>';

		echo '<p class="msg msg-error" style="display:none">' . _x( 'The link is incorrect or the image does not exist.', 'Metabox Class', $this->textdomain ) . '</p>';
			
		// Button
		echo '<button class="_button upload-image" style="display:' . $display . '"><i class="fa icon fa-plus"></i>' . $button_title . '</button>';

		echo '<button class="_button ui-button-delete delete-image" style="display:' . $del_display . '"><i class="fa icon fa-trash-o"></i>' . _x( 'Remove', 'Metabox Class', $this->textdomain ) . '</button>';

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


	/* Input: Datepicker
	---------------------------------------------- */
	private function datepicker( $value ) {	
		
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


	/* Input: Date Range
	---------------------------------------------- */
	private function date_range( $value ) {	
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'][0]['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="date-range-wrap">';
		// Start
		echo '<div class="input-group date-range-start">';
		echo '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
		echo '<input name="' . $value['id'][0]['id'] . '" id="' . $value['id'][0]['id'] . '" type="text" value="' . htmlspecialchars( $value['id'][0]['std'] ) . '" class="datepicker-input"/>';
		echo '</div>';
		// End
		echo '<div class="input-group date-range-end">';
		echo '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
		echo '<input name="' . $value['id'][1]['id'] . '" id="' . $value['id'][1]['id'] . '" type="text" value="' . htmlspecialchars( $value['id'][1]['std'] ) . '" class="datepicker-input"/>';
		echo '</div>';
		echo '</div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Input: Time Range
	---------------------------------------------- */
	private function time_range( $value ) {	
		
		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'][0]['id'] . '" >' . $value['name'] . '</label>';
		}
		echo '<div class="time-range-wrap">';
		// Start
		echo '<div class="input-group time-range-start">';
		echo '<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>';
		echo '<input name="' . $value['id'][0]['id'] . '" id="' . $value['id'][0]['id'] . '" type="text" value="' . htmlspecialchars( $value['id'][0]['std'] ) . '" class="timepicker-input"/>';
		echo '</div>';
		// End
		echo '<div class="input-group time-range-end">';
		echo '<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>';
		echo '<input name="' . $value['id'][1]['id'] . '" id="' . $value['id'][1]['id'] . '" type="text" value="' . htmlspecialchars( $value['id'][1]['std'] ) . '" class="timepicker-input"/>';
		echo '</div>';
		echo '</div>';
		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* Background Generator
	---------------------------------------------- */
	private function bg_generator( $value ) {	

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
		echo '<button class="_button generate-bg" style="' . $display_g . '"><i class="fa icon fa-magic"></i>' . _x('Generate Background', 'Metabox Class', $this->textdomain ) . '</button>';
		
		echo '<button class="_button ui-button-delete delete-bg" style="' . $display_d . '"><i class="fa icon fa-trash-o"></i>' . _x('Remove', 'Metabox Class', $this->textdomain ) . '</button>';
		
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
		      <label for="bg-type">' . _x('Background Type', 'Metabox Class', $this->textdomain ) . '</label>
		      <select name="bg_type" id="bg-type" size="1" class="bg-type">
			  <option value="empty"></option>
		      <option value="none">None</option>
			  <option value="color">Color</option>
			  <option value="image">Image</option>
			  </select>
	          <p class="help-box">' . _x('Select background type.', 'Metabox Class', $this->textdomain ) . '</p>
			  </div>';
		
		/* Color */
		echo '
		<div class="color-group" style="display:none">
		<div class="dialog-row">
		<label for="bg-color">' . _x('Color', 'Metabox Class', $this->textdomain ) . '</label>
		<label for="bg-color-transparent" class="checkbox-label">' . _x('Transparent: ', 'Metabox Class', $this->textdomain ) . ' <input type="checkbox" id="bg-color-transparent" name="bg_color_transparent" value="" /></label>
		<div class="clear"></div>
		<input type="text" id="bg-color" name="bg_color" value="#ffffff" class="colorpicker-input"/>
		<div class="clear"></div>
		<p class="help-box">' . _x('Select background color.', 'Metabox Class', $this->textdomain ) . '</p>
		</div>
		</div>';
		
		/* File */
		$hidden_class = 'r-hidden';
		echo '
		<div class="dialog-row file-group" style="display:none">
		
		<div class="dialog-row">
		<label for="bg-file">' . _x('File URL ', 'Metabox Class', $this->textdomain ) . '</label>
		<input type="text" id="bg-file" name="bg_file" value="http://" class="image-input" onBlur="if (this.value == \'\') this.value = \'http://\'" onFocus="if (this.value == \'http://\') this.value = \'\';"/>
		
		<div class="image-holder" data-width="150" data-height="80" data-crop="80" data-get_url="true">
		
		</div>

		<p class="msg msg-error" style="display:none">' . _x( 'The link is incorrect or the image does not exist.', 'Metabox Class', $this->textdomain ) . '</p>

		<button class="_button upload-image"><i class="fa icon fa-plus"></i>' . _x( 'Add File', 'Metabox Class', $this->textdomain ) . '</button>
		<button class="_button ui-button-delete delete-image" style="display:none"><i class="fa icon fa-trash-o"></i>' . _x( 'Remove', 'Metabox Class', $this->textdomain ) . '</button>
		<img class="ajax-loader" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="Loading..." style="display:none" />
		<p class="help-box">' . _x('Enter image URL for your background.', 'Metabox Class', $this->textdomain ) . '</p>
		</div>
		<div class="dialog-row">
		<label for="bg-pos">' . _x('Position', 'Metabox Class', $this->textdomain ) . '</label>
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
	          <p class="help-box">' . _x('The first value is the horizontal position and the second value is the vertical. The top left corner is 0 0. Units can be pixels (0px 0px) or any other CSS units. If you specify only one value, the other value will be 50%. You can mix % and positions', 'Metabox Class', $this->textdomain ) . '</p>
		</div>
		
		<div class="dialog-row custom-pos-group" style="display:none">
		<label for="bg-custom-pos">' . _x('Custom', 'Metabox Class', $this->textdomain ) . '</label>
		<input type="text" id="bg-custom-pos" name="bg_custom_pos" value="50% 50%" class="image-input"/>
		</div>
		
		<div class="dialog-row">
		<label for="bg-repeat">' . _x('Repeat', 'Metabox Class', $this->textdomain ) . '</label>
		      <select name="bg_repeat" id="bg-repeat" size="1" class="bg-repeat">
		      <option value="repeat">repeat</option>
			  <option value="repeat-x">repeat-x</option>
			  <option value="repeat-y">repeat-y</option>
			  <option value="no-repeat">no-repeat</option>
			  </select>
	          <p class="help-box">' . _x('The background-repeat property sets if/how a background image will be repeated. <br/> <strong>repeat</strong> - The background image will be repeated both vertically and horizontally. This is default <br/> <strong>repeat-x</strong> - The background image will be repeated only horizontally <br/> <strong>repeat-y</strong> - The background image will be repeated only vertically <br/> <strong>no-repeat</strong> - The background-image will not be repeated', 'Metabox Class', $this->textdomain ) . '</p>
		</div>
		
		<div class="dialog-row">
		<label for="bg-att">' . _x('Attachment', 'Metabox Class', $this->textdomain ) . '</label>
		      <select name="bg_attt" id="bg-att" size="1" class="bg-att">
		      <option value="scroll">scroll</option>
			  <option value="fixed">fixed</option>
			  </select>
	          <p class="help-box">' . _x('The background-attachment property sets whether a background image is fixed or scrolls with the rest of the page.', 'Metabox Class', $this->textdomain ) . '</p>
		</div>
		
		
		</div>';
		
	    echo '</div>';

	}


	/* Iframe Generator
	---------------------------------------------- */
	private function iframe_generator( $value ) {
		
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

		echo '<button class="_button generate-iframe" style="' . $display_g . '"><i class="fa icon fa-magic"></i>' . _x('Generate Iframe', 'Metabox Class', $this->textdomain ) . '</button>';
		
		echo '<button class="_button ui-button-delete delete-iframe" style="' . $display_d . '"><i class="fa icon fa-trash-o"></i>' . _x('Remove', 'Metabox Class', $this->textdomain ) . '</button>';

		echo '<p class="msg msg-error" style="display:none;">' . _x( 'Error: Content does not contain the iframe.', 'Metabox Class', $this->textdomain ) . '</p>';
		
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
			<label for="iframe-content">' . _x( 'Iframe Code', 'Metabox Class', $this->textdomain ) . '
			</label>';
		echo '<textarea id="iframe-content" name="iframe_content"></textarea>';
		echo '<p class="help-box">' . _x( 'Paste Iframe code here..', 'Metabox Class', $this->textdomain ) . '</p></div>';
		echo '</div>';

	}


	/* Input: Video
	---------------------------------------------- */
	private function video( $value ) {	
		
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


	/* Media Manager
	---------------------------------------------- */

	/* Preview */
	private function media_manager( $value ) {	
		
		global $post;

		echo '<div class="box-row clearfix">';
		if ( isset( $value['name'] ) && ( $value['name'] != '' ) ) {	
			echo '<label for="' . $value['id'] . '" >' . $value['name'] . '</label>';
		}
		
		if ( ! isset( $value['std'] ) || $value['std'] == '') 
			$no_images = 'block';
		else 
			$no_images = 'none';

		/* Select All Items */
		echo '<span class="mm-select-all">select all</span>';
		echo '<div class="clear"></div>';

		// Texts
		if ( isset( $value['btn_text'] ) && $value['btn_text'] != '' ) 
			$btn_text = $value['btn_text'];
		else 
			$btn_text = _x('Add Images', 'Metabox Class', $this->textdomain );
		if ( isset( $value['msg_text'] ) && $value['msg_text'] != '' ) 
			$msg_text = $value['msg_text'];
		else 
			$msg_text = _x('Currently slider does not have images, you can add them by clicking on button below.', 'Metabox Class', $this->textdomain );
		
		/* Message */
		echo '<div class="msg-dotted" style="display:' . $no_images . '">' . $msg_text . '</div>';

		/* Settings */
		echo '<span class="mm-settings mm-hidden" data-post-id="' . $post->ID . '" data-mm-id="' . $value['id'] . '" data-mm-type="' . $value['media_type'] . '" data-mm-admin-path="' . $this->admin_path . '"></span>';

		/*  Hidden input */
		echo '<input type="hidden" value="' . $value['std'] . '" id="' . $value['id'] . '" name="' . $value['id'] . '" class="mm-ids"/>';

		/* Preview */
		echo '<div class="mm-wrap">';
		

		/* Preview Items */
		if ( isset( $value['std'] ) && $value['std'] != '' ) {

			$items = explode('|', $value['std'] );
			foreach( $items as $id ) {

			/* Image */
			if ( $value['media_type'] == 'images' || $value['media_type'] == 'slider' ) {

				$image = wp_get_attachment_image_src( $id );

				if ( $image ) {
					echo '
					<div class="mm-item" id="' . $id . '">
						<div class="mm-item-preview">
					    	<div class="mm-item-image">
					    		<div class="mm-centered">
					    			<img src="' . $image[0] . '" />
					    		</div>
					    	</div>
						</div>
						<span class="mm-edit-button"><i class="fa fa-gear"></i></span>
					</div>';
				} else {
					echo '
					<div class="mm-item mm-audio" id="' . $id . '">
						<div class="mm-item-preview">
					    	<div class="mm-filename"><div>' . _x( 'Error: Image file doesn\'t exists.', 'Metabox Class', $this->textdomain ) . '</div></div>
						</div>
					</div>';
				}
			}

			/* Audio */
			if ( $value['media_type'] == 'audio' ) {

				/* If custom id */
				$audio = get_post( $id );
				$track = false;

				if ( $audio ) {

					/* This is not custom audio */
					$track = get_post_meta( $post->ID, $value['id'] . '_' . $id, true );
					if ( ! isset( $track['title'] ) ) 
						$track['title'] = $audio->post_title;
				} else {

					$track = get_post_meta( $post->ID, $value['id'] . '_' . $id, true );
					/* Check custom track */
					if ( isset( $track['custom_url'] ) ) 
						$audio = true;
				}

				if ( $audio ) {
					echo '
						<div class="mm-item mm-audio" id="' . $id . '">
							<div class="mm-item-preview">
						    	<img src="' . $this->admin_path . '/assets/images/metabox/audio.png" class="mm-audio-icon" />
						    	<div class="mm-filename"><div>' . $track['title'] . '</div></div>
							</div>
							<span class="mm-edit-button"><i class="fa fa-gear"></i></span>
						</div>';
					} else {
					echo '
						<div class="mm-item mm-audio" id="' . $id . '">
							<div class="mm-item-preview">
						    	<div class="mm-filename"><div>' . _x( 'Error: Audio file doesn\'t exists.', 'Metabox Class', $this->textdomain ) . '</div></div>
							</div>
						</div>';
					}

				}
	     	}	
		}
		echo '</div>';

		/* Error message */
		echo '<p class="msg msg-error" style="display:none;">' . _x( 'Error: AJAX Transport', 'Metabox Class', $this->textdomain ) . '</p>';

		/* Buttons */

		/* Explorer */
		echo '<button class="_button mm-explorer-button"><i class="fa icon fa-plus"></i>' . $btn_text . '</button>';

		/* Add custom audio */
		if ($value['media_type'] == 'audio') echo '<button class="_button mm-custom-audio"><i class="fa icon fa-plus"></i>' . _x( 'Add Custom Track', 'Metabox Class', $this->textdomain ) . '</button>';

		/* Delete */
		echo '<button class="_button ui-button-delete mm-delete-button" style="display:none"><i class="fa icon fa-trash-o"></i>' . _x( 'Remove Selected', 'Metabox Class', $this->textdomain ) . '</button>';

		/* Ajax loader */
		echo '<img class="mm-ajax" src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" alt="Loading..." />';

		echo '<div class="help-box">';
		echo $value['desc'];
		echo '</div>';
		echo '</div>';
	}


	/* ----- Dialog Boxes ----- */

	/* mm Box */
	function mm_explorer_box() {
	  
		echo '<div id="mm-explorer-box" style="display:none">';
		echo '<input type="hidden" autofocus="autofocus" />';
		echo '<div id="explorer-top">';
		echo '<label for="mm-search">';
		//echo '<span>' . _x(' Search:', 'Metabox Class', $this->textdomain ) . '</span>';
		echo '<input type="text" id="mm-search" name="mm-search" tabindex="60" autocomplete="off" value="" placeholder="' . _x( 'Search', 'Metabox Class', $this->textdomain ) . '" />';
		echo '</label>';
		echo '<label for="mm-select" class="mm-label-select">';
		echo '<span>' . _x( 'Select All:', 'Metabox Class', $this->textdomain ) . '</span>';
		echo '<input type="checkbox" id="mm-select" name="mm-select"/>';
		echo '</label>';
		echo '<img id="mm-explorer-loader" class="mm-ajax" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="" />';
		echo '</div>';
		
		/* Results */
		echo '<div class="mm-wrap">';
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '<span class="mm-load-next">' . _x( 'Load Next 30 Items', 'Metabox Class', $this->textdomain ) . '</span>';

		echo '</div>';

	}

	/* Item Details */
	function mm_editor_box() {
	  
	    echo '<div id="mm-editor-box" style="display:none">';
	    echo '<input type="hidden" autofocus="autofocus" />';
		echo '<img id="mm-editor-loader" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="" />';
		echo '<div id="mm-editor-content">';

		echo '</div>';
	    echo '</div>';
	}


	/* ----- Helper functions ----- */

	/* mm query */
	function mm_query( $args = array() ) {

		/* Media Manager type */
		if ( $args['type'] == 'images' || $args['type'] == 'slider'  ) 
			$args['type'] = 'image';
		else 
			$args['type'] = 'audio';

		$query = array(
			'post_type'      => 'attachment',
			'order'          => 'DESC',
			'orderby'        => 'post_date',
			'post_status'    => null,
			'post_parent'    => null, // any parent
			'post_mime_type' => $args['type'],
			'numberposts'    => $args['numberposts']
		);
	    
		if ( isset( $args['ids'] ) ) 
			$query['exclude'] = $args['ids'];
		
		$args['pagenum'] = isset( $args['pagenum']) ? absint( $args['pagenum'] ) : 1;

		if ( isset( $args['s'] ) ) $query['s'] = $args['s'];

		$query['offset'] = $args['pagenum'] > 1 ? $query['numberposts'] * ($args['pagenum'] - 1) : 0;

		// Do main query.
		$posts = get_posts( $query );

		// Check if any posts were found.
		if ( ! $posts )
			return false;

		// Build results.
		$results = array();
		foreach ( $posts as $post ) {
			setup_postdata( $post ); 
			$results[] = array(
				'ID' => $post->ID,
				'image' => wp_get_attachment_image_src( $post->ID ),
				'title' => trim( esc_html( strip_tags( get_the_title( $post) ) ) ),
				'permalink' => get_permalink( $post->ID )
			);
		}
		return $results;
	}


	/* ----- Ajax functions ----- */


	/* Save item data */
	function mm_editor_save() {
		
		/* Variables */
		$fields = $_POST['fields'];
		$settings = $_POST['settings'];
		$id = $_POST['item_id'];
		$output = '';
		$response = 'success';

		/* Update attachment audio title */
		if ( $settings['mm_type'] == 'audio' && $fields['title'] != '' ) {
			$response = $fields['title'];
		}

		$option_name = $settings['mm_id'] . '_' . $id;
		$options = get_post_meta($settings['post_id'], $option_name , true);
		
		if ( ! isset( $fields ) && is_array( $fields ) || ! isset( $settings ) ) 
			die();
		
		if ( update_post_meta( $settings['post_id'], $option_name, $fields ) )
	        echo $response;
		else
		    echo 'error';
	   exit;
	}


	/* Media Manager - Ajax Actions */
	function mm_actions() {
		
		$action = $_POST['mm_action'];
		$output = '';

		if ( ! isset( $_POST['action'] ) ) {
			exit;
			echo $output = 'Error - Not set action';
		}


		/* --- Media Explorer --- */
		if ( $action == 'media_explorer' ) {

			/* Variables */
			$pagenum = $_POST['page_num'];
		    $args = array();
		    $args['pagenum'] = $pagenum;
		    $args['numberposts'] = $_POST['numberposts'];
		    $output = '';

			if ( isset( $_POST['type'] ) ) 
				$args['type'] = $_POST['type'];
			else 
				$args['type'] = 'images';

			if ( isset( $_POST['ids'] ) && is_array( $_POST['ids'] ) ) {
				$args['ids'] = $_POST['ids'];
			}
			if ( isset( $_POST['s'] ) && $_POST['s'] != '' ) 
				$args['s'] = stripslashes( $_POST['s'] );
			
			$results = $this->mm_query( $args );

			if ( ! isset( $results ) ) die();
			
		    $output = '';
			if ( ! empty( $results ) ) {
				foreach ( $results as $i => $result ) {

					/* Images */
					if ( $args['type'] == 'images' || $args['type'] == 'slider' ) {
						$output .= '
						<div class="mm-item" id="' . $result['ID'] . '">
							<div class="mm-item-preview">
						    	<div class="mm-item-image">
						    		<div class="mm-centered">
						    			<img src="' . $result['image'][0] . '" />
						    		</div>
						    	</div>
							</div>
						</div>';


					/* Audio */
					} else {
						$output .= '
						<div class="mm-item mm-audio" id="' . $result['ID'] . '">
							<div class="mm-item-preview">
						    	<img src="' . $this->admin_path . '/assets/images/metabox/audio.png" class="mm-audio-icon" />
						    	<div class="mm-filename"><div>' . $result['title'] . '</div></div>
							</div>
						</div>';
					}
				}
			} else {
				$output = 'end pages';
			}

		    echo $output;
		    exit;
		}


		/* --- Add Media --- */
		if ( $action == 'add_media' ) {

			/* Variables */
			$items = $_POST['items'];
			$type = $_POST['type'];

			if ( ! isset( $items ) || empty( $items ) ) 
				die();
			if ( isset( $type ) ) {
				if ( $type == 'images' || $type == 'slider' ) 
					$type = 'image';
				else 
					$type = 'audio';
			}

			$output = '';
			foreach( $items as $id ) {

				/* Image */
				if ( $type == 'image' ) {
					$image = wp_get_attachment_image_src( $id );
					$output .= '
					<div class="mm-item" id="' . $id . '">
	                	<div class="mm-item-preview">
		                	<div class="mm-item-image">
		                		<div class="mm-centered">
		                			<img src="' . $image[0] . '" />
		                		</div>
		                	</div>
	                	</div>
	                	<span class="mm-edit-button"><i class="fa fa-gear"></i></span>
	                </div>';
				}

				/* Audio */
				if ( $type == 'audio' ) {
					$audio = get_post( $id );
					$output .= '
					<div class="mm-item mm-audio" id="' . $id . '">
						<div class="mm-item-preview">
					    	<img src="' . $this->admin_path . '/assets/images/metabox/audio.png" class="mm-audio-icon" />
					    	<div class="mm-filename"><div>' . $audio->post_title . '</div></div>
						</div>
						<span class="mm-edit-button"><i class="fa fa-gear"></i></span>
					</div>';
				}
			}

			echo $output;
			exit;
		}


		/* --- Remove Media --- */
		if ( $action == 'remove_media' ) {

			/* Variables */
			$settings = $_POST['settings'];
			$selected_ids = $_POST['selected_ids'];
			$output = '';

			if ( ! isset( $selected_ids ) || empty( $selected_ids ) ) 
				die();
			if ( ! isset( $settings ) ) 
				die();

			foreach ( $selected_ids as $id ) {
				$option_name = $settings['mm_id'] . '_' . $id;
				
				if ( get_post_meta( $settings['post_id'], $option_name ) ) {
					delete_post_meta( $settings['post_id'], $option_name );
				}

			}
			echo 'success';
			exit;
		}


		/* --- Update Media --- */
		if ( $action == 'update_media' ) {

			/* Variables */
			$settings = $_POST['settings'];
			$ids = $_POST['ids'];
			$output = '';
			
			if ( ! isset( $settings ) ) 
				die();

			/* Update post string */
			if ( ! isset( $ids ) || $ids == '' )
				delete_post_meta( $settings['post_id'], $settings['mm_id'] );
			else
		    	update_post_meta( $settings['post_id'], $settings['mm_id'], $ids );
		  	
			echo 'success';
		   	exit;
		}

		echo 'Error: Bad action';
		exit;
	}


	/* Get item data -------------------------------------------- */

	function mm_editor() {
		
		/* Variables */
		$id = $_POST['item_id'];
		$settings = $_POST['settings'];
		$custom = ($_POST['custom'] === 'true');
		if ( ! isset( $id ) || ! isset( $settings ) ) 
			die();
		$type = $settings['mm_type'];
		$item = get_post( $id );
		$output = '';
		$option_name = $settings[ 'mm_id' ] . '_' . $id;
		$options = get_post_meta( $settings[ 'post_id' ], $option_name, true );

		/* Audio defaults */
		if ( $type == 'audio' ) {
			$defaults = array(
				'custom' => $custom,
				'custom_url' => '',
				'title' => '',
				'desc' => '',
				'buttons' => '',
				'volume' => '100'
			);
		}

		/* Image defaults */
	  	if ( $type == 'images' ) {
		   	$defaults = array(
				'custom' => $custom,
				'title' => '',
				'desc' => '',
				'crop' => 'c',
				'image_type' => 'image',
				'lightbox_image' => '',
				'lightbox_video' => '',
				'lightbox_soundcloud' => '',
				'custom_link' => '',
				'iframe_code' => ''
			);
	   	}

	   	/* Slider defaults */
	  	if ( $type == 'slider' ) {
		   	$defaults = array(
				'custom' => $custom,
				'title' => '',
				'desc' => '',
				'crop' => 'c',
				'image_type' => 'image',
				'lightbox_image' => '',
				'lightbox_video' => '',
				'lightbox_soundcloud' => '',
				'custom_link' => '',
				'iframe_code' => ''
			);
	   	}

	   	/* Set default options */
		if ( isset( $options ) && is_array( $options ) ) 
			$options = array_merge( $defaults, $options );
		else 
			$options = $defaults;

		if ( ! $item && ! $options['custom'] ) {
				echo '<p class="msg msg-error">' . _x(' Error: File does not exist!', 'Metabox Class', $this->textdomain ) . '</p>';
			exit;
			return die();
		}

		/* Meta */

		/* --- IMAGES OR SLIDER --- */
		if ( $type == 'images' || $type == 'slider' ) {

			/* Get Image Data */
			$meta = wp_get_attachment_metadata( $id );
			$image_data = wp_get_attachment_image_src( $id );

			$output .= '
				<div class="mm-item mm-item-editor" id="' . $id . '">
					<div class="mm-item-preview">
				    	<div class="mm-item-image">
				    		<div class="mm-centered">
				    			<a href="' . $item->guid . '" target="_blank"><img src="' . $image_data[0] . '" /></a>
				    		</div>
				    	</div>
					</div>
				</div>';
			
			/* Meta */
			$output .= '<div id="mm-editor-meta">';
			$output .= '<span><strong>' . _x(' File name:', 'Metabox Class', $this->textdomain ) . '</strong> ' . esc_html( basename( $item->guid ) ) . '</span>';
			$output .= '<span><strong>' . _x(' File type:', 'Metabox Class', $this->textdomain ) . '</strong> ' . $item->post_mime_type . '</span>';
			$output .= '<span><strong>' . _x(' Upload date:', 'Metabox Class', $this->textdomain ) . '</strong> ' . mysql2date( get_option( 'date_format' ), $item->post_date ) . '</span>';

			if ( is_array( $meta ) && array_key_exists( 'width', $meta ) && array_key_exists('height', $meta ) )
				$output .= '<span><strong>' . _x(' Dimensions:', 'Metabox Class', $this->textdomain ) . '</strong> ' . $meta['width'] . ' x ' . $meta['height'] . '</span>';

			$output .= '<span><strong>' . _x(' Image URL:', 'Metabox Class', $this->textdomain ) . '</strong> <br>
			<a href="' . $item->guid . '" target="_blank">' . $item->guid . '</a>
			</span>';

			$output .= '</div>';

		}

		/* --- Make Form --- */

		/* --- IMAGES --- */
		if ( $type == 'images' || $type == 'slider' ) {
			
			// Default ightbox link
			if ( $options['lightbox_image'] == '' ) 
				$options['lightbox_image'] = $item->guid;
			
			$output .= '<fieldset>';
			
			/* Title */
		   	$output .= '<div class="dialog-row"><label for="mm-image-title">' . _x(' Title', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<input type="text" id="mm-image-title" name="title" value="' . $options['title'] . '" />';
			$output .= '<p class="help-box">' . _x(' Title for the image.', 'Metabox Class', $this->textdomain ) . '</p></div>';
			
			/* Decription */
			$output .= '<div class="dialog-row"><label for="mm-image-desc">' . _x(' Description', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<textarea id="mm-image-desc" name="desc">'. $options['desc'] .'</textarea>';
			$output .= '<p class="help-box">' . _x(' Short description of the image.', 'Metabox Class', $this->textdomain ) . '</p></div>';
			
			/* Crop */
			$output .= '<div class="dialog-row"><label for="mm-image-crop">' . _x(' Image Crop', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<select name="crop" id="mm-image-crop" size="1" class="r-meta-select">';
			$select_options = array(
									array('name' => 'Center', 'value' => 'c'),
									array('name' => 'Top', 'value' => 't'),
									array('name' => 'Top right', 'value' => 'tr'),
									array('name' => 'Top left', 'value' => 'tl'),
									array('name' => 'Bottom', 'value' => 'b'),
									array('name' => 'Bottom right', 'value' => 'br'),
									array('name' => 'Bottom left', 'value' => 'bl'),
									array('name' => 'Left', 'value' => 'l'),
									array('name' => 'Right', 'value' => 'r')
									);
			foreach( $select_options as $option ) {
				
				if ( $options['crop'] == $option['value'] ) 
					$selected = 'selected="selected"';
				else 
					$selected = '';
				$output .= "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
			}
			$output .= '</select>';
			$output .= '<p class="help-box">' . _x(' Cropping Alignment/Positioning for the image.', 'Metabox Class', $this->textdomain ) . '</p></div>';
			unset( $select_options );
			
			/* Image type */
			$output .= '<div class="dialog-row"><label for="mm-image-type">' . _x(' Image Type', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<select name="image_type" id="mm-image-type" size="1" data-main-group="mm-main-group-image-type" class="mm-select mm-group">';
			$select_options = array(
							  array('name' => 'Image', 'value' => 'image'),
							  array('name' => 'Image Lightbox', 'value' => 'lightbox_image'),
							  array('name' => 'Video lightbox', 'value' => 'lightbox_video'),
							  array('name' => 'Soundcloud lightbox', 'value' => 'lightbox_soundcloud'),
							  array('name' => 'Custom link', 'value' => 'custom_link'),
							  array('name' => 'Custom link in new window', 'value' => 'custom_link_blank'),
							 );
			foreach ( $select_options as $option ) {
				
				if ( $options['image_type'] == $option['value'] ) 
					$selected = 'selected="selected"';
				else 
					$selected = '';
				$output .= "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
			}
			$output .= '</select>';
			$output .= '<p class="help-box">' . _x(' Select image type.', 'Metabox Class', $this->textdomain ) . '</p></div>';
			unset( $select_options );
			
			/* Lightbox */
			$output .= '
			<div class="dialog-row mm-group-lightbox_image mm-main-group-image-type" style="display:none">
				<label for="mm-image-lightbox">' . _x(' Lightbox Link', 'Metabox Class', $this->textdomain ) . '</label>
				<input type="text" id="mm-image-lightbox" name="lightbox_image" value="' . $options['lightbox_image'] . '" />
				<p class="help-box">' . _x(' Paste the full URL (include http://) of your image you would like to use for jQuery lightbox pop-up effect.', 'Metabox Class', $this->textdomain ) . '</p>
			</div>';
			
			/* Lightbox video */
			$output .= '
			<div class="dialog-row mm-group-lightbox_video mm-main-group-image-type" style="display:none">
				<label for="r-video-lightbox">' . _x(' Video Code', 'Metabox Class', $this->textdomain ) . '</label>
				<textarea id="r-video-lightbox" name="lightbox_video" style="height:50px">'. stripslashes( $options['lightbox_video'] ) .'</textarea>
				<p class="help-box">' . _x(' Paste video embed code (iframe).', 'Metabox Class', $this->textdomain ) . '
			</div>';

			/* Lightbox Souncloud */
			$output .= '
			<div class="dialog-row mm-group-lightbox_soundcloud mm-main-group-image-type" style="display:none">
				<label for="mm-soundcloud-lightbox">' . _x(' Soundcloud Code', 'Metabox Class', $this->textdomain ) . '</label>
				<textarea id="mm-sound-lightbox" name="lightbox_soundcloud" style="height:50px">'. stripslashes( $options['lightbox_soundcloud'] ) .'</textarea>
				<p class="help-box">' . _x(' Paste Soundcloud embed code (iframe).', 'Metabox Class', $this->textdomain ) . '
				</p>
			</div>';
			
			/* Custom Link */
			$output .= '
			<div class="dialog-row mm-group-custom_link mm-group-custom_link_blank mm-main-group-image-type" style="display:none">
				<label for="mm-image-custom-link">' . _x(' Custom Link', 'Metabox Class', $this->textdomain ) . '</label>
				<input type="text" id="mm-image-custom-link" name="custom_link" value="' . $options['custom_link'] . '" />
				<p class="help-box">' . _x(' Paste the full URL (include http://).', 'Metabox Class', $this->textdomain ) . '</p>
			</div>';

			$output .='<input type="hidden" id="iframe_code" name="iframe_code" value="' . $options['iframe_code'] . '"/>';

			$output .= '</fieldset>';
		}

		
		/* --- Audio --- */
		if ( $type == 'audio' ) {
			
			$output .= '<fieldset>';

			/* Title */
			if ( $options['title'] == '' && ! $options['custom'] ) 
				$options['title'] = $item->post_title;
			if ( $options['title'] == '' ) 
				$options['title'] = _x(' Custom title', 'Metabox Class', $this->textdomain );

		   $output .= '<div class="dialog-row"><label for="mm-audio-title">' . _x(' Title', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<input type="text" id="mm-audio-title" name="title" value="' . $options['title'] . '" />';
			$output .= '<p class="help-box">' . _x(' Title for the audio.', 'Metabox Class', $this->textdomain ) . '</p></div>';

			/* Custom url */
			if ( $options['custom'] ) {
			   $output .= '<div class="dialog-row"><label for="mm-audio-custom-url">' . _x(' URL', 'Metabox Class', $this->textdomain ) . '</label>';
				$output .= '<input type="text" id="mm-audio-custom-url" name="custom_url" value="'.$options['custom_url'].'" />';
				$output .= '<p class="help-box">' . _x(' Paste here link to the MP3 file or link to the radio stream.', 'Metabox Class', $this->textdomain ) . '</p></div>';
			}
			
			/* Decription */
			$output .= '<div class="dialog-row"><label for="mm-audio-desc">' . _x(' Description', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<textarea id="mm-audio-desc" name="desc">'. $options['desc'] .'</textarea>';
			$output .= '<p class="help-box">' . _x(' Short description for the audio track.', 'Metabox Class', $this->textdomain ) . '</p></div>';

			/* Buttons */
			$output .= '<div class="dialog-row"><label for="mm-audio-buttons">' . _x(' Buttons', 'Metabox Class', $this->textdomain ) . '</label>';
			$output .= '<textarea id="mm-audio-buttons" name="buttons">'. $options['buttons'] .'</textarea>';
			$output .= '<p class="help-box">' . _x(' Add player buttons. Button example:<br/> [player_button title="Download" link="http://link_here" target="self"] <br/> Please note target="blank" - open 
				link in new window.', 'Metabox Class', $this->textdomain ) . '</p></div>';

			// Volume
			$output .= '<div class="dialog-row"><label for="mm-audio-volume">' . _x(' Volume', 'Metabox Class', $this->textdomain ) . '</label>';
			
			$output .= '<input name="volume" id="mm-audio-volume" type="text" class="range-input" value="' . $options['volume'] . '"';
				$output .= ' data-min="0"';
				$output .= ' data-max="100"';
				$output .= ' data-step="1"';
			$output .= '/>';
			$output .= '<p class="help-box">' . _x(' Set track volume (0-100).', 'Metabox Class', $this->textdomain ) . '</p>';
			$output .= '</div>';

			$output .= '</fieldset>';
		}

	    echo $output;
	    exit;
	}
}
?>