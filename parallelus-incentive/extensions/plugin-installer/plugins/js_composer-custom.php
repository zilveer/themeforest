<?php
if (function_exists('vc_manager')) {
  //vc_set_as_theme(true);  //disables auto updater
  vc_manager()->disableUpdater(true);
}

#-----------------------------------------------------------------
# Visual Composer Specific Extras
#-----------------------------------------------------------------

// Custom Column Classes
// ...............................................................

function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
	if ($tag=='vc_row' || $tag=='vc_row_inner') {
		$class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
	}
	if($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_span(\d{1,2})/', 'span$1', $class_string);
	}
	return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);



# ---------------------------------------------------------------
# Modified or added options for Visual Composer default elements
# ---------------------------------------------------------------

function add_custom_theme_vc_params() {

	// Old element color structure
	// ...............................................................

		// Visual Composer color values
		$vc_colors = array(
				__("Grey", "js_composer") => "wpb_button", 
				__("Blue", "js_composer") => "btn-primary", 
				__("Turquoise", "js_composer") => "btn-info", 
				__("Green", "js_composer") => "btn-success",
				__("Orange", "js_composer") => "btn-warning", 
				__("Red", "js_composer") => "btn-danger", 
				__("Black", "js_composer") => "btn-inverse"
			);

		// Custom color values
		$theme_custom_colors = array(
			__("Theme Default", "framework") => "theme-default", 
			__("Theme Accent Color", "framework") => "accent-primary"
		);

		// Merged all colors
		$all_colors = array_merge( 
			(array) $theme_custom_colors,
			(array) $vc_colors
		);

	// Updated element color structure
	// ...............................................................

		// Visual Composer color values
		$vc_shared_colors = (function_exists('getVcShared')) ? getVcShared("colors") : array();

		// Custom color values
		$theme_custom_shared_colors = array(
			__("Theme Default", "framework") => "theme-default", 
			__("Theme Accent Color", "framework") => "accent-primary"
		);

		// Merged all colors
		$all_shared_colors = array_merge( 
			(array) $theme_custom_shared_colors,
			(array) $vc_shared_colors
		);


	// Apply updtes to default VC elements using add param function
	// ===============================================================
	
	if (function_exists('vc_add_param')) {

		// Add custom progress bar colors 
		// ===============================================================

		// Add parameters to 'vc_progress_bar'
		// ...............................................................
		$base = 'vc_progress_bar';
		$extraParams = array(
			array(
				"type" => "dropdown",
				"heading" => __("Bar color", "js_composer"),
				"param_name" => "bgcolor",
				"value" => array_merge( 
					array(__("Theme Accent Color", "js_composer") => "accent-primary"),
					(array) $vc_colors
				),
				"description" => __("Select bar background color.", "js_composer"),
				"admin_label" => true
			),
		);
		foreach ($extraParams as $params) {
			vc_add_param( $base, $params );
		}


		// Add custom button colors 
		// ===============================================================

		// Add parameters to 'vc_button' (Button)
		// ...............................................................
		$base = 'vc_button';
		$extraParams = array(
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => $all_colors,
				"description" => __("Button color.", "js_composer"),
				"param_holder_class" => 'vc-colored-dropdown'
			)
		);
		foreach ($extraParams as $params) {
			vc_add_param( $base, $params );
		}

		if(version_compare(WPB_VC_VERSION,  "4.3.5") > 0) {
			$base = 'vc_btn';
			$extraParams = array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'color',
					'description' => __( 'Select button color.', 'js_composer' ),
					// compatible with btn2, need to be converted from btn1
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value' => $theme_custom_shared_colors + array(
						           // Btn1 Colors
						           __( 'Classic Grey', 'js_composer' ) => 'default',
						           __( 'Classic Blue', 'js_composer' ) => 'primary',
						           __( 'Classic Turquoise', 'js_composer' ) => 'info',
						           __( 'Classic Green', 'js_composer' ) => 'success',
						           __( 'Classic Orange', 'js_composer' ) => 'warning',
						           __( 'Classic Red', 'js_composer' ) => 'danger',
						           __( 'Classic Black', 'js_composer' ) => "inverse"
						           // + Btn2 Colors (default color set)
					           ) + getVcShared( 'colors-dashed' ),
					'std' => 'grey',
					// must have default color grey
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array( 'custom' )
					),
				)
			);
			foreach ($extraParams as $params) {
				vc_add_param( $base, $params );
			}
		}

		if(version_compare(WPB_VC_VERSION,  "4.3.5") > 0) {
			$base = 'vc_cta';
			$extraParams = array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'color',
					'value' => $theme_custom_shared_colors +
							   array( __( 'Classic', 'js_composer' ) => 'classic' ) +
					           getVcShared( 'colors-dashed' ),
					'std' => 'classic',
					'description' => __( 'Select color schema.', 'js_composer' ),
					'param_holder_class' => 'vc_colored-dropdown vc_cta3-colored-dropdown',
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array( 'custom' )
					),
				),			
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'btn_color',
					'description' => __( 'Select button color.', 'js_composer' ),
					// compatible with btn2, need to be converted from btn1
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value' => $theme_custom_shared_colors + array(
						           // Btn1 Colors
						           __( 'Classic Grey', 'js_composer' ) => 'default',
						           __( 'Classic Blue', 'js_composer' ) => 'primary',
						           __( 'Classic Turquoise', 'js_composer' ) => 'info',
						           __( 'Classic Green', 'js_composer' ) => 'success',
						           __( 'Classic Orange', 'js_composer' ) => 'warning',
						           __( 'Classic Red', 'js_composer' ) => 'danger',
						           __( 'Classic Black', 'js_composer' ) => "inverse"
						           // + Btn2 Colors (default color set)
					           ) + getVcShared( 'colors-dashed' ),
					'std' => 'grey',
					// must have default color grey
					'dependency' => array(
						'element' => 'btn_style',
						'value_not_equal_to' => array( 'custom' )
					),
	            	'group' => 'Button',
	            	'integrated_shortcode' => 'vc_btn',
	            	'integrated_shortcode_field' => 'btn_'				
				)
			);
			foreach ($extraParams as $params) {
				vc_add_param( $base, $params );
			}
		}

		// Add parameters to 'vc_cta_button' (Call to Action)
		// ...............................................................
		$base = 'vc_cta_button'; 
		$extraParams = array(
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => $all_colors,
				"description" => __("Button color.", "js_composer"),
				"param_holder_class" => 'vc-colored-dropdown'
			)
		);
		foreach ($extraParams as $params) {
			vc_add_param( $base, $params );
		}

		if(version_compare(WPB_VC_VERSION,  "4.3.5") > 0) {
			vc_remove_param( "vc_row", "parallax" );
			vc_remove_param( "vc_row", "parallax_image" );
			vc_remove_param( "vc_row", "full_height" );
			vc_remove_param( "vc_row", "content_placement" );
			vc_remove_param( "vc_row", "video_bg" );
			vc_remove_param( "vc_row", "video_bg_url" );
			vc_remove_param( "vc_row", "video_bg_parallax" );
		}

		if(version_compare(WPB_VC_VERSION, '4.9') >= 0) {
			// Remove native columns gap parameters from 'vc_row'
			vc_remove_param( "vc_row", "gap" );
			// Remove native columns position parameters from 'vc_row'
			vc_remove_param( "vc_row", "columns_placement" );
			// Remove native equal height parameters from 'vc_row'
			vc_remove_param( "vc_row", "equal_height" );
		}

		if(version_compare(WPB_VC_VERSION, '4.10') >= 0) {
			// Remove video parallax speed from'vc_row'
			vc_remove_param( "vc_row", "parallax_speed_video" );
			// Remove background parallax speed from'vc_row'
			vc_remove_param( "vc_row", "parallax_speed_bg" );
		}

		// Add custom row options
		// ===============================================================

		// Add parameters to 'vc_row'
		$base = 'vc_row';
		$extraParams = array(
			array(
				"type" => "checkbox",
				"param_name" => "bg_parallax",
				"value" => array(
							__('Enable parallax effect', 'framework') => 'true'
						),
				"description" => __("Make the background image have a parallax scrolling effect.", "framework")
			),
			// Inertia
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Scroll Offset (inertia)", 'framework'),
				"param_name" => "inertia",
				"value" => array(
					1  => '0.1',
					2  => '0.2',
					3  => '0.3',
					4  => '0.4',
					5  => '0.5',
					6  => '0.6',
					7  => '0.7',
					8  => '0.8',
					9  => '0.9'
				),
				"description" => __("Specify the offset speed of the parallax effect. The lower the number the less the background moves relative to browser window.", 'framework')
			),
			array(
				"type" => "textfield",
				"admin_label" => true,
				"heading" => __("Google Maps Url", "framework"),
				"param_name" => "bg_maps",
				"description" => __("Instead of a background image, show a gorgeous full width google map. Parallax effect won't apply here.", "framework")
			),
			array(
				"type" => "textfield",
				"admin_label" => true,
				"heading" => __("Google Maps Height", "framework"),
				"param_name" => "bg_maps_height",
				"description" => __("Specify the height of the maps. (default 200px)", "framework")
			),
		);
		foreach ($extraParams as $params) {
			vc_add_param( $base, $params );
		}

		// Update 'vc_row' to include custom shortcode template and re-map shortcode
		//$sc = vc_map_update( 'vc_row', array('html_template' => locate_template('templates/vc_templates/vc_row.php')) );
		vc_map_update( 'vc_row' , array('html_template' => locate_template('templates/vc_templates/vc_row.php')) );
		$sc = vc_get_shortcode('vc_row');
		// Remove default vc_row shortcode
		vc_remove_element('vc_row');
		// Remap shortcode, identical to original, but with custom template path
		//vc_map($sc['vc_row']);
		vc_map($sc);

	}

}

