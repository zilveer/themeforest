<?php
class rt_generate_space_box_class extends RTThemePageLayoutOptions{
	#
	#	Space Box
	# 
	function rt_generate_space_box($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName       = __("Space Box", "rt_theme_admin");
			$contet_type   = "space_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ;  
			$height        = isset( $options["height"] ) ? $options["height"] : "" ;
		
			echo '<li class="ui-state-default '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
	 
						array(
								"desc" => __("The space box wil create a space, a empty room between modules, at the location where the box is inserted in the template with a height as set in the space box height setting.",'rt_theme_admin'),	 
								"hr" => "true",
								"type" => "info"),  
								
 						array(
								"name" 		=> __("Space Box Height (px)",'rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_space_box[height]",
								"desc" 		=> __("<strong>Space Box Height (px)</strong> : Set the height for the space box in pixels by dragging the horizontal (scroll) bar to the left or right to decrease or increase the height value or by directly inputting a height value into the text field.",'rt_theme_admin'),
								"hr" 		=> "true",
								"min"		=> "0",
								"max"		=> "500",
								"default"	=> "0",
								"hr"		=> true,
								"dont_save"	=> true,
								"value"		=> $height,
								"class"		=> $randomClass,
								"type"		=> "rangeinput"),  								
 
					);
										
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	