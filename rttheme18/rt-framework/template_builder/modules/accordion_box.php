<?php
class rt_generate_accordion_box_class extends RTThemePageLayoutOptions{
	#
	#	Accordion Box
	#
	function rt_generate_accordion_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Accordion Content", "rt_theme_admin");
			$contet_type   = "accordion_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module";
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ;
 

 			$accordion_style = isset($options["accordion_style"]) ? $options["accordion_style"] : ""; 
 			$first_one_open = isset($options["first_one_open"]) ? $options["first_one_open"] : ""; 

			echo '<li class="ui-state-default '.$layout.' '.$randomClass.' accordion_box" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

								
			$form_options = array (
  
				array(
						"desc" 		=> __("This module displays a accordion with content.",'rt_theme_admin'),	 
						"hr" 		=> "true",
						"type" 		=> "info"), 	 

				array(
						"name"		=> __("Select Accordion Style",'rt_theme_admin'), 
						"desc"      => __('Select and set the accordion style. <br /><br />&#39;Numbered&#39; : the caption is preceded by a number,<br />&#39;With icons&#39; :  the caption is preceded by a icon, <br />&#39;Captions Only&#39; : the caption without icon or number is displayed.','rt_theme_admin'),
						"id" 		=> $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_style]", 
						"options" 	=>	array( 
											"numbered" => "Numbered",
											"icons" => "With Icons",
											"only_captions" => "Captions Only"
									), 
						"value"		=> $accordion_style,
						"hr" 		=> "true",
						"dont_save"	=> true,
						"type"		=> "select"),  
 


					array(
							"name" 	=> __("First One Visible",'rt_theme_admin'),
							"check_desc"  => __("Make the first accordion content visible when the page loaded.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_accordion_box[first_one_open]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $first_one_open,  
							"default" => "",
							"std" 	=> "false",
							"hr" 	=> "true"),

					array(
						"desc" 		=> __("CREATE CONTENTS",'rt_theme_admin'),	  
						"type" 		=> "info_text_only"), 
			);


			echo  $this->rt_generate_forms($form_options);
			 
			//call the accordions
			$options["accordion_contents"] = isset( $options["accordion_contents"] ) ? $options["accordion_contents"] : array();
			echo $this->rt_create_accordions($theTemplateID,$theGroupID,$options["accordion_contents"],$randomClass);  
			echo  '</div></div></div></li>';
	}

	//creates accordion contents
	function rt_create_accordions($theTemplateID,$theGroupID,$options){

		echo '<div class="slider_creator for_accordions"><ul class="slides_holder">';		 


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
								"desc"      => __('Enter the accordion caption title.','rt_theme_admin'),													
								"id"        => $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_contents][caption][]", 
								"value"     => $caption, 
								"type"      => "text"),  

							array("type"   => "td_col"),

							array(
								"name"      => __("Icon",'rt_theme_admin'),
								"desc"      => __('Select and set a icon to precede the caption (optional).','rt_theme_admin'),													
								"id"        => $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_contents][icon][]", 
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
								"desc"      => __('Enter the content to be displayed within the accordion panel. The content becomes visible when the accordion panel is active.','rt_theme_admin'),													
								"id"        => $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_contents][text][]",								
								"css_id"    => $theTemplateID.'_'.$theGroupID."_accordion_box".$key,
								"value"     => $text, 
								"type"      => "textarea_tinyMCE"), 

							array( 
									"type" => "col_end"
							)							
						); 

						echo  $this->rt_generate_forms($form_options);

					echo '</div></li>';	
				}
 
			}							
		}

		echo '<li class="slide_options new_slide"><div class="title">New Content<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

			$form_options = array (

				array("type"		=> "table_start"),

				array(
					"name"      => __("Caption",'rt_theme_admin'), 
					"desc"      => __('Enter the accordion caption title.','rt_theme_admin'),																		
					"id"        => $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_contents][caption][]",
					"hr"        => "true",
					"type"      => "text"),

				array("type"   => "td_col"),

				array(
					"name"      => __("Icon",'rt_theme_admin'), 
					"desc"      => __('Select and set a icon to precede the caption (optional).','rt_theme_admin'),																		
					"id"        => $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_contents][icon][]",  
					"class"		=> 'icon_selection',
					"hr"        => "true",
					"type"      => "text"),		

				array("type"    => "table_end"),

				array( 
					"type"         => "col_start",
					"layout"       => "one",
					"holder_class" => "labels_block box_border paddings",
				),
				array(
					"name"      => __("Text",'rt_theme_admin'), 
					"desc"      => __('Enter the content to be displayed within the accordion panel. The content becomes visible when the accordion panel is active.','rt_theme_admin'),																		
					"id"        => $theTemplateID.'_'.$theGroupID."_accordion_box[accordion_contents][text][]",
					"css_id"    => $theTemplateID.'_'.$theGroupID."_accordion_box_new", 
					"type"      => "textarea_tinyMCE"),  		

				array( 
						"type" => "col_end"
				),					
			); 

			echo  $this->rt_generate_forms($form_options);

		echo '</div></li>';   
		echo '</ul>';  
		echo '<button type="button" class="template_button green rt_add_new_slide icon-plus-squared-1">'.__('add new content','rt_theme_admin') .' </button>';  				
		echo '</div>';
	}
}
?>	