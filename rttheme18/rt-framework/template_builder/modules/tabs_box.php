<?php
class rt_generate_tabs_box_class extends RTThemePageLayoutOptions{
	#
	#	Tabs Box
	#
	function rt_generate_tabs_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Tabular Content", "rt_theme_admin");
			$contet_type   = "tabs_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module";
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ;
 

 			$tabs_style = isset($options["tabs_style"]) ? $options["tabs_style"] : "";


			echo '<li class="ui-state-default tabs_box '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

								
			$form_options = array (
  
				array(
						"desc" 		=> __("This module is to display entered content in tabs.",'rt_theme_admin'),	 
						"hr" 		=> "true",
						"type" 		=> "info"), 	 

				array(
						"name"		=> __("Select Tabs Style",'rt_theme_admin'),
						"desc" 		=> __("Select and set the tabs layout (horizontal or vertical).",'rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_tabs_box[tabs_style]", 
						"options" 	=>	array( 
											"horizontal" => __("Horizontal Tabs","rt_theme_admin"),
											"horizontal2" => __("Horizontal Tabs (Style 2)","rt_theme_admin"),
											"horizontal3" => __("Horizontal Tabs (Style 3)","rt_theme_admin"),
											"vertical" => __("Vertical Tabs","rt_theme_admin")
										), 
						"value"		=> $tabs_style,
						"hr" 		=> "true",
						"dont_save"	=> true,
						"type"		=> "select"),  
 

					array(
							"desc" 		=> __("CREATE TABS. Press the &#39;add new tab&#39; button to add one or more tabs.",'rt_theme_admin'),	  
							"type" 		=> "info_text_only"), 
			);


			echo  $this->rt_generate_forms($form_options);
			 
			//call the tabs
			$options["tab_contents"] = isset( $options["tab_contents"] ) ? $options["tab_contents"] : array();
			echo $this->rt_create_tabs($theTemplateID,$theGroupID,$options["tab_contents"],$randomClass);   

			echo  '</div></div></div></li>';
 
	}

	//create slides for the slider that embedded to the slider module
	function rt_create_tabs($theTemplateID,$theGroupID,$options){

		echo '<div class="slider_creator for_tabs"><ul class="slides_holder">';		  

		if ( isset( $options["caption"] ) ) {
			foreach ( $options["caption"] as $key => $value ) {

				$caption = ! empty( $options["caption"][$key] ) ? $options["caption"][$key] : "";
				$text    = ! empty( $options["text"][$key] ) ? $options["text"][$key] : "";		
				$icon    = ! empty( $options["icon"][$key] ) ? $options["icon"][$key] : "";				 

				if ( $caption ) {
					echo '<li class="slide_options"><div class="title">'.stripslashes($caption).'<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

						$form_options = array (

							array("type"    => "table_start"),

							array(
								"name"      => __("Caption",'rt_theme_admin'), 
								"desc"      => __('Enter a tab caption title.','rt_theme_admin'),
								"id"        => $theTemplateID.'_'.$theGroupID."_tabs_box[tab_contents][caption][]", 
								"value"     => $caption, 
								"type"      => "text"),  

							array("type"   => "td_col"),

							array(
								"name"      => __("Icon",'rt_theme_admin'), 
								"desc"      => __('Select and set a icon to precede the caption (optional).','rt_theme_admin'),
								"id"        => $theTemplateID.'_'.$theGroupID."_tabs_box[tab_contents][icon][]", 
								"value"     => $icon,
								"class"     => 'icon_selection', 
								"type"      => "text"), 

							array("type"    => "table_end"),

							array( 
									"type" => "col_start",
									"layout" => "one",
									"holder_class" => "labels_block box_border paddings",
							),

							array(
								"name"      => __("Text",'rt_theme_admin'), 
								"desc"      => __('Enter the content to be displayed within the tab. The content becomes visible when the tab is active.','rt_theme_admin'),
								"id"        => $theTemplateID.'_'.$theGroupID."_tabs_box[tab_contents][text][]",								
								"css_id"    => $theTemplateID.'_'.$theGroupID."_tabs_box".$key,
								"value"     => $text, 
								"type"      => "textarea_tinyMCE"), 

							array( 
									"type" => "col_end"
							),	

						); 

						echo  $this->rt_generate_forms($form_options);

					echo '</div></li>';	
				}
 
			}							
		}

		echo '<li class="slide_options new_slide"><div class="title">New Tab<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

			$form_options = array (

				array("type"    => "table_start"),

				array(
					"name"      => __("Caption",'rt_theme_admin'), 
					"desc"      => __('Enter a tab caption title.','rt_theme_admin'),					
					"id"        => $theTemplateID.'_'.$theGroupID."_tabs_box[tab_contents][caption][]",
					"hr"        => "true",
					"type"      => "text"),

				array("type"    => "td_col"),

				array(
					"name"      => __("Icon",'rt_theme_admin'), 
					"desc"      => __('Select and set a icon to precede the caption (optional).','rt_theme_admin'),					
					"id"        => $theTemplateID.'_'.$theGroupID."_tabs_box[tab_contents][icon][]",  
					"class"     => 'icon_selection',
					"hr"        => "true",
					"type"      => "text"),		

				array("type"    => "table_end"), 

				array( 
						"type" => "col_start",
						"layout" => "one",
						"holder_class" => "labels_block box_border paddings",
				),

				array(
					"name"      => __("Text",'rt_theme_admin'),
					"desc"      => __('Enter the content to be displayed within the tab. The content becomes visible when the tab is active.','rt_theme_admin'),					
					"id"        => $theTemplateID.'_'.$theGroupID."_tabs_box[tab_contents][text][]",
					"css_id"    => $theTemplateID.'_'.$theGroupID."_tabs_box_new", 
					"type"      => "textarea_tinyMCE"),  		

				array( 
						"type" => "col_end"
				),	
							
			); 

			echo  $this->rt_generate_forms($form_options);

		echo '</div></li>';   
		echo '</ul>'; 
		echo '<button type="button" class="template_button green rt_add_new_slide icon-plus-squared-1">'.__('add new tab','rt_theme_admin') .' </button>';  		
		echo '</div>';

	}
}	
?>	