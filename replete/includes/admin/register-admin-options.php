<?php
global $avia_config;

//avia pages holds the data necessary for backend page creation
$avia_pages = array( 
	
	array( 'slug' => 'avia', 		'parent'=>'avia', 'icon'=>"hammer_screwdriver.png" , 	'title' =>  'Theme Options' ),
	array( 'slug' => 'styling', 	'parent'=>'avia', 'icon'=>"palette.png", 				'title' =>  'Styling'  ),
	array( 'slug' => 'layout', 		'parent'=>'avia', 'icon'=>"blueprint_horizontal.png", 	'title' =>  'Layout &amp; Settings'  ),
	array( 'slug' => 'portfolio', 	'parent'=>'avia', 'icon'=>"photo_album.png" , 			'title' =>  'Portfolio' ),
	array( 'slug' => 'contact', 	'parent'=>'avia', 'icon'=>"book_addresses.png" , 		'title' =>  'Contact' ),
	array( 'slug' => 'sidebar', 	'parent'=>'avia', 'icon'=>"layout_select_sidebar.png", 	'title' =>  'Sidebar'  ),
	array( 'slug' => 'footer', 		'parent'=>'avia', 'icon'=>"layout_select_footer.png", 	'title' =>  'Footer'  ),
	array( 'slug' => 'templates', 	'parent'=>'templates','icon'=>"page_white_wrench.png", 	'title' =>  'Template Builder'  ),
	array( 'slug' => 'frontpage', 	'parent'=>'templates','icon'=>"layout_header_footer_3_mix.png", 	'title' =>  'Frontpage', 'sortable' => 'avia_sortable'  )
					 
);





/*Frontpage Settings*/


					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Import Dummy Content: Posts, Pages, Categories",
					"desc" 	=> "If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitely help to understand how those tasks are done.",
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
					"name" 	=> "Favicon",
					"desc" 	=> "Specify a <a href='http://en.wikipedia.org/wiki/Favicon'>favicon</a> for your site. <br/>Accepted formats: .ico, .png, .gif",
					"id" 	=> "favicon",
					"type" 	=> "upload",
					"label"	=> "Use Image as Favicon");

					
$avia_elements[] = array(	
					"slug"	=> "avia",
					"name" 	=> "Header Search Form",
					"desc" 	=> "Should the form let users search the entire site (default WordPress Search) or just for Products (Product Search)",
					"id" 	=> "header_search",
					"type" 	=> "select",
					"std" 	=> "default",
					"no_first"=>true,
					"subtype" => array('Default WordPress Search'=>'default','Product Search'=>'product'));	
								
													
