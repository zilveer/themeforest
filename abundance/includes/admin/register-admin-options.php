<?php


//avia pages holds the data necessary for backend page creation
$avia_pages = array( 
	
	array( 'slug' => 'avia', 		'parent'=>'avia', 'icon'=>"hammer_screwdriver.png" , 	'title' =>  'Theme Options' ),
	array( 'slug' => 'styling', 	'parent'=>'avia', 'icon'=>"palette.png", 				'title' =>  'Styling'  ),
	array( 'slug' => 'layout', 		'parent'=>'avia', 'icon'=>"blueprint_horizontal.png", 	'title' =>  'Layout &amp; Settings'  ),
	array( 'slug' => 'contact', 	'parent'=>'avia', 'icon'=>"book_addresses.png" , 		'title' =>  'Contact &amp; <br/>Social Stuff' ),
	array( 'slug' => 'sidebar', 	'parent'=>'avia', 'icon'=>"layout_select_sidebar.png", 	'title' =>  'Sidebar'  ),
	array( 'slug' => 'footer', 		'parent'=>'avia', 'icon'=>"layout_select_footer.png", 	'title' =>  'Footer'  ),
	array( 'slug' => 'templates', 	'parent'=>'templates','icon'=>"page_white_wrench.png", 	'title' =>  'Template Builder'  )
					 
);





/*Frontpage Settings*/


					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Import Dummy Content: Posts, Pages, Categories and Portfolio Entries",
					"desc" 	=> "If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitley help to understand how those tasks are done.",
					"id" 	=> "import",
					"type" 	=> "import");
	
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Frontpage Settings",
					"desc" 	=> "Select which page to display on your Frontpage. If left blank the Blog will be displayed",
					"id" 	=> "frontpage",
					"type" 	=> "select",
					"subtype" => 'page');
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "And where do you want to display the Blog?",
					"desc" 	=> "Select which page to display as your Blog Page. If left blank no blog will be displayed",
					"id" 	=> "blogpage",
					"type" 	=> "select",
					"subtype" => 'page',
					"required" => array('frontpage','{true}')
					);
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Logo",
					"desc" 	=> "Upload a logo image, or enter the URL to an image if its already uploaded. The themes default logo gets applied if the input field is left blank<br/>Logo Dimension: 200px * 100px (if your logo is larger you might need to modify style.css to align it perfectly)",
					"id" 	=> "logo",
					"type" 	=> "upload",
					"label"	=> "Use Image as logo");
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Google Analytics Tracking Code",
					"desc" 	=> "Enter your Google analytics tracking Code here. It will automatically be added to the themes footer so google can track your visitors behaviour.",
					"id" 	=> "analytics",
					"type" 	=> "textarea"
					);
					
					