add_action( 'wp_loaded', 'add_custom_theme_vc_params' );




# ---------------------------------------------------------------
# Custom Shortcodes Added to Visual Composer
# ---------------------------------------------------------------


// setup large separator shortcode
// ...............................................................

add_shortcode( 'large_separator', 'shortcode_large_separator' );
function shortcode_large_separator( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style'    => false
	), $atts ) );

	// Custom styles?
	$css = '';
	if ($style) {
		$css = 'style="'. $style .'"';
	}

	return '<div class="separator-large" '.$css.'></div>';
}
// Call WPBakery VC map function
if (function_exists('wpb_map')) {
	wpb_map( array(
		"name" => __("Separator (Large Divider)", 'framework'),
		"base" => "large_separator",
		"class"		=> "separator",
		"controls" => "edit_popup_delete", // not "full"
		"icon" => "icon-wpb-ui-separator",
		"show_settings_on_create" => false,
		"category" => __('Content', 'framework')
	) );
}


// Headline Block Shortcode
// ...............................................................

add_shortcode( 'headline_box', 'shortcode_headline_box' );
function shortcode_headline_box( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'text'    => 'Having <em>fun</em> yet?'
	), $atts ) );

	return '<div class="headline-box"><div class="separator-large"></div><h1 class="headline">'.$text.'</h1><div class="separator-large"></div></div>';
}
// Call WPBakery VC map function
if (function_exists('wpb_map')) {
	wpb_map( array(
		"name" => __("Headline Text Box", 'framework'),
		"base" => "headline_box",
		"class"		=> "",
		"controls" => "full", 
		"icon" => "icon-wpb-layer-shape-text",
		"category" => __('Content', 'framework'),
	   "params" => array(
	      array(
	         "type" => "textfield",
	         "holder" => "div",
	         // 'admin_label' => true,
	         "class" => "",
	         "heading" => __("Text", 'framework'),
	         "param_name" => "text",
	         "value" => __("Having <em>fun</em> yet?", 'framework'),
	         "description" => __("Enter the headline text. Use &lt;em&gt;emphasis&lt;/em&gt; to highlight words.", 'framework')
	      )
	   )
	) );
}


