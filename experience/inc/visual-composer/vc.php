<?php
if( has_action( 'vc_before_init' ) ) {
	
	add_action( 'vc_before_init',	'experience_vc_init' );
	add_action( 'vc_before_init',	'experience_remove_vc_elements' );
	add_action( 'vc_before_init',	'experience_map_update_vc_elements' );
	add_action( 'vc_before_init',	'experience_add_params_vc_elements' );
	add_action( 'vc_before_init',	'experience_remove_params_vc_elements' );
	add_action( 'vc_after_init', 	'experience_param_update_vc_elements' );
	add_action( 'vc_load_default_templates_action','experience_custom_vc_templates' );
	
}

function experience_vc_init() {

	/* ---------- Embed In Theme ---------- */
	vc_set_as_theme();

}

	
/**
 *	Remove unwanted VC elements
 **/
function experience_remove_vc_elements() {

	vc_remove_element( 'vc_gmaps' );			// Replaced by experience_google_map
	vc_remove_element( 'vc_posts_slider' );
	
	//vc_remove_element( 'vc_cta_button' );

}


/**
 *	Update existing VC elements
 **/
function experience_map_update_vc_elements() {

	vc_map_update( 'vc_video',		array( 'name' => 'Video (Embed)' ) );	
	vc_map_update( 'vc_facebook',	array( 'name' => 'Facebook Button' ) );
	vc_map_update( 'vc_tweetmeme',	array( 'name' => 'Twitter Button' ) );
	vc_map_update( 'vc_pinterest',	array( 'name' => 'Pinterest Button' ) );

}


/**
 *	Add params to default Visual Composer elements
 **/