/*Styling Settings*/
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"id" 	=> "default_slideshow_target",
					"type" 	=> "target",
					"std" 	=> "
					<style type='text/css'>
						.live_bg, .live_bg_default{padding:2%; width:46%; float:left; height:150px;}
						.live_bg_wrap{ padding:4%; background:#f8f8f8; overflow:hidden; border:1px solid #e1e1e1;}
						.live_bg_default{background:#fff;color:#777;}
						.live_bg_default h3{color:#333;}
						.live_bg_default#dark-skin-css{background:#222;color:#fff;}
						.live_bg_default#dark-skin-css h3{color:#fff;}
						.live_bg p{opacity:0.7;}
						
					</style> 
					<div class='live_bg_wrap'>
					<div class='live_bg_default'><h3>Demo heading</h3><p>This is default content with a default heading. Font color and text are set based on the skin you choose above. Headings and link colors can be choosen below. <br/> <a class='a_link' href='#'>A link</a>  <a class='an_activelink' href='#'>A hovered link</a></p></div>
					
					<div class='live_bg'><h3>Demo heading</h3><p>This is text on a colored background</p>
					<!--, as for example in your footer.</p><p>Text and <a href='#'>links</a> got the same color, headings are a little lighter</p>-->
					</div>
					</div>
					",
					"nodescription" => true
					);	
					
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Select a predefined color scheme",
					"desc" 	=> "Choose a predefined color scheme here. You can edit the settings of the scheme bellow then.",
					"id" 	=> "color_scheme",
					"type" 	=> "link_controller",
					"std" 	=> "",
					"class"	=> "link_controller_list",
					"subtype" => array('Grey' => array(	'style'=>'background-color:#333333;',
															'color_scheme'	=>'',
															'header_bg'		=>'#333333',
															'header_font'	=>'#ffffff',
															'bg_color'		=>'#f8f8f8',
															'primary'		=>'#687785',
															'secondary'		=>'#aac1cc',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Purple' => array(	'style'=>'background-color:#46424f;',
															'color_scheme'	=>'Purple',
															'header_bg'		=>'#46424f',
															'header_font'	=>'#ffffff',
															'bg_color'		=>'#fbf9fe',
															'primary'		=>'#46424f',
															'secondary'		=>'#8d87a0',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Blue' => array(	'style'=>'background-color:#2c3547;',
															'color_scheme'	=>'Blue',
															'header_bg'		=>'#2c3547',
															'header_font'	=>'#f5f7fa',
															'bg_color'		=>'#f5f7fa',
															'primary'		=>'#697a9c',
															'secondary'		=>'#6e7584',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Green' => array(	'style'=>'background-color:#596847;',
															'color_scheme'	=>'Green',
															'header_bg'		=>'#596847',
															'header_font'	=>'#f3f5f1',
															'bg_color'		=>'#f3f5f1',
															'primary'		=>'#3b5b12',
															'secondary'		=>'#658936',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
										
										
															
										'Brown' => array(	'style'=>'background-color:#352408;',
															'color_scheme'	=>'Brown',
															'header_bg'		=>'#352408',
															'header_font'	=>'#f2f0ee',
															'bg_color'		=>'#f2f0ee',
															'primary'		=>'#352408',
															'secondary'		=>'#594519',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Beige' => array(	'style'=>'background-color:#c8a05b;',
															'color_scheme'	=>'Beige',
															'header_bg'		=>'#c8a05b',
															'header_font'	=>'#fff',
															'bg_color'		=>'#f5eee2',
															'primary'		=>'#886324',
															'secondary'		=>'#c8a05b',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
										
										'Black/white' => array(	'style'=>'background-color:#000000;',
															'color_scheme'	=>'bw',
															'header_bg'		=>'#000000',
															'header_font'	=>'#fff',
															'bg_color'		=>'#f8f8f8',
															'primary'		=>'#222222',
															'secondary'		=>'#444444',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Red' => array(	'style'=>'background-color:#390c0c;',
															'color_scheme'	=>'red',
															'header_bg'		=>'#390c0c',
															'header_font'	=>'#fff',
															'bg_color'		=>'#f3e8e8',
															'primary'		=>'#390c0c',
															'secondary'		=>'#792c2c',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'), 
										
										'Teal' => array(	'style'=>'background-color:#43605b;',
															'color_scheme'	=>'teal',
															'header_bg'		=>'#43605b',
															'header_font'	=>'#fff',
															'bg_color'		=>'#e6edea',
															'primary'		=>'#43605b',
															'secondary'		=>'#548d83',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Navy' => array(	'style'=>'background-color:#435960;',
															'color_scheme'	=>'navy',
															'header_bg'		=>'#435960',
															'header_font'	=>'#fff',
															'bg_color'		=>'#dfe2e4',
															'primary'		=>'#435960',
															'secondary'		=>'#4c7987',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
										
										'Mettalic' => array('style'=>'background-color:#646e76;',
															'color_scheme'	=>'Mettalic',
															'header_bg'		=>'#646e76',
															'header_font'	=>'#fff',
															'bg_color'		=>'#e4e6e7',
															'primary'		=>'#435960',
															'secondary'		=>'#4c7987',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
																				
										'Light Grey' => array('style'=>'background-color:#777777;',
															'color_scheme'	=>'Light_Grey',
															'header_bg'		=>'#777777',
															'header_font'	=>'#ffffff',
															'bg_color'		=>'#e7e7e7',
															'primary'		=>'#333333',
															'secondary'		=>'#666666',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
										
										'Full Green' => array('style'=>'background-color:#666c1d;',
															'color_scheme'	=>'Full_Green',
															'header_bg'		=>'#666c1d',
															'header_font'	=>'#ffffff',
															'bg_color'		=>'#666c1d',
															'primary'		=>'#666c1d',
															'secondary'		=>'#a3a957',
															'bg_image'		=>'',
															'bg_image_repeat'=>'repeat',
															'bg_image_header_active'=>'',
															'stylesheet'	=>'minimal-skin.css'),
										
										'Blue Image' => array('style'=>'background-color:#2c3547;',
															'color_scheme'	=>'Blue_Image',
															'header_bg'		=>'#2c3547',
															'header_font'	=>'#f5f7fa',
															'bg_color'		=>'#f5f7fa',
															'primary'		=>'#697a9c',
															'secondary'		=>'#6e7584',
															'bg_image'		=> AVIA_BASE_URL.'images/background/yacht.jpg',
															'bg_image_repeat'=>'fullscreen',
															'bg_image_header_active'=>'transparent',
															'stylesheet'	=>'minimal-skin.css'),
										
										'Grunge' => array('style'=>'background-color:#222222;',
															'color_scheme'	=>'Grunge',
															'header_bg'		=>'#333333',
															'header_font'	=>'#fff',
															'bg_color'		=>'#000000',
															'primary'		=>'#222222',
															'secondary'		=>'#444444',
															'bg_image'		=> AVIA_BASE_URL.'images/background/grunge.jpg',
															'bg_image_repeat'=>'no-repeat',
															'bg_image_attachment'=>'fixed',
															'bg_image_position'=>'center',
															'bg_image_header_active'=>'transparent',
															'stylesheet'	=>'minimal-skin.css'),
															
										'Stripes' => array('style'=>'background-color:#435960;',
															'color_scheme'	=>'Stripes',
															'header_bg'		=>'#435960',
															'header_font'	=>'#fff',
															'bg_color'		=>'#dfe2e4',
															'primary'		=>'#435960',
															'secondary'		=>'#4c7987',
															'bg_image'		=> AVIA_BASE_URL.'images/background/diagonal-wide-left-to-right.png',
															'bg_image_repeat'=>'repeat',
															'bg_image_position'=>'center',
															'bg_image_header_active'=>'',
															'bg_image_attachment'=>'scroll',
															'stylesheet'	=>'minimal-skin.css'),
									   
					));
	
/*
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Stylesheet",
					"desc" 	=> "You can choose between a stylesheet for dark and for light color schemes.",
					"id" 	=> "stylesheet",
					"type" 	=> "select",
					"std" 	=> "minimal-skin.css",
					"target" => array("default_slideshow_target::.live_bg_default::set_id"),
					"subtype" => array('Minimal (minimal-skin.css)'=>'minimal-skin.css','Dark (dark-skin.css)'=>'dark-skin.css'));
*/


	
$avia_elements[] =	array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "default_image_settings", "nodescription" => true);	
				
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Header/Footer background color",
					"desc" 	=> "Choose a background Color for your header and footer",
					"id" 	=> "header_bg",
					"type" 	=> "colorpicker",
					"std" 	=> "#333333",
					"target" => array("default_slideshow_target::.live_bg, .live_bg p::background-color"),
					);

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Background color",
					"desc" 	=> "Choose a background color for the part that is outside of the 'boxed content'.",
					"id" 	=> "bg_color",
					"type" 	=> "colorpicker",
					"std" 	=> "#f8f8f8",
					"target" => array("default_slideshow_target::.live_bg_wrap, .live_bg_wrap::background-color"),
					);					

					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Primary font color",
					"desc" 	=> "Choose a font color for links, dropcaps and other elements that are highlighted via font color",
					"id" 	=> "primary",
					"type" 	=> "colorpicker",
					"std" 	=> "#687785",
					"target" => array("default_slideshow_target::.live_bg_default .a_link::color"),
					);	
					
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Secondary color",
					"desc" 	=> "Choose a secondary color for links hover",
					"id" 	=> "secondary",
					"type" 	=> "colorpicker",
					"std" 	=> "#aac1cc",
					"target" => "default_slideshow_target::.live_bg_default .an_activelink::color",
					);


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Header/Footer font color",
					"desc" 	=> "Choose a color for the font located on colored header/footer background",
					"id" 	=> "header_font",
					"type" 	=> "colorpicker",
					"std" 	=> "#ffffff",
					"target" => "default_slideshow_target::.live_bg h3, .live_bg p, .live_bg a::color",
					);	
				
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Background Image",
					"desc" 	=> "This image will be displayed behind the boxed area",
					"id" 	=> "bg_image",
					"type" 	=> "upload",
					"std" 	=> "",
					"label"	=> "Use Image");
			 					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Position of the image",
					"desc" 	=> "",
					"id" 	=> "bg_image_position",
					"type" 	=> "select",
					"std" 	=> "left",
					"required" => array('bg_image','{true}'),
					"subtype" => array('Left'=>'left','Center'=>'center','Right'=>'right'));
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Repeat",
					"desc" 	=> "",
					"id" 	=> "bg_image_repeat",
					"type" 	=> "select",
					"std" 	=> "no-repeat",
					"required" => array('bg_image','{true}'),
					"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y', 'Stretch Fullscreen'=>'fullscreen'));
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Attachment",
					"desc" 	=> "",
					"id" 	=> "bg_image_attachment",
					"type" 	=> "select",
					"std" 	=> "scroll",
					"required" => array('bg_image','{true}'),
					"subtype" => array('Scroll'=>'scroll','Fixed'=>'fixed'));

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Disable Header Background",
					"desc" 	=> "Should the header background be transparent so the image can be visible at the top of the page as well? ",
					"id" 	=> "bg_image_header_active",
					"type" 	=> "select",
					"std" 	=> "transparent",
					"required" => array('bg_image','{true}'),
					"subtype" => array('Yes'=>'transparent','No'=>''));
					
					
										
