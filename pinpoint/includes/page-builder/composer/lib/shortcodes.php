<?php
/**
 * Swift Page Builder Shortcodes main
 *
 * @package WPBakeryVisualComposer
 *
 */

/*
This is were shortcodes for default content elements are
defined. Each element should have shortcode for frontend
display (on a website).

This will add shortcode that will be used in frontend site
*/

abstract class WPBakeryShortCode extends SwiftPageBuilderAbstract {

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

        if ( $content != NULL ) { $content = wpautop(stripslashes($content)); }

        if ( isset($this->settings['params']) ) {
            $shortcode_attributes = array('width' => '1/1');
            foreach ( $this->settings['params'] as $param ) {
                if ( $param['param_name'] != 'content' ) {
                    //var_dump($param['value']);
                    if ( isset($param['value']) ) {
                        $shortcode_attributes[$param['param_name']] = is_string($param['value']) ? __($param['value'], "js_composer") : $param['value'];
                    } else {
                        $shortcode_attributes[$param['param_name']] = '';
                    }
                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                    $content = __($param['value'], "js_composer");
                }
            }
            extract(shortcode_atts(
                $shortcode_attributes
                , $atts));
            $elem = $this->getElementHolder($width);

            $iner = '';
            foreach ($this->settings['params'] as $param) {
                $param_value = $$param['param_name'];
                //var_dump($param_value);
                if ( is_array($param_value)) {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $iner .= $this->singleParamHtmlHolder($param, $param_value);
            }
            $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
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
            $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
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
        return ( !empty($_GET['wpb_debug']) &&  $_GET['wpb_debug']=='true' ? '<!-- END '.$string.' -->' : '' );
    }

    /**
     * Start row comment for html shortcode block
     *
     * @param $position - block position
     * @return string
     */

    public function startRow($position) {
        $output = '';
        if ( strpos($position, 'first') !== false ) {
            $output = ( !empty($_GET['wpb_debug']) &&  $_GET['wpb_debug']=='true' ? "\n" . '<!-- START row -->' ."\n" : '' ) . '<div class="row-fluid">';
        }
        return $output;
    }

    /**
     * End row comment for html shortcode block
     *
     * @param $position -block position
     * @return string
     */

    public function endRow($position) {
        $output = '';
        if ( strpos($position, 'last') !== false ) {
            $output = '</div>'. ( !empty($_GET['wpb_debug']) &&  $_GET['wpb_debug']=='true' ? "\n" .  '<!-- END row --> ' . "\n" : '' );
        }
        return $output;
    }

    public function settings($name) {
        return isset($this->settings[$name]) ? $this->settings[$name] : null;
    }
    function getElementHolder($width) {

        $output = '';
        $column_controls = $this->getColumnControls($this->settings('controls'));

        $output .= '<div data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings["base"].' wpb_content_element wpb_sortable '.wpb_translateColumnWidthToSpan($width).' '.$this->settings["class"].'">';
        $output .= '<input type="hidden" class="wpb_vc_sc_base" name="element_name-'.$this->shortcode.'" value="'.$this->settings["base"].'" />';
        $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width), $column_controls);
        $output .= $this->getCallbacks($this->shortcode);
        $output .= '<div class="wpb_element_wrapper '.$this->settings("wrapper_class").'">';

        $output .= '%wpb_element_content%';

        $output .= '</div> <!-- end .wpb_element_wrapper -->';
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

        $controls_column_size = ' <div class="column_size_wrapper"> <a class="column_decrease" href="#" title="'.__('Decrease width', 'js_composer').'"></a> <span class="column_size">%column_size%</span> <a class="column_increase" href="#" title="'.__('Increase width', 'js_composer').'"></a> </div>';

        $controls_edit = ' <a class="column_edit" href="#" title="'.__('Edit', 'js_composer').'"></a>';
        $controls_popup = ' <a class="column_popup" href="#" title="'.__('Pop up', 'js_composer').'"></a>';
        $controls_delete = ' <a class="column_clone" href="#" title="'.__('Clone', 'js_composer').'"></a> <a class="column_delete" href="#" title="'.__('Delete', 'js_composer').'"></a>';
        // $delete_edit_row = '<a class="row_delete" title="'.__('Delete %element%', "js_composer").'">'.__('Delete %element%', "js_composer").'</a>';

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
                $output .= '<input type="hidden" class="wpb_vc_callback wpb_vc_'.$text_val.'_callback " name="'.$text_val.'" value="'.$val.'" />';
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
            //$value = __($value, "js_composer");
            //
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
        $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
        }
        else {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        return $output;
    }
}