function experience_add_params_vc_elements() {
	
	// ----- Row [vc_row] ----- //
	vc_add_params( "vc_row", array(
		
		// Title
		array(
			"param_name"	=> "el_title",
			"heading"		=> esc_html__( "Title", 'experience' ),
			"type"			=> "textfield",
			"description"	=> esc_html__( "Enter a title to be shown when this rows pagination link is hovered over. Section pagination links must be enabled in the Page Options.", 'experience' )
		),
		
		// Width
		array(
			"param_name"	=> "width",
			"heading"		=> esc_html__( "Max Width", 'experience' ),
			"type"			=> "dropdown",
			'value'			=> array( 
				esc_html__( "Fluid", 'experience' )  => "",
				esc_html__( "Boxed", 'experience' )  => "site-width",
				esc_html__( "Narrow", 'experience' ) => "narrow-width"
			),
			"description"	=> esc_html__( "Set the max width of content in this row.", 'experience' )
		),
		
		// Parallax (Video)	(modified version of VC original)
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Parallax', 'experience' ),
			'param_name' 	=> 'video_bg_parallax',
			'value' 		=> array(
				esc_html__( 'None', 'experience' ) 	=> '',
				esc_html__( 'Simple', 'experience' ) 	=> 'content-moving'
			),
			'description' 	=> esc_html__( 'Add parallax type background for row.', 'experience' ),
			'dependency' 	=> array(
				'element' 		=> 'video_bg',
				'not_empty' 	=> true,
			),
		),
		
		// Parallax (modified version of VC original)
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Parallax', 'experience' ),
			'param_name' 	=> 'parallax',
			'value' 		=> array(
				esc_html__( 'None', 'experience' ) 	=> '',
				esc_html__( 'Simple', 'experience' ) 	=> 'content-moving'
			),
			'description' 	=> esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'experience' ),
			'dependency' 	=> array(
				'element' 		=> 'video_bg',
				'is_empty' 		=> true,
			),
		),
		
		// Padding (Vertical)
		array(
			"param_name"	=> "padding_v",			
			"heading"		=> esc_html__( "Padding (Vertical)", 'experience' ),			
			"type"			=> "dropdown",
			'value'			=> array( 
				esc_html__( "Default", 'experience' )				=> "padding-v",
				esc_html__( "Top only", 'experience' ) 				=> "padding-v no-padding-bottom",
				esc_html__( "Bottom only", 'experience' ) 			=> "padding-v no-padding-top",
				esc_html__( "Large top and bottom", 'experience' )	=> "padding-v-large",
				esc_html__( "Large top only", 'experience' ) 		=> "padding-v-large no-padding-bottom",
				esc_html__( "Large bottom only", 'experience' )		=> "padding-v-large no-padding-top",
				esc_html__( "Small top and bottom", 'experience' )	=> "padding-v-small",
				esc_html__( "Small top only", 'experience' ) 		=> "padding-v-small no-padding-bottom",
				esc_html__( "Small bottom only", 'experience' )		=> "padding-v-small no-padding-top",
				esc_html__( "None", 'experience' ) 					=> "padding-v-none"
			),
			"description"	=> esc_html__( "Set the left and right padding of this row.", 'experience' )
		),
		
		// Padding (Horizontal)
		array(
			"param_name"	=> "padding_h",			
			"heading"		=> esc_html__( "Padding (Horizontal)", 'experience' ),			
			"type"			=> "dropdown",
			'value'			=> array( 
				esc_html__( "Default", 'experience' )				=> "padding-h",
				esc_html__( "Left only", 'experience' )				=> "padding-h no-padding-right",
				esc_html__( "Right only", 'experience' )			=> "padding-h no-padding-left",
				esc_html__( "Small left and right", 'experience' ) 	=> "padding-h-small",
				esc_html__( "Small left only", 'experience' )		=> "padding-h-small no-padding-right",
				esc_html__( "Small right only", 'experience' )		=> "padding-h-small no-padding-left",
				esc_html__( "None", 'experience' )					=> "padding-h-none"
			),
			"description"	=> esc_html__( "Set the top and bottom padding of this row.", 'experience' )
		),
		
		// Colour Scheme
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),			
			"type"			=> "dropdown",
			'value'			=> array( 
				""												=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' ) 	=> "color-scheme-10"
			),
			"description"	=> esc_html__( "Select the colour scheme used for this row. This setting can be overwritten for individual columns within this row. Colour schemes are configured on the Theme Options screen.", 'experience' )
		)		
		
	));
	
	
	// ----- Column [vc_column] ----- //
	vc_add_params( "vc_column", array(
		
		// Padding (Vertical)
		array(
			"param_name"	=> "padding_v",			
			"heading"		=> esc_html__( "Padding (Vertical)", 'experience' ),			
			"type"			=> "dropdown",
			'value'			=> array( 
				esc_html__( "Default", 'experience' )				=> "",
				esc_html__( "Top and Bottom", 'experience' ) 		=> "padding-v",
				esc_html__( "Top Only", 'experience' ) 				=> "padding-v no-padding-bottom",
				esc_html__( "Bottom Only", 'experience' ) 			=> "padding-v no-padding-top",
				esc_html__( "Large top and bottom", 'experience' )	=> "padding-v-large",
				esc_html__( "Large top only", 'experience' ) 		=> "padding-v-large no-padding-bottom",
				esc_html__( "Large bottom only", 'experience' )		=> "padding-v-large no-padding-top",
				esc_html__( "Small Top and Bottom", 'experience' ) 	=> "padding-v-small",
				esc_html__( "Small Top Only", 'experience' ) 		=> "padding-v-small no-padding-bottom",
				esc_html__( "Small Bottom Only", 'experience' )		=> "padding-v-small no-padding-top",
				esc_html__( "None", 'experience' ) 					=> "padding-v-none"
			),
			"description"	=> esc_html__( "Set the left and right padding of this row.", 'experience' )
		),
		
		// Padding (Horizontal)
		array(
			"param_name"	=> "padding_h",			
			"heading"		=> esc_html__( "Padding (Horizontal)", 'experience' ),		
			"type"			=> "dropdown",
			'value'			=> array( 
				esc_html__( "Default", 'experience' )				=> "",
				esc_html__( "Left and right", 'experience' )		=> "padding-h",
				esc_html__( "Left only", 'experience' )				=> "padding-h no-padding-right",
				esc_html__( "Right only", 'experience' )			=> "padding-h no-padding-left",
				esc_html__( "Small left and right", 'experience' )	=> "padding-h-small",
				esc_html__( "Small left only", 'experience' )		=> "padding-h-small no-padding-right",
				esc_html__( "Small right only", 'experience' )		=> "padding-h-small no-padding-left",
				esc_html__( "None", 'experience' )					=> "padding-h-none"
			),
			"description"	=> esc_html__( "Set the top and bottom padding of this row.", 'experience' )
		),
		
		// Colour Scheme
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),		
			"type"			=> "dropdown",
			'value'			=> array( 
				""											=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' )=> "color-scheme-10",
			),
			"description"	=> esc_html__( "Select the colour scheme used for this column. Colour schemes are configured on the Theme Options screen.", 'experience' )
		)	
		
	));
	
	
	// ----- Button [vc_btn] ----- //
	vc_add_params( "vc_btn", array(
		
		// Color
		array(
			"param_name"	=> "color",
			"heading"		=> esc_html__( "Color", 'experience' ),
			"description"	=> esc_html__( "Select button colour.", 'experience' ),
			"type"			=> "dropdown",
			"value"			=> array(
				esc_html__( "Primary", 'experience' )		=> "",
				esc_html__( "Secondary", 'experience' )	=> "secondary"		
			)
		)
		
	));	
	
	// ----- Image Gallery [vc_gallery] ----- //
	vc_add_params( "vc_gallery", array(
		
		// Width
		array(
			"param_name"	=> "onclick",
			"heading"		=> esc_html__( "On Click Action", 'experience' ),
			"type"			=> "dropdown",
			'value'			=> array( 
				esc_html__( "Open in lightbox", 'experience' )=> "link_image",
				esc_html__( "None", 'experience' )			=> "link_no",
				esc_html__( "Open custom link", 'experience' )=> "custom_link"
			),
			"description"	=> esc_html__( "Select action for click action.", 'experience' )
		),
		
		// Columns
		array(
			"param_name"	=> "columns",			
			"heading"		=> esc_html__( "Grid Columns", 'experience' ),			
			"type"			=> "dropdown",
			'value'			=> array( 
				""						 			=> "",
				esc_html__( "1", 'experience' ) 	=> "1",
				esc_html__( "2", 'experience' ) 	=> "2",
				esc_html__( "3", 'experience' ) 	=> "3",
				esc_html__( "4", 'experience' ) 	=> "4",
				esc_html__( "5", 'experience' )		=> "5",
				esc_html__( "6", 'experience' ) 	=> "6",
				esc_html__( "7", 'experience' ) 	=> "7",
				esc_html__( "8", 'experience' ) 	=> "8",
				esc_html__( "9", 'experience' ) 	=> "9"
			),
			"description"	=> esc_html__( "Set number of columns the gallery images are arrange into.", 'experience' )
		),
		
		// Remove Spacing
		array(
			"param_name"	=> "remove_spacing",
			"heading"		=> esc_html__( "Remove Spacing", 'experience' ),
			"description"	=> esc_html__( "Enable this option to remove the space between cells in the media grid.", 'experience' ),
			"type"			=> "checkbox"
		),
		
		// ----- CSS ----- //
		
		// CSS
		array(
			"param_name" => "css",
			"heading"	 => esc_html__( "CSS", 'experience' ),
			"type"		 => "css_editor",
			"group"		 => esc_html__( "Design options", 'experience' )
		)
		
	));
	
	
	// ----- Slider [experience_slider] ----- //
	vc_add_params( "experience_slider", array(
	
	));
	
	
	// ----- Slider Slide [experience_slider_slide] ----- //
	vc_add_params( "experience_slider_slide", array(
		
		// Colour Scheme
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),			
			"description"	=> esc_html__( "Select the colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			"type"			=> "dropdown",
			"value"			=> array( 
				""												=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' )	=> "color-scheme-10",
			)
		)
	
	));
	
	
	// ----- Custom Gallery [experience_custom_gallery] ----- //
	vc_add_params( "experience_custom_gallery", array(
	
		// Remove Spacing
		array(
			"param_name"	=> "remove_spacing",
			"heading"		=> esc_html__( "Remove Spacing", 'experience' ),
			"description"	=> esc_html__( "Enable this option to remove the space between cells in the media grid.", 'experience' ),
			"type"			=> "checkbox"
		)
		
	));
	
	
	// ----- Portfolio Custom [experience_portfolio_custom] ----- //
	vc_add_params( "experience_portfolio_custom", array(
		
		// Colour Scheme
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),			
			"description"	=> esc_html__( "Select the colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			"type"			=> "dropdown",
			'value'			=> array( 
				""												=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' )	=> "color-scheme-10",
			)
		),
		
		// Grid Width
		array(
			"param_name"	=> "grid_width",			
			"heading"		=> esc_html__( "Grid Width", 'experience' ),
			"description"	=> esc_html__( "Select the portfolio grid width.", 'experience' ),
			"type"			=> "dropdown",
			"value"			=> array(
				esc_html__( "Full Width", 'experience' )	=> "",
				esc_html__( "Boxed", 'experience' )		=> "site-width",
				esc_html__( "Narrow", 'experience' )		=> "narrow-width"
			),
			"dependency"	=> array(
				"element"		=> "layout",
				"value"			=> array( "grid" )
			)
		)
		
	));
	
	
	// ----- Slider Text [experience_slider_text] ----- //
	vc_add_params( "experience_slider_text", array(
		
		// Colour Scheme
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),			
			"description"	=> esc_html__( "Select the colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			"type"			=> "dropdown",
			"value"			=> array( 
				""												=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' )	=> "color-scheme-10",
			)
		)
		
	));
	
	
	// ----- Instagram Gallery [experience_instagram_gallery] ----- //
	vc_add_params( "experience_instagram_gallery", array(
		
		// Remove Spacing
		array(
			"param_name"	=> "remove_spacing",
			"heading"		=> esc_html__( "Remove Spacing", 'experience' ),
			"description"	=> esc_html__( "Enable this option to remove the space between cells in the media grid.", 'experience' ),
			"type"			=> "checkbox"
		)
		
		
	));
	
	
	// ----- Portfolio [experience_portfolio] ----- //
	vc_add_params( "experience_portfolio", array(
	
		// Fill Screen
		array(
			"param_name"	=> "fill_screen",
			"heading"		=> esc_html__( "Fill Screen", 'experience' ),
			"description"	=> esc_html__( "Set this row's minimum height so that it fills the window height.", 'experience' ),
			"type"			=> "checkbox"
		)
	
	));
	
	
	// ----- Portfolio Grid [experience_portfolio_grid] ----- //
	vc_add_params( "experience_portfolio_grid", array(
	
		// Colour Scheme	
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),			
			"description"	=> esc_html__( "Select the colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			"type"			=> "dropdown",
			'value'			=> array( 
				""												=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' )	=> "color-scheme-10",
			)
		),
		
		// Grid Width
		array(
			"param_name"	=> "grid_width",			
			"heading"		=> esc_html__( "Grid Width", 'experience' ),
			"description"	=> esc_html__( "Select the portfolio grid width.", 'experience' ),
			"type"			=> "dropdown",
			"value"			=> array(
				esc_html__( "Full Width", 'experience' )	=> "",
				esc_html__( "Boxed", 'experience' )		=> "site-width",
				esc_html__( "Narrow", 'experience' )		=> "narrow-width"					
			)
		)
	
	));
	
	
	// ----- Posts Grid [experience_posts_grid] ----- //
	vc_add_params( "experience_posts_grid", array(
		
		// Colour Scheme	
		array(
			"param_name"	=> "color",			
			"heading"		=> esc_html__( "Colour Scheme", 'experience' ),			
			"description"	=> esc_html__( "Select the colour scheme. Colour schemes are configured on the Theme Options screen.", 'experience' ),
			"type"			=> "dropdown",
			'value'			=> array( 
				""												=> "",
				esc_html__( "Colour Scheme 1", 'experience' )	=> "color-scheme-1",
				esc_html__( "Colour Scheme 2", 'experience' )	=> "color-scheme-2",
				esc_html__( "Colour Scheme 3", 'experience' )	=> "color-scheme-3",
				esc_html__( "Colour Scheme 4", 'experience' )	=> "color-scheme-4",
				esc_html__( "Colour Scheme 5", 'experience' )	=> "color-scheme-5",
				esc_html__( "Colour Scheme 6", 'experience' )	=> "color-scheme-6",
				esc_html__( "Colour Scheme 7", 'experience' )	=> "color-scheme-7",
				esc_html__( "Colour Scheme 8", 'experience' )	=> "color-scheme-8",
				esc_html__( "Colour Scheme 9", 'experience' )	=> "color-scheme-9",
				esc_html__( "Colour Scheme 10", 'experience' )	=> "color-scheme-10",
			)
		),
		
		// Colour Scheme	
		array(
			"param_name"	=> "color_alt",			
			"heading"		=> esc_html__( "Alternate Color", 'experience' ),
			"description"	=> esc_html__( "Select whether the post grid boxes should be made lighter or darker than the post grid background.", 'experience' ),
			"type"			=> "dropdown",
			'value'			=> array( 
				""									=> "",
				esc_html__( "Dark", 'experience' )	=> "color-alt-dark",
				esc_html__( "Light", 'experience' )	=> "color-alt-light",
			)
			
		),
		
		// Grid Width
		array(
			"param_name"	=> "grid_width",			
			"heading"		=> esc_html__( "Grid Width", 'experience' ),
			"description"	=> esc_html__( "Select the post grid width.", 'experience' ),
			"type"			=> "dropdown",
			"value"			=> array(
				esc_html__( "Full Width", 'experience' )	=> "",
				esc_html__( "Boxed", 'experience' )		=> "site-width",
				esc_html__( "Narrow", 'experience' )		=> "narrow-width"					
			)
		)
		
	));

}


