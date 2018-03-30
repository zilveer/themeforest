<?php
class rt_generate_heading_bar_class extends RTThemePageLayoutOptions{
	#
	#	Heading Bar
	#
	function rt_generate_heading_bar($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName       = __("Heading Bar", "rt_theme_admin");
			$contet_type   = "heading_bar";			
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;';	 
			$heading       = isset( $options['heading'] ) ? $options['heading'] : "";  
			$icon          = isset( $options['icon'] ) ? $options['icon'] : "";  
			$style         = isset( $options['style'] ) ? $options['style'] : "";  


			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
  
						array(
								"desc" => __("Use this module to display a heading bar with an icon (optional).",'rt_theme_admin'),	 
								"hr"   => "true",
								"type" => "info"),
 
						array(
								"name"  => __("Heading",'rt_theme_admin'),
								"desc"      => __('Enter a heading title.','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_heading_bar[heading]",
								"value" => $heading,
								"class" => "heading",
								"type"  => "text"),

						array(
								"name"  => __("Icon",'rt_theme_admin'), 
								"desc"      => __('Select a icon to precede the title (heading).','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_heading_bar[icon]",
								"value" => $icon,
								"class" => 'icon_selection', 
								"type"  => "text"),

						array(
								"name"  => __("Style",'rt_theme_admin'),
								"desc"      => __('Select and set text alignment of the banner text.','rt_theme_admin'),
								"id"    => $theTemplateID.'_'.$theGroupID."_heading_bar[style]",
								"options" => array(
													"" => "Style 1",
													"style-2" => "Style 2", 
												),
								"default" => "left",
								"value"   => $style, 
								"type"    => "select"),		
			);


			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}	 
}	
?>	