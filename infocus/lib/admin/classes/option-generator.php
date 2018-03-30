<?php
/**
 *
 */
class mysiteOptionGenerator {
	
	private $saved_options;
	private $saved_internal;
	private $saved_sidebars;
	private $saved_skin;
	
	function __construct( $options ) {
		
		$this->saved_options();
		
		$out = '<div id="mysite_admin_panel">';
		$out .= '<form name="mysite_admin_form" method="post" action="options.php" id="mysite_admin_form">';
		
		$out .= $this->settings_fields();
		$out .= '<input type="hidden" name="mysite_full_submit" value="0" id="mysite_full_submit" />';
		$out .= '<input type="hidden" name="mysite_admin_wpnonce" value="' . wp_create_nonce( MYSITE_SETTINGS . '_wpnonce' ) . '" />';
		
		$out .= '<div id="mysite_header">';
		
		$out .= '<div id="mysite_logo"><img src="' . ( !empty( $this->saved_options['admin_logo_url'] ) ? esc_url( $this->saved_options['admin_logo_url'] ) :
		esc_url( THEME_ADMIN_ASSETS_URI ) . '/images/logo.png' ) . '" alt="" /></div>';
		
		$out .= '<div id="header_links">';
		$out .= '<span>' . THEME_NAME . ' ' . THEME_VERSION . '</span>';
		$out .= '<a href="' . esc_url( $this->saved_internal['documentation_url'] ) . '" target="_blank">' . __( 'Documentation', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
		$out .= '<a href="' . esc_url( $this->saved_internal['support_url'] ) . '" target="_blank">' . __( 'Support Forum', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
		$out .= '</div><!-- #header_links -->';
		$out .= '</div><!-- #mysite_header -->';
		
		$out .= '<div id="mysite_body">';
		
		foreach( $options as $option )
			$out .= $this->$option['type']( $option );

		$out .= '</div><!-- #mysite_tab_content -->';
		$out .= '<div class="clear"></div>';
		$out .= '</div><!-- #mysite_body -->';
		
		$out .= '<div id="mysite_footer">';
		
		$out .= '<input type="submit" name="' . MYSITE_SETTINGS . '[reset]" value="' . esc_attr__( 'Reset All Options' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="button mysite_reset_button" />';
		$out .= '<input type="submit" name="submit" value="' . esc_attr__( 'Save All Changes' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="button mysite_footer_submit" />';
		
		$out .= '</div><!-- #mysite_footer -->';
		
		$out .= '</form><!-- #mysite_admin_form -->';
		
		$out .= '</div><!-- #mysite_admin_panel -->';
		
		echo $out;
	}
	
	/**
	 *
	 */
	function saved_options() {
		$this->saved_options = get_option( MYSITE_SETTINGS );
		$this->saved_internal = get_option( MYSITE_INTERNAL_SETTINGS );
		$this->saved_sidebars = get_option( MYSITE_SIDEBARS );
		$this->saved_skin = get_option( MYSITE_ACTIVE_SKIN );
	}
	
	/**
	 *
	 */
	function messages() {
		$message = '';
		
		if( isset( $_GET['reset'] ) )
			$message = __( 'All Options Restored To Default.', MYSITE_ADMIN_TEXTDOMAIN );
			
		if( isset( $_GET['settings-updated'] ) )
			$message = __( 'Settings Saved.', MYSITE_ADMIN_TEXTDOMAIN );
			
		if( isset( $_GET['import'] ) && $_GET['import'] == 'true' )
			$message = __( 'Options Import Successful.', MYSITE_ADMIN_TEXTDOMAIN );
			
		if( isset( $_GET['import'] ) && $_GET['import'] == 'false' )
			$message = __( 'There was an error importing your options, please try again.', MYSITE_ADMIN_TEXTDOMAIN );
			
		$style = ( !$message ) ? ' style="display:none;"' : '';
		
		$out = '<div id="message" class="error fade below-h2"' . $style . '>' . $message . '</div>';
		$out .= '<div id="ajax-feedback"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function settings_fields() {
		ob_start(); settings_fields( MYSITE_SETTINGS ); $out = ob_get_clean();
		return $out;
	}
	
	/**
	 * 
	 */
	function navigation( $value ) {
		$out = '<div id="mysite_admin_tabs">';
		$out .= '<ul>';
		
		foreach( $value['name'] as $key => $name ) {
			$out .= '<li><a title="' . $name . '" href="#' . $key . '">' . $name . '</a></li>';
		}
		$out .= '</ul>';
		$out .= '</div><!-- #mysite_admin_tabs -->';
		$out .= '<div id="mysite_tab_content">';
		
		$out .= $this->messages();
		
		$out .= '<div class="mysite_admin_save"><input type="submit" name="submit" value="' . esc_attr__( 'Save All Changes' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="button" /></div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function tab_start( $value ) {
		foreach( $value['name'] as $key => $name ) {
			$out = '<div id="' . $key . '" class="mysite_tab">';
			$out .= '<div>';
			$out .= '<h2>' . $name[$key] . '</h2>';
			$out .= '</div>';
		}
		
		return $out;
	}
	
	/**
	 * 
	 */
	function tab_end( $value ) {
		$out = '</div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function option_start( $value ) {
		$out = '';
		
		if( isset( $value['name'] ) ) {
			$out .= '<div class="mysite_option_header">' . $value['name'] . '</div>';
		}
		
		$out .= '<div class="mysite_option">';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function option_end( $value ) {
		$out = '</div><!-- mysite_option -->';
		
		if( !empty( $value['desc'] ) ) {
			$out .= '<div class="mysite_option_help">';
			$out .= '<a href="#"><img src="' . esc_url( THEME_ADMIN_ASSETS_URI ) . '/images/help.png" alt="" /></a>';
			$out .= '<div class="mysite_help_tooltip">' . $value['desc'] . '</div>';
			$out .= '</div>';
		}

		$out .= '<div class="clear"></div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function toggle_start( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="mysite_option_set toggle_option_set">';
		$out .= '<h3 class="option_toggle ' . $toggle_class . 'trigger"><a href="#">' . str_replace( ' ~', '', $value['name'] ) . ' <span>[+]</span></a></h3>';
		$out .= '<div class="toggle_container" style="display:none;">';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function toggle_end( $value ) {
		$out = '</div></div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function text( $value ) {
		$size = isset( $value['size'] ) ? $value['size'] : '10';
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set text_option_set">';
		
		$out .= $this->option_start( $value );
		
		if( !is_array( $value['id'] ) )
			$value['id'] = array( $value['id'] => false );
		
		foreach( $value['id'] as $id => $lable ) {
			
			if( $lable )
				$out .= '<label for="' . $id . '">' . $lable . '</label>';
			
			$out .= '<input type="text" name="' . MYSITE_SETTINGS . '[' . $id . ']" id="' . $id . '" class="mysite_textfield" value="' .
			( isset( $this->saved_options[$id] ) && isset( $value['htmlentities'] )
			? stripslashes(htmlentities( $this->saved_options[$id] ) ) : ( isset( $this->saved_options[$id] ) && isset( $value['htmlspecialchars'] )
			? stripslashes(htmlspecialchars( $this->saved_options[$id] ) )
			: ( isset( $this->saved_options[$id] ) ? stripslashes( $this->saved_options[$id] )
			: ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) ) . '" />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .text_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function textarea( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set textarea_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<textarea rows="' . ( !empty( $value['rows'] ) ? $value['rows'] : '8' ) . '" cols="8" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="mysite_textarea">' .
		( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '</textarea><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .textarea_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function select( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? $value['toggle'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set select_option_set">';
		
		$out .= $this->option_start( $value );
		
		if( isset( $value['target'] ) ) {
			if( isset( $value['options'] ) ) {
				$value['options'] = $value['options'] + $this->select_target_options( $value['target'] );
			} else {
				$value['options'] = $this->select_target_options( $value['target'] );
			}
		}
		
		$out .= '<select name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="' . $toggle . 'mysite_select">';
		
		$out .= '<option value="">' . __( 'Choose one...', MYSITE_ADMIN_TEXTDOMAIN ) . '</option>';
		
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '"';
			if( isset( $this->saved_options[$value['id']] ) ) {
				if( $this->saved_options[$value['id']] == $key ) {
					$out .= ' selected="selected"';
				}
				
			} elseif( isset( $value['default'] ) ) {
				if( $value['default'] == $key ) {
					$out .= ' selected="selected"';
				}
			}
			
			$out .= '>' . esc_attr( $option ) . '</option>';
		}
		
		$out .= '</select>';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .select_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function multidropdown( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set multidropdown_option_set">';
		
		$out .= $this->option_start( $value );
		
		if( isset( $value['target'] ) ) {
			if( isset( $value['options'] ) ) {
				$value['options'] = $value['options'] + $this->select_target_options( $value['target'] );
			} else {
				$value['options'] = $this->select_target_options( $value['target'] );
			}
		}

		$selected_keys = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array();
		
		$out .= '<div id="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" class="multidropdown">';
		
		$i = 0;
		foreach( $selected_keys as $selected ) {
			$out .= '<select name="' . $value['id'] . '_' . $i . '" id="' . $value['id'] . '_' . $i . '" class="mysite_select">';
			$out .= '<option value=""> ' . __( 'Choose one...', MYSITE_ADMIN_TEXTDOMAIN ) . '</option>';
			foreach( $value['options'] as $key => $option ) {
				$out .= '<option value="' . $key . '"';
				if( $selected == $key ) {
					$out .= ' selected="selected"';
				}
				$out .= '>' . esc_attr( $option ) . '</option>';
			}
			$i++;
			$out .= '</select>';
		}
		
		$out .= '<select name="' . $value['id'] . '_' . $i . '" id="' . $value['id'] . '_' . $i . '" class="mysite_select">';
		$out .= '<option value="">' . __( 'Choose one...', MYSITE_ADMIN_TEXTDOMAIN ) . '</option>';
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '">' . $option . '</option>';
		}
		$out .= '</select></div>';
		
		$out .= $this->option_end( $value );
	
		$out .= '</div><!-- .multidropdown_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function checkbox( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? ' class="' . $value['toggle'] . '"' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set checkbox_option_set">';
		
		$out .= $this->option_start( $value );
		
		$i = 0;
		foreach( $value['options'] as $key => $option ) {
			$i++;
			$checked = '';
			if( isset( $this->saved_options[$value['id']] ) ) {
				if( is_array( $this->saved_options[$value['id']] ) ) {
					if( in_array( $key, $this->saved_options[$value['id']] ) ) {
						$checked = ' checked="checked"';
					}
				}
				
			} elseif ( isset( $value['default'] ) ){
				if( is_array( $value['default'] ) ) {
					if( in_array( $key, $value['default'] ) ) {
						$checked = ' checked="checked"';
					}
				}
			}
			
			$out .= '<input type="checkbox" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][]" value="' . $key . '" id="' . $value['id'] . '-' . $i . '"' . $checked . $toggle . ' />';
			
			if( !empty( $option ) )
				$out .= '<label for="' . $value['id'] . '-' . $i . '">' . esc_html( $option ) . '</label><br />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .checkbox_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function radio( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? ' class="' . $value['toggle'] . '"' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set radio_option_set">';
		
		$out .= $this->option_start( $value );
		
		$checked_key = ( isset( $this->saved_options[$value['id']] ) ? $this->saved_options[$value['id']] : ( isset( $value['default'] ) ? $value['default'] : '' ) );
			
		$i = 0;
		foreach( $value['options'] as $key => $option ) {
			$i++;
			$checked = ( $key == $checked_key ) ? ' checked="checked"' : '';
			
			$out .= '<input type="radio" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '_' . $i . '"' . $toggle .' />';
			$out .= '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .radio_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function upload( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out = '<div class="' . $toggle_class . 'mysite_option_set upload_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="text" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" value="' . ( isset( $this->saved_options[$value['id']] )
		? esc_url(stripslashes( $this->saved_options[$value['id']] ) )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '" id="' . $value['id'] . '" class="mysite_upload" />';
		
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value['id'] . ' button" /><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .upload_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function resize( $value ) {
		$option = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : '';
		
		$out = '<div class="mysite_option_set resize_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="text" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][w]" id="' . $value['id'] . '_w" class="mysite_textfield" value="' . ( isset( $option['w'] )
		? stripslashes( $option['w'] )
		: '' ) . '" />';
		
		$out .= '<label for="' . $value['id'] . '_w">' . __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
		
		$out .= '<input type="text" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][h]" id="' . $value['id'] . '_h" class="mysite_textfield" value="' . ( isset( $option['h'] )
		? stripslashes( $option['h'] )
		: '' ) . '" />';
		
		$out .=  '<label for="' . $value['id'] . '_h">' . __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .resize_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function editor( $value ) {
		global $wp_version, $post, $post_type;
		
		$out = '';
		
		if( !isset( $value['no_header'] ) && isset( $value['name'] ) ) {
			$out .= '<h3 class="editor_option_header">' . $value['name'] . '</h3>';
			$value['name'] = '';
		}
		
		$out .= '<div class="mysite_option_set editor_option_set">';
		
		$out .= $this->option_start( $value );

		$content = ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) );
		
		// TinyMCE editor IDs cannot have brackets.
		// This is the fix for now.
		
		//$content_id = MYSITE_SETTINGS . '[' . $value['id'] .']';
		$content_id = MYSITE_SETTINGS . '-bracket-' . $value['id'];
		
		if( version_compare( $wp_version, '3.3', '>=' ) ) {
			
			ob_start();
			$args = array("textarea_name" => $content_id);
			wp_editor( $content, $content_id, $args );
			$editor = ob_get_contents();
			ob_end_clean();

			$out .= $editor;
		}
		else
		{
			$out .= '<div id="poststuff"><div id="post-body"><div id="post-body-content"><div class="postarea" id="postdivrich">';
			
			ob_start();
			the_editor( $content, $content_id );
			$editor = ob_get_contents();
			ob_end_clean();

			$content_replace = MYSITE_SETTINGS . '_' . $value['id'];

			$editor = str_replace( $content_id, $content_replace, $editor );
			$out .= str_replace( 'name=\'' . $content_replace . '\'', 'name=\'' . $content_id . '\'', $editor );
			
			$out .= '</div></div></div></div>';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .editor_option_set -->';

		return $out;
	}
	
	/**
	 * 
	 */
	function layout( $value ) {
		$out = '<div class="mysite_option_set layout_option_set">';
		
		$out .= $this->option_start( $value );
		
		foreach( $value['options'] as $rel => $image ) {
			$out .= '<a href="#" rel="' . $rel . '"><img src="' . esc_url( $image ) . '" alt="" /></a>';
		}
		
		$out .= '<input type="hidden" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" value="' . ( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '" />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .layout_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function export_options( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set textarea_option_set">';
		
		$out .= $this->option_start( $value );
		
		$options = $this->saved_options;
		
		$export_options = array();
		if( !empty( $options ) ) {
			foreach( $options as $key => $option ) {
				if( is_string( $option ) )
					$export_options[$key] = preg_replace( "/(\r\n|\r|\n)\s*/i", '<br /><br />', stripslashes( $option ) );
				else
					$export_options[$key] = $option;
			}
		}
		
		if( !empty( $export_options ) ) {
			$export_options = array_merge( $export_options, array( 'mysitemyway_options_export' => true ) );
			$export_options = mysite_encode( $export_options, $serialize = true );
		}
					
		$out .= '<textarea rows="8" cols="8" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="mysite_textarea">' . $export_options . '</textarea><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .textarea_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function contact( $value ) {
		
		$out = '<div class="shortcode_atts_contactform">';
		$out .= $this->text( array(
			'name' => __( 'Email', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the email address that you wish to be used when the form is submitted.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'sc-contactform-email',
			'default' => ''
		));
		
		$out .= '</div>';
		
		$form_options = array(
			array( 
				'name' => __( 'Name', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a textfield that is used as the name of the sender.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Email', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a textfield that is used as the email of the sender. This field will be validated for a correct email.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Textfield', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a basic textfield which can be used for anything.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Textarea', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a basic textarea which can be used for anything. This is usually used as the "Message" section of a form.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Checkbox', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a checkbox to your form. The checkbox can be used for anything and the value will be displayed in your email.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Radio', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds radio buttons to your form. You will need to separate your values with a comma.<br /><br />For example if you wanted to offer the choice of male or female then you would enter the value like this: "male, female".', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,value,required'
			),
			array(
				'name' => __( 'Select', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a select box to your form. You will need to separate your values with a comma.<br /><br />For example if you wanted to offer the choice of male or female then you would enter the value like this: "male, female".', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'label,value,required'
			),
			array(
				'name' => __( 'Submit', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'By default the submit button will be displayed as "Submit". If you wish to change the text then you can add this to the form with a custom value.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'value'
			),
			array(
				'name' => __( 'Autoresponder', MYSITE_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Allows you to setup an automated response after the form is submitted. You can use the tags by typing them out like so, %name%, %email%, etc etc.', MYSITE_ADMIN_TEXTDOMAIN ),
				'options' => 'autoresponder'
			)
		);
		
		$out .= '<div class="toggle_option_set">';
		$out .= '<h3 class="option_toggle contactform_trigger"><a href="#">' . __( 'Advanced Settings', MYSITE_ADMIN_TEXTDOMAIN ) . ' <span>[+]</span></a></h3>';
		$out .= '<div class="contactform_toggle_container" style="display: none;" >';
		
		
		$out .= '<div class="shortcode_atts_contactform">';
		$out .= $this->text( array(
			'name' => __( 'Subject', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can place a custom subject line here. This is the subject that you will see in your emails.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'sc-contactform-subject',
			'default' => ''
		));
		
		$out .= '</div>';
		
		$out .= '<div class="shortcode_atts_contactform">';
		$out .= $this->text( array(
			'name' => __( 'Success Message', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'When the form is submitted successfully this message will be displayed to the user.  Common examples would be, "Thanks!" or something similar.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'sc-contactform-success',
			'default' => ''
		));
		
		$out .= '</div>';
		
		$out .= '<div class="shortcode_atts_contactform">';
		$out .= $this->checkbox( array(
			'name' => __( 'Spam Protection', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => 'You can choose whether to use a captcha for spam protection or the akismet plugin. If using akismet then make sure you sign up with their service and have the akismet plugin enabled.',
			"id" => "sc-contactform-spam",
			'options' => array(
				'captcha-true' => 'Captcha',
				'akismet-true' => 'Akismet'
			),
			"default" => ''
		));
		
		$out .= '</div>';
		
		$out .= '<div class="shortcode_contactform_multiplier mysite_option_set">';
		$out .= $this->option_start( array( 'name' => __( 'Add Form Field', MYSITE_ADMIN_TEXTDOMAIN ) ) );
		
		$out .= '<select class="mysite_select" name="contactform_multiplier">';
		$out .= '<option value="">' . __( 'Choose one...', MYSITE_ADMIN_TEXTDOMAIN ) . '</option>';
		foreach( $form_options as $key => $value ) {
			$out .= '<option value="' . strtolower( $value['name'] ) . '">' . $value['name'] . '</option>';
		}
		$out .= '</select>';
		
		$out .= '<input type="button" value="' . __( 'Add Field &raquo;', MYSITE_ADMIN_TEXTDOMAIN ) . '" id="multiply_contactform" class="button">';
		$out .= $this->option_end( array( 'desc' => __( 'You can add fields to display with your form.  When the form is submitted these fields will display in your email.', MYSITE_ADMIN_TEXTDOMAIN ) ) );
		
		$out .= '</div>';
		
		foreach( $form_options as $key => $value ) {
			
			$out .= '<div class="shortcode_atts_contactform mysite_option_set select_option_set contactform_clone clone_' . strtolower( $value['name'] ) . '" style="display:none;">';
			$out .= $this->option_start(  array( 'name' => $value['name'] ) );
			
			if( strpos( $value['options'], 'label' ) !== false ) {
				$out .= '<label for="sc-contactform-label-#">' . __( 'Form Label:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-label-#" type="text" value="" class="mysite_textfield" id="sc-contactform-label-#" style="width:40%;"><br />';
			}
			if( strpos( $value['options'], 'value' ) !== false ) {
				$out .= '<label for="sc-contactform-label-#">' . __( 'Form Value:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-value-#" type="text" value="" class="mysite_textfield" id="sc-contactform-value-#" style="width:40%;"><br />';
			}
			if ( strpos( $value['options'], 'required' ) !== false ) {
				$out .= '<label for="sc-contactform-required-#">' . __( 'Require Field:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input type="checkbox" value="true" name="sc-contactform-required-#" id="sc-contactform-required-#"><br />';
			}
			if( strpos( $value['options'], 'autoresponder' ) !== false ) {
				$out .= '<label for="sc-contactform-fromName-#">' . __( 'From Name:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-fromName-#" type="text" value="" class="mysite_textfield" id="sc-contactform-fromName-#" style="width:40%;"><br />';
				$out .= '<label for="sc-contactform-fromEmail-#">' . __( 'From Email:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-fromEmail-#" type="text" value="" class="mysite_textfield" id="sc-contactform-fromEmail-#" style="width:40%;"><br />';
				$out .= '<label for="sc-contactform-subject-#">' . __( 'Subject:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-subject-#" type="text" value="" class="mysite_textfield" id="sc-contactform-subject-#" style="width:40%;"><br />';
				
				$out .= '<div class="contactform_available_tags">' . __( 'Available Tags:', MYSITE_ADMIN_TEXTDOMAIN ) . '&nbsp;&nbsp;<span>%return%</span></div>';
				$out .= '<label for="sc-contactform-message-#">' . __( 'Message:', MYSITE_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<textarea name="sc-contactform-message-#" class="mysite_textarea" id="sc-contactform-message-#" cols="8" rows="8"></textarea><br />';
			}
			
			$out .= '<a class="submitdelete contactform_field_deletion" id="delete-1" href="#">' . __( 'Remove', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= $this->option_end( array( 'desc' => $value['desc'] ) );
			$out .= '</div>';
		}
		
		$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function sidebar( $value ) {
		$out = '<div class="mysite_option_set sidebar_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="text" name="' . $value['id'] . '" id="' . $value['id'] . '" class="mysite_textfield" onkeyup="mysiteAdmin.fixField(this);" value="" />';
		
		$out .= '<div class="add_sidebar">';
		$out .= '<span class="button mysite_add_sidebar">' . __( 'Add Sidebar', MYSITE_ADMIN_TEXTDOMAIN ) . '</span>';
		$out .= '</div><!-- .add_sidebar -->';
		
		$out .= $this->option_end( $value );
		
		$init = ( !empty( $this->saved_sidebars ) ) ? false : true;
		
		$out .= '<div class="clear menu_clear"' . ( $init ? ' style="display:none;"' : '' ) . '></div>';
		
		$out .= '<ul id="sidebar-to-edit" class="menu"' . ( $init ? ' style="display:none;"' : '' ) . '>';
		
		if( !$init ){
			foreach( $this->saved_sidebars as $key => $sidebar ){
				$out .= '<li class="menu-item" id="sidebar-item-' . $key . '">';
				$out .= '<dl class="menu-item-bar">';
				$out .= '<dt class="menu-item-handle">';
				$out .= '<span class="sidebar-title">' . $sidebar . '</span>';
				$out .= '<span class="item-controls"><a href="#" class="item-type delete_sidebar" rel="sidebar-item-' . $key . '">' . __( 'Delete', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></span>';
				$out .= '</dt>';
				$out .= '</dl>';
				$out .= '</li>';
			}
			
		} elseif( $init ) {
			$out .= '<li></li>';
		}
		$out .= '</ul><!-- #sidebar-to-edit -->';
		
		$out .= '<ul id="sample-sidebar-item" class="menu" style="display:none;"> ';
		$out .= '<li class="menu-item" id="sidebar-item-:">';
		$out .= '<dl class="menu-item-bar">';
		$out .= '<dt class="menu-item-handle">';
		$out .= '<span class="sidebar-title">:</span>';
		$out .= '<span class="item-controls"><a href="#" class="item-type delete_sidebar" rel="sidebar-item-:">' . __( 'Delete', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></span>';
		$out .= '</dt>';
		$out .= '</dl>';
		$out .= '</li>';
		$out .= '</ul><!-- #sample-sidebar-item -->';
		
		$out .= '</div><!-- .sidebar_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function slideshow( $value ) {
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'slider_keys' => '#' );
		
		$init = false;
		
		if( $options['slider_keys'] == '#' )
			$init = true;
		
		$slider_keys = explode( ',', $options['slider_keys'] );
		
		$key_count = count( $slider_keys );
		
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set slideshow_option_set">';
		$out .= '<div class="mysite_option_heading">' . $value['name'] . '</div>';
		$out .= '<div class="add_menu"><span class="button mysite_add_menu">' . __( 'Add New Slider', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $slider_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) )
				$out .= '<ul class="menu-to-edit menu">';
			
			if ( $i == $key_count )
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MYSITE_SETTINGS . '[slideshow][' . $id . ']';
			$url = ( !empty( $val['slider_url'] ) ) ? esc_url(stripslashes( $val['slider_url'] ) ) : '';
			$alt = ( !empty( $val['alt_attr'] ) ) ? stripslashes( $val['alt_attr'] ) : '';
			$link_url = ( !empty( $val['link_url'] ) ) ? esc_url(stripslashes( $val['link_url'] ) ) : '';
			$title = ( !empty( $val['title'] ) ) ? stripslashes( $val['title'] ) : '';
			$description = ( !empty( $val['description'] ) ) ? stripslashes( $val['description'] ) : '';
			$stage = ( !empty( $val['stage_effect'] ) ) ? $val['stage_effect'] : '';
			
			$out .= '<li id="slideshow-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . sprintf( __( 'Slideshow %1$s', MYSITE_ADMIN_TEXTDOMAIN ), $i ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="slideshow-menu-item-settings-' . $id .'" title="Edit Menu Item" id="edit-' . $id . '" class="item-edit">' . __( 'Edit Menu Item', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="slideshow-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			
			# slider image url
			$out .= '<p class="description description-thin"><label for="edit-menu-image-url-' . $id . '">' . __( 'Image/Video URL', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[slider_url]" value="' . $url . '" id="edit-menu-image-url-' . $id . '" class="widefat" />';
			$out .= '&nbsp;<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button button" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider image alt attr
			$out .= '<p class="description description-thin"><label for="edit-menu-alt-url-' . $id . '">' . __( 'Image Alt Attribute', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[alt_attr]" value="' . $alt . '" id="edit-menu-alt-url-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider link url
			$out .= '<p class="description description-thin"><label for="edit-menu-link-url-' . $id . '">' . __( 'Link URL', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[link_url]" value="' . $link_url . '" id="edit-menu-link-url-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider title
			$out .= '<p class="description description-thin"><label for="edit-menu-title-' . $id . '">' . __( 'Title', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[title]" value="' . $title . '" id="edit-menu-title-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider stage effect
			$out .= '<p class="description description-thin"><label for="edit-menu-stage-effect-' . $id . '">' . __( 'Stage Effect', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<select name="' . $name . '[stage_effect]" id="edit-menu-stage-effect-' . $id . '" class="widefat">';
			
			foreach ( $this->select_target_options( 'slider_stage' ) as $stage_value => $stage_effect ) {
				
				$selected = ( $stage == $stage_value ) ? ' selected="selected"' : '' ;
				$out .= '<option' . $selected . ' value="' . $stage_value . '">' . $stage_effect . '</option>';
			}
			$out .= '</select>';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider read more
			$out .= '<p class="description description-thin"><label><input' . ( !empty( $val['read_more'] )
			? ' checked="checked"': '' ) .' type="checkbox" value="1" name="' . $name . '[read_more]" />' . __( 'Disable "Read More" Button', MYSITE_ADMIN_TEXTDOMAIN ) . '</label></p>';
			
			# slider description
			$out .= '<p class="field-description description description-wide"><label for="edit-menu-slider-description-' . $id . '">' . __( 'Description', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<textarea cols="20" rows="3" name="' . $name . '[description]" id="edit-menu-slider-description-' . $id . '" class="widefat">' . $description . '</textarea>';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="#" id="delete-slideshow-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MYSITE_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="slideshow-menu-item-settings-' . $id . '" class="slider_cancel submitcancel">' . __( 'Cancel', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			$out .= '</div><!-- #slideshow-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MYSITE_SETTINGS . '[slideshow][slider_keys]" value="' . $options['slider_keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .slideshow_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function sociable( $value ) {
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'keys' => '#' );
		
		$init = false;
		
		if( $options['keys'] == '#' )
			$init = true;
		
		$sociable_keys = explode(',', $options['keys'] );
		
		$key_count = count( $sociable_keys );
		
		$out = '<div class="mysite_option_set sociable_option_set">';
		$out .= '<div class="mysite_option_heading">' . $value['name'] . '</div>';
		$out .= '<div class="add_menu"><span class="button mysite_add_menu">' . __( 'Add New Sociable', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $sociable_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) )
				$out .= '<ul class="menu-to-edit menu">';

			if ( $i == $key_count )
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MYSITE_SETTINGS . '[sociable][' . $id . ']';
			$custom = ( !empty( $val['custom'] ) ) ? esc_url(stripslashes( $val['custom'] ) ) : '';
			$link = ( !empty( $val['link'] ) ) ? esc_url(stripslashes( $val['link'] ) ) : '';
			$icon = ( !empty( $val['icon'] ) ) ? $val['icon'] : '';
			$color = ( !empty( $val['color'] ) ) ? $val['color'] : '';
			$alt = ( !empty($val['alt'] )) ? stripslashes( $val['alt'] ) : '';
			
			if( !empty( $icon ) ) {
				$parts = explode( '.', $icon );
				$icon_title = str_replace( '_',' ', $parts[count($parts) - 2] );
				$icon_title = ucwords( $icon_title );
				$icon_title = str_replace( ' ','', $icon_title );
			}
						
			$out .= '<li id="sociable-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . ( $custom || $id == '#' || empty( $icon ) ? sprintf( __( 'Sociable %1$s', MYSITE_ADMIN_TEXTDOMAIN ), $i ) : $icon_title ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="sociable-menu-item-settings-' . $id .'" title="Edit Menu Item" id="sociable-menu-edit-' . $id . '" class="item-edit">' . __( 'Edit Menu Item', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="sociable-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			
			# sociable icon
			$out .= '<p class="field-link-target description description-thin"><label for="edit-menu-sociable-icon-' . $id . '">' . __( 'Sociable Icon', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<select id="edit-menu-sociable-icon-' . $id . '" class="widefat" name="' . $name . '[icon]">';
			
			$sociables_icons = mysite_sociable_option();
			foreach ( $sociables_icons['sociables'] as $key => $val ) {
				
				$selected = ( $icon == $key ) ? ' selected="selected"' : '' ;
				$out .= '<option' . $selected. ' value="' . $key . '">' . $val . '</option>';
			}
			$out .= '</select>';
			$out .= '</label>';
			$out .= '</p>';
			
			# style variation
			$out .= '<p class="field-link-target description description-thin"><label for="edit-menu-sociable-color-' . $id . '">' . __( 'Sociable Icon Style', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<select id="edit-menu-sociable-color-' . $id . '" class="widefat" name="' . $name . '[color]">';
			
			$styles = mysite_sociable_option();
			foreach ( $styles['styles'] as $key => $val ) {
				
				$selected = ( $color == $key ) ? ' selected="selected"' : '' ;
				$out .= '<option' . $selected . ' value="' . $key . '">' . $val . '</option>';
			}
			$out .= '</select>';
			$out .= '</label>';
			$out .= '</p>';
			
			# sociable url
			$out .= '<p class="description description-thin"><label for="edit-sociable-menu-url-' . $id . '">' . __( 'Custom Icon', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $custom . '" name="' . $name . '[custom]" id="edit-sociable-menu-url-' . $id . '" class="widefat sociable_custom" />';
			$out .= '&nbsp;<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button button" /><br />';
			$out .= '</label>';
			$out .= '</p>';
			
			# sociable link
			$out .= '<p class="description description-thin"><label for="edit-sociable-menu-link-' .$id. '">' . __( 'Sociable Link', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $link . '" name="' . $name . '[link]" id="edit-sociable-menu-link-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# sociable alt
			$out .= '<p class="description description-thin"><label for="edit-sociable-menu-alt-' .$id. '">' . __( 'Alt Text', MYSITE_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $alt . '" name="' . $name . '[alt]" id="edit-sociable-menu-alt-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="" id="delete-sociable-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MYSITE_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="sociable-menu-item-settings-' . $id .'" class="slider_cancel submitcancel">' . __( 'Cancel', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			
			$out .= '</div><!-- #sociable-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MYSITE_SETTINGS . '[sociable][keys]" value="' . $options['keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .sociable_option_set -->';
		
		return $out;
	}
	
	
	/**
	 *
	 */
	function color( $value ) {
		$out = '<div class="mysite_option_set color_option_set">';
		
		$out .= $this->option_start($value);
		
		$val = ( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] )
		? $value['default'][0]
		: '' ) );
		
		$out .= '<div class="colorSelector" id="' .$value['id']. '_picker"><div></div></div>';
		$out .= '<input value="' .$val. '" id="' .$value['id']. '" name="' .$value['id']. '" class="mysite_colorselector"><br />';
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- color_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function border( $value ) {
		$out = '<div class="mysite_option_set border_option_set">';
		
		$out .= $this->option_start( $value );
				
		$out .= '<div class="colorSelector" id="' . $value['id'] . '_picker"><div></div></div>';
		$out .= '<input value="' . $value['default'][0] . '" id="' . $value['id'] . '_color" name="' . $value['id'] . '[' . $value['properties'][0] . ']" class="mysite_colorselector">';
		
		$value['options'] = $this->select_target_options( $value['target'] );
		
		foreach($value['options'] as $key => $val) {
			
			if( !empty( $value['properties'][$key] ) ) {
				$out .= '<select name="' . $value['id']. '[' . $value['properties'][$key] . ']" id="' . $value['id'] . '_' . $key . '" class="mysite_select">';

				foreach($val as $name => $option){
					$option = ( $key == 1 ) ?  $option . 'px' : $option;

					$out .= '<option value="' . $option . '"';

					foreach($value['default'] as $selected){
						if ( $selected == $option ) {
							$out .= ' selected="selected"';
						}
					}

					$out .= '>' . $option . '</option>';
				}

				$out .= '</select>';
			}
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- border_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function background($value) {
		
		$out = '<div class="mysite_option_set background_option_set">';
		
		$out .= $this->option_start($value);
		
		$patterns = mysite_pattern_presets();
		if( !empty( $patterns) ) {
			$out .= '<div class="pattern_images">';
			
				foreach( $patterns as $image => $class )
					$out .= '<a class="single_pattern ' . $class . '" href="#" title="' . ( is_multisite() ? '/wp-content/themes/' . THEME_SLUG . '/styles/' : '' ) . THEME_PATTERNS . '/' . $image . '">' . ucfirst( $class ) . '</a>';
		
			$out .= '</div>';
		}
		
		$out .= '<input type="text" name="' . $value['id'] . '[background-image]" value="' . $value['default'][0] . '" id="' . $value['id'] . '" class="mysite_upload" />';
		$out .= '<input type="button" value="' . esc_attr__( 'Select Preset' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="preset_pattern ' . $value['id'] . ' button" />';
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value['id'] . ' button" /><br /><br />';
		
		$value['options'] = $this->select_target_options($value['target']);
		
		$out .= '<div class="colorSelector" id="' . $value['id'] . '_picker"><div></div></div>';
		$out .= '<input value="' . $value['default'][1] . '" id="' . $value['id'] . '_color" name="' . $value['id'] . '[background-color]" class="mysite_colorselector">';
		
		foreach($value['options'] as $key => $val) {
			
			if( $key == 'background-position' )
				$val = array_merge( $val, array( $value['default'][4] ) );
			
			$out .= '<select name="' .$value['id']. '[' .$key. ']" id="' .$value['id']. '_' .$key. '" class="mysite_select">';
						
			foreach($val as $name => $option){
				$out .= '<option value="' . $option . '"';
				
				foreach($value['default'] as $selected){
					if ( $selected == $option ) {
						$out .= ' selected="selected"';
					}
				}
				
				$out .= '>' . $option . '</option>';
			}
			
			$out .= '</select>';
		}
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- typography_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function background_plus( $value ) {
		
		$out = '<div class="mysite_option_set background_option_set">';
		
		$out .= $this->option_start($value);
		
		$patterns = mysite_pattern_presets();
		if( !empty( $patterns) ) {
			$out .= '<div class="pattern_images">';
			
				foreach( $patterns as $image => $class )
					$out .= '<a class="single_pattern ' . $class . '" href="#" title="' . ( is_multisite() ? '/wp-content/themes/' . THEME_SLUG . '/styles/' : '' ) . THEME_PATTERNS . '/' . $image . '">' . ucfirst( $class ) . '</a>';
		
			$out .= '</div>';
		}
		
		$out .= '<input type="text" name="' . $value['id'] . '[background-image]" value="' . $value['default'][0] . '" id="' . $value['id'] . '" class="mysite_upload" />';
		$out .= '<input type="button" value="' . esc_attr__( 'Select Preset' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="preset_pattern ' . $value['id'] . ' button" />';
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value['id'] . ' button" /><br /><br />';
		
		$value['options'] = $this->select_target_options( str_replace('_plus', '', $value['target'] ) );
		
		$out .= '<div class="colorSelector" id="' . $value['id'] . '_picker"><div></div></div>';
		$out .= '<input value="' . $value['default'][1] . '" id="' . $value['id'] . '_color" name="' . $value['id'] . '[background-color]" class="mysite_colorselector">';
		
		foreach($value['options'] as $key => $val) {
			
			if( $key == 'background-position' )
				$val = array_merge( $val, array( $value['default'][4] ) );
			
			$out .= '<select name="' .$value['id']. '[' .$key. ']" id="' .$value['id']. '_' .$key. '" class="mysite_select">';
						
			foreach($val as $name => $option){
				$out .= '<option value="' . $option . '"';
				
				foreach($value['default'] as $selected){
					if ( $selected == $option ) {
						$out .= ' selected="selected"';
					}
				}
				
				$out .= '>' . $option . '</option>';
			}
			
			$out .= '</select>';
		}
		
		$out .= '<br /><br /><input type="checkbox" name="full_bg" value="true" id="full_bg"' .
		( isset( $value['default']['fullbg_options']['fullbg'] ) && $value['default']['fullbg_options']['fullbg'] == 'fullbg' ? ' checked="checked"' : '' ) . ' />';
		$out .= '<label for="full_bg">' . esc_attr__( 'Check for Full Screen Background' , MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= '<input type="checkbox" name="fade_bg" value="true" id="fade_bg"' .
		( isset( $value['default']['fullbg_options']['fadebg'] ) && $value['default']['fullbg_options']['fadebg'] == 'fadebg' ? ' checked="checked"' : '' ) . ' />';
		$out .= '<label for="fade_bg">' . esc_attr__( 'Check to Fade In Full Screen Background' , MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- typography_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function custom_background( $value ) {
		
		if( empty( $this->saved_options[$value['id']] ) )
			$value['default'] = ( isset( $value['default'] ) && is_array( $value['default'] ) ) ? $value['default'] : array();
		else
			$value['default'] = $this->saved_options[$value['id']];
			
		if( $value['id'][0] == '_' )
			$value_rm_un = str_replace( $value['id'][0].$value['id'][1], $value['id'][1], $value['id'] );
		else
			$value_rm_un = $value['id'];
		
		$out = '<div class="mysite_option_set background_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="text" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][url]" value="' . ( isset( $value['default']['url'] )
		? ( strtolower( $value['default']['url'] ) == 'none' ? strtolower( $value['default']['url'] ) : esc_url(stripslashes( $value['default']['url'] ) )  ) : '' ) . '" id="' . $value_rm_un . '_input' . '" class="mysite_upload" />';
		
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value_rm_un . ' button" /><br /><br />';
		
		$out .= '<div class="colorSelector" id="' . $value['id'] . '_picker"><div></div></div>';
		$out .= '<input value="' . ( isset( $value['default']['background-color'] ) 
		? $value['default']['background-color'] : '' ) . '" id="' . $value_rm_un . '_color" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][background-color]" class="mysite_colorselector">';
		
		$value['options'] = $this->select_target_options( $value['target'] );
		
		foreach( $value['options'] as $key => $val ) {
			
			$out .= '<select name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][' . $key . ']" id="' . $value_rm_un . '_' . str_replace( '-', '_', $key ) . '" class="mysite_select">';
						
			foreach( $val as $name => $option ) {
				$out .= '<option value="' . $option . '"';
				
				foreach( $value['default'] as $selected ) {
					if ( $selected == $option ) {
						$out .= ' selected="selected"';
					}
				}
				
				$out .= '>' . $option . '</option>';
			}
			
			$out .= '</select>';
		}
		
		$out .= '<br /><br /><br /><input type="checkbox" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][full_bg]" value="true" id="' . $value_rm_un . '_full_bg' . '"' .
		( isset( $value['default']['full_bg'] ) ? ' checked="checked"' : '' ) . ' />';
		$out .= '<label for="' . $value_rm_un . '_full_bg">' . esc_attr__( 'Check for Full Screen Background' , MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= '<input type="checkbox" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][fade_bg]" value="true" id="' . $value_rm_un . '_fade_bg' . '"' .
		( isset( $value['default']['fade_bg'] ) ? ' checked="checked"' : '' ) . ' />';
		$out .= '<label for="' . $value_rm_un . '_fade_bg">' . esc_attr__( 'Check to Fade In Full Screen Background' , MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- background_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function typography( $value ) {
		$out = '<div class="mysite_option_set typography_option_set">';
		
		$out .= $this->option_start($value);
		
		$value['options'] = $this->select_target_options($value['target']);
		
		$color = (isset($this->saved_options[$value['id']])) ? stripslashes($this->saved_options[$value['id']]['color']) : $value['default'][0];
		
		$out .= '<div class="colorSelector" id="' .$value['id']. '_picker"><div></div></div>';
		$out .= '<input value="' .$color. '" id="' .$value['id']. '_color" name="' .$value['id']. '[color]" class="mysite_colorselector">';
		
		foreach($value['options'] as $key => $val) {
			
			$out .= '<select name="' .$value['id']. '[' .$key. ']" id="' .$value['id']. '_' .$key. '" class="mysite_select">';
			
			
			foreach($val as $name => $option){
				
				$option = ( $key == 'font-size' ) ?  $option . 'px' : $option;
				$name = ( $key == 'font-size' ) ?  $name . 'px' : $name;
				
				if( $option == 'Web' || $option == 'Cufon' )
					$out .= '<optgroup label="' . $option . '">';

				if( ($option != 'Web') && ($option != 'Cufon') && ($option != 'optgroup') ) {
					if( $key == 'font-family' )
						$out .= '<option value="' . esc_attr( $name ) . '"';
					else
						$out .= '<option value="' . esc_attr( $option ) . '"';
				}
					
				$select = '';
				foreach($value['default'] as $selected){
					if( $key == 'font-family' ) {
						if ( $selected == $name )
							$select = ' selected="selected"';
							
					} else {
						if ( $selected == $option )
							$select = ' selected="selected"';
					}
				}
				
				if( ($option != 'Web') && ($option != 'Cufon') && ($option != 'optgroup') )
					$out .= $select . '>' . esc_attr( $option ) . '</option>';
				
				if($option == 'optgroup')
					$out .= '</optgroup>';
			}
			
			$out .= '</select>';
		}
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- typography_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function link( $value ) {
		$out = '<div class="mysite_option_set color_option_set">';
		
		$out .= $this->option_start($value);
		
		$val = (isset($this->saved_options[$value['id']])) ? stripslashes($this->saved_options[$value['id']]) : $value['default'][0];
		
		$out .= '<div class="colorSelector" id="' .$value['id']. '_picker"><div></div></div>';
		$out .= '<input value="' .$val. '" id="' .$value['id']. '" name="' .$value['id']. '[color]" class="mysite_colorselector">';
		
		$value['options'] = $this->select_target_options($value['target']);
		
		foreach($value['options'] as $key => $val) {
			
			$out .= '<select name="' .$value['id']. '[' .$key. ']" id="' .$value['id']. '_' .$key. '" class="mysite_select">';
						
			foreach($val as $name => $option){
				$out .= '<option value="' . $option . '"';
				
				foreach($value['default'] as $selected){
					if ( $selected == $option ) {
						$out .= ' selected="selected"';
					}
				}
				
				$out .= '>' . $option . '</option>';
			}
			
			$out .= '</select>';
		}
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- color_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function skin_generator( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? ' class="' . $value['toggle'] . '"' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set radio_option_set">';
		
		$out .= $this->option_start( $value );
		
		$checked_key =  $value['default'];
			
		$i = 0;
		foreach( $value['options'] as $key => $option ) {
			$i++;
			$checked = ( $key == $checked_key ) ? ' checked="checked"' : '';
			
			$out .= '<input type="radio" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '_' . $i . '"' . $toggle .' />';
			$out .= '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .radio_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function skin_select( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? $value['toggle'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'mysite_option_set skin_select_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="' . $toggle . 'mysite_select">';
		
		$value['options'] = $this->select_target_options( $value['target'] );
		
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '"';
			if( isset( $this->saved_skin[$value['id']] ) ) {
				if( $this->saved_skin[$value['id']] == $key ) {
					$out .= ' selected="selected"';
				}
			}
			
			$out .= '>' . esc_attr( $option ) . '</option>';
		}
		
		$out .= '</select>';
		
		$out .= '&nbsp;&nbsp;<input type="submit" value="' . esc_attr__( 'Activate Skin' , MYSITE_ADMIN_TEXTDOMAIN ) . '" id="mysite_activate_skin" class="button-primary" name="mysite_activate_skin" />';
		$out .= '<span class="ajax_feedback_activate_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></span>';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .select_option_set -->';
		
		$out .='<div id="ajax_feedback_skin_loader"><img src="' . esc_url( THEME_ADMIN_ASSETS_URI . '/images/skin-loader.gif' ) . '" alt="" /></div>';
		
		return $out;
	}
	
	
	/**
	 *
	 */
	function icon_preset( $value ) {

		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out = '<div class="' . $toggle_class . 'mysite_option_set icon_option_set">';

		$out .= $this->option_start( $value );

		# Output hidden field (type)
		$out .= '<input type="hidden" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" value="' . ( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '" />';

		# Output preset button and result label
		$out .= '<div id = "'.$value['shortcode'].'_result" class = "icon_result_type" style = "float: left; margin-right: 20px;"></div>';
		$out .= '<a class="icon_preset_button button" data-type="' . $value['shortcode'] . '">' . __( 'Select Preset', MYSITE_ADMIN_TEXTDOMAIN ) . '</a><br />';

		$out .= $this->option_end( $value );

		$out .= '</div>';

		return $out;
	}

	/**
	 *
	 */
	function hidden( $value ) {

		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out = '<div style = "display: none;" class="' . $toggle_class . 'mysite_option_set hidden_option_set">';

		$out .= $this->option_start( $value );

		# Output hidden field
		$out .= '<input type="hidden" name="' . MYSITE_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" value="' . ( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '" />';

		$out .= $this->option_end( $value );

		$out .= '</div>';

		return $out;
	}
	
	
	/**
	 *
	 */
	function image_banner( $value ) {
		
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		if( empty( $this->saved_options[$value['id']] ) )
			$value['default'] = ( isset( $value['default'] ) && is_array( $value['default'] ) ) ? $value['default'] : array();
		else
			$value['default'] = $this->saved_options[$value['id']];
			
		if( $value['id'][0] == '_' )
			$value_rm_un = str_replace( $value['id'][0].$value['id'][1], $value['id'][1], $value['id'] );
		else
			$value_rm_un = $value['id'];
		
		$out = '<div class="'.$toggle_class.' mysite_option_set background_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="text" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][url]" value="' . ( isset( $value['default']['url'] )
		? ( strtolower( $value['default']['url'] ) == 'none' ? strtolower( $value['default']['url'] ) : esc_url(stripslashes( $value['default']['url'] ) )  ) : '' ) . '" id="' . $value_rm_un . '_input' . '" class="mysite_upload" />';
		
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MYSITE_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value_rm_un . ' button" /><br /><br />';
			
		$out .= '<input type="checkbox" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][title]" value="true" id="' . $value_rm_un . '_title' . '"' .
		( isset( $value['default']['title'] ) ? ' checked="checked"' : '' ) . ' />';
		$out .= '<label for="' . $value_rm_un . '_title">' . esc_attr__( 'Display page title on top of image' , MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= '<input type="checkbox" name="' . MYSITE_SETTINGS . '[' . $value['id'] . '][enable_resize]" value="true" id="' . $value_rm_un . '_enable_resize' . '"' .
		( isset( $value['default']['enable_resize'] ) ? ' checked="checked"' : '' ) . ' />';
		$out .= '<label for="' . $value_rm_un . '_enable_resize">' . esc_attr__( 'Enable automatic image resizing' , MYSITE_ADMIN_TEXTDOMAIN ) . '</label><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- background_option_set -->';
		
		return $out;
	}
	
	
	/**
	 *
	 */
	function select_target_options( $type ) {
		$options = array();
		switch( $type ) {
			
			case 'page':
				$entries = get_pages( 'title_li=&orderby=name' );
				foreach( $entries as $key => $entry ) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'cat':
				$entries = get_categories( 'orderby=name&hide_empty=0' );
				foreach( $entries as $key => $entry ) {
					$options[$entry->term_id] = $entry->name;
				}
				break;
			case 'portfolio_category':
				$entries = get_terms('portfolio_category','orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'custom_sidebars':
				$custom_sidebars = ( get_option( MYSITE_SIDEBARS ) ) ? get_option( MYSITE_SIDEBARS ) : array();
				foreach( $custom_sidebars as $key => $value ) {
					$options[$value] = $value;
				}
				break;
			case 'style_variations':
				$options = mysite_style_option();
				break;
			case 'color_variations':
				$variation = mysite_color_variations();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value;
				}
				break;
			case 'link':
				$decoration = array('none', 'overline', 'line-through', 'underline');
				$options = array( 'text-decoration' => $decoration );
				break;
			case 'background':
				$repeat = array('repeat', 'repeat-x', 'repeat-y', 'no-repeat');
				$attachment = array('scroll', 'fixed');
				$position = array( 'left top', 'left center', 'left bottom', 'right top', 'right center', 'right bottom', 'center top', 'center center', 'center bottom' );
				$options = array( 'background-repeat' => $repeat, 'background-attachment' => $attachment, 'background-position' => $position );
				break;
			case 'typography':
				$options = mysite_typography_options();
				break;
			case 'border':
				$size = range(0,72);
				$style = array( 'none', 'hidden', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );
				$options = array( '1' => $size, '2' => $style );
				break;
			case 'slider':
				$options = array(
					'fading_slider' => __( 'Fading Slider', MYSITE_ADMIN_TEXTDOMAIN ),
					'scrolling_slider' => __( 'Scrolling Slider', MYSITE_ADMIN_TEXTDOMAIN ),
					'nivo_slider' => __( 'Nivo Slider', MYSITE_ADMIN_TEXTDOMAIN ),
					'responsive_slider' => __( 'Responsive Slider', MYSITE_ADMIN_TEXTDOMAIN )
				);
				break;
			case 'slider_stage':
				$options = array(
					'staged_slide' => __( 'Staged', MYSITE_ADMIN_TEXTDOMAIN ),
					'partial_staged_slide' => __( 'Partial Staged Right', MYSITE_ADMIN_TEXTDOMAIN ),
					'partial_staged_slideL' => __( 'Partial Staged Left', MYSITE_ADMIN_TEXTDOMAIN ),
					'partial_gradient_slide' => __( 'Partial Gradient', MYSITE_ADMIN_TEXTDOMAIN ),
					'overlay_slide' => __( 'Overlay', MYSITE_ADMIN_TEXTDOMAIN ),
					'floating_slide' => __( 'Floating', MYSITE_ADMIN_TEXTDOMAIN ),
					'full_slide' => __( 'Full', MYSITE_ADMIN_TEXTDOMAIN ),
					'raw_html' => __( 'Full + Raw Html', MYSITE_ADMIN_TEXTDOMAIN )
				);
				break;
			case 'nivo_effects':
				$options = array(
					'sliceDown' => 'sliceDown',
					'sliceDownLeft' => 'sliceDownLeft',
					'sliceUp' => 'sliceUp',
					'sliceUpLeft' => 'sliceUpLeft',
					'sliceUpDown' => 'sliceUpDown',
					'sliceUpDownLeft' => 'sliceUpDownLeft',
					'fold' => 'fold',
					'fade' => 'fade',
					'random' => 'random',
					'slideInRight' => 'slideInRight',
					'slideInLeft' => 'slideInLeft',
					'boxRandom' => 'boxRandom',
					'boxRain' => 'boxRain',
					'boxRainReverse' => 'boxRainReverse',
					'boxRainGrow' => 'boxRainGrow',
					'boxRainGrowReverse' => 'boxRainGrowReverse'
				);
				break;
			case 'post_types':
				$post_types = get_post_types();
				$rempost = array( 'attachment', 'revision', 'nav_menu_item', 'testimonial' );
				$post_types = array_diff( $post_types, $rempost );
				foreach( $post_types as $post_type ) {
					$options[$post_type] = ucwords( $post_type );
				}
				break;
			case 'cat_testimonial':
				$categories = get_terms('testimonial_category','orderby=name&hide_empty=0');
				foreach( $categories as $category ) {
					$options[$category->slug] = $category->name;
				}
				break;
		}
		
		return $options;
	}
	
}

?>