$avia_elements[] =	array(	"slug"	=> "styling", "type" => "visual_group_end", "nodescription" => true);	

$avia_elements[] =	array(	"name" 	=> "Heading Font",
							"slug"	=> "styling",
							"desc" 	=> "The Font heading utilizes cufon and allows you to use a wide range of custom fonts for your headings",
				            "id" 	=> "font_heading",
				            "type" 	=> "select",
				            "no_first" => true,
				            "std" 	=> "",
				            "subtype" => array(	'no custom font'=>'',
				            					'Arvo'=>'arvo__1.3',
				            					'Bevan'=>'bevan__1.3',
				            					'Cantarell'=>'cantarell__1.3',
				            					'Cardo'=>'cardo__1.3',
				            					'Droid Sans'=>'droidsans__1.3',
				            					'Inconsolata'=>'inconsolata__1.3',
				            					'Josefin All Characters'=>'josefine__1.3',
				            					'Josefin Common Characters'=>'josefine_small__1.3',
				            					'Kreon'=>'kreon__1.3',
				            					'Lobster'=>'lobster__1.3',
				            					'Molengo'=>'molengo__1.3',
				            					'Oswald'=>'oswald__1.3',
				            					'Reenie Beanie'=>'reeniebeanie__1.6', //number attached is a font size modifier for very small fonts ( * 1.4)
				            					'Tangerine'=>'tangerine__2.2',
				            					'Vollkorn'=>'vollkorn__1.3',
				            					'Yanone Kaffeesatz'=>'yanonekaffeesatz__1.3'
				            					));
				            					
				            					





