<?php
class rt_generate_grid_class extends RTThemePageLayoutOptions{
	#
	#	Create Grid
	#
	public function rt_generate_grid($theGroupID,$theTemplateID,$options,$randomClass){    
			global $rt_sidebars_class;
			$saved_options = $options;

			$boxName                = __("Grid", "rt_theme_admin");
			$contet_type            = "grid";			
			$theTemplateID          = str_replace('_'.$contet_type,'',$theTemplateID);   
			$part                   = isset( $options['part'] ) ? $options['part'] : 'full' ;  			
			$header_options         = isset( $options['header_options'] ) ? $options['header_options'] : "default" ;  
			$background_options     = isset( $options['background_options'] ) ? $options['background_options'] : "default" ; 
			$background_image_url   = isset( $options['background_image_url'] ) ? $options['background_image_url'] : "" ;  
			$background_color       = isset( $options['background_color'] ) ? $options['background_color'] : "" ;  
			$background_position    = isset( $options['background_position'] ) ? $options['background_position'] : "" ;  
			$background_repeat      = isset( $options['background_repeat'] ) ? $options['background_repeat'] : "" ;  
			$background_attachment  = isset( $options['background_attachment'] ) ? $options['background_attachment'] : "" ;  
			$sidebar_id             = isset( $options['sidebar_id'] ) ? $options['sidebar_id'] : "" ;   
			$sidebar_selection      = isset( $options['sidebar_selection'] ) ? $options['sidebar_selection'] : "full" ;   			
			$breadcrumb_position    = isset( $options['breadcrumb_position'] ) ? $options['breadcrumb_position'] : "full" ;  
			$first_top_widget_name  = isset( $options['first_top_widget_name'] ) ? $options['first_top_widget_name'] : "sidebar-for-top-first" ;  
			$second_top_widget_name = isset( $options['second_top_widget_name'] ) ? $options['second_top_widget_name'] : "sidebar-for-top-second" ;  
			$isNewBox               = isset( $options['newtemplate'] ) && $options['newtemplate']=="true"  ? true : false;
			$breadcrumb             = isset( $options['breadcrumb'] )  || ( isset( $options['breadcrumb'] ) && empty( $options['breadcrumb'] ) ) ? $options['breadcrumb'] : 1 ;    
			$page_title             = isset( $options['page_title'] ) ? $options['page_title'] : "" ;   
			$display_widgets        = isset( $options['display_widgets'] ) ? $options['display_widgets'] : "" ;   
			$header_purpose         = isset( $options['header_purpose'] ) ? $options['header_purpose'] == true || $options['header_purpose'] == "1" ? true : false : false; 			
			$footer_purpose         = isset( $options['footer_purpose'] ) ? $options['footer_purpose'] == true || $options['footer_purpose'] == "1" ? true : false : false; 			
			$div_header_class       = isset ( $header_options ) && $header_options == "new" ? 'header_background_options active' : "header_background_options";
			$div_row_class          = isset ( $background_options ) && $background_options == "new" ? 'header_background_options active' : "header_background_options";
			$sidebar_selector_class = $isNewBox || $sidebar_selection=="full" ? 'sidebar_selection_list' : "sidebar_selection_list active";

			$padding_left           = isset( $options['column_options'] ) && isset( $options['column_options']['padding_left'] ) ? $options['column_options']['padding_left'] : "0";
			$padding_right          = isset( $options['column_options'] ) && isset( $options['column_options']['padding_right'] ) ? $options['column_options']['padding_right'] : "0";
			$padding_top            = isset( $options['column_options'] ) && isset( $options['column_options']['padding_top'] ) ? $options['column_options']['padding_top'] : "0";
			$padding_bottom         = isset( $options['column_options'] ) && isset( $options['column_options']['padding_bottom'] ) ? $options['column_options']['padding_bottom'] : "0";
 
			$row_padding_left           = isset( $options['row_style_options'] ) && isset( $options['row_style_options']['padding_left'] ) ? $options['row_style_options']['padding_left'] : "0";
			$row_padding_right          = isset( $options['row_style_options'] ) && isset( $options['row_style_options']['padding_right'] ) ? $options['row_style_options']['padding_right'] : "0"; 
			$row_padding_top            = isset( $options['row_style_options'] ) && isset( $options['row_style_options']['padding_top'] ) ? $options['row_style_options']['padding_top'] : "20";
			$row_padding_bottom         = isset( $options['row_style_options'] ) && isset( $options['row_style_options']['padding_bottom'] ) ? $options['row_style_options']['padding_bottom'] : "20";
			
			$custom_class         = isset( $options['row_style_options'] ) && isset( $options['row_style_options']['custom_class'] ) ? $options['row_style_options']['custom_class'] : "";
 	


			//first part of the row 		
			if($part == "first" || $part == "full" ) {

				//row class
				if( $header_purpose == "true" ){ // header row
					$row_class_name = "header_content_row";
				}elseif( $footer_purpose == "true" ){ // footer row
					$row_class_name = "footer_content_row";
				}else{
					$row_class_name = "content_row";
				}
 		  
				//close content rows holder - before footer row
				if( $footer_purpose == "true" && $part == "first"){  
					echo  '</div>';
				} 

				//row holder
				echo '<div class="grid_holder grid_'.$theTemplateID.' '.$row_class_name.'">'; 				

				if( $header_purpose == "true" ){ // header row
  
					echo '<div class="grid_options"> 
							<span class="row_title icon-right-open">'.__("Header Row",'rt_theme_admin').'</span>
							<span class="grid_options_button header active"><span class="icon-plus-squared"></span> '.__("Show Header Options",'rt_theme_admin').'</span>
							<span class="grid_options_button header hide hidden"><span class="icon-minus-squared"></span>  '.__("Hide Header Options",'rt_theme_admin').'</span> 
						</div>';						
				
				}elseif( $footer_purpose == "true" ){ // footer row 

					echo '<div class="grid_options"> 
							<span class="row_title icon-right-open">'.__("Footer Row",'rt_theme_admin').'</span>
							<span class="grid_options_button footer active"><span class="icon-plus-squared"></span> '.__("Show Footer Options",'rt_theme_admin').'</span>
							<span class="grid_options_button footer hide hidden"><span class="icon-minus-squared"></span>  '.__("Hide Footer Options",'rt_theme_admin').'</span> 
						</div>';						
																							
				}else{ // options and delete buttons - content row
 
					
					echo '<div class="row_delete" title="'.__('Delete Row','rt_theme_admin').'"></div>';
					echo '<div class="grid_options"> 
							<span class="row_title icon-right-open">'.__("Content Row",'rt_theme_admin').'</span>
							<span class="grid_options_button active"><span class="icon-plus-squared"></span> '.__("Show Row Options",'rt_theme_admin').'</span>
							<span class="grid_options_button hide hidden"><span class="icon-minus-squared"></span>  '.__("Hide Row Options",'rt_theme_admin').'</span> 
						</div>';					
				} 

				echo '<div class="grid_options_hidden">';


				if( $header_purpose == "true" ){ // header row options

					$options = array (  	 
  
							array(
								"name" => __("BREADCRUMB & TITLE",'rt_theme_admin'), 
								"type" => "heading"),	


							array(
								"name"    => __("Breadcrumb & Title Position",'rt_theme_admin'),
								"desc"    => __('Select a position for the breadcrumb menu path and the page title.','rt_theme_admin'),
								"id"      => $theTemplateID.'_'.$theGroupID."_grid[breadcrumb_position]",   
								"options" =>  array(
												"inside_header"  =>  "Inside Header Bar", 
												"inside_content" =>  "Inside Content Area",
											),
								"value"	  => $breadcrumb_position,
								"default" => "inside_header",
								"type"    => "select"
							),	

							array(
								"name" 		=> __("Show Breadcrumb Menu",'rt_theme_admin'),
								"desc"    => __('Enable (if checked) the breadcrumb menu path for this page.','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_grid[breadcrumb]",    
								"class"		=> $randomClass, 
								"check_desc"=> __('Show breadcrumb menu for this template','rt_theme_admin'),
								"value"		=> $isNewBox ? "on" : $breadcrumb,
								"type" 		=> "checkbox"						
							),  						

							array(
								"name" 		=> __("Show Page Title",'rt_theme_admin'),
								"desc"    => __('Enabled (if checked) displaying the title for this page. Note: This option will be ignored for single post pages due to it\'s special layout.','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_grid[page_title]",    
								"class"		=> $randomClass, 
								"check_desc"=> __('Display the page / post title.','rt_theme_admin'),
								"value"		=> $isNewBox ? "on" : $page_title,
								"type" 		=> "checkbox"						
							),  		

							array(
								"name" => __("TOP WIDGET AREAS",'rt_theme_admin'), 
								"type" => "heading"),	

							array(
								"name" 		=> __("First Top Widget Area",'rt_theme_admin'),
								"desc"		=> __("Select / set the first sidebar container area you want to display within this template area (row)",'rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_grid[first_top_widget_name]",
								"select"    =>__("Select",'rt_theme_admin'),
								"options"	=> $rt_sidebars_class->rt_active_sidebars,
								"class"		=> $randomClass,
								"value"		=> $first_top_widget_name, 
								"type" 		=> "select"
							),

							array(
								"name" 		=> __("Second Top Widget Area",'rt_theme_admin'),
								"desc"		=> __("Select / set the second sidebar container area that you want to display within this template area (row)",'rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_grid[second_top_widget_name]",
								"select"    =>__("Select",'rt_theme_admin'),
								"options"	=> $rt_sidebars_class->rt_active_sidebars,
								"class"		=> $randomClass,
								"value"		=> $second_top_widget_name, 
								"type" 		=> "select"
							),
					);

				//get styling options
				$options = array_merge( $options,  $this->rt_generate_grid_background_options($theGroupID,$theTemplateID,$saved_options,$randomClass, "header" ) ) ;
				
			
				}elseif( $footer_purpose == "true" ){ // footer row options

					$options = array (  	 
 
 							array(
								"name" => __("DEFAULT FOOTER WIDGETS",'rt_theme_admin'), 
								"type" => "heading"),	

							array(
								"name" 		=> __("Display Default Widgets",'rt_theme_admin'),
								"desc"		=> __("Turn OFF/ON visibility of the default footer widgets for this page.","rt_theme_admin"),
								"id"        => $theTemplateID.'_'.$theGroupID."_grid[display_widgets]",    
								"class"		=> $randomClass, 
								"value"		=> $isNewBox ? "on" : $display_widgets,
								"type" 		=> "checkbox2"						
							),  		

					);
				
				//get styling options
				$options = array_merge( $options,  $this->rt_generate_grid_background_options($theGroupID,$theTemplateID,$saved_options,$randomClass, "footer" ) ) ;

				}else{//content row options

					$options = array (  	 

							array(
								"desc"   => "Row ID: #row-".str_replace('templateid_','',$theTemplateID).'-'.$theGroupID,
								"type"    => "info" 
							),

							array(
								"name"    => __("Sidebar Location",'rt_theme_admin'),
								"desc"      => __('Select and set the layout for this template container (row).','rt_theme_admin'),								
								"id"      => $theTemplateID.'_'.$theGroupID."_grid[sidebar_selection]", 
								"options" => array("full"=>"No Sidebar","left"=>"Left Sidebar","right"=>"Right Sidebar"), 
								"value"   => $sidebar_selection,  
								"purpose" => "page_layouts", 
								"class"   => "layout_selector",
								"type"    => "radio" 
							),

							array(
								"id"      	=> $theTemplateID."_sidebar_hidden_div_start",
								"div_class"	=> $sidebar_selector_class,
								"type"    	=> "div_start" 
							), 

							array(
								"name" 		=> __("Select Sidebar (Widget Area)",'rt_theme_admin'),
								"desc"		=> __("Select and set the sidebar container area that you want to display for this template container (row)",'rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_grid[sidebar_id][]",
								"options"	=> $rt_sidebars_class->rt_active_sidebars,
								"class"		=> $randomClass,
								"value"		=> $sidebar_id,  
								"type" 		=> "selectmultiple"
							),

							array(
								"id"	=> $theTemplateID."_sidebar_hidden_div_end",
								"type"	=> "div_end" 
							), 

							//COLUMN OPTIONS
							array(	 
								"type"    => "div_start",
								"div_class"   => "options_set_holder",
							),	  				


								array(
								"name" 		=> __("ROW STYLE",'rt_theme_admin'), 
								"type" 		=> "heading"),		


								array(
								"name"      => __("Row Width",'rt_theme_admin'),
								"desc"      => __('Select and set the width for this template container (row). When set to &#39;full width&#39; the row can contain f.e. a full width (flex) slider or google map. <strong>Note</strong> : Be do adviced to set this <strong>NOT</strong> to &#39;full width row&#39; for listing your normal page content (products, portfolio, blogpost etc).','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_grid[row_style_options][row_width]",    
								"options"   =>  array(
									"default"   => __("Content Width",'rt_theme_admin'),
									"full" 		=> __("Window Width (100%)",'rt_theme_admin'),
									), 
								"dont_save" => "true",
								"type"      => "select", 
								"class"		=> "row_width",
								"value"		=> isset( $options['row_style_options'] ) && isset( $options['row_style_options']['row_width'] ) ? $options['row_style_options']['row_width'] : "default",
								),	 
			 

								array(
								"name" 		=> __("ROW PADDINGS (px)",'rt_theme_admin'), 
								"type" 		=> "heading"),		

								array( 
									"layout"   => "four",
									"type"    => "col_start", 
									"holder_class" => "option_paddings paddings box_border",
								),

								array(
										"name" => __("Padding Left",'rt_theme_admin'),
										"desc" => __('Set the left padding in pixels.','rt_theme_admin'),										
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[row_style_options][padding_left]",    
										"value"=> $row_padding_left,
										"type" => "text"
								),

								array( 
									"layout"   => "four",
									"type"     => "col_split", 
								),

								array(
										"name" => __("Padding Right",'rt_theme_admin'),
										"desc"      => __('Set the right padding in pixels.','rt_theme_admin'),																				
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[row_style_options][padding_right]",    
										"value"	=> $row_padding_right,
										"type" => "text"
								),

								array( 
									"layout"   => "four",
									"type"    => "col_split", 
								),

								array(
										"name" => __("Padding Top",'rt_theme_admin'),
										"desc"      => __('Set the top padding in pixels.','rt_theme_admin'),																				
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[row_style_options][padding_top]",    
										"value"	=> $row_padding_top,
										"type" => "text"
								),

								array( 
									"layout"   => "four",
									"type"    => "col_split", 
								),

								array(
										"name" => __("Padding Bottom",'rt_theme_admin'),
										"desc"      => __('Set the bottom padding in pixels.','rt_theme_admin'),										
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[row_style_options][padding_bottom]",    
										"value"	=> $row_padding_bottom,
										"type" => "text"
								),								
								array(	 
									"type"    => "col_end"
								),			


								array(
								"name" 		=> __("COLUMN PADDINGS (px)",'rt_theme_admin'), 
								"type" 		=> "heading"),		

								array( 
									"layout"   => "four",
									"type"    => "col_start", 
									"holder_class" => "option_paddings paddings box_border",
								),

								array(
										"name" => __("Padding Left",'rt_theme_admin'),
										"desc"      => __('Set the left padding in pixels.','rt_theme_admin'),										
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[column_options][padding_left]",    
										"value"	=> $padding_left,
										"type" => "text"
								),

								array( 
									"layout"   => "four",
									"type"    => "col_split", 
								),

								array(
										"name" => __("Padding Right",'rt_theme_admin'),
										"desc"      => __('Set the right padding in pixels.','rt_theme_admin'),																				
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[column_options][padding_right]",    
										"value"	=> $padding_right,
										"type" => "text"
								),

								array( 
									"layout"   => "four",
									"type"    => "col_split", 
								),

								array(
										"name" => __("Padding Top",'rt_theme_admin'),
										"desc"      => __('Set the top padding in pixels.','rt_theme_admin'),																				
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[column_options][padding_top]",    
										"value"	=> $padding_top,
										"type" => "text"
								),

								array( 
									"layout"   => "four",
									"type"    => "col_split", 
								),

								array(
										"name" => __("Padding Bottom",'rt_theme_admin'),
										"desc"      => __('Set the bottom padding in pixels.','rt_theme_admin'),										
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[column_options][padding_bottom]",    
										"value"	=> $padding_bottom,
										"type" => "text"
								),								
								array(	 
									"type"    => "col_end"
								),	

								array(
								"name" 		=> __("COLUMN BACKGROUND",'rt_theme_admin'), 
								"type" 		=> "heading"),		


								array(
								"name"      => __("Column Background",'rt_theme_admin'),
								"desc"      => __('Select and set a default column background color for this template container (row).','rt_theme_admin'),								
								"id"        => $theTemplateID.'_'.$theGroupID."_grid[column_options][background_selection]",    
								"options"   =>  array(
									"default"          => __("Default",'rt_theme_admin'),
									"half_transparent" => __("Transparent-White",'rt_theme_admin'),
									"new"              => "Select Color",
									), 
								"dont_save" => "true",
								"type"      => "select", 
								"value"		=> isset( $options['column_options'] ) && isset( $options['column_options']['background_selection'] ) ? $options['column_options']['background_selection'] : "default",
								"class"     => "div_controller",
								),	 
			 
								array( 
									"div_class"   => "hidden_options_set",
									"type"    => "div_start", 
								),

									array(
									"name"      => __("Column Background Color",'rt_theme_admin'),
									"desc" 		=> __('Click within the color field or on the circular element of the color field to open up the colorpicker. In the colorpicker select a color by dragging the circular object within the colorgrid. You can also insert manually a valid html color code. If you would like to turn back to the default color, just delete the value and make sure to save the settings.','rt_theme_admin'),
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[column_options][background_color]",    
									"dont_save" => "true",
									"value"		=> isset( $options['column_options'] ) && isset( $options['column_options']['background_color'] ) ? $options['column_options']['background_color'] : "#ffffff",
									"type"      => "colorpicker"),		

								array(	 
									"type"    => "div_end"
								),				 							

								array(
								"name" 		=> __("CSS",'rt_theme_admin'), 
								"type" 		=> "heading"),		

								array(
										"name" => __("CSS Class Name",'rt_theme_admin'),
										"desc"      => __('Custom CSS Class Name','rt_theme_admin'),										
										"id"   => $theTemplateID.'_'.$theGroupID."_grid[row_style_options][custom_class]",    
										"value"	=> $custom_class,
										"type" => "text"
								),		


							array(	 
								"type"    => "div_end"
							),	
					);
	
				//get styling options
				$options = array_merge( $options,  $this->rt_generate_grid_background_options($theGroupID,$theTemplateID,$saved_options,$randomClass,"ca1") ) ;			 
 
				}

				echo  $this->rt_generate_forms($options,$theTemplateID); 				
				echo '</div>'; 
			}   

			if( $header_purpose ){ // header row
				$options = array (  

						array(
								"id"      => $theTemplateID.'_'.$theGroupID."_grid[grid]",
								"type"    => "grid",
								"purpose" => "page_template",
								"value"   => $part,
								"part"    => $part,
								"header_purpose" => true,
								"footer_purpose" => false  
							)
				);
			}elseif( $footer_purpose ){ // footer row
				$options = array (  

						array(
								"id"      => $theTemplateID.'_'.$theGroupID."_grid[grid]",
								"type"    => "grid",
								"purpose" => "page_template",
								"value"   => $part,
								"part"    => $part,
								"header_purpose" => false, 
								"footer_purpose" => true, 
							)
				);				
			}else{
				$options = array (  

						array(
								"id"      => $theTemplateID.'_'.$theGroupID."_grid[grid]",
								"type"    => "grid",
								"purpose" => "page_template",
								"value"   => $part,
								"part"    => $part,
								"header_purpose" => false,
								"footer_purpose" => false  
							)
				);				
			}

			echo  $this->rt_generate_forms($options,$theTemplateID); 

			//close rows  
			if($part == "second" || $part == "full" ){
				echo  '</div>';
			}

			//start content rows holder - after hader row
			if( $header_purpose == "true" && $part == "second"){  
				echo  '<div class="start_content_rows">';
			} 
	}	

	private function rt_generate_grid_background_options($theGroupID,$theTemplateID,$options,$randomClass,$default){    
	
		$background_repeat = $background_attachment = $background_size = $background_position = $background_color = $background_image_url = $background_selection = $social_media = $highlighted = $border = $link_hover = $link = $heading_links = $headings = $light_font = $font = $primary = $color_set_selection = $parallax_background = "";
		$color_set	= isset( $options['color_set'] ) && is_array( $options['color_set'] )  ? $options['color_set'] : array() ;   
		$background_options	= isset( $options['background_options'] ) && is_array( $options['background_options'] )  ? $options['background_options'] : array() ; 	 	
		$colorpickerdescription = __('Click within the color field or on the circular element of the color field to open up the colorpicker. In the colorpicker select a color by dragging the circular object within the colorgrid. You can also insert manually a valid html color code. If you would like to turn back to the default color, just delete the value and make sure to save the settings.','rt_theme_admin');

		extract( $color_set );  
		extract( $background_options );

		$color_set_selection = !empty( $color_set_selection ) ? $color_set_selection :  $default ;	
		$background_selection = !empty( $background_selection ) ? $background_selection :  $default ;	
		
		$options = array (  	 

			array(	 
				"type" => "div_start",
				"id"   => "rttheme-tab-2",
			),	  

				//COLOR SET
				array(	 
					"type"        => "div_start",
					"div_class"   => "color_set options_set_holder",
				),	  				

					array(
					"name"      => __("COLOR SETTINGS",'rt_theme_admin'), 
					"type"      => "heading"),		


					array(
					"name"      => __("Color Style",'rt_theme_admin'),
					"desc"    => __('Select and set a default color style as set in the theme styling options or create a new one.','rt_theme_admin'),								
					"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][color_set_selection]",    
					"options"   => array(
										"optgroup_start 1"=>"Theme Defaults",
											"default"  => __("Use theme defaults",'rt_theme_admin'), 						
										"optgroup_end 1"=>"",
										
										"optgroup_start 2"=>"Create a custom color set",
											"new"      => "Custom",								
										"optgroup_end 2"=>"",

										"optgroup_start 3"=>"Use global color set of",
											"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
											"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
											"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
											"header"  => __("Sub-Header Area ",'rt_theme_admin'),
											"footer"  => __("Footer Area",'rt_theme_admin'),
										"optgroup_end 3"=>"",			
										),   
					"dont_save" => "true",
					"type"      => "select", 
					"value"		=> $color_set_selection,
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
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][primary]",    
									"dont_save" => "true", 
									"value"		=> $primary,
									"type"      => "colorpicker"),

									array(
									"name"      => __("Content Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][font]",    
									"dont_save" => "true", 
									"value"		=> $font,
									"type"      => "colorpicker"),								

									array(
									"name"      => __("Secondary Content Font Color (Lighter)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][light_font]",    
									"dont_save" => "true", 
									"value"		=> $light_font,
									"type"      => "colorpicker"),


									array(
									"name"      => __("Headings Font Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][headings]", 
									"dont_save" => "true",
									"value"		=> $headings,
									"type"      => "colorpicker"),

									array(
									"name"      => __("Headings With Links (Hover Stage)",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][heading_links]",    
									"dont_save" => "true",
									"value"		=> $heading_links,
									"type"      => "colorpicker"), 
									
									array(							
									"type" 		=> "col_split",
									"layout" 	=> "two"
									),

									array(
									"name"      => __("Custom Link Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][link]", 
									"dont_save" => "true",
									"value"		=> $link,
									"type"      => "colorpicker"),
									
									array(
									"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][link_hover]", 
									"dont_save" => "true",
									"value"		=> $link_hover,
									"type"      => "colorpicker"),		 
		 
									array(
									"name"      => __("Border Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][border]", 
									"dont_save" => "true",
									"value"		=> $border,
									"type"      => "colorpicker"),		  

									array(
									"name"      => __("Highlighted Background Color",'rt_theme_admin'),
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][highlighted]",  
									"dont_save" => "true",
									"value"		=> $highlighted,
									"type"      => "colorpicker"),
		 
									array(
									"name"      => __("Social Media Icons Base Color",'rt_theme_admin'), 
									"desc" 		=> $colorpickerdescription,
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[color_set][social_media]",   
									"dont_save" => "true",
									"value"		=> $social_media,
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
					"name" 		=> __("BACKGROUND SETTINGS",'rt_theme_admin'), 
					"type" 		=> "heading"),		 

					array(
					"name"      => __("Background Style",'rt_theme_admin'),
					"desc"    => __('Select and set a default background style as set in the theme styling options or create a new one.','rt_theme_admin'),								
					"id"        =>  $theTemplateID.'_'.$theGroupID."_grid[background_options][background_selection]",    
					"options"   => array( 
										"optgroup_start 1"=>"Theme Defaults",
											"default"  => __("Use theme defaults",'rt_theme_admin'), 						
										"optgroup_end 1"=>"",
										
										"optgroup_start 2"=>"Create a custom background",
											"new"      => "Custom",								
										"optgroup_end 2"=>"",

										"optgroup_start 3"=>"Use global background of",
											"ca1"  => __("Default Content Area ",'rt_theme_admin'),		
											"ca2"  => __("Alternate Content Area 1 ",'rt_theme_admin'),							
											"ca3"  => __("Alternate Content Area 2",'rt_theme_admin'),
											"header"  => __("Sub-Header Area ",'rt_theme_admin'),
											"footer"  => __("Footer Area",'rt_theme_admin'),
										"optgroup_end 3"=>"",		
										),   
					"dont_save" => "true",					
					"type"      => "select", 
					"value"		=> $background_selection,
					"class"     => "div_controller",
					),	 


					array( 
						"div_class"   => "hidden_options_set",
						"type"    => "div_start",
					), 

									array(
									"name"      => __("Background Image",'rt_theme_admin'),
									"desc"      => __('Please add a image by the use of the upload button or insert a valid url to a image to use as a background. <strong>Note</strong> : Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),
									"id"        => $theTemplateID.'_'.$theGroupID."_grid[background_options][background_image_url]",  
									"value"		=> $background_image_url,  
									"type"      => "upload"),


									array(	 
										"type"    => "div_start",
										"div_class"   => "options_set_holder",
									),	  				
	
											array(
											"name"      => __("Parallax Background Effect",'rt_theme_admin'),
											"desc"    => __('If you enable this option, the background image will be used as a parrallax background image.','rt_theme_admin'),								
											"id"        =>  $theTemplateID.'_'.$theGroupID."_grid[background_options][parallax_background]",    
											"options"   => array( 
																"disabled_parallax"  => __("Disabled",'rt_theme_admin'),    
																"1"  => __("Horizontally, from left to right",'rt_theme_admin'),  
																"2"  => __("Horizontally, from right to left",'rt_theme_admin'),  
																"3"  => __("Vertically, from top to bottom",'rt_theme_admin'),  
																"4"  => __("Vertically, from bottom to top",'rt_theme_admin'),  

																),   			
											"type"      => "select", 
											"value"		=> $parallax_background,
											"class"     => "div_controller parallax_effect",
											),

											array( 
												"div_class"   => "hidden_options_set",
												"type"    => "div_start",
											), 
													array(
													"name"      => __("Background Color",'rt_theme_admin'),
													"desc" 		=> $colorpickerdescription,
													"id"        => $theTemplateID.'_'.$theGroupID."_grid[background_options][background_color]",    
													"value"		=> $background_color,
													"type"      => "colorpicker"),
													 
													array(
													"name"      => __("Position",'rt_theme_admin'),
													"desc"      => __('Select and set alignment for the background image.','rt_theme_admin'),									
													"id"        => $theTemplateID.'_'.$theGroupID."_grid[background_options][background_position]",    
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
													"value"		=> $background_position,
													"type"      => "select"),

													array(
													"name"      => __("Repeat",'rt_theme_admin'),
													"desc"      => __('Select and set repeat mode direction for the background image.','rt_theme_admin'),									
													"id"        => $theTemplateID.'_'.$theGroupID."_grid[background_options][background_repeat]",    
													"options"   => array(		
																	"repeat"       =>"Tile",
																	"repeat-x"     =>"Tile Horizontally",
																	"repeat-y"     =>"Tile Vertically",
																	"no-repeat"    =>"No Repeat"
																	),  
													"type"      => "radio",
													"value"		=> $background_repeat,
													"default"	=> "repeat"
													),

													array(
													"name"      => __("Attachment",'rt_theme_admin'),
													"desc"      => __('Select and set fixed or scroll mode for the background image.','rt_theme_admin'),									
													"id"        => $theTemplateID.'_'.$theGroupID."_grid[background_options][background_attachment]",    
													"options"   => array(		
																	"scroll"        =>"Scroll",
																	"fixed"         =>"Fixed"  
																	),  
													"default"	=> "scroll",
													"value"		=> $background_attachment,
													"type"      => "radio"
													),  

													array(
													"name"      => __("Background Size",'rt_theme_admin'),
													"desc"      => __('Select and set size / coverage behaviour for the background image.','rt_theme_admin'),									
													"id"        => $theTemplateID.'_'.$theGroupID."_grid[background_options][background_size]",   
													"options"   => array(		
																	"auto auto" =>"Auto",  
																	"cover" =>"Cover",
																	"contain" =>"Contain",
																	"100% auto" =>"100%",
																	"50% auto" =>"50%",  
																	"25% auto" =>"25%",  
																	),  
													"value"		=> $background_size,
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
			)

		);

		return $options;		 
	}		
}	
?>	