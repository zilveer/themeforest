<?php 

$themename = "Yourmag Options";
$shortname = "op";

$cats_array = get_categories('hide_empty=0');
$pages_array = get_pages('hide_empty=0');
$site_pages = array();
$site_cats = array();

foreach ($pages_array as $pagg) {
	$site_pages[$pagg->ID] = htmlspecialchars($pagg->post_title);
	$pages_ids[] = $pagg->ID;
}

foreach ($cats_array as $categs) {
	$site_cats[$categs->cat_ID] = $categs->cat_name;
	$cats_ids[] = $categs->cat_ID;
}
 
$op_categories_obj = get_categories('hide_empty=1');
$op_categories = array();
foreach ($op_categories_obj as $op_cat) {
$op_categories[$op_cat->cat_ID] = $op_cat->category_nicename;
}
$categories_tmp = array_unshift($op_categories, "Select a category:");	

$google_fonts_header =  array('Oswald','Open Sans','Open Sans Condensed','Droid Sans','Lato','Droid Serif','Bitter','PT Sans', 'PT Sans Narrow', 'PT Sans Caption', 'Abel','Lato','Nobile','Crimson Text','Arvo','Tangerine','Cuprum','Cantarell','Philosopher','Josefin Sans','Dancing Script','Raleway','Bentham','Goudy Bookletter 1911','Quattrocento','Ubuntu');
$google_fonts =  array('Open Sans','Open Sans Condensed','Droid Sans','Oswald','Lato','Droid Serif','Bitter','PT Sans', 'PT Sans Narrow', 'PT Sans Caption', 'Abel','Lato','Nobile','Crimson Text','Arvo','Tangerine','Cuprum','Cantarell','Philosopher','Josefin Sans','Dancing Script','Raleway','Bentham','Goudy Bookletter 1911','Quattrocento','Ubuntu');