$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Quick CSS",
					"desc" 	=> "Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the custom.css file.",
					"id" 	=> "quick_css",
					"type" 	=> "textarea"
					);




					
/*Layout Settings*/

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Do you want to use a stretched layout or a boxed?",
					"desc" 	=> "The stretched layout expands from the left side of the viewport to the right.",
					"id" 	=> "boxed",
					"type" 	=> "select",
					"std" 	=> "boxed",
					"subtype" => array('Stretched layout'=>'stretched','Boxed Layout'=>'boxed'));

					

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Blog Layout",
					"desc" 	=> "Choose the default blog layout here. You can create multiple blogs with different layouts by using the template builder if you want to",
					"id" 	=> "blog_layout",
					"type" 	=> "select",
					"std" 	=> "big_image sidebar_right single_sidebar",
					"no_first"=>true,
					"subtype" => array( 'Big preview image, left sidebar' =>'big_image sidebar_left single_sidebar',
										'Big preview image, right sidebar'=>'big_image sidebar_right single_sidebar',
										'Medium preview image, left sidebar' =>'medium_image sidebar_left single_sidebar',
										'Medium preview image, right sidebar'=>'medium_image sidebar_right single_sidebar',
										'Medium preview image, left and right sidebar'=>'medium_image dual-sidebar',
										'Small preview image, left sidebar'=>'small_image sidebar_left single_sidebar',
										'Small preview image, right sidebar'=>'small_image sidebar_right single_sidebar'
										));



