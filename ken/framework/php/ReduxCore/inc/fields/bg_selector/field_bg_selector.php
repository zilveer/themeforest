<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color_Gradient
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_bg_selector')) {
    
    /**
     * Main ReduxFramework_link_color class
     *
     * @since       1.0.0
     */
    class ReduxFramework_bg_selector extends ReduxFramework
    {
        
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($field = array(), $value = '', $parent)
        {
            
            parent::__construct($parent->sections, $parent->args);
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
            
            $defaults    = array(
                'preset' => true,
                'custom' => true,
                'color' => true,
                'position' => true,
                'repeat' => true,
                'attachment' => true,
                'cover' => true,
                'border' => false
            );
            $this->field = wp_parse_args($this->field, $defaults);
            
            $defaults = array(
                'preset' => '',
                'custom' => '',
                'color' => '',
                'position' => '',
                'repeat' => '',
                'attachment' => '',
                'cover' => 0,
                'border' => ''
            );
            
            $this->value = wp_parse_args($this->value, $defaults);
            
            $this->field['default'] = wp_parse_args($this->field['default'], $defaults);
            
        }
        
        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render()
        {
            
            
            
            
            /**
             * Preset Backgrounds
             * Will load images from images/patterns/
             */
            if ($this->field['preset'] === true && $this->field['default']['preset'] !== false):
                $sample_patterns_path = THEME_DIR . '/images/patterns/';
                $sample_patterns_url  = THEME_DIR_URI . '/images/patterns/';
                $sample_patterns      = array();
                if (is_dir($sample_patterns_path)):
                    if ($sample_patterns_dir = opendir($sample_patterns_path)):
                        $sample_patterns = array();
                        while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {
                            
                            if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                                $name              = explode(".", $sample_patterns_file);
                                $name              = str_replace('.' . end($name), '', $sample_patterns_file);
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;
                
                if (!empty($sample_patterns)) {
                    
                    if (isset($this->value['preset'])) {
                        $name                  = explode(".", $this->value['preset']);
                        $name                  = str_replace('.' . end($name), '', $this->value['preset']);
                        $name                  = basename($name);
                        $this->value['preset'] = trim($name);
                    }
                    
                    $x = 1;
                    
                    $width = ' style="width:320px"';
                    
                    $placeholder = (isset($this->field['placeholder'])) ? esc_attr($this->field['placeholder']) : __('Select Preset Images', 'mk_framework');
                    
                    echo '<strong>' . __('Select from presets', 'mk_framework') . '</strong><div class="bg-selector-option"><select id="' . $this->field['id'] . '-select_image" data-placeholder="' . $placeholder . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][preset]" class="redux-select-item redux-select-image-item"' . $width . ' rows="6"' . '>';
                    echo '<option></option>';
                    
                    foreach ($sample_patterns as $k => $v) {
                        
                        if (!is_array($v)) {
                            $v = array(
                                'img' => $v
                            );
                        }
                        
                        if (!isset($v['title'])) {
                            $v['title'] = '';
                        }
                        
                        if (!isset($v['alt'])) {
                            $v['alt'] = $v['title'];
                        }
                        
                        $selected = selected($this->value['preset'], $v['alt'], false);
                        
                        if ('' != $selected) {
                            $arrNum = $x;
                        }
                        
                        echo '<option value="' . $v['img'] . '"' . $selected . '>' . $v['alt'] . '</option>';
                        
                        $x++;
                    }
                    
                    echo '</select><br /><div>';
                    
                    if (!isset($arrNum)) {
                        $this->value['preset'] = '';
                    }
                    if ('' == $this->value['preset']) {
                        echo '<img src="#" class="redux-preview-image" id="image_' . $this->field['id'] . '">';
                    } else {
                        echo '<img src=' . $sample_patterns[$arrNum - 1]['img'] . ' class="redux-preview-image" id="image_' . $this->field['id'] . '">';
                    }
                    echo '</div></div><br><br><br>';
                }
            endif;
            /**** End of Presets ****/
            
            
            
            
            /**
             * Upload Backgrounds
             */
            if ($this->field['custom'] === true && $this->field['default']['custom'] !== false):
                
                    $defaults    = array(
                        'id' => '',
                        'url' => '',
                    );
                $this->value = wp_parse_args($this->value, $defaults);
                
                if (isset($this->field['mode']) && $this->field['mode'] == false) {
                    $this->field['mode'] = 0;
                }
                
                if (!isset($this->field['mode'])) {
                    $this->field['mode'] = "image";
                }
                
                if (!isset($this->field['library_filter'])) {
                    $libFilter = '';
                } else {
                    if (!is_array($this->field['library_filter'])) {
                        $this->field['library_filter'] = array(
                            $this->field['library_filter']
                        );
                    }
                    
                    $mimeTypes = get_allowed_mime_types();
                    
                    $libArray = $this->field['library_filter'];
                    
                    $jsonArr = array();
                    
                    // Enum mime types
                    foreach ($mimeTypes as $ext => $type) {
                        if (strpos($ext, '|')) {
                            $expArr = explode('|', $ext);
                            
                            foreach ($expArr as $ext) {
                                if (in_array($ext, $libArray)) {
                                    $jsonArr[$ext] = $type;
                                }
                            }
                        } elseif (in_array($ext, $libArray)) {
                            $jsonArr[$ext] = $type;
                        }
                        
                    }
                    
                    $libFilter = urlencode(json_encode($jsonArr));
                }
                
                if (empty($this->value) && !empty($this->field['default'])) { // If there are standard values and value is empty
                    if (is_array($this->field['default'])) {
                        if (!empty($this->field['default']['id'])) {
                            $this->value['id'] = $this->field['default']['id'];
                        }
                        
                        if (!empty($this->field['default']['url'])) {
                            $this->value['url'] = $this->field['default']['url'];
                        }
                    } else {
                        if (is_numeric($this->field['default'])) { // Check if it's an attachment ID
                            $this->value['id'] = $this->field['default'];
                        } else { // Must be a URL
                            $this->value['url'] = $this->field['default'];
                        }
                    }
                }
                
                
                if (empty($this->value['url']) && !empty($this->value['id'])) {
                    $img                   = wp_get_attachment_image_src($this->value['id'], 'full');
                    $this->value['url']    = $img[0];
                }
                
                
                $placeholder = isset($this->field['placeholder']) ? $this->field['placeholder'] : __('No media selected', 'mk_framework');
                echo '<strong style="padding-top:20px;">' . __('Upload Custom Image', 'mk_framework') . '</strong>';    
                echo '<div class="bg-selector-option"><fieldset class="redux-field-container redux-field redux-field-init redux-container-media " data-id="'.$this->value['id'].'" data-type="media">';
                
                echo '<input placeholder="' . $placeholder . '" type="text" class="upload regular-text ' . $this->field['class'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[url]" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][url]" value="' . $this->value['url'] . '"/>';
                echo '<input type="hidden" class="upload-id ' . $this->field['class'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[id]" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][id]" value="' . $this->value['id'] . '" />';
                
                //Preview
                $hide = '';
                
                if ((isset($this->field['preview']) && $this->field['preview'] === false) || empty($this->value['url'])) {
                    $hide = 'hide ';
                }
                
                if (empty($this->value['thumbnail']) && !empty($this->value['url'])) { // Just in case
                    if (!empty($this->value['id'])) {
                        $image                    = wp_get_attachment_image_src($this->value['id'], array(
                            150,
                            150
                        ));
                        $this->value['thumbnail'] = $image[0];
                    } else {
                        $this->value['thumbnail'] = $this->value['url'];
                    }
                }
                
                echo '<div class="' . $hide . 'screenshot">';
                echo '<a class="of-uploaded-image" href="' . $this->value['url'] . '" target="_blank">';
                echo '<img class="redux-option-image" id="image_' . $this->field['id'] . '" src="' . $this->value['thumbnail'] . '" alt="" target="_blank" rel="external" />';
                echo '</a>';
                echo '</div>';
                
                //Upload controls DIV
                echo '<div class="upload_button_div">';
                
                //If the user has WP3.5+ show upload/remove button
                echo '<span class="button media_upload_button" id="' . $this->field['id'] . '-media">' . __('Upload', 'mk_framework') . '</span>';
                
                $hide = '';
                if (empty($this->value['url']) || $this->value['url'] == '') {
                    $hide = ' hide';
                }
                
                echo '<span class="button remove-image' . $hide . '" id="reset_' . $this->field['id'] . '" rel="' . $this->field['id'] . '">' . __('Remove', 'mk_framework') . '</span>';
                
                echo '</div></fieldset></div><br><br><br>';
            endif;
            
            
            
            
            
            
            
            /**
             * Background Color
             */
            if ($this->field['color'] === true && $this->field['default']['color'] !== false):
                echo '<strong>' . __('Background Color', 'mk_framework') . '</strong><div class="bg-selector-option">';
                
                echo '<input data-id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][color]" id="' . $this->field['id'] . '-color" class="redux-color redux-color-init"  type="text" value="' . $this->value['color'] . '"  data-default-color="' . (isset($this->value['color']) ? $this->value['color'] : "") . '" />';
                
                echo '<input type="hidden" class="redux-saved-color" id="' . $this->field['id'] . '-saved-color' . '" value="">';
                
                echo '</div><br><br><br>';
            endif;
            
            
            
            
            
            
            
            /**
             * Background position
             */
            if ($this->field['position'] === true && $this->field['default']['position'] !== false):
                $this->field['options'] = array(
                    'left top' => 'left top',
                    'center top' => 'center top',
                    'right top' => 'right top',
                    'left center' => 'left center',
                    'center center' => 'center center',
                    'right center' => 'right center',
                    'left bottom' => 'left bottom',
                    'center bottom' => 'center bottom',
                    'right bottom' => 'right bottom'
                );
                echo '<div class="redux-container-select">';
                echo '<strong>' . __('Background Position', 'mk_framework') . '</strong><div class="bg-selector-option">';
                
                
                
                echo '<select id="' . $this->field['id'] . '-select" data-placeholder="Select image position" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][position]" class="redux-select-item" style="width:320px;" rows="6">';
                echo '<option></option>';
                
                
                
                
                foreach ($this->field['options'] as $k => $v) {
                    if (is_array($this->value)) {
                        $selected = (is_array($this->value) && in_array($k, $this->value)) ? ' selected="selected"' : '';
                    } else {
                        $selected = selected($this->value, $k, false);
                    }
                    echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
                } //foreach
                echo '</select>';
                
                echo '</div></div><br><br><br>';
            endif;
            
            
            
            
            
            
            
            
            /**
             * Background attachment
             */
            if ($this->field['attachment'] === true && $this->field['default']['attachment'] !== false):
                $this->field['options'] = array(
                    'scroll' => 'Scroll',
                    'fixed' => 'Fixed'
                );
                echo '<div class="redux-container-button_set">';
                echo '<strong>' . __('Background Attachment', 'mk_framework') . '</strong><div class="bg-selector-option">';
                echo '<div class="buttonset ui-buttonset">';
                
                foreach ($this->field['options'] as $k => $v) {
                    
                    echo '<input data-id="' . $this->field['id'] . '" type="radio" id="' . $this->field['id'] . '-buttonset' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][attachment]" value="' . $k . '" ' . checked($this->value['attachment'], $k, false) . '/>';
                    echo '<label for="' . $this->field['id'] . '-buttonset' . $k . '">' . $v . '</label>';
                    
                }
                
                echo '</div>';
                echo '</div></div><br><br><br>';
            endif;
            
            
            
            
            
            
            /**
             * Background Repeat
             */
            if ($this->field['repeat'] === true && $this->field['default']['repeat'] !== false):
                $this->field['options'] = array(
                    'no-repeat' => 'No Repeat',
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Horizontal Repeat',
                    'repeat-y' => 'Vertical Repeat'
                    
                );
                echo '<div class="redux-container-button_set">';
                echo '<strong>' . __('Background Repeat', 'mk_framework') . '</strong><div class="bg-selector-option">';
                echo '<div class="buttonset ui-buttonset">';
                
                foreach ($this->field['options'] as $k => $v) {
                    
                    echo '<input data-id="' . $this->field['id'] . '" type="radio" id="' . $this->field['id'] . '-buttonset' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][repeat]" value="' . $k . '" ' . checked($this->value['repeat'], $k, false) . '/>';
                    echo '<label for="' . $this->field['id'] . '-buttonset' . $k . '">' . $v . '</label>';
                    
                }
                
                echo '</div>';
                echo '</div></div><br><br><br>';
            endif;
            
            
            
            /**
             * Background Cover
             */
            if ($this->field['cover'] === true && $this->field['default']['cover'] !== false):
                $this->field['options'] = array(
                    1 => 'Enabled',
                    0 => 'Disabled'
                    
                );
                echo '<div class="redux-container-button_set">';
                echo '<strong>' . __('Background Cover', 'mk_framework') . '</strong><div class="bg-selector-option">';
                echo '<div class="buttonset ui-buttonset">';
                
                foreach ($this->field['options'] as $k => $v) {
                    
                    echo '<input data-id="' . $this->field['id'] . '" type="radio" id="' . $this->field['id'] . '-buttonset' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][cover]" value="' . $k . '" ' . checked($this->value['cover'], $k, false) . '/>';
                    echo '<label for="' . $this->field['id'] . '-buttonset' . $k . '">' . $v . '</label>';
                    
                }
                
                echo '</div>';
                echo '<div class="description field-desc">' . __('Enable this option if you want the image fit to the area no matter what size it is.', 'mk_framework') . '</div>';
                echo '</div></div><br><br><br>';
            endif;
            
            
            
            
            
            
            /**
             * Border Bottom Color
             */
            if ($this->field['border'] === true && $this->field['default']['border'] !== false):
                echo '<strong>' . __('Bottom Border Color', 'mk_framework') . '</strong><div class="bg-selector-option">';
                
                echo '<input data-id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][border]" id="' . $this->field['id'] . '-color" class="redux-color redux-color-init"  type="text" value="' . $this->value['border'] . '"  data-default-color="' . (isset($this->value['border']) ? $this->value['border'] : "") . '" />';
                
                echo '</div><br><br><br>';
            endif;
            
        }
        
        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue()
        {
            
            wp_enqueue_script('redux-field-bg-selector-js', ReduxFramework::$_url . 'inc/fields/bg_selector/field_bg_selector.js', array(
                'jquery',
                'wp-color-picker',
                'redux-js'
            ), time(), true);
            
            wp_enqueue_script('redux-field-media-js', ReduxFramework::$_url . 'assets/js/media/media' . Redux_Functions::isMin() . '.js', array(
                'jquery',
                'redux-js'
            ), time(), true);
            
            wp_enqueue_style('redux-field-media-css', ReduxFramework::$_url . 'inc/fields/media/field_media.css', time(), true);
            
            wp_enqueue_script('redux-field-select-js', ReduxFramework::$_url . 'inc/fields/select/field_select' . Redux_Functions::isMin() . '.js', array(
                'jquery',
                'select2-js',
                'redux-js'
            ), time(), true);
            
            wp_enqueue_script('redux-field-button-set-js', ReduxFramework::$_url . 'inc/fields/button_set/field_button_set' . Redux_Functions::isMin() . '.js', array(
                'jquery',
                'jquery-ui-core',
                'redux-js'
            ), time(), true);
            
            
            
            
            
        }
        
        
    }
}
?>