/**
 *	Remove params from existing VC elements
 **/
function experience_remove_params_vc_elements() {

	// Row [vc_row]
	vc_remove_param( "vc_row", "gap" );
	vc_remove_param( "vc_row", "full_width" );
	
	// Row Inner [vc_row_inner]
	vc_remove_param( "vc_row_inner", "gap" );

	// Button [vc_btn]
	vc_remove_param( "vc_btn", "style" );
	vc_remove_param( "vc_btn", "shape" );	
	vc_remove_param( "vc_btn", "custom_background" );
	vc_remove_param( "vc_btn", "custom_text" );
	vc_remove_param( "vc_btn", "outline_custom_color" );
	vc_remove_param( "vc_btn", "outline_custom_hover_background" );
	vc_remove_param( "vc_btn", "outline_custom_hover_text" );
	vc_remove_param( "vc_btn", "gradient_color_1" );
	vc_remove_param( "vc_btn", "gradient_color_2" );
	vc_remove_param( "vc_btn", "gradient_custom_color_1" );
	vc_remove_param( "vc_btn", "gradient_custom_color_2" );
	vc_remove_param( "vc_btn", "gradient_text_color" );
	
	// FAQ [vc_toggle]
	vc_remove_param( "vc_toggle", "size" );
	vc_remove_param( "vc_toggle", "color" );
	vc_remove_param( "vc_toggle", "style" );
	
	// Image Gallery [vc_gallery]
	vc_remove_param( "vc_gallery", "title" );
	vc_remove_param( "vc_gallery", "type" );
	vc_remove_param( "vc_gallery", "interval" );
	vc_remove_param( "vc_gallery", "interval" );
	
	// Image Carousel[vc_images_carousel]
	vc_remove_param( "vc_images_carousel", "hide_prev_next_buttons" );
	
	// Accordion [vc_accordion]
	vc_remove_param( "vc_tta_accordion", "style" );
	vc_remove_param( "vc_tta_accordion", "shape" );
	vc_remove_param( "vc_tta_accordion", "color" );
	vc_remove_param( "vc_tta_accordion", "no_fill" );
	vc_remove_param( "vc_tta_accordion", "spacing" );
	vc_remove_param( "vc_tta_accordion", "c_icon" );
	vc_remove_param( "vc_tta_accordion", "c_position" );

}


