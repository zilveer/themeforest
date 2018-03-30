<?php


//avia pages holds the data necessary for backend page creation
$avia_pages = array( 
	
	array( 'slug' => 'avia', 		'parent'=>'avia', 'icon'=>"hammer_screwdriver.png" , 	'title' =>  'Theme Options' ),
	array( 'slug' => 'styling', 	'parent'=>'avia', 'icon'=>"palette.png", 				'title' =>  'Styling'  ),
	array( 'slug' => 'layout', 		'parent'=>'avia', 'icon'=>"blueprint_horizontal.png", 	'title' =>  'General Settings'  ),
	array( 'slug' => 'portfolio', 	'parent'=>'avia', 'icon'=>"photo_album.png" , 			'title' =>  'Portfolio' ),
	array( 'slug' => 'contact', 	'parent'=>'avia', 'icon'=>"book_addresses.png" , 		'title' =>  'Contact &amp; Social Stuff' ),
	array( 'slug' => 'sidebar', 	'parent'=>'avia', 'icon'=>"layout_select_sidebar.png", 	'title' =>  'Sidebar'  )
					 
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
					"name" 	=> "Which general color scheme should be used?",
					"desc" 	=> "You can choose between a light and a dark color scheme here.",
					"id" 	=> "stylesheet",
					"type" 	=> "select",
					"std" 	=> "minimal-skin.css",
					"target" => array("default_slideshow_target::.live_bg_default::set_id"),
					"subtype" => array('Minimal (minimal-skin.css)'=>'minimal-skin.css','Dark (dark-skin.css)'=>'dark-skin.css'));

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"id" 	=> "default_slideshow_target",
					"type" 	=> "target",
					"std" 	=> "
					<style type='text/css'>
						.live_bg, .live_bg_default{padding:2%; width:46%; float:left; height:150px;}
					
						.live_bg_default{background:#fff;color:#777;}
						.live_bg_default h3{color:#333;}
						.live_bg_default#dark-skin-css{background:#222;color:#fff;}
						.live_bg_default#dark-skin-css h3{color:#fff;}
						/*.live_bg p{opacity:0.6;}*/
						
					</style> 
					<div class='live_bg_default'><h3>Demo heading</h3><p>This is default content with a default heading. Font color and text are set based on the skin you choose above. Headings and link colors can be choosen below. <br/> <a class='a_link' href='#'>A link</a>  <a class='an_activelink' href='#'>A hovered link</a></p></div>
					
					<div class='live_bg'><h3>Demo heading</h3><p>This is text on a colored background</p>
					<!--, as for example in your footer.</p><p>Text and <a href='#'>links</a> got the same color, headings are a little lighter</p>-->
					</div>
					",
					"nodescription" => true
					);	
	
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Primary color",
					"desc" 	=> "Choose a primary color for links, buttons, colored dropcaps etc",
					"id" 	=> "primary",
					"type" 	=> "colorpicker",
					"std" 	=> "#1994e6",
					"target" => array("default_slideshow_target::.live_bg_default .a_link::color", "default_slideshow_target::.live_bg, .live_bg p::background-color"),
					);
					


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Font Color on colored background",
					"desc" 	=> "Choose a color for font located on colored background",
					"id" 	=> "primary_font",
					"type" 	=> "colorpicker",
					"std" 	=> "#ffffff",
					"target" => "default_slideshow_target::.live_bg h3, .live_bg p, .live_bg a::color",
					);	
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Secondary color",
					"desc" 	=> "Choose a secondary color for links hover",
					"id" 	=> "secondary",
					"type" 	=> "colorpicker",
					"std" 	=> "#ff00c4",
					"target" => "default_slideshow_target::.live_bg_default .an_activelink::color",
					);							
					

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
					"name" 	=> "Blog Overview Image layout",
					"desc" 	=> "",
					"id" 	=> "blog_image_layout",
					"type" 	=> "select",
					"std" 	=> "",
					"subtype" => array('Display Image Small beside entry when mouse is hovering entry'=>'','Display Image Above Entry'=>'full'));

					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Background color",
					"desc" 	=> "Choose a background color for your site.",
					"id" 	=> "bg_color",
					"type" 	=> "colorpicker",
					"std" 	=> "#222222"
					
					);
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Background Image",
					"desc" 	=> "A single background image or pattern. It is recommended to use a small pattern here in case your fullwidth background images didnt load yet",
					"id" 	=> "bg_image",
					"type" 	=> "upload",
					"std" 	=> "",
					"label"	=> "Use Image");
			 					
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Repeat",
					"desc" 	=> "",
					"id" 	=> "bg_image_repeat",
					"type" 	=> "select",
					"std" 	=> "no-repeat",
					"required" => array('bg_image','{true}'),
					"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y', 'Fullscreen'=>'fullscreen'));
					
										
