<?php


//avia pages holds the data necessary for backend page creation
$avia_pages = array( 
	
	array( 'slug' => 'avia', 		'parent'=>'avia', 'icon'=>"hammer_screwdriver.png" , 	'title' =>  'Theme Options' ),
	array( 'slug' => 'styling', 	'parent'=>'avia', 'icon'=>"palette.png", 				'title' =>  'Styling'  ),
	array( 'slug' => 'layout', 		'parent'=>'avia', 'icon'=>"blueprint_horizontal.png", 	'title' =>  'Layout &amp; Settings'  ),
	array( 'slug' => 'portfolio', 	'parent'=>'avia', 'icon'=>"photo_album.png" , 			'title' =>  'Portfolio' ),
	array( 'slug' => 'contact', 	'parent'=>'avia', 'icon'=>"book_addresses.png" , 		'title' =>  'Contact' ),
	array( 'slug' => 'sidebar', 	'parent'=>'avia', 'icon'=>"layout_select_sidebar.png", 	'title' =>  'Sidebar'  ),
	array( 'slug' => 'footer', 		'parent'=>'avia', 'icon'=>"layout_select_footer.png", 	'title' =>  'Footer'  ),
					 
);





/*Frontpage Settings*/


					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Import Dummy Content: Posts, Pages, Categories",
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
					"name" 	=> "Favicon",
					"desc" 	=> "Specify a <a href='http://en.wikipedia.org/wiki/Favicon'>favicon</a> for your site. <br/>Accepted formats: .ico, .png, .gif",
					"id" 	=> "favicon",
					"type" 	=> "upload",
					"label"	=> "Use Image as Favicon");

$avia_elements[] =	array(
			"name" 	=> "Your facebook page/group/account",
			"desc" 	=> "Enter the url to your facebook page/group/account. If you leave this blank the facebook link in the head of your site wont be displayed.",
			"id" 	=> "facebook",
			"slug"	=> "avia",
			"std" 	=> "http://www.facebook.com/kriesi.at",
			"type" 	=> "text");

$avia_elements[] =	array(
			"name" 	=> "Your google plus account",
			"desc" 	=> "Enter the url to your google plus page/group/account. If you leave this blank the google plus link in the head of your site wont be displayed.",
			"id" 	=> "gplus",
			"slug"	=> "avia",
			"std" 	=> "https://plus.google.com/106461359737856957875/posts",
			"type" 	=> "text");
			
	
$avia_elements[] =	array(	
			"name" 	=> "Your twitter account",
			"slug"	=> "avia",
			"desc" 	=> "Enter your twitter account name. If you leave this blank the twitter link in the head of your site wont be displayed.",
			"id" 	=> "twitter",
			"std" 	=> "envato",
			"type" 	=> "text");
			
$avia_elements[] =	array(	
			"name" 	=> "Your dribbble account",
			"slug"	=> "avia",
			"desc" 	=> "Enter your dribbble account name. If you leave this blank the dribbble link in the head of your site wont be displayed.",
			"id" 	=> "dribbble",
			"std" 	=> "Kriesi",
			"type" 	=> "text");
			
$avia_elements[] =	array(
			"name" 	=> "Your LinkedIn account",
			"desc" 	=> "Enter the url to your linkedin profile. If you leave this blank the linkedin link in the head of your site wont be displayed.",
			"id" 	=> "linkedin",
			"slug"	=> "avia",
			"std" 	=> "",
			"type" 	=> "text");
			
