<?php
/**
 * Themeva shortcode includes
 *
 * @package Themeva
 *
 */
 
 /* ------------------------------------
:: VISUAL COMPOSER
------------------------------------ */
	
	if ( class_exists('WPBakeryVisualComposerAbstract') )
	{	
		// Remove Default VC Features
		if( of_get_option('display_vc_elements') != 'enable' && of_get_option('display_vc_elements') != '' )
		{		
			vc_remove_element( "vc_button" ); 	
			vc_remove_element( "vc_cta_button" ); 
			vc_remove_element( "vc_cta_button2" ); 
			vc_remove_element( "vc_images_carousel" ); 
			vc_remove_element( "vc_carousel" ); 
			vc_remove_element( "vc_message" );
			vc_remove_element( "vc_toggle" );
			vc_remove_element( "vc_twitter" );
			vc_remove_element( "vc_video" );
			vc_remove_element( "vc_single_image" );
			vc_remove_element( "vc_teaser_grid" );
			vc_remove_element( "vc_posts_slider" );
			vc_remove_element( "vc_flickr" );
		}
		
		// Update Columns / Row CSS
		update_option( 'wpb_js_row_css_class', 'row' );
		update_option( 'wpb_js_column_css_classes', '' );
		update_option( 'themeva_vc', 0 );		
 
 	
		/* ------------------------------------
		:: SHORTCODE OPTIONS FUNCTION
		------------------------------------*/
	
		function get_options_array( $type )
		{
			if( $type == 'transition' )
			{
				return $transition_effect = array("linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce");	
			}
	
			if( $type == 'animation' )
			{
				return $animation_types = array("fade","blindY","blindZ","blindX","cover","curtainX","curtainY","fadeZoom","growX","growY","none","scrollUp","scrollDown","scrollLeft","scrollRight","scrollHorz","scrollVert","shuffle","slideX","slideY","toss","turnUp","turnDown","turnLeft","turnRight","uncover","wipe","zoom");	
			}
	
			if( $type == 'datasource' )
			{
				$datasource = array(
					'Select Source' => "", 
					'Image Selector' => "data-1", 
					'Post Categories' => "data-2", 
					'Slide Sets' => "data-4", 
					'Portfolio Categories' => "data-6", 
					'Page / Post ID' => "data-8", 
				);	
				
				if( of_get_option('flickr_userid') !='' )
				{
					$datasource['Flickr Set'] = 'data-3';
				}
				
				if( class_exists('Woocommerce') || class_exists('WPSC_Query') )
				{
					$datasource['Product Categories'] = 'data-5';
				}
				
				return $datasource;
			}
			
			if( $type == 'imageeffect' )
			{
				return $image_effect = array(
					'None' => "", 
					'Shadow' => "shadow",
					'Reflection' => "reflection", 
					'Shadow + Reflection' => "shadowreflection", 
					'Frame' => "frame",
					'Black & White' => 'blackwhite',
					'Frame + Black & White' => 'frameblackwhite',
					'Shadow + Black & White' => 'shadowblackwhite',
				);	
			}
	
			if( $type == 'colors' )
			{
				return $colors = array(
					'grey-lite ' => "grey-lite", 
					'black' => "black", 
					'blue' => "blue", 
					'blue-lite' => "blue-lite", 
					'green-lite' => "green-lite", 
					'green' => "green", 
					'grey' => "grey",
					'orange-lite' => "orange-lite", 
					'orange' => "orange", 
					'blue' => "blue", 
					'pink-lite' => "pink-lite", 
					'pink' => "pink",
					'purple-lite' => "purple-lite", 
					'purple' => "purple", 		
					'red-lite' => "red-lite", 
					'red' => "red", 		
					'teal-lite' => "teal-lite", 
					'teal' => "teal", 		
					'transparent' => "transparent", 
					'white' => "white",
					'yellow-lite' => "yellow-lite", 
					'yellow' => "yellow", 																																											
	
				);	
			}		
		}
		
	
		/* ------------------------------------
		:: SHORTCODE GALLERY OPTIONS FUNCTION
		------------------------------------*/	
		
		function get_common_options( $type, $object = '', $option = null )
		{	
			$extras = '';
			
			if( $type == 'datasource' )
			{
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Data Source", "js_composer"),
					"param_name" => "data_source",
					"value" => get_options_array( 'datasource' )
				);
			}
			elseif( $type == 'data-1' )
			{
				$option = array(
					"type" => "attach_images",
					"heading" => __("Images", "js_composer"),
					"param_name" => "attached_id",
					"value" => "",
					"description" => __("Select images from media library.", "js_composer"),
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-1'))
      			);
			}
			elseif( $type == 'data-2' )
			{
				$option = array(
					"type" => "checkbox",
					"class" => "",
					"heading" => __("Categories", "js_composer"),
					"param_name" => "categories",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2')),
					"value" => get_data_source( 'data-2', 'shortcode' )
				);
			}		
			elseif( $type == 'data-2-formats' )
			{
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Filter by Post", "js_composer"),
					"param_name" => "post_format",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2')),
					"value" => get_data_source( 'data-2-formats', 'shortcode' )
				);
			}
			elseif( $type == 'data-8' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Page / Post ID", "js_composer"),
					"param_name" => "pagepost_id",
					"value" => "",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-8')),
					"description" => __("Comma separate multiple ID's.", "js_composer")
				);
			}			
			elseif( $type == 'orderby' )
			{
				if( $object == 'recentposts' )
				{
					$option = array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Order Post By", "js_composer"),
						"param_name" => "orderby",
						"value" => array(
							'Ascending' => 'ASC',
							'Descending' => 'DESC'
						)
					);				
					
				}
				else
				{
					$option = array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Order Post By", "js_composer"),
						"param_name" => "orderby",
						"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2','data-8','data-6')),
						"value" => array(
							'Ascending' => 'ASC',
							'Descending' => 'DESC'
						)
					);				
				}
	
			}
			elseif( $type == 'sortby' || $type == 'order' )
			{
				if( $object == 'recentposts' )
				{
					$option = array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Sort Post By", "js_composer"),
						"param_name" => $type,
						"value" => array(
							'Post Order' => '',
							'Date' => 'date',
							'Random' => 'rand',
							'Title' => 'title',
						)
					);				
				}
				else
				{
					$option = array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Sort Post By", "js_composer"),
						"param_name" => $type,
						"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2','data-8','data-6')),
						"value" => array(
							'Post Order' => '',
							'Date' => 'date',
							'Random' => 'rand',
							'Title' => 'title',
						)
					);
				}
			}
			elseif( $type == 'excerpt' )
			{
				if( $object == 'recentposts' )
				{
					$option = array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Excerpt", "js_composer"),
						"param_name" => "excerpt",
						"value" => "",
						"description" => __("Default is 55 words.", "js_composer")
					);				
					
				}
				else
				{
					$option = array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Excerpt", "js_composer"),
						"param_name" => "excerpt",
						"value" => "",
						"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2','data-6','data-5','data-8')),
						"description" => __("Default is 55 words.", "js_composer")
					);				
				}
	
			}					
			elseif( $type == 'data-3' )
			{
				if( of_get_option('flickr_userid') !='' )
				{
					$option = array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Flickr Set", "js_composer"),
						"param_name" => "flickr_set",
						"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-3')),
						"value" => get_data_source( 'data-3', 'shortcode' )
					);
				}
				else
				{
					$option = array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Flickr Set", "js_composer"),
						"param_name" => "flickr_set",
						"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-3')),
						"value" => 'No username entered'
					);				
				}
			}
			elseif( $type == 'data-4' )
			{
				$option = array(
					"type" => "checkbox",
					"class" => "",
					"heading" => __("Slide Sets", "js_composer"),
					"param_name" => "slidesetid",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-4')),
					"value" => get_data_source( 'data-4', 'shortcode' )
				);
			}	
			elseif( $type == 'data-5' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Product Categories", "js_composer"),
					"param_name" => "product_categories",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-5')),
					"description" => __("Comma separate category names.", "js_composer"),
					"value" => "",
				);
			}
			elseif( $type == 'data-5-tags' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Product Tags", "js_composer"),
					"param_name" => "product_tags",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-5')),
					"description" => __("Comma separate tag names.", "js_composer"),
					"value" => "",
				);
			}		
			elseif( $type == 'data-6' )
			{
				$option = array(
					"type" => "checkbox",
					"class" => "",
					"heading" => __("Portfolio Categories", "js_composer"),
					"param_name" => "portfolio_categories",
					"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-6')),
					"value" => get_data_source( 'data-6', 'shortcode' )
				);
			}	
			elseif( $type == 'width' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Gallery Width", "js_composer"),
					"param_name" => "width",
					"value" => "",
				);
			}
			elseif( $type == 'height' )
			{
				if( $object == 'grid' )
				{
					$text = "Row Height";	
				}
				else
				{
					$text = "Gallery Height";	
				}
				
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => $text,
					"param_name" => "height",
					"value" => "",
				);
			}
			elseif( $type == 'columns' )
			{
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Columns", "js_composer"),
					"param_name" => "columns",
					"value" => array(
						'3 Columns' => '',
						'1 Columns' => '1',
						'2 Columns' => '2',
						'4 Columns' => '4',
						'5 Columns' => '5',
						'6 Columns' => '6',
						'7 Columns' => '7',
						'8 Columns' => '8',
						'9 Columns' => '9',
						'10 Columns' => '10',
						'11 Columns' => '11',
						'12 Columns' => '12',
					)
				);
			}
			elseif( $type == 'columnpadding' )
			{
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Column Padding", "js_composer"),
					"param_name" => "columnpadding",
					"value" => array(
						'Enable' => '',
						'Disable' => 'disable_padding'
					)
				);
			}				
			elseif( $type == 'content' )
			{	
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "content_type",
					"value" => array(
						'Image + Text' => 'textimage',
						'Image + Title' => 'titleimage',
						'Image' => 'image',
						'Text' => 'text',
						'Image + Title Overlay' => 'titleoverlay',
						'Image + Title / Text Overlay' => 'titletextoverlay',
					)
				);
	
				if( $object == 'recent_posts' )
				{
					$option['value']['Title'] = 'title';
				}
				
			}		
			elseif( $type == 'align' )
			{
	
				if( $object !='' )
				{
					$text = $object;	
				}
				
				
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => sprintf( __('%s Align', "js_composer" ), $text ),
					"param_name" => "align",
					"value" => array(
						__('Normal', "js_composer" ) => '',
						__('Left', "js_composer" ) => 'alignleft',
						__('Center', "js_composer" ) => 'aligncenter',
						__('Right', "js_composer" ) => 'alignright'
					)
				);
			}			
			elseif( $type == 'imgwidth' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Image Width", "js_composer"),
					"param_name" => "imgwidth",
					"value" => "",
				);
			}	
			elseif( $type == 'imgheight' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Image Height", "js_composer"),
					"param_name" => "imgheight",
					"value" => "",
				);
			}
			elseif( $type == 'imageeffect' )
			{
				$option = array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Image Effect", "js_composer"),
					"param_name" => "imageeffect",
					"value" => get_options_array( 'imageeffect' )
				);
			}
			elseif( $type == 'timeout' )
			{
				$option = array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Timeout", "js_composer"),
					"param_name" => "timeout",
					"value" => "",
					"description" => __("Time between animating slides, in seconds.", "js_composer")
				);
			}												
			
			if( empty( $option ) )
			{
				$option = array(
					"type" => NULL,
					"param_name" => NULL,
					"value" => NULL
				);
			}
			
			return $option;
		}

		$add_css_animation = array(
			"type" => "dropdown",
			"heading" => __("CSS Animation", "js_composer"),
			"param_name" => "css_animation",
			"admin_label" => true,
			"value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
			"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
		);		
	
		/* ------------------------------------
		:: CHECKBOX PARAM
		------------------------------------*/
	
		function checkbox_settings_field( $settings, $value ='' )
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			
			$param_line = '<input class="wpb_vc_param_value wpb-checkboxes" type="hidden" value="" name="" ' . $dependency . '/>';
	
			foreach ( $settings['options'] as $text_val => $val )
			{		
				$checked = "";
					
				if ( in_array($val, explode(",", $value)) ) $checked = ' checked="checked"';            
							
				$param_line .= ' <input id="'. $settings['param_name'] . '-' . $val .'" value="' . $val . '" class="'.$settings['param_name'].' '.$settings['type'].'" type="checkbox" name="'.$settings['param_name'].'"'. $checked .'' . $dependency . '> ' . $text_val;
			}
				
			return $param_line;
		}
		
		
		add_shortcode_param('checkbox', 'checkbox_settings_field');	
	
		$shortcodes_dir = NV_FILES . '/inc/shortcodes/';
	
		/* ------------------------------------
		:: SHORTCODES + MAPS
		------------------------------------*/
	
		require_once( $shortcodes_dir . 'grid-gallery.php' );
		require_once( $shortcodes_dir . 'group-slider.php' );
		require_once( $shortcodes_dir . 'stage-slider.php' );
		require_once( $shortcodes_dir . 'accordion-slider.php' );
		require_once( $shortcodes_dir . 'buttons.php' );
		require_once( $shortcodes_dir . 'block-quote.php' );
		require_once( $shortcodes_dir . 'dividers.php' );
		require_once( $shortcodes_dir . 'font-icons.php' );
		require_once( $shortcodes_dir . 'styled-boxes.php' );
		require_once( $shortcodes_dir . 'highlight.php' );
		require_once( $shortcodes_dir . 'image-effects.php' );
		require_once( $shortcodes_dir . 'media-types.php' );
		require_once( $shortcodes_dir . 'columns.php' );
		require_once( $shortcodes_dir . 'tabs.php' );
		require_once( $shortcodes_dir . 'accordion.php' );
		require_once( $shortcodes_dir . 'lists.php' );
		require_once( $shortcodes_dir . 'toggle.php' );
		require_once( $shortcodes_dir . 'drop-caps.php' );
		require_once( $shortcodes_dir . 'social-icons.php' );
		require_once( $shortcodes_dir . 'enquiry-form.php' );
		require_once( $shortcodes_dir . 'pricing-table.php' );
		require_once( $shortcodes_dir . 'tooltip.php' );
		require_once( $shortcodes_dir . 'content-animator.php' );
		require_once( $shortcodes_dir . 'recent-posts.php' );
		require_once( $shortcodes_dir . 'clear.php' );
	
		add_filter('widget_text', 'do_shortcode');


		// VC Row
		/*vc_map( array(
		  "name" => __("Row", "js_composer"),
		  "base" => "vc_row",
		  "is_container" => true,
		  "icon" => "icon-wpb-row",
		  "show_settings_on_create" => false,
		  "category" => __('Content', 'js_composer'),
		  "params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Add Background", "js_composer"),
				"param_name" => "custom_background",
				"description" => "Add an image or color to the Row background",
				"value" => array(
					'Disabled' => '',
					'Custom Background' => 'custom',
				)
			),		
			array(
				"type" => "attach_image",
				"heading" => __("Background Image", "js_composer"),
				"param_name" => "bg_image",
				"value" => "",
				"description" => "",
				"dependency" => Array('element' => 'custom_background', 'value' => array('custom')),
			),			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Wide Row", "js_composer"),
				"param_name" => "wide_row",
				"description" => "Make the Background Color / Image full width.",
				"value" => array(
					'Enable' => 'yes',
				),
				"dependency" => Array('element' => 'custom_background', 'value' => array('custom')),
			),	
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Parallax", "js_composer"),
				"param_name" => "parallax",
				"description" => "Add Parallax effect to background image.",
				"value" => array(
					'Enable' => 'yes',
				),
				"dependency" => Array('element' => 'custom_background', 'value' => array('custom')),
			),			 
			array(
				"type" => "colorpicker",
				"heading" => __("Background Color", "js_composer"),
				"param_name" => "bg_color",
				"value" => "",
				"dependency" => Array('element' => 'custom_background' , 'value' => array('custom')),
			),				 
			array(
			  "type" => "colorpicker",
			  "heading" => __('Font Color', 'wpb'),
			  "param_name" => "font_color",
			  "description" => __("", "wpb")
			),
			array(
			  "type" => "textfield",
			  "heading" => __('Padding', 'wpb'),
			  "param_name" => "padding",
			  "description" => __("You can use px, em, %, etc. or enter just number and it will use pixels. ", "wpb")
			),
			array(
			  "type" => "textfield",
			  "heading" => __('Bottom margin', 'wpb'),
			  "param_name" => "margin_bottom",
			  "description" => __("You can use px, em, %, etc. or enter just number and it will use pixels. ", "wpb")
			),
			array(
			  "type" => "textfield",
			  "heading" => __("Extra class name", "js_composer"),
			  "param_name" => "el_class",
			  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),						
		  ),		  
		  "js_view" => 'VcRowView'
		) );		*/
		

		// VC Row
		vc_map( array(
		  "name" => __("Row", "js_composer"),
		  "base" => "vc_row",
		  "is_container" => true,
		  "icon" => "icon-wpb-row",
		  "show_settings_on_create" => false,
		  "category" => __('Content', 'js_composer'),
		  "params" => array(	
			array(
				'type' => 'dropdown',
				'heading' => __( 'Row stretch', 'js_composer' ),
				'param_name' => 'full_width',
				'value' => array(
					__( 'Default', 'js_composer' ) => '',
					__( 'Stretch row', 'js_composer' ) => 'stretch_row',
					__( 'Stretch row and content', 'js_composer' ) => 'stretch_row_content',
					__( 'Stretch row and content (no paddings)', 'js_composer' ) => 'stretch_row_content_no_spaces',
				),
				'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'js_composer' )
			),			  		  
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Set Full Height", "js_composer"),
				"param_name" => "full_height_row",
				"description" => "Set the row height to that of the browser window. Works best with Image backgrounds.",
				"value" => array(
					'Enable' => 'enable',
				),
			),	
			array(
				'type' => 'dropdown',
				'heading' => __( 'Content position', 'js_composer' ),
				'param_name' => 'content_placement',
				'value' => array(
					__( 'Middle', 'js_composer' ) => 'middle',
					__( 'Top', 'js_composer' ) => 'top',
				),
				'description' => __( 'Select content position within row.', 'js_composer' ),
				'dependency' => array(
					'element' => 'full_height',
					'not_empty' => true,
				),
			),		
			array(
			  "type" => "textfield",
			  "heading" => __("Anchor Link Name", "js_composer"),
			  "param_name" => "anchor_link",
			  "description" => __("Use this field to add an Anchor Name. You can then use links to scroll to this row, including from the menu.", "js_composer")
			),					  			  
			array(
			  "type" => "colorpicker",
			  "heading" => __('Font Color', 'wpb'),
			  "param_name" => "font_color",
			  "description" => __("", "wpb")
			),		  
			array(
				'type' => 'el_id',
				'heading' => __( 'Row ID', 'js_composer' ),
				'param_name' => 'el_id',
				'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),			
			array(
			  "type" => "textfield",
			  "heading" => __("Extra class name", "js_composer"),
			  "param_name" => "el_class",
			  "description" => __("<p>Use this field to add a class name and then refer to it in your css file.<br />Some useful pre-defined classes:</p><strong>no-margin-top</strong> ( This removes the top space above the row. )<br /><strong>no-margin-bottom</strong> ( This removes the bottom space below the row. )", "js_composer")
			),	
			array(
			  "type" => "css_editor",
			  "heading" => __('Css', "js_composer"),
			  "param_name" => "css",
			  // "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
			  "group" => __('Design options', 'js_composer')
			),					
			array(
				'type' => 'checkbox',
				'heading' => __( 'Use video background?', 'js_composer' ),
				'param_name' => 'video_bg',
				'description' => __( 'If checked, video will be used as row background.', 'js_composer' ),
				'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
				"group" => __('Background Extras', 'js_composer')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'YouTube link', 'js_composer' ),
				'param_name' => 'video_bg_url',
				'description' => __( 'Add YouTube link.', 'js_composer' ),
				'dependency' => array(
					'element' => 'video_bg',
					'not_empty' => true,
				),
				"group" => __('Background Extras', 'js_composer')
			),				  	
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Parallax", "js_composer"),
				"param_name" => "parallax",
				"description" => "Add Parallax effect to <strong>Background Image</strong>.",
				"value" => array(
					'Disabled' => '',
					'Normal' => 'yes',
					'With Fade' => 'content-moving-fade',
				),
				"group" => __('Background Extras', 'js_composer')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Shaded Wide Row", "js_composer"),
				"param_name" => "wide_row",
				"description" => "Make the Background Color / Image full width.",
				"value" => array(
					'Enable' => 'yes',
				),
				"group" => __('Background Extras', 'js_composer')
			),																							 											
		  ),	
		  	  
		  "js_view" => 'VcRowView'
		) );				
	
	}