$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Page Layout",
					"desc" 	=> "Choose the default page layout here. You can change the setting of each individual page when editing that page",
					"id" 	=> "page_layout",
					"type" 	=> "select",
					"std" 	=> "big_image sidebar_left single_sidebar",
					"no_first"=>true,
					"subtype" => array( 'Big preview image, left sidebar' =>'big_image sidebar_left single_sidebar',
										'Big preview image, right sidebar'=>'big_image sidebar_right single_sidebar',
										'Medium preview image, left and right sidebar'=>'medium_image dual-sidebar',
										'Fullsize preview image, no sidebar'=>'fullwidth'
										));
							
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Page Sidebar navigation",
					"desc" 	=> "You can choose to display a sidebar navigation for all nested subpages of a page automatically. ",
					"id" 	=> "page_nesting_nav",
					"type" 	=> "select",
					"std" 	=> "true",
					"no_first"=>true,
					"subtype" => array( 'Display sidebar navigation'=>'true',
										'Don\'t display Sidebar navigation' => ""
										));			







/*Contact + social stuff*/


			
$avia_elements[] =	array(	
			"name" 	=> "Contact Form Page",
			"slug"	=> "contact",
			"desc" 	=> "Select which page should be used to display your contact form.",
			"id" 	=> "email_page",
			"type" 	=> "select",
			"subtype" => 'page');
			
$avia_elements[] =	array(	
			"name" 	=> "Your email adress",
			"slug"	=> "contact",
			"desc" 	=> "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
			"id" 	=> "email",
			"std" 	=> get_option('admin_email'),
			"type" 	=> "text");
	
$avia_elements[] =	array(	
			"name" 	=> "Your twitter account",
			"slug"	=> "contact",
			"desc" 	=> "Enter your twitter account name. If you leave this blank the twitter link in the head and footer of your site wont be displayed.",
			"id" 	=> "twitter",
			"std" 	=> "envato",
			"type" 	=> "text");
			
$avia_elements[] =	array(	
			"name" 	=> "RSS feed url",
			"slug"	=> "contact",
			"desc" 	=> "If you want to use a service like feedburner enter the feed url here. Otherwise the default wordpress feed url will be used",
			"id" 	=> "feedburner",
			"std" 	=> "",
			"type" 	=> "text");
			
$avia_elements[] =	array(
			"name" 	=> "Your facebook page/group/account",
			"desc" 	=> "Enter the url to your facebook page/group/account. If you leave this blank the facebook link in the head and footer of your site wont be displayed.",
			"id" 	=> "facebook",
			"slug"	=> "contact",
			"std" 	=> "http://www.facebook.com/kriesi.at",
			"type" 	=> "text");
			

			
			



/*sidebar settings*/
					
$avia_elements[] =	array(	"name" => "Add new widget areas for pages and categories:",
							"desc" => "Here you can add widget areas for single pages or categories. that way you can put different content for each page/category into your sidebar.
After you have choosen the Pages and Categorys which should receive a unique widget area press the 'Save Changes' button and then start adding widgets to the new widget areas <a href='widgets.php'>here</a>.
<br/><br/>
<strong>Attention when removing areas:</strong> You have to be carefull when deleting widget areas that are not the last one in the list.
It is recommended to avoid this. If you want to know more about this topic please read the documentation that comes with this theme.",
							"id" => "widgetdescription",
							"std" => "",
							"slug"	=> "sidebar",
							"type" => "heading",
							"nodescription"=>true);
			
			
					
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_start", "id" => "sidebar_left", "class"=>"avia_one_half avia_first", "nodescription" => true);
$avia_elements[] =	array(
					"type" 			=> "group", 
					"id" 			=> "widget_pages", 
					"slug"			=> "sidebar",
					"linktext" 		=> "Add another widget",
					"deletetext" 	=> "Remove widget",
					"blank" 		=> true, 
					"nodescription" => true,
					'subelements' 	=> array(	
	
							array(	
								"name" 	=> "Select a PAGE that should receive a new widget area:",
								"desc" 	=> "",
								"id" 	=> "widget_page",
								"type" 	=> "select",
								"slug"	=> "sidebar",
								"subtype" => 'page'),				           
						        )   
						);
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_end", "nodescription" => true);





$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_start", "id" => "sidebar_right", "class"=>"avia_one_half", "nodescription" => true);
$avia_elements[] =	array(
					"type" 			=> "group", 
					"slug"			=> "sidebar",
					"id" 			=> "widget_categories", 
					"linktext" 		=> "Add another widget",
					"deletetext" 	=> "Remove widget",
					"blank" 		=> true, 
					"nodescription" => true,
					'subelements' 	=> array(
						
							array(	
								"name" 	=> "Select a Category that should receive a new widget area:",
								"desc" 	=> "",
								"id" 	=> "widget_cat",
								"slug"	=> "sidebar",
								"type" 	=> "select",
								"subtype" => 'cat'),				           
						        )   
						);
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_end", "nodescription" => true);
	