$royal_options = array (
	
array( "type" => "tabs-open",),
		
array( "name" => "General_1",
       "type" => "tab",
	   "desc" => "General settings"),

array( "name" => "General_2",
		"type" => "tab",
		"desc" => "Featured"),	
		
array( "name" => "General_3",
		"type" => "tab",
		"desc" => "Pages"),
		
array( "name" => "General_4",
		"type" => "tab",
		"desc" => "Single post"),			

array( "name" => "General_41",
		"type" => "tab",
		"desc" => "Single page"),			
		
array( "name" => "General_5",
		"type" => "tab",
		"desc" => "Colorization"),

array( "name" => "General_52",
		"type" => "tab",
		"desc" => "Ads & Social"),	
		
array( "name" => "General_6",
		"type" => "tab",
		"desc" => "SEO"),	

array( "name" => "General_7",
		"type" => "tab",
		"desc" => "Translation"),	
	
array( "name" => "General_8",
		"type" => "tab",
		"desc" => "Layout"),		
	
array( "type" => "tabs-close",),
		
		
array( "name" => "General_1",
		"type" => "content-open",),						
		
array( "name" => "Custom Style (Must be enabled!)",
        "id" => $shortname."_custom_colors",
        "type" => "checkbox",
        "std" => "on",
        "desc" => "Enable this option to display custom styles theme"),	

array( "type" => "clearfix",),
	
array( "name" => "Header top panel",
        "id" => $shortname."_header_top_menu",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Header top panel."),
		
array( "type" => "clearfix",),		
	
	
array( "name" => "Header (Logo and Banner)",
        "id" => $shortname."_header",
        "type" => "checkbox",
        "std" => "on",
		"desc" => "Enable this option to display Header."),
		
array( "type" => "clearfix",),		
	
	
array( "name" => "Disable Default Menu Scripts (Only if you have enabled menu plugin, ex: Mega Main Menu)",
        "id" => $shortname."_menu_disable",
        "type" => "checkbox",
        "std" => "false",
        "desc" => "Enable this option to Disable Default Menu Scripts"),	

array( "type" => "clearfix",),

array( "name" => "Show login panel in header (Only if you have enabled Wp Modal Login plugin)",
        "id" => $shortname."_header_login",
        "type" => "checkbox",
        "std" => "false",
        "desc" => "Enable this option to login panel in header"),		
	
array( "type" => "clearfix",),
	
array( "name" => "Favicon",
		"id" => $shortname."_favicon",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to the image favicon <br/>(size: 16x16px, format: .ico)"),		
	
	
array( 	"name" => "Header - Variant",
		"id" => $shortname."_header_layout",
		"type" => "select",
		"std" => "",
        "options" => array('Logo Center', 'Logo + Banner'),
		"desc" => "Select a variant for header."),		
	
	
array( "name" => "Logo",
        "id" => $shortname."_logo_on",
        "type" => "checkbox",
        "std" => "on",
		"desc" => "If logo is turned off, then will be displayed name and site description."),
			
array( "type" => "clearfix",),
			 
array( "name" => "Logo image",
		"id" => $shortname."_logo",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to the image"),			 							

array( "type" => "clearfix",),			
	

array( "name" => "Header Cufon Font",
		"id" => $shortname."_header_font",
		"type" => "select",
		"std" => "Kreon",
		"options" => $google_fonts_header,
		"desc" => "Select Cufon font for h1-h6 headers.",),	

array( "name" => "Custom Header Cufon Font",
        "id" => $shortname."_custom_header_font",
        "type" => "text",
		"std" => "",
		"desc" => "Write your own Cufon Font for Headers"),				
		
array( "name" => "Text Cufon Font",
		"id" => $shortname."_text_font",
		"type" => "select",
		"std" => "Kreon",
		"options" => $google_fonts,
		"desc" => "Select Cufon font for text.",),	
			
array( "type" => "clearfix",),	
		
array( "name" => "Footer sidebar",
        "id" => $shortname."_footer_sidebar",
        "type" => "checkbox",
        "std" => "on",
		"desc" => "Enable this option to display footer sidebar."),

array( "type" => "clearfix",),
	
array( "name" => "Google Analytics Code",
        "id" => $shortname."_ga_code",
		"std" => "",
        "type" => "textarea",
		"desc" => "Insert GA Code which will be displayed in footer."),	
		
array( "type" => "clearfix",),			

array( "name" => "Custom CSS",
        "id" => $shortname."_custom_css",
		"std" => "",
        "type" => "textarea",
		"desc" => "Write your own custom styles."),		
		
		
		
array( "type" => "clearfix",),				   
array( "name" => "General_1",
		"type" => "content-close",),
		
		
array( "name" => "General_2",
		"type" => "content-open",),				
		

array( "name" => "News ticker",
        "id" => $shortname."_news_ticker",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display News ticker."),	
		
array( "type" => "clearfix",),
		
array( 	"name" => "News ticker - recent posts or featured category",
		"id" => $shortname."_recent_news_ticker",
		"type" => "select",
		"std" => "",
        "options" => array('Recent posts', 'Featured category'),
		"desc" => "Select recent posts or featured category posts for News ticker."),	
		
array( 	"name" => "Header ticker category",
		"desc" => "Select the category for ticker.",
		"id" => $shortname."_ticker_cat",
		"std" => "Select a category:",
		"type" => "select",
		"options" => $op_categories),
		
array( "type" => "clearfix",),	
		
array( 	"name" => "Header ticker - number of posts",
		"id" => $shortname."_ticker_slides",
		"type" => "select",
		"std" => "",
        "options" => array('2','3', '4', '5', '6', '7', '8', '9', '10'),
		"desc" => "Select the number posts."),	



array( "name" => "Featured area",
        "id" => $shortname."_featured_area",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display featured area on home page."),	
		
array( "type" => "clearfix",),			
	
array( "name" => "Featured area parallax image",
		"id" => $shortname."_parallax_image",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to parallax image"),			 							

array( "type" => "clearfix",),	
	
array( 	"name" => "Home Slider/Carousel - recent posts or featured category",
		"id" => $shortname."_recent_featured_flex",
		"type" => "select",
		"std" => "",
        "options" => array('Recent posts', 'Featured category'),
		"desc" => "Select recent posts or featured category posts for Slider/Carousel slider."),		
	
array( 	"name" => "Home Slider/Carousel featured category",
		"desc" => "Select the category for Slider/Carousel slider.",
		"id" => $shortname."_feat_cat",
		"std" => "Select a category:",
		"type" => "select",
		"options" => $op_categories),
		
array( "type" => "clearfix",),

array( 	"name" => "Home Slider/Carousel - number of slides",
		"id" => $shortname."_feat_slides",
		"type" => "select",
		"std" => "",
        "options" => array('3', '4', '5', '6', '7', '8', '9', '10'),
		"desc" => "Select the number slides."),				
		
array( 	"name" => "Row slider - Count of rows",
		"id" => $shortname."_rows_count",
		"type" => "select",
		"std" => "",
        "options" => array('1', '2'),
		"desc" => "Select Count of rows for Row slider."),		
		
array( 	"name" => "Slider - Variant of time",
		"id" => $shortname."_slider_time_variant",
		"type" => "select",
		"std" => "",
        "options" => array('Standard', 'Time ago'),
		"desc" => "Select Variant of time for slider."),		
		
		
array( 	"name" => "Home featured image - First category",
		"desc" => "Select the category for first small image in featured area.",
		"id" => $shortname."_feat_cat_one",
		"std" => "Select a category:",
		"type" => "select",
		"options" => $op_categories),		
	
array( 	"name" => "Home featured image - Second category",
		"desc" => "Select the category for second small image in featured area.",
		"id" => $shortname."_feat_cat_two",
		"std" => "Select a category:",
		"type" => "select",
		"options" => $op_categories),	
	
	
	
array( "name" => "Testimonials carousel",
        "id" => $shortname."_home_testimonials",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display Testimonials carousel on home page."),	
		
array( "type" => "clearfix",),			

array( 	"name" => "Testimonials - featured category",
		"desc" => "Select the category for Testimonials carousel.",
		"id" => $shortname."_test_cat",
		"std" => "Select a category:",
		"type" => "select",
		"options" => $op_categories),
		
array( "type" => "clearfix",),

array( 	"name" => "Testimonials - number of slides",
		"id" => $shortname."_test_slides",
		"type" => "select",
		"std" => "",
        "options" => array('3', '4', '5', '6', '7', '8', '9', '10'),
		"desc" => "Select the number slides."),		
	
		
array( "type" => "clearfix",),	
array( "name" => "General_2",
		"type" => "content-close",),


		
array( "name" => "General_3",
		"type" => "content-open",),	
		
array( "name" => "Slider in categories",
        "id" => $shortname."_category_slider",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display Slider in categories"),	
		
array( "type" => "clearfix",),	
		
array( 	"name" => "Category Slider - Style",
		"id" => $shortname."_cat_slider_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Elastic Slider'),
		"desc" => "Select style for Category Slider."),		
		
array( 	"name" => "Category Slider - recent posts or featured category",
		"id" => $shortname."_category_rec_feat_cat",
		"type" => "select",
		"std" => "",
        "options" => array('Recent posts', 'Featured category'),
		"desc" => "Select recent posts or featured category posts for Category Slider."),		
	
array( 	"name" => "Category Slider featured category",
		"desc" => "Select the category for Category Slider.",
		"id" => $shortname."_category_feat_cat",
		"std" => "Select a category:",
		"type" => "select",
		"options" => $op_categories),
		
array( "type" => "clearfix",),

array( 	"name" => "Category Slider - number of slides",
		"id" => $shortname."_category_feat_slides",
		"type" => "select",
		"std" => "",
        "options" => array('4', '5', '6', '7', '8', '9', '10'),
		"desc" => "Select the number slides."),				
		
		
array( "name" => "Carousel in categories (with random posts)",
        "id" => $shortname."_category_carousel",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display Carousel in categories"),	
		
array( "type" => "clearfix",),				
			
array( "name" => "Breadcrumbs on pages",
        "id" => $shortname."_crumbs",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display breadcrumbs on pages"),	
		
array( "type" => "clearfix",),	
		
array( "name" => "Posts meta line",
        "id" => $shortname."_blog_meta_line",
        "type" => "checkbox",
        "std" => "on",
		"desc" => "Enable this option for display meta line (date, category)"),		

array( "type" => "clearfix",),							
		
array( "name" => "Email for contact form",
        "id" => $shortname."_contact_email",
        "type" => "text",
		"std" => "",
		"desc" => "Enter your email for contact form"),			
	
array( "name" => "Text for contact page",
		"id" => $shortname."_cf_text",
		"type" => "textarea",
		"std" => "",
		"desc" => "Enter the text what will be displayed on contact page",),	
		
array( "name" => "Contact page map code",
		"id" => $shortname."_cf_map",
		"type" => "textarea",
		"std" => "",
		"desc" => "Enter the map code what will be displayed on contact page<br />(recomend size: 300x320px)",),	
		
array( "type" => "clearfix",),
array( "name" => "General_3",
	    "type" => "content-close",),		

		
		
		

array( "name" => "General_4",
		"type" => "content-open",),				
		
array( "name" => "Title font size",
        "id" => $shortname."_title_size",
        "type" => "select",
		"std" => "",
		"options" => array('17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35'),
		"desc" => "Select title font size for single posts and pages."),				
	
array( "name" => "Breadcrumbs",
        "id" => $shortname."_crumbs_single",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display breadcrumbs in single posts"),	
		
array( "type" => "clearfix",),		
	
array( "name" => "Single post meta line",
        "id" => $shortname."_single_meta_line",
        "type" => "checkbox",
        "std" => "on",
		"desc" => "Enable this option for display meta line (date, category) in single post."),		

array( "type" => "clearfix",),			
	
array( "name" => "Tags",
        "id" => $shortname."_tags",
        "type" => "checkbox",
        "std" => "on",
		"desc" => "Enable this option for display tags in single posts."),		   
	
array( "type" => "clearfix",),


array( "name" => "Tags - variant",
        "id" => $shortname."_tags_variant",
		"std" => "",
        "type" => "select",
		"options" => array("All tags","Post tags"),
		"desc" => "Select a Tags variant"),	
	
array( "name" => "Recent posts",
        "id" => $shortname."_single_recent",
        "type" => "checkbox",
        "std" => "false",
        "desc" => "Enable this option for display recent posts in single posts"),
				   
array( "type" => "clearfix",),	
	
array( "name" => "Similar posts",
        "id" => $shortname."_similar",
        "type" => "checkbox",
        "std" => "false",
        "desc" => "Enable this option for display similar posts in single posts"),
				   
array( "type" => "clearfix",),			
		
array( "name" => "Navigation - variant",
        "id" => $shortname."_nav_variant",
		"std" => "",
        "type" => "select",
		"options" => array("After Text", "Sticky"),
		"desc" => "Select a Navigation variant"),			
		
array( "name" => "Comments",
        "id" => $shortname."_single_comments",
        "type" => "checkbox",
        "std" => "on",
        "desc" => "Enable this option for display comments in single posts"),	   
			
array( "type" => "clearfix",),

array( "name" => "Comments variant",
        "id" => $shortname."_comments_variant",
		"std" => "",
        "type" => "select",
		"options" => array("Simple comments","Disqus"),
		"desc" => "Select a comments variant"),	
	
array( "name" => "Discus ID",
        "id" => $shortname."_discus",
        "type" => "text",
		"std" => "",
		"desc" => "Enter your Discus ID"),	

array( "name" => "General_4",
	    "type" => "content-close",),		
	
	
	
	
	
array( "name" => "General_41",
		"type" => "content-open",),			
	
array( "name" => "Breadcrumbs",
        "id" => $shortname."_crumbs_page",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display breadcrumbs in single page"),	
		
array( "type" => "clearfix",),		
	
array( "name" => "Single page meta line",
        "id" => $shortname."_page_meta_line",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option for display meta line (date, category) in single page."),		

array( "type" => "clearfix",),		
	
array( "name" => "Comments",
        "id" => $shortname."_single_page_comments",
        "type" => "checkbox",
        "std" => "on",
        "desc" => "Enable this option for display comments in single pages"),	   	
	
	
array( "type" => "clearfix",),

array( "name" => "General_41",
	    "type" => "content-close",),	
		
		
array( "name" => "General_5",
		"type" => "content-open",),	
		
		
array( "name" => "Fast change theme colors",
		"id" => $shortname."_theme_colors",
		"type" => "textcolorpopup",
		"std" => "f14d4d",
		"desc" => "Choose a color for all theme colors",),		
		
array( "name" => "Header background color",
		"id" => $shortname."_header_bg",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a Header background color",),			
		
array( "name" => "Top panel background color",
		"id" => $shortname."_header_top_panel_bg",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a Top panel background color",),			
		
		
		
array( "name" => "Top menu links color",
		"id" => $shortname."_top_menu_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a Top menu links color",),		
		
array( "name" => "Top menu background color on hover",
		"id" => $shortname."_top_active_menu_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a Top menu active & hover links background color",),			

array( "name" => "Top menu links color on hover",
		"id" => $shortname."_top_menu_hover_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a Top menu active & hover links color",),			
		
		
		
array( "name" => "Headers color (h1 - h6)",
		"id" => $shortname."_headers_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a headers color",),	

array( "name" => "Site title color",
		"id" => $shortname."_site_title_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a site title and description color",),

array( "name" => "Site title hover color",
		"id" => $shortname."_site_title_color_hover",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a site title hover color",),
		

array( "name" => "Sidebar headers color",
		"id" => $shortname."_sidebar_headers_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a sidebar headers color",),			

array( "name" => "Sidebar footer headers color",
		"id" => $shortname."_sidebar_footer_headers_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a sidebar footer headers color",),	
	
array( "name" => "Breadcrumbs color",
		"id" => $shortname."_crumbs_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a color for Breadcrumbs",),	
		
array( "name" => "Breadcrumbs color on hover",
		"id" => $shortname."_crumbs_color_hover",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a color for Breadcrumbs on hover",),		
	
array( "name" => "Footer background color",
		"id" => $shortname."_footer_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a footer background color",),		

array( "name" => "Footer bottom line background color",
		"id" => $shortname."_footer_bottom_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a footer bottom line background color",),	
	
	
	
array( "name" => "Main menu (Default menu) background",
		"id" => $shortname."_main_menu_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main menu background",),		
	
array( "name" => "Main menu color",
		"id" => $shortname."_main_menu_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main menu color",),		
		
array( "name" => "Main menu color on hover",
		"id" => $shortname."_main_menu_hover_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main menu color on hover",),	
		
array( "name" => "Main menu active & hover background color",
		"id" => $shortname."_active_menu_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main menu active & hover links background color",),			

array( "name" => "Main menu active & hover color",
		"id" => $shortname."_active_menu_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main menu active & hover links color",),	
		
array( "name" => "Main sub menu color",
		"id" => $shortname."_main_sub_menu_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main sub menu color",),		
		
array( "name" => "Main sub menu color on hover",
		"id" => $shortname."_main_sub_menu_hover_color",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main sub menu color on hover",),			
	
array( "name" => "Main sub menu background color",
		"id" => $shortname."_main_sub_menu_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main sub menu background color",),		
		
array( "name" => "Main sub menu background color on hover",
		"id" => $shortname."_main_sub_menu_hover_background",
		"type" => "textcolorpopup",
		"std" => "",
		"desc" => "Choose a main sub menu background color on hover",),	
			
	
array( "type" => "clearfix",),
array( "name" => "General_5",
	    "type" => "content-close",),
		

		
array( "name" => "General_52",
		"type" => "content-open",),	

array( "name" => "Header banner",
        "id" => $shortname."_banner_header",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display banner (468x60px) in header."),
			
array( "type" => "clearfix",),		
	
array( "name" => "Banner size",
        "id" => $shortname."_banner_size",
		"std" => "",
        "type" => "select",
		"options" => array("468x60px","728x90px"),
		"desc" => "Select a banner size"),		
	
array( "name" => "Header - banner code",
        "id" => $shortname."_banner_header_code",
		"std" => "",
        "type" => "textarea",
		"desc" => "Enter code for banner in header."),
	
	
	

array( "name" => "Header banner rotator",
        "id" => $shortname."_banner_rotator",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display banner rotator in header."),
			
array( "type" => "clearfix",),
		
array( "name" => "Header banner rotator - Timer",
        "id" => $shortname."_rotator_timer",
        "type" => "checkbox",
        "std" => "true",
		"desc" => "Enable this option to display banner rotator Timer."),
			
array( "type" => "clearfix",),	


array( "name" => "Banner rotator - Image 1",
		"id" => $shortname."_rotator_image_1",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to Banner rotator image 1"),			 							

array( "type" => "clearfix",),	

array( "name" => "Banner rotator - Title 1",
        "id" => $shortname."_br_title_1",
        "type" => "text",
		"desc" => "Write Title for Banner 1"),	
	
array( "name" => "Banner rotator - Link 1",
        "id" => $shortname."_br_link_1",
        "type" => "text",
		"desc" => "Write Link for Banner 1"),	

array( "name" => "Banner rotator - Image 2",
		"id" => $shortname."_rotator_image_2",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to Banner rotator image 2"),			 							

array( "type" => "clearfix",),	

array( "name" => "Banner rotator - Title 2",
        "id" => $shortname."_br_title_2",
        "type" => "text",
		"desc" => "Write Title for Banner 2"),	
	
array( "name" => "Banner rotator - Link 2",
        "id" => $shortname."_br_link_2",
        "type" => "text",
		"desc" => "Write Link for Banner 2"),	
		
array( "name" => "Banner rotator - Image 3",
		"id" => $shortname."_rotator_image_3",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to Banner rotator image 3"),			 							

array( "type" => "clearfix",),	

array( "name" => "Banner rotator - Title 3",
        "id" => $shortname."_br_title_3",
        "type" => "text",
		"desc" => "Write Title for Banner 3"),	
	
array( "name" => "Banner rotator - Link 3",
        "id" => $shortname."_br_link_3",
        "type" => "text",
		"desc" => "Write Link for Banner 3"),	

array( "name" => "Banner rotator - Image 4",
		"id" => $shortname."_rotator_image_4",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to Banner rotator image 4"),			 							

array( "type" => "clearfix",),	

array( "name" => "Banner rotator - Title 4",
        "id" => $shortname."_br_title_4",
        "type" => "text",
		"desc" => "Write Title for Banner 4"),	
	
array( "name" => "Banner rotator - Link 4",
        "id" => $shortname."_br_link_4",
        "type" => "text",
		"desc" => "Write Link for Banner 4"),	

array( "name" => "Banner rotator - Image 5",
		"id" => $shortname."_rotator_image_5",
		"type" => "upload",
		"std" => "",
		"desc" => "Enter the full path to Banner rotator image 5"),			 							

array( "type" => "clearfix",),	

array( "name" => "Banner rotator - Title 5",
        "id" => $shortname."_br_title_5",
        "type" => "text",
		"desc" => "Write Title for Banner 5"),	
	
array( "name" => "Banner rotator - Link 5",
        "id" => $shortname."_br_link_5",
        "type" => "text",
		"desc" => "Write Link for Banner 5"),	



array( "name" => "Category banner (728x90px)",
        "id" => $shortname."_banner_index",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display banner (728x90px) in category."),
			
array( "type" => "clearfix",),		
	
array( "name" => "Category - banner code",
        "id" => $shortname."_banner_index_code",
		"std" => "",
        "type" => "textarea",
		"desc" => "Enter code for banner in category."),		
		

array( "name" => "Single banner (728x90px)",
        "id" => $shortname."_banner_single",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display banner (728x90px) in Single post."),
			
array( "type" => "clearfix",),		
	
array( "name" => "Single - banner code",
        "id" => $shortname."_banner_single_code",
		"std" => "",
        "type" => "textarea",
		"desc" => "Enter code for banner in Single post."),		
		
				
		

array( "name" => "Footer banner",
        "id" => $shortname."_banner_footer",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display banner (728x90px) in footer."),
			
array( "type" => "clearfix",),		
	
array( "name" => "Footer - banner code",
        "id" => $shortname."_banner_footer_code",
		"std" => "",
        "type" => "textarea",
		"desc" => "Enter code for banner in Footer."),
	


array( "name" => "Social bookmarks",
        "id" => $shortname."_social",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display social bookmarks."),
		
array( "type" => "clearfix",),			
		
array( "name" => "Twitter subscribe",
        "id" => $shortname."_twitter",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Twitter subscribe."),
			
array( "type" => "clearfix",),	
	
array( "name" => "Twitter path",
        "id" => $shortname."_twitter_id",
        "type" => "text",
		"desc" => "Enter the full path to your Twitter account"),	
		
array( "name" => "Facebook subscribe",
        "id" => $shortname."_facebook",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Facebook subscribe."),
			
array( "type" => "clearfix",),		
		
array( "name" => "Facebook path",
        "id" => $shortname."_facebook_id",
        "type" => "text",
		"desc" => "Enter the full path to your Facebook account"),	
	
array( "name" => "Linkedin subscribe",
        "id" => $shortname."_linkedin",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Linkedin subscribe."),	
		
array( "type" => "clearfix",),		
	
array( "name" => "Linkedin path",
        "id" => $shortname."_linkedin_id",
        "type" => "text",
		"desc" => "Enter the full path to your Linkedin account"),	
	
array( "name" => "Vimeo subscribe",
        "id" => $shortname."_vimeo",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Vimeo subscribe."),		

array( "type" => "clearfix",),			
	
array( "name" => "Vimeo path",
        "id" => $shortname."_vimeo_id",
        "type" => "text",
		"desc" => "Enter the full path to your Vimeo account"),	
	
array( "name" => "Flickr subscribe",
        "id" => $shortname."_flickr",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Flickr subscribe."),		

array( "type" => "clearfix",),			
	
array( "name" => "Flickr path",
        "id" => $shortname."_flickr_id",
        "type" => "text",
		"desc" => "Enter the full path to your Flickr account"),			
		
array( "name" => "Youtube subscribe",
        "id" => $shortname."_youtube",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Youtube subscribe."),		

array( "type" => "clearfix",),			
	
array( "name" => "Youtube path",
        "id" => $shortname."_youtube_id",
        "type" => "text",
		"desc" => "Enter the full path to your Youtube account"),	

array( "name" => "Skype subscribe",
        "id" => $shortname."_skype",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Skype subscribe."),		

array( "type" => "clearfix",),			
	
array( "name" => "Skype path",
        "id" => $shortname."_skype_id",
        "type" => "text",
		"desc" => "Enter the full path to your Skype account"),			
			
			
		
array( "type" => "clearfix",),
array( "name" => "General_52",
	    "type" => "content-close",),


		
array( "name" => "General_6",
		"type" => "content-open",),			
		
array( "name" => "Homepage custom title ",
		"id" => $shortname."_seo_home_title",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Enable this option for display custom title on home page",),

array( "type" => "clearfix",),

array( "name" => "Homepage meta description",
		"id" => $shortname."_seo_home_description",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Enable this option for display custom meta description on home page",),

array( "type" => "clearfix",),

array( "name" => "Homepage meta keywords",
		"id" => $shortname."_seo_home_keywords",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Enable this option for display custom meta keywords on home page",),

array( "type" => "clearfix",),
		
array( "name" => "Homepage custom title",
		"id" => $shortname."_seo_home_titletext",
		"type" => "text",
		"std" => "",
		"desc" => "",),

array( "name" => "Homepage meta description",
		"id" => $shortname."_seo_home_descriptiontext",
		"type" => "textarea",
		"std" => "",
		"desc" => "",),

array( "name" => "Homepage meta keywords",
		"id" => $shortname."_seo_home_keywordstext",
		"type" => "text",
		"std" => "",
		"desc" => "",),

array( "name" => "Single custom titles",
		"id" => $shortname."_seo_single_title",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Enable this option for display custom title on single post and pages",),

array( "name" => "Single custom description",
		"id" => $shortname."_seo_single_description",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Enable this option for display custom description on single post and pages",),

array( "type" => "clearfix",),

array( "name" => "Single custom keywords",
		"id" => $shortname."_seo_single_keywords",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Enable this option for display custom keywords on single post and pages",),
				   
				   
array( "type" => "clearfix",),
array( "name" => "General_6",
	    "type" => "content-close",),			
	
		
	
array( "name" => "General_7",
		"type" => "content-open",),				
		
array( "name" => "News ticker text",
        "id" => $shortname."_ticker_text",
		"std" => "Hot News",
        "type" => "text",
		"desc" => "Enter a title for News ticker"),	
		
array( "name" => "Read more",
        "id" => $shortname."_read_more",
		"std" => "Read more",
        "type" => "text",
		"desc" => "Enter a Read more text for posts"),		
	
array( "name" => "View more",
        "id" => $shortname."_view_more",
		"std" => "View more",
        "type" => "text",
		"desc" => "Enter a View more text for Homepage shortcodes title"),	

array( "name" => "View more in",
        "id" => $shortname."_view_more_in_category",
		"std" => "View more in",
        "type" => "text",
		"desc" => "Enter a View more text for Homepage shortcodes categories"),	
		

	
array( "name" => "Search...",
        "id" => $shortname."_search",
		"std" => "Search...",
        "type" => "text",
		"desc" => "Enter a Search text for search form"),									
		
array( "name" => "Home",
        "id" => $shortname."_home_text",
		"std" => "Home",
        "type" => "text",
		"desc" => "Enter a Home text for breadcrumbs"),		

array( "name" => "Ago",
        "id" => $shortname."_time_ago",
		"std" => "ago",
        "type" => "text",
		"desc" => "Enter a ago text for all dates"),			
		
array( "name" => "Posts Found",
        "id" => $shortname."_posts_found",
		"std" => "Posts Found",
        "type" => "text",
		"desc" => "Enter a Posts Found for all homepage shortcodes"),				
		
array( "name" => "Search results for",
        "id" => $shortname."_search_result",
		"std" => "Search results for",
        "type" => "text",
		"desc" => "Enter a Search results text for breadcrumbs"),				
		
array( "name" => "Posts tagged",
        "id" => $shortname."_posts_tagged",
		"std" => "Posts tagged",
        "type" => "text",
		"desc" => "Enter a Posts tagged text for breadcrumbs"),			

array( "name" => "Articles posted by",
        "id" => $shortname."_posted_author",
		"std" => "Articles posted by",
        "type" => "text",
		"desc" => "Enter a Articles posted by text for breadcrumbs"),	
		
array( "name" => "Error 404",
        "id" => $shortname."_error_404",
		"std" => "Error 404",
        "type" => "text",
		"desc" => "Enter a Error 404 text for breadcrumbs"),		
	
array( "name" => "Page (for navigation)",
        "id" => $shortname."_page_navi",
		"std" => "Page",
        "type" => "text",
		"desc" => "Enter a Page text for breadcrumbs"),		
		
array( "name" => "Comments",
        "id" => $shortname."_comments_text",
		"std" => "Comments",
        "type" => "text",
		"desc" => "Enter a Comments text for posts"),		

array( "name" => "Views",
        "id" => $shortname."_views_text",
		"std" => "Views",
        "type" => "text",
		"desc" => "Enter a Views text for posts"),			

array( "name" => "Author:",
        "id" => $shortname."_signle_author",
		"std" => "Author:",
        "type" => "text",
		"desc" => "Enter a Author text"),			
		
array( "name" => "Total posts:",
        "id" => $shortname."_total_posts",
		"std" => "Total posts:",
        "type" => "text",
		"desc" => "Enter a Total posts"),	
		
array( "name" => "Author",
        "id" => $shortname."_author",
		"std" => "Written by",
        "type" => "text",
		"desc" => "Enter a Written by text"),	
	
array( "name" => "Next article",
        "id" => $shortname."_next_article",
		"std" => "Next article",
        "type" => "text",
		"desc" => "Enter a Next article text for single posts"),	

array( "name" => "Previous article",
        "id" => $shortname."_previous_article",
		"std" => "Previous article",
        "type" => "text",
		"desc" => "Enter a Previous article text for single posts"),			
				
		
array( "name" => "Recent posts",
        "id" => $shortname."_recent_posts",
		"std" => "Recent posts",
        "type" => "text",
		"desc" => "Enter a Recent posts text for single posts"),			
		
array( "name" => "Similar posts",
        "id" => $shortname."_more_news",
		"std" => "Similar posts",
        "type" => "text",
		"desc" => "Enter a Similar posts text for single posts"),			
	
array( "name" => "30 Recent Posts (sitemap)",
        "id" => $shortname."_30_recent_posts",
		"std" => "30 Recent Posts",
        "type" => "text",
		"desc" => "Enter a 30 Recent Posts text for sitemap"),		
	
array( "name" => "Error 404 - Page not found",
        "id" => $shortname."_page_not_found",
		"std" => "Error 404 - Page not found!",
        "type" => "text",
		"desc" => "Enter a Error 404 - Page not found text for 404 page"),			
	
array( "name" => "Try searching",
        "id" => $shortname."_try_searching",
		"std" => "Try searching:",
        "type" => "text",
		"desc" => "Enter a Try searching text for 404 page"),

array( "name" => "Or look in the archives",
        "id" => $shortname."_look_archives",
		"std" => "Or look in the archives:",
        "type" => "text",
		"desc" => "Enter a Or look in the archives text for 404 page"),		

array( "name" => "Nothing Found",
        "id" => $shortname."_nothing_found",
		"std" => "Nothing Found!",
        "type" => "text",
		"desc" => "Enter a Nothing Found text for search page"),	
		
array( "name" => "Text for search page",
		"id" => $shortname."_nothing_found_text",
		"type" => "textarea",
		"std" => "Sorry, but nothing matched your search criteria. Please try again with some different keywords.",
		"desc" => "Enter the text what will be displayed on search page",),			

array( "name" => "Your name (contact form)",
        "id" => $shortname."_your_name",
		"std" => "Your name: *",
        "type" => "text",
		"desc" => "Enter a Your name text for contact form"),			
		
array( "name" => "Your email (contact form)",
        "id" => $shortname."_your_email",
		"std" => "Your email: *",
        "type" => "text",
		"desc" => "Enter a Your email text for contact form"),		
	
array( "name" => "Your message (contact form)",
        "id" => $shortname."_your_message",
		"std" => "Your message: *",
        "type" => "text",
		"desc" => "Enter a Your message text for contact form"),		
		
array( "name" => "Submit - button (contact form)",
        "id" => $shortname."_contact_submit",
		"std" => "Submit",
        "type" => "text",
		"desc" => "Enter a Submit text for contact form"),	
	
array( "name" => "Your email was successfully sent (popup)",
        "id" => $shortname."_successfully_sent",
		"std" => "Your email was successfully sent!",
        "type" => "text",
		"desc" => "Enter a Successfully sent text for contact form"),		

array( "name" => "Wrong data (popup)",
        "id" => $shortname."_wrong_data",
		"std" => "Please enter your name, a message and a valid email address!",
        "type" => "text",
		"desc" => "Enter a Successfully sent text for contact form"),				
	
array( "name" => "Footer copy text",
        "id" => $shortname."_footer_copy",
		"std" => "All rights reserved",
        "type" => "text",
		"desc" => "Enter copy text for footer."),	
	
array( "type" => "clearfix",),			
array( "name" => "General_7",
	    "type" => "content-close",),
				
		
		
array( "name" => "General_8",
		"type" => "content-open",),			
		
array( "name" => "Boxed layout",
        "id" => $shortname."_theme_full",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to display Full width Theme layout."),
			
array( "type" => "clearfix",),	

array( 	"name" => "Boxed layout - Top margin",
		"id" => $shortname."_top_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '20px', '30px', '40px', '50px', '60px', '70px', '80px', '90px', '100px', '150px', '200px'),
		"desc" => "Select the position for Top menu."),	


array( "name" => "Boxed Main menu, Secondary menu, News Ticker",
        "id" => $shortname."_boxed_menu_ticker",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to make boxed Main menu, Secondary menu, News Ticker."),
			
array( "type" => "clearfix",),			
		
array( 	"name" => "Secondary menu (Top menu) - Position",
		"id" => $shortname."_top_menu_position",
		"type" => "select",
		"std" => "",
        "options" => array('Top', 'Bottom'),
		"desc" => "Select the position for Top menu."),			
		
array( 	"name" => "Secondary menu (Top menu) - Top margin",
		"id" => $shortname."_top_menu_top_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '15px', '20px', '25px', '30px'),
		"desc" => "Select the Top margin for Top menu."),	
		
array( 	"name" => "Secondary menu (Top menu) - Bottom margin",
		"id" => $shortname."_top_menu_bottom_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '15px', '20px', '25px', '30px'),
		"desc" => "Select the Bottom margin for Top menu."),		
		
		
array( 	"name" => "News Ticker - Style",
		"id" => $shortname."_ticker_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Kesha'),
		"desc" => "Select the Style for News Ticker."),		
		
array( 	"name" => "News Ticker - Position",
		"id" => $shortname."_ticker_position",
		"type" => "select",
		"std" => "",
        "options" => array('Top', 'Bottom'),
		"desc" => "Select the position for News Ticker."),				
		
array( 	"name" => "News Ticker - Top margin",
		"id" => $shortname."_news_ticker_top_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '15px', '20px', '25px', '30px'),
		"desc" => "Select the Top margin for Top menu."),	
		
array( 	"name" => "News Ticker - Bottom margin",
		"id" => $shortname."_news_ticker_bottom_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '15px', '20px', '25px', '30px'),
		"desc" => "Select the Bottom margin for Top menu."),		
				
		
		
		
		
		
array( 	"name" => "Sidebar - Style",
		"id" => $shortname."_sidebar_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Kesha'),
		"desc" => "Select the Sidebar style."),	
		
array( 	"name" => "Sidebar header - Style",
		"id" => $shortname."_sidebar_header_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Kesha_1', 'Kesha_2', 'Kesha_3', 'Kesha_4'),
		"desc" => "Select the Sidebar header style."),	
				
		
array( "name" => "Boxed Category parallax image",
        "id" => $shortname."_cat_parallax_image",
        "type" => "checkbox",
        "std" => "false",
		"desc" => "Enable this option to make boxed Category parallax image with title and description."),
			
array( "type" => "clearfix",),		

array( 	"name" => "Category parallax image - Top margin",
		"id" => $shortname."_cat_parallax_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '15px', '20px', '25px', '30px'),
		"desc" => "Select the Top margin for Category parallax image."),		
				
array( 	"name" => "Category parallax image - Style",
		"id" => $shortname."_cat_parallax_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Kesha'),
		"desc" => "Select the Sidebar style."),			
		
array( 	"name" => "Index posts (categories, archives etc.) - Style",
		"id" => $shortname."_index_post_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Kesha'),
		"desc" => "Select the Index style."),				
		

array( 	"name" => "Single Post thumbnail - Top margin",
		"id" => $shortname."_single_image_top_margin",
		"type" => "select",
		"std" => "",
        "options" => array('0px', '10px', '15px', '20px', '25px', '30px'),
		"desc" => "Select the Top margin for Single Post featured area (Parallax image, Video, Carousel etc."),		
		
array( 	"name" => "Single Post Recent/Similar posts - Style",
		"id" => $shortname."_rec_sim_style",
		"type" => "select",
		"std" => "",
        "options" => array('Default', 'Kesha'),
		"desc" => "Select the Recent/Similar posts style for Single Post."),			
		
		
array( "type" => "clearfix",),			
array( "name" => "General_8",
	    "type" => "content-close",),
		
		
//-------------------------------------------------------------------------------------//	
			
);

function custom_colors_css(){
	global $shortname; ?>
	
<style type="text/css">

<?php if (get_option('op_custom_header_font') == '') { ?>

h1, h2, h3, h4, h5, h6, .title_lp, .cat_title_box_Kesha h1, .cat_title_box_Kesha p, .blog_title_Kesha, .custom_cat_class_Kesha, .car_title_descr.Kesha, .car_title_descr.Kesha_2, .cat_view_more, .ticker_date, .lof-slidecontent .slider-description .slider-meta, .widget_title_third, .widget_date_third, .widget_two_meta, #top_title_box, .site_title h1, #homeSlider .rsTmb, .fn, .menu-item, .cat_post_count, .tagcloud a, .author_description span, #tags_simple a, #post_tags li a, .custom_read_more, .product_list_widget li a, .product-categories, .post-single-rate, .widget_title, .full_widget_title, .widget_title_two, #home_carousel .jcarousel-skin-tango .carousel_post h1 a, .home_posts_title h2, #header_top_menu .logout, #header_top_menu .login, #mainMenu ul li a, #mega_main_menu .link_text, #secondaryMenu, .mt-label, .mt-news .ticker_title, .slide_time, .post h1 a, .product h1 a, .cat_meta, .category_time, .post_views, .cat_author, .custom_cat_class, .post_meta_line, .post_time, .latest_title_box, #single_recent_posts .recent_posts_title, .prev_link_title a, .next_link_title a, #navigation_images span, .author_posts_title, #archive .arch_title, .fn a, .comment-meta, #submit, #content_bread_panel, #contact input[type="submit"], h2.widgettitle, .widget_date, .full_widget_date, .widget.widget_nav_menu li a, .widget_menu_title, .yop-poll-container label, .yop_poll_vote_button, .widget_footer_title, .wpt_widget_content .tab_title a, #comments-tab-content .wpt_comment_meta a, .user-rate-wrap, #bbp_search_submit, .forum-titles, .bbp-forum-title, .entry-title, .bbp-topic-permalink, .bbp-submit-wrapper button, .wpb_row h1, .wpb_row h2, .wpb_row h3, .wpb_row h4, .wpb_row h5, .ts-icon-title-text, .home_posts_time, .home_masonry_posts .home_posts_time, .video_post .masonry_title, .line_title, .video_post .video_time, .home_video_posts_time, .video_title, .column_post:first-child .column_title, .column_title, .blog_title, .mega-hovertitle, .ms-videogallery-template .ms-layer.video-title, .ms-videogallery-template .ms-layer.video-author, .sb-modern-skin .showbiz-title, .sb_retro_skin_Kesha .showbiz-title, .masonry_title, .main_title, .pbc_title, .sb-retro-skin .showbiz-title a{font-family:<?php echo(get_option($shortname.'_header_font')); ?>;}

<?php } else { ?>

h1, h2, h3, h4, h5, h6, .title_lp, .cat_title_box_Kesha h1, .cat_title_box_Kesha p, .blog_title_Kesha, .custom_cat_class_Kesha, .car_title_descr.Kesha, .car_title_descr.Kesha_2, .cat_view_more, .ticker_date, .lof-slidecontent .slider-description .slider-meta, .widget_title_third, .widget_date_third, .widget_two_meta, #top_title_box, .site_title h1, #homeSlider .rsTmb, .fn, .menu-item, .cat_post_count, .tagcloud a, .author_description span, #tags_simple a, #post_tags li a, .custom_read_more, .product_list_widget li a, .product-categories, .post-single-rate, .widget_title, .full_widget_title, .widget_title_two, #home_carousel .jcarousel-skin-tango .carousel_post h1 a, .home_posts_title h2, #header_top_menu .logout, #header_top_menu .login, #mainMenu ul li a, #mega_main_menu .link_text, #secondaryMenu, .mt-label, .mt-news .ticker_title, .slide_time, .post h1 a, .product h1 a, .cat_meta, .category_time, .post_views, .cat_author, .custom_cat_class, .post_meta_line, .post_time, .latest_title_box, #single_recent_posts .recent_posts_title, .prev_link_title a, .next_link_title a, #navigation_images span, .author_posts_title, #archive .arch_title, .fn a, .comment-meta, #submit, #content_bread_panel, #contact input[type="submit"], h2.widgettitle, .widget_date, .full_widget_date, .widget.widget_nav_menu li a, .widget_menu_title, .yop-poll-container label, .yop_poll_vote_button, .widget_footer_title, .wpt_widget_content .tab_title a, #comments-tab-content .wpt_comment_meta a, .user-rate-wrap, #bbp_search_submit, .forum-titles, .bbp-forum-title, .entry-title, .bbp-topic-permalink, .bbp-submit-wrapper button, .wpb_row h1, .wpb_row h2, .wpb_row h3, .wpb_row h4, .wpb_row h5, .ts-icon-title-text, .home_posts_time, .home_masonry_posts .home_posts_time, .video_post .masonry_title, .line_title, .video_post .video_time, .home_video_posts_time, .video_title, .column_post:first-child .column_title, .column_title, .blog_title, .mega-hovertitle, .ms-videogallery-template .ms-layer.video-title, .ms-videogallery-template .ms-layer.video-author, .sb-modern-skin .showbiz-title, .sb_retro_skin_Kesha .showbiz-title, .masonry_title, .main_title, .pbc_title, .sb-retro-skin .showbiz-title a{font-family:<?php echo(get_option($shortname.'_custom_header_font')); ?>;}

<?php } ?>

	.featured_area_content_text, .bx-wrapper .bxslider_quote, #home_content, #container, .post_one_column h1, .post_mini_one_column h1, .post_two_column h1, .post_three_column h1, .video_widget { font-family:<?php echo(get_option($shortname.'_text_font')); ?>; }	
    
	h1, h2, h3, h4, h5, h6 { color: #<?php echo(get_option($shortname.'_headers_color')); ?>!important; }
	.site_title h1 { color: #<?php echo(get_option($shortname.'_site_title_color')); ?>!important; } 
	.site_title h1:hover { color: #<?php echo(get_option($shortname.'_site_title_color_hover')); ?>!important; } 
	
	.right-heading h3 { color: #<?php echo(get_option($shortname.'_sidebar_headers_color')); ?>!important; } 

	.footer-heading h3 { color: #<?php echo(get_option($shortname.'_sidebar_footer_headers_color')); ?>!important; } 
	#crumbs, #crumbs a{ color: #<?php echo(get_option($shortname.'_crumbs_color')); ?>!important; }
	#crumbs a:hover { color: #<?php echo(get_option($shortname.'_crumbs_color_hover')); ?>!important; }
	
	
	#header, #dc_jqaccordion_widget-7-item ul ul li a { background-color: #<?php echo(get_option($shortname.'_header_bg')); ?>!important; } 
	
	#header_top_menu { background-color: #<?php echo(get_option($shortname.'_header_top_panel_bg')); ?>!important; } 
	
	#mainMenu ul li a { color: #<?php echo(get_option($shortname.'_main_menu_color')); ?>!important; } 
	#mainMenu ul li a:hover, #mainMenu ul li.current-menu-parent > a, #mainMenu ul li.current_page_item > a, #mainMenu ul li.current-menu-ancestor > a, #mainMenu ul li.current-menu-item > a, #mainMenu ul li a:hover { color: #<?php echo(get_option($shortname.'_main_menu_hover_color')); ?>!important; } 
	#mainMenu ul li.current-menu-parent > a, #mainMenu ul li.current_page_item > a, #mainMenu ul li.current-menu-ancestor > a, #mainMenu ul li.current-menu-item > a, #mainMenu ul li a:hover { background: #<?php echo(get_option($shortname.'_active_menu_background')); ?>!important; } 
    #mainMenu ul li.current-menu-parent > a, #mainMenu ul li.current_page_item > a, #mainMenu ul li.current-menu-ancestor > a, #mainMenu ul li.current-menu-item > a, #mainMenu ul li a:hover { color: #<?php echo(get_option($shortname.'_active_menu_color')); ?>!important; } 	
	#mainMenu.ddsmoothmenu ul li ul li a { color: #<?php echo(get_option($shortname.'_main_sub_menu_color')); ?>!important; } 
	#mainMenu.ddsmoothmenu ul li ul li a:hover { color: #<?php echo(get_option($shortname.'_main_sub_menu_hover_color')); ?>!important; } 
	#mainMenu.ddsmoothmenu ul li ul li a, #mainMenu.ddsmoothmenu ul li ul li.current-menu-ancestor > a, #mainMenu.ddsmoothmenu ul li ul li.current-menu-item > a { background: #<?php echo(get_option($shortname.'_main_sub_menu_background')); ?>!important; } 
	#mainMenu.ddsmoothmenu ul li ul li a:hover { background: #<?php echo(get_option($shortname.'_main_sub_menu_hover_background')); ?>!important; } 
	
		
	#secondaryMenu ul li a { color: #<?php echo(get_option($shortname.'_top_menu_color')); ?>!important; } 
    #secondaryMenu ul li a:hover { color: #<?php echo(get_option($shortname.'_top_menu_hover_color')); ?>!important; } 
    #secondaryMenu ul li a:hover { background-color: #<?php echo(get_option($shortname.'_top_active_menu_background')); ?>!important; } 
	
	
	.post_format { background-color: #<?php echo(get_option($shortname.'_post_format_bg')); ?>!important; } 
	.post_format_video { background-color: #<?php echo(get_option($shortname.'_video_format_bg')); ?>!important; } 
	.post_format_image { background-color: #<?php echo(get_option($shortname.'_image_format_bg')); ?>!important; } 
	
	#footer_box, .footer-heading h3 { background: #<?php echo(get_option($shortname.'_footer_background')); ?>!important; }
	#footer_bottom { background: #<?php echo(get_option($shortname.'_footer_bottom_background')); ?>!important; }
	
	.single_title h1 { font-size: <?php echo(get_option($shortname.'_title_size')); ?>px!important; } 
    
	.timer > #slice > .pie, .ei-slider-thumbs li.ei-slider-element, .recent_cat_third li:first-child .widget_date_third, .full_widget_date, .fws2 .title, h1.rsSlideTitle, .fws2 .slidePrev, .fws2 .slideNext, .feat_image_content .slide_time, .rsUni .rsThumb.rsNavSelected, .bx-wrapper .custom_read_more, .bx-wrapper .custom_read_more:hover, .widget_date, .full_widget_date, #tags_simple li, .car_image_caption .slide_time, .comment-reply-link, .comment-reply-link:visited, #submit, #contact input[type="submit"] { background-color: #<?php echo(get_option($shortname.'_theme_colors')); ?>!important; }
    .timer > #slice > .pie, #single_recent_posts.Kesha .latest_title_box h3, #similar-post.Kesha h3, .cat_title_box_Kesha h1, .cat_title_box_Kesha p, #header_top_menu, .archive_title h3 { border-color: #<?php echo(get_option($shortname.'_theme_colors')); ?>!important; }
	
	#all_content.boxed_width { margin-top: <?php echo(get_option($shortname.'_top_margin')); ?>!important; } 	
	
	#header_top_menu { margin-top: <?php echo(get_option($shortname.'_top_menu_top_margin')); ?>!important; } 
	#header_top_menu { margin-bottom: <?php echo(get_option($shortname.'_top_menu_bottom_margin')); ?>!important; } 
	
	.ticker_box { margin-top: <?php echo(get_option($shortname.'_news_ticker_top_margin')); ?>!important; } 
	.ticker_box { margin-bottom: <?php echo(get_option($shortname.'_news_ticker_bottom_margin')); ?>!important; } 
	
	.dzsparallaxer, .cat_title_box_Kesha { margin-top: <?php echo(get_option($shortname.'_cat_parallax_margin')); ?>!important; } 
	
	#example2, .single_photo, .big_image_cover, .dzsparallaxer { margin-top: <?php echo(get_option($shortname.'_single_image_top_margin')); ?>!important; } 
	

</style>

<?php }; ?>
