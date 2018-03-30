<?php
// **********************************************************************// 
// ! Visual Composer Setup
// **********************************************************************//

add_action( 'init', 'etheme_VS_setup');

if(!function_exists('etheme_VS_setup')) {
	if(!function_exists('getCSSAnimation')) {
		function getCSSAnimation($css_animation) {
            $output = '';
            if ( $css_animation != '' ) {
                wp_enqueue_script( 'waypoints' );
                $output = ' wpb_animate_when_almost_visible wpb_'.$css_animation;
            }
            return $output;
		}
	}
	if(!function_exists('buildStyle')) {
	    function buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '') {
	        $has_image = false;
	        $style = '';
	        if((int)$bg_image > 0 && ($image_url = wp_get_attachment_url( $bg_image, 'large' )) !== false) {
	            $has_image = true;
	            $style .= "background-image: url(".$image_url.");";
	        }
	        if(!empty($bg_color)) {
	            $style .= vc_get_css_color('background-color', $bg_color);
	        }
	        if(!empty($bg_image_repeat) && $has_image) {
	            if($bg_image_repeat === 'cover') {
	                $style .= "background-repeat:no-repeat;background-size: cover;";
	            } elseif($bg_image_repeat === 'contain') {
	                $style .= "background-repeat:no-repeat;background-size: contain;";
	            } elseif($bg_image_repeat === 'no-repeat') {
	                $style .= 'background-repeat: no-repeat;';
	            }
	        }
	        if( !empty($font_color) ) {
	            $style .= vc_get_css_color('color', $font_color); // 'color: '.$font_color.';';
	        }
	        if( $padding != '' ) {
	            $style .= 'padding: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding.'px').';';
	        }
	        if( $margin_bottom != '' ) {
	            $style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom.'px').';';
	        }
	        return empty($style) ? $style : ' style="'.$style.'"';
	    }
	}
	function etheme_VS_setup() {
		global $vc_params_list;
		if (!class_exists('WPBakeryVisualComposerAbstract')) return;
		
		$vc_params_list[] = 'icon';
	
	    // **********************************************************************// 
	    // ! Register New Element: Brands
	    // **********************************************************************//
	
	    $brands_params = array(
	      'name' => 'Brands',
	      'base' => 'brands',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display type", ETHEME_DOMAIN),
	          "param_name" => "display_type",
	          "value" => array( 
	              __("Slider", ETHEME_DOMAIN) => 'slider',
	              __("Grid", ETHEME_DOMAIN) => 'grid'
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Number of columns", ETHEME_DOMAIN),
	          "param_name" => "columns",	          
	          "dependency" => Array('element' => "display_type", 'value' => array('grid')),
	          "value" => array( 
	              '2' => 2,
	              '3' => 3,
	              '4' => 4,
	              '5' => 5,
	              '6' => 6,
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Maximum number of brands to display", ETHEME_DOMAIN),
	          "param_name" => "limit"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class"
	        )
	      )
	
	    );  
	
	    vc_map($brands_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Search Form
	    // **********************************************************************//
	
	    $search_params = array(
	      'name' => 'Mega Search Form',
	      'base' => 'etheme_search',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "dropdown",
	          "heading" => __("Search for products", "js_composer"),
	          "param_name" => "products",
	          "value" => array( 
	              "", 
	              __("Yes", ETHEME_DOMAIN) => 1,
	              __("No", ETHEME_DOMAIN) => 0
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display images for products", ETHEME_DOMAIN),
	          "param_name" => "images",
	          "value" => array( 
	              "", 
	              __("Yes", ETHEME_DOMAIN) => 1,
	              __("No", ETHEME_DOMAIN) => 0
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Search for posts", "js_composer"),
	          "param_name" => "posts",
	          "value" => array( 
	              "", 
	              __("Yes", ETHEME_DOMAIN) => 1,
	              __("No", ETHEME_DOMAIN) => 0
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Search in portfolio", "js_composer"),
	          "param_name" => "portfolio",
	          "value" => array( 
	              "", 
	              __("Yes", ETHEME_DOMAIN) => 1,
	              __("No", ETHEME_DOMAIN) => 0
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Search for pages", "js_composer"),
	          "param_name" => "pages",
	          "value" => array( 
	              "", 
	              __("Yes", ETHEME_DOMAIN) => 1,
	              __("No", ETHEME_DOMAIN) => 0
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items from each section", ETHEME_DOMAIN),
	          "param_name" => "count"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class"
	        )
	      )
	
	    );  
	
	    vc_map($search_params);
	
	
	    // **********************************************************************// 
	    // ! Register New Element: Twitter Slider
	    // **********************************************************************//
	
	    $twitter_params = array(
	      'name' => 'Twitter Slider',
	      'base' => 'twitter_slider',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("User account name", ETHEME_DOMAIN),
	          "param_name" => "user"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Consumer Key", ETHEME_DOMAIN),
	          "param_name" => "consumer_key"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Consumer Secret", ETHEME_DOMAIN),
	          "param_name" => "consumer_secret"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("User Token", ETHEME_DOMAIN),
	          "param_name" => "user_token"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("User Secret", ETHEME_DOMAIN),
	          "param_name" => "user_secret"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ETHEME_DOMAIN),
	          "param_name" => "limit"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Choose color scheme ", ETHEME_DOMAIN),
	          "param_name" => "style",
	          "value" => array( 
				__("Light", ETHEME_DOMAIN) => "white",
	          	__("Dark", ETHEME_DOMAIN) => "dark", 
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class"
	        ),
	      )
	
	    );  
	
	    vc_map($twitter_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Testimonials Widget
	    // **********************************************************************//
	
	    $testimonials_params = array(
	      'name' => 'Testimonials widget',
	      'base' => 'testimonials',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ETHEME_DOMAIN),
	          "param_name" => "limit",
	          "description" => __('How many testimonials to show? Enter number.', ETHEME_DOMAIN)
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display type", "js_composer"),
	          "param_name" => "type",
	          "value" => array( 
	              "", 
	              __("Slider", ETHEME_DOMAIN) => 'slider',
	              __("Grid", ETHEME_DOMAIN) => 'grid'
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Interval", ETHEME_DOMAIN),
	          "param_name" => "interval",
	          "description" => __('Interval between slides. In milliseconds. Default: 10000', ETHEME_DOMAIN),
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Show Control Navigation", "js_composer"),
	          "param_name" => "navigation",
	          "dependency" => Array('element' => "type", 'value' => array('slider')),
	          "value" => array( 
	              "", 
	              __("Hide", ETHEME_DOMAIN) => 'hide',
	              __("Show", ETHEME_DOMAIN) => 'show'
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Category", ETHEME_DOMAIN),
	          "param_name" => "category",
	          "description" => __('Display testimonials from category.', ETHEME_DOMAIN)
	        ),
	      )
	
	    );  
	
	    vc_map($testimonials_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Recent Comments Widget
	    // **********************************************************************//
	
	    $recent_comments_params = array(
	      'name' => 'Recent comments widget',
	      'base' => 'et_recent_comments',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'textfield',
	          "heading" => __("Widget title", ETHEME_DOMAIN),
	          "param_name" => "title",
	          "description" => __("What text use as a widget title. Leave blank if no title is needed.", ETHEME_DOMAIN)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ETHEME_DOMAIN),
	          "param_name" => "number",
	          "description" => __('How many comments to show? Enter number.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($recent_comments_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Recent Posts Widget
	    // **********************************************************************//
	
	    $recent_posts_params = array(
	      'name' => 'Recent posts widget',
	      'base' => 'et_recent_posts_widget',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'textfield',
	          "heading" => __("Widget title", ETHEME_DOMAIN),
	          "param_name" => "title",
	          "description" => __("What text use as a widget title. Leave blank if no title is needed.", ETHEME_DOMAIN)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ETHEME_DOMAIN),
	          "param_name" => "number",
	          "description" => __('How many posts to show? Enter number.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($recent_posts_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Team Member
	    // **********************************************************************//
	
	    $team_member_params = array(
	      'name' => 'Team member',
	      'base' => 'team_member',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'textfield',
	          "heading" => __("Member name", ETHEME_DOMAIN),
	          "param_name" => "name"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Member email", ETHEME_DOMAIN),
	          "param_name" => "email"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Position", ETHEME_DOMAIN),
	          "param_name" => "position"
	        ),
	        array(
	          'type' => 'attach_image',
	          "heading" => __("Avatar", ETHEME_DOMAIN),
	          "param_name" => "img"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Image size", "js_composer"),
	          "param_name" => "img_size",
	          "description" => __("Enter image size. Example in pixels: 200x100 (Width x Height).", "js_composer")
	        ),
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          "heading" => __("Member information", "js_composer"),
	          "param_name" => "content",
	          "value" => __("Member description", "js_composer")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display Type", "js_composer"),
	          "param_name" => "type",
	          "value" => array( 
	              "", 
	              __("Vertical", ETHEME_DOMAIN) => 1,
	              __("Horizontal", ETHEME_DOMAIN) => 2
	            )
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Twitter link", ETHEME_DOMAIN),
	          "param_name" => "twitter"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Facebook link", ETHEME_DOMAIN),
	          "param_name" => "facebook"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Linkedin", ETHEME_DOMAIN),
	          "param_name" => "linkedin"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Skype name", ETHEME_DOMAIN),
	          "param_name" => "skype"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Instagram", ETHEME_DOMAIN),
	          "param_name" => "instagram"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	    vc_map($team_member_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Icon
	    // **********************************************************************//
	
	    $icon_box_params = array(
	      'name' => 'Awesome Icon',
	      'base' => 'icon',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'icon',
	          "heading" => __("Icon", ETHEME_DOMAIN),
	          "param_name" => "name"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Size", ETHEME_DOMAIN),
	          "param_name" => "size",
	          "description" => __('For example: 64')
	        ),
	        array(
	          'type' => 'colorpicker',
	          "heading" => __("Color", ETHEME_DOMAIN),
	          "param_name" => "color"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($icon_box_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Icon Box
	    // **********************************************************************//
	
	    $icon_box_params = array(
	      'name' => 'Icon Box',
	      'base' => 'icon_box',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'textfield',
	          "heading" => __("Box title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          'type' => 'icon',
	          "heading" => __("Icon", ETHEME_DOMAIN),
	          "param_name" => "icon"
	        ),
	        array(
	          'type' => 'colorpicker',
	          "heading" => __("Icon Color", ETHEME_DOMAIN),
	          "param_name" => "color"
	        ),
	        array(
	          'type' => 'colorpicker',
	          "heading" => __("Background Color", ETHEME_DOMAIN),
	          "param_name" => "bg_color"
	        ),
	        array(
	          'type' => 'colorpicker',
	          "heading" => __("Icon Color [HOVER]", ETHEME_DOMAIN),
	          "param_name" => "color_hover"
	        ),
	        array(
	          'type' => 'colorpicker',
	          "heading" => __("Background Color [HOVER]", ETHEME_DOMAIN),
	          "param_name" => "bg_color_hover"
	        ),
	        array(
	          "type" => "textarea_html",
	          'admin_label' => true,
	          "heading" => __("Text", "js_composer"),
	          "param_name" => "content",
	          "value" => __("Click edit button to change this text.", "js_composer"),
	          "description" => __("Enter your content.", "js_composer")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Icon Position", "js_composer"),
	          "param_name" => "icon_position",
	          "value" => array( 
	              "", 
	              __("Top", ETHEME_DOMAIN) => 'top',
	              __("Left", ETHEME_DOMAIN) => 'left'
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Icon Style", "js_composer"),
	          "param_name" => "icon_style",
	          "value" => array( 
	              __("Encircled", ETHEME_DOMAIN) => 'encircled',
	              __("Small", ETHEME_DOMAIN) => 'small',
	              __("Large", ETHEME_DOMAIN) => 'large'
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($icon_box_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Banner with mask
	    // **********************************************************************//
	
	    $icon_box_params = array(
	      'name' => 'Banner',
	      'base' => 'banner',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'attach_image',
	          "heading" => __("Banner Image", ETHEME_DOMAIN),
	          "param_name" => "img"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Banner size", "js_composer"),
	          "param_name" => "img_size",
	          "description" => __("Enter image size. Example in pixels: 200x100 (Width x Height).", "js_composer")
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Link", "js_composer"),
	          "param_name" => "link"
	        ),
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          "heading" => "Banner Mask Text",
	          "param_name" => "content",
	          "value" => "Some promo text"
	        ),
	        /*array(
	          "type" => "dropdown",
	          "heading" => __("Vertical Align", ETHEME_DOMAIN),
	          "param_name" => "valign",
	          "value" => array( "", __("top", ETHEME_DOMAIN) => "top", __("center", ETHEME_DOMAIN) => "center",__("bottom", ETHEME_DOMAIN) => "bottom")
	        ),*/
	        array(
	          "type" => "dropdown",
	          "heading" => __("Vertical text centering", ETHEME_DOMAIN),
	          "param_name" => "valign",
	          "value" => array( "", __("Enable", ETHEME_DOMAIN) => "middle", __("Disable", ETHEME_DOMAIN) => "top")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Banner style", ETHEME_DOMAIN),
	          "param_name" => "banner_style",
	          "value" => array( "", __("dark with border", ETHEME_DOMAIN) => "dark_border")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Font style", ETHEME_DOMAIN),
	          "param_name" => "font_style",
	          "value" => array( "", __("light", ETHEME_DOMAIN) => "light", __("dark", ETHEME_DOMAIN) => "dark")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Hover effect", ETHEME_DOMAIN),
	          "param_name" => "hover",
	          "value" => array( "", __("zoom", ETHEME_DOMAIN) => "zoom", __("fade", ETHEME_DOMAIN) => "faded")
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        ),
	        array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'js_composer' ),
			),
	      )
	
	    );  
	
	    vc_map($icon_box_params);
	
	    // **********************************************************************// 
	    // ! Register New Element:Pricing Table
	    // **********************************************************************//
	    $demoTable = "\n\t".'<ul>';
	    $demoTable .= "\n\t\t".'<li class="row-title">Free</li>';
	    $demoTable .= "\n\t\t".'<li class="row-price"><sup class="currency">$</sup>19<sup>00</sup><sub>per month</sub></li>';
	    $demoTable .= "\n\t\t".'<li>512 mb</li>';
	    $demoTable .= "\n\t\t".'<li>0.6 GHz</li>';
	    $demoTable .= "\n\t\t".'<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>';
	    $demoTable .= "\n\t\t".'<li><a href="#" class="button">Add to Cart</a></li>';
	    $demoTable .= "\n\t".'</ul>';
	    
	    
	    $ptable_params = array(
	      'name' => 'Pricing Table',
	      'base' => 'ptable',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          "heading" => "Table",
	          "param_name" => "content",
	          "value" => $demoTable
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Style", ETHEME_DOMAIN),
	          "param_name" => "style",
	          "value" => array( "", __("default", ETHEME_DOMAIN) => "default", __("Style 2", ETHEME_DOMAIN) => "style2")
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($ptable_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Single post
	    // **********************************************************************//
	
	    $fpost_params = array(
	      'name' => 'Single blog post',
	      'base' => 'single_post',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Post ID", ETHEME_DOMAIN),
	          "param_name" => "id"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Show more posts link", ETHEME_DOMAIN),
	          "param_name" => "more_posts",
	          "value" => array( "", __("Show", ETHEME_DOMAIN) => 1, __("Hide", ETHEME_DOMAIN) => 0)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($fpost_params);

	    

	    // **********************************************************************// 
	    // ! Register New Element: Countdown
	    // **********************************************************************//

		$countdown_params = array(
	      'name' => 'Countdown',
	      'base' => 'countdown',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Year", ETHEME_DOMAIN),
	          "param_name" => "year"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Month", ETHEME_DOMAIN),
	          "param_name" => "month",
	          "value" => array( 
	          	__("January", ETHEME_DOMAIN) => 'January', 
	          	__("February", ETHEME_DOMAIN) => 'February',
	          	__("March", ETHEME_DOMAIN) => 'March',
	          	__("April", ETHEME_DOMAIN) => 'April',
	          	__("May", ETHEME_DOMAIN) => 'May',
	          	__("June", ETHEME_DOMAIN) => 'June',
	          	__("July", ETHEME_DOMAIN) => 'July',
	          	__("August", ETHEME_DOMAIN) => 'August',
	          	__("September", ETHEME_DOMAIN) => 'September',
	          	__("October", ETHEME_DOMAIN) => 'October',
	          	__("November", ETHEME_DOMAIN) => 'November',
	          	__("December", ETHEME_DOMAIN) => 'December',
	          	)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Day", ETHEME_DOMAIN),
	          "param_name" => "day"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Hour", ETHEME_DOMAIN),
	          "param_name" => "hour"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Minutes", ETHEME_DOMAIN),
	          "param_name" => "minute"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Color scheme", ETHEME_DOMAIN),
	          "param_name" => "scheme",
	          "value" => array( 
				__("Light", ETHEME_DOMAIN) => "white",
	          	__("Dark", ETHEME_DOMAIN) => "dark", 
	          	)
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($countdown_params);

	    // **********************************************************************// 
	    // ! Register New Element: Product categories
	    // **********************************************************************//
	
	    $brands_params = array(
	      'name' => 'Product categories',
	      'base' => 'etheme_product_categories',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of categories", ETHEME_DOMAIN),
	          "param_name" => "number"
	        ),
	        /*
		    array(
		      "type" => "dropdown",
		      "heading" => __("Order by", "js_composer"),
		      "param_name" => "orderby",
		      "value" => array( "", __("ID", "js_composer") => "id", __("Count", "js_composer") => "count", __("Name", "js_composer") => "name",  __("Slug", "js_composer") => "slug"),
		      
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Order way", "js_composer"),
		      "param_name" => "order",
		      "value" => array( __("Descending", "js_composer") => "DESC", __("Ascending", "js_composer") => "ASC" ),
		      "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		    ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Hide empty", ETHEME_DOMAIN),
	          "param_name" => "hide_empty",
	          "value" => array( 
	              __("Enable", ETHEME_DOMAIN) => 1,
	              __("Disable", ETHEME_DOMAIN) => 0
	            )
	        ),*/
	        array(
	          "type" => "textfield",
	          "heading" => __("Parent ID", ETHEME_DOMAIN),
	          "param_name" => "parent",
              "description" => __('Get direct children of this term (only terms whose explicit parent is this value). If 0 is passed, only top-level terms are returned. Default is an empty string.', ETHEME_DOMAIN)
		    ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display type", ETHEME_DOMAIN),
	          "param_name" => "display_type",
	          "value" => array( 
	              __("Grid", ETHEME_DOMAIN) => 'grid',
	              __("Slider", ETHEME_DOMAIN) => 'slider',
	              __("Menu", ETHEME_DOMAIN) => 'menu'
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Columns", "js_composer"),
	          "param_name" => "columns",
	          "dependency" => Array('element' => "display_type", 'value' => array('grid')),
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Large Desktops", "js_composer"),
	          "param_name" => "items_l",
	          "dependency" => Array('element' => "display_type", 'value' => array('slider')),
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Desktops", "js_composer"),
	          "param_name" => "items_d",
	          "dependency" => Array('element' => "display_type", 'value' => array('slider')),
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Tablets", "js_composer"),
	          "param_name" => "items_t",
	          "dependency" => Array('element' => "display_type", 'value' => array('slider')),
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Phones", "js_composer"),
	          "param_name" => "items_p",
	          "dependency" => Array('element' => "display_type", 'value' => array('slider')),
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class"
	        )
	      )
	
	    );  
	
	    vc_map($brands_params);
	    
	    // **********************************************************************// 
	    // ! Register New Element: Teaser Box
	    // **********************************************************************//
	
	    $teaser_box_params = array(
	      'name' => 'Teaser Box',
	      'base' => 'teaser_box',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          'type' => 'attach_image',
	          "heading" => __("Image", ETHEME_DOMAIN),
	          "param_name" => "img"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Image size", "js_composer"),
	          "param_name" => "img_size",
	          "description" => __("Enter image size. Example in pixels: 200x100 (Width x Height).", "js_composer")
	        ),
	        array(
	          "type" => "textarea_html",
	          'admin_label' => true,
	          "heading" => __("Text", "js_composer"),
	          "param_name" => "content",
	          "value" => __("Click edit button to change this text.", "js_composer"),
	          "description" => __("Enter your content.", "js_composer")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Style", ETHEME_DOMAIN),
	          "param_name" => "style",
	          "value" => array( __("Default", ETHEME_DOMAIN) => 'default', __("Bordered", ETHEME_DOMAIN) => 'bordered')
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ETHEME_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ETHEME_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($teaser_box_params);
	
	    // **********************************************************************// 
	    // ! Register New Element: Products
	    // **********************************************************************//
	    
	    $static_blocks = array('--choose--' => '');
	    
	    foreach(et_get_static_blocks() as $value) {
		    $static_blocks[$value['label']] = $value['value'];
	    }
		$order_by_values = array(
		'',
			__( 'Date', 'js_composer' ) => 'date',
			__( 'ID', 'js_composer' ) => 'ID',
			__( 'Author', 'js_composer' ) => 'author',
			__( 'Title', 'js_composer' ) => 'title',
			__( 'Modified', 'js_composer' ) => 'modified',
			__( 'Random', 'js_composer' ) => 'rand',
			__( 'Comment count', 'js_composer' ) => 'comment_count',
			__( 'Menu order', 'js_composer' ) => 'menu_order',
		);

		$order_way_values = array(
		'',
			__( 'Descending', 'js_composer' ) => 'DESC',
			__( 'Ascending', 'js_composer' ) => 'ASC',
		);
	    
	    $fpost_params = array(
	      'name' => 'Products',
	      'base' => 'etheme_products',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ETHEME_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("IDs", ETHEME_DOMAIN),
	          "param_name" => "ids"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("SKUs", ETHEME_DOMAIN),
	          "param_name" => "skus"
	        ),
		    array(
	        	'type' => 'dropdown',
	        	'heading' => __( 'Order by', 'js_composer' ),
	        	'param_name' => 'orderby',
	        	'value' => $order_by_values,
	        	'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', ETHEME_DOMAIN ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
	        ),
	        array(
	        	'type' => 'dropdown',
	        	'heading' => __( 'Order way', 'js_composer' ),
	        	'param_name' => 'order',
	        	'value' => $order_way_values,
	        	'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', ETHEME_DOMAIN ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display Type", ETHEME_DOMAIN),
	          "param_name" => "type",
	          "value" => array( __("Slider", ETHEME_DOMAIN) => 'slider',__("Slider full width (LOOK BOOK)", ETHEME_DOMAIN) => 'full-width', __("Grid", ETHEME_DOMAIN) => 'grid')
	        ),
	        array(
	          "type" => "dropdown",
	          "dependency" => Array('element' => "type", 'value' => array('full-width')),
	          "heading" => __("Static block for the first slide of the LOOK BOOK", ETHEME_DOMAIN),
	          "param_name" => "block_id",
	          "value" => $static_blocks
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Columns", ETHEME_DOMAIN),
	          "param_name" => "columns",
	          "dependency" => Array('element' => "type", 'value' => array('grid'))
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Product view", ETHEME_DOMAIN),
	          "param_name" => "style",
	          "dependency" => Array('element' => "type", 'value' => array('slider')),
	          "value" => array( __("Default", ETHEME_DOMAIN) => 'default', __("Advanced", ETHEME_DOMAIN) => 'advanced')
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on desktop", ETHEME_DOMAIN),
	          "param_name" => "desktop",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on notebook", ETHEME_DOMAIN),
	          "param_name" => "notebook",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on tablet", ETHEME_DOMAIN),
	          "param_name" => "tablet",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on phones", ETHEME_DOMAIN),
	          "param_name" => "phones",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Products type", ETHEME_DOMAIN),
	          "param_name" => "products",
	          "value" => array( __("All", ETHEME_DOMAIN) => '', __("Featured", ETHEME_DOMAIN) => 'featured', __("New", ETHEME_DOMAIN) => 'new', __("Sale", ETHEME_DOMAIN) => 'sale', __("Recently viewed", ETHEME_DOMAIN) => 'recently_viewed', __("Bestsellings", ETHEME_DOMAIN) => 'bestsellings')
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ETHEME_DOMAIN),
	          "param_name" => "limit"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Categories IDs", ETHEME_DOMAIN),
	          "param_name" => "categories"
	        )
	      )
	
	    );  
	
	    vc_map($fpost_params);
	
	
		$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
		// Used in "Button", "Call to Action", "Pie chart" blocks
		$colors_arr = array(__("Grey", "js_composer") => "wpb_button", __("Blue", "js_composer") => "btn-primary", __("Turquoise", "js_composer") => "btn-info", __("Green", "js_composer") => "btn-success", __("Orange", "js_composer") => "btn-warning", __("Red", "js_composer") => "btn-danger", __("Black", "js_composer") => "btn-inverse");
		
		// Used in "Button" and "Call to Action" blocks
		$size_arr = array(__("Regular size", "js_composer") => "wpb_regularsize", __("Large", "js_composer") => "btn-large", __("Small", "js_composer") => "btn-small", __("Mini", "js_composer") => "btn-mini");
		
		$target_arr = array(__("Same window", "js_composer") => "_self", __("New window", "js_composer") => "_blank");
		
		$add_css_animation = array(
			"type" => "dropdown",
			"heading" => __("CSS Animation", "js_composer"),
			"param_name" => "css_animation",
			"admin_label" => true,
			"value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
			"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
		);
		
		// Remove Some Elements
		vc_remove_element("vc_text_separator");
		vc_remove_element("vc_tour"); 
		vc_remove_element("vc_carousel"); 
		
	    // **********************************************************************// 
	    // ! Row HTML
	    // **********************************************************************//
		$row_params = array(
	        array(
	          "type" => "dropdown",
	          "heading" => __("Color Scheme", ETHEME_DOMAIN),
	          "param_name" => "color_scheme",
	          "value" => array( "", __("light with black text", ETHEME_DOMAIN) => 'light',  __("dark with white text", ETHEME_DOMAIN) => 'dark'),
	            "dependency" => Array('element' => "full_width", 'value' => array('stretch_row', 'stretch_row_content', 'stretch_row_content_no_spaces'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Video URL (mp4)", "js_composer"),
	          "param_name" => "video_mp4",
	            "dependency" => Array('element' => "full_width", 'value' => array('stretch_row', 'stretch_row_content', 'stretch_row_content_no_spaces'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Video URL (webm)", "js_composer"),
	          "param_name" => "video_webm",
	            "dependency" => Array('element' => "full_width", 'value' => array('stretch_row', 'stretch_row_content', 'stretch_row_content_no_spaces'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Video URL (ogv)", "js_composer"),
	          "param_name" => "video_ogv",
	            "dependency" => Array('element' => "full_width", 'value' => array('stretch_row', 'stretch_row_content', 'stretch_row_content_no_spaces'))
	        ),
	        array(
	          "type" => "attach_image",
	          "heading" => __("Video poster image", "js_composer"),
	          "param_name" => "video_poster",
	            "dependency" => Array('element' => "full_width", 'value' => array('stretch_row', 'stretch_row_content', 'stretch_row_content_no_spaces'))
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Parallax effect for background", ETHEME_DOMAIN),
	          "param_name" => "parallax",
	          "value" => array( "", __("enable", ETHEME_DOMAIN) => 1,  __("disable", ETHEME_DOMAIN) => 0),
	            "dependency" => Array('element' => "full_width", 'value' => array('stretch_row', 'stretch_row_content', 'stretch_row_content_no_spaces'))
	        ),
		);
		
      	//vc_add_params('vc_row', $row_params);

	
	    // **********************************************************************// 
	    // ! Separator
	    // **********************************************************************//
	    $setting_vc_separator = array (
	    "show_settings_on_create" => true,
	      'params' => array(
	          array(
	            "type" => "dropdown",
	            "heading" => __("Type", "js_composer"),
	            "param_name" => "type",
	            "value" => array( 
	                "", 
	                __("Default", ETHEME_DOMAIN) => "",
	                __("Double", ETHEME_DOMAIN) => "double",
	                __("Dashed", ETHEME_DOMAIN) => "dashed", 
	                __("Dotted", ETHEME_DOMAIN) => "dotted", 
	                __("Double Dotted", ETHEME_DOMAIN) => "double dotted", 
	                __("Double Dashed", ETHEME_DOMAIN) => "double dashed", 
	                __("Horizontal break", ETHEME_DOMAIN) => "horizontal-break", 
	                __("Space", ETHEME_DOMAIN) => "space"
	              )
	          ),
	          array(
	            "type" => "textfield",
	            "heading" => __("Height", "js_composer"),
	            "param_name" => "height",
	            "dependency" => Array('element' => "type", 'value' => array('space'))
	          ),
	          array(
	            "type" => "textfield",
	            "heading" => __("Extra class", "js_composer"),
	            "param_name" => "class"
	          )
	        ) 
	    );
	    vc_map_update('vc_separator', $setting_vc_separator);
	
	    function vc_theme_vc_separator($atts, $content = null) {
	      $output = $color = $el_class = $css_animation = '';
	      extract(shortcode_atts(array(
	          'type' => '',
	          'class' => '',
	          'height' => ''
	      ), $atts));
	
	      $output .= do_shortcode('[hr class="'.$type.' '.$class.'" height="'.$height.'"]');
	      return $output;
	    }
	
	    // **********************************************************************// 
	    // ! FAQ toggle elements
	    // **********************************************************************//
	
	    function vc_theme_vc_toggle($atts, $content = null) {
	      $output = $title = $css_class = $el_class = $open = $css_animation = '';
	      extract(shortcode_atts(array(
	          'title' => __("Click to toggle", "js_composer"),
	          'el_class' => '',
	          'open' => 'false',
	          'css_animation' => ''
	      ), $atts));
	
	
	      $open = ( $open == 'true' ) ? 1 : 0;
	
	      $css_class .= getCSSAnimation($css_animation);
	      $css_class .= ' '.$el_class;
	
	      $output .= '<div class="toggle-block '.$css_class.'">'.do_shortcode('[toggle title="'.$title.'" class="'.$css_class.'" active="'.$open.'"]'.wpb_js_remove_wpautop($content).'[/toggle]').'</div>';
	
	
	      return $output;
	    }
	
	    // **********************************************************************// 
	    // ! Sliders
	    // **********************************************************************//
	   $setting_vc_gallery = array(
		  "name" => __("Image Gallery", "js_composer"),
		  "icon" => "icon-wpb-images-stack",
		  "category" => __('Content', 'js_composer'),
		  "params" => array(
		    array(
		      "type" => "textfield",
		      "heading" => __("Widget title", "js_composer"),
		      "param_name" => "title",
		      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Gallery type", "js_composer"),
		      "param_name" => "type",
		      "value" => array(__("Flex slider fade", "js_composer") => "flexslider_fade", __("Flex slider slide", "js_composer") => "flexslider_slide", __("Nivo slider", "js_composer") => "nivo", __("Carousel", "js_composer") => "carousel", __("Image grid", "js_composer") => "image_grid"),
		      "description" => __("Select gallery type.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Auto rotate slides", "js_composer"),
		      "param_name" => "interval",
		      "value" => array(3, 5, 10, 15, __("Disable", "js_composer") => 0),
		      "description" => __("Auto rotate slides each X seconds.", "js_composer"),
		      "dependency" => Array('element' => "type", 'value' => array('flexslider_fade', 'flexslider_slide', 'nivo'))
		    ),
		    array(
		      "type" => "attach_images",
		      "heading" => __("Images", "js_composer"),
		      "param_name" => "images",
		      "value" => "",
		      "description" => __("Select images from media library.", "js_composer")
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Image size", "js_composer"),
		      "param_name" => "img_size",
		      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("On click", "js_composer"),
		      "param_name" => "onclick",
		      "value" => array(__("Open prettyPhoto", "js_composer") => "link_image", __("Do nothing", "js_composer") => "link_no", __("Open custom link", "js_composer") => "custom_link"),
		      "description" => __("What to do when slide is clicked?", "js_composer")
		    ),
		    array(
		      "type" => "exploded_textarea",
		      "heading" => __("Custom links", "js_composer"),
		      "param_name" => "custom_links",
		      "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'js_composer'),
		      "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Custom link target", "js_composer"),
		      "param_name" => "custom_links_target",
		      "description" => __('Select where to open  custom links.', 'js_composer'),
		      "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
		      'value' => $target_arr
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Extra class name", "js_composer"),
		      "param_name" => "el_class",
		      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
		    )
		  )
		);
	    
	    vc_map_update('vc_gallery', $setting_vc_gallery);
	    
	    function vc_theme_vc_gallery($atts, $content = null) {
	      $output = $title = $type = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $interval = '';
	      extract(shortcode_atts(array(
	          'title' => '',
	          'type' => 'flexslider',
	          'onclick' => 'link_image',
	          'custom_links' => '',
	          'custom_links_target' => '',
	          'img_size' => 'thumbnail',
	          'images' => '',
	          'el_class' => '',
	          'interval' => '5',
	      ), $atts));
	      $gal_images = '';
	      $link_start = '';
	      $link_end = '';
	      $el_start = '';
	      $el_end = '';
	      $slides_wrap_start = '';
	      $slides_wrap_end = '';
	      $rand = rand(1000,9999);
	
	      $el_class = ' '.$el_class;
	
	      if ( $type == 'nivo' ) {
	          $type = ' wpb_slider_nivo theme-default';
	          wp_enqueue_script( 'nivo-slider' );
	          wp_enqueue_style( 'nivo-slider-css' );
	          wp_enqueue_style( 'nivo-slider-theme' );
	
	          $slides_wrap_start = '<div class="nivoSlider">';
	          $slides_wrap_end = '</div>';
	      } else if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'flexslider_slide' || $type == 'fading' ) {
	          $el_start = '<li>';
	          $el_end = '</li>';
	          $slides_wrap_start = '<ul class="slides">';
	          $slides_wrap_end = '</ul>';
	      } else if ( $type == 'image_grid' ) {
	          wp_enqueue_script( 'isotope' );
	
	          $el_start = '<li class="isotope-item">';
	          $el_end = '</li>';
	          $slides_wrap_start = '<ul class="wpb_image_grid_ul">';
	          $slides_wrap_end = '</ul>';
	      } else if ( $type == 'carousel' ) {
	
	          $el_start = '<li class="">';
	          $el_end = '</li>';
	          $slides_wrap_start = '<ul class="images-carousel carousel-'.$rand.'">';
	          $slides_wrap_end = '</ul>';
	      }
	
	      $flex_fx = '';
	      $flex = false;
	      if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'fading' ) {
	          $flex = true;
	          $type = ' wpb_flexslider'.$rand.' flexslider_fade flexslider';
	          $flex_fx = ' data-flex_fx="fade"';
	      } else if ( $type == 'flexslider_slide' ) {
	          $flex = true;
	          $type = ' wpb_flexslider'.$rand.' flexslider_slide flexslider';
	          $flex_fx = ' data-flex_fx="slide"';
	      } else if ( $type == 'image_grid' ) {
	          $type = ' wpb_image_grid';
	      }
	
	
	      /*
	       else if ( $type == 'fading' ) {
	          $type = ' wpb_slider_fading';
	          $el_start = '<li>';
	          $el_end = '</li>';
	          $slides_wrap_start = '<ul class="slides">';
	          $slides_wrap_end = '</ul>';
	          wp_enqueue_script( 'cycle' );
	      }*/
	
	      //if ( $images == '' ) return null;
	      if ( $images == '' ) $images = '-1,-2,-3';
	
	      $pretty_rel_random = 'rel-'.rand();
	
	      if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }
	      $images = explode( ',', $images);
	      $i = -1;
	
	      foreach ( $images as $attach_id ) {
	          $i++;
	          if ($attach_id > 0) {
	              $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
	          }
	          else {
	              $different_kitten = 400 + $i;
	              $post_thumbnail = array();
	              $post_thumbnail['thumbnail'] = '<img src="http://placekitten.com/g/'.$different_kitten.'/300" />';
	              $post_thumbnail['p_img_large'][0] = 'http://placekitten.com/g/1024/768';
	          }
	
	          $thumbnail = $post_thumbnail['thumbnail'];
	          $p_img_large = $post_thumbnail['p_img_large'];
	          $link_start = $link_end = '';
	
	          if ( $onclick == 'link_image' ) {
	              $link_start = '<a rel="lightboxGall" href="'.$p_img_large[0].'">';
	              $link_end = '</a>';
	          }
	          else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
	              $link_start = '<a href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '>';
	              $link_end = '</a>';
	          }
	          $gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
	      }
	      $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element'.$el_class.' clearfix');
	      $output .= "\n\t".'<div class="'.$css_class.'">';
	      $output .= "\n\t\t".'<div class="wpb_wrapper">';
	      $output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_gallery_heading'));
	      $output .= '<div class="wpb_gallery_slides'.$type.'" data-interval="'.$interval.'"'.$flex_fx.'>'.$slides_wrap_start.$gal_images.$slides_wrap_end.'</div>';
	      $output .= "\n\t\t".'</div> ';
	      $output .= "\n\t".'</div> ';
	
	      if ( $flex ) {
	          $output .= '<script type="text/javascript">';
	          $output .= 'jQuery(document).ready(function(){';
	          $output .= 'var sliderElement = jQuery(".wpb_flexslider'.$rand.'");';
	            $output .= 'var sliderSpeed = 800,';
	                $output .= "sliderTimeout = parseInt(sliderElement.attr('data-interval'))*1000,";
	                $output .= "sliderFx = sliderElement.attr('data-flex_fx'),";
	                $output .= "slideshow = true;";
	            $output .= "if ( sliderTimeout == 0 ) slideshow = false;";
	
	            $output .= "sliderElement.flexslider({";
	                $output .= "animation: sliderFx,";
	                $output .= "slideshow: slideshow,";
	                $output .= "slideshowSpeed: sliderTimeout,";
	                $output .= "sliderSpeed: sliderSpeed,";
	                $output .= "smoothHeight: false";
	            $output .= "});";
	            $output .= "});";
	          $output .= "</script>";
	      }
	      
	      if( $type == 'carousel' ) {
	      		   $items = '[[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]';
		           $output .=  '<script type="text/javascript">';
		           //$output .=  '     jQuery(".images-carousel").etFullWidth();';
		           $output .=  '     jQuery(".carousel-'.$rand.'").owlCarousel({';
		           $output .=  '         items:4, ';
		           $output .=  '         navigation: true,';
		           $output .=  '         navigationText:false,';
		           $output .=  '         rewindNav: false,';
		           $output .=  '         itemsCustom: '.$items.'';
		           $output .=  '    });';
		
		           $output .=  ' </script>';
	      }
	
	      return $output;
	    }
	
	
	
	    // **********************************************************************// 
	    // ! Accordion
	    // **********************************************************************//
	
	    function vc_theme_vc_accordion($atts, $content = null) {
	      $output = $title = $interval = $el_class = $collapsible = $active_tab = '';
	      //
	      extract(shortcode_atts(array(
	          'title' => '',
	          'interval' => 0,
	          'el_class' => '',
	          'collapsible' => 'no',
	          'active_tab' => '1'
	      ), $atts));
	
	      $el_class = ' '.$el_class;
	      
	      if($active_tab == 'false') {
	      	$el_class .= ' closed-tabs ';
	      }
	      $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_content_element '.$el_class.' not-column-inherit');
	
	
	      $output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));
	
	      $output .= "\n\t".'<div class="'.$css_class.' tabs accordion">'; 
	      $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	      $output .= "\n\t".'</div> ';
	      return $output;
	    }
	
	    function vc_theme_vc_accordion_tab($atts, $content = null) {
	      global $tab_count;
	      $output = $title = '';
	
	      extract(shortcode_atts(array(
	        'title' => __("Section", "js_composer")
	      ), $atts));
	
	      $tab_count++;
	
	          $output .= "\n\t\t\t\t" . '<a href="#tab_'.$tab_count.'" id="tab_'.$tab_count.'" class="tab-title">'.$title.'</a>';
	          $output .= "\n\t\t\t\t" . '<div id="content_tab_'.$tab_count.'" class="tab-content">';
	              $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
	              $output .= "\n\t\t\t\t" . '</div>';
	      return $output;
	    }
	
	    // **********************************************************************// 
	    // ! Tabs
	    // **********************************************************************//
	
	    $tab_id_1 = time().'-1-'.rand(0, 100);
	    $tab_id_2 = time().'-2-'.rand(0, 100);
	    vc_map( array(
	      "name"  => __("Tabs", "js_composer"),
	      "base" => "vc_tabs",
	      "show_settings_on_create" => true,
	      "is_container" => true,
	      "icon" => "icon-wpb-ui-tab-content",
	      "category" => __('Content', 'js_composer'),
	      "params" => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Widget title", "js_composer"),
	          "param_name" => "title",
	          "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Tabs type", "js_composer"),
	          "param_name" => "type",
	          "value" => array(__("Default", "js_composer") => '', 
	              __("Accordion", "js_composer") => 'accordion', 
	              __("Left bar", "js_composer") => 'left-bar', 
	              __("Right bar", "js_composer") => 'right-bar')
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra class name", "js_composer"),
	          "param_name" => "el_class",
	          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
	        )
	      ),
	      "custom_markup" => '
	      <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
	      <ul class="tabs_controls">
	      </ul>
	      %content%
	      </div>'
	      ,
	      'default_content' => '
	      [vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
	      [vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
	      ',
	      "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
	    ) );
	
	
	    function vc_theme_vc_tabs($atts, $content = null) {
	      $output = $title = $interval = $el_class = $collapsible = $active_tab = '';
	      //
	      extract(shortcode_atts(array(
	          'title' => '',
	          'interval' => 0,
	          'el_class' => '',
	          'type' => '',
	          'collapsible' => 'no',
	          'active_tab' => '1'
	      ), $atts));
	
	      $el_class = ' '.$el_class;
	      $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_content_element '.$el_class.' '.$type.' not-column-inherit');
	
	
	      $output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));
	
	      $output .= "\n\t".'<div class="'.$css_class.' tabs">'; 
	      $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	      $output .= "\n\t".'</div> ';
	      return $output;
	    }
	
	    vc_map( array(
	      "name" => __("Tab", "js_composer"),
	      "base" => "vc_tab",
	      "allowed_container_element" => 'vc_row',
	      "is_container" => true,
	      "content_element" => false,
	      "params" => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", "js_composer"),
	          "param_name" => "title",
	          "description" => __("Tab title.", "js_composer")
	        ),
	        array(
	          'type' => 'icon',
	          "heading" => __("Icon", ETHEME_DOMAIN),
	          "param_name" => "icon"
	        ),
	        array(
	          "type" => "tab_id",
	          "heading" => __("Tab ID", "js_composer"),
	          "param_name" => "tab_id"
	        )
	      ),
	      'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
	    ) );
	    
	    function vc_theme_vc_tab($atts, $content = null) {
	      global $tab_count;
	      $output = $title = $iconHtml = '';
	
	      extract(shortcode_atts(array(
	        'title' => __("Section", "js_composer"),
	        'icon' => ''
	      ), $atts));
	
	      $tab_count++;
	      if($icon != '') {
	        $iconHtml = '<i class="icon-'.$icon.'"></i>';
	      }
	
	          $output .= "\n\t\t\t\t" . '<a href="#tab_'.$tab_count.'" id="tab_'.$tab_count.'" class="tab-title">'.$iconHtml.$title.'</a>';
	          $output .= "\n\t\t\t\t" . '<div id="content_tab_'.$tab_count.'" class="tab-content">';
	              $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
	              $output .= "\n\t\t\t\t" . '</div>';
	      return $output;
	    }
	
	
	    // **********************************************************************// 
	    // ! Posts Slider
	    // **********************************************************************//
	    $setting_vc_posts_slider = array (
	      'params' => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Widget title", "js_composer"),
	      "param_name" => "title",
	      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Slides count", "js_composer"),
	      "param_name" => "count",
	      "description" => __('How many slides to show? Enter number or word "All".', "js_composer")
	    ),
	    array(
	      "type" => "posttypes",
	      "heading" => __("Post types", "js_composer"),
	      "param_name" => "posttypes",
	      "description" => __("Select post types to populate posts from.", "js_composer")
	    ),
	    array(
	      "type" => 'checkbox',
	      "heading" => __("Output post date?", "js_composer"),
	      "param_name" => "slides_date",
	      "description" => __("If selected, date will be printed before the teaser text.", "js_composer"),
	      "value" => Array(__("Yes, please", "js_composer") => true)
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Description", "js_composer"),
	      "param_name" => "slides_content",
	      "value" => array(
	      		__("No description", "js_composer") => "", 
	      		__("Teaser (Excerpt)", "js_composer") => "teaser",
      		),
	      "description" => __("Some sliders support description text, what content use for it?", "js_composer"),
	    ),
	    array(
	      "type" => 'checkbox',
	      "heading" => __("Output post title?", "js_composer"),
	      "param_name" => "slides_title",
	      "description" => __("If selected, title will be printed before the teaser text.", "js_composer"),
	      "value" => Array(__("Yes, please", "js_composer") => true),
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Thumbnail size", "js_composer"),
	      "param_name" => "thumb_size",
	      "description" => __('Enter thumbnail size. Example: 200x100 (Width x Height).', "js_composer")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Post/Page IDs", "js_composer"),
	      "param_name" => "posts_in",
	      "description" => __('Fill this field with page/posts IDs separated by commas (,), to retrieve only them. Use this in conjunction with "Post types" field.', "js_composer")
	    ),
	    array(
	      "type" => "exploded_textarea",
	      "heading" => __("Categories", "js_composer"),
	      "param_name" => "categories",
	      "description" => __("If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter).", "js_composer")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Order by", "js_composer"),
	      "param_name" => "orderby",
	      "value" => array( "", __("Date", "js_composer") => "date", __("ID", "js_composer") => "ID", __("Author", "js_composer") => "author", __("Title", "js_composer") => "title", __("Modified", "js_composer") => "modified", __("Random", "js_composer") => "rand", __("Comment count", "js_composer") => "comment_count", __("Menu order", "js_composer") => "menu_order" ),
	      "description" => sprintf(__('Select how to sort retrieved posts. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Order by", "js_composer"),
	      "param_name" => "order",
	      "value" => array( __("Descending", "js_composer") => "DESC", __("Ascending", "js_composer") => "ASC" ),
	      "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "js_composer"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
	    )
	  ) 
	    );
	    vc_map_update('vc_posts_slider', $setting_vc_posts_slider);
	
	    function vc_theme_vc_posts_slider($atts, $content = null) {
	      $output = $title = $type = $count = $interval = $slides_content = $link = '';
	      $custom_links = $thumb_size = $posttypes = $posts_in = $categories = '';
	      $orderby = $order = $el_class = $link_image_start = '';
	      extract(shortcode_atts(array(
	          'title' => '',
	          'type' => 'flexslider_fade',
	          'count' => 10,
	          'interval' => 3,
	          'slides_content' => '',
	          'slides_title' => '',
	          'link' => 'link_post',
	          'more_link' => 1,
	          'custom_links' => site_url().'/',
	          'thumb_size' => '300x200',
	          'posttypes' => '',
	          'posts_in' => '',
	          'slides_date' => false,
	          'categories' => '',
	          'orderby' => NULL,
	          'order' => 'DESC',
	          'el_class' => ''
	      ), $atts));
	
	      $gal_images = '';
	      $link_start = '';
	      $link_end = '';
	      $el_start = '';
	      $el_end = '';
	      $slides_wrap_start = '';
	      $slides_wrap_end = '';
	
	      $el_class = ' '.$el_class;
	
	      $query_args = array();
	
	      //exclude current post/page from query
	      if ( $posts_in == '' ) {
	          global $post;
	          $query_args['post__not_in'] = array($post->ID);
	      }
	      else if ( $posts_in != '' ) {
	          $query_args['post__in'] = explode(",", $posts_in);
	      }
	
	      // Post teasers count
	      if ( $count != '' && !is_numeric($count) ) $count = -1;
	      if ( $count != '' && is_numeric($count) ) $query_args['posts_per_page'] = $count;
	
	      // Post types
	      $pt = array();
	      if ( $posttypes != '' ) {
	          $posttypes = explode(",", $posttypes);
	          foreach ( $posttypes as $post_type ) {
	              array_push($pt, $post_type);
	          }
	          $query_args['post_type'] = $pt;
	      }
	
	      // Narrow by categories
	      if ( $categories != '' ) {
	          $categories = explode(",", $categories);
	          $gc = array();
	          foreach ( $categories as $grid_cat ) {
	              array_push($gc, $grid_cat);
	          }
	          $gc = implode(",", $gc);
	          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
	          $query_args['category_name'] = $gc;
	
	          $taxonomies = get_taxonomies('', 'object');
	          $query_args['tax_query'] = array('relation' => 'OR');
	          foreach ( $taxonomies as $t ) {
	              if ( in_array($t->object_type[0], $pt) ) {
	                  $query_args['tax_query'][] = array(
	                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
	                      'terms' => $categories,
	                      'field' => 'slug',
	                  );
	              }
	          }
	      }
	
	      // Order posts
	      if ( $orderby != NULL ) {
	          $query_args['orderby'] = $orderby;
	      }
	      $query_args['order'] = $order;
	
	      $thumb_size = explode('x', $thumb_size);
	      $width = $thumb_size[0];
	      $height = $thumb_size[1];
	
	      $crop = true;
	
	      ob_start();
	      etheme_create_posts_slider($query_args, $title, $more_link, $slides_date, $slides_content, $width, $height, $crop );
	      $output = ob_get_contents();
	      ob_end_clean();
	
	      return $output;
	    }
	
	
	
	    // **********************************************************************// 
	    // ! Button
	    // **********************************************************************//
	    $setting_vc_button = array (
	      "params" => array(
	          array(
	            "type" => "textfield",
	            "heading" => __("Text on the button", "js_composer"),
	            "holder" => "button",
	            "class" => "wpb_button",
	            "param_name" => "title",
	            "value" => __("Text on the button", "js_composer"),
	            "description" => __("Text on the button.", "js_composer")
	          ),
	          array(
	            "type" => "textfield",
	            "heading" => __("URL (Link)", "js_composer"),
	            "param_name" => "href",
	            "description" => __("Button link.", "js_composer")
	          ),
	          array(
	            "type" => "dropdown",
	            "heading" => __("Target", "js_composer"),
	            "param_name" => "target",
	            "value" => $target_arr,
	            "dependency" => Array('element' => "href", 'not_empty' => true)
	          ),
	          array(
	            "type" => "dropdown",
	            "heading" => __("Type", "js_composer"),
	            "param_name" => "btn_type",
	            "value" => array('bordered', 'filled'),
	            "description" => __("Button type.", "js_composer")
	          ),
	          /*
	          array(
	            "type" => "dropdown",
	            "heading" => __("Icon", "js_composer"),
	            "param_name" => "icon",
	            "value" => $icons_arr,
	            "description" => __("Button icon.", "js_composer")
	          ),*/
	          array(
	            "type" => "dropdown",
	            "heading" => __("Size", "js_composer"),
	            "param_name" => "size",
	            "value" => array('small','medium','big'),
	            "description" => __("Button size.", "js_composer")
	          ),
	          array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "js_composer"),
	            "param_name" => "el_class",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
	          )
	        )
	    );
	    vc_map_update('vc_button', $setting_vc_button);
	
	    function vc_theme_vc_button($atts, $content = null) {
	      $output = $btn_type = $size = $icon = $target = $href = $el_class = $title = $position = '';
	      extract(shortcode_atts(array(
	          'btn_type' => '',
	          'size' => '',
	          'target' => '_self',
	          'href' => '',
	          'el_class' => '',
	          'title' => __('Text on the button', "js_composer"),
	          'position' => ''
	      ), $atts));
	
	      if ( $target == 'same' || $target == '_self' ) { $target = ''; }
	      $target = ( $target != '' ) ? ' target="'.$target.'"' : '';
	
	      $btn_type = ( $btn_type != '' ) ? ' '.$btn_type : '';
	      $size = ( $size != '') ? ' '.$size : ' ';
	      $position = ( $position != '' ) ? ' '.$position.'-button-position' : '';
	      $el_class = ' '.$el_class;
	
	      $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' '.$btn_type.$size.$el_class.$position);
	
	      if ( $href != '' ) {
	          $output = '<a class="button '.$css_class.'" title="'.$title.'" href="'.$href.'"'.$target.'>' . $title . '</a>';
	      } else {
	          $output .= '<button class="button '.$css_class.'">'.$title.'</button>';
	
	      }
	
	      return $output;
	    }
	
	
	    // **********************************************************************// 
	    // ! Call To Action
	    // **********************************************************************//
	    $setting_cta_button = array (
	      "params" => array(
	          array(
	            "type" => "textarea_html",
	            "heading" => __("Text", "js_composer"),
	            "param_name" => "content",
	            "value" => __("Click edit button to change this text.", "js_composer"),
	            "description" => __("Enter your content.", "js_composer")
	          ),
	          array(
	            "type" => "dropdown",
	            "heading" => __("Block Style", "js_composer"),
	            "param_name" => "style",
	            "value" => array(
	              "" => "",
	              __("Default", "js_composer") => "default", 
	              __("Filled", "js_composer") => "filled", 
	              __("Without Border", "js_composer") => "without-border", 
	              __("Dark", "js_composer") => "dark"
	            )
	          ),
	          array(
	            "type" => "textfield",
	            "heading" => __("Text on the button", "js_composer"),
	            "param_name" => "title",
	            "value" => __("Text on the button", "js_composer"),
	            "description" => __("Text on the button.", "js_composer")
	          ),
	          array(
	            "type" => "textfield",
	            "heading" => __("URL (Link)", "js_composer"),
	            "param_name" => "href",
	            "description" => __("Button link.", "js_composer")
	          ),
	          array(
	            "type" => "dropdown",
	            "heading" => __("Button position", "js_composer"),
	            "param_name" => "position",
	            "value" => array(__("Align right", "js_composer") => "right", __("Align left", "js_composer") => "left"),
	            "description" => __("Select button alignment.", "js_composer")
	          )
	        )
	    );
	    vc_map_update('vc_cta_button', $setting_cta_button);
	
	    function vc_theme_vc_cta_button($atts, $content = null) {
	      $output = $call_title = $href = $title = $call_text = $el_class = '';
	      extract(shortcode_atts(array(
	          'href' => '',
	          'style' => '',
	          'title' => '',
	          'position' => 'right'
	      ), $atts));
	
	      return do_shortcode('[callto btn_position="'.$position.'" btn="'.$title.'" style="'.$style.'" link="'.$href.'"]'.$content.'[/callto]');
	    }
	
	    // **********************************************************************// 
	    // ! Teaser grid
	    // **********************************************************************//
		$setting_teaser_grid = array(
		  "params" => array(
		    array(
		      "type" => "textfield",
		      "heading" => __("Widget title", "js_composer"),
		      "param_name" => "title",
		      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Columns count", "js_composer"),
		      "param_name" => "grid_columns_count",
		      "value" => array( 4, 3, 2, 1),
		      "admin_label" => true,
		      "description" => __("Select columns count.", "js_composer")
		    ),
		    array(
		      "type" => "posttypes",
		      "heading" => __("Post types", "js_composer"),
		      "param_name" => "grid_posttypes",
		      "description" => __("Select post types to populate posts from.", "js_composer")
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Teasers count", "js_composer"),
		      "param_name" => "grid_teasers_count",
		      "description" => __('How many teasers to show? Enter number or word "All".', "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Pagination", "js_composer"),
		      "param_name" => "pagination",
		      "value" => array(__("Show Pagination", "js_composer") => "show", __("Hide", "js_composer") => "hide")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Content", "js_composer"),
		      "param_name" => "grid_content",
		      "value" => array(__("Teaser (Excerpt)", "js_composer") => "teaser", __("Full Content", "js_composer") => "content"),
		      "description" => __("Teaser layout template.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("'Posted by' block", "js_composer"),
		      "param_name" => "posted_block",
		      "value" => array(__("Show", "js_composer") => "show", __("Hide", "js_composer") => "hide")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Hover mask", "js_composer"),
		      "param_name" => "hover_mask",
		      "value" => array(__("Show", "js_composer") => "show", __("Hide", "js_composer") => "hide")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Layout", "js_composer"),
		      "param_name" => "grid_layout",
		      "value" => array(__("Title + Thumbnail + Text", "js_composer") => "title_thumbnail_text", __("Thumbnail + Title + Text", "js_composer") => "thumbnail_title_text", __("Thumbnail + Text", "js_composer") => "thumbnail_text", __("Thumbnail + Title", "js_composer") => "thumbnail_title", __("Thumbnail only", "js_composer") => "thumbnail", __("Title + Text", "js_composer") => "title_text"),
		      "description" => __("Teaser layout.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Border", "js_composer"),
		      "param_name" => "border",
		      "value" => array(__("Show border", "js_composer") => "on", __("Without border", "js_composer") => "off"),
		      "description" => __("Teaser layout.", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Teaser grid layout", "js_composer"),
		      "param_name" => "grid_template",
		      "value" => array(__("Grid", "js_composer") => "grid", __("Grid with filter", "js_composer") => "filtered_grid"),
		      "description" => __("Teaser layout template.", "js_composer")
		    ),
		    array(
		      "type" => "taxonomies",
		      "heading" => __("Taxonomies", "js_composer"),
		      "param_name" => "grid_taxomonies",
		      "dependency" => Array('element' => 'grid_template' /*, 'not_empty' => true*/, 'value' => array('filtered_grid'), 'callback' => 'wpb_grid_post_types_for_taxonomies_handler'),
		      "description" => __("Select taxonomies from.", "js_composer") //TODO: Change description
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Thumbnail size", "js_composer"),
		      "param_name" => "grid_thumb_size",
		      "description" => __('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).', "js_composer")
		    ),  
		    array(
		      "type" => "textfield",
		      "heading" => __("Post/Page IDs", "js_composer"),
		      "param_name" => "posts_in",
		      "description" => __('Fill this field with page/posts IDs separated by commas (,) to retrieve only them. Use this in conjunction with "Post types" field.', "js_composer")
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Exclude Post/Page IDs", "js_composer"),
		      "param_name" => "posts_not_in",
		      "description" => __('Fill this field with page/posts IDs separated by commas (,) to exclude them from query.', "js_composer")
		    ),
		    array(
		      "type" => "exploded_textarea",
		      "heading" => __("Categories", "js_composer"),
		      "param_name" => "grid_categories",
		      "description" => __("If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter).", "js_composer")
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Order by", "js_composer"),
		      "param_name" => "orderby",
		      "value" => array( "", __("Date", "js_composer") => "date", __("ID", "js_composer") => "ID", __("Author", "js_composer") => "author", __("Title", "js_composer") => "title", __("Modified", "js_composer") => "modified", __("Random", "js_composer") => "rand", __("Comment count", "js_composer") => "comment_count", __("Menu order", "js_composer") => "menu_order" ),
		      "description" => sprintf(__('Select how to sort retrieved posts. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Order way", "js_composer"),
		      "param_name" => "order",
		      "value" => array( __("Descending", "js_composer") => "DESC", __("Ascending", "js_composer") => "ASC" ),
		      "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		    ),
		    array(
		      "type" => "textfield",
		      "heading" => __("Extra class name", "js_composer"),
		      "param_name" => "el_class",
		      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
		    )
		  )
		);
	
	    vc_map_update('vc_posts_grid', $setting_teaser_grid);
	    
	    function vc_theme_vc_posts_grid($atts, $content = null) {
	      return etheme_teaser($atts, $content = null);
	    }
	}
}
