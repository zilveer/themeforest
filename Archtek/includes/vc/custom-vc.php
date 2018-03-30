<?php

/***** Visual Composer *****/
define( 'UXB_VC_THEME_DEFAULT_STYLE_VALUE', 'theme-default' );



// Customize the VC rows and columns to use theme's classes
if ( ! function_exists( 'uxbarn_customize_vc_rows_columns' ) ) {
	
	function uxbarn_customize_vc_rows_columns( $class_string, $tag ) {
			
		// vc_row 
		if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
			
			$replace = array(
				'vc_row-fluid' 	=> 'row',
				'wpb_row' 		=> '',
				'vc_row'		=> '', 
			);
			
			$class_string = uxbarn_replace_string_with_assoc_array( $replace, $class_string );
			
		}
		
		// vc_column
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			
			$replace = array(
				'wpb_column' 		=> '',
				'vc_column_container' 	=> '',
			);
			
			// VC 4.3.x (it changed the tags)
			$class_string = uxbarn_replace_string_with_assoc_array(
								$replace, preg_replace('/vc_col-(xs|sm|md|lg)-(\d{1,2})/', 'uxb-col large-$2 columns', $class_string)
							);
							
		}
		
		return $class_string;
		
	}

}



if ( ! function_exists( 'uxbarn_customize_vc_elements' ) ) {

	function uxbarn_customize_vc_elements() {

		if ( class_exists( 'WPBMap' ) && function_exists( 'vc_update_shortcode_param' ) ) {
			
			// Heading
			uxbarn_customize_vc_element_vc_custom_heading();
			// Gallery
			uxbarn_customize_vc_element_vc_gallery();
			// Tabs
			uxbarn_customize_vc_element_vc_tta_tabs();
			// Tour
			uxbarn_customize_vc_element_vc_tta_tour();
			// Accordion
			uxbarn_customize_vc_element_vc_tta_accordion();
			// Posts Slider
			uxbarn_customize_vc_element_vc_posts_slider();
			
		}
		
		if ( function_exists( 'vc_remove_param' ) ) {
			
			vc_remove_param( 'vc_row', 'full_height' );
			vc_remove_param( 'vc_row', 'content_placement' );
			/*vc_remove_param( 'vc_row', 'full_width' );
			vc_remove_param( 'vc_row', 'video_bg' );
			vc_remove_param( 'vc_row', 'video_bg_url' );
			vc_remove_param( 'vc_row', 'video_bg_parallax' );
			vc_remove_param( 'vc_row', 'parallax' );
			vc_remove_param( 'vc_row', 'parallax_image' );*/
			
		}

	}

}



// Add some custom param to the existing elements
if ( ! function_exists('uxbarn_add_custom_param_to_vc_elements' ) ) {
	
	function uxbarn_add_custom_param_to_vc_elements() {
		
		if ( function_exists( 'vc_add_param' ) ) {
			
			$theme_class_desc = __('You can select some predefined options here for additional styles (Learn more about this in the documentation on "Tutorial" section). If you want more custom styles, please enter your custom CSS class to the "Extra class name" field above.', 'uxbarn');
			
			// To Row element
			$predefined_class_for_row = uxbarn_get_predefined_class_for_row_array( $theme_class_desc );
			vc_add_param( 'vc_row', $predefined_class_for_row );
			
			// To Column element
			$predefined_class_for_column = uxbarn_get_predefined_class_for_column_array( $theme_class_desc );
			vc_add_param( 'vc_column', $predefined_class_for_column );
					
		}

	}
	
}



if ( ! function_exists( 'uxbarn_add_custom_param_to_vc_inner_elements' ) ) {
	
	function uxbarn_add_custom_param_to_vc_inner_elements() {
		
		if ( function_exists( 'vc_add_param' ) ) {
			
			$theme_class_desc = __('You can select some predefined options here for additional styles (Learn more about this in the documentation on "Tutorial" section). If you want more custom styles, please enter your custom CSS class to the "Extra class name" field above.', 'uxbarn');
			// To Inner Row element
			$predefined_class_for_row = uxbarn_get_predefined_class_for_row_array( $theme_class_desc );
			vc_add_param( 'vc_row_inner', $predefined_class_for_row );
			
			// To Inner Column element
			$predefined_class_for_column = uxbarn_get_predefined_class_for_column_array( $theme_class_desc );
			vc_add_param( 'vc_column_inner', $predefined_class_for_column );
					
		}
		
	}
	
}



