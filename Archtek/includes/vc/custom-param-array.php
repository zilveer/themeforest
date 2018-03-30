<?php

// ---------------------------------------------- //
// Param array functions
// ---------------------------------------------- //
if(!function_exists('uxbarn_get_css_animation_param')) {
    function uxbarn_get_css_animation_param() {
        // CSS animation param code copied from "config/map.php" of VC plugin v3.6.5
        $add_css_animation = array(
          "type" => "dropdown",
          "heading" => __("CSS Animation", "uxbarn"),
          "param_name" => "css_animation",
          "admin_label" => false,
          "value" => array(
          				__("No", "uxbarn") => '', 
      					__("Top to bottom", "uxbarn") => "top-to-bottom", 
      					__("Bottom to top", "uxbarn") => "bottom-to-top", 
      					__("Left to right", "uxbarn") => "left-to-right", 
      					__("Right to left", "uxbarn") => "right-to-left", 
      					__("Appear from center", "uxbarn") => "appear"
					),
          "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "uxbarn")
        );
        
        return $add_css_animation;
    }
}



if(!function_exists('uxbarn_get_link_param')) {
    function uxbarn_get_link_param($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
        
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
             'type' => 'textfield',
             'holder' => 'div',
             'class' => '',
             'heading' => __('Target URL', 'uxbarn'),
             'param_name' => 'link',
             'value' => '',
             'description' => __('Specify the target URL once the element is clicked. For example: <em>http://www.uxbarn.com</em>. ' . $additional_desc, 'uxbarn'),
             'dependency' => $dependency_array,
          );
        
        return $param;
    }
}



if(!function_exists('uxbarn_get_open_new_window_param')) {
    function uxbarn_get_open_new_window_param($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
    	
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
             'type' => 'dropdown',
             'holder' => 'div',
             'class' => '',
             'heading' => __('Open new window?', 'uxbarn'),
             'param_name' => 'open_new_window',
             'value' => array(
                            __('No', 'uxbarn') => '', 
                            __('Yes', 'uxbarn') =>'true',
                        ),
             'description' => sprintf(__('Whether to open new window/tab when an element is clicked. %s', 'uxbarn'), $additional_desc),
             'admin_label' => false,
             'dependency' => $dependency_array,
          );
      
        return $param;
    }
}



if(!function_exists('uxbarn_get_extra_class_name')) {
    function uxbarn_get_extra_class_name() {
        
        $param = array(
             'type' => 'textfield',
             'holder' => 'div',
             'class' => '',
             'heading' => __('Extra class name', 'uxbarn'),
             'param_name' => 'extra_class',
             'value' => '',
             'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uxbarn'),
             'admin_label' => false,
          );
          
        return $param;
    }
}



if(!function_exists('uxbarn_get_orderby')) {
    function uxbarn_get_orderby() {
        $param = array(
             'type' => 'dropdown',
             'holder' => 'div',
             'class' => '',
             'heading' => __('Order by', 'uxbarn'),
             'param_name' => 'order_by',
             'value' => array(
                            __('ID', 'uxbarn') => 'ID', 
                            __('Title', 'uxbarn') => 'title',
                            __('Slug', 'uxbarn') => 'name',
                            __('Published Date', 'uxbarn') => 'date',
                            __('Modified Date', 'uxbarn') => 'modified',
                            __('Random', 'uxbarn') => 'rand',
                        ),
			'std'	=> 'ID',
             'description' => __('Select the which parameter to be used for ordering. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxbarn'),
             'admin_label' => false,
          );
          
        return $param;
    }
}



if(!function_exists('uxbarn_get_order')) {
    function uxbarn_get_order() {
        $param = array(
             'type' => 'dropdown',
             'holder' => 'div',
             'class' => '',
             'heading' => __('Order', 'uxbarn'),
             'param_name' => 'order',
             'value' => array(
                            __('Ascending', 'uxbarn') => 'ASC', 
                            __('Descending', 'uxbarn') =>'DESC',
                        ),
			'std'	=> 'ASC',
             'description' => __('<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxbarn'),
             'admin_label' => false,
          );
          
        return $param;
    }
}



if(!function_exists('uxbarn_get_stretch_image')) {
    function uxbarn_get_stretch_image($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
        
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param =  array(
                     'type' => 'dropdown',
                     'holder' => 'div',
                     'class' => '',
                     'heading' => __('Stretch image filling its column?', 'uxbarn'),
                     'param_name' => 'stretch_image',
                     'value' => array(
                                    __('No', 'uxbarn') => 'false', 
                                    __('Yes', 'uxbarn') =>'true',
                                ),
					'std'	=> 'false',
                     'description' => __('Theme will try to stretch this image to fill its containing column. <strong>NOTE:</strong> The column needs to have some height. In Edit Column screen, you may use either predefined option of "Fixed 255px" or "Fixed 510px" or enter your own extra class for the column.' . $additional_desc, 'uxbarn'),
                     'admin_label' => false,
                     'dependency' => $dependency_array,
                  );
          
        return $param;
    }
}



// button, vc_cta_button
if(!function_exists('uxbarn_get_button_text')) {
    function uxbarn_get_button_text($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
    	
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
                     'type' => 'textfield',
                     'holder' => 'div',
                     'class' => '',
                     'heading' => __('Button text', 'uxbarn'),
                     'param_name' => 'button_text',
                     'value' => __('Click me', 'uxbarn'),
                     'description' => $additional_desc,
                     'admin_label' => true,
                     'dependency' => $dependency_array,
                  );
          
        return $param;
    }
}



