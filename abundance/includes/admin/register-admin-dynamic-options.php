<?php


$elements[] =	array(	
				"dynamic"		=> 'blog',
				"name" 			=> "Blog",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_blog", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(
										
						
						array(	"name" 	=> "<strong>A Blog section will be added to the page. Bellow you can choose some blog settings:</strong><br/><br/>Which categories should be used for the blog?",
								"desc" 	=> "You can select multiple categories here. If left empty all categories will be displayed",
					            "id" 	=> "dynamic_blog_cats",
					            "type" 	=> "select",
								"slug"	=> "",
	            				"multiple"=>6,
					            "subtype" => "cat"),
					            
					   array(	"name" 	=> "Preview Image size?",
								"desc" 	=> "You can choose between small, medium and big image size",
					            "id" 	=> "dynamic_blog_image_size",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "small",
								"no_first"=>true,
					            "subtype" => array('small'=>'small','medium'=>'medium','big'=>'big')),	
					            
						array(	"name" 	=> "Show Pagination?",
								"desc" 	=> "Should the title of the entry be displayed as well?",
					            "id" 	=> "dynamic_blog_pagination",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "yes",
								"no_first"=>true,
					            "subtype" => array('yes'=>'yes','no'=>'no')),
					   
					   array(	"name" 	=> "Posts per page?",
								"desc" 	=> "How many posts should be displayed?",
					            "id" 	=> "dynamic_blog_posts_per_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "3",
								"no_first"=>true,
					            "subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','All'=>"-1")),       
					            
									
				)
			);


	$column_element = array();
	$columns = 4;
							
	for ($i = 1; $i <= $columns; $i++)
	{
		$requirement = $i;
		if($requirement < 2) $requirement = 2;
	
	//start column	
	$column_element[] = array(	"slug"	=> "", "type" => "visual_group_start", "id" => "vg".$i, "nodescription" => true, 'class'=>'avia_pseudo_sortable', "required" => array('dynamic_column_count','{higher_than}'.$requirement) );
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Column ".$i." Content:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i,
		"type" 	=> "select",
		"std" 	=> "page",
		"subtype" => array('Single Page'=>'page','Post from Category'=>'cat','Widget'=>'widget','Direct Text input'=>'textarea')
	);
		
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Page:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page",
		"type" 	=> "select",
		"std" 	=> "",
		"required" => array('dynamic_column_content_'.$i,'page'),
		"subtype" => 'page'
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "How do you want to display the page?",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page_display",
		"type" 	=> "select",
		"std" 	=> "img_post",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'page'),
		"subtype" => array('Preview Image and post content' => 'img_post', 'Preview Image and post title' => 'img_title', 'Only preview Image' => 'img', 'Only post Content' => 'post')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Post from Category:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat",
		"type" 	=> "select",
		"std" 	=> "",
		"required" => array('dynamic_column_content_'.$i,'cat'),
		"subtype" => 'cat'
	);
	
	
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "How do you want to display the post?",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat_display",
		"type" 	=> "select",
		"std" 	=> "img_post",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'cat'),
		"subtype" => array('Preview Image and post content' => 'img_post', 'Preview Image and post title' => 'img_title', 'Only preview Image' => 'img', 'Only post Content' => 'post')
	);
	
		$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Overwrite default Link",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat_link",
		"type" => "text",
		"std" 	=> "http://",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'cat')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Overwrite default Link",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page_link",
		"type" => "text",
		"std" 	=> "http://",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'page')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Enter a widget area name (no special characters) - Once you have saved this template head over to <a href='widgets.php'>Appearance &raquo; Widgets</a> and add some widgets to the Widget area.",
		"class" => 'avia_dynamic_template_widget',
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_widget",
		"type" => "text",
		"required" => array('dynamic_column_content_'.$i,'widget')
		);
	
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Enter text here:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_textarea",
		"required" => array('dynamic_column_content_'.$i,'textarea'),
		"type" 	=> "textarea");
		
	$column_element[] = array(	"slug"	=> "", "type" => "visual_group_end", "id" => "vg".$i."_end", "nodescription" => true );
	// end column
	
	}
	
	

	

