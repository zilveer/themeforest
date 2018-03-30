<?php
class rt_generate_portfolio_carousel_class extends RTThemePageLayoutOptions{
	#
	#	Portfolio Carousel Box
	#
	function rt_generate_portfolio_carousel($theGroupID,$theTemplateID,$options,$randomClass){
	   
			$boxName       = __("Portfolio Carousel", "rt_theme_admin");
			$contet_type   = "portfolio_carousel";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;		
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus';
			$data_position = 'display: none;' ; 
			$values        = isset( $options['values'] ) ? $options['values'] : array() ; 

			$crop = $display_descriptions = $display_titles = $item_width = $max_item = $list_order = $list_orderby = $categories = $heading_icon = $heading = "";
			extract( $values );

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
					
					array(
							"desc" => __("This module displays portfolio items as a carousel following the settings below.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
					), 

					array(	"type" => "table_start"), 

					array(
							"name" => __("Heading",'rt_theme_admin'),
							"desc"      => __('Enter a title to be displayed above the portfolio carousel.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][heading]", 
							"value"=> $heading,
							"type" => "text"
					), 

					array(
							"name" => __("Heading Icon",'rt_theme_admin'),
							"desc"      => __('Select and set a icon to precede the portfolio carousel title.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][heading_icon]", 
							"class" => "icon_selection",
							"value"=> $heading_icon,
							"type" => "text"
					), 


					array(
							"name" 	=> __("Select Portfolio Categories",'rt_theme_admin'),
							"desc" 	=> __("Select and set categories to filter (shorten) the amount of portfolio items presented in the carousel. If you don't select and set a category, this module will list all portfolio items.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][categories][]",
							"options" => RTTheme::rt_get_portfolio_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the portfolio items within the carsousel by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),	 
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true, 				
							"type" 	=> "select"),

					
					array(	"type" => "td_col" ),	

					array(
							"name" 	=> __("Carousel Style",'rt_theme_admin'),
							"desc"      => __('Select and set the carousel style.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][style]",
							"options" =>	array(
										"plain_carousel" => "Plain Box", 
										"rounded_carousel" => "With Borders",								
								),
							"default"=>"1",
							"value"=>$item_width, 
							"type" => "select"), 


					array(
							"name" 	=> __("Maximum Items",'rt_theme_admin'),
							"desc"	=> __("Set the amount of portfolio items to be displayed within the carousel.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][max_item]",
							"min"	=> "1",
							"max"	=> "200",
							"class"	=> $randomClass,
							"value"	=> $max_item,
							"default"	=> "9",
							"dont_save" => true, 
							"type" 	=> "rangeinput"),
			
					array(
							"name" 	=> __("Content Layout",'rt_theme_admin'),
							"desc"      => __('Select and set the column layout for the carousel.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][item_width]",
							"options" =>	array(
										5 => "1/5", 
										4 => "1/4",
										3 => "1/3",
										2 => "1/2",
										1 => "1/1"									
								),
							"default"=>"1",
							"value"=>$item_width,
							"hr" => "true",
							"type" => "select"), 	


					array(
							"name" 	=> __("Display Titles. (check to add the portfolio item title to the carousel)",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][display_titles]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $display_titles, 		
							"default"	=> "on",
							"std" 	=> "false"),

					array(
							"name" 	=> __("Display Descriptions. (check to add the portfolio item discription to the carousel)",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][display_descriptions]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $display_descriptions, 		 
							"default"	=> "on",
							"std" 	=> "false"),

					array(
							"name" 	=> __("Crop Images. (check to enable cropping the portfolio item image)",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_carousel[values][crop]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $crop, 		 
							"default"	=> "on",
							"std" 	=> "false"),


					array(	"type" => "table_end" ),						
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>'; 
	}
}
?>	