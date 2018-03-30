<?php
class rt_generate_slider_box_class extends RTThemePageLayoutOptions{
	#
	#	New Slider Box
	#
	function rt_generate_slider_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName            = __("Slider", "rt_theme_admin");
			$contet_type        = "slider_box";
			$theTemplateID      = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox           = (trim($randomClass)=="") ? false : true;
			$opacity            = 1;
			$layout             = "one passive_module";
			$position           = $isNewBox ? 'open minus' :	'plus' ;
			$data_position      = 'display: none;' ; 
			$slider_script      = isset( $options["slider_script"] ) ? $options["slider_script"] : "";
			$slider_timeout     = isset( $options["slider_timeout"] ) ? $options["slider_timeout"] : "";
			$slider_height      = isset( $options["slider_height"] ) ? $options["slider_height"] : "";  
			$flex_slider_effect = isset( $options["flex_slider_effect"] ) ? $options["flex_slider_effect"] : "";
			$nivo_slider_effect = isset( $options["nivo_slider_effect"] ) ? $options["nivo_slider_effect"] : "";  
			$slider_width       = isset( $options["slider_width"] ) ? $options["slider_width"] : "";
			$image_resize       = $isNewBox ? "" : $options["image_resize"];
			$image_crop         = $isNewBox ? "" : $options["image_crop"];