$avia_elements[] =	array(
					"type" 			=> "group", 
					"id" 			=> "social_icons", 
					"slug"			=> "avia",
					"linktext" 		=> "Add another social icon",
					"deletetext" 	=> "Remove icon",
					"blank" 		=> true, 
					"nodescription" => true,
					"std"			=> array(
										array('social_icon'=>'twitter', 'social_icon_link'=>'http://twitter.com/kriesi'),
										array('social_icon'=>'dribbble', 'social_icon_link'=>'http://dribbble.com/kriesi'),
										array('social_icon'=>'rss', 'social_icon_link'=>''),
										),
					'subelements' 	=> array(	
	
							array(	
								"name" 	=> "Social Icon",
								"desc" 	=> "",
								"id" 	=> "social_icon",
								"type" 	=> "select",
								"slug"	=> "sidebar",
								"class" => "av_2columns av_col_1",
								"subtype" => array(
								
									'Behance' 	=> 'behance',
									'Dribbble' 	=> 'dribbble',
									'Facebook' 	=> 'facebook',
									'Flickr' 	=> 'flickr',
									'Forrst' 	=> 'forrst',
									'Google Plus' => 'gplus',
									'LinkedIn' 	=> 'linkedin',
									'Myspace' 	=> 'myspace',
									'Pinterest' 	=> 'pinterest',
									'Skype' 	=> 'skype',
									'Tumblr' 	=> 'tumblr',
									'Twitter' 	=> 'twitter',
									'Vimeo' 	=> 'vimeo',
									'Youtube' 	=> 'youtube',
									'Special: RSS (add RSS URL, leave blank if you want to use default WordPress RSS feed)' => 'rss',
									'Special: Email Icon (add URL to a contact form, leave blank if you want to use this Sites contact form)' => 'mail',
								
								)),	
								
							array(	
								"name" 	=> "Social Icon URL:",
								"desc" 	=> "",
								"id" 	=> "social_icon_link",
								"type" 	=> "text",
								"slug"	=> "sidebar",
								"class" => "av_2columns av_col_2"),			           
						        )   
						);					
			
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Google Analytics Tracking Code",
					"desc" 	=> "Enter your Google analytics tracking Code here. It will automatically be added so google can track your visitors behavior.",
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
					
						#stretched .live_bg_wrap{padding:10px 0; border:none;}
					
						.live_bg_small{font-size:10px; color:#999;}
						.live_bg_wrap{ padding:23px; background:#f8f8f8; overflow:hidden; border:1px solid #e1e1e1; background-position: top center;}
						.live_bg_wrap div{overflow:hidden; position:relative;}
						.live_bg_wrap h3{margin: 0 0 5px 0;}
						.live_bg_wrap .main_h3{font-weight:bold; font-size:17px;}
						.border{border:1px solid; border-bottom:none; padding:13px; width:562px;}
						#boxed .border{  width:514px;} 
						
						.live_header_color {position: relative;width: 100%;left: }
						.bg2{border:1px solid; margin:4px; display:block; float:right; width:220px; padding:5px;}
						.content_p{display:block; float:left; width:250px;}
						.live-socket_color{font-size:11px;}
						.live-footer_color a{text-decoration:none;}
						.live-socket_color a{text-decoration:none;  position:absolute; top:28%; right:13px;}

						#avia_preview .webfont_google_webfont{  font-weight:normal; } 
						.webfont_default_font{  font-weight:normal; font-size:13px; line-height:1.7em;} 
						
						div .link_controller_list a{ width:81px; font-size:11px;}
						.avia_half{width: 267px; float:left; height:183px;}
						.avia_half .bg2{float:none; margin-left:0;}
						.avia_half_2{border-left:none; padding-left:14px;}
						#boxed  .avia_half { width: 243px; }
						.live-slideshow_color{text-align:center;}
						.text_small_outside{position:relative; top:-15px; display:block; left: 10px;}
					</style>
					
					
					
					
					
					<small class='live_bg_small'>A rough preview of the frontend.</small>
					
					<div id='avia_preview' class='live_bg_wrap webfont_default_font'>
					<!--<small class='text_small_outside'>Next Event: in 10 hours 5 minutes.</small>-->
					
					
						<div class='live-header_color border'>
							<span class='text'>Header Text</span>
							<a class='a_link' href='#'>A link</a>  
							<a class='an_activelink' href='#'>A hovered link</a>
							<div class='bg2'>Highlight Background + Border Color</div>
						</div>
						
						<div class='live-slideshow_color border'>
							<h3 class='webfont_google_webfont main_h3'>Slideshow Area/Page Title Area</h3>
								<p class='slide_p'>Slideshow caption<br/> 
									<a class='a_link' href='#'>A link</a>  
									<a class='an_activelink' href='#'>A hovered link</a>
								</p>
						</div>
						
						<div class='live-main_color border avia_half'>
							<h3 class='webfont_google_webfont main_h3'>Main Content heading</h3>
								<p class='content_p'>This is default content with a default heading. Font color, headings and link colors can be choosen below. <br/> 
									<a class='a_link' href='#'>A link</a>  
									<a class='an_activelink' href='#'>A hovered link</a>
								</p>
								
								<div class='bg2'>Highlight Background + Border Color</div>
						</div>
						
						
						
						<div class='live-alternate_color border avia_half avia_half_2'>
								<h3 class='webfont_google_webfont main_h3'>Alternate Content Area</h3>
								<p>This is content of an alternate content area. Choose font color, headings and link colors below. <br/>
									<a class='a_link' href='#'>A link</a>  
									<a class='an_activelink' href='#'>A hovered link</a>
								</p>
								
								<div class='bg2'>Highlight Background + Border Color</div>
						</div>
					
						<div class='live-footer_color border'>
							<h3 class='webfont_google_webfont'>Demo heading (Footer)</h3>
							<p>This is text on the footer background</p>
							<a class='a_link' href='#'>Link | Link 2</a>
						</div>
						
						<div class='live-socket_color border'>Socket Text <a class='a_link' href='#'>Link | Link 2</a></div>
					</div>
					
					",
					"nodescription" => true
					);	
					

include('register-backend-styles.php');			
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Select a predefined color scheme",
					"desc" 	=> "Choose a predefined color scheme here. You can edit the settings of the scheme bellow then.",
					"id" 	=> "color_scheme",
					"type" 	=> "link_controller",
					"std" 	=> "Blue",
					"class"	=> "link_controller_list",
					"subtype" => $styles);


$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "avia_tab1", "nodescription" => true, 'class'=>'avia_tab_container avia_set');

