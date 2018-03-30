<?php
class rt_generate_text_box_class extends RTThemePageLayoutOptions{
	#
	#	Text Box
	#
	function rt_generate_text_box($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName        = __("Text Box", "rt_theme_admin");
			$contet_type    = "text_box";
			$theTemplateID  = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox       = (trim($randomClass)=="") ? false : true; 
			$opacity        = 1;
			$layout         = "one passive_module" ;
			$position       = $isNewBox ? 'open minus' : 'plus' ;
			$data_position  = 'display: none;' ;	 
			$values     	= isset($options["values"]) ? $options["values"] : array();

			$text = $font_size = $font_color = $heading_color = $font_family_text = $font_family_heading = "";
			extract( $values );
 
			echo '<li class="ui-state-default for_content_boxes '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
 			

			//create font size array
			$font_sizes = array();
			for ($i=11; $i < 51 ; $i++) { 
				$font_sizes[$i] = $i."px";
			}

			$options = array (

					array(
							"desc" => __("This module adds a box with any content, at the location where the box is inserted, into the template. <strong>Note</strong> : Any valid html, shortcode or text content is allowed by using the 'HTML' button.",'rt_theme_admin'),
							"hr"   => "true",
							"type" => "info"),  

					array( 
							"type" 		   => "col_start",
							"layout" 	   => "one",
							"holder_class" => "labels_block box_border paddings",
					),

					array( 		
							"name"		  => __("Content Box Textarea",'rt_theme_admin'),					
							"id"          => $theTemplateID.'_'.$theGroupID."_text_box[values][text]", 
							"desc"		  => __('Enter any content (shortcode, text, or valid html by using the html button) in the editor area.','rt_theme_admin'),
							"value"       => $text, 
							"table_class" => "fulltable",
							"hr"		  => "true",
							"type"		  => "textarea_tinyMCE"),    


					array( 
							"type"		=> "col_end"
					),	

					array(  
							"type"		=> "table_start",  
					),

					array(
							"name"      => __("Color (Text)",'rt_theme_admin'),
							"desc" 		=> __('Click within the color field or on the circular element of the color field to open up the colorpicker. In the colorpicker select a color by dragging the circular object within the colorgrid. You can also insert manually a valid html color code. If you would like to turn back to the default color, just delete the value and make sure to save the settings. Leave blank to use the default color.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_text_box[values][font_color]",    
							"dont_save" => "true",
							"hr" 		=> "true",  
							"value"		=> $font_color,
							"type"      => "colorpicker"),	

					array(
							"name"      => __("Color (Headings)",'rt_theme_admin'),
							"desc" 		=> __('Click within the color field or on the circular element of the color field to open up the colorpicker. In the colorpicker select a color by dragging the circular object within the colorgrid. You can also insert manually a valid html color code. If you would like to turn back to the default color, just delete the value and make sure to save the settings. Leave blank to use the default color.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_text_box[values][heading_color]",    
							"dont_save" => "true",
							"hr" 		=> "true",  
							"value"		=> $heading_color,
							"type"      => "colorpicker"),	

					array(
							"name" 		=> __("Font Size (Text)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_text_box[values][font_size]",
							"options" 	=> $font_sizes,
							"select" 	=> __('Default','rt_theme_admin'),
							"default"	=> "",
							"value"		=> $font_size,  
							"type" 		=> "select"),

					array(  
							"type"    		=> "td_col",
					),


					array(
							"name" 		=> __("Font (Headings)",'rt_theme_admin'),
							"desc" 		=> __("Select a font for the heading elements (h-tags).",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_text_box[values][font_family_heading]",
							"options" 	=> $this->rt_font_list,
							"font-demo" => "true", 
							"class" 	=> "fontlist",
							"select"	=>__("Default Font",'rt_theme_admin'),
							"hr" 		=> "true",  
							"default"	=> "",
							"value"		=> $font_family_heading,  
							"type" 		=> "select"),


					array(
							"name" 		=> __("Font (Text)",'rt_theme_admin'),
							"desc" 		=> __("Select a font for the text",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_text_box[values][font_family_text]",
							"options" 	=> $this->rt_font_list,
							"font-demo" => "true", 
							"class" 	=> "fontlist",
							"select"	=>__("Default Font",'rt_theme_admin'),
							"default"	=> "",
							"value"		=> $font_family_text,  
							"type" 		=> "select"),			

					array(  
							"type"    		=> "table_end",
					),

					);



			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}
?>	