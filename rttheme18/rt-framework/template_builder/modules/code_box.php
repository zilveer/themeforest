<?php
class rt_generate_code_box_class extends RTThemePageLayoutOptions{
	#
	#	Code Box
	#
	function rt_generate_code_box($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName       = __("Code Box", "rt_theme_admin");
			$contet_type   = "code_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ; 
			$code_space    = isset( $options["code_space"] ) ? $options["code_space"] : "" ;
			$heading       = isset( $options["heading"] ) ? $options["heading"] : "" ;
		
			echo '<li class="ui-state-default '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
	 
						array(
								"desc" => __("Use this module to add your shortcodes, valid HTML-code, javascript or unformatted text at the location of the codebox within the template to the page.",'rt_theme_admin'),	 
								"hr" => "true",
								"type" => "info"), 
 
						array(
								"name" => __("Module Title",'rt_theme_admin'),
								"desc"      => __('Enter any title for the codebox (optional).','rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_code_box[heading]",
								"value"=>$heading,
								"type" => "text"), 

						array(
								"name" => __("Code Space",'rt_theme_admin'),
								"desc" => __("Enter / paste your shortcode, javascript or valid HTML-code.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_code_box[code_space]",
								"value"=>$code_space,
								"type" => "textarea"),  
 
					);
										
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	