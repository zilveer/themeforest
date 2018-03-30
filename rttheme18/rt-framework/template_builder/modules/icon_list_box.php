<?php
class rt_generate_icon_list_box_class extends RTThemePageLayoutOptions{
	#
	#	Icon List Box
	#
	function rt_generate_icon_list_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("List With Icons", "rt_theme_admin");
			$contet_type   = "icon_list_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module";
			$position      = $isNewBox ? 'open minus' : 'plus';
			$data_position = 'display: none;';
			$module_title  = isset( $options['module_title'] ) ? $options['module_title'] : '' ;  			
			$list          = isset( $options['list'] ) ? $options['list'] : '' ;  		
			$icon_style    = isset( $options['icon_style'] ) ? $options['icon_style'] : '' ;  
			$item_width    = isset( $options['item_width'] ) ? $options['item_width'] : '' ;   

			echo '<li class="ui-state-default '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
					array(
							"desc" => __("You can use this module to add a detailed information list preceded with icons (f.e. contact information). <br /><strong>Note</strong> : Add a icon and line of text per listed item.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
					),  

					array( 
							"type" => "col_start",
							"layout" => "three",
							"holder_class" => "labels_block box_border paddings",							
					),

					array(
							"name" => __("List Title",'rt_theme_admin'),
							"desc"      => __('Enter the title to be displayed above the detailed list.','rt_theme_admin'),							
							"id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[module_title]",
							"hr" => "true",
							"value"=> $module_title,
							"type" => "text"
					), 

					array( 
							"type" => "col_split",
							"layout" => "three"
					),

					array(
							"name" 	=> __("Content Layout",'rt_theme_admin'),
							"desc"  => __('Select and set the column layout for listing the list items.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[item_width]",
							"options" => array(
											1 => "1/1",
											2 => "1/2",	
											3 => "1/3",
											4 => "1/4",	
											5 => "1/5" 
										),
							"default"=>"1", 
							"hr" => "true", 
							"value"=>$item_width, 
							"type" => "select"), 

					array( 
							"type" => "col_split",
							"layout" => "three"
					), 

					array(
							"name"      => __("Icon Style",'rt_theme_admin'),
							"desc"      => __('Select and set the default icon color for each of the listed items.','rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[icon_style]",
							"options"   =>  array(
								"default" => "Content Color", 
								"colored" => "Primary Color",
								"light" => "Light Grey",
								"default big_icons" => "Big Icons - Content Color", 
								"colored big_icons" => "Big Icons - Primary Color",
								"light big_icons" => "Big Icons - Light Grey",
								"default big_icons icon_borders" => "Big Icons - Content Color w/ Borders", 
								"colored big_icons icon_borders" => "Big Icons - Primary Color w/ Borders",
								"light big_icons icon_borders" => "Big Icons - Light Grey w/ Borders",
								),
							"value"		=> $icon_style,
							"hr"		=> "true",
							"type"      => "select", 
					),	 


					array( 
							"type" => "col_end"
					),
			); 

			array_push($options, array( 
				"id" => $theTemplateID.'_'.$theGroupID."_icon_list_holder",
				"div_class" => "icon_list_holder", 
				"type" => "div_start", 
			)); 

			array_push($options, array( 
				"id" => $theTemplateID.'_'.$theGroupID."_icon_list",
				"ul_class" => "icon_list", 
				"type" => "ul_start", 
			)); 
										
			if( is_array( $list ) ){
				foreach ( $list["text"] as $key => $value ) {
						
					$list_text  = ! empty( $list["text"][$key] ) ? $list["text"][$key] : "";	
					$list_icon  = ! empty( $list["icon"][$key] ) ? $list["icon"][$key] : "";	

					if( !empty( $list_text ) ){
						array_push($options, array(
							"icon_id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[list][icon][]", 
							"text_id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[list][text][]", 
							"icon_value"=> $list_icon,
							"text_value"=> $list_text,
							"class_name"=> "",
							"type" => "icon_list")
						);
					}

				}
			}

			array_push($options, array(
				"icon_id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[list][icon][]", 
				"text_id" => $theTemplateID.'_'.$theGroupID."_icon_list_box[list][text][]", 
				"icon_value"=> "",
				"text_value"=> "",
				"class_name"=> "hidden_line",
				"type" => "icon_list")
			);

			array_push($options, array( 
				"type" => "ul_end", 
			));

			array_push($options, array(
				"add_new" => true,					
				"type" => "icon_list")
			);

			array_push($options, array( 
				"type" => "div_end", 
			));				 

			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	