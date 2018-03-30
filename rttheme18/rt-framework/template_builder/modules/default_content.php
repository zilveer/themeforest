<?php
class rt_generate_default_content_class extends RTThemePageLayoutOptions{
	#
	#	Default Contet Box
	#
	function rt_generate_default_content($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Default Page Content", "rt_theme_admin");
			$contet_type   = "default_content";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);			
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus':'plus';
			$data_position = 'display: none;';	  
		
			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
 
					
					array(
							"desc" => __("This module displays the default page or post content at the location within the template it is inserted. If this module is not used within a column the default content will be visible in full width.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
					),
 
					array( 
							"value"	=> "1", 
							"id" 	=> $theTemplateID.'_'.$theGroupID."_default_content[hidden]",
							"type" 	=> "hidden", 
					),
					  				
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}
?>	