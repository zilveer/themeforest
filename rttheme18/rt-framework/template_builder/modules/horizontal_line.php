<?php
class rt_generate_horizontal_line_class extends RTThemePageLayoutOptions{
	#
	#	Horizontal Line Box
	#
	function rt_generate_horizontal_line($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Horizontal Line", "rt_theme_admin");
			$contet_type   = "horizontal_line";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module";
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ; 
 			$style         = isset($options["style"]) ? $options["style"] : ""; 
 			$margin_top    = isset($options["margin_top"]) ? $options["margin_top"] : ""; 
 			$margin_bottom = isset($options["margin_bottom"]) ? $options["margin_bottom"] : ""; 
			 
			 
			echo '<li class="ui-state-default '.$layout.' '.$randomClass.' tabs_box" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
 								
			$form_options = array (
  
				array(
						"desc" 		=> __("This module displays an horizontal line",'rt_theme_admin'),	 
						"hr" 		=> "true",
						"type" 		=> "info"), 	 

				array(
						"name"		=> __("Select a style",'rt_theme_admin'),
						"desc" 		=> __("Select one of the three available styles for the horizontal line",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_horizontal_line[style]", 
						"options" 	=>	array(  
											"1" => __("Style 1 - Double Line With Circle","rt_theme_admin"),
											"2" => __("Style 2 - Double Line With Dot","rt_theme_admin"),
											"3" => __("Style 3 - Double Line With Waves","rt_theme_admin"),
											"4" => __("Style 4 - Double Line Only","rt_theme_admin"),
											"5" => __("Style 5 - Classic Single Line","rt_theme_admin"),
											"6" => __("Style 6 - Half Colored Line With Down Arrow ","rt_theme_admin"),
											"7" => __("Style 7 - Line With White Down Arrow ","rt_theme_admin"),
											"8" => __("Style 8 - Colored Line With Down Arrow","rt_theme_admin"),
									), 
						"value"		=> $style,
						"hr" 		=> "true",
						"dont_save"	=> true,
						"type"		=> "select"),   	

				array(
						"name"		=> __("Margin Top",'rt_theme_admin'),
						"desc" 		=> __("Select top margin values for the HR element",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_horizontal_line[margin_top]", 
						"options" 	=>	array(  
											"0" => __("No Margin","rt_theme_admin"),
											"5" => __("5px","rt_theme_admin"),
											"10" => __("10px","rt_theme_admin"),
											"15" => __("15px","rt_theme_admin"),
											"20" => __("20px","rt_theme_admin"),
											"30" => __("30px","rt_theme_admin"),
											"40" => __("40px","rt_theme_admin"),
											"50" => __("50px","rt_theme_admin"),
											"60" => __("60px","rt_theme_admin"),
											"70" => __("70px","rt_theme_admin"),
											"80" => __("80px","rt_theme_admin"),
									), 
						"value"		=> $margin_top,
						"hr" 		=> "true",
						"dont_save"	=> true,
						"type"		=> "select"),   		


				array(
						"name"		=> __("Margin Bottom",'rt_theme_admin'),
						"desc" 		=> __("Select bottom margin values for the HR element",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_horizontal_line[margin_bottom]", 
						"options" 	=>	array(  
											"0" => __("No Margin","rt_theme_admin"),
											"5" => __("5px","rt_theme_admin"),
											"10" => __("10px","rt_theme_admin"),
											"15" => __("15px","rt_theme_admin"),
											"20" => __("20px","rt_theme_admin"),
											"30" => __("30px","rt_theme_admin"),
											"40" => __("40px","rt_theme_admin"),
											"50" => __("50px","rt_theme_admin"),
											"60" => __("60px","rt_theme_admin"),
											"70" => __("70px","rt_theme_admin"),
											"80" => __("80px","rt_theme_admin"),
									), 
						"value"		=> $margin_bottom,
						"hr" 		=> "true",
						"dont_save"	=> true,
						"type"		=> "select"),   												
			); 

			echo  $this->rt_generate_forms($form_options);  
			echo  '</div></div></div></li>';
	}
}	
?>	