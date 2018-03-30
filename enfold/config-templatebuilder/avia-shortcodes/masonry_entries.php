<?php
/**
 * Masonry
 * Shortcode that allows to display a fullwidth masonry of any post type
 */

if ( !class_exists( 'avia_sc_masonry_entries' ) ) 
{
	class avia_sc_masonry_entries extends aviaShortcodeTemplate
	{	
			/**
			 * Create the config array for the shortcode button
			 */
			function shortcode_insert_button()
			{
				$this->config['name']			= __('Masonry', 'avia_framework' );
				$this->config['tab']			= __('Content Elements', 'avia_framework' );
				$this->config['icon']			= AviaBuilder::$path['imagesURL']."sc-masonry.png";
				$this->config['order']			= 38;
				$this->config['target']			= 'avia-target-insert';
				$this->config['shortcode'] 		= 'av_masonry_entries';
				$this->config['tooltip'] 	    = __('Display a fullwidth masonry/grid with blog entries', 'avia_framework' );
				$this->config['drag-level'] 	= 3;
			}
			
			
			function extra_assets()
			{
				add_action('wp_ajax_avia_ajax_masonry_more', array('avia_masonry','load_more'));
				add_action('wp_ajax_nopriv_avia_ajax_masonry_more', array('avia_masonry','load_more'));
				
				if(!is_admin() && !current_theme_supports('avia_no_session_support') && !session_id()) session_start();
			}
			

			/**
			 * Popup Elements
			 *
			 * If this function is defined in a child class the element automatically gets an edit button, that, when pressed
			 * opens a modal window that allows to edit the element properties
			 *
			 * @return void
			 */
			function popup_elements()
			{
				$this->elements = array(

				array(
							"type" 	=> "tab_container", 'nodescription' => true
						),
						
				array(
						"type" 	=> "tab",
						"name"  => __("Masonry Content" , 'avia_framework'),
						'nodescription' => true
					),
					
					
                   array(
						"name" 	=> __("Which Entries?", 'avia_framework' ),
						"desc" 	=> __("Select which entries should be displayed by selecting a taxonomy", 'avia_framework' ),
						"id" 	=> "link",
						"fetchTMPL"	=> true,
						"type" 	=> "linkpicker",
						"subtype"  => array( __('Display Entries from:',  'avia_framework' )=>'taxonomy'),
						"multiple"	=> 6,
						"std" 	=> "category"
				),
				
				array(
						"name" 	=> __("Sortable?", 'avia_framework' ),
						"desc" 	=> __("Should sorting options based on the taxonomies above be displayed?", 'avia_framework' ),
						"id" 	=> "sort",
						"type" 	=> "select",
						"std" 	=> "yes",
						"subtype" => array(
							__('Yes, display sort options',  'avia_framework' ) => 'yes',
							__('Yes, display sort options and currently active taxonomy',  'avia_framework' ) => 'yes-tax',
							__('No, do not display sort options',  'avia_framework' )  => 'no')),
				
				array(
					"name" 	=> __("Post Number", 'avia_framework' ),
					"desc" 	=> __("How many items should be displayed per page?", 'avia_framework' ),
					"id" 	=> "items",
					"type" 	=> "select",
					"std" 	=> "12",
					"subtype" => AviaHtmlHelper::number_array(1,100,1, array('All'=>'-1'))),
				
				array(
					"name" 	=> __("Columns", 'avia_framework' ),
					"desc" 	=> __("How many columns do you want to display?", 'avia_framework' ),
					"id" 	=> "columns",
					"type" 	=> "select",
					"std" 	=> "flexible",
					"subtype" => array(
						__('Automatic, based on screen width',  'avia_framework' ) =>'flexible',
						__('2 Columns',  'avia_framework' ) =>'2',
						__('3 Columns',  'avia_framework' ) =>'3',
						__('4 Columns',  'avia_framework' ) =>'4',
						__('5 Columns',  'avia_framework' ) =>'5',
						__('6 Columns',  'avia_framework' ) =>'6',
						
						)),
				
				
				
				array(
					"name" 	=> __("Pagination", 'avia_framework' ),
					"desc" 	=> __("Should a pagination or load more option be displayed to view additional entries?", 'avia_framework' ),
					"id" 	=> "paginate",
					"type" 	=> "select",
					"std" 	=> "yes",
					"required" => array('items','not','-1'),
					"subtype" => array(
						__('Display Pagination',  'avia_framework' ) =>'pagination',
						__('Display "Load More" Button',  'avia_framework' ) =>'load_more',
						__('No option to view additional entries',  'avia_framework' ) =>'none')),
				
				array(
            			    "name" => __("Order by",'avia_framework' ),
							"desc" 	=> __("You can order the result by various attributes like creation date, title, author etc", 'avia_framework' ),
            			    "id"   => "query_orderby",
            			    "type" 	=> "select",
            			    "std" 	=> "date",
            			    "subtype" => array(
            			        __('Date',  'avia_framework' ) =>'date',
            			        __('Title',  'avia_framework' ) =>'title',
            			        __('Random',  'avia_framework' ) =>'rand',
            			        __('Author',  'avia_framework' ) =>'author',
            			        __('Name (Post Slug)',  'avia_framework' ) =>'name',
            			        __('Last modified',  'avia_framework' ) =>'modified',
            			        __('Comment Count',  'avia_framework' ) =>'comment_count',
            			        __('Page Order',  'avia_framework' ) =>'menu_order')
            			),
            			
                  array(
                    "name" => __("Display order",'avia_framework' ),
			        "desc" 	=> __("Display the results either in ascending or descending order", 'avia_framework' ),
                    "id"   => "query_order",
                    "type" 	=> "select",
                    "std" 	=> "DESC",
                    "subtype" => array(
                        __('Ascending Order',  'avia_framework' ) =>'ASC',
                        __('Descending Order',  'avia_framework' ) =>'DESC')
              	),
              			
              				
				array(
					"name" 	=> __("Size Settings", 'avia_framework' ),
					"desc" 	=> __("Here you can select how the masonry should behave and handle all entries and the feature images of those entries", 'avia_framework' ),
					"id" 	=> "size",
					"type" 	=> "radio",
					"std" 	=> "fixed masonry",
					"options" => array(
						'flex' => __('Flexible Masonry: All entries get the same width but Images of each entry are displayed with their original height and width ratio',  'avia_framework' ),
						'fixed' => __('Perfect Grid: Display a perfect grid where each element has exactly the same size. Images get cropped/stretched if they don\'t fit',  'avia_framework' ),
						'fixed masonry' => __('Perfect Automatic Masonry: Display a grid where most elements get the same size, only elements with very wide images get twice the width and elements with very high images get twice the height. To qualify for "very wide" or "very high" the image must have a aspect ratio of 16:9 or higher',  'avia_framework' ),
						'fixed manually' => __('Perfect Manual Masonry: Manually control the height and width of entries by adding either a "landscape" or "portrait" tag when creating the entry. Elements with no such tag use a fixed default size, elements with both tags will display extra large',  'avia_framework' ),
					)),
					
					
				array(
					"name" 	=> __("Gap between elements", 'avia_framework' ),
					"desc" 	=> __("Select the gap between the elements", 'avia_framework' ),
					"id" 	=> "gap",
					"type" 	=> "select",
					"std" 	=> "1px",
					"subtype" => array(
						__('No Gap',  'avia_framework' ) =>'no',
						__('1 Pixel Gap',  'avia_framework' ) =>'1px',
						__('Large Gap',  'avia_framework' ) =>'large',
					)),
				
				
				
				array(
					"name" 	=> __("Image overlay effect", 'avia_framework' ),
					"desc" 	=> __("Do you want to display the image overlay?", 'avia_framework' ),
					"id" 	=> "overlay_fx",
					"type" 	=> "select",
					"std" 	=> "active",
					"subtype" => array(
						__('Overlay activated',  'avia_framework' ) =>'active',
						__('Overlay deactivated',  'avia_framework' ) =>'',
					)),
				
				array(	"name" 	=> __("For Developers: Section ID", 'avia_framework' ),
						"desc" 	=> __("Apply a custom ID Attribute to the section, so you can apply a unique style via CSS. This option is also helpful if you want to use anchor links to scroll to a sections when a link is clicked", 'avia_framework' )."<br/><br/>".
								   __("Use with caution and make sure to only use allowed characters. No special characters can be used.", 'avia_framework' ),
			            "id" 	=> "id",
			            "type" 	=> "input",
			            "std" => ""),
				
				array(
							"type" 	=> "close_div",
							'nodescription' => true
						),
					
					array(
							"type" 	=> "tab",
							"name"	=> __("Element captions",'avia_framework' ),
							'nodescription' => true
						),	
				
				array(
					"name" 	=> __("Element Title and Excerpt", 'avia_framework' ),
					"desc" 	=> __("You can choose if you want to display title and/or excerpt", 'avia_framework' ),
					"id" 	=> "caption_elements",
					"type" 	=> "select",
					"std" 	=> "title excerpt",
					"subtype" => array(
						__('Display Title and Excerpt',  'avia_framework' ) =>'title excerpt',
						__('Display Title',  'avia_framework' ) =>'title',
						__('Display Excerpt',  'avia_framework' ) =>'excerpt',
						__('Display Neither',  'avia_framework' ) =>'none',
					)),	
				
				
				array(
					"name" 	=> __("Element Title and Excerpt Styling", 'avia_framework' ),
					"desc" 	=> __("You can choose the styling for the title and excerpt here", 'avia_framework' ),
					"id" 	=> "caption_styling",
					"type" 	=> "select",
					"std" 	=> "always",
					"required" => array('caption_elements','not','none'),
					"subtype" => array(
						__('Default display (at the bottom of the elements image)',  'avia_framework' ) =>'',
						__('Display as centered overlay (overlays the image)',  'avia_framework' ) =>'overlay',
					)),	
				
				
					
				array(
					"name" 	=> __("Element Title and Excerpt display settings", 'avia_framework' ),
					"desc" 	=> __("You can choose whether to always display Title and Excerpt or only on hover", 'avia_framework' ),
					"id" 	=> "caption_display",
					"type" 	=> "select",
					"std" 	=> "always",
					"required" => array('caption_elements','not','none'),
					"subtype" => array(
						__('Always Display',  'avia_framework' ) =>'always',
						__('Display on mouse hover',  'avia_framework' ) =>'on-hover',
						__('Hide on mouse hover',  'avia_framework' ) =>'on-hover-hide',
					)),	
					
					
				 
			     array(
							"type" 	=> "close_div",
							'nodescription' => true
						),
						
				array(
						"type" 	=> "tab",
						"name"  => __("Element Colors" , 'avia_framework'),
						'nodescription' => true
					),
					
				array(
							"name" 	=> __("Custom Colors", 'avia_framework' ),
							"desc" 	=> __("Either use the themes default colors or apply some custom ones", 'avia_framework' ),
							"id" 	=> "color",
							"type" 	=> "select",
							"std" 	=> "",
							"subtype" => array( __('Default', 'avia_framework' )=>'',
												__('Define Custom Colors', 'avia_framework' )=>'custom'),
												
					),
					
					array(	
							"name" 	=> __("Custom Background Color", 'avia_framework' ),
							"desc" 	=> __("Select a custom background color. Leave empty to use the default", 'avia_framework' ),
							"id" 	=> "custom_bg",
							"type" 	=> "colorpicker",
							"std" 	=> "",
							//"container_class" => 'av_third av_third_first',
							"required" => array('color','equals','custom')
						),	
						
				
				array(
						"type" 	=> "close_div",
						'nodescription' => true
					),
				
						
				array(
							"type" 	=> "close_div",
							'nodescription' => true
						),
					
				);


				if(current_theme_supports('add_avia_builder_post_type_option'))
                {
                    $element = array(
                        "name" 	=> __("Select Post Type", 'avia_framework' ),
                        "desc" 	=> __("Select which post types should be used. Note that your taxonomy will be ignored if you do not select an assign post type.
                                      If yo don't select post type all registered post types will be used", 'avia_framework' ),
                        "id" 	=> "post_type",
                        "type" 	=> "select",
                        "multiple"	=> 6,
                        "std" 	=> "",
                        "subtype" => AviaHtmlHelper::get_registered_post_type_array()
                    );

                    array_unshift($this->elements, $element);
                }

			}
			
			/**
			 * Editor Element - this function defines the visual appearance of an element on the AviaBuilder Canvas
			 * Most common usage is to define some markup in the $params['innerHtml'] which is then inserted into the drag and drop container
			 * Less often used: $params['data'] to add data attributes, $params['class'] to modify the className
			 *
			 *
			 * @param array $params this array holds the default values for $content and $args. 
			 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
			 */
			function editor_element($params)
			{	
				$params['innerHtml'] = "<img src='".$this->config['icon']."' title='".$this->config['name']."' />";
				$params['innerHtml'].= "<div class='avia-element-label'>".$this->config['name']."</div>";
				
				$params['innerHtml'].= "<div class='avia-flex-element'>"; 
				$params['innerHtml'].= 		__('This element will stretch across the whole screen by default.','avia_framework')."<br/>";
				$params['innerHtml'].= 		__('If you put it inside a color section or column it will only take up the available space','avia_framework');
				$params['innerHtml'].= "	<div class='avia-flex-element-2nd'>".__('Currently:','avia_framework');
				$params['innerHtml'].= "	<span class='avia-flex-element-stretched'>&laquo; ".__('Stretch fullwidth','avia_framework')." &raquo;</span>";
				$params['innerHtml'].= "	<span class='avia-flex-element-content'>| ".__('Adjust to content width','avia_framework')." |</span>";
				$params['innerHtml'].= "</div></div>";
				
				return $params;
			}
			
			/**
			 * Editor Sub Element - this function defines the visual appearance of an element that is displayed within a modal window and on click opens its own modal window
			 * Works in the same way as Editor Element
			 * @param array $params this array holds the default values for $content and $args. 
			 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
			 */
			function editor_sub_element($params)
			{	
				$img_template 		= $this->update_template("img_fakeArg", "{{img_fakeArg}}");
				$template 			= $this->update_template("title", "{{title}}");
				$content 			= $this->update_template("content", "{{content}}");
				
				$thumbnail = isset($params['args']['id']) ? wp_get_attachment_image($params['args']['id']) : "";
				
		
				$params['innerHtml']  = "";
				$params['innerHtml'] .= "<div class='avia_title_container'>";
				$params['innerHtml'] .= "	<span class='avia_slideshow_image' {$img_template} >{$thumbnail}</span>";
				$params['innerHtml'] .= "	<div class='avia_slideshow_content'>";
				$params['innerHtml'] .= "		<h4 class='avia_title_container_inner' {$template} >".$params['args']['title']."</h4>";
				$params['innerHtml'] .= "		<p class='avia_content_container' {$content}>".stripslashes($params['content'])."</p>";
				$params['innerHtml'] .= "	</div>";
				$params['innerHtml'] .= "</div>";
				
				
				
				return $params;
			}
			
			
			
			/**
			 * Frontend Shortcode Handler
			 *
			 * @param array $atts array of attributes
			 * @param string $content text within enclosing form of shortcode element 
			 * @param string $shortcodename the shortcode found, when == callback name
			 * @return string $output returns the modified html string 
			 */
			
			function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
			{
				$output  = "";
				
				$params['class'] = "main_color ".$meta['el_class'];
				$params['open_structure'] = false;
				$params['id'] = !empty($atts['id']) ? AviaHelper::save_string($atts['id'],'-') : "";
				$params['custom_markup'] = $meta['custom_markup'];
				if( ($atts['gap'] == 'no' && $atts['sort'] == "no") || $meta['index'] == 0) $params['class'] .= " avia-no-border-styling";
				
				//we dont need a closing structure if the element is the first one or if a previous fullwidth element was displayed before
				if($meta['index'] == 0) $params['close'] = false;
				if(!empty($meta['siblings']['prev']['tag']) && in_array($meta['siblings']['prev']['tag'], AviaBuilder::$full_el_no_section )) $params['close'] = false;
				
				if($meta['index'] != 0) $params['class'] .= " masonry-not-first";
				if($meta['index'] == 0 && get_post_meta(get_the_ID(), 'header', true) != "no") $params['class'] .= " masonry-not-first";
				
				$masonry  = new avia_masonry($atts);
				$masonry->extract_terms();
				$masonry->query_entries();
				$masonry_html = $masonry->html();
				

				if(!ShortcodeHelper::is_top_level()) return $masonry_html;
				
				
				if( !empty( $atts['color'] ) && !empty( $atts['custom_bg']) )
				{
					$params['class'] .= " masonry-no-border";
				}
				
				$output .=  avia_new_section($params);
				$output .= $masonry_html;
				$output .= avia_section_after_element_content( $meta , 'after_masonry' );
				
				return $output;
			}
			
	}
}









