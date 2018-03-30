<?php

// Check if shortcodes settings are now used
if ( !function_exists( 'ancora_shortcodes_is_used' ) ) {
	function ancora_shortcodes_is_used() {
		return ancora_options_is_used() 															// All modes when Theme Options are used
			|| (is_admin() && isset($_POST['action']) 
					&& in_array($_POST['action'], array('vc_edit_form', 'wpb_show_edit_form')))		// AJAX query when save post/page
			|| ancora_vc_is_frontend();															// VC Frontend editor mode
	}
}

// Width and height params
if ( !function_exists( 'ancora_shortcodes_width' ) ) {
	function ancora_shortcodes_width($w="") {
		return array(
			"title" => __("Width", "ancora"),
			"divider" => true,
			"value" => $w,
			"type" => "text"
		);
	}
}
if ( !function_exists( 'ancora_shortcodes_height' ) ) {
	function ancora_shortcodes_height($h='') {
		return array(
			"title" => __("Height", "ancora"),
			"desc" => __("Width (in pixels or percent) and height (only in pixels) of element", "ancora"),
			"value" => $h,
			"type" => "text"
		);
	}
}

/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'ancora_shortcodes_settings_theme_setup' ) ) {
//	if ( ancora_vc_is_frontend() )
	if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline') )
		add_action( 'ancora_action_before_init_theme', 'ancora_shortcodes_settings_theme_setup', 20 );
	else
		add_action( 'ancora_action_after_init_theme', 'ancora_shortcodes_settings_theme_setup' );
	function ancora_shortcodes_settings_theme_setup() {
		if (ancora_shortcodes_is_used()) {
			global $ANCORA_GLOBALS;

			// Prepare arrays 
			$ANCORA_GLOBALS['sc_params'] = array(
			
				// Current element id
				'id' => array(
					"title" => __("Element ID", "ancora"),
					"desc" => __("ID for current element", "ancora"),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				// Current element class
				'class' => array(
					"title" => __("Element CSS class", "ancora"),
					"desc" => __("CSS class for current element (optional)", "ancora"),
					"value" => "",
					"type" => "text"
				),
			
				// Current element style
				'css' => array(
					"title" => __("CSS styles", "ancora"),
					"desc" => __("Any additional CSS rules (if need)", "ancora"),
					"value" => "",
					"type" => "text"
				),
			
				// Margins params
				'top' => array(
					"title" => __("Top margin", "ancora"),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				'bottom' => array(
					"title" => __("Bottom margin", "ancora"),
					"value" => "",
					"type" => "text"
				),
			
				'left' => array(
					"title" => __("Left margin", "ancora"),
					"value" => "",
					"type" => "text"
				),
			
				'right' => array(
					"title" => __("Right margin", "ancora"),
					"desc" => __("Margins around list (in pixels).", "ancora"),
					"value" => "",
					"type" => "text"
				),
			
				// Switcher choises
				'list_styles' => array(
					'ul'	=> __('Unordered', 'ancora'),
					'ol'	=> __('Ordered', 'ancora'),
					'iconed'=> __('Iconed', 'ancora')
				),
				'yes_no'	=> ancora_get_list_yesno(),
				'on_off'	=> ancora_get_list_onoff(),
				'dir' 		=> ancora_get_list_directions(),
				'align'		=> ancora_get_list_alignments(),
				'float'		=> ancora_get_list_floats(),
				'show_hide'	=> ancora_get_list_showhide(),
				'sorting' 	=> ancora_get_list_sortings(),
				'ordering' 	=> ancora_get_list_orderings(),
				'sliders'	=> ancora_get_list_sliders(),
				'users'		=> ancora_get_list_users(),
				'members'	=> ancora_get_list_posts(false, array('post_type'=>'team', 'orderby'=>'title', 'order'=>'asc', 'return'=>'title')),
				'categories'=> ancora_get_list_categories(),
				'testimonials_groups'=> ancora_get_list_terms(false, 'testimonial_group'),
				'team_groups'=> ancora_get_list_terms(false, 'team_group'),
				'columns'	=> ancora_get_list_columns(),
				'images'	=> array_merge(array('none'=>"none"), ancora_get_list_files("images/icons", "png")),
				'icons'		=> array_merge(array("inherit", "none"), ancora_get_list_icons()),
				'locations'	=> ancora_get_list_dedicated_locations(),
				'filters'	=> ancora_get_list_portfolio_filters(),
				'formats'	=> ancora_get_list_post_formats_filters(),
				'hovers'	=> ancora_get_list_hovers(),
				'hovers_dir'=> ancora_get_list_hovers_directions(),
				'tint'		=> ancora_get_list_bg_tints(),
				'animations'=> ancora_get_list_animations_in(),
				'blogger_styles'	=> ancora_get_list_templates_blogger(),
				'posts_types'		=> ancora_get_list_posts_types(),
				'button_styles'		=> ancora_get_list_button_styles(),
				'googlemap_styles'	=> ancora_get_list_googlemap_styles(),
				'field_types'		=> ancora_get_list_field_types(),
				'label_positions'	=> ancora_get_list_label_positions()
			);

			$ANCORA_GLOBALS['sc_params']['animation'] = array(
				"title" => __("Animation",  'ancora'),
				"desc" => __('Select animation while object enter in the visible area of page',  'ancora'),
				"value" => "none",
				"type" => "select",
				"options" => $ANCORA_GLOBALS['sc_params']['animations']
			);
	
			// Shortcodes list
			//------------------------------------------------------------------
			$ANCORA_GLOBALS['shortcodes'] = array(
			
				// Accordion
				"trx_accordion" => array(
					"title" => __("Accordion", "ancora"),
					"desc" => __("Accordion items", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Accordion style", "ancora"),
							"desc" => __("Select style for display accordion", "ancora"),
							"value" => 1,
							"options" => array(
								1 => __('Style 1', 'ancora'),
								2 => __('Style 2', 'ancora')
							),
							"type" => "radio"
						),
						"counter" => array(
							"title" => __("Counter", "ancora"),
							"desc" => __("Display counter before each accordion title", "ancora"),
							"value" => "off",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['on_off']
						),
						"initial" => array(
							"title" => __("Initially opened item", "ancora"),
							"desc" => __("Number of initially opened item", "ancora"),
							"value" => 1,
							"min" => 0,
							"type" => "spinner"
						),
						"icon_closed" => array(
							"title" => __("Icon while closed",  'ancora'),
							"desc" => __('Select icon for the closed accordion item from Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"icon_opened" => array(
							"title" => __("Icon while opened",  'ancora'),
							"desc" => __('Select icon for the opened accordion item from Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_accordion_item",
						"title" => __("Item", "ancora"),
						"desc" => __("Accordion item", "ancora"),
						"container" => true,
						"params" => array(
							"title" => array(
								"title" => __("Accordion item title", "ancora"),
								"desc" => __("Title for current accordion item", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"icon_closed" => array(
								"title" => __("Icon while closed",  'ancora'),
								"desc" => __('Select icon for the closed accordion item from Fontello icons set',  'ancora'),
								"value" => "",
								"type" => "icons",
								"options" => $ANCORA_GLOBALS['sc_params']['icons']
							),
							"icon_opened" => array(
								"title" => __("Icon while opened",  'ancora'),
								"desc" => __('Select icon for the opened accordion item from Fontello icons set',  'ancora'),
								"value" => "",
								"type" => "icons",
								"options" => $ANCORA_GLOBALS['sc_params']['icons']
							),
							"_content_" => array(
								"title" => __("Accordion item content", "ancora"),
								"desc" => __("Current accordion item content", "ancora"),
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Anchor
				"trx_anchor" => array(
					"title" => __("Anchor", "ancora"),
					"desc" => __("Insert anchor for the TOC (table of content)", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"icon" => array(
							"title" => __("Anchor's icon",  'ancora'),
							"desc" => __('Select icon for the anchor from Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"title" => array(
							"title" => __("Short title", "ancora"),
							"desc" => __("Short title of the anchor (for the table of content)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => __("Long description", "ancora"),
							"desc" => __("Description for the popup (then hover on the icon). You can use '{' and '}' - make the text italic, '|' - insert line break", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"url" => array(
							"title" => __("External URL", "ancora"),
							"desc" => __("External URL for this TOC item", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"separator" => array(
							"title" => __("Add separator", "ancora"),
							"desc" => __("Add separator under item in the TOC", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"id" => $ANCORA_GLOBALS['sc_params']['id']
					)
				),
			
			
				// Audio
				"trx_audio" => array(
					"title" => __("Audio", "ancora"),
					"desc" => __("Insert audio player", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"url" => array(
							"title" => __("URL for audio file", "ancora"),
							"desc" => __("URL for audio file", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media",
							"before" => array(
								'title' => __('Choose audio', 'ancora'),
								'action' => 'media_upload',
								'type' => 'audio',
								'multiple' => false,
								'linked_field' => '',
								'captions' => array( 	
									'choose' => __('Choose audio file', 'ancora'),
									'update' => __('Select audio file', 'ancora')
								)
							),
							"after" => array(
								'icon' => 'icon-cancel',
								'action' => 'media_reset'
							)
						),
                        "style" => array(
                            "title" => __("Style", "ancora"),
                            "desc" => __("Select style", "ancora"),
                            "value" => "none",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => array('audio_normal' => 'Normal', 'audio_dark' => 'Dark'),
                        ),
						"image" => array(
							"title" => __("Cover image", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for audio cover", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"title" => array(
							"title" => __("Title", "ancora"),
							"desc" => __("Title of the audio file", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"author" => array(
							"title" => __("Author", "ancora"),
							"desc" => __("Author of the audio file", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"controls" => array(
							"title" => __("Show controls", "ancora"),
							"desc" => __("Show controls in audio player", "ancora"),
							"divider" => true,
							"size" => "medium",
							"value" => "show",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['show_hide']
						),
						"autoplay" => array(
							"title" => __("Autoplay audio", "ancora"),
							"desc" => __("Autoplay audio on page load", "ancora"),
							"value" => "off",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['on_off']
						),
						"align" => array(
							"title" => __("Align", "ancora"),
							"desc" => __("Select block alignment", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Block
				"trx_block" => array(
					"title" => __("Block container", "ancora"),
					"desc" => __("Container for any block ([section] analog - to enable nesting)", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"dedicated" => array(
							"title" => __("Dedicated", "ancora"),
							"desc" => __("Use this block as dedicated content - show it before post title on single page", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"align" => array(
							"title" => __("Align", "ancora"),
							"desc" => __("Select block alignment", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"columns" => array(
							"title" => __("Columns emulation", "ancora"),
							"desc" => __("Select width for columns emulation", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['columns']
						), 
						"pan" => array(
							"title" => __("Use pan effect", "ancora"),
							"desc" => __("Use pan effect to show section content", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"scroll" => array(
							"title" => __("Use scroller", "ancora"),
							"desc" => __("Use scroller to show section content", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"scroll_dir" => array(
							"title" => __("Scroll direction", "ancora"),
							"desc" => __("Scroll direction (if Use scroller = yes)", "ancora"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "horizontal",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['dir']
						),
						"scroll_controls" => array(
							"title" => __("Scroll controls", "ancora"),
							"desc" => __("Show scroll controls (if Use scroller = yes)", "ancora"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"color" => array(
							"title" => __("Fore color", "ancora"),
							"desc" => __("Any color for objects in this section", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_tint" => array(
							"title" => __("Background tint", "ancora"),
							"desc" => __("Main background tint: dark or light", "ancora"),
							"value" => "",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Any background color for this section", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for the background", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "ancora"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "ancora"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "ancora"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"font_size" => array(
							"title" => __("Font size", "ancora"),
							"desc" => __("Font size of the text (default - in pixels, allows any CSS units of measure)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"font_weight" => array(
							"title" => __("Font weight", "ancora"),
							"desc" => __("Font weight of the text", "ancora"),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'100' => __('Thin (100)', 'ancora'),
								'300' => __('Light (300)', 'ancora'),
								'400' => __('Normal (400)', 'ancora'),
								'700' => __('Bold (700)', 'ancora')
							)
						),
						"_content_" => array(
							"title" => __("Container content", "ancora"),
							"desc" => __("Content for section container", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Blogger
				"trx_blogger" => array(
					"title" => __("Blogger", "ancora"),
					"desc" => __("Insert posts (pages) in many styles from desired categories or directly from ids", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Posts output style", "ancora"),
							"desc" => __("Select desired style for posts output", "ancora"),
							"value" => "regular",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['blogger_styles']
						),
						"filters" => array(
							"title" => __("Show filters", "ancora"),
							"desc" => __("Use post's tags or categories as filter buttons", "ancora"),
							"value" => "no",
							"dir" => "horizontal",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['filters']
						),
						"hover" => array(
							"title" => __("Hover effect", "ancora"),
							"desc" => __("Select hover effect (only if style=Portfolio)", "ancora"),
							"dependency" => array(
								'style' => array('portfolio','grid','square','courses')
							),
							"value" => "",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['hovers']
						),
						"hover_dir" => array(
							"title" => __("Hover direction", "ancora"),
							"desc" => __("Select hover direction (only if style=Portfolio and hover=Circle|Square)", "ancora"),
							"dependency" => array(
								'style' => array('portfolio','grid','square','courses'),
								'hover' => array('square','circle')
							),
							"value" => "left_to_right",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['hovers_dir']
						),
						"dir" => array(
							"title" => __("Posts direction", "ancora"),
							"desc" => __("Display posts in horizontal or vertical direction", "ancora"),
							"value" => "horizontal",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['dir']
						),
						"post_type" => array(
							"title" => __("Post type", "ancora"),
							"desc" => __("Select post type to show", "ancora"),
							"value" => "post",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['posts_types']
						),
						"ids" => array(
							"title" => __("Post IDs list", "ancora"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"cat" => array(
							"title" => __("Categories list", "ancora"),
							"desc" => __("Select the desired categories. If not selected - show posts from any category or from IDs list", "ancora"),
							"dependency" => array(
								'ids' => array('is_empty'),
								'post_type' => array('refresh')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $ANCORA_GLOBALS['sc_params']['categories']
						),
						"count" => array(
							"title" => __("Total posts to show", "ancora"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
							"dependency" => array(
								'ids' => array('is_empty')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns number", "ancora"),
							"desc" => __("How many columns used to show posts? If empty or 0 - equal to posts number", "ancora"),
							"dependency" => array(
								'dir' => array('horizontal')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "ancora"),
							"desc" => __("Skip posts before select next part.", "ancora"),
							"dependency" => array(
								'ids' => array('is_empty')
							),
							"value" => 0,
							"min" => 0,
							"max" => 100,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "ancora"),
							"desc" => __("Select desired posts sorting method", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "ancora"),
							"desc" => __("Select desired posts order", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"only" => array(
							"title" => __("Select posts only", "ancora"),
							"desc" => __("Select posts only with reviews, videos, audios, thumbs or galleries", "ancora"),
							"value" => "no",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['formats']
						),
						"scroll" => array(
							"title" => __("Use scroller", "ancora"),
							"desc" => __("Use scroller to show all posts", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"controls" => array(
							"title" => __("Show slider controls", "ancora"),
							"desc" => __("Show arrows to control scroll slider", "ancora"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"location" => array(
							"title" => __("Dedicated content location", "ancora"),
							"desc" => __("Select position for dedicated content (only for style=excerpt)", "ancora"),
							"divider" => true,
							"dependency" => array(
								'style' => array('excerpt')
							),
							"value" => "default",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['locations']
						),
						"rating" => array(
							"title" => __("Show rating stars", "ancora"),
							"desc" => __("Show rating stars under post's header", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"info" => array(
							"title" => __("Show post info block", "ancora"),
							"desc" => __("Show post info block (author, date, tags, etc.)", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"links" => array(
							"title" => __("Allow links on the post", "ancora"),
							"desc" => __("Allow links on the post from each blogger item", "ancora"),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"descr" => array(
							"title" => __("Description length", "ancora"),
							"desc" => __("How many characters are displayed from post excerpt? If 0 - don't show description", "ancora"),
							"value" => 0,
							"min" => 0,
							"step" => 10,
							"type" => "spinner"
						),
						"readmore" => array(
							"title" => __("More link text", "ancora"),
							"desc" => __("Read more link text. If empty - show 'More', else - used as link text", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Br
				"trx_br" => array(
					"title" => __("Break", "ancora"),
					"desc" => __("Line break with clear floating (if need)", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"clear" => 	array(
							"title" => __("Clear floating", "ancora"),
							"desc" => __("Clear floating (if need)", "ancora"),
							"value" => "",
							"type" => "checklist",
							"options" => array(
								'none' => __('None', 'ancora'),
								'left' => __('Left', 'ancora'),
								'right' => __('Right', 'ancora'),
								'both' => __('Both', 'ancora')
							)
						)
					)
				),
			
			
			
			
				// Button
				"trx_button" => array(
					"title" => __("Button", "ancora"),
					"desc" => __("Button with link", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Caption", "ancora"),
							"desc" => __("Button caption", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"type" => array(
							"title" => __("Button's shape", "ancora"),
							"desc" => __("Select button's shape", "ancora"),
							"value" => "square",
							"size" => "medium",
							"options" => array(
								'square' => __('Square', 'ancora'),
								'round' => __('Round', 'ancora')
							),
							"type" => "switch"
						), 
						"style" => array(
							"title" => __("Button's style", "ancora"),
							"desc" => __("Select button's style", "ancora"),
							"value" => "default",
							"dir" => "horizontal",
							"options" => array(
								'dark' => __('Dark', 'ancora'),
								'light' => __('Light', 'ancora'),
                                'global' => __('Global', 'ancora')
							),
							"type" => "checklist"
						), 
						"size" => array(
							"title" => __("Button's size", "ancora"),
							"desc" => __("Select button's size", "ancora"),
							"value" => "small",
							"dir" => "horizontal",
							"options" => array(
								'small' => __('Small', 'ancora'),
								'medium' => __('Medium', 'ancora'),
								'large' => __('Large', 'ancora')
							),
							"type" => "checklist"
						), 
						"icon" => array(
							"title" => __("Button's icon",  'ancora'),
							"desc" => __('Select icon for the title from Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"bg_style" => array(
							"title" => __("Button's color scheme", "ancora"),
							"desc" => __("Select button's color scheme", "ancora"),
							"value" => "custom",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['button_styles']
						), 
						"color" => array(
							"title" => __("Button's text color", "ancora"),
							"desc" => __("Any color for button's caption", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Button's backcolor", "ancora"),
							"desc" => __("Any color for button's background", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"align" => array(
							"title" => __("Button's alignment", "ancora"),
							"desc" => __("Align button to left, center or right", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						), 
						"link" => array(
							"title" => __("Link URL", "ancora"),
							"desc" => __("URL for link on button click", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"target" => array(
							"title" => __("Link target", "ancora"),
							"desc" => __("Target for link on button click", "ancora"),
							"dependency" => array(
								'link' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"popup" => array(
							"title" => __("Open link in popup", "ancora"),
							"desc" => __("Open link target in popup window", "ancora"),
							"dependency" => array(
								'link' => array('not_empty')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						), 
						"rel" => array(
							"title" => __("Rel attribute", "ancora"),
							"desc" => __("Rel attribute for button's link (if need)", "ancora"),
							"dependency" => array(
								'link' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Chat
				"trx_chat" => array(
					"title" => __("Chat", "ancora"),
					"desc" => __("Chat message", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"title" => array(
							"title" => __("Item title", "ancora"),
							"desc" => __("Chat item title", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"photo" => array(
							"title" => __("Item photo", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for the item photo (avatar)", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"link" => array(
							"title" => __("Item link", "ancora"),
							"desc" => __("Chat item link", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Chat item content", "ancora"),
							"desc" => __("Current chat item content", "ancora"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
				// Columns
				"trx_columns" => array(
					"title" => __("Columns", "ancora"),
					"desc" => __("Insert up to 5 columns in your page (post)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"fluid" => array(
							"title" => __("Fluid columns", "ancora"),
							"desc" => __("To squeeze the columns when reducing the size of the window (fluid=yes) or to rebuild them (fluid=no)", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						), 
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_column_item",
						"title" => __("Column", "ancora"),
						"desc" => __("Column item", "ancora"),
						"container" => true,
						"params" => array(
							"span" => array(
								"title" => __("Merge columns", "ancora"),
								"desc" => __("Count merged columns from current", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"align" => array(
								"title" => __("Alignment", "ancora"),
								"desc" => __("Alignment text in the column", "ancora"),
								"value" => "",
								"type" => "checklist",
								"dir" => "horizontal",
								"options" => $ANCORA_GLOBALS['sc_params']['align']
							),
							"color" => array(
								"title" => __("Fore color", "ancora"),
								"desc" => __("Any color for objects in this column", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"bg_color" => array(
								"title" => __("Background color", "ancora"),
								"desc" => __("Any background color for this column", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"bg_image" => array(
								"title" => __("URL for background image file", "ancora"),
								"desc" => __("Select or upload image or write URL from other site for the background", "ancora"),
								"readonly" => false,
								"value" => "",
								"type" => "media"
							),
							"_content_" => array(
								"title" => __("Column item content", "ancora"),
								"desc" => __("Current column item content", "ancora"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Contact form
				"trx_contact_form" => array(
					"title" => __("Contact form", "ancora"),
					"desc" => __("Insert contact form", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"custom" => array(
							"title" => __("Custom", "ancora"),
							"desc" => __("Use custom fields or create standard contact form (ignore info from 'Field' tabs)", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						), 
						"action" => array(
							"title" => __("Action", "ancora"),
							"desc" => __("Contact form action (URL to handle form data). If empty - use internal action", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Align", "ancora"),
							"desc" => __("Select form alignment", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"title" => array(
							"title" => __("Title", "ancora"),
							"desc" => __("Contact form title", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => __("Description", "ancora"),
							"desc" => __("Short description for contact form", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_form_item",
						"title" => __("Field", "ancora"),
						"desc" => __("Custom field", "ancora"),
						"container" => false,
						"params" => array(
							"type" => array(
								"title" => __("Type", "ancora"),
								"desc" => __("Type of the custom field", "ancora"),
								"value" => "text",
								"type" => "checklist",
								"dir" => "horizontal",
								"options" => $ANCORA_GLOBALS['sc_params']['field_types']
							), 
							"name" => array(
								"title" => __("Name", "ancora"),
								"desc" => __("Name of the custom field", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"value" => array(
								"title" => __("Default value", "ancora"),
								"desc" => __("Default value of the custom field", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"label" => array(
								"title" => __("Label", "ancora"),
								"desc" => __("Label for the custom field", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"label_position" => array(
								"title" => __("Label position", "ancora"),
								"desc" => __("Label position relative to the field", "ancora"),
								"value" => "top",
								"type" => "checklist",
								"dir" => "horizontal",
								"options" => $ANCORA_GLOBALS['sc_params']['label_positions']
							), 
							"top" => $ANCORA_GLOBALS['sc_params']['top'],
							"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
							"left" => $ANCORA_GLOBALS['sc_params']['left'],
							"right" => $ANCORA_GLOBALS['sc_params']['right'],
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Content block on fullscreen page
				"trx_content" => array(
					"title" => __("Content block", "ancora"),
					"desc" => __("Container for main content block with desired class and style (use it only on fullscreen pages)", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Container content", "ancora"),
							"desc" => __("Content for section container", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Countdown
				"trx_countdown" => array(
					"title" => __("Countdown", "ancora"),
					"desc" => __("Insert countdown object", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"date" => array(
							"title" => __("Date", "ancora"),
							"desc" => __("Upcoming date (format: yyyy-mm-dd)", "ancora"),
							"value" => "",
							"format" => "yy-mm-dd",
							"type" => "date"
						),
						"time" => array(
							"title" => __("Time", "ancora"),
							"desc" => __("Upcoming time (format: HH:mm:ss)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"style" => array(
							"title" => __("Style", "ancora"),
							"desc" => __("Countdown style", "ancora"),
							"value" => "1",
							"type" => "checklist",
							"options" => array(
								1 => __('Style 1', 'ancora'),
								2 => __('Style 2', 'ancora')
							)
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Align counter to left, center or right", "ancora"),
							"divider" => true,
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						), 
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Dropcaps
				"trx_dropcaps" => array(
					"title" => __("Dropcaps", "ancora"),
					"desc" => __("Make first letter as dropcaps", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"style" => array(
							"title" => __("Style", "ancora"),
							"desc" => __("Dropcaps style", "ancora"),
							"value" => "1",
							"type" => "checklist",
							"options" => array(
								1 => __('Style 1', 'ancora'),
								2 => __('Style 2', 'ancora'),
								3 => __('Style 3', 'ancora'),
								4 => __('Style 4', 'ancora')
							)
						),
						"_content_" => array(
							"title" => __("Paragraph content", "ancora"),
							"desc" => __("Paragraph with dropcaps content", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Emailer
				"trx_emailer" => array(
					"title" => __("E-mail collector", "ancora"),
					"desc" => __("Collect the e-mail address into specified group", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"group" => array(
							"title" => __("Group", "ancora"),
							"desc" => __("The name of group to collect e-mail address", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"open" => array(
							"title" => __("Open", "ancora"),
							"desc" => __("Initially open the input field on show object", "ancora"),
							"divider" => true,
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Align object to left, center or right", "ancora"),
							"divider" => true,
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						), 
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Gap
				"trx_gap" => array(
					"title" => __("Gap", "ancora"),
					"desc" => __("Insert gap (fullwidth area) in the post content. Attention! Use the gap only in the posts (pages) without left or right sidebar", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Gap content", "ancora"),
							"desc" => __("Gap inner content", "ancora"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						)
					)
				),
			
			
			
			
			
				// Google map
				"trx_googlemap" => array(
					"title" => __("Google map", "ancora"),
					"desc" => __("Insert Google map with desired address or coordinates", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"address" => array(
							"title" => __("Address", "ancora"),
							"desc" => __("Address to show in map center", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"latlng" => array(
							"title" => __("Latitude and Longtitude", "ancora"),
							"desc" => __("Comma separated map center coorditanes (instead Address)", "ancora"),
							"value" => "",
							"type" => "text"
						),
                        "description" => array(
                            "title" => __("Description", "ancora"),
                            "desc" => __("Description", "ancora"),
                            "value" => "",
                            "type" => "text"
                        ),
						"zoom" => array(
							"title" => __("Zoom", "ancora"),
							"desc" => __("Map zoom factor", "ancora"),
							"divider" => true,
							"value" => 16,
							"min" => 1,
							"max" => 20,
							"type" => "spinner"
						),
						"style" => array(
							"title" => __("Map style", "ancora"),
							"desc" => __("Select map style", "ancora"),
							"value" => "default",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['googlemap_styles']
						),
						"width" => ancora_shortcodes_width('100%'),
						"height" => ancora_shortcodes_height(240),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Hide or show any block
				"trx_hide" => array(
					"title" => __("Hide/Show any block", "ancora"),
					"desc" => __("Hide or Show any block with desired CSS-selector", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"selector" => array(
							"title" => __("Selector", "ancora"),
							"desc" => __("Any block's CSS-selector", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"hide" => array(
							"title" => __("Hide or Show", "ancora"),
							"desc" => __("New state for the block: hide or show", "ancora"),
							"value" => "yes",
							"size" => "small",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no'],
							"type" => "switch"
						)
					)
				),
			
			
			
				// Highlght text
				"trx_highlight" => array(
					"title" => __("Highlight text", "ancora"),
					"desc" => __("Highlight text with selected color, background color and other styles", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"type" => array(
							"title" => __("Type", "ancora"),
							"desc" => __("Highlight type", "ancora"),
							"value" => "1",
							"type" => "checklist",
							"options" => array(
								0 => __('Custom', 'ancora'),
								1 => __('Type 1', 'ancora'),
								2 => __('Type 2', 'ancora'),
								3 => __('Type 3', 'ancora')
							)
						),
						"color" => array(
							"title" => __("Color", "ancora"),
							"desc" => __("Color for the highlighted text", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Background color for the highlighted text", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"font_size" => array(
							"title" => __("Font size", "ancora"),
							"desc" => __("Font size of the highlighted text (default - in pixels, allows any CSS units of measure)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Highlighting content", "ancora"),
							"desc" => __("Content for highlight", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Icon
				"trx_icon" => array(
					"title" => __("Icon", "ancora"),
					"desc" => __("Insert icon", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"icon" => array(
							"title" => __('Icon',  'ancora'),
							"desc" => __('Select font icon from the Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"color" => array(
							"title" => __("Icon's color", "ancora"),
							"desc" => __("Icon's color", "ancora"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "color"
						),
						"bg_shape" => array(
							"title" => __("Background shape", "ancora"),
							"desc" => __("Shape of the icon background", "ancora"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "none",
							"type" => "radio",
							"options" => array(
								'none' => __('None', 'ancora'),
								'round' => __('Round', 'ancora'),
								'square' => __('Square', 'ancora')
							)
						),
						"bg_style" => array(
							"title" => __("Background style", "ancora"),
							"desc" => __("Select icon's color scheme", "ancora"),
							"value" => "custom",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['button_styles']
						), 
						"bg_color" => array(
							"title" => __("Icon's background color", "ancora"),
							"desc" => __("Icon's background color", "ancora"),
							"dependency" => array(
								'icon' => array('not_empty'),
								'background' => array('round','square')
							),
							"value" => "",
							"type" => "color"
						),
						"font_size" => array(
							"title" => __("Font size", "ancora"),
							"desc" => __("Icon's font size", "ancora"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "spinner",
							"min" => 8,
							"max" => 240
						),
						"font_weight" => array(
							"title" => __("Font weight", "ancora"),
							"desc" => __("Icon font weight", "ancora"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'100' => __('Thin (100)', 'ancora'),
								'300' => __('Light (300)', 'ancora'),
								'400' => __('Normal (400)', 'ancora'),
								'700' => __('Bold (700)', 'ancora')
							)
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Icon text alignment", "ancora"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						), 
						"link" => array(
							"title" => __("Link URL", "ancora"),
							"desc" => __("Link URL from this icon (if not empty)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Image
				"trx_image" => array(
					"title" => __("Image", "ancora"),
					"desc" => __("Insert image into your post (page)", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"url" => array(
							"title" => __("URL for image file", "ancora"),
							"desc" => __("Select or upload image or write URL from other site", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"title" => array(
							"title" => __("Title", "ancora"),
							"desc" => __("Image title (if need)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"icon" => array(
							"title" => __("Icon before title",  'ancora'),
							"desc" => __('Select icon for the title from Fontello icons set',  'ancora'),
							"value" => "none",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"align" => array(
							"title" => __("Float image", "ancora"),
							"desc" => __("Float image to left or right side", "ancora"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['float']
						), 
						"shape" => array(
							"title" => __("Image Shape", "ancora"),
							"desc" => __("Shape of the image: square (rectangle) or round", "ancora"),
							"value" => "square",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								"square" => __('Square', 'ancora'),
								"round" => __('Round', 'ancora')
							)
						), 
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Infobox
				"trx_infobox" => array(
					"title" => __("Infobox", "ancora"),
					"desc" => __("Insert infobox into your post (page)", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"style" => array(
							"title" => __("Style", "ancora"),
							"desc" => __("Infobox style", "ancora"),
							"value" => "regular",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'regular' => __('Regular', 'ancora'),
								'info' => __('Info', 'ancora'),
								'success' => __('Success', 'ancora'),
								'error' => __('Error', 'ancora'),
                                'warning'=> __('Warning','ancora')
							)
						),
						"closeable" => array(
							"title" => __("Closeable box", "ancora"),
							"desc" => __("Create closeable box (with close button)", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"icon" => array(
							"title" => __("Custom icon",  'ancora'),
							"desc" => __('Select icon for the infobox from Fontello icons set. If empty - use default icon',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"color" => array(
							"title" => __("Text color", "ancora"),
							"desc" => __("Any color for text and headers", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Any background color for this infobox", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"_content_" => array(
							"title" => __("Infobox content", "ancora"),
							"desc" => __("Content for infobox", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Line
				"trx_line" => array(
					"title" => __("Line", "ancora"),
					"desc" => __("Insert Line into your post (page)", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Style", "ancora"),
							"desc" => __("Line style", "ancora"),
							"value" => "solid",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'solid' => __('Solid', 'ancora'),
								'dashed' => __('Dashed', 'ancora'),
								'dotted' => __('Dotted', 'ancora'),
								'double' => __('Double', 'ancora')
							)
						),
						"color" => array(
							"title" => __("Color", "ancora"),
							"desc" => __("Line color", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// List
				"trx_list" => array(
					"title" => __("List", "ancora"),
					"desc" => __("List items with specific bullets", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Bullet's style", "ancora"),
							"desc" => __("Bullet's style for each list item", "ancora"),
							"value" => "ul",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['list_styles']
						), 
						"color" => array(
							"title" => __("Color", "ancora"),
							"desc" => __("List items color", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"icon" => array(
							"title" => __('List icon',  'ancora'),
							"desc" => __("Select list icon from Fontello icons set (only for style=Iconed)",  'ancora'),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"icon_color" => array(
							"title" => __("Icon color", "ancora"),
							"desc" => __("List icons color", "ancora"),
							"value" => "",
							"dependency" => array(
								'style' => array('iconed')
							),
							"type" => "color"
						),
                        "boxed_icon" => array(
                            "title" => __("Boxed Icon", "ancora"),
                            "desc" => __("Create border around icon", "ancora"),
                            "value" => "",
                            "type" => "checklist",
                            "options" => array('' => 'No', 'boxed_icon' => 'Yes'),
                        ),
                        "top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_list_item",
						"title" => __("Item", "ancora"),
						"desc" => __("List item with specific bullet", "ancora"),
						"decorate" => false,
						"container" => true,
						"params" => array(
							"_content_" => array(
								"title" => __("List item content", "ancora"),
								"desc" => __("Current list item content", "ancora"),
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"title" => array(
								"title" => __("List item title", "ancora"),
								"desc" => __("Current list item title (show it as tooltip)", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"color" => array(
								"title" => __("Color", "ancora"),
								"desc" => __("Text color for this item", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"icon" => array(
								"title" => __('List icon',  'ancora'),
								"desc" => __("Select list item icon from Fontello icons set (only for style=Iconed)",  'ancora'),
								"value" => "",
								"type" => "icons",
								"options" => $ANCORA_GLOBALS['sc_params']['icons']
							),
							"icon_color" => array(
								"title" => __("Icon color", "ancora"),
								"desc" => __("Icon color for this item", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"link" => array(
								"title" => __("Link URL", "ancora"),
								"desc" => __("Link URL for the current list item", "ancora"),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"target" => array(
								"title" => __("Link target", "ancora"),
								"desc" => __("Link target for the current list item", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
				// Number
				"trx_number" => array(
					"title" => __("Number", "ancora"),
					"desc" => __("Insert number or any word as set separate characters", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"value" => array(
							"title" => __("Value", "ancora"),
							"desc" => __("Number or any word", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Align", "ancora"),
							"desc" => __("Select block alignment", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Parallax
				"trx_parallax" => array(
					"title" => __("Parallax", "ancora"),
					"desc" => __("Create the parallax container (with asinc background image)", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"gap" => array(
							"title" => __("Create gap", "ancora"),
							"desc" => __("Create gap around parallax container", "ancora"),
							"value" => "no",
							"size" => "small",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no'],
							"type" => "switch"
						), 
						"dir" => array(
							"title" => __("Dir", "ancora"),
							"desc" => __("Scroll direction for the parallax background", "ancora"),
							"value" => "up",
							"size" => "medium",
							"options" => array(
								'up' => __('Up', 'ancora'),
								'down' => __('Down', 'ancora')
							),
							"type" => "switch"
						), 
						"speed" => array(
							"title" => __("Speed", "ancora"),
							"desc" => __("Image motion speed (from 0.0 to 1.0)", "ancora"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0.3",
							"type" => "spinner"
						),
						"color" => array(
							"title" => __("Text color", "ancora"),
							"desc" => __("Select color for text object inside parallax block", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_tint" => array(
							"title" => __("Bg tint", "ancora"),
							"desc" => __("Select tint of the parallax background (for correct font color choise)", "ancora"),
							"value" => "light",
							"size" => "medium",
							"options" => array(
								'light' => __('Light', 'ancora'),
								'dark' => __('Dark', 'ancora')
							),
							"type" => "switch"
						), 
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Select color for parallax background", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for the parallax background", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_image_x" => array(
							"title" => __("Image X position", "ancora"),
							"desc" => __("Image horizontal position (as background of the parallax block) - in percent", "ancora"),
							"min" => "0",
							"max" => "100",
							"value" => "50",
							"type" => "spinner"
						),
						"bg_video" => array(
							"title" => __("Video background", "ancora"),
							"desc" => __("Select video from media library or paste URL for video file from other site to show it as parallax background", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media",
							"before" => array(
								'title' => __('Choose video', 'ancora'),
								'action' => 'media_upload',
								'type' => 'video',
								'multiple' => false,
								'linked_field' => '',
								'captions' => array( 	
									'choose' => __('Choose video file', 'ancora'),
									'update' => __('Select video file', 'ancora')
								)
							),
							"after" => array(
								'icon' => 'icon-cancel',
								'action' => 'media_reset'
							)
						),
						"bg_video_ratio" => array(
							"title" => __("Video ratio", "ancora"),
							"desc" => __("Specify ratio of the video background. For example: 16:9 (default), 4:3, etc.", "ancora"),
							"value" => "16:9",
							"type" => "text"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "ancora"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "ancora"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "ancora"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"_content_" => array(
							"title" => __("Content", "ancora"),
							"desc" => __("Content for the parallax container", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Popup
				"trx_popup" => array(
					"title" => __("Popup window", "ancora"),
					"desc" => __("Container for any html-block with desired class and style for popup window", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Container content", "ancora"),
							"desc" => __("Content for section container", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Price
				"trx_price" => array(
					"title" => __("Price", "ancora"),
					"desc" => __("Insert price with decoration", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"money" => array(
							"title" => __("Money", "ancora"),
							"desc" => __("Money value (dot or comma separated)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"currency" => array(
							"title" => __("Currency", "ancora"),
							"desc" => __("Currency character", "ancora"),
							"value" => "$",
							"type" => "text"
						),
						"period" => array(
							"title" => __("Period", "ancora"),
							"desc" => __("Period text (if need). For example: monthly, daily, etc.", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Align price to left or right side", "ancora"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['float']
						), 
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Price block
				"trx_price_block" => array(
					"title" => __("Price block", "ancora"),
					"desc" => __("Insert price block with title, price and description", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"title" => array(
							"title" => __("Title", "ancora"),
							"desc" => __("Block title", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"link" => array(
							"title" => __("Link URL", "ancora"),
							"desc" => __("URL for link from button (at bottom of the block)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"link_text" => array(
							"title" => __("Link text", "ancora"),
							"desc" => __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"icon" => array(
							"title" => __("Icon",  'ancora'),
							"desc" => __('Select icon from Fontello icons set (placed before/instead price)',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"money" => array(
							"title" => __("Money", "ancora"),
							"desc" => __("Money value (dot or comma separated)", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"currency" => array(
							"title" => __("Currency", "ancora"),
							"desc" => __("Currency character", "ancora"),
							"value" => "$",
							"type" => "text"
						),
						"period" => array(
							"title" => __("Period", "ancora"),
							"desc" => __("Period text (if need). For example: monthly, daily, etc.", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Align price to left or right side", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['float']
						), 
						"_content_" => array(
							"title" => __("Description", "ancora"),
							"desc" => __("Description for this price block", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Quote
				"trx_quote" => array(
					"title" => __("Quote", "ancora"),
					"desc" => __("Quote text", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
                        "style" => array(
                            "title" => __("Style", "ancora"),
                            "desc" => __("Quote style", "ancora"),
                            "value" => "",
                            "type" => "checklist",
                            "options" => array ( '1' => 'Dark', '2' => 'White')
                        ),
						"cite" => array(
							"title" => __("Quote cite", "ancora"),
							"desc" => __("URL for quote cite", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"title" => array(
							"title" => __("Title (author)", "ancora"),
							"desc" => __("Quote title (author name)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Quote content", "ancora"),
							"desc" => __("Quote content", "ancora"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Reviews
				"trx_reviews" => array(
					"title" => __("Reviews", "ancora"),
					"desc" => __("Insert reviews block in the single post", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Align counter to left, center or right", "ancora"),
							"divider" => true,
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						), 
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Search
				"trx_search" => array(
					"title" => __("Search", "ancora"),
					"desc" => __("Show search form", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"ajax" => array(
							"title" => __("Style", "ancora"),
							"desc" => __("Select style to display search field", "ancora"),
							"value" => "regular",
							"options" => array(
								"regular" => __('Regular', 'ancora'),
								"flat" => __('Flat', 'ancora')
							),
							"type" => "checklist"
						),
						"title" => array(
							"title" => __("Title", "ancora"),
							"desc" => __("Title (placeholder) for the search field", "ancora"),
							"value" => __("Search &hellip;", 'ancora'),
							"type" => "text"
						),
						"ajax" => array(
							"title" => __("AJAX", "ancora"),
							"desc" => __("Search via AJAX or reload page", "ancora"),
							"value" => "yes",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no'],
							"type" => "switch"
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Section
				"trx_section" => array(
					"title" => __("Section container", "ancora"),
					"desc" => __("Container for any block with desired class and style", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"dedicated" => array(
							"title" => __("Dedicated", "ancora"),
							"desc" => __("Use this block as dedicated content - show it before post title on single page", "ancora"),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"align" => array(
							"title" => __("Align", "ancora"),
							"desc" => __("Select block alignment", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"columns" => array(
							"title" => __("Columns emulation", "ancora"),
							"desc" => __("Select width for columns emulation", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['columns']
						), 
						"pan" => array(
							"title" => __("Use pan effect", "ancora"),
							"desc" => __("Use pan effect to show section content", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"scroll" => array(
							"title" => __("Use scroller", "ancora"),
							"desc" => __("Use scroller to show section content", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"scroll_dir" => array(
							"title" => __("Scroll and Pan direction", "ancora"),
							"desc" => __("Scroll and Pan direction (if Use scroller = yes or Pan = yes)", "ancora"),
							"dependency" => array(
								'pan' => array('yes'),
								'scroll' => array('yes')
							),
							"value" => "horizontal",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['dir']
						),
						"scroll_controls" => array(
							"title" => __("Scroll controls", "ancora"),
							"desc" => __("Show scroll controls (if Use scroller = yes)", "ancora"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"color" => array(
							"title" => __("Fore color", "ancora"),
							"desc" => __("Any color for objects in this section", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_tint" => array(
							"title" => __("Background tint", "ancora"),
							"desc" => __("Main background tint: dark or light", "ancora"),
							"value" => "",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Any background color for this section", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for the background", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "ancora"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "ancora"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "ancora"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"font_size" => array(
							"title" => __("Font size", "ancora"),
							"desc" => __("Font size of the text (default - in pixels, allows any CSS units of measure)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"font_weight" => array(
							"title" => __("Font weight", "ancora"),
							"desc" => __("Font weight of the text", "ancora"),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'100' => __('Thin (100)', 'ancora'),
								'300' => __('Light (300)', 'ancora'),
								'400' => __('Normal (400)', 'ancora'),
								'700' => __('Bold (700)', 'ancora')
							)
						),
						"_content_" => array(
							"title" => __("Container content", "ancora"),
							"desc" => __("Content for section container", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
				// Skills
				"trx_skills" => array(
					"title" => __("Skills", "ancora"),
					"desc" => __("Insert skills diagramm in your page (post)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"max_value" => array(
							"title" => __("Max value", "ancora"),
							"desc" => __("Max value for skills items", "ancora"),
							"value" => 100,
							"min" => 1,
							"type" => "spinner"
						),
						"type" => array(
							"title" => __("Skills type", "ancora"),
							"desc" => __("Select type of skills block", "ancora"),
							"value" => "bar",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'bar' => __('Bar', 'ancora'),
								'pie' => __('Pie chart', 'ancora'),
								'counter' => __('Counter', 'ancora'),
								'arc' => __('Arc', 'ancora')
							)
						), 
						"layout" => array(
							"title" => __("Skills layout", "ancora"),
							"desc" => __("Select layout of skills block", "ancora"),
							"dependency" => array(
								'type' => array('counter','pie','bar')
							),
							"value" => "rows",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'rows' => __('Rows', 'ancora'),
								'columns' => __('Columns', 'ancora')
							)
						),
						"dir" => array(
							"title" => __("Direction", "ancora"),
							"desc" => __("Select direction of skills block", "ancora"),
							"dependency" => array(
								'type' => array('counter','pie','bar')
							),
							"value" => "horizontal",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['dir']
						), 
						"style" => array(
							"title" => __("Counters style", "ancora"),
							"desc" => __("Select style of skills items (only for type=counter)", "ancora"),
							"dependency" => array(
								'type' => array('counter')
							),
							"value" => 1,
							"min" => 1,
							"max" => 4,
							"type" => "spinner"
						), 
						// "columns" - autodetect, not set manual
						"color" => array(
							"title" => __("Skills items color", "ancora"),
							"desc" => __("Color for all skills items", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Background color for all skills items (only for type=pie)", "ancora"),
							"dependency" => array(
								'type' => array('pie')
							),
							"value" => "",
							"type" => "color"
						),
						"border_color" => array(
							"title" => __("Border color", "ancora"),
							"desc" => __("Border color for all skills items (only for type=pie)", "ancora"),
							"dependency" => array(
								'type' => array('pie')
							),
							"value" => "",
							"type" => "color"
						),
						"title" => array(
							"title" => __("Skills title", "ancora"),
							"desc" => __("Skills block title", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"subtitle" => array(
							"title" => __("Skills subtitle", "ancora"),
							"desc" => __("Skills block subtitle - text in the center (only for type=arc)", "ancora"),
							"dependency" => array(
								'type' => array('arc')
							),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Align skills block", "ancora"),
							"desc" => __("Align skills block to left or right side", "ancora"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['float']
						), 
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_skills_item",
						"title" => __("Skill", "ancora"),
						"desc" => __("Skills item", "ancora"),
						"container" => false,
						"params" => array(
							"title" => array(
								"title" => __("Title", "ancora"),
								"desc" => __("Current skills item title", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"value" => array(
								"title" => __("Value", "ancora"),
								"desc" => __("Current skills level", "ancora"),
								"value" => 50,
								"min" => 0,
								"step" => 1,
								"type" => "spinner"
							),
							"color" => array(
								"title" => __("Color", "ancora"),
								"desc" => __("Current skills item color", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"bg_color" => array(
								"title" => __("Background color", "ancora"),
								"desc" => __("Current skills item background color (only for type=pie)", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"border_color" => array(
								"title" => __("Border color", "ancora"),
								"desc" => __("Current skills item border color (only for type=pie)", "ancora"),
								"value" => "",
								"type" => "color"
							),
							"style" => array(
								"title" => __("Counter tyle", "ancora"),
								"desc" => __("Select style for the current skills item (only for type=counter)", "ancora"),
								"value" => 1,
								"min" => 1,
								"max" => 4,
								"type" => "spinner"
							), 
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Slider
				"trx_slider" => array(
					"title" => __("Slider", "ancora"),
					"desc" => __("Insert slider into your post (page)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array_merge(array(
						"engine" => array(
							"title" => __("Slider engine", "ancora"),
							"desc" => __("Select engine for slider. Attention! Swiper is built-in engine, all other engines appears only if corresponding plugings are installed", "ancora"),
							"value" => "swiper",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['sliders']
						),
						"align" => array(
							"title" => __("Float slider", "ancora"),
							"desc" => __("Float slider to left or right side", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['float']
						),
						"custom" => array(
							"title" => __("Custom slides", "ancora"),
							"desc" => __("Make custom slides from inner shortcodes (prepare it on tabs) or prepare slides from posts thumbnails", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						)
						),
						ancora_exists_revslider() || ancora_exists_royalslider() ? array(
						"alias" => array(
							"title" => __("Revolution slider alias or Royal Slider ID", "ancora"),
							"desc" => __("Alias for Revolution slider or Royal slider ID", "ancora"),
							"dependency" => array(
								'engine' => array('revo','royal')
							),
							"divider" => true,
							"value" => "",
							"type" => "text"
						)) : array(), array(
						"cat" => array(
							"title" => __("Swiper: Category list", "ancora"),
							"desc" => __("Comma separated list of category slugs. If empty - select posts from any category or from IDs list", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $ANCORA_GLOBALS['sc_params']['categories']
						),
						"count" => array(
							"title" => __("Swiper: Number of posts", "ancora"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Swiper: Offset before select posts", "ancora"),
							"desc" => __("Skip posts before select next part.", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Swiper: Post order by", "ancora"),
							"desc" => __("Select desired posts sorting method", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "date",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Swiper: Post order", "ancora"),
							"desc" => __("Select desired posts order", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Swiper: Post IDs list", "ancora"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "",
							"type" => "text"
						),
						"controls" => array(
							"title" => __("Swiper: Show slider controls", "ancora"),
							"desc" => __("Show arrows inside slider", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"divider" => true,
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"pagination" => array(
							"title" => __("Swiper: Show slider pagination", "ancora"),
							"desc" => __("Show bullets for switch slides", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "checklist",
							"options" => array(
								'yes'  => __('Dots', 'ancora'),
								'full' => __('Side Titles', 'ancora'),
								'over' => __('Over Titles', 'ancora'),
								'no'   => __('None', 'ancora')
							)
						),
						"titles" => array(
							"title" => __("Swiper: Show titles section", "ancora"),
							"desc" => __("Show section with post's title and short post's description", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"divider" => true,
							"value" => "no",
							"type" => "checklist",
							"options" => array(
								"no"    => __('Not show', 'ancora'),
								"slide" => __('Show/Hide info', 'ancora'),
								"fixed" => __('Fixed info', 'ancora')
							)
						),
						"descriptions" => array(
							"title" => __("Swiper: Post descriptions", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"desc" => __("Show post's excerpt max length (characters)", "ancora"),
							"value" => 0,
							"min" => 0,
							"max" => 1000,
							"step" => 10,
							"type" => "spinner"
						),
						"links" => array(
							"title" => __("Swiper: Post's title as link", "ancora"),
							"desc" => __("Make links from post's titles", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"crop" => array(
							"title" => __("Swiper: Crop images", "ancora"),
							"desc" => __("Crop images in each slide or live it unchanged", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"autoheight" => array(
							"title" => __("Swiper: Autoheight", "ancora"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"interval" => array(
							"title" => __("Swiper: Slides change interval", "ancora"),
							"desc" => __("Slides change interval (in milliseconds: 1000ms = 1s)", "ancora"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => 5000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)),
					"children" => array(
						"name" => "trx_slider_item",
						"title" => __("Slide", "ancora"),
						"desc" => __("Slider item", "ancora"),
						"container" => false,
						"params" => array(
							"src" => array(
								"title" => __("URL (source) for image file", "ancora"),
								"desc" => __("Select or upload image or write URL from other site for the current slide", "ancora"),
								"readonly" => false,
								"value" => "",
								"type" => "media"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Socials
				"trx_socials" => array(
					"title" => __("Social icons", "ancora"),
					"desc" => __("List of social icons (with hovers)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"size" => array(
							"title" => __("Icon's size", "ancora"),
							"desc" => __("Size of the icons", "ancora"),
							"value" => "small",
							"type" => "checklist",
							"options" => array(
								"tiny" => __('Tiny', 'ancora'),
								"small" => __('Small', 'ancora'),
								"large" => __('Large', 'ancora')
							)
						), 
						"socials" => array(
							"title" => __("Manual socials list", "ancora"),
							"desc" => __("Custom list of social networks. For example: twitter=http://twitter.com/my_profile|facebook=http://facebooc.com/my_profile. If empty - use socials from Theme options.", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"custom" => array(
							"title" => __("Custom socials", "ancora"),
							"desc" => __("Make custom icons from inner shortcodes (prepare it on tabs)", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_social_item",
						"title" => __("Custom social item", "ancora"),
						"desc" => __("Custom social item: name, profile url and icon url", "ancora"),
						"decorate" => false,
						"container" => false,
						"params" => array(
							"name" => array(
								"title" => __("Social name", "ancora"),
								"desc" => __("Name (slug) of the social network (twitter, facebook, linkedin, etc.)", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"url" => array(
								"title" => __("Your profile URL", "ancora"),
								"desc" => __("URL of your profile in specified social network", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"icon" => array(
								"title" => __("URL (source) for icon file", "ancora"),
								"desc" => __("Select or upload image or write URL from other site for the current social icon", "ancora"),
								"readonly" => false,
								"value" => "",
								"type" => "media"
							)
						)
					)
				),
			
			
			
			
				// Table
				"trx_table" => array(
					"title" => __("Table", "ancora"),
					"desc" => __("Insert a table into post (page). ", "ancora"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"align" => array(
							"title" => __("Content alignment", "ancora"),
							"desc" => __("Select alignment for each table cell", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"_content_" => array(
							"title" => __("Table content", "ancora"),
							"desc" => __("Content, created with any table-generator", "ancora"),
							"divider" => true,
							"rows" => 8,
							"value" => "Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/",
							"type" => "textarea"
						),
						"width" => ancora_shortcodes_width(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Tabs
				"trx_tabs" => array(
					"title" => __("Tabs", "ancora"),
					"desc" => __("Insert tabs in your page (post)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Tabs style", "ancora"),
							"desc" => __("Select style for tabs items", "ancora"),
							"value" => 1,
							"options" => array(
								1 => __('Style 1', 'ancora'),
								2 => __('Style 2', 'ancora')
							),
							"type" => "radio"
						),
						"initial" => array(
							"title" => __("Initially opened tab", "ancora"),
							"desc" => __("Number of initially opened tab", "ancora"),
							"divider" => true,
							"value" => 1,
							"min" => 0,
							"type" => "spinner"
						),
						"scroll" => array(
							"title" => __("Use scroller", "ancora"),
							"desc" => __("Use scroller to show tab content (height parameter required)", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_tab",
						"title" => __("Tab", "ancora"),
						"desc" => __("Tab item", "ancora"),
						"container" => true,
						"params" => array(
							"title" => array(
								"title" => __("Tab title", "ancora"),
								"desc" => __("Current tab title", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"_content_" => array(
								"title" => __("Tab content", "ancora"),
								"desc" => __("Current tab content", "ancora"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
			
				// Team
				"trx_team" => array(
					"title" => __("Team", "ancora"),
					"desc" => __("Insert team in your page (post)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Team style", "ancora"),
							"desc" => __("Select style to display team members", "ancora"),
							"value" => "1",
							"type" => "select",
							"options" => array(
								1 => __('Style 1', 'ancora'),
								2 => __('Style 2', 'ancora')
							)
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns use to show team members", "ancora"),
							"value" => 3,
							"min" => 2,
							"max" => 5,
							"step" => 1,
							"type" => "spinner"
						),
						"custom" => array(
							"title" => __("Custom", "ancora"),
							"desc" => __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"cat" => array(
							"title" => __("Categories", "ancora"),
							"desc" => __("Select categories (groups) to show team members. If empty - select team members from any category (group) or from IDs list", "ancora"),
							"dependency" => array(
								'custom' => array('no')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $ANCORA_GLOBALS['sc_params']['team_groups']
						),
						"count" => array(
							"title" => __("Number of posts", "ancora"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "ancora"),
							"desc" => __("Skip posts before select next part.", "ancora"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "ancora"),
							"desc" => __("Select desired posts sorting method", "ancora"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "title",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "ancora"),
							"desc" => __("Select desired posts order", "ancora"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "asc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Post IDs list", "ancora"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "",
							"type" => "text"
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_team_item",
						"title" => __("Member", "ancora"),
						"desc" => __("Team member", "ancora"),
						"container" => true,
						"params" => array(
							"user" => array(
								"title" => __("Registerd user", "ancora"),
								"desc" => __("Select one of registered users (if present) or put name, position, etc. in fields below", "ancora"),
								"value" => "",
								"type" => "select",
								"options" => $ANCORA_GLOBALS['sc_params']['users']
							),
							"member" => array(
								"title" => __("Team member", "ancora"),
								"desc" => __("Select one of team members (if present) or put name, position, etc. in fields below", "ancora"),
								"value" => "",
								"type" => "select",
								"options" => $ANCORA_GLOBALS['sc_params']['members']
							),
							"link" => array(
								"title" => __("Link", "ancora"),
								"desc" => __("Link on team member's personal page", "ancora"),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"name" => array(
								"title" => __("Name", "ancora"),
								"desc" => __("Team member's name", "ancora"),
								"divider" => true,
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"position" => array(
								"title" => __("Position", "ancora"),
								"desc" => __("Team member's position", "ancora"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"email" => array(
								"title" => __("E-mail", "ancora"),
								"desc" => __("Team member's e-mail", "ancora"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"photo" => array(
								"title" => __("Photo", "ancora"),
								"desc" => __("Team member's photo (avatar)", "ancora"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"readonly" => false,
								"type" => "media"
							),
							"socials" => array(
								"title" => __("Socials", "ancora"),
								"desc" => __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", "ancora"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"_content_" => array(
								"title" => __("Description", "ancora"),
								"desc" => __("Team member's short description", "ancora"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Testimonials
				"trx_testimonials" => array(
					"title" => __("Testimonials", "ancora"),
					"desc" => __("Insert testimonials into post (page)", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"controls" => array(
							"title" => __("Show arrows", "ancora"),
							"desc" => __("Show control buttons", "ancora"),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"interval" => array(
							"title" => __("Testimonials change interval", "ancora"),
							"desc" => __("Testimonials change interval (in milliseconds: 1000ms = 1s)", "ancora"),
							"value" => 7000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Alignment of the testimonials block", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"autoheight" => array(
							"title" => __("Autoheight", "ancora"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "ancora"),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"custom" => array(
							"title" => __("Custom", "ancora"),
							"desc" => __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", "ancora"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"cat" => array(
							"title" => __("Categories", "ancora"),
							"desc" => __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", "ancora"),
							"dependency" => array(
								'custom' => array('yes')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $ANCORA_GLOBALS['sc_params']['testimonials_groups']
						),
						"count" => array(
							"title" => __("Number of posts", "ancora"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
							"dependency" => array(
								'custom' => array('yes')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "ancora"),
							"desc" => __("Skip posts before select next part.", "ancora"),
							"dependency" => array(
								'custom' => array('yes')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "ancora"),
							"desc" => __("Select desired posts sorting method", "ancora"),
							"dependency" => array(
								'custom' => array('yes')
							),
							"value" => "date",
							"type" => "select",
							"options" => $ANCORA_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "ancora"),
							"desc" => __("Select desired posts order", "ancora"),
							"dependency" => array(
								'custom' => array('yes')
							),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Post IDs list", "ancora"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
							"dependency" => array(
								'custom' => array('yes')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_tint" => array(
							"title" => __("Background tint", "ancora"),
							"desc" => __("Main background tint: dark or light", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Any background color for this section", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for the background", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "ancora"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "ancora"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "ancora"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_testimonials_item",
						"title" => __("Item", "ancora"),
						"desc" => __("Testimonials item", "ancora"),
						"container" => true,
						"params" => array(
							"author" => array(
								"title" => __("Author", "ancora"),
								"desc" => __("Name of the testimonmials author", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"link" => array(
								"title" => __("Link", "ancora"),
								"desc" => __("Link URL to the testimonmials author page", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"email" => array(
								"title" => __("E-mail", "ancora"),
								"desc" => __("E-mail of the testimonmials author (to get gravatar)", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"photo" => array(
								"title" => __("Photo", "ancora"),
								"desc" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "ancora"),
								"value" => "",
								"type" => "media"
							),
							"_content_" => array(
								"title" => __("Testimonials text", "ancora"),
								"desc" => __("Current testimonials text", "ancora"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Title
				"trx_title" => array(
					"title" => __("Title", "ancora"),
					"desc" => __("Create header tag (1-6 level) with many styles", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Title content", "ancora"),
							"desc" => __("Title content", "ancora"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"type" => array(
							"title" => __("Title type", "ancora"),
							"desc" => __("Title type (header level)", "ancora"),
							"divider" => true,
							"value" => "1",
							"type" => "select",
							"options" => array(
								'1' => __('Header 1', 'ancora'),
								'2' => __('Header 2', 'ancora'),
								'3' => __('Header 3', 'ancora'),
								'4' => __('Header 4', 'ancora'),
								'5' => __('Header 5', 'ancora'),
								'6' => __('Header 6', 'ancora'),
							)
						),
						"style" => array(
							"title" => __("Title style", "ancora"),
							"desc" => __("Title style", "ancora"),
							"value" => "regular",
							"type" => "select",
							"options" => array(
								'regular' => __('Regular', 'ancora'),
								'underline' => __('Underline', 'ancora'),
								'divider' => __('Divider', 'ancora'),
								'iconed' => __('With icon (image)', 'ancora')
							)
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Title text alignment", "ancora"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						), 
						"font_size" => array(
							"title" => __("Font_size", "ancora"),
							"desc" => __("Custom font size. If empty - use theme default", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"font_weight" => array(
							"title" => __("Font weight", "ancora"),
							"desc" => __("Custom font weight. If empty or inherit - use theme default", "ancora"),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'inherit' => __('Default', 'ancora'),
								'100' => __('Thin (100)', 'ancora'),
								'300' => __('Light (300)', 'ancora'),
								'400' => __('Normal (400)', 'ancora'),
								'600' => __('Semibold (600)', 'ancora'),
								'700' => __('Bold (700)', 'ancora'),
								'900' => __('Black (900)', 'ancora')
							)
						),
                        "fig_border" => array(
                            "title" => __("Figure botoom border", "ancora"),
                            "desc" => __("Apply a figure botoom border", "ancora"),
                            "value" => "",
                            "type" => "checklist",
                            "options" => array('No' => '', 'Yes' => 'fig_border'),
                        ),
                        "color" => array(
							"title" => __("Title color", "ancora"),
							"desc" => __("Select color for the title", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"icon" => array(
							"title" => __('Title font icon',  'ancora'),
							"desc" => __("Select font icon for the title from Fontello icons set (if style=iconed)",  'ancora'),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"image" => array(
							"title" => __('or image icon',  'ancora'),
							"desc" => __("Select image icon for the title instead icon above (if style=iconed)",  'ancora'),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "",
							"type" => "images",
							"size" => "small",
							"options" => $ANCORA_GLOBALS['sc_params']['images']
						),
						"picture" => array(
							"title" => __('or URL for image file', "ancora"),
							"desc" => __("Select or upload image or write URL from other site (if style=iconed)", "ancora"),
							"dependency" => array(
								'style' => array('iconed')
							),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"image_size" => array(
							"title" => __('Image (picture) size', "ancora"),
							"desc" => __("Select image (picture) size (if style='iconed')", "ancora"),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "small",
							"type" => "checklist",
							"options" => array(
								'small' => __('Small', 'ancora'),
								'medium' => __('Medium', 'ancora'),
								'large' => __('Large', 'ancora')
							)
						),
						"position" => array(
							"title" => __('Icon (image) position', "ancora"),
							"desc" => __("Select icon (image) position (if style=iconed)", "ancora"),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "left",
							"type" => "checklist",
							"options" => array(
								'top' => __('Top', 'ancora'),
								'left' => __('Left', 'ancora')
							)
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Toggles
				"trx_toggles" => array(
					"title" => __("Toggles", "ancora"),
					"desc" => __("Toggles items", "ancora"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Toggles style", "ancora"),
							"desc" => __("Select style for display toggles", "ancora"),
							"value" => 1,
							"options" => array(
								1 => __('Style 1', 'ancora'),
								2 => __('Style 2', 'ancora')
							),
							"type" => "radio"
						),
						"counter" => array(
							"title" => __("Counter", "ancora"),
							"desc" => __("Display counter before each toggles title", "ancora"),
							"value" => "off",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['on_off']
						),
						"icon_closed" => array(
							"title" => __("Icon while closed",  'ancora'),
							"desc" => __('Select icon for the closed toggles item from Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"icon_opened" => array(
							"title" => __("Icon while opened",  'ancora'),
							"desc" => __('Select icon for the opened toggles item from Fontello icons set',  'ancora'),
							"value" => "",
							"type" => "icons",
							"options" => $ANCORA_GLOBALS['sc_params']['icons']
						),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_toggles_item",
						"title" => __("Toggles item", "ancora"),
						"desc" => __("Toggles item", "ancora"),
						"container" => true,
						"params" => array(
							"title" => array(
								"title" => __("Toggles item title", "ancora"),
								"desc" => __("Title for current toggles item", "ancora"),
								"value" => "",
								"type" => "text"
							),
							"open" => array(
								"title" => __("Open on show", "ancora"),
								"desc" => __("Open current toggles item on show", "ancora"),
								"value" => "no",
								"type" => "switch",
								"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
							),
							"icon_closed" => array(
								"title" => __("Icon while closed",  'ancora'),
								"desc" => __('Select icon for the closed toggles item from Fontello icons set',  'ancora'),
								"value" => "",
								"type" => "icons",
								"options" => $ANCORA_GLOBALS['sc_params']['icons']
							),
							"icon_opened" => array(
								"title" => __("Icon while opened",  'ancora'),
								"desc" => __('Select icon for the opened toggles item from Fontello icons set',  'ancora'),
								"value" => "",
								"type" => "icons",
								"options" => $ANCORA_GLOBALS['sc_params']['icons']
							),
							"_content_" => array(
								"title" => __("Toggles item content", "ancora"),
								"desc" => __("Current toggles item content", "ancora"),
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $ANCORA_GLOBALS['sc_params']['id'],
							"class" => $ANCORA_GLOBALS['sc_params']['class'],
							"css" => $ANCORA_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
			
				// Tooltip
				"trx_tooltip" => array(
					"title" => __("Tooltip", "ancora"),
					"desc" => __("Create tooltip for selected text", "ancora"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"title" => array(
							"title" => __("Title", "ancora"),
							"desc" => __("Tooltip title (required)", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Tipped content", "ancora"),
							"desc" => __("Highlighted content with tooltip", "ancora"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),



//                // Testim
//                "trx_testim" => array(
//                    "title" => __("Testim", "ancora"),
//                    "desc" => __("Create testim for selected text", "ancora"),
//                    "decorate" => false,
//                    "container" => true,
//                    "params" => array(
//                        "title" => array(
//                            "title" => __("Title", "ancora"),
//                            "desc" => __("Testim title (required)", "ancora"),
//                            "value" => "",
//                            "type" => "text"
//                        ),
//                        "_content_" => array(
//                            "title" => __("Tipped content", "ancora"),
//                            "desc" => __("Highlighted content with tooltip", "ancora"),
//                            "divider" => true,
//                            "rows" => 4,
//                            "value" => "",
//                            "type" => "textarea"
//                        ),
//                        "id" => $ANCORA_GLOBALS['sc_params']['id'],
//                        "class" => $ANCORA_GLOBALS['sc_params']['class'],
//                        "css" => $ANCORA_GLOBALS['sc_params']['css']
//                    )
//                ),
			
			
				// Twitter
				"trx_twitter" => array(
					"title" => __("Twitter", "ancora"),
					"desc" => __("Insert twitter feed into post (page)", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"user" => array(
							"title" => __("Twitter Username", "ancora"),
							"desc" => __("Your username in the twitter account. If empty - get it from Theme Options.", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"consumer_key" => array(
							"title" => __("Consumer Key", "ancora"),
							"desc" => __("Consumer Key from the twitter account", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"consumer_secret" => array(
							"title" => __("Consumer Secret", "ancora"),
							"desc" => __("Consumer Secret from the twitter account", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"token_key" => array(
							"title" => __("Token Key", "ancora"),
							"desc" => __("Token Key from the twitter account", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"token_secret" => array(
							"title" => __("Token Secret", "ancora"),
							"desc" => __("Token Secret from the twitter account", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"count" => array(
							"title" => __("Tweets number", "ancora"),
							"desc" => __("Tweets number to show", "ancora"),
							"divider" => true,
							"value" => 3,
							"max" => 20,
							"min" => 1,
							"type" => "spinner"
						),
						"controls" => array(
							"title" => __("Show arrows", "ancora"),
							"desc" => __("Show control buttons", "ancora"),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"interval" => array(
							"title" => __("Tweets change interval", "ancora"),
							"desc" => __("Tweets change interval (in milliseconds: 1000ms = 1s)", "ancora"),
							"value" => 7000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"align" => array(
							"title" => __("Alignment", "ancora"),
							"desc" => __("Alignment of the tweets block", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"autoheight" => array(
							"title" => __("Autoheight", "ancora"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "ancora"),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						),
						"bg_tint" => array(
							"title" => __("Background tint", "ancora"),
							"desc" => __("Main background tint: dark or light", "ancora"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"options" => $ANCORA_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "ancora"),
							"desc" => __("Any background color for this section", "ancora"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for the background", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "ancora"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "ancora"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "ancora"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
				// Video
				"trx_video" => array(
					"title" => __("Video", "ancora"),
					"desc" => __("Insert video player", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"url" => array(
							"title" => __("URL for video file", "ancora"),
							"desc" => __("Select video from media library or paste URL for video file from other site", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media",
							"before" => array(
								'title' => __('Choose video', 'ancora'),
								'action' => 'media_upload',
								'type' => 'video',
								'multiple' => false,
								'linked_field' => '',
								'captions' => array( 	
									'choose' => __('Choose video file', 'ancora'),
									'update' => __('Select video file', 'ancora')
								)
							),
							"after" => array(
								'icon' => 'icon-cancel',
								'action' => 'media_reset'
							)
						),
						"ratio" => array(
							"title" => __("Ratio", "ancora"),
							"desc" => __("Ratio of the video", "ancora"),
							"value" => "16:9",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								"16:9" => __("16:9", 'ancora'),
								"4:3" => __("4:3", 'ancora')
							)
						),
						"autoplay" => array(
							"title" => __("Autoplay video", "ancora"),
							"desc" => __("Autoplay video on page load", "ancora"),
							"value" => "off",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['on_off']
						),
						"align" => array(
							"title" => __("Align", "ancora"),
							"desc" => __("Select block alignment", "ancora"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['align']
						),
						"image" => array(
							"title" => __("Cover image", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for video preview", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_image" => array(
							"title" => __("Background image", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for video background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", "ancora"),
							"divider" => true,
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_top" => array(
							"title" => __("Top offset", "ancora"),
							"desc" => __("Top offset (padding) inside background image to video block (in percent). For example: 3%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_bottom" => array(
							"title" => __("Bottom offset", "ancora"),
							"desc" => __("Bottom offset (padding) inside background image to video block (in percent). For example: 3%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_left" => array(
							"title" => __("Left offset", "ancora"),
							"desc" => __("Left offset (padding) inside background image to video block (in percent). For example: 20%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_right" => array(
							"title" => __("Right offset", "ancora"),
							"desc" => __("Right offset (padding) inside background image to video block (in percent). For example: 12%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Zoom
				"trx_zoom" => array(
					"title" => __("Zoom", "ancora"),
					"desc" => __("Insert the image with zoom/lens effect", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"effect" => array(
							"title" => __("Effect", "ancora"),
							"desc" => __("Select effect to display overlapping image", "ancora"),
							"value" => "lens",
							"size" => "medium",
							"type" => "switch",
							"options" => array(
								"lens" => __('Lens', 'ancora'),
								"zoom" => __('Zoom', 'ancora')
							)
						),
						"url" => array(
							"title" => __("Main image", "ancora"),
							"desc" => __("Select or upload main image", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"over" => array(
							"title" => __("Overlaping image", "ancora"),
							"desc" => __("Select or upload overlaping image", "ancora"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"align" => array(
							"title" => __("Float zoom", "ancora"),
							"desc" => __("Float zoom to left or right side", "ancora"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $ANCORA_GLOBALS['sc_params']['float']
						), 
						"bg_image" => array(
							"title" => __("Background image", "ancora"),
							"desc" => __("Select or upload image or write URL from other site for zoom block background. Attention! If you use background image - specify paddings below from background margins to zoom block in percents!", "ancora"),
							"divider" => true,
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_top" => array(
							"title" => __("Top offset", "ancora"),
							"desc" => __("Top offset (padding) inside background image to zoom block (in percent). For example: 3%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_bottom" => array(
							"title" => __("Bottom offset", "ancora"),
							"desc" => __("Bottom offset (padding) inside background image to zoom block (in percent). For example: 3%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_left" => array(
							"title" => __("Left offset", "ancora"),
							"desc" => __("Left offset (padding) inside background image to zoom block (in percent). For example: 20%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_right" => array(
							"title" => __("Right offset", "ancora"),
							"desc" => __("Right offset (padding) inside background image to zoom block (in percent). For example: 12%", "ancora"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"width" => ancora_shortcodes_width(),
						"height" => ancora_shortcodes_height(),
						"top" => $ANCORA_GLOBALS['sc_params']['top'],
						"bottom" => $ANCORA_GLOBALS['sc_params']['bottom'],
						"left" => $ANCORA_GLOBALS['sc_params']['left'],
						"right" => $ANCORA_GLOBALS['sc_params']['right'],
						"id" => $ANCORA_GLOBALS['sc_params']['id'],
						"class" => $ANCORA_GLOBALS['sc_params']['class'],
						"animation" => $ANCORA_GLOBALS['sc_params']['animation'],
						"css" => $ANCORA_GLOBALS['sc_params']['css']
					)
				)
			);
	
			// Woocommerce Shortcodes list
			//------------------------------------------------------------------
			if (ancora_exists_woocommerce()) {
				
				// WooCommerce - Cart
				$ANCORA_GLOBALS['shortcodes']["woocommerce_cart"] = array(
					"title" => __("Woocommerce: Cart", "ancora"),
					"desc" => __("WooCommerce shortcode: show Cart page", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Checkout
				$ANCORA_GLOBALS['shortcodes']["woocommerce_checkout"] = array(
					"title" => __("Woocommerce: Checkout", "ancora"),
					"desc" => __("WooCommerce shortcode: show Checkout page", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - My Account
				$ANCORA_GLOBALS['shortcodes']["woocommerce_my_account"] = array(
					"title" => __("Woocommerce: My Account", "ancora"),
					"desc" => __("WooCommerce shortcode: show My Account page", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Order Tracking
				$ANCORA_GLOBALS['shortcodes']["woocommerce_order_tracking"] = array(
					"title" => __("Woocommerce: Order Tracking", "ancora"),
					"desc" => __("WooCommerce shortcode: show Order Tracking page", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Shop Messages
				$ANCORA_GLOBALS['shortcodes']["shop_messages"] = array(
					"title" => __("Woocommerce: Shop Messages", "ancora"),
					"desc" => __("WooCommerce shortcode: show shop messages", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Product Page
				$ANCORA_GLOBALS['shortcodes']["product_page"] = array(
					"title" => __("Woocommerce: Product Page", "ancora"),
					"desc" => __("WooCommerce shortcode: display single product page", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"sku" => array(
							"title" => __("SKU", "ancora"),
							"desc" => __("SKU code of displayed product", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"id" => array(
							"title" => __("ID", "ancora"),
							"desc" => __("ID of displayed product", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"posts_per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => "1",
							"min" => 1,
							"type" => "spinner"
						),
						"post_type" => array(
							"title" => __("Post type", "ancora"),
							"desc" => __("Post type for the WP query (leave 'product')", "ancora"),
							"value" => "product",
							"type" => "text"
						),
						"post_status" => array(
							"title" => __("Post status", "ancora"),
							"desc" => __("Display posts only with this status", "ancora"),
							"value" => "publish",
							"type" => "select",
							"options" => array(
								"publish" => __('Publish', 'ancora'),
								"protected" => __('Protected', 'ancora'),
								"private" => __('Private', 'ancora'),
								"pending" => __('Pending', 'ancora'),
								"draft" => __('Draft', 'ancora')
							)
						)
					)
				);
				
				// WooCommerce - Product
				$ANCORA_GLOBALS['shortcodes']["product"] = array(
					"title" => __("Woocommerce: Product", "ancora"),
					"desc" => __("WooCommerce shortcode: display one product", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"sku" => array(
							"title" => __("SKU", "ancora"),
							"desc" => __("SKU code of displayed product", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"id" => array(
							"title" => __("ID", "ancora"),
							"desc" => __("ID of displayed product", "ancora"),
							"value" => "",
							"type" => "text"
						)
					)
				);
				
				// WooCommerce - Best Selling Products
				$ANCORA_GLOBALS['shortcodes']["best_selling_products"] = array(
					"title" => __("Woocommerce: Best Selling Products", "ancora"),
					"desc" => __("WooCommerce shortcode: show best selling products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						)
					)
				);
				
				// WooCommerce - Recent Products
				$ANCORA_GLOBALS['shortcodes']["recent_products"] = array(
					"title" => __("Woocommerce: Recent Products", "ancora"),
					"desc" => __("WooCommerce shortcode: show recent products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Related Products
				$ANCORA_GLOBALS['shortcodes']["related_products"] = array(
					"title" => __("Woocommerce: Related Products", "ancora"),
					"desc" => __("WooCommerce shortcode: show related products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"posts_per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						)
					)
				);
				
				// WooCommerce - Featured Products
				$ANCORA_GLOBALS['shortcodes']["featured_products"] = array(
					"title" => __("Woocommerce: Featured Products", "ancora"),
					"desc" => __("WooCommerce shortcode: show featured products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Top Rated Products
				$ANCORA_GLOBALS['shortcodes']["featured_products"] = array(
					"title" => __("Woocommerce: Top Rated Products", "ancora"),
					"desc" => __("WooCommerce shortcode: show top rated products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Sale Products
				$ANCORA_GLOBALS['shortcodes']["featured_products"] = array(
					"title" => __("Woocommerce: Sale Products", "ancora"),
					"desc" => __("WooCommerce shortcode: list products on sale", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Product Category
				$ANCORA_GLOBALS['shortcodes']["product_category"] = array(
					"title" => __("Woocommerce: Products from category", "ancora"),
					"desc" => __("WooCommerce shortcode: list products in specified category(-ies)", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"category" => array(
							"title" => __("Categories", "ancora"),
							"desc" => __("Comma separated category slugs", "ancora"),
							"value" => '',
							"type" => "text"
						),
						"operator" => array(
							"title" => __("Operator", "ancora"),
							"desc" => __("Categories operator", "ancora"),
							"value" => "IN",
							"type" => "checklist",
							"size" => "medium",
							"options" => array(
								"IN" => __('IN', 'ancora'),
								"NOT IN" => __('NOT IN', 'ancora'),
								"AND" => __('AND', 'ancora')
							)
						)
					)
				);
				
				// WooCommerce - Products
				$ANCORA_GLOBALS['shortcodes']["products"] = array(
					"title" => __("Woocommerce: Products", "ancora"),
					"desc" => __("WooCommerce shortcode: list all products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"skus" => array(
							"title" => __("SKUs", "ancora"),
							"desc" => __("Comma separated SKU codes of products", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"ids" => array(
							"title" => __("IDs", "ancora"),
							"desc" => __("Comma separated ID of products", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Product attribute
				$ANCORA_GLOBALS['shortcodes']["product_attribute"] = array(
					"title" => __("Woocommerce: Products by Attribute", "ancora"),
					"desc" => __("WooCommerce shortcode: show products with specified attribute", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many products showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for products output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"attribute" => array(
							"title" => __("Attribute", "ancora"),
							"desc" => __("Attribute name", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"filter" => array(
							"title" => __("Filter", "ancora"),
							"desc" => __("Attribute value", "ancora"),
							"value" => "",
							"type" => "text"
						)
					)
				);
				
				// WooCommerce - Products Categories
				$ANCORA_GLOBALS['shortcodes']["product_categories"] = array(
					"title" => __("Woocommerce: Product Categories", "ancora"),
					"desc" => __("WooCommerce shortcode: show categories with products", "ancora"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"number" => array(
							"title" => __("Number", "ancora"),
							"desc" => __("How many categories showed", "ancora"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "ancora"),
							"desc" => __("How many columns per row use for categories output", "ancora"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'ancora'),
								"title" => __('Title', 'ancora')
							)
						),
						"order" => array(
							"title" => __("Order", "ancora"),
							"desc" => __("Sorting order for products output", "ancora"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $ANCORA_GLOBALS['sc_params']['ordering']
						),
						"parent" => array(
							"title" => __("Parent", "ancora"),
							"desc" => __("Parent category slug", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"ids" => array(
							"title" => __("IDs", "ancora"),
							"desc" => __("Comma separated ID of products", "ancora"),
							"value" => "",
							"type" => "text"
						),
						"hide_empty" => array(
							"title" => __("Hide empty", "ancora"),
							"desc" => __("Hide empty categories", "ancora"),
							"value" => "yes",
							"type" => "switch",
							"options" => $ANCORA_GLOBALS['sc_params']['yes_no']
						)
					)
				);

			}
			
			do_action('ancora_action_shortcodes_list');

		}
	}
}
?>