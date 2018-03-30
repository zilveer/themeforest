<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. class BTP_Option_View
 * 2. class BTP_Option_View_Info
 * 3. class BTP_Option_View_String   
 * 4. class BTP_Option_View_Checkbox
 * 5. class BTP_Option_View_Choice
 * 6. class BTP_Option_View_Text
 * 7. class BTP_Option_View_Color
 * 8. class BTP_Option_View_Image_Choice
 * 9. class BTP_Option_View_Range
 */

/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );

/**
 * Abstract Option View Layer
 * 
 * @package			BTP_Framework
 * @subpackage		BTP_Option 
 */
abstract class BTP_Option_View {
	
	/**
	 * Identifier
	 * @var 	string
	 */
	protected	$id;
	
	/**
	 * Arguments
	 * @var 	array
	 */
	protected	$args;
	
	
				
	/**
	 * Constructor
	 * 
	 * @param 			$id
	 * @param 			$args
	 * @param 			$value
	 */			
	public function __construct( $id, $args, $value = null ) {
		$this->id = $id;
		$this->args = array_multimerge(
			array(
				'label'		=> null,
				'name'		=> null,
				'hint'		=> null,
				'help'		=> null,
				'default'	=> null,
				'prefix'	=> null,
			),
			$args
		);		
		$this->value = $value;
	}			
				
	abstract public function get_css_class();			
					
	public function set_id( $v ) { $this->id = $v; }	
	public function get_id() { return $this->id; }
	
	public function get_final_id() {
		if ( strlen( $this->args[ 'prefix' ] ) )
			return $this->args[ 'prefix' ] . '_' . $this->id;
		else
			return $this->id;
	}
	
	public function set_label( $v ) { $this->args['label'] = $v; }	
	public function get_label() { 
		return ( $this->args[ 'label' ] === null) ? $this->id : $this->args[ 'label' ];
	}
	
	public function set_help( $v ) { $this->args['help'] = $v; }	
	public function get_help() {
		if ( isset( $this->args[ 'help_cb' ] ) && is_callable( $this->args[ 'help_cb' ] ) ) {
			return call_user_func( $this->args[ 'help_cb' ] );
		} else {
			return $this->args['help'];
		}	 
	}
	
	public function set_hint( $v ) { $this->args['hint'] = $v; }	
	public function get_hint() { return $this->args['hint']; }
	
	public function set_name( $v ) { $this->args['name'] = $v; }	
	public function get_name() {
		if ( strlen( $this->args[ 'name' ] ) )
			return $this->args[ 'name' ];
			
		if ( strlen( $this->args[ 'prefix' ] ) ) {
			return $this->args[ 'prefix' ] . '[' . $this->id .']';	
		}
		
		return $this->id;
	}
	
	public function set_value( $v ) { $this->value = $v; }
	public function get_value() { return $this->value; }
	
	
	public function get_choices() {
		if ( isset( $this->args[ 'choices_cb' ] ) ) {
			if ( is_callable( $this->args[ 'choices_cb' ] ) ){
				return call_user_func( $this->args[ 'choices_cb' ] );
			}
		} elseif ( isset( $this->args[ 'choices' ] ) ) {
			return $this->args[ 'choices' ];
		} else {
			return array();
		}		
	}
	
	public function get_final_choices() {
		$result = $this->get_choices();
		
		if ( isset( $this->args[ 'null' ] ) ) {
			$result = array( '' => $this->args[ 'null' ] ) + $result;
		}	
	
		return $result;
	}	
	
	public function has_children() {
		if (  
			isset( $this->args[ 'children' ] ) && 
			is_array( $this->args[ 'children' ] ) && 
			count( $this->args[ 'children' ] ) 
		) {
			return true;
		}
		
		return false;
	}
	
	
	/**
	 * Captures the markup
	 * 
	 * @return			string
	 */
	public function capture() {
		$out = '';
		
		$class = '';
		$class .= 'btp-option-view ';
		
		$has_children = isset( $this->args[ 'children' ] ) && is_array( $this->args[ 'children' ] ) && count( $this->args[ 'children' ] );
		
		if ( $this->has_children() ) {
			$class .= 'btp-option-view-children ';
		}
		
		$class .= sanitize_html_class( $this->get_css_class() ) .' ';

		$out .= '<div id="' . esc_attr( $this->get_final_id() ) . '" class="' . $class . '">';
		if ( $this->has_children() ) {
			$out .= '<div class="btp-option-view-children-title">';
				$out .= $this->capture_label();
				$out .= $this->capture_hint();
			$out .= '</div>';
			
			$out .= '<div class="btp-option-view-children-content">';	
				$out .= $this->capture_children();
			$out .= '</div>';						
		} else {	 
			$out .= $this->capture_label();				
			$out .= $this->capture_help();
			$out .= $this->capture_field();
			$out .= $this->capture_hint();
		}	
		$out .= '</div>';
		
		return $out;
	}
	
	
	
