<?php
class mkMetaboxesGenerator
{
    var $config;
    var $options;
    var $saved_options;
    
    /**
     * Constructor
     *
     * @param string  $name
     * @param array   $options
     */
    function __construct($config, $options) {
        $this->config = $config;
        $this->options = $options;
        
        add_action('admin_menu', array(&$this,
            'create'
        ));

        add_action('save_post', array(&$this,
            'save'
        ) , 10, 3);


    }
    
    function create() {
        if (function_exists('add_meta_box')) {
            if (!empty($this->config['callback']) && function_exists($this->config['callback'])) {
                $callback = $this->config['callback'];
            } 
            else {
                $callback = array(&$this,
                    'render'
                );
            }
            foreach ($this->config['pages'] as $page) {
                add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
            }
        }
    }

    
    function save($post_id) {
        if (!isset($_POST[$this->config['id'] . '_noncename'])) {
            return $post_id;
        }
        
        if (!wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
            return $post_id;
        }
        
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } 
        else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        add_post_meta($post_id, 'textfalse', false, true);
        
        foreach ($this->options as $option) {
            if (isset($option['id']) && !empty($option['id'])) {
                
                if (isset($_POST[$option['id']])) {
                    if ($option['type'] == 'multidropdown') {
                        $value = array_unique(explode(',', $_POST[$option['id']]));
                    } 
                    else {
                        $value = $_POST[$option['id']];
                    }
                } 
                else if ($option['type'] == 'toggle') {
                    $value = - 1;
                } 
                else {
                    $value = false;
                }
                
                if (get_post_meta($post_id, $option['id']) == "") {
                    add_post_meta($post_id, $option['id'], $value, true);
                } 
                elseif ($value != get_post_meta($post_id, $option['id'], true)) {
                    update_post_meta($post_id, $option['id'], $value);
                } 
                elseif ($value == "") {
                    delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
                }
            }
        }
        
        // Deletes blog post twitter type meta on save post.
        delete_post_meta(get_the_ID() , '_blog_post_tweet');
        
        // Deletes blog post Instagram type meta on save post.
        delete_post_meta(get_the_ID() , '_blog_instagram_feed');
        
        // Deletes dynamic styles on save post.
        delete_post_meta(get_the_ID() , '_dynamic_styles');

