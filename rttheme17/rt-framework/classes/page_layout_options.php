<?php
#-----------------------------------------
#	RT-Theme page_layout_options.php
#	version: 1.0
#
#	Several functions for template builder
#
#-----------------------------------------


class RTThemePageLayoutOptions extends RTThemeAdmin{
	  
	#
	#	Save Page Templates
	# 
	
	function rt_save_page_templates(){
		
		$savedTemplates       =  $_POST;
		$savedTemplates_Array =  array(); 
		
		//Class For Templates
		$templates  =  new stdClass;

		$box=0;
		$template=0;
		foreach($savedTemplates as $key=>$value){
			
			 
			$jump = stristr($key, '_template_name') == TRUE && $value==""  ? true : false ;
			 
			if(!$jump){
				//template name and ID		
				if(stristr($key, '_template_name') == TRUE) {
					
					$template = str_replace('_template_name','',$key); 
					
					$templates->templates[$template] =  new stdClass;

					$templates->templates[$template]->templateID	= $template; 
					$templates->templates[$template]->templateName = $value;
 
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
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'home_page_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value[0];
				$templates->templates[$template]->contents[$box]->content_id         =  $value[1];
				}
				
				//product list
				if(stristr($key, '_product_box')                                     == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'product_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->item_width         =  $value["item_width"];
				$templates->templates[$template]->contents[$box]->pagination         =  isset($value["pagination"]) ? $value["pagination"] : ""; 
				$templates->templates[$template]->contents[$box]->ajax_scroller      =  isset($value["ajax_scroller"]) ? $value["ajax_scroller"] : ""; 
				$templates->templates[$template]->contents[$box]->list_orderby       =  $value["list_orderby"];
				$templates->templates[$template]->contents[$box]->list_order         =  $value["list_order"];
				$templates->templates[$template]->contents[$box]->item_per_page      =  $value["item_per_page"];
				$templates->templates[$template]->contents[$box]->categories         =  isset($value["categories"]) ? $value["categories"] : "";	 
				}

				if ( class_exists( 'Woocommerce' ) ) {
					//woo product list
					if(stristr($key, '_woo_products_box')                                == TRUE) {
					$box++;
					$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class					
					$templates->templates[$template]->contents[$box]->group_id         	 =  $group_id; // group id
					$templates->templates[$template]->contents[$box]->content_type       =  'woo_products_box';
					$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
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
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'portfolio_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value[0]; 
				$templates->templates[$template]->contents[$box]->item_width         =  $value[1]; 
				$templates->templates[$template]->contents[$box]->pagination         =  isset($value["pagination"]) ? $value["pagination"] : "";
				$templates->templates[$template]->contents[$box]->portf_list_orderby =  $value["portf_list_orderby"];
				$templates->templates[$template]->contents[$box]->portf_list_order   =  $value["portf_list_order"];
				$templates->templates[$template]->contents[$box]->item_per_page      =  $value["item_per_page"]; 
				$templates->templates[$template]->contents[$box]->filterable         =  isset($value["filterable"]) ?  $value["filterable"] : ""; 
				}
				
				//portfolio categories
				if(stristr($key, '_portfolio_categories')                            == TRUE) {
				$templates->templates[$template]->contents[$box]->categories         =  $value;
				} 
				
				//sidebar boxes
				if(stristr($key, 'sidebar_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'sidebar_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"];
				$templates->templates[$template]->contents[$box]->sidebar_id         =  $value["sidebar_id"];
				$templates->templates[$template]->contents[$box]->widget_box_width   =  $value["widget_box_width"]; 
				}
				
				//default content 
				if(stristr($key, 'default_content')                                  == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'default_content';
				$templates->templates[$template]->contents[$box]->layout             =  "one";
				$templates->templates[$template]->contents[$box]->heading            =  $value["heading"];
				}
				
				//all content boxes
				if(stristr($key, '_all_content_boxes')                               == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'all_content_boxes';
				$templates->templates[$template]->contents[$box]->content_id         =  isset($value["content_id"]) ? $value["content_id"] : ""; 
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->item_width         =  $value["item_width"]; 
				$templates->templates[$template]->contents[$box]->list_orderby       =  $value["list_orderby"];
				$templates->templates[$template]->contents[$box]->list_order         =  $value["list_order"];
				}
				
				//banner box
				if(stristr($key, '_banner_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'banner_box'; 			
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"];
				$templates->templates[$template]->contents[$box]->text               =  $value["text"];
				$templates->templates[$template]->contents[$box]->button_text        =  $value["button_text"];
					//wpml register string
					wpml_register_string( THEMESLUG , 'Text for Banner '.$templates->templates[$template]->templateID.$group_id, $value["text"] );
					wpml_register_string( THEMESLUG , 'Button Text for Banner '.$templates->templates[$template]->templateID.$group_id, $value["button_text"] );
					wpml_register_string( THEMESLUG , 'Button Link for Banner '.$templates->templates[$template]->templateID.$group_id, $value["button_link"] );
									 
				$templates->templates[$template]->contents[$box]->button_link        =  $value["button_link"]; 
				}
				
				//Slider box
				if(stristr($key, '_slider_box')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'slider_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"];
				$templates->templates[$template]->contents[$box]->slider_script      =  $value["slider_script"];
				$templates->templates[$template]->contents[$box]->content_id         =  isset($value["content_id"]) ? $value["content_id"] : "";
				$templates->templates[$template]->contents[$box]->slider_timeout     =  $value["slider_timeout"];
				$templates->templates[$template]->contents[$box]->slider_height      =  $value["slider_height"];
				$templates->templates[$template]->contents[$box]->image_resize       =  isset($value["image_resize"]) ? $value["image_resize"] : "";
				$templates->templates[$template]->contents[$box]->image_crop         =  isset($value["image_crop"]) ? $value["image_crop"] : "";
				$templates->templates[$template]->contents[$box]->list_orderby       =  $value["list_orderby"];
				$templates->templates[$template]->contents[$box]->list_order         =  $value["list_order"]; 
				$templates->templates[$template]->contents[$box]->slider_buttons     =  isset($value["slider_buttons"]) ? $value["slider_buttons"] : "";
				$templates->templates[$template]->contents[$box]->slider_thumbs      =  isset($value["slider_thumbs"]) ? $value["slider_thumbs"] : "";
				$templates->templates[$template]->contents[$box]->thumbs_width       =  $value["thumbs_width"];
				$templates->templates[$template]->contents[$box]->thumbs_height      =  $value["thumbs_height"];
				$templates->templates[$template]->contents[$box]->slider_effect      =  isset($value["slider_effect"]) ? $value["slider_effect"] : "";
				}

				
				//Revolution Slider box
				if(stristr($key, '_revolution_box')                                  == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"];				
				$templates->templates[$template]->contents[$box]->content_type       =  'revolution_box'; 
				$templates->templates[$template]->contents[$box]->slider_id      	 =  $value["slider_id"];  
				}

				//google map 
				if(stristr($key, '_google_map')                                      == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'google_map';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->map_url            =  $value["map_url"];
				$templates->templates[$template]->contents[$box]->height             =  $value["height"]; 

					//wpml register string
					wpml_register_string( THEMESLUG , 'Map URL '.$templates->templates[$template]->templateID.$group_id, stripslashes($value["map_url"]));				
				}
				
				//contact form
				if(stristr($key, '_contact_form')                                    == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'contact_form';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->title              =  $value["title"];
				$templates->templates[$template]->contents[$box]->email              =  $value["email"];
				$templates->templates[$template]->contents[$box]->shortcode          =  $value["shortcode"]; 
				$templates->templates[$template]->contents[$box]->description        =  $value["description"];
				
					//wpml register string
					wpml_register_string( THEMESLUG , 'Text for Contact Form '.$templates->templates[$template]->templateID.$group_id, $value["title"] );
					wpml_register_string( THEMESLUG , 'Description for Contact Form '.$templates->templates[$template]->templateID.$group_id, $value["description"] );
				}
				
				//contact info box
				if(stristr($key, '_contact_info_box')                                == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'contact_info_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->contact_title      =  $value["contact_title"];
				$templates->templates[$template]->contents[$box]->contact_text       =  $value["contact_text"];
				$templates->templates[$template]->contents[$box]->address            =  $value["address"];
				$templates->templates[$template]->contents[$box]->phone              =  $value["phone"];
				$templates->templates[$template]->contents[$box]->email              =  $value["email"]; 
				$templates->templates[$template]->contents[$box]->support_email      =  $value["support_email"];
				$templates->templates[$template]->contents[$box]->fax                =  $value["fax"]; 


					//wpml register string
					wpml_register_string( THEMESLUG , 'Title for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["contact_title"] );
					wpml_register_string( THEMESLUG , 'Text for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["contact_text"] ); 
					wpml_register_string( THEMESLUG , 'Address for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["address"] );
					wpml_register_string( THEMESLUG , 'Phone for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["phone"] ); 
					wpml_register_string( THEMESLUG , 'Email for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["email"] );
					wpml_register_string( THEMESLUG , 'Support Email for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["support_email"] ); 
					wpml_register_string( THEMESLUG , 'Fax for Contact Info '.$templates->templates[$template]->templateID.$group_id, $value["fax"] ); 				
				}


				//heading bar
				if(stristr($key, '_heading_bar')                               		 == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'heading_bar';
				$templates->templates[$template]->contents[$box]->heading            =  $value["heading"];
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 


					//wpml register string
					wpml_register_string( THEMESLUG , 'Heading '.$templates->templates[$template]->templateID.$group_id, $value["heading"] );
				}				
				//blog posts
				if(stristr($key, '_blog_box')                                        == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'blog_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->pagination         =  isset($value["pagination"]) ? $value["pagination"] : "";
				$templates->templates[$template]->contents[$box]->list_orderby       =  $value["list_orderby"];
				$templates->templates[$template]->contents[$box]->list_order         =  $value["list_order"];
				$templates->templates[$template]->contents[$box]->item_per_page      =  $value["item_per_page"];
				$templates->templates[$template]->contents[$box]->categories         =  isset($value["categories"]) ? $value["categories"] : ""; 
				}

				//code box
				if(stristr($key, '_code_box')                                        == TRUE) {
				$box++;
				$templates->templates[$template]->contents[$box] 					 =  new stdClass; //create new sub class				
				$templates->templates[$template]->contents[$box]->group_id           =  $group_id; // group id
				$templates->templates[$template]->contents[$box]->content_type       =  'code_box';
				$templates->templates[$template]->contents[$box]->layout             =  $value["layout"]; 
				$templates->templates[$template]->contents[$box]->heading            =  $value["heading"];
				$templates->templates[$template]->contents[$box]->code_space         =  $value["code_space"];
				$templates->templates[$template]->contents[$box]->transparent        =  isset($value["transparent"]) ? $value["transparent"] : "";
				$templates->templates[$template]->contents[$box]->no_padding         =  isset($value["no_padding"]) ? $value["no_padding"] : ""; 

					
					//wpml register string
					wpml_register_string( THEMESLUG , 'Title for Code Box '.$templates->templates[$template]->templateID.$group_id, $value["heading"] ); 
					wpml_register_string( THEMESLUG , 'Description for Code Box '.$templates->templates[$template]->templateID.$group_id, $value["code_space"] ); 							
				}


				//line up boxes 	templateid_50758_line_up_boxes
				if(stristr($key, $templates->templates[$template]->templateID.'_line_up_boxes') == TRUE && $templates->templates[$template]->templateName) {
					$box++;
					$templates->templates[$template]->lineup 						=  $value; 
				} 
			}
			
			//save the object
			update_option('rt_page_layouts', $templates);
			
			//save the template names array
			update_option('rt_template_names_array', $savedTemplates_Array); 
		 
		}
		 
			
	}
	 

	#
	#	Create Default Templates
	#
	
	function rt_create_default_templates(){
		

		$defaultTemplates = new stdClass;


				#
				#	Home Page default
				#
		
				//create a default tempalte for products - no sidebar
				$templateID                                                                = "templateid_001";
				$defaultTemplates->templates[$templateID] = new stdClass;
				$defaultTemplates->templates[$templateID]->templateID                      = "templateid_001";
				$defaultTemplates->templates[$templateID]->templateName                    = __("Default Home Page Template","rt_theme_admin");
				$defaultTemplates->templates[$templateID]->sidebar                         = "full";
				
				
				//accordion slider with all avaiable slider contents
				$defaultTemplates->templates[$templateID]->contents[0] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[0]->group_id           = 1;
				$defaultTemplates->templates[$templateID]->contents[0]->content_type       = "slider_box";
				$defaultTemplates->templates[$templateID]->contents[0]->slider_script      = "flex";
				$defaultTemplates->templates[$templateID]->contents[0]->content_id         = "";
				$defaultTemplates->templates[$templateID]->contents[0]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[0]->slider_timeout     = 8;
				$defaultTemplates->templates[$templateID]->contents[0]->slider_height      = 400;
				$defaultTemplates->templates[$templateID]->contents[0]->image_resize       = "on";
				$defaultTemplates->templates[$templateID]->contents[0]->image_crop         = "on";
				$defaultTemplates->templates[$templateID]->contents[0]->list_orderby       = "date";
				$defaultTemplates->templates[$templateID]->contents[0]->list_order         = "DESC"; 
				$defaultTemplates->templates[$templateID]->contents[0]->slider_buttons     = "on";
				$defaultTemplates->templates[$templateID]->contents[0]->slider_effect      = "fade";
				$defaultTemplates->templates[$templateID]->contents[0]->slider_thumbs      = "";


				//banner box
				$defaultTemplates->templates[$templateID]->contents[1] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[1]->group_id           = 2;
				$defaultTemplates->templates[$templateID]->contents[1]->content_type       = "banner_box";
				$defaultTemplates->templates[$templateID]->contents[1]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[1]->text               = 'Lorem ipsum dolor sit amet, consectetur &amp; <a href="#" title="">adipisicing</a> at eros';
				$defaultTemplates->templates[$templateID]->contents[1]->button_text        = 'Button Text';
				$defaultTemplates->templates[$templateID]->contents[1]->button_color       = 'light';
				$defaultTemplates->templates[$templateID]->contents[1]->button_link        = '#';
				$defaultTemplates->templates[$templateID]->contents[1]->button_size        = 'small';
				
				//home page contents  - home page custom posts - all - four columns in full width box
				$defaultTemplates->templates[$templateID]->contents[2] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[2]->group_id           = 3;
				$defaultTemplates->templates[$templateID]->contents[2]->content_type       = "all_content_boxes";
				$defaultTemplates->templates[$templateID]->contents[2]->content_id         = "";
				$defaultTemplates->templates[$templateID]->contents[2]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[2]->item_width         = "4"; 
				$defaultTemplates->templates[$templateID]->contents[2]->list_orderby       = "date";
				$defaultTemplates->templates[$templateID]->contents[2]->list_order         = "DESC";
				
				//call widgetized home page area
				$defaultTemplates->templates[$templateID]->contents[3] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[3]->group_id           = 4;
				$defaultTemplates->templates[$templateID]->contents[3]->content_type       = "sidebar_box";
				$defaultTemplates->templates[$templateID]->contents[3]->sidebar_id         = "home-page-contents";
				$defaultTemplates->templates[$templateID]->contents[3]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[3]->widget_box_width   = "4";
				
				//save the templates as an array
				$savedTemplates_Array[$templateID]                                         = $defaultTemplates->templates[$templateID]->templateName;
				
				
				#
				#	Portfolio default
				#
				
				//create a default tempalte for portfolio - no sidebar
				$templateID                                                                = "templateid_002";
				$defaultTemplates->templates[$templateID] = new stdClass;
				$defaultTemplates->templates[$templateID]->templateID                      = "templateid_002";
				$defaultTemplates->templates[$templateID]->templateName                    = __("Default Portfolio Template","rt_theme_admin");
				$defaultTemplates->templates[$templateID]->sidebar                         = "full";
				
				//default content - 1/1 box with heading
				$defaultTemplates->templates[$templateID]->contents[0] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[0]->group_id           = 1;
				$defaultTemplates->templates[$templateID]->contents[0]->content_type       = "default_content";
				$defaultTemplates->templates[$templateID]->contents[0]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[0]->heading            = "on";				
				
				//all portfolio items with all categories - pagination ON - 1/1 box width - 1/4 item width
				$defaultTemplates->templates[$templateID]->contents[1] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[1]->group_id           = 2;
				$defaultTemplates->templates[$templateID]->contents[1]->content_type       = "portfolio_box";
				$defaultTemplates->templates[$templateID]->contents[1]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[1]->heading            = "on";
				$defaultTemplates->templates[$templateID]->contents[1]->item_width         = 4;
				$defaultTemplates->templates[$templateID]->contents[1]->pagination         = "on";
				$defaultTemplates->templates[$templateID]->contents[1]->item_per_page      = 12;
				$defaultTemplates->templates[$templateID]->contents[1]->portf_list_orderby = "date";
				$defaultTemplates->templates[$templateID]->contents[1]->portf_list_order   = "DESC";
				
				//save the templates as an array
				$savedTemplates_Array[$templateID]                                         = $defaultTemplates->templates[$templateID]->templateName;
				
				
				#
				#	Product default
				#
				
				//create a default tempalte for products - no sidebar
				$templateID                                                                = "templateid_003";
				$defaultTemplates->templates[$templateID] = new stdClass;
				$defaultTemplates->templates[$templateID]->templateID                      = "templateid_003";
				$defaultTemplates->templates[$templateID]->templateName                    = __("Default Product Template","rt_theme_admin");
				$defaultTemplates->templates[$templateID]->sidebar                         = "right";				
				
				//default content - 1/1 box with heading
				$defaultTemplates->templates[$templateID]->contents[0] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[0]->group_id           = 1;
				$defaultTemplates->templates[$templateID]->contents[0]->content_type       = "default_content";
				$defaultTemplates->templates[$templateID]->contents[0]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[0]->heading            = "on";
				
				//all product items with all categories - pagination ON - 1/1 box width - 1/3 item width
				$defaultTemplates->templates[$templateID]->contents[1] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[1]->group_id           = 2;
				$defaultTemplates->templates[$templateID]->contents[1]->content_type       = "product_box";
				$defaultTemplates->templates[$templateID]->contents[1]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[1]->heading            = "on";
				$defaultTemplates->templates[$templateID]->contents[1]->item_width         = 3;
				$defaultTemplates->templates[$templateID]->contents[1]->pagination         = "on";
				$defaultTemplates->templates[$templateID]->contents[1]->ajax_scroller      = "";
				$defaultTemplates->templates[$templateID]->contents[1]->item_per_page      = 9;
				$defaultTemplates->templates[$templateID]->contents[1]->list_orderby       = "date";
				$defaultTemplates->templates[$templateID]->contents[1]->list_order         = "DESC";
				
				//save the templates as an array
				$savedTemplates_Array[$templateID]                                         = $defaultTemplates->templates[$templateID]->templateName;
				
				
				#
				#	Blog default
				#
				
				//create a default tempalte for products - no sidebar
				$templateID                                                                = "templateid_004";
				$defaultTemplates->templates[$templateID] = new stdClass;
				$defaultTemplates->templates[$templateID]->templateID                      = "templateid_004";
				$defaultTemplates->templates[$templateID]->templateName                    = __("Default Blog Template","rt_theme_admin");
				$defaultTemplates->templates[$templateID]->sidebar                         = "right";				
				
				//all posts with all categories - pagination ON - 1/1 box width - 1/1 item width
				$defaultTemplates->templates[$templateID]->contents[0] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[0]->group_id           = 1;
				$defaultTemplates->templates[$templateID]->contents[0]->content_type       = "blog_box";
				$defaultTemplates->templates[$templateID]->contents[0]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[0]->pagination         = "on";
				$defaultTemplates->templates[$templateID]->contents[0]->item_per_page      = 5;
				$defaultTemplates->templates[$templateID]->contents[0]->list_orderby       = "date";
				$defaultTemplates->templates[$templateID]->contents[0]->ist_order          = "DESC";
				$defaultTemplates->templates[$templateID]->contents[0]->categories         = "";
				
				//save the templates as an array
				$savedTemplates_Array[$templateID]                                         = $defaultTemplates->templates[$templateID]->templateName;
				
				
				
				#
				#	Contact Contact Page default
				#
				
				//create a default tempalte for products - no sidebar
				$templateID                                                                = "templateid_005";
				$defaultTemplates->templates[$templateID] = new stdClass;
				$defaultTemplates->templates[$templateID]->templateID                      = "templateid_005";
				$defaultTemplates->templates[$templateID]->templateName                    = __("Default Contact Page Template","rt_theme_admin");
				$defaultTemplates->templates[$templateID]->sidebar                         = "full";				
				
				//default content - 1/1 box with heading
				$defaultTemplates->templates[$templateID]->contents[0] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[0]->group_id           = 1;
				$defaultTemplates->templates[$templateID]->contents[0]->content_type       = "default_content";
				$defaultTemplates->templates[$templateID]->contents[0]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[0]->heading            = "on";		
				
				//sample google map
				$defaultTemplates->templates[$templateID]->contents[1] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[1]->group_id           = 2;
				$defaultTemplates->templates[$templateID]->contents[1]->content_type       = "google_map";
				$defaultTemplates->templates[$templateID]->contents[1]->layout             = "one";
				$defaultTemplates->templates[$templateID]->contents[1]->map_url            = '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?ie=UTF8&amp;ll=40.748151,-73.985131&amp;spn=0.012355,0.021007&amp;t=m&amp;z=16&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/?ie=UTF8&amp;ll=40.748151,-73.985131&amp;spn=0.012355,0.021007&amp;t=m&amp;z=16&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>';				
				$defaultTemplates->templates[$templateID]->contents[1]->height             = "270";
				
				
				//sample contact info box
				$defaultTemplates->templates[$templateID]->contents[2] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[2]->group_id           = 3;
				$defaultTemplates->templates[$templateID]->contents[2]->content_type       = "contact_info_box";
				$defaultTemplates->templates[$templateID]->contents[2]->layout             = "two";
				$defaultTemplates->templates[$templateID]->contents[2]->contact_title      = "Contact Details";
				$defaultTemplates->templates[$templateID]->contents[2]->contact_text       = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius mod tempor incididunt ut lab ore et dolore magna aliqua.";
				$defaultTemplates->templates[$templateID]->contents[2]->address            = "63739 street lorem ipsum City, Country ";
				$defaultTemplates->templates[$templateID]->contents[2]->phone              = "+1 123 312 32 23";
				$defaultTemplates->templates[$templateID]->contents[2]->email              = "info@company.com";
				$defaultTemplates->templates[$templateID]->contents[2]->support_email      = "support@company.com";
				$defaultTemplates->templates[$templateID]->contents[2]->fax                = "+1 123 312 32 23";
				
				//sample contact form
				$defaultTemplates->templates[$templateID]->contents[3] = new stdClass;
				$defaultTemplates->templates[$templateID]->contents[3]->group_id           = 4;
				$defaultTemplates->templates[$templateID]->contents[3]->content_type       = "contact_form";
				$defaultTemplates->templates[$templateID]->contents[3]->layout             = "two";
				$defaultTemplates->templates[$templateID]->contents[3]->title              = "Contact Form";
				$defaultTemplates->templates[$templateID]->contents[3]->email              = get_option('admin_email');
				$defaultTemplates->templates[$templateID]->contents[3]->description        = "(*) lorem ipsum dolor sit amet!";
				$defaultTemplates->templates[$templateID]->contents[3]->shortcode          = "";

				//save the templates as an array
				$savedTemplates_Array[$templateID]                                         = $defaultTemplates->templates[$templateID]->templateName;
 



		//save the template names array
		update_option('rt_template_names_array', $savedTemplates_Array);

		//save the object
		update_option('rt_page_layouts', $defaultTemplates);
		
	}


	#
	#	Heading Bar
	#
	function rt_generate_heading_bar($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName       = __("Heading Bar", "rt_theme_admin");
			$contet_type   = "heading_bar";			
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			
			$opacity       = 1;
			$layout        = $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position      = $isNewBox ? 'open minus'	:	'plus'					;
			$data_position = $isNewBox ? ''				:	'display: none;'		;	 
			$heading       = $isNewBox ? ''				:	$options['heading']		;  
 

			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
 
					
					array(
							   "desc" 	=> __("You can use this module to display a banner box.",'rt_theme_admin'),	 
							   "hr" 		=> "true",
							   "type" 	=> "info_text_only"),

					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_heading_bar[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"),
 

					array(
							   "name" => __("Heading",'rt_theme_admin'),
							   "desc" => __("Please select a box size for the content.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_heading_bar[heading]",
							   "value"=>$heading,
							   "class"=>"heading",
							   "hr" => "true",
							   "type" => "text"),

					array(
							"name" 		=> __("delete",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID.'_'."_delete",
							"class" 		=> "deleteButton template_box_delete",
							"purpose" 	=> "page_template",
							"type" 		=> "button"),


					array(
							"name" 		=> __("close",'rt_theme_admin'),
							"id" 		=>$theTemplateID.'_'.$theGroupID.'_'."_close",
							"class" 		=> "closeButton template_box_close",
							"purpose" 	=> "page_template",
							"type" 		=> "button")
					); 


					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}

	#
	#	Banner Box
	#
	function rt_generate_banner_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName       = __("Banner Box", "rt_theme_admin");
			$contet_type   = "banner_box";			
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			
			$opacity       = 1;
			$layout        = $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position      = $isNewBox ? 'open minus'	:	'plus'					;
			$data_position = $isNewBox ? ''				:	'display: none;'		;		
			$text          = $isNewBox ? ''				:	$options['text']		;  
			$button_text   = $isNewBox ? ''				:	$options['button_text']	;
			$button_link   = $isNewBox ? ''				:	$options['button_link']	;


			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
 
					
					array(
							   "desc" 	=> __("You can use this module to display a banner box.",'rt_theme_admin'),	 
							   "hr" 		=> "true",
							   "type" 	=> "info_text_only"),

 					array( 
							"value"		=> "one", 						 
							"id" 		=> $theTemplateID.'_'.$theGroupID."_banner_box[layout]",
							"type" 		=> "hidden", 
					),

					array(
							   "name" => __("Banner Text",'rt_theme_admin'),
							   "desc" => __("Please select a box size for the content.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_banner_box[text]",
							   "value"=>$text,
							   "class"=>"banner_text",
							   "hr" => "true",
							   "type" => "textarea"),				 
 
					array(
							   "name" => __("Button Text",'rt_theme_admin'),						 
							   "id" => $theTemplateID.'_'.$theGroupID."_banner_box[button_text]",
							   "value"=>$button_text,
							   "class"=>"button_text",
							   "hr" => "true",
							   "type" => "text"),

					array(
							   "name" => __("Button Link",'rt_theme_admin'),						 
							   "id" => $theTemplateID.'_'.$theGroupID."_banner_box[button_link]",
							   "value"=>$button_link,
							   "class"=>"button_link",
							   "hr" => "true",
							   "type" => "text"), 
					
					array(
							"name" 		=> __("delete",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID.'_'."_delete",
							"class" 		=> "deleteButton template_box_delete",
							"purpose" 	=> "page_template",
							"type" 		=> "button"),


					array(
							"name" 		=> __("close",'rt_theme_admin'),
							"id" 		=>$theTemplateID.'_'.$theGroupID.'_'."_close",
							"class" 		=> "closeButton template_box_close",
							"purpose" 	=> "page_template",
							"type" 		=> "button")
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}


	function rt_generate_slider_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Slider", "rt_theme_admin");
			$contet_type	= "slider_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
 
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;
 
			
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
		
								
			$options = array (
 
 					array( 
							"value"		=> "one", 						 
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[layout]",
							"type" 		=> "hidden", 
					),
							
					array(
							"desc" 		=> __("This module displays a slider.",'rt_theme_admin'),	 
							"hr" 		=> "true",
							"type" 		=> "info_text_only"), 							
		
					array(
							"name"		=> __("Select Slider Script",'rt_theme_admin'),
							"desc" 		=> __("Select a slider script for your home page",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_script]", 
							"options" 	=>	array( 
												"flex"		=>	    "Flex Slider" ,
												"nivo"		=>	    "Nivo Slider" 
										),
							"default"		=> "fl",
							"value"		=> @$options["slider_script"],
							"hr" 		=> "true",
							"dont_save"	=> true,
							"type"		=> "select"),
					
					array(
							"name" 		=> __("Select Slides",'rt_theme_admin'),
							"desc" 		=> __("Select the slides which you want to use with this slider. If you don't select one, all slides will be displayed.",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[content_id][]",
							"options" 	=> RTTheme::rt_get_slidercontents(),
							"purpose"		=> "sidebar",
							"type"		=> "selectmultiple",
							"class"		=> $randomClass,
							"hr"			=> true,
							"default"		=> @$options["content_id"]),
			
		
					array(
							"name" 		=> __("Transition Timeout (seconds)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_timeout]",
							"desc" 		=> __("The speed of the slideshow cycling",'rt_theme_admin'),
							"hr" 		=> "true",
							"min"		=>"1",
							"max"		=>"120",
							"default"		=>"8",
							"hr"			=> true,
							"dont_save"	=> true,
							"value"		=> @$options["slider_timeout"],
							"class"		=> $randomClass,
							"type"		=> "rangeinput"),

					array(
							"name"		=> __("Slider Height (px)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_height]",
							"desc" 		=> __("The max. height value of the slider",'rt_theme_admin'),
							"min"		=>"100",
							"max"		=>"1000",
							"default"		=>"300", 
							"dont_save"	=> true,
							"value"		=> @$options["slider_height"],
							"class"		=> $randomClass,
							"type" 		=> "rangeinput"),


					array(
							"name"		=> __("Order Slides",'rt_theme_admin'), 
							"type" 		=> "heading"),

					
					array(
							"name" 		=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 		=> __("sort the slides by this parameter",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[list_orderby]", 
							"options" 	=> array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"hr"			=> true,
							"value"		=> @$options["list_orderby"],
							"default"		=> "date",
							"dont_save" 	=> true,
							"type" 		=> "select"),
			
					array(
							"name" 		=> __("Order",'rt_theme_admin'),
							"desc" 		=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[list_order]", 
							"options" 	=> array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"		=> @$options["list_order"],
							"default"		=> "DESC",
							"dont_save" 	=> true,
							"hr"			=> true,
							"type" 		=> "select"),


					array(
							"desc" 		=> __("FOLLOWING OPTIONS ARE ONLY FOR THE FLEX SLIDER",'rt_theme_admin'),	  
							"type" 		=> "info_text_only"),

					array(
							"name"		=> __("Slide Images",'rt_theme_admin'), 
							"type" 		=> "heading"),

					array(
							"name" 		=> __("Resize Slider Images.",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[image_resize]", 
							"desc" 		=> __("Turn ON this option to automatically resize the slider images to fit your content width and the slider height",'rt_theme_admin'),
							"class"		=> $randomClass,							
							"value"		=>  $isNewBox ? "on" : $options["image_resize"],
							"hr"			=> true, 
							"type" 		=> "checkbox"),
					
					array(
							"name" 		=> __("Crop Slider Images.",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[image_crop]", 
							"desc" 		=> __("If you turn on the crop feature, the image will be cropped as the height value above. Resize feature must be ON.",'rt_theme_admin'),
							"class"		=> $randomClass,
							"value"		=>  $isNewBox ? "on" : $options["image_crop"],
							"hr" 		=> "true",
							"type" 		=> "checkbox"), 


		
					array(
							"name" 		=> __("Transition Effect",'rt_theme_admin'),
							"desc" 		=> __("Choose an effect for this slider",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_effect]", 
							"options" 	=>	array( 
												"fade"			=>	    "fade",
												"slide"			=>	    "slide", 
										 ),
							"class"		=> $randomClass,
							"value"		=> @$options["slider_effect"],
							"default"		=>"scrollUp",
							"dont_save"	=>"true",
							"type" 		=> "select"),

					array(
							"name"		=> __("Slider Navigation Items",'rt_theme_admin'), 
							"type" 		=> "heading"),

					array(
							"name" 		=> __("Pager Style",'rt_theme_admin'),
							"desc" 		=> __("Select a pager style for this slider",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[slider_buttons]",  
							"class"		=> $randomClass,
							"options" 	=>	array( 
												"no_pager"		=>	    "No Pager",												
												"on"				=>	    "Button Pager",
												"thumbnails"		=>	    "Thumbnail Pager",
												"headings"		=>	    "Heading Pager", 
										 ),
							"value"		=> $isNewBox ? "on" : (!$options["slider_buttons"] ? "no_pager" : $options["slider_buttons"]), 
							"type" 		=> "radio"),

					array(
							"name"		=> __("Heading & Thumbnail Pager Options",'rt_theme_admin'), 
							"type" 		=> "heading"),
 
					array(
							"name"		=> __("Pager Box Widths (px)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[thumbs_width]",
							"desc" 		=> __("Set width value for the thumbnails or headings tabs",'rt_theme_admin'),
							"hr"	 		=> "true",
							"min"		=> "40",
							"max"		=> "920",
							"default"		=> "200",
							"hr"			=> true,
							"dont_save"	=> true,
							"value"		=> @$options["thumbs_width"],
							"class"		=> $randomClass,
							"type" 		=> "rangeinput"),

					array(
							"name"		=> __("Pager Box Heights (px)",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_slider_box[thumbs_height]",
							"desc" 		=> __("Set height value for the thumbnails or headings tabs",'rt_theme_admin'), 
							"min"		=>"20",
							"max"		=>"1000",
							"default"		=>"80", 
							"dont_save"	=> true,
							"value"		=> @$options["thumbs_height"],
							"class"		=> $randomClass,
							"hr" 		=> "true",
							"type" 		=> "rangeinput"),			


					array(
							"name" 		=> __("delete",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID.'_'."_delete",
							"class" 		=> "deleteButton template_box_delete",
							"purpose" 	=> "page_template",
							"type" 		=> "button"),


					array(
							"name" 		=> __("close",'rt_theme_admin'),
							"id" 		=>$theTemplateID.'_'.$theGroupID.'_'."_close",
							"class" 		=> "closeButton template_box_close",
							"purpose" 	=> "page_template",
							"type" 		=> "button")
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}



	function rt_generate_revolution_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Revolution Slider", "rt_theme_admin");
			$contet_type	= "revolution_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
 
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout			= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;
			$slider_id		= $isNewBox ? '': 	$options['slider_id'];
			
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo  '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
		
								
			$options = array (
 
					array( 
							"value"		=> "one", 						 
							"id" 		=> $theTemplateID.'_'.$theGroupID."_revolution_box[layout]",
							"type" 		=> "hidden", 
					),
							
					array(
							"desc" 		=> __("This module displays a Revolution Slider.",'rt_theme_admin'),	 
							"hr" 		=> "true",
							"type" 		=> "info_text_only"), 							
		
					array(
							"name"		=> __("Revolution Slider Shortcode",'rt_theme_admin'),
							"desc" 		=> __("Paste the shortcode of the slider that has been created with Revolution Slider. To learn more please go to \"Setup Assistant\" and read \"How To Create Revolution Slider\" section.",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_revolution_box[slider_id]", 
							"value"		=> $slider_id,
							"hr" 		=> "true",
							"type"		=> "text"), 

					array(
							"name" 		=> __("delete",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID.'_'."_delete",
							"class" 	=> "deleteButton template_box_delete",
							"purpose" 	=> "page_template",
							"type" 		=> "button"),


					array(
							"name" 		=> __("close",'rt_theme_admin'),
							"id" 		=>$theTemplateID.'_'.$theGroupID.'_'."_close",
							"class" 	=> "closeButton template_box_close",
							"purpose" 	=> "page_template",
							"type" 		=> "button")
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}


	function rt_generate_all_content_boxes($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Home Page Content", "rt_theme_admin");
			$contet_type	= "all_content_boxes";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;		
			$item_width	= $isNewBox ? ''			:	$options['item_width']	;
			$list_orderby	= $isNewBox ? ''			:	$options['list_orderby'];
			$list_order	= $isNewBox ? ''			:	$options['list_order'];
			$content_id	= $isNewBox ? ''			:	$options['content_id'];
			

			
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
 
					
					array(
							   "desc" 	=> __("You can use this module to display posts that has been created with <a href='edit.php?post_type=home_page'>Home Page Custom Posts</a>",'rt_theme_admin'),	 
							   "hr" 		=> "true",
							   "type" 	=> "info_text_only"),

					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_all_content_boxes[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"),									
					
					array(
							"name" 	=> __("Select Contents",'rt_theme_admin'),
							"desc" 	=> __("You can filter posts by selecting from this list. If you don't select one, all home page contents will be displayed.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_all_content_boxes[content_id][]",
							"options" => RTTheme::rt_get_homecontents(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $content_id
					),
					
					array(
							   "name" 	=> __("Content Layout",'rt_theme_admin'),
							   "desc" 	=> __("Please select a layout for the contents that will be displayed in this column.",'rt_theme_admin'),
							   "id" 		=> $theTemplateID.'_'.$theGroupID."_all_content_boxes[item_width]",
							   "options" 	=>	array(
													5 => "1/5", 
													4 => "1/4",
													3 => "1/3",
													2 => "1/2",
													1 => "1/1"									
										    ),
							   "default"	=>"4",
							   "dont_save"	=>true,
							   "value"	=>$item_width,
							   "hr" 		=> "true",
							   "type" 	=> "select"), 
					
					array(
							"name" 		=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 		=> __("sort your home page posts by this parameter",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_all_content_boxes[list_orderby]", 
							"options" 	=> array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"hr"			=> true,
							"value"		=> $list_orderby,
							"default"		=> "date",
							"dont_save" 	=> true,
							"type" 		=> "select"),
			
					array(
							"name" 		=> __("Order",'rt_theme_admin'),
							"desc" 		=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_all_content_boxes[list_order]", 
							"options" 	=> array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"		=> $list_order,
							"default"		=> "DESC",
							"dont_save" 	=> true,
							"hr"			=> true,					
							"type" 		=> "select"),					

					array(
							"name" 		=> __("delete",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID.'_'."_delete",
							"class" 		=> "deleteButton template_box_delete",
							"purpose" 	=> "page_template",
							"type" 		=> "button"),


					array(
							"name" 		=> __("close",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID.'_'."_close",
							"class" 		=> "closeButton template_box_close",
							"purpose" 	=> "page_template",
							"type" 		=> "button")
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}


	function rt_generate_default_content_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Default Content", "rt_theme_admin");
			$contet_type	= "default_content";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;	  
			$heading		= $isNewBox ? 'on'			:	$options['heading']		;
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
 
					
					array(
							"desc" => __("This module displays the content of the page or post that used with.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info_text_only", 
					),

	
					array(
							"name" 	=> __("Heading",'rt_theme_admin'),
							"desc" 	=> __("Turn Off this option if you don't want to show page/post heading.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_default_content[heading]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $heading,  
							"std" 	=> "false"),			

					array( 
							"value"	=> "1", 
							"hr" 	=> "true",
							"id" 	=> $theTemplateID.'_'.$theGroupID."_default_content[hidden]",
							"type" 	=> "hidden", 
					),
					
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),


					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button",
					)
					
										
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}
	

	function rt_generate_blog_box($theGroupID,$theTemplateID,$options,$randomClass){
	   
	   
			$boxName		= __("Blog Posts", "rt_theme_admin");
			$contet_type	= "blog_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		; 
			$categories	= $isNewBox ? ''			:	$options['categories']	;
			$pagination	= $isNewBox ? ''			:	$options['pagination']	; 
			$list_orderby	= $isNewBox ? ''			:	$options['list_orderby'];
			$list_order	= $isNewBox ? ''			:	$options['list_order'];
			$item_per_page	= $isNewBox ? ''			:	$options['item_per_page'];
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			

			$options = array (

					array(
							   "desc" => __("This module displays posts according the options below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
 					array( 
							"value"		=> "one", 						 
							"id" 		=> $theTemplateID.'_'.$theGroupID."_blog_box[layout]",
							"type" 		=> "hidden", 
					),
					
					array(
							"name" 	=> __("Select Post Categories",'rt_theme_admin'),
							"desc" 	=> __("You can select categories to filter posts that will be displayed with this module. If you don't select one, this module will display all posts.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_box[categories][]",
							"options" => RTTheme::rt_get_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple", 
							"hr"		=> true,	
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("sort your posts by this parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_box[list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"hr"		=> true,
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_box[list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true,
							"hr"		=> true,					
							"type" 	=> "select"),
	
					array(
							"name" 	=> __("Amount of blog post per page",'rt_theme_admin'),
							"desc"	=> __("How many posts do you want to display per page?",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_box[item_per_page]",
							"min"	=> "1",
							"max"	=> "200",
							"class"	=> $randomClass,
							"value"	=> $item_per_page,
							"default"	=> "9",
							"dont_save" => true,
							"hr"		=> true,
							"type" 	=> "rangeinput"),
			  
					array(
							"name" 	=> __("Pagination",'rt_theme_admin'),
							"desc" 	=> __("Adds page navigation under the posts.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_box[pagination]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $pagination, 							
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"),
 
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button"),
					
					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button"),			
					
					);
						
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
			
			
	}


	function rt_generate_portfolio_box($theGroupID,$theTemplateID,$options,$randomClass){
	   
				
	   
			$boxName		= __("Portfolio Posts", "rt_theme_admin");
			$contet_type	= "portfolio_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;		 
			$categories	= $isNewBox ? ''			:	$options['categories']	;
			$pagination	= $isNewBox ? ''			:	$options['pagination']	;
			$filterable	= $isNewBox ? ''			:	$options['filterable']	;
			$item_width	= $isNewBox ? ''			:	$options['item_width']	;
			$portf_list_orderby	= $isNewBox ? ''		:	$options['portf_list_orderby'];
			$portf_list_order	= $isNewBox ? ''		:	$options['portf_list_order'];
			$item_per_page		= $isNewBox ? ''		:	$options['item_per_page'];
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			

			$options = array (
					
					
					array(
							   "desc" => __("This module displays portfolio posts according the options below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"),
	

					array(
							"name" 	=> __("Select Portfolio Categories",'rt_theme_admin'),
							"desc" 	=> __("You can filter posts by selecting categories from this list. If you don't select one, all portfolio posts will be displayed.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_categories[]",
							"options" => RTTheme::rt_get_portfolio_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("sort the portfolio items by this parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[portf_list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"hr"		=> true,
							"value"	=> $portf_list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[portf_list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $portf_list_order,
							"default"	=> "DESC",
							"dont_save" => true,
							"hr"		=> true,					
							"type" 	=> "select"),
	
					array(
						"name" 	=> __("Amount of portfolio item per page",'rt_theme_admin'),
						"desc"	=> __("How many item do you want to display per page?",'rt_theme_admin'),
						"id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[item_per_page]",
						"min"	=> "1",
						"max"	=> "200",
						"class"	=> $randomClass,
						"value"	=> $item_per_page,
						"default"	=> "9",
						"dont_save" => true,
						"hr"		=> true,
						"type" 	=> "rangeinput"),
			
					array(
							   "name" 	=> __("Content Layout",'rt_theme_admin'),
							   "desc" 	=> __("Please select a layout for the contents that will be displayed in this column.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_portfolio_box[]",
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
					 
					
					array(
							"name" 	=> __("Pagination",'rt_theme_admin'),
							"desc" 	=> __("Adds page navigation under the portfolio posts.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[pagination]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $pagination, 							
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"),
 

					
					array(
							"name" 	=> __("Filter Navigation",'rt_theme_admin'),
							"desc" 	=> __("Adds a filter navigation top of the items.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_portfolio_box[filterable]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $filterable, 							
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"), 

					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button"),
					
					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button"),			
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
			
			
	}

	function rt_generate_product_box($theGroupID,$theTemplateID,$options,$randomClass){
	   
				
	   
			$boxName		= __("Product Posts", "rt_theme_admin");
			$contet_type	= "product_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;
			$pagination	= $isNewBox ? ''			:	$options['pagination']	;
			$item_width	= $isNewBox ? ''			:	$options['item_width']	;
			$categories	= $isNewBox ? ''			:	@$options['categories']	;
			$list_orderby	= $isNewBox ? ''			:	$options['list_orderby'];
			$list_order	= $isNewBox ? ''			:	$options['list_order'];
			$item_per_page	= $isNewBox ? ''			:	$options['item_per_page'];
			$ajax_scroller	= $isNewBox ? ''			:	$options['ajax_scroller'];
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			

			$options = array (
					
					array(
							   "desc" => __("This module displays product posts according the options below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_product_box[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"),
	

					array(
							"name" 	=> __("Select Product Categories",'rt_theme_admin'),
							"desc" 	=> __("You can filter posts by selecting categories from this list. If you don't select one, all product posts will be displayed.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[categories][]",
							"options" => RTTheme::rt_get_product_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("sort products by this parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_product_box[list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"hr"		=> true,
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_product_box[list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true,
							"hr"		=> true,					
							"type" 	=> "select"),
	
					array(
						"name" 	=> __("Amount of product post per page",'rt_theme_admin'),
						"desc"	=> __("How many product do you want to display per page?",'rt_theme_admin'),
						"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[item_per_page]",
						"min"	=> "1",
						"max"	=> "200",
						"class"	=> $randomClass,
						"value"	=> $item_per_page,
						"default"	=> "9",
						"dont_save" => true,
						"hr"		=> true,
						"type" 	=> "rangeinput"),
			
					array(
							   "name" 	=> __("Content Layout",'rt_theme_admin'),
							   "desc" 	=> __("Please select a layout for the contents that will be displayed in this column.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_product_box[item_width]",
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
							"name" 	=> __("Pagination",'rt_theme_admin'),
							"desc" 	=> __("Adds page navigation under the product posts.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[pagination]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $pagination, 							
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"),

					array(
							"name" 	=> __("Ajax Product Sroller",'rt_theme_admin'),
							"desc" 	=> __("You can turn ON this option to activate ajax paginations. The pagination option above must be ON also to use this feature.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_product_box[ajax_scroller]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $ajax_scroller, 							
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"),					
 
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button"),
					
					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button"),			
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
			
			
	}

	
	function rt_generate_woo_products_box($theGroupID,$theTemplateID,$options,$randomClass){
	   
				
	   
			$boxName		= __("WooCommerce Products", "rt_theme_admin");
			$contet_type	= "woo_products_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$options['ajax_scroller'] = isset( $options['ajax_scroller'] ) ? $options['ajax_scroller'] : "";
			$options['pagination'] = isset( $options['pagination'] ) ? $options['pagination'] : "";
			$options['categories'] = isset( $options['categories'] ) ? $options['categories'] : ""; 


			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;
			$pagination	= $isNewBox ? ''			:	$options['pagination']	;
			$item_width	= $isNewBox ? ''			:	$options['item_width']	;
			$categories	= $isNewBox ? ''			:	$options['categories']	; 
			$list_orderby	= $isNewBox ? ''			:	$options['list_orderby'];
			$list_order	= $isNewBox ? ''			:	$options['list_order'];
			$item_per_page	= $isNewBox ? ''			:	$options['item_per_page'];
			$ajax_scroller	= $isNewBox ? ''			:	$options['ajax_scroller'];
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			

			$options = array (
					
					array(
							   "desc" => __("This module displays WooCommerce products according the options below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"),
	

					array(
							"name" 	=> __("Select a WooCommerce Product Category",'rt_theme_admin'),
							"desc" 	=> __("You need to select a category from the list below. ",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_woo_products_box[categories]",
							"options" => RTTheme::rt_get_woo_product_categories(),
							"purpose" => "sidebar",
							"type"	=> "select",
							"class"	=> $randomClass,
							"default"	=> $categories,							
							"value"	=>$categories,),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("sort your portfolio by this parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"hr"		=> true,
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true,
							"hr"		=> true,					
							"type" 	=> "select"),
	
					array(
						"name" 	=> __("Amount of products",'rt_theme_admin'),
						"desc"	=> __("How many product do you want to display in this box?",'rt_theme_admin'),
						"id" 	=> $theTemplateID.'_'.$theGroupID."_woo_products_box[item_per_page]",
						"min"	=> "1",
						"max"	=> "200",
						"class"	=> $randomClass,
						"value"	=> $item_per_page,
						"default"	=> "9",
						"dont_save" => true,
						"hr"		=> true,
						"type" 	=> "rangeinput"),
			
					array(
							   "name" 	=> __("Content Layout",'rt_theme_admin'),
							   "desc" 	=> __("Please select a layout for the contents that will be displayed in this column.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[item_width]",
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
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button"),
					
					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button"),			
					
					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
			
			
	}
	
	
	function rt_generate_homepage_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Home Page Post", "rt_theme_admin");
			$contet_type	= "home_page_content";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;
			$content_id	= $isNewBox ? ''			:	$options['content_id']	;
			
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (

					array(
							   "name" => __("Select Box Size",'rt_theme_admin'),
							   "desc" => __("Please select a box size for the content.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_home_page_box[]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"
					),
					
					
					array(
							   "name" => __("Select Box Content",'rt_theme_admin'),
							   "desc" => __("Please select a home page post for this box.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_home_page_box[]",
							   "options" =>	RTTheme::rt_get_homecontents(),
							   "class"=>$randomClass,
							   "value"=>$content_id, 
							   "hr" => "true",
							   "type" => "select", 
					),
			
			
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),

					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button"
					),					
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}	



	function rt_generate_sidebar_box($theGroupID,$theTemplateID,$options,$randomClass){
			global $UserSidebarIDs;

			$boxName		= __("Sidebar", "rt_theme_admin");
			$contet_type	= "sidebar_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity			= 1;
			$layout				= $isNewBox ? 'full expanded"': 	$options['layout']			;	
			$position			= $isNewBox ? 'open minus'	:	'plus'					;
			$data_position		= $isNewBox ? ''			:	'display: none;'			;
			$sidebar_id			= $isNewBox ? ''			:	$options['sidebar_id']		;
			$widget_box_width	= $isNewBox ? ''			:	$options['widget_box_width']	; 
			
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (

					array(
							   "desc" => __("This module displays a sidebar (widget area) according the options below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_sidebar_box[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"
					),

					array(
							   "name" => __("Select Sidebar (Widget Area)",'rt_theme_admin'),
							   "desc" => __("select the sidebar you want to display in this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_sidebar_box[sidebar_id]",
							   "options" => $UserSidebarIDs->sidebars,
							   "class"=>$randomClass,
							   "value"=>$sidebar_id, 
							   "hr" => "true",
							   "type" => "select", 
					),

					array(
							   "name" => __("Select Widgets Size",'rt_theme_admin'),
							   "desc" => __("Please select a layout for the widgets that will be displayed in this column.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_sidebar_box[widget_box_width]",
							   "options" =>	array(
													5 => "1/5", 
													4 => "1/4",
													3 => "1/3",
													2 => "1/2",
													1 => "1/1"									
										    ),
							   "default"=>"1",
							   "value"=>$widget_box_width,
							   "hr" => "true",
							   "type" => "select"
					), 				

					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),

					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button"),
					);


			echo  $this->rt_generate_forms($options);

			echo  '</div></div></div></li>';

	}



	function rt_generate_google_map($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Google Map", "rt_theme_admin");
			$contet_type	= "google_map";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;	 
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
  					
					array(
							   "desc" 	=> __("You can use this module to display a Google Map.",'rt_theme_admin'),	 
							   "hr" 		=> "true",
							   "type" 	=> "info_text_only"),

					
 					array(
							   "name" => __("Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_google_map[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"
					),

					array(
							"name" 		=> __("Map URL",'rt_theme_admin'), 
							"desc"		=> __('You can generate your own map code from <a href="http://maps.google.com">http://maps.google.com</a>  Find your address on the map, then click the link icon top of the Google Maps page and copy the embed code from the "Paste HTML to embed in website" field. If you customize the map, your height and width values will be ignored. You can choose a map height from the option below.','rt_theme_admin'),							
							"id" 		=> $theTemplateID.'_'.$theGroupID."_google_map[map_url]",
							"value"		=> @$options["map_url"],  
							"type" 		=> "textarea" 
					),		

					array(
							"name" 		=> __("Height of the map",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_google_map[height]", 
							"hr" 		=> "true",
							"min"		=>"1",
							"max"		=>"800",
							"default"		=>"200",
							"hr"			=> true,
							"dont_save"	=> true,
							"value"		=> @$options["height"],  
							"class"		=> $randomClass,
							"type"		=> "rangeinput"),
 
					
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),


					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button",
					)
					
										
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}


	function rt_generate_contact_form($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Contact Form", "rt_theme_admin");
			$contet_type	= "contact_form";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;	 
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
  					array(
							   "desc" => __("You can use this module to add a contact form.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
 					array(
							   "name" => __("Select Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_contact_form[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"
					),

					
					array(
							"name" => __("Module Title",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_form[title]",
							"value"=>@$options["title"], 
							"type" => "text"),

					array(
							"name" 		=> __("Description",'rt_theme_admin'),
							"id" 		=> $theTemplateID.'_'.$theGroupID."_contact_form[description]",
							"value"		=>@$options["description"], 
							"type" 		=> "textarea" 
					),							
		
					array(
							"name" 	=> __("Contact Form Email",'rt_theme_admin'),
							"desc" 	=> __("the contact form will be submited this email",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_contact_form[email]",
							"default"	=> get_option('admin_email'),
							"dont_save"=> true,
							"value"	=>@$options["email"], 
							"type" 	=> "text"),

					array(
							"name" 	=> __("OR",'rt_theme_admin'), 
							"type" 	=> "heading"),
		
					array(
							"name" 	=> __("3rd Party Contact Form Plugin",'rt_theme_admin'),
							"desc" 	=> __('You are free to use 3rd party contact form plugins on the contact box. There are great contact form plugins on the <a href="http://wordpress.org/extend/plugins/">WordPress plugins page</a> like <a href="http://wordpress.org/extend/plugins/contact-form-7/">Contact Form 7</a>. Paste the plugin shortcode in the box below to use it instead of the default form.','rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_contact_form[shortcode]",
							"value"	=>@$options["shortcode"], 
							"hr" => "true",
							"type" 	=> "textarea"),			 
 		 
					
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),


					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button",
					)
					
										
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}

	function rt_generate_contact_info_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Contact Info", "rt_theme_admin");
			$contet_type	= "contact_info_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;	 
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
 					array(
							   "desc" => __("You can use this module to add your contact details with icons.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
 					array(
							   "name" => __("Select Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"
					),

					array(
							"name" => __("Module Title",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[contact_title]",
							"hr" => "true",
							"value"=>@$options["contact_title"],
							"type" => "text"),
					
					array(
							"name" => __("Text",'rt_theme_admin'),
							"desc" => __("adds a text before the contact details.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[contact_text]",
							"hr" => "true",
							"value"=>@$options["contact_text"],
							"type" => "textarea"),
					
					array(
							"name" => __("Address",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[address]",
							"hr" => "true",
							"value"=>@$options["address"],
							"type" => "textarea"),
		
					array(
							"name" => __("Phone",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[phone]",
							"hr" => "true",
							"value"=>@$options["phone"], 
							"type" => "text"),
		
					array(
							"name" => __("Email",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[email]",
							"hr" => "true",
							"value"=>@$options["email"], 
							"type" => "text"),
		
					array(
							"name" => __("Support Email",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[support_email]",
							"hr" => "true",
							"value"=>@$options["support_email"], 	 
							"type" => "text"),
		
					array(
							"name" => __("Fax",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_contact_info_box[fax]",
							"value"=>@$options["fax"], 	  
							"hr"		=> true,
							"type" => "text"),  		
					
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),


					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button",
					)
					
					);
										
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}

	function rt_generate_code_box($theGroupID,$theTemplateID,$options,$randomClass){


			$boxName		= __("Code Box", "rt_theme_admin");
			$contet_type	= "code_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			
			$isNewBox = (trim($randomClass)=="") ? false : true;
			
			$opacity		= 1;
			$layout		= $isNewBox ? 'full expanded"': 	$options['layout']		;
			$position		= $isNewBox ? 'open minus'	:	'plus'				;
			$data_position	= $isNewBox ? ''			:	'display: none;'		;	 
		
			echo  '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo  '<div class="box_shadow"><div class="Itemholder"> <div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo	 '<div class="expand '.$position.'"></div><div class="move"></div></div> <div class="ItemData" style="'.$data_position.'">';
			echo  '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';
			
			$options = array (
 					array(
							   "desc" => __("You can use this module to add your Shortcodes or HTML codes",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info_text_only", 
					),
					
 					array(
							   "name" => __("Select Column Width",'rt_theme_admin'),
							   "desc" => __("Please select a column size for this module.",'rt_theme_admin'),
							   "id" => $theTemplateID.'_'.$theGroupID."_code_box[layout]",
							   "options" =>	array(
													"one"		=>		"Full Width",
													"two"		=>		"1:2 - One Second",
													"three"		=>		"1:3 - One Third",
													"four"		=>		"1:4 - One Fourth",
													"five"		=>		"1:5 - One Fifth",
													"two-three"	=>		"2:3 - Second Third",
													"three-four"	=>		"3:4 - Third Fourth",
													"four-five"	=>		"4:5 - Four Fifth",											
										    ),
							   "default"=>"one",
							   "value"=>$layout,
							   "class"=>"layout_selector",
							   "hr" => "true",
							   "type" => "select"
					),

					array(
							"name" => __("Module Title",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_code_box[heading]",
							"hr" => "true",
							"value"=>@$options["heading"],
							"type" => "text"),
					
					array(
							"name" => __("Code Space",'rt_theme_admin'),
							"desc" => __("paste your shortcode or HTML codes here",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_code_box[code_space]",
							"hr" => "true",
							"value"=>@$options["code_space"],
							"type" => "textarea"),

					array(
							"name" 	=> __("Transparent Box",'rt_theme_admin'),
							"desc" 	=> __("You can turn ON this option to use this box without background color and shadows.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_code_box[transparent]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> @$options["transparent"],					
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"),		


					array(
							"name" 	=> __("No Padding",'rt_theme_admin'),
							"desc" 	=> __("You can turn ON this option to remove paddings from this box.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_code_box[no_padding]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> @$options["no_padding"],					
							"hr"		=> true,
							"default"	=> "off",
							"std" 	=> "false"),		
					
					
					array(
							"name" => __("delete",'rt_theme_admin'),
							"id" => "_delete",
							"class" => "deleteButton template_box_delete",
							"purpose" => "page_template",
							"type" => "button",
					),


					array(
							"name" => __("close",'rt_theme_admin'),
							"id" => "_close",
							"class" => "closeButton template_box_close",
							"purpose" => "page_template",
							"type" => "button",
					)
					
					);
										
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
 
	}		
}


$RTThemePageLayoutOptionsClass = new RTThemePageLayoutOptions(); 
?>