$avia_elements[] =	array(	
			"name" 	=> "RSS feed url",
			"slug"	=> "avia",
			"desc" 	=> "If you want to use a service like feedburner enter the feed url here. Otherwise the default wordpress feed url will be used",
			"id" 	=> "feedburner",
			"std" 	=> "",
			"type" 	=> "text");
			
					
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
						#avia_preview{position:relative;}
						.live_bg_wrap_top{border-bottom:20px solid; position:relative; top:1px;display:none;}
						.live_bg_default{border:1px solid; width: 370px;}
						.live_sidebar{position:absolute; left:414px; top:23px; height:305px; background:#fff; padding:10px; width:131px; z-index:1;}
						.live_bg, .live_bg_default{padding:10px; position:relative; z-index:5;}
						.live_bg_wrap{ padding:4%; background:#f8f8f8; overflow:hidden; border:1px solid #e1e1e1; background-position: top center;}
						.live_bg_default{background:#transparent; color:#777;}
						.live_bg_default h3{font-size:30px;}
						.live_bg_highlight{height:20px; line-height:20px; padding:5px; border:1px solid;}
						.live_bg_default{}
						.live_bg_socket{height:20px; line-height:20px; padding:10px; clear:both;}
						.live_bg_small{font-size:10px; color:#999;}
						#avia_preview .webfont_google_webfont{  font-weight:normal; } 
						.webfont_default_font{  font-weight:normal; font-size:14px; line-height:1.7em;} 
						div .link_controller_list a{ width:115px; font-size:11px; }
						.live_portfolio_wrap{display:block; overflow:hidden; clear:both; margin-bottom:10px;}
						.live_portfolio_item{float:left; width:49%; height:120px; margin-right:1px; background-color:#333; border:1px solid #e1e1e1;}
						
						.live_portfolio_text{display:block; padding:10px;}
					</style>
					<small class='live_bg_small'>A rough preview of the frontend.</small>
					
					<div id='avia_preview' class='live_bg_wrap webfont_default_font'>
						<div class='live_bg_wrap_top'></div>
						<div class='live_sidebar'>Sidebar text</div>
						<div class='live_bg_default'>
							<h3 class='webfont_google_webfont'>Demo heading</h3>
							<p>This is default content with a default heading. Font color and text are set based on the skin you choose above. Headings and link colors can be choosen below. <br/> 
								<a class='a_link' href='#'>A link</a>  
								<a class='an_activelink' href='#'>A hovered link</a>
							</p>
							
							<div class='live_bg_highlight'>Highlight Background + Border Color</div>
							
						</div>
					
						<div class='live_bg'>
							<h3>Demo heading (Footer)</h3>
							<p>This is text on the footer background</p>
							<!--, as for example in your footer.</p><p>Text and <a href='#'>links</a> got the same color, headings are a little lighter</p>-->
						</div>
						
						<div class='live_bg_socket'>Socket Text</div>
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
					"std" 	=> "Boxed Navy",
					"class"	=> "link_controller_list",
					"subtype" => array(
										'Boxed Navy' => array(	
															'style'=>'background-color:#435960;',
															'google_webfont' => 'Signika Negative',
															'color_scheme'	=>'Boxed Navy',
															'bg_color'		=>'#1e2324',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#29383d',
															'border'		=>'#e1e1e1',
															'primary'		=>'#2e9dbf',
															'highlight'		=>'#089cc9',
															'footer_bg'		=>'#33393A',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#222829',
															'socket_font'	=>'#ffffff',
															'sidebar_bg'	=>'#222829',
															'sidebar_font'=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/ios-linen-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															
															),
										
										'Clean Orange' => array(	
															'style'=>'background-color:#f0b70c;',
															'google_webfont' => 'Questrial',
															'color_scheme'	=>'Clean Orange',
															'bg_color'		=>'#f8f8f8',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#f0b70c',
															'highlight'		=>'#edc756',
															'footer_bg'		=>'#333333',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#aaaaaa',
															'sidebar_bg'	=>'#ffffff',
															'sidebar_font'	=>'#555555',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),
										
										'Cyan' => array(	
															'style'=>'background-color:#2997ab;',
															'google_webfont' => 'Signika Negative',
															'color_scheme'	=>'Cyan',
															'bg_color'		=>'#111111',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#2997ab',
															'highlight'		=>'#23b5cf',
															'footer_bg'		=>'#0b3e47',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#0c2b30',
															'socket_font'	=>'#5f777a',
															'sidebar_bg'	=>'#ffffff',
															'sidebar_font'=>'#444444',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/diagonal-bold-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Open Sans',
															'bg_color_boxed'=>'#ffffff',
															),
															
										
										
														
										'Black/Red' => array(	
															'style'=>'background-color:#a81010;',
															'google_webfont' => 'Oswald',
															'color_scheme'	=>'Black/Red',
															'bg_color'		=>'#f8f8f8',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#a81010',
															'highlight'		=>'#eb3b3b',
															'footer_bg'		=>'#161616',
															'footer_font'	=>'#8a8a8a',
															'socket_bg'		=>'#a81010',
															'socket_font'	=>'#ffffff',
															'sidebar_bg'	=>'#000000',
															'sidebar_font'=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Arial-websave',
															'bg_color_boxed'=>'#ffffff',
															),	
										
										'White/Black' => array(	
															'style'=>'background-color:#000000;',
															'google_webfont' => 'Josefin Sans',
															'color_scheme'	=>'White/Black',
															'bg_color'		=>'#f8f8f8',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#333333',
															'border'		=>'#e1e1e1',
															'primary'		=>'#000000',
															'highlight'		=>'#23b5cf',
															'footer_bg'		=>'#000000',
															'footer_font'	=>'#8a8a8a',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#999999',
															'sidebar_bg'	=>'#ffffff',
															'sidebar_font'=>'#444444',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Georgia-websave',
															'bg_color_boxed'=>'#ffffff',
															),
									
										
										'Blue' => array(	
															'style'=>'background-color:#2d5c88;',
															'google_webfont' => 'Varela Round',
															'color_scheme'	=>'Blue',
															'bg_color'		=>'#f8f8f8',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#2d5c88',
															'highlight'		=>'#4686c2',
															'footer_bg'		=>'#333333',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#999999',
															'sidebar_bg'	=>'#183757',
															'sidebar_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),
										
										'Full Purple' => array(	
															'style'=>'background-color:#46424f;',
															'google_webfont' => 'Coda',
															'color_scheme'	=>'Purple',
															'bg_color'		=>'#46424f',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#46424f',
															'highlight'		=>'#6b5c8c',
															'footer_bg'		=>'#4d4857',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#201e24',
															'socket_font'	=>'#6f6c75',
															'sidebar_bg'	=>'#46424f',
															'sidebar_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Full Green' => array(	
															'style'=>'background-color:#719430;',
															'google_webfont' => 'Salsa',
															'color_scheme'	=>'Green',
															'bg_color'		=>'#374a15',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#719430',
															'highlight'		=>'#8bba34',
															'footer_bg'		=>'#415719',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#2a3810',
															'socket_font'	=>'#7a8568',
															'sidebar_bg'	=>'#374a15',
															'sidebar_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Lime' => array(	
															'style'=>'background-color:#aec71e;',
															'google_webfont' => 'Allerta',
															'color_scheme'	=>'Lime',
															'bg_color'		=>'#aec71e',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#aec71e',
															'highlight'		=>'#becf50',
															'footer_bg'		=>'#222222',
															'footer_font'	=>'#aaaaaa',
															'socket_bg'		=>'#aec71e',
															'socket_font'	=>'#ffffff',
															'sidebar_bg'	=>'#292929',
															'sidebar_font'=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),
								
														
															
										
										
										'Grunge Pink' => array(	
															'style'=>'background-color:#c71c77;',
															'google_webfont' => 'Mako',
															'color_scheme'	=>'Grunge Pink',
															'bg_color'		=>'#222222',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#c71c77',
															'highlight'		=>'#eb419c',
															'footer_bg'		=>'#111111',
															'footer_font'	=>'#aaaaaa',
															'socket_bg'		=>'#c71c77',
															'socket_font'	=>'#ffffff',
															'sidebar_bg'	=>'#222222',
															'sidebar_font'=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/grunge-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),
															
									
															
										'Brown Wood' => array(	
															'style'=>'background-color:#2e1f06;',
															'google_webfont' => 'News Cycle',
															'color_scheme'	=>'Brown Wood',
															'bg_color'		=>'#2e1f06',
															'bg_highlight'	=>'#ebdecd',
															'body_font'		=>'#423114',
															'border'		=>'#e8d8c3',
															'primary'		=>'#3d2b0d',
															'highlight'		=>'#ff8c00',
															'footer_bg'		=>'#2e1f08',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#3d2b0d',
															'socket_font'	=>'#ebdecd',
															'sidebar_bg'	=>'#261a06',
															'sidebar_font'=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/wood-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Open Sans',
															'bg_color_boxed'=>'#ffffff',
															),
										
										
															
										'Teal' => array(	
															'style'=>'background-color:#43605b;',
															'google_webfont' => 'Merriweather',
															'color_scheme'	=>'Boxed Teal',
															'bg_color'		=>'#f8f8f8',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#22302d',
															'border'		=>'#e1e1e1',
															'primary'		=>'#43605b',
															'highlight'		=>'#749aa6',
															'footer_bg'		=>'#314743',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#43605b',
															'socket_font'	=>'#ffffff',
															'sidebar_bg'	=>'#283b38',
															'sidebar_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/floral-dark.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),	
															
							
															
										'G+ Red' => array(	
														'style'=>'background-color:#de5a49;',
														'google_webfont' => 'Droid Sans',
														'color_scheme'	=>'G+ Red',
														'bg_color'		=>'#222222',
														'bg_highlight'	=>'#f8f8f8',
														'body_font'		=>'#777777',
														'border'		=>'#e1e1e1',
														'primary'		=>'#de5a49',
														'highlight'		=>'#bd4133',
														'footer_bg'		=>'#333333',
														'footer_font'	=>'#aaaaaa',
														'socket_bg'		=>'#de5a49',
														'socket_font'	=>'#ffffff',
														'sidebar_bg'	=>'#f8f8f8',
														'sidebar_font'	=>'#444444',
														'bg_image'		=>'',
														'bg_image_custom' => '',
														'bg_image_position' => 'left',
														'bg_image_repeat'=>'repeat',
														'bg_image_attachment'=>'fixed',
														'boxed'			=>'boxed',
														'default_font'	=>'Arial-websave',
														'bg_color_boxed'=>'#ffffff',
														),
																	
										'Fullsize Grunge' => array(	
															'style'=>'background-color:#85742e;',
															'google_webfont' => 'Signika Negative',
															'color_scheme'	=>'Fullsize Grunge',
															'bg_color'		=>'#000000',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#85742e',
															'highlight'		=>'#c2ab51',
															'footer_bg'		=>'#272727',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#999999',
															'sidebar_bg'	=>'#222222',
															'sidebar_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/fullsize-grunge.jpg',																		'bg_image_custom' => '',
															'bg_image_position' => 'center',
															'bg_image_repeat'=>'no-repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),	
															
										'Fullsize Abstract' => array(	
															'style'=>'background-color:#4e90e0;',
															'google_webfont' => 'Metrophobic',
															'color_scheme'	=>'Fullsize Abstract',
															'bg_color'		=>'#000000',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#111111',
															'highlight'		=>'#4e90e0',
															'footer_bg'		=>'#272727',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#999999',
															'sidebar_bg'	=>'#222222',
															'sidebar_font'=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/fullsize-abstract.jpg',																		'bg_image_custom' => '',
															'bg_image_position' => 'center',
															'bg_image_repeat'=>'no-repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'default_font'	=>'Helvetica-Neue,Helvetica-websave',
															'bg_color_boxed'=>'#ffffff',
															),					
																	   
					));
	


$avia_elements[] =	array(	"name" 	=> "Heading Font",
							"slug"	=> "styling",
							"desc" 	=> "The Font heading utilizes google fonts and allows you to use a wide range of custom fonts for your headings",
				            "id" 	=> "google_webfont",
				            "type" 	=> "select",
				            "no_first" => true,
				            "class" => "av_2columns av_col_1",
				            "onchange" => "avia_add_google_font",
				            "std" 	=> "Signika Negative",
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
					


	
$avia_elements[] =	array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "default_image_settings", "nodescription" => true);	


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Content Background Color",
					"desc" 	=> "Choose the background color for the boxed content area<br/><br/>",
					"id" 	=> "bg_color_boxed",
					"type" 	=> "colorpicker",
					"std" 	=> "#ffffff",
					"class" => "av_2columns av_col_1 set_blank_on_hide",
					"target" => array("default_slideshow_target::.live_bg_wrap .live_bg_default::background-color"));
										
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Highlight Background color",
					"desc" 	=> "Background color for highlighted areas on the site <br/>(eg menu hover)",
					"id" 	=> "bg_highlight",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#f8f8f8",
					"target" => array("default_slideshow_target::.live_bg_highlight::background-color"),
					);	

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Font color",
					"desc" 	=> "Default Font color. Color variations for headings and meta info is generated automatically",
					"id" 	=> "body_font",
					"type" 	=> "colorpicker",
					"std" 	=> "#29383d",
					"class" => "av_2columns av_col_1",
					"target" => array("default_slideshow_target::.live_bg_default::color"),
					);	
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Border color",
					"desc" 	=> "Color of all the borders and rulers on your site<br/><br/>",
					"id" 	=> "border",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#e1e1e1",
					"target" => array("default_slideshow_target::.live_bg_highlight, .live_bg_default::border-color"),
					);
					
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Primary color",
					"desc" 	=> "Choose a font color for links, dropcaps and a few other elements",
					"id" 	=> "primary",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#2e9dbf",
					"target" => array("default_slideshow_target::.live_bg_default .a_link, .live_bg_wrap_top::color,border-color"),
					);	

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Highlight color",
					"desc" 	=> "Choose a secondary color for link and button hover<br/><br/>",
					"id" 	=> "highlight",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#089cc9",
					"target" => "default_slideshow_target::.live_bg_default .an_activelink::color",
					);
						

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Sidebar background",
					"desc" 	=> "Choose a background Color for the sidebar",
					"id" 	=> "sidebar_bg",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#222829",
					"target" => array("default_slideshow_target::.live_sidebar::background-color"),
					);				
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Sidebarfont color",
					"desc" 	=> "Choose a font color for the sidebar",
					"id" 	=> "sidebar_font",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#ffffff",
					"target" => array("default_slideshow_target::.live_sidebar::color"),
					);	




$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Footer background color",
					"desc" 	=> "Choose a background Color for your footer",
					"id" 	=> "footer_bg",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#33393a",
					"target" => array("default_slideshow_target::.live_bg::background-color"),
					);				
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Footer font color",
					"desc" 	=> "Choose a font color for your footer",
					"id" 	=> "footer_font",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#ffffff",
					"target" => array("default_slideshow_target::.live_bg::color"),
					);	

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Socket background color",
					"desc" 	=> "Choose a background Color for your socket",
					"id" 	=> "socket_bg",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#222829",
					"target" => array("default_slideshow_target::.live_bg_socket::background-color"),
					);				
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Socket font color",
					"desc" 	=> "Choose a font color for your socket",
					"id" 	=> "socket_font",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#ffffff",
					"target" => array("default_slideshow_target::.live_bg_socket::color"),
					);						
					




					
