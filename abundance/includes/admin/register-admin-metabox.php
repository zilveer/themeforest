<?php

//avia pages holds the data necessary for backend page creation
$boxes = array( 
	array( 'title' =>  'Page Layout', 'id'=>'page_layout' , 'page'=>array('page'), 'context'=>'side', 'priority'=>'low' ),
	array( 'title' =>  'Post Layout', 'id'=>'post_layout' , 'page'=>array('post'), 'context'=>'side', 'priority'=>'low' ),
	array( 'title' =>  'Slideshow Options', 'id'=>'slideshow_meta', 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Add featured media', 'id'=>'slideshow' , 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Dynamic Templates', 'id'=>'dynamic_templates' , 'page'=>array('portfolio'), 'context'=>'side', 'priority'=>'low' ),
	array( 'title' =>  'Product Images', 'id'=>'product_images' , 'page'=>array('product'), 'context'=>'side', 'priority'=>'low' )
					 
);


$elements = array(
	array(	
					"slug"	=> "product_images",
					"name" 	=> "Feature Image Option",
					"desc" 	=> "Big versions of feature Images can either be displayed in a lightbox or with a magnifiyng tool",
					"id" 	=> "zoom_lightbox",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Use lightbox' => "",
										'Use Zoom' => "noLightbox cloudzoom_active"
										)),
	array(	
					"slug"	=> "page_layout",
					"name" 	=> "Overwrite default Page Layout",
					"desc" 	=> "You may overwrite the default layout you have set in your wordpress <a href='admin.php?page=avia#goto_layout_settings'>Theme Settings</a>",
					"id" 	=> "page_layout",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Use default' => "",
										'Big preview image, left sidebar' =>'big_image sidebar_left single_sidebar',
										'Big preview image, right sidebar'=>'big_image sidebar_right single_sidebar',
										'Medium preview image, left and right sidebar'=>'medium_image dual-sidebar',
										'Fullsize preview image, no sidebar'=>'fullwidth',
										'Dynamic Template'=>'dynamic'
										
										)),
										
		array(	
					"slug"	=> "post_layout",
					"name" 	=> "Overwrite default Blog Post Layout",
					"desc" 	=> "You may overwrite the default layout you have set in your wordpress <a href='admin.php?page=avia#goto_layout_settings'>Theme Settings</a>",
					"id" 	=> "blog_layout",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Use default' => "",
										'Big preview image, left sidebar' =>'big_image sidebar_left single_sidebar',
										'Big preview image, right sidebar'=>'big_image sidebar_right single_sidebar',
										'Medium preview image, left sidebar' =>'medium_image sidebar_left single_sidebar',
										'Medium preview image, right sidebar'=>'medium_image sidebar_right single_sidebar',
										'Medium preview image, left and right sidebar'=>'medium_image dual-sidebar',
										'Small preview image, left sidebar'=>'small_image sidebar_left single_sidebar',
										'Small preview image, right sidebar'=>'small_image sidebar_right single_sidebar',
										'Dynamic Template'=>'dynamic'
										)),
		

	array(	
		"name" 	=> "Dynamic Template",
		"desc" 	=> "Select a dynamic template for this entry. If you haven't created one yet you can do so at <a href='admin.php?page=templates'>the Template Builder</a>",
		"id" 	=> "dynamic_templates",
		"type" 	=> "select",
		"std" 	=> "",
		"required" 	=> array('page_layout','{contains}dynamic'),
		"slug"  => "page_layout",
		"subtype" => avia_backend_get_dynamic_templates()),	
		
		array(	
		"name" 	=> "Dynamic Template",
		"desc" 	=> "Select a dynamic template for this entry. If you haven't created one yet you can do so at <a href='admin.php?page=templates'>the Template Builder</a>",
		"id" 	=> "dynamic_templates",
		"type" 	=> "select",
		"std" 	=> "",
		"required" 	=> array('blog_layout','{contains}dynamic'),
		"slug"  => "post_layout",
		"subtype" => avia_backend_get_dynamic_templates()),	
		
		array(	
		"name" 	=> "Dynamic Template",
		"desc" 	=> "Select a dynamic template for this entry. If you haven't created one yet you can do so at <a href='admin.php?page=templates'>the Template Builder</a>",
		"id" 	=> "dynamic_templates",
		"type" 	=> "select",
		"std" 	=> "",
		"slug"  => "dynamic_templates",
		"subtype" => avia_backend_get_dynamic_templates()),	
		
		
		
	array(	
		"name" 	=> "Which Slideshow do you want to use?",
		"desc" 	=> "The default slider will adapt its size to whatever layout you have choosen besides at 'Post/Page Layout'.<br/>The other sliders will overwrite the Page layout settings and show as Fullwidth sliders at the top of the page or post" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"std" 	=> "fade_slider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"subtype" => array('Fade Slider (size depends on page layout selected above)'=>'fade_slider','Aviaslider (Fullwidth)'=>'aviaslider','3d Piecmaker Slider (Fullwidth)'=>'piecemaker','AviaCordion (Fullwidth)'=>'aviacordion', 'Caption Slider (Small Image &amp; Caption will appear beside)' => 'caption_slider','Fade Slider (forced full width)'=>'fade_slider fullwidth')),

	array(	
		"name" 	=> "Autorotation active?",
		"desc" 	=> "Check if the slideshow should rotate by default",
		"id" 	=> "_slideshow_autoplay",
		"type" 	=> "select",
		"std" 	=> "false",
		"no_first" => true,
		"slug"  => "slideshow_meta",
		"subtype" => array('yes'=>'true','no'=>'false')),	
			
	array(	
		"name" 	=> "Slidehsow autorotation duration",
		"desc" 	=> "Each image will be shown X seconds, where X is the number you choose at the dropdown menu",
		"id" 	=> "_slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "5",
		"no_first" => true,
		"slug"  => "slideshow_meta",
		"subtype" => 
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),
	
	
	array(	"slug"	=> "slideshow_meta", "type" => "visual_group_start", "id" => "visual_group_meta_description", "nodescription" => true, 'class'=>'avia_meta_description', "required" => array('_slideshow_type','{contains}aviaslider') ),
	

	array(	
		"name" 	=> "Slice width",
		"desc" 	=> "",
		"id" 	=> "slice_width",
		"type" 	=> "select",
		"std" 	=> "full",
		"slug"  => "slideshow_meta",
		"subtype" => 
		array('25px'=>'25','50px'=>'50','75px'=>'75','100px'=>'100','125px'=>'125','130px'=>'130','150px'=>'150','200px'=>'200','230px'=>'230', 'full'=>'full')),	
	

	array(	
		"name" 	=> "Slice height",
		"desc" 	=> "",
		"id" 	=> "slice_height",
		"type" 	=> "select",
		"std" 	=> "full",
		"slug"  => "slideshow_meta",
		"subtype" => 
		array('25px'=>'25','50px'=>'50','75px'=>'75','100px'=>'100','125px'=>'125','130px'=>'130','150px'=>'150','200px'=>'200','230px'=>'230', 'full'=>'full')),	
		
		array(	
		"name" 	=> "Transition Type",
		"desc" 	=> "",
		"id" 	=> "transition_type",
		"type" 	=> "select",
		"std" 	=> "fade",
		"slug"  => "slideshow_meta",
		"subtype" => 
		array('Slide'=>'slide','Fade'=>'fade','Drop'=>'drop')),	
		
		 array(	
		"name" 	=> "Movement behaviour of the slides",
		"desc" 	=> "",
		"id" 	=> "direction",
		"type" 	=> "select",
		"std" 	=> "all",
		"slug"  => "slideshow_meta",
		"subtype" => 
		array('diagonal'=>'diagonal','winding'=>'winding','randomized'=>'random','all of those'=>'all')),

		
array(	"slug"	=> "slideshow_meta", "type" => "visual_group_end", "id" => "visual_group_meta_description_end", "nodescription" => true),
		 
		 
		/*Featue Image & slideshow */
		
		array(
			"type" 			=> "group", 
			"id" 			=> "slideshow", 
			"linktext" 		=> "Add another Slide",
			"deletetext" 	=> "Remove Slide",
			"slug"  		=> "slideshow",
			"blank" 		=> true, 
			"nodescription" => true,
			'subelements' 	=> array(	
			
					array(	"name" 	=> "Featured Media",
							"desc" 	=> "Upload an image or video or choose one from the Media Library",
							"id" 	=>  "slideshow_image",
							"type" 	=> "upload",
							"slug"  => "slideshow",
							"subtype" => "advanced",
							"force_old_media" =>true,
							"label"	=> "Use Image as featured Image"),
					
					array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta1_start", "nodescription" => true, 'class'=>'avia_meta_default'),
					
					array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta2_start", "nodescription" => true, 'class'=>'avia_meta_block avia_wrap'),

							
					array(	"name" 	=> "Caption Title",
							"slug"  => "slideshow",
							"desc" 	=> "Enter a title to display for your welcome message.",
							"id" 	=> "slideshow_caption_title",
							"type" 	=> "text" ),
							
					array(	"name" 	=> "Caption",
							"slug"  => "slideshow",
							"desc" 	=> "Image Caption for this Slide",
				            "id" 	=> "slideshow_caption",
				            "type" 	=> "textarea" ),
				   
				    array(	"name" 	=> "Apply link to the image?",
							"desc" 	=> "",
							"slug"  => "slideshow",
				            "id" 	=> "slideshow_link",
				            "type" 	=> "select",
				            "std" 	=> "self",
				            "subtype" => array('No link'=>'','Lightbox Image'=>'lightbox','Link to this Post'=>'self','Link to Page'=>'page','Link to Category'=>'cat','Link manually'=>'url','Embed Video when image is clicked (Enter the URL to a video file or a service like youtube/vimeo)'=>'video'),
				   
				           ),
				           
					array(	"name" 	=> "",
							"desc" 	=> "",
							"slug"  => "slideshow",
							"id"   	=> "slideshow_link_url",
							"std"  	=> "http://",
							"type" 	=> "text",
							"required" => array('slideshow_link','url') ),
							
					array(	"name" 	=> "",
							"desc" 	=> "Enter the URL to a video file or a service like youtube/vimeo",
							"slug"  => "slideshow",
							"id"   	=> "slideshow_link_video",
							"std"  	=> "http://",
							"type" 	=> "text",
							"required" => array('slideshow_link','video') ),
							
							
					array(	"name" 	=> "",
							"desc" 	=> "",
							"slug"  => "slideshow",
				            "id" 	=> "slideshow_link_page",
				            "type" 	=> "select",
				            "subtype" => "page",
				            "required" => array('slideshow_link','page') ),
				            
				    array(	"name" 	=> "",
							"desc" 	=> "",
							"slug"  => "slideshow",
				            "id" 	=> "slideshow_link_cat",
				            "type" 	=> "select",
				            "subtype" => "cat",
				            "required" => array('slideshow_link','cat') ),
						       
				           
				   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta1_end", "nodescription" => true, ),
				   
				    array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta3_start", "nodescription" => true, 'class'=>'avia_meta_block avia_wrap', "required" => array('_slideshow_type','piecemaker') ),
						           
						   array(	"name" 	=> "Transition Type (a.k.a easing)",
									"desc" 	=> "",
									"slug"  => "slideshow",
						            "id" 	=> "easing",
						            "type" 	=> "select",
						            "std" 	=> "linear",
						            "subtype" => array('Linear'=>'linear', 'easeInSine'=>'easeInSine', 'easeOutSine'=>'easeOutSine', 'easeInOutSine'=>'easeInOutSine', 'easeInQuad'=>'easeInQuad', 'easeOutQuad'=>'easeOutQuad', 'easeInOutQuad'=>'easeInOutQuad', 'easeInQuart'=>'easeInQuart', 'easeOutQuart'=>'easeOutQuart', 'easeInOutQuart'=>'easeInOutQuart', 'easeInBack'=>'easeInBack', 'easeOutBack'=>'easeOutBack', 'easeInOutBack'=>'easeInOutBack', 'easeInBounce'=>'easeInBounce', 'easeOutBounce'=>'easeOutBounce', 'easeInOutBounce'=>'easeInOutBounce', 'easeInCirc'=>'easeInCirc', 'easeOutCirc'=>'easeOutCirc', 'easeInOutCirc'=>'easeInSine', 'easeInElastic'=>'easeInElastic', 'easeOutElastic'=>'easeOutElastic', 'easeInOutElastic'=>'easeInOutElastic' ) ),
 
									        
						    array(	
									"name" 	=> "Flip Depth",
									"desc" 	=> "",
									"id" 	=> "flip_depth",
									"type" 	=> "select",
									"std" 	=> "250",
									"slug"  => "slideshow",
									"subtype" => 
									array('none'=>'0','little'=>'100','normal'=>'250','deep'=>'500','deepest'=>'1000')),     
									
							 array(	
									"name" 	=> "Flip Sideward Movement",
									"desc" 	=> "",
									"id" 	=> "sideward",
									"type" 	=> "select",
									"std" 	=> "1",
									"slug"  => "slideshow",
									"subtype" => 
									array('none'=>'1','normal'=>'20','a lot'=>'40')),   
									
		
											            
							array(	
									"name" 	=> "vertical slicing",
									"desc" 	=> "",
									"id" 	=> "slice_vertical",
									"type" 	=> "select",
									"std" 	=> "3",
									"slug"  => "slideshow",
									"subtype" => 
									array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20')),
									
				
					
									
						   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta2_end", "nodescription" => true),
						   
						   array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta4_start", "nodescription" => true, 'class'=>'avia_meta_block avia_wrap', "required" => array('_slideshow_type','caption_slider') ),
						   
						   array(	
									"name" 	=> "Display Caption on the left or right?",
									"desc" 	=> "",
									"id" 	=> "caption_position",
									"type" 	=> "select",
									"std" 	=> "caption_right",
									"slug"  => "slideshow",
									"no_first"  => "true",
									"subtype" => 
									array('right'=>'caption_right','left'=>'caption_left', 'right framed'=>'caption_right caption_right_framed','left framed'=>'caption_left caption_left_framed')),
						   			
						   			
						   			array(	"name" 	=> "Button Label (leave empty for no buton)",
											"slug"  => "slideshow",
											"desc" 	=> "Enter a title to display for your welcome message.",
											"id" 	=> "slideshow_button_title",
											"type" 	=> "text" ),
								   
								    array(	"name" 	=> "Apply link to the button?",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button_link",
								            "type" 	=> "select",
								            "std" 	=> "nextSlide",
								            "subtype" => array('Link to this Post'=>'self','Link to the next slide'=>'nextSlide','Link to Page'=>'page','Link to Category'=>'cat','Link manually'=>'url'),
								   
								           ),
								           
									array(	"name" 	=> "",
											"desc" 	=> "",
											"slug"  => "slideshow",
											"id"   	=> "slideshow_button_link_url",
											"std"  	=> "http://",
											"type" 	=> "text",
											"required" => array('slideshow_button_link','url') ),
											
											
									array(	"name" 	=> "",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button_link_page",
								            "type" 	=> "select",
								            "subtype" => "page",
								            "required" => array('slideshow_button_link','page') ),
								            
								    array(	"name" 	=> "",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button_link_cat",
								            "type" 	=> "select",
								            "subtype" => "cat",
								            "required" => array('slideshow_button_link','cat') ),
						   
						   
						   
						   
						   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta4_end", "nodescription" => true),
						   
				   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta_default_end", "nodescription" => true),
				   
				   )
				   
			)

);

