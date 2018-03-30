<?php
class rt_generate_new_content_box_class extends RTThemePageLayoutOptions{
	#
	#	Content Box with Image
	#
	function rt_generate_new_content_box($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName        = __("Content Box With Image", "rt_theme_admin");
			$contet_type    = "new_content_box";
			$theTemplateID  = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox       = (trim($randomClass)=="") ? false : true; 
			$opacity        = 1;
			$layout         = "one passive_module" ;
			$position       = $isNewBox ? 'open minus' :	'plus' ;
			$data_position  = 'display: none;' ;	 
			$title          = isset($options["title"]) ? $options["title"] : "";
			$title_position = isset($options["title"]) ? $options["title_position"] : "";
			$text           = isset($options["text"] ) ? $options["text"] : "";
			$featured_image = isset($options["featured_image"] ) ? $options["featured_image"] : ""; 
			$icon           = isset($options["icon"]) ? $options["icon"] : ""; 
			$icon_style     = isset($options["icon_style"]) ? $options["icon_style"] : ""; 
			$text_position  = isset($options["text_position"]) ? $options["text_position"] : "";
			$link           = isset($options["link"]) ? $options["link"] : "";
			$link_text      = isset($options["link_text"]) ? $options["link_text"] : "";
			$link_target    = isset($options["link_target"]) ? $options["link_target"] : "";
			$image_style    = isset($options["image_style"]) ? $options["image_style"] : "";


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
							"id" 		=> $theTemplateID.'_'.$theGroupID."_new_content_box[title]", 
							"value"		=> $title, 
							"type"		=> "text"), 

					array( 		
							"name"		=> __("Content Box Textarea",'rt_theme_admin'),					
							"id"          => $theTemplateID.'_'.$theGroupID."_new_content_box[text]", 
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
							"id"        => $theTemplateID.'_'.$theGroupID."_new_content_box[title_position]", 
							"options"   => array('embedded'=>'Embedded to the featured image','before'=>'Before Featured Image','after'=>'After Featured Image'),					
							"value"     => $title_position,
							"default"   => "embedded", 
							"type"      => "select"), 

					array(
							"name"      => __("Content Alignment",'rt_theme_admin'), 
							"desc"      => __('Select and set aligment of all content of the content box module.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_new_content_box[text_position]", 
							"options"   => array('1'=>'Left Aligned','2'=>'Centered'),	 
							"value"     => $text_position,  
							"type"      => "select"),


					array(
							"name"      => __("LINK",'rt_theme_admin'), 
							"type"      => "heading"), 


					array(
							"name"		=> __("Link",'rt_theme_admin'),						
							"desc"      => __('Put in a valid link to where the linktext supplied in the next field should link to when clicked upon. <strong>Note</strong> : The link is shown at the bottom of the content box.','rt_theme_admin'),																				
							"id" 		=> $theTemplateID.'_'.$theGroupID."_new_content_box[link]", 
							"value"		=> $link, 
							"type"		=> "text"), 					

					array(
							"name"		=> __("Link Text",'rt_theme_admin'),						
							"desc"      => __('Provide a text for the link button.','rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_new_content_box[link_text]", 
							"value"		=> $link_text, 
							"type"		=> "text"), 

					array(
							"name"      => __("Link Target",'rt_theme_admin'),
							"desc"      => __('Select and set the link target.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_new_content_box[link_target]", 
							"options"   => array(
												'_self'=>__('Same Window','rt_theme_admin'),
												'_blank'=>__('New Window','rt_theme_admin')
											),
							"hr"        => true,
							"value"     => $link_target, 
							"type"      => "select"),

			
					array(
							"id"        => $theTemplateID.'_'.$theGroupID."_new_content_box_header_div_end",
							"type"      => "div_end" 
					), 

					array(  "type"		=> "td_col"),

 
 					array(
							"name"      => __("ICON STYLE",'rt_theme_admin'), 
							"type"      => "heading"), 

					array(
							"name"      => __("Select Icon Style",'rt_theme_admin'), 
							"desc"      => __('Select and set the Icon style. <strong>Note</strong> : To be able to add a featured image select one of the two available &#39;small icon&#39; options.','rt_theme_admin'),							
							"id"        => $theTemplateID.'_'.$theGroupID."_new_content_box[icon_style]", 
							"options"   => array('0'=>'No Icon','1'=>'Small Icon','2'=>'Small icon with squared background'),					
							"hr"        => true,
							"value"     => $icon_style,
							"type"      => "select"),   

					array(
							"name"		=> __("Icon",'rt_theme_admin'),	
							"desc"      => __('Select and set the icon to display within the content box.','rt_theme_admin'),							
							"id" 		=> $theTemplateID.'_'.$theGroupID."_new_content_box[icon]", 
							"desc"		=> __('Click into the text field to select an icon or type an icon name.','rt_theme_admin'),
							"value"		=> $icon,
							"class"		=> 'icon_selection', 
							"type"		=> "text"),   

 					array(
							"name"      => __("FEATURED IMAGE",'rt_theme_admin'), 
							"type"      => "heading"), 

					array(
							"name"      => __("Featured Image Style",'rt_theme_admin'), 
							"desc"      => __('Select and set the Icon style','rt_theme_admin'),							
							"id"        => $theTemplateID.'_'.$theGroupID."_new_content_box[image_style]", 
							"options"   => array(
												'0'=>__('Square standart','rt_theme_admin'),
												'1'=>__('Rounded with pin and b/w image effect','rt_theme_admin'),
												'2'=>__('Rounded with pin without b/w image effect','rt_theme_admin'),
												'3'=>__('Octange with b/w image effect','rt_theme_admin'),
												'4'=>__('Octange without b/w image effect','rt_theme_admin'),
												),	
							"hr"        => true,
							"value"     => $image_style,
							"class"     => "select_featured_image_style",
							"type"      => "select"),   

					array(
							"name"		=> __("Featured Image",'rt_theme_admin'),
							"desc"      => __('Please add a image by the use of the upload button or insert a valid url to a image to use as a featured image. <strong>Note</strong> : Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),
							"id"		=> $theTemplateID.'_'.$theGroupID."_new_content_box[featured_image]",   
							"type"		=> "upload",
							"value"		=> $featured_image),   

					array(  "type"		=> "table_end"),
 

					);

			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	