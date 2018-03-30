<?php
class rt_generate_sidebar_box_class extends RTThemePageLayoutOptions{
	#
	#	Slider Box
	#
	function rt_generate_sidebar_box($theGroupID,$theTemplateID,$options,$randomClass){
		global $rt_sidebars_class; 

			$boxName          = __("Sidebar", "rt_theme_admin");
			$contet_type      = "sidebar_box";
			$theTemplateID    = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox         = (trim($randomClass)=="") ? false : true;			
			$opacity          = 1;
			$layout           = "one passive_module" ;	
			$position         = $isNewBox ? 'open minus' : 'plus' ;
			$data_position    = 'display: none;' ;
			$sidebar_id       = $isNewBox ? '' : $options['sidebar_id'] ;
			$widget_box_width = $isNewBox ? '' : $options['widget_box_width']	; 
			
			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (

						array(
							"desc" => __("This module displays a sidebar (widget area) following the settings below.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
						), 

						array(
								"name" => __("Select Sidebar (Widget Area)",'rt_theme_admin'),
								"desc" => __("Select and set a sidebar you want to display within this module.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_sidebar_box[sidebar_id]",
								"options" => $rt_sidebars_class->rt_active_sidebars,
								"class"=>$randomClass,
								"value"=>$sidebar_id, 
								"hr" => "true",
								"type" => "select", 
						),

						array(
								"name" => __("Select Widgets Size",'rt_theme_admin'),
								"desc" => __("Select a column layout to display the widgets from this sidebar.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_sidebar_box[widget_box_width]",
								"options" =>	array(
													5 => "1/5", 
													4 => "1/4",
													3 => "1/3",
													2 => "1/2",
													1 => "1/1"									
											),
								"default"=>"1",
								"value"=>$widget_box_width,
								"hr" => "true",
								"type" => "select"
						), 	 
					); 

			echo  $this->rt_generate_forms($options); 
			echo  '</div></div></div></li>'; 
	}
}	
?>	