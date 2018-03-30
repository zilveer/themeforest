<?php

if(function_exists('vc_map')) {

	function iron_register_js_composer() {

		global $wpdb;
		
		require_once(IRON_PARENT_DIR."/admin/options/fields/fontawesome/field_fontawesome.php");
		$fontawesome = new Redux_Options_fontawesome(array('id'=>'fontawsome_vc_icons'), '', null);
		$font_icons = $fontawesome->icons;
	
	
	
		$css_animations = array(
			'None' 					=> '',
			'Left to Right Effect' 	=> 'wpb_animate_when_almost_visible wpb_left-to-right',
			'Right to Left Effect' 	=> 'wpb_animate_when_almost_visible wpb_right-to-left',
			'Top to Bottom Effect' 	=> 'wpb_animate_when_almost_visible wpb_top-to-bottom',
			'Bottom to Top Effect' 	=> 'wpb_animate_when_almost_visible wpb_bottom-to-top',
			'Appear From Center' 	=> 'wpb_animate_when_almost_visible wpb_appear'
		);
	
		$row_params = array(
		    array(
		      "type" => "dropdown",
		      "heading" => __('Type', 'js_composer'),
		      "param_name" => "iron_row_type",
		      "description" => __("You can specify whether the row is displayed fullwidth or in container.", "js_composer"),
		      "value" => array(
	                        
	            __("In Container", 'js_composer') => 'in_container',
	            __("Fullwidth", 'js_composer') => 'full_width'
	          ),
	          'save_always' => true,
		    ),
		    
		    array(
		      "type" => "dropdown",
		      "heading" => __('Remove Padding On Medium & Small Screens (1024px)', 'js_composer'),
		      "param_name" => "iron_remove_padding_medium",
		      "value" => array(
	                        
	            __("No", 'js_composer') => '',
	            __("Yes", 'js_composer') => 'tabletnopadding'
	          ),
	          'save_always' => true,
		    ),
		    
		    array(
		      "type" => "dropdown",
		      "heading" => __('Remove Padding On Small Screens Only (700px)', 'js_composer'),
		      "param_name" => "iron_remove_padding_small",
		      "value" => array(
	                        
	            __("No", 'js_composer') => '',
	            __("Yes", 'js_composer') => 'mobilenopadding'
	          ),
	          'save_always' => true,
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("ID Name for Navigation", "js_composer"),
		      "param_name" => "iron_id",
		      "description" => __('If this row wraps the content of one of your sections, set an ID. You can then use it for navigation.<br>Ex: if you enter "work" then you can add a custom link to the menu as follow: "#work". Once this link is clicked, the page will be scrolled to that specific section.', "js_composer")
		    ), 
		    array(
		      "type" => "colorpicker",
		      "heading" => __('Overlay Color', 'js_composer'),
		      "param_name" => "iron_overlay_color",
		      "description" => __("You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white ", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __('Overlay Pattern', 'js_composer'),
		      "param_name" => "iron_overlay_pattern",
		      "description" => __("You can set an overlay pattern over the background image", "js_composer"),
		      "value" => array(
		      	__("", 'js_composer') => '',
	            __("Brick", 'js_composer') => 'brick',
	            __("Dot", 'js_composer') => 'dot',
	            __("Zig Zag", 'js_composer') => 'zigzag',
				__("45 Degrees Dash", 'js_composer') => '45_degree_dash',
	            __("45 Degrees Grid", 'js_composer') => '45_degree_grid',
	            __("45 Degrees Line Small", 'js_composer') => '45_degree_line_small',
	            __("45 Degrees Line Medium", 'js_composer') => '45_degree_line_medium',
	            __("45 Degrees Line Large", 'js_composer') => '45_degree_line_large'
	          ),
	          'save_always' => true,
		    ),   
		    array(
		      "type" => "dropdown",
		      "heading" => __('Activate Parallax', 'js_composer'),
		      "param_name" => "iron_parallax",
		      "description" => __("You will need to add a background image within the design tab.", "js_composer"),
		      "value" => array(
	                        
	            __("No", 'js_composer') => '',
	            __("Yes", 'js_composer') => 'parallax'
	          ),
	          'save_always' => true,
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __('Activate Background Video', 'js_composer'),
		      "param_name" => "iron_bg_video",
		      "value" => array(
	                        
	            __("No", 'js_composer') => '',
	            __("Yes", 'js_composer') => 'bg_video'
	          ),
	          'save_always' => true,
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __('Video Url (Self Hosted MP4)', 'js_composer'),
		      "param_name" => "iron_bg_video_mp4",
		      "value" => ''      
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __('Video Url (Self Hosted WebM)', 'js_composer'),
		      "param_name" => "iron_bg_video_webm",
		      "value" => ''      
		    ),
		    array(
		      "type" => "attach_image",
		      "heading" => __('Video Image Fallback', 'js_composer'),
		      "description" => __("This image will replace video if its not supported by device.", "js_composer"),
		      "param_name" => "iron_bg_video_poster",
		      "value" => ''      
		    ),
		);
		
		foreach($row_params as $param) {
			vc_add_param('vc_row', $param);
		}
		vc_remove_param('vc_row', 'font_color');
		vc_remove_param('vc_row_inner', 'font_color');
		vc_remove_param('vc_custom_heading', 'el_class');
		vc_remove_param('vc_row', 'full_width');
		vc_remove_param('vc_row', 'parallax');
		vc_remove_param('vc_row', 'parallax_image');
		vc_remove_param('vc_row', 'parallax_speed_video');
		vc_remove_param('vc_row', 'parallax_speed_bg');
		vc_remove_param('vc_row', 'el_id');
		vc_remove_param('vc_row', 'full_height');
		vc_remove_param('vc_row', 'content_placement');
		vc_remove_param('vc_row', 'video_bg');
		vc_remove_param('vc_row', 'video_bg_url');
		vc_remove_param('vc_row', 'video_bg_parallax');
		vc_remove_param('vc_row', 'columns_placement');	
		vc_remove_param('vc_row', 'equal_height');	

		vc_add_param('vc_custom_heading', array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.<br><br>Insert the class <b><a href="#" onclick="jQuery(this).closest(\'.vc_shortcode-param\').find(\'.el_class\').val(jQuery(this).html()); return false">fittext</a></b> to make heading responsive and fit mobile screens correctly', 'js_composer' ),
        ));
	
		vc_map( array(
		   "name" => _x("Audio Player", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_audioplayer",
		   "class" => "",
		   "icon" => "iron_vc_icon_audio_player",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "album",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Albums", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "albums",
		         "value" => '',
		         "description" => '',
	          	'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Auto Play", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "autoplay",
		         "value" => array(
	                _x("No", 'VC', IRON_TEXT_DOMAIN)=> 0,
	                _x("Yes", 'VC', IRON_TEXT_DOMAIN)=> 1,
	              ),
		         "description" => '',
	          'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Show Playlist", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "show_playlist",
		         "value" => array(
	                _x("No", 'VC', IRON_TEXT_DOMAIN)=> 0,
	                _x("Yes", 'VC', IRON_TEXT_DOMAIN)=> 1,
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),
		      	      
		   )
	
		));
	
		vc_map( array(
		   "name" => _x("Discography", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_discography",
		   "class" => "",
		   "icon" => "iron_vc_icon_discography",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "album",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Albums", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "albums",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),
		      	      
		   )
	
		));
	
		vc_map( array(
		   "name" => _x("Twitter", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_twitter",
		   "class" => "",
		   "icon" => "iron_vc_icon_twitter",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x('Screen Name (ex: @IronTemplates)', 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "screen_name",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),	      
		   )
	
		));
	
	
		vc_map( array(
		   "name" => _x("News", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_posts",
		   "class" => "",
		   "icon" => "iron_vc_icon_news",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Number of posts to show", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "number",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "taxonomy_multiselect",
		         "taxonomy" => "category",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Select one or multiple categories", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "category",
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("View As", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "view",
		         "value" => array(
	                _x("Grid", 'VC', IRON_TEXT_DOMAIN)=> 'post_grid',
	                _x("List", 'VC', IRON_TEXT_DOMAIN)=> 'post',
					_x("Simple", 'VC', IRON_TEXT_DOMAIN)=> 'post_simple',
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Show Excerpts", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "enable_excerpts",
		         "value" => array(
	                _x("No", 'VC', IRON_TEXT_DOMAIN)=> 0,
	                _x("Yes", 'VC', IRON_TEXT_DOMAIN)=> 1,
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Show Date", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "show_date",
		         "value" => array(
	                _x("Yes", 'VC', IRON_TEXT_DOMAIN)=> 1,
	                _x("No", 'VC', IRON_TEXT_DOMAIN)=> 0,
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),	      
		   )
	
		));
	
	
		vc_map( array(
		   "name" => _x("Videos", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_recentvideos",
		   "class" => "",
		   "icon" => "iron_vc_icon_videos",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Number of videos to show (*apply only for categories):", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "number",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "taxonomy_multiselect",
		         "taxonomy" => "video-category",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Select one or multiple categories", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "category",
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "video",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Select Videos", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "include",
		         "description" => '',
		         'save_always' => true,
		      ),
		       array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("What happens when you click the video's thumbnails ?", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "video_link_type",
		         "value" => array(
	                _x("Go to detailed video page", 'VC', IRON_TEXT_DOMAIN) => 'single',
	                _x("Open video in a LightBox", 'VC', IRON_TEXT_DOMAIN) => 'lightbox',
	                _x("Replace image by video", 'VC', IRON_TEXT_DOMAIN) => 'inline',
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("View As", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "view",
		         "value" => array(
	                _x("Grid", 'VC', IRON_TEXT_DOMAIN)=> 'video_grid',
	                _x("List", 'VC', IRON_TEXT_DOMAIN)=> 'video_list',
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),
		   )
	
		));
	
		vc_map( array(
		   "name" => _x("Photos", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_featuredphotos",
		   "class" => "",
		   "icon" => "iron_vc_icon_photos",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		         "description" => '',
		      ),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "photo-album",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Albums", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "albums",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Gallery Layout", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "gallery_layout",
		         "value" => array(
	                _x("Fit photos within window height (Gallery bottom will be flat, some photos might be hidden)", 'VC', IRON_TEXT_DOMAIN)=> 'window_height',
	                _x("Fit photos within custom height (Gallery bottom will be flat, manually adjust gallery height)", 'VC', IRON_TEXT_DOMAIN)=> 'custom_height',
	                _x("Show all photos (Gallery bottom might not be flat)", 'VC', IRON_TEXT_DOMAIN)=> 'show_all',
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Gallery Height", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "gallery_height",
		         "value" => '',
		         "description" => 'Height in pixels. Leave empty to use window height',
		         'dependency' => array(
		         	'element' => 'gallery_layout',
		         	'value' => 'custom_height'
		         )
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),
		      	      
		   )
	
		));	
		vc_map( array(
		   "name" => _x("Events", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_events",
		   "class" => "",
		   "icon" => "iron_vc_icon_events",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "title",
		         "value" => "",
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Number of events to show", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "number",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Filter by", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "filter",
				 "value" => array(
	                _x("Upcoming Events", 'VC', IRON_TEXT_DOMAIN)=> 'upcoming',
					_x("Past Events", 'VC', IRON_TEXT_DOMAIN) => 'past'
	              ),
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Title", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_title",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_obj_id",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Call To Action External Link", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "action_ext_link",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "dropdown",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "css_animation",
		         "value" => $css_animations,
		         "description" => '',
		         'save_always' => true,
		      ),
		   )
	
		));

		if (function_exists('is_plugin_active') && is_plugin_active('nmedia-mailchimp-widget/nm_mailchimp.php')) {
	
			$results = $wpdb->get_results('SELECT form_id, form_name FROM '.$wpdb->prefix.'nm_mc_forms ORDER BY form_name');
			$newsletters = array();
			foreach($results as $result) {
			
				$name = !empty($result->form_name) ? $result->form_name : $result->form_id;
				$id = $result->form_id;
				
				$newsletters[$name] = $id;
			}
			
			vc_map( array(
			   "name" => _x("Newsletter", 'VC', IRON_TEXT_DOMAIN),
			   "base" => "iron_newsletter",
			   "class" => "",
			   "icon" => "iron_vc_icon_newsletter",
			   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
			   "params" => array(
			      array(
			         "type" => "textfield",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("Title", 'VC', IRON_TEXT_DOMAIN),
			         "param_name" => "title",
			         "value" => _x("", 'VC', IRON_TEXT_DOMAIN),
			         "description" => '',
			      ),
			      array(
			         "type" => "textarea",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("Description", 'VC', IRON_TEXT_DOMAIN),
			         "param_name" => "description",
			         "value" => _x("", 'VC', IRON_TEXT_DOMAIN),
			         "description" => '',
			      ),
			      array(
			         "type" => "dropdown",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("Newsletters", 'VC', IRON_TEXT_DOMAIN),
			         "param_name" => "fid",
					 "value" => $newsletters,
			         "description" => '',
			         'save_always' => true,
			      ),
			      array(
			         "type" => "dropdown",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
			         "param_name" => "css_animation",
			         "value" => $css_animations,
			         "description" => '',
			         'save_always' => true,
			      ),
			   )
		
			));
	
		}

		vc_map( array(
			"name" => _x("Promotion", 'VC', IRON_TEXT_DOMAIN),
			"base" => "iron_promotion",
			"class" => "",
			"icon" => "iron_vc_icon_promobox",
			"category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
			"params" => array(
				array(
					"param_name" => "image",
					"type" => "attach_image",
					"heading" => _x('Image', 'VC', IRON_TEXT_DOMAIN),
					"description" => ''
				),
				array(
					"param_name" => "title",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Title', 'VC', IRON_TEXT_DOMAIN),
					"value" => "",
					"description" => '',
				),
		        array(
		          "param_name" => "title_tag_name",
		          "type" => "dropdown",
		          "heading" => _x("Title Tag Name", 'VC', IRON_TEXT_DOMAIN),
		          "value" => array(
		              "h3" => "h3",
		              "h2" => "h2",
		              "h4" => "h4",
		              "h5" => "h5",
		              "h6" => "h6",
		              "h1" => "h1"
		          ),
		          'save_always' => true,
				),
				array(
			      "param_name" => "title_color",
			      "type" => "colorpicker",
			      "heading" => _x('Title Color', 'VC', IRON_TEXT_DOMAIN),
			      "description" => '',
			      "value" => "",
			    ),	
				array(
					"param_name" => "subtitle",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Subtitle', 'VC', IRON_TEXT_DOMAIN),
					"value" => "",
					"description" => '',
				),
		        array(
		          "param_name" => "subtitle_tag_name",
		          "type" => "dropdown",
		          "heading" => _x("Subtitle Tag Name", 'VC', IRON_TEXT_DOMAIN),
		          "value" => array(
		              "h3" => "h3",
		              "h2" => "h2",
		              "h4" => "h4",
		              "h5" => "h5",
		              "h6" => "h6",
		              "h1" => "h1"
		          ),
		          'save_always' => true,
				),
				array(
			      "param_name" => "subtitle_color",
			      "type" => "colorpicker",
			      "heading" => _x('Subtitle Color', 'VC', IRON_TEXT_DOMAIN),
			      "description" => '',
			      "value" => "",
			    ),	
				array(
			      "param_name" => "title_align",
			      "type" => "dropdown",
			      "heading" => _x('Title Align', 'VC', IRON_TEXT_DOMAIN),
			      "value" => array(
							_x('Left', 'VC', IRON_TEXT_DOMAIN) => 'left',
							_x('Center', 'VC', IRON_TEXT_DOMAIN) => 'center',
							_x('Right', 'VC', IRON_TEXT_DOMAIN) => 'right',
						),
			    ),
			    array(
			      "param_name" => "overlay_color",
			      "type" => "colorpicker",
			      "heading" => _x('Overlay Color', 'VC', IRON_TEXT_DOMAIN),
			      "description" => '',
			      "value" => "rgb(0,0,0)",
			    ),
				array(
					"param_name" => "link_page",
					"type" => "post_select",
					"post_type" => "page",
					"holder" => "div",
					"class" => "",
					"heading" => _x("Link Page", 'VC', IRON_TEXT_DOMAIN),
					"value" => '',
					"description" => '',
					'save_always' => true,
				),
				array(
					"param_name" => "link_product",
					"type" => "post_select",
					"post_type" => "product",
					"holder" => "div",
					"class" => "",
					"heading" => _x("Link Product", 'VC', IRON_TEXT_DOMAIN),
					"value" => '',
					"description" => '',
					'save_always' => true,
				),
				array(
					"param_name" => "link_external",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x("Link External", 'VC', IRON_TEXT_DOMAIN),
					"value" => '',
					"description" => '',
				),
				array(
			      "param_name" => "hover_animation",
			      "type" => "dropdown",
			      "heading" => _x('Hover Animation', 'VC', IRON_TEXT_DOMAIN),
			      "value" => array(
							_x('Slide', 'VC', IRON_TEXT_DOMAIN) => 'slide',
							_x('Zoom', 'VC', IRON_TEXT_DOMAIN) => 'zoom',
						),
			      'save_always' => true,
			    ),
				array(
			         "type" => "dropdown",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
			         "param_name" => "css_animation",
			         "value" => $css_animations,
			         "description" => '',
			         'save_always' => true,
			     ),
			)
		));



/*


		vc_map( array(
			"name" => _x("InfoBox", 'VC', IRON_TEXT_DOMAIN),
			"base" => "iron_infobox",
			"class" => "",
			"icon" => "iron_vc_icon_infobox",
			"category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
			"params" => array(

				array(
					"param_name" => "icon",
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Icon', 'VC', IRON_TEXT_DOMAIN),
					"value" => $font_icons,
					"description" => '',
				),
				array(
					"param_name" => "title",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Title', 'VC', IRON_TEXT_DOMAIN),
					"value" => "",
					"description" => '',
				),
				array(
		          "param_name" => "title_tag_name",
		          "type" => "dropdown",
		          "heading" => _x("Title Tag Name", 'VC', IRON_TEXT_DOMAIN),
		          "value" => array(
		              "h3" => "h3",
		              "h2" => "h2",
		              "h4" => "h4",
		              "h5" => "h5",
		              "h6" => "h6",
		              "h1" => "h1"
				   )
				), 
				array(
					 "param_name" => "description",
			         "type" => "textarea",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("Description", 'VC', IRON_TEXT_DOMAIN),
			         "value" => "",
			         "description" => '',
			    ),
			    array(
			         "type" => "dropdown",
			         "holder" => "div",
			         "class" => "",
			         "heading" => _x("CSS Animation", 'VC', IRON_TEXT_DOMAIN),
			         "param_name" => "css_animation",
			         "value" => $css_animations,
			         "description" => '',
			    ),
 			)
		));
*/

	
		vc_map( array(
		   "name" => _x("Logos Slider", 'VC', IRON_TEXT_DOMAIN),
		   "base" => "iron_logos",
		   "class" => "",
		   "icon" => "iron_vc_icon_iosslider",
		   "category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
		   "params" => array(
		   		array(
					"param_name" => "title",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Title', 'VC', IRON_TEXT_DOMAIN),
					"value" => "",
					"description" => '',
				),
		      array(
		         "type" => "post_multiselect",
		         "post_type" => "logo",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Logos", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "logos",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		   )
		));

		vc_map( array(
			"name" => _x("Image Divider", 'VC', IRON_TEXT_DOMAIN),
			"base" => "iron_image_divider",
			"class" => "",
			"icon" => "iron_vc_icon_iosslider",
			"category" => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
			"params" => array(
				array(
					"param_name" => "divider_image",
					"type" => "attach_image",
					"heading" => _x('Divider Image', 'VC', IRON_TEXT_DOMAIN),
					"description" => ''
				),
		    array(
		      "param_name" => "divider_color",
		      "type" => "colorpicker",
		      "heading" => _x('Divider Color', 'VC', IRON_TEXT_DOMAIN),
		      "description" => 'If no image chosen, the default css divider will be used',
		    ),
		    array(
		      "param_name" => "divider_align",
		      "type" => "dropdown",
		      "heading" => _x('Divider Align', 'VC', IRON_TEXT_DOMAIN),
		      "value" => array(
						_x('Left', 'VC', IRON_TEXT_DOMAIN) => 'left',
						_x('Center', 'VC', IRON_TEXT_DOMAIN) => 'center',
						_x('Right', 'VC', IRON_TEXT_DOMAIN) => 'right',
					),
		      'save_always' => true,
		    ),
				array(
					"param_name" => "divider_padding_top",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Divider Padding Top', 'VC', IRON_TEXT_DOMAIN),
					"value" => "",
					"description" => '',
				),
				array(
					"param_name" => "divider_padding_bottom",
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => _x('Divider Padding Bottom', 'VC', IRON_TEXT_DOMAIN),
					"value" => "",
					"description" => '',
				),
			)
		));

		vc_map( array(
			'name' => __( 'Button', 'js_composer' ),
			'base' => 'iron_button',
			'icon' => 'iron_vc_icon_iosslider',
			'category' => _x('IRON Widgets', 'VC', IRON_TEXT_DOMAIN),
			'params' => array(
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Text", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "text",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
				  "param_name" => "text_align",
				  "type" => "dropdown",
				  "heading" => _x('Text Align', 'VC', IRON_TEXT_DOMAIN),
				  "value" => array(
						_x('Left', 'VC', IRON_TEXT_DOMAIN) => 'left',
						_x('Center', 'VC', IRON_TEXT_DOMAIN) => 'center',
						_x('Right', 'VC', IRON_TEXT_DOMAIN) => 'right',
					),
				  'save_always' => true,
			  ),
		      array(
		         "type" => "post_select",
		         "post_type" => "page",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Link Page", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "link_page",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "post_select",
		         "post_type" => "product",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Link Product", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "link_product",
		         "value" => '',
		         "description" => '',
		         'save_always' => true,
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Link External", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "link_external",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Border Width (px)", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "border_width",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
		         "type" => "textfield",
		         "holder" => "div",
		         "class" => "",
		         "heading" => _x("Border Radius (px)", 'VC', IRON_TEXT_DOMAIN),
		         "param_name" => "border_radius",
		         "value" => '',
		         "description" => '',
		      ),
		      array(
			      "type" => "colorpicker",
				  "heading" => _x("Border Color", 'VC', IRON_TEXT_DOMAIN),
			      "param_name" => "border_color",
			      "description" => '',
			    ),
			    array(
			      "type" => "colorpicker",
				  "heading" => _x("Background Color", 'VC', IRON_TEXT_DOMAIN),
			      "param_name" => "background_color",
			      "description" => '',
			    ),
			    array(
			      "type" => "colorpicker",
				  "heading" => _x("Text Color", 'VC', IRON_TEXT_DOMAIN),
			      "param_name" => "text_color",
			      "description" => '',
			    ),
			    array(
			      "type" => "colorpicker",
				  "heading" => _x("Hover Border Color", 'VC', IRON_TEXT_DOMAIN),
			      "param_name" => "hover_border_color",
			      "description" => '',
			    ),
			    array(
			      "type" => "colorpicker",
				  "heading" => _x("Hover Background Color", 'VC', IRON_TEXT_DOMAIN),
			      "param_name" => "hover_bg_color",
			      "description" => '',
			    ),
			    array(
			      "type" => "colorpicker",
				  "heading" => _x("Hover Text Color", 'VC', IRON_TEXT_DOMAIN),
			      "param_name" => "hover_text_color",
			      "description" => '',
			    )
			),
		));


	
	}
	add_action('init', 'iron_register_js_composer');
}