/*footer settings*/

$avia_elements[] =	array(	"name" 	=> "Logo Footer",
				"desc" 	=> "Here you can add a Logo Gallery that will appear at your footer. Display the logos of partner shops for example",
				"id" 	=> "gallery_image",
				"type" 	=> "upload",
				"slug"  => "footer",
				"subtype" => "advanced",
				"button-label" => "Upload",
				"label"	=> "Update Gallery",
				"attachment-prefix"=>'smart-logo-gallery',
				"no-attachment-id"=>true
				
				);
				
$avia_elements[] =	array(	
					"slug"	=> "footer",
					"name" 	=> "Footer Logo Display",
					"desc" 	=> "You can choose were to display the footer logos here. ",
					"id" 	=> "footer_logo_where",
					"type" 	=> "select",
					"std" 	=> "true",
					"no_first"=>true,
					"subtype" => array( 'Display only on frontpage'=>'',
										'Display everywhere' => "everywhere"
										));		
										
$avia_elements[] =	array(	
					"slug"	=> "footer",
					"name" 	=> "Footer Columns",
					"desc" 	=> "How many colmns should be diplayed in your footer",
					"id" 	=> "footer_columns",
					"type" 	=> "select",
					"std" 	=> "4",
					"subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'));	


					
				
					

######################################################################
# TEMPLATE BUILDER
######################################################################


$avia_elements[] 	=		array(	"name" => "How does this work?",
							"desc" => "
							<p>It only takes a few simple steps to create any number of unique page layouts with the template builder. The description bellow is just a short intro on how it works, you can read more about it in the <a target='_blank' href='http://docs.kriesi.at/".avia_backend_safe_string($this->base_data['prefix'])."/documentation#template_builder'>documentation</a></p>
							<ol>
								<li>First you need to create a new Template by adding a name and hitting the 'Create template' Button</li>
								<li>Next you select your template from the sidebar at the left. Add elements like columns, post snippets, text content and widget areas.</li>
								<li>Once that is done save the changes by hitting 'Save all Changes'</li>
								<li>Now create or edit a page/post and you will notice that you can select your template at the <strong>Post or Page Layout</strong> section. If you do, it will be applied to the post or page.</li>
							</ol>
							",
							"id" => "template_builder_description",
							"std" => "",
							"type" => "heading",
							"slug" => "templates",
							"nodescription"=>true);


$avia_elements[] 	=	array(	"name" 	=> "Create a new dynamic template",
								"desc" 	=> "Enter a name for your new template, then hit the 'Create template' Button<br/><strong>Please Note:</strong> Allowed characters include: a-z, A-Z, 0-9, space, underscore and dash",
								"label"	=> "Create template",
								"remove_label"=> "remove this template",
								"id" 	=> "template_builder",
								"type" 	=> "create_options_page",
								"slug"  => "templates",
								"template_sortable" => 'avia_sortable',
 								"temlate_parent" => "templates",
								"temlate_icon" => "layout_header_footer_3_mix.png",
								"temlate_default_elements" => array(
								
										array(	
										"slug"	=> "templates",
										"name" 	=> "Dynamic Template Page Layout",
										"desc" 	=> "Choose the default page layout here. You can change the setting of each individual page when editing that page",
										"id" 	=> "dynamic_page_layout",
										"type" 	=> "select",
										"std" 	=> "fullwidth",
										"no_first"=>true,
										"subtype" => array( 'Left sidebar' =>'big_image sidebar_left single_sidebar',
															'Right sidebar'=>'big_image sidebar_right single_sidebar',
															'Left and Right sidebar'=>'medium_image dual-sidebar',
															'Fullsize, no sidebar'=>'fullwidth'
															)),
										
										array(
										"type" 	=> "dynamical_add_elements",
										"slug"  => 'templates',
										"name" 	=> "Add Elements",
										"desc" 	=> "Select an Element and hit the 'Add Element' Button.<br/>The Element will be added to the template and you will be able to position it via drag and drop",
										"std"	=> "",
										"id"	=> "add_template_option",
										"options_file"		=> "dynamic"
										)
									)
								);