	/**
	 * Renders the markup 
	 */
	public function render() {
		echo $this->capture();
	}
	
	
	
	/**
	 * Captures the markup for the children element
	 * 
	 * @return			string
	 */
	public function capture_children() {
		$out = '';
		
		$value = $this->get_value();
		
		$out .= '<div class="btp-children">';
		
		foreach( $this->args[ 'children' ] as $item_id => $option ) {
        	if ( strlen( $option[ 'view' ] ) ) {
				$option_view_class = 'BTP_Option_View_'.$option[ 'view' ];
				
				$subvalue = null;
				if ( is_array( $value ) && isset ( $value[ $item_id ] ) ) {
					$subvalue = $value[ $item_id ];
				}	
				
	            $option_view = new $option_view_class(
	            	$this->get_name() . '[' .$item_id . ']',
	            	$option,							
	            	$subvalue 		
	            );
	            
	            $out .= $option_view->capture();
        	}        
		}	
		
		$out .= '</div>';
		
		return $out;
	}	
	
	
	
	/**
	 * Captures the markup for the label element
	 * 
	 * @return			string
	 */
	public function capture_label() {
		$out = '';	
		$out .= '<div class="btp-label">';
		if ( $this->has_children() ) {
			$out .= '<h4>' . esc_html( $this->get_label() ) . '</h4>';
		} else {
			$out .= '<label>'. esc_html( $this->get_label() ) . '</label>';	
		}	
		$out .= '</div>';
		
		return $out;
	}

	
	
	/**
	 * Captures the markup for the help element
	 * 
	 * @return			string
	 */
	public function capture_help() {
		$out = '';
		
		if ( strlen( $this->get_help() ) ) {
			$out .= '<div class="btp-help">';
				$out .= '<div class="btp-help-toggle"></div>';
				$out .= '<div class="btp-help-content">';
					$out .= $this->get_help();
				$out .= '</div>';
			$out .= '</div>';
		}
		
		return $out;
	}
	
	
	
	/**
	 * Captures the markup for the field element
	 * 
	 * @return			string  
	 */
	public function capture_field() {
		$out = '';
		
		$out .= '<div class="btp-field">';
			$out .= '<input type="text" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $this->get_value() ) . '" />';
		$out .= '</div>';
		
		return $out;
	}
	
	
	
	/**
	 * Captures the markup for the hint element
	 * 
	 * @return			string
	 */
	public function capture_hint() {
		$out = '';				
		
		if ( strlen( $this->get_hint() ) ) {
			$out .= '<div class="btp-hint">';
				$out .= $this->get_hint();
			$out .= '</div>';
		}
		
		return $out;
	}
}



class BTP_Option_View_Info extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-info'; }
	
	public function capture() {
		$out = '';
		
		$class = '';
		$class .= 'btp-option-view ';
		$class .= sanitize_html_class( $this->get_css_class() ) .' ';

		$out .= '<div id="' . esc_attr( $this->get_final_id() ) . '" class="' . $class . '">';
			$out .= $this->capture_help();
		$out .= '</div>';
		
		return $out;
	}
	
	public function capture_help() {
		$out = '';
					
		if ( strlen( $this->get_help() ) ) {
			$out .= '<div>';
				$out .= $this->get_help();
			$out .= '</div>';
		}
		
		return $out;
	}
}



class BTP_Option_View_String extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-string'; }
	
	public function capture_field() {
		$out = '';
		
		$out .= '<div class="btp-field btp-field-input-text">';
			$out .= '<input type="text" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $this->get_value() ) . '" />';
		$out .= '</div>';
		
		return $out;
	}
}



class BTP_Option_View_Checkbox extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-checkbox'; }	
	
	public function capture_field() {
		$out = '';
		
		$out .= '<div class="btp-field btp-field-checkbox">';
		if( $this->get_value() !== null ) {
			$out .= '<input type="checkbox" name="' . esc_attr( $this->get_name() ) . '" value="true" checked="checked" />';
		} else {	
			$out .= '<input type="checkbox" name="' . esc_attr( $this->get_name() ) . '" value="true" />';
		}
		$out .= '</div>';
		
		return $out;
	}
}