$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "avia_tab1", "nodescription" => true, 'class'=>'avia_tab avia_tab1','name'=>'Fonts');


					
					
$avia_elements[] =	array(	"name" 	=> "Heading Font",
							"slug"	=> "styling",
							"desc" 	=> "The Font heading utilizes google fonts and allows you to use a wide range of custom fonts for your headings",
				            "id" 	=> "google_webfont",
				            "type" 	=> "select",
				            "no_first" => true,
				            "class" => "av_2columns av_col_1",
				            "onchange" => "avia_add_google_font",
				            "std" 	=> "Open Sans",
				            "subtype" => array(	'no custom font'=>'',
				            
				            					'Alice'=>'Alice',
				            					'Allerta'=>'Allerta',
				            					'Arvo'=>'Arvo',
				            					'Antic'=>'Antic',
				            
				            					'Bangers'=>'Bangers',
				            					'Bitter'=>'Bitter',
				            					
				            					'Cabin'=>'Cabin',
				            					'Cardo'=>'Cardo',
				            					'Carme'=>'Carme',
				            					'Coda'=>'Coda',
				            					'Coustard'=>'Coustard',
				            					'Gruppo'=>'Gruppo',

				            					'Damion'=>'Damion',
				            					'Dancing Script'=>'Dancing Script',
				            					'Droid Sans'=>'Droid Sans',
				            					'Droid Serif'=>'Droid Serif',
				            					
				            					'EB Garamond'=>'EB Garamond',
				            					
				            					'Fjord One'=>'Fjord One',
				            					
				            					'Inconsolata'=>'Inconsolata',
				            					
				            					'Josefin Sans' => 'Josefin Sans',
				            					'Josefin Slab'=>'Josefin Slab',
				            					
				            					'Kameron'=>'Kameron',
				            					'Kreon'=>'Kreon',
				            					
				            					'Lobster'=>'Lobster',
				            					'League Script'=>'League Script',

				            					'Mate SC'=>'Mate SC',
				            					'Mako'=>'Mako',
				            					'Merriweather'=>'Merriweather',
				            					'Metrophobic'=>'Metrophobic',
				            					'Molengo'=>'Molengo',
				            					'Muli'=>'Muli',

				            					'Nobile'=>'Nobile',
				            					'News Cycle'=>'News Cycle',

				            					'Open Sans'=>'Open Sans',
				            					'Orbitron'=>'Orbitron',
				            					'Oswald'=>'Oswald',
				            					
				            					'Pacifico'=>'Pacifico',
				            					'Poly'=>'Poly',
				            					'Podkova'=>'Podkova',

				            					'Quattrocento'=>'Quattrocento',
				            					'Questrial'=>'Questrial',
				            					'Quicksand'=>'Quicksand',
				            					
				            					'Raleway'=>'Raleway',

				            					'Salsa'=>'Salsa',
				            					'Sunshiney'=>'Sunshiney',
				            					'Signika Negative'=>'Signika Negative',


				            					'Tangerine'=>'Tangerine',
				            					'Terminal Dosis'=>'Terminal Dosis',
				            					'Tenor Sans'=>'Tenor Sans',

				            					'Varela Round'=>'Varela Round',
				            					
				            					'Yellowtail'=>'Yellowtail',

				            					
				            					));
				            					
$avia_elements[] =	array(	"name" 	=> "Defines the Font for your body text",
							"slug"	=> "styling",
							"desc" 	=> "Choose between web save fonts (faster rendering) and google webkit fonts (more unqiue)",
				            "id" 	=> "default_font",
				            "type" 	=> "select",
				            "no_first" => true,
				            "class" => "av_2columns av_col_2",
				            "onchange" => "avia_add_google_font",
				            "std" 	=> "Helvetica-Neue,Helvetica-websave",
				            "subtype" => array(	':: :: Web save fonts :: ::'=>'',
				            					'Arial'=>'Arial-websave',
				            					'Georgia'=>'Georgia-websave',
				            					'Verdana'=>'Verdana-websave',
				            					'Helvetica'=>'Helvetica-websave',
				            					'Helvetica Neue'=>'Helvetica-Neue,Helvetica-websave',
				            					'Lucida'=>'"Lucida-Sans",-"Lucida-Grande",-"Lucida-Sans-Unicode-websave"',
				            					':: :: Google fonts :: ::'=>'',
				            					'Arimo'=>'Arimo',
				            					'Cardo'=>'Cardo',
				            					'Droid Sans'=>'Droid Sans',
				            					'Droid Serif'=>'Droid Serif',
				            					'Kameron'=>'Kameron',
				            					'Maven Pro'=>'Maven Pro',
				            					'Open Sans'=>'Open Sans',
				            					'Lora'=>'Lora',
				            					
				            					));				            					
	
	