// Icon Box Shortcode
// ...............................................................

add_shortcode( 'icon_box', 'shortcode_icon_box' );
function shortcode_icon_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title' => false,
		'icon' => false,
		'custom' => false
    ), $atts));

	$class = 'iconBox';
	
	if ($icon || $custom) {
		$class .= ' icon';
		if ( $custom ) {
			// was the image provided as a media attachment ID?
			$src = (wp_get_attachment_url($custom)) ? wp_get_attachment_url($custom) : $custom;
			$image = '<img src="'.$src.'" alt="">';
			$icon = '<i class="custom-icon">'. $image .'</i>';			
		} else {
			$icon = str_replace('fa fa-', 'fa-', $icon);
			$icon = str_replace('icon-', 'fa-', $icon);
			$image = 'fa fa-'.str_replace('fa-','',strtolower($icon)); // remove "icon-" prefix (if there) then add it back (to be sure)		
			$icon = '<i class="'. $image .'"></i>';
		}
	}
	if ($title) $title = '<h2 class="iconBoxTitle">'.$title.'</h2>';

	$content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
	$box  = '<div class="'.$class.'">';
		$box .= $icon;
		$box .= '<div class="textContent">';
			$box .= $title;
			$box .= '<div class="theText">'.do_shortcode($content).'</div>';
		$box .= '</div>';
	$box .= '</div>';
		
   return $box;
}
// Call WPBakery VC map function
if (function_exists('wpb_map')) {
	wpb_map( array(
		"name" => __("Icon Box", 'framework'),
		"base" => "icon_box",
		"class"		=> "",
		"controls" => "full", 
		"icon" => "icon-wpb-information-white",
		"category" => __('Content', 'framework'),
	   "params" => array(
	      array(
	         "type" => "textfield",
	         "holder" => "div",
	         // 'admin_label' => true,
	         "class" => "",
	         "heading" => __("Title", 'framework'),
	         "param_name" => "title",
	         "value" => __("Your Title", 'framework'),
	         "description" => __("Enter the title to use for this box.", 'framework')
	      ),
	      array(
	         "type" => "textfield",
	         // "holder" => "div",
	         // 'admin_label' => true,
	         "class" => "",
	         "heading" => __("Icon", 'framework'),
	         "param_name" => "icon",
	         "value" => __("fa-plus", 'framework'),
	         "description" => __("Enter the icon file or class. This can be any <a href='http://fortawesome.github.com/Font-Awesome/#icons-web-app' target='_blank'>Font Awesome</a> icon class, for example 'fa-star' or 'fa-check'.")
	      ),
	      array(
	         "type" => "textarea_html",
	         // "holder" => "div",
	         // 'admin_label' => true,
	         "class" => "",
	         "heading" => __("Content", 'framework'),
	         "param_name" => "content",
	         "value" => __("This is the text block. Click edit to change this text.", 'framework'),
	         "description" => __("Enter your content or description.", 'framework')
	      )
	    )
	) );
}



