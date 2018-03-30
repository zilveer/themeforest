<?php

/**
 * Get Theme Customizer Fields
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2013, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Helper function that holds array of theme options.
 *
 * @return	array	$options	Array of theme options
 * @uses	thsp_get_theme_customizer_fields()	defined in customizer/helpers.php
 */
function thsp_cbp_get_fields() {

	/*
	 * Using helper function to get default required capability
	 */
	$thsp_cbp_capability = thsp_cbp_capability();
	
	$options = array(

		
		// Section ID
		'icy_theme_logo' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Logo Setup', 'framework' ),
				'description' => __( 'Setup your own logo & favicon for your website.', 'framework' ),
				'priority' => 1
			),
			'fields' => array(
							
				'logo' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 2
					)
				),					
				'favicon' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Favicon', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 6
					)
				),				
			),
			
		),
		// Section ID
		'icy_theme_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Theme Settings', 'framework' ),
				'description' => __( 'Theme settings helping you customize your brand new theme and make it your own.', 'framework' ),
				'priority' => 6
			),
			'fields' => array(		
				'sidebar_position' => array(
					'setting_args' => array(
						'default' => 'sidebar-right',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Sidebar Layout', 'framework' ),
						'type' => 'select',
						'choices' => array(
							'sidebar-right' => array(
								'label' => __( 'Sidebar Right', 'framework' )
							),
							'sidebar-left' => array(
								'label' => __( 'Sidebar Left', 'framework' )
							),							
						),					
						'priority' => 1
					)
				),									
				'footer_text' => array(
					'setting_args' => array(
						'default' => '&copy; <a href="http://icypixels.com">Icy Pixels.</a> Designed with love, coded with care.',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Footer Text', 'framework' ),
						'type' => 'textarea', // Textarea control
						'priority' => 2
					)
				),

				'comments_message' => array(
					'setting_args' => array(
						'default' => 'Write us your thoughts about this post. Be kind & Play nice.',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Comments Message', 'framework' ),
						'type' => 'textarea', // Textarea control
						'priority' => 3
					)
				),

				'custom_css' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Custom CSS', 'framework' ),
						'type' => 'textarea', // Textarea control
						'priority' => 4
					)
				),


			),
			
		),

		'icy_update_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Auto-Update Settings', 'framework' ),
				'description' => __( 'Easily update your theme with the push of a button.', 'framework' ),
				'priority' => 7
			),
			'fields' => array(				
				'buyer_username' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Buyer Username', 'framework' ),
						'description' => __( 'Please provide a username in order for the auto-update to work.', 'framework'),
						'type' => 'text', 
						'priority' => 1
					)
				),
				'buyer_apikey' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Buyer API key', 'framework' ),
						'description' => __( 'Please provide a API key in order for the auto-update to work.', 'framework'),
						'type' => 'text', 
						'priority' => 2
					)
				),				
			),
			
		),
		
		'colors' => array(
			'existing_section' => true,
			'fields' => array(				
				'primary_accent' => array(
						'setting_args' => array(
							'default' => '#c0a127',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Primary Accent color', 'framework' ),
							'type' => 'color',							
							'priority' => 1
						)
				),																		
			)
		)

	);
	
	/* 
	 * 'thsp_cbp_options_array' filter hook will allow you to 
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'thsp_cbp_options_array', $options );
	
}