$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_end", "id" => "avia_tab1_end", "nodescription" => true);		            					



//create color sets for #header, Main Content, Secondary Content, Footer, Socket, Slideshow

$colorsets = $avia_config['color_sets'];
$iterator = 1;

foreach($colorsets as $set_key => $set_value)
{
	$iterator ++;
	
	$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "avia_tab".$iterator, "nodescription" => true, 'class'=>'avia_tab avia_tab'.$iterator,'name'=>$set_value);
	
	$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "$set_value background color",
					"id" 	=> "colorset-$set_key-bg",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#ffffff",
					"desc" 	=> "Default Background color",
					"target" => array("default_slideshow_target::.live-$set_key::background-color"),
					);				
	
	$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Alternate Background color",
					"desc" 	=> "Alternate Background for menu hover, tables etc",
					"id" 	=> "colorset-$set_key-bg2",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#f8f8f8",
					"target" => array("default_slideshow_target::.live-$set_key .bg2::background-color"),
					);
	
	$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Primary color",
					"desc" 	=> "Font color for links, dropcaps and other elements",
					"id" 	=> "colorset-$set_key-primary",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#719430",
					"target" => array("default_slideshow_target::.live-$set_key .a_link, .live-$set_key-wrap-top::color,border-color"),
					);	


	$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Highlight color",
					"desc" 	=> "Secondary color for link and button hover, etc<br/>",
					"id" 	=> "colorset-$set_key-secondary",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#8bba34",
					"target" => "default_slideshow_target::.live-$set_key .an_activelink::color",
					);
	
					
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "$set_value font color",
						"id" 	=> "colorset-$set_key-color",
						"type" 	=> "colorpicker",
						"class" => "av_2columns av_col_1",
						"std" 	=> "#666666",
						"target" => array("default_slideshow_target::.live-$set_key::color"),
						);	
	
	$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Border colors ",
					"id" 	=> "colorset-$set_key-border",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#e1e1e1",
					"target" => array("default_slideshow_target::.live-$set_key.border, .live-$set_key .bg2::border-color"),
					);
					
					

					
	
	
	$avia_elements[] = array(	"slug"	=> "styling", "type" => "hr", "id" => "hr".$set_key, "nodescription" => true);				
										
	$avia_elements[] = array(	
						"slug"	=> "styling",
						"id" 	=> "colorset-$set_key-img",
						"name" 	=> "Background Image",
						"desc" 	=> "The background image of your $set_value<br/><br/>",
						"type" 	=> "select",
						"subtype" => array('No Background Image'=>'','Upload custom image'=>'custom','----------------------'=>''),
						"std" 	=> "",
						"no_first"=>true,
						"class" => "av_2columns av_col_1",
						"target" => array("default_slideshow_target::.live-$set_key::background-image"),
						"folder" => "images/background-images/",
						"folderlabel" => "");					
						
					
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Custom Background Image",
						"desc" 	=> "Upload a BG image for your $set_value<br/><br/>",
						"id" 	=> "colorset-$set_key-customimage",
						"type" 	=> "upload",
						"std" 	=> "",
						"class" => "set_blank_on_hide av_2columns av_col_2",
						"label"	=> "Use Image",
						"required" => array("colorset-$set_key-img",'custom'),
						"target" => array("default_slideshow_target::.live-$set_key::background-image"),
						);
						
			 					
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Position of the image",
						"desc" 	=> "",
						"id" 	=> "colorset-$set_key-pos",
						"type" 	=> "select",
						"std" 	=> "top left",
						"no_first"=>true,
						"class" => "av_2columns av_col_1",
						"required" => array("colorset-$set_key-img",'{true}'),
						"target" => array("default_slideshow_target::.live-$set_key::background-position"),
						"subtype" => array('Top Left'=>'top left','Top Center'=>'top center','Top Right'=>'top right', 'Bottom Left'=>'bottom left','Bottom Center'=>'bottom center','Bottom Right'=>'bottom right', 'Center Left '=>'center left','Center Center'=>'center center','Center Right'=>'center right'));
						
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Repeat",
						"desc" 	=> "",
						"id" 	=> "colorset-$set_key-repeat",
						"type" 	=> "select",
						"std" 	=> "no-repeat",
						"class" => "av_2columns av_col_2",
						"no_first"=>true,
						"required" => array("colorset-$set_key-img",'{true}'),
						"target" => array("default_slideshow_target::.live-$set_key::background-repeat"),
						"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y'));
						
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Attachment",
						"desc" 	=> "",
						"id" 	=> "colorset-$set_key-attach",
						"type" 	=> "select",
						"std" 	=> "scroll",
						"class" => "av_2columns av_col_1",
						"no_first"=>true,
						"required" => array("colorset-$set_key-img",'{true}'),
						"target" => array("default_slideshow_target::.live-$set_key::background-attachment"),
						"subtype" => array('Scroll'=>'scroll','Fixed'=>'fixed'));	
		
	
	
	



	$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_end", "id" => "avia_tab_end".$iterator, "nodescription" => true);	
}

	


