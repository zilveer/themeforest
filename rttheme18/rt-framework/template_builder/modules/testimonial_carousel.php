<?php
class rt_generate_testimonial_carousel_class extends RTThemePageLayoutOptions{
	#
	#	Testimonial Carousel
	#
	function rt_generate_testimonial_carousel($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Testimonial Carousel", "rt_theme_admin");
			$contet_type   = "testimonial_carousel";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus':'plus';
			$data_position = 'display: none;'; 
			$ids           = "";
			$values        = isset( $options['values'] ) ? $options['values'] : array() ; 

			$heading = $heading_icon = $list_orderby = $list_order = $item_width = $style = "";
			extract( $values );

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';


			$options = array (
					
					array(
							"desc" => __("This module displays the testimonials created by the testimonial post type within a carousel.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
					),


					array(	"type" => "table_start"),
					 	


					array(
							"name" => __("Heading",'rt_theme_admin'),
							"desc" => __('Enter a title to be displayed above the testimonials carousel.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][heading]", 
							"value"=> $heading,
							"type" => "text"
					), 

					array(
							"name" => __("Heading Icon",'rt_theme_admin'),
							"desc" => __('Select and set a icon to precede the testimonials carousel title.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][heading_icon]", 
							"class" => "icon_selection",
							"value"=> $heading_icon,
							"type" => "text"
					), 
 

					array(
							"name" 	=> __("Select Testimonials (Optional)",'rt_theme_admin'),
							"desc" 	=> __("You can filter testimonials by selecting them from this list. If you don't select one, all testimonials will be displayed.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][ids][]",
							"options" => RTTheme::rt_get_testimonial_list(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $ids ),

					array(
							"name" 	=> __("Style",'rt_theme_admin'), 
							"id" => $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][style]",
							"options" =>	array(
										"centered" => "Big Text / Center Aligned", 
										"" => "Small Text / Left Aligned",
								),
							"value"=>$style, 
							"type" => "select"), 


					array(	"type" => "td_col" ),	 					

					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the testimonial items within the carousel by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true, 				
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Content Layout",'rt_theme_admin'),
							"desc"  => __('Select and set the column layout for the carousel.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_testimonial_carousel[values][item_width]",
							"options" =>	array(
										5 => "1/5", 
										4 => "1/4",
										3 => "1/3",
										2 => "1/2",
										1 => "1/1"									
								),
							"value"=>$isNewBox ? 4 : $item_width, 
							"type" => "select"), 		

					array(	"type" => "table_end" ),						
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';			
	}
}
?>	