<?php

function get_category_page_array($std = 0){

	$pagearr = array("select");
	
	$pages = get_pages();
	
	if(empty($pages)) return false;
	
	foreach($pages as $key=>$page):
	
		$pagearr[$page->ID] = $page->post_title;
	
	endforeach;
	
	return $pagearr;
	
}
add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		
		$shortname="sellya";
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		
		
		foreach ($of_pages_obj as $of_page) {
		
		    $of_pages[$of_page->ID] = $of_page->post_name; 
			
		}
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}



		//Background Images Reader
		
		$bg_transparent_images_path = get_template_directory().'/image/patterns/transparent/'; // change this to where you store your bg images
         
        $bg_transparent_images_url = get_template_directory_uri().'/image/patterns/transparent/'; // change this to where you store your bg images
      
        /*for transparent*/
        
         $bg_transparent_images = array();

        if (is_dir($bg_transparent_images_path)) {
            if ($bg_images_dir = opendir($bg_transparent_images_path)) {
                while (($bg_images_file = readdir($bg_images_dir)) !== false) {
                    if (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                        $bg_transparent_images[] = $bg_transparent_images_url . $bg_images_file;
                    }
                }
            }
        }
      
        /*end transparent*/
        
        /*for non  transparent*/
        
        $bg_non_transparent_images_path  = get_template_directory().'/image/patterns/non_transparent/'; // change this to where you store your bg images
        
        $bg_non_transparent_images_url = get_template_directory_uri().'/image/patterns/non_transparent/'; // change this to where you store your bg images
         
         
        $bg_non_transparent_images = array();
		 

        if (is_dir($bg_non_transparent_images_path)) {
            if ($bg_images_dir = opendir($bg_non_transparent_images_path)) {
                while (($bg_images_file = readdir($bg_images_dir)) !== false) {
                    if (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                        $bg_non_transparent_images[] = $bg_non_transparent_images_url . $bg_images_file;
                    }
                }
            }
        }
        
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 

		$url = get_template_directory_uri().'/admin/assets/images/';


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
		global $of_options, $of_menus;
		$of_options = $of_menus = array();
	
	
	   /* Option Page 1 - Header Options */
		$of_menus = array( 
			array(
				"name" => 'General Options',
				"id"	=> 'of_general_op',
				"sub" => array(
					array(
						"name" => "Theme Options",
						"id" => "sub_general_tab_1",				
					),
					array(
						'name' => 'Main Menu',
						'id' => 'sub_general_tab_2'
					),
					array(
						'name' => 'Home Page',
						'id' => 'sub_general_tab_3'
					),
					array(
						'name' => 'Product page',
						'id' => 'sub_general_tab_4'
					)
				)
			),
	
			array(
				"id"	=> 'of_background_op',
				"name" => 'Background',
				"sub" => array(
					array(
						"name" => "Body",
						"id" => "sub_heading_tab_1"
					),
					array(
						'name' => 'Main Column',
						'id' => 'sub_heading_tab_2'
					),
					array(
						'name' => 'Top Area',
						'id' => 'sub_heading_tab_3'
					),
					array(
						'name' => 'Main Menu',
						'id' => 'sub_heading_tab_4'
					),
					array(
						'name' => 'Bottom Area',
						'id' => 'sub_heading_tab_5'
					)
					
				)
					
			),
			array(
				"name" => 'Styling',
				"id" => "of_styling_op",
				"sub" => array(
					array(
						"name" => "General",
						"id" => "styling_tab_1"
					),
					array(
						'name' => 'Prices',
						'id' => 'styling_tab_2'					
					),
					array(
						'name' => 'Buttons',
						'id' => 'styling_tab_3'
					),
					array(
						'name' => 'Top Area',
						'id' => 'styling_tab_4'
					),
					array(
						'name' => 'Main Menu',
						'id' => 'styling_tab_5'
					),
					array(
						'name' => 'Midsection',
						'id' => 'styling_tab_6'					
					),
					array(
						'name' => 'Bottom Area',
						'id' => 'styling_tab_7'
					)
				)
			),
			array(
				"name" => 'Fonts',
				"id" => "of_fonts_op"
			),
			array(
				"name" => 'Product View',
				"id" => "of_product_view_op"
			),
			array(
				"name" => 'Footer',
				"id" => "of_footer_op",
				"sub" => array(
					array(					
						'name' => 'Payment',
						'id' => 'footer_tab_1'
					),
					array(
						'name' => 'Credits',
						'id' => 'footer_tab_2'
					),
					array(
						'name' => 'Follow',
						'id' => 'footer_tab_3'
					),
					array(
						'name' => 'About Us',
						'id' => 'footer_tab_4'
					)				
				)
			),
			array(
				"name" => 'Widgets',
				"id" => "of_widgets_op",
				"sub" => array(
					array(
						'name' => 'Facebook Box',
						'id' => 'widgets_tab_1'
					),				
					array(
						'name' => 'Custom box',
						'id' => 'widgets_tab_2',
					)
				)
			),
			array(
				"name" => 'Sliders',
				"id" => "of_sliders_op"
			),
			array(
				"name" => 'Custom CSS',
				"id" => "of_custom_css_op"
			),
			array(
				"name" => "Backup Options",
				"id" => "of_backup_op"
			)
			
		); //end $of_menus[]
        
		
		$of_options[] = array(
		
			'related' => 'sub_general_tab_1',
			'elements' => array(
                                
                                array("name" => 'Layout',
					//"desc" => "Related Products Position Option",
					"id" => $shortname . "_layout",
					"std" => "boxed",
					"type" => "select",
					"options"=>array('boxed'=>'Boxed','full'=>'Full width',),					
				), 
                            
				array("name" => 'Logo',
					"desc" => 'Upload a custom logo for your Website.',
					"id" => $shortname . "_sitelogo",
					"std" => '', //$image_url_logo
					"type" => "media",					
				),
				array("name" => 'Sellya Skin',
					//"desc" => "Sellya Skin Option",
					"id" => $shortname . "_skin",
					"std" => "Default",
					"type" => "select",
					"options"=>array('Default'=>'Default','Kids'=>'Kids','Sport'=>'Sport','Fashion'=>'Fashion','Gifts'=>'Gifts','Restaurant'=>'Restaurant','Light'=>'Light','Electronics'=>'Electronics'),
					'help_tip'=>'sellya-help-32' 
					 
				),
				
                                array("name" => 'Enable / Disable product description, rating / alternative image',					
					"id" => $shortname . "_product_alt_image_setting",
					"std" => 0,
					"type" => "select",
					"options"=>array('0'=>'Show description &amp; rating','1'=>'Show alternative image',),					
				), 
                            
				array("name" => 'Related Products Position',
					//"desc" => "Related Products Position Option",
					"id" => $shortname . "_related_product_pos",
					"std" => "right",
					"type" => "select",
					"options"=>array('right'=>'Right','bottom'=>'Bottom',),
					"help_tip" => "sellya-help-27"  
				), 
				
				array("name" => 'Show category grid icons:',
					//"desc" => "Only for <strong>Horizontal</strong> style",
					"id" => $shortname . "_category_grid_icon_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				
				array("name" => 'Categories per row',
					//"desc" => "Categories per row",
					"id" => $shortname . "_categories_per_row",
					"std" => "6",
					"type" => "select",
					"options"=>array('2'=>'2','3'=>'3','4'=>'4','6'=>'6')   
				), 
				array("name" => 'Subcategories per column',
					//"desc" => "Subcategories per column",
					"id" => $shortname . "_subcategories_per_column",
					"std" => "5",
					"type" => "select",
					"options"=>array('2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10')   
				), 
				array("name" => 'Tracking Code',
					//"desc" => 'Paste Google Analytics (or other) tracking code here.',
					"id" => $shortname . "_google_analytics",
					"std" => "",
					"type" => "textarea",
					"help_tip" => "sellya-help-36"
				)				
			
			) 
		
		);
		
		
		$of_options[] = array(
		
			'related' => 'sub_general_tab_2',
			'elements' => array(
				array("name" => 'Categories Page:',
					//"desc" => "Categories display style",
					"id" => $shortname . "_menu_categories_page",
					"type" => "select",
					"std" => 0,
					"options" => get_category_page_array()
				),
				array("name" => 'Categories display style:',
					//"desc" => "Categories display style",
					"id" => $shortname . "_menu_categories_style",
					"type" => "select",
					"std" => "Horizontal",
					"options" => array('Horizontal' => 'Horizontal', 'Vertical' => 'Vertical')
				),
				array("name" => 'Show category icons:',
					"desc" => "Only for <strong>Horizontal</strong> style",
					"id" => $shortname . "_mm2_main_category_icon_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'sub_general_tab_3',
			'elements' => array(
				array("name" => 'Show Slider On Homepage:',										
					"id" => $shortname . "_show_slider_on_homepage",
					"type" => "iphone_checkboxes",
					"std" => 1
				),			
				array("name" => 'Show Brands:',										
					"id" => $shortname . "_show_brands",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Brands View:',										
					"id" => $shortname . "_brands_wall_status",
					"type" => "select",
					"std" => "0",
					"options" => array('0' => 'Slider', '1' => 'Wall')
				),				
				array("name" => 'Brands per row',
					"desc" => "Works only on <em>Wall</em> style",
					"id" => $shortname . "_brands_per_row",
					"std" => "6",
					"type" => "select",
					"options"=>array('4'=>'4','6'=>'6')   
				),
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'sub_general_tab_4',
			'elements' => array(
				array("name" => 'Product Page Design',
					//"desc" => "Works only on <em>Wall</em> style",
					"id" => $shortname . "_product_page_design",
					"std" => "1",
					"type" => "select",
					"options"=>array('1'=>'Full Width','2'=>'With Left Sidebar','3'=>'With Right Sidebar')   
				),					                       						
				array("name" => 'Show Related Products',
					//"desc" => "Show related products in product page",
					"id" => $shortname . "_related_pro",
					"type" => "iphone_checkboxes",
					"std" => 1
				),						
				array("name" => 'Show custom block:',
					//"desc" => "Show custom block in product page",
					"id" => $shortname . "_cblcok_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Custom block content',
					// "desc" => "Custom block Content in product page",
					"id" => $shortname . "_custom_block",
					"type" => "textarea",
					"std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
				),
				array("name" => 'Show custom tab',
					// "desc" => "Show custom tab in product page",
					"id" => $shortname . "_ctab_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Custom tab title',
					//"desc" => "Custom Tab Title",
					"id" => $shortname . "_ctab_title",
					"type" => "text",
					"std" => 'Custom Tab'
				),
				array("name" => 'Custom tab content',
					//"desc" => "Custom tab Content on product page",
					"id" => $shortname . "_ctab_content",
					"type" => "textarea",
					"std" => 'This is a static Custom Tab Content from admin panel. You can insert any content here.'
				)
			)
			
		);
		
		/*end General Options*/
		
		/*start Background*/
		
		$of_options[] = array(
		
			'related' => 'sub_heading_tab_1',
			'elements' => array(
				array("name" => 'Show Body pattern or background image',
					//"desc" => "Show related products in product page",
					"id" => $shortname . "_show_bg_image_custom",
					"type" => "iphone_checkboxes",
					"std" => 0,
					"help_tip" => "sellya-help-16"
					),
				array("name" => 'Upload your own pattern or background image',
					//"desc" => 'Upload your own pattern or background image:',
					"id" => $shortname . "_bg_image_custom",
					"std" => '',
					"type" => "media"),
				array("name" => 'Background Position',
					//"desc" => 'Body Background Position',
					"id" => $shortname . '_bodybg_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'top center', 'top left' => 'top teft', 'top right' => 'top right', 'center' => 'center',
						'left' => 'Left', 'right' => 'Right', 'bottom center' => 'bottom center', 'bottom left' => 'bottom left', 'bottom right' => 'bottom right'
					)
				), 
				array("name" => 'Background Repeat',
					//"desc" => 'Body Background Repeat',
					"id" => $shortname . '_bodybg_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat')
				), 
				array("name" => 'Background Attachment',
				   // "desc" => 'Body Background Attachment',
					"id" => $shortname . '_bodybg_attach',
					"std" => "scroll",
					"type" => "select",
					"options" => array('scroll' => 'scroll', 'fixed' => 'fixed')
				), 
				array("name" => "Background Paterns",
				   // "desc" => "Select a background pattern.",
					"id" => $shortname . "_body_bg",
					"std" => get_template_directory_uri()."/image/patterns/non_transparent/p193.png",
					"type" => "pattern_tiles", 
					"transparent_options" =>$bg_transparent_images ,
					"non_transparent_options" => $bg_non_transparent_images
				)
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'sub_heading_tab_2',
			'elements' => array(
				array("name" => 'Show Main Column pattern or background image',
					//"desc" => "Show related products in product page",
					"id" => $shortname . "_show_bg_image_mc_custom",
					"type" => "iphone_checkboxes",
					"std" => 1,
					"help_tip" => "sellya-help-17"
					),
				array("name" => 'Upload Main Column background image:',
					//"desc" => 'Upload your own pattern or background image:',
					"id" => $shortname . "_bg_image_mc_custom",
					"std" => '',
					"type" => "media"),
				array("name" => 'Background Position',
					//"desc" => 'Background Position',
					"id" => $shortname . '_maincolbg_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'Top Center', 'top left' => 'Top Left', 'top right' => 'Top Right', 'center' => 'Center',
						'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right'
					)
				), 
				array("name" => 'Background Repeat',
					//"desc" => 'Background Repeat',
					"id" => $shortname . '_maincolbg_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')
				), 
				array("name" => 'Background Attachment',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_maincolbg_attach',
					"std" => "scroll",
					"type" => "select",
					"options" => array('scroll' => 'Scroll', 'fixed' => 'Fixed')
				), 
				array("name" => "Background Paterns",
				   // "desc" => "Select a background pattern.",
					"id" => $shortname . "_maincol_bg",
					"std" => "",
					"type" => "pattern_tiles", 
					"transparent_options" =>$bg_transparent_images   ,
					"non_transparent_options" => $bg_non_transparent_images
				)
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'sub_heading_tab_3',
			'elements' => array(
				array("name" => 'Show Top Area pattern or background image',
					//"desc" => "Show related products in product page",
					"id" => $shortname . "_show_bg_image_ta_custom",
					"type" => "iphone_checkboxes",
					"std" => 1,
					"help_tip" => "sellya-help-18"
				),
				array("name" => 'Upload Top Area background image:',
					//"desc" => '',
					"id" => $shortname . "_bg_image_ta_custom",
					"std" => '',
					"type" => "media"
				),
				array("name" => 'Background Position',
					//"desc" => 'Background Position',
					"id" => $shortname . '_topabg_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'Top Center', 'top left' => 'Top Left', 'top right' => 'Top Right', 'center' => 'Center',
						'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right'
					)
				), 
				array("name" => 'Background Repeat',
				   // "desc" => 'Background Repeat',
					"id" => $shortname . '_topabg_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')
				), 
				array("name" => 'Background Attachment',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_topabg_attach',
					"std" => "scroll",
					"type" => "select",
					"options" => array('scroll' => 'Scroll', 'fixed' => 'Fixed')
				), 
				array("name" => "Background Paterns",
					//"desc" => "Select a background pattern.",
					"id" => $shortname . "_topa_bg",
					"std" => "",
					"type" => "pattern_tiles", 
					"transparent_options" =>$bg_transparent_images   ,
					"non_transparent_options" => $bg_non_transparent_images
				)
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'sub_heading_tab_4',
			'elements' => array(
				array("name" => 'Show Main Menu pattern or background image',
					//"desc" => "Show related products in product page",
					"id" => $shortname . "_show_bg_image_mm_thumb",
					"type" => "iphone_checkboxes",
					"std" => 1,
					"help_tip" => "sellya-help-19"
					),
				array("name" => 'Upload Main Menu background image:',
					"desc" => 'Upload background image: Dimensions: 940 x 46px',
					"id" => $shortname . "_bg_image_mm_thumb",
					"std" => '',
					"type" => "media"),					
				array("name" => 'Background Repeat',
					//"desc" => 'Background Repeat',
					"id" => $shortname . '_mainmbg_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')
				), 
				array("name" => "Background Paterns",
					//"desc" => "Select a background pattern.",
					"id" => $shortname . "_mainm_bg",
					"std" => "",
					"type" => "pattern_tiles",                              
					"transparent_options" => $bg_transparent_images ,
					"non_transparent_options" => $bg_non_transparent_images
				)
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'sub_heading_tab_5',
			'elements' => array(
				
				array("name" => 'Show Contact Us, Twitter, Custom Column pattern or background image ',
					//"desc" => "Show Image slider in home page",
					"id" => $shortname . "_show_bg_image_f1_thumb",
					"type" => "iphone_checkboxes",
					"std" => 1 ,
					"help_tip" => "sellya-help-20"                               
				),                                  
				array("name" => 'Upload Bottom Area Contact Us, Twitter, Custom Column pattern or background image',
				//"desc" => 'Upload your own pattern or background image:',
					"id" => $shortname . "_bg_image_f1_thumb",
					"std" => '',
					"type" => "media"
				),
				array("name" => 'Background Position',
				//"desc" => 'Background Position',
					"id" => $shortname . '_bg_image_f1_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'Top Center', 'top left' => 'Top Left', 'top right' => 'Top Right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right')
				),
				array("name" => 'Background Repeat',
					//"desc" => 'Background Repeat',
					"id" => $shortname . '_bg_image_f1_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')
				), 
				array("name" => "Background Paterns",
					"desc" => "Select a background pattern.",
					"id" => $shortname . "_pattern_sellya_f1",
					"std" => "",
					"type" => "pattern_tiles",                              
					"transparent_options" => $bg_transparent_images ,
					"non_transparent_options" => $bg_non_transparent_images 
				),
			
			
			
			 	array("name" => 'Show Information, Customer Service, Extras, My Account pattern or background image',
					//"desc" => "Show Image slider in home page",
					"id" => $shortname . "_show_bg_image_f2_thumb",
					"type" => "iphone_checkboxes",
					"std" => 1,
					"help_tip" => "sellya-help-21"				
				), 
					 
				array("name" => 'Upload Bottom Area Show Information, Customer Service, Extras, My Account pattern or background image',
					//"desc" => 'Upload your own pattern or background image:',
					"id" => $shortname . "_bg_image_f2_thumb",
					"std" => '',
					"type" => "media"
				),
				array("name" => 'Background Position',
					//"desc" => 'Background Position',
					"id" => $shortname . '_bg_image_f2_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'Top Center', 'top left' => 'Top Left', 'top right' => 'Top Right', 'center' => 'Center','left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right')
				), 
				array("name" => 'Background Repeat',
					//"desc" => 'Background Repeat',
					"id" => $shortname . '_bg_image_f2_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')
				), 
				array("name" => "Background Paterns",
					"desc" => "Select a background pattern.",
					"id" => $shortname . "_pattern_sellya_f2",
					"std" => "",
					"type" => "pattern_tiles",                              
					"transparent_options" => $bg_transparent_images ,
					"non_transparent_options" => $bg_non_transparent_images
				),
			
			
		 
				array("name" => 'Show Footer - Payment Images, Powered by, Follow Us pattern or background image',
					//"desc" => "Show Image slider in home page",
					"id" => $shortname . "_show_bg_image_f4_thumb",
					"type" => "iphone_checkboxes",
					"std" => 1 ,
					"help_tip" => "sellya-help-22"                               
				), 
					 
				array("name" => 'Upload Bottom Area Payment Images, Powered by, Follow Us pattern or background image',
					//"desc" => 'Upload your own pattern or background image:',
					"id" => $shortname . "_bg_image_f4_thumb",
					"std" => '',
					"type" => "media"),
				array("name" => 'Background Position',
					//"desc" => 'Background Position',
					"id" => $shortname . '_bg_image_f4_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'Top Center', 'top left' => 'Top Left', 'top right' => 'Top Right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right')
				), 
				array("name" => 'Background Repeat',
					//"desc" => 'Background Repeat',
					"id" => $shortname . '_bg_image_f4_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')),
				array("name" => "Background Paterns",
					"desc" => "Select a background pattern.",
					"id" => $shortname . "_pattern_sellya_f4",
					"std" => "",
					"type" => "pattern_tiles",                              
					"transparent_options" => $bg_transparent_images ,
					"non_transparent_options" => $bg_non_transparent_images
				),
			
			
				array("name" => 'Show About Us background pattern or background image ',
					//"desc" => "Show Image slider in home page",
					"id" => $shortname . "_show_bg_image_f5_thumb",
					"type" => "iphone_checkboxes",
					"std" => 1,
					"help_tip" => "sellya-help-23"							
				), 
					 
				array("name" => 'Show About Us pattern or background image',
					//"desc" => 'Upload your own pattern or background image:',
					"id" => $shortname . "_bg_image_f5_thumb",
					"std" => '',
					"type" => "media"
				),
				array("name" => 'Background Position',
					//"desc" => 'Background Position',
					"id" => $shortname . '_bg_image_f5_position',
					"std" => "top center",
					"type" => "select",
					"options" => array('top center' => 'Top Center', 'top left' => 'Top Left', 'top right' => 'Top Right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right')
				), 
				array("name" => 'Background Repeat',
					//"desc" => 'Background Repeat',
					"id" => $shortname . '_bg_image_f5_repeat',
					"std" => "repeat",
					"type" => "select",
					"options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat')
				), 
				array("name" => "Background Paterns",
					"desc" => "Select a background pattern.",
					"id" => $shortname . "_pattern_sellya_f5",
					"std" => "",
					"type" => "pattern_tiles",                              
					"transparent_options" => $bg_transparent_images ,
					"non_transparent_options" => $bg_non_transparent_images
				)
			)
			
		);
		/*end Background*/
		
		
		/*start Styling*/
		$of_options[] = array(
		
			'related' => 'styling_tab_1',
			'elements' => array(
				array("name" => 'Body background color:',
					//"desc" => 'Body background color:',
					"id" => $shortname . '_bodybg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),				
				array("name" => 'Headings Color',
				   // "desc" => 'Headings Color',
					"id" => $shortname . '_headings_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Body text color',
				   // "desc" => 'Body text color',
					"id" => $shortname . '_btext_color',
					"std" => "#545454",
					"type" => "color"
				),
				array("name" => ' Light text color',
					//"desc" => ' Light text color',
					"id" => $shortname . '_ltext_color',
					"std" => "#A3A3A3",
					"type" => "color"
				),
				array("name" => 'Other links color',
					//"desc" => 'Other links color',
					"id" => $shortname . '_olink_color',
					"std" => "#545454",
					"type" => "color"
				),
				array("name" => 'Links hover color',
				   // "desc" => 'Links hover color:',
					"id" => $shortname . '_lover_color',
					"std" => "#EE3963",
					"type" => "color"
				),
				array("name" => 'Main Column',
					"type" => "subsection",
					"help_tip" => "sellya-help-5"	
				),
				/* Main Column Start   */
				array("name" => 'Show background color',
				   // "desc" => "Show background color:",
					"id" => $shortname . "_mainbg_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Background color',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainbg_color',
					"std" => "#F8F8F8",
					"type" => "color"
				),				
				array("name" => 'Border Show',
					//"desc" => "Border Show",
					"id" => $shortname . "_mainborder_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				array("name" => 'Border Size',
				   // "desc" => 'Border Size',
					"id" => $shortname . '_mainborder_size',
					"std" => "1",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
				   // "desc" => 'Border Style',
					"id" => $shortname . '_mainborder_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border color',
				   // "desc" => 'Border color',
					"id" => $shortname . '_mainborder_color',
					"std" => "#CCCCCC",
					"type" => "color"
				),
				array("name" => 'Radius',
				   // "desc" => 'Radius',
					"id" => $shortname . '_mainboder_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Shadow',
				   // "desc" => "Border Show",
					"id" => $shortname . "_mainborder_shadow",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				/* Left/Right Column   */
				array("name" => 'Left/Right Column',
					"type" => "subsection",
					"help_tip" => "sellya-help-2"
				),
				array("name" => 'Show background color',
				   // "desc" => "Show background color:",
					"id" => $shortname . "_lrcbg_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				array("name" => 'Background color',
				   // "desc" => 'Background color',
					"id" => $shortname . '_lrcbg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Content radius:',
				   // "desc" => 'Content radius:',
					"id" => $shortname . '_lrcbg_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Shadow',
				   // "desc" => "Border Show",
					"id" => $shortname . "_lrcbg_shadow",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				/* Left/Right Column Heading   */
				array("name" => 'Left/Right Column Heading',
					"type" => "subsection",
					"help_tip" => "sellya-help-3"
				),
				array("name" => 'Show background color',
				   // "desc" => "Show background color:",
					"id" => $shortname . "_lrchbg_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Background color',
				   // "desc" => 'Background color',
					"id" => $shortname . '_lrchbg_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Title color',
				   // "desc" => 'Title color',
					"id" => $shortname . '_lrchtitle_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Radius',
					//"desc" => 'Radius',
					"id" => $shortname . '_lrch_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Shadow',
					//"desc" => "Border Show",
					"id" => $shortname . "_lrch_shadow",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				/* Left/Right Column Box   */
				array("name" => 'Left/Right Column Box',
					"type" => "subsection",
					"help_tip" => "sellya-help-4"
				),
				array("name" => 'Show box background color:',
					//"desc" => "Show background color:",
					"id" => $shortname . "_lrcboxbg_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Background color',
				   // "desc" => 'Background color',
					"id" => $shortname . '_lrcboxbg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Separator Size',
					//"desc" => 'Separator Size',
					"id" => $shortname . '_lrcboxsep_size',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')
				),
				array("name" => 'Separator Style',
				   // "desc" => 'Radius',
					"id" => $shortname . '_lrcboxsep_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'solid', 'dotted' => 'dotted', 'dashed' => 'dashed')
				),
				array("name" => 'Separator color',
				   // "desc" => 'Separator color',
					"id" => $shortname . '_lrcboxsep_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Box radius:',
				   // "desc" => 'Box radius:',
					"id" => $shortname . '_lrcbox_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Box shadow:',
				   // "desc" => "Box shadow:",
					"id" => $shortname . "_lrcbox_shadow",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				/* Content Column   */
				array("name" => 'Content Column',
					"type" => "subsection",
					"help_tip" => "sellya-help-1"
				),
				array("name" => 'Content background color:',
				   // "desc" => "Content background color:",
					"id" => $shortname . "_ccbg_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Background color',
				   // "desc" => 'Background color',
					"id" => $shortname . '_ccbg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),			   
				array("name" => 'Box radius:',
					//"desc" => 'Box radius:',
					"id" => $shortname . '_cc_redius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Box shadow:',
					//"desc" => "Box shadow:",
					"id" => $shortname . "_ccbox_shadow",
					"type" => "iphone_checkboxes",
					"std" => 0
				)
			)
		);
		
		$of_options[] = array(
		
			'related' => 'styling_tab_2',
			'elements' => array(
				array("name" => 'Price color',
				   // "desc" => 'Price color',
					"id" => $shortname . '_price_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Old price color',
				   // "desc" => 'Old price color',
					"id" => $shortname . '_oprice_color',
					"std" => "#A3A3A3",
					"type" => "color"
				),
				array("name" => 'New price color',
					//"desc" => 'New price color',
					"id" => $shortname . '_nprice_color',
					"std" => "#EE3963",
					"type" => "color"
				),
			)
		);
		
		$of_options[] = array(
		
			'related' => 'styling_tab_3',
			'elements' => array(
				array("name" => 'Button border radius:',
				   // "desc" => 'Button border radius:',
					"id" => $shortname . '_btnborder_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'),
					"help_tip" => "sellya-help-6"
				),
				array("name" => 'Button text shadow:',
				   // "desc" => "Button text shadow:",
					"id" => $shortname . "_btntext_shadow",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				/* Buttons  */
				array("name" => 'Buttons',
					"type" => "subsection"
				),				
				array("name" => 'Background color',
					//"desc" => 'Background color',
					"id" => $shortname . '_btnbg_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Border top color',
					//"desc" => 'Border top color',
					"id" => $shortname . '_btntopbor_color',
					"std" => "#66BCDA ",
					"type" => "color"
				),
				array("name" => 'Border bottom color',
				   // "desc" => 'Border bottom color',
					"id" => $shortname . '_btnbuttom_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Background color hover',
				   // "desc" => 'Background color hover',
					"id" => $shortname . '_btnbghover_color',
					"std" => "#62B4D1",
					"type" => "color"
				),
				array("name" => 'Border top color hover',
					//"desc" => 'Border top color hover:',
					"id" => $shortname . '_btntopo_color',
					"std" => "#559CB5",
					"type" => "color"
				),
				array("name" => 'Border bottom color hover',
				   // "desc" => 'Border bottom color hover:',
					"id" => $shortname . '_btnbottomo_color',
					"std" => "#5CA9C4",
					"type" => "color"
				),
				array("name" => 'Text color',
					"desc" => 'Text color',
					"id" => $shortname . '_btntext_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				/*   Exclusive Buttons */
				
				array("name" => 'Exclusive Buttons',
					"type" => "subsection",
					"help_tip" => "sellya-help-7"
				),
				array("name" => 'Background color',
				   // "desc" => 'Background color',
					"id" => $shortname . '_ebtnbg_color',
					"std" => "#EE3963",
					"type" => "color"
				),
				array("name" => 'Border color',
					//"desc" => '',
					"id" => $shortname . '_ebtnbortop_color',
					"std" => "#EE3963",
					"type" => "color"
				),				
				array("name" => 'Background color hover',
				   // "desc" => '',
					"id" => $shortname . '_ebtnbgover_color',
					"std" => "#E0365D",
					"type" => "color"
				),
				array("name" => 'Border color hover',
				  //  "desc" => '',
					"id" => $shortname . '_ebtntopo_color',
					"std" => "#A12744",
					"type" => "color"
				),			   
				array("name" => 'Text color',
					//"desc" => 'Text color',
					"id" => $shortname . '_ebtntext_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'styling_tab_4',
			'elements' => array(
				
				array("name" => 'Show box background color:',
					//"desc" => "Show background color:",
					"id" => $shortname . "_topbg_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				array("name" => 'Background color',
				   // "desc" => 'Background color',
					"id" => $shortname . '_topareabg_color',
					"std" => "#F8F8F8",
					"type" => "color"
				),
				/* Logo+ */
				array("name" => 'Logo',
					"type" => "subsection"
				),
					
				array("name" => 'Logo position',
					//"desc" => 'Logo position',
					"id" => $shortname . '_logo_position',
					"std" => "left",
					"type" => "select",
					"options" => array('left' => 'left', 'center' => 'center')
				),
				/* Search Bar */
				array("name" => 'Search Bar',
					"type" => "subsection"
				),
				
				array("name" => 'Show Search Bar',
					//"desc" => "Show background color:",
					"id" => $shortname . "_top_search_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Auto Suggest Search Bar',
					//"desc" => "Show background color:",
					"id" => $shortname . "_top_search_autosuggest_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				array("name" => 'Show Search Results at most (Numeric value)',
				   // "desc" => 'Search button color',
					"id" => $shortname . '_top_search_autosuggest_no',
					"std" => "10",
					"type" => "text"
				),
				array("name" => 'Search position',
					//"desc" => 'Search position',
					"id" => $shortname . '_search_position',
					"std" => "center",
					"type" => "select",
					"options" => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right')
				),
				array("name" => "Search bar style",
				   // "desc" => "Search bar style",
					"id" => $shortname . "_search_style",
					"std" => "search1",
					"type" => "images",
					"options" => array(
						'search1' => $url . 'searchbar_1.png',
						'search2' => $url . 'searchbar_2.png',
						'search3' => $url . 'searchbar_3.png'
					)
				),
				array("name" => 'Search button color',
				   // "desc" => 'Search button color',
					"id" => $shortname . '_searchbtn_color',
					"std" => "#62B5DD",
					"type" => "color"
				),
				array("name" => 'Search bar border color:',
				   // "desc" => 'Search bar border color:',
					"id" => $shortname . '_searchbor_color',
					"std" => "#DFDFDF",
					"type" => "color"
				),
				/* Links Section */
				array("name" => 'Links Section',
					"type" => "subsection"),
				array("name" => 'Link color',
				  //  "desc" => 'Link color',
					"id" => $shortname . '_link_color',
					"std" => "#545454",
					"type" => "color"
				),
				array("name" => 'Link color hover',
				   // "desc" => 'Link color hover',
					"id" => $shortname . '_linkover_color',
					"std" => "#EE3963",
					"type" => "color"
				),
				array("name" => 'Separator color:',
				   // "desc" => 'Separator color:',
					"id" => $shortname . '_linksepa_color',
					"std" => "#E3E3E3",
					"type" => "color"
				),
				/* Links Section */
				array("name" => 'Cart Section',
					"type" => "subsection"
				),
				array("name" => 'Show cart section',
				   // "desc" => "Show cart icon",
					"id" => $shortname . "_show_cart",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				
				array("name" => 'Link color',
				   // "desc" => 'Link color',
					"id" => $shortname . '_cartlink_color',
					"std" => "#66BCDA",
					"type" => "color"),
				array("name" => 'Link color hover',
				   // "desc" => 'Link color hover',
					"id" => $shortname . '_cartlinko_color',
					"std" => "#EE3963",
					"type" => "color"
				),
				array("name" => 'Show cart icon',
				   // "desc" => "Show cart icon",
					"id" => $shortname . "_cart_icon",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => "Cart icon style",
				   // "desc" => "Cart icon style",
					"id" => $shortname . "_carticon_style",
					"std" => "1",
					"type" => "images",
					"options" => array(
						'1' => $url . 'icon_cart_1.png',
						'2' => $url . 'icon_cart_2.png',
						'3' => $url . 'icon_cart_3.png',
						'4' => $url . 'icon_cart_4.png'
					)
				),
				
				array("name" => 'Dropdowns Section',
					"type" => "subsection"
				),
				array("name" => 'Background color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_subsbg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Top bar color:',
				   // "desc" => 'Top bar color:',
					"id" => $shortname . '_subsbar_color',
					"std" => "#333333",
					"type" => "color"
				),
			
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'styling_tab_5',
			'elements' => array(
				array("name" => 'Show background color',
					//"desc" => "Show background color",
					"id" => $shortname . "_mainmenu_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Background color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmbg_color',
					"std" => "#EE3963",
					"type" => "color"
				),
				
				array("name" => 'Item background color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmitembg_color',
					"std" => "",
					"type" => "color"
				),
				
				array("name" => 'Item text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmitemtext_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				
				
				array("name" => 'Item hover background color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmitemhoverbg_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				
				array("name" => 'Item hover text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmitemhovertext_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				
				array("name" => 'Active item background color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmactiveitembg_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				
				array("name" => 'Active item text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_mainmactiveitemtext_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
                            
				
                                array("name" => 'Item border left show',
					//"desc" => "Border top show",
					"id" => $shortname . "_mmileftbor_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
                                array("name" => 'Item border left size',
					//"desc" => '',
					"id" => $shortname . '_mmileftbor_size',
					"std" => "2",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px','3' => '3px','4' => '4px','5' => '5px',)
				),
				array("name" => 'Item border left style',
					//"desc" => '',
					"id" => $shortname . '_mmileftbor_style',
					"std" => "dotted",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Item border left color',
				   // "desc" => '',
					"id" => $shortname . '_mmileftbor_color',
					"std" => "#FF809E",
					"type" => "color"
				),
                            
                            
				array("name" => 'Border top show',
					//"desc" => "Border top show",
					"id" => $shortname . "_mmtopbor_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				array("name" => 'Border top style',
					//"desc" => '',
					"id" => $shortname . '_mainmtop_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'sotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border top color',
				   // "desc" => '',
					"id" => $shortname . '_mainmtopb_color',
					"std" => "#C30B36",
					"type" => "color"
				),				
				array("name" => 'Border bottom show',
					//"desc" => "",
					"id" => $shortname . "_mmbtmbor_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				array("name" => 'Border bottom style',
				   // "desc" => '',
					"id" => $shortname . '_mainbbuttom_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'sotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border bottom color',
				   // "desc" => '',
					"id" => $shortname . '_mainbbuttom_color',
					"std" => "#C30B36",
					"type" => "color"
				),
				array("name" => 'Radius',
					//"desc" => 'Radius',
					"id" => $shortname . '_mainbbuttom_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Shadow',
				   // "desc" => "Shadow",
					"id" => $shortname . "_mainbbuttom_shadow",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				
				/* Sub-Menu */
				array("name" => 'Sub-Menu Section',
					"type" => "subsection"
				),
				array("name" => 'Background color',
				   // "desc" => '',
					"id" => $shortname . '_smenubg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
                                
                            
				array("name" => 'Link color:',
				   // "desc" => 'Link color:',
					"id" => $shortname . '_smenulink_color',
					"std" => "#000000",
					"type" => "color"
				),
				array("name" => 'Link hover background color:',
				   // "desc" => 'Link color:',
					"id" => $shortname . '_smenulink_hover_bg_color',
					"std" => "#f8f8f8",
					"type" => "color"
				),                            
                                array("name" => 'Link color hover:',
				   // "desc" => 'Link color hover:',
					"id" => $shortname . '_smenulinko_color',
					"std" => "#EE3963",
					"type" => "color"
				),
                            
                            
                            
				array("name" => 'Top Border Style',
				   // "desc" => '',
					"id" => $shortname . '_smenusep_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Top Border color',
				   // "desc" => '',
					"id" => $shortname . '_smenusep_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Show background Shadow',
				   // "desc" => "",
					"id" => $shortname . "_smenusep_shadow",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
			)
		);
		
		$of_options[] = array(
		
			'related' => 'styling_tab_6',
			'elements' => array(
				array("name" => 'Product Box',
					"type" => "subsection",
					"help_tip" => "sellya-help-8"
				),				
				array("name" => 'Rating color',
				   // "desc" => '',
					"id" => $shortname . '_proboxrating_color',
					"std" => "#ffca42",
					"type" => "color"
				),				
				array("name" => 'Background color',
				   // "desc" => '',
					"id" => $shortname . '_proboxbg_color',
					"std" => "#F7F7F7",
					"type" => "color"
				),
				array("name" => 'Border color:',
				   // "desc" => '',
					"id" => $shortname . '_proboxbor_color',
					"std" => "#F7F7F7",
					"type" => "color"
				),
				array("name" => 'Background color hover:',
				   // "desc" => '',
					"id" => $shortname . '_proboxbgo_color',
					"std" => "#E9F0F4",
					"type" => "color"
				),
				array("name" => 'Border color hover:',
				   // "desc" => '',
					"id" => $shortname . '_proboxboro_color',
					"std" => "#E9F0F4",
					"type" => "color"
				),
				array("name" => 'Radius',
					//"desc" => '',
					"id" => $shortname . '_probox_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
				array("name" => 'Sale icon color:',
				   // "desc" => '',
					"id" => $shortname . '_proboxicon_color',
					"std" => "#EE3963",
					"type" => "color"
				),
				   /* Product Page - Buy Section */
				array("name" => 'Product Page - Buy Section',
					"type" => "subsection",
					"help_tip" => "sellya-help-9"
				),
					
				array("name" => 'Background color',
					//"desc" => '',
					"id" => $shortname . '_probuybg_color',
					"std" => "#F3F3F3",
					"type" => "color"
				),
				array("name" => 'Border Size',
				   // "desc" => '',
					"id" => $shortname . '_probuysep_size',
					"std" => "1",
					"type" => "select",
					"options" => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')
				),
				array("name" => 'Border Style',
				   // "desc" => '',
					"id" => $shortname . '_probuysep_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border color',
				  //  "desc" => '',
					"id" => $shortname . '_probuysep_color',
					"std" => "#EDEDED",
					"type" => "color"
				),
				array("name" => 'Radius',
				  //  "desc" => '',
					"id" => $shortname . '_probuysep_radius',
					"std" => "0",
					"type" => "select",
					"options" => array('0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')
				),
					/* Product Page - Tabs */
				array("name" => 'Product Page - Tabs',
					"type" => "subsection",
					"help_tip" => "sellya-help-10"
				),					  
				array("name" => 'Background color',
				  //  "desc" => 'Background color',
					"id" => $shortname . '_ppagebg_color',
					"std" => "#F3F3F3",
					"type" => "color"
				),

					/* Product Slider on Home Page */
				array("name" => 'Product Slider on Home Page',
					"type" => "subsection",
					"help_tip" => "sellya-help-11"
				),
					  
				array("name" => 'Background color',
				   // "desc" => '',
					"id" => $shortname . '_psliderbg_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				   
				array("name" => 'Product name color',
					//"desc" => '',
					"id" => $shortname . '_proname_color',
					"std" => "#545454",
					"type" => "color"
				),
				array("name" => 'Product description color:',
				   // "desc" => '',
					"id" => $shortname . '_prodesc_color',
					"std" => "#A3A3A3",
					"type" => "color"
				),
					
				array("name" => 'Product price color:',
				   // "desc" => '',
					"id" => $shortname . '_proprice_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Product links color hover:',
				   // "desc" => '',
					"id" => $shortname . '_prolinkso_color',
					"std" => "#EE3963",
					"type" => "color"
				),
					
				array("name" => 'Bottom bar background color:',
				   // "desc" => '',
					"id" => $shortname . '_probuttombg_color',
					"std" => "#F3F3F3",
					"type" => "color"
				),
				array("name" => 'Bottom bar background color hover:',
				   // "desc" => '',
					"id" => $shortname . '_probottombgo_color',
					"std" => "#F9F9F9",
					"type" => "color"
				),
				array("name" => 'Bottom small bar background color:',
				   // "desc" => '',
					"id" => $shortname . '_probottomsmall_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => '',
				   // "desc" => 'Bottom bar link color:',
					"id" => $shortname . '_probottomlink_color',
					"std" => "#545454",
					"type" => "color"
				),
			)
			
		);
		
		$of_options[] = array(
		
			'related' => 'styling_tab_7',
			'elements' => array(
				array("name" => 'Contact Us, Twitter, Custom Column',
					"type" => "subsection",
					"help_tip" => "sellya-help-12"
				),
				array("name" => 'Background color',
					//"desc" => '',
					"id" => $shortname . '_f1bg_color',
					"std" => "#1F1F1F",
					"type" => "color"
				),
				array("name" => 'Titles color:',
				   // "desc" => '',
					"id" => $shortname . '_bottomatitle_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Border Size',
				   // "desc" => '',
					"id" => $shortname . '_f1btmborder_size',
					"std" => "1",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
				   // "desc" => '',
					"id" => $shortname . '_f1btmborder_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border color',
				   // "desc" => '',
					"id" => $shortname . '_f1btmborder_color',
					"std" => "#2E2E2E",
					"type" => "color"
				),				
				array("name" => 'Text color:',
				   // "desc" => '',
					"id" => $shortname . '_f1text_color',
					"std" => "#A3A3A3",
					"type" => "color"
				),
				array("name" => 'Link color:',
				   // "desc" => '',
					"id" => $shortname . '_f1linkscolor',
					"std" => "#B2B2B2",
					"type" => "color"
				),
				array("name" => 'Link hover color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_f1linkso_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Light text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_f1light_color',
					"std" => "#B2B2B2",
					"type" => "color"
				),
				array("name" => 'Show border Top:',
					//"desc" => "Show border Top",
					"id" => $shortname . "_f1topbor_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Border Size',
					//"desc" => 'Border Size',
					"id" => $shortname . '_f1topborder_size',
					"std" => "3",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
					//"desc" => 'Border Style',
					"id" => $shortname . '_f1topborder_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border color',
					//"desc" => 'Border color',
					"id" => $shortname . '_f1topborder_color',
					"std" => "#616161",
					"type" => "color"
				),
				array("name" => "Contact icons color",
					//"desc" => "Cart icon style",
					"id" => $shortname . "_contact_icon",
					"std" => "11",
					"type" => "images",
					"options" => array(
						'1' => $url . 'icon_contact_skype_1.png',
						'2' => $url . 'icon_contact_skype_2.png',
						'3' => $url . 'icon_contact_skype_3.png',
						'4' => $url . 'icon_contact_skype_4.png',
						'5' => $url . 'icon_contact_skype_5.png',
						'6' => $url . 'icon_contact_skype_6.png',
						'7' => $url . 'icon_contact_skype_7.png',
						'8' => $url . 'icon_contact_skype_8.png',
						'9' => $url . 'icon_contact_skype_9.png',
						'10' => $url . 'icon_contact_skype_10.png',
						'11' => $url . 'icon_contact_skype_11.png',
						'12' => $url . 'icon_contact_skype_12.png',
						'13' => $url . 'icon_contact_skype_13.png'
						
					)
				),
				
				/* Information, Customer Service, Extras, My Account */
				array("name" => 'Information, Customer Service, Extras, My Account',
					"type" => "subsection",
					"help_tip" => "sellya-help-13"
				),
				
				array("name" => 'Background color',
					//"desc" => 'Background color',
					"id" => $shortname . '_f2bg_color',
					"std" => "#191919",
					"type" => "color"
				),
				array("name" => 'Titles color:',
				   // "desc" => 'Titles color',
					"id" => $shortname . '_f2titles_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Border Size',
					//"desc" => 'Border Size',
					"id" => $shortname . '_f2_title_border_size',
					"std" => "1",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
					//"desc" => 'Border Style',
					"id" => $shortname . '_f2_title_border_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border color',
					//"desc" => 'Border color',
					"id" => $shortname . '_f2_title_border_color',
					"std" => "#262626",
					"type" => "color"
				),
				array("name" => 'Link color:',
				   // "desc" => 'Background color',
					"id" => $shortname . '_f2link_color',
					"std" => "#A3A3A3",
					"type" => "color"
				),
				array("name" => 'Link hover color:',
				   // "desc" => 'Background color',
					"id" => $shortname . '_f2linko_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Border top show:',
				   // "desc" => "Border top show",
					"id" => $shortname . "_f2bg_status",
					"type" => "iphone_checkboxes",
					"std" => 0
				),
				   array("name" => 'Border Size',
				   // "desc" => 'Border Size',
					"id" => $shortname . '_f2border_size',
					"std" => "1",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
					//"desc" => 'Border Style',
					"id" => $shortname . '_f2border_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),				
				array("name" => 'Border color',
				   // "desc" => 'Border color',
					"id" => $shortname . '_f2border_color',
					"std" => "#191919",
					"type" => "color"
				),
				
				 /* Footer - Payment Images, Powered by, Follow Us */
				array("name" => 'Footer - Payment Images, Powered by, Follow Us',
					"type" => "subsection",
					"help_tip" => "sellya-help-14"
				),
				
				array("name" => 'Background color:',
				   // "desc" => 'Background color:',
					"id" => $shortname . '_f4bg_color',
					"std" => "#191919",
					"type" => "color"
				),
				array("name" => 'Text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_f4text_color',
					"std" => "#A3A3A3",
					"type" => "color"
				),
				array("name" => 'Link color:',
				   // "desc" => 'Background color',
					"id" => $shortname . '_f4link_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Link hover color:',
				   // "desc" => 'Background color',
					"id" => $shortname . '_f4linko_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Light text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_f4lighttext_color',
					"std" => "#545454",
					"type" => "color"
				),
				array("name" => 'Show border Top:',
				   // "desc" => "Show border Top",
					"id" => $shortname . "_f4border_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Border Size',
					//"desc" => 'Border Size',
					"id" => $shortname . '_f4border_size',
					"std" => "1",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
					//"desc" => 'Border Style',
					"id" => $shortname . '_f4border_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),
				array("name" => 'Border color',
					//"desc" => 'Border color',
					"id" => $shortname . '_f4border_color',
					"std" => "#1F1F1F",
					"type" => "color"
				),
				
					  /*  About Us */
				array("name" => 'About Us',
					"type" => "subsection",
					"help_tip" => "sellya-help-15"
				),
				
				array("name" => 'Background color:',
				   // "desc" => 'Background color:',
					"id" => $shortname . '_f5bg_color',
					"std" => "#191919",
					"type" => "color"
				),
				array("name" => 'Text color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_f5title_color',
					"std" => "#545454",
					"type" => "color"
				),
				array("name" => 'Link color:',
				   // "desc" => 'Background color',
					"id" => $shortname . '_f5link_color',
					"std" => "#66BCDA",
					"type" => "color"
				),
				array("name" => 'Link hover color:',
					//"desc" => 'Background color',
					"id" => $shortname . '_f5linko_color',
					"std" => "#FFFFFF",
					"type" => "color"
				),
				array("name" => 'Show border',
				   // "desc" => "Show border color:",
					"id" => $shortname . "_f5border_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Border Size',
				   // "desc" => 'Border Size',
					"id" => $shortname . '_f5border_size',
					"std" => "1",
					"type" => "select",
					"options" => array('1' => '1px', '2' => '2px', '3' => '3px', '4' => '4px', '5' => '5px')
				),
				array("name" => 'Border Style',
					//"desc" => 'Border Style',
					"id" => $shortname . '_f5border_style',
					"std" => "solid",
					"type" => "select",
					"options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed')
				),				
				array("name" => 'Border color',
					//"desc" => 'Border color',
					"id" => $shortname . '_f5border_color',
					"std" => "#1F1F1F",
					"type" => "color"
				),
			)
		);
				
		/*end Styling*/
		
		/*start Fonts*/
		
		$fonts_op = array();
		
		
		$fonts_op[] = array("name" => 'Body font',
            //"desc" => "Body font",
            "id" => $shortname . "_body_fonts",
            "std" => "",
            "type" => "googlefonts");
		
		$fonts_op[] = array("name" => 'Headings font',
           // "desc" => "Headings font",
            "id" => $shortname . "_headings_fonts",
            "std" => "",
            "type" => "googlefonts");
		
		$fonts_op[] = array("name" => 'Headings Font Weight',
			//"desc" => "Headings Font Weight",
			"id" => $shortname . "_headings_wieight",
			"std" => "normal",
			"type" => "select",
			"options"=>array('normal'=>'Normal','bold'=>'Bold',)   
		);
		$fonts_op[] = array("name" => 'Headings Font Transform',
		   // "desc" => "Headings Font Transform",
			"id" => $shortname . "_headings_transform",
			"type" => "iphone_checkboxes",
			"std" => 1
		);
		// Headings font size
		
		$fonts_op[] = array("name" => 'Box Headings H1 Font Size',
		// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_box_h1_f_size",
			"std" => "16",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')			 
		);
		
		$fonts_op[] = array("name" => 'Headings H1 Font Size',
			// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_h1_f_size",
			"std" => "24",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		);
							
		$fonts_op[] = array("name" => 'Headings H2 Font Size',
			// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_h2_f_size",
			"std" => "20",
			"type" => "select",
			
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		
		);
		
		$fonts_op[] = array("name" => 'Headings H3 Font Size',
			// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_h3_f_size",
			"std" => "18",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		);
		
		$fonts_op[] = array("name" => 'Headings H4 Font Size',
			// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_h4_f_size",
			"std" => "14",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		);
							  
		$fonts_op[] = array("name" => 'Headings H5 Font Size',
			// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_h5_f_size",
			"std" => "12",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		);
		 
		$fonts_op[] = array("name" => 'Headings H6 Font Size',
			// "desc" => "Search Font Size",
			"id" => $shortname . "_heading_h6_f_size",
			"std" => "12",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		);			
		
		
		$fonts_op[] = array("name" => 'Price font',
            //"desc" => "Price font",
            "id" => $shortname . "_price_fonts",
            "std" => "",
            "type" => "googlefonts");
		
		$fonts_op[] = array("name" => 'Price Font Weight',
		//"desc" => "Headings Font Weight",
		"id" => $shortname . "_price_wieight",
		"std" => "normal",
		"type" => "select",
		"options"=>array('normal'=>'Normal','bold'=>'Bold',)   
			);
		
		$fonts_op[] = array("name" => 'Button font',
            //"desc" => "Show Facebook app id",
            "id" => $shortname . "_buttonf_fonts",
            "std" => "",
            "type" => "googlefonts");
		
		$fonts_op[] = array("name" => 'Button Font Weight',
		//"desc" => "Button Font Weight",
		"id" => $shortname . "_buttonf_weight",
		"std" => "normal",
		"type" => "select",
		"options"=>array('normal'=>'Normal','bold'=>'Bold',)   
			);
		$fonts_op[] = array("name" => 'Button Font Transform',
		   // "desc" => "Button Font Transform",
			"id" => $shortname . "_buttonf_transform",
			"type" => "iphone_checkboxes",
			"std" => 1
		);
		$fonts_op[] = array("name" => 'Search font:',
           // "desc" => "Show Facebook app id",
            "id" => $shortname . "_search_fonts",
            "std" => "",
            "type" => "googlefonts"
		);
		$fonts_op[] = array("name" => 'Search Font Weight',
			//"desc" => "Search Font Weight",
			"id" => $shortname . "_searchf_wieight",
			"std" => "normal",
			"type" => "select",
			"options"=>array('normal'=>'Normal','bold'=>'Bold',)   
			);
		$fonts_op[] = array("name" => 'Search Font Size',
		//"desc" => "Search Font Size",
		"id" => $shortname . "_searchf_size",
		"std" => "12",
		"type" => "select",
		"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
			);
		$fonts_op[] = array("name" => 'Search Font Transform',
			//"desc" => "Search Font Transform",
			"id" => $shortname . "_searchf_transform",
			"type" => "iphone_checkboxes",
			"std" => 1
		);
		$fonts_op[] = array("name" => 'Cart font',
           // "desc" => "Show Facebook app id",
            "id" => $shortname . "_cart_fonts",
            "std" => "",
            "type" => "googlefonts"
		);
		$fonts_op[] = array("name" => 'Cart Font Weight',
			//"desc" => "Cart Font Weight",
			"id" => $shortname . "_cartf_weight",
			"std" => "normal",
			"type" => "select",
			"options"=>array('normal'=>'Normal','bold'=>'Bold',)   
		);
		$fonts_op[] = array("name" => 'Cart Font Size',
		//"desc" => "Cart Font Size",
			"id" => $shortname . "_cartf_size",
			"std" => "20",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
			);
		$fonts_op[] = array("name" => 'Cart Font Transform',
			//"desc" => "Cart Font Transform",
			"id" => $shortname . "_cartf_transform",
			"type" => "iphone_checkboxes",
			"std" => 0
		);
		$fonts_op[] = array("name" => 'Main menu font',
            //"desc" => "Show Facebook app id",
            "id" => $shortname . "_mm_fonts",
            "std" => "",
            "type" => "googlefonts"
		);
		$fonts_op[] = array("name" => 'Main menu Font Weight',
		//"desc" => "Main menu Font Weight",
		"id" => $shortname . "_mmf_weight",
		"std" => "normal",
		"type" => "select",
		"options"=>array('normal'=>'Normal','bold'=>'Bold')   
		);
		  $fonts_op[] = array("name" => 'Main menu Font Size',
		//"desc" => "Main menu Font Size",
			"id" => $shortname . "_mmf_size",
			"std" => "15",
			"type" => "select",
			"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
			);
		$fonts_op[] = array("name" => 'Main menu Font Transform',
		   // "desc" => "Main menu Font Transform",
			"id" => $shortname . "_mmf_transform",
			"type" => "iphone_checkboxes",
			"std" => 1
		);
		$fonts_op[] = array("name" => 'Product name font weight:',
		//"desc" => "Product name font weight:",
		"id" => $shortname . "_productname_font_weight",
		"std" => "bold",
		"type" => "select", 
		 "options" =>array('normal'=>'Normal','bold'=>'Bold'));
		 
		$fonts_op[] = array("name" => 'Product name font size:',
		// "desc" => "Product name font size:",
		"id" => $shortname . "_productname_font_size",
		"std" => "12",
		"type" => "select", 
		 "options" =>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')
		 );
		 $fonts_op[] = array("name" => 'Product name List mode font size:',
		//"desc" => "Product name List mode font size:",
		"id" => $shortname . "_productname_list_font_size",
		"std" => "13",
		"type" => "select", 
		 "options" =>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')
		 );
		 
		$fonts_op[] = array("name" => 'Single product page price font size',
		//"desc" => "Single product page price font size",
		"id" => $shortname . "_single_price_font_size",
		"std" => "24",
		"type" => "select",
		"options"=>array('12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px','17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px','21'=>'21px','22'=>'22px','23'=>'23px','24'=>'24px')   
		);
		
		
		$of_options[] = array(		
			'related' => 'of_fonts_op',
			'elements' => $fonts_op
		);
		
		/*end Fonts*/
		
		/*start Product View*/
		
		
		
		$pro_op = array();
		
            $pro_op[] = array("name" => 'Enable Shop',
                "desc" => "Enable or disable shop",
                "id" => $shortname . "_shop_status",
                "type" => "iphone_checkboxes",
                "std" => 1,
            );
		
		
        $pro_op[] = array("name" => 'Show product Social Icon',
            "desc" => "Enter Footer Copyright Text here.",
            "id" => $shortname . "_product_share",
            "type" => "iphone_checkboxes",
            "std" => 1,
        );

        $pro_op[] = array("name" => 'Show Wish list link',
            "desc" => "If you want to show wishlist link on product page.",
            "id" => $shortname . "_show_wishlist",
            "type" => "iphone_checkboxes",
            "std" => 1
        );
        
        $pro_op[] = array("name" => 'Show Color Box in product page',
            "desc" => "Enable or disable color box in product details page .",
            "id" => $shortname . "_en_colorbox",
            "type" => "iphone_checkboxes",
            "std" => 0
        );
		
		
		$of_options[] = array(		
			'related' => 'of_product_view_op',
			'elements' => $pro_op
		);
		
		
		/*end Product View*/		
		/*start Footer*/
		
		$of_options[] = array(		
			'related' => 'footer_tab_1',
			'elements' => array(
				array("name" => 'Show payment icons',
					//"desc" => "Show background color:",
					"id" => $shortname . "_payment_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'PayPal',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_paypal',
					"std" => get_template_directory_uri() . "/image/payment/payment_image_paypal.png",
					"type" => "media"
				),
				array("name" => 'Visa',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_visa',
					"std" => get_template_directory_uri() . "/image/payment/payment_image_visa.png",
					"type" => "media"
				),
				array("name" => 'MasterCard',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_mastercart',
					"std" =>  "",
					"type" => "media"
				),
				array("name" => 'Maestro',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_maestro',
					"std" => get_template_directory_uri() . "/image/payment/payment_image_maestro.png",
					"type" => "media"
				),
				array("name" => 'Discover',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_discover',
					"std" => get_template_directory_uri() . "/image/payment/payment_image_discover.png",
					"type" => "media"),
				array("name" => 'Moneybookers',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_moneybookers',
					"std" =>  get_template_directory_uri() . "/image/payment/payment_image_moneybookers.png",
					"type" => "media"
				),
				array("name" => 'American Express',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_american_express',
					"std" => "",
					"type" => "media"
				),
			)
		);
		
		$of_options[] = array(		
			'related' => 'footer_tab_2',
			'elements' => array(
				array("name" => 'Credits Stuatus',
					//"desc" => "Credits Stuatus",
					"id" => $shortname . "_credits_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Content',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_credits',
					"std" => '<span>&copy; Copyright 2012.</span> <a href="http://321cart.com/">Sellya Theme</a> <span>by</span> 321cart.com<br>
	<span>Powered by</span> <a href="http://wordpress.com/">Wordpress</a>',
					"type" => "textarea"
				),
			)			
		);
		
		$of_options[] = array(		
			'related' => 'footer_tab_3',
			'elements' => array(
				array("name" => 'Show Follow',
				   // "desc" => "Follow Show",
					"id" => $shortname . "_follow_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Facebook:',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_facebook_id',
					"std" => "http://facebook.com",
					"type" => "text"
					),
				array("name" => 'Twitter:',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_twitter_id',
					"std" => "http://twitter.com",
					"type" => "text"
				),
				array("name" => 'Google+:',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_google_id',
					"std" => "http://plus.google.com",
					"type" => "text"
				),
				array("name" => 'RSS url:',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_rss_id',
					"std" => home_url().'/feed',
					"type" => "text"
				),
				array("name" => 'Pinterest:',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_pinterest_id',
					"std" => "http://pinterest.com/",
					"type" => "text"
				),
				array("name" => 'Vimeo',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_vimeo_id',
					"std" => "http://www.vimeo.com/Sellya",
					"type" => "text"
				),
				array("name" => 'Flickr',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_flickr_id',
					"std" => "http://www.flickr.com/photos/Sellya",
					"type" => "text"
				),
				array("name" => 'LinkedIn',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_linkedin_id',
					"std" => "",
					"type" => "text"
				),
				array("name" => 'YouTube',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_youtube',
					"std" => "",
					"type" => "text"
				),
				array("name" => 'Dribbble',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_dribbble',
					"std" => "",
					"type" => "text"
				)
			)
		);
		
		$of_options[] = array(		
			'related' => 'footer_tab_4',
			'elements' => array(
				array("name" => 'Footer About Info',
				  //  "desc" => "Footer About Info",
					"id" => $shortname . "_faboutus_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Footer About Info',
				   // "desc" => 'Footer About Info',
					"id" => $shortname . '_faboutus_text',
					"std" => 'This is a CMS block edited from admin panel. You can insert any content here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non dui at sapien tempor gravida ut vel arcu. Maecenas odio arcu, feugiat vel congue feugiat, laoreet vitae diam. In hac habitasse platea dictumst. Morbi consectetur nunc porta ligula tempor et varius nibh sollicitudin. Mauris risus felis, adipiscing eu consequat ac, aliquam vel urna. Duis bibendum sapien nec mi egestas tempor.',
					"type" => "textarea"
				)
			)
		);
		
		/*end Footer*/
		
		/*start Widgets*/
		
		$of_options[] = array(		
			'related' => 'widgets_tab_1',
			'elements' => array(
				array("name" => 'Show Facebook',
				   // "desc" => "Show Facebook",
					"id" => $shortname . "_widgetfb_status",
					"type" => "iphone_checkboxes",
					"std" => 1,					
				),
				array("name" => 'Facebook ID:',
				   // "desc" => 'Background Attachment',
					"id" => $shortname . '_widgetfb_id',
					"std" => "332747343429694",
					"type" => "textarea",
					"help_tip" => "sellya-help-39"
				 )
			)
		);
		$of_options[] = array(		
			'related' => 'widgets_tab_2',
			'elements' => array(
				array("name" => 'Show Custom Block:',
				   // "desc" => "Show Custom Block",
					"id" => $shortname . "_widgetc_status",
					"type" => "iphone_checkboxes",
					"std" => 1
				),
				array("name" => 'Content',
					//"desc" => 'Background Attachment',
					"id" => $shortname . '_widgetc_content',
					"std" => '<p>
<strong>Custom Box</strong></p>
<p>
This is a CMS box edited from admin panel. You can display a box in the left or right side.</p>
<p>
<img alt="" src="'.get_template_directory_uri().'/image/lcd_d.jpg" /><br />
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed velit urna, elementum at dignissim varius, euismod a elit. Praesent ornare metus eget metus commodo rhoncus.</p>
<p>
<a href="http://themes.smartdatasoft.com/sellya/">Read more</a></p>',
					"type" => "textarea"
				 )
			)
		);
		
		/*end Widgets*/
		
		/*start Sliders*/
		
		$of_options[] = array(		
			'related' => 'of_sliders_op',
			'elements' => array(
				array( "name" => "Home Page Slider Options",
					//"desc" => "Unlimited slider with drag and drop sortings.",
					"id" => "home_camera_slider",
					"std" => "",
					"type" => "slider"
				),
				array( "name" => "Carousel Top Banners Options",
					//"desc" => "Unlimited slider with drag and drop sortings.",
					"id" => "carousel_top_banner_slider",
					"std" => "",
					"type" => "slider"
				)
			)
			
		);
		
		/*end Sliders*/
		
		/*start Custom CSS*/
		$of_options[] = array(		
			'related' => 'of_custom_css_op',
			'elements' => array(
				array("name" => 'Custom stylesheet',
					//"desc" => "Custom stylesheet",
					"id" => $shortname . "_custom_stylesheet",
					"std" => "",
					"type" => "textarea"
				)
			)
			
		);
		
		/*end Custom CSS*/
		
		/*start Backup Options*/
		$of_options[] = array(		
			'related' => 'of_backup_op',
			'elements' => array(
				array("name" => "Backup and Restore Options",
					"id" => $shortname . "of_backup",
					"std" => "",
					"type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				),
				array("name" => "Transfer Theme Options Data",
					"id" => $shortname . "_transfer",
					"std" => "",
					"type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
									'
				)
			)
		);
		
		
		/*end Backup Options*/
		
	} //end function of_options()

} //end if (!function_exists('of_options'))
  
?>