$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "avia_tab5", "nodescription" => true, 'class'=>'avia_tab avia_tab2','name'=>'Background');

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Use stretched or boxed layout?",
					"desc" 	=> "The stretched layout expands from the left side of the viewport to the right.",
					"id" 	=> "color-body_style",
					"type" 	=> "select",
					"std" 	=> "stretched",
					"no_first"=>true,
					"class" => "av_2columns av_col_1",
					"target" => array("default_slideshow_target::.avia_control_container::set_id"),
					"subtype" => array('Stretched layout'=>'stretched','Boxed Layout'=>'boxed'));


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Background color",
					"desc" 	=> "Background color for your site<br/><br/>",
					"id" 	=> "color-body_color",
					"type" 	=> "colorpicker",
					"std" 	=> "#eeeeee",
					"class" => "av_2columns av_col_2",
					//"required" => array("color-body_style",'boxed'),
					"target" => array("default_slideshow_target::.live_bg_wrap::background-color"),
					);	
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Background color",
					"desc" 	=> "Background color for your site<br/><br/>",
					"id" 	=> "color-body_fontcolor",
					"type" 	=> "colorpicker",
					"std" 	=> "#ffffff",
					"class" => "av_2columns av_col_1",
					//"required" => array("color-body_style",'boxed'),
					"target" => array("default_slideshow_target::.text_small_outside::color"),
					);	
					

	$avia_elements[] = array(	"slug"	=> "styling", "type" => "hr", "id" => "hr".$set_key, "nodescription" => true);				
										
	$avia_elements[] = array(	
						"slug"	=> "styling",
						"id" 	=> "color-body_img",
						"name" 	=> "Background Image",
						"desc" 	=> "The background image of your Body<br/><br/>",
						"type" 	=> "select",
						"subtype" => array('No Background Image'=>'','Upload custom image'=>'custom','----------------------'=>''),
						"std" 	=> "",
						"no_first"=>true,
						"class" => "av_2columns av_col_1 set_blank_on_hide",
						"target" => array("default_slideshow_target::.live_bg_wrap::background-image"),
						"folder" => "images/background-images/",
						//"required" => array("color-body_style",'boxed'),
						"folderlabel" => "");					
						
					
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Custom Background Image",
						"desc" 	=> "Upload a BG image for your Body<br/><br/>",
						"id" 	=> "color-body_customimage",
						"type" 	=> "upload",
						"std" 	=> "",
						"class" => "set_blank_on_hide av_2columns av_col_2",
						"label"	=> "Use Image",
						"required" => array("color-body_img",'custom'),
						"target" => array("default_slideshow_target::.live_bg_wrap::background-image"),
						);
						
			 					
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Position of the image",
						"desc" 	=> "",
						"id" 	=> "color-body_pos",
						"type" 	=> "select",
						"std" 	=> "top left",
						"no_first"=>true,
						"class" => "av_2columns av_col_1",
						"required" => array("color-body_img",'{true}'),
						"target" => array("default_slideshow_target::.live_bg_wrap::background-position"),
						"subtype" => array('Top Left'=>'top left','Top Center'=>'top center','Top Right'=>'top right', 'Bottom Left'=>'bottom left','Bottom Center'=>'bottom center','Bottom Right'=>'bottom right', 'Center Left '=>'center left','Center Center'=>'center center','Center Right'=>'center right'));
						
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Repeat",
						"desc" 	=> "",
						"id" 	=> "color-body_repeat",
						"type" 	=> "select",
						"std" 	=> "no-repeat",
						"class" => "av_2columns av_col_2",
						"no_first"=>true,
						"required" => array("color-body_img",'{true}'),
						"target" => array("default_slideshow_target::.live_bg_wrap::background-repeat"),
						"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y', 'Stretch Fullscreen'=>'fullscreen'));
						
	$avia_elements[] =	array(	
						"slug"	=> "styling",
						"name" 	=> "Attachment",
						"desc" 	=> "",
						"id" 	=> "color-body_attach",
						"type" 	=> "select",
						"std" 	=> "scroll",
						"class" => "av_2columns av_col_1",
						"no_first"=>true,
						"required" => array("color-body_img",'{true}'),
						"target" => array("default_slideshow_target::.live_bg_wrap::background-attachment"),
						"subtype" => array('Scroll'=>'scroll','Fixed'=>'fixed'));	

									
