<?php
class rt_generate_staff_box_class extends RTThemePageLayoutOptions{
	#
	#	Staff Box
	#
	function rt_generate_staff_box($theGroupID,$theTemplateID,$options,$randomClass){
	     
			$boxName		= __("Staff List", "rt_theme_admin");
			$contet_type	= "staff_box";
			$theTemplateID  = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity 		= 1;
			$layout 		= "one passive_module" ;
			$position		= $isNewBox ? 'open minus'	:'plus';
			$data_position	= 'display: none;'; 
			$ids        	= isset( $options['ids'] ) ? $options['ids'] : "" ; 
			$list_orderby 	= isset( $options['list_orderby'] ) ? $options['list_orderby'] : "" ; 
			$list_order 	= isset( $options['list_order'] ) ? $options['list_order'] : "" ; 
			$style 			= isset( $options['style'] ) ? $options['style'] : "" ; 
			$item_width 	= isset( $options['item_width'] ) ? $options['item_width'] : "" ; 
			
			$values	= isset( $options['values'] ) ? $options['values'] : array() ; 
			extract( $values );

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
					
					array(
							"desc" => __("This module displays a team / staff memberlist from the team / staff post type following the settings below.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
					),

					array(	"type" => "table_start"),

					array(
							"name" 	=> __("Select Staff (Optional)",'rt_theme_admin'),
							"desc" 	=> __("You can filter team / staff members by selecting them from this list. If you don't select individual members, all team / staff members will be listed.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_staff_box[values][ids][]",
							"options" => RTTheme::rt_get_staff_list(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"=> $ids),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the team / staff member items within the memberlist by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_staff_box[values][list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'), 
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_staff_box[values][list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true, 					
							"type" 	=> "select"),

					
					array(	"type" => "td_col" ),	
 

					array(
							"name" 	=> __("List Style",'rt_theme_admin'),
							"desc"  => __('Select and set a style to display the team / staff memberlist.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_staff_box[values][style]",
							"options" =>	array(
										"style-one" => "Style One", 
										"style-two" => "Style Two", 									
										"style-three" => "Style Three", 									
								),
							"default"=>"style-one",
							"value"=>$style, 
							"type" => "select"), 
			
					array(
							"name" 	=> __("Content Layout",'rt_theme_admin'),
							"desc"  => __('Select and set the column layout for the team / staff memberlist.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_staff_box[values][item_width]",
							"options" =>	array(
										5 => "1/5", 
										4 => "1/4",
										3 => "1/3",
										2 => "1/2",
										1 => "1/1"									
								),
							"default"=>"1",
							"value"=>$item_width, 
							"type" => "select"), 


					array(	"type" => "table_end" ),						
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';				
	}
}
?>	