if ( ! function_exists( 'uxbarn_get_predefined_class_for_row_array' ) ) {
	
	function uxbarn_get_predefined_class_for_row_array( $theme_class_desc ) {
		
		return array(
					 'type' => 'checkbox',
					 'holder' => 'span',
					 'class' => '',
					 'heading' => __('Predefined options', 'uxbarn'),
					 'param_name' => 'uxb_theme_class',
					 'value' => array(
									__('Increase outer padding', 'uxbarn') . '<br/>' => 'outer-padding',
									__('Make contained columns smaller padding', 'uxbarn') . '<br/>' => 'col-small-padding',
									__('Increase top margin', 'uxbarn') . '<br/>' => 'top-margin',
									__('No top padding', 'uxbarn') . '<br/>' => 'no-padding-top',
									__('No bottom padding', 'uxbarn') . '<br/>' => 'no-padding-bottom',
									__('Has line at the bottom', 'uxbarn') . '<br/>' => 'bottom-line',
									__('No background', 'uxbarn') . '<br/>' => 'no-bg',
								),
					'save_always' => true,
					 'description' => $theme_class_desc,
					 'admin_label' => false,
				  );
		
	}
	
}



if ( ! function_exists( 'uxbarn_get_predefined_class_for_column_array' ) ) {
	
	function uxbarn_get_predefined_class_for_column_array( $theme_class_desc ) {
		
		return array(
					 'type' => 'checkbox',
					 'holder' => 'span',
					 'class' => '',
					 'heading' => __('Predefined options', 'uxbarn'),
					 'param_name' => 'uxb_theme_class',
					 'value' => array(
									__('For nesting other rows/columns <em>(if use this, please also uncheck "No padding" option below)</em>', 'uxbarn') . '<br/>' => 'for-nested',
									__('No padding', 'uxbarn') . '<br/>' => 'no-padding',
									__('Has line at the bottom', 'uxbarn') . '<br/>' => 'bottom-line',
									__('Center alignment', 'uxbarn') . '<br/>' => 'col-center',
									__('Fixed 255px height', 'uxbarn') . '<br/>' => 'height-255',
									__('Fixed 510px height', 'uxbarn') . '<br/>' => 'height-510',
								),
					'save_always' => true,
					 'description' => $theme_class_desc,
					 'admin_label' => false,
				  );
		
	}
	
}