$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_end", "id" => "avia_tab5_end", "nodescription" => true);	

$avia_elements[] = array(	"slug"	=> "styling", "type" => "visual_group_end", "id" => "avia_tab_container_end", "nodescription" => true);				


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
					"name" 	=> "Responsive Layout",
					"desc" 	=> "By default the theme adapts to the screen size of the visitor and uses a layout best suited. You can disable this behavior so the theme will only show the default layout without adaptation",
					"id" 	=> "responsive_layout",
					"type" 	=> "select",
					"std" 	=> "responsive",
					"no_first"=>true,
					"subtype" => array( 'Responsive Layout' =>'responsive',
										'Fixed layout'=>'static_layout',
										));


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Websave fonts fallback for Windows",
					"desc" 	=> "Older Browsers on Windows dont render custom fonts as smooth as modern ones. If you want to force websave fonts instead of custom fonts for those browsers activate the setting here (affects older versions of IE, Firefox and Opera)",
					"id" 	=> "websave_windows",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Not activated' =>'',
										'Activated'=>'active',
										));
										
															

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Blog Layout",
					"desc" 	=> "Choose the default blog layout here. You can create multiple blogs with different layouts by using the template builder if you want to",
					"id" 	=> "blog_layout",
					"type" 	=> "select",
					"std" 	=> "sidebar_right",
					"no_first"=>true,
					"subtype" => array( 'left sidebar' =>'sidebar_left',
										'right sidebar'=>'sidebar_right',
										/* 'no sidebar'=>'fullsize' */
										));



$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Page Layout",
					"desc" 	=> "Choose the default page layout here. You can change the setting of each individual page when editing that page",
					"id" 	=> "page_layout",
					"type" 	=> "select",
					"std" 	=> "sidebar_right",
					"no_first"=>true,
					"subtype" => array( 'left sidebar' =>'sidebar_left',
										'right sidebar'=>'sidebar_right',
										'no sidebar'=>'fullsize' 
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


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Slideshow behavior on overview pages",
					"desc" 	=> "The default setting is: overview pages (eg Blog, Portfolio Overview) display the whole slideshow for each post. <br/><br/>You can change this so that overview pages always only display a single image. Only single entries will then show the whole slideshow",
					"id" 	=> "slideshow_poster",
					"type" 	=> "select",
					"std" 	=> "true",
					"no_first"=>true,
					"subtype" => array( 'Display default slideshow on overview pages and on single entries'=>'',
										'Display only single image on overview pages and all slideshow images on single entries' => "single",
										'Display only single image on overview pages and all slideshow images except the first one on single entries' => "poster",
										));	


/*portfolio settings*/

	
$avia_elements[] =	array(		
					"slug"	=> "portfolio",
					"name" 	=> "Enter a page slug that should be used for your portfolio single items",
					"desc" 	=> "For example if you enter 'portfolio-item' the link to the item will be <strong>".home_url().'/portfolio-item/post-name</strong><br/><br/>Dont use characters that are not allowed in urls and make sure that this slug is not used anywere else on your site (for example as a category or a page)',
					"id" 	=> "portfolio-slug",
					"std" 	=> "portfolio-item",
					"type" 	=> "text");

$avia_elements[] =	array(	"name" => "Add new portfolio meta fields",
							"desc" => "The Portfolio Meta fields hold extra information for your portfolio entries. Define the available Meta fields here, <a href='".admin_url('edit.php?post_type=portfolio')."'>then write/edit a portfolio entry</a> and you will notice the additional fields that allow you to enter extra information.",
							"std" => "",
							"slug"	=> "portfolio",
							"type" => "heading",
							"nodescription"=>true);

$avia_elements[] =	array(	
				"slug"			=> "portfolio",
				"type" 			=> "group", 
				"id" 			=> "portfolio-meta", 
				"linktext" 		=> "Add another Meta Field",
				"deletetext" 	=> "Remove Meta Field",
				"blank" 		=> true, 
				"std"			=> array(
										array('meta'=>'Skills Needed'),
										array('meta'=>'Client'),
										array('meta'=>'Project URL'),
										),
				'subelements' 	=> array(	
						
							array(	
							"name" 	=> "Portfolio Meta Field:",
							"slug"	=> "portfolio",
							"desc" 	=> "",
							"id" 	=> "meta",
							"std" 	=> "",
							"type" 	=> "text"),
 
				),	           
					           
			);