$avia_elements[] =	array(	"name" 	=> "Default Background Image Gallery",
				"desc" 	=> "Here you can add a default background Gallery that will appear on all posts and pages that have not set a unique background gallery",
				"id" 	=> "gallery_image",
				"type" 	=> "upload",
				"slug"  => "layout",
				"subtype" => "advanced",
				"button-label" => "Upload",
				"label"	=> "Update Gallery",
				"attachment-prefix"=>'smart-default-gallery',
				"no-attachment-id"=>true,
				"force_old_media" => true
				
				);
				
$avia_elements[] =	array(	
					"id" 	=> "gallery_overlay",
					"name" 	=> "Do you want to display a tiled semi-transparent background pattern in front of the background?",
					"desc" 	=> "This is useful for pages that focus on the content area rather than the background. You can add patterns to the list by simply adding files to your themes images/patterns/ folder",
					"type" 	=> "select",
					"slug"  => "layout",
					"no_first" => true,
					"subtype" => array('Display no pattern overlay'=>'none'),
					"std" 	=> "none", //AVIA_BASE_URL."images/patterns/glow.png",
					"folder" => "images/patterns/",
					"folderlabel" => "");
					
									
$avia_elements[] = array(	
		"name" 	=> "Background Image Gallery Autorotation",
		"desc" 	=> "Here you can set the default autorotation timer of all your slideshows. Each slideshow image will be shown X seconds, where X is the number you choose at the dropdown menu.<br/> This setting can be overwritten for each single entry individually",
		"id" 	=> "slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "false",
		"no_first" => true,
		"slug"  => "layout",
		"subtype" => 
		array('no autoroation'=>'false','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100'));
					

$avia_elements[] = 	array(	
			"slug"	=> "layout",
			"name" 	=> "Background Gallery Default Transition",
			"desc" 	=> "You can choose if images should either fade or slide",
			"id" 	=> "gallery_transition",
			"type" 	=> "select",
			"std" 	=> "fade",
			"no_first"=>true,
			"subtype" => array( 'Fade' => "fade",
								'Slide' => "slide"
		));

$avia_elements[] = 	array(	
			"slug"	=> "layout",
			"name" 	=> "Background Gallery Image Cropping/resizing",
			"desc" 	=> "By default the images are resized to fill the whole user viewport. Depending on the browser size of the user this might lead to cropping of your images. You can deactivate this behavior and tell the slideshow to show your images un-cropped, no matter the user viewport size. This probably doesn't look that nice but works better for pictures in portrait orientation",
			"id" 	=> "gallery_cropping",
			"type" 	=> "select",
			"std" 	=> "",
			"no_first"=>true,
			"subtype" => array( 'Images should be scaled to fit, with cropping if necessary' => "",
								'Images should be displayed without cropping' => "dont_crop_images"
		));


