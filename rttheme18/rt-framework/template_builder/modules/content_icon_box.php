<?php
class rt_generate_content_icon_box_class extends RTThemePageLayoutOptions{
	#
	#	Content Box with Icon
	#	
	function rt_generate_content_icon_box($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName        = __("Content Box With Icon", "rt_theme_admin");
			$contet_type    = "content_icon_box";
			$theTemplateID  = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox       = (trim($randomClass)=="") ? false : true; 
			$opacity        = 1;
			$layout         = "one passive_module" ;
			$position       = $isNewBox ? 'open minus' :	'plus' ;
			$data_position  = 'display: none;' ;	 
			$title          = isset($options["title"]) ? $options["title"] : "";
			$title_position = isset($options["title"]) ? $options["title_position"] : "";
			$text           = isset($options["text"] ) ? $options["text"] : "";
			$icon           = isset($options["icon"]) ? $options["icon"] : ""; 
			$icon_style     = isset($options["icon_style"]) ? $options["icon_style"] : ""; 
			$text_position  = isset($options["text_position"]) ? $options["text_position"] : "";
			$link           = isset($options["link"]) ? $options["link"] : "";
			$link_text      = isset($options["link_text"]) ? $options["link_text"] : "";
			$link_target    = isset($options["link_target"]) ? $options["link_target"] : "";
			$icon_bg_color	= isset($options["icon_bg_color"]) ? $options["icon_bg_color"] : "";
			$icon_color		= isset($options["icon_color"]) ? $options["icon_color"] : "";
			$icon_border_color = isset($options["icon_border_color"]) ? $options["icon_border_color"] : "";

			$featured_image_visibility = isset($icon_style) && intval($icon_style) > 2 ? "featured_image_visibility" : "featured_image_visibility active";
 
			echo '<li class="ui-state-default for_content_boxes '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
 			

			$options = array (

					array(
							"desc" => __("This module allows to create a styled content box with a big icon or featured image.",'rt_theme_admin'),
							"hr"   => "true",
							"type" => "info"), 

					array(
							"name"		=> __("Title",'rt_theme_admin'),						
							"desc"      => __('Enter a title to show in the content box area.','rt_theme_admin'),							
							"id" 		=> $theTemplateID.'_'.$theGroupID."_content_icon_box[title]", 
							"value"		=> $title, 
							"type"		=> "text"), 

					array( 		
							"name"		=> __("Content Box Textarea",'rt_theme_admin'),					
							"id"          => $theTemplateID.'_'.$theGroupID."_content_icon_box[text]", 
							"desc"      => __('Enter any content (shortcode, text, or valid html by using the html button) in the editor area.','rt_theme_admin'),
							"value"       => $text, 
							"table_class" => "fulltable",
							"type"        => "textarea_tinyMCE"),   

 
					array(  "type" => "table_start"),


					array(
							"name"      => __("POSITIONS",'rt_theme_admin'), 
							"type"      => "heading"), 


					array(
							"name"      => __("Title Position",'rt_theme_admin'),
							"desc"      => __("Select and set the title position.",'rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[title_position]", 
							"options"   => array(
												'embedded'=>__('Right side of the icon','rt_theme_admin'),
												'before'=>__('Before the icon','rt_theme_admin'),
												'after'=>__('After the icon','rt_theme_admin'),
												),					
							"value"     => $title_position,
							"default"   => "embedded", 
							"type"      => "select"), 

					array(
							"name"      => __("Content Alignment",'rt_theme_admin'), 
							"desc"      => __('Select and set aligment of all content of the content box module.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[text_position]", 
							"options"   => array(
												'1'=>__('Left Aligned','rt_theme_admin'),
												'2'=>__('Centered','rt_theme_admin'),
												),	 
							"value"     => $text_position,  
							"type"      => "select"),


					array(
							"name"      => __("LINK",'rt_theme_admin'), 
							"type"      => "heading"), 


					array(
							"name"		=> __("Link",'rt_theme_admin'),						
							"desc"      => __('Put in a valid link to where the linktext supplied in the next field should link to when clicked upon. <strong>Note</strong> : The link is shown at the bottom of the content box.','rt_theme_admin'),																				
							"id" 		=> $theTemplateID.'_'.$theGroupID."_content_icon_box[link]", 
							"value"		=> $link, 
							"type"		=> "text"), 					

					array(
							"name"		=> __("Link Text",'rt_theme_admin'),						
							"desc"      => __('Provide a text for the link button.','rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_content_icon_box[link_text]", 
							"value"		=> $link_text, 
							"type"		=> "text"), 

					array(
							"name"      => __("Link Target",'rt_theme_admin'),
							"desc"      => __('Select and set the link target.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[link_target]", 
							"options"   => array(
												'_self'=>__('Same Window','rt_theme_admin'),
												'_blank'=>__('New Window','rt_theme_admin'),
												),					
							"hr"        => true,
							"value"     => $link_target, 
							"type"      => "select"),
 

					array(  "type"		=> "td_col"),

 
 					array(
							"name"      => __("ICON STYLE",'rt_theme_admin'), 
							"type"      => "heading"), 

					array(
							"name"      => __("Select Icon Style",'rt_theme_admin'), 
							"desc"      => __('Select and set the Icon style','rt_theme_admin'),							
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[icon_style]", 
							"options"   => array('0'=>'No Icon','1'=>'Small Icon','2'=>'Small icon with squared background','3'=>'Big Icon','4'=>'Big Icon with squared background', '5'=>'Big Icon with rounded background', '6'=>'Big Icon with rounded border', '7'=>'Big Icon with rounded border and pin'),					
							"hr"        => "true",
							"value"     => $icon_style,
							"class"     => "select_content_box_style",
							"type"      => "select"),   

					array(
							"name"		=> __("Icon",'rt_theme_admin'),	
							"desc"      => __('Select and set the icon to display within the content box.','rt_theme_admin'),							
							"id" 		=> $theTemplateID.'_'.$theGroupID."_content_icon_box[icon]", 
							"desc"		=> __('Click into the text field to select an icon or type an icon name.','rt_theme_admin'),
							"value"		=> $icon,
							"class"		=> 'icon_selection', 
							"type"		=> "text"),  
 					
 					array(
							"name"      => __("OPTIONAL COLORS",'rt_theme_admin'), 
							"type"      => "heading"), 

					array(
							"name"      => __("Icon Color",'rt_theme_admin'), 
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[icon_color]",  
							"value"		=> $icon_color,	
							"hr"        => "true",
							"type"      => "colorpicker"),

					array(
							"name"      => __("Icon Background Color",'rt_theme_admin'), 
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[icon_bg_color]",  
							"value"		=> $icon_bg_color,	
							"hr"        => "true",
							"type"      => "colorpicker"),					

					array(
							"name"      => __("Icon Border Color",'rt_theme_admin'), 
							"id"        => $theTemplateID.'_'.$theGroupID."_content_icon_box[icon_border_color]",  
							"value"		=> $icon_border_color,								
							"type"      => "colorpicker"),

					array(  "type"		=> "table_end"),

					);

			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	