<?php
class rt_generate_revslider_box_class extends RTThemePageLayoutOptions{
	#
	#	Revolution Slider Box
	#
	function rt_generate_revslider_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Revolution Slider", "rt_theme_admin");
			$contet_type   = "revslider_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ;
			$slider_id     = $isNewBox ? '' : $options['slider_id'];


			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
								
			$options = array (
 
					array( 
							"value"		=> "one", 						 
							"id" 		=> $theTemplateID.'_'.$theGroupID."_revslider_box[layout]",
							"type" 		=> "hidden", 
					),
							
					array(
							"desc" 		=> __("This module displays a slider of the Revolution Slider plugin.",'rt_theme_admin'),	 
							"hr" 		=> "true",
							"type" 		=> "info"), 	

					array(
							   "name" => __("Select a slider",'rt_theme_admin'), 
							   "desc" => __('Select a slider to display.','rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_revslider_box[slider_id]",
							   "options" =>	rt_rev_slider_list(),
							   "value"=>$slider_id, 
							   "hr" => "true",
							   "type" => "select"),		 
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}
?>	