$elements[] =	array(	
				"dynamic"		=> 'columns',
				"name" 			=> "Columns",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_columns", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  	=> 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	
								"slug"	=> "",
								"name" 	=> "Select how many columns you want to display, then choose the column width and content: <br/> (Please be aware that the dual sidebar layout has limitations and is only able to display 2 columns of equal height)",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_count",
								"type" 	=> "select",
								"no_first"=>true,
								"std" 	=> "2",
								"subtype" => array('2 Columns'=>'2','3 Columns (not available for dual sidebar templates)'=>'3','4 Columns (not available for dual sidebar templates)'=>'4')),
						
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_2",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','2'),
								"no_first"=>true,
								"std" 	=> "2-2",
								"subtype" => array('50%:50%'=>'1-1', '25%:75%'=>'1-3', '75%:25%'=>'3-1', '33%:66%'=>'1-2', '66%:33%'=>'2-1')),	
								
						
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_3",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','3'),
								"no_first"=>true,
								"std" 	=> "1-1-1",
								"subtype" => array('33%:33%:33%'=>'1-1-1', '25%:25%:50%'=>'1-1-2', '25%:50%:25%'=>'1-2-1', '50%:25%:25%'=>'2-1-1')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_4",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','4'),
								"no_first"=>true,
								"std" 	=> "1-1-1-1",
								"subtype" => array('25%:25%:25%:25%'=>'1-1-1-1')),	
								
						$column_element[0],
						$column_element[1],
						$column_element[2],
						$column_element[3],
						$column_element[4],
						$column_element[5],
						$column_element[6],
						$column_element[7],
						$column_element[8],
						$column_element[9],
						$column_element[10],
						$column_element[11],
						$column_element[12],
						$column_element[13],
						$column_element[14],
						$column_element[15],
						$column_element[16],
						$column_element[17],
						$column_element[18],
						$column_element[19],
						$column_element[20],
						$column_element[21],
						$column_element[22],
						$column_element[23],
						$column_element[24],
						$column_element[25],
						$column_element[26],
						$column_element[27],
						$column_element[28],
						$column_element[29],
						$column_element[30],
						$column_element[31],
						$column_element[32],
						$column_element[33],
						$column_element[34],
						$column_element[35],
						$column_element[36],
						$column_element[37],
						$column_element[38],
						$column_element[39],
						$column_element[40],
						$column_element[41],
						$column_element[42],
						$column_element[43]
							
							
			
				)
			);


$elements[] = 	array(	
				"dynamic"=> 'hr',
				"name" 	=> "Horizontal Ruler",
				"desc" 	=> "Adds a horizontal ruler to the template. You can either choose the default styling, the default styling with less padding at the top and bottom, a ruler with 'top' link or an invisible ruler that just adds whitespace",
				"id" 	=> "dynamic_hr_group",
				"type" 	=> "group",
				"nodescription"=>true,
				"slug"  => '',
				"removable"  => 'remove element',
				'subelements' 	=> array(	
				
						array(	
							"name" 	=> "Horizontal Ruler",
							"desc" 	=> "Adds a horizontal ruler to the template. You can either choose the default styling, the default styling with less padding at the top and bottom, a ruler with 'top' link or an invisible ruler that just adds whitespace",
							"id" 	=> "dynamic_hr",
							"type" 	=> "select",
							"std" 	=> "default",
							"no_first"=>true,
							"subtype" => array('Default Ruler'=>'default','Default Ruler (less padding)'=>'default_small','Ruler with Top Link'=>'top','Ruler with Custom Text'=>'custom','Whitespace'=>'whitespace'),
							"slug"  => '',
							"removable"  => 'remove element'
							),
					    
						   array(	
							"slug"	=> "",
							"name" 	=> "Enter the text",
							"desc" 	=> "",
							"id" 	=> "dynamic_hr_text",
							"type" => "text",
							"required" => array('dynamic_hr','custom')
							)

				)
			);

	
