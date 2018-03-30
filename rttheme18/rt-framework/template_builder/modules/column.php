<?php
class rt_generate_column_class extends RTThemePageLayoutOptions{
	#
	#	Create Columns
	#
	function rt_generate_column($theGroupID,$theTemplateID,$options,$randomClass){ 

			$boxName       = __("Column", "rt_theme_admin");
			$contet_type   = "column";			
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$part          = isset( $options['part'] ) ? $options['part'] : 'full' ;
			$layout        = isset( $options['layout'] ) ? $options['layout'] : '1' ; 


				$options = array (  

						array(
								"id"      => $theTemplateID.'_'.$theGroupID."_column[column]",
								"type"    => "column",
								"purpose" => "page_template",
								"value"   => $part,
								"part"    => $part,
								"layout"  =>  $layout
							)
				);

						echo  $this->rt_generate_forms($options,$theTemplateID); 
	}			
}				
?>	