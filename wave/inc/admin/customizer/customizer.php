<?php
/**
 * Options framework for the Theme Customize WP feature
 */


include get_template_directory().'/inc/admin/customizer-options.php';

//delete_option( $dd_sn.'_customizer' );

/**
* Option types
*/
function dd_theme_customize_register( $wp_customize ) {
	
	global $dd_sn;
	global $customizer_options;
	
	$section_priority = 200;
	$setting_priority = 5;
	$current_section_id = '';
	$current_setting_id = '';
	
	foreach( $customizer_options as $customizer_option ) {

		if ( $customizer_option['type'] == 'section' ) {
			
			/* New Section */
			
			$section_priority += 50;
			$setting_priority = 5;
			$current_section_id = $dd_sn.'_'.$customizer_option['id'];
			
			$wp_customize->add_section( $current_section_id, array(
				'title'          => $customizer_option['title'],
				'priority'       => $section_priority,
			) );
			
		} elseif ( $customizer_option['type'] == 'option_color' ) {
			
			/* New Option (COLOR) */
			
			$current_setting_id = $dd_sn.'_customizer['.$customizer_option['id'].']';
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'        => $customizer_option['def'],
				'type'           => 'option'
			) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $current_setting_id, array(
					'label'    => $customizer_option['title'],
					'section'  => $current_section_id,
					'priority' => $setting_priority
				) ) );
			
		} elseif ( $customizer_option['type'] == 'option_text' ) {
			
			/* New Option (TEXT) */
			
			$current_setting_id = $dd_sn.'_customizer['.$customizer_option['id'].']';
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'option'
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'text',
					'priority'	=> $setting_priority
				));
			
		} elseif ( $customizer_option['type'] == 'option_select' ) {
			
			/* New Option (TEXT) */
			
			$current_setting_id = $dd_sn.'_customizer['.$customizer_option['id'].']';
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'option'
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'select',
					'choices'	=> $customizer_option['opts'],
					'priority'	=> $setting_priority,
				));
			
		} elseif ( $customizer_option['type'] == 'option_checkbox' ) {
			
			/* New Option (checkbox) */
			
			$current_setting_id = $dd_sn.'_customizer['.$customizer_option['id'].']';
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'option'
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'checkbox',
					'priority'	=> $setting_priority,
				));
			
		} elseif ( $customizer_option['type'] == 'option_image' ) {
			
			/* New Option (checkbox) */
			
			$current_setting_id = $dd_sn.'_customizer['.$customizer_option['id'].']';
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'option'
			) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'priority'	=> $setting_priority,
				) ) );
			
		}
		
	}

}

add_action( 'customize_register', 'dd_theme_customize_register' );

/**
* Get Customize values
*/
function dd_theme_get_customizer_options( ) {
		
	include get_template_directory().'/inc/admin/customizer-options.php';
	
	$customizer_user_defined = get_option($dd_sn.'_customizer');
	
	if ( ! empty( $customizer_user_defined ) ) {
		
		/* If values exist in DB return them */
		return $customizer_user_defined;
		
	} else {
	
		/* If they don't use the default vals */
		
		$customizer_defaults = array();
		
		foreach( $customizer_options as $customizer_opt ) {
			if ( $customizer_opt['type'] != 'section' ) {
				$customizer_opt_key = $customizer_opt['id'];
				$customizer_opt_val = $customizer_opt['def'];
				$customizer_defaults[$customizer_opt_key] = $customizer_opt_val;
			}
		}
		
		return $customizer_defaults;
		
	}
	
}


/**
* Get the font value
*/
function dd_theme_get_font( $font, $google_font ) {
	
	switch( $font ) {
		
		case 'inherit':
			$font = 'inherit';
			break;

		case 'arial':
			$font = '"Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif';
			break;
			
		case 'arialblack':
			$font = '"Arial Black", Gadget, sans-serif';
			break;
			
		case 'courier':
			$font = '"Courier New", Courier, monospace';
			break;
			
		case 'georgia':
			$font = 'Georgia, serif';
			break;
			
		case 'lucida':
			$font = '"Lucida Sans Unicode", "Lucida Grande", sans-serif';
			break;
			
		case 'tahoma':
			$font = 'Tahoma, Geneva, sans-serif';
			break;
			
		case 'times':
			$font = '"Times New Roman", Times, serif';
			break;
			
		case 'trebuchet':
			$font = '"Trebuchet MS", Helvetica, sans-serif';
			break;
			
		case 'verdana':
			$font = 'Verdana, Geneva, sans-serif';
			break;

		default:
			global $google_fonts_to_load;
			$google_fonts_to_load[] = $google_font;
			$font = '"'.$google_font.'"';
		
	}
	
	return $font;
	
}