// Blog, Portfolio and "Query" shortcodes mapped to VC
// ...............................................................

// Check if [blog] shortcode exists
// if ( array_key_exists('blog', $GLOBALS['shortcode_tags']) ) {

	// Map to WPBakery VC
	if (function_exists('wpb_map')) {
		// Item settings and options
		$settings = array(
			"name" => __("Post List", 'framework'),
			"base" => "blog",
			"class"		=> "",
			"wrapper_class" => "clearfix",
			// "controls" => "full", 
			"icon" => "icon-wpb-application-icon-large",
			"category" => __('Content', 'framework'),
			"params" => array(
				// Posts per page
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Posts per page", 'framework'),
					"param_name" => "posts_per_page",
					"value" => '',
					"description" => __("The number of items to show per page. (optional)<br>WP_Query parameter <code>posts_per_page</code>", 'framework')
				),
				// Post types
				array(
					"type" => "posttypes",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Post types", 'framework'),
					"param_name" => "post_type",
					"value" => "post",
					"description" => __("Blog lists can be created from any standard or custom post type. The default is 'post'.<br>WP_Query parameter <code>post_type</code>", 'framework')
				),
				// Template Select
				array(
					"type" => "dropdown",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Template", 'framework'),
					"param_name" => "template",
					"value" => array(
						__("Blog - Image Top", 'framework')   => 'blog-image-top',
						__("Blog - Image Left", 'framework') => 'blog-image-left',
						__("Grid - Rows", 'framework')   => 'grid-rows',
						__("Grid - Rows with Filtering", 'framework')  => 'grid-rows-filtered',
						__("Grid - Staggered", 'framework')   => 'grid-staggered',
						__("Grid - Staggered with Filtering", 'framework')   => 'grid-staggered-filtered',
					),
					"description" => __("Select a display style. Items can be displayed as blog posts or portfolio items.", 'framework')
				),
				// Grid Columns
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Grid Columns", 'framework'),
					"param_name" => "columns",
					"value" => '4',
					"description" => __("The number of columns in grid layouts. Only applies to Grid templates.", 'framework')
				),
				array(
					"type" => "checkbox",
					// "holder" => "div",
					"class" => "",
					// "heading" => __("Use Post Excerpts", 'framework'),
					"param_name" => "post_excerpts",
					"value" => array(
						__('Use Post Excerpts', 'framework') => 'true'
					),
					"description" => __('Use shortened content excerpts. If turned off the full post will display in post lists.','framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Excerpt length", 'framework'),
					"param_name" => "excerpt_length",
					"value" => '50',
					"description" => __("The number of words in post excerpts, 250 max. Custom excerpts are not restricted by this setting.", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Image width", 'framework'),
					"param_name" => "image_width",
					"value" => '',
					"description" => __("Specify a width for images in the post list view. Leave blank or set to '0' for auto. (optional)", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Image height", 'framework'),
					"param_name" => "image_height",
					"value" => '',
					"description" => __("Specify a height for images in the post list view. Leave blank or set to '0' for auto. (optional)", 'framework')
				),
				array(
					"type" => "checkbox",
					// "holder" => "div",
					"class" => "",
					// "heading" => __("Paging", 'framework'),
					"param_name" => "paging",
					"value" => array(
						__('Disable paging?', 'framework') => 'false'
					),
					"description" => __('Paging is enabled by default.','framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Categories", 'framework'),
					"param_name" => "category_name",
					"value" => '',
					"description" => __("A comma separated list of category names to restrict results within. e.g. tutorials,business,travel<br>WP_Query parameter <code>category_name</code>", 'framework')
				),

				array(
					"type" => "textfield",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Tags", 'framework'),
					"param_name" => "tag_slug__in",
					"value" => '',
					"description" => __("A comma separated list of tag names to restrict results within. e.g. bread,baking<br>WP_Query parameter <code>tag_slug__in</code>", 'framework')
				),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Order by", 'framework'),
					"param_name" => "orderby",
					"value" => array(
						'' => '',
						__("Date", 'framework')   => 'date',
						__("Author", 'framework') => 'author',
						__("Title", 'framework')  => 'title',
						__("Slug", 'framework')   => 'name',
						__("ID", 'framework')   => 'ID',
						__("Last modified", 'framework') => 'modified',
						__("Parent", 'framework')  => 'parent',
						__("Random", 'framework')   => 'rand',
						__("Comment count", 'framework')   => 'comment_count',
						__("Menu order", 'framework') => 'menu_order',
						__("Meta value", 'framework')  => 'meta_value',
						__("Meta value number", 'framework')   => 'meta_value_num',
						__("post__in parameter", 'framework')   => 'post__in'
					),
					"description" => __("Specify sorting method.<br>WP_Query parameter <code>orderby</code>", 'framework')
				),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Sort order", 'framework'),
					"param_name" => "order",
					"value" => array(
						'' => '',
						__("Descending (default)", 'framework')   => 'DESC',
						__("Ascending", 'framework')   => 'ASC'
					),
					"description" => __("Specify sorting order, ascending or descending.<br>WP_Query parameter <code>order</code>", 'framework')
				),

				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Taxonomy", 'framework'),
					"param_name" => "taxonomy_slug",
					"value" => '',
					"description" => __("The name of a custom taxonomy to query.<br>WP_Query parameter <code>tax_query->taxonomy</code>", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Taxonomy terms", 'framework'),
					"param_name" => "taxonomy_terms",
					"value" => '',
					"description" => __("A comma separated list of taxonomy terms, use with the taxonomy fields above.<br>WP_Query parameter <code>tax_query->terns</code>", 'framework')
				),
				array(
					"type" => "textarea",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Other Parameters", 'framework'),
					"param_name" => "string",
					"value" => __("", 'framework'),
					"description" => __("Additional <a href='http://codex.wordpress.org/Class_Reference/WP_Query' target='_blank'>WP_Query</a> parameters can be entered here. Use the format <code>parameter=value&amp;parameter_2=value2</code> You should not enter any blank spaces or quotes.", 'framework')
				)
			)
		);
		// Call mapping function
		wpb_map($settings);
	}
