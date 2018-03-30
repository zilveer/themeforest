<?php
class rt_generate_product_categories_class extends RTThemePageLayoutOptions{
	#
	#	Product Box
	#
	function rt_generate_product_categories($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Product Categories", "rt_theme_admin");
			$contet_type   = "product_categories";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus':'plus'; 
			$data_position = 'display: none;'; 

			$values        = isset( $options['values'] ) ? $options['values'] : array() ;  
			
			$parent = $ids =  $orderby =  $order =  $item_width =  $crop =  $image_max_height = $display_titles = $display_descriptions = $display_thumbnails = "";

			extract( $values );					

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
					
						array(
								"desc" => __("This module displays product categories following the settings below.",'rt_theme_admin'),	 
								"hr" => "true",
								"type" => "info", 
						), 

						array(	"type" => "table_start"),
						
						array(
								"name" 	=> __("Select Parent Category",'rt_theme_admin'),
								"desc" 	=> __("(Optional) Select a parent category to list only the subcategories of the category.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][parent]",
								"options" => array_merge(array(""=>"Select"),RTTheme::rt_get_product_categories()),
								"purpose" => "sidebar",
								"type"	=> "select",
								"class"	=> $randomClass,
								"default"	=> $parent),

						array(
								"name" 	=> __("Select Product Categories",'rt_theme_admin'),
								"desc" 	=> __("(Optional) List only selected categories. Be sure that you are selecting child categories of the parent category or no category selected from the parent category list.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][ids][]",
								"options" => RTTheme::rt_get_product_categories(),
								"purpose" => "sidebar",
								"type"	=> "selectmultiple",
								"class"	=> $randomClass,
								"default"	=> $ids),
						
						array(
								"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
								"desc" 	=> __("Select and set the sorting order for the product items within the product list by this parameter.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_categories[values][orderby]", 
								"options" => array(	 
															'id'    => __('ID','rt_theme_admin'),
															'name'  => __('Name','rt_theme_admin'),
															'slug'  => __('Slug','rt_theme_admin'),
															'count' => __('Count','rt_theme_admin')	
														),
								"value"	=> $orderby,
								"default"	=> "name",
								"dont_save" => true,
								"type" 	=> "select"),
				
						array(
								"name" 	=> __("Order",'rt_theme_admin'),
								"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_categories[values][order]", 
								"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
								"value"	=> $order,
								"default"	=> "DESC",
								"dont_save" => true, 			
								"type" 	=> "select"),						

				
						array(
								"name" 	=> __("List Layout",'rt_theme_admin'),
								"desc"  => __('Select and set the column layout for listing list. ','rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_product_categories[values][item_width]",
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
								"name" 	=> __("Display Titles",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][display_titles]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $display_titles, 		
								"default"	=> "on",
								"std" 	=> "false"),

						array(
								"name" 	=> __("Display Descriptions",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][display_descriptions]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $display_descriptions, 		 
								"default"	=> "on",
								"std" 	=> "false"),

						array(
								"name" 	=> __("Display Thumbnails",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][display_thumbnails]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $display_thumbnails, 		 
								"default"	=> "on",
								"std" 	=> "false"),					


						array(
								"name" 	=> __("Crop Thumnails",'rt_theme_admin'),
								"desc"  => __("Enable (if checked) the the category thumbnails will be cropped according the 'Maximum Thumbnail Height' value.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][crop]",
								"type" 	=> "checkbox2",
								"class"	=> $randomClass,
								"value"	=> $crop, 	  
								"std" 	=> "false"),	


						array(
								"name" 	=> __("Maximum Thumbnail Height",'rt_theme_admin'),
								"desc"	=> __("Maximum image height for the category thumbnails. 'Crop Thumbnails' option must be checked in order to use this option.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_product_categories[values][image_max_height]",
								"min"	=> "20",
								"max"	=> "2000",
								"class"	=> $randomClass,
								"value"	=> $image_max_height,
								"default"	=> "400",
								"dont_save" => true, 
								"type" 	=> "rangeinput"),


						array(	"type" => "table_end" ),						
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>'; 
	}
}
?>	