/**
 *	Update existing Visual Composer element params
 **/
function experience_param_update_vc_elements() { }


/**
 *	Add custom templates to Visual Composer
 **/
 
function experience_custom_vc_templates() {
	
// Services Wide
$data = array();
$data['name'] = __( 'Experience: Services - Wide', 'experience' );
$data['content'] = <<<CONTENT
[vc_row content_placement="middle" padding_v="padding-v-none" padding_h="padding-h-none"][vc_column width="1/2" padding_v="padding-v" padding_h="padding-h" color="color-scheme-1" offset="vc_col-lg-4"][vc_column_text css=".vc_custom_1453300844376{margin-bottom: 28px !important;}"]<h2>Services</h2>Nunc id eros lectus. Suspendisse ac semper mauris. Nulla facilisi. Suspendisse quis lobortis ligula. Maecenas egestas est augue, et volutpat erat laoreet et. Nam tristique ante ut euismod blandit. Nam eget nisl ac felis tempor viverra.[/vc_column_text][/vc_column][vc_column width="1/2" padding_v="padding-v" padding_h="padding-h" color="color-scheme-2" offset="vc_col-lg-8"][vc_row_inner][vc_column_inner offset="vc_col-lg-4"][vc_icon icon_fontawesome="fa fa-star-o" color="custom" size="lg" custom_color="#503750" css=".vc_custom_1453300953475{margin-bottom: 4px !important;margin-left: -14px !important;}"][vc_column_text]<h3>Title</h3>Nullam pellentesque dapibus dui, vitae consequat metus tempor in. Vivamus malesuada egestas diam, nec dictum nisi suscipit vitae. Phasellus sit amet mauris et mi placerat suscipit id et justo.[/vc_column_text][/vc_column_inner][vc_column_inner offset="vc_col-lg-4"][vc_icon icon_fontawesome="fa fa-sliders" color="custom" size="lg" custom_color="#503750" css=".vc_custom_1453300960669{margin-bottom: 4px !important;margin-left: -14px !important;}"][vc_column_text]<h3>Title</h3>Nullam pellentesque dapibus dui, vitae consequat metus tempor in. Vivamus malesuada egestas diam, nec dictum nisi suscipit vitae. Phasellus sit amet mauris et mi placerat suscipit id et justo.[/vc_column_text][/vc_column_inner][vc_column_inner offset="vc_col-lg-4"][vc_icon icon_fontawesome="fa fa-globe" color="custom" size="lg" custom_color="#503750" css=".vc_custom_1453300966908{margin-bottom: 4px !important;margin-left: -14px !important;}"][vc_column_text]<h3>Title</h3>Nullam pellentesque dapibus dui, vitae consequat metus tempor in. Vivamus malesuada egestas diam, nec dictum nisi suscipit vitae. Phasellus sit amet mauris et mi placerat suscipit id et justo.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
vc_add_default_templates( $data );

// Services Grid
$data = array();
$data['name'] = __( 'Experience: Services - Grid', 'experience' );
$data['content'] = <<<CONTENT
[vc_row content_placement="middle" padding_v="padding-v-none" padding_h="padding-h-none"][vc_column width="1/3" padding_v="padding-v" padding_h="padding-h"][vc_icon color="black" size="xl" align="center"][vc_column_text]<h3 style="text-align: center;">Title</h3><p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>[/vc_column_text][/vc_column][vc_column width="1/3" padding_v="padding-v-none" padding_h="padding-h-none" color="color-scheme-2"][vc_empty_space height="500px"][/vc_column][vc_column width="1/3" padding_v="padding-v" padding_h="padding-h"][vc_icon color="black" size="xl" align="center"][vc_column_text]<h3 style="text-align: center;">Title</h3><p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>[/vc_column_text][/vc_column][/vc_row][vc_row content_placement="middle" padding_v="padding-v-none" padding_h="padding-h-none"][vc_column width="1/3" padding_v="padding-v-none" padding_h="padding-h-none" color="color-scheme-2"][vc_empty_space height="500px"][/vc_column][vc_column width="1/3" padding_v="padding-v" padding_h="padding-h" color="color-scheme-1"][vc_icon color="black" size="xl" align="center"][vc_column_text]<h3 style="text-align: center;">Title</h3><p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>[/vc_column_text][/vc_column][vc_column width="1/3" padding_v="padding-v-none" padding_h="padding-h-none" color="color-scheme-2"][vc_empty_space height="500px"][/vc_column][/vc_row][vc_row content_placement="middle" padding_v="padding-v-none" padding_h="padding-h-none"][vc_column width="1/3" padding_v="padding-v" padding_h="padding-h" color="color-scheme-1"][vc_icon color="black" size="xl" align="center"][vc_column_text]<h3 style="text-align: center;">Title</h3><p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>[/vc_column_text][/vc_column][vc_column width="1/3" padding_v="padding-v-none" padding_h="padding-h-none" color="color-scheme-2"][vc_empty_space height="500px"][/vc_column][vc_column width="1/3" padding_v="padding-v" padding_h="padding-h" color="color-scheme-1"][vc_icon color="black" size="xl" align="center"][vc_column_text]<h3 style="text-align: center;">Title</h3><p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
vc_add_default_templates( $data );

// About Agency
// About Agency Simple
// About Minimal

// Project Case Study
// Project Case Study 2

// Project 1 Column Gallery
$data = array();
$data['name'] = __( 'Experience: Project - 1 Column Gallery', 'experience' );
$data['content'] = <<<CONTENT
[vc_row width="narrow-width"][vc_column][vc_column_text]<h3>One Column Gallery</h3><p>Etiam est augue, mattis non ornare ut, lobortis vitae metus. Donec augue dolor, venenatis non luctus nec, viverra non lorem. Duis semper aliquam diam sed laoreet. In sed tortor felis. Etiam placerat lacinia ultricies. Nullam vulputate ipsum urna, sit amet dapibus metus dapibus in. Donec id turpis convallis, mattis metus eget, auctor neque. Vivamus id leo et ex sodales porta in eget ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed venenatis suscipit dolor, quis faucibus lacus iaculis sed.</p>[/vc_column_text][/vc_column][/vc_row][vc_row padding_v="padding-v no-padding-top"][vc_column][vc_gallery images="" img_size="full" onclick="link_no" columns="1"][/vc_column][/vc_row]
CONTENT;
vc_add_default_templates( $data );

// Project Split Gallery
$data = array();
$data['name'] = __( 'Experience: Project - Split Gallery', 'experience' );
$data['content'] = <<<CONTENT
[vc_row width="site-width"][vc_column width="2/3"][vc_gallery images="" img_size="large" onclick="link_no" columns="2"][/vc_column][vc_column width="1/3"][vc_column_text]<h3>Sidebar Gallery</h3>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
vc_add_default_templates( $data );

// Product Tech
// Product Fashion

// Parallax Story

// Contact Minimal
$data = array();
$data['name'] = __( 'Experience: Contact - Minimal', 'experience' );
$data['content'] = <<<CONTENT
[vc_row full_height="yes" content_placement="middle" width="narrow-width" color="color-scheme-3"][vc_column][vc_column_text css=".vc_custom_1453303434443{margin-bottom: 24px !important;}"]<h2 style="text-align: center;">Contact</h2>[/vc_column_text][vc_separator color="custom" el_width="10" css=".vc_custom_1453303423185{margin-bottom: 24px !important;}"][vc_column_text]<p style="text-align: center;">123 Wonder Ave,<br/>Manhatten,<br/>New York</p><p style="text-align: center;">Phone: +44 (0) 0000 0000Email: info@example.com</p>[/vc_column_text][vc_btn title="Say Hello!" align="center" link="url:%23||"][/vc_column][/vc_row]
CONTENT;
vc_add_default_templates( $data );

}