// }



// Portfolio shortcodes mapped to VC
// ...............................................................

// Check if [blog] shortcode exists
// if ( array_key_exists('portfolio', $GLOBALS['shortcode_tags']) ) {

	// Map to WPBakery VC
	if (function_exists('wpb_map')) {
		// Item settings and options
		$settings = array(
			"name" => __("Portfolio", 'framework'),
			"base" => "portfolio",
			"class"		=> "",
			"wrapper_class" => "clearfix",
			// "controls" => "full", 
			"icon" => "icon-wpb-application-icon-large",
			"category" => __('Content', 'framework'),
			"params" => array(
				// Posts per page
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Posts per page", 'framework'),
					"param_name" => "posts_per_page",
					"value" => '',
					"description" => __("The number of items to show per page. (optional)<br>WP_Query parameter <code>posts_per_page</code>", 'framework')
				),
				// Template Select
				array(
					"type" => "dropdown",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Template", 'framework'),
					"param_name" => "template",
					"value" => array(
						// __("Blog - Image Top", 'framework')   => 'blog-image-top',
						// __("Blog - Image Left", 'framework') => 'blog-image-left',
						__("Grid - Rows", 'framework')   => 'grid-rows',
						__("Grid - Rows with Filtering", 'framework')  => 'grid-rows-filtered',
						__("Grid - Staggered", 'framework')   => 'grid-staggered',
						__("Grid - Staggered with Filtering", 'framework')   => 'grid-staggered-filtered',
					),
					"description" => __("Select a display style. Items can be displayed as blog posts or portfolio items.", 'framework')
				),
				// Grid Columns
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Grid Columns", 'framework'),
					"param_name" => "columns",
					"value" => '4',
					"description" => __("The number of columns in grid layouts. Only applies to Grid templates.", 'framework')
				),
				array(
					"type" => "checkbox",
					// "holder" => "div",
					"class" => "",
					// "heading" => __("Use Post Excerpts", 'framework'),
					"param_name" => "post_excerpts",
					"value" => array(
						__('Use Excerpts', 'framework') => 'true'
					),
					"description" => __('Use shortened content excerpts. If turned off no excerpt will be displayed.','framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Excerpt length", 'framework'),
					"param_name" => "excerpt_length",
					"value" => '50',
					"description" => __("The number of words in post excerpts.", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Image width", 'framework'),
					"param_name" => "image_width",
					"value" => '',
					"description" => __("Specify a width for images portfolio grid. Leave blank or set to '0' for auto. (optional)", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Image height", 'framework'),
					"param_name" => "image_height",
					"value" => '',
					"description" => __("Specify a height for images portfolio grid. Leave blank or set to '0' for auto. (optional)", 'framework')
				),
				array(
					"type" => "checkbox",
					// "holder" => "div",
					"class" => "",
					// "heading" => __("Paging", 'framework'),
					"param_name" => "paging",
					"value" => array(
						__('Disable paging?', 'framework') => 'false'
					),
					"description" => __('Paging is enabled by default.','framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Categories", 'framework'),
					"param_name" => "category",
					"value" => '',
					"description" => __("A comma separated list of category names to restrict results within. e.g. tutorials,business,travel", 'framework')
				),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Order by", 'framework'),
					"param_name" => "orderby",
					"value" => array(
						'' => '',
						__("Date", 'framework')   => 'date',
						__("Author", 'framework') => 'author',
						__("Title", 'framework')  => 'title',
						__("Slug", 'framework')   => 'name',
						__("ID", 'framework')   => 'ID',
						__("Last modified", 'framework') => 'modified',
						__("Parent", 'framework')  => 'parent',
						__("Random", 'framework')   => 'rand',
						__("Comment count", 'framework')   => 'comment_count',
						__("Menu order", 'framework') => 'menu_order',
						__("Meta value", 'framework')  => 'meta_value',
						__("Meta value number", 'framework')   => 'meta_value_num',
						__("post__in parameter", 'framework')   => 'post__in'
					),
					"description" => __("Specify sorting method.<br>WP_Query parameter <code>orderby</code>", 'framework')
				),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Sort order", 'framework'),
					"param_name" => "order",
					"value" => array(
						'' => '',
						__("Descending (default)", 'framework')   => 'DESC',
						__("Ascending", 'framework')   => 'ASC'
					),
					"description" => __("Specify sorting order, ascending or descending.<br>WP_Query parameter <code>order</code>", 'framework')
				),
				array(
					"type" => "textarea",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Other Parameters", 'framework'),
					"param_name" => "string",
					"value" => __("", 'framework'),
					"description" => __("Additional <a href='http://codex.wordpress.org/Class_Reference/WP_Query' target='_blank'>WP_Query</a> parameters can be entered here. Use the format <code>parameter=value&amp;parameter_2=value2</code> You should not enter any blank spaces or quotes.", 'framework')
				)
			)
		);
		// Call mapping function
		wpb_map($settings);
	}