class BTP_Option_View_Choice extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-choice'; }
	
	public function capture_field() {
		$out = '';

		$out .= '<div class="btp-field btp-field-select">';		
			$out .= '<select name="' . esc_attr( $this->get_name() ) . '">';
			
			$choices = $this->get_final_choices();			
			
			foreach( $choices as $k => $v ) {
				if ( is_array( $v ) && count( $v ) ) {
					$out .= '<optgroup label="' . esc_attr( $k ) .'">';

					foreach ( $v as $k2 => $v2 ) {
						if ( $k2 == $this->get_value() ) {
							$out .= '<option selected="selected" value="' . esc_attr( $k2 ) . '">' . esc_html( $v2 ) . '</option>';	
						} else {
							$out .= '<option value="' . esc_attr( $k2 ) . '">' . esc_html( $v2 ) . '</option>';
						}
					}	
					
					$out .= '</optgroup>';
				} else if ( $k == $this->get_value() ) {
					$out .= '<option selected="selected" value="' . esc_attr( $k ) . '">' . esc_html( $v ) . '</option>';	
				} else {
					$out .= '<option value="' . esc_attr( $k ) . '">' . esc_html( $v ) . '</option>';
				}
			}
				
			$out .= '</select>';
		$out .= '</div>';
		
		return $out;
	}
	
	
}



class BTP_Option_View_Text extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-text'; }
	
	public function capture_field() {
		$out = '';
		
		$out .= '<div class="btp-field btp-field-textarea">';
			$out .= '<textarea name="' . esc_attr( $this->get_name() ) . '" cols="10" rows="10">';
				$out .= esc_textarea( $this->get_value() );
			$out .= '</textarea>';
		$out .= '</div>';
		
		return $out;
	}
}



class BTP_Option_View_Color extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-color'; }
	
	public function capture_field() {		
		$out = '';
		
		$out .= '<div class="btp-field btp-field-color" tabindex="-1">';
			$out .= '<span class="btp-color-picker-preview">';
				if ( strlen( $this->get_value() ) ) {
            		$out .= '<span class="btp-color-picker-preview-current" style="background: ' . $this->get_value() . ';"></span>';
				} else {
					$out .= '<span class="btp-color-picker-preview-current"></span>';
				}
				
				$out .= '<span class="btp-color-picker-preview-new"></span>';
            $out .= '</span>';

            $out .= '<input type="text" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $this->get_value() ) . '" />';
			$out .= '<span class="btp-color-picker-toggle">' . __( 'Color Picker', 'btp_theme' ) . '</span>';            	
       		$out .= '<div class="btp-color-picker-container"></div>';
		$out .= '</div>';
		
		return $out;
	}
}



class BTP_Option_View_Image_Choice extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-image-choice'; }
	
	public function capture_field() {
		$out = '';
		$i = 0;
		
		$out .= '<div class="btp-field btp-field-image-choice">';
		foreach( $this->get_final_choices() as $opt_value => $opt_img ) {
			$out .= '<div>';
				$out .= '<label>';
					if ( $opt_value === $this->get_value() || ( 0 == $i && !strlen( $this->get_value() ) ) ) {
						$out .= '<input type="radio" name="' . esc_attr( $this->get_name() ) . '" checked="checked" value="' . esc_attr( $opt_value ) . '" />';
					} else {					
						$out .= '<input type="radio" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $opt_value ) . '" />';
					}	

                    $alt = !empty( $opt_value ) ? esc_attr( $opt_value ) : esc_url( $opt_img );

                    $out .= '<img src="' . esc_url( $opt_img ) . '" alt="' . $alt . '" title="' . esc_attr( $opt_value ) . '" />';
				$out .= '</label>';
			$out .= '</div>';
			$i++; 
		}
		$out .= '</div>';	
				
		return $out;
	}	
}



class BTP_Option_View_Range extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-range'; }
	
	public function capture_field() {
		$out = '';		
		
		if( !isset( $this->args[ 'min' ] ) ) 
			$this->args[ 'min' ] = 0; 
		if( !isset( $this->args[ 'max' ] ) ) 
			$this->args[ 'max' ] = 100;	
		if( !isset( $this->args[ 'step' ] ) ) 
			$this->args[ 'step' ] = 1;
       		
		$out .= '<div class="btp-field btp-field-range">';
			$out .= '<input type="range" min="' . esc_attr( $this->args[ 'min'] ) . '" max="' . esc_attr( $this->args[ 'max'] ) . '" step="' . esc_attr( $this->args[ 'step'] ) .'" name="' . esc_attr( $this->get_name() ) . '" value="' . esc_attr( $this->get_value() ) . '" />';
		$out .= '</div>';
		
		return $out;
	}
}



class BTP_Option_View_Children extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-children'; }
}



class BTP_Option_View_Font extends BTP_Option_View_Choice {
	public function get_css_class() { return 'btp-option-view-font'; }
}

class BTP_Option_View_CSS extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-css'; }
}

?>