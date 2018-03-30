<?php

//avia pages holds the data necessary for backend page creation
$boxes = array( 
	array( 'title' =>  'Layout Options', 'id'=>'page_layout' , 'page'=>array('post','page','portfolio'), 'context'=>'side', 'priority'=>'low' ),
	array( 'title' =>  'Layout Options', 'id'=>'product_layout' , 'page'=>array('product'), 'context'=>'side', 'priority'=>'low' ),
	array( 'title' =>  'Gallery Options','id'=>'gallery', 'page'=>array('post','page','portfolio','product'), 'context'=>'normal', 'priority'=>'high' )
);


$elements = array(
		/*Featue Image & slideshow */
		array(	"name" 	=>  "Image Gallery",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "gallery",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>false,
							'subelements' 	=> array(	
							
							array(	"name" 	=> "Image Gallery",
							"desc" 	=> 	"",
							"id" 	=>  "slideshow_image",
							"type" 	=> "gallery_image",
							"slug"  => "gallery",
							"nodescription" => true,
							"subtype" => "advanced",
							"label"	=> "Insert"),
									
							
							array(	"slug"	=> "gallery", "type" => "visual_group_start", "id" => "avia_tab1", "nodescription" => true, 'class'=>'avia_tab_container'),
								
								
								array(	"slug"	=> "gallery", "type" => "visual_group_start", "id" => "avia_tab1", "nodescription" => true, 'class'=>'avia_tab avia_tab1','name'=>'Default Options'),
	
								array(	"name" 	=> "Caption Title",
										"slug"  => "gallery",
										"class" => "av_2columns av_col_1",
										"desc" 	=> "",
										"id" 	=> "slideshow_caption_title",
										"type" 	=> "text" ),
										
								array(	"name" 	=> "Caption Text",
										"slug"  => "gallery",
										"class" => "av_2columns av_col_2",
										"desc" 	=> "",
							            "id" 	=> "slideshow_caption",
							            "type" 	=> "textarea" ),
							   
							            
							    array(	"slug"	=> "gallery", "type" => "visual_group_end", "id" => "avia_tab1_end", "nodescription" => true),
							    
							    
							    							    
							   
							   
							  array(	"slug"	=> "gallery", "type" => "visual_group_end", "id" => "avia_tab_container_end", "nodescription" => true),
	
							)
						),
						
						
		/*
array(	"name" 	=> "Image Gallery",
				"desc" 	=> "Upload any number of images. Those images will be converted to a gallery automatically and displayed the way you choose at the Gallery Layout settings bellow<br/>If no Gallery Pictures are uploaded the default background picture set in your <a href='admin.php?page=avia#goto_general_settings'>Theme Settings</a> will be displayed.",
				"id" 	=> "gallery_image",
				"type" 	=> "upload",
				"slug"  => "gallery",
				"subtype" => "advanced",
				"button-label" => "Upload",
				"label"	=> "Update Gallery",
				"attachment-prefix"=>'smart-gallery-of-post-'),
*/
				
			array(	"id" 	=> "gallery_image",
				"type" 	=> "hidden",
				"slug"  => "gallery"),			
				
	
	array(	"slug"	=> "gallery", "type" => "visual_group_start", "id" => "visual_group_meta1_start", "nodescription" => true, 'class'=>'avia_meta_default_boxed'),
	array(	
				"slug"	=> "gallery",
				"name" 	=> "Gallery Layout",
				"desc" 	=> "Please choose how to display the images in the gallery above",
				"id" 	=> "gallery_layout",
				"type" 	=> "select",
				"std" 	=> "bg_gallery",
				"no_first"=>true,
				"subtype" => array( 'As background slider only' => "bg_gallery",
									'Image list attached to the entry' =>"fixed attached_images bg_gallery",
									'Image Slideshow at the top of the entry' =>"fixed thumbslider bg_gallery",
									'Flexible Grid Gallery' =>'flexible masonry',
									'3 Column Gallery' =>'three_columns',
									'Wordpress Default Gallery attached to the entry' =>'gallery_shortcode',
									)),
									
		array(	
		"name" 	=> "<br/>Slideshow Autorotation",
		"desc" 	=> "Here you can set the autorotation timer of your inline slideshow.",
		"id" 	=> "inline_slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "false",
		"no_first" => true,
		"slug"  => "gallery",
		"required" => array('gallery_layout','fixed thumbslider bg_gallery'),
		"subtype" => 
		array('no autoroation'=>'false','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),
		
		
		array(	
		"name" 	=> "<br/>Enforce Default Background?",
		"desc" 	=> "Usually the first image of this entries gallery will be displayed as background image. You can change that and use your default background image/gallery that you have set in your <a href='admin.php?page=avia#goto_general_settings'>".THEMENAME." &raquo; General Settings</a> instead",
		"id" 	=> "bg_gallery_use_default",
		"type" 	=> "select",
		"std" 	=> "",
		"no_first" => true,
		"slug"  => "gallery",
		"required" => array('gallery_layout','{contains}s'),
		"subtype" => 
		array('Use this gallery as background'=>"", 'Use the default gallery as background'=>'default')),
									
									
	array(	"slug"	=> "gallery", "type" => "visual_group_end", "id" => "visual_group_meta1_end"),
	
		array(	
				"slug"	=> "gallery",
				"name" 	=> "Background Gallery controlls",
				"desc" 	=> "Here you can choose to remove the controls for the background gallery at the bottom of the sidebar, so the user can no longer manually control the background slides",
				"id" 	=> "gallery_controlls",
				"type" 	=> "select",
				"std" 	=> "show",
				"no_first"=>true,
				"subtype" => array( 'Show controlls' => "show",
									'Hide controlls' => "hide"
			)),


	array(	
		"name" 	=> " Gallery Autorotation",
		"desc" 	=> "Here you can set the autorotation timer of your background slider. Each slideshow image will be shown X seconds, where X is the number you choose at the dropdown menu.<br/>The default settings are set in <a href='admin.php?page=avia#goto_general_settings'>".THEMENAME." &raquo; General Settings</a> ",
		"id" 	=> "slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "",
		"no_first" => true,
		"slug"  => "gallery",
		"subtype" => 
		array('Use default (set in '.THEMENAME.' &raquo; General Settings)'=>'', 'no autoroation'=>'false','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),
		

array(	
			"slug"	=> "gallery",
			"name" 	=> "Background Gallery Transition",
			"desc" 	=> "You can choose if images should either fade or slide in your background gallery<br/>The default settings are set in <a href='admin.php?page=avia#goto_general_settings'>".THEMENAME." &raquo; General Settings</a>",
			"id" 	=> "gallery_transition",
			"type" 	=> "select",
			"std" 	=> "",
			"no_first"=>true,
			"subtype" => array( 'Use default'=>'',
								'Fade' => "fade",
								'Slide' => "slide"
		)),

	array(	
			"slug"	=> "gallery",
			"name" 	=> "Gallery Tooltips/Metadata",
			"desc" 	=> "Some of the galleries support tooltips or metadata fields that show the item title, description and image exif data. <br/><strong>Please Note:</strong>If you want to display some tooltips but want to skip the tooltip for a single image just rename the title to a single dash: - <br/>The default settings are set in <a href='admin.php?page=avia#goto_general_settings'>".THEMENAME." &raquo; General Settings</a>",
			"id" 	=> "gallery_tooltips",
			"type" 	=> "select",
			"std" 	=> "",
			"no_first"=>true,
			"subtype" => array( 'Use default (set in '.THEMENAME.' &raquo; General Settings)'=>'',
								'Show Tooltips with title, description and exif data' => "all",
								'Show Tooltips with title &amp; description only' => "title",
								'Show no tooltips' => "none",
		)),
		
									
				
	array(	
					"id" 	=> "gallery_overlay",
					"name" 	=> "Do you want to display a tiled semi-transparent background pattern in front of the background?",
					"desc" 	=> "This is useful for pages that focus on the content area rather than the background. You can add patterns to the list by simply adding files to your themes images/patterns/ folder<br/>The default settings are set in <a href='admin.php?page=avia#goto_general_settings'>".THEMENAME." &raquo; General Settings</a> ",
					"type" 	=> "select",
					"slug"  => "gallery",
					"subtype" => array('Use default (set in '.THEMENAME.' &raquo; General Settings)'=>'', 'Display no pattern overlay'=>'none'),
					"std" 	=> "",
		"no_first" => true,
					"folder" => "images/patterns/",
					"folderlabel" => ""),
					
			

	array(	
					"slug"	=> "page_layout",
					"name" 	=> "Choose a Page Layout",
					"desc" 	=> "Set the layout for this post here",
					"id" 	=> "entry_layout",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Default Layout (Content + small title)' => "",
										'Default Layout Big (Content + big title)' => "big_title",
										'No Content Area' =>'no_content_display bg_gallery',
										'Mini Content Area' =>'mini_content_display bg_gallery',
										)),

		

	array(	
					"slug"	=> "page_layout",
					"name" 	=> "Do you want to display a sidebar?",
					"desc" 	=> "Attention: This only applies to default pages. Masonry pages for example are excluded from this setting",
					"id" 	=> "sidebar_right",
					"type" 	=> "select",
					"std" 	=> "",
					"subtype" => array('Use default (set in '.THEMENAME.' &raquo; Sidebar)'=>'','No right sidebar'=>'no','Yes display right sidebar'=>'yes')),
					
					
	array(	
					"slug"	=> "product_layout",
					"name" 	=> "Do you want to display a sidebar?",
					"desc" 	=> "Attention: This only applies to default pages. Masonry pages for example are excluded from this setting",
					"id" 	=> "sidebar_right",
					"type" 	=> "select",
					"std" 	=> "",
					"subtype" => array('Use default (set in '.THEMENAME.' &raquo; Sidebar)'=>'','No right sidebar'=>'no','Yes display right sidebar'=>'yes')),
		

			 
			
	 	array(	
			"slug"	=> "gallery",
			"name" 	=> "Background Gallery Image Cropping/resizing",
			"desc" 	=> "By default the images are resized to fill the whole user viewport. Depending on the browser size of the user this might lead to cropping of your images. You can deactivate this behavior and tell the slideshow to show your images un-cropped, no matter the user viewport size. This probably doesn't look that nice but works better for pictures in portrait orientation<br/>The default settings are set in <a href='admin.php?page=avia#goto_general_settings'>".THEMENAME." &raquo; General Settings</a>",
			"id" 	=> "gallery_cropping",
			"type" 	=> "select",
			"std" 	=> "",
			"no_first"=>true,
			"subtype" => array( 'Use default (set in '.THEMENAME.' &raquo; General Settings)'=>'',
								'Images should be scaled to fit, with cropping if necessary' => "cropping",
								'Images should be displayed without cropping' => "dont_crop_images"
		)),
		
		
			 	array(	
			"slug"	=> "gallery",
			"name" 	=> "Instant Background Gallery",
			"desc" 	=> "By default a visitor needs to manually click 'hide the sidebar and content' button when he wants to see the full page gallery. <br/>If you want the fullpage gallery to appear imgallerytely on page load you can set the option here.",
			"id" 	=> "instant_gallery",
			"type" 	=> "select",
			"std" 	=> "",
			"no_first"=>true,
			"subtype" => array( 'Display Sidebar and content on pageload, user needs to hide it manually'=>'',
								'Display Gallery on page load, user needs to click on the "home" button to show sidebar and content' => "instant_gallery"
		)),
);

