<?php

// Width and height params
if ( !function_exists( 'ancora_vc_width' ) ) {
	function ancora_vc_width($w='') {
		return array(
			"param_name" => "width",
			"heading" => __("Width", "ancora"),
			"description" => __("Width (in pixels or percent) of the current element", "ancora"),
			"group" => __('Size &amp; Margins', 'ancora'),
			"value" => $w,
			"type" => "textfield"
		);
	}
}
if ( !function_exists( 'ancora_vc_height' ) ) {
	function ancora_vc_height($h='') {
		return array(
			"param_name" => "height",
			"heading" => __("Height", "ancora"),
			"description" => __("Height (only in pixels) of the current element", "ancora"),
			"group" => __('Size &amp; Margins', 'ancora'),
			"value" => $h,
			"type" => "textfield"
		);
	}
}

// Load scripts and styles for VC support
if ( !function_exists( 'ancora_shortcodes_vc_scripts_admin' ) ) {
	//add_action( 'admin_enqueue_scripts', 'ancora_shortcodes_vc_scripts_admin' );
	function ancora_shortcodes_vc_scripts_admin() {
		// Include CSS 
		ancora_enqueue_style ( 'shortcodes_vc-style', ancora_get_file_url('shortcodes/shortcodes_vc_admin.css'), array(), null );
		// Include JS
		ancora_enqueue_script( 'shortcodes_vc-script', ancora_get_file_url('shortcodes/shortcodes_vc_admin.js'), array(), null, true );
	}
}

// Load scripts and styles for VC support
if ( !function_exists( 'ancora_shortcodes_vc_scripts_front' ) ) {
	//add_action( 'wp_enqueue_scripts', 'ancora_shortcodes_vc_scripts_front' );
	function ancora_shortcodes_vc_scripts_front() {
		if (ancora_vc_is_frontend()) {
			// Include CSS 
			ancora_enqueue_style ( 'shortcodes_vc-style', ancora_get_file_url('shortcodes/shortcodes_vc_front.css'), array(), null );
			// Include JS
			ancora_enqueue_script( 'shortcodes_vc-script', ancora_get_file_url('shortcodes/shortcodes_vc_front.js'), array(), null, true );
		}
	}
}