			echo '<li class="ui-state-default '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
		
								
			$form_options = array (
							
					array(
							"desc" 		=> __("This module displays a slider.",'rt_theme_admin'),	 
							"hr" 		=> "true",
							"type" 		=> "info"), 	 

					array(  "type"		=> "table_start"), 
		
					array(
							"name" 		=> __("Transition Timeout (seconds)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_timeout]",
							"desc" 		=> __("Set the speed for the images cycling the slideshow.",'rt_theme_admin'),
							"hr" 		=> "true",
							"min"		=>"1",
							"max"		=>"120",
							"default"	=>"8",
							"hr"		=> true,
							"dont_save"	=> true,
							"value"		=> $slider_timeout,
							"class"		=> $randomClass,
							"type"		=> "rangeinput"),  

					array(
							"name" 		=> __("Slider Transition Effect",'rt_theme_admin'),
							"desc" 		=> __("Select and set a transition effect for this slider.",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[flex_slider_effect]", 
							"options" 	=>	array( 
												"fade"			=>	    "fade",
												"slide"			=>	    "slide", 
										 ),
							"class"		=> $randomClass,
							"value"		=> $flex_slider_effect,
							"default"	=>"slide",
							"dont_save"	=>"true",
							"type" 		=> "select"),
 
					array(
							"name" 	=> __("IMAGE RESIZE & CROP TOOLS",'rt_theme_admin'), 
							"type" 	=> "heading"), 

					array(
							"name" 		=> __("Resize Slider Images.",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[image_resize]", 
							"desc" 		=> __("Check this box to resize the slider images following the width and height values as set below.",'rt_theme_admin'),
							"class"		=> $randomClass,							
							"value"		=> $image_resize, 
							"type" 		=> "checkbox2"),

					array(
							"name" 		=> __("Crop Slider Images",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[image_crop]", 
							"desc" 		=> __("Check this box to enable the cropping feature following the width and height values as set below.",'rt_theme_admin'),
							"class"		=> $randomClass,
							"value"		=> $image_crop,
							"hr" 		=> "true",
							"type" 		=> "checkbox2"),						
					
					array(
							"name" 		=> __("Max Image Width (px)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_width]",
							"desc" 		=> __("<strong>Max Image Width (px)</strong> : Set the max. width value in pixels for the slider images. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the width or you can directly input the width value in the text field.<br /><br /><strong>Note</strong> : The &#39;Resize Slider Images&#39; option must be set to ON to use this option.",'rt_theme_admin'),
							"min"		=>"100",
							"max"		=>"4000",
							"default"	=>"1200", 
							"dont_save"	=> true,
							"value"		=> $slider_width,
							"class"		=> $randomClass,
							"type" 		=> "rangeinput"),

					array(
							"name"		=> __("Max Image Height (px)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_height]",
							"desc" 		=> __("<strong>Max Image Height (px)</strong> : Set the max. height value in pixels for the slider images. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the height or you can directly input the height value in the text field.<br /><br /><strong>Note</strong> : The &#39;Resize Slider Images&#39; option must be set to ON to use this option. ",'rt_theme_admin'),
							"min"		=>"100",
							"max"		=>"4000",
							"default"	=>"400", 
							"dont_save"	=> true,
							"value"		=> $slider_height,
							"class"		=> $randomClass,
							"type" 		=> "rangeinput"),		

					array(  "type"		=> "td_col"),

					array(
							"desc" 		=> __("CREATE SLIDES. (Press the &#39;add new slider image&#39; button to add one or more slider images)",'rt_theme_admin'),	  
							"type" 		=> "info_text_only"),

					);


			echo  $this->rt_generate_forms($form_options);
 
			//call the slides
			$options["slides"] = isset( $options["slides"] ) ? $options["slides"] : array();
			echo $this->rt_create_slides($theTemplateID,$theGroupID,$options["slides"],$randomClass);  

			$form_options = array ( array(  "type"		=> "table_end") ); 
			
			echo  $this->rt_generate_forms($form_options);
			
			echo  '</div></div></div></li>';
	}

	//create slides for the slider that embedded to the slider module
	function rt_create_slides($theTemplateID,$theGroupID,$options){

		echo '<div class="slider_creator for_slider"><ul class="slides_holder">';		 

		if ( isset( $options["slide_title"] ) ) {
			foreach ( $options["slide_title"] as $key => $value ) {

				$slide_hidden_value = ! empty( $options["slide_hidden_value"][$key] ) ? $options["slide_hidden_value"][$key] : "";
				$slide_title        = ! empty( $options["slide_title"][$key] ) ? $options["slide_title"][$key] : "";
				$slide_caption      = ! empty( $options["slide_title"][$key] ) ? $options["slide_title"][$key] : "Slide - ".intval( $key + 1 ) ;
				$slide_text         = ! empty( $options["slide_text"][$key] ) ? $options["slide_text"][$key] : "";				
				$slide_image_url    = ! empty( $options["slide_image_url"][$key] ) ? $options["slide_image_url"][$key] : "";
				$slide_link         = ! empty( $options["slide_link"][$key] ) ? $options["slide_link"][$key] : "";
				$slide_only_image   = ! empty( $options["slide_only_image"][$key] ) ? $options["slide_only_image"][$key] : "";
				$text_align         = ! empty( $options["text_align"][$key] ) ? $options["text_align"][$key] : "";
				$stretch_images     = ! empty( $options["stretch_images"][$key] ) ? $options["stretch_images"][$key] : "";


				$styling     = ! empty( $options["styling"][$key] ) ? $options["styling"][$key] : "";
				$title_color     = ! empty( $options["title_color"][$key] ) ? $options["title_color"][$key] : "";
				$title_bg_color     = ! empty( $options["title_bg_color"][$key] ) ? $options["title_bg_color"][$key] : "";
				$text_color     = ! empty( $options["text_color"][$key] ) ? $options["text_color"][$key] : "";
				$text_bg_color     = ! empty( $options["text_bg_color"][$key] ) ? $options["text_bg_color"][$key] : "";
				$title_size     = ! empty( $options["title_size"][$key] ) ? $options["title_size"][$key] : "22";
				$text_size     = ! empty( $options["text_size"][$key] ) ? $options["text_size"][$key] : "14";


				if ( $slide_hidden_value ) {
					echo '<li class="slide_options"><div class="title">'.$slide_caption.'<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

						$form_options = array (
							array(
								"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_hidden_value][]",
								"value"    	=> "1",
								"type"      => "hidden"),

							array(
								"name"      => __("Slider item Title",'rt_theme_admin'), 
								"desc"      => __('Enter a title to show within the slider item on top of the slider image or leave empty to show no title.','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_title][]",
								"value"		=> $slide_title, 
								"type"      => "text"),

							array(
								"name"      => __("Slider item Textarea",'rt_theme_admin'), 
								"desc"      => __('Enter text to show in a textarea within the slider item on top of the slider image or leave empty to show no textarea with additional information.','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_text][]",
								"value"		=> $slide_text, 
								"type"      => "textarea"),

							array(
								"name"      => __("Slider item Image",'rt_theme_admin'), 
								"desc"      => __('Put in a valid url to the image or press the upload button to upload and set a slider image or select an already uploaded image from the media library. <strong>Note</strong> : only image uploaded into the wordpress media library can be used. Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_image_url][]",
								"value"		=> $slide_image_url, 
								"type"      => "upload"),

							array(
								"name"      => __("Link",'rt_theme_admin'), 
								"desc"      => __('Put in a valid link to where the title (if set) and slider image should link to when clicked upon.','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_link][]",
								"value"		=> $slide_link, 
								"type"      => "text"), 

							array(
								"name" 		=> __("Title & Text Position",'rt_theme_admin'),
								"desc"      => __('Select and set alignment of the title and textarea.','rt_theme_admin'),								
								"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_align][]", 
								"options" 	=>	array( 
												"left"   => "Left", 								
												"right"  => "Right", 		
												"center" => "Center", 		
											 ), 
								"value"		=> $text_align,
								"default"	=>"left",
								"type" 		=> "select"),	 

							array(
								"name" 		=> __("Image Width",'rt_theme_admin'),
								"desc"      => __('Select and set the way the slider image should be displayed.','rt_theme_admin'),								
								"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][stretch_images][]", 
								"options" 	=>	array( 
												"true"   => "Display image 100% width", 								
												"false"  => "Use orginal width",  	
											 ), 
								"value"		=> $stretch_images,
								"default"	=> "true",
								"type"		=> "select"),	 



							//STYLING
							array(	 
								"type"		=> "div_start",
								"div_class"	=> "color_set options_set_holder",
							),	  				

								array(
								"name"		=> __("COLOR & FONT SIZE SETTINGS FOR THIS SLIDE",'rt_theme_admin'), 
								"type"		=> "heading"),		


								array(
								"name"		=> __("Color & Font Size",'rt_theme_admin'), 
								"id"		=>  $theTemplateID.'_'.$theGroupID."_slider_box[slides][styling][]", 
								"options"	=>  array( 
												"default"  => __("Use defaults",'rt_theme_admin'),  
												"new"      => __("Custom",'rt_theme_admin'),  
												),
								"value"		=> $styling,	
								"type"		=> "select", 
								"class"		=> "div_controller",
								),	 


								array( 
									"div_class"	=> "hidden_options_set",
									"type"		=> "div_start",

								),

									array(							
									"type"			=> "col_start",
									"holder_class"	=> "box_border paddings heading_size",
									"layout"		=> "two"
									),
											
									array(
									"name"		=> __("Title Color",'rt_theme_admin'), 
									"id"		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][title_color][]",  
									"value"		=> $title_color,	
									"type"		=> "colorpicker"									
									), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Title Background Color",'rt_theme_admin'),
									"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][title_bg_color][]", 
									"value"		=> $title_bg_color,	
									"type"      => "colorpicker"), 	
		 
		 							array(							
									"type" 		=> "col_end"
									),

									array(							
									"type" 			=> "col_start",
									"holder_class"  => "box_border paddings heading_size",
									"layout" 		=> "two"
									),
											
									array(
									"name"      => __("Textarea Color",'rt_theme_admin'), 
									"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_color][]",  
									"value"		=> $text_color,	
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Textarea Background Color",'rt_theme_admin'),
									"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_bg_color][]", 
									"value"		=> $text_bg_color,			
									"type"      => "colorpicker"), 	
		 
		 							array(							
									"type" 		=> "col_end"
									),				 


									array(							
									"type" 			=> "col_start",
									"holder_class"  => "box_border paddings heading_size",
									"layout" 		=> "two"
									),

									array(
									"name"      => __("Title Font Size (px)",'rt_theme_admin'), 
									"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][title_size][]",  
									"value"		=> $title_size,										
									"type"      => "text"
									), 
									 
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Text Font Size (px)",'rt_theme_admin'),
									"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_size][]", 
									"value"		=> $text_size,
									"type"      => "text"																	 
									),						

		 							array(							
									"type" 		=> "col_end"
									),																																	

								array(	 
									"type"    => "div_end"
								),				 							
			 

							array(	 
								"type"    => "div_end"
							),	


						); 

						echo  $this->rt_generate_forms($form_options);

					echo '</div></li>';	
				}
 
			}							
		}

		echo '</ul>';

		echo '<li class="slide_options new_slide"><div class="title">New Slide<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

			$form_options = array (
				array(
					"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_hidden_value][]",
					"type"      => "hidden"),

				array(
					"name"      => __("Slider item Title",'rt_theme_admin'), 
					"desc"      => __('Enter a title to show within the slider item on top of the slider image or leave empty to show no title.','rt_theme_admin'),													
					"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_title][]",
					"hr"        => "true",
					"type"      => "text"),

				array(
					"name"      => __("Slider item Textarea",'rt_theme_admin'), 
					"desc"      => __('Enter text to show in a textarea within the slider item on top of the slider image or leave empty to show no textarea with additional information.','rt_theme_admin'),												
					"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_text][]",
					"hr"        => "true",
					"type"      => "textarea"),

				array(
					"name"      => __("Slider item Image",'rt_theme_admin'), 
					"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_image_url][]",
					"desc"      => __('Put in a valid url to the image or press the upload button to upload and set a slider image or select an already uploaded image from the media library. <strong>Note</strong> : only image uploaded into the wordpress media library can be used. Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),								
					"hr"        => "true",
					"value"		=> "",
					"type"      => "upload"),

				array(
					"name"      => __("Link",'rt_theme_admin'), 
					"desc"      => __('Put in a valid link to where the title (if set) and slider image should link to when clicked upon.','rt_theme_admin'),													
					"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][slide_link][]",
					"hr"        => "true",
					"type"      => "text"),

				array(
					"name" 		=> __("Title & Text Position",'rt_theme_admin'),
					"desc"      => __('Select and set alignment of the title and textarea.','rt_theme_admin'),								
					"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_align][]", 
					"options" 	=>	array( 
									"left"   => "Left", 								
									"right"  => "Right", 		
									"center" => "Center", 		
								 ), 
					"value"		=> "",
					"default"	=>"left",
					"type" 		=> "select"),		 
 
				array(
					"name" 		=> __("Image Width",'rt_theme_admin'),
					"desc"      => __('Select and set the way the slider image should be displayed.','rt_theme_admin'),
					"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][stretch_images][]", 
					"options" 	=>	array( 
									"true"   => "Display image 100% width", 								
									"false"  => "Use orginal width",  	
								 ), 
					"default"	=> "true",
					"type" 		=> "select"),	

				//STYLING
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE DEFAULT CONTENT AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'), 
					"id"        =>  $theTemplateID.'_'.$theGroupID."_slider_box[slides][styling][]", 
					"options"   =>  array( 
									"default"  => __("Use defaults",'rt_theme_admin'),  
									"new"      => __("Custom",'rt_theme_admin'),  
									), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

						array(							
						"type" 			=> "col_start",
						"holder_class" 	=> "box_border paddings heading_size",
						"layout" 		=> "two"
						),
								
						array(
						"name"      => __("Title Color",'rt_theme_admin'), 
						"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][title_color][]",  
						"type"      => "colorpicker",
						"class"		=> "hidden_slide_item"
						), 
						
						array(							
						"type" 		=> "col_split",
						"layout" 	=> "two"
						),

						array(
						"name"      => __("Title Background Color",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][title_bg_color][]", 
						"type"      => "colorpicker",
						"class"		=> "hidden_slide_item"
						),  	

							array(							
						"type" 		=> "col_end"
						),

						array(							
						"type" 			=> "col_start",
						"holder_class"  => "box_border paddings heading_size",
						"layout" 		=> "two"
						),
								
						array(
						"name"      => __("Textarea Color",'rt_theme_admin'), 
						"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_color][]",  
						"type"      => "colorpicker",
						"class"		=> "hidden_slide_item"
						), 
						
						array(							
						"type" 		=> "col_split",
						"layout" 	=> "two"
						),

						array(
						"name"      => __("Textarea Background Color",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_bg_color][]", 
						"type"      => "colorpicker",
						"class"		=> "hidden_slide_item"
						), 

						array(							
						"type" 		=> "col_end"
						),				 
								
						array(							
						"type" 			=> "col_start",
						"holder_class"  => "box_border paddings heading_size",
						"layout" 		=> "two"
						),
								

						array(
						"name"      => __("Title Font Size (px)",'rt_theme_admin'), 
						"id"        => $theTemplateID.'_'.$theGroupID."_slider_box[slides][title_size][]",  
						"type"      => "text"
						), 
						 
						array(							
						"type" 		=> "col_split",
						"layout" 	=> "two"
						),

						array(
						"name"      => __("Text Font Size (px)",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slides][text_size][]", 
						"type"      => "text"																	 
						),						

							array(							
						"type" 		=> "col_end"
						),																																	

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
							
			); 

			echo  $this->rt_generate_forms($form_options);

		echo '</div></li>'; 
		echo '<button type="button" class="template_button green rt_add_new_slide icon-plus-squared-1">'.__('add new slider image','rt_theme_admin') .' </button>';  
		echo '</div>';
	}
}
?>	