        // Deletes the cached css and JS files as well as theme options.
        mk_purge_cache_actions();
    }
    
    function render() {
        global $post;
        echo '<div class="mk-metabox-wrapper mk-resets"><table class="form-table"><tbody>';
        foreach ($this->options as $option) {
            if (method_exists($this, $option['type'])) {
                if (isset($option['id'])) {
                    $default = get_post_meta($post->ID, $option['id'], true);
                    if ($default != "") {
                        $option['default'] = $default;
                    }
                }
                $function = $option['type'];
                $this->$function($option);
            }
        }
        echo '</tbody></table><div class="clearboth"></div></div>';
        echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
    }
    
    function dependency_builder($val) {
        if (!isset($val) && empty($val)) return false;
        
        $output = isset($val['element']) ? ' data-dependency-mother="' . $val['element'] . '" ' : '';
        $output.= isset($val['value']) ? ' data-dependency-value=\'' . json_encode($val['value']) . '\' ' : '';
        
        return $output;
    }
    
    function build_fields($value, $field) {
        
        $dependency = isset($value['dependency']) ? $value['dependency'] : '';
        
        echo '<tr class="mk-single-option" id="' . $value['id'] . '_wrapper"' . $this->dependency_builder($dependency) . '>';
        
        echo '<th>';
        echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
        
        if (isset($value['desc'])) {
            echo '<span class="option-desc">' . $value['desc'] . '</span>';
        }
        echo '</th>';
        
        echo '<td>';
        
        echo $field;
        
        echo '</td>';
        echo '</tr>';
    }
    
    /*
     **
     **
     ** Type : Info
     -------------------------------------------------------------*/
    
    function info($value) {
        echo '<tr class="mk-single-option no-divider">';
        if (isset($value['desc'])) {
            echo '<span class="option-desc">' . $value['desc'] . '</span>';
        }
        echo '</tr>';
    }
    
    /*
     **
     **
     ** Type : General Wrapper
     -------------------------------------------------------------*/
    
    function general_wrapper_start($value) {
        echo '<tbody id="' . $value['id'] . '">';
    }
    
    function general_wrapper_end() {
        echo '</tbody>';
    }
    
    /*
     **
     **
     ** Type : Text Box
     -------------------------------------------------------------*/
    
    function text($value) {
        
        $field = '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="40" value="' . (isset($value['default']) ? $value['default'] : '') . '" />';
        
        $this->build_fields($value, $field);
    }
    
    /*
     **
     **
     ** Type : Upload Image
     -------------------------------------------------------------*/
    function upload($value) {
        wp_enqueue_media();
        $preview = isset($value['preview']) ? $value['preview'] : false;

        $field = '<input class="mk-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="' . $value['default'] . '" /><a class="option-upload-button secondary-button thickbox" id="' . $value['id'] . '_button" href="#">' . __('Upload', 'mk_framework') . '</a>';
        
        if ($preview) {
            $field .= '<span id="' . $value['id'] . '-preview" class="show-upload-image"><img src="' . $value['default'] . '" title="" /></span>';
        }

        $this->build_fields($value, $field);
       
    }
    
    /*
     **
     **
     ** Type : Toggle Button
     -------------------------------------------------------------*/
    function toggle($value) {
        
        $field = '<span class="mk-toggle-button"><span class="toggle-handle"></span><input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/></span>';
        
        $this->build_fields($value, $field);
    }
    
    /*
     **
     **
     ** Type : Color Picker
     -------------------------------------------------------------*/
    
    function color($value) {
        
        $field = '<div class="color-picker-holder"><input name="' . $value['id'] . '" id="' . $value['id'] . '" size="8" class="color-picker" value="' . $value['default'] . '" /></div>';

        $this->build_fields($value, $field);
       
    }
    
    /*
     **
     **
     ** Type : Range Input
     -------------------------------------------------------------*/
    function range($value) {
        
        $field = '<div class="mk-ui-input-slider">';
        $field .= '<div class="mk-range-input"';
        $field .= '" data-value="' . $value['default'] . '"';
        
        if (isset($value['min'])) {
            $field .= '" data-min="' . $value['min'];
        }
        if (isset($value['max'])) {
            $field .= '" data-max="' . $value['max'];
        }
        if (isset($value['step'])) {
            $field .= '" data-step="' . $value['step'] . '"';
        }
        $field .= '></div>';
        $field .= '<input class="range-input-selector" name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="';
        $field .= $value['default'];
        $field .= '" />';
        
        if (isset($value['unit'])) {
            $field .= '<span class="unit">' . $value['unit'] . '</span>';
        }
        
        $field .= '</div>';
        

        $this->build_fields($value, $field);
    }
    
    /*
     **
     **
     ** Type : Textarea
     -------------------------------------------------------------*/
    function textarea($value) {
        $rows = isset($value['rows']) ? $value['rows'] : '8';
        
        $field = '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" class="code">' . $value['default'] . '</textarea>';

        $this->build_fields($value, $field);
       
    }
    
    /*
     **
     **
     ** Type : Header Styles
     -------------------------------------------------------------*/
    function header_styles($value) {
        
        $field  = '<div id="mk-header-switcher">';
        $field .= '<div class="header-style-unit">';
        
        $field .= '<div class="mk-header-preview"><div></div></div>';
        
        $field .= '<div class="mk-header-styles-number">';
        $field .= '<span rel="4">4</span>';
        $field .= '<span rel="3">3</span>';
        $field .= '<span rel="2">2</span>';
        $field .= '<span rel="1">1</span>';
        $field .= '</div>';
        
        $field .= '<div class="mk-header-style-tools">';
        $field .= '<div class="mk-header-align">';
        $field .= '<div class="label">' . __('Align', 'mk_framework') . '</div>';
        $field .= '<span rel="left" class="header-align-left"></span>';
        $field .= '<span rel="center" class="header-align-center"></span>';
        $field .= '<span rel="right" class="header-align-right"></span>';
        $field .= '</div>';
        
        $field .= '<div class="mk-header-toolbar-toggle">';
        $field .= '<div class="label">' . __('Toolbar', 'mk_framework') . '</div>';
        $field .= '<span class="header-toolbar-toggle-button"></span>';
        $field .= '</div>';
        
        $field .= '</div>';
        
        $field .= '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';

        $this->build_fields($value, $field);
        
        
    }
    
    /*
     **
     **
     ** Type : Icon Selector
     -------------------------------------------------------------*/
    function icon_selector($value) {
        
        $field = '<div id="' . $value['id'] . '_container" class="mk-visual-selector mk-font-icons-wrapper" style="">';
        foreach ($value['options'] as $key => $option) {
            if ($key) {
                $field .= '<a href="#" title="Class Name : mk-' . $key . '" rel="' . $key . '"><span>' . $key . '</span><i class="mk-' . $key . '" ></i></a>';
            } 
            else {
                $field .= '<a class="mk-no-icon" href="#" rel="">r</a>';
            }
        }
        $field .= '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        $field .= '</div>';

        $this->build_fields($value, $field);
        
    
    }
    
    /*
     **
     **
     ** Type : Select Box
     -------------------------------------------------------------*/
    function select($value) {
        
        if (isset($value['target'])) {
            if (isset($value['options'])) {
                $value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
            } 
            else {
                $value['options'] = $this->get_select_target_options($value['target']);
            }
        }
        
        if (isset($this->saved_options[$value['id']])) {
            $default = $this->saved_options[$value['id']];
        } 
        else {
            $default = $value['default'];
        }
        
       
        $field = '<select class="mk-select" name="' . $value['id'] . '" id="' . $value['id'] . '">';
        $field .= '<option value="">' . __('Select Option', 'mk_framework') . '</div>';
        foreach ($value['options'] as $key => $option) {
            $field .= '<option value="' . $key . '"';
            if ($key == $value['default']) {
                $field .= ' selected';
            }
            $field .= ' ">' . $option . '</option>';
        }
        
        $field .= '</select>';
        
        $this->build_fields($value, $field);

    }
    
    /*
     **
     **
     ** Type : Multi Select
     -------------------------------------------------------------*/
    function multiselect($value) {
        if (isset($value['target'])) {
            if (isset($value['options'])) {
                $value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
            } 
            else {
                $value['options'] = $this->get_select_target_options($value['target']);
            }
        }
        
        $field = '<select class="mk-chosen" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" style="width:500px;">';
        
        if (!empty($value['options']) && is_array($value['options'])) {
            foreach ($value['options'] as $key => $option) {
                $field .= '<option value="' . $key . '"';
                if (in_array($key, $value['default'])) {
                    $field .= ' selected="selected"';
                }
                $field .= '>' . $option . '</option>';
            }
        }
        $field .= '</select>';

        $this->build_fields($value, $field);
        
    }
    
    /*
     **
     **
     ** Type : Page Layout
     -------------------------------------------------------------*/
    function visual_selector($value) {
        
        $field = '<div id="' . $value['id'] . '_container" class="mk-visual-selector">';
        foreach ($value['options'] as $key => $option) {
            $field .= '<a href="#" rel="' . $key . '"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/' . $option . '.png" /></a>';
        }
        $field .= '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        $field .= '</div>';

        $this->build_fields($value, $field);
    }
    
    /*
     **
     **
     ** Type : Wrodpress Built-in Editor
     -------------------------------------------------------------*/
    function editor($value) {

        if (isset($this->saved_options[$value['id']])) {
            $value['default'] = stripslashes($this->saved_options[$value['id']]);
        }
        ob_start();
        wp_editor($value['default'], $value['id']);
        $field = ob_get_clean();

        $this->build_fields($value, $field);
    }
    
    /*
     **
     **
     ** Type : Super Links
     -------------------------------------------------------------*/
    
    function superlink($value) {
        $target = '';
        if (!empty($value['default'])) {
            list($target, $target_value) = explode('||', $value['default']);
        }
        
        $field = '<input type="hidden" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . $value['default'] . '"/>';
        
        $method_options = array(
            'page' => 'Link to page',
            'cat' => 'Link to category',
            'post' => 'Link to post',
            'portfolio' => 'Link to portfolio',
            'manually' => 'Link manually'
        );
        $field .= '<select class="mk-select" name="' . $value['id'] . '_selector" id="' . $value['id'] . '_selector">';
        $field .= '<option value="">' . __('Select Linking method', 'mk_framework') . '</option>';
        foreach ($method_options as $key => $option) {
            $field .= '<option value="' . $key . '"';
            if ($key == $target) {
                $field .= ' selected="selected"';
            }
            $field .= '>' . $option . '</option>';
        }
        $field .= '</select>';
        
        $field .= '<div style="margin-top:15px;" class="superlink-wrap">';
        
        //render page selector
        $hidden = ($target != "page") ? 'class="hidden"' : '';
        $field .= '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_page" ' . $hidden . '>';
        $field .= '<op$field .=tion value="">' . __('Select Page', 'mk_framework') . '</option>';
        foreach ($this->get_select_target_options('page') as $key => $option) {
            $field .= '<option value="' . $key . '"';
            if ($target == "page" && $key == $target_value) {
                $field .= ' selected="selected"';
            }
            $field .= '>' . $option . '</option>';
        }
        $field .= '</select>';
        
        //render portfolio selector
        $hidden = ($target != "portfolio") ? 'class="hidden"' : '';
        $field .= '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_portfolio" ' . $hidden . '>';
        $field .= '<option value="">' . __('Select Portfolio', 'mk_framework') . '</option>';
        foreach ($this->get_select_target_options('portfolio') as $key => $option) {
            $field .= '<option value="' . $key . '"';
            if ($target == "portfolio" && $key == $target_value) {
                $field .= ' selected="selected"';
            }
            $field .= '>' . $option . '</option>';
        }
        $field .= '</select>';
        
        //render category selector
        $hidden = ($target != "cat") ? 'class="hidden"' : '';
        $field .= '<select name="' . $value['id'] . '_cat" id="' . $value['id'] . '_cat" ' . $hidden . '>';
        $field .= '<option value="">' . __('Select Category', 'mk_framework') . '</option>';
        foreach ($this->get_select_target_options('cat') as $key => $option) {
            $field .= '<option value="' . $key . '"';
            if ($target == "cat" && $key == $target_value) {
                $field .= ' selected="selected"';
            }
            $field .= '>' . $option . '</option>';
        }
        $field .= '</select>';
        
        //render post selector
        $hidden = ($target != "post") ? 'class="hidden"' : '';
        $field .= '<select name="' . $value['id'] . '_post" id="' . $value['id'] . '_post" ' . $hidden . '>';
        $field .= '<option value="">' . __('Select Post', 'mk_framework') . '</option>';
        foreach ($this->get_select_target_options('post') as $key => $option) {
            $field .= '<option value="' . $key . '"';
            if ($target == "post" && $key == $target_value) {
                $field .= ' selected="selected"';
            }
            $field .= '>' . $option . '</option>';
        }
        $field .= '</select>';
        
        //render manually
        $hidden = ($target != "manually") ? 'class="hidden"' : '';
        $field .= '<input name="' . $value['id'] . '_manually" id="' . $value['id'] . '_manually" type="text" value="';
        if ($target == 'manually') {
            $field .= $target_value;
        }
        $field .= '" size="35" ' . $hidden . '/>';
        $field .= '</div>';
        
        $this->build_fields($value, $field);
    }
    
    /*
     **
     **
     ** Type : General Background Selector
     -------------------------------------------------------------*/
    function general_background_selector($value) {

        $dependency = isset($value['dependency']) ? $value['dependency'] : '';
        
        echo '<tr class="mk-single-option" id="' . $value['id'] . '_wrapper"' . $this->dependency_builder($dependency) . '>';
        echo '<th>';
        echo '<label>' . $value['name'] . '</label>';
        
        if (isset($value['desc'])) {
            echo '<span class="option-desc">' . $value['desc'] . '</span>';
        }
        echo '</th>';
        
        echo '<td>';
?>

<div class="mk-general-bg-selector">
    <div class="outer-wrapper">
        <div rel="body" class="body-section"><span class="hover-state-body"><span class="section-indicator">
            <?php _e( 'Body', 'mk_framework' ) ?>
            </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
            <div class="main-sections-wrapper">
                <div rel="header" class="header-section"><span class="hover-state"><span class="section-indicator">
                    <?php _e( 'Header', 'mk_framework' ) ?>
                    </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                    <div rel="banner" class="banner-section"><span class="hover-state"><span class="section-indicator">
                        <?php _e( 'Page Title Section', 'mk_framework' ) ?>
                        </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                        <div rel="page" class="page-section"><span class="hover-state"><span class="section-indicator">
                            <?php _e( 'Page', 'mk_framework' ) ?>
                            </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                            <div rel="footer" class="footer-section"><span class="hover-state"><span class="section-indicator">
                                <?php _e( 'Footer', 'mk_framework' ) ?>
                                </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                            </div>
                        </div>
                        <div id="mk-bg-edit-panel" class="mk-bg-edit-panel">
                            <div class="mk-bg-panel-heading"> <a class="mk-bg-edit-panel-heading-cancel" href="#"><i class="icon-close2"></i></a> <span class="mk-bg-edit-panel-heading-text">Edit color & texture - <span class="mk-edit-panel-heading"></span></span> </div>
                            <div style="border-bottom:1px solid #ccc;">
                                <div class="mk-bg-edit-right">
                                    <div class="mk-bg-edit-option mk-bg-edit-bg-color"> <span class="mk-bg-edit-label"><?php _e( 'Background color', 'mk_framework' ); ?></span>
                                        <div class="bg-edit-panel-color">
                                          <select class="mk-select bg-panel-color-style" name="bg_panel_color_style" id="bg_panel_color_style">
                                            <option value="single"><?php _e( 'Single Color', 'mk_framework' );?></option>
                                            <option value="gradient"><?php _e( 'Gradient', 'mk_framework' );?></option>
                                          </select>
                                        </div>
                                        <div class="clearboth"></div>
                                        <div class="bg-edit-panel-color">
                                          <span class="mk-bg-edit-label panel-gradient-element"><?php _e( 'From', 'mk_framework' );?></span>
                                          <div class="color-picker-holder"><input name="bg_panel_color" id="bg_panel_color" size="8" class="color-picker" value="" /></div>
                                        </div>

                                        <div class="bg-edit-panel-color panel-gradient-element">
                                          <span class="mk-bg-edit-label"><?php _e( 'To', 'mk_framework' );?></span>
                                          <div class="color-picker-holder"><input name="bg_panel_color_2" id="bg_panel_color_2" size="8" class="color-picker" value="" /></div>
                                        </div>
                                        <div class="clearboth"></div>
                                        <div class="bg-edit-panel-color panel-gradient-element">
                                          <span class="mk-bg-edit-label"><?php _e( 'Style', 'mk_framework' );?></span>
                                          <select class="mk-select" name="grandient_color_style" id="grandient_color_style">
                                            <option value="linear"><?php _e( 'Linear', 'mk_framework' );?></option>
                                            <option value="radial"><?php _e( 'Radial', 'mk_framework' );?></option>
                                          </select>
                                        </div>

                                        <div class="bg-edit-panel-color panel-gradient-element panel-linear-gradient-el">
                                          <span class="mk-bg-edit-label"><?php _e( 'Angle', 'mk_framework' );?></span>
                                          <select name="grandient_color_angle" id="grandient_color_angle" class="mk-select">
                                            <option value="vertical"><?php _e( 'Vertical ↓', 'mk_framework' );?></option>
                                            <option value="horizontal"><?php _e( 'Horizontal →', 'mk_framework' );?></option>
                                            <option value="diagonal_left_bottom"><?php _e( 'Diagonal ↘', 'mk_framework' );?></option>
                                            <option value="diagonal_left_top"><?php _e( 'Diagonal ↗', 'mk_framework' );?></option>
                                          </select>
                                        </div>

                                        <div class="clearboth"></div>
                                      </div>

                                    <div class="mk-bg-edit-option"> <span class="mk-bg-edit-label">
                                        <?php  _e( 'Background Image', 'mk_framework' )  ?>
                                        </span>
                                        <ul class="bg-background-type-tabs">
                                            <li><a rel="no-image" href="#" class="mk-bg-edit-option-no-image-button bg-image-buttons">
                                                <?php  _e( 'No Image', 'mk_framework' )  ?>
                                            </a></li>
                                            <li><a rel="custom" href="#" class="mk-bg-edit-option-upload-button bg-image-buttons">
                                                <?php  _e( 'Custom', 'mk_framework' )  ?>
                                            </a></li>
                                        </ul>
                                        <div class="clearboth"></div>
                                        <div class="bg-background-type-panes">
                                            <div class="bg-background-type-pane bg-no-image"> </div>
                                            <div class="bg-background-type-pane bg-edit-panel-upload">
                                                <div class="upload-option">
                                                    <span class="bg-edit-panel-upload-title">
                                                    <?php  _e( 'Upload a new custom image', 'mk_framework' )  ?>
                                                    </span>
                                                    <div class="mk-upload-bg-wrapper">
                                                        <input class="mk-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" />
                                                        <a class="option-upload-button secondary-button thickbox" id="bg_panel_upload_button" href="#"><?php _e( 'Upload', 'mk_framework' );?></a>
                                                        <div id="bg_panel_upload-preview" class="custom-image-preview-block show-upload-image"><img src="" title="" /></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearboth"></div>
                                    </div>
                                </div>
                                <div class="mk-bg-edit-left">
                                    <div class="mk-bg-edit-option mk-bg-edit-option-repeat"> <span class="mk-bg-edit-label">
                                        <?php  _e( 'Background Repeat', 'mk_framework' )  ?>
                                        </span>
                                        <div class="bg-repeat-option"><a style="border:none" class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a><a href="#" rel="repeat" class="repeat" title="repeat"></a><a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a><a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a></div>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="mk-bg-edit-option mk-bg-edit-option-attachment"> <span class="mk-bg-edit-label">
                                        <?php  _e( 'Background Attachment', 'mk_framework' )  ?>
                                        </span>
                                        <div class="bg-attachment-option"> <a style="border:none" href="#" rel="fixed" class="fixed" title="fixed"></a><a href="#" rel="scroll" class="scroll" title="scroll"></a></div>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="mk-bg-edit-option mk-bg-edit-option-position"> <span class="mk-bg-edit-label"><?php  _e( 'Background Position', 'mk_framework' )  ?></span>
                                        <div class="bg-position-option">
                                            <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
                                            <div class="clearboth"></div>
                                            <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
                                            <div class="clearboth"></div>
                                            <a style="border-left:none; border-bottom:none;" href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
                                        </div>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="mk-bg-edit-option mk-bg-edit-option-stretch">
                                        <span class="mk-bg-edit-label"><?php  _e( 'Enable Parallax Effect', 'mk_framework' )  ?></span>
                                        <span class="mk-toggle-button">
                                            <span class="toggle-handle"></span>
                                            <input type="hidden" value="false" name="bg_panel_parallax" id="bg_panel_parallax"/>
                                        </span>
                                        <div class="clearboth"></div>
                                    </div>                                    
                                    <div class="mk-bg-edit-option mk-bg-edit-option-stretch">
                                        <span class="mk-bg-edit-label"><?php  _e( 'Cover whole background', 'mk_framework' )  ?></span>
                                        <span class="mk-toggle-button">
                                            <span class="toggle-handle"></span>
                                            <input type="hidden" value="false" name="bg_panel_stretch" id="bg_panel_stretch"/>
                                        </span>
                                        <div class="clearboth"></div>
                                    </div>                                    
                                    <div class="clearboth"></div>
                                </div>
                                <div class="clearboth"></div>
                            </div>
                            <div class="mk-bg-edit-buttons"> <a id="mk_cancel_bg_selector" href="#" class="secondary-button full-rounded"><span>
                                <?php _e( 'Cancel', 'mk_framework' ) ?>
                                </span></a> <a id="mk_apply_bg_selector" href="#" class="primary-button blue-button"><span>
                                <?php _e( 'Apply', 'mk_framework' ) ?>
                            </span></a> </div>
                        </div>
                    </div>

<?php
        echo '</td>';
        echo '</tr>';
    }
    
    /*
     **
     **
     ** Type : Hidden input
     -------------------------------------------------------------*/
    function hidden_input($value) {
        if (isset($this->saved_options[$value['id']])) {
            $default = $this->saved_options[$value['id']];
        } 
        else {
            $default = $value['default'];
        }
        
        echo '<input class="hidden-input-' . $value['id'] . '" type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
    }
    
    /*
     **
     **
     ** Type : Gallery
     -------------------------------------------------------------*/
    
    function gallery($value) {
        
        $dependency = isset($value['dependency']) ? $value['dependency'] : '';
        
        echo '<tr class="mk-single-option" id="' . $value['id'] . '_wrapper"' . $this->dependency_builder($dependency) . '>';
        
        echo '<th>';
        echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
        
        if (isset($value['desc'])) {
            echo '<span class="option-desc">' . $value['desc'] . '</span>';
        }
        echo '</th>';
        
        echo '<td>';
        
        if (function_exists('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        
        global $post;
?>

    <div id="gallery_images_container<?php
        echo $value['id']; ?>">

        <ul class="gallery_images">
            <?php
        $image_gallery = get_post_meta($post->ID, $value['id'], true);
        $attachments = array_filter(explode(',', $image_gallery));
        
        if ($attachments) foreach ($attachments as $attachment_id) {
            echo '<li class="image attachment details" data-attachment_id="' . $attachment_id . '"><div class="attachment-preview"><div class="thumbnail">
                            ' . wp_get_attachment_image($attachment_id, 'thumbnail') . '</div>
                            <a href="#" class="delete check" title="' . __('Remove image', 'mk_framework') . '"><div class="media-modal-icon"></div></a>

                        </div></li>';
        }
?>
        </ul>


        <input type="hidden" id="<?php
        echo $value['id']; ?>" name="<?php
        echo $value['id']; ?>" value="<?php
        echo esc_attr($image_gallery); ?>" />


    </div>
    <br class="clear" />
    <div class="add_gallery_images hide-if-no-js">
        <a class="primary-button blue-button add_gallery_images" style="margin-left: 0;padding: 12px 20px;" href="#"><?php
        _e('Add Images', 'mk_framework'); ?></a>
    </div>


    <?php
        
        /**
         * Props to WooCommerce for the following JS code
         */
?>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            // Uploading files
            var image_gallery_frame;
            var $image_gallery_ids = $('#<?php
        echo $value['id']; ?>');
            var $gallery_images = $('#gallery_images_container<?php
        echo $value['id']; ?> ul.gallery_images');

            jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( image_gallery_frame ) {
                    image_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php
        _e('Add Images to Gallery', 'mk_framework'); ?>',
                    button: {
                        text: '<?php
        _e('Add to gallery', 'mk_framework'); ?>',
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                image_gallery_frame.on( 'select', function() {

                    var selection = image_gallery_frame.state().get('selection');

                    selection.map( function( attachment ) {

                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                             $gallery_images.append('\
                                <li class="image attachment details" data-attachment_id="' + attachment.id + '">\
                                    <div class="attachment-preview">\
                                        <div class="thumbnail">\
                                            <img src="' + attachment.url + '" />\
                                        </div>\
                                       <a href="#" class="delete check" title="<?php
        _e('Remove image', 'mk_framework'); ?>"><div class="media-modal-icon"></div></a>\
                                    </div>\
                                </li>');

                        }

                    } );

                    $image_gallery_ids.val( attachment_ids );
                });

                // Finally, open the modal.
                image_gallery_frame.open();
            });

            // Image ordering
            $gallery_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity:40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'eig-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#gallery_images_container<?php
        echo $value['id']; ?> ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#gallery_images_container<?php
        echo $value['id']; ?>').on( 'click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#gallery_images_container<?php
        echo $value['id']; ?> ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>
    <?php
        
        echo '<td>';
        
        echo '</tr>';
    }
    
    /*
    Extract Array data from sources
    */
    function get_select_target_options($type) {
        $options = array();
        switch ($type) {
            case 'page':
                $entries = get_pages('title_li=&orderby=name&number=40');
                foreach ($entries as $key => $entry) {
                    $options[$entry->ID] = $entry->post_title;
                }
                break;

            case 'cat':
                $entries = get_categories('orderby=name&hide_empty=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->term_id] = $entry->name;
                }
                break;

            case 'author':
                $mk_user_query = get_users();
                if (!empty($mk_user_query)) {
                    foreach ($mk_user_query as $user) {
                        $options[$user_id] = $user->display_name;
                    }
                }
                break;

            case 'post':
                $entries = get_posts('orderby=title&numberposts=20&order=ASC&suppress_filters=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->ID] = $entry->post_title;
                }
                break;

            case 'portfolio':
                $entries = get_posts('post_type=portfolio&orderby=title&numberposts=20&order=ASC&suppress_filters=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->ID] = $entry->post_title;
                }
                break;

            case 'flexslider':
                $entries = get_posts('post_type=slideshow&orderby=title&numberposts=20&order=ASC&suppress_filters=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->ID] = $entry->post_title;
                }
                break;

            case 'banner_builder':
                $entries = get_posts('post_type=banner_builder&orderby=title&numberposts=20&order=ASC&suppress_filters=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->ID] = $entry->post_title;
                }
                break;

            case 'edge':
                $entries = get_posts('post_type=edge&orderby=title&numberposts=20&order=ASC&suppress_filters=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->ID] = $entry->post_title;
                }
                break;

            case 'portfolio_category':
                $entries = get_terms('portfolio_category', 'orderby=name&hide_empty=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->slug] = $entry->name;
                }
                break;

            case 'portfolio_category_id':
                $entries = get_terms('portfolio_category', 'orderby=name&hide_empty=0');
                foreach ($entries as $key => $entry) {
                    $options[$entry->term_id] = $entry->name;
                }
                break;

            case 'revolution_slider':
                if (class_exists('RevSlider')) {
                    $slider = new RevSlider();
                    $arrSliders = $slider->getArrSlidersShort();
                    foreach ($arrSliders as $key => $entry) {
                        $options[$key] = $entry;
                    }
                }
                break;

            case 'layer_slider_source':
                if (is_plugin_active('LayerSlider/layerslider.php')) {
                    global $wpdb;
                    $table_name = $wpdb->prefix . "layerslider";
                    $sliders = $wpdb->get_results("SELECT * FROM $table_name
                                                WHERE flag_hidden = '0' AND flag_deleted = '0'
                                                ORDER BY date_c ASC LIMIT 100");
                    if ($sliders != null && !empty($sliders)) {
                        
                        foreach ($sliders as $item):
                            $options[$item->id] = $item->name;
                        endforeach;
                    }
                }
        }
        return $options;
    }
}

function mk_get_sidebar_options() {
    global $wp_registered_sidebars;
    $options = array();
    foreach ($wp_registered_sidebars as $sidebar) {
        $options[$sidebar["id"]] = $sidebar["name"];
    }
    return $options;
}

add_action('admin_init', 'mk_get_sidebar_options');





if(!function_exists('mk_load_metaboxes')) {
    function mk_load_metaboxes() {

        $metabox_path = get_template_directory() . '/framework/metaboxes/';
        $chid_theme_metabox_path = get_stylesheet_directory() . '/framework/metaboxes/';

        $metabox_dir = $metabox_path . 'metabox-*.php';

        
        $metaboxes = glob($metabox_dir);
        
        if(is_array($metaboxes) && !empty($metaboxes)) {
            foreach ($metaboxes as $metabox) {

                $metabox_name = array_reverse(explode('/', $metabox));
                $metabox_name = $metabox_name[0];

                if(file_exists($chid_theme_metabox_path.$metabox_name)) {
                    include_once($chid_theme_metabox_path.$metabox_name);
                } else {
                    include_once ($metabox);
                }

            }
        }
    }

    mk_load_metaboxes();
}




