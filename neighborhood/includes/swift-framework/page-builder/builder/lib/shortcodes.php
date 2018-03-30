<?php
	
	/*
	*
	*	Swift Page Builder - Shortcodes Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	abstract class SwiftPageBuilderShortcode extends SFPageBuilderAbstract {
	
	    protected $shortcode;
	
	    protected $atts, $settings;
	
	    public function __construct($settings) {
	        $this->settings = $settings;
	        $this->shortcode = $this->settings['base'];
	        $this->addShortCode($this->shortcode, Array($this, 'output'));
	    }
	
	    public function shortcode($shortcode) {
	
	    }
	
	    abstract protected function content( $atts, $content = null );
	
	    public function contentAdmin($atts, $content) {
	        $element = $this->shortcode;
	        $output = $custom_markup = $width = '';
	
	        if ( $content != NULL ) {
				  $content = wpautop(stripslashes($content)) ;
				  $content = preg_replace('/^\s+|\n|\r|\s+$/m', '', $content);
			}
	
	        if ( isset($this->settings['params']) ) {
	            $shortcode_attributes = array('width' => '1/1');
	            foreach ( $this->settings['params'] as $param ) {
	                if ( $param['param_name'] != 'content' ) {
	                    //var_dump($param['value']);
	                    if ( isset($param['value']) ) {
	                        $shortcode_attributes[$param['param_name']] = is_string($param['value']) ? __($param['value'], "swiftframework") : $param['value'];
	                    } else {
	                        $shortcode_attributes[$param['param_name']] = '';
	                    }
	                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
	                    $content = __($param['value'], "swiftframework");
	                }
	            }
	            extract(shortcode_atts(
	                $shortcode_attributes
	                , $atts));
	            $elem = $this->getElementHolder($width);
	
	            $iner = '';
	            foreach ($this->settings['params'] as $param) {
	                $param_value = ${$param['param_name']};
	                //var_dump($param_value);
	                if ( is_array($param_value)) {
	                    // Get first element from the array
	                    reset($param_value);
	                    $first_key = key($param_value);
	                    $param_value = $param_value[$first_key];
	                }
	                $iner .= $this->singleParamHtmlHolder($param, $param_value);
	            }
	            $elem = str_ireplace('%spb_element_content%', $iner, $elem);
	            $output .= $elem;
	        } else {
	            //This is used for shortcodes without params (like simple divider)
	            // $column_controls = $this->getColumnControls($this->settings['controls']);
	            $width = '1/1';
	
	            $elem = $this->getElementHolder($width);
	
	            $iner = '';
	            if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
	                if ( $content != '' ) {
	                    $custom_markup = str_ireplace("%content%", $content, $this->settings["custom_markup"]);
	                } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
	                    $custom_markup = str_ireplace("%content%", $this->settings["default_content"], $this->settings["custom_markup"]);
	                }
	                //$output .= do_shortcode($this->settings["custom_markup"]);
	                $iner .= do_shortcode($custom_markup);
	            }
	            $elem = str_ireplace('%spb_element_content%', $iner, $elem);
	            $output .= $elem;
	        }
	
	        return $output;
	    }
	    public function output($atts, $content = null, $base = '') {
	        $this->atts = $atts;
	        $output = '';
	
	        $content = empty($content) && !empty($atts['content']) ? $atts['content'] : $content;
	
	        if( is_admin() ) $output .= $this->contentAdmin( $this->atts, $content );
	
	        if( empty($output) ) $output .= $this->content( $this->atts, $content );
	
	        return $output;
	    }
	
	    public function getExtraClass($el_class) {
	        $output = '';
	        if ( $el_class != '' ) {
	            $output = " " . str_replace(".", "", $el_class);
	        }
	        return $output;
	    }
	
	    /**
	     * Create HTML comment for blocks
	     *
	     * @param $string
	     *
	     * @return string
	     */
	
	    public function endBlockComment($string) {
	        return ( !empty($_GET['spb_debug']) &&  $_GET['spb_debug']=='true' ? '<!-- END '.$string.' -->' : '' );
	    }
	
	    /**
         * Start row comment for html shortcode block
         *
         * @param $position - block position
         *
         * @return string
         */

        public function startRow( $position, $col_width = "", $fullwidth = false, $content_mode = "", $alt_style = "", $id = "" ) {
            global $sf_sidebar_config;

            if ( is_singular( 'portfolio' ) ) {
                $sf_sidebar_config = "no-sidebars";
            }

            $output = '';
            
            if ( strpos( $position, 'first' ) !== false ) {
            	if ( $fullwidth && $content_mode == "full-width" ) {
            		$output = ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- START row -->' . "\n" : '' ) . '<section ' . $id . ' class="fw-row asset-bg ' . $alt_style . '"><div class="container-fluid"><div class="row-fluid">';
            	} else if ( $fullwidth && $content_mode == "content-width" ) {
            		$output = ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- START row -->' . "\n" : '' ) . '<section ' . $id . ' class="fw-row row-content-width asset-bg ' . $alt_style . '"><div class="container"><div class="row">';
            	} else if ( $fullwidth ) {
                    $output = ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- START row -->' . "\n" : '' ) . '<section ' . $id . ' class="row fw-row content-width asset-bg ' . $alt_style . '"><div class="container"><div class="row">';
                } else if ( $sf_sidebar_config == "no-sidebars" ) {
                    $output = ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- START row -->' . "\n" : '' ) . '<section ' . $id . ' class="container"><div class="row">';
                } else {
                    $output = ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- START row -->' . "\n" : '' ) . '<section ' . $id . ' class="row">';
                }
            }

            return $output;
        }

        /**
         * End row comment for html shortcode block
         *
         * @param $position -block position
         *
         * @return string
         */

        public function endRow( $position, $col_width = "", $fullwidth = false, $content_mode = "" ) {

            global $sf_sidebar_config;

            if ( is_singular( 'portfolio' ) ) {
                $sf_sidebar_config = "no-sidebars";
            }
            
            $output = '';
            
            if ( strpos( $position, 'last' ) !== false ) {
                if ( $fullwidth && ( $content_mode == "content-width" || $content_mode == "full-width" ) ) {
                	$output = '</div></div></section>' . ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- END row --> ' . "\n" : '' . "\n" );
                } else if ( $fullwidth ) {
                    $output = '</div></div></section>' . ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- END row --> ' . "\n" : '' . "\n" );
                } else if ( $sf_sidebar_config == "no-sidebars" ) {
                    $output = '</div></section>' . ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- END row --> ' . "\n" : '' . "\n" );
                } else {
                    $output = '</section>' . ( ! empty( $_GET['spb_debug'] ) && $_GET['spb_debug'] == 'true' ? "\n" . '<!-- END row --> ' . "\n" : '' . "\n" );
                }
            }

            return $output;
        }
	
	    public function settings($name) {
	        return isset($this->settings[$name]) ? $this->settings[$name] : null;
	    }
	    function getElementHolder($width) {
	
	        $output = '';
	        $column_controls = $this->getColumnControls($this->settings('controls'));
	
	        $output .= '<div data-element_type="'.$this->settings["base"].'" class="'.$this->settings["base"].' spb_content_element spb_sortable '.spb_translateColumnWidthToSpan($width).' '.$this->settings["class"].'">';
	        $output .= '<input type="hidden" class="spb_sc_base" name="element_name-'.$this->shortcode.'" value="'.$this->settings["base"].'" />';
	        $output .= str_replace("%column_size%", spb_translateColumnWidthToFractional($width), $column_controls);
	        $output .= $this->getCallbacks($this->shortcode);
	        $output .= '<div class="spb_element_wrapper '.$this->settings("wrapper_class").'">';
	
	        $output .= '%spb_element_content%';
	
	        $output .= '</div> <!-- end .spb_element_wrapper -->';
	        $output .= '</div> <!-- end #element-'.$this->shortcode.' -->';
	
	        return $output;
	    }
	
	     /* This returs block controls
	---------------------------------------------------------- */
	    public function getColumnControls($controls) {
	        $controls_start = '<div class="controls sidebar-name">';
	        $controls_end = '</div>';
	
	        $right_part_start = '<div class="controls_right">';
	        $right_part_end = '</div>';
	
	        $controls_column_size = ' <div class="column_size_wrapper"> <a class="column_decrease" href="#" title="'.__('Decrease width', "swiftframework").'"></a> <span class="column_size">%column_size%</span> <a class="column_increase" href="#" title="'.__('Increase width', "swiftframework").'"></a> </div>';
	
	        $controls_edit = ' <a class="column_edit" href="#" title="'.__('Edit', "swiftframework").'"></a>';
	        $controls_popup = ' <a class="column_popup" href="#" title="'.__('Pop up', "swiftframework").'"></a>';
	        $controls_delete = ' <a class="column_clone" href="#" title="'.__('Clone', "swiftframework").'"></a> <a class="column_delete" href="#" title="'.__('Delete', "swiftframework").'"></a>';
	        // $delete_edit_row = '<a class="row_delete" title="'.__('Delete %element%', "swiftframework").'">'.__('Delete %element%', "swiftframework").'</a>';
	
	        $column_controls_full = $controls_start . $controls_column_size . $right_part_start . $controls_popup . $controls_edit . $controls_delete . $right_part_end . $controls_end;
	        $column_controls_size_delete = $controls_start . $controls_column_size . $right_part_start . $controls_delete . $right_part_end . $controls_end;
	        $column_controls_popup_delete = $controls_start . $right_part_start . $controls_popup . $controls_delete . $right_part_end . $controls_end;
	        $column_controls_delete = $controls_start . $right_part_start . $controls_delete . $right_part_end . $controls_end;
	        $column_controls_edit_popup_delete = $controls_start . $right_part_start . $controls_popup . $controls_edit . $controls_delete . $right_part_end . $controls_end;
	
	        if ( $controls == 'popup_delete' ) {
	            return $column_controls_popup_delete;
	        }
	        else if ( $controls == 'edit_popup_delete' ) {
	            return $column_controls_edit_popup_delete;
	        }
	        else if ( $controls == 'size_delete' ) {
	            return $column_controls_size_delete;
	        }
	        else if ( $controls == 'popup_delete' ) {
	            return $column_controls_popup_delete;
	        }
	        else {
	            return $column_controls_full;
	        }
	    }
	
	    /* This will fire callbacks if they are defined in map.php
	   ---------------------------------------------------------- */
	    public function getCallbacks($id) {
	        $output = '';
	
	        if (isset($this->settings['js_callback'])) {
	            foreach ($this->settings['js_callback'] as $text_val => $val) {
	                /* TODO: name explain */
	                $output .= '<input type="hidden" class="spb_callback spb_'.$text_val.'_callback " name="'.$text_val.'" value="'.$val.'" />';
	            }
	        }
	
	        return $output;
	    }
	
	    public function singleParamHtmlHolder($param, $value) {
	        $output = '';
	            // Compatibility fixes
	        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
	        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
	        $value = str_ireplace($old_names, $new_names, $value);
	            //$value = __($value, "swiftframework");
	            //
	        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
	        $type = isset($param['type']) ? $param['type'] : '';
	        $class = isset($param['class']) ? $param['class'] : '';
	
	        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
	        $output .= '<input type="hidden" class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
	        }
	        else {
	            $output .= '<'.$param['holder'].' class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
	        }
	        return $output;
	    }
	}
	
	abstract class SwiftPageBuilderShortcode_UniversalAdmin extends SwiftPageBuilderShortcode {
	    public function __construct($settings) {
	        $this->settings = $settings;
	        $this->addShortCode($this->settings['base'], Array($this, 'output'));
	    }
	    protected  function content( $atts, $content = null) {
	        return '';
	    }
	    public function contentAdmin($atts,  $content) {
	
	        $element = $this->settings['base'];
	        $output = '';
	
	        //if ( $content != NULL ) { $content = apply_filters('the_content', $content); }
	        $content = '';
	        if ( isset($this->settings['params']) ) {
	            $shortcode_attributes = array();
	            foreach ( $this->settings['params'] as $param ) {
	                if ( $param['param_name'] != 'content' ) {
	                    $shortcode_attributes[$param['param_name']] = $param['value'];
	                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
	                    $content = $param['value'];
	                }
	            }
	            extract(shortcode_atts(
	                $shortcode_attributes
	                , $atts));
	
	            //$output .= '<div class="span12 spb_edit_form_elements"><h2>'.__('Edit', "swiftframework").' ' .__($this->settings['name'], "swiftframework").'</h2>';
				$output .= '<div class="spb_edit_form_elements">';
				
				$output .= '<div id="edit-modal-header">';
				$output .= '<h2>'.__('Edit', "swiftframework").' ' .__($this->settings['name'], "swiftframework").'</h2>';
				$output .= '<div class="edit_form_actions"><a href="#" class="spb_save_edit_form button-primary">'. __('Save', "swiftframework") .'</a></div>';
				$output .= '</div>';
				
	            foreach ($this->settings['params'] as $param) {
	                $param_value = isset(${$param['param_name']}) ? ${$param['param_name']} : null;
	
	                if ( is_array($param_value)) {
	                    // Get first element from the array
	                    reset($param_value);
	                    $first_key = key($param_value);
	                    $param_value = $param_value[$first_key];
	                }
	                $output .= $this->singleParamEditHolder($param, $param_value);
	            }
	
	            $output .= '</div>'; //close spb_edit_form_elements
	        }
	        return $output;
	    }
	
	    protected function singleParamEditHolder( $param, $param_value ) {
            $output = '';
            $field_visibility = '';

            if ( isset( $param['required'][0] ) ){

            	$req_parent_id       = $param['required'][0];
            	$req_parent_operator = $param['required'][1];
            	$req_parent_value    = $param['required'][2];

                $field_visibility = 'hide';

                $output .= '<div class="row-fluid hide depency-field" data-parent-id="' . $req_parent_id . '" data-parent-operator="' . $req_parent_operator . '" data-parent-value="' . $req_parent_value . '">';
            }
            else{
				$output .= '<div class="row-fluid">';
			}

            if ( $param['type'] == "section" ) {

                $output .= '<div class="span12 spb_element_section">' . __( $param['heading'], 'swiftframework' ) . '</div>';

            } else {

                $output .= '<label class="spb_element_label">' . __( $param['heading'], 'swiftframework' ) . '</label>';

                $output .= '<div class="edit_form_line">';
                $output .= $this->singleParamEditForm( $param, $param_value );
                $output .= ( isset( $param['description'] ) ) ? '<span class="description">' . __( $param['description'], 'swiftframework' ) . '</span>' : '';
                $output .= '</div>';

            }

            $output .= '</div>';

            return $output;
        }
	
	    protected function singleParamEditForm( $param, $param_value ) {
            $param_line = '';

            // Textfield - input
            if ( $param['type'] == 'textfield' ) {
                $value = __( $param_value, 'swiftframework' );
                $value = $param_value;

                if ( $param['param_name'] == 'address' && $param_value == __( 'Click the edit button to change the map pin details.', 'swiftframework' ) ) {
                    $param_line .= '<input name="' . $param['param_name'] . '" class="spb_param_value spb-textinput ' . $param['param_name'] . ' ' . $param['type'] . '" type="text" value="" data-previous-text="' . __( 'Click the edit button to change the map pin details.', 'swiftframework' ) . '"/>';
                } else {
                    $param_line .= '<input name="' . $param['param_name'] . '" class="spb_param_value spb-textinput ' . $param['param_name'] . ' ' . $param['type'] . '" type="text" value="' . $value . '" />';
                }

            } // Textfield - color
            else if ( $param['type'] == 'colorpicker' ) {
                $value = __( $param_value, 'swiftframework' );
                $value = $param_value;
                $param_line .= '<input name="' . $param['param_name'] . '" class="spb_param_value spb-colorpicker ' . $param['param_name'] . ' ' . $param['type'] . '" type="text" value="' . $value . '" maxlength="6" size"6" />';
            } // Slider - uislider
            else if ( $param['type'] == 'uislider' ) {
                $value = $param_value;
                $min   = isset( $param['min'] ) ? $param['min'] : 0;
                $max   = isset( $param['max'] ) ? $param['max'] : 800;
                $step  = isset( $param['step'] ) ? $param['step'] : 5;
                $param_line .= '<div class="noUiSlider"></div><input name="' . $param['param_name'] . '" class="spb_param_value spb-uislider ' . $param['param_name'] . ' ' . $param['type'] . '" type="text" value="' . $value . '" maxlength="6" size"6" data-min="' . $min . '" data-max="' . $max . '" data-step="' . $step . '" />';
            } // Buttonset
	        else if ( $param['type'] == 'buttonset' ) {
	            $param_line .= '<fieldset id="' . $param['param_name'] . '" class="spb-buttonset">';

				$param_line .= '<input name="' . $param['param_name'] . '" class="spb_param_value ' . $param['param_name'] . ' ' . $param['type'] . '" value="'.$param_value.'" type="hidden" />';

	            foreach ( $param['value'] as $text_val => $val ) {

	                $text_val = __( $text_val, 'swiftframework' );
	                $checked = '';
	                if ( $val == $param_value ) {
	                    $checked = 'checked="checked"';
	                }

	                $id =  $param['param_name'] . '-' . $val;

	                $param_line .= '<input type="radio" name="' . $param['param_name'] . '" id="' . $id . '" data-id="' . $val . '" class="buttonset-item  ui-helper-hidden-accessible" ' . $checked . '></input>';
	                $param_line .= '<label for="' . $id . '" class="ui-button ui-widget"><span class="ui-button-text">' . $text_val . '</span></label>';
	            }
	            $param_line .= '</fieldset>';
            } // Dropdown - select
            else if ( $param['type'] == 'dropdown' ) {

	            $default = $param_value;

				if ( isset( $param['std'] ) ) {
					$default = $param['std'];
				}

                $param_line .= '<select name="' . $param['param_name'] . '" class="spb_param_value spb-input spb-select ' . $param['param_name'] . ' ' . $param['type'] . '" data-default="'.$default.'">';

                foreach ( $param['value'] as $text_val => $val ) {
                    if ( is_numeric( $text_val ) && is_string( $val ) || is_numeric( $text_val ) && is_numeric( $val ) ) {
                        $text_val = $val;
                    }
                    $text_val = __( $text_val, 'swiftframework' );
                    //$val      = strtolower( str_replace( array( " " ), array( "_" ), $val ) );
                    $val      = str_replace( array( " " ), array( "_" ), $val );
                    $selected = '';
                    if ( $val == $param_value ) {
                        $selected = ' selected="selected"';
                    }
                    $param_line .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
                }
                $param_line .= '</select>';
            } // Dropdown (id) - select
            else if ( $param['type'] == 'dropdown-id' ) {
                $param_line .= '<select name="' . $param['param_name'] . '" class="spb_param_value spb-input spb-select ' . $param['param_name'] . ' ' . $param['type'] . '">';

                foreach ( $param['value'] as $val => $text_val ) {
                    $text_val = __( $text_val, 'swiftframework' );
                    $selected = '';
                    if ( $val == $param_value ) {
                        $selected = ' selected="selected"';
                    }
                    $param_line .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
                }
                $param_line .= '</select>';
            } // Multi - select
            else if ( $param['type'] == 'select-multiple' ) {
                $param_line .= '<select multiple name="' . $param['param_name'] . '" class="spb_param_value spb-select ' . $param['param_name'] . ' ' . $param['type'] . '" type="hidden" value="" name="" multiple>';

                $selected_values = explode( ",", $param_value );

                foreach ( $param['value'] as $text_val => $val ) {

                    if ( is_numeric( $text_val ) && is_string( $val ) || is_numeric( $text_val ) && is_numeric( $val ) ) {
                        $text_val = $val;
                    }
                    $text_val = __( $text_val, 'swiftframework' );
                    $selected = '';
                    if ( in_array( $val, $selected_values ) ) {
                        $selected = ' selected="selected"';
                    }
                    $param_line .= '<option id="' . $text_val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
                }
                $param_line .= '</select>';
            } // Multi (id) - select
            else if ( $param['type'] == 'select-multiple-id' ) {
                $param_line .= '<select multiple name="' . $param['param_name'] . '" class="spb_param_value spb-select ' . $param['param_name'] . ' ' . $param['type'] . '" type="hidden" value="" name="" multiple>';

                $selected_values = explode( ",", $param_value );

                foreach ( $param['value'] as $val => $text_val ) {

                    $text_val = __( $text_val, 'swiftframework' );
                    $selected = '';
                    if ( in_array( $val, $selected_values ) ) {
                        $selected = ' selected="selected"';
                    }
                    $param_line .= '<option id="' . $val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
                }
                $param_line .= '</select>';
            } // Encoded field
            else if ( $param['type'] == 'textarea_encoded' ) {
            	$param_value = htmlentities( rawurldecode( base64_decode( $param_value ) ), ENT_COMPAT, 'UTF-8' );
                $param_line .= '<textarea name="' . $param['param_name'] . '" class="spb_param_value spb-textarea spb-encoded-textarea ' . $param['param_name'] . ' ' . $param['type'] . '">' . $param_value . '</textarea>';
            } // WYSIWYG field
            else if ( $param['type'] == 'textarea_html' ) {
                $param_line .= $this->getTinyHtmlTextArea( $param, $param_value );
            } // Checkboxes with post types
            else if ( $param['type'] == 'posttypes' ) {
                $param_line .= '<input class="spb_param_value spb-checkboxes" type="hidden" value="" name="" />';
                $args       = array(
                    'public' => true
                );
                $post_types = get_post_types( $args );
                foreach ( $post_types as $post_type ) {
                    $checked = "";
                    if ( $post_type != 'attachment' ) {
                        if ( in_array( $post_type, explode( ",", $param_value ) ) ) {
                            $checked = ' checked="checked"';
                        }
                        $param_line .= ' <input id="' . $post_type . '" class="' . $param['param_name'] . ' ' . $param['type'] . '" type="checkbox" name="' . $param['param_name'] . '"' . $checked . '> ' . $post_type;
                    }
                }
            } // Exploded textarea
            else if ( $param['type'] == 'exploded_textarea' ) {
                $param_value = str_replace( ",", "\n", $param_value );
                $param_line .= '<textarea name="' . $param['param_name'] . '" class="spb_param_value spb-textarea ' . $param['param_name'] . ' ' . $param['type'] . '">' . $param_value . '</textarea>';
            } // Big Regular textarea
            else if ( $param['type'] == 'textarea_raw_html' ) {
                // $param_value = __($param_value, 'swiftframework');
                $param_line .= '<textarea name="' . $param['param_name'] . '" class="spb_param_value spb-textarea_raw_html ' . $param['param_name'] . ' ' . $param['type'] . '" rows="16">' . htmlentities( rawurldecode( base64_decode( $param_value ) ), ENT_COMPAT, 'UTF-8' ) . '</textarea>';
            } // Regular textarea
            else if ( $param['type'] == 'textarea' ) {
                $param_value = __( $param_value, 'swiftframework' );
                $param_line .= '<textarea name="' . $param['param_name'] . '" class="spb_param_value spb-textarea ' . $param['param_name'] . ' ' . $param['type'] . '">' . $param_value . '</textarea>';
            } // Attach images
            else if ( $param['type'] == 'attach_images' ) {
                // TODO: More native way
                $param_value = spb_removeNotExistingImgIDs( $param_value );
                $param_line .= '<input type="hidden" class="spb_param_value gallery_widget_attached_images_ids ' . $param['param_name'] . ' ' . $param['type'] . '" name="' . $param['param_name'] . '" value="' . $param_value . '" />';
                $param_line .= '<a class="button gallery_widget_add_images" href="#" title="' . __( 'Add images', 'swiftframework' ) . '">' . __( 'Add images', 'swiftframework' ) . '</a>';
                $param_line .= '<div class="gallery_widget_attached_images">';
                $param_line .= '<ul class="gallery_widget_attached_images_list">';
                $param_line .= ( $param_value != '' ) ? spb_fieldAttachedImages( explode( ",", $param_value ) ) : '';
                $param_line .= '</ul>';
                $param_line .= '</div>';
                $param_line .= '<div class="spb_clear"></div>';
            } else if ( $param['type'] == 'attach_image' ) {
                // TODO: More native way
                $param_value = spb_removeNotExistingImgIDs( preg_replace( '/[^\d]/', '', $param_value ) );
                $param_line .= '<input type="hidden" class="spb_param_value gallery_widget_attached_images_ids ' . $param['param_name'] . ' ' . $param['type'] . '" name="' . $param['param_name'] . '" value="' . $param_value . '" />';
                $param_line .= '<a class="button gallery_widget_add_images" href="#" use-single="true" title="' . __( 'Add image', 'swiftframework' ) . '" data-uploader_title="' . __( 'Add image', 'swiftframework' ) . '">' . __( 'Add image', 'swiftframework' ) . '</a>';
                $param_line .= '<div class="gallery_widget_attached_images">';
                $param_line .= '<ul class="gallery_widget_attached_images_list">';
                $param_line .= ( $param_value != '' ) ? spb_fieldAttachedImages( explode( ",", $param_value ) ) : '';
                $param_line .= '</ul>';
                $param_line .= '</div>';
                $param_line .= '<div class="spb_clear"></div>';
            }       //
            else if ( $param['type'] == 'widgetised_sidebars' ) {
                $spb_sidebar_ids = Array();
                $sidebars        = $GLOBALS['wp_registered_sidebars'];

                $param_line .= '<select name="' . $param['param_name'] . '" class="spb_param_value dropdown spb-input spb-select ' . $param['param_name'] . ' ' . $param['type'] . '">';
                foreach ( $sidebars as $sidebar ) {
                    $selected = '';
                    if ( $sidebar["id"] == $param_value ) {
                        $selected = ' selected="selected"';
                    }
                    $sidebar_name = __( $sidebar["name"], 'swiftframework' );
                    $param_line .= '<option value="' . $sidebar["id"] . '"' . $selected . '>' . $sidebar_name . '</option>';
                }
                $param_line .= '</select>';
            } else if ( $param['type'] == 'icon-picker' ) {
                $value = __( $param_value, 'swiftframework' );
                $value = $param_value;
				$param_line .= '<div class="span9 edit_form_line"><input type="text" class="search-icon-grid textfield" placeholder="Search Icon"></div><input name="'.$param['param_name'].'" class="spb_param_value icon-picker '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$value.'" style="visibility: hidden;height: 0;" /><ul class="font-icon-grid">'.sf_get_icons_list().'</ul>';

            }


            return $param_line;
        }

	    protected function getTinyHtmlTextArea($param = array(), $param_value) {
	        $param_line = '';
	
	        //$upload_media_btns = '<div class="spb_media-buttons hide-if-no-js"> '.__('Upload/Insert').' <a title="'.__('Add an Image').'" class="spb_insert-image" href="#"><img alt="'.__('Add an Image').'" src="'.home_url().'/wp-admin/images/media-button-image.gif"></a> <a class="spb_switch-editors" title="'.__('Switch Editors').'" href="#">HTML mode</a></div>';
	
	        if ( function_exists('wp_editor') ) {
	            $default_content = __($param_value, "swiftframework");
	            $output_value = '';
	            // WP 3.3+
	            ob_start();
	            wp_editor($default_content, 'spb_tinymce_'.$param['param_name'], array('editor_class' => 'spb_param_value spb-textarea spb_tinymce '.$param['param_name'].' '.$param['type'], 'media_buttons' => true ) );
	            $output_value = ob_get_contents();
	            ob_end_clean();
	            $param_line .= $output_value;
	        }
	        return $param_line;
	    }
	}
	
	
	class SwiftPageBuilderShortcode_Settings extends SwiftPageBuilderShortcode_UniversalAdmin {
	
	    public function content( $atts, $content = null ) {
	        return '';
	    }
	
	    public function contentAdmin($atts, $content) {
	
	        $output = '';
	
	        //if ( $content != NULL ) { $content = apply_filters('the_content', $content); }
	        if ( isset($this->settings['params']) ) {
	            $shortcode_attributes = array();
	            foreach ( $this->settings['params'] as $param ) {
	                if ( $param['param_name'] != 'content' ) {
	                    $shortcode_attributes[$param['param_name']] = isset($param['value']) ? $param['value'] : null;
	                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
	                    $content = $param['value'];
	                }
	            }
	            extract(shortcode_atts(
	                $shortcode_attributes
	                , $atts));
	
	            //$output .= '<div class="span12 spb_edit_form_elements"><h2>'.__('Edit', "swiftframework").' ' .__($this->settings['name'], "swiftframework").'</h2>';
				$output .= '<div class="spb_edit_form_elements">';
				$output .= '<div id="edit-modal-header">';
				$output .= '<h2>'.__('Edit', "swiftframework").' ' .__($this->settings['name'], "swiftframework").'</h2>';
				$output .= '<div class="edit_form_actions"><a href="#" id="cancel-background-options">' . __('Cancel', "swiftframework") . '</a><a href="#" class="spb_save_edit_form button-primary">'. __('Save', "swiftframework") .'</a></div>';
				$output .= '</div>';
				
				$output .= '<div class="spb_edit_wrap">';
				
	            foreach ($this->settings['params'] as $param) {
	                $param_value = isset(${$param['param_name']}) ? ${$param['param_name']} : null;
	
	                if ( is_array($param_value)) {
	                    // Get first element from the array
	                    reset($param_value);
	                    $first_key = key($param_value);
	                    $param_value = $param_value[$first_key];
	                }
	                $output .= $this->singleParamEditHolder($param, $param_value);
	            }
	
	            $output .= '</div></div>'; //close spb_edit_form_elements
	        }
	
	        return $output;
	    }
	}

?>
