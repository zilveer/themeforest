<?php
class rt_generate_blog_carousel_class extends RTThemePageLayoutOptions{
	#
	#	Blog Carousel Box
	#
	function rt_generate_blog_carousel($theGroupID,$theTemplateID,$options,$randomClass){				
	   
			$boxName		= __("Blog Carousel", "rt_theme_admin");
			$contet_type	= "blog_carousel";
			$theTemplateID  = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity    = 1;
			$layout        = "one passive_module" ;
			$position		= $isNewBox ? 'open minus'	:'plus';
			$data_position	= 'display: none;';  
			$categories	= isset( $options['categories'] ) ? $options['categories'] : array() ; 
			$values	= isset( $options['values'] ) ? $options['values'] : array() ; 

			$heading = $heading_icon = $list_order = $list_orderby = $item_width = $max_item = $crop = $display_excerpts = $limit_chars = $style = "";
			extract( $values );

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';			

			$options = array (
					
					array(
							"desc" => __("This module displays blog posts as a carousel following the settings below.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
					),


					array(	"type" => "table_start"),
					 	


					array(
							"name" => __("Heading",'rt_theme_admin'),
							"desc"      => __('Enter a title to be displayed above the blog posts carousel.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][heading]", 
							"value"=> $heading,
							"type" => "text"
					), 

					array(
							"name" => __("Heading Icon",'rt_theme_admin'),
							"desc"      => __('Select and set a icon to precede the blog posts carousel title.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][heading_icon]", 
							"class" => "icon_selection",
							"value"=> $heading_icon,
							"type" => "text"
					), 


					array(
							"name" 	=> __("Select Categories",'rt_theme_admin'),
							"desc" 	=> __("Select and set categories to filter (shorten) the amount of blog posts presented in the carousel. If you don't select and set a category, this module will list all blogposts.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_carousel[values][categories][]",
							"options" => RTTheme::rt_get_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the blog posts within the carousel by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),		 
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true, 		
							"type" 	=> "select"),


					array(
							"name" => __("Custom Excerpts Size",'rt_theme_admin'),
							"desc" => __('Give a number to change the charackter size of the post excerpts.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][limit_chars]", 
							"value"=> $limit_chars,
							"type" => "text"
					), 
					
					array(	"type" => "td_col" ),	
 

					array(
							"name" 	=> __("Carousel Style",'rt_theme_admin'),
							"desc"      => __('Select and set the carousel style.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][style]",
							"options" =>	array(
										"plain_carousel" => "Plain Box", 
										"rounded_carousel" => "With Borders", 									
								),
							"default"=>"1",
							"value"=>$style,
							"type" => "select"), 


					array(
							"name" 	=> __("Maximum Items",'rt_theme_admin'),
							"desc"	=> __("Set the amount of blog posts to be displayed within the carousel.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_carousel[values][max_item]",
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
							"id" => $theTemplateID.'_'.$theGroupID."_blog_carousel[values][item_width]",
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
							"name" 	=> __("Display Excerpts. (check to add blog excerpts to the carousel)",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_carousel[values][display_excerpts]",
							"type" 	=> "checkbox2",
							"class"	=> $randomClass,
							"value"	=> $display_excerpts, 		 
							"default"	=> "on",
							"std" 	=> "false"),

					array(
							"name" 	=> __("Crop Images (check to enable cropping of the blog post featured image)",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_carousel[values][crop]",
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