$avia_elements[] = array(	
					"slug"	=> "styling",
					"id" 	=> "bg_image",
					"name" 	=> "Background Image",
					"desc" 	=> "This background image of your site<br/><br/>",
					"type" 	=> "select",
					"subtype" => array('No Background Image'=>'','Upload custom image'=>'custom','----------------------'=>''),
					"std" 	=> AVIA_BASE_URL.'images/background-images/ios-linen-light.png',
					"class" => "av_2columns av_col_1",
					"no_first"=>true,
					"target" => array("default_slideshow_target::.live_bg_wrap::background-image"),
					"folder" => "images/background-images/",
					"folderlabel" => "");	
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Background color",
					"desc" 	=> "Background color for your site<br/><br/>",
					"id" 	=> "bg_color",
					"type" 	=> "colorpicker",
					"std" 	=> "#1e2324",
					"class" => "av_2columns av_col_2",
					"target" => array("default_slideshow_target::.live_bg_wrap::background-color"),
					);				
					
				
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Custom Background Image",
					"desc" 	=> "Upload a background image of your site",
					"id" 	=> "bg_image_custom",
					"type" 	=> "upload",
					"std" 	=> "",
					"class" => "set_blank_on_hide",
					"label"	=> "Use Image",
					"required" => array('bg_image','custom'),
					"target" => array("default_slideshow_target::.live_bg_wrap::background-image"),
					);
			 					
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
					"std" 	=> "repeat",
					"required" => array('bg_image','{true}'),
					"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y', 'Stretch Fullscreen'=>'fullscreen'));
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Attachment",
					"desc" 	=> "",
					"id" 	=> "bg_image_attachment",
					"type" 	=> "select",
					"std" 	=> "fixed",
					"required" => array('bg_image','{true}'),
					"subtype" => array('Scroll'=>'scroll','Fixed'=>'fixed'));


										