$avia_elements[] = 	array(	
			"slug"	=> "layout",
			"name" 	=> "Gallery Tooltips",
			"desc" 	=> "Some of the galleries support fancy tooltips that can display various options. <br/><strong>Please Note:</strong>If you want to display some tooltips but want to skip the tooltip for a single image just rename the title to a single dash: -",
			"id" 	=> "gallery_tooltips",
			"type" 	=> "select",
			"std" 	=> "all",
			"no_first"=>true,
			"subtype" => array( 'Show Tooltips with title, description and exif data' => "all",
								'Show Tooltips with title &amp; description only' => "title",
								'Show no tooltips' => "none",
		));
		



/*portfolio settings*/

	
$avia_elements[] =	array(		
					"slug"	=> "portfolio",
					"name" 	=> "Enter a page slug that should be used for your portfolio single items",
					"desc" 	=> "For example if you enter 'portfolio-item' the link to the item will be <strong>".get_option('home').'/portfolio-item/post-name</strong><br/><br/>Dont use characters that are not allowed in urls and make sure that this slug is not used anywere else on your site (for example as a category or a page)',
					"id" 	=> "portfolio-slug",
					"std" 	=> "portfolio-item",
					"type" 	=> "text");
					
$itemcount = array('All'=>'-1');
for($i = 1; $i<101; $i++) $itemcount[$i] = $i;		
	
$avia_elements[] =	array(	
				"slug"			=> "portfolio",
				"type" 			=> "group", 
				"id" 			=> "portfolio", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which categories should be used for the portfolio?",
								"desc" 	=> "You can select multiple categories here. The Portfolio Page that you choose below will then show all posts from those categories, along with a sort option for each category.",
					            "id" 	=> "portfolio_cats",
					            "type" 	=> "select",
								"slug"	=> "portfolio",
	            				"multiple"=>6,
	            				"taxonomy" => "portfolio_entries",
					            "subtype" => "cat"),
					            
					    							
						array(	"name" 	=> "Which page should display the portfolio?",
								"slug"	=> "portfolio",
								"desc" 	=> "",
					            "id" 	=> "portfolio_page",
					            "type" 	=> "select",
					            "subtype" => "page"),
					            
					   array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Columns",
								"desc" 	=> "How many columns should be displayed?",
								"id" 	=> "portfolio_columns",
								"type" 	=> "select",
								"std" 	=> "2",
								"subtype" => array(	'2 Columns'=>'2',
													'3 Columns'=>'3'
													)),

								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Post Number",
								"desc" 	=> "How many items should be displayed per page?",
								"id" 	=> "portfolio_item_count",
								"type" 	=> "select",
								"std" 	=> "16",
								"subtype" => $itemcount),
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Title & Excerpt",
								"desc" 	=> "Should a small text excerpt of the portfolio entry be displayed?",
								"id" 	=> "portfolio_text",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no')),	

								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Pagination",
								"desc" 	=> "Should a portfolio pagination be displayed?",
								"id" 	=> "portfolio_pagination",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no'))
	
				)
			);
	



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
			"desc" 	=> "Enter your twitter account name. If you leave this blank the twitter link in your sidebar of your site wont be displayed.",
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
			"desc" 	=> "Enter the url to your facebook page/group/account. If you leave this blank the facebook link in your sidebar of your site wont be displayed.",
			"id" 	=> "facebook",
			"slug"	=> "contact",
			"std" 	=> "http://www.facebook.com/kriesi.at",
			"type" 	=> "text");
			

			
			



/*sidebar settings*/
$avia_elements[] =	array(	
					"slug"	=> "sidebar",
					"name" 	=> "Do you want to display a right sidebar by default?",
					"desc" 	=> "Attention: This only applies to small pages. Masonry pages for example are excluded from this setting",
					"id" 	=> "sidebar_right",
					"type" 	=> "select",
					"std" 	=> "no",
					"subtype" => array('No right sidebar'=>'no','Yes display right sidebar'=>'yes'));						
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
	






