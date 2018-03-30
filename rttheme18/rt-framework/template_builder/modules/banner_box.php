<?php
class rt_generate_banner_box_class extends RTThemePageLayoutOptions{
	#
	#	Banner Box
	#
	function rt_generate_banner_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Banner Box", "rt_theme_admin");
			$contet_type   = "banner_box";			
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ;			
			$values        = isset( $options['values'] ) ? $options['values'] : array();  

			$border  = $gradient = $text_icon = $text_alignment = $button_text = $button_icon = $button_size = $button_link  = $link_target = $text = "";
			extract($values);

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array ( 

						array(
								"desc" => __("You can use this module to display a banner box.",'rt_theme_admin'),	 
								"type" => "info"),


						array( 
								"type"   => "table_start"),


						array(
								"name" 		=> __("BANNER TEXT",'rt_theme_admin'),	  
								"type" 		=> "heading"), 					

						array(
								"name"  => __("Banner Text",'rt_theme_admin'),
								"desc"      => __('Enter the text to show within the banner. Simple html is allowed.','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][text]",
								"value" => $text,
								"class" => "banner_text", 
								"type"  => "textarea"),	

						array(
								"name"  => __("Text Icon",'rt_theme_admin'), 
								"desc"  => __('Select and set a icon to precede the banner text.','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][text_icon]",
								"value" => $text_icon,
								"class" => 'icon_selection', 
								"type"  => "text"),

						array(
								"name"  => __("Text Alignment",'rt_theme_admin'),
								"desc"      => __('Select and set text alignment of the banner text.','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][text_alignment]",
								"options" => array(
													"left"   => "Left",
													"center" => "Center", 
												),
								"default" => "left",
								"value"   => $text_alignment, 
								"type"    => "select"),

						array(
								"name" 		=> __("BANNER STYLE",'rt_theme_admin'),	  
								"type" 		=> "heading"), 					

						array(
								"name" 	=> __("Border (if checked a border will show around the banner text)",'rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][border]", 
								"value" => $border, 
								"type" 	=> "checkbox2"),			

						array(
								"name" 	=> __("Gradient (if checked a gradient background will show behind the banner box)",'rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][gradient]", 
								"value" => $gradient, 
								"type" 	=> "checkbox2"), 

						array( 
								"type"   => "td_col"),

						array(
								"name"    => __("BUTTON",'rt_theme_admin'),	  
								"type"    => "heading"), 					
				 
	 
						array(
								"name"  => __("Button Text",'rt_theme_admin'),
								"desc"  => __('Enter the text to show within the button.','rt_theme_admin'),								
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][button_text]",
								"value" => $button_text,
								"class" => "button_text", 
								"type"  => "text"),

						array(
								"name"  => __("Button Icon",'rt_theme_admin'), 
								"desc"  => __('Select and set a icon to precede the button title.','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][button_icon]",
								"value" => $button_icon,
								"class" => 'icon_selection', 
								"type"  => "text"),

						array(
								"name"    => __("Button Size",'rt_theme_admin'),
								"desc"      => __('Select and set the button size.','rt_theme_admin'),
								"id"      => $theTemplateID.'_'.$theGroupID."_banner_box[values][button_size]",
								"options" => array(
													"small"   => "Small",
													"medium"  => "Medium",
													"big"     => "Big", 
												),
								"default" => "small",
								"value"   => $button_size,  
								"type"    => "select"),


						array(
								"name"  => __("Button Link",'rt_theme_admin'),
								"desc"  => __('Enter a valid URL to link the button to.','rt_theme_admin'),								
								"id"    => $theTemplateID.'_'.$theGroupID."_banner_box[values][button_link]",
								"value" => $button_link,
								"class" => "button_link", 
								"type"  => "text"), 

						array(
								"name"      => __("Link Target",'rt_theme_admin'), 
								"desc"      => __('Select and set the link target.','rt_theme_admin'),
								"id"        => $theTemplateID.'_'.$theGroupID."_banner_box[values][link_target]",
								"options"   => array('_self'=>'Same Window','_blank'=>'New Window'), 
								"value"     => $link_target, 
								"type"      => "select"),

						array( 
								"type"   => "table_end"), 

					);
 
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	