$avia_elements[] =	array(	"name" => "Add new portfolios",
							"desc" => "Here you can add new portfolio overview pages with multiple columns of portfolio Items. Before you start adding options here, please create a new blank page and save it. Afterwards return to this page and apply the portfolio overview page you want to create to that page.",
							"std" => "",
							"slug"	=> "portfolio",
							"type" => "heading",
							"nodescription"=>true);

				
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
								"desc" 	=> "Please choose the page that should serve as portfolio overview page<br/><br/>",
					            "id" 	=> "portfolio_page",
					            "type" 	=> "select",
								"class" => "av_2columns av_col_1",
					            "subtype" => "page"),
					            
					    array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Details?",
								"desc" 	=> "Should the portfolio details be opened on the same page when someone clicks a portfolio item?<br/><br/>",
								"id" 	=> "portfolio_ajax_class",
								"type" 	=> "select",
								"std" 	=> "ajax_portfolio_container",
								"no_first"=>true,
								"class" => "av_2columns av_col_2",
								"subtype" => array( 'Yes, on the same page - known as AJAX Portfolio'=>'ajax_portfolio_container',
													'No, open entries on a single page'=>'')),
					            
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Columns",
								"desc" 	=> "How many columns should be displayed? Should a sidebar be displayed as well?<br/><br/>",
								"id" 	=> "portfolio_columns",
								"type" 	=> "select",
								"class" => "av_2columns av_col_1",
								"no_first"=>true,
								"std" 	=> "4",
								"subtype" => array(	'1 Column'=>'1',
													'2 Columns'=>'2',
													'3 Columns'=>'3',
													'4 Columns'=>'4',
													)),
								
						array(	
							"slug"	=> "layout",
							"name" 	=> "Portfolio Page Layout",
							"desc" 	=> "Choose the portfolio layout here. This will overwrite any individual page settings<br/><br/>",
							"id" 	=> "portfolio_layout",
							"type" 	=> "select",
							"std" 	=> "fullsize",
								"class" => "av_2columns av_col_2",
							"no_first"=>true,
							"subtype" => array( 'left sidebar' =>'sidebar_left',
												'right sidebar'=>'sidebar_right',
												'no sidebar'=>'fullsize' 
												)),
			
			
			
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Post Number",
								"desc" 	=> "How many items should be displayed per page?<br/><br/>",
								"id" 	=> "portfolio_item_count",
								"type" 	=> "select",
								"std" 	=> "16",
								"no_first"=>true,
								"class" => "av_2columns av_col_1",
								"subtype" => $itemcount),
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Title and Excerpt",
								"desc" 	=> "Display Title and Excerpt of entry?<br/><br/>",
								"id" 	=> "portfolio_text",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"class" => "av_2columns av_col_2",
								"subtype" => array('yes'=>'yes','no'=>'no')),	
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Sortable?",
								"desc" 	=> "Should the sorting options based on categories be displayed?<br/><br/>",
								"id" 	=> "portfolio_sorting",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"class" => "av_2columns av_col_1",
								"subtype" => array('yes'=>'yes','no'=>'no')),
								
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Pagination",
								"desc" 	=> "Should a portfolio pagination be displayed?<br/><br/><br/>",
								"id" 	=> "portfolio_pagination",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"class" => "av_2columns av_col_2",
								"subtype" => array('yes'=>'yes','no'=>'no')),
	
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
					"slug"	=> "contact",
					"name" 	=> "Autoresponder",
					"desc" 	=> "Enter a message that will be sent to the users email adress once he has submitted the form. If left empty no autoresponse will be sent. <br/>Please make sure to not delete the Email Field bellow, otherwise the script wont be able to send a mail",
					"id" 	=> "autoresponder",
					"std" 	=> "",
					"type" 	=> "textarea"
					);			


		
			
$avia_elements[] =	array(	
						"slug"	=> "contact",
						"name" 	=> "Contact Form Captcha",
						"desc" 	=> "Do you want to display a captcha field at the end of the form so users must prove they are human by solving a simply mathematical question? (It is recommended to only activate this if you receive spam from your contact form, since an invisible spam protection is also implemented that should filter most spam messages by robots anyways)",
						"id" 	=> "contact-form-captcha",
						"type" 	=> "select",
						"std" 	=> "",
						"no_first"=>true,
						"subtype" => array('Dont display Captcha'=>'', 'Display Captcha'=>'active')
					);				
			
			
$avia_elements[] =	array(	"name" => "Add new form elements to your contact form:",
							"desc" => "Here you can add, remove and edit the form Elements of your contact form. You can choose to display single line input elements, textareas, checkboxes and select dropdown menus. You also have the option to validate these options. It is recommended to not delete the 'E-Mail' field if you want to use an auto responder.",
							"id" => "contactformdescription",
							"std" => "",
							"slug"	=> "contact",
							"type" => "heading",
							"nodescription"=>true);

