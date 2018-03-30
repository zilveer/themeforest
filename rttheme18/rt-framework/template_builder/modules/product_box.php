<?php
class rt_generate_product_box_class extends RTThemePageLayoutOptions{
	#
	#	Product Box
	#
	function rt_generate_product_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Product Posts", "rt_theme_admin");
			$contet_type   = "product_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus':'plus'; 
			$data_position = 'display: none;'	; 

			$values        = isset( $options['values'] ) ? $options['values'] : array() ;  

			$heading = $pagination = $item_width = $list_orderby = $list_orderby = $list_order = $item_per_page = $categories = $display_descriptions = $display_price =  $display_titles = $with_borders = $with_effect = $no_top_border = $no_bottom_border = "";
			extract( $values );					


			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
					
						array(
								"desc" => __("This module displays product items following the settings below.",'rt_theme_admin'),	 
								"hr" => "true",
								"type" => "info", 
						), 

						array(	"type" => "table_start"),
						 	

						array(
								"name" => __("Embedded Heading",'rt_theme_admin'),
								"desc"      => __('Enter a title to be displayed as embedded to the grid.','rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_box[values][heading]", 
								"value"=> $heading,
								"type" => "text"
						), 

						array(
								"name" 	=> __("Select Product Categories",'rt_theme_admin'),
								"desc" 	=> __("Select and set categories to filter (shorten) the amount of product items presented in the productlist. If you don't select and set a category, this module will list all product items.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][categories][]",
								"options" => RTTheme::rt_get_product_categories(),
								"purpose" => "sidebar",
								"type"	=> "selectmultiple",
								"class"	=> $randomClass,
								"default"	=> $categories),
						
						array(
								"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
								"desc" 	=> __("Select and set the sorting order for the product items within the product list by this parameter.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_box[values][list_orderby]", 
								"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),	 
								"value"	=> $list_orderby,
								"default"	=> "date",
								"dont_save" => true,
								"type" 	=> "select"),
				
						array(
								"name" 	=> __("Order",'rt_theme_admin'),
								"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_box[values][list_order]", 
								"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
								"value"	=> $list_order,
								"default"	=> "DESC",
								"dont_save" => true, 			
								"type" 	=> "select"),						

						array(
								"name" 	=> __("Amount of product post per page",'rt_theme_admin'),
								"desc"	=> __("Set the amount of product items to display at once per page.<br /><strong>Note</strong> : works in conjunction with the pagination settings.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][item_per_page]",
								"min"	=> "1",
								"max"	=> "200",
								"class"	=> $randomClass,
								"value"	=> $item_per_page,
								"default"	=> "9",
								"dont_save" => true, 
								"type" 	=> "rangeinput"),
				
						array(
								"name" 	=> __("Content Layout",'rt_theme_admin'),
								"desc"  => __('Select and set the column layout for listing the product items. (<strong>Note</strong> : when used in a column module which is f.e. set to a 1/5 column it is better to set the content layout to a 1/1 layout.)','rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_box[values][item_width]",
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

						array(	"type" => "td_col" ),	

						array(
								"name" 	=> __("Pagination",'rt_theme_admin'),
								"desc"  => __("Enable (if checked) the pagination ability for the product items.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][pagination]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $pagination, 	 
								"default"	=> "off",
								"std" 	=> "false"),	

						array(
								"name" 	=> __("Display Titles",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][display_titles]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $display_titles, 		
								"default"	=> "on",
								"std" 	=> "false"),

						array(
								"name" 	=> __("Display Descriptions",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][display_descriptions]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $display_descriptions, 		 
								"default"	=> "on",
								"std" 	=> "false"),

						array(
								"name" 	=> __("Display Prices",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][display_price]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $display_price, 		 
								"default"	=> "on",
								"std" 	=> "false"),					


						array(
								"name" 	=> __("Display as Grid",'rt_theme_admin'),
								"desc"  => __("Enable (if checked) the list will be displayed in grid style.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][with_borders]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $with_borders, 	  
								"std" 	=> "false"),	

						array(
								"name" 	=> __("Enable Sliding Info",'rt_theme_admin'),
								"desc"  => __("Enable (if checked) the mouse over sliding info for the items.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][with_effect]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $with_effect, 	 
								"default"	=> "off",
								"std" 	=> "false"),	

						array(
								"name" 	=> __("Remove Top Borders of the Grid",'rt_theme_admin'),
								"desc"  => __("Enable (if checked) to remove the top borders of the grid will be removed. In some cases you may need this option checked to make your design much beatuiful.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][no_top_border]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $no_top_border, 	  
								"std" 	=> "false"),	

						array(
								"name" 	=> __("Remove Bottom Borders of the Grid",'rt_theme_admin'),
								"desc"  => __("Enable (if checked) to remove the bottom borders of the grid will be removed. In some cases you may need this option checked to make your design much beatuiful.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[values][no_bottom_border]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $no_bottom_border, 	  
								"std" 	=> "false"),	




						array(	"type" => "table_end" ),						
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>'; 
	}
}
?>	