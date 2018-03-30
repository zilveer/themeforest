<?php
#-----------------------------------------
#	RT-Theme product_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Portfolio Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$sample_attachment_code = '
<pre>
File Name or Title | file_url 
File Name or Title | file_url 
File Name or Title | file_url | new_window
File Name or Title | file_url			
</pre>
';

$customFields = array(
	  



	array(	 
		"type"    => "group_start",
		"name"    => "_product_tabs",
		"class"   => "vertical_tabs rt_tabs",
	),	


			array(	 
				"type"    => "group_start",
				"name"    => "_product_tabs_titles",
			),				

					array(	 
						"type"			 => "tab_titles",
						"tab_names"      => array(
												RT_COMMON_THEMESLUG."-product-tab-1"=>array("Product Info","icon-info-circled"),
												RT_COMMON_THEMESLUG."-product-tab-2"=>array("Free Tab 1","icon-pencil"),
												RT_COMMON_THEMESLUG."-product-tab-3"=>array("Free Tab 2","icon-pencil"),
												RT_COMMON_THEMESLUG."-product-tab-4"=>array("Free Tab 3","icon-pencil"),
												RT_COMMON_THEMESLUG."-product-tab-5"=>array("Free Tab 4","icon-pencil"),
												RT_COMMON_THEMESLUG."-product-tab-6"=>array("Related Products","icon-link"),												
												RT_COMMON_THEMESLUG."-product-tab-7"=>array("Attached Documents","icon-docs"),
										),
					),

			array(	 
				"type"    => "group_end"
			),				




			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-1",
			),	

					array(
						"description"	=> __('Product Information. Note : A Product can have more then one  Gallery image attached to it. The moment more then one (1) image is added to the product they will be shown as a gallery in the single product page.','rt_theme_admin'),					
						"type"			=> "info_text_only",
						"hr"			=> "true",
					), 			
			
					array(
						"name"			=> "sku",
						"title"			=> __('SKU','rt_theme_admin'),
						"type"			=> "inline_text", 
						"description"	=> __("Stock Keeping Unit : Enter the productnumber which your company uses internally to keep track of this product, it's stock, it's location etc.",'rt_theme_admin'),
						"hr"			=> true 
					),  

					array(
						"name"			=> "price_regular",
						"description"	=> __('Regular Price : Enter the normal/regular price at which the product is sold. No discount offer.','rt_theme_admin'),
						"title"			=> __('Regular Price','rt_theme_admin'),
						"type"			=> "inline_text", 
					),  

					array(
						"name"			=> "sale_price",
						"title"			=> __("Sale Price",'rt_theme_admin'),						
						"description"	=> __("Sale Price : Enter the discount price at which the product now is being sold during the discount period (NOTE : don't forget to remove the discount price after the discount period is over).",'rt_theme_admin'),
						"type"			=> "inline_text", 
						"hr"			=> true 
					),  

					array(
						"name"			=> "short_description",
						"title"			=> __("Short Description",'rt_theme_admin'),
						"description"	=> __('The Product Short description : Enter a short description for this product. The short description will be shown in : <br /><br />1) The Single Product page on the right side of the product image or slider below the product price.<br />2) The Product Listing Pages <br />3) Product Category Listing Pages<br /><br />Any valid HTML is allowed. ','rt_theme_admin'),
						"type"			=> "textarea" 
					),  


			array(	 
				"type"    => "group_end"
			),				


			//Related Product
			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-6",
			),	

				array(
					"description"	=> __('Related Products: Select the products to be listed as related products to this product. They will appear below the single product content or in a tab when tabbed layout is activated.','rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 			
			
				array(
					"title" 		=> __("Select Related Products",'rt_theme_admin'), 
					"description"	=> __('Select and add a related product one by one by selecting and clicking on the listed products in the dropdown list. A added related product can be removed again by clicking the "x" at the end of the line of each related product which has been added. Related products will only show one product image in the single product page. If a related product has more then one image attached to it they will not be shown as a slider in the single product related products section.','rt_theme_admin'),
					"name"			=> "related_products[]",
					"options" 		=> RTTheme::rt_get_products(),
					"select" 		=> __("Select products",'rt_theme_admin'),
					"type" 			=> "selectmultiple"
				),

			array(	 
				"type"    => "group_end"
			),	




			//Attached Documents
			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-7",
			),					
				 
				array(
					"description"	=> __('Product Attachments : To each product multiple attachments can be added. Multiple attachments are allowed. Per attachment one can set : <br /><br /><strong>1) The Title or Filename</strong>,<br />2) <strong>The Url to the attachment</strong>,<br />3)<strong> The Target</strong> (Set the target if the attachment should open in a new window. Default it will open in the same parent window).<br /><br />A delimiter "|" is required to split The Title/Filename, The URL and the Target information. Example;','rt_theme_admin').$sample_attachment_code,					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 				 
				 
				array(
					"name"			=> "attached_documents",
					"title"			=> __("Attached Files", 'rt_theme_admin'),
					"description"	=> __('Use one line per attachment. Use a delimiter "|" to add and split The Title, The URL and the Target information.<br /><br /><pre style=\"font-style:normal;\">For example: <br /><br /><strong>File Name or Title|http://file_url</strong> (Only Filename / Title and URL to the attachment are set)<br /><br /><strong>File Name or Title|http://file_url|_blank</strong> (Filename / Title, URL and Target are set)<br /><br /><strong>|http://file_url|_blank</strong> (No Filename / Title, the delimiter is still added!, URL and Target are set only.)<br /><br />Note : <strong>If no Filename / Title is required one still needs to add a delimiter / splitter to tell the code that it needs to skip the title.</strong></pre><br />More info on the target directive can be found here : <a href="http://www.w3schools.com/tags/att_a_target.asp" target="_blank"><strong>W3School A-Tag Target</strong></a>','rt_theme_admin'),
					"type"			=> "textarea" 
				),


			array(	 
				"type"    => "group_end"
			),	




			//Free Tab 1
			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-2",
			),	

				array(
					"description"	=> __("Free Tab : Each product can have one to four tabs with any information of choice. They are called Free Tabs. The moment one or more Free Tabs are used the complete single product page changes to a tabbed layout. <br /><br />1) The normal product information content goes into a tab called 'General Details',<br />2) The Attachments go into a tab called 'Attachments',<br />3) The Related Products go into a Tab called 'Related Products'<br />4) The Comments go into a tab called 'Comments'.<br /><br />The Free Tabs are also added. Each one shown with its own title and content as set below in the free tab settings. <br /><br />The titles of the <strong>default product tabs</strong> (not the free tabs) can be changed by the use of the default language file that comes with the theme and a program called <a href='http://www.poedit.net/' target='_blank'>PoEdit</a>. This is called localizing the theme. Even if your native language is English you can create your own language file and change the wording used in the tabs. Follow the <a href='http://codex.wordpress.org/WordPress_in_Your_Language' target='_blank'> wordpress codex</a> on this on the how to <a href='http://codex.wordpress.org/Translating_WordPress' target='_blank'>localize your theme</a>. You can change/translated any text string used in the frontend of your website. All the frontend website strings are available for translation in the default language file which is included in the package and which can be found in the RtThemeXX/languages folder.",'rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 		
			
				array(
					"name"			=> "free_tab_1_title",
					"title"			=> __("#1 - Free Tab Name ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Title : Enter the tab title to identify and select the tab. The tab title is shown above the tab content.','rt_theme_admin'),														
					"type"			=> "inline_text" 
				),

				array(
					"name"			=> "free_tab_1_icon",
					"title"			=> __("#1 - Free Tab Icon ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Icon: Choose a Icon to show before the Free Tab Title making identifying the tab more easier, but also gives the tab a nicer look and feel.','rt_theme_admin'),																			
					"type"			=> "inline_text",
					"class"			=> "icon_selection",
					"hr"			=> "true"
				),

				array(
					"name"			=> "free_tab_1_content",
					"title"			=> __("#1 - Free Tab Content", 'rt_theme_admin'),
					"description"	=> __("Free Tab Content : Enter the content that should be shown when the tab is activated/clicked upon. Any valid html, shortcode containing a image, slider or video, etc. is allowed.",'rt_theme_admin'),																			
					"type"			=> "textarea",
					"richeditor"	=> "true",
					"label_position"=> "block"		
				),


			array(	 
				"type"    => "group_end"
			),	



			//Free Tab 2		
			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-3",
			),	
			
				array(
					"description"	=> __('Free Tab : Each product can have one to four tabs with any information of choice. They are called Free Tabs. For more detailed information click on the <strong>Free Tab 1</strong>.','rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 			

				array(
					"name"			=> "free_tab_2_title",
					"title"			=> __("#2 - Free Tab Name ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Title : Enter the tab title to identify and select the tab. The tab title is shown above the tab content.','rt_theme_admin'),														
					"type"			=> "inline_text" 
				),
	 
				array(
					"name"			=> "free_tab_2_icon",
					"title"			=> __("#2 - Free Tab Icon ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Icon: Choose a Icon to show before the Free Tab Title making identifying the tab more easier, but also gives the tab a nicer look and feel.','rt_theme_admin'),																								
					"type"			=> "inline_text",
					"class"			=> "icon_selection",
					"hr"			=> "true"
				),
	 
				array(
					"name"			=> "free_tab_2_content",
					"title"			=> __("#2 - Free Tab Content", 'rt_theme_admin'),
					"description"	=> __("Free Tab Content : Enter the content that should be shown when the tab is activated/clicked upon. Any valid html, shortcode containing a image, slider or video, etc. is allowed.",'rt_theme_admin'),																								
					"type"			=> "textarea",
					"richeditor"	=> "true",
					"label_position"=> "block"			
				),

	 
			array(	 
				"type"    => "group_end"
			),	



			//Free Tab 3
			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-4",
			),	

				array(
					"description"	=> __('Free Tab : Each product can have one to four tabs with any information of choice. They are called Free Tabs. For more detailed information click on the <strong>Free Tab 1</strong>.','rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 			
	 

				array(
					"name"			=> "free_tab_3_title",
					"title"			=> __("#3 - Free Tab Name ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Title : Enter the tab title to identify and select the tab. The tab title is shown above the tab content.','rt_theme_admin'),														
					"type"			=> "inline_text" 
				),
	 
				array(
					"name"			=> "free_tab_3_icon",
					"title"			=> __("#3 - Free Tab Icon ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Icon: Choose a Icon to show before the Free Tab Title making identifying the tab more easier, but also gives the tab a nicer look and feel.','rt_theme_admin'),																			
					"type"			=> "inline_text",
					"class"			=> "icon_selection",
					"hr"			=> "true"
				),
	 

				array(
					"name"			=> "free_tab_3_content",
					"title"			=> __("#3 - Free Tab Content", 'rt_theme_admin'),
					"description"	=> __("Free Tab Content : Enter the content that should be shown when the tab is activated/clicked upon. Any valid html, shortcode containing a image, slider or video, etc. is allowed.",'rt_theme_admin'),																								
					"type"			=> "textarea",
					"richeditor"	=> "true",
					"label_position"=> "block"			
				),

	 
			array(	 
				"type"    => "group_end"
			),	


 
			//Free Tab 4
			array(	 
				"type"    => "group_start",
				"name"    => "-product-tab-5",
			),	

				array(
					"description"	=> __('Free Tab : Each product can have one to four tabs with any information of choice. They are called Free Tabs. For more detailed information click on the <strong>Free Tab 1</strong>.','rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 			
 
				array(
					"name"			=> "free_tab_4_title",
					"title"			=> __("#4 - Free Tab Name ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Title : Enter the tab title to identify and select the tab. The tab title is shown above the tab content.','rt_theme_admin'),														
					"type"			=> "inline_text" 
				),
	 

				array(
					"name"			=> "free_tab_4_icon",
					"title"			=> __("#4 - Free Tab Icon ", 'rt_theme_admin'),
					"description"	=> __('Free Tab Icon: Choose a Icon to show before the Free Tab Title making identifying the tab more easier, but also gives the tab a nicer look and feel.','rt_theme_admin'),																			
					"type"			=> "inline_text",
					"class"			=> "icon_selection",
					"hr"			=> "true"
				),
	 
				array(
					"name"			=> "free_tab_4_content",
					"title"			=> __("#4 - Free Tab Content", 'rt_theme_admin'),
					"description"	=> __("Free Tab Content : Enter the content that should be shown when the tab is activated/clicked upon. Any valid html, shortcode containing a image, slider or video, etc. is allowed.",'rt_theme_admin'),																			
					"type"			=> "textarea",
					"richeditor"	=> "true",
					"label_position"=> "block"			
				),

	 
			array(	 
				"type"    => "group_end"
			),	
 

 
	array(	 
		"type"    => "group_end"
	),		
 
);

$settings  = array( 
	"name"       => RT_THEMENAME ." Product Options",
	"scope"      => "products",
	"slug"       => "product_custom_fields",
	"capability" => "edit_post",
	"context"    => "normal",
	"priority"   => "high" 
);

?>