if ( ! function_exists( 'uxbarn_customize_vc_element_vc_custom_heading' ) ) {

	function uxbarn_customize_vc_element_vc_custom_heading() {
		
		$vc_element = 'vc_custom_heading';
		
		if ( WPBMap::exists( $vc_element ) ) {
				
			/*** "use_theme_fonts" ***/
			/* Purpose: to set the default value to use theme's font */
			$param = WPBMap::getParam( $vc_element, 'use_theme_fonts' );
			if ( $param ) {
				$param['std'] = 'yes';
				vc_update_shortcode_param( $vc_element, $param );
			}
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_customize_vc_element_vc_tta_tabs' ) ) {

	function uxbarn_customize_vc_element_vc_tta_tabs() {

		$vc_element = 'vc_tta_tabs';
		
		if ( WPBMap::exists( $vc_element ) ) {
				
			$theme_default_style_array = uxbarn_get_theme_default_style_array();

			/*** "style" param ***/
			/* Purpose: to add theme's style as a default option for the element */
			$param = WPBMap::getParam( $vc_element, 'style' );
			if ( $param ) {
				$param['value'] = $theme_default_style_array + $param['value'];
				$param['std'] = UXB_VC_THEME_DEFAULT_STYLE_VALUE;
				vc_update_shortcode_param( $vc_element, $param );
			}



			/*** "shape", "color", "no_fill_content_area", "spacing", "gap" ***/
			/* Purpose: to edit the dependency of this param so if the theme's style is used, the param will not display */
			$param = WPBMap::getParam( $vc_element, 'shape' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'color' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'no_fill_content_area' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'spacing' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'gap' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_customize_vc_element_vc_tta_tour' ) ) {

	function uxbarn_customize_vc_element_vc_tta_tour() {

		$vc_element = 'vc_tta_tour';
		
		if ( WPBMap::exists( $vc_element ) ) {
				
			$theme_default_style_array = uxbarn_get_theme_default_style_array();

			/*** "style" param ***/
			/* Purpose: to add theme's style as a default option for the element */
			$param = WPBMap::getParam( $vc_element, 'style' );
			if ( $param ) {
				$param['value'] = $theme_default_style_array + $param['value'];
				$param['std'] = UXB_VC_THEME_DEFAULT_STYLE_VALUE;
				vc_update_shortcode_param( $vc_element, $param );
			}



			/*** "shape", "color", "no_fill_content_area", "spacing", "gap" ***/
			/* Purpose: to edit the dependency of this param so if the theme's style is used, the param will not display */
			$param = WPBMap::getParam( $vc_element, 'shape' );
			if ( $param ) {vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'color' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'no_fill_content_area' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'spacing' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'gap' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_customize_vc_element_vc_tta_accordion' ) ) {

	function uxbarn_customize_vc_element_vc_tta_accordion() {

		$vc_element = 'vc_tta_accordion';
		
		if ( WPBMap::exists( $vc_element ) ) {
				
			$theme_default_style_array = uxbarn_get_theme_default_style_array();

			/*** "style" param ***/
			/* Purpose: to add theme's style as a default option for the element */
			$param = WPBMap::getParam( $vc_element, 'style' );
			if ( $param ) {
				$param['value'] = $theme_default_style_array + $param['value'];
				$param['std'] = UXB_VC_THEME_DEFAULT_STYLE_VALUE;
				vc_update_shortcode_param( $vc_element, $param );
			}



			/*** "shape", "color", "no_fill_content_area", "spacing", "gap" ***/
			/* Purpose: to edit the dependency of this param so if the theme's style is used, the param will not display */
			$param = WPBMap::getParam( $vc_element, 'shape' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'color' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'no_fill' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'spacing' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			$param = WPBMap::getParam( $vc_element, 'gap' );
			if ( $param ) { vc_update_shortcode_param( $vc_element, uxbarn_add_dependency_not_equal_to_for_param( $param, array( UXB_VC_THEME_DEFAULT_STYLE_VALUE ) ) ); }
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_customize_vc_element_vc_gallery' ) ) {

	function uxbarn_customize_vc_element_vc_gallery() {

		$vc_element = 'vc_gallery';
		
		if ( WPBMap::exists( $vc_element ) ) {
				
			/*** "type" ***/
			/* Purpose: to remove "Nivo Slider" type out of the list */
			$param = WPBMap::getParam( $vc_element, 'type' );
			if ( $param ) {
				
				if ( ( $key = array_search( 'nivo', $param['value'] ) ) !== false ) {
					unset( $param['value'][$key] );
				}

				vc_update_shortcode_param( $vc_element, $param );
				
			}
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_customize_vc_element_vc_posts_slider' ) ) {

	function uxbarn_customize_vc_element_vc_posts_slider() {

		$vc_element = 'vc_posts_slider';
		
		if ( WPBMap::exists( $vc_element ) ) {
				
			/*** "type" ***/
			/* Purpose: to remove "Nivo Slider" type out of the list */
			$param = WPBMap::getParam( $vc_element, 'type' );
			if ( $param ) {
					
				if ( ( $key = array_search( 'nivo', $param['value'] ) ) !== false ) {
					unset( $param['value'][$key] );
				}

				vc_update_shortcode_param( $vc_element, $param );
				
			}
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_get_theme_default_style_array' ) ) {

	function uxbarn_get_theme_default_style_array( $additional_entry_array = array() ) {
		
		return array( 
					__( "Theme's Default Style", 'uxbarn' ) => UXB_VC_THEME_DEFAULT_STYLE_VALUE,
				) + $additional_entry_array;

	}

}
	


// For adding "value_not_equal_to" dependency for element's param
if ( ! function_exists( 'uxbarn_add_dependency_not_equal_to_for_param' ) ) {

	function uxbarn_add_dependency_not_equal_to_for_param( $param, $not_equal_to_string_array ) {

		if ( ! empty( $param['dependency'] ) && ! empty( $param['dependency']['value_not_equal_to'] ) ) {

			foreach( $not_equal_to_string_array as $value ) {
				array_push( $param['dependency']['value_not_equal_to'], $value );
			}
			
		} else {

			$param['dependency'] = array(
				'element' => 'style',
				'value_not_equal_to' => $not_equal_to_string_array,
			);

		}

		return $param;

	}

}



if ( ! function_exists( 'uxbarn_remove_vc_prettyphoto' ) ) {

	function uxbarn_remove_vc_prettyphoto() {
	
		wp_deregister_script( 'prettyphoto' );
		wp_deregister_style( 'prettyphoto' );

	}

}



if ( ! function_exists( 'uxb_team_get_css_animation_complete_class' ) ) {
    
    function uxb_team_get_css_animation_complete_class( $css_animation ) {
    	
        // Code copied from "/lib/shortcodes.php" of VC plugin v3.6.5. Function: getCSSAnimation()
        if ( $css_animation != '' ) {
        	
            wp_enqueue_script( 'waypoints' );
            return ' wpb_animate_when_almost_visible wpb_' . $css_animation;
			
        } else {
            return '';
        }
        
    }
	
}