$avia_elements[] =	array(	"slug"	=> "styling", "type" => "visual_group_end", "nodescription" => true);	

					


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
					"name" 	=> "Default Site Layout",
					"desc" 	=> "Choose the default blog layout here. You can create multiple blogs with different layouts by using the template builder if you want to",
					"id" 	=> "blog_layout",
					"type" 	=> "select",
					"std" 	=> "right_sidebar",
					"no_first"=>true,
					"subtype" => array( 'left sidebar' =>'left_sidebar',
										'right sidebar'=>'right_sidebar',
										/* 'no sidebar'=>'sidebar_class|zero : content_class|twelve alpha : layout|fullsize' */
										));


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Slideshow behavior on overview pages",
					"desc" 	=> "Change this setting to control how Overview pages (pages with multiple posts: eg Blog, Portfolio Overview) display the whole slideshow for each post. <br/><br/>You can change this so that overview pages always only display a single image. Only single entries will then show the whole slideshow",
					"id" 	=> "slideshow_poster",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Display default slideshow on overview pages and on single entries'=>'',
										'Display only single image on overview pages and all slideshow images on single entries' => "single",
										'Display only single image on overview pages and all slideshow images except the first one on single entries' => "poster",
										));	

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Category Layout",
					"desc" 	=> "Display full Content or only an excerpt on category pages (applies only to Post Format: Standard)",
					"id" 	=> "cat_layout",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Full Post' =>'',
										'Excerpt'=>'excerpt',
										/* 'no sidebar'=>'sidebar_class|zero : content_class|twelve alpha : layout|fullsize' */
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