$elements[] = 	array(	
				"dynamic"=> 'slideshow',
				"name" 	=> "Slideshow",
				"desc" 	=> "The slideshow settings of the post or page that are used to display this template will be applied with all its options. You can modify the slideshow for each post/page when editing that post",
				"id" 	=> "dynamic_slideshow",
				"type" 	=> "group",
				"nodescription"=>true,
				"slug"  => '',
				"removable"  => 'remove element',
				'subelements' 	=> array(	
				
						array(	"name" 	=> "Which Slideshow?",
								"desc" 	=> "By default the theme will display the slideshow of the entry which got the this template applied. However you can choose a different page as well.<br/> The slideshow settings of the entry you choose will be applied with all its options. You can modify the slideshow for each post/page when editing that post",
					            "id" 	=> "dynamic_slideshow_which_post_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "self",
								"no_first"=>true,
					            "subtype" => array('Display the slideshow of this entry'=>'self','Choose a Page'=>'page')),
					    
					   	array(	
								"slug"	=> "",
								"name" 	=> "Select Page",
								"desc" 	=> "",
								"id" 	=> "dynamic_slideshow_page_id",
								"type" 	=> "select",
								"subtype" => 'page',
								"required" => array('dynamic_slideshow_which_post_page','page')
							),

				)
			);
				

$elements[] =	array(	
				"dynamic"		=> 'textarea',
				"name" 			=> "Text Area / Callout / Quotes",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_text_area", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Text Styling",
								"desc" 	=> "Chosose which text styling should be applied. You can either add a default paragraph or callout style",
					            "id" 	=> "dynamic_text_styling",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "p",
								"no_first"=>true,
					            "subtype" => array('Paragraph Style'=>'p','Blockquote Style'=>'blockquote','Callout Style'=>'callout')),
					    
					    array(	"slug"	=> "", "type" => "visual_group_start", "id" => "visual_group_dyn_callout", "nodescription" => true, "required" => array('dynamic_text_styling','callout') ),
        
					    array(	
								"slug"	=> "",
								"name" 	=> "Callout Button Label",
								"desc" 	=> "Add the label text of the call to action button. If left empty no button will be displayed",
								"id" 	=> "dynamic_text_button",
								"type" => "text"
								),
								
						array(	"name" 	=> "Callout Button link",
								"desc" 	=> "",
								"slug"  => "",
					            "id" 	=> "dynamic_text_button_link",
					            "type" 	=> "select",
					            "std" 	=> "",
					            "subtype" => array('Link manually'=>'url','Link to Page'=>'page','Link to Category'=>'cat'),
					            ),
					   
								array(	"name" 	=> "",
										"desc" 	=> "",
										"slug"  => "",
										"id"   	=> "dynamic_text_button_link_url",
										"std"  	=> "http://",
										"type" 	=> "text",
										"required" => array('dynamic_text_button_link','url') ),
										
								array(	"name" 	=> "",
										"desc" 	=> "",
										"slug"  => "",
								        "id" 	=> "dynamic_text_button_link_page",
								        "type" 	=> "select",
								        "subtype" => "page",
								        "required" => array('dynamic_text_button_link','page') ),
								        
								array(	"name" 	=> "",
										"desc" 	=> "",
										"slug"  => "",
								        "id" 	=> "dynamic_text_button_link_cat",
								        "type" 	=> "select",
								        "subtype" => "cat",
								        "required" => array('dynamic_text_button_link','cat') ),
	
						
						array(	"slug"	=> "", "type" => "visual_group_end", "id" => "visual_group_dyn_callout_end", "nodescription" => true),
					            
						array(	
								"slug"	=> "",
								"name" 	=> "The text message that should be displayed",
								"desc" 	=> "Your message to the world :)<br/>(Wordpress shortcodes and HTML allowed)",
								"id" 	=> "dynamic_text",
								"type" 	=> "textarea"),
		
				)
			);
			

