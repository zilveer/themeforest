<?php
class rt_generate_portfolio_box_class extends RTThemePageLayoutOptions{
	#
	#	Portfolio Box
	#
	function rt_generate_portfolio_box($theGroupID,$theTemplateID,$options,$randomClass){ 
	   
			$boxName	   = __("Portfolio Posts", "rt_theme_admin");
			$contet_type   = "portfolio_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity	= 1;
			$layout		= "one passive_module";
			$position	= $isNewBox ? 'open minus':'plus';
			$data_position	= 'display: none;';		 

			$values        = isset( $options['values'] ) ? $options['values'] : array() ;  

			$pagination = $item_width = $item_per_page = $portf_list_orderby = $portf_list_order = $pagination = $filterable = $list_order = $categories = $display_descriptions = $display_embedded_titles =  $display_titles = "";
			extract( $values );		
		
			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (

					array(
							   "desc" => __("This module displays portfolio list following the settings below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info", 
					),
				
					array( "type"	=> "table_start"),	
 
					array(
							"name" 	=> __("Select Portfolio Categories",'rt_theme_admin'),
							"desc" 	=> __("Select categories to filter (shorten) the amount of portfolio items presented in the portfolio list. If you don't select and set a category, this module will list all portfolio items.",'rt_theme_admin'),							
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[values][categories][]",
							"options" => RTTheme::rt_get_portfolio_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the portfolio items within the portfolio list by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[values][portf_list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),		 
							"value"	=> $portf_list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[values][portf_list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $portf_list_order,
							"default"	=> "DESC",
							"dont_save" => true, 					
							"type" 	=> "select"),
	
	

					array(
						"name" 	=> __("Amount of portfolio item per page",'rt_theme_admin'),
						"desc"	=> __("Set the amount of portfolio items to display at once per page.<br /><strong>Note</strong> : works in conjunction with the pagination settings.",'rt_theme_admin'),
						"id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[values][item_per_page]",
						"min"	=> "1",
						"max"	=> "200",
						"class"	=> $randomClass,
						"value"	=> $item_per_page,
						"default"	=> "9",
						"dont_save" => true, 
						"type" 	=> "rangeinput"),
			
					array(
							   "name" 	=> __("Content Layout",'rt_theme_admin'),
							   "desc"  => __('Select and set the column layout for listing the portfolio items. (<strong>Note</strong> : when used in a column module which is f.e. set to a 1/5 column it is better to set the portfolio column layout to a 1/1 layout.)','rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[values][item_width]",
							   "options" =>	array(
													5 => "1/5", 
													4 => "1/4",
													3 => "1/3",
													2 => "1/2",
													1 => "1/1"									
											),
							   "default"=>"3",
							   "value"=>$item_width,
							   "hr" => "true",
							   "type" => "select"),
					 
					array( "type"	=> "td_col"),
										
					array(
							"name" 	=> __("Pagination",'rt_theme_admin'),
							"desc"  => __("Enable (if checked) the pagination ability for the portfolio list.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[values][pagination]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $pagination,  
							"default"	=> "off",
							"std" 	=> "false"),
 

					
					array(
							"name" 	=> __("Filter Navigation",'rt_theme_admin'),
							"desc" 	=> __("Enable (if checked) toplevel filter navigation for the listed portfolio items.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[values][filterable]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $filterable,  
							"default"	=> "off",
							"std" 	=> "false"), 	


					array(
							"name" 	=> __("Display Titles",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[values][display_titles]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $display_titles, 		
							"default"	=> "on",
							"std" 	=> "false"),

					array(
							"name" 	=> __("Display Descriptions",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[values][display_descriptions]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $display_descriptions, 		 
							"default"	=> "on",
							"std" 	=> "false"),

					array(
							"name" 	=> __("Display Embedded Titles",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[values][display_embedded_titles]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $display_embedded_titles, 		 
							"default"	=> "on",
							"std" 	=> "false"),		

					array( "type"	=> "table_end"),	

					);

			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';		
	}
}	
?>	