$avia_elements[] =	array(	"name" => "Add new portfolio pages",
							"desc" => "Here you can choose normal pages that you have already created, and convert them to portfolio overview pages: pages that show preview images of multiple portfolio entries.",
							"std" => "",
							"slug"	=> "portfolio",
							"type" => "heading",
							"nodescription"=>true);
	
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
								"desc" 	=> "How many columns should be displayed? Should a sidebar be displayed as well?",
								"id" 	=> "portfolio_columns",
								"type" 	=> "select",
								"std" 	=> "4",
								"subtype" => array(	'1 Column'=>'1',
													'2 Columns'=>'2',
													'3 Columns'=>'3',
													)),
			
			
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Post Number",
								"desc" 	=> "How many items should be displayed per page?",
								"id" 	=> "portfolio_item_count",
								"type" 	=> "select",
								"std" 	=> "12",
								"subtype" => $itemcount),

						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Sortable?",
								"desc" 	=> "Should the sorting options based on categories be displayed?",
								"id" 	=> "portfolio_sorting",
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
								"subtype" => array('yes'=>'yes','no'=>'no')),
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Width",
								"desc" 	=> "Select the portfolio width",
								"id" 	=> "portfolio_width",
								"type" 	=> "select",
								"std" 	=> "small_element",
								"no_first"=>true,
								"subtype" => array('Small'=>'small_element','Large'=>'large_element')),
	
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
										array('label'=>'Budget', 'type'=>'select', 'check'=>'', 'options'=>'500$ - 1000$, 1000$ - 2500$, 2500$ - 5000$, 5000$ and higher'),
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
						"subtype" => array('No Validation'=>'', 'Is not empty'=>'is_empty', 'Valid Mail adress'=>'is_email')), 
						
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