// Add init script into shortcodes output in VC frontend editor
if ( !function_exists( 'ancora_shortcodes_vc_add_init_script' ) ) {
	//add_filter('ancora_shortcode_output', 'ancora_shortcodes_vc_add_init_script', 10, 4);
	function ancora_shortcodes_vc_add_init_script($output, $tag='', $atts=array(), $content='') {
		if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') && (isset($_POST['action']) && $_POST['action']=='vc_load_shortcode')
				&& ( isset($_POST['shortcodes'][0]['tag']) && $_POST['shortcodes'][0]['tag']==$tag )
		) {
			if (ancora_strpos($output, 'ancora_vc_init_shortcodes')===false) {
				$id = "ancora_vc_init_shortcodes_".str_replace('.', '', mt_rand());
				$output .= '
					<script id="'.esc_attr($id).'">
						try {
							ancora_init_post_formats();
							ancora_init_shortcodes(jQuery("body").eq(0));
							ancora_scroll_actions();
						} catch (e) { };
					</script>
				';
			}
		}
		return $output;
	}
}


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'ancora_shortcodes_vc_theme_setup' ) ) {
	//if ( ancora_vc_is_frontend() )
	if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline') )
		add_action( 'ancora_action_before_init_theme', 'ancora_shortcodes_vc_theme_setup', 20 );
	else
		add_action( 'ancora_action_after_init_theme', 'ancora_shortcodes_vc_theme_setup' );
	function ancora_shortcodes_vc_theme_setup() {
		if (ancora_shortcodes_is_used()) {
			// Set VC as main editor for the theme
			vc_set_as_theme( true );
			
			// Enable VC on follow post types
			vc_set_default_editor_post_types( array('page', 'team', 'courses') );
			
			// Disable frontend editor
			//vc_disable_frontend();

			// Load scripts and styles for VC support
			add_action( 'wp_enqueue_scripts',		'ancora_shortcodes_vc_scripts_front');
			add_action( 'admin_enqueue_scripts',	'ancora_shortcodes_vc_scripts_admin' );

			// Add init script into shortcodes output in VC frontend editor
			add_filter('ancora_shortcode_output', 'ancora_shortcodes_vc_add_init_script', 10, 4);

			// Remove standard VC shortcodes
			vc_remove_element("vc_button");
			vc_remove_element("vc_posts_slider");
			vc_remove_element("vc_gmaps");
			vc_remove_element("vc_teaser_grid");
			vc_remove_element("vc_progress_bar");
			vc_remove_element("vc_facebook");
			vc_remove_element("vc_tweetmeme");
			vc_remove_element("vc_googleplus");
			vc_remove_element("vc_facebook");
			vc_remove_element("vc_pinterest");
			vc_remove_element("vc_message");
			vc_remove_element("vc_posts_grid");
			vc_remove_element("vc_carousel");
			vc_remove_element("vc_flickr");
			vc_remove_element("vc_tour");
			vc_remove_element("vc_separator");
			vc_remove_element("vc_single_image");
			vc_remove_element("vc_cta_button");
//			vc_remove_element("vc_accordion");
//			vc_remove_element("vc_accordion_tab");
			vc_remove_element("vc_toggle");
			vc_remove_element("vc_tabs");
			vc_remove_element("vc_tab");
			vc_remove_element("vc_images_carousel");
			
			// Remove standard WP widgets
			vc_remove_element("vc_wp_archives");
			vc_remove_element("vc_wp_calendar");
			vc_remove_element("vc_wp_categories");
			vc_remove_element("vc_wp_custommenu");
			vc_remove_element("vc_wp_links");
			vc_remove_element("vc_wp_meta");
			vc_remove_element("vc_wp_pages");
			vc_remove_element("vc_wp_posts");
			vc_remove_element("vc_wp_recentcomments");
			vc_remove_element("vc_wp_rss");
			vc_remove_element("vc_wp_search");
			vc_remove_element("vc_wp_tagcloud");
			vc_remove_element("vc_wp_text");
			
			global $ANCORA_GLOBALS;
			
			$ANCORA_GLOBALS['vc_params'] = array(
				
				// Common arrays and strings
				'category' => __("Ancora shortcodes", "ancora"),
			
				// Current element id
				'id' => array(
					"param_name" => "id",
					"heading" => __("Element ID", "ancora"),
					"description" => __("ID for current element", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"value" => "",
					"type" => "textfield"
				),
			
				// Current element class
				'class' => array(
					"param_name" => "class",
					"heading" => __("Element CSS class", "ancora"),
					"description" => __("CSS class for current element", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"value" => "",
					"type" => "textfield"
				),

				// Current element animation
				'animation' => array(
					"param_name" => "animation",
					"heading" => __("Animation", "ancora"),
					"description" => __("Select animation while object enter in the visible area of page", "ancora"),
					"class" => "",
					"value" => array_flip($ANCORA_GLOBALS['sc_params']['animations']),
					"type" => "dropdown"
				),
			
				// Current element style
				'css' => array(
					"param_name" => "css",
					"heading" => __("CSS styles", "ancora"),
					"description" => __("Any additional CSS rules (if need)", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
			
				// Margins params
				'margin_top' => array(
					"param_name" => "top",
					"heading" => __("Top margin", "ancora"),
					"description" => __("Top margin (in pixels).", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"value" => "",
					"type" => "textfield"
				),
			
				'margin_bottom' => array(
					"param_name" => "bottom",
					"heading" => __("Bottom margin", "ancora"),
					"description" => __("Bottom margin (in pixels).", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"value" => "",
					"type" => "textfield"
				),
			
				'margin_left' => array(
					"param_name" => "left",
					"heading" => __("Left margin", "ancora"),
					"description" => __("Left margin (in pixels).", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"value" => "",
					"type" => "textfield"
				),
				
				'margin_right' => array(
					"param_name" => "right",
					"heading" => __("Right margin", "ancora"),
					"description" => __("Right margin (in pixels).", "ancora"),
					"group" => __('Size &amp; Margins', 'ancora'),
					"value" => "",
					"type" => "textfield"
				)
			);
	
	
	
			// Accordion
			//-------------------------------------------------------------------------------------
			vc_map( array(
				"base" => "trx_accordion",
				"name" => __("Accordion", "ancora"),
				"description" => __("Accordion items", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_accordion',
				"class" => "trx_sc_collection trx_sc_accordion",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => false,
				"as_parent" => array('only' => 'trx_accordion_item'),	// Use only|except attributes to limit child shortcodes (separate multiple values with comma)
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Accordion style", "ancora"),
						"description" => __("Select style for display accordion", "ancora"),
						"class" => "",
						"admin_label" => true,
						"value" => array(
							__('Style 1', 'ancora') => 1,
							__('Style 2', 'ancora') => 2
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "counter",
						"heading" => __("Counter", "ancora"),
						"description" => __("Display counter before each accordion title", "ancora"),
						"class" => "",
						"value" => array("Add item numbers before each element" => "on" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "initial",
						"heading" => __("Initially opened item", "ancora"),
						"description" => __("Number of initially opened item", "ancora"),
						"class" => "",
						"value" => 1,
						"type" => "textfield"
					),
					array(
						"param_name" => "icon_closed",
						"heading" => __("Icon while closed", "ancora"),
						"description" => __("Select icon for the closed accordion item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon_opened",
						"heading" => __("Icon while opened", "ancora"),
						"description" => __("Select icon for the opened accordion item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'default_content' => '
					[trx_accordion_item title="' . __( 'Item 1 title', 'ancora' ) . '"][/trx_accordion_item]
					[trx_accordion_item title="' . __( 'Item 2 title', 'ancora' ) . '"][/trx_accordion_item]
				',
				"custom_markup" => '
					<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
						%content%
					</div>
					<div class="tab_controls">
						<button class="add_tab" title="'.__("Add item", "ancora").'">'.__("Add item", "ancora").'</button>
					</div>
				',
				'js_view' => 'VcTrxAccordionView'
			) );
			
			
			vc_map( array(
				"base" => "trx_accordion_item",
				"name" => __("Accordion item", "ancora"),
				"description" => __("Inner accordion item", "ancora"),
				"show_settings_on_create" => true,
				"content_element" => true,
				"is_container" => true,
				'icon' => 'icon_trx_accordion_item',
				"as_child" => array('only' => 'trx_accordion'), 	// Use only|except attributes to limit parent (separate multiple values with comma)
				"as_parent" => array('except' => 'trx_accordion'),
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title for current accordion item", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "icon_closed",
						"heading" => __("Icon while closed", "ancora"),
						"description" => __("Select icon for the closed accordion item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon_opened",
						"heading" => __("Icon while opened", "ancora"),
						"description" => __("Select icon for the opened accordion item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
			  'js_view' => 'VcTrxAccordionTabView'
			) );

			class WPBakeryShortCode_Trx_Accordion extends ANCORA_VC_ShortCodeAccordion {}
			class WPBakeryShortCode_Trx_Accordion_Item extends ANCORA_VC_ShortCodeAccordionItem {}
			
			
			
			
			
			
			// Anchor
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_anchor",
				"name" => __("Anchor", "ancora"),
				"description" => __("Insert anchor for the TOC (table of content)", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_anchor',
				"class" => "trx_sc_single trx_sc_anchor",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "icon",
						"heading" => __("Anchor's icon", "ancora"),
						"description" => __("Select icon for the anchor from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "title",
						"heading" => __("Short title", "ancora"),
						"description" => __("Short title of the anchor (for the table of content)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => __("Long description", "ancora"),
						"description" => __("Description for the popup (then hover on the icon). You can use '{' and '}' - make the text italic, '|' - insert line break", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "url",
						"heading" => __("External URL", "ancora"),
						"description" => __("External URL for this TOC item", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "separator",
						"heading" => __("Add separator", "ancora"),
						"description" => __("Add separator under item in the TOC", "ancora"),
						"class" => "",
						"value" => array("Add separator" => "yes" ),
						"type" => "checkbox"
					),
					$ANCORA_GLOBALS['vc_params']['id']
				),
			) );
			
			class WPBakeryShortCode_Trx_Anchor extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			// Audio
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_audio",
				"name" => __("Audio", "ancora"),
				"description" => __("Insert audio player", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_audio',
				"class" => "trx_sc_single trx_sc_audio",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
                    array(
                        "param_name" => "style",
                        "heading" => __("Style", "ancora"),
                        "description" => __("Select style", "ancora"),
                        "class" => "",
                        "value" => array('Normal' => 'audio_normal', 'Dark' => 'audio_dark' ),
                        "type" => "dropdown"
                    ),
					array(
						"param_name" => "url",
						"heading" => __("URL for audio file", "ancora"),
						"description" => __("Put here URL for audio file", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "image",
						"heading" => __("Cover image", "ancora"),
						"description" => __("Select or upload image or write URL from other site for audio cover", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title of the audio file", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "author",
						"heading" => __("Author", "ancora"),
						"description" => __("Author of the audio file", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "controls",
						"heading" => __("Controls", "ancora"),
						"description" => __("Show/hide controls", "ancora"),
						"class" => "",
						"value" => array("Hide controls" => "hide" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "autoplay",
						"heading" => __("Autoplay", "ancora"),
						"description" => __("Autoplay audio on page load", "ancora"),
						"class" => "",
						"value" => array("Autoplay" => "on" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Select block alignment", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
			) );
			
			class WPBakeryShortCode_Trx_Audio extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Block
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_block",
				"name" => __("Block container", "ancora"),
				"description" => __("Container for any block ([section] analog - to enable nesting)", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_block',
				"class" => "trx_sc_collection trx_sc_block",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "dedicated",
						"heading" => __("Dedicated", "ancora"),
						"description" => __("Use this block as dedicated content - show it before post title on single page", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(__('Use as dedicated content', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Select block alignment", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns emulation", "ancora"),
						"description" => __("Select width for columns emulation", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['columns']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "pan",
						"heading" => __("Use pan effect", "ancora"),
						"description" => __("Use pan effect to show section content", "ancora"),
						"group" => __('Scroll', 'ancora'),
						"class" => "",
						"value" => array(__('Content scroller', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "scroll",
						"heading" => __("Use scroller", "ancora"),
						"description" => __("Use scroller to show section content", "ancora"),
						"group" => __('Scroll', 'ancora'),
						"admin_label" => true,
						"class" => "",
						"value" => array(__('Content scroller', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "scroll_dir",
						"heading" => __("Scroll direction", "ancora"),
						"description" => __("Scroll direction (if Use scroller = yes)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"group" => __('Scroll', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['dir']),
						'dependency' => array(
							'element' => 'scroll',
							'not_empty' => true
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "scroll_controls",
						"heading" => __("Scroll controls", "ancora"),
						"description" => __("Show scroll controls (if Use scroller = yes)", "ancora"),
						"class" => "",
						"group" => __('Scroll', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['dir']),
						'dependency' => array(
							'element' => 'scroll',
							'not_empty' => true
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Fore color", "ancora"),
						"description" => __("Any color for objects in this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_tint",
						"heading" => __("Background tint", "ancora"),
						"description" => __("Main background tint: dark or light", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['tint']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Any background color for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image URL", "ancora"),
						"description" => __("Select background image from library for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_overlay",
						"heading" => __("Overlay", "ancora"),
						"description" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_texture",
						"heading" => __("Texture", "ancora"),
						"description" => __("Texture style from 1 to 11. Empty or 0 - without texture.", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "font_size",
						"heading" => __("Font size", "ancora"),
						"description" => __("Font size of the text (default - in pixels, allows any CSS units of measure)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "font_weight",
						"heading" => __("Font weight", "ancora"),
						"description" => __("Font weight of the text", "ancora"),
						"class" => "",
						"value" => array(
							__('Default', 'ancora') => 'inherit',
							__('Thin (100)', 'ancora') => '100',
							__('Light (300)', 'ancora') => '300',
							__('Normal (400)', 'ancora') => '400',
							__('Bold (700)', 'ancora') => '700'
						),
						"type" => "dropdown"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Container content", "ancora"),
//						"description" => __("Content for section container", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Block extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			// Blogger
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_blogger",
				"name" => __("Blogger", "ancora"),
				"description" => __("Insert posts (pages) in many styles from desired categories or directly from ids", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_blogger',
				"class" => "trx_sc_single trx_sc_blogger",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Output style", "ancora"),
						"description" => __("Select desired style for posts output", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['blogger_styles']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "filters",
						"heading" => __("Show filters", "ancora"),
						"description" => __("Use post's tags or categories as filter buttons", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['filters']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "hover",
						"heading" => __("Hover effect", "ancora"),
						"description" => __("Select hover effect (only if style=Portfolio)", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['hovers']),
						'dependency' => array(
							'element' => 'style',
							'value' => array('portfolio_2','portfolio_3','portfolio_4','grid_2','grid_3','grid_4','square_2','square_3','square_4','courses_2','courses_3','courses_4')
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "hover_dir",
						"heading" => __("Hover direction", "ancora"),
						"description" => __("Select hover direction (only if style=Portfolio and hover=Circle|Square)", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['hovers_dir']),
						'dependency' => array(
							'element' => 'style',
							'value' => array('portfolio_2','portfolio_3','portfolio_4','grid_2','grid_3','grid_4','square_2','square_3','square_4','courses_2','courses_3','courses_4')
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "location",
						"heading" => __("Dedicated content location", "ancora"),
						"description" => __("Select position for dedicated content (only for style=excerpt)", "ancora"),
						"class" => "",
						'dependency' => array(
							'element' => 'style',
							'value' => array('excerpt')
						),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['locations']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "dir",
						"heading" => __("Posts direction", "ancora"),
						"description" => __("Display posts in horizontal or vertical direction", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['dir']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "rating",
						"heading" => __("Show rating stars", "ancora"),
						"description" => __("Show rating stars under post's header", "ancora"),
						"group" => __('Details', 'ancora'),
						"class" => "",
						"value" => array(__('Show rating', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "info",
						"heading" => __("Show post info block", "ancora"),
						"description" => __("Show post info block (author, date, tags, etc.)", "ancora"),
						"class" => "",
						"value" => array(__('Show info', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "descr",
						"heading" => __("Description length", "ancora"),
						"description" => __("How many characters are displayed from post excerpt? If 0 - don't show description", "ancora"),
						"group" => __('Details', 'ancora'),
						"class" => "",
						"value" => 0,
						"type" => "textfield"
					),
					array(
						"param_name" => "links",
						"heading" => __("Allow links to the post", "ancora"),
						"description" => __("Allow links to the post from each blogger item", "ancora"),
						"group" => __('Details', 'ancora'),
						"class" => "",
						"value" => array(__('Allow links', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "readmore",
						"heading" => __("More link text", "ancora"),
						"description" => __("Read more link text. If empty - show 'More', else - used as link text", "ancora"),
						"group" => __('Details', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "post_type",
						"heading" => __("Post type", "ancora"),
						"description" => __("Select post type to show", "ancora"),
						"group" => __('Query', 'ancora'),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['posts_types']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => __("Post IDs list", "ancora"),
						"description" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
						"group" => __('Query', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "cat",
						"heading" => __("Categories list", "ancora"),
						"description" => __("Put here comma separated category slugs or ids. If empty - show posts from any category or from IDs list", "ancora"),
						'dependency' => array(
							'element' => 'ids',
							'is_empty' => true
						),
						"group" => __('Query', 'ancora'),
						"class" => "",
						"value" => array_flip(ancora_array_merge(array(0 => __('- Select category -', 'ancora')), $ANCORA_GLOBALS['sc_params']['categories'])),
						"type" => "dropdown"
					),
					array(
						"param_name" => "count",
						"heading" => __("Total posts to show", "ancora"),
						"description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
						'dependency' => array(
							'element' => 'ids',
							'is_empty' => true
						),
						"admin_label" => true,
						"group" => __('Query', 'ancora'),
						"class" => "",
						"value" => 3,
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns number", "ancora"),
						"description" => __("How many columns used to display posts?", "ancora"),
						'dependency' => array(
							'element' => 'dir',
							'value' => 'horizontal'
						),
						"group" => __('Query', 'ancora'),
						"class" => "",
						"value" => 3,
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => __("Offset before select posts", "ancora"),
						"description" => __("Skip posts before select next part.", "ancora"),
						'dependency' => array(
							'element' => 'ids',
							'is_empty' => true
						),
						"group" => __('Query', 'ancora'),
						"class" => "",
						"value" => 0,
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => __("Post order by", "ancora"),
						"description" => __("Select desired posts sorting method", "ancora"),
						"class" => "",
						"group" => __('Query', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['sorting']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => __("Post order", "ancora"),
						"description" => __("Select desired posts order", "ancora"),
						"class" => "",
						"group" => __('Query', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "only",
						"heading" => __("Select posts only", "ancora"),
						"description" => __("Select posts only with reviews, videos, audios, thumbs or galleries", "ancora"),
						"class" => "",
						"group" => __('Query', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['formats']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "scroll",
						"heading" => __("Use scroller", "ancora"),
						"description" => __("Use scroller to show all posts", "ancora"),
						"group" => __('Scroll', 'ancora'),
						"class" => "",
						"value" => array(__('Use scroller', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "controls",
						"heading" => __("Show slider controls", "ancora"),
						"description" => __("Show arrows to control scroll slider", "ancora"),
						"group" => __('Scroll', 'ancora'),
						"class" => "",
						"value" => array(__('Show controls', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
			) );
			
			class WPBakeryShortCode_Trx_Blogger extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			// Br
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_br",
				"name" => __("Line break", "ancora"),
				"description" => __("Line break or Clear Floating", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_br',
				"class" => "trx_sc_single trx_sc_br",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "clear",
						"heading" => __("Clear floating", "ancora"),
						"description" => __("Select clear side (if need)", "ancora"),
						"class" => "",
						"value" => "",
						"value" => array(
							__('None', 'ancora') => 'none',
							__('Left', 'ancora') => 'left',
							__('Right', 'ancora') => 'right',
							__('Both', 'ancora') => 'both'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Trx_Br extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Button
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_button",
				"name" => __("Button", "ancora"),
				"description" => __("Button with link", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_button',
				"class" => "trx_sc_single trx_sc_button",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "content",
						"heading" => __("Caption", "ancora"),
						"description" => __("Button caption", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "type",
						"heading" => __("Button's shape", "ancora"),
						"description" => __("Select button's shape", "ancora"),
						"class" => "",
						"value" => array(
							__('Square', 'ancora') => 'square',
							__('Round', 'ancora') => 'round'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "style",
						"heading" => __("Button's style", "ancora"),
						"description" => __("Select button's style", "ancora"),
						"class" => "",
						"value" => array(
                            __('Dark', 'ancora') => 'dark',
                            __('Light', 'ancora') => 'light',
                            __('Global', 'ancora') => 'global'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "size",
						"heading" => __("Button's size", "ancora"),
						"description" => __("Select button's size", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Small', 'ancora') => 'mini',
							__('Medium', 'ancora') => 'medium',
							__('Large', 'ancora') => 'big'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon",
						"heading" => __("Button's icon", "ancora"),
						"description" => __("Select icon for the title from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_style",
						"heading" => __("Button's color scheme", "ancora"),
						"description" => __("Select button's color scheme", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['button_styles']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Button's text color", "ancora"),
						"description" => __("Any color for button's caption", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Button's backcolor", "ancora"),
						"description" => __("Any color for button's background", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "align",
						"heading" => __("Button's alignment", "ancora"),
						"description" => __("Align button to left, center or right", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link URL", "ancora"),
						"description" => __("URL for the link on button click", "ancora"),
						"class" => "",
						"group" => __('Link', 'ancora'),
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "target",
						"heading" => __("Link target", "ancora"),
						"description" => __("Target for the link on button click", "ancora"),
						"class" => "",
						"group" => __('Link', 'ancora'),
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "popup",
						"heading" => __("Open link in popup", "ancora"),
						"description" => __("Open link target in popup window", "ancora"),
						"class" => "",
						"group" => __('Link', 'ancora'),
						"value" => array(__('Open in popup', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "rel",
						"heading" => __("Rel attribute", "ancora"),
						"description" => __("Rel attribute for the button's link (if need", "ancora"),
						"class" => "",
						"group" => __('Link', 'ancora'),
						"value" => "",
						"type" => "textfield"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextView'
			) );
			
			class WPBakeryShortCode_Trx_Button extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Chat
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_chat",
				"name" => __("Chat", "ancora"),
				"description" => __("Chat message", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_chat',
				"class" => "trx_sc_container trx_sc_chat",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("Item title", "ancora"),
						"description" => __("Title for current chat item", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "photo",
						"heading" => __("Item photo", "ancora"),
						"description" => __("Select or upload image or write URL from other site for the item photo (avatar)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link URL", "ancora"),
						"description" => __("URL for the link on chat title click", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Chat item content", "ancora"),
//						"description" => __("Current chat item content", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			
			) );
			
			class WPBakeryShortCode_Trx_Chat extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			// Columns
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_columns",
				"name" => __("Columns", "ancora"),
				"description" => __("Insert columns with margins", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_columns',
				"class" => "trx_sc_columns",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => false,
				"as_parent" => array('only' => 'trx_column_item'),
				"params" => array(
					array(
						"param_name" => "count",
						"heading" => __("Columns count", "ancora"),
						"description" => __("Number of the columns in the container.", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "2",
						"type" => "textfield"
					),
					array(
						"param_name" => "fluid",
						"heading" => __("Fluid columns", "ancora"),
						"description" => __("To squeeze the columns when reducing the size of the window (fluid=yes) or to rebuild them (fluid=no)", "ancora"),
						"class" => "",
						"value" => array(__('Fluid columns', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'default_content' => '
					[trx_column_item][/trx_column_item]
					[trx_column_item][/trx_column_item]
				',
				'js_view' => 'VcTrxColumnsView'
			) );
			
			
			vc_map( array(
				"base" => "trx_column_item",
				"name" => __("Column", "ancora"),
				"description" => __("Column item", "ancora"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_collection trx_sc_column_item",
				"content_element" => true,
				"is_container" => true,
				'icon' => 'icon_trx_column_item',
				"as_child" => array('only' => 'trx_columns'),
				"as_parent" => array('except' => 'trx_columns'),
				"params" => array(
					array(
						"param_name" => "span",
						"heading" => __("Merge columns", "ancora"),
						"description" => __("Count merged columns from current", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Alignment text in the column", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Fore color", "ancora"),
						"description" => __("Any color for objects in this column", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Any background color for this column", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("URL for background image file", "ancora"),
						"description" => __("Select or upload image or write URL from other site for the background", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Column's content", "ancora"),
//						"description" => __("Content of the current column", "ancora"),
//						"class" => "",
//						"value" => "",
//						/*"holder" => "div",*/
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxColumnItemView'
			) );
			
			class WPBakeryShortCode_Trx_Columns extends ANCORA_VC_ShortCodeColumns {}
			class WPBakeryShortCode_Trx_Column_Item extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			
			// Contact form
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_contact_form",
				"name" => __("Contact form", "ancora"),
				"description" => __("Insert contact form", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_contact_form',
				"class" => "trx_sc_collection trx_sc_contact_form",
				"content_element" => true,
				"is_container" => true,
				"as_parent" => array('only' => 'trx_form_item'),
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "custom",
						"heading" => __("Custom", "ancora"),
						"description" => __("Use custom fields or create standard contact form (ignore info from 'Field' tabs)", "ancora"),
						"class" => "",
						"value" => array(__('Create custom form', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "action",
						"heading" => __("Action", "ancora"),
						"description" => __("Contact form action (URL to handle form data). If empty - use internal action", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Select form alignment", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title above contact form", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => __("Description (under the title)", "ancora"),
						"description" => __("Contact form description", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textarea_html"
					),
					ancora_vc_width(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			
			vc_map( array(
				"base" => "trx_form_item",
				"name" => __("Form item (custom field)", "ancora"),
				"description" => __("Custom field for the contact form", "ancora"),
				"class" => "trx_sc_item trx_sc_form_item",
				'icon' => 'icon_trx_form_item',
				"allowed_container_element" => 'vc_row',
				"show_settings_on_create" => true,
				"content_element" => true,
				"is_container" => false,
				"as_child" => array('only' => 'trx_contact_form'), // Use only|except attributes to limit parent (separate multiple values with comma)
				"params" => array(
					array(
						"param_name" => "type",
						"heading" => __("Type", "ancora"),
						"description" => __("Select type of the custom field", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['field_types']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "name",
						"heading" => __("Name", "ancora"),
						"description" => __("Name of the custom field", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "value",
						"heading" => __("Default value", "ancora"),
						"description" => __("Default value of the custom field", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "label",
						"heading" => __("Label", "ancora"),
						"description" => __("Label for the custom field", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "label_position",
						"heading" => __("Label position", "ancora"),
						"description" => __("Label position relative to the field", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['label_positions']),
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Contact_Form extends ANCORA_VC_ShortCodeCollection {}
			class WPBakeryShortCode_Trx_Form_Item extends ANCORA_VC_ShortCodeItem {}
			
			
			
			
			
			
			
			// Content block on fullscreen page
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_content",
				"name" => __("Content block", "ancora"),
				"description" => __("Container for main content block (use it only on fullscreen pages)", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_content',
				"class" => "trx_sc_collection trx_sc_content",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
//					array(
//						"param_name" => "content",
//						"heading" => __("Container content", "ancora"),
//						"description" => __("Content for section container", "ancora"),
//						"class" => "",
//						"value" => "",
//						/*"holder" => "div",*/
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Content extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			
			// Countdown
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_countdown",
				"name" => __("Countdown", "ancora"),
				"description" => __("Insert countdown object", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_countdown',
				"class" => "trx_sc_single trx_sc_countdown",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "date",
						"heading" => __("Date", "ancora"),
						"description" => __("Upcoming date (format: yyyy-mm-dd)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "time",
						"heading" => __("Time", "ancora"),
						"description" => __("Upcoming time (format: HH:mm:ss)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "style",
						"heading" => __("Style", "ancora"),
						"description" => __("Countdown style", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Style 1', 'ancora') => 1,
							__('Style 2', 'ancora') => 2
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Align counter to left, center or right", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Countdown extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Dropcaps
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_dropcaps",
				"name" => __("Dropcaps", "ancora"),
				"description" => __("Make first letter of the text as dropcaps", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_dropcaps',
				"class" => "trx_sc_container trx_sc_dropcaps",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Style", "ancora"),
						"description" => __("Dropcaps style", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Style 1', 'ancora') => 1,
							__('Style 2', 'ancora') => 2,
							__('Style 3', 'ancora') => 3,
							__('Style 4', 'ancora') => 4
						),
						"type" => "dropdown"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Paragraph text", "ancora"),
//						"description" => __("Paragraph with dropcaps content", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			
			) );
			
			class WPBakeryShortCode_Trx_Dropcaps extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			
			// Emailer
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_emailer",
				"name" => __("E-mail collector", "ancora"),
				"description" => __("Collect e-mails into specified group", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_emailer',
				"class" => "trx_sc_single trx_sc_emailer",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "group",
						"heading" => __("Group", "ancora"),
						"description" => __("The name of group to collect e-mail address", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "open",
						"heading" => __("Opened", "ancora"),
						"description" => __("Initially open the input field on show object", "ancora"),
						"class" => "",
						"value" => array(__('Initially opened', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Align field to left, center or right", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Emailer extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Gap
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_gap",
				"name" => __("Gap", "ancora"),
				"description" => __("Insert gap (fullwidth area) in the post content", "ancora"),
				"category" => __('Structure', 'js_composer'),
				'icon' => 'icon_trx_gap',
				"class" => "trx_sc_collection trx_sc_gap",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => false,
				"params" => array(
//					array(
//						"param_name" => "content",
//						"heading" => __("Gap content", "ancora"),
//						"description" => __("Gap inner content", "ancora"),
//						"class" => "",
//						"value" => "",
//						/*"holder" => "div",*/
//						"type" => "textarea_html"
//					)
				)
			) );
			
			class WPBakeryShortCode_Trx_Gap extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			
			// Googlemap
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_googlemap",
				"name" => __("Google map", "ancora"),
				"description" => __("Insert Google map with desired address or coordinates", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_googlemap',
				"class" => "trx_sc_single trx_sc_googlemap",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "address",
						"heading" => __("Address", "ancora"),
						"description" => __("Address to show in map center", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "latlng",
						"heading" => __("Latitude and Longtitude", "ancora"),
						"description" => __("Comma separated map center coorditanes (instead Address)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
                    array(
                        "param_name" => "description",
                        "heading" => __("Description", "ancora"),
                        "description" => __("Description", "ancora"),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
					array(
						"param_name" => "zoom",
						"heading" => __("Zoom", "ancora"),
						"description" => __("Map zoom factor", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "16",
						"type" => "textfield"
					),
					array(
						"param_name" => "style",
						"heading" => __("Style", "ancora"),
						"description" => __("Map custom style", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['googlemap_styles']),
						"type" => "dropdown"
					),
					ancora_vc_width('100%'),
					ancora_vc_height(240),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Googlemap extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Highlight
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_highlight",
				"name" => __("Highlight text", "ancora"),
				"description" => __("Highlight text with selected color, background color and other styles", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_highlight',
				"class" => "trx_sc_container trx_sc_highlight",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "type",
						"heading" => __("Type", "ancora"),
						"description" => __("Highlight type", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
								__('Custom', 'ancora') => 0,
								__('Type 1', 'ancora') => 1,
								__('Type 2', 'ancora') => 2,
								__('Type 3', 'ancora') => 3
							),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Text color", "ancora"),
						"description" => __("Color for the highlighted text", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Background color for the highlighted text", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "font_size",
						"heading" => __("Font size", "ancora"),
						"description" => __("Font size for the highlighted text (default - in pixels, allows any CSS units of measure)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "content",
						"heading" => __("Highlight text", "ancora"),
						"description" => __("Content for highlight", "ancora"),
						"class" => "",
						"value" => "",
						/*"holder" => "div",*/
						"type" => "textarea_html"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			) );
			
			class WPBakeryShortCode_Trx_Highlight extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			// Icon
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_icon",
				"name" => __("Icon", "ancora"),
				"description" => __("Insert the icon", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_icon',
				"class" => "trx_sc_single trx_sc_icon",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "icon",
						"heading" => __("Icon", "ancora"),
						"description" => __("Select icon class from Fontello icons set", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Text color", "ancora"),
						"description" => __("Icon's color", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Background color for the icon", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_shape",
						"heading" => __("Background shape", "ancora"),
						"description" => __("Shape of the icon background", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('None', 'ancora') => 'none',
							__('Round', 'ancora') => 'round',
							__('Square', 'ancora') => 'square'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_style",
						"heading" => __("Icon's color scheme", "ancora"),
						"description" => __("Select icon's color scheme", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['button_styles']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "font_size",
						"heading" => __("Font size", "ancora"),
						"description" => __("Icon's font size", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "font_weight",
						"heading" => __("Font weight", "ancora"),
						"description" => __("Icon's font weight", "ancora"),
						"class" => "",
						"value" => array(
							__('Default', 'ancora') => 'inherit',
							__('Thin (100)', 'ancora') => '100',
							__('Light (300)', 'ancora') => '300',
							__('Normal (400)', 'ancora') => '400',
							__('Bold (700)', 'ancora') => '700'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "align",
						"heading" => __("Icon's alignment", "ancora"),
						"description" => __("Align icon to left, center or right", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link URL", "ancora"),
						"description" => __("Link URL from this icon (if not empty)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
			) );
			
			class WPBakeryShortCode_Trx_Icon extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Image
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_image",
				"name" => __("Image", "ancora"),
				"description" => __("Insert image", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_image',
				"class" => "trx_sc_single trx_sc_image",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "url",
						"heading" => __("Select image", "ancora"),
						"description" => __("Select image from library", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "align",
						"heading" => __("Image alignment", "ancora"),
						"description" => __("Align image to left or right side", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['float']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "shape",
						"heading" => __("Image shape", "ancora"),
						"description" => __("Shape of the image: square or round", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Square', 'ancora') => 'square',
							__('Round', 'ancora') => 'round'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Image's title", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "icon",
						"heading" => __("Title's icon", "ancora"),
						"description" => __("Select icon for the title from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Image extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Infobox
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_infobox",
				"name" => __("Infobox", "ancora"),
				"description" => __("Box with info or error message", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_infobox',
				"class" => "trx_sc_container trx_sc_infobox",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Style", "ancora"),
						"description" => __("Infobox style", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
								__('Regular', 'ancora') => 'regular',
								__('Info', 'ancora') => 'info',
								__('Success', 'ancora') => 'success',
								__('Error', 'ancora') => 'error',
								__('Warning', 'ancora') => 'warning',
							),
						"type" => "dropdown"
					),
					array(
						"param_name" => "closeable",
						"heading" => __("Closeable", "ancora"),
						"description" => __("Create closeable box (with close button)", "ancora"),
						"class" => "",
						"value" => array(__('Close button', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "icon",
						"heading" => __("Custom icon", "ancora"),
						"description" => __("Select icon for the infobox from Fontello icons set. If empty - use default icon", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Text color", "ancora"),
						"description" => __("Any color for the text and headers", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Any background color for this infobox", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Message text", "ancora"),
//						"description" => __("Message for the infobox", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			) );
			
			class WPBakeryShortCode_Trx_Infobox extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			
			// Line
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_line",
				"name" => __("Line", "ancora"),
				"description" => __("Insert line (delimiter)", "ancora"),
				"category" => __('Content', 'js_composer'),
				"class" => "trx_sc_single trx_sc_line",
				'icon' => 'icon_trx_line',
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Style", "ancora"),
						"description" => __("Line style", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
								__('Solid', 'ancora') => 'solid',
								__('Dashed', 'ancora') => 'dashed',
								__('Dotted', 'ancora') => 'dotted',
								__('Double', 'ancora') => 'double',
								__('Shadow', 'ancora') => 'shadow'
							),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Line color", "ancora"),
						"description" => __("Line color", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Line extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// List
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_list",
				"name" => __("List", "ancora"),
				"description" => __("List items with specific bullets", "ancora"),
				"category" => __('Content', 'js_composer'),
				"class" => "trx_sc_collection trx_sc_list",
				'icon' => 'icon_trx_list',
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => false,
				"as_parent" => array('only' => 'trx_list_item'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Bullet's style", "ancora"),
						"description" => __("Bullet's style for each list item", "ancora"),
						"class" => "",
						"admin_label" => true,
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['list_styles']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Color", "ancora"),
						"description" => __("List items color", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "icon",
						"heading" => __("List icon", "ancora"),
						"description" => __("Select list icon from Fontello icons set (only for style=Iconed)", "ancora"),
						"admin_label" => true,
						"class" => "",
						'dependency' => array(
							'element' => 'style',
							'value' => array('iconed')
						),
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon_color",
						"heading" => __("Icon color", "ancora"),
						"description" => __("List icons color", "ancora"),
						"class" => "",
						'dependency' => array(
							'element' => 'style',
							'value' => array('iconed')
						),
						"value" => "",
						"type" => "colorpicker"
					),
                    array(
                        "param_name" => "boxed_icon",
                        "heading" => __("Boxed Icon", "ancora"),
                        "description" => __("Create border around icon", "ancora"),
                        "class" => "",
                        "value" => array('No' => '', 'Yes' => 'boxed_icon'),
                        "type" => "dropdown"
                    ),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'default_content' => '
					[trx_list_item]' . __( 'Item 1', 'ancora' ) . '[/trx_list_item]
					[trx_list_item]' . __( 'Item 2', 'ancora' ) . '[/trx_list_item]
				'
			) );
			
			
			vc_map( array(
				"base" => "trx_list_item",
				"name" => __("List item", "ancora"),
				"description" => __("List item with specific bullet", "ancora"),
				"class" => "trx_sc_single trx_sc_list_item",
				"show_settings_on_create" => true,
				"content_element" => true,
				"is_container" => false,
				'icon' => 'icon_trx_list_item',
				"as_child" => array('only' => 'trx_list'), // Use only|except attributes to limit parent (separate multiple values with comma)
				"as_parent" => array('except' => 'trx_list'),
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("List item title", "ancora"),
						"description" => __("Title for the current list item (show it as tooltip)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link URL", "ancora"),
						"description" => __("Link URL for the current list item", "ancora"),
						"admin_label" => true,
						"group" => __('Link', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "target",
						"heading" => __("Link target", "ancora"),
						"description" => __("Link target for the current list item", "ancora"),
						"admin_label" => true,
						"group" => __('Link', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "color",
						"heading" => __("Color", "ancora"),
						"description" => __("Text color for this item", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "icon",
						"heading" => __("List item icon", "ancora"),
						"description" => __("Select list item icon from Fontello icons set (only for style=Iconed)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon_color",
						"heading" => __("Icon color", "ancora"),
						"description" => __("Icon color for this item", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("List item text", "ancora"),
//						"description" => __("Current list item content", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextView'
			
			) );
			
			class WPBakeryShortCode_Trx_List extends ANCORA_VC_ShortCodeCollection {}
			class WPBakeryShortCode_Trx_List_Item extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			
			
			// Number
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_number",
				"name" => __("Number", "ancora"),
				"description" => __("Insert number or any word as set of separated characters", "ancora"),
				"category" => __('Content', 'js_composer'),
				"class" => "trx_sc_single trx_sc_number",
				'icon' => 'icon_trx_number',
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "value",
						"heading" => __("Value", "ancora"),
						"description" => __("Number or any word to separate", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Select block alignment", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Number extends ANCORA_VC_ShortCodeSingle {}


			
			
			
			
			
			// Parallax
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_parallax",
				"name" => __("Parallax", "ancora"),
				"description" => __("Create the parallax container (with asinc background image)", "ancora"),
				"category" => __('Structure', 'js_composer'),
				'icon' => 'icon_trx_parallax',
				"class" => "trx_sc_collection trx_sc_parallax",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "gap",
						"heading" => __("Create gap", "ancora"),
						"description" => __("Create gap around parallax container (not need in fullscreen pages)", "ancora"),
						"class" => "",
						"value" => array(__('Create gap', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "dir",
						"heading" => __("Direction", "ancora"),
						"description" => __("Scroll direction for the parallax background", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
								__('Up', 'ancora') => 'up',
								__('Down', 'ancora') => 'down'
							),
						"type" => "dropdown"
					),
					array(
						"param_name" => "speed",
						"heading" => __("Speed", "ancora"),
						"description" => __("Parallax background motion speed (from 0.0 to 1.0)", "ancora"),
						"class" => "",
						"value" => "0.3",
						"type" => "textfield"
					),
					array(
						"param_name" => "color",
						"heading" => __("Text color", "ancora"),
						"description" => __("Select color for text object inside parallax block", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_tint",
						"heading" => __("Bg tint", "ancora"),
						"description" => __("Select tint of the parallax background (for correct font color choise)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
								__('Light', 'ancora') => 'light',
								__('Dark', 'ancora') => 'dark'
							),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Backgroud color", "ancora"),
						"description" => __("Select color for parallax background", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image", "ancora"),
						"description" => __("Select or upload image or write URL from other site for the parallax background", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_image_x",
						"heading" => __("Image X position", "ancora"),
						"description" => __("Parallax background X position (in percents)", "ancora"),
						"class" => "",
						"value" => "50%",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_video",
						"heading" => __("Video background", "ancora"),
						"description" => __("Paste URL for video file to show it as parallax background", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_video_ratio",
						"heading" => __("Video ratio", "ancora"),
						"description" => __("Specify ratio of the video background. For example: 16:9 (default), 4:3, etc.", "ancora"),
						"class" => "",
						"value" => "16:9",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_overlay",
						"heading" => __("Overlay", "ancora"),
						"description" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_texture",
						"heading" => __("Texture", "ancora"),
						"description" => __("Texture style from 1 to 11. Empty or 0 - without texture.", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Content", "ancora"),
//						"description" => __("Content for the parallax container", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Parallax extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			// Popup
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_popup",
				"name" => __("Popup window", "ancora"),
				"description" => __("Container for any html-block with desired class and style for popup window", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_popup',
				"class" => "trx_sc_collection trx_sc_popup",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
//					array(
//						"param_name" => "content",
//						"heading" => __("Container content", "ancora"),
//						"description" => __("Content for popup container", "ancora"),
//						"class" => "",
//						"value" => "",
//						/*"holder" => "div",*/
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Popup extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			
			// Price
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_price",
				"name" => __("Price", "ancora"),
				"description" => __("Insert price with decoration", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_price',
				"class" => "trx_sc_single trx_sc_price",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "money",
						"heading" => __("Money", "ancora"),
						"description" => __("Money value (dot or comma separated)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "currency",
						"heading" => __("Currency symbol", "ancora"),
						"description" => __("Currency character", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "$",
						"type" => "textfield"
					),
					array(
						"param_name" => "period",
						"heading" => __("Period", "ancora"),
						"description" => __("Period text (if need). For example: monthly, daily, etc.", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Align price to left or right side", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['float']),
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Price extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Price block
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_price_block",
				"name" => __("Price block", "ancora"),
				"description" => __("Insert price block with title, price and description", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_price_block',
				"class" => "trx_sc_single trx_sc_price_block",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Block title", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link URL", "ancora"),
						"description" => __("URL for link from button (at bottom of the block)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link_text",
						"heading" => __("Link text", "ancora"),
						"description" => __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "icon",
						"heading" => __("Icon", "ancora"),
						"description" => __("Select icon from Fontello icons set (placed before/instead price)", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "money",
						"heading" => __("Money", "ancora"),
						"description" => __("Money value (dot or comma separated)", "ancora"),
						"admin_label" => true,
						"group" => __('Money', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "currency",
						"heading" => __("Currency symbol", "ancora"),
						"description" => __("Currency character", "ancora"),
						"admin_label" => true,
						"group" => __('Money', 'ancora'),
						"class" => "",
						"value" => "$",
						"type" => "textfield"
					),
					array(
						"param_name" => "period",
						"heading" => __("Period", "ancora"),
						"description" => __("Period text (if need). For example: monthly, daily, etc.", "ancora"),
						"admin_label" => true,
						"group" => __('Money', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Align price to left or right side", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['float']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "content",
						"heading" => __("Description", "ancora"),
						"description" => __("Description for this price block", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textarea_html"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextView'
			) );
			
			class WPBakeryShortCode_Trx_PriceBlock extends ANCORA_VC_ShortCodeSingle {}

			
			
			
			
			// Quote
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_quote",
				"name" => __("Quote", "ancora"),
				"description" => __("Quote text", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_quote',
				"class" => "trx_sc_container trx_sc_quote",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
                    array(
                        "param_name" => "style",
                        "heading" => __("Style", "ancora"),
                        "description" => __("Quote style", "ancora"),
                        "class" => "",
                        "value" => array( 'Dark' => '1', 'White' => '2'),
                        "type" => "dropdown"
                    ),
					array(
						"param_name" => "cite",
						"heading" => __("Quote cite", "ancora"),
						"description" => __("URL for the quote cite link", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title (author)", "ancora"),
						"description" => __("Quote title (author name)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "content",
						"heading" => __("Quote content", "ancora"),
						"description" => __("Quote content", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textarea_html"
					),
					ancora_vc_width(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			) );
			
			class WPBakeryShortCode_Trx_Quote extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			
			// Reviews
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_reviews",
				"name" => __("Reviews", "ancora"),
				"description" => __("Insert reviews block in the single post", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_reviews',
				"class" => "trx_sc_single trx_sc_reviews",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Align counter to left, center or right", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Reviews extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Search
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_search",
				"name" => __("Search form", "ancora"),
				"description" => __("Insert search form", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_search',
				"class" => "trx_sc_single trx_sc_search",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Style", "ancora"),
						"description" => __("Select style to display search field", "ancora"),
						"class" => "",
						"value" => array(
							__('Regular', 'ancora') => "regular",
							__('Flat', 'ancora') => "flat"
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title (placeholder) for the search field", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => __("Search &hellip;", 'ancora'),
						"type" => "textfield"
					),
					array(
						"param_name" => "ajax",
						"heading" => __("AJAX", "ancora"),
						"description" => __("Search via AJAX or reload page", "ancora"),
						"class" => "",
						"value" => array(__('Use AJAX search', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Search extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Section
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_section",
				"name" => __("Section container", "ancora"),
				"description" => __("Container for any block ([block] analog - to enable nesting)", "ancora"),
				"category" => __('Content', 'js_composer'),
				"class" => "trx_sc_collection trx_sc_section",
				'icon' => 'icon_trx_block',
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "dedicated",
						"heading" => __("Dedicated", "ancora"),
						"description" => __("Use this block as dedicated content - show it before post title on single page", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(__('Use as dedicated content', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Select block alignment", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns emulation", "ancora"),
						"description" => __("Select width for columns emulation", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['columns']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "pan",
						"heading" => __("Use pan effect", "ancora"),
						"description" => __("Use pan effect to show section content", "ancora"),
						"group" => __('Scroll', 'ancora'),
						"class" => "",
						"value" => array(__('Content scroller', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "scroll",
						"heading" => __("Use scroller", "ancora"),
						"description" => __("Use scroller to show section content", "ancora"),
						"group" => __('Scroll', 'ancora'),
						"admin_label" => true,
						"class" => "",
						"value" => array(__('Content scroller', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "scroll_dir",
						"heading" => __("Scroll and Pan direction", "ancora"),
						"description" => __("Scroll and Pan direction (if Use scroller = yes or Pan = yes)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"group" => __('Scroll', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['dir']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "scroll_controls",
						"heading" => __("Scroll controls", "ancora"),
						"description" => __("Show scroll controls (if Use scroller = yes)", "ancora"),
						"class" => "",
						"group" => __('Scroll', 'ancora'),
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['dir']),
						'dependency' => array(
							'element' => 'scroll',
							'not_empty' => true
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "color",
						"heading" => __("Fore color", "ancora"),
						"description" => __("Any color for objects in this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_tint",
						"heading" => __("Background tint", "ancora"),
						"description" => __("Main background tint: dark or light", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['tint']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Any background color for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image URL", "ancora"),
						"description" => __("Select background image from library for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_overlay",
						"heading" => __("Overlay", "ancora"),
						"description" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_texture",
						"heading" => __("Texture", "ancora"),
						"description" => __("Texture style from 1 to 11. Empty or 0 - without texture.", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "font_size",
						"heading" => __("Font size", "ancora"),
						"description" => __("Font size of the text (default - in pixels, allows any CSS units of measure)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "font_weight",
						"heading" => __("Font weight", "ancora"),
						"description" => __("Font weight of the text", "ancora"),
						"class" => "",
						"value" => array(
							__('Default', 'ancora') => 'inherit',
							__('Thin (100)', 'ancora') => '100',
							__('Light (300)', 'ancora') => '300',
							__('Normal (400)', 'ancora') => '400',
							__('Bold (700)', 'ancora') => '700'
						),
						"type" => "dropdown"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Container content", "ancora"),
//						"description" => __("Content for section container", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Section extends ANCORA_VC_ShortCodeCollection {}
			
			
			
			
			
			
			
			// Skills
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_skills",
				"name" => __("Skills", "ancora"),
				"description" => __("Insert skills diagramm", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_skills',
				"class" => "trx_sc_collection trx_sc_skills",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_skills_item'),
				"params" => array(
					array(
						"param_name" => "max_value",
						"heading" => __("Max value", "ancora"),
						"description" => __("Max value for skills items", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "100",
						"type" => "textfield"
					),
					array(
						"param_name" => "type",
						"heading" => __("Skills type", "ancora"),
						"description" => __("Select type of skills block", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Bar', 'ancora') => 'bar',
							__('Pie chart', 'ancora') => 'pie',
							__('Counter', 'ancora') => 'counter',
							__('Arc', 'ancora') => 'arc'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "layout",
						"heading" => __("Skills layout", "ancora"),
						"description" => __("Select layout of skills block", "ancora"),
						"admin_label" => true,
						'dependency' => array(
							'element' => 'type',
							'value' => array('counter','bar','pie')
						),
						"class" => "",
						"value" => array(
							__('Rows', 'ancora') => 'rows',
							__('Columns', 'ancora') => 'columns'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "dir",
						"heading" => __("Direction", "ancora"),
						"description" => __("Select direction of skills block", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['dir']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "style",
						"heading" => __("Counters style", "ancora"),
						"description" => __("Select style of skills items (only for type=counter)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Style 1', 'ancora') => '1',
							__('Style 2', 'ancora') => '2',
							__('Style 3', 'ancora') => '3',
							__('Style 4', 'ancora') => '4'
						),
						'dependency' => array(
							'element' => 'type',
							'value' => array('counter')
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns count", "ancora"),
						"description" => __("Skills columns count (required)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "2",
						"type" => "textfield"
					),
					array(
						"param_name" => "color",
						"heading" => __("Color", "ancora"),
						"description" => __("Color for all skills items", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Background color for all skills items (only for type=pie)", "ancora"),
						'dependency' => array(
							'element' => 'type',
							'value' => array('pie')
						),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "border_color",
						"heading" => __("Border color", "ancora"),
						"description" => __("Border color for all skills items (only for type=pie)", "ancora"),
						'dependency' => array(
							'element' => 'type',
							'value' => array('pie')
						),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title of the skills block", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "subtitle",
						"heading" => __("Subtitle", "ancora"),
						"description" => __("Default subtitle of the skills block (only if type=arc)", "ancora"),
						'dependency' => array(
							'element' => 'type',
							'value' => array('arc')
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Align skills block to left or right side", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['float']),
						"type" => "dropdown"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			
			vc_map( array(
				"base" => "trx_skills_item",
				"name" => __("Skill", "ancora"),
				"description" => __("Skills item", "ancora"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_single trx_sc_skills_item",
				"content_element" => true,
				"is_container" => false,
				"as_child" => array('only' => 'trx_skills'),
				"as_parent" => array('except' => 'trx_skills'),
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title for the current skills item", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "value",
						"heading" => __("Value", "ancora"),
						"description" => __("Value for the current skills item", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "50",
						"type" => "textfield"
					),
					array(
						"param_name" => "color",
						"heading" => __("Color", "ancora"),
						"description" => __("Color for current skills item", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Background color for current skills item (only for type=pie)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "border_color",
						"heading" => __("Border color", "ancora"),
						"description" => __("Border color for current skills item (only for type=pie)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "style",
						"heading" => __("Item style", "ancora"),
						"description" => __("Select style for the current skills item (only for type=counter)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Style 1', 'ancora') => '1',
							__('Style 2', 'ancora') => '2',
							__('Style 3', 'ancora') => '3',
							__('Style 4', 'ancora') => '4'
						),
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Skills extends ANCORA_VC_ShortCodeCollection {}
			class WPBakeryShortCode_Trx_Skills_Item extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Slider
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_slider",
				"name" => __("Slider", "ancora"),
				"description" => __("Insert slider", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_slider',
				"class" => "trx_sc_collection trx_sc_slider",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_slider_item'),
				"params" => array_merge(array(
					array(
						"param_name" => "engine",
						"heading" => __("Engine", "ancora"),
						"description" => __("Select engine for slider. Attention! Swiper is built-in engine, all other engines appears only if corresponding plugings are installed", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['sliders']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "align",
						"heading" => __("Float slider", "ancora"),
						"description" => __("Float slider to left or right side", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['float']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "custom",
						"heading" => __("Custom slides", "ancora"),
						"description" => __("Make custom slides from inner shortcodes (prepare it on tabs) or prepare slides from posts thumbnails", "ancora"),
						"class" => "",
						"value" => array(__('Custom slides', 'ancora') => 'yes'),
						"type" => "checkbox"
					)
					),
					ancora_exists_revslider() || ancora_exists_royalslider() ? array(
					array(
						"param_name" => "alias",
						"heading" => __("Revolution slider alias or Royal Slider ID", "ancora"),
						"description" => __("Alias for Revolution slider or Royal slider ID", "ancora"),
						"admin_label" => true,
						"class" => "",
						'dependency' => array(
							'element' => 'engine',
							'value' => array('revo','royal')
						),
						"value" => "",
						"type" => "textfield"
					)) : array(), array(
					array(
						"param_name" => "cat",
						"heading" => __("Categories list", "ancora"),
						"description" => __("Select category. If empty - show posts from any category or from IDs list", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array_flip(ancora_array_merge(array(0 => __('- Select category -', 'ancora')), $ANCORA_GLOBALS['sc_params']['categories'])),
						"type" => "dropdown"
					),
					array(
						"param_name" => "count",
						"heading" => __("Swiper: Number of posts", "ancora"),
						"description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => __("Swiper: Offset before select posts", "ancora"),
						"description" => __("Skip posts before select next part.", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => __("Swiper: Post sorting", "ancora"),
						"description" => __("Select desired posts sorting method", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['sorting']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => __("Swiper: Post order", "ancora"),
						"description" => __("Select desired posts order", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => __("Swiper: Post IDs list", "ancora"),
						"description" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "controls",
						"heading" => __("Swiper: Show slider controls", "ancora"),
						"description" => __("Show arrows inside slider", "ancora"),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array(__('Show controls', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "pagination",
						"heading" => __("Swiper: Show slider pagination", "ancora"),
						"description" => __("Show bullets or titles to switch slides", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array(
								__('Dots', 'ancora') => 'yes',
								__('Side Titles', 'ancora') => 'full',
								__('Over Titles', 'ancora') => 'over',
								__('None', 'ancora') => 'no'
							),
						"type" => "dropdown"
					),
					array(
						"param_name" => "titles",
						"heading" => __("Swiper: Show titles section", "ancora"),
						"description" => __("Show section with post's title and short post's description", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array(
								__('Not show', 'ancora') => "no",
								__('Show/Hide info', 'ancora') => "slide",
								__('Fixed info', 'ancora') => "fixed"
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "descriptions",
						"heading" => __("Swiper: Post descriptions", "ancora"),
						"description" => __("Show post's excerpt max length (characters)", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "links",
						"heading" => __("Swiper: Post's title as link", "ancora"),
						"description" => __("Make links from post's titles", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array(__('Titles as a links', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "crop",
						"heading" => __("Swiper: Crop images", "ancora"),
						"description" => __("Crop images in each slide or live it unchanged", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array(__('Crop images', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "autoheight",
						"heading" => __("Swiper: Autoheight", "ancora"),
						"description" => __("Change whole slider's height (make it equal current slide's height)", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => array(__('Autoheight', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					array(
						"param_name" => "interval",
						"heading" => __("Swiper: Slides change interval", "ancora"),
						"description" => __("Slides change interval (in milliseconds: 1000ms = 1s)", "ancora"),
						"group" => __('Details', 'ancora'),
						'dependency' => array(
							'element' => 'engine',
							'value' => array('swiper')
						),
						"class" => "",
						"value" => "5000",
						"type" => "textfield"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				))
			) );
			
			
			vc_map( array(
				"base" => "trx_slider_item",
				"name" => __("Slide", "ancora"),
				"description" => __("Slider item - single slide", "ancora"),
				"show_settings_on_create" => true,
				"content_element" => true,
				"is_container" => false,
				'icon' => 'icon_trx_slider_item',
				"as_child" => array('only' => 'trx_slider'),
				"as_parent" => array('except' => 'trx_slider'),
				"params" => array(
					array(
						"param_name" => "src",
						"heading" => __("URL (source) for image file", "ancora"),
						"description" => __("Select or upload image or write URL from other site for the current slide", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Slider extends ANCORA_VC_ShortCodeCollection {}
			class WPBakeryShortCode_Trx_Slider_Item extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Socials
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_socials",
				"name" => __("Social icons", "ancora"),
				"description" => __("Custom social icons", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_socials',
				"class" => "trx_sc_collection trx_sc_socials",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_social_item'),
				"params" => array_merge(array(
					array(
						"param_name" => "size",
						"heading" => __("Icon's size", "ancora"),
						"description" => __("Size of the icons", "ancora"),
						"class" => "",
						"value" => array(
							__('Tiny', 'ancora') => 'tiny',
							__('Small', 'ancora') => 'small',
							__('Large', 'ancora') => 'large'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "socials",
						"heading" => __("Manual socials list", "ancora"),
						"description" => __("Custom list of social networks. For example: twitter=http://twitter.com/my_profile|facebook=http://facebooc.com/my_profile. If empty - use socials from Theme options.", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "custom",
						"heading" => __("Custom socials", "ancora"),
						"description" => __("Make custom icons from inner shortcodes (prepare it on tabs)", "ancora"),
						"class" => "",
						"value" => array(__('Custom socials', 'ancora') => 'yes'),
						"type" => "checkbox"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				))
			) );
			
			
			vc_map( array(
				"base" => "trx_social_item",
				"name" => __("Custom social item", "ancora"),
				"description" => __("Custom social item: name, profile url and icon url", "ancora"),
				"show_settings_on_create" => true,
				"content_element" => true,
				"is_container" => false,
				'icon' => 'icon_trx_social_item',
				"as_child" => array('only' => 'trx_socials'),
				"as_parent" => array('except' => 'trx_socials'),
				"params" => array(
					array(
						"param_name" => "name",
						"heading" => __("Social name", "ancora"),
						"description" => __("Name (slug) of the social network (twitter, facebook, linkedin, etc.)", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "url",
						"heading" => __("Your profile URL", "ancora"),
						"description" => __("URL of your profile in specified social network", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "icon",
						"heading" => __("URL (source) for icon file", "ancora"),
						"description" => __("Select or upload image or write URL from other site for the current social icon", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					)
				)
			) );
			
			class WPBakeryShortCode_Trx_Socials extends ANCORA_VC_ShortCodeCollection {}
			class WPBakeryShortCode_Trx_Social_Item extends ANCORA_VC_ShortCodeSingle {}
			

			
			
			
			
			
			// Table
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_table",
				"name" => __("Table", "ancora"),
				"description" => __("Insert a table", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_table',
				"class" => "trx_sc_container trx_sc_table",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "align",
						"heading" => __("Cells content alignment", "ancora"),
						"description" => __("Select alignment for each table cell", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "content",
						"heading" => __("Table content", "ancora"),
						"description" => __("Content, created with any table-generator", "ancora"),
						"class" => "",
						"value" => "Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/",
						/*"holder" => "div",*/
						"type" => "textarea_html"
					),
					ancora_vc_width(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			) );
			
			class WPBakeryShortCode_Trx_Table extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			
			// Tabs
			//-------------------------------------------------------------------------------------
			
			$tab_id_1 = 'sc_tab_'.time() . '_1_' . rand( 0, 100 );
			$tab_id_2 = 'sc_tab_'.time() . '_2_' . rand( 0, 100 );
			vc_map( array(
				"base" => "trx_tabs",
				"name" => __("Tabs", "ancora"),
				"description" => __("Tabs", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_tabs',
				"class" => "trx_sc_collection trx_sc_tabs",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => false,
				"as_parent" => array('only' => 'trx_tab'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Tabs style", "ancora"),
						"description" => __("Select style of tabs items", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Style 1', 'ancora') => '1',
							__('Style 2', 'ancora') => '2'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "initial",
						"heading" => __("Initially opened tab", "ancora"),
						"description" => __("Number of initially opened tab", "ancora"),
						"class" => "",
						"value" => 1,
						"type" => "textfield"
					),
					array(
						"param_name" => "scroll",
						"heading" => __("Scroller", "ancora"),
						"description" => __("Use scroller to show tab content (height parameter required)", "ancora"),
						"class" => "",
						"value" => array("Use scroller" => "yes" ),
						"type" => "checkbox"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'default_content' => '
					[trx_tab title="' . __( 'Tab 1', 'ancora' ) . '" tab_id="'.esc_attr($tab_id_1).'"][/trx_tab]
					[trx_tab title="' . __( 'Tab 2', 'ancora' ) . '" tab_id="'.esc_attr($tab_id_2).'"][/trx_tab]
				',
				"custom_markup" => '
					<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
						<ul class="tabs_controls">
						</ul>
						%content%
					</div>
				',
				'js_view' => 'VcTrxTabsView'
			) );
			
			
			vc_map( array(
				"base" => "trx_tab",
				"name" => __("Tab item", "ancora"),
				"description" => __("Single tab item", "ancora"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_collection trx_sc_tab",
				"content_element" => true,
				"is_container" => true,
				'icon' => 'icon_trx_tab',
				"as_child" => array('only' => 'trx_tabs'),
				"as_parent" => array('except' => 'trx_tabs'),
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("Tab title", "ancora"),
						"description" => __("Title for current tab", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "tab_id",
						"heading" => __("Tab ID", "ancora"),
						"description" => __("ID for current tab (required). Please, start it from letter.", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
			  'js_view' => 'VcTrxTabView'
			) );
			class WPBakeryShortCode_Trx_Tabs extends ANCORA_VC_ShortCodeTabs {}
			class WPBakeryShortCode_Trx_Tab extends ANCORA_VC_ShortCodeTab {}
			
			
			
			
			// Team
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_team",
				"name" => __("Team", "ancora"),
				"description" => __("Insert team members", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_team',
				"class" => "trx_sc_columns trx_sc_team",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_team_item'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Team style", "ancora"),
						"description" => __("Select style to display team members", "ancora"),
						"class" => "",
						"admin_label" => true,
						"value" => array(
							__('Style 1', 'ancora') => 1,
							__('Style 2', 'ancora') => 2
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns", "ancora"),
						"description" => __("How many columns use to show team members", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "custom",
						"heading" => __("Custom", "ancora"),
						"description" => __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", "ancora"),
						"class" => "",
						"value" => array("Custom members" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "cat",
						"heading" => __("Categories", "ancora"),
						"description" => __("Put here comma separated categories (ids or slugs) to show team members. If empty - select team members from any category (group) or from IDs list", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "count",
						"heading" => __("Number of posts", "ancora"),
						"description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => __("Offset before select posts", "ancora"),
						"description" => __("Skip posts before select next part.", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => __("Post sorting", "ancora"),
						"description" => __("Select desired posts sorting method", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['sorting']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => __("Post order", "ancora"),
						"description" => __("Select desired posts order", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => __("Team member's IDs list", "ancora"),
						"description" => __("Comma separated list of team members's ID. If set - parameters above (category, count, order, etc.)  are ignored!", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'default_content' => '
					[trx_team_item user="' . __( 'Member 1', 'ancora' ) . '"][/trx_team_item]
					[trx_team_item user="' . __( 'Member 2', 'ancora' ) . '"][/trx_team_item]
				',
				'js_view' => 'VcTrxColumnsView'
			) );
			
			
			vc_map( array(
				"base" => "trx_team_item",
				"name" => __("Team member", "ancora"),
				"description" => __("Team member - all data pull out from it account on your site", "ancora"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_item trx_sc_column_item trx_sc_team_item",
				"content_element" => true,
				"is_container" => false,
				'icon' => 'icon_trx_team_item',
				"as_child" => array('only' => 'trx_team'),
				"as_parent" => array('except' => 'trx_team'),
				"params" => array(
					array(
						"param_name" => "user",
						"heading" => __("Registered user", "ancora"),
						"description" => __("Select one of registered users (if present) or put name, position, etc. in fields below", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['users']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "member",
						"heading" => __("Team member", "ancora"),
						"description" => __("Select one of team members (if present) or put name, position, etc. in fields below", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['members']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link", "ancora"),
						"description" => __("Link on team member's personal page", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "name",
						"heading" => __("Name", "ancora"),
						"description" => __("Team member's name", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "position",
						"heading" => __("Position", "ancora"),
						"description" => __("Team member's position", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "email",
						"heading" => __("E-mail", "ancora"),
						"description" => __("Team member's e-mail", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "photo",
						"heading" => __("Member's Photo", "ancora"),
						"description" => __("Team member's photo (avatar", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "socials",
						"heading" => __("Socials", "ancora"),
						"description" => __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Team extends ANCORA_VC_ShortCodeColumns {}
			class WPBakeryShortCode_Trx_Team_Item extends ANCORA_VC_ShortCodeItem {}
			
			
			
			
			
			
			
			// Testimonials
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_testimonials",
				"name" => __("Testimonials", "ancora"),
				"description" => __("Insert testimonials slider", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_testimonials',
				"class" => "trx_sc_collection trx_sc_testimonials",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_testimonials_item'),
				"params" => array(
					array(
						"param_name" => "controls",
						"heading" => __("Show arrows", "ancora"),
						"description" => __("Show control buttons", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['yes_no']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "interval",
						"heading" => __("Testimonials change interval", "ancora"),
						"description" => __("Testimonials change interval (in milliseconds: 1000ms = 1s)", "ancora"),
						"class" => "",
						"value" => "7000",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Alignment of the testimonials block", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "autoheight",
						"heading" => __("Autoheight", "ancora"),
						"description" => __("Change whole slider's height (make it equal current slide's height)", "ancora"),
						"class" => "",
						"value" => array("Autoheight" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "custom",
						"heading" => __("Custom", "ancora"),
						"description" => __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", "ancora"),
						"class" => "",
						"value" => array("Custom slides" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "cat",
						"heading" => __("Categories", "ancora"),
						"description" => __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "count",
						"heading" => __("Number of posts", "ancora"),
						"description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => __("Offset before select posts", "ancora"),
						"description" => __("Skip posts before select next part.", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => __("Post sorting", "ancora"),
						"description" => __("Select desired posts sorting method", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['sorting']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => __("Post order", "ancora"),
						"description" => __("Select desired posts order", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => __("Post IDs list", "ancora"),
						"description" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "ancora"),
						"group" => __('Query', 'ancora'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_tint",
						"heading" => __("Background tint", "ancora"),
						"description" => __("Main background tint: dark or light", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['tint']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Any background color for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image URL", "ancora"),
						"description" => __("Select background image from library for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_overlay",
						"heading" => __("Overlay", "ancora"),
						"description" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_texture",
						"heading" => __("Texture", "ancora"),
						"description" => __("Texture style from 1 to 11. Empty or 0 - without texture.", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			
			vc_map( array(
				"base" => "trx_testimonials_item",
				"name" => __("Testimonial", "ancora"),
				"description" => __("Single testimonials item", "ancora"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_container trx_sc_testimonials_item",
				"content_element" => true,
				"is_container" => true,
				'icon' => 'icon_trx_testimonials_item',
				"as_child" => array('only' => 'trx_testimonials'),
				"as_parent" => array('except' => 'trx_testimonials'),
				"params" => array(
					array(
						"param_name" => "author",
						"heading" => __("Author", "ancora"),
						"description" => __("Name of the testimonmials author", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link", "ancora"),
						"description" => __("Link URL to the testimonmials author page", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "email",
						"heading" => __("E-mail", "ancora"),
						"description" => __("E-mail of the testimonmials author", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "photo",
						"heading" => __("Photo", "ancora"),
						"description" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
//					array(
//						"param_name" => "content",
//						"heading" => __("Testimonials text", "ancora"),
//						"description" => __("Current testimonials text", "ancora"),
//						"class" => "",
//						"value" => "",
//						"type" => "textarea_html"
//					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextContainerView'
			) );
			
			class WPBakeryShortCode_Trx_Testimonials extends ANCORA_VC_ShortCodeColumns {}
			class WPBakeryShortCode_Trx_Testimonials_Item extends ANCORA_VC_ShortCodeContainer {}
			
			
			
			
			
			
			
			// Title
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_title",
				"name" => __("Title", "ancora"),
				"description" => __("Create header tag (1-6 level) with many styles", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_title',
				"class" => "trx_sc_single trx_sc_title",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "content",
						"heading" => __("Title content", "ancora"),
						"description" => __("Title content", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textarea_html"
					),
					array(
						"param_name" => "type",
						"heading" => __("Title type", "ancora"),
						"description" => __("Title type (header level)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Header 1', 'ancora') => '1',
							__('Header 2', 'ancora') => '2',
							__('Header 3', 'ancora') => '3',
							__('Header 4', 'ancora') => '4',
							__('Header 5', 'ancora') => '5',
							__('Header 6', 'ancora') => '6'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "style",
						"heading" => __("Title style", "ancora"),
						"description" => __("Title style: only text (regular) or with icon/image (iconed)", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Regular', 'ancora') => 'regular',
							__('Underline', 'ancora') => 'underline',
							__('Divider', 'ancora') => 'divider',
							__('With icon (image)', 'ancora') => 'iconed'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Title text alignment", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "font_size",
						"heading" => __("Font size", "ancora"),
						"description" => __("Custom font size. If empty - use theme default", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "font_weight",
						"heading" => __("Font weight", "ancora"),
						"description" => __("Custom font weight. If empty or inherit - use theme default", "ancora"),
						"class" => "",
						"value" => array(
							__('Default', 'ancora') => 'inherit',
							__('Thin (100)', 'ancora') => '100',
							__('Light (300)', 'ancora') => '300',
							__('Normal (400)', 'ancora') => '400',
							__('Semibold (600)', 'ancora') => '600',
							__('Bold (700)', 'ancora') => '700',
							__('Black (900)', 'ancora') => '900'
						),
						"type" => "dropdown"
					),
                    array(
                        "param_name" => "fig_border",
                        "heading" => __("Figure bottom border", "ancora"),
                        "description" => __("Apply a figure bottom border", "ancora"),
                        "class" => "",
                        "value" => array('No' => '', 'Yes' => 'fig_border'),
                        "type" => "dropdown"
                    ),
					array(
						"param_name" => "color",
						"heading" => __("Title color", "ancora"),
						"description" => __("Select color for the title", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "icon",
						"heading" => __("Title font icon", "ancora"),
						"description" => __("Select font icon for the title from Fontello icons set (if style=iconed)", "ancora"),
						"class" => "",
						"group" => __('Icon &amp; Image', 'ancora'),
						'dependency' => array(
							'element' => 'style',
							'value' => array('iconed')
						),
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "image",
						"heading" => __("or image icon", "ancora"),
						"description" => __("Select image icon for the title instead icon above (if style=iconed)", "ancora"),
						"class" => "",
						"group" => __('Icon &amp; Image', 'ancora'),
						'dependency' => array(
							'element' => 'style',
							'value' => array('iconed')
						),
						"value" => $ANCORA_GLOBALS['sc_params']['images'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "picture",
						"heading" => __("or select uploaded image", "ancora"),
						"description" => __("Select or upload image or write URL from other site (if style=iconed)", "ancora"),
						"group" => __('Icon &amp; Image', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "image_size",
						"heading" => __("Image (picture) size", "ancora"),
						"description" => __("Select image (picture) size (if style=iconed)", "ancora"),
						"group" => __('Icon &amp; Image', 'ancora'),
						"class" => "",
						"value" => array(
							__('Small', 'ancora') => 'small',
							__('Medium', 'ancora') => 'medium',
							__('Large', 'ancora') => 'large'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "position",
						"heading" => __("Icon (image) position", "ancora"),
						"description" => __("Select icon (image) position (if style=iconed)", "ancora"),
						"group" => __('Icon &amp; Image', 'ancora'),
						"class" => "",
						"value" => array(
							__('Top', 'ancora') => 'top',
							__('Left', 'ancora') => 'left'
						),
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextView'
			) );
			
			class WPBakeryShortCode_Trx_Title extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Toggles
			//-------------------------------------------------------------------------------------
				
			vc_map( array(
				"base" => "trx_toggles",
				"name" => __("Toggles", "ancora"),
				"description" => __("Toggles items", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_toggles',
				"class" => "trx_sc_collection trx_sc_toggles",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => false,
				"as_parent" => array('only' => 'trx_toggles_item'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Toggles style", "ancora"),
						"description" => __("Select style for display toggles", "ancora"),
						"class" => "",
						"admin_label" => true,
						"value" => array(
							__('Style 1', 'ancora') => 1,
							__('Style 2', 'ancora') => 2
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "counter",
						"heading" => __("Counter", "ancora"),
						"description" => __("Display counter before each toggles title", "ancora"),
						"class" => "",
						"value" => array("Add item numbers before each element" => "on" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "icon_closed",
						"heading" => __("Icon while closed", "ancora"),
						"description" => __("Select icon for the closed toggles item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon_opened",
						"heading" => __("Icon while opened", "ancora"),
						"description" => __("Select icon for the opened toggles item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class']
				),
				'default_content' => '
					[trx_toggles_item title="' . __( 'Item 1 title', 'ancora' ) . '"][/trx_toggles_item]
					[trx_toggles_item title="' . __( 'Item 2 title', 'ancora' ) . '"][/trx_toggles_item]
				',
				"custom_markup" => '
					<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
						%content%
					</div>
					<div class="tab_controls">
						<button class="add_tab" title="'.__("Add item", "ancora").'">'.__("Add item", "ancora").'</button>
					</div>
				',
				'js_view' => 'VcTrxTogglesView'
			) );
			
			
			vc_map( array(
				"base" => "trx_toggles_item",
				"name" => __("Toggles item", "ancora"),
				"description" => __("Single toggles item", "ancora"),
				"show_settings_on_create" => true,
				"content_element" => true,
				"is_container" => true,
				'icon' => 'icon_trx_toggles_item',
				"as_child" => array('only' => 'trx_toggles'),
				"as_parent" => array('except' => 'trx_toggles'),
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => __("Title", "ancora"),
						"description" => __("Title for current toggles item", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "open",
						"heading" => __("Open on show", "ancora"),
						"description" => __("Open current toggle item on show", "ancora"),
						"class" => "",
						"value" => array("Opened" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "icon_closed",
						"heading" => __("Icon while closed", "ancora"),
						"description" => __("Select icon for the closed toggles item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					array(
						"param_name" => "icon_opened",
						"heading" => __("Icon while opened", "ancora"),
						"description" => __("Select icon for the opened toggles item from Fontello icons set", "ancora"),
						"class" => "",
						"value" => $ANCORA_GLOBALS['sc_params']['icons'],
						"type" => "dropdown"
					),
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTogglesTabView'
			) );
			class WPBakeryShortCode_Trx_Toggles extends ANCORA_VC_ShortCodeToggles {}
			class WPBakeryShortCode_Trx_Toggles_Item extends ANCORA_VC_ShortCodeTogglesItem {}
			
			
			
			
			
			
			// Twitter
			//-------------------------------------------------------------------------------------

			vc_map( array(
				"base" => "trx_twitter",
				"name" => __("Twitter", "ancora"),
				"description" => __("Insert twitter feed into post (page)", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_twitter',
				"class" => "trx_sc_single trx_sc_twitter",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "user",
						"heading" => __("Twitter Username", "ancora"),
						"description" => __("Your username in the twitter account. If empty - get it from Theme Options.", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "consumer_key",
						"heading" => __("Consumer Key", "ancora"),
						"description" => __("Consumer Key from the twitter account", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "consumer_secret",
						"heading" => __("Consumer Secret", "ancora"),
						"description" => __("Consumer Secret from the twitter account", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "token_key",
						"heading" => __("Token Key", "ancora"),
						"description" => __("Token Key from the twitter account", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "token_secret",
						"heading" => __("Token Secret", "ancora"),
						"description" => __("Token Secret from the twitter account", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "count",
						"heading" => __("Tweets number", "ancora"),
						"description" => __("Number tweets to show", "ancora"),
						"class" => "",
						"divider" => true,
						"value" => 3,
						"type" => "textfield"
					),
					array(
						"param_name" => "controls",
						"heading" => __("Show arrows", "ancora"),
						"description" => __("Show control buttons", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['yes_no']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "interval",
						"heading" => __("Tweets change interval", "ancora"),
						"description" => __("Tweets change interval (in milliseconds: 1000ms = 1s)", "ancora"),
						"class" => "",
						"value" => "7000",
						"type" => "textfield"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Alignment of the tweets block", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "autoheight",
						"heading" => __("Autoheight", "ancora"),
						"description" => __("Change whole slider's height (make it equal current slide's height)", "ancora"),
						"class" => "",
						"value" => array("Autoheight" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "bg_tint",
						"heading" => __("Background tint", "ancora"),
						"description" => __("Main background tint: dark or light", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['tint']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "ancora"),
						"description" => __("Any background color for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image URL", "ancora"),
						"description" => __("Select background image from library for this section", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_overlay",
						"heading" => __("Overlay", "ancora"),
						"description" => __("Overlay color opacity (from 0.0 to 1.0)", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_texture",
						"heading" => __("Texture", "ancora"),
						"description" => __("Texture style from 1 to 11. Empty or 0 - without texture.", "ancora"),
						"group" => __('Colors and Images', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				),
			) );
			
			class WPBakeryShortCode_Trx_Twitter extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Video
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_video",
				"name" => __("Video", "ancora"),
				"description" => __("Insert video player", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_video',
				"class" => "trx_sc_single trx_sc_video",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "url",
						"heading" => __("URL for video file", "ancora"),
						"description" => __("Paste URL for video file", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "ratio",
						"heading" => __("Ratio", "ancora"),
						"description" => __("Select ratio for display video", "ancora"),
						"class" => "",
						"value" => array(
							__('16:9', 'ancora') => "16:9",
							__('4:3', 'ancora') => "4:3"
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "autoplay",
						"heading" => __("Autoplay video", "ancora"),
						"description" => __("Autoplay video on page load", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array("Autoplay" => "on" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Select block alignment", "ancora"),
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "image",
						"heading" => __("Cover image", "ancora"),
						"description" => __("Select or upload image or write URL from other site for video preview", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image", "ancora"),
						"description" => __("Select or upload image or write URL from other site for video background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_top",
						"heading" => __("Top offset", "ancora"),
						"description" => __("Top offset (padding) from background image to video block (in percent). For example: 3%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_bottom",
						"heading" => __("Bottom offset", "ancora"),
						"description" => __("Bottom offset (padding) from background image to video block (in percent). For example: 3%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_left",
						"heading" => __("Left offset", "ancora"),
						"description" => __("Left offset (padding) from background image to video block (in percent). For example: 20%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_right",
						"heading" => __("Right offset", "ancora"),
						"description" => __("Right offset (padding) from background image to video block (in percent). For example: 12%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Video extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
			
			
			
			// Zoom
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "trx_zoom",
				"name" => __("Zoom", "ancora"),
				"description" => __("Insert the image with zoom/lens effect", "ancora"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_zoom',
				"class" => "trx_sc_single trx_sc_zoom",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "effect",
						"heading" => __("Effect", "ancora"),
						"description" => __("Select effect to display overlapping image", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							__('Lens', 'ancora') => 'lens',
							__('Zoom', 'ancora') => 'zoom'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "url",
						"heading" => __("Main image", "ancora"),
						"description" => __("Select or upload main image", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "over",
						"heading" => __("Overlaping image", "ancora"),
						"description" => __("Select or upload overlaping image", "ancora"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "align",
						"heading" => __("Alignment", "ancora"),
						"description" => __("Float zoom to left or right side", "ancora"),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($ANCORA_GLOBALS['sc_params']['float']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image", "ancora"),
						"description" => __("Select or upload image or write URL from other site for zoom background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_top",
						"heading" => __("Top offset", "ancora"),
						"description" => __("Top offset (padding) from background image to zoom block (in percent). For example: 3%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_bottom",
						"heading" => __("Bottom offset", "ancora"),
						"description" => __("Bottom offset (padding) from background image to zoom block (in percent). For example: 3%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_left",
						"heading" => __("Left offset", "ancora"),
						"description" => __("Left offset (padding) from background image to zoom block (in percent). For example: 20%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_right",
						"heading" => __("Right offset", "ancora"),
						"description" => __("Right offset (padding) from background image to zoom block (in percent). For example: 12%", "ancora"),
						"group" => __('Background', 'ancora'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					ancora_vc_width(),
					ancora_vc_height(),
					$ANCORA_GLOBALS['vc_params']['margin_top'],
					$ANCORA_GLOBALS['vc_params']['margin_bottom'],
					$ANCORA_GLOBALS['vc_params']['margin_left'],
					$ANCORA_GLOBALS['vc_params']['margin_right'],
					$ANCORA_GLOBALS['vc_params']['id'],
					$ANCORA_GLOBALS['vc_params']['class'],
					$ANCORA_GLOBALS['vc_params']['animation'],
					$ANCORA_GLOBALS['vc_params']['css']
				)
			) );
			
			class WPBakeryShortCode_Trx_Zoom extends ANCORA_VC_ShortCodeSingle {}
			

			do_action('ancora_action_shortcodes_list_vc');
			
			
			if (ancora_exists_woocommerce()) {
			
				// WooCommerce - Cart
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "woocommerce_cart",
					"name" => __("Cart", "ancora"),
					"description" => __("WooCommerce shortcode: show cart page", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_wooc_cart',
					"class" => "trx_sc_alone trx_sc_woocommerce_cart",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => false,
					"params" => array()
				) );
				
				class WPBakeryShortCode_Woocommerce_Cart extends ANCORA_VC_ShortCodeAlone {}
			
			
				// WooCommerce - Checkout
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "woocommerce_checkout",
					"name" => __("Checkout", "ancora"),
					"description" => __("WooCommerce shortcode: show checkout page", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_wooc_checkout',
					"class" => "trx_sc_alone trx_sc_woocommerce_checkout",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => false,
					"params" => array()
				) );
				
				class WPBakeryShortCode_Woocommerce_Checkout extends ANCORA_VC_ShortCodeAlone {}
			
			
				// WooCommerce - My Account
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "woocommerce_my_account",
					"name" => __("My Account", "ancora"),
					"description" => __("WooCommerce shortcode: show my account page", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_wooc_my_account',
					"class" => "trx_sc_alone trx_sc_woocommerce_my_account",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => false,
					"params" => array()
				) );
				
				class WPBakeryShortCode_Woocommerce_My_Account extends ANCORA_VC_ShortCodeAlone {}
			
			
				// WooCommerce - Order Tracking
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "woocommerce_order_tracking",
					"name" => __("Order Tracking", "ancora"),
					"description" => __("WooCommerce shortcode: show order tracking page", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_wooc_order_tracking',
					"class" => "trx_sc_alone trx_sc_woocommerce_order_tracking",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => false,
					"params" => array()
				) );
				
				class WPBakeryShortCode_Woocommerce_Order_Tracking extends ANCORA_VC_ShortCodeAlone {}
			
			
				// WooCommerce - Shop Messages
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "shop_messages",
					"name" => __("Shop Messages", "ancora"),
					"description" => __("WooCommerce shortcode: show shop messages", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_wooc_shop_messages',
					"class" => "trx_sc_alone trx_sc_shop_messages",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => false,
					"params" => array()
				) );
				
				class WPBakeryShortCode_Shop_Messages extends ANCORA_VC_ShortCodeAlone {}
			
			
				// WooCommerce - Product Page
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "product_page",
					"name" => __("Product Page", "ancora"),
					"description" => __("WooCommerce shortcode: display single product page", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_product_page',
					"class" => "trx_sc_single trx_sc_product_page",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "sku",
							"heading" => __("SKU", "ancora"),
							"description" => __("SKU code of displayed product", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "id",
							"heading" => __("ID", "ancora"),
							"description" => __("ID of displayed product", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "posts_per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "1",
							"type" => "textfield"
						),
						array(
							"param_name" => "post_type",
							"heading" => __("Post type", "ancora"),
							"description" => __("Post type for the WP query (leave 'product')", "ancora"),
							"class" => "",
							"value" => "product",
							"type" => "textfield"
						),
						array(
							"param_name" => "post_status",
							"heading" => __("Post status", "ancora"),
							"description" => __("Display posts only with this status", "ancora"),
							"class" => "",
							"value" => array(
								__('Publish', 'ancora') => 'publish',
								__('Protected', 'ancora') => 'protected',
								__('Private', 'ancora') => 'private',
								__('Pending', 'ancora') => 'pending',
								__('Draft', 'ancora') => 'draft'
							),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Product_Page extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Product
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "product",
					"name" => __("Product", "ancora"),
					"description" => __("WooCommerce shortcode: display one product", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_product',
					"class" => "trx_sc_single trx_sc_product",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "sku",
							"heading" => __("SKU", "ancora"),
							"description" => __("Product's SKU code", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "id",
							"heading" => __("ID", "ancora"),
							"description" => __("Product's ID", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						)
					)
				) );
				
				class WPBakeryShortCode_Product extends ANCORA_VC_ShortCodeSingle {}
			
			
				// WooCommerce - Best Selling Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "best_selling_products",
					"name" => __("Best Selling Products", "ancora"),
					"description" => __("WooCommerce shortcode: show best selling products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_best_selling_products',
					"class" => "trx_sc_single trx_sc_best_selling_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						)
					)
				) );
				
				class WPBakeryShortCode_Best_Selling_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Recent Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "recent_products",
					"name" => __("Recent Products", "ancora"),
					"description" => __("WooCommerce shortcode: show recent products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_recent_products',
					"class" => "trx_sc_single trx_sc_recent_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Recent_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Related Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "related_products",
					"name" => __("Related Products", "ancora"),
					"description" => __("WooCommerce shortcode: show related products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_related_products',
					"class" => "trx_sc_single trx_sc_related_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "posts_per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Related_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Featured Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "featured_products",
					"name" => __("Featured Products", "ancora"),
					"description" => __("WooCommerce shortcode: show featured products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_featured_products',
					"class" => "trx_sc_single trx_sc_featured_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Featured_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Top Rated Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "top_rated_products",
					"name" => __("Top Rated Products", "ancora"),
					"description" => __("WooCommerce shortcode: show top rated products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_top_rated_products',
					"class" => "trx_sc_single trx_sc_top_rated_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Top_Rated_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Sale Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "sale_products",
					"name" => __("Sale Products", "ancora"),
					"description" => __("WooCommerce shortcode: list products on sale", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_sale_products',
					"class" => "trx_sc_single trx_sc_sale_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Sale_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Product Category
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "product_category",
					"name" => __("Products from category", "ancora"),
					"description" => __("WooCommerce shortcode: list products in specified category(-ies)", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_product_category',
					"class" => "trx_sc_single trx_sc_product_category",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						),
						array(
							"param_name" => "category",
							"heading" => __("Categories", "ancora"),
							"description" => __("Comma separated category slugs", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "operator",
							"heading" => __("Operator", "ancora"),
							"description" => __("Categories operator", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('IN', 'ancora') => 'IN',
								__('NOT IN', 'ancora') => 'NOT IN',
								__('AND', 'ancora') => 'AND'
							),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Product_Category extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Products
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "products",
					"name" => __("Products", "ancora"),
					"description" => __("WooCommerce shortcode: list all products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_products',
					"class" => "trx_sc_single trx_sc_products",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "skus",
							"heading" => __("SKUs", "ancora"),
							"description" => __("Comma separated SKU codes of products", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "ids",
							"heading" => __("IDs", "ancora"),
							"description" => __("Comma separated ID of products", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						)
					)
				) );
				
				class WPBakeryShortCode_Products extends ANCORA_VC_ShortCodeSingle {}
			
			
			
			
				// WooCommerce - Product Attribute
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "product_attribute",
					"name" => __("Products by Attribute", "ancora"),
					"description" => __("WooCommerce shortcode: show products with specified attribute", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_product_attribute',
					"class" => "trx_sc_single trx_sc_product_attribute",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "per_page",
							"heading" => __("Number", "ancora"),
							"description" => __("How many products showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						),
						array(
							"param_name" => "attribute",
							"heading" => __("Attribute", "ancora"),
							"description" => __("Attribute name", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "filter",
							"heading" => __("Filter", "ancora"),
							"description" => __("Attribute value", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						)
					)
				) );
				
				class WPBakeryShortCode_Product_Attribute extends ANCORA_VC_ShortCodeSingle {}
			
			
			
				// WooCommerce - Products Categories
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "product_categories",
					"name" => __("Product Categories", "ancora"),
					"description" => __("WooCommerce shortcode: show categories with products", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_product_categories',
					"class" => "trx_sc_single trx_sc_product_categories",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "number",
							"heading" => __("Number", "ancora"),
							"description" => __("How many categories showed", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => __("Columns", "ancora"),
							"description" => __("How many columns per row use for categories output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "4",
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => __("Order by", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array(
								__('Date', 'ancora') => 'date',
								__('Title', 'ancora') => 'title'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => __("Order", "ancora"),
							"description" => __("Sorting order for products output", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => array_flip($ANCORA_GLOBALS['sc_params']['ordering']),
							"type" => "dropdown"
						),
						array(
							"param_name" => "parent",
							"heading" => __("Parent", "ancora"),
							"description" => __("Parent category slug", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "date",
							"type" => "textfield"
						),
						array(
							"param_name" => "ids",
							"heading" => __("IDs", "ancora"),
							"description" => __("Comma separated ID of products", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "hide_empty",
							"heading" => __("Hide empty", "ancora"),
							"description" => __("Hide empty categories", "ancora"),
							"class" => "",
							"value" => array("Hide empty" => "1" ),
							"type" => "checkbox"
						)
					)
				) );
				
				class WPBakeryShortCode_Products_Categories extends ANCORA_VC_ShortCodeSingle {}
			
				/*
			
				// WooCommerce - Add to cart
				//-------------------------------------------------------------------------------------
				
				vc_map( array(
					"base" => "add_to_cart",
					"name" => __("Add to cart", "ancora"),
					"description" => __("WooCommerce shortcode: Display a single product price + cart button", "ancora"),
					"category" => __('WooCommerce', 'js_composer'),
					'icon' => 'icon_trx_add_to_cart',
					"class" => "trx_sc_single trx_sc_add_to_cart",
					"content_element" => true,
					"is_container" => false,
					"show_settings_on_create" => true,
					"params" => array(
						array(
							"param_name" => "id",
							"heading" => __("ID", "ancora"),
							"description" => __("Product's ID", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "sku",
							"heading" => __("SKU", "ancora"),
							"description" => __("Product's SKU code", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "quantity",
							"heading" => __("Quantity", "ancora"),
							"description" => __("How many item add", "ancora"),
							"admin_label" => true,
							"class" => "",
							"value" => "1",
							"type" => "textfield"
						),
						array(
							"param_name" => "show_price",
							"heading" => __("Show price", "ancora"),
							"description" => __("Show price near button", "ancora"),
							"class" => "",
							"value" => array("Show price" => "true" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "class",
							"heading" => __("Class", "ancora"),
							"description" => __("CSS class", "ancora"),
							"class" => "",
							"value" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "style",
							"heading" => __("CSS style", "ancora"),
							"description" => __("CSS style for additional decoration", "ancora"),
							"class" => "",
							"value" => "",
							"type" => "textfield"
						)
					)
				) );
				
				class WPBakeryShortCode_Add_To_Cart extends ANCORA_VC_ShortCodeSingle {}
				*/
			}

		}
	}
}
?>