$avia_elements[] =	array(	
				"slug"			=> "contact",
				"type" 			=> "group", 
				"id" 			=> "contact-form-elements", 
				"linktext" 		=> "Add another Form Element",
				"deletetext" 	=> "Remove Form Element",
				"blank" 		=> true, 
				"nodescription" => true,
				"std"			=> array(
										array('label'=>'Name', 'type'=>'text', 'check'=>'is_empty'),
										array('label'=>'E-Mail', 'type'=>'text', 'check'=>'is_email'),
										array('label'=>'Subject', 'type'=>'text', 'check'=>'is_empty'),
										array('label'=>'Priority', 'type'=>'select', 'check'=>'', 'options'=>'Low, Medium, High, Urgent as Hell, ASAP DUDE!!!'),
										array('label'=>'Message', 'type'=>'textarea', 'check'=>'is_empty'),
										array('label'=>'I have read the general terms and conditions and I agree!', 'type'=>'checkbox', 'check'=>'is_empty'),
										),
				'subelements' 	=> array(	
						
							array(	
							"name" 	=> "Form Element Label",
							"slug"	=> "contact",
							"desc" 	=> "",
							"class" => "av_3columns av_col_1",
							"id" 	=> "label",
							"std" 	=> "",
							"type" 	=> "text"),
					        
					           
					        array(	
						"slug"	=> "contact",
						"name" 	=> "Form Element Type",
						"desc" 	=> "",
						"class" => "av_3columns av_col_2",
						"id" 	=> "type",
						"type" 	=> "select",
						"std" 	=> "text",
						"no_first"=>true,
						"subtype" => array('Text input'=>'text', 'Text Area'=>'textarea', 'Select Element'=>'select',  'Checkbox'=>'checkbox')),    
						
						    array(	
						"slug"	=> "contact",
						"name" 	=> "Form Element Validation",
						"desc" 	=> "",
						"id" 	=> "check",
						"type" 	=> "select",
						"class" => "av_3columns av_col_3",
						"std" 	=> "",
						"no_first"=>true,
						"subtype" => array('No Validation'=>'', 'Is not empty'=>'is_empty', 'Valid Mail adress'=>'is_email', 'Valid Phone Number'=>'is_phone', 'Valid Number'=>'is_number')), 
						
						array(	
							"name" 	=> "Form Element Options",
							"slug"	=> "contact",
							"desc" 	=> "Enter any number of options that the visitor can choose from. Separate these Options with a comma. <br/>Example: Option 1, Option 2, Option 3",
							"id" 	=> "options",
							"required" => array('type','select'),
							"std" 	=> "",
							"type" 	=> "text"),   
				),	           
					           
			);

			



			
			



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


										
$avia_elements[] =	array(	
					"slug"	=> "footer",
					"name" 	=> "Footer Columns",
					"desc" 	=> "How many colmns should be diplayed in your footer",
					"id" 	=> "footer_columns",
					"type" 	=> "select",
					"std" 	=> "4",
					"subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'));	

					
$avia_elements[] =	array(	
			"name" 	=> "Footer Contact Info",
			"slug"	=> "footer",
			"desc" 	=> "Phone Number, link to Contact form or mail adress. Whatever you prefer ;)",
			"id" 	=> "footer_arrow",
			"std" 	=> "Need help? <a href='#'>Mail Us!</a>",
			"type" 	=> "text");					
				
					

######################################################################
# TEMPLATE BUILDER
######################################################################


$avia_elements[] 	=		array(	"name" => "How does this work?",
							"desc" => "
							<p>It only takes a few simple steps to create any number of unique page layouts with the template builder. The description bellow is just a short intro on how it works, you can read more about it in the documentation</p>
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
										"std" 	=> "fullsize",
										"class" => "av_2columns av_col_1",
										"no_first"=>true,
										"subtype" => array( 'left sidebar' =>'sidebar_left',
															'right sidebar'=>'sidebar_right',
															'no sidebar'=>'fullsize' 
															)),
										array(	
										"slug"	=> "templates",
										"name" 	=> "Display Title?",
										"desc" 	=> "Should the Template display Title and Breadcumb Navigation at the top of the page?",
										"id" 	=> "dynamic_title",
										"type" 	=> "select",
										"std" 	=> "no",
										"class" => "av_2columns av_col_2",
										"no_first"=>true,
										"subtype" => array( 'Yes' =>'yes',
															'No'=>'no',
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



