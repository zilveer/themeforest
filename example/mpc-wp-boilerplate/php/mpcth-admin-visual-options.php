<?php

/**
 * Front End Customizer
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 * WordPress 3.4 Required
 */

require_once (get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-admin-options.php');
add_action( 'customize_register', 'mpcth_customizer_register' );

function mpcth_customizer_register($wp_customize) {
	global $mpcth_options_name;
	/**
	 * This is optional, but if you want to reuse some of the defaults
	 * or values you already have built in the options panel, you
	 * can load them into $options for easy reference
	 */

	$options = mpcth_optionsframework_options();

	/* Color Options */
	$add_to_visual = false;
	$slug = '';
	
	foreach($options as $option) {
		
		/* Add section */
		if(isset($option['visual_panel']) && $option['visual_panel'] == 'true') {
		
			$slug = preg_replace('/\s+/', '_', $option['visual_panel_title']);  
			$slug = strtolower($slug);
			
			$wp_customize->add_section( $mpcth_options_name . '_' . $slug, array(
				'title' => $option['visual_panel_title'],
				'priority' => 0
			));

			$add_to_visual = true;
		} elseif ((!isset($option['visual_panel']) && $option['type'] == 'accordion') || $option['type'] == 'heading') {
			$add_to_visual = false;
		}

		/* Add elements to section */
		if($add_to_visual && isset($option['id'])) {
			$wp_customize->add_setting( $mpcth_options_name . '[' . $option['id'] . ']', array(
				'default' => $option['std'],
				'type' => 'option'
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option['id'], array(
				'label'   => $option['name'],
				'section' => $mpcth_options_name . '_' . $slug,
				'settings'   => $mpcth_options_name . '[' . $option['id'] . ']'
			) ) );
		}
	}
}