$elements[] =	array(	
				"dynamic"		=> 'heading',
				"name" 			=> "Heading + Breadcrumb",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_heading", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
				
				array(	"name" 	=> "Set a Page title and a page description",
						"desc" 	=> "By default the theme will display the page title of the entry which got this template applied.",
			            "id" 	=> "dynamic_heading_type",
			            "type" 	=> "select",
						"slug"	=> "",
						"std"	=> "self",
						"no_first"=>true,
			            "subtype" => array('Display this entries heading'=>'self','Custom Heading'=>'custom')),
			            
	            array(	"name" 	=> "Custom Heading",
						"desc" 	=> "",
						"slug"  => "",
						"id"   	=> "dynamic_heading_custom",
						"std"  	=> "",
						"type" 	=> "text",
						"required" => array('dynamic_heading_type','custom') ),
				
				 array(	"name" 	=> "Content bellow heading",
						"desc" 	=> "",
						"slug"  => "",
						"id"   	=> "dynamic_heading_custom_sub",
						"std"  	=> "",
						"type" 	=> "textarea"),
										
																
				array(	"name" 	=> "Breadcrumb Navigation",
						"desc" 	=> "Should the breadcrumb navigation be displayed?",
			            "id" 	=> "dynamic_heading_bc",
			            "type" 	=> "select",
						"slug"	=> "",
						"std"	=> "yes",
						"no_first"=>true,
			            "subtype" => array('Yes'=>'yes','No'=>'no'))

				)
			);

			
				
$elements[] =	array(	
				"dynamic"		=> 'post_page',
				"name" 			=> "Post/Page Content",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_post_page", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which Content?",
								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",
					            "id" 	=> "dynamic_which_post_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "self",
								"no_first"=>true,
					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),
					    
					   	array(	
								"slug"	=> "",
								"name" 	=> "Select Page",
								"desc" 	=> "",
								"id" 	=> "dynamic_page_id",
								"type" 	=> "select",
								"subtype" => 'page',
								"required" => array('dynamic_which_post_page','page')
							),
							
						
						 array(	
								"slug"	=> "",
								"name" 	=> "Select Post",
								"desc" 	=> "",
								"id" 	=> "dynamic_post_id",
								"type" 	=> "select",
								"subtype" => 'post',
								"required" => array('dynamic_which_post_page','post')
							),
							
						array(	"name" 	=> "Display Title?",
								"desc" 	=> "Should the title of the entry be displayed as well?",
					            "id" 	=> "dynamic_which_post_page_title",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "yes",
								"no_first"=>true,
					            "subtype" => array('yes'=>'yes','no'=>'no')),
					            

				)
			);
			
$itemcount = array('All'=>'-1');
for($i = 1; $i<101; $i++) $itemcount[$i] = $i;				

$elements[] =	array(	
				"dynamic"		=> 'shop',
				"name" 			=> "Products",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_shop", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which shop categories should be used?",
								"desc" 	=> "You can select multiple categories here. Products from those categories will be shown.",
					            "id" 	=> "shop_cats_dynamic",
					            "type" 	=> "select",
								"slug"	=> "",
	            				"multiple"=>6,
	            				"taxonomy" => "product_cat",
					            "subtype" => "cat"),
					            
						array(	
								"slug"	=> "",
								"name" 	=> "Shop Columns",
								"desc" 	=> "How many columns should be displayed?",
								"id" 	=> "shop_columns",
								"type" 	=> "select",
								"std" 	=> "3",
								"no_first"=>true,
								"subtype" => array('2'=>'2','3'=>'3','4'=>'4','5'=>'5')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Products per page",
								"desc" 	=> "How many items should be displayed?",
								"id" 	=> "shop_item_count",
								"type" 	=> "select",
								"std" 	=> "24",
								"no_first"=>true,
								"subtype" => $itemcount),

												
						array(	
								"slug"	=> "",
								"name" 	=> "Product Excerpt",
								"desc" 	=> "Should a small text excerpt of the product entry be displayed?",
								"id" 	=> "shop_text",
								"type" 	=> "select",
								"std" 	=> "no",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no')),	
								
						array(	
								"slug"	=> "",
								"name" 	=> "Shop Pagination",
								"desc" 	=> "Should a shop pagination be displayed?",
								"id" 	=> "shop_pagination",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Shop Slider Row",
								"desc" 	=> "Should the products appear as a horizontal slider that only shows one row at a time?",
								"id" 	=> "shop_slider",
								"type" 	=> "select",
								"std" 	=> "no",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Shop Slider Autorotation",
								"desc" 	=> "Should the slider autorotate? if so choose how many seconds each product set should be visible",
								"id" 	=> "shop_autorotate",
								"type" 	=> "select",
								"std" 	=> "0",
								"required"=>array('shop_slider','yes'),
								"no_first"=>true,
								"subtype" => array('Off'=>'0','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30')),
	
				)
			);