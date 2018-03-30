<?php
#-----------------------------------------
#	RT-Theme page_layout_options.php
#
#	Several functions for template builder
#
#-----------------------------------------


class RTThemePageLayoutOptions extends RTThemeAdmin{

	#
	#	Export Templates
	# 
	function rt_export_page_templates( $selectedTemplate = "" ){
		global $pageLayoutClass;

		$output = array();

 		//get the saved template names
		$saved_template_names = get_option(RT_THEMESLUG.'_template_names_array');		

		if( is_array( $saved_template_names ) ){
			//create default templates 
			foreach ($saved_template_names as $templateID => $templateData) {

					//check if a template specified
					if ( ! empty( $selectedTemplate ) ) {
						$templateID = $selectedTemplate;
					}

					$this_template = array();

					//the template data
					if( get_option( RT_THEMESLUG."_".$templateID."_encoded") == "true" ){ 	
						$this_template["template"] = unserialize( base64_decode( get_option( RT_THEMESLUG."_".$templateID ) ) );
					}else{
						$this_template["template"] = get_option( RT_THEMESLUG."_".$templateID );
					}

					//header output
					$this_template["header_output"] = get_option( RT_THEMESLUG."_".$templateID."_header_output" );							

					//footer output
		 			$this_template["footer_output"] = get_option( RT_THEMESLUG."_".$templateID."_footer_output" ); 
		 
					//content output
		 			$this_template["content_output"] = get_option( RT_THEMESLUG."_".$templateID."_content_output" ); 
		 
					//css output
					$this_template["css_output"] = get_option( RT_THEMESLUG."_".$templateID."_css_output" );
					 
					//template options
					$this_template["template_options"] = get_option( RT_THEMESLUG."_".$templateID."_template_options");

					//encode remark
					$this_template["encoded"] = get_option( RT_THEMESLUG."_".$templateID."_encoded");

					//add to the output
					array_push( $output, $this_template); 

					//check if a template specified then stop the loop
					if ( ! empty( $selectedTemplate ) ) {
						break;
					}

			}
		}		

		// server time 
		$file_time = date('y-M-d-H-i-s');

		// sent file to user
		header('Content-type: text/plain');  
		header('Content-Disposition: attachment; filename="Templates '.$file_time.'.txt"'); 

		print base64_encode(serialize($output));


		/*	demo image replacement
			$demo_image= "{{demo_image}}"; 
			$output = preg_replace('/https?:\/\/[^ ]+?(?:\.jpg|\.png|\.gif)/', $demo_image, serialize($output));
			$output = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $output );
			print base64_encode($output);	
		*/
	}


	#
	#	Upload demo image
	# 
	function rt_upload_demo_images( $url = "" ){

		$tmp = download_url( $url );

		$file_array= array('name' => "", 'tmp_name' => "" );
		$post_id = 1;
		$desc = "Sample Image";

		if ( is_wp_error( $tmp ) ) { 
			return false;
		}

		// Set variables for storage
		// fix file filename for query strings
		if ( ! is_wp_error( $tmp ) ) {
			preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $url, $matches);
			$file_array['name'] = basename($matches[0]);
			$file_array['tmp_name'] = $tmp;
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		if ( is_wp_error($id) ) { 
			return false;
		}
		
		return $id;  
	}


	#
	#	Import Templates
	# 
 
	function rt_import_page_templates( $file_content = "" ){
		global $pageLayoutClass;
		
		//check file content
		if( empty( $file_content ) ){
			return false;
		}  

		//decode
		$file_content = base64_decode( $file_content );

		//unserialize data and check if it is array
		$file_content_array = $pageLayoutClass->fix_serialized_array( $file_content ); 

		if( ! is_array( $file_content_array ) ){
			return false;
		}

		//get the saved template names
		$saved_template_names = get_option(RT_THEMESLUG.'_template_names_array');		

		//fix template and row id's
		foreach ( $file_content_array as $key => $template ) {

			if(!is_object($template["template"])){
				continue;
			}			

			$template_object = $pageLayoutClass->fix_serialized_array( $template["template"]->templates );				
			$old_templateID = key( $template_object );
			$old_templateID_number = explode("_", $old_templateID );
			$old_templateID_number = is_array( $old_templateID_number ) ? $old_templateID_number[1] : "" ; 


			if( ! empty( $old_templateID_number ) ){

				//check the old tempalte ID if exists
				if( isset( $saved_template_names[ $old_templateID] ) ) {
		 			// New Template ID
					$randomnumber = rand(1000, 1000000); 	 
					$file_content = str_replace($old_templateID_number, $randomnumber, $file_content ); 
				}

			}else{
				return false;
			}

		}

		//the demo image
		$demo_image_url = RT_THEMEURI . "/images/sample-image.jpg";

		//try to upload the demo sample image to wp_uploads folder
		if( ! get_option( RT_THEMESLUG."_demo_images_uploaded" ) ){
			
			$demo_image_id = $this->rt_upload_demo_images( $demo_image_url );

			if( $demo_image_id ){
				$demo_image_url = wp_get_attachment_url( $demo_image_id );
			}

			//set a value to prevent multiple uploads even if there is an error with the upload
			update_option( RT_THEMESLUG."_demo_images_uploaded", "true");
		}

		//demo image urls
		$demo_image_replaces = array (
			'{{demo_image}}' => $demo_image_url
		); 
		$file_content = strtr($file_content, $demo_image_replaces);


		//unserialize the edited serilized array in file content 
		$file_content_array = $pageLayoutClass->fix_serialized_array( $file_content ); 

		//new template array
		$newTemplateArray = array(); 

		//error
		if( ! is_array( $file_content_array ) ){
			return ;
		}

		//import templates
		foreach ( $file_content_array as $key => $template ) {

			if(!is_object($template["template"])){
				continue;
			}	
			
			$template_object = $pageLayoutClass->fix_serialized_array( $template["template"]->templates );
			$template_data = base64_encode( serialize( $template["template"] ) );

			$templateID = key( $template_object );
			$templateName = $template_object[ $templateID ]->templateName; 

			//the template data
			update_option( RT_THEMESLUG."_".$templateID, $template_data );

			//header output
			update_option( RT_THEMESLUG."_".$templateID."_header_output", stripcslashes( $template["header_output"] ) );							

			//footer output
 			update_option( RT_THEMESLUG."_".$templateID."_footer_output", stripcslashes( $template["footer_output"] ) ); 
 
			//content output
 			update_option( RT_THEMESLUG."_".$templateID."_content_output", stripcslashes( $template["content_output"] ) ); 

			//stripped content for search
			$clean_text = preg_replace("/(\[|\]|-)/si"," ", sanitize_text_field( $template["header_output"] . $template["content_output"] . $template["footer_output"] ) );  
 			update_option( RT_THEMESLUG."_".$templateID."_clean_text", $clean_text );
 
			//css output
			update_option( RT_THEMESLUG."_".$templateID."_css_output",  $template["css_output"] );
			
			//template options
			if( isset( $template["encoded"] ) && $template["encoded"] == "true" ){ 			
				update_option( RT_THEMESLUG."_".$templateID."_template_options", $template["template_options"] );
			}else{
				update_option( RT_THEMESLUG."_".$templateID."_template_options", base64_encode( serialize( $template["template_options"] ) ) );
			}

			//encode remark			
			update_option( RT_THEMESLUG."_".$templateID."_encoded", "true" );

			//new template names array to add the list
			$newTemplateArray[$templateID] =  array( "name" => $templateName, "is_default_template" => false, "default_template_data" => '' );

		}


		/*
		* update the template list   
		*/

		//update the list
	 	update_option(RT_THEMESLUG.'_template_names_array',  array_merge( $saved_template_names, $newTemplateArray ) );  

		return true;
	}


	#
	#	Fix editor contents
	#	removes the extra html codes of all shortcodes that added into the editor via shortcode helper
	# 
	function fix_editor_contents($content) { 

		// array of custom shortcodes requiring the fix		
		$block = join("|",array("rt_column","rt_columns","columns","column","slider","slide","photo_gallery","image","auto_thumb","icon_list","icon_list_line","tabs","tab","accordion","pane","table_column","pricing_table","contact_form","pullquote","banner","button","heading","location","google_maps","h_chained_contents","h_content","v_media_boxes","v_media_box","v_icon_boxes","v_icon_box","content_box","content_icon_box"));

		// opening tag
		$content = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>|<br \/>)(<br \/>)?/","[$2$3]", $content); 
 
