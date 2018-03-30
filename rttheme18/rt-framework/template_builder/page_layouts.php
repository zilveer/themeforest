<?php
#-----------------------------------------
#	RT-Theme page_layouts.php
#	version: 1.0
#-----------------------------------------

#
#	Admin Class
#

class RTThemePageLayouts extends RTThemeAdmin{


	// Items
	public $rt_modules = array(
			"optgroup_start 1"=>"Layout Elements",
				"grid"=>"Content Row",
				"column"=>"Column",
			"optgroup_end 1"=>"",

			"optgroup_start 2"=>"Sliders",
				"slider_box"=>"Slider",
				"layerslider_box"=>"Layer Slider",
				"revslider_box"=>"Revolution Slider",
			"optgroup_end 2"=>"",

			"optgroup_start 3"=>"Content Elements",									
				"text_box" => "Text Box",
				"new_content_box" => "Content Box With Image",
				"content_icon_box" => "Content Box With Icon",
				"v_chained_icon_box" => "Vertical Chained Icon Boxes",
				"v_chained_image_box" => "Vertical Chained Image Boxes",
				"h_chained_image_box" => "Horizontal Chained Image Boxes",
				"tabs_box" => "Tabular Content", 
				"accordion_box" => "Accordion Content", 
				"icon_list_box" => "Lists With Icons", 
				"banner_box"=>"Banner Box",		
				"google_map" => "Google Map",
				"heading_bar"=>"Heading Bar",
			"optgroup_end 3"=>"",

			"optgroup_start 6"=>"Contents",	
				"blog_box" => "Blog Posts", 
				"portfolio_box" => "Portfolio",
				"product_box" => "Product Showcase", 
				"product_categories" => "Product Showcase Categories", 
				"woo_products_box" => "WooCommerce Products",	
				"woo_products_extended" => "WooCommerce Products (Extended) ",	
				"staff_box" => "Staff List",
				"testimonial_box" => "Testimonials",								
			"optgroup_end 6"=>"",

			"optgroup_start 4"=>"Carousels",	
				"product_carousel" => "Product Showcase Carousel",
				"wcproduct_carousel" => "WooCommerce Product Carousel",
				"portfolio_carousel" => "Portfolio Carousel",
				"blog_carousel" => "Blog Carousel",
				"testimonial_carousel" => "Testimonial Carousel",
			"optgroup_end 4"=>"",

			"optgroup_start 5"=>"Dynamic Contents",	
				"default_content"=>"Default Page / Post Content",	
				"sidebar_box" => "Widget Area - Sidebar",
			"optgroup_end 5"=>"",

			"optgroup_start 7"=>"Design Elements",	 							
				"space_box"=>"Space",
				"horizontal_line" => "Horizontal Line", 
			"optgroup_end 7"=>"",

			"optgroup_start 8"=>"Miscellaneous",	
				"contact_form" => "Contact Form",											
				"code_box"=>"Code Box",  
			"optgroup_end 8"=>"",			
		);


