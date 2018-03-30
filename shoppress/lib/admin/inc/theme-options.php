<?php

$page_handle = $dirname . '-options';
$options = array(

array(	"name" => __('General Settings', 'gp_lang'),
      	"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_general_settings"),

		array(
		"name" => __('General Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_general_header",
      	"desc" => __('This section controls the general settings for the theme.', 'gp_lang')
      	),

  		array("type" => "divider"),
  		
 		array(  
		"name" => __('Theme Skin', 'gp_lang'),
        "desc" => __('Choose the theme skin (can be overridden on individual posts/pages).', 'gp_lang'),
        "id" => $dirname."_skin",
        "std" => "dark",
		"options" => array('dark' => __('Dark', 'gp_lang'), 'dark-wide' => __('Dark Wide', 'gp_lang'), 'light' => __('Light', 'gp_lang'), 'light-wide' => __('Light Wide', 'gp_lang')),
        "type" => "select"),
        
        array(
		"name" => __('Custom Stylesheet', 'gp_lang'),
		"desc" => __('Enter the relative URL to your custom stylesheet e.g. <code>lib/css/custom-style.css</code> (can be overridden on individual posts/pages).', 'gp_lang'),
        "id" => $dirname."_custom_stylesheet",
        "type" => "text"),
        
		array("type" => "divider"), 
		
		array(
		"name" => __('Custom Logo Image', 'gp_lang'),
        "desc" => __('Upload your own logo.', 'gp_lang'),
        "id" => $dirname."_logo",
        "type" => "upload"),

		array(
		"name" => __('Logo Width', 'gp_lang'),
        "desc" => __('Enter the logo width (set to half the original logo width for retina displays).', 'gp_lang'),
        "id" => $dirname."_logo_width",
        "type" => "text",
		"size" => "small",
		"details" => "px"),

		array(
		"name" => __('Logo Height', 'gp_lang'),
        "desc" => __('Enter the logo height (set to half the original logo height for retina displays).', 'gp_lang'),
        "id" => $dirname."_logo_height",
        "type" => "text",
		"size" => "small",
		"details" => "px"),
					
		array(
		"name" => __('Logo Top Margin', 'gp_lang'),
        "desc" => __('Enter the top margin of your logo.', 'gp_lang'),
        "id" => $dirname."_logo_top",
        "type" => "text",
		"size" => "small",
		"details" => "px"),

		array(
		"name" => __('Logo Left Margin', 'gp_lang'),
        "desc" => __('Enter the left margin of your logo.', 'gp_lang'),
        "id" => $dirname."_logo_left",
        "type" => "text",
		"size" => "small",
		"details" => "px"),
		
		array(
		"name" => __('Logo Bottom Margin', 'gp_lang'),
        "desc" => __('Enter the bottom margin of your logo.', 'gp_lang'),
        "id" => $dirname."_logo_bottom",
        "type" => "text",
		"size" => "small",
		"details" => "px"),
		
		array("type" => "divider"),

		array(
		"name" => __('Header Height', 'gp_lang'),
        "desc" => __('Enter the height of the header.', 'gp_lang'),
        "id" => $dirname."_header_height",
        "std" => "75",
        "type" => "text",
		"size" => "small",
		"details" => "px"),

		array("type" => "divider"),
		 		
 		array(
		"name" => __('Search Criteria', 'gp_lang'),
        "desc" => __('Choose what posts and pages show up in search results.', 'gp_lang'),
        "id" => $dirname."_search_criteria",
        "std" => "Products",
		"options" => array('Products' => __('Products', 'gp_lang'), 'Posts' => __('Posts', 'gp_lang'), 'Posts and pages' => __('Posts and pages', 'gp_lang'), 'Posts, pages and products' => __('Posts, pages and products', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),

		array(  
		"name" => __('Responsive', 'gp_lang'),
        "desc" => __('Choose whether the theme responds to the width of the browser window.', 'gp_lang'),
        "id" => $dirname."_responsive",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),

		array("type" => "divider"),
		   				
		array(  
		"name" => __('Retina Images', 'gp_lang'),
        "desc" => __('Choose whether to crop images at double the size on retina displays (newer iPhones/iPads, Macbook Pro etc.).', 'gp_lang'),
        "id" => $dirname."_retina",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
                		
		array("type" => "divider"),
		   				
		array(  
		"name" => __('RSS Feed Button', 'gp_lang'),
        "desc" => __('Display the RSS feed button with the default RSS feed or enter a custom feed below.', 'gp_lang'),
        "id" => $dirname."_rss_button",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array(
		"name" => __('RSS URL', 'gp_lang'),
        "id" => $dirname."_rss",
        "type" => "text"),
        
        array(
		"name" => __('Twitter URL', 'gp_lang'),
        "id" => $dirname."_twitter",
        "type" => "text"),
        
        array(
		"name" => __('Facebook URL', 'gp_lang'),
        "id" => $dirname."_facebook",
        "type" => "text"),
        
        array(
		"name" => __('Dribbble URL', 'gp_lang'),
        "id" => $dirname."_dribbble",
        "type" => "text"),    
        
        array(
		"name" => __('Digg URL', 'gp_lang'),
        "id" => $dirname."_digg",
        "type" => "text"), 

        array(
		"name" => __('YouTube URL', 'gp_lang'),
        "id" => $dirname."_youtube",
        "type" => "text"),

        array(
		"name" => __('Vimeo URL', 'gp_lang'),
        "id" => $dirname."_vimeo",
        "type" => "text"),
        
        array(
		"name" => __('Google+ URL', 'gp_lang'),
        "id" => $dirname."_googleplus",
        "type" => "text"),
        
        array(
		"name" => __('LinkedIn URL', 'gp_lang'),
        "id" => $dirname."_linkedin",
        "type" => "text"),

        array(
		"name" => __('MySpace URL', 'gp_lang'),
        "id" => $dirname."_myspace",
        "type" => "text"),
                
        array(
		"name" => __('Flickr URL', 'gp_lang'),
        "id" => $dirname."_flickr",
        "type" => "text"),

        array(
		"name" => __('Pinterest URL', 'gp_lang'),
        "id" => $dirname."_pinterest",
        "type" => "text"),
                
 		array(
		"name" => __('Additional Social Icons', 'gp_lang'),
        "desc" => __('Add additional social icons by entering the link and image HTML code e.g. <code>&lt;a href=&quot;http://social-link.com&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;'.get_template_directory_uri().'/images/socialicon.png&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;</code>', 'gp_lang'),
        "id" => $dirname."_additional_social_icons",
        "type" => "textarea"),
        
		array("type" => "divider"), 
	
		array(
		"name" => __('Footer Content', 'gp_lang'),
        "desc" => __('Enter the content you want to display in your footer (e.g. copyright text).', 'gp_lang'),
        "id" => $dirname."_footer_content",
        "type" => "textarea"),

		array("type" => "divider"), 
		
		array(
		"name" => __('Scripts', 'gp_lang'),
        "desc" => __('Enter any scripts that need to be embedded into your theme (e.g. Google Analytics)', 'gp_lang'),
        "id" => $dirname."_scripts",
        "type" => "textarea"),
 		
 		array("type" => "divider"),
				
		array(  
		"name" => __('JW Player For YouTube Videos', 'gp_lang'),
        "desc" => __('Use the JW Player for YouTube vidoes (not recommended!).', 'gp_lang'),
        "id" => $dirname."_jwplayer",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),

		array(  
		"name" => __('Old Video Shortcode', 'gp_lang'),
        "desc" => __('WordPress now has it\'s own native [video] shortcode. Choose this option to use the old video shortcode instead.', 'gp_lang'),
        "id" => $dirname."_old_video_shortcode",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
                              
		array("type" => "divider"),

	 	array(
		"name" => __('Preload Effect', 'gp_lang'),
        "desc" => __('Choose whether to use the preload effect on content in category, archive, tag pages etc (this can be specified individually from shortcodes using <code>preload="true"</code>).', 'gp_lang'),
        "id" => $dirname."_preload",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array("type" => "close"),	

array(	"name" => __('Category Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_category_settings"),

		array(
		"name" => __('Category Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_cat_header",
      	"desc" => __('This section controls the global settings for all category, archive, tag and search result pages.', 'gp_lang')
      	),
 
  		array("type" => "divider"),
  		
        array(
		"name" => __('Thumbnail Width', 'gp_lang'),
        "desc" => __('The width to crop the thumbnail to (can be overridden on individual posts, set to 0 to have a proportionate width).', 'gp_lang'),
        "id" => $dirname."_cat_thumbnail_width",
        "std" => "670",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 

  		array(
		"name" => __('Thumbnail Height', 'gp_lang'),
        "desc" => __('The height to crop the thumbnail to (can be overridden on individual posts, set to 0 to have a proportionate height).', 'gp_lang'),
        "id" => $dirname."_cat_thumbnail_height",
        "std" => "250",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 

		array(
		"name" => __('Image Wrap', 'gp_lang'),
        "desc" => __('Choose whether the page content wraps around the featured image.', 'gp_lang'),
        "id" => $dirname."_cat_image_wrap",
		"style" => "Disable",
		"options" => array('Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')),
        "type" => "select"),

		array(
		"name" => __('Hard Crop', 'gp_lang'),
        "desc" => __('Choose whether the image is hard cropped.', 'gp_lang'),
        "id" => $dirname."_cat_hard_crop",
        "std" => "Enable",
		"options" => array('Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')),
        "type" => "select"),
                
  		array("type" => "divider"),
  		
   		array( 
		"name" => __('Sidebar', 'gp_lang'),
        "desc" => __('Choose which sidebar area to display.', 'gp_lang'),
        "id" => $dirname."_cat_sidebar",
        "std" => "gp-default",
        "type" => "select_sidebar"),

   		array("type" => "divider"),
   		 		 		
		array( 
		"name" => __('Layout', 'gp_lang'),
        "desc" => __('Choose the page layout.', 'gp_lang'),
        "id" => $dirname."_cat_layout",
        "std" => "sb-right",
		"options" => array('sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
  		array(
		"name" => __('Title', 'gp_lang'),
        "desc" => __('Choose whether to display the page title.', 'gp_lang'),
        "id" => $dirname."_cat_title",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Breadcrumbs', 'gp_lang'),
        "desc" => __('Choose whether to display breadcrumbs.', 'gp_lang'),
        "id" => $dirname."_cat_breadcrumbs",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Search Bar', 'gp_lang'),
        "desc" => __('Choose whether to display the search bar.', 'gp_lang'),
        "id" => $dirname."_cat_search",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

  		array("type" => "divider"),
  		
  		array(
		"name" => __('Bottom Content Widgets', 'gp_lang'),
        "desc" => __('Choose whether to display the bottom content widgets.', 'gp_lang'),
        "id" => $dirname."_cat_bottom_content_widgets",
        "std" => "Hide",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

  		array("type" => "divider"),
  		 		
		array(
		"name" => __('Content Display', 'gp_lang'),
        "desc" => __('Choose whether to display the full post content or an excerpt.', 'gp_lang'),
        "id" => $dirname."_cat_content_display",
        "std" => "0",
		"options" => array(__('Excerpt', 'gp_lang'), __('Full Content', 'gp_lang')),
        "type" => "radio"),
        
		array("type" => "divider"),
		
        array(
		"name" => __('Excerpt Length', 'gp_lang'),
        "desc" => __('The number of characters in excerpts.', 'gp_lang'),
        "id" => $dirname."_cat_excerpt_length",
        "std" => "400",
        "type" => "text",
		"size" => "small"),
 
  		array("type" => "divider"),
		
		array(  
		"name" => __('Read More Link', 'gp_lang'),
        "desc" => __('Choose whether to display the read more links.', 'gp_lang'),
        "id" => $dirname."_cat_read_more",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
 
  		array("type" => "divider"),
  		
		array(  
		"name" => __('Post Date', 'gp_lang'),
        "desc" => __('Choose whether to display the post date.', 'gp_lang'),
        "id" => $dirname."_cat_date",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),

		array(  
		"name" => __('Post Author', 'gp_lang'),
        "desc" => __('Choose whether to display the post author.', 'gp_lang'),
        "id" => $dirname."_cat_author",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),

		array(  
		"name" => __('Post Categories', 'gp_lang'),
        "desc" => __('Choose whether to display the post categories.', 'gp_lang'),
        "id" => $dirname."_cat_cats",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array(  
		"name" => __('Post Comments', 'gp_lang'),
        "desc" => __('Choose whether to display the post comments.', 'gp_lang'),
        "id" => $dirname."_cat_comments",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
 
		array(  
		"name" => __('Post Tags', 'gp_lang'),
        "desc" => __('Choose whether to display the post tags.', 'gp_lang'),
        "id" => $dirname."_cat_tags",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
                       
		array("type" => "close"),

array(	"name" => __('Product Category Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_product_category_settings"),

		array(
		"name" => __('Product Category Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_product_cat_header",
      	"desc" => __('This section controls the global settings for all product category.', 'gp_lang')
      	),

  		array("type" => "divider"),
  		
 		array( 
		"name" => __('Sidebar', 'gp_lang'),
        "desc" => __('Choose which sidebar area to display.', 'gp_lang'),
        "id" => $dirname."_product_cat_sidebar",
        "std" => "gp-product-cat",
        "type" => "select_sidebar"),

   		array("type" => "divider"),
   		   		  		
		array( 
		"name" => __('Layout', 'gp_lang'),
        "desc" => __('Choose the page layout.', 'gp_lang'),
        "id" => $dirname."_product_cat_layout",
        "std" => "sb-right",
		"options" => array('sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
  		array(
		"name" => __('Title', 'gp_lang'),
        "desc" => __('Choose whether to display the page title.', 'gp_lang'),
        "id" => $dirname."_product_cat_title",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Breadcrumbs', 'gp_lang'),
        "desc" => __('Choose whether to display breadcrumbs.', 'gp_lang'),
        "id" => $dirname."_product_cat_breadcrumbs",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Search Bar', 'gp_lang'),
        "desc" => __('Choose whether to display the search bar.', 'gp_lang'),
        "id" => $dirname."_product_cat_search",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
   		array(
		"name" => __('Bottom Content Widgets', 'gp_lang'),
        "desc" => __('Choose whether to display the bottom content widgets.', 'gp_lang'),
        "id" => $dirname."_product_cat_bottom_content_widgets",
        "std" => "Hide",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

  		array("type" => "divider"),
  		  		        
		array(
		"name" => __('Products Per Row', 'gp_lang'),
        "desc" => __('Enter the number of products you want to display per row.', 'gp_lang'),
        "id" => $dirname."_product_cat_columns",
        "std" => "3",
		"options" => array('1' => __('1', 'gp_lang'), '2' => __('2', 'gp_lang'), '3' => __('3', 'gp_lang'), '4' => __('4', 'gp_lang'), '5' => __('5', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),

  		array(
		"name" => __('Add To Cart Button', 'gp_lang'),
        "desc" => __('Choose whether to display the add to cart button.', 'gp_lang'),
        "id" => $dirname."_add_to_cart_button",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),

  		array(
		"name" => __('View Product Button', 'gp_lang'),
        "desc" => __('Choose whether to display the view product button.', 'gp_lang'),
        "id" => $dirname."_view_product_button",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),
        			                
		array("type" => "close"),
				
array(	"name" => __('Post Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_post_settings"),

		array(
		"name" => __('Post Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_posT_header",
      	"desc" => __('This section controls the global settings for all posts, but most settings can be overridden on individual posts.', 'gp_lang')
      	),

  		array("type" => "divider"),
  		        
		array(  
		"name" => __('Featured Image', 'gp_lang'),
        "desc" => __('Choose whether to display the featured image (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_show_post_image",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),
        
        array(
		"name" => __('Image Width', 'gp_lang'),
        "desc" => __('The width to crop the image to (can be overridden on individual posts, set to 0 to have a proportionate width).', 'gp_lang'),
        "id" => $dirname."_post_image_width",
        "std" => "670",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 

  		array(
		"name" => __('Image Height', 'gp_lang'),
        "desc" => __('The height to crop the image to (can be overridden on individual posts, set to 0 to have a proportionate height).', 'gp_lang'),
        "id" => $dirname."_post_image_height",
        "std" => "250",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 
		
		array(
		"name" => __('Image Wrap', 'gp_lang'),
        "desc" => __('Choose whether the page content wraps around the featured image (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_image_wrap",
        "std" => "Disable",
		"options" => array('Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')),
        "type" => "select"),

		array(
		"name" => __('Hard Crop', 'gp_lang'),
        "desc" => __('Choose whether the image is hard cropped (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_hard_crop",
        "std" => "Enable",
		"options" => array('Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')),
        "type" => "select"),
                
  		array("type" => "divider"),

 		array( 
		"name" => __('Sidebar', 'gp_lang'),
        "desc" => __('Choose which sidebar area to display (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_sidebar",
        "std" => "gp-default",
        "type" => "select_sidebar"),

   		array("type" => "divider"),
   		
   		array( 
		"name" => __('Layout', 'gp_lang'),
        "desc" => __('Choose the page layout (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_layout",
        "std" => "sb-right",
		"options" => array('sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
  		array(
		"name" => __('Title', 'gp_lang'),
        "desc" => __('Choose whether to display the page title (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_title",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Breadcrumbs', 'gp_lang'),
        "desc" => __('Choose whether to display breadcrumbs (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_breadcrumbs",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
    		
 		array(
		"name" => __('Search Bar', 'gp_lang'),
        "desc" => __('Choose whether to display the search bar (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_search",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

 		array("type" => "divider"),
 		
  		array(
		"name" => __('Bottom Content Widgets', 'gp_lang'),
        "desc" => __('Choose whether to display the bottom content widgets (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_post_bottom_content_widgets",
        "std" => "Hide",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

  		array("type" => "divider"),
  		
		array(  
		"name" => __('Post Author', 'gp_lang'),
        "desc" => __('Choose whether to display the post author.', 'gp_lang'),
        "id" => $dirname."_post_author",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
	
		array(  
		"name" => __('Post Date', 'gp_lang'),
        "desc" => __('Choose whether to display the post date.', 'gp_lang'),
        "id" => $dirname."_post_date",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array(  
		"name" => __('Post Categories', 'gp_lang'),
        "desc" => __('Choose whether to display the post categories.', 'gp_lang'),
        "id" => $dirname."_post_cats",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array(  
		"name" => __('Post Comment Number', 'gp_lang'),
        "desc" => __('Choose whether to display the number of post comments.', 'gp_lang'),
        "id" => $dirname."_post_comments",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
 
 		array(  
		"name" => __('Post Tags', 'gp_lang'),
        "desc" => __('Choose whether to display the post tags.', 'gp_lang'),
        "id" => $dirname."_post_tags",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
  		array("type" => "divider"),
  		
         array(
		"name" => __('Author Info Panel', 'gp_lang'),
        "desc" => __('Choose whether to display the author info panel (can also be inserted in individual posts using the <code>[author]</code> shortcode).', 'gp_lang'),
        "id" => $dirname."_post_author_info",
       "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
  		array("type" => "divider"),
		
		array( 
		"name" => __('Related Items', 'gp_lang'),
        "desc" => __('Choose whether to display a related items section (can also be inserted in individual posts using the <code>[related_posts]</code> shortcode).', 'gp_lang'), 
        "id" => $dirname."_post_related_items",
        "std" => "0",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),

        array(
		"name" => __('Image Width', 'gp_lang'),
        "desc" => __('The width to crop the image to (set to 0 to have a proportionate width).', 'gp_lang'),
        "id" => $dirname."_post_related_image_width",
        "std" => "120",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 

  		array(
		"name" => __('Image Height', 'gp_lang'),
        "desc" => __('The height to crop the image to (set to 0 to have a proportionate height).', 'gp_lang'),
        "id" => $dirname."_post_related_image_height",
        "std" => "100",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 
         
		array("type" => "close"),

array(	"name" => __('Page Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_page_settings"),

		array(
		"name" => __('Page Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_page_header",
      	"desc" => __('This section controls the global settings for all pages, but most settings can be overridden on individual pages.', 'gp_lang')
      	),

  		array("type" => "divider"),
  		   		
		array(  
		"name" => __('Featured Image', 'gp_lang'),
        "desc" => __('Choose whether to display the featured image (can be overridden on individual posts).', 'gp_lang'),
        "id" => $dirname."_show_page_image",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),
        
        array(
		"name" => __('Image Width', 'gp_lang'),
        "desc" => __('The width to crop the image to (can be overridden on individual pages, set to 0 to have a proportionate width).', 'gp_lang'),
        "id" => $dirname."_page_image_width",
        "std" => "670",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 

  		array(
		"name" => __('Image Height', 'gp_lang'),
        "desc" => __('The height to crop the image to (can be overridden on individual pages, set to 0 to have a proportionate height).', 'gp_lang'),
        "id" => $dirname."_page_image_height",
        "std" => "250",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 
		
		array(
		"name" => __('Image Wrap', 'gp_lang'),
        "desc" => __('Choose whether the page content wraps around the featured image (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_image_wrap",
        "std" => "Disable",
		"options" => array('Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')),
        "type" => "select"),

		array(
		"name" => __('Hard Crop', 'gp_lang'),
        "desc" => __('Choose whether the image is hard cropped (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_hard_crop",
        "std" => "Enable",
		"options" => array('Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')),
        "type" => "select"),
                
   		array("type" => "divider"),

 		array( 
		"name" => __('Sidebar', 'gp_lang'),
        "desc" => __('Choose which sidebar area to display (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_sidebar",
        "std" => "gp-default",
        "type" => "select_sidebar"),

   		array("type" => "divider"),
   		   		
		array( 
		"name" => __('Layout', 'gp_lang'),
        "desc" => __('Choose the page layout (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_layout",
		"style" => "sb-right",
		"options" => array('sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
  		array(
		"name" => __('Title', 'gp_lang'),
        "desc" => __('Choose whether to display the page title (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_title",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Breadcrumbs', 'gp_lang'),
        "desc" => __('Choose whether to display breadcrumbs (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_breadcrumbs",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Search Bar', 'gp_lang'),
        "desc" => __('Choose whether to display the search bar (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_search",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
  		array(
		"name" => __('Bottom Content Widgets', 'gp_lang'),
        "desc" => __('Choose whether to display the bottom content widgets (can be overridden on individual pages).', 'gp_lang'),
        "id" => $dirname."_page_bottom_content_widgets",
        "std" => "Hide",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

  		array("type" => "divider"),
  		
		array(  
		"name" => __('Page Author', 'gp_lang'),
        "desc" => __('Choose whether to display the page author.', 'gp_lang'),
        "id" => $dirname."_page_author",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
   		
		array(  
		"name" => __('Page Date', 'gp_lang'),
        "desc" => __('Choose whether to display the page date.', 'gp_lang'),
        "id" => $dirname."_page_date",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array(  
		"name" => __('Page Comment Number', 'gp_lang'),
        "desc" => __('Choose whether to display the number of page comments.', 'gp_lang'),
        "id" => $dirname."_page_comments",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),

   		array("type" => "divider"),
   		
		array(  
		"name" => __('Author Info Panel', 'gp_lang'),
        "desc" => __('Choose whether to display an author info panel.', 'gp_lang'),
        "id" => $dirname."_page_author_info",
        "std" => "1",
		"options" => array(__('Enable', 'gp_lang'), __('Disable', 'gp_lang')),
        "type" => "radio"),
        
		array("type" => "close"),

array(	"name" => __('Product Page Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_product_page_settings"),

		array(
		"name" => __('Product Page Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_product_page_header",
      	"desc" => __('This section controls the global settings for all product pages, but most settings can be overridden on individual product pages.', 'gp_lang')
      	),

  		array("type" => "divider"),
  		  		   		
 		array(
		"name" => __('Image Effect', 'gp_lang'),
        "desc" => __('Choose what image effect is used on your product page images.', 'gp_lang'),
        "id" => $dirname."_image_effect",
        "std" => "Zoom",
		"options" => array('Zoom' => __('Zoom', 'gp_lang'), 'Lightbox' => __('Lightbox', 'gp_lang'), 'None' => __('None', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),

 		array( 
		"name" => __('Sidebar', 'gp_lang'),
        "desc" => __('Choose which sidebar area to display (can be overridden on individual products).', 'gp_lang'),
        "id" => $dirname."_product_sidebar",
        "std" => "gp-product",
        "type" => "select_sidebar"),

   		array("type" => "divider"),
     		
   		array( 
		"name" => __('Layout', 'gp_lang'),
        "desc" => __('Choose the page layout (can be overridden on individual products).', 'gp_lang'),
        "id" => $dirname."_product_layout",
        "std" => "sb-right",
		"options" => array('sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		 		   		
 		array(
		"name" => __('Breadcrumbs', 'gp_lang'),
        "desc" => __('Choose whether to display breadcrumbs (can be overridden on individual products).', 'gp_lang'),
        "id" => $dirname."_product_breadcrumbs",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),

   		array("type" => "divider"),
   		
 		array(
		"name" => __('Search Bar', 'gp_lang'),
        "desc" => __('Choose whether to display the search bar (can be overridden on individual products).', 'gp_lang'),
        "id" => $dirname."_product_search",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),
  
   		array("type" => "divider"),

  		array(
		"name" => __('Bottom Content Widgets', 'gp_lang'),
        "desc" => __('Choose whether to display the bottom content widgets (can be overridden on individual products).', 'gp_lang'),
        "id" => $dirname."_product_bottom_content_widgets",
        "std" => "Show",
		"options" => array('Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')),
        "type" => "select"),
                        
		array("type" => "close"),

array(	"name" => __('Style Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_style_settings"),
	
		array(
		"name" => __('Style Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_style_header",
      	"desc" => __('This section provides you with some basic settings to change the look of the theme. If you want to customize the design of the theme further you can add your own CSS styling in "CSS Settings" tab.', 'gp_lang')
      	),

  		array("type" => "divider"), 		
  			
 		array(
		"name" => __('Body Font', 'gp_lang'),
        "desc" => __('Enter the name of the font you want to use for the body text (e.g. Times New Roman, Arial, Oswald). To use <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a> get the "Standard" code provided by Google and add this to "Scripts" box in the "General Settings" tab.', 'gp_lang'),
        "id" => $dirname."_body_font",
        "type" => "text",), 
				
 		array(
		"name" => __('Body Text Size', 'gp_lang'),
        "desc" => __('The text size used in body text.', 'gp_lang'),
        "id" => $dirname."_body_size",
        "type" => "text",
		"size" => "small",
		"details" => "px"), 
				   		
 		array(
		"name" => __('Body Text Color', 'gp_lang'),
        "desc" => __('The text color used in body text.', 'gp_lang'),
        "id" => $dirname."_body_text_color",
        "type" => "colorpicker"),
   		         
 		array(
		"name" => __('Body Link Color', 'gp_lang'),
        "desc" => __('The link color used in body text.', 'gp_lang'),
        "id" => $dirname."_body_link_color",
        "type" => "colorpicker"), 

 		array(
		"name" => __('Body Link Hover Color', 'gp_lang'),
        "desc" => __('The link hover color used in body text.', 'gp_lang'),
        "id" => $dirname."_body_link_hover_color",
        "type" => "colorpicker"), 

   		array("type" => "divider"),

 		array(
		"name" => __('Heading Font', 'gp_lang'),
        "desc" => __('Enter the name of the font you want to use for the headings (e.g. Times New Roman, Arial, Oswald). To use <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a> get the "Standard" code provided by Google and add this to "Scripts" box in the "General Settings" tab.', 'gp_lang'),
        "id" => $dirname."_heading_font",
        "type" => "text",), 

 		array(
		"name" => __('Heading 1 Text Size', 'gp_lang'),
        "desc" => __('The text size used in &lt;h1&gt; headings.', 'gp_lang'),
        "id" => $dirname."_heading1_size",
        "type" => "text",
		"size" => "small",
		"details" => "px"),

 		array(
		"name" => __('Heading 2 Text Size', 'gp_lang'),
        "desc" => __('The text size used in &lt;h2&gt; headings.', 'gp_lang'),
        "id" => $dirname."_heading2_size",
        "type" => "text",
		"size" => "small",
		"details" => "px"),
		
 		array(
		"name" => __('Heading 3 Text Size', 'gp_lang'),
        "desc" => __('The text size used in &lt;h3&gt; headings.', 'gp_lang'),
        "id" => $dirname."_heading3_size",
        "type" => "text",
		"size" => "small",
		"details" => "px"),
						           		
 		array(
		"name" => __('Heading Text Color', 'gp_lang'),
        "desc" => __('The text colour used in headings.', 'gp_lang'),
        "id" => $dirname."_heading_text_color",
        "type" => "colorpicker"), 

 		array(
		"name" => __('Heading Link Color', 'gp_lang'),
        "desc" => __('The link colour used in headings.', 'gp_lang'),
        "id" => $dirname."_heading_link_color",
        "type" => "colorpicker"), 
        
 		array(
		"name" => __('Heading Link Hover Color', 'gp_lang'),
        "desc" => __('The link hover colour used in headings.', 'gp_lang'),
        "id" => $dirname."_heading_link_hover_color",
        "type" => "colorpicker"), 

   		array("type" => "divider"),
  
   		array(
		"name" => __('Left Header Background Color', 'gp_lang'),
        "desc" => __('The background colour of the header to the left of your logo.', 'gp_lang'),
        "id" => $dirname."_header_left_bg_color",
        "type" => "colorpicker"),  		
 
 		array(
		"name" => __('Right Header Background Color', 'gp_lang'),
        "desc" => __('The background colour of the header to the right of your logo.', 'gp_lang'),
        "id" => $dirname."_header_right_bg_color",
        "type" => "colorpicker"),  	
				   		
 		array(
		"name" => __('Header Text Color', 'gp_lang'),
        "desc" => __('The text colour used in the header.', 'gp_lang'),
        "id" => $dirname."_header_text_color",
        "type" => "colorpicker"),
   		         
 		array(
		"name" => __('Header Link Color', 'gp_lang'),
        "desc" => __('The link colour used in the header.', 'gp_lang'),
        "id" => $dirname."_header_link_color",
        "type" => "colorpicker"), 

 		array(
		"name" => __('Header Link Hover Color', 'gp_lang'),
        "desc" => __('The link hover colour used in the header.', 'gp_lang'),
        "id" => $dirname."_header_link_hover_color",
        "type" => "colorpicker"), 
                     		  		
  		array("type" => "divider"),
 
 		array(
		"name" => __('Outer Body Text Color', 'gp_lang'),
        "desc" => __('The text colour used outside the main content area.', 'gp_lang'),
        "id" => $dirname."_outer_body_text_color",
        "type" => "colorpicker"),
   		         
 		array(
		"name" => __('Outer Body Link Color', 'gp_lang'),
        "desc" => __('The link colour used outside the main content area.', 'gp_lang'),
        "id" => $dirname."_outer_body_link_color",
        "type" => "colorpicker"), 

 		array(
		"name" => __('Outer Body Link Hover Color', 'gp_lang'),
        "desc" => __('The link hover colour used outside the main content area.', 'gp_lang'),
        "id" => $dirname."_outer_body_link_hover_color",
        "type" => "colorpicker"), 
                     		  		
  		array("type" => "divider"),
  		  		
		array(
		"name" => __('Content Background Color 1', 'gp_lang'),
        "desc" => __('The background colour of the main elements that contain content.', 'gp_lang'),
        "id" => $dirname."_content_bg_color_1",
        "type" => "colorpicker"),  
 
		array(
		"name" => __('Content Background Color 2', 'gp_lang'),
        "desc" => __('The background colour of secondary elements that contain content.', 'gp_lang'),
        "id" => $dirname."_content_bg_color_2",
        "type" => "colorpicker"), 
               
		array(
		"name" => __('Content Border Color', 'gp_lang'),
        "desc" => __('The border colour of the main elements.', 'gp_lang'),
        "id" => $dirname."_content_border_color",
        "type" => "colorpicker"), 
             
		array(
		"name" => __('Alternative Content Border Color', 'gp_lang'),
        "desc" => __('The alternative border colour of the main elements.', 'gp_lang'),
        "id" => $dirname."_content_border_alt_color",
        "type" => "colorpicker"), 
                
   		array("type" => "divider"),

 		array(
		"name" => __('Button Text Color', 'gp_lang'),
        "desc" => __('The text color of buttons.', 'gp_lang'),
        "id" => $dirname."_button_text_color",
        "type" => "colorpicker"),  

 		array(
		"name" => __('Button Text Hover Color', 'gp_lang'),
        "desc" => __('The link color of buttons.', 'gp_lang'),
        "id" => $dirname."_button_text_hover_color",
        "type" => "colorpicker"),  
        
 		array(
		"name" => __('Button Background Color', 'gp_lang'),
        "desc" => __('The background color of buttons.', 'gp_lang'),
        "id" => $dirname."_button_bg_color",
        "type" => "colorpicker"),      

 		array(
		"name" => __('Button Background Hover Color', 'gp_lang'),
        "desc" => __('The background hover color of buttons.', 'gp_lang'),
        "id" => $dirname."_button_bg_hover_color",
        "type" => "colorpicker"),	
           		           		                                 
		array("type" => "close"),
		       		              			
array(	"name" => __('CSS Settings', 'gp_lang'),
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $dirname."_css_settings"),

		array(
		"name" => __('CSS Settings', 'gp_lang'),
		"type" => "header",
      	"id" => $dirname."_css_header",
      	"desc" => __('You can add your own CSS below to style the theme. This CSS will not be lost if you update the theme. For more information on how to find the names of the elements you want to style  click', 'gp_lang').' <a href="http://ghostpool.com/help/'.$dirname.'/help.html#customizing-design" target="_blank">'.__('here', 'gp_lang').'</a>',
      	),

  		array("type" => "divider"),
  				
		array(
		"name" => __('Custom CSS', 'gp_lang'),
        "desc" => '',
        "id" => $dirname."_custom_css",
        "type" => "textarea",
        "size" => "large"),

		array("type" => "close"),
	
);

function gp_add_admin() {

    global $dirname, $options;
			
    if(isset($_GET['page']) && $_GET['page'] == basename(__FILE__)) {

        if(isset($_REQUEST['action']) && 'save' == $_REQUEST['action']) {

			foreach($options as $value) {
				if(isset($value['id'])) {
					update_option($value['id'], $_REQUEST[ $value['id']]);
				} else {
					if(isset($value['id'])) { delete_option($value['id']); }
				}
			}

			header("Location: themes.php?page=theme-options.php&saved=true");
			die;

        } elseif(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {

            foreach($options as $value) {
                delete_option($value['id']);
            }
            
            update_option($dirname.'_theme_setup_status', '0');

            header("Location: themes.php?page=theme-options.php&reset=true");
            die;

        }

		elseif(isset($_REQUEST['action']) && 'export' == $_REQUEST['action']) export_settings();
		elseif(isset($_REQUEST['action']) && 'import' == $_REQUEST['action']) import_settings();

    }

    add_theme_page(__('Theme Options', 'gp_lang'), __('Theme Options', 'gp_lang'), 'manage_options', basename(__FILE__), 'gp_admin');

}

function gp_admin() {

    global $dirname, $options;

    if(isset($_REQUEST['saved']) && $_REQUEST['saved']) echo '<div id="message" class="updated"><p><strong>'.__('Options Saved', 'gp_lang').'</strong></p></div>';
    if(isset($_REQUEST['reset']) && $_REQUEST['reset']) echo '<div id="message" class="updated"><p><strong>'.__('Options Reset', 'gp_lang').'</strong></p></div>';

?>


<!-- BEGIN THEME WRAPPER -->

<div id="gp-theme-options" class="wrap">
	
	<?php screen_icon('options-general'); ?>
	<h2><?php _e('Theme Options', 'gp_lang'); ?></h2>
		
	<p><h3><a href="http://ghostpool.com/help/<?php echo $dirname; ?>/help.html" target="_blank"><?php _e('Help File', 'gp_lang'); ?></a> | <a href="http://ghostpool.com/help/<?php echo $dirname; ?>/changelog.html" target="_blank"><?php _e('Changelog', 'gp_lang'); ?></a> | <a href="http://ghostpool.ticksy.com" target="_blank"><?php _e('Support', 'gp_lang'); ?></a> | <a href="http://www.ourwebmedia.com/ghostpool.php?aff=002" target="_blank"><?php _e('Premium Services', 'gp_lang'); ?></a></h3></p>
	
	<div id="import_export" class="hide-if-js">
	
		<h3><?php _e('Import Theme Options', 'gp_lang'); ?></h3>
		<div class="option-desc"><?php _e('If you have a back up of your theme options you can import them below.', 'gp_lang'); ?></div>
		
		<form method="post" enctype="multipart/form-data">
			<p class="submit"><input type="file" name="file" id="file" />
			<input type="submit" name="import" class="button" value="<?php _e('Upload', 'gp_lang'); ?>" /></p>
			<input type="hidden" name="action" value="import" />
		</form>

		<div class="divider"></div>
		
		<h3><?php _e('Export Theme Options', 'gp_lang'); ?></h3>
		<div class="option-desc"><?php _e('If you want to create a back up of all your theme options click the Export button below (will only back up your theme options and not your post/page/images data).', 'gp_lang'); ?></div>
		
		<form method="post">
			<p class="submit"><input name="export" type="submit" class="button" value="<?php _e('Export Theme Settings', 'gp_lang'); ?>" /></p>
			<input type="hidden" name="action" value="export" />
		</form>	
	
	</div>

	
	<form method="post">
		
		<div class="submit">	
		
			<a href="#TB_inline?height=300&amp;width=500&amp;inlineId=import_export" onclick="return false;" class="thickbox"><input type="button" class="button" value="<?php _e('Import/Export Theme Options' ,'gp_lang'); ?>"></a>
		
			<input name="save" type="submit" class="button-primary right" value="<?php _e('Save Changes', 'gp_lang'); ?>" />
			<input type="hidden" name="action" value="save" />
			
		</div>
		
		<div id="panels">


<?php foreach($options as $value) {
switch($value['type']) {
case "open":
?>

<?php break;
case "title":
?>

<div class="panel" id="<?php echo $value['name']; ?>">


<?php break;
case "header":
?>

	<div class="option option-header">
		<?php if($value['name']) { ?><h2><?php echo $value['name']; ?></h2><?php } ?>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>
	
	
<?php break;
case "close":
?>

</div>
<!-- END PANEL -->


<?php break;
case "divider":
?>

<div class="divider"></div>


<?php break;
case "clear":
?>

<div class="clear"></div>


<?php break;
case 'text':
?>
	
	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?><?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if( get_option( $value['id'] ) != '' ) { echo get_option( $value['id'] ); } else { if( isset( $value['std'] ) ) { echo $value['std']; } } ?>" size="<?php if ( isset( $value['size'] ) && $value['size'] == 'small' ) { ?>3<?php } else { ?>40<?php } ?>" /><?php if ( isset( $value['details'] ) ) { ?> <span><?php echo $value['details']; ?></span>&nbsp;<?php } ?>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php break;
case 'upload':
?>

	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option uploader"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" size="40" class="upload" value="<?php echo get_option($value['id']); ?>" />
		<input type="button" id="<?php echo $value['id']; ?>_button" class="upload-image-button button" value="<?php _e('Upload', 'gp_lang'); ?>" />
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php
break;

case 'textarea':
?>

	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="70" rows="<?php if ( isset( $value['size'] ) && $value['size'] == 'large' ) { ?>50<?php } else { ?>10<?php } ?>"><?php if( get_option( $value['id'] ) != '' ) { echo stripslashes( get_option( $value['id'] ) ); } else { if( isset( $value['std'] ) ) { echo $value['std']; } } ?></textarea>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php
break;
case 'select':
?>
	
	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach($value['options'] as $key=>$option) { ?>
					<?php if(get_option($value['id']) != "") { ?>
						<option value="<?php echo $key; ?>" <?php if(get_option($value['id']) == $key) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
					<?php } else { ?>
						<option value="<?php echo $key; ?>" <?php if($value['std'] == $key) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
					<?php } ?>
			<?php } ?>
		</select>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php
break;
case 'select_taxonomy':
?>
		
	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<?php $terms = get_terms($value['cats'], 'hide_empty=0'); ?>
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><option value=''><?php _e('None', 'gp_lang'); ?></option><?php foreach($terms as $term): ?><option value="<?php echo $term->slug; ?>" <?php if(get_option($value['id'])==  $term->slug) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option><?php endforeach; ?></select>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>	


<?php
break;
case 'select_sidebar':
global $post, $wp_registered_sidebars;
?>
		
	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php $sidebars = $wp_registered_sidebars; 
		if(is_array($sidebars) && !empty($sidebars)) { 
			foreach($sidebars as $sidebar) { 
				if(get_option($value['id']) != "") { ?>
					<option value="<?php echo $sidebar['id']; ?>"<?php if(get_option($value['id']) == $sidebar['id']) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
				<?php } else { ?>				
					<option value="<?php echo $sidebar['id']; ?>"<?php if($value['std'] == $sidebar['id']) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>				
		<?php }}} ?>	
		</select>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>

	
<?php
break;
case "checkbox":
?>
   
   
   	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option<?php if($value['extras'] == "multi") { ?> multi-checkbox<?php } ?>">
		<?php if(get_option($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; } ?><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php        
break;
case "radio":
?>

	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<?php foreach($value['options'] as $key=>$option) {	
			$radio_setting = get_option($value['id']);
			if($radio_setting != '') {
				if($key == get_option($value['id'])) {
					$checked = "checked=\"checked\"";
				} else {
					$checked = "";
				}
			} else {
				if($key == $value['std']) {
					$checked = "checked=\"checked\"";
				} else {
					$checked = "";
				}
			} ?>
			<div class="radio-buttons">
				<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'] . $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><label for="<?php echo $value['id'] . $key; ?>"><?php echo $option; ?></label>
			</div>	
		<?php } ?>
		<div class="clear"></div>
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php        
break;
case "colorpicker":
?>

	<?php if($value['name']) { ?><h3><?php echo $value['name']; ?></h3><?php } ?>
	<div class="option"<?php if ( isset( $value['style'] ) ) { ?> style="<?php echo $value['style']; ?>"<?php } ?>>
		<script type="text/javascript">
			jQuery(document).ready(function($) {  
				$("#<?php echo $value['id']; ?>").wpColorPicker();
			});
		</script>
		<input type="text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php if( get_option( $value['id'] ) != '' ) { echo get_option( $value['id'] ); } else { if( isset( $value['std'] ) ) { if( isset( $value['std'] ) ) { echo $value['std']; } } } ?>" />
		<?php if ( isset( $value['desc'] ) ) { ?><div class="option-desc"><?php echo $value['desc']; ?></div><?php } ?>
	</div>


<?php        
break;
}}
?>

	</div>
	
	<div class="submit">

			<input name="save" type="submit" class="button-primary right" value="<?php _e('Save Changes', 'gp_lang'); ?>" />
			<input type="hidden" name="action" value="save" />

		</form>
	
		<form method="post" onSubmit="if(confirm('<?php _e('Are you sure you want to reset all the theme options&#63;', 'gp_lang'); ?>')) return true; else return false;">	
			<input name="reset" type="submit" class="button right" style="margin-right: 10px;" value="<?php _e('Reset', 'gp_lang'); ?>" />
			<input type="hidden" name="action" value="reset" />			
		</form>
		
		<div class="clear"></div>
	
	</div>

</div>

<!-- END THEME WRAPPER -->


<?php } 

if(is_admin() && $pagenow == "themes.php") {
	function gp_admin_scripts() {
		wp_enqueue_style('thickbox');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('gp-admin', get_template_directory_uri().'/lib/admin/css/admin.css');	
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('thickbox');
		wp_enqueue_media();
		wp_enqueue_script('gp-tabs', get_template_directory_uri().'/lib/admin/scripts/jquery.tabs.js', array('jquery'));
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('gp-uploader', get_template_directory_uri().'/lib/admin/scripts/uploader.js');
	}
	add_action('admin_print_scripts', 'gp_admin_scripts');
}

add_action('admin_menu', 'gp_add_admin'); 


// Export Theme Options
function export_settings() {
	global $options;
	header("Cache-Control: public, must-revalidate");
	header("Pragma: hack");
	header("Content-Type: text/plain");
	header('Content-Disposition: attachment; filename="theme-options-'.date("dMy").'.dat"');
	foreach($options as $value) $theme_settings[$value['id']] = get_option($value['id']);	
	echo serialize($theme_settings);
}

// Import Theme Options
function import_settings() {
	global $options;
	if($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
	} else {
		$rawdata = file_get_contents($_FILES["file"]["tmp_name"]);		
		$theme_settings = unserialize($rawdata);		
		foreach($options as $value) {
			if($theme_settings[$value['id']]) {
				update_option($value['id'], $theme_settings[$value['id']]);
				$$value['id'] = $theme_settings[$value['id']];
			} else {
				if($value['type'] == 'checkbox_multiple')$$value['id'] = array();
				else $$value['id'] = $value['std'];
			}
		}
		
	}
	if(in_array('cacheStyles', get_option('theme_misc'))) cache_settings();
	wp_redirect($_SERVER['PHP_SELF'].'?page=theme-options.php');
}

// Help Tab
if(is_admin() && $pagenow == "themes.php") {
	function theme_help_tab() {
		global $dirname;
		$screen = get_current_screen();
		$screen->add_help_tab(array( 
			'id' => 'help', 'title' => 'Help', 'content' => '<p><a href="http://ghostpool.com/help/'.$dirname.'/help.html" target="_blank">'.__('Help File', 'gp_lang').'</a></p><p><a href="http://ghostpool.com/help/'.$dirname.'/changelog.html" target="_blank">'.__('Changelog', 'gp_lang').'</a></p><p><a href="http://ghostpool.ticksy.com" target="_blank">'.__('Support', 'gp_lang').'</a></p><p><a href="http://www.ourwebmedia.com/ghostpool.php?aff=002" target="_blank">'.__('Premium Services', 'gp_lang').'</a></p>'
		));	
	}
	add_action('admin_head', 'theme_help_tab');
}


/////////////////////////////////////// Save Default Theme Options ///////////////////////////////////////

add_action('after_setup_theme', 'the_theme_setup');
function the_theme_setup() {

	global $dirname;
	
	if(get_option($dirname.'_theme_setup_status') !== '1') {
	
		$core_settings = array(
		
			/* General Settings */
			$dirname.'_skin' => 'dark',
			$dirname.'_header_height' => '75',							
			$dirname.'_search_criteria' => 'Products',
			$dirname.'_responsive' => '0',	
			$dirname.'_retina' => '0',		
			$dirname.'_rss_button' => '0',
			$dirname.'_jwplayer' => '1',			
			$dirname.'_old_video_shortcode' => '1',
			$dirname.'_preload' => '1',
		
			/* Category Settings */
			$dirname.'_cat_thumbnail_width' => '670',
			$dirname.'_cat_thumbnail_height' => '250',
			$dirname.'_cat_image_wrap' => 'Disable',
			$dirname.'_cat_hard_crop' => 'Enable',	
			$dirname.'_cat_sidebar' => 'gp-default',
			$dirname.'_cat_layout' => 'sb-right',
			$dirname.'_cat_title' => 'Show',
			$dirname.'_cat_breadcrumbs' => 'Show',
			$dirname.'_cat_search' => 'Show',
			$dirname.'_cat_bottom_widgets' => 'Hide',						
			$dirname.'_cat_content_display' => '0',
			$dirname.'_cat_excerpt_length' => '400',
			$dirname.'_cat_read_more' => '0',
			$dirname.'_cat_date' => '0',
			$dirname.'_cat_author' => '0',
			$dirname.'_cat_cats' => '0',
			$dirname.'_cat_comments' => '0',
			$dirname.'_cat_tags' => '1',	

			/* Product Category Settings */
			$dirname.'_product_cat_sidebar' => 'gp-product-cat',
			$dirname.'_product_cat_layout' => 'sb-right',
			$dirname.'_product_cat_title' => 'Show',
			$dirname.'_product_cat_breadcrumbs' => 'Show',
			$dirname.'_product_cat_search' => 'Show',			
			$dirname.'_product_cat_bottom_widgets' => 'Hide',
			$dirname.'_product_cat_columns' => '3',
			
			/* Post Settings */
			$dirname.'_post_image' => 'Show',
			$dirname.'_post_image_width' => '670',
			$dirname.'_post_image_height' => '250',
			$dirname.'_post_image_wrap' => 'Disable',
			$dirname.'_post_hard_crop' => 'Enable',	
			$dirname.'_post_sidebar' => 'gp-default',
			$dirname.'_post_layout' => 'sb-right',	
			$dirname.'_post_title' => 'Show',
			$dirname.'_post_breadcrumbs' => 'Show',
			$dirname.'_post_search' => 'Show',
			$dirname.'_post_bottom_widgets' => 'Hide',			
			$dirname.'_post_date' => '0',
			$dirname.'_post_author' => '0',
			$dirname.'_post_cats' => '0',
			$dirname.'_post_comments' => '0',
			$dirname.'_post_tags' => '1',	
			$dirname.'_post_author_info' => '0',	
			$dirname.'_post_related_items' => '0',	
			$dirname.'_post_related_image_width' => '120',	
			$dirname.'_post_related_image_height' => '100',			
			
			/* Page Settings */
			$dirname.'_page_image' => 'Show',
			$dirname.'_page_image_width' => '670',
			$dirname.'_page_image_height' => '250',
			$dirname.'_page_image_wrap' => 'Disable',
			$dirname.'_page_hard_crop' => 'Enable',	
			$dirname.'_page_sidebar' => 'gp-default',
			$dirname.'_page_layout' => 'sb-right',		
			$dirname.'_page_title' => 'Show',
			$dirname.'_page_breadcrumbs' => 'Show',
			$dirname.'_page_search' => 'Show',
			$dirname.'_page_bottom_widgets' => 'Hide',			
			$dirname.'_page_date' => '1',
			$dirname.'_page_author' => '1',
			$dirname.'_page_comments' => '1',	
			$dirname.'_page_author_info' => '1',			

			/* Product Page Settings */
			$dirname.'_product_image_effect' => 'Zoom',
			$dirname.'_product_sidebar' => 'gp-product',
			$dirname.'_product_layout' => 'sb-right',
			$dirname.'_product_page_breadcrumbs' => 'Show',
			$dirname.'_product_page_search' => 'Show',
			$dirname.'_product_page_bottom_widgets' => 'Show',
																			
		);
		foreach($core_settings as $k => $v) {
			update_option($k, $v);
		}

		update_option($dirname.'_theme_setup_status', '1');

	}		

}

?>