		// closing tag
		$content = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>|<br \/>)(<br \/>)?/","[/$2]",$content);  

		//find single idle p tags 
		$content = preg_replace('/\p{Zs}/u', '', $content) == "<p></p>" ? "" : $content ;

		return $content;  			 
	}


	#
	#	Fix editor columns
	#	removes the extra html codes of column shortcodes that added into the editor via shortcode helper
	# 
	function fix_editor_columns( $the_content ){ 
	 
		//clear first part 
		$first='[columns]';
		$second='[column layout='; 
		$content = preg_replace('#('.preg_quote($first).')(.*?)('.preg_quote($second).')#si', '$1$3', $the_content);

		$array = array (
			'<p>[columns]</p>' => '[columns]', 
			'[/columns]</p>' => '[/columns]',  
			'[/column]<br /><br />[/columns]' => '[/column][/columns]',    
			'[/column]<br /><br />[/columns]</p>' => '[/column][/columns]',   
			'[/column]<br /><br /> [column' => '[/column][column',    
			'[/column] <br /><br /> [column layout' => '[/column][column layout',
			'[/column]<br />[/columns]</p>' => '[/column][/columns]',   
			'[/column]<br />[/columns]' => '[/column][/columns]',  	   
			'[/column]'."\n".'<p>&nbsp;</p>'."\n".'[column ' => '[/column][column]',   
		); 

		$content = strtr(trim($content), $array);

		return $content;  
	}


	#
	#	Save Page Templates
	# 
	function rt_save_page_templates(){
		global $wpdb; 

		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}	

		$savedTemplates       =  $_POST;
		$savedTemplates_Array =  array();  


		//Class For Templates
		$templates  =  new stdClass;

		$box=0;
		$template=0;

		$group_id = "";
		
		foreach($savedTemplates as $key=>$value){
			
			 
			$jump = stristr($key, '_template_name') == TRUE && $value==""  ? true : false ;
			 
			if(!$jump){
				//template name and ID		
				if(stristr($key, '_template_name') == TRUE) {
					
					$template = str_replace('_template_name','',$key); 
					
					$templates->templates[$template] =  new stdClass;

					$templates->templates[$template]->templateID	= $template; 
					$templates->templates[$template]->templateName 	= $value;
 
					//save the templates as an array
					$savedTemplates_Array[$template] = $value; 
				}

				//Page layout - sidebar selection
				if(stristr($key, $templates->templates[$template]->templateID.'_sidebarSelection') == TRUE && $templates->templates[$template]->templateName) { 
					$box++; 
					$templates->templates[$template]->sidebar 		= $value; 
				}	
	
				//group id
				if(stristr($key, 'theGroupID_') == TRUE) {			
					$group_id = $value;  
				}


				//home page boxes
				if(stristr($key, '_home_page_box')                                   == TRUE) {
				$box++;				
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'home_page_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value[0];
				$templates->templates[$template]->contents[$box]->content_id         =  $value[1];
				}
				
				//product list
				if(stristr($key, '_product_box')                                     == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'product_box'; 
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				//product categories
				if(stristr($key, '_product_categories')                              == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'product_categories'; 
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}


				//product carousel
				if(stristr($key, '_product_carousel')                                == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'product_carousel';
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				if ( class_exists( 'Woocommerce' ) ) {

					//woocommerce product carousel
					if(stristr($key, '_wcproduct_carousel')                                == TRUE) {
					$box++;
					$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
					$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
					$templates->templates[$template]->contents[$box]->content_type       =  'wcproduct_carousel';
					$templates->templates[$template]->contents[$box]->values             =  $value["values"];
					}

					//woocommerce product list
					if(stristr($key, '_woo_products_extended')                           == TRUE) {
					$box++;
					$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
					$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
					$templates->templates[$template]->contents[$box]->content_type       =  'woo_products_extended'; 
					$templates->templates[$template]->contents[$box]->values             =  $value["values"];
					}

					//woo product list
					if(stristr($key, '_woo_products_box')                                == TRUE) {
					$box++;
					$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class					
					$templates->templates[$template]->contents[$box]->group_id         	 =  $group_id; // group id
					$templates->templates[$template]->contents[$box]->content_type       =  'woo_products_box'; 
					$templates->templates[$template]->contents[$box]->item_width         =  $value["item_width"]; 
					$templates->templates[$template]->contents[$box]->list_orderby       =  $value["list_orderby"];
					$templates->templates[$template]->contents[$box]->list_order         =  $value["list_order"];
					$templates->templates[$template]->contents[$box]->item_per_page      =  $value["item_per_page"];
					$templates->templates[$template]->contents[$box]->categories         =  isset($value["categories"]) ? $value["categories"] : "";	 
					}
				}
				
				//portfolio list
				if(stristr($key, '_portfolio_box')                                   == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'portfolio_box'; 
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];	
				}

				//portfolio carousel
				if(stristr($key, '_portfolio_carousel')                              == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'portfolio_carousel';
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				//sidebar boxes
				if(stristr($key, 'sidebar_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'sidebar_box';
				$templates->templates[$template]->contents[$box]->sidebar_id         =  $value["sidebar_id"];
				$templates->templates[$template]->contents[$box]->widget_box_width   =  $value["widget_box_width"]; 
				}
				
				//default content 
				if(stristr($key, 'default_content')                                  == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'default_content';
				$templates->templates[$template]->contents[$box]->layout             =  "one";
				}
				
				//banner box
				if(stristr($key, '_banner_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'banner_box'; 			
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];									 
				}
				
				//Slider box
				if(stristr($key, '_slider_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'slider_box';  
				$templates->templates[$template]->contents[$box]->slider_timeout     =  $value["slider_timeout"];
				$templates->templates[$template]->contents[$box]->slider_height      =  $value["slider_height"];
				$templates->templates[$template]->contents[$box]->slider_width       =  $value["slider_width"];
				$templates->templates[$template]->contents[$box]->image_resize       =  isset($value["image_resize"]) ? $value["image_resize"] : "";  
				$templates->templates[$template]->contents[$box]->image_crop         =  isset($value["image_crop"]) ? $value["image_crop"] : "";  
				$templates->templates[$template]->contents[$box]->flex_slider_effect =  $value["flex_slider_effect"];   
				$templates->templates[$template]->contents[$box]->slides             =  $value["slides"]; 
				}

				//Tabs box
				if(stristr($key, '_tabs_box')                                        == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'tabs_box'; 
 				$templates->templates[$template]->contents[$box]->tabs_style         =  $value["tabs_style"]; 
				$templates->templates[$template]->contents[$box]->tab_contents       =  $value["tab_contents"]; 
				}

				//Accordion box
				if(stristr($key, '_accordion_box')                                   == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'accordion_box'; 
 				$templates->templates[$template]->contents[$box]->accordion_style    =  $value["accordion_style"]; 
 				$templates->templates[$template]->contents[$box]->first_one_open     =  isset($value["first_one_open"]) ? $value["first_one_open"] : "";
				$templates->templates[$template]->contents[$box]->accordion_contents =  $value["accordion_contents"]; 
				}

				//Vertical chained box
				if(stristr($key, '_v_chained_icon_box')                                   == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'v_chained_icon_box'; 
 				$templates->templates[$template]->contents[$box]->media_alignment    =  $value["media_alignment"]; 
				$templates->templates[$template]->contents[$box]->box_contents 		 =  $value["box_contents"]; 
				}

				//Vertical chained image box
				if(stristr($key, '_v_chained_image_box')                                   == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'v_chained_image_box'; 
				$templates->templates[$template]->contents[$box]->media_style 		 =  $value["media_style"];
 				$templates->templates[$template]->contents[$box]->media_alignment    =  $value["media_alignment"]; 
				$templates->templates[$template]->contents[$box]->box_contents 		 =  $value["box_contents"]; 
				$templates->templates[$template]->contents[$box]->bw_filter 		 =  $value["bw_filter"]; 
				}				

				//Horizontal chained image box
				if(stristr($key, '_h_chained_image_box')                                   == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'h_chained_image_box'; 
				$templates->templates[$template]->contents[$box]->media_style 		 =  $value["media_style"]; 
				$templates->templates[$template]->contents[$box]->box_contents 		 =  $value["box_contents"]; 
				$templates->templates[$template]->contents[$box]->bw_filter 		 =  $value["bw_filter"]; 
				}				

				//Layer Slider box
				if(stristr($key, '_layerslider_box')                                  == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'layerslider_box'; 
				$templates->templates[$template]->contents[$box]->slider_id      	 =  $value["slider_id"];  
				}

				//Revolution Slider box
				if(stristr($key, '_revslider_box')                                  == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'revslider_box'; 
				$templates->templates[$template]->contents[$box]->slider_id      	 =  $value["slider_id"];  
				}

				//google map 
				if(stristr($key, '_google_map')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'google_map'; 
				$templates->templates[$template]->contents[$box]->module_title       =  $value["module_title"];
				$templates->templates[$template]->contents[$box]->height             =  $value["height"]; 
				$templates->templates[$template]->contents[$box]->zoom               =  $value["zoom"]; 
				$templates->templates[$template]->contents[$box]->list               =  $value["list"]; 	
				$templates->templates[$template]->contents[$box]->bwcolor            =  $value["bwcolor"]; 			
				}
				
				//contact form
				if(stristr($key, '_contact_form')                                    == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'contact_form'; 
				$templates->templates[$template]->contents[$box]->title              =  $value["title"];
				$templates->templates[$template]->contents[$box]->email              =  $value["email"];
				$templates->templates[$template]->contents[$box]->shortcode          =  $value["shortcode"]; 
				$templates->templates[$template]->contents[$box]->text               =  $value["text"];			
				}
				
				//contact info box
				if(stristr($key, '_icon_list_box')                                == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'icon_list_box'; 
				$templates->templates[$template]->contents[$box]->list               =  $value["list"];
				$templates->templates[$template]->contents[$box]->module_title       =  $value["module_title"]; 
				$templates->templates[$template]->contents[$box]->icon_style         =  $value["icon_style"];  
				$templates->templates[$template]->contents[$box]->item_width         =  $value["item_width"];    
				}


				//heading bar
				if(stristr($key, '_heading_bar')                               		 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'heading_bar';
				$templates->templates[$template]->contents[$box]->heading            =  $value["heading"];
				$templates->templates[$template]->contents[$box]->icon               =  $value["icon"]; 
				$templates->templates[$template]->contents[$box]->style              =  $value["style"]; 
				}				

				//space box
				if(stristr($key, '_space_box')                               		 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'space_box';
				$templates->templates[$template]->contents[$box]->height             =  $value["height"];
				}	

				//blog posts
				if(stristr($key, '_blog_box')                                        == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'blog_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->pagination         =  isset($value["pagination"]) ? $value["pagination"] : "";
				$templates->templates[$template]->contents[$box]->list_orderby       =  $value["list_orderby"];
				$templates->templates[$template]->contents[$box]->list_order         =  $value["list_order"];
				$templates->templates[$template]->contents[$box]->item_per_page      =  $value["item_per_page"];
				$templates->templates[$template]->contents[$box]->list_style         =  $value["list_style"];
				$templates->templates[$template]->contents[$box]->list_layout        =  $value["list_layout"];
				$templates->templates[$template]->contents[$box]->categories         =  isset($value["categories"]) ? $value["categories"] : ""; 
				}

				//bog carousel
				if(stristr($key, '_blog_carousel')                                   == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'blog_carousel';
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				//code box
				if(stristr($key, '_code_box')                                        == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'code_box'; 
				$templates->templates[$template]->contents[$box]->heading            =  $value["heading"];
				$templates->templates[$template]->contents[$box]->code_space         =  $value["code_space"];
				$templates->templates[$template]->contents[$box]->transparent        =  isset($value["transparent"]) ? $value["transparent"] : "";
				$templates->templates[$template]->contents[$box]->no_padding         =  isset($value["no_padding"]) ? $value["no_padding"] : ""; 						
				}


				//grid
				if(stristr($key, '_grid')												 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                         = new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id               = $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type           = 'grid';
				$templates->templates[$template]->contents[$box]->part                   = $value["grid"];   
				$templates->templates[$template]->contents[$box]->header_purpose         = $value["header_purpose"]; 
				$templates->templates[$template]->contents[$box]->footer_purpose         = $value["footer_purpose"];   
				$templates->templates[$template]->contents[$box]->newtemplate            = isset($value["newtemplate"]) ? $value["newtemplate"] : ""; 					
				$templates->templates[$template]->contents[$box]->breadcrumb             = isset($value["breadcrumb"]) ? $value["breadcrumb"] : ""; 	
				$templates->templates[$template]->contents[$box]->breadcrumb_position    = isset($value["breadcrumb_position"]) ? $value["breadcrumb_position"] : ""; 	  
				$templates->templates[$template]->contents[$box]->page_title             = isset($value["page_title"]) ? $value["page_title"] : ""; 	  
				$templates->templates[$template]->contents[$box]->display_widgets        = isset($value["display_widgets"]) ? $value["display_widgets"] : ""; 	  
				$templates->templates[$template]->contents[$box]->header_options         = isset($value["header_options"]) ? $value["header_options"] : ""; 					
				$templates->templates[$template]->contents[$box]->sidebar_selection      = isset($value["sidebar_selection"]) ? $value["sidebar_selection"] : ""; 					
				$templates->templates[$template]->contents[$box]->sidebar_id             = isset($value["sidebar_id"]) ? $value["sidebar_id"] : ""; 					
				$templates->templates[$template]->contents[$box]->first_top_widget_name  = isset($value["first_top_widget_name"]) ? $value["first_top_widget_name"] : ""; 					
				$templates->templates[$template]->contents[$box]->second_top_widget_name = isset($value["second_top_widget_name"]) ? $value["second_top_widget_name"] : ""; 
				$templates->templates[$template]->contents[$box]->background_options     = isset($value["background_options"]) ? $value["background_options"] : ""; 
				$templates->templates[$template]->contents[$box]->color_set              = isset($value["color_set"]) ? $value["color_set"] : ""; 
				$templates->templates[$template]->contents[$box]->column_options         = isset($value["column_options"]) ? $value["column_options"] : ""; 
				$templates->templates[$template]->contents[$box]->row_style_options      = isset($value["row_style_options"]) ? $value["row_style_options"] : ""; 

				}

				//columns
				if(stristr($key, '_column')                                        	 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'column';
				$templates->templates[$template]->contents[$box]->layout             =  isset($value["layout"]) ? $value["layout"] : ""; 
				$templates->templates[$template]->contents[$box]->part               =  isset($value["column"]) ? $value["column"] : "";  
				}


				//New Content Boxex 
				if(stristr($key, '_new_content_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                          = new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id                = $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type            = 'new_content_box'; 			
				$templates->templates[$template]->contents[$box]->title                   = $value["title"];
				$templates->templates[$template]->contents[$box]->title_position          = $value["title_position"];
				$templates->templates[$template]->contents[$box]->text                    = $value["text"];
				$templates->templates[$template]->contents[$box]->featured_image          = $value["featured_image"]; 
				$templates->templates[$template]->contents[$box]->icon                    = $value["icon"]; 
				$templates->templates[$template]->contents[$box]->icon_style              = $value["icon_style"]; 
				$templates->templates[$template]->contents[$box]->text_position           = $value["text_position"];
				$templates->templates[$template]->contents[$box]->link                    = $value["link"];
				$templates->templates[$template]->contents[$box]->link_text               = $value["link_text"];
				$templates->templates[$template]->contents[$box]->link_target             = $value["link_target"]; 									  
				$templates->templates[$template]->contents[$box]->image_style             = $value["image_style"];
				}

				//New Content Boxex 
				if(stristr($key, '_content_icon_box')                                     == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                          = new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id                = $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type            = 'content_icon_box'; 			
				$templates->templates[$template]->contents[$box]->title                   = $value["title"];
				$templates->templates[$template]->contents[$box]->title_position          = $value["title_position"];
				$templates->templates[$template]->contents[$box]->text                    = $value["text"]; 
				$templates->templates[$template]->contents[$box]->icon                    = $value["icon"]; 
				$templates->templates[$template]->contents[$box]->icon_style              = $value["icon_style"]; 
				$templates->templates[$template]->contents[$box]->text_position           = $value["text_position"];
				$templates->templates[$template]->contents[$box]->link                    = $value["link"];
				$templates->templates[$template]->contents[$box]->link_text               = $value["link_text"];
				$templates->templates[$template]->contents[$box]->link_target             = $value["link_target"]; 	
				$templates->templates[$template]->contents[$box]->icon_color              = $value["icon_color"]; 	
				$templates->templates[$template]->contents[$box]->icon_bg_color           = $value["icon_bg_color"]; 									  
				$templates->templates[$template]->contents[$box]->icon_border_color           = $value["icon_border_color"]; 									  
				}


				//New Content Boxex 
				if(stristr($key, '_text_box')                                             == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                          = new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id                = $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type            = 'text_box';
				$templates->templates[$template]->contents[$box]->values                  = $value["values"];
				}

				//horizontal line
				if(stristr($key, '_horizontal_line')                                 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'horizontal_line';
				$templates->templates[$template]->contents[$box]->style              =  $value["style"];   
				$templates->templates[$template]->contents[$box]->margin_top         =  $value["margin_top"];     
				$templates->templates[$template]->contents[$box]->margin_bottom      =  $value["margin_bottom"];     
				}


				//Staff 
				if(stristr($key, '_staff_box')  			                         == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'staff_box';
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				//Testimonails
				if(stristr($key, '_testimonial_box')  			                     == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'testimonial_box';
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				//Testimonail Carousel
				if(stristr($key, '_testimonial_carousel') 			                 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box]                     =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'testimonial_carousel';
				$templates->templates[$template]->contents[$box]->values             =  $value["values"];
				}

				//line up boxes
				if(stristr($key, $templates->templates[$template]->templateID.'_line_up_boxes') == TRUE && $templates->templates[$template]->templateName) {
					$box++;
					$templates->templates[$template]->lineup 						=  $value; 
				} 
			} 

		}

		//prepare the object to save
		$encoded_object = base64_encode(serialize($templates));

		//add a note for this object saved as encoded
		update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_encoded", "true");

		//save the object	 
		update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID, $encoded_object);

		//save the template output as shortocde 
		$get_outputs = $this->generate_template_output($templates->templates[$template]->contents,$templates->templates[$template]->templateID);

		//save template parts
		if( is_array( $get_outputs ) ){

			//save header output
			if( ! empty( $get_outputs["header"] )){
				update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_header_output", $get_outputs["header"]);							
			}

			//save footer output
			if( ! empty( $get_outputs["footer"] )){
				update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_footer_output", $get_outputs["footer"]);							
			}

			//save content output
			if( ! empty( $get_outputs["content"] )){
				update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_content_output", $get_outputs["content"]);							
			}

			//save css output
			if( ! empty( $get_outputs["css"] )){
				update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_css_output", $get_outputs["css"]);
			}

			//save template options
			if( ! empty( $get_outputs["template_options"] )){
				
				//encode template options array
				$encoded_template_options = base64_encode( serialize( $get_outputs["template_options"] ) );
				update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_template_options", $encoded_template_options );
			}

			//stripped content for search
			$clean_text = preg_replace("/(\[|\]|-')/s"," ", sanitize_text_field( $get_outputs["header"] . $get_outputs["content"] . $get_outputs["footer"] ) );  
 			update_option( RT_THEMESLUG."_".$templates->templates[$template]->templateID."_clean_text", $clean_text );  						

		}
 
		//get the saved template names
		$saved_template_names = is_array( get_option(RT_THEMESLUG.'_template_names_array') ) ? get_option(RT_THEMESLUG.'_template_names_array') : array() ;


		//add the new template name to the list 
		if( ! isset( $saved_template_names[ $templates->templates[$template]->templateID ] ) ){

			//new template values
			$newTemplateId = $templates->templates[$template]->templateID;
			$newTemplateName = $templates->templates[$template]->templateName;

			//new template array
			$newTemplateArray  = array(
									$newTemplateId => array(
										"name" => $newTemplateName,
										"is_default_template" => false,
										"default_template_data" => ''
									)
								); 

			//update the list
			update_option(RT_THEMESLUG.'_template_names_array',  array_merge( $saved_template_names, $newTemplateArray ) ); 
		}else{

			$saved_template_names[ $templates->templates[$template]->templateID ]["name"] = $templates->templates[$template]->templateName;
			update_option(RT_THEMESLUG.'_template_names_array',  $saved_template_names ); 
		}
	}


	#
	#	Generate Template Output
	# 
	function generate_template_output($template_contents = "", $templateID = ""){
		global $rt_google_fonts; 

		// output
		$template_output = "";		
		$header_output = "";		
		$footer_output = "";	
		$footer_started = false;
		$css_output = array("color_sets"=>array(),"backgrounds"=>array(),"css_codes"=>"","fonts"=>array());		

		//template options
		$template_options = array();

		//variables
		$start_row = $next_item_width = $count_item_widths = $columns_started = "";
		$layout_width_values = array("four-five"=>48,"three-four"=>45,"two-three"=>40,"five"=>12,"four"=>15,"three"=>20,"two"=>30,"one"=>60);
		$column_class_names	 = array( 2=>"four-five", 3=>"three-four", 4=>"two-three", 8=>"five", 7=>"four", 6=>"three", 5=>"two", 1=>"one" );
		$row_counter = 1;
		$header_purpose = isset( $header_purpose ) && ! empty( $header_purpose ) ? $header_purpose : false;
		$footer_purpose = isset( $footer_purpose ) && ! empty( $footer_purpose ) ? $footer_purpose : false;

		// Create contents
		foreach($template_contents as $item_num => $template){ 

			//extract template vars
			extract( get_object_vars( $template ) ) ;

			//content type
			$content_type = isset( $content_type ) ? $content_type : "";


			//columns holder for other elemets
			if ( ! $header_purpose && empty( $columns_started ) && $content_type != "column" && $content_type != "grid" && $content_type != "slider_box" && $content_type != "space_box" ){
				$template_output .= '[rt_columns]';
			}

			//colorsets and bacgrounds
			if( $content_type == "grid" && $part == "first"){	 				 					

 					// container
					if( $header_purpose ){
						$container = "body .header-".str_replace("templateid_", "", $templateID);
					}elseif ( $footer_purpose ) {
						$container = "body #container .footer-".str_replace("templateid_", "", $templateID);
					}else{
						$container = '#row-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
					}

					// colorset
					$colorset_array = array("container" => $container, "selection" => $color_set["color_set_selection"], "values" => array() );

					if( $color_set["color_set_selection"] == "new"){
						$colorset_array["values"] = array(
							"primary" => $color_set["primary"],// primary color
							"font" => $color_set["font"],// font color
							"light_font" => $color_set["light_font"],// light font color
							"headings" => $color_set["headings"],// heading color 
							"heading_links" => $color_set["heading_links"],// heading :hover color
							"link" => $color_set["link"],// link color
							"link_hover" => $color_set["link_hover"],// link :hover color
							"highlighted" => $color_set["highlighted"],// highlighted content background color 
							"border" => $color_set["border"],// border color 
							"social_media" => $color_set["social_media"],// social media base color  
						);   
					}

					array_push($css_output["color_sets"], $colorset_array );
					

					// background
					$background_array = array("container" => $container, "selection" => $background_options["background_selection"], "values" => array() );

					// parallax background 
					$parallax_background = isset( $background_options["parallax_background"] ) ? $background_options["parallax_background"] : "disabled_parallax";

					//create value set 
					if( $background_options["background_selection"] == "new" && $parallax_background == "disabled_parallax" ){
						$background_array["values"] = array(
							"background_color" => isset( $background_options["background_color"] ) ? $background_options["background_color"] : "",// content background color		
							"background_image_url" => isset( $background_options["background_image_url"] ) ? $background_options["background_image_url"] : "", //background-image 
							"background_attachment" => isset( $background_options["background_attachment"] ) ? $background_options["background_attachment"] : "", //background-attachment
							"background_position" => isset( $background_options["background_position"] ) ? $background_options["background_position"] : "", //background-position
							"background_repeat" => isset( $background_options["background_repeat"] ) ? $background_options["background_repeat"] : "", //background-repeat
							"background_size" => isset( $background_options["background_size"] ) ? $background_options["background_size"] : "", //background-size
						);
 
					} 

					array_push($css_output["backgrounds"], $background_array );
 					
			}
		 
			//header
			if( $content_type == "grid" && $header_purpose ){	


				if ( $part == "first" ){ //first part
					$template_output .= '[header selector_class="header-'.str_replace("templateid_", "", $templateID).'" header_options="'.$header_options.'" breadcrumb="'.$breadcrumb.'" page_title="'.$page_title.'" breadcrumb_position="'.$breadcrumb_position.'"]';
 
				 	//keep common values  
			 		$breadcrumb_position_keep = $breadcrumb_position;
			 		$page_title_keep = $page_title;
			 		$breadcrumb_keep = $breadcrumb;


			 		//add values to $template_options
					$template_options = array( 
						"breadcrumb_position" => $breadcrumb_position, 
						"display_title" => $page_title, 
						"display_breadcrumb" => $breadcrumb, 
						"header_background_options" => $header_options,
						"first_top_widget_name" => $first_top_widget_name,
						"second_top_widget_name" => $second_top_widget_name
					);

				}

				if ( $part == "second" ){ //second part
					$template_output .= "[/header]";

					$header_output = $template_output;
					$template_output  = "";													

				}		
				
			}

			//footer
			elseif( $content_type == "grid" && $footer_purpose ){	


				if ( $part == "first" ){ //first part
					$save_template_output = $template_output;
					$template_output  = "";
					$template_output .= '[footer selector_class="footer-'.str_replace("templateid_", "", $templateID).'"]';  						  					

			 		//add values to $template_options
					$template_options["display_widgets"] = $display_widgets;

					$footer_started = true;
				}

				if ( $part == "second" ){ //second part
					$template_output .= "[/footer]";
					$footer_output = $template_output;

					$template_output  = $save_template_output;													

				}		
				
			}			

			//rows
			elseif( $content_type == "grid" && ! $header_purpose && ! $footer_purpose ){
				if ( $part == "first" ){ //first part

					$row_id = 'row-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';


					//get row style  
					$row_class  = "";
					$row_class .= $background_options["background_selection"] == "ca2" ? "row-style-2" : "";
					$row_class .= $background_options["background_selection"] == "ca3" ? "row-style-3" : "";
					
					//get row width
					$full_width_row = $row_style_options["row_width"] == "full" ? "true": "";

					//row css
					$row_paddings = "";
					$row_paddings .= ! empty( $row_style_options["padding_top"] )  ?  sprintf('#%1$s { padding-top: %2$spx; }', $row_id."", $row_style_options["padding_top"] ) : "";
					$row_paddings .= ! empty( $row_style_options["padding_left"] ) ?  sprintf('#%1$s { padding-left: %2$spx; }', $row_id."", $row_style_options["padding_left"] ) : "";
					$row_paddings .= ! empty( $row_style_options["padding_right"] ) ?  sprintf('#%1$s { padding-right: %2$spx; }', $row_id."", $row_style_options["padding_right"] ): "";
					$row_paddings .= ! empty( $row_style_options["padding_bottom"] ) ? sprintf('#%1$s { padding-bottom: %2$spx; }', $row_id."", $row_style_options["padding_bottom"] ): ""; 
					$row_paddings = ! empty( $row_paddings ) ? sprintf('%s', $row_paddings ) . '' . sprintf('@media only screen and (max-width: 767px) { #%1$s { padding-left: 0px; padding-right: 0px; } }', $row_id ) : "";

					//columns css
					$column_paddings = "";
					$column_paddings .= ! empty( $column_options["padding_top"] ) ?  sprintf('#%1$s >  .row  > .box { padding-top: %2$spx; }', $row_id."-content", $column_options["padding_top"] ) : "";
					$column_paddings .= ! empty( $column_options["padding_left"] ) ?  sprintf('#%1$s >  .row  > .box { padding-left: %2$spx; }', $row_id."-content", $column_options["padding_left"] ) : "";
					$column_paddings .= ! empty( $column_options["padding_right"] ) ?  sprintf('#%1$s >  .row  > .box { padding-right: %2$spx; }', $row_id."-content", $column_options["padding_right"] ): "";
					$column_paddings .= ! empty( $column_options["padding_bottom"] ) ? sprintf('#%1$s >  .row  > .box { padding-bottom: %2$spx; }', $row_id."-content", $column_options["padding_bottom"] ): "";
					$column_paddings .= ! empty( $column_paddings ) ? sprintf('@media only screen and (max-width: 767px) {  #%1$s >  .row  > .box { padding-left: 5px;padding-right: 5px; }}', $row_id."-content") : "";
					
					$paddings = ! empty( $column_paddings ) ? "true" : "";

					$css_output["css_codes"] .= $row_paddings;
					$css_output["css_codes"] .= $column_paddings;
					$css_output["css_codes"] .= $column_options["background_selection"] == "new"  ? sprintf('#%1$s >  .row  > .box { background-color: %2$s; background-color: %3$s; }', $row_id."-content", rt_rgba2hex( $column_options["background_color"] ), $column_options["background_color"] ): "";
					$css_output["css_codes"] .= $column_options["background_selection"] == "half_transparent"  ? sprintf('#%1$s >  .row  > .box { background-image: url(%2$s/images/transparent-white.png); }', $row_id."-content", RT_THEMEURI ): "";

					$sidebar_id = is_array( $sidebar_id ) ? implode(",", $sidebar_id ) : "";
					
					$css_class = isset($row_style_options["custom_class"]) && ! empty($row_style_options["custom_class"]) ? $row_style_options["custom_class"] : "";

					$background_image_url = isset( $background_options["background_image_url"] ) ? $background_options["background_image_url"] : "";
					$parallax_background = $background_options["background_selection"] == "new" && isset( $background_options["parallax_background"] ) ? $background_options["parallax_background"] : "disabled_parallax";

					$template_output .= '[row full_width_row="'.$full_width_row.'" row_counter='.$row_counter.' page_title="'.$page_title_keep.'" breadcrumb="'.$breadcrumb_keep.'" breadcrumb_position="'.$breadcrumb_position_keep.'" id="'.$row_id.'" sidebar_selection = "'.$sidebar_selection .'" sidebar_id = "'. $sidebar_id .'" paddings = "'. $paddings .'" class="'. $row_class .'" css_class="'. $css_class .'" parallax_background="'. $parallax_background.'" background_image_url = "'.$background_image_url.'"]';

					$sidebar_id = $sidebar_selection = $column_paddings = "";

				 	//the row counter
				 	$row_counter++;
				}

				if ( $part == "second" ){ //second part
					$template_output .= "[/row]";
				}		
			}

			//columns
			elseif( $content_type == "column" ){ 
		 
		 		$count_column_widths = isset( $count_column_widths ) ? $count_column_widths : 0;


				if ( $part == "first" ){ //first part

					//create column holder
					$template_output .= ($count_column_widths == 0 || $count_column_widths == "") ? '[rt_columns]' : "";
						
					//start counter for column holder
			 		$this_column_width =  $layout_width_values[$column_class_names[$layout]];  // finds width of this item as in $layout_width_values		
			 		$count_column_widths = $count_column_widths + $this_column_width;

			 		//start column
					$template_output .= '[rt_column layout="'.$column_class_names[$layout].'"]';

					$columns_started = true;
				}

				if ( $part == "second" ){ //second part

					//end column
					$template_output .= "[/rt_column]";


					//find the next columns width 
					if( isset($template_contents[$item_num+1]->content_type) && $template_contents[$item_num+1]->content_type == "column" ){			
						$next_column_width = $layout_width_values[$column_class_names[$template_contents[$item_num+1]->layout]] ; 
					}else{
						$next_column_width = 60; // there is no next column so this must be hightest value
					}	

					//close the column holder
					if ( $count_column_widths + $next_column_width  > 60 ){
						$template_output .= '[/rt_columns]';
						$count_column_widths = 0; // reset the column counter
						$columns_started = "";
					}	

				}		
		  
			}

			//content boxes - with featured image
			elseif( $content_type == "new_content_box" ){

				$content_box_id = 'content-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

				$template_output .= '[content_box id="'.$content_box_id.'" title="'.htmlspecialchars( $title ).'" title_position="'.$title_position.'" featured_image="'.$featured_image.'" image_style="'.$image_style.'" icon="'.$icon.'" icon_style="'.$icon_style.'" text_position="'.$text_position.'" link="'.htmlspecialchars($link).'" link_text="'.htmlspecialchars($link_text).'" link_target="'.htmlspecialchars($link_target).'"]';

 				//fix editor shortcodes
 				$text = $this->fix_editor_columns($text);
				$text = $this->fix_editor_contents($text);
								
				$template_output .= $text;
				$template_output .= '[/content_box]'; 

			}

			//content boxes - with icon
			elseif( $content_type == "content_icon_box" ){

				$content_box_id = 'content-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
			 
				$template_output .= '[content_icon_box id="'.$content_box_id.'" title="'.htmlspecialchars( $title ).'" title_position="'.$title_position.'" icon="'.$icon.'" icon_style="'.$icon_style.'" text_position="'.$text_position.'" icon_color="'.$icon_color.'" icon_bg_color="'.$icon_bg_color.'" icon_border_color="'.$icon_border_color.'" link="'.htmlspecialchars($link).'" link_text="'.htmlspecialchars($link_text).'" link_target="'.htmlspecialchars($link_target).'"]';

				//css output for this icons
			 	$css_output["css_codes"] .= ! empty( $icon_color ) ? sprintf('.row #%1$s .heading_icon{color:%2$s !important;}', $content_box_id, $icon_color ) : "";
			 	$css_output["css_codes"] .= ! empty( $icon_bg_color ) ? sprintf('.row #%1$s .heading_icon{background-color:%2$s;}', $content_box_id, $icon_bg_color ) : "";
			 	$css_output["css_codes"] .= ! empty( $icon_border_color ) ? sprintf('.row #%1$s .heading_icon{border-color:%2$s;}#%1$s .pin:after{color:%2$s;border-color:%2$s;}', $content_box_id, $icon_border_color ) : "";

 				//fix editor shortcodes
 				$text = $this->fix_editor_columns($text);
				$text = $this->fix_editor_contents($text);

				$template_output .= $text;
				$template_output .= '[/content_icon_box]'; 

			}

			//text boxes
			elseif( $content_type == "text_box" ){
			 	
			 	$text = $font_size = $font_color = $heading_color = $font_family_text = $font_family_heading = $font_family_heading_css = $font_family_text_css = "";
			 	extract( $values );

				$text_box_id = 'text-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.''; 
				

				//font family heading
				if( ! empty( $font_family_text ) ){
					$font_family_text = stripslashes( $font_family_text );
					if( isset($rt_google_fonts[$font_family_text] ) ){ //check if it is a google font
						$font_family_text_css = "'".$rt_google_fonts[$font_family_text][0]."',sans-serif" ; 
						$font_weight_text_css = isset( $rt_google_fonts[$font_family_text][2] ) ? $rt_google_fonts[$font_family_text][2]: "normal";
					}else{
						$font_family_text_css = $font_family_text;
						$font_weight_text_css ="normal";
					}
				} 

				//font family heading
				if( ! empty( $font_family_heading ) ){
					$font_family_heading = stripslashes( $font_family_heading );

					if( isset($rt_google_fonts[$font_family_heading] ) ){ //check if it is a google font
						$font_family_heading_css = "'".$rt_google_fonts[$font_family_heading][0]."',sans-serif" ; 
						$font_weight_heading_css = isset( $rt_google_fonts[$font_family_heading][2] ) ? $rt_google_fonts[$font_family_heading][2]: "normal";
					}else{
						$font_family_heading_css = $font_family_heading;
						$font_weight_heading_css ="normal";
					}
				}

				$heading_selector = sprintf('#%1$s h1,#%1$s h2,#%1$s h3,#%1$s h4,#%1$s h5,#%1$s h6',$text_box_id);

			 	$css_output["css_codes"] .= ! empty( $font_color ) ? sprintf('#%1$s p{color:%2$s}', $text_box_id, $font_color ) : "";
			 	$css_output["css_codes"] .= ! empty( $font_size ) ? sprintf('#%1$s p{font-size:%2$spx;line-height:150%%;}', $text_box_id, $font_size ) : "";
				$css_output["css_codes"] .= ! empty( $heading_color ) ? sprintf('%1$s{color:%2$s;}', $heading_selector, $heading_color ) : ""; 				
				$css_output["css_codes"] .= ! empty( $font_family_text_css ) ? '#'. $text_box_id .' p{font-family:'. $font_family_text_css .'; font-weight:'.$font_weight_text_css.' !important;}' : ""; 				
				$css_output["css_codes"] .= ! empty( $font_family_heading_css ) ? $heading_selector .'{font-family:'. $font_family_heading_css .'; font-weight:'.$font_weight_heading_css.' !important;}' : "";


				/*
				add the selected fonts to the fonts array of this template to 
				be loaded with wp_enqueue in custom_styling.php
				*/
				if( ! empty( $font_family_text ) ){					
					array_push($css_output["fonts"], $font_family_text );
				}

				if( ! empty( $font_family_heading ) ){
					array_push($css_output["fonts"], $font_family_heading );
				}
 				
 				//fix editor shortcodes
 				$text = $this->fix_editor_columns($text);
				$text = $this->fix_editor_contents($text);

				$template_output .= '[text_box id="'.$text_box_id.'"]';  
				$template_output .= $text; 
				$template_output .= '[/text_box]'; 

			}

			//slider
			elseif( $content_type == "slider_box" ){			 

			 	/*
			 	//[slider slider_width="650" slider_height="300" slider_script=""]
			 		[slide link="link" title="title" img_url="" video_url="" styling="" title_color="" title_bg_color="" text_color="" text_bg_color="" title_size="" text_size=""]slide_text[/slide] 
				[/slider]
			 	*/

			 	
			 	$slides_output = "";

			 	foreach ($slides["slide_hidden_value"] as $key => $options) {
			 		if( ! empty( $slides["slide_hidden_value"][$key] ) ){
				 		$slide_title = $slide_text = $slide_image_url = $slide_link = $text_size = $title_size = $text_bg_color = $title_bg_color = $title_color = $styling = "";

						$slide_title = ! empty( $slides["slide_title"][$key] ) ? $slides["slide_title"][$key] : "";
						$slide_text  = ! empty( $slides["slide_text"][$key] ) ? $slides["slide_text"][$key] : "";		
						$slide_image_url = ! empty( $slides["slide_image_url"][$key] ) ? $slides["slide_image_url"][$key] : "";	
						$slide_link  = ! empty( $slides["slide_link"][$key] ) ? $slides["slide_link"][$key] : "";	 				 	
						$text_align = ! empty( $slides["text_align"][$key] ) ? $slides["text_align"][$key] : "";					 	
						$stretch_images = ! empty( $slides["stretch_images"][$key] ) ? $slides["stretch_images"][$key] : "";	 
						$styling     = ! empty( $slides["styling"][$key] ) ? $slides["styling"][$key] : "";
						$title_color     = ! empty( $slides["title_color"][$key] ) ? $slides["title_color"][$key] : "";
						$title_bg_color     = ! empty( $slides["title_bg_color"][$key] ) ? $slides["title_bg_color"][$key] : "";
						$text_color     = ! empty( $slides["text_color"][$key] ) ? $slides["text_color"][$key] : "";
						$text_bg_color     = ! empty( $slides["text_bg_color"][$key] ) ? $slides["text_bg_color"][$key] : "";
						$title_size     = ! empty( $slides["title_size"][$key] ) ? $slides["title_size"][$key] : "";
						$text_size     = ! empty( $slides["text_size"][$key] ) ? $slides["text_size"][$key] : ""; 

						if( $slide_title || $slide_text || $slide_image_url ){
							$slides_output .= sprintf('[slide link="%s" title="%s" img_url="%s" text_align="%s" stretch_images="%s" styling="%s" title_color="%s" title_bg_color="%s" text_color="%s" text_bg_color="%s" title_size="%s" text_size="%s"]%s[/slide]',$slide_link, $slide_title, $slide_image_url, $text_align, $stretch_images, $styling, $title_color, $title_bg_color, $text_color, $text_bg_color, $title_size, $text_size, $slide_text);			 			
						}					 		
			 		}

			 	}		

				$template_output .= sprintf('[slider slider_width="%s" slider_height="%s" slider_script="%s" image_resize="%s" image_crop="%s" slider_timeout="%s" flex_slider_effect="%s"]%s[/slider]', $slider_width, $slider_height, "flex_slider", $image_resize, $image_crop, $slider_timeout, $flex_slider_effect, $slides_output );

			}

			//tabs
			elseif( $content_type == "tabs_box" ){
			 
			 	/*
			 	//[tabs tab1="" tab1-icon="" tab2="" tab2-icon="" tab3="" tab3-icon=""][/tabs]
			 		[tab][/tab]
			 	[/tabs]
			 	*/
		 
			 	$tab_captions_output = '[tabs tabs_style="'.$tabs_style.'" ' ;
			 	$tab_contents_output = "";

			 	$tab_count = 1;

			 	foreach ($tab_contents["caption"] as $key => $options) {


			 		$tab_caption = $tab_text = $tab_icon = "";
					$tab_caption = ! empty( $tab_contents["caption"][$key] ) ? $tab_contents["caption"][$key] : "";
					$tab_text    = ! empty( $tab_contents["text"][$key] ) ? $tab_contents["text"][$key] : "";		
					$tab_icon    = ! empty( $tab_contents["icon"][$key] ) ? $tab_contents["icon"][$key] : "";	
				 	
				 	$tab_captions_output .= ! empty( $tab_caption ) ? 'tab'.$tab_count.'="'.htmlspecialchars($tab_caption).'" ' : "";
				 	$tab_captions_output .= ! empty( $tab_icon ) ? 'tab'.$tab_count.'_icon="'.$tab_icon.'" ' : "";
				 	$tab_contents_output .= ! empty( $tab_caption ) ? '[tab]'.$tab_text.'[/tab]' : "";

				 	$tab_count++;
			 	}
			
				$tab_captions_output .= "]";	 	

				$template_output .= $tab_captions_output ." " . stripslashes( $tab_contents_output );

				$template_output .= '[/tabs]'; 

			}

			//accordions
			elseif( $content_type == "accordion_box" ){
			 
			 	/*
			 	//[accordion align="" style=""]
			 		[pane title="" icon=""][/pane]
			 	[/accordion]
			 	*/

			 	$first_one_open = isset( $first_one_open ) && !empty( $first_one_open ) ? "true" : "";	

			 	$accordion_contents_output = '';

			 	foreach ($accordion_contents["caption"] as $key => $options) {

			 		$accordion_caption = $accordion_text = $accordion_icon = "";
					$accordion_caption = ! empty( $accordion_contents["caption"][$key] ) ? $accordion_contents["caption"][$key] : "";
					$accordion_text    = ! empty( $accordion_contents["text"][$key] ) ? $accordion_contents["text"][$key] : "";		
					$accordion_icon    = ! empty( $accordion_contents["icon"][$key] ) ? $accordion_contents["icon"][$key] : "";	  
				 	 
					$accordion_contents_output .= ! empty( $accordion_caption ) ? '[pane title="'.htmlspecialchars($accordion_caption).'" ' : "";
				 	$accordion_contents_output .= ! empty( $accordion_caption ) && ! empty( $accordion_icon ) ? 'icon="'.$accordion_icon.'" ' : "";
				 	$accordion_contents_output .= ! empty( $accordion_caption ) ? ']'.$accordion_text.'[/pane]' : "";

			 	}

				$template_output .= ! empty( $accordion_contents_output ) ? sprintf('[accordion style="%s" first_one_open="%s"]%s[/accordion]',$accordion_style, $first_one_open, stripslashes( $accordion_contents_output ) ) : ""; 

				$first_one_open = "";
			}	


			//icon lists
			elseif( $content_type == "icon_list_box" ){
			 
			 	/*
			 	//[icon_list title=""]
			 		[icon_list_line icon=""]content[/icon_list_line]
			 	[/icon_list]
			 	*/

			 	$icon_list_output = '';

			 	foreach ($list["text"] as $key => $options) {

					$list_text  = ! empty( $list["text"][$key] ) ? $list["text"][$key] : "";	
					$list_icon  = ! empty( $list["icon"][$key] ) ? $list["icon"][$key] : "";

		 		 	if( !empty( $list_text ) ){
						$icon_list_output .= '[icon_list_line icon="'.$list_icon.'"]'.$list_text.'[/icon_list_line]';
		 		 	} 

			 	}

				$template_output .= ! empty( $icon_list_output ) ? sprintf('[icon_list title="%s" icon_style="%s" item_width="%s"]%s[/icon_list]',$module_title,$icon_style,$item_width,$icon_list_output ) : ""; 

			}	

			//blog box
			elseif( $content_type == "blog_box" ){
			 
			 	/*
			 	//[blog_box pagination="" list_orderby="" list_order="" item_per_page="" list_style="" list_layout="" categories="" ]
			 	*/

			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : "";

 				$template_output .=  sprintf('[blog_box pagination="%s" list_orderby="%s" list_order="%s" item_per_page="%s" list_style="%s" list_layout="%s" categories="%s"]',$pagination, $list_orderby, $list_order, $item_per_page, $list_style, $list_layout, $categories ) ; 

			}	

			//blog carousel
			elseif( $content_type == "blog_carousel" ){
			 
			 	/*
			 	//[blog_carousel id="" crop="" style="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" max_item="" categories="" ids="" display_excerpts=""]
			 	*/

			 	$crop = $style = $heading = $heading_icon = $item_width = $list_orderby = $list_order = $max_item = $categories = $display_excerpts =  $limit_chars = "";
			 	extract( $values );

			 	$blog_carousel_id = 'blog-carousel-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : "";

 				$template_output .=  sprintf('[blog_carousel id="%s" crop="%s" style="%s" heading="%s" heading_icon="%s" item_width="%s" list_orderby="%s" list_order="%s" max_item="%s" categories="%s" ids="%s" display_excerpts="%s" limit_chars="%s"]',
 					$blog_carousel_id, $crop, $style, $heading, $heading_icon, $item_width, $list_orderby, $list_order, $max_item, $categories, "", $display_excerpts,  $limit_chars ) ; 

			}	

			//portfolio box
			elseif( $content_type == "portfolio_box" ){
			 
			 	/*
			 	//[portfolio_box id="" item_width="5" pagination="" portf_list_orderby="" portf_list_order="" item_per_page="9" filterable="" categories=""  display_descriptions="" display_titles="" display_embedded_titles="" ]
			 	*/

			 	$categories = $display_descriptions = $display_titles = $pagination = $display_embedded_titles = $filterable = "";
			 	extract( $values );

			 	$portfolio_id = 'portfolio-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : "";

 				$template_output .=  sprintf('[portfolio_box id="%s" item_width="%s" pagination="%s" portf_list_orderby="%s" portf_list_order="%s" item_per_page="%s" filterable="%s" categories="%s" display_descriptions="%s" display_titles="%s" display_embedded_titles="%s"]',
 					$portfolio_id, $item_width, $pagination, $portf_list_orderby, $portf_list_order, $item_per_page, $filterable, $categories, $display_descriptions, $display_titles, $display_embedded_titles) ; 

			}	

			//product carousel
			elseif( $content_type == "portfolio_carousel" ){
			 
			 	/*
			 	//[portfolio_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" max_item="9" categories="" portfolio_ids=""  display_descriptions="" display_titles=""]
			 	*/

			 	extract( $values );
			 	$crop = isset( $crop ) ? $crop : "";
			 	$display_descriptions = isset( $display_descriptions ) ? $display_descriptions : "";
			 	$display_titles = isset( $display_titles ) ? $display_titles : "";

			 	$portfolio_carousel_id = 'portfolio-carousel-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : "";

 				$template_output .=  sprintf('[portfolio_carousel id="%s" crop="%s" style="%s" heading="%s" heading_icon="%s" item_width="%s" list_orderby="%s" list_order="%s" max_item="%s" categories="%s" portfolio_ids="%s" display_descriptions="%s" display_titles="%s"]',
 					$portfolio_carousel_id, $crop, $style, $heading, $heading_icon, $item_width, $list_orderby, $list_order, $max_item, $categories, "", $display_descriptions, $display_titles ) ; 

			}	

			//product box
			elseif( $content_type == "product_box" ){
			 
			 	/*
			 	//[product_box id="" item_width="5" pagination="" list_orderby="" list_order="" item_per_page="9" categories="" display_descriptions="" display_titles="" display_price="" ]
			 	*/

			 	$heading = $crop = $categories = $display_descriptions = $display_titles = $display_price = $pagination = $with_borders = $with_effect = $no_top_border = $no_bottom_border = "";
			 	extract( $values );

			 	$product_id = 'products-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : ""; 

 				$template_output .=  sprintf('[product_box id="%s" item_width="%s" pagination="%s" list_orderby="%s" list_order="%s" item_per_page="%s" categories="%s"  display_descriptions="%s" display_titles="%s" display_price="%s" heading="%s" with_borders="%s" with_effect="%s" no_top_border="%s" no_bottom_border="%s"]',
 					$product_id, $item_width, $pagination, $list_orderby, $list_order, $item_per_page, $categories, $display_descriptions, $display_titles, $display_price, esc_attr($heading), $with_borders, $with_effect, $no_top_border, $no_bottom_border ); 

			}

			//product categories
			elseif( $content_type == "product_categories" ){

			 	$parent = $ids =  $orderby =  $order =  $item_width =  $crop =  $image_max_height = $display_titles = $display_descriptions = $display_thumbnails = "";

			 	extract( $values );

			 	$product_id = 'product-categories-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
			 	$ids = isset( $ids ) && is_array( $ids ) ? implode($ids, ",") : ""; 

 				$template_output .=  sprintf('[rt_product_categories id="%s" ids="%s" item_width="%s" display_titles="%s" display_descriptions="%s" display_thumbnails="%s" image_max_height="%s" crop="%s" orderby="%s" order="%s" parent="%s"]',
 					$product_id, $ids, $item_width, $display_titles, $display_descriptions, $display_thumbnails, $image_max_height, $crop, $orderby, $order, $parent); 

			}

			//woocommerce extended products
			elseif( $content_type == "woo_products_extended" ){
			 
			 	/*
			 	//[woo_products id="%s" item_width="%s" pagination="%s" list_orderby="%s" list_order="%s" item_per_page="%s" categories="%s" heading="%s" with_borders="%s" with_effect="%s" no_top_border="%s" no_bottom_border="%s"]
			 	*/

				$heading = $crop = $categories = $pagination = $with_borders = $with_effect = $no_top_border = $no_bottom_border = "";
				extract( $values );

				$product_id = 'woo-products-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
				$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : ""; 

 				$template_output .=  sprintf('[woo_products id="%s" item_width="%s" pagination="%s" list_orderby="%s" list_order="%s" item_per_page="%s" categories="%s" heading="%s" with_borders="%s" with_effect="%s" no_top_border="%s" no_bottom_border="%s"]',
 					$product_id, $item_width, $pagination, $list_orderby, $list_order, $item_per_page, $categories, esc_attr($heading), $with_borders, $with_effect, $no_top_border, $no_bottom_border ); 

			}

			//product carousel
			elseif( $content_type == "product_carousel" ){
			 
			 	/*
			 	//[product_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" max_item="9" categories="" product_ids=""]
			 	*/

			 	extract( $values );
			 	$crop = isset( $crop ) ? $crop : "";

			 	$product_carousel_id = 'product-carousel-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : "";

 				$template_output .=  sprintf('[product_carousel id="%s" crop="%s" style="%s" heading="%s" heading_icon="%s" item_width="%s" list_orderby="%s" list_order="%s" max_item="%s" categories="%s" product_ids="%s"]',
 					$product_carousel_id, $crop, $style, $heading, $heading_icon, $item_width, $list_orderby, $list_order, $max_item, $categories, "" ) ; 
			}	

			//product carousel
			elseif( $content_type == "wcproduct_carousel" ){
			 
			 	/*
			 	//[wcproduct_carousel id="" heading="" heading_icon="" style="%s" item_width="5" list_orderby="" list_order="" max_item="9" categories="" product_ids=""]
			 	*/

			 	extract( $values );
			 	$crop = isset( $crop ) ? $crop : "";

			 	$product_carousel_id = 'wc-product-carousel-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$categories = isset( $categories ) && is_array( $categories ) ? implode($categories, ",") : "";

 				$template_output .=  sprintf('[wcproduct_carousel id="%s" style="%s" heading="%s" heading_icon="%s" item_width="%s" list_orderby="%s" list_order="%s" max_item="%s" categories="%s" product_ids="%s"]',
 					$product_carousel_id, $style, $heading, $heading_icon, $item_width, $list_orderby, $list_order, $max_item, $categories, "" ) ; 
			}				

			//google maps
			elseif( $content_type == "google_map" ){
			 
			 	/*
			 	//[google_maps map_id="" title="" height=""]
			 		[location title="" lat="" lon=""]text[/location] 
			 	[/google_maps]  
			 	*/
		 	
		 		$map_id = 'map-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
 
				//css for the map					 				
		 		$css_output["css_codes"] = $css_output["css_codes"]. sprintf("#%s{height:%spx}", $map_id, $height );

		 		$coords_output = "";
			 	foreach ($list["geo"] as $key => $options) {

			 		if( !empty( $list["geo"][$key] )){
						$geo            =  explode(",",$list["geo"][$key]);
						$location_text  = ! empty( $list["text"][$key] ) ? $list["text"][$key] : "";		
						$location_title = ! empty( $list["title"][$key] ) ? $list["title"][$key] : "";					 	
					 	 
					 	$coords_output .=  sprintf('[location title="%s" lat="%s" lon="%s"]%s[/location]',strip_tags($location_title), $geo[0], $geo[1], stripslashes($location_text) ) ; 
				 	}
			 	}

				$template_output .=  ! empty( $coords_output ) ? sprintf('[google_maps map_id="%s" height="%s" zoom="%s" bwcolor="%s" title="%s" template_builder="true"]%s[/google_maps]', $map_id, $height, $zoom, $bwcolor, strip_tags($module_title), $coords_output ) : ""; 
			}


			//contact form box
			elseif( $content_type == "contact_form" ){
			 
			 	/*
			 	//[contact_form title="" email="" text=""] 
			 	*/

				if ( empty( $shortcode ) ){
					$template_output .=  sprintf('[contact_form title="%s" email="%s"]%s[/contact_form] ',$title, $email, stripslashes($text)) ; 
				}else{
					$template_output .=  stripslashes($shortcode); 
				}	 				

			}				


			//banner box
			elseif( $content_type == "banner_box" ){
			 
			 	/*
			 	//[banner_box id="" text_icon="" text_alignment="" button_text="" button_icon="" button_link="" button_size="" link_target=""]text[/banner_box]
			 	*/

			 	$banner_id = 'banner-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
			 	$gradient = isset( $gradient ) ? $gradient : "";
			 	$border = isset( $border ) ? $border : "";

			 	extract( $values );

				if ( ! empty( $text ) ){ 
					$template_output .=  sprintf('[banner id="%s" gradient="%s" border="%s" text_icon="%s" text_alignment="%s" button_text="%s" button_icon="%s" button_link="%s" button_size="%s" link_target="%s"]%s[/banner]',
						$banner_id, $gradient, $border, $text_icon, $text_alignment, strip_tags( $button_text ), $button_icon, $button_link, $button_size, $link_target, stripslashes($text)) ; 
				}

				$border = $gradient = "";

			}				


			//code box
			elseif( $content_type == "code_box" ){
			 
				/*
				//[code_box box_id="" heading=""]code_space[/code_box]
				*/

				$box_id = 'code-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

				$template_output .=  sprintf('[code_box box_id="%s" heading="%s"]%s[/code_box]',
				$box_id, strip_tags($heading), stripslashes($code_space)) ; 

			}	

			//sidebar box
			elseif( $content_type == "sidebar_box" ){

				/*
				//[sidebar_box sidebar_id="sidebar-for-footer-column-4" widget_box_width="4"]
				*/ 

				if( $footer_started ){
					$location = "footer";
				}else{
					$location = "default";
				}

				$template_output .=  sprintf('[sidebar_box sidebar_id="%s" widget_box_width="%s" location="%s"]',
				$sidebar_id, $widget_box_width, $location ) ; 

			}		 

			//staff box
			elseif( $content_type == "staff_box" ){
			 
				/*
				//[staff_box id="" item_width="5" list_orderby="" list_order="" ids=""]
				*/

				$ids = $staff_box_id = $item_width = $list_orderby = $list_order = $style = $staff_ids = "";

				extract( $values );

				$staff_box_id = 'staff-list-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

				$staff_ids = isset( $ids ) && is_array( $ids ) ? implode($ids, ",") : "";

				$template_output .=  sprintf('[staff_box id="%s" item_width="%s" list_orderby="%s" list_order="%s" style="%s" ids="%s"]',
					$staff_box_id, $item_width, $list_orderby, $list_order, $style, $staff_ids) ; 

			}	


			//testimonial box
			elseif( $content_type == "testimonial_box" ){
			 
			 	/*
			 	//[testimonial_box id="" item_width="5" list_orderby="" list_order="" ids=""]
			 	*/

			 	$ids = $testimonial_box_id = $item_width = $list_orderby = $list_order = $style = $testimonial_ids = $pagination = $item_per_page = "";
			 	extract( $values );

			 	$testimonial_box_id = 'testimonials-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$testimonial_ids = isset( $ids ) && is_array( $ids ) ? implode($ids, ",") : "";

 				$template_output .=  sprintf('[testimonial_box id="%s" item_width="%s" list_orderby="%s" list_order="%s" style="%s" ids="%s" pagination="%s" item_per_page="%s"]',
 					$testimonial_box_id, $item_width, $list_orderby, $list_order, $style, $testimonial_ids, $pagination, $item_per_page) ; 

			}	

			//testimonial carousel
			elseif( $content_type == "testimonial_carousel" ){
			 
			 	/*
			 	//[testimonial_carousel id="" heading="" heading_icon="" item_width="5" list_orderby="" list_order="" ids=""]
			 	*/

			 	$ids = $testimonial_box_id = $heading = $heading_icon = $item_width = $list_orderby = $list_order = $testimonial_ids = $style = "";
			 	extract( $values );

			 	$testimonial_box_id = 'testimonial-carousel-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';

			 	$testimonial_ids = isset( $ids ) && is_array( $ids ) ? implode($ids, ",") : "";

 				$template_output .=  sprintf('[testimonial_carousel id="%s" heading="%s" heading_icon="%s" item_width="%s" list_orderby="%s" list_order="%s" ids="%s" style="%s"]',
 					$testimonial_box_id, $heading, $heading_icon, $item_width, $list_orderby, $list_order, $testimonial_ids, $style) ; 

			}	

			//WooCommerce Products
			elseif( $content_type == "woo_products_box" ){
			 
			 	/*
			 	//[product_category category="" per_page="12" columns="4" orderby="date" order="desc"]
			 	*/ 

 				$template_output .=  sprintf('[product_category category="%s" per_page="%s" columns="%s" orderby="%s" order="%s"]',
 					$categories, $item_per_page, $item_width, $list_orderby, $list_order) ; 

			}	
 
			//Layerslider
			elseif( $content_type == "layerslider_box" ){
			 
			 	/*
			 	//[layerslider id="1"]
			 	*/ 

 				$template_output .=  sprintf('[layerslider id="%s"]', $slider_id) ; 

			}	


			//Revolution slider
			elseif( $content_type == "revslider_box" ){
			 
			 	/*
			 	//[rev_slider aliasname]
			 	*/ 
 				$template_output .=  sprintf('[rev_slider %s]', $slider_id) ; 

			}	


			//space box
			elseif( $content_type == "space_box" ){
			 
			 	/*
			 	//[space_box id=""]
			 	*/
		 	
		 		$space_id = 'space-'.str_replace("templateid_", "", $templateID).'-'.$group_id.'';
 
				//css for the map					 				
		 		$css_output["css_codes"] = $css_output["css_codes"]. sprintf("#%s{height:%spx}", $space_id, $height );
 

				$template_output .=  ! empty( $height ) ? sprintf('[space_box id="%s" height="%s"]', $space_id, $height ) : ""; 
			}

			//vertical chained icon box
			elseif( $content_type == "v_chained_icon_box" ){
			 
			 	/*
			 	//[v_icon_boxes id="" icon_align=""]
					[v_icon_box icon="" title="" link="" link_target=""][/v_icon_box]
			 	[/v_icon_boxes]
			 	*/

			 	$v_icon_box_id = 'v-icon-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.''; 

			 	$v_icon_box_output = "";

			 	foreach ($box_contents["icon"] as $key => $options) {

					$v_icon_box_title = ! empty( $box_contents["caption"][$key] ) ? htmlspecialchars( $box_contents["caption"][$key] ) : "";
					$v_icon_box_text    = ! empty( $box_contents["text"][$key] ) ? $box_contents["text"][$key] : "";		
					$v_icon_box_icon    = ! empty( $box_contents["icon"][$key] ) ? htmlspecialchars( $box_contents["icon"][$key] ) : "";	
					$v_icon_box_link    = ! empty( $box_contents["link"][$key] ) ? htmlspecialchars( $box_contents["link"][$key] ) : "";	
					$v_icon_box_link_target    = ! empty( $box_contents["link_target"][$key] ) ? $box_contents["link_target"][$key] : "";					 	
				 	$v_icon_box_output .= ! empty( $v_icon_box_icon ) ? '[v_icon_box icon="'. $v_icon_box_icon .'" title="'. $v_icon_box_title .'" link="'. $v_icon_box_link .'" link_target="'. $v_icon_box_link_target .'"]'.$this->fix_editor_contents($v_icon_box_text).'[/v_icon_box]' : "";
			 	}
			
			 	$v_icon_box_output = '[v_icon_boxes id="'. $v_icon_box_id .'" icon_align="'.$media_alignment.'"]'. stripslashes( $v_icon_box_output ) .'[/v_icon_boxes]'; 

				//add to the template output
				$template_output .= $v_icon_box_output;

			}

			//vertical chained image box
			elseif( $content_type == "v_chained_image_box" ){
			 
			 	/*
			 	//[v_media_boxes id="" media_align="" media_stlye=""]
					[v_media_box image="" title="" link="" link_target=""][/v_media_box]
			 	[/v_media_boxes]
			 	*/

			 	$v_image_box_id = 'v-image-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.''; 

			 	$v_image_box_output = "";

			 	foreach ($box_contents["image"] as $key => $options) {

					$v_image_box_title = ! empty( $box_contents["caption"][$key] ) ? htmlspecialchars( $box_contents["caption"][$key] ) : "";
					$v_image_box_text    = ! empty( $box_contents["text"][$key] ) ? $box_contents["text"][$key] : "";		
					$v_image_box_image    = ! empty( $box_contents["image"][$key] ) ? htmlspecialchars( $box_contents["image"][$key] ) : "";	
					$v_image_box_link    = ! empty( $box_contents["link"][$key] ) ? htmlspecialchars( $box_contents["link"][$key] ) : "";	
					$v_image_box_link_target    = ! empty( $box_contents["link_target"][$key] ) ? $box_contents["link_target"][$key] : "";					 	
				 	$v_image_box_output .= ! empty( $v_image_box_image ) ? '[v_media_box image="'. $v_image_box_image .'" title="'. $v_image_box_title .'" link="'. $v_image_box_link .'" link_target="'. $v_image_box_link_target .'"]'.$this->fix_editor_contents($v_image_box_text).'[/v_media_box]' : "";
			 	}
			
			 	$v_image_box_output = '[v_media_boxes id="'. $v_image_box_id .'" image_align="'.$media_alignment.'" image_style="'.$media_style.'" bw_filter="'.$bw_filter.'" ]'. stripslashes( $v_image_box_output ) .'[/v_media_boxes]'; 


				//add to the template output
				$template_output .= $v_image_box_output;

			}			

			//horizontal chained image box
			elseif( $content_type == "h_chained_image_box" ){
			 
			 	/*
			 	//[h_chained_contents id="" image_style="" bw_filter=""]
					[h_content image="" title="" link="" link_target=""][/h_content]
			 	[/h_chained_contents]
			 	*/

			 	$h_image_box_id = 'v-icon-box-'.str_replace("templateid_", "", $templateID).'-'.$group_id.''; 

			 	$h_image_box_output = "";

			 	foreach ($box_contents["image"] as $key => $options) {

					$h_image_box_title = ! empty( $box_contents["caption"][$key] ) ? htmlspecialchars( $box_contents["caption"][$key] ) : "";
					$h_image_box_text    = ! empty( $box_contents["text"][$key] ) ? $box_contents["text"][$key] : "";		
					$h_image_box_image    = ! empty( $box_contents["image"][$key] ) ? htmlspecialchars( $box_contents["image"][$key] ) : "";	
					$h_image_box_link    = ! empty( $box_contents["link"][$key] ) ? htmlspecialchars( $box_contents["link"][$key] ) : "";	
					$h_image_box_link_target    = ! empty( $box_contents["link_target"][$key] ) ? $box_contents["link_target"][$key] : "";			


				 	$h_image_box_output .= ! empty( $h_image_box_image ) ? '[h_content image="'. $h_image_box_image .'" title="'. $h_image_box_title .'" link="'. $h_image_box_link .'" link_target="'. $h_image_box_link_target .'"]'.$this->fix_editor_contents($h_image_box_text).'[/h_content]' : "";
			 	}
			 				
			 	$h_image_box_output = '[h_chained_contents id="'. $h_image_box_id .'" image_style="'.$media_style.'" bw_filter="'.$bw_filter.'" ]'. stripslashes( $h_image_box_output ) .'[/h_chained_contents]'; 

				//add to the template output
				$template_output .= $h_image_box_output;

			}	

			//other modules 
			else{
				$template_output .= rt_generate_shortcode($template);  
			}


			//close column holder for other elements than a column
			if ( ! $header_purpose && empty( $columns_started ) && $content_type != "column" && $content_type != "grid"  && $content_type != "slider_box" && $content_type != "space_box"){
				$template_output .= "[/rt_columns]";
			}


		} 

		return array( 'header' => $header_output, 'footer' => $footer_output, 'content' => $template_output, 'css' => $css_output, "template_options" => $template_options );
	}	 

	#
	#	Create Default Templates
	#
	function rt_create_default_templates(){
		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}	
				
		//reset
		$defaultTemplates  = array();
		update_option(RT_THEMESLUG.'_template_names_array', $defaultTemplates); 		
		
		//get the default tempalates data
		require_once(RT_THEMEFRAMEWORKDIR . "/template_builder/default_templates/index.php");  	
 
		$this->rt_import_page_templates( $default_templates );

	}

	#
	#	Delete All Templates
	#
	function rt_delete_templates( $selectedTemplate = "" ){
	
		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}	

 		//get the saved template names
		$saved_template_names = get_option(RT_THEMESLUG.'_template_names_array');

		if( is_array( $saved_template_names ) ){
			//create default templates 
			foreach ($saved_template_names as $templateID => $templateData) {

				//check if a template specified
				if ( ! empty( $selectedTemplate ) ) {

					//delete the template name from the array
					unset($saved_template_names[ $selectedTemplate ]);
					update_option(RT_THEMESLUG.'_template_names_array', $saved_template_names);

					$templateID = $selectedTemplate;
				}

				//delete the template data
				delete_option( RT_THEMESLUG."_".$templateID );

				//delete header output
				delete_option( RT_THEMESLUG."_".$templateID."_header_output" );							

				//delete footer output
	 			delete_option( RT_THEMESLUG."_".$templateID."_footer_output" ); 
	 
				//delete content output
	 			delete_option( RT_THEMESLUG."_".$templateID."_content_output" ); 
	 
				//delete css output
				delete_option( RT_THEMESLUG."_".$templateID."_css_output" );
				 
				//delete template options
				delete_option( RT_THEMESLUG."_".$templateID."_template_options");

				//delete encoded mark
				delete_option( RT_THEMESLUG."_".$templateID."_encoded");				

				//check if a template specified then stop the loop
				if ( ! empty( $selectedTemplate ) ) {
					break;
				}
			}
		} 
	} 


	#
	#	Module Controls
	#
	function module_controls( $isNewBox ){

		return $module_controls ='
			<div class="module_controls">
				<span class="icon-pencil-1 module_edit" title="'.__("Edit", "rt_theme_admin").'"></span> 
				<span class="icon-move module_move"></span>   
				<span class="icon-clipboard module_copy" title="'.__("Copy", "rt_theme_admin").'"></span>	
				<span class="icon-docs-1 module_clone" title="'.__("Clone", "rt_theme_admin").'"></span>	
				<span class="icon-trash-1 module_delete" title="'.__("Delete", "rt_theme_admin").'"></span>				
				<span class="icon-cancel module_close" title="'.__("Close", "rt_theme_admin").'"></span>			
			</div>
		';
	}
 


}


$RTThemePageLayoutOptionsClass = new RTThemePageLayoutOptions(); 
?>