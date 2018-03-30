<?php
#-----------------------------------------
#	RT-Theme admin.php
#	version: 1.0
#-----------------------------------------

#
#	Admin Class
#

class RTThemePageLayouts extends RTThemeAdmin{
	
 
	function __construct(){   
  
		// Items
		$rt_items          = array("slider_box"=>"Slider","revolution_box"=>"Revolution Slider","blog_box" => "Blog Posts","contact_info_box" => "Contact Info","contact_form" => "Contact Form","google_map" => "Google Map","all_content_boxes" => "Home Page Content","portfolio_box" => "Portfolio","product_box" => "Product","woo_products_box" => "WooCommerce Products","sidebar_box" => "Widget Area - Sidebar","default_content"=>"Default Content + Page Title","banner_box"=>"Banner Box","heading_bar"=>"Heading Bar","code_box"=>"Code Box");

		//remove module if woocommerce not installed 
		if ( ! class_exists( 'Woocommerce' ) ) {
			unset($rt_items["woo_products_box"]);
		}

		// Pages
		$rt_getpages       = RTTheme::rt_get_pages();   
		
		// Categories
		$rt_getcat         = RTTheme::rt_get_categories();		
		
		// Product Categories		
		$rt_product_getcat = RTTheme::rt_get_product_categories();		 

		// Woo Product Categories	
		if ( class_exists( 'Woocommerce' ) ) {					
			$rt_woo_product_getcat = RTTheme::rt_get_woo_product_categories();
		}

		// reset query	   
		wp_reset_query();
		
		// get saved values
		$savedTemplates    = get_option('rt_page_layouts'); 	

		// costruct form arrays		
		$options = array ();  
		
		//template builder info text
		array_push($options, array(
		"name" => __("Info",'rt_theme_admin'),
		"desc" => __('Template Builder is a built-in tool that lets you create custom page templates to use with your pages or posts. You are free to edit the default templates or create a new one as you wish. In order to use this templates edit a page or post and select the template name from the list under "RT-THEME TEMPLATE OPTIONS" box and save the page.  To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Use Template Builder".','rt_theme_admin'),
		"hr"   => "true",
		"type" => "info"
		));		
				
		if($savedTemplates){
			foreach($savedTemplates->templates as $template){
		 
				
							$TemplateID         =	$template->templateID;
							$template_name		=	$template->templateName;
							$lineUp			=	isset($template->lineup) ? $template->lineup : "";
							
			  
							    //Temlates Div
								array_push($options, array(
								"id"              => "div_".$TemplateID,
								"name"            => $template_name,
								"type"            => "div"));
								
								//Template Name
								array_push($options, array(
								"name"            => __("Template Name",'rt_theme_admin'),
								"value"           => $template_name,
								"id"              => $TemplateID."_template_name",
								"class"           => "sidebar_name saved",
								"hr"              => "true", 
								"type"            => "text"));
								
								//Sidebar selection
								array_push($options,	array(
								"name"            => __("Select a Page Layout",'rt_theme_admin'),
								"id"              => $TemplateID."_sidebarSelection",
								"options"         => array("full"=>"Full Width","left"=>"Left Sidebar","right"=>"Right Sidebar"), 
								"value"           => $template->sidebar, 
								"purpose"         => "page_layouts",
								"hr"              => "true",
								"class"			=> "layout_selector",
								"type"            => "radio")); 
								
								//Create Item Select List
								array_push($options,	array(
								"name"            => __("Module List",'rt_theme_admin'),
								"id"              => $TemplateID."_item_list",
								"options"         => $rt_items, 
								"default"         => "", 
								"purpose"         => "sidebar", 
								"sidebuttonName"  => "Add",
								"sidebuttonClass" => "rt_template_item_add_button add_button",  
								"type"            => "select"));
								
								//Heading 
								array_push($options,	array(
								"name"            => __("Modules",'rt_theme_admin'),
								"id"              => $TemplateID."_header", 
								"default"         => "", 
								"purpose"         => "page_layouts",
								"type"            => "heading"));
								
								//Create Grid First Part
								array_push($options,	array( 
								"id"              => $TemplateID."_grid",  
								"purpose"         => "page_layouts",
								"type"            => "grid",
								"part"            => "first"));		
								
												if(isset($template->contents) && is_array($template->contents)){
														foreach($template->contents as $templateContents){
															
															//possible empty values - fix php warnings
															$templateContents->categories  = isset($templateContents->categories) ? $templateContents->categories : "";
															$templateContents->thumbs_width  = isset($templateContents->thumbs_width) ? $templateContents->thumbs_width : "";
															$templateContents->thumbs_height  = isset($templateContents->thumbs_height) ? $templateContents->thumbs_height : "";
															$templateContents->filterable  = isset($templateContents->filterable) ? $templateContents->filterable : "";
															$templateContents->list_order  = isset($templateContents->list_order) ? $templateContents->list_order : "";

															//Call Home Page Box
															if($templateContents->content_type=="home_page_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_home_page_contents",
																		"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'content_id'=>$templateContents->content_id ),
																		"purpose"      => "page_layouts",
																		"content_type" => "home_page_box",
																		"type"         => "template_item"));
															}
															
															//Call Portfolio Posts
															if($templateContents->content_type=="portfolio_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_portfolio_posts",
																		"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'categories'=>@$templateContents->categories, 'pagination'=>$templateContents->pagination ,'item_width'=>$templateContents->item_width , 'portf_list_orderby'=>$templateContents->portf_list_orderby, 'portf_list_order'=>$templateContents->portf_list_order , 'item_per_page'=>$templateContents->item_per_page , 'filterable'=>$templateContents->filterable ),
																		"purpose"      => "page_layouts",
																		"content_type" => "portfolio_box",
																		"type"         => "template_item"));
															}
					
															//Call Sidebar Box
															if($templateContents->content_type=="sidebar_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_sidebar_box",
																		"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'sidebar_id'=>$templateContents->sidebar_id, 'widget_box_width'=>$templateContents->widget_box_width),
																		"purpose"      => "page_layouts",
																		"content_type" => "sidebar_box",
																		"type"         => "template_item"));
															}										
					
															//Call Default Content Box
															if($templateContents->content_type=="default_content"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_default_content",
																		"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'heading'=>$templateContents->heading),
																		"purpose"      => "page_layouts",
																		"content_type" => "default_content",
																		"type"         => "template_item"));
															}

															
															//Call All content boxes
															if($templateContents->content_type=="all_content_boxes"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_all_content_boxes",
																		"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'content_id'=>$templateContents->content_id, 'item_width'=>$templateContents->item_width , 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>$templateContents->list_order ),
																		"purpose"      => "page_layouts",
																		"content_type" => "all_content_boxes",
																		"type"         => "template_item"));
															}

															//Call banner boxes
															if($templateContents->content_type=="banner_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_banner_box",
																		"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'text'=>stripslashes($templateContents->text), 'button_text'=>$templateContents->button_text, 'button_link'=>$templateContents->button_link),
																		"purpose"      => "page_layouts",
																		"content_type" => "banner_box",
																		"type"         => "template_item"));
															}

															//Call slider boxes
															if($templateContents->content_type=="slider_box"){
																
																array_push($options,	array( 
																		"id"           => $TemplateID."_slider_box",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout,  'slider_script'=>$templateContents->slider_script, 'content_id'=>$templateContents->content_id, 'slider_timeout'=>$templateContents->slider_timeout, 'slider_height'=>$templateContents->slider_height, 'image_resize'=>$templateContents->image_resize, 'image_crop'=>$templateContents->image_crop, 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>$templateContents->list_order, 'slider_buttons'=>$templateContents->slider_buttons, 'slider_thumbs'=>$templateContents->slider_thumbs, 'thumbs_width'=>$templateContents->thumbs_width, 'thumbs_height'=>$templateContents->thumbs_height, 'slider_effect'=>$templateContents->slider_effect),
																		"purpose"      => "page_layouts",
																		"content_type" => "slider_box",
																		"type"         => "template_item"));
															} 	


															//Call revolution slider boxes
															if($templateContents->content_type=="revolution_box"){
																
																array_push($options,	array( 
																		"id"           => $TemplateID."_revolution_box",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout,  'slider_id'=>$templateContents->slider_id),
																		"purpose"      => "page_layouts",
																		"content_type" => "revolution_box",
																		"type"         => "template_item"));
															} 	

  
															//Call product boxes
															if($templateContents->content_type=="product_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_product_box",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout,  'item_width'=>$templateContents->item_width, 'ajax_scroller'=>@$templateContents->ajax_scroller, 'pagination'=>$templateContents->pagination, 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>$templateContents->list_order, 'categories'=>@$templateContents->categories , 'item_per_page'=>$templateContents->item_per_page),
																		"purpose"      => "page_layouts",
																		"content_type" => "product_box",
																		"type"         => "template_item"));
															}
															
															if ( class_exists( 'Woocommerce' ) ) {	
																//Call woo product boxes
																if($templateContents->content_type=="woo_products_box"){
																	array_push($options,	array( 
																			"id"           => $TemplateID."_woo_products_box",
																			"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout,  'item_width'=>$templateContents->item_width, 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>$templateContents->list_order, 'categories'=>@$templateContents->categories , 'item_per_page'=>$templateContents->item_per_page),
																			"purpose"      => "page_layouts",
																			"content_type" => "woo_products_box",
																			"type"         => "template_item"));
																}
															}

															//Call blog boxes
															if($templateContents->content_type=="blog_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_blog_box",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout, 'pagination'=>$templateContents->pagination, 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>@$templateContents->list_order, 'categories'=>@$templateContents->categories , 'item_per_page'=>$templateContents->item_per_page),
																		"purpose"      => "page_layouts",
																		"content_type" => "blog_box",
																		"type"         => "template_item"));
															}
															
															//Call google map
															if($templateContents->content_type=="google_map"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_google_map",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout, 'map_url'=>stripslashes($templateContents->map_url), 'height'=>$templateContents->height),
																		"purpose"      => "page_layouts",
																		"content_type" => "google_map",
																		"type"         => "template_item"));
															}															

															//Call contact form
															if($templateContents->content_type=="contact_form"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_contact_form",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout, 'title'=>stripslashes($templateContents->title), 'email'=>$templateContents->email, 'shortcode'=>stripslashes($templateContents->shortcode), 'description'=>stripslashes($templateContents->description)),
																		"purpose"      => "page_layouts",
																		"content_type" => "contact_form",
																		"type"         => "template_item"));
															}


															//Call contact info box
															if($templateContents->content_type=="contact_info_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_contact_info_box",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout, 'contact_title'=>stripslashes($templateContents->contact_title), 'contact_text'=>stripslashes($templateContents->contact_text),'address'=>stripslashes($templateContents->address), 'phone'=>stripslashes($templateContents->phone), 'email'=>stripslashes($templateContents->email), 'support_email'=>stripslashes($templateContents->support_email),'fax'=>stripslashes($templateContents->fax)),
																		"purpose"      => "page_layouts",
																		"content_type" => "contact_info_box",
																		"type"         => "template_item"));
															}

															//Call heading bar
															if($templateContents->content_type=="heading_bar"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_heading_bar",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout, 'heading'=>stripslashes($templateContents->heading)),
																		"purpose"      => "page_layouts",
																		"content_type" => "heading_bar",
																		"type"         => "template_item"));
															}															

															//Call code box
															if($templateContents->content_type=="code_box"){
																 
																array_push($options,	array( 
																		"id"           => $TemplateID."_code_box",
																		"options"      => array('group_id'=>$templateContents->group_id,'layout'=>$templateContents->layout, 'heading'=>stripslashes($templateContents->heading), 'code_space'=>stripslashes($templateContents->code_space),'transparent'=>stripslashes($templateContents->transparent),'no_padding'=>stripslashes($templateContents->no_padding)),
																		"purpose"      => "page_layouts",
																		"content_type" => "code_box",
																		"type"         => "template_item"));
															}																		
														}
												}	
									

								//Create Grid Second Part
								array_push($options,	array( 
									"id"        => $TemplateID."_grid",  
									"purpose"   => "page_layouts",
									"type"      => "grid",
									"part"      => "second"
								)); 

								//Delete Button
								if(// user can't delete default templates
								$TemplateID !="templateid_001" && 
								$TemplateID !="templateid_002" && 
								$TemplateID !="templateid_003" && 
								$TemplateID !="templateid_004" && 
								$TemplateID !="templateid_005" 
								){
								array_push($options,array(
									"name"      => __("Delete Template",'rt_theme_admin'),
									"id"        => $TemplateID."_delete",
									"class"     => "deleteButton deteleTemplateButton",
									"purpose"   => "sidebar",
									"type"      => "button"
								));
								}							
								
								//Sidebar Divend
								array_push($options, array(
									"id"        => "",
									"type"      => "divend"
								));
					 
			}
		}		 
	
		// New Sidebar
		 
		$templateID   ='templateid_'.rand(1000, 1000000); 
		$templateName =$templateID.'_template_name';
		
		
		//Sidebar Div
		array_push($options, array(
		"name"            => __("Create New Template",'rt_theme_admin'), 
		"id"              => "div_".$templateID,
		"class"           => "new_sidebar",
		"type"            => "div"));		
		
		//Template Names
		array_push($options, array(
		"name"            => __("Template Name",'rt_theme_admin'),
		"value"           => "",
		"class"           => "sidebar_name",
		"hr"              => "true",
		"id"              => $templateName,
		"type"            => "text"));	   
		
		
		//Sidebar selection
		array_push($options,	array(
		"name"            => __("Select a Page Layout",'rt_theme_admin'),
		"id"              => $templateID."_sidebarSelection",
		"options"         => array("full"=>"Full Width","left"=>"Left Sidebar","right"=>"Right Sidebar"), 
		"value"           => "full", 
		"purpose"         => "page_layouts",
		"class"			=> "layout_selector",
		"hr"              => "true",
		"type"            => "radio"));
		
		
		//Create Item Select List
		array_push($options,	array(
		"name"            => __("Module List",'rt_theme_admin'),
		"id"              => $templateID."_item_list",
		"options"         => $rt_items, 
		"default"         => "", 
		"purpose"         => "sidebar", 
		"sidebuttonName"  => "Add",
		"sidebuttonClass" => "rt_template_item_add_button add_button",  
		"type"            => "select"));  
		
		//Heading 
		array_push($options,	array(
		"name"            => __("Modules",'rt_theme_admin'),
		"id"              => $templateID."_header", 
		"default"         => "", 
		"purpose"         => "page_layouts",
		"type"            => "heading"));
		
		//Create Grid
		array_push($options,	array( 
		"id"              => $templateID."_grid",  
		"purpose"         => "page_layouts",
		"type"            => "grid",
		"part"            => "full"));
		
		//Send button
		array_push($options,	array(
		"name"            => __("Create Template",'rt_theme_admin'),
		"id"              => $templateID."_send_button",
		"class"           => "create_button",
		"purpose"         => "page_layouts",  
		"type"            => "send_button"));
		
		//Sidebar Divend
		array_push($options, array(
		"id"              => "",
		"type"            => "divend"));
			
	
					
		$this->rt_generate_form_page($options); 	
	}

}

$pageLayoutClass = new RTThemePageLayouts();

?>