// button, vc_cta_button
if(!function_exists('uxbarn_get_button_color')) {
    function uxbarn_get_button_color($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
    	
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
                     'type' => 'dropdown',
                     'holder' => 'div',
                     'class' => '',
                     'heading' => __('Button color', 'uxbarn'),
                     'param_name' => 'button_color',
                     'value' => array(
                                    __('Default (as theme color)', 'uxbarn') => '', 
                                    __('Gray', 'uxbarn') => 'secondary',
                                    __('Red', 'uxbarn') => 'alert',
                                    __('Green', 'uxbarn') => 'success',
                                    __('Custom', 'uxbarn') => 'custom',
                                ),
                     'description' => sprintf(__('Choose the button color. %s', 'uxbarn'), $additional_desc),
                     'admin_label' => false,
                     'dependency' => $dependency_array,
                  );
          
        return $param;
    }
}



// button, vc_cta_button
if(!function_exists('uxbarn_get_button_custom_color')) {
    function uxbarn_get_button_custom_color($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
    	
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
                     'type' => 'colorpicker',
                     'holder' => 'div',
                     'class' => '',
                     'heading' => __('Custom color', 'uxbarn'),
                     'param_name' => 'button_custom_color',
                     'value' => '',
                     'description' => $additional_desc,
                     'admin_label' => false,
                     'dependency' => $dependency_array,
                  );
          
        return $param;
    }
}



// button, vc_cta_button
if(!function_exists('uxbarn_get_button_size')) {
    function uxbarn_get_button_size($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
        
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
                     'type' => 'dropdown',
                     'holder' => 'div',
                     'class' => '',
                     'heading' => __('Button size', 'uxbarn'),
                     'param_name' => 'button_size',
                     'value' => array(
                                    __('Default (medium)', 'uxbarn') => '', 
                                    __('Small', 'uxbarn') => 'small',
                                    __('Large', 'uxbarn') => 'large',
                                ),
                     'description' => sprintf(__('Choose the size.', 'uxbarn'), $additional_desc),
                     'admin_label' => true,
                     'dependency' => $dependency_array,
                  );
          
        return $param;
    }
}



// button, vc_cta_button
if(!function_exists('uxbarn_get_button_border_style')) {
    function uxbarn_get_button_border_style($dependency_param_name = '', $dependency_value_array = array(), $additional_desc = '') {
        
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
                     'type' => 'dropdown',
                     'holder' => 'div',
                     'class' => '',
                     'heading' => __('Button border style', 'uxbarn'),
                     'param_name' => 'button_border',
                     'value' => array(
                                    __('Default', 'uxbarn') => '', 
                                    __('Radius', 'uxbarn') => 'radius',
                                    __('Round', 'uxbarn') => 'round',
                                ),
                     'description' => sprintf(__('Choose the border style for the button.', 'uxbarn'), $additional_desc),
                     'admin_label' => false,
                     'dependency' => $dependency_array,
                  );
          
        return $param;
    }
}



// Image gallery/slider, Testimonial slider
if(!function_exists('uxbarn_get_auto_rotation')) {
    function uxbarn_get_auto_rotation($dependency_param_name = '', $dependency_value_array = array()) {
        
		$dependency_array = array();
		if ( $dependency_param_name != '' && $dependency_value_array != array() ) {
			$dependency_array = array(
                                    'element' 	=> $dependency_param_name,
                                    'value' 	=> $dependency_value_array,
                                );
		}
		
        $param = array(
                 'type' => 'dropdown',
                 'holder' => 'div',
                 'class' => '',
                 'heading' => __('Auto rotation duration', 'uxbarn'),
                 'param_name' => 'auto_rotation_duration',
                 'value' => array(
                                __('Disable auto rotation', 'uxbarn') => 'disabled',
                                '5' => '5',
                                '6' => '6',
                                '7' => '7',
                                '8' => '8',
                                '9' => '9',
                                '10' => '10',
                                '12' => '12',
                                '14' => '14',
                                '16' => '16',
                                '18' => '18',
                                '20' => '20',
                                '25' => '25',
                                '30' => '30',
                                '40' => '40',
                                '60' => '60',
                                '80' => '80',
                                '100' => '100',
                            ),
				'std'	=> 'disabled',
                 'description' => __('Select how many seconds to stay on current slide before rotating to the next one.', 'uxbarn'),
                 'admin_label' => false,
                 'dependency' => $dependency_array,
              );
              
        return $param;
    }
}



if(!function_exists('uxbarn_get_image_size_array')) {
    function uxbarn_get_image_size_array() {
        // Prepare image size array
        $size_array = array(__('Original size', 'uxbarn') => 'full');
        
        foreach (get_intermediate_image_sizes() as $s) {
            
            global $_wp_additional_image_sizes;
            
            if (isset($_wp_additional_image_sizes[$s])) {
                $width = intval($_wp_additional_image_sizes[$s]['width']);
                $height = intval($_wp_additional_image_sizes[$s]['height']);
            } else {
                $width = get_option($s.'_size_w');
                $height = get_option($s.'_size_h');
            }
            
            $clean_name = ucwords(str_replace('cropped', '', str_replace('-', ' ', $s)));
            
            $size_array[$clean_name . ' (' . $width . 'x' . $height . ')'] = $s;
            
        }
        
        return $size_array;
    }
}