	#
	#	generates template forms and starter modules
	# 
	function generate_template_forms(){   

		//remove module if woocommerce not installed 
		if ( ! class_exists( 'Woocommerce' ) ) {
			unset($this->rt_modules["woo_products_box"]);
			unset($this->rt_modules["woo_products_extended"]);
			unset($this->rt_modules["wcproduct_carousel"]);
		}
 
		//remove module if layerslider not installed 
		if ( ! rt_check_layer_slider() ) {
			unset($this->rt_modules["layerslider_box"]);
		}  

		//remove module if revslider not installed 
		if ( ! class_exists( 'RevSlider' ) ) {
			unset($this->rt_modules["revslider_box"]);
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

		// get saved tempalates list
		$savedTemplatesList  = get_option(RT_THEMESLUG.'_template_names_array'); 	

		// costruct form arrays		
		$options = array ();  
		
		//template builder info text
		array_push($options, array(
		"name" => __("Info",'rt_theme_admin'),
		"desc" => __('Template Builder is a build-in tool that lets you create custom page templates to use with your pages or posts. You are free to edit the default templates or create as many new templates as you wish. In order to use the templates edit a page or post and select the template name from the list under "RT-THEME TEMPLATE OPTIONS" box and save the page. To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Use Template Builder".','rt_theme_admin'),
		"hr"   => "true",
		"type" => "info"
		));				

		if($savedTemplatesList){
			foreach ($savedTemplatesList as $TemplateID => $templateData) {

				// get saved templates list
				$savedTemplates = get_option(RT_THEMESLUG.'_template_names_array');		

				// get this tempalate data
				$thisTemplate = $this->get_template_data( $TemplateID );

				if( is_object( $thisTemplate )){
					// init the form
					foreach($thisTemplate->templates as $template){ 			 
						 			
							//tempalte name
							$template_name  = $templateData["name"];  

							//Start Form
							array_push($options, array(
							"type"            => "form_start",
							"template_id"     => $TemplateID,
							"form_class"      => "template_builder_form",
							"template_name"   => $template_name,
							));  

							//Hidden Value
							array_push($options, array(
							"type"            => "hidden",
							"id"              => "templateBuilder",
							"value"           => "true"
							));		

							//End Form
							array_push($options, array(
							"type"            => "form_end"
							));									 
					}		
				}		
			} 
		}		 
	
		// New Template 
		$randomnumber = rand(1000, 1000000);
		$TemplateID   = 'templateid_'.$randomnumber; 
		$templateName = $TemplateID.'_template_name';
 
		//Start Form
		array_push($options, array( 
		"type"            => "form_start",
		"template_id"     => $TemplateID,
		"form_class"      => "template_builder_form",
		"template_name"   => __("New Template #". $randomnumber ,'rt_theme_admin'), 
		));   
 
		//Start header row 
		array_push($options,  array( 
		"id"              => "templateid_".$TemplateID."_1_grid",
		"options"         => array('group_id'=>1,'part'=>'full','header_purpose'=>true,'footer_purpose'=>false,'newtemplate'=>true),
		"purpose"         => "page_layouts",
		"content_type"    => "grid", 
		"type"            => "template_item")); 
 
		//Start grid 
		array_push($options,  array( 
		"id"              => "templateid_".$TemplateID."_2_grid",
		"options"         => array('group_id'=>2,'part'=>'full','header_purpose'=>false,'footer_purpose'=>false),
		"purpose"         => "page_layouts",
		"content_type"    => "grid", 
		"type"            => "template_item")); 

		//Start footer row 
		array_push($options, array( 
		"id"              => "templateid_".$TemplateID."_3_grid",
		"options"         => array('group_id'=>3,'part'=>'full','header_purpose'=>false,'footer_purpose'=>true,'newtemplate'=>true),
		"purpose"         => "page_layouts",
		"content_type"    => "grid", 
		"type"            => "template_item")); 
   
		//End Form
		array_push($options, array(
		"type"            => "form_end"));		 


		//template builder list templates
		array_push($options, array(
			"type" => "list_templates",
			"templateID" => $TemplateID
		));				 

		$this->rt_generate_form_page($options,'template_builder',$TemplateID); 	
	}

	#
	#	generates content forms
	# 
	function generate_template_content_forms($TemplateID){ 
		$tempateClass = $this->get_template_data( $TemplateID );

		//if template data corrupted return false
		if( ! is_object( $tempateClass )){
			return ;
		}

		$options  = array();
		$contents = $tempateClass->templates[$TemplateID]->contents; 

		if(is_array($contents)){

				foreach($contents as $templateContents){
					
					//possible empty values - fix php warnings
					$templateContents->categories  = isset($templateContents->categories) ? $templateContents->categories : "";
					$templateContents->thumbs_width  = isset($templateContents->thumbs_width) ? $templateContents->thumbs_width : "";
					$templateContents->thumbs_height  = isset($templateContents->thumbs_height) ? $templateContents->thumbs_height : "";
					$templateContents->filterable  = isset($templateContents->filterable) ? $templateContents->filterable : "";
					$templateContents->list_order  = isset($templateContents->list_order) ? $templateContents->list_order : "";
					$templateContents->style = isset($templateContents->style) ? $templateContents->style : "";
					$templateContents->first_one_open = isset($templateContents->first_one_open) ? $templateContents->first_one_open : "";
					$templateContents->item_width = isset($templateContents->item_width) ? $templateContents->item_width : "";
					$templateContents->icon_color = isset($templateContents->icon_color) ? $templateContents->icon_color : "";
					$templateContents->icon_bg_color = isset($templateContents->icon_bg_color) ? $templateContents->icon_bg_color : "";
					$templateContents->icon_border_color = isset($templateContents->icon_border_color) ? $templateContents->icon_border_color : "";
					$templateContents->bw_filter = isset($templateContents->bw_filter) ? $templateContents->bw_filter : "";

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
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "portfolio_box",
								"type"         => "template_item"));
					}

					//Call portfolio carousel
					if($templateContents->content_type=="portfolio_carousel"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_portfolio_carousel",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "portfolio_carousel",
								"type"         => "template_item"));
					}					


					//Call blog carousel
					if($templateContents->content_type=="blog_carousel"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_blog_carousel",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "blog_carousel",
								"type"         => "template_item"));
					}					

					//Call Sidebar Box
					if($templateContents->content_type=="sidebar_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_sidebar_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'sidebar_id'=>$templateContents->sidebar_id, 'widget_box_width'=>$templateContents->widget_box_width),
								"purpose"      => "page_layouts",
								"content_type" => "sidebar_box",
								"type"         => "template_item"));
					}										

					//Call Default Content Box
					if($templateContents->content_type=="default_content"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_default_content",
								"options"      => array('group_id'=>$templateContents->group_id ),
								"purpose"      => "page_layouts",
								"content_type" => "default_content",
								"type"         => "template_item"));
					}
 

					//Call banner boxes
					if($templateContents->content_type=="banner_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_banner_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "banner_box",
								"type"         => "template_item"));
					}

					//Call slider boxes
					if($templateContents->content_type=="slider_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_slider_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'slider_timeout'=>$templateContents->slider_timeout, 'slider_height'=>$templateContents->slider_height, 'slider_width'=>$templateContents->slider_width, 'image_resize'=>$templateContents->image_resize, 'image_crop'=>$templateContents->image_crop, 'flex_slider_effect'=>$templateContents->flex_slider_effect, 'slides'=>$templateContents->slides),
								"purpose"      => "page_layouts",
								"content_type" => "slider_box",
								"type"         => "template_item"));
					} 	

					//Call tab boxes
					if($templateContents->content_type=="tabs_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_tabs_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'tabs_style'=>$templateContents->tabs_style, 'tab_contents'=>$templateContents->tab_contents),
								"purpose"      => "page_layouts",
								"content_type" => "tabs_box",
								"type"         => "template_item"));
					} 	

					//Call accordion boxes
					if($templateContents->content_type=="accordion_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_accordion_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'accordion_style'=>$templateContents->accordion_style, 'first_one_open'=>$templateContents->first_one_open, 'accordion_contents'=>$templateContents->accordion_contents),
								"purpose"      => "page_layouts",
								"content_type" => "accordion_box",
								"type"         => "template_item"));
					} 	
 
					//Call layerslider box 
					if($templateContents->content_type=="layerslider_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_layerslider_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'slider_id'=>$templateContents->slider_id),
								"purpose"      => "page_layouts",
								"content_type" => "layerslider_box",
								"type"         => "template_item"));
					} 	
 
					//Call layerslider box 
					if($templateContents->content_type=="revslider_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_revslider_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'slider_id'=>$templateContents->slider_id),
								"purpose"      => "page_layouts",
								"content_type" => "revslider_box",
								"type"         => "template_item"));
					} 	

					//Call product boxes
					if($templateContents->content_type=="product_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_product_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "product_box",
								"type"         => "template_item"));
					}

					//Call product categories
					if($templateContents->content_type=="product_categories"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_product_categories",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "product_categories",
								"type"         => "template_item"));
					}

					//Call woocommerce products extended
					if($templateContents->content_type=="woo_products_extended"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_woo_products_extended",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "woo_products_extended",
								"type"         => "template_item"));
					}

					//Call product carousel
					if($templateContents->content_type=="product_carousel"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_product_carousel",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "product_carousel",
								"type"         => "template_item"));
					}


					//Call woocommerce product carousel
					if($templateContents->content_type=="wcproduct_carousel"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_wcproduct_carousel",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "wcproduct_carousel",
								"type"         => "template_item"));
					}

					if ( class_exists( 'Woocommerce' ) ) {	
						//Call woo product boxes
						if($templateContents->content_type=="woo_products_box"){
							array_push($options,	array( 
								"id"           => $TemplateID."_woo_products_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'item_width'=>$templateContents->item_width, 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>$templateContents->list_order, 'categories'=>@$templateContents->categories , 'item_per_page'=>$templateContents->item_per_page),
								"purpose"      => "page_layouts",
								"content_type" => "woo_products_box",
								"type"         => "template_item"));
						}
					}

					//Call blog boxes
					if($templateContents->content_type=="blog_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_blog_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'pagination'=>$templateContents->pagination, 'list_orderby'=>$templateContents->list_orderby, 'list_order'=>@$templateContents->list_order, 'categories'=>@$templateContents->categories , 'item_per_page'=>$templateContents->item_per_page, 'list_style' => $templateContents->list_style, 'list_layout' => $templateContents->list_layout),
								"purpose"      => "page_layouts",
								"content_type" => "blog_box",
								"type"         => "template_item"));
					}
					
					//Call google map
					if($templateContents->content_type=="google_map"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_google_map",
								"options"      => array('group_id'=>$templateContents->group_id, 'module_title'=>stripslashes($templateContents->module_title), 'height'=>$templateContents->height, 'zoom'=>$templateContents->zoom, 'list'=>$templateContents->list),
								"purpose"      => "page_layouts",
								"content_type" => "google_map",
								"type"         => "template_item"));
					}															

					//Call contact form
					if($templateContents->content_type=="contact_form"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_contact_form",
								"options"      => array('group_id'=>$templateContents->group_id, 'title'=>stripslashes($templateContents->title), 'email'=>$templateContents->email, 'shortcode'=>stripslashes($templateContents->shortcode), 'text'=>stripslashes($templateContents->text)),
								"purpose"      => "page_layouts",
								"content_type" => "contact_form",
								"type"         => "template_item"));
					}


					//Call contact info box
					if($templateContents->content_type=="icon_list_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_icon_list_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'list'=>$templateContents->list, 'module_title'=>stripslashes($templateContents->module_title), 'icon_style'=>$templateContents->icon_style, 'item_width'=>$templateContents->item_width ),
								"purpose"      => "page_layouts",
								"content_type" => "icon_list_box",
								"type"         => "template_item"));
					}

					//Call heading bar
					if($templateContents->content_type=="heading_bar"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_heading_bar",
								"options"      => array('group_id'=>$templateContents->group_id, 'icon'=>$templateContents->icon, 'style'=>$templateContents->style, 'heading'=>stripslashes($templateContents->heading)),
								"purpose"      => "page_layouts",
								"content_type" => "heading_bar",
								"type"         => "template_item"));
					}	

					//Call space box
					if($templateContents->content_type=="space_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_space_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'height'=>$templateContents->height ),
								"purpose"      => "page_layouts",
								"content_type" => "space_box",
								"type"         => "template_item"));
					}																				

					//Call code box
					if($templateContents->content_type=="code_box"){
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_code_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'heading'=>stripslashes($templateContents->heading), 'code_space'=>stripslashes($templateContents->code_space),'transparent'=>stripslashes($templateContents->transparent),'no_padding'=>stripslashes($templateContents->no_padding)),
								"purpose"      => "page_layouts",
								"content_type" => "code_box",
								"type"         => "template_item"));
					}
					

					//Call grid
					if($templateContents->content_type=="grid"){ 

						array_push($options,	array( 
								"id"           => $TemplateID."_grid",
								"options"      => array('group_id'=>$templateContents->group_id,'part'=>$templateContents->part,'header_purpose' => $templateContents->header_purpose,'footer_purpose' => $templateContents->footer_purpose, 'breadcrumb' => $templateContents->breadcrumb,'header_options' => $templateContents->header_options, 'newtemplate' => $templateContents->newtemplate, 'sidebar_id' => $templateContents->sidebar_id, 'sidebar_selection' => $templateContents->sidebar_selection, 'breadcrumb_position' => $templateContents->breadcrumb_position, 'page_title' => $templateContents->page_title, 'display_widgets' => $templateContents->display_widgets, 'first_top_widget_name' => $templateContents->first_top_widget_name, 'second_top_widget_name' => $templateContents->second_top_widget_name, 'background_options' => $templateContents->background_options , 'color_set' => $templateContents->color_set, 'column_options' => $templateContents->column_options, 'row_style_options' => $templateContents->row_style_options ),
								"purpose"      => "page_layouts",
								"content_type" => "grid",
								"type"         => "template_item"));
					}

					//Call column
					if($templateContents->content_type=="column"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_column",
								"options"      => array('group_id'=>$templateContents->group_id, 'layout'=>$templateContents->layout, 'part'=>$templateContents->part,'layout' =>$templateContents->layout),
								"purpose"      => "page_layouts",
								"content_type" => "column",
								"type"         => "template_item"));
					} 

					//Call new content box
					if($templateContents->content_type=="new_content_box"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_new_content_box",
								"options"      => array('group_id'=>$templateContents->group_id,'title'=>$templateContents->title,'text'=>$templateContents->text,'featured_image'=>$templateContents->featured_image,'icon'=>$templateContents->icon,'icon_style'=>$templateContents->icon_style,'text_position'=>$templateContents->text_position,'title_position'=>$templateContents->title_position,'link'=>$templateContents->link,'link_text'=>$templateContents->link_text,'link_target'=>$templateContents->link_target,'image_style'=>$templateContents->image_style),
								"purpose"      => "page_layouts",
								"content_type" => "new_content_box",
								"type"         => "template_item"));
					}

					//Call new content box
					if($templateContents->content_type=="content_icon_box"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_content_icon_box",
								"options"      => array('group_id'=>$templateContents->group_id,'title'=>$templateContents->title,'text'=>$templateContents->text,'icon'=>$templateContents->icon,'icon_style'=>$templateContents->icon_style,'text_position'=>$templateContents->text_position,'title_position'=>$templateContents->title_position,'link'=>$templateContents->link,'link_text'=>$templateContents->link_text,'link_target'=>$templateContents->link_target, 'icon_color'=>$templateContents->icon_color, 'icon_bg_color'=>$templateContents->icon_bg_color, 'icon_border_color'=>$templateContents->icon_border_color),
								"purpose"      => "page_layouts",
								"content_type" => "content_icon_box",
								"type"         => "template_item"));
					} 

					//Call text box
					if($templateContents->content_type=="text_box"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_text_box",
								"options"      => array('group_id'=>$templateContents->group_id,'values'=>$templateContents->values ),
								"purpose"      => "page_layouts",
								"content_type" => "text_box",
								"type"         => "template_item"));
					}					

					//Call horizontal line box
					if($templateContents->content_type=="horizontal_line"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_horizontal_line",
								"options"      => array('group_id'=>$templateContents->group_id, 'style'=>$templateContents->style, 'margin_top'=>$templateContents->margin_top, 'margin_bottom'=>$templateContents->margin_bottom ),
								"purpose"      => "page_layouts",
								"content_type" => "horizontal_line",
								"type"         => "template_item"));
					}	


					//Call staff box
					if($templateContents->content_type=="staff_box"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_staff_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "staff_box",
								"type"         => "template_item"));
					}	


					//Call testimonials box
					if($templateContents->content_type=="testimonial_box"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_staff_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "testimonial_box",
								"type"         => "template_item"));
					}	


					//Call testimonials carousel box
					if($templateContents->content_type=="testimonial_carousel"){ 
						 
						array_push($options,	array( 
								"id"           => $TemplateID."_testimonial_carousel",
								"options"      => array('group_id'=>$templateContents->group_id, 'values'=>$templateContents->values),
								"purpose"      => "page_layouts",
								"content_type" => "testimonial_carousel",
								"type"         => "template_item"));
					}	

					//Call vertical chained icon boxes
					if($templateContents->content_type=="v_chained_icon_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_v_chained_icon_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'media_alignment'=>$templateContents->media_alignment, 'box_contents'=>$templateContents->box_contents),
								"purpose"      => "page_layouts",
								"content_type" => "v_chained_icon_box",
								"type"         => "template_item"));
					} 	

					//Call vertical chained image boxes
					if($templateContents->content_type=="v_chained_image_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_v_chained_image_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'media_alignment'=>$templateContents->media_alignment, 'media_style'=>$templateContents->media_style, 'box_contents'=>$templateContents->box_contents, 'bw_filter' => $templateContents->bw_filter),
								"purpose"      => "page_layouts",
								"content_type" => "v_chained_image_box",
								"type"         => "template_item"));
					} 	

					//Call horizontal chained image boxes
					if($templateContents->content_type=="h_chained_image_box"){
						
						array_push($options,	array( 
								"id"           => $TemplateID."_h_chained_image_box",
								"options"      => array('group_id'=>$templateContents->group_id, 'media_style'=>$templateContents->media_style, 'box_contents'=>$templateContents->box_contents, 'bw_filter' => $templateContents->bw_filter ),
								"purpose"      => "page_layouts",
								"content_type" => "h_chained_image_box",
								"type"         => "template_item"));
					} 	
				}
		}	


		$result = $this->rt_generate_forms($options,$TemplateID); 

		return $result;
	}

	#
	#	generates template list html
	# 
	function list_templates($newtemplateID){

		$savedTemplates = get_option(RT_THEMESLUG.'_template_names_array');
		echo '<input type="text" name="template_search" id="rt_template_search" value="" placeholder="'. __('search', 'rt_theme_admin').'"><span id="rt_template_search_result"></span>';
		echo '<ul class="list_templates rt_admin_lists">';
		if(is_array($savedTemplates)){
			foreach($savedTemplates as $templateID => $templateData){

				$icon = $templateData["is_default_template"] ? "icon-lock" : "icon-cog-alt" ;
				$delete_button = ! $templateData["is_default_template"] ? '<li class="delete_template list_delete_button" data-scope="delete" data-templateid="'.$templateID.'"><span class="icon-cancel"></span> '. __("Delete",'rt_theme_admin') .'</li>' : '<li class="delete_template list_delete_button locked" data-scope="none" data-templateid="'.$templateID.'"><span class="icon-lock"></span> '. __("Delete",'rt_theme_admin') .'</li>';


				echo '<li class="'.$templateID.'" data-templateid="'.$templateID.'" data-templatename="'.$templateData["name"].'">

						<div class="template_meta"><span class="'.$icon.'"></span> <div class="template_id"><span>'.$templateID.'</span><br />'.$templateData["name"].'</div>  </div>

						<ul class="template_controls rt_admin_list_controls">
							<li data-scope="edit-template" data-templateid="'.$templateID.'">
								<span class="icon-edit"></span> '. __("Edit",'rt_theme_admin') .'
							</li>

							'. $delete_button .'

							<li data-scope="clone" data-templateid="'.$templateID.'">
								<span class="icon-magic"></span> '. __("Clone",'rt_theme_admin') .'
							</li>											

							<li data-scope="export-single-template" data-templateid="'.$templateID.'">
								<form action="?page=rt_template_options&templateBuilder=true&export_template=true&selectedTemplate='.$templateID.'" method="post"><span class="icon-upload"></span> '. __("Export",'rt_theme_admin') .'</form>
							</li>

						</ul>


				</li>';
			}
		}			

			
		echo '
		</ul> 

		<ul class="template_builder_buttons">
			<li><button type="button" class="new_template list_new_item template_button light icon-plus-squared-1" data-scope="create-template" data-templateid="'.$newtemplateID.'">'. __("Create New Template",'rt_theme_admin') .'</button></li>
			<li><button type="button" class="import_template list_new_item template_button light icon-download" data-scope="import-template" data-templateid="'.$newtemplateID.'">'. __("Import Templates",'rt_theme_admin') .'</button></li>
			<li><form action="?page=rt_template_options&templateBuilder=true&export_template=true" method="post"> <button type="submit" class="export_template list_new_item template_button light icon-upload" data-scope="export-template" data-templateid="'.$newtemplateID.'">'. __("Export All Templates",'rt_theme_admin') .'</button></form></li>			
			<li><form action="?page=rt_template_options&templateBuilder=true&reset_settings=true" method="post"><button type="submit" class="reset_template template_button light icon-trash-1" data-scope="reset-template">'. __("Reset Template Builder",'rt_theme_admin') .'</button></form></li>			
		</ul>
		';
 

		//import form
		$file_byte = wp_max_upload_size() ;
		$file_size = size_format( $file_byte );
		$wp_upload_dir = wp_upload_dir();

		//check if multisite
		$multisite_notice = "";
		if ( is_multisite() ) { 
			$multisite_notice = '
				<strong>PLEASE NOTE 2: </strong>
				You need to add "txt" in your allowed file types list before upload the file if it does not exist. 
				For further reading: http://premium.wpmudev.org/blog/how-to-change-the-allowed-file-upload-types-in-wordpress-multisite/
			';
		}

		if ( ! empty( $wp_upload_dir['error'] ) ){
			echo "<h3>ERROR:</h3><br />".__($wp_upload_dir['error'],'rt_theme_admin');
		}else{

	 		echo '
	 			<div class="import_tempalte">

					<h3 class="page_title">'.__('Import Templates','rt_theme_admin').'</h3>
					
					<div class="import_desc">

						<p>Upload your templates (txt) file and to import the templates. <br /> 
						<strong>PLEASE NOTE: </strong> This tool will only import the templates. You need to upload your images that used within templates and correct the image urls by manually after templates imported.</p> 


						'.$multisite_notice.'


					</div>
	 
					<form action="?page=rt_template_options&templateBuilder=true&import_template=true" method="post" enctype="multipart/form-data">
					<p>
						<label for="upload">Choose a file from your computer:</label> '.sprintf( __('Maximum size: %s', "rt_theme_admin" ), $file_size ).'
						<input type="file" size="25" name="import" id="upload">
						<input type="hidden" value="save" name="action">
						<input type="hidden" value="'.$file_byte.'" name="max_file_size">
					</p>

					<p class="submit"><input type="submit" value="Upload file and import" class="button" id="import_templates_submit" name="submit"></p>

					</form>

				</div>
			';

		}	
  		
  		//hidden copied module holder
  		echo '<div id="copied_module"></div>';
	}	

	#
	#	generates UI grid
	# 
	function create_grid($templateID, $templateName, $class = "", $part = "full"){

		if( $part == "full" || $part == "first" ){
 

			//module select box
			$module_select_box = "";
			foreach($this->rt_modules as $module_id => $module_name){					

				if( strpos( $module_id, "optgroup_start" ) !== false ){
				    $module_select_box .=  '<optgroup label="'.$module_name.'">';
				}elseif( strpos( $module_id,"optgroup_end" ) !== false ){					
					$module_select_box .= '</optgroup>';
				}else{ 
					$module_select_box .= '<option value="'.$module_id.'">'.$module_name.'</option>'; 
				}
			} 
			$module_select_box = '<select name="module_list" class="module_list"><option value="0" selected>'. __("Select Module","rt_theme_admin") .'</option>'.$module_select_box.'</select>';


			echo '

				<div class="rt_modal">
				
					<div class="window_bar"> 
					
						<div class="title"> <input id="'.$templateID.'_template_name" type="text" value="'.$templateName.'" name="'.$templateID.'_template_name"> </div> 

						<div class="left">
							<div class="module_select_box">  
								'.$module_select_box.'
							</div>  

							<div class="module_add_button">  
								<span class="icon-plus-squared-1">'. __("Add Module","rt_theme_admin") .'</span>
							</div>

							<div class="module_paste_button">  
								<span class="icon-paste">'. __("Paste","rt_theme_admin") .'</span>
							</div>							

						</div>

						<div id="footer_submit" class="rt_modal_save rt_modal_control" title="'. __("Save Template","rt_theme_admin") .'">
							<span class="icon-floppy"></span> '. __("Save Template","rt_theme_admin") .'
						</div>					 				
	 
						<div class="rt_modal_close rt_modal_control" title="'. __("Close","rt_theme_admin") .'">
							<span class="icon-cancel"></span>
						</div>					 
					</div>

					<div class="modal_content">
					<div class="modules_holder"> 
			';	
		}

		if( $part == "full" || $part == "second" ){
			echo '
				</div></div></div>
			';
		}
	}	

	#
	#	retrives template data 
	#	@return class
	# 
	function get_template_data( $TemplateID ){
		global $wpdb;

		// get this tempalate stored data
		$thisTemplate = get_option(RT_THEMESLUG.'_'.$TemplateID); 	 

		// check if this templated stored as encoded
		$isthisEncoded = get_option(RT_THEMESLUG.'_'.$TemplateID.'_encoded'); 	 		

		if( $isthisEncoded == "true" ){
			
			//decode and unserialize the object 
			$thisTemplate = @unserialize( base64_decode( $thisTemplate ) );
		}

		//check if it is object & return the object 
		if( is_object( $thisTemplate ) ){
			return $thisTemplate;
		}

		//seems something wrong with the data - try to fix the data from db directly
		$f_name = RT_THEMESLUG.'_'.$TemplateID;
		$thisTemplate = $this->fix_serialized_object( $wpdb->get_var("select option_value from ".$wpdb->prefix."options where option_name = '{$f_name}' ") ) ;
 
		if( is_object( $thisTemplate ) ){
			return $thisTemplate;
		}

		return ;
	}	

	#
	#	fixes if a serialized object data corrupoted
	#	@return var
	# 
	function fix_serialized_object( $data ){

		global $wpdb; 
		 
		if( is_array( $data ) ){
			return $data;
		}

		// seems something wrong with the data - try to fix
		$data = preg_replace_callback('/s:(\d+):"(.*?)";/s',create_function('$matches','return "s:".strlen($matches[2]).":\"".( $matches[2] )."\";";'), $data );
		$data = @unserialize( $data ); 
 
		if( $data === false ){	
			return ;
		}

		if( $data != false && is_object( $data ) ){	
			return $data;
		}

		return ;		

	}	


	#
	#	fixes if a serialized array data corrupoted
	#	@return var
	# 
	function fix_serialized_array( $data ){
		global $wpdb; 
		 
		if( is_array( $data ) ){
			return $data;
		}

		// seems something wrong with the data - try to fix
		$data = preg_replace_callback('/s:(\d+):"(.*?)";/s',create_function('$matches','return "s:".strlen($matches[2]).":\"".( $matches[2] )."\";";'), $data );
		$data = @unserialize( $data ); 
 
		if( $data === false  ){	
			return ;
		}

		if( $data != false && is_array( $data ) ){	
			return $data;
		}

		return ;
	}	

}

$pageLayoutClass = new RTThemePageLayouts();
 
?>