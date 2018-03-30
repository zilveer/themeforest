<?php		

//avia pages holds the data necessary for backend page creation
$boxes = array( 
	array( 'title' =>  'Layout', 'id'=>'layout' , 'page'=>array('post','page'), 'context'=>'side', 'priority'=>'low' ),
	array( 'title' =>  'Slideshow Options', 'id'=>'slideshow_meta', 'page'=>array('post','page'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Slideshow Options', 'id'=>'slideshow_meta_portfolio', 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Featured media - add any number of images and/or videos', 'id'=>'media' , 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	//array( 'title' =>  'Additional Options', 'id'=>'add_options' , 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),

					 
);

								
$elements = array(

				
array(	
				"name" 	=> "Subtitle",
				"desc" 	=> "You can choose to display a subtitle bellow your default title for this entry" ,
				"id" 	=> "subtitle",
				"type" 	=> "text",
				"std" 	=> "",
				"slug"  => "add_options",
				"class" => "av_2columns av_col_1"
				),

				
				
array(	
					"slug"	=> "layout",
					"name" 	=> "Overwrite default Post Layout",
					"desc" 	=> "Overwrite the default layout you have set in your wordpress <a href='admin.php?page=avia#goto_layout_settings'>Theme Settings</a>. You can choose predefined templates or <a href='admin.php?page=templates'>dynamic Templates</a>",
					"id" 	=> "layout",
					"type" 	=> "select",
					"std" 	=> "",
					"hook" 	=> 'on_save_layout_dynamic_save',
					"no_first"=>true,
					"subtype" => array( 	
											'Predefined Templates' => array(
											'Use global default' => "",
											'Left sidebar' =>'sidebar_left',
											'Right sidebar'=>'sidebar_right',
											'Fullsize (no sidebar)'=>'fullsize'
											),
											
											'Dynamic Templates' => avia_backend_get_dynamic_templates('dynamic_template_')
											
										)),		
				
	
		

		/*page and post slideshow options*/		
		
		array(	
		"name" 	=> "Which Slideshow do you want to use?",
		"desc" 	=> "Choose one of the available slideshow types here. The default Slideshow is a basic fade slider." ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"std" 	=> "fade_slider",
		"slug"  => "slideshow_meta",
		"class" => "av_2columns av_col_1",
		"no_first" => true,
		"subtype" => array('Fade Slider'=>'fade', 'Moving Slider'=>'move' ,'Aviapoly Slider'=>'fx')),
		
	array(	
		"name" 	=> "Slideshow Layout on Single Pages",
		"desc" 	=> "Display the slideshow fixed fullwidth or should it adjust to the page layout (eg smaller on pages with sidebar)" ,
		"id" 	=> "_slideshow_position",
		"type" 	=> "select",
		"std" 	=> "big",
		"slug"  => "slideshow_meta",
		"class" => "av_2columns av_col_2",
		"no_first" => true,
		"subtype" => array('Full Width Slider'=>'big',  'Full Width Slider with Thumbnails'=>'big thumbs', 'Adjust to page Layout'=>'small')),

	array(	
		"name" 	=> "Autorotation active?",
		"desc" 	=> "Check if the slideshow should rotate by default",
		"id" 	=> "_slideshow_autoplay",
		"type" 	=> "select",
		"std" 	=> "false",
		"class" => "av_2columns av_col_1",
		"no_first" => true,
		"slug"  => "slideshow_meta",
		"subtype" => array('yes'=>'true','no'=>'false')),	
			
	array(	
		"name" 	=> "Slidehsow autorotation duration",
		"desc" 	=> "Images will be shown the selected amount of seconds.",
		"id" 	=> "_slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "5",
		"no_first" => true,
		"class" => "av_2columns av_col_2",
		"slug"  => "slideshow_meta",
		"subtype" => 
		array('3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),
	
		 
		 /*portfolio slideshow options*/
		 
	array(	
		"name" 	=> "Which Slideshow do you want to use?",
		"desc" 	=> "Choose one of the available slideshow types here. The default Slideshow is a basic fade slider." ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"std" 	=> "fade_slider",
		"slug"  => "slideshow_meta_portfolio",
		"class" => "av_2columns av_col_1",
		"no_first" => true,
		"subtype" => array('Fade Slider'=>'fade', 'Moving Slider'=>'move' ,'Aviapoly Slider'=>'fx')),
		
	array(	
		"name" 	=> "Portfolio Display Option",
		"desc" 	=> "Instead of displaying a slideshow you can also choose to show all portfolio images bellow each other" ,
		"id" 	=> "_slideshow_position",
		"type" 	=> "select",
		"std" 	=> "small",
		"slug"  => "slideshow_meta_portfolio",
		"class" => "av_2columns av_col_2",
		"no_first" => true,
		"subtype" => array('Use Slideshow'=>'small', 'Disable Slideshow, show images bellow each other'=>'static')),

	array(	
		"name" 	=> "Autorotation active?",
		"desc" 	=> "Check if the slideshow should rotate by default",
		"id" 	=> "_slideshow_autoplay",
		"type" 	=> "select",
		"std" 	=> "false",
		"class" => "av_2columns av_col_1",
		"no_first" => true,
		"slug"  => "slideshow_meta_portfolio",
		"subtype" => array('yes'=>'true','no'=>'false')),	
			
	array(	
		"name" 	=> "Slidehsow autorotation duration",
		"desc" 	=> "Images will be shown the selected amount of seconds.",
		"id" 	=> "_slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "5",
		"no_first" => true,
		"class" => "av_2columns av_col_2",
		"slug"  => "slideshow_meta_portfolio",
		"subtype" => 
		array('3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),	 
		 
		 
		 
		 
		 
		/*Featue Image & slideshow */
		array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
							array(	"name" 	=> "Featured Media",
							"desc" 	=> 	"",
							"id" 	=>  "slideshow_image",
							"type" 	=> "gallery_image",
							"slug"  => "media",
							"nodescription" => true,
							"subtype" => "advanced",
							"label"	=> "Insert"),
							
							array(	"name" 	=> "",
							"desc" 	=> 	"",
							"id" 	=>  "slideshow_video",
							"type" 	=> "text",
							"class"	=> "slideshow_video_input",
							"slug"  => "media",
							"simple"=> true,
							"class_on_value"=> 'video_active',
							"nodescription" => true),
							
							
							array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "avia_tab1", "nodescription" => true, 'class'=>'avia_tab_container'),
								
								
								array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "avia_tab1", "nodescription" => true, 'class'=>'avia_tab avia_tab1','name'=>'Default Options'),
	
								array(	"name" 	=> "Caption Title",
										"slug"  => "media",
										"class" => "av_2columns av_col_1",
										"desc" 	=> "",
										"id" 	=> "slideshow_caption_title",
										"type" 	=> "text" ),
										
								array(	"name" 	=> "Caption Text",
										"slug"  => "media",
										"class" => "av_2columns av_col_2",
										"desc" 	=> "",
							            "id" 	=> "slideshow_caption",
							            "type" 	=> "textarea" ),
							   
							    array(	"name" 	=> "Apply link to the image?",
										"desc" 	=> "",
										"slug"  => "media",
										"class" => "av_2columns av_col_1",
							            "id" 	=> "slideshow_link",
							            "type" 	=> "select",
							            "std" 	=> "",
							            "no_first"  => "true",
							            "subtype" => array('No link'=>'','Open Lightbox when clicked'=>'lightbox','Link to this Post'=>'self','Link to Page'=>'page','Link to Category'=>'cat','Link manually'=>'url'),
							   
							           ),
							           
								array(	"name" 	=> "Enter URL",
										"desc" 	=> "",
										"slug"  => "media",
										"id"   	=> "slideshow_link_url",
										"std"  	=> "http://",
										"type" 	=> "text",
										"class" => "av_2columns av_col_2",
										"required" => array('slideshow_link','url') ),
										
								array(	"name" 	=> "Choose Page",
										"desc" 	=> "",
										"slug"  => "media",
							            "id" 	=> "slideshow_link_page",
							            "type" 	=> "select",
							            "subtype" => "page",
										"class" => "av_2columns av_col_2",
							            "required" => array('slideshow_link','page') ),
							            
							    array(	"name" 	=> "Choose Category",
										"desc" 	=> "",
										"slug"  => "media",
							            "id" 	=> "slideshow_link_cat",
							            "type" 	=> "select",
							            "subtype" => "cat",
										"class" => "av_2columns av_col_2",
							            "required" => array('slideshow_link','cat') ),
							            
							    array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "avia_tab1_end", "nodescription" => true),
							    
							    array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "avia_tab2", "nodescription" => true, 'class'=>'avia_tab avia_tab2','name'=>'Caption Advanced' ),
							    		
							    		array(	
										"name" 	=> "Caption Animation",
										"desc" 	=> "",
										"id" 	=> "caption_animation",
										"type" 	=> "select",
										"std" 	=> "",
										"slug"  => "media",
										"no_first"  => "true",
										"subtype" => 
										array(	'Fade In' => '', 'Left/Right slide in' =>'caption_animate caption_animate_side', 'Top/Bottom slide in' =>'caption_animate caption_animate_top')),
							    		
							    		
							    		array(	
										"name" 	=> "Caption Position and Style",
										"desc" 	=> "",
										"id" 	=> "caption_position",
										"type" 	=> "select",
										"std" 	=> "caption_left caption_left_framed",
										"slug"  => "media",
										"no_first"  => "true",
										"class" => "av_2columns av_col_1",
										"subtype" => 
										array(	'-------- default size --------'=>array(
												'right framed'=>'caption_right caption_right_framed caption_framed',
												'left framed'=>'caption_left caption_left_framed caption_framed', 
												'bottom framed'=>'caption_bottom caption_bottom_framed caption_framed',
												'center framed'=>'caption_center caption_center_framed caption_framed',
												'right without frame'=>'caption_right',
												'left without frame'=>'caption_left',
												'bottom without frame'=>'caption_bottom',
												'center without frame'=>'caption_center'
												),
												'-------- super size --------'=>array(
												'right framed - big'=>'caption_right caption_right_framed caption_framed caption_supersize',
												'left framed - big'=>'caption_left caption_left_framed caption_framed caption_supersize', 
												'bottom framed - big'=>'caption_bottom caption_bottom_framed caption_framed caption_supersize',
												'center framed - big'=>'caption_center caption_center_framed caption_framed caption_supersize',
												'right without frame - big'=>'caption_right caption_supersize',
												'left without frame - big'=>'caption_left caption_supersize',
												'bottom without frame - big'=>'caption_bottom caption_supersize',
												'center without frame - big'=>'caption_center caption_supersize'
												)
											)),
										
								array(	
									"slug"	=> "media",
									"name" 	=> "Caption font color",
									"desc" 	=> "",
									"id" 	=> "caption_font",
									"type" 	=> "colorpicker",
									"class" => "av_2columns av_col_2",
									"std" 	=> "",
									),
														
										
									array(	"slug"	=> "media", "type" => "hr", "id" => "hr1", "nodescription" => true),	
									
									array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "button_wrap", "nodescription" => true, "class"=>"av_2columns av_col_1"),
										
									array(	"name" 	=> "Caption Call to Action Button Label",
											"slug"  => "slideshow",
											"desc" 	=> "Leave empty if you dont want to display a Button",
											"id" 	=> "slideshow_button_title",
											"type" 	=> "text" ),
								   
								    array(	"name" 	=> "Apply link to the button?",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button_link",
								            "type" 	=> "select",
								            "std" 	=> "self",
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
								            
								    
								    
							   		array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "button_wrap_end", "nodescription" => true),	
								    
	/*
							    array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "button_wrap2", "nodescription" => true , "class"=>"av_2columns av_col_2"),
								    array(	"name" 	=> "Caption Call to Action Button Label 2",
											"slug"  => "slideshow",
											"desc" 	=> "Leave empty if you dont want to display a Button",
											"id" 	=> "slideshow_button2_title",
											"type" 	=> "text" ),
								   
								    array(	"name" 	=> "Apply link to the button?",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button2_link",
								            "type" 	=> "select",
								            "std" 	=> "nextSlide",
								            "subtype" => array('Link to this Post'=>'self','Link to the next slide'=>'nextSlide','Link to Page'=>'page','Link to Category'=>'cat','Link manually'=>'url'),
								   
								           ),
								           
									array(	"name" 	=> "",
											"desc" 	=> "",
											"slug"  => "slideshow",
											"id"   	=> "slideshow_button2_link_url",
											"std"  	=> "http://",
											"type" 	=> "text",
											"required" => array('slideshow_button2_link','url') ),
											
											
									array(	"name" 	=> "",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button2_link_page",
								            "type" 	=> "select",
								            "subtype" => "page",
								            "required" => array('slideshow_button2_link','page') ),
								            
								    array(	"name" 	=> "",
											"desc" 	=> "",
											"slug"  => "slideshow",
								            "id" 	=> "slideshow_button2_link_cat",
								            "type" 	=> "select",
								            "subtype" => "cat",
								            "required" => array('slideshow_button2_link','cat') ),
								            
								            
							   		array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "button_wrap_end2", "nodescription" => true),	
*/
							   			
							   			
									            
								array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "avia_tab2_end", "nodescription" => true),
								
								
								
array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "avia_tab3", "nodescription" => true, 'class'=>'avia_tab avia_tab3','name'=>'Image Size Options', "required" => array('_slideshow_type','{contains}e'), "inactive"=>"This Tab is deactivated due to your Slideshow choice above. If you choose to use the Moving Slider or Fade Slider instead it will become available" ),
							    
							    		array(	
										"name" 	=> "Which slideshow layout do you want to use for this slide?",
										"desc" 	=> "Please be aware that this function only is applied to slideshows on single pages that are set to 'Full Width Slider' or 'Full Width Slider with Thumbnails'",
										"id" 	=> "slideshow_image_layout",
										"type" 	=> "select",
										"std" 	=> "random",
										"slug"  => "media",
										"no_first"  => "true",
										"subtype" => 
										array(	'Big Image/Video'=>'', 
												//'Big Image/Video with top and bottom margin'=>'with_border', 
												'Small Image/Video Left'=>'small_image small_image_left', 
												//'Small Image/Video Left with top and bottom margin'=>'small_image small_image_left with_border', 
												'Small Image/Video Right'=>'small_image small_image_right', 
												//'Small Image/Video Right with top and bottom margin'=>'small_image small_image_right with_border' , 
						 
										)),
							   			
							   			
							   			
									            
								array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "avia_tab4_end", "nodescription" => true),

								
								
								array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "avia_tab3", "nodescription" => true, 'class'=>'avia_tab avia_tab4','name'=>'Aviapoly Options', "required" => array('_slideshow_type','{contains}fx'), "inactive"=>"This Tab is deactivated due to your Slideshow choice above. If you choose to use the Adaptavia Slider it will become available" ),
							    
							    		array(	
										"name" 	=> "Which slideshow transition do you want to use for this slide?",
										"desc" 	=> "",
										"id" 	=> "slideshow_transition",
										"type" 	=> "select",
										"std" 	=> "random",
										"slug"  => "media",
										"no_first"  => "true",
										"subtype" => 
										array('Choose a transition at random'=>'random', 
											  'Squares (sliding)'	=>	'square',
											  'Squares (fading)' 	=>	'square-fade',
											  'Squares (random/sliding)'	=>	'square-random',
											  'Squares (random/fading)'	=>	'square-random-fade',
											  'Squares (zoom)'	=>	'square-zoom',
											  					 	  	
											  'Vertical Bars (top)'		=>	'bar-vertical-top',
											  'Vertical Bars (side)'	=>	'bar-vertical-side',
											  'Vertical Bars (mesh)'	=>	'bar-vertical-mesh',
											  'Vertical Bars (random)'	=>	'bar-vertical-random',
											  'Vertical Bars (zoom)'	=>	'bar-vertical-zoom',
											  					 	  	
											  'Horizontal Bars (top)'	=>	'bar-horizontal-top',
											  'Horizontal Bars (side)'	=>	'bar-horizontal-side',
											  'Horizontal Bars (mesh)'	=>	'bar-horizontal-mesh',
											  'Horizontal Bars (random)'	=>	'bar-horizontal-random',
											  'Horizontal Bars (zoom)'	=>	'bar-horizontal-zoom',
											  					 	  	
											  
											  
											  
										)),
							   			
							   			
							   			
									            
								array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "avia_tab4_end", "nodescription" => true),
							    							    
							   
							   
							  array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "avia_tab_container_end", "nodescription" => true),
	
							)
						),
							

			
			
			
			
			
		
);


/*dynamic portfolio meta fields*/
$portfolio_metas = avia_get_option('portfolio-meta', array(array('meta'=>'Skills Needed'), array('meta'=>'Client'), array('meta'=>'Project URL')));

$counter = 0;
foreach($portfolio_metas as $p_meta)
{
	if(!empty($p_meta['meta']))
	{

		$counter ++;
		$elements[] = array(	
					"name" 	=> $p_meta['meta'],
					"desc" 	=> "" ,
					"id" 	=> "portfolio-meta-$counter",
					"type" 	=> "text",
					"std" 	=> "",
					"slug"  => "portfolio-meta");
	}
}

if($counter)
{
	$boxes[]    = array( 'title' =>  'Portfolio Meta Information', 'id'=>'portfolio-meta' , 'page'=>array('portfolio'), 'context'=>'side', 'priority'=>'low' );
}
