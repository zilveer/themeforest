<?php

if ( class_exists( 'WPBakeryVisualComposerAbstract') ) {
	
	if(!function_exists('webnus_setup_vc_row')){
		
		function webnus_setup_vc_row(){
			
			vc_remove_param('vc_row', 'full_width');
			vc_remove_param('vc_row', 'gap');
			vc_remove_param('vc_row', 'full_height');
			vc_remove_param('vc_row', 'columns_placement');
			vc_remove_param('vc_row', 'equal_height');
			vc_remove_param('vc_row', 'content_placement');
			vc_remove_param('vc_row', 'video_bg');
			vc_remove_param('vc_row', 'video_bg_url');
			vc_remove_param('vc_row', 'video_bg_parallax');
			vc_remove_param('vc_row', 'parallax');
			vc_remove_param('vc_row', 'parallax_image');
			vc_remove_param('vc_row', 'el_id');
			vc_remove_param('vc_row', 'el_class');
			vc_remove_param('vc_row', 'css');
			vc_remove_param('vc_row', 'parallax_speed_video');
			vc_remove_param('vc_row', 'parallax_speed_bg');
			vc_remove_param('vc_row', 'disable_element');
			
			
						
			
			$attributes = array(
							      "type" => "dropdown",
							      "heading" => esc_html__("Select Row Type", "webnus_framework"),
							      "param_name" => "row_type",
							      "description" => esc_html__("Select row types available in theme, [row,blox,blox_dark,parallax,video background] are available", "webnus_framework"),
								  "value"=>array("Default"=>'0',"FullWidth Row"=>"1", "Blox"=>"2" , "Parallax"=>"3", "ProcessBox"=>"4", "Video Background"=>'5' , "MaxSlider"=>'6')
   						 );			
			vc_add_param('vc_row',$attributes);
			
			$attributes = array(
							      "type" => "textfield",
							      "heading" => esc_html__("Row ID", "webnus_framework"),
							      "param_name" => "row_id",
							      "description" => esc_html__("Enter the row ID", "webnus_framework"),
								  "value"=>''
   						 );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
									"type"=>'dropdown',
									"heading"=>esc_html__('Background Video Source', 'webnus_framework'),
									"param_name"=> "video_src",
									"value"=>array(
										'Self Hosted' => 'host',
										'Youtube'	=> 'video_sharing',
									),
									"description" => wp_kses( __( "<strong style=\"color: red;\">!Important:</strong> When you choose \"Host\" type, for better experience you must upload MP4,WebM and OGG format altogether", 'webnus_framework'), array( 'strong' => array( 'style' => array() ) ) ),
									"dependency"=>array('element'=>'row_type','value'=>array('5'))
									   );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
									"type"=>'textfield',
									"heading"=>esc_html__('Youtube Video ID', 'webnus_framework'),
									"param_name"=> "video_sharing_url",
									"value"=>'',
									"description" => esc_html__( "Input your youtube video ID", 'webnus_framework'),
									"dependency"=>array('element'=>'video_src','value'=>array('video_sharing'))
									   );
			vc_add_param('vc_row',$attributes);

			$attributes = array(
									"type"=>'textfield',
									"heading"=>esc_html__('.MP4 Format', 'webnus_framework'),
									"param_name"=> "mp4_format",
									"value"=>'',
									"description" => esc_html__( "Compatibility for Safari and IE9", 'webnus_framework'),
									"dependency"=>array('element'=>'video_src','value'=>array('host'))
									   );
			vc_add_param('vc_row',$attributes);

			$attributes = array(
									"type"=>'textfield',
									"heading"=>esc_html__('.WebM Format', 'webnus_framework'),
									"param_name"=> "webm_format",
									"value"=>'',
									"description" => esc_html__( "Compatibility for Firefox4, Opera, and Chrome", 'webnus_framework'),
									"dependency"=>array('element'=>'video_src','value'=>array('host'))
									   );
			vc_add_param('vc_row',$attributes);

			$attributes = array(
									"type"=>'textfield',
									"heading"=>esc_html__('.Ogg Format', 'webnus_framework'),
									"param_name"=> "ogg_format",
									"value"=>'',
									"description" => esc_html__( "Compatibility for older Firefox and Opera versions", 'webnus_framework'),
									"dependency"=>array('element'=>'video_src','value'=>array('host'))
									   );
			vc_add_param('vc_row',$attributes);

			$attributes = array(
									"type"=>'attach_image',
									"heading"=>esc_html__('Background image', 'webnus_framework'),
									"param_name"=> "img_preview_video",
									"value"=>'',
									"description" => esc_html__( "This Image will be showed up until video is loaded. If video is not supported or could not load on user's machine, the image will stay in background.", 'webnus_framework'),
									"dependency"=>array('element'=>'row_type','value'=>array('5'))
									   );
			vc_add_param('vc_row',$attributes);
			
			$attributes = array(
							      "type" => "textfield",
							      "heading" => esc_html__("Height", "webnus_framework"),
							      "param_name" => "blox_height",
							      "description" => esc_html__("Select blox Height in number format Example: 380", "webnus_framework"),
								  "value"=>"",
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3','5'))
							   	);			
			vc_add_param('vc_row',$attributes);

			
			$attributes = array(
							      "type" => "attach_image",
							      "heading" => esc_html__("Background Image", "webnus_framework"),
							      "param_name" => "blox_image",
							      "description" => esc_html__("Select background image URL", "webnus_framework"),
								  "value"=>"",
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3'))
							   );			
			vc_add_param('vc_row',$attributes);
			
			$attributes = array(
							      "type" => "dropdown",
							      "heading" => esc_html__("Background Attachment", "webnus_framework"),
							      "param_name" => "blox_bg_attachment",
							      "description" => esc_html__("Select Background Attachment?", "webnus_framework"),
								  "value"=>array( 'Scroll'=>'false','Fixed'=>'true'),
								  "dependency"=>array('element'=>'row_type','value'=>array('2'))
							   );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
							      "type" => "dropdown",
							      "heading" => esc_html__("Background Position", "webnus_framework"),
							      "param_name" => "blox_bg_position",
							      "description" => esc_html__("The background-position property sets the starting position of a background image.", "webnus_framework"),
								  'value'				=> array(
										'Left Top'			=> 'left top',
										'Left Center'		=> 'left center',
										'Left Bottom'		=> 'left bottom',
										'Center Top'		=> 'center top',
										'Center Center'		=> 'center center',
										'Center Bottom'		=> 'center bottom',
										'Right Top'			=> 'right top',
										'Right Center'		=> 'right center',
										'Right Bottom'		=> 'right bottom',
									),
								  'std' => 'center center',
								  "dependency"=>array('element'=>'row_type','value'=>array('2'))
							   );			
			vc_add_param('vc_row',$attributes);
						
			$attributes = array(
							      "type" => "dropdown",
							      "heading" => esc_html__("Background Cover?", "webnus_framework"),
							      "param_name" => "blox_cover",
							      "description" => esc_html__("Blox has cover background?", "webnus_framework"),
								  "value"=>array('True'=>'true', 'False'=>'false'),
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3'))
							   );			
			vc_add_param('vc_row',$attributes);
				
			$attributes = array(
							     "type" => "dropdown",
							      "heading" => esc_html__("Background Repeat?", "webnus_framework"),
							      "param_name" => "blox_repeat",
							      "description" => esc_html__("Is Background image repeated?", "webnus_framework"),
								  "value"=>array( 'No Repeat'=>'no-repeat','Repeat'=>'repeat'),
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3'))
							   );			
			vc_add_param('vc_row',$attributes);
			
			$attributes = array(
							      "type" => "checkbox",
							      "heading" => esc_html__("Align Center?", "webnus_framework"),
							      "param_name" => "align_center",
							      "description" => esc_html__("Align center content", "webnus_framework"),
								  'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'aligncenter' ),
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3','5'))
							   );	
			vc_add_param('vc_row',$attributes);	
							   
			$attributes = array(
							      "type" => "checkbox",
							      "heading" => esc_html__("Used as Page Title?", "webnus_framework"),
							      "param_name" => "page_title",
							      "description" => esc_html__("Remove gap between header and this section", "webnus_framework"),
								  'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'page-title-x' ),
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3','5'))
							   );			
			vc_add_param('vc_row',$attributes);			
			
			
			
			$attributes = array(
							      "type" => "textfield",
							      "heading" => esc_html__("Padding Top", "webnus_framework"),
							      "param_name" => "blox_padding_top",
							      "description" => esc_html__("Blox Top Padding in px format", "webnus_framework"),
								  "value"=>'',
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3','5'))
							   );			
			vc_add_param('vc_row',$attributes);
						
			$attributes = array(
							     "type" => "textfield",
							      "heading" => esc_html__("Padding Bottom", "webnus_framework"),
							      "param_name" => "blox_padding_bottom",
							      "description" => esc_html__("Blox Bottom Padding in px format", "webnus_framework"),
								  "value"=>'',
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3','5'))
							   );			
			vc_add_param('vc_row',$attributes);
			
			
			
			$attributes = array(
							     "type" => "dropdown",
							      "heading" => esc_html__("Dark or Light?", "webnus_framework"),
							      "param_name" => "blox_dark",
							      "description" => esc_html__("If you choose Dark, Background Color goes dark and Text Color goes light<br/>If you choose Light, Background Color goes Light and Text Color goes dark", "webnus_framework"),
								  "value"=>array( 'Light'=>'false','Dark'=>'true'),
								  "dependency"=>array('element'=>'row_type','value'=>array('2','3','5'))
							   );			
			vc_add_param('vc_row',$attributes);
			
			$attributes = array(
							      "type" => "textfield",
							      "heading" => esc_html__("Extra Class", "webnus_framework"),
							      "param_name" => "blox_class",
							      "description" => esc_html__("Predefined colors are greenbox,redbox,bluebox,yellowbox,gray. To use custom color please use below Cutom Background Color", "webnus_framework"),
								  "value"=>"",
								  "dependency"=>array('element'=>'row_type','value'=>array('0', '1', '2','3','5'))
							   );			
			vc_add_param('vc_row',$attributes);
			

			

			$attributes = array(
							     "type" => "colorpicker",
							      "heading" => esc_html__("Background Color", "webnus_framework"),
							      "param_name" => "blox_bgcolor",
							      "description" => esc_html__("Select Custom Background color", "webnus_framework"),
								  "value"=>'',
								  "dependency"=>array('element'=>'row_type','value'=>array('2'))
							   );			
			vc_add_param('vc_row',$attributes);			
			
			$attributes = array(
							     "type" => "textfield",
							      "heading" => esc_html__("Speed(Parallax)", "webnus_framework"),
							      "param_name" => "parallax_speed",
							      "description" => esc_html__("Select Parallax scroll speed in number format Example: 6", "webnus_framework"),
								  "value"=>"6",
								  "dependency"=>array('element'=>'row_type','value'=>array('3'))
							   );			
			vc_add_param('vc_row',$attributes);			
			
			$attributes = array(
									"type"=>'textfield',
									"heading"=>esc_html__('Title', 'webnus_framework'),
									"param_name"=> "process_title",
									"value"=>"",
									"description" => esc_html__( "ProcessBox Title", 'webnus_framework'),
									"dependency"=>array('element'=>'row_type','value'=>array('4'))
							   );			
			vc_add_param('vc_row',$attributes);			
							
			$attributes = array(
									"type"=>'textfield',
									"heading"=>esc_html__('Subtitle', 'webnus_framework'),
									"param_name"=> "process_subtitle",
									"value"=>"",
									"description" => esc_html__( "ProcessBox Subtitle", 'webnus_framework'),
									"dependency"=>array('element'=>'row_type','value'=>array('4'))
									   );			
			vc_add_param('vc_row',$attributes);			
			
			$attributes = array(
									"type"=>'dropdown',
									"heading"=>esc_html__('Process Count', 'webnus_framework'),
									"param_name"=> "process_count",
									"value"=>array("3"=>"3","4"=>"4", "5"=>"5"),
									"description" => esc_html__( "How many process items in process box?", 'webnus_framework'),
									"dependency"=>array('element'=>'row_type','value'=>array('4'))
									   );			
			vc_add_param('vc_row',$attributes);			
						
			$attributes = array(
							        "type" => "iconfonts",
							        "heading" => esc_html__( "Top Icon", 'webnus_framework' ),
							        "param_name" => "process_icon",
							        'value'=>'',
							        "description" => esc_html__( "Select ProcessBox Top Icon", 'webnus_framework'),
							        "dependency"=>array('element'=>'row_type','value'=>array('4'))
									   );			
			vc_add_param('vc_row',$attributes);		
						
			$attributes = array(
									"type"=>'dropdown',
									"heading"=>esc_html__('Pattern', 'webnus_framework'),
									"param_name"=> "video_pattern",
									"value"=>array('Enable'=>'true','Disable'=>'false'),
									"description" => esc_html__( "Display Foreground dotted Pattern", 'webnus_framework'),
									"dependency"=>array('element'=>'row_type','value'=>array('5'))
										   );			
			vc_add_param('vc_row',$attributes);			
						
					

			
			
			$attributes = array(
				"type"=>'dropdown',
				"heading"=>esc_html__('Overlay pattern', 'webnus_framework'),
				"param_name"=> "row_pattern",
				"value"=>array('No Pattern'=>'','Pattern 1'=>'max-pat','Pattern 2'=> 'max-pat2'),
				"description" => esc_html__( "Overlay Pattern for [blox,parallax]", 'webnus_framework'),
				"dependency"=>array('element'=>'row_type','value'=>array('2','3'))
				
			);
			vc_add_param('vc_row',$attributes);		
			$attributes = array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Overlay color', 'webnus_framework'),
				"param_name"=> "row_color",
				"value"=>'',
				"description" => esc_html__( "Overlay Color  for [blox,parallax]", 'webnus_framework'),
				"dependency"=>array('element'=>'row_type','value'=>array('2','3'))
				
			);
			vc_add_param('vc_row',$attributes);				
			
			/*
			 * max slider
			 */			
			
			$attributes =	array(
				      "type" => "attach_image",
				      "heading" => esc_html__("Slide 1", "webnus_framework"),
				      "param_name" => "maxslider_image1",
				      "description" => esc_html__("Select Slide 1 Image", "webnus_framework"),
					  "value"=>"",
					  "dependency"=>array('element'=>'row_type','value'=>array('6'))
			    );
			vc_add_param('vc_row',$attributes);
			$attributes =	array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Slide 2", "webnus_framework"),
		      "param_name" => "maxslider_image2",
		      "description" => esc_html__("Select Slide 2 Image", "webnus_framework"),
			  "value"=>"",
			  "dependency"=>array('element'=>'row_type','value'=>array('6'))
		    );
		    vc_add_param('vc_row',$attributes);
			$attributes =	array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Slide 3", "webnus_framework"),
		      "param_name" => "maxslider_image3",
		      "description" => esc_html__("Select Slide 3 Image", "webnus_framework"),
			  "value"=>"",
			  "dependency"=>array('element'=>'row_type','value'=>array('6'))
		    );
		    vc_add_param('vc_row',$attributes);
			$attributes =	array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Slide 4", "webnus_framework"),
		      "param_name" => "maxslider_image4",
		      "description" => esc_html__("Select Slide 4 Image", "webnus_framework"),
			  "value"=>"",
			  "dependency"=>array('element'=>'row_type','value'=>array('6'))
		    );
		    vc_add_param('vc_row',$attributes);
			$attributes =	array(
		      "type" => "attach_image",
		      "heading" => esc_html__("Slide 5", "webnus_framework"),
		      "param_name" => "maxslider_image5",
		      "description" => esc_html__("Select Slide 5 Image", "webnus_framework"),
			  "value"=>"",
			  "dependency"=>array('element'=>'row_type','value'=>array('6'))
		    );
			vc_add_param('vc_row',$attributes);
			$attributes =	array(
				"type"=>'dropdown',
				"heading"=>esc_html__('Parallax Images', 'webnus_framework'),
				"param_name"=> "maxslider_parallax",
				"value"=>array('Yes'=>'true','No'=>'false'),
				"description" => esc_html__( "Parallax images for maxslider", 'webnus_framework'),
				"dependency"=>array('element'=>'row_type','value'=>array('6'))
				
			);
			vc_add_param('vc_row',$attributes);
			$attributes =	array(
				"type"=>'dropdown',
				"heading"=>esc_html__('Pattern Images', 'webnus_framework'),
				"param_name"=> "maxslider_pattern",
				"value"=>array('Yes'=>'true','No'=>'false'),
				"description" => esc_html__( "Pattern images for maxslider", 'webnus_framework'),
				"dependency"=>array('element'=>'row_type','value'=>array('6'))
				
			);
			vc_add_param('vc_row',$attributes);			
						
		}// END OF FUNCTION
		
	}
	
	add_action('admin_init', 'webnus_setup_vc_row');
	
} // End of if statement


?>