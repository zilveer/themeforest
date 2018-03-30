<?php
class rt_generate_google_map_class extends RTThemePageLayoutOptions{
	#
	#	Google Map Box
	#
	function rt_generate_google_map($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Google Map", "rt_theme_admin");
			$contet_type   = "google_map";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID); 
			$isNewBox      = (trim($randomClass)=="") ? false : true; 
			$opacity       = 1;
			$layout        = "one passive_module";
			$position      = $isNewBox ? 'open minus' : 'plus';
			$data_position = 'display: none;'; 
			$module_title  = isset($options["module_title"]) ? $options["module_title"] : ""; 
			$height        = isset($options["height"]) ? $options["height"] : ""; 
			$bwcolor       = isset($options["bwcolor"]) ? $options["bwcolor"] : ""; 
			$zoom          = isset($options["zoom"]) ? $options["zoom"] : ""; 
			$list          = isset($options["list"]) ? $options["list"] : ""; 
			$api_key       = get_option(RT_THEMESLUG.'_google_api_key');
			

			echo '<li class="ui-state-default '.$layout.' '.$randomClass.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';


			$options = array (


						array(
								"desc" => sprintf(
										__("Use this module to insert a google map that displays a single or multiple locations (address markers).<br /><br />Use the &#39;add new location&#39; button to add one or more locations (address markers) to the map.<br /><strong>Note</strong> : per location add the latitude, longitude values, a title and a description (for the description field simple formatting with h & br tags is allowed).<br /><strong>Note</strong> : If more then one location is entered the zoom level is ignored and the map is centered between the locations.%s",'rt_theme_admin'), 
										empty( $api_key ) ? '<p style="color:red">'.__("Missing Google API Key: Google Maps module requires API key to work properly. Go to RT-Theme 18 > General Options and enter yoour API key. Map module will still work for websites created on or before June 22nd, 2016","rt_theme_admin").'<p>' : "" 
										) ,	 
								"hr" => "true",
								"type" => "info", 
						),  

						array( 
								"type" => "col_start",
								"layout" => "three",
								"holder_class" => "labels_block box_border paddings",
						),

						array(
								"name" => __("Module Title",'rt_theme_admin'),
								"desc"      => __('Enter a title to be displayed above the map.','rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_google_map[module_title]", 
								"value"=> $module_title,
								"type" => "text"
						),  

						array(
								"name" 		=> __("Height of the map",'rt_theme_admin'),
								"desc"      => __('Set the height of the map.','rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_google_map[height]",  
								"min"		=>"1",
								"max"		=>"800",
								"default"   =>"300", 
								"dont_save"	=> true,
								"value"		=> $height,  
								"class"		=> $randomClass,
								"type"		=> "rangeinput"
						), 

						array(
								"name" 		=> __("Zoom Level",'rt_theme_admin'),
								"desc"      => __('Set the zoom level of the map. <strong>Note</strong> : Does not work with more then one location added.','rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_google_map[zoom]",  
								"min"		=>"3",
								"max"		=>"21",
								"default"   =>"6", 
								"dont_save"	=> true,
								"value"		=> $zoom,  
								"class"		=> $randomClass,
								"type"		=> "rangeinput"
						), 


						array(
								"name"       => __("Black & White Map",'rt_theme_admin'),
								"id"         => $theTemplateID.'_'.$theGroupID."_google_map[bwcolor]", 
								"value"      => $bwcolor,
								"default"    => "off",
								"class"      => $randomClass,
								"type"       => "checkbox2",
								"std" 	    => "false"
						),  



						array( 
								"type" => "col_split",
								"layout" => "two-three",
						),
 			
				);



			array_push($options, array( 
				"id" => $theTemplateID.'_'.$theGroupID."_google_map_holder",
				"div_class" => "google_map_holder", 
				"type" => "div_start", 
			)); 

			array_push($options, array( 
				"id" => $theTemplateID.'_'.$theGroupID."_google_map",
				"ul_class" => "google_map_list", 
				"type" => "ul_start", 
			)); 
										
			if( is_array( $list ) ){
				foreach ( $list["geo"] as $key => $value ) {
						
					$geo  = ! empty( $list["geo"][$key] ) ? $list["geo"][$key] : "";	
					$title  = ! empty( $list["title"][$key] ) ? $list["title"][$key] : "";	
					$text  = ! empty( $list["text"][$key] ) ? $list["text"][$key] : "";	

					if( !empty( $geo ) ){
						array_push($options, array(
							"geo_id" => $theTemplateID.'_'.$theGroupID."_google_map[list][geo][]", 
							"title_id" => $theTemplateID.'_'.$theGroupID."_google_map[list][title][]", 
							"text_id" => $theTemplateID.'_'.$theGroupID."_google_map[list][text][]", 
							"geo_value"=> $geo,
							"title_value"=> $title,
							"text_value"=> $text,
							"class_name"=> "",
							"type" => "map_location")
						);
					}

				}
			}

			array_push($options, array(
				"geo_id" => $theTemplateID.'_'.$theGroupID."_google_map[list][geo][]", 
				"title_id" => $theTemplateID.'_'.$theGroupID."_google_map[list][title][]", 
				"text_id" => $theTemplateID.'_'.$theGroupID."_google_map[list][text][]", 
				"geo_value"=> "",
				"title_value"=> "",
				"text_value"=> "",
				"class_name"=> "hidden_line",
				"type" => "map_location")
			);

			array_push($options, array( 
				"type" => "ul_end", 
			));

			array_push($options, array(
				"add_new" => true,					
				"type" => "map_location")
			);

			array_push($options, array( 
				"type" => "div_end", 
			));				 

			echo  $this->rt_generate_forms($options);

			array_push($options, array( 
				"type" => "col_end", 
			));		

			echo  '</div></div></div></li>';
	}
}	
?>	