abstract class WPBakeryShortCode_UniversalAdmin extends WPBakeryShortCode {
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

            $output .= '<div class="span12 wpb_edit_form_elements"><h2>'.__('Edit', 'js_composer').' ' .__($this->settings['name'], "js_composer").'</h2>';

            foreach ($this->settings['params'] as $param) {
                $param_value = '';
                eval("\$param_value = \$".$param['param_name'].";");

                if ( is_array($param_value)) {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $output .= $this->singleParamEditHolder($param, $param_value);
            }

            $output .= '<div class="edit_form_actions"><a href="#" class="wpb_save_edit_form button-primary">'. __('Save', "js_composer") .'</a></div>';

            $output .= '</div>'; //close wpb_edit_form_elements
        }
        return $output;
    }

    protected function singleParamEditHolder($param, $param_value) {
        $output = '';

        $output .= '<div class="row-fluid">';
        $output .= '<div class="span3 wpb_element_label">'.__($param['heading'], "js_composer").'</div>';

        $output .= '<div class="span9 edit_form_line">';
        $output .= $this->singleParamEditForm($param, $param_value);
        $output .= (isset($param['description'])) ? '<span class="description">'.__($param['description'], "js_composer").'</span>' : '';
        $output .= '</div>';

        $output .= '</div>';

        return $output;
    }

    protected function singleParamEditForm($param, $param_value) {
        $param_line = '';

        // Textfield - input
        if ( $param['type'] == 'textfield' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$value.'" />';
        }
        // Dropdown - select
        else if ( $param['type'] == 'dropdown' ) {
            $param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';

            foreach ( $param['value'] as $text_val => $val ) {
                if ( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
                    $text_val = $val;
                }
                $text_val = __($text_val, "js_composer");
                $val = strtolower(str_replace(array(" "), array("_"), $val));
                $selected = '';
                if ( $val == $param_value ) $selected = ' selected="selected"';
                $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
            }
            $param_line .= '</select>';
        }
        // WYSIWYG field
        else if ( $param['type'] == 'textarea_html' ) {
            $param_line .= $this->getTinyHtmlTextArea($param, $param_value);
        }
        // Checkboxes with post types
        else if ( $param['type'] == 'posttypes' ) {
            $param_line .= '<input class="wpb_vc_param_value wpb-checkboxes" type="hidden" value="" name="" />';
            $args = array(
                'public'   => true
            );
            $post_types = get_post_types($args);
            foreach ( $post_types as $post_type ) {
                $checked = "";
                if ( $post_type != 'attachment' ) {
                    if ( in_array($post_type, explode(",", $param_value)) ) $checked = ' checked="checked"';
                    $param_line .= ' <input id="'. $post_type .'" class="'.$param['param_name'].' '.$param['type'].'" type="checkbox" name="'.$param['param_name'].'"'.$checked.'> ' . $post_type;
                }
            }
        }
        // Exploded textarea
        else if ( $param['type'] == 'exploded_textarea' ) {
            $param_value = str_replace(",", "\n", $param_value);
            $param_line .= '<textarea name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textarea '.$param['param_name'].' '.$param['type'].'">'.$param_value.'</textarea>';
        }
        // Big Regular textarea
        else if ( $param['type'] == 'textarea_raw_html' ) {
            // $param_value = __($param_value, "js_composer");
            $param_line .= '<textarea name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textarea_raw_html '.$param['param_name'].' '.$param['type'].'" rows="16">' . base64_decode($param_value) . '</textarea>';
        }
        // Regular textarea
        else if ( $param['type'] == 'textarea' ) {
            $param_value = __($param_value, "js_composer");
            $param_line .= '<textarea name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textarea '.$param['param_name'].' '.$param['type'].'">'.$param_value.'</textarea>';
        }
        // Attach images
        else if ( $param['type'] == 'attach_images' ) {
            // TODO: More native way
            $param_value = wpb_removeNotExistingImgIDs($param_value);
            $param_line .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '.$param['param_name'].' '.$param['type'].'" name="'.$param['param_name'].'" value="'.$param_value.'" />';
            $param_line .= '<a class="button gallery_widget_add_images" href="#" title="'.__('Add images', "js_composer").'">'.__('Add images', "js_composer").'</a>';
            $param_line .= '<div class="gallery_widget_attached_images">';
            $param_line .= '<ul class="gallery_widget_attached_images_list">';
            $param_line .= ($param_value != '') ? fieldAttachedImages(explode(",", $param_value)) : '';
            $param_line .= '</ul>';
            $param_line .= '</div>';
            $param_line .= '<div class="gallery_widget_site_images">';
            $param_line .= siteAttachedImages(explode(",", $param_value));
            $param_line .= '</div>';
            $param_line .= '<div class="wpb_clear"></div>';
        }
		else if ( $param['type'] == 'attach_image' ) {
			// TODO: More native way
			$param_value = wpb_removeNotExistingImgIDs(preg_replace('/[^\d]/', '', $param_value));
			$param_line .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '.$param['param_name'].' '.$param['type'].'" name="'.$param['param_name'].'" value="'.$param_value.'" />';
			$param_line .= '<a class="button gallery_widget_add_images" href="#" use-single="true" title="'.__('Add image', "js_composer").'">'.__('Add image', "js_composer").'</a>';
			$param_line .= '<div class="gallery_widget_attached_images">';
			$param_line .= '<ul class="gallery_widget_attached_images_list">';
			$param_line .= ($param_value != '') ? fieldAttachedImages(explode(",", $param_value)) : '';
			$param_line .= '</ul>';
			$param_line .= '</div>';
			$param_line .= '<div class="gallery_widget_site_images">';
			$param_line .= siteAttachedImages(explode(",", $param_value));
			$param_line .= '</div>';
			$param_line .= '<div class="wpb_clear"></div>';
		}       //
        else if ( $param['type'] == 'widgetised_sidebars' ) {
            $wpb_sidebar_ids = Array();
            $sidebars = $GLOBALS['wp_registered_sidebars'];

            $param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
            foreach ( $sidebars as $sidebar ) {
                $selected = '';
                if ( $sidebar["id"] == $param_value ) $selected = ' selected="selected"';
                $sidebar_name = __($sidebar["name"], "js_composer");
                $param_line .= '<option value="'.$sidebar["id"].'"'.$selected.'>'.$sidebar_name.'</option>';
            }
            $param_line .= '</select>';
        }


        return $param_line;
    }

    protected function getTinyHtmlTextArea($param = array(), $param_value) {
        $param_line = '';

        //$upload_media_btns = '<div class="wpb_media-buttons hide-if-no-js"> '.__('Upload/Insert').' <a title="'.__('Add an Image').'" class="wpb_insert-image" href="#"><img alt="'.__('Add an Image').'" src="'.home_url().'/wp-admin/images/media-button-image.gif"></a> <a class="wpb_switch-editors" title="'.__('Switch Editors').'" href="#">HTML mode</a></div>';

        if ( function_exists('wp_editor') ) {
            $default_content = __($param_value, "js_composer");
            $output_value = '';
            // WP 3.3+
            ob_start();
            wp_editor($default_content, 'wpb_tinymce_'.$param['param_name'], array('editor_class' => 'wpb_vc_param_value wpb-textarea visual_composer_tinymce '.$param['param_name'].' '.$param['type'], 'media_buttons' => true ) );
            $output_value = ob_get_contents();
            ob_end_clean();
            $param_line .= $output_value;
        }
        return $param_line;
    }
}


class WPBakeryShortCode_Settings extends WPBakeryShortCode_UniversalAdmin {

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

            $output .= '<div class="span12 wpb_edit_form_elements"><h2>'.__('Edit', 'js_composer').' ' .__($this->settings['name'], "js_composer").'</h2>';

            foreach ($this->settings['params'] as $param) {
                $param_value = '';
                eval("\$param_value = \$".$param['param_name'].";");

                if ( is_array($param_value)) {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $output .= $this->singleParamEditHolder($param, $param_value);
            }

            $output .= '<div class="edit_form_actions"><a href="#" class="wpb_save_edit_form button-primary">'. __('Save', "js_composer") .'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="cancel-background-options">' . __('Cancel', 'js_composer') . '</a></div>';

            $output .= '</div>'; //close wpb_edit_form_elements
        }

        return $output;
    }
}