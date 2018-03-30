<?php
		$colorpickerdescription = __('Click within the color field or on the circular element of the color field to open up the colorpicker. In the colorpicker select a color by dragging the circular object within the colorgrid. You can also insert manually a valid html color code. If you would like to turn back to the default color, just delete the value and make sure to save the settings.','rt_theme_admin');
		$globalcolordescription = __('Select and set a color style to use or create a custom color style for this styling group. <br /><br />If set to &#39;<strong>use theme defaults</strong>&#39 the colors from the color style as set in the global styling panel, first panel in the <strong>theme styling options</strong>, are used. <br /><br />If set to &#39;<strong>custom</strong>&#39; a new group of color settings is created and can be set for this styling group. The styling group can be called at different levels in the template builder. You can also select and set the colors to one of the other styling groups. This way they will all have the same color settings.','rt_theme_admin');		
		$globalbackgrounddescription = array('generalinfo' => __("Select and set a background style to use or create a custom background setting for this styling group.<br /><br />If set to &#39;<strong>use theme defaults</strong>&#39; the background style as set in the global styling panel, first panel of the <strong>theme styling options</strong>, is used. <br /><br />If set to &#39;<strong>custom</strong>&#39; a new group of background settings is created for this styling group. The styling group can be called at different levels in the template builder. You can also select and set the background to one of the other styling groups. This way they all have the same background settings.",'rt_theme_admin'),
											 'uploadimage' => __('Add a background image by the use of the upload button or insert a valid url to a image to use as a background. <strong>Note</strong> : Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),
											 'alignmentmode'=>__('Select and set alignment for the background image.','rt_theme_admin'),
											 'repeatmode'=>__('Select and set repeat mode direction for the background image.','rt_theme_admin'),
											 'attachmentmode'=>__('Select and set fixed or scroll mode for the background image.','rt_theme_admin'),
											 'coveragemode'=> __('Select and set size / coverage behaviour for the background image.','rt_theme_admin'));
		
		$options    = array (

		array(	 
		"type"    => "div_start",
		"id"    => "styling_options_parts", 
		),	

 

			/* ----------------------------------------------------	


				TAB 1 -  GLOBAL 


			------------------------------------------------------- */ 

			array(	 
				"type"  => "div_start",
				"id"    => "info",
				"div_class" => "active"
			),	  

			array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("Click on the sub-links (under the Styling Options link) to alter each of the available color settings. Navigate your mouse cursor over the following image to get a better idea about the areas.</strong>",'rt_theme_admin'),
				"type"    => "info"
			),

			array(	 

				"type" => "html_content",
				"value" => '
					<div class="style_parts">
						<div class="icon-reply" data-desc="Top Links Area" style="height:11px;"></div>
						<div class="icon-reply" data-desc="Header Logo Area" style="height:35px;"></div>
						<div class="icon-reply" data-desc="Navigation Bar" style="height:18px;"></div>
						<div class="icon-reply" data-desc="Sub-Header Area" style="height:119px;"></div> 
						<div class="icon-reply" data-desc="Default Content Area" style="height:64px;"></div>
						<div class="icon-reply" data-desc="Alternate Content Area 1" style="height:56px;"></div>
						<div class="icon-reply" data-desc="Default Content Area" style="height:118px;"></div> 
						<div class="icon-reply" data-desc="Footer Area" style="height:47px;"></div>
						<div class="icon-reply" data-desc="Sub-Footer Area" style="height:29px;"></div> 
				</div>
				',
				"hr"=> "true",
			),

			array(	 
				"type"    => "div_end"
			),

			/* ----------------------------------------------------	


				TAB 1 -  GLOBAL 


			------------------------------------------------------- */ 

			array(	 
				"type"  => "div_start",
				"id"    => "global"
			),	  

					array(
					"name"    => __("Info",'rt_theme_admin'),
					"desc"    => __("GLOBAL STYLE. Select and set a default style and background to be used throughout the complete website. The default style will apply to all content in the website unless you adjust and replace these colors with your own color settings. You can adjust the style, and thus alter the look, for each of the available theme sections (header, navigation, footer etc.) by modifying the individual color- & background settings for that group.",'rt_theme_admin'),
					"type"    => "info"),


					array(
					"name" 		=> __("GLOBAL STYLING OPTIONS",'rt_theme_admin'), 
					"type" 		=> "heading"),		

							array(
							"name"      => __("Theme Default Color Style",'rt_theme_admin'),
							"desc"      => __("Select and set one of the available default color styles for your theme.",'rt_theme_admin'),
							"id"        => RT_THEMESLUG."_18_style",
							"options"   =>	array(
											"orange"   => "Yellow Ochre Style", 
											"lightblue"     => "Blue Sky Style",
											"blue"     => "Blue Steel Style", 
											"paleturquoise" => "Pale Winter Style",
											"brown"   => "Brown Sand Style", 	
											"green"   => "Green Sea Style", 
											"lightgreen"   => "Green Grey Style",  											
											"rose"   => "Rose Red Style", 	 	
											"gold"   => "Gold Beige Style",									
											),
							"default"   => "orange", 
							"hr"		=> "true",
							"type"      => "select"),  

							array(	 
								"type"    => "div_start",
								"div_class"   => "options_set_holder color_set",
							),	  		

								array(
								"name"      => __("Theme Layout Style",'rt_theme_admin'),
								"desc"      => __('Select and set the default theme layout style (boxed mode or full width mode).','rt_theme_admin'),
								"id"        => RT_THEMESLUG."_content_layout",
								"options"   =>	array(
												"wide"   => "Full Width", 
												"boxed-body"  => "Boxed",
												"half-boxed"  => "Half Boxed", 					
												),
								"default"   => "wide", 
								"class"     => "div_controller",
								"type"      => "select"),  


									array( 
										"div_class"   => "hidden_options_set",
										"type"    => "div_start",

									),

										array(	 
											"type"    => "div_start",
											"div_class"   => "options_set_holder",
										),	  									

											array(
											"name"      => __("Background settings",'rt_theme_admin'),
											"desc"      => __('Select and set to use the default theme background or create a new &#39;global background setting&#39;.','rt_theme_admin'),
											"id"        =>  RT_THEMESLUG."_page_background", 
											"options"   =>  array(
												"default"  => "Use the default theme background", 
												"new"      => "Create a new global background setting",
												), 
											"type"      => "select", 
											"class"     => "div_controller",
											),	 

												array( 
													"div_class"   => "hidden_options_set",
													"type"    => "div_start",

												),

														array(
														"name"      => __("Background Image",'rt_theme_admin'),
														"desc" 		=> $globalbackgrounddescription['uploadimage'],
														"id"        => RT_THEMESLUG."_page_background_image_url", 
														"type"      => "upload"),

														array(
														"name"      => __("Background Color",'rt_theme_admin'),
														"desc" 		=> $colorpickerdescription,
														"id"        => RT_THEMESLUG."_page_background_color",
														"type"      => "colorpicker"),
														 
														array(
														"name"      => __("Position",'rt_theme_admin'),
														"desc" 		=> $globalbackgrounddescription['alignmentmode'],
														"id"        => RT_THEMESLUG."_page_background_position",
														"options"	=> array(		
																			"right top"     => "Right Top",
																			"right center"  => "Right Center",
																			"right bottom"  => "Right Bottom",
																			"left top"      => "Left Top",
																			"left center"   => "Left Center",
																			"left bottom"   => "Left Bottom",
																			"center top"    => "Center Top",
																			"center center" => "Center Center",
																			"center bottom" => "Center Bottom",
																		),  
														"type"      => "select"),

														array(
														"name"      => __("Repeat",'rt_theme_admin'),
														"desc" 		=> $globalbackgrounddescription['repeatmode'],
														"id"        => RT_THEMESLUG."_page_background_repeat",
														"options"   => array(		
																		"repeat"       =>"Tile",
																		"repeat-x"     =>"Tile Horizontally",
																		"repeat-y"     =>"Tile Vertically",
																		"no-repeat"    =>"No Repeat"
																		),  
														"type"      => "radio",
														"default"	=> "repeat"
														),

														array(
														"name"      => __("Attachment",'rt_theme_admin'),
														"desc" 		=> $globalbackgrounddescription['attachmentmode'],
														"id"        => RT_THEMESLUG."_page_background_attachment",
														"options"   => array(		
																		"scroll"        =>"Scroll",
																		"fixed"         =>"Fixed"  
																		),  
														"default"	=> "scroll",
														"type"      => "radio"
														),  

														array(
														"name"      => __("Background Size",'rt_theme_admin'),
														"desc" 		=> $globalbackgrounddescription['coveragemode'],
														"id"        => RT_THEMESLUG."_page_background_size",
														"options"   => array(		
																		"auto auto" =>"Auto",
																		"cover" =>"Cover",
																		"contain" =>"Contain",  
																		"100% auto" =>"100%",
																		"50% auto" =>"50%",  
																		"25% auto" =>"25%",  
																		),  
														"default"	=> "auto auto",
														"type"      => "select"
														),  													

												array(	 
													"type"    => "div_end"
												),																

											array(	 
												"type"    => "div_end"
											),										


								array(	 
									"type"    => "div_end"
								),										


							array(	 
								"type"    => "div_end"
							),				 															 

			array(	 
				"type"    => "div_end"
			),				 

			/* ----------------------------------------------------	


				TAB 2 -  PRIMARY CONTENT AREA


			------------------------------------------------------- */ 

			array(	 
				"type"    => "div_start",
				"id"    => "content1",
			),	  

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("DEFAULT CONTENT AREA. The default content area is the area in your page where the actual page, post, product, portfolio, etc. content is shown, the so called &#39;page inner&#39;, &#39;the body content&#39;, &#39;the story you want to tell&#39;. In here the colors and background settings for this area can be adjusted and set.",'rt_theme_admin'),
				"type"    => "info"),


				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE DEFAULT CONTENT AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_ca1_colorset", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom color set",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom color set of",
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),							
						"optgroup_end 3"=>"",
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),
 
									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
											
									array(
									"name"      => __("Primary Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_ca1_primary', 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_ca1_font', 
									"dont_save" => "true",
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_light_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_headings", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_heading_links", 
									"dont_save" => "true",
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),		
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_highlighted",
									"dont_save" => "true",
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),














					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND FOR THE DEFAULT CONTENT AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_ca1_background", 
					"options"   =>  array(

						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom background",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom background of", 
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'), 
						"optgroup_end 3"=>"",

						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_ca1_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca1_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_ca1_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_ca1_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_ca1_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_ca1_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",  													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),				 


			/* ----------------------------------------------------	


				TAB 3 -  SECONDARY CONTENT AREA


			------------------------------------------------------- */ 

			array(	 
				"type"    => "div_start",
				"id"    => "content2",
			),	  

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("ALTERNATE CONTENT AREA 1. The alternate content area 1 is a preset of colors to be used in any of your pages for the area where actual page, post, product, portfolio, etc. content is shown. In here the colors and background settings for this area can be adjusted and set.<br /><br /><strong>Note</strong> : The alternate preset colors need to be assigned to a header module, row modules, etc. in the template builder or to be used as preset colors for one of the other color area&#39;s here in the theme styling options (header, footer, subfooter, etc.). This way you can easily switch colors throughout the whole theme.",'rt_theme_admin'),				
				"type"    => "info"),

				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE ALTERNATE CONTENT AREA 1",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_ca2_colorset", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom color set",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom color set of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",			
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
											
									array(
									"name"      => __("Primary Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_ca2_primary', 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_ca2_font', 
									"dont_save" => "true",
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_light_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_headings", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_heading_links", 
									"dont_save" => "true",
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),		
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_highlighted",
									"dont_save" => "true",
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE ALTERNATE CONTENT AREA 1",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_ca2_background", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom background",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom background of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",

						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_ca2_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca2_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_ca2_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_ca2_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_ca2_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_ca2_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",  													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),				 


			/* ----------------------------------------------------	


				TAB 4 -  THIRD CONTENT AREA


			------------------------------------------------------- */ 


			array(	 
				"type"    => "div_start",
				"id"    => "content3",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("ALTERNATE CONTENT AREA 2. The alternate content area 2 is a preset of colors to be used in any of your pages for the area where actual page, post, product, portfolio, etc. content is shown. In here the colors and background settings for this area can be adjusted and set.<br /><br /><strong>Note</strong> : The alternate preset colors need to be assigned to a header module, row modules, etc. in the template builder or to be used as preset colors for one of the other color area&#39;s here in the theme styling options (header, footer, subfooter, etc.). This way you can easily switch colors throughout the whole theme.",'rt_theme_admin'),				
				"type"    => "info"),

				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE ALTERNATE CONTENT AREA 2",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_ca3_colorset", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom color set",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom color set of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),	 
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",	
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
											
									array(
									"name"      => __("Primary Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_ca3_primary', 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_ca3_font', 
									"dont_save" => "true",
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_light_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_headings", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_heading_links", 
									"dont_save" => "true",
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),		
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_highlighted",
									"dont_save" => "true",
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE ALTERNATE CONTENT AREA 2",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_ca3_background", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom background",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom background of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),	 
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_ca3_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_ca3_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_ca3_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_ca3_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_ca3_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_ca3_background_size",
									"options"   => array(		
													"auto auto" =>"Auto", 
													"cover" =>"Cover",
													"contain" =>"Contain",  													 
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  														


					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),				

  
			/* ----------------------------------------------------	


				TAB 5 -  HEADER CONTENT AREA


			------------------------------------------------------- */ 


			array(	 
				"type"    => "div_start",
				"id"    => "header",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("SUB-HEADER AREA. The header area is the area below the main navigation menu where the sliders, titles, breadcrumbs(optional) are shown. In here the colors and background settings for this area can be adjusted and set.",'rt_theme_admin'),
				"type"    => "info"),


				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE SUB-HEADER AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_header_colorset", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom color set",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom color set of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'), 
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",			
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
											
									array(
									"name"      => __("Primary Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_header_primary', 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_header_font', 
									"dont_save" => "true",
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_light_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_headings", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_heading_links", 
									"dont_save" => "true",
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_highlighted",
									"dont_save" => "true",
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE SUB-HEADER AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_header_background", 
					"options"   =>  array( 
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom background",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom background of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'), 
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",

						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_header_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_header_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_header_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_header_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_header_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  		

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),				


			/* ----------------------------------------------------	


				TAB 6 -  FOOTER CONTENT AREA


			------------------------------------------------------- */ 


			array(	 
				"type"    => "div_start",
				"id"    => "footer",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("FOOTER AREA. The footer area is the area at the bottom of your page above the Sub-Footer Area (the copyright section) where the content of footer widgets containers are shown. In here the colors and background settings for this area can be adjusted and set. <br /><br /><strong>Note</strong> : The Footer widgets will be displayed in one to five columns as set in the theme footer settings and will display the widgets as added in each of the available footer widgets containers in the wordpress widgets section. ",'rt_theme_admin'),
				"type"    => "info"),


				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE FOOTER AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_footer_colorset", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom color set",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom color set of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'), 
						"optgroup_end 3"=>"",	
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
											
									array(
									"name"      => __("Primary Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_footer_primary', 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_footer_font', 
									"dont_save" => "true",
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_light_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_headings", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_heading_links", 
									"dont_save" => "true",
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,									
									"id"        => RT_THEMESLUG."_footer_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_highlighted",
									"dont_save" => "true",
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE FOOTER AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_footer_background", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom background",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom background of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'), 
						"optgroup_end 3"=>"",
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_footer_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_footer_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_footer_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_footer_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_footer_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_footer_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  		

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),			


			/* ----------------------------------------------------	


				TAB 7 -  MAIN NAVIGATION


			------------------------------------------------------- */ 

			array(	 
				"type"    => "div_start",
				"id"    => "main_navigation",
			),	  

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("NAVIGATION AREA. The navigation area is the area in your website where the main navigation is shown. In here the colors for the menu (items) can be adjusted and set.",'rt_theme_admin'),
				"type"    => "info"),

				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE NAVIGATION AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Settings",'rt_theme_admin'),
					"desc" 		=> __('Select and set color style to use or create a custom color style for the navigation area. <br /><br />If set to &#39;<strong>use theme defaults</strong>&#39 the colors settings as set in the global styling (first) panel in the <strong>theme styling options</strong> are used. <br /><br />If set to &#39;<strong>Create a new one for this area</strong>&#39; a new group of color settings for the navigation area is created and can be set for the available elements.','rt_theme_admin'),
					"id"        =>  RT_THEMESLUG."_navigation_colorset", 
					"options"   =>  array(
						"default"  => "Use theme defaults", 
						"new"      => "Create a new one for this area",
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start", 
					),


						array(
						"name" 		=> __("ALL MENU ITEMS",'rt_theme_admin'), 
						"type" 		=> "heading"),	

						array(
						"name"        => __("Font Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_menu_font_color", 
						"type"        => "colorpicker"),

						array(
						"name"        => __("Subtitle Font Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_subtitle_font_color", 
						"type"        => "colorpicker"),

						array(
						"name" 		=> __("ACTIVE MENU ITEM & HOVER STATE",'rt_theme_admin'), 
						"type" 		=> "heading"),	
 

 						array(
						"name"        => __("Top & Left Indicator Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_active_menu_border_color",		   
						"type"        => "colorpicker"
						),

						array(
						"name"        => __("Background Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_active_menu_background_color",		   
						"type"        => "colorpicker"
						),
						
						array(
						"name"        => __("Font Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_active_menu_font_color",
						"dont_save"   => "true",	 
						"type"        => "colorpicker"),
 
 						array(
						"name"        => __("Subtitle Font Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_active_subtitle_font_color", 
						"type"        => "colorpicker"),


						array(
						"name" 		=> __("NAVIGATION BAR & SUB MENUS",'rt_theme_admin'), 
						"type" 		=> "heading"),	

						array(
						"name"        => __("Background Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_bar_background_color",		   	
						"type"        => "colorpicker"
						),

						array(
						"name"      => __("Background Texture",'rt_theme_admin'),
						"desc" 		=> $globalbackgrounddescription['uploadimage'],
						"id"        => RT_THEMESLUG."_bar_background_image", 
						"type"      => "upload"),

						array(
						"name"        => __("Border Color",'rt_theme_admin'),
						"desc" 		=> $colorpickerdescription,
						"id"          => RT_THEMESLUG."_bar_border_color",		   	
						"type"        => "colorpicker"
						),


					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),				


			/* ----------------------------------------------------	


				TAB 8 -  CUSTOM CSS


			------------------------------------------------------- */ 

			array(	 
				"type"    => "div_start",
				"id"    => "custom_css",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("CUSTOM CSS STYLING. Add in here all your custom css adjustments to override the Theme default css styles for the selectors of your choice.<br /><br /><strong>Note</strong> : Do not include &lt;style&gt;&lt;/style&gt; tag(s) or any html tag(s). Be aware that incorrect (css) coding will result in failure of all the (css)code below that point. ",'rt_theme_admin'),
				"type"    => "info"),


					array(
					"name" 		=> __("CUSTOM CSS CODES",'rt_theme_admin'), 
					"type" 		=> "heading"),		

					array(
					"name"      => __("Custom CSS Codes",'rt_theme_admin'),
					"desc"      => __("This field can be used to add any custom css (adjustments) to override the theme default css coding. <br /><br /><strong>Note</strong> : Do not include &lt;style&gt;&lt;/style&gt; tag(s) or any html tag(s) in this area as that will cause any css, below the point where you added those tags, to fail from working. <br /><br /><strong>Note</strong> : Use correct css coding syntax (open and close properly). Incorrect code will also cause any other code below that point to fail from working. <br /><br /><strong>Note</strong> : If custom css coding does not work review your code first before submitting a thread on the support forum. In most cases (99%) a typo has been made or the incorrect selector name has been used. A simple test, to check if the code is working, is to put the last added custom css code into the top of this custom css field. This way you know for sure no error from preceding code is bugging you and preventing the last added code from working.<br /><br /><strong>Note</strong> : To get a element/selector name checkout the theme css files in the css folder which is located as a subfolder of the theme folder or install the firebug addon in firefox and inspect the element on the fly in the front of the website.",'rt_theme_admin'),
					"id"        => RT_THEMESLUG."_custom_css",
					"hr"        => "true", 
					"type"      => "textarea"),

 
			array(	 
				"type"    => "div_end"
			),	



			/* ----------------------------------------------------	


				TAB 9 -  LOGO BAR 


			------------------------------------------------------- */ 


			array(	 
				"type"    => "div_start",
				"id"    => "header_logo",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("HEADER LOGO AREA. The header logo area is the area at the top of your page between the top-bar and the main navigation where the logo, titles, header widgets are shown. In here the colors and background settings for this area can be adjusted and set.",'rt_theme_admin'),
				"type"    => "info"),

				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE HEADER LOGO AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_header_logo_colorset", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom color set",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom color set of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",	
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
											
									array(
									"name"      => __("Primary Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_header_logo_primary', 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG.'_header_logo_font', 
									"dont_save" => "true",
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_light_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_headings", 
									"dont_save" => "true",
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_heading_links", 
									"dont_save" => "true",
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,									
									"id"        => RT_THEMESLUG."_header_logo_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_highlighted",
									"dont_save" => "true",
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE HEADER LOGO AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_header_logo_background", 
					"options"   =>  array(
						"optgroup_start 1"=>"Theme Defaults",
							"default"  => __("Use theme defaults",'rt_theme_admin'), 						
						"optgroup_end 1"=>"",
						
						"optgroup_start 2"=>"Create a custom background",
							"new"      => "Custom",								
						"optgroup_end 2"=>"",

						"optgroup_start 3"=>"Use custom background of",
							"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
							"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
							"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
							"header"  => __("Sub-Header Area ",'rt_theme_admin'),
							"footer"  => __("Footer Area",'rt_theme_admin'),
						"optgroup_end 3"=>"",
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_header_logo_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_header_logo_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_header_logo_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_header_logo_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_header_logo_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_header_logo_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  		

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),						


			/* ----------------------------------------------------	


				TAB 10 -  TOP BAR 


			------------------------------------------------------- */ 


			array(	 
				"type"    => "div_start",
				"id"    => "top_bar",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("TOP LINKS AREA. The header top-bar area is the area at the utmost top of your page where the woocommerce logins, shopcart, search, custom menu (optional), social icons etc. are shown. In here the colors and background settings for this area can be adjusted and set.",'rt_theme_admin'),
				"type"    => "info"),


				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE HEADER TOP-BAR AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_top_bar_colorset", 
					"options"   =>  array( 
							"default"  => __("Use theme defaults",'rt_theme_admin'),   
							"new"      => __("Create a custom color set",'rt_theme_admin'),  
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
  
									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,									
									"id"        => RT_THEMESLUG."_top_bar_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_top_bar_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_top_bar_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_top_bar_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE HEADER TOP-BAR AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_top_bar_background", 
					"options"   =>  array(
							"default"  => __("Use theme defaults",'rt_theme_admin'),   
							"new"      => __("Create a custom background",'rt_theme_admin'),  
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_top_bar_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_top_bar_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_top_bar_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_top_bar_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_top_bar_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_top_bar_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  		

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),	


			/* ----------------------------------------------------	


				TAB 11 -  BOTTOM BAR 


			------------------------------------------------------- */ 


			array(	 
				"type"    => "div_start",
				"id"    => "bottom_bar",
			),	 

				array(
				"name"    => __("Info",'rt_theme_admin'),
				"desc"    => __("SUB-FOOTER AREA. The Sub-Footer Area is the area at the bottom of your page where the copyright section and social icons are shown. In here the colors and background settings for this area can be adjusted and set.",'rt_theme_admin'),
				"type"    => "info"),
				

				//COLOR SET
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("COLOR SETTINGS FOR THE SUB-FOOTER AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc" 		=> $globalcolordescription,
					"id"        =>  RT_THEMESLUG."_bottom_bar_colorset", 
					"options"   =>  array( 
							"default"  => __("Use theme defaults",'rt_theme_admin'),   
							"new"      => __("Create a custom color set",'rt_theme_admin'),  
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(							
									"type" 		=> "col_start",
									"holder_class" => "box_border paddings heading_size",
									"layout" 	=> "two"
									),
  
  									array(
									"name"      => __("Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,									
									"id"        => RT_THEMESLUG."_bottom_bar_font", 
									"dont_save" => "true",
									"type"      => "colorpicker"),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,									
									"id"        => RT_THEMESLUG."_bottom_bar_link", 
									"dont_save" => "true",
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_bottom_bar_link_hover",
									"dont_save" => "true",
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_bottom_bar_border",
									"dont_save" => "true",
									"type"      => "colorpicker"),		  
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_bottom_bar_social_media",
									"dont_save" => "true",
									"type"      => "colorpicker"),		
		 
		 							array(							
									"type" 		=> "col_end"
									),

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	


				//BACKGROUND
				array(	 
					"type"    => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name" 		=> __("BACKGROUND SETTINGS FOR THE SUB-FOOTER AREA",'rt_theme_admin'), 
					"type" 		=> "heading"),		


					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc" 		=> $globalbackgrounddescription['generalinfo'],
					"id"        =>  RT_THEMESLUG."_bottom_bar_background", 
					"options"   =>  array(
							"default"  => __("Use theme defaults",'rt_theme_admin'),   
							"new"      => __("Create a custom background",'rt_theme_admin'),  
						), 
					"type"      => "select", 
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",

					),

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['uploadimage'],
									"id"        => RT_THEMESLUG."_bottom_bar_background_image_url", 
									"type"      => "upload"),

									array(
									"name"      => __("Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => RT_THEMESLUG."_bottom_bar_background_color",
									"type"      => "colorpicker"),
									 
									array(
									"name"      => __("Position",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['alignmentmode'],
									"id"        => RT_THEMESLUG."_bottom_bar_background_position",
									"options"	=> array(		
														"right top"     => "Right Top",
														"right center"  => "Right Center",
														"right bottom"  => "Right Bottom",
														"left top"      => "Left Top",
														"left center"   => "Left Center",
														"left bottom"   => "Left Bottom",
														"center top"    => "Center Top",
														"center center" => "Center Center",
														"center bottom" => "Center Bottom",
													),  
									"type"      => "select"),

									array(
									"name"      => __("Repeat",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['repeatmode'],
									"id"        => RT_THEMESLUG."_bottom_bar_background_repeat",
									"options"   => array(		
													"repeat"       =>"Tile",
													"repeat-x"     =>"Tile Horizontally",
													"repeat-y"     =>"Tile Vertically",
													"no-repeat"    =>"No Repeat"
													),  
									"type"      => "radio",
									"default"	=> "repeat"
									),

									array(
									"name"      => __("Attachment",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['attachmentmode'],
									"id"        => RT_THEMESLUG."_bottom_bar_background_attachment",
									"options"   => array(		
													"scroll"        =>"Scroll",
													"fixed"         =>"Fixed"  
													),  
									"default"	=> "scroll",
									"type"      => "radio"
									),  

									array(
									"name"      => __("Background Size",'rt_theme_admin'),
									"desc" 		=> $globalbackgrounddescription['coveragemode'],
									"id"        => RT_THEMESLUG."_bottom_bar_background_size",
									"options"   => array(		
													"auto auto" =>"Auto",
													"cover" =>"Cover",
													"contain" =>"Contain",													  
													"100% auto" =>"100%",
													"50% auto" =>"50%",  
													"25% auto" =>"25%",  
													),  
									"default"	=> "auto auto",
									"type"      => "select"
									),  		

					array(	 
						"type"    => "div_end"
					),				 							
 

				array(	 
					"type"    => "div_end"
				),	
 

			array(	 
				"type"    => "div_end"
			),				
		);
?>