// }



// Content Rotator (carousel) shortcode mapped to VC
// ...............................................................

// Check if [blog] shortcode exists
// if ( array_key_exists('content_rotator', $GLOBALS['shortcode_tags']) ) {

	// Map to WPBakery VC
	if (function_exists('wpb_map')) {
		// Item settings and options
		$settings = array(
			"name" => __("Content Rotator", 'framework'),
			"base" => "content_rotator",
			"class"		=> "",
			"wrapper_class" => "clearfix",
			// "controls" => "full", 
			"icon" => "icon-wpb-application-icon-large",
			"category" => __('Content', 'framework'),
			"params" => array(
				// Title
				array(
					"type" => "textfield",
					// "holder" => "span",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Title", 'framework'),
					"param_name" => "title",
					"value" => '',
					"description" => __("An optional title element for the rotator.", 'framework')
				),
				// Columns
				array(
					"type" => "dropdown",
					// "holder" => "strong ",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Columns", 'framework'),
					"param_name" => "columns",
					"value" => array(
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4,
						5 => 5,
						6 => 6
					),
					// "description" => __("The number of columns.", 'framework')
				),
				// Transition
				array(
					"type" => "dropdown",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Transition", 'framework'),
					"param_name" => "transition",
					"value" => array(
						'' => '',
						'Slide' => 'slide',
						'Fade' => 'fade',
						'Flip' => 'flip'
					),
					"description" => __("You can choose a transition to be used for slide changing.", 'framework')
				),
				// Autoplay
				array(
					"type" => "checkbox",
					// "holder" => "div",
					// 'admin_label' => true,
					"class" => "",
					"heading" => __("Auto-play", 'framework'),
					"param_name" => "autoplay",
					"value" => array(
						__('Start transitions automatically?', 'framework') => 'true'
					),
					"description" => __('Enable auto-play and slides will transition at a specified interval.','framework')
				),
				// Interval
				array(
					"type" => "textfield",
					// "holder" => "span",
					"class" => "",
					// "heading" => __("Autoplay Interval", 'framework'),
					"param_name" => "interval",
					"value" => '',
					"description" => __("The interval time in milliseconds between slides when auto-play is enabled. e.g. 4000 for 4 seconds. 6000 for 6 seconds.", 'framework')
				),				
				// Post types
				array(
					"type" => "posttypes",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Post types", 'framework'),
					"param_name" => "post_type",
					"value" => "post",
					"description" => __("Select the post types to use as the content source.", 'framework')
				),
				array(
					"type" => "checkbox",
					// "holder" => "div",
					"class" => "",
					// "heading" => __("Use Post Excerpts", 'framework'),
					"param_name" => "hide_title",
					"value" => array(
						__('Hide Item Titles', 'framework') => 'true'
					),
					"description" => __('Hide item titles.','framework')
				),
				array(
					"type" => "checkbox",
					// "holder" => "div",
					"class" => "",
					// "heading" => __("Use Post Excerpts", 'framework'),
					"param_name" => "post_excerpts",
					"value" => array(
						__('Use Content Excerpts', 'framework') => 'true'
					),
					"description" => __('Show content excerpts. If turned off there will be no description text.','framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Excerpt length", 'framework'),
					"param_name" => "excerpt_length",
					"value" => '30',
					"description" => __("The number of words in post excerpts, 250 max. Custom excerpts are not restricted by this setting.", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Image size", 'framework'),
					"param_name" => "image_size",
					"value" => '',
					"description" => __("Specify the image size. Example: thumbnail, medium, full. You can also provide exact sizes in pixels: e.g. 200x100 (width x height).", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					'admin_label' => true,
					"class" => "",
					"heading" => __("Categories", 'framework'),
					"param_name" => "category_name",
					"value" => '',
					"description" => __("A comma separated list of category names to restrict results within. e.g. tutorials,business,travel<br>WP_Query parameter <code>category_name</code>", 'framework')
				),

				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Tags", 'framework'),
					"param_name" => "tag_slug__in",
					"value" => '',
					"description" => __("A comma separated list of tag names to restrict results within. e.g. bread,baking<br>WP_Query parameter <code>tag_slug__in</code>", 'framework')
				),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Order by", 'framework'),
					"param_name" => "orderby",
					"value" => array(
						'' => '',
						__("Date", 'framework')   => 'date',
						__("Author", 'framework') => 'author',
						__("Title", 'framework')  => 'title',
						__("Slug", 'framework')   => 'name',
						__("ID", 'framework')   => 'ID',
						__("Last modified", 'framework') => 'modified',
						__("Parent", 'framework')  => 'parent',
						__("Random", 'framework')   => 'rand',
						__("Comment count", 'framework')   => 'comment_count',
						__("Menu order", 'framework') => 'menu_order',
						__("Meta value", 'framework')  => 'meta_value',
						__("Meta value number", 'framework')   => 'meta_value_num',
						__("post__in parameter", 'framework')   => 'post__in'
					),
					"description" => __("Specify sorting method.<br>WP_Query parameter <code>orderby</code>", 'framework')
				),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Sort order", 'framework'),
					"param_name" => "order",
					"value" => array(
						'' => '',
						__("Descending (default)", 'framework')   => 'DESC',
						__("Ascending", 'framework')   => 'ASC'
					),
					"description" => __("Specify sorting order, ascending or descending.<br>WP_Query parameter <code>order</code>", 'framework')
				),

				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Taxonomy", 'framework'),
					"param_name" => "taxonomy_slug",
					"value" => '',
					"description" => __("The name of a custom taxonomy to query.<br>WP_Query parameter <code>tax_query->taxonomy</code>", 'framework')
				),
				array(
					"type" => "textfield",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Taxonomy terms", 'framework'),
					"param_name" => "taxonomy_terms",
					"value" => '',
					"description" => __("A comma separated list of taxonomy terms, use with the taxonomy fields above.<br>WP_Query parameter <code>tax_query->terns</code>", 'framework')
				),
				array(
					"type" => "textarea",
					// "holder" => "div",
					"class" => "",
					"heading" => __("Other Parameters", 'framework'),
					"param_name" => "string",
					"value" => __("", 'framework'),
					"description" => __("Additional <a href='http://codex.wordpress.org/Class_Reference/WP_Query' target='_blank'>WP_Query</a> parameters can be entered here. Use the format <code>parameter=value&amp;parameter_2=value2</code> You should not enter any blank spaces or quotes.", 'framework')
				)
			)
		);
		// Call mapping function
		wpb_map($settings);
	}

// }


?>