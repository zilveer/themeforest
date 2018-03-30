<?php
/**
 * COLUMNS
 * Shortcode which creates columns for better content separation
 */

 // Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }



if ( !class_exists( 'avia_sc_grid_row' ) )
{
	class avia_sc_grid_row extends aviaShortcodeTemplate{

			static $count = 0;

			/**
			 * Create the config array for the shortcode button
			 */
			function shortcode_insert_button()
			{
				$this->config['name']		= __('Grid Row', 'avia_framework' );
				$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-layout_row.png";
				$this->config['tab']		= __('Layout Elements', 'avia_framework' );
				$this->config['order']		= 15;
				$this->config['shortcode'] 	= 'av_layout_row';
				$this->config['html_renderer'] 	= false;
				$this->config['tinyMCE'] 	= array('disable' => "true");
				$this->config['tooltip'] 	= __('Add multiple Grid Rows below each other to create advanced grid layouts. Cells can be styled individually', 'avia_framework' );
				$this->config['drag-level'] = 1;
				$this->config['drop-level'] = 100;

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
				
				/*
				$params['content'] = trim($params['content']);
				if(empty($params['content'])) $params['content'] = "[av_cell_one_half first][/av_cell_one_half] [av_cell_one_half][/av_cell_one_half]";
*/

			
				extract($params);
				
				$name = $this->config['shortcode'];
				$data['shortcodehandler'] 	= $this->config['shortcode'];
    			$data['modal_title'] 		= $this->config['name'];
    			$data['modal_ajax_hook'] 	= $this->config['shortcode'];
				$data['dragdrop-level'] 	= $this->config['drag-level'];
				$data['allowed-shortcodes']	= $this->config['shortcode'];
				
				if(!empty($this->config['modal_on_load']))
    			{
    				$data['modal_on_load'] 	= $this->config['modal_on_load'];
    			}

    			$dataString  = AviaHelper::create_data_string($data);
				
				
				if($content)
				{
					$final_content = $this->builder->do_shortcode_backend($content);
					$text_area = ShortcodeHelper::create_shortcode_by_array($name, $content, $args);
				}
				else
				{
					$cell = new avia_sc_cell_one_half($this->builder);
					$params = array('content' => "", 'args' => array(), 'data'=>'');
					$final_content  = "";
					$final_content .= $cell->editor_element($params);
					$final_content .= $cell->editor_element($params);
					$text_area = ShortcodeHelper::create_shortcode_by_array($name, '[av_cell_one_half first][/av_cell_one_half] [av_cell_one_half][/av_cell_one_half]', $args);
				
				}


				$output  = "<div class='avia_layout_row avia_layout_section avia_pop_class avia-no-visual-updates ".$name." av_drag' ".$dataString.">";
				$output .= "    <a class='avia-add-cell avia-add'  href='#add-cell' title='".__('Add Cell','avia_framework' )."'>".__('Add Cell','avia_framework' )."</a>";
    				$output .= "    <a class='avia-set-cell-size avia-add'  href='#set-size' title='".__('Set Cell Size','avia_framework' )."'>".__('Set Cell Size','avia_framework' )."</a>";

				$output .= "    <div class='avia_sorthandle menu-item-handle'>";
				$output .= "        <span class='avia-element-title'>".$this->config['name']."</span>";
				$output .= "        <a class='avia-delete'  href='#delete' title='".__('Delete Row','avia_framework' )."'>x</a>";

				if(!empty($this->config['popup_editor']))
    			{
    				$output .= "    <a class='avia-edit-element'  href='#edit-element' title='".__('Edit Row','avia_framework' )."'>".__('edit','avia_framework' )."</a>";
    			}
				$output .= "<a class='avia-save-element'  href='#save-element' title='".__('Save Element as Template','avia_framework' )."'>+</a>";
				$output .= "        <a class='avia-clone'  href='#clone' title='".__('Clone Row','avia_framework' )."' >".__('Clone Row','avia_framework' )."</a></div>";
    								$output .= "    <div class='avia_inner_shortcode avia_connect_sort av_drop' data-dragdrop-level='".$this->config['drop-level']."'>";
				$output .= "<textarea data-name='text-shortcode' cols='20' rows='4'>".$text_area."</textarea>";
				$output .= $final_content;
				$output .= "</div></div>";

				return $output;
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
			    global  $avia_config;

				$this->elements = array(
					
					array(
						"name" 	=> __("Grid Borders",'avia_framework' ),
						"id" 	=> "border",
						"desc"  => __("Choose if your layout grid should display any border",'avia_framework' ),
						"type" 	=> "select",
						"std" 	=> "",
						"subtype" => array(	__('No Borders' , 'avia_framework' ) =>'',
									__('Borders on top and bottom' , 'avia_framework' ) =>'av-border-top-bottom',
									__('Borders between cells' , 'avia_framework' ) =>'av-border-cells',
									__('Borders on top and bottom and between cells' , 'avia_framework' ) =>'av-border-top-bottom av-border-cells',
									)
				    ),
				    
				    array(	
							"name" 	=> __("Minimum height", 'avia_framework' ),
							"desc" 	=> __("Set the minimum height of all the cells in pixel. eg:400px", 'avia_framework' ),
							"id" 	=> "min_height",
							"type" 	=> "input",
							"std" 	=> "0",
						),
				    
					
			        array(
						"name" 	=> __("Section Colors",'avia_framework' ),
						"id" 	=> "color",
						"desc"  => __("The section will use the color scheme you select. Color schemes are defined on your styling page",'avia_framework' ) .
						           '<br/><a target="_blank" href="'.admin_url('admin.php?page=avia#goto_styling').'">'.__("(Show Styling Page)",'avia_framework' )."</a>",
						"type" 	=> "select",
						"std" 	=> "main_color",
						"subtype" =>  array_flip($avia_config['color_sets'])
				    ),
				    
				    
				    array(
						"name" 	=> __("Mobile Behaviour",'avia_framework' ),
						"id" 	=> "mobile",
						"desc"  => __("Choose how the cells inside the grid should behave on mobile devices and small screens",'avia_framework' ),
						"type" 	=> "select",
						"std" 	=> "av-flex-cells",
						"subtype" => array(	__('Default: Each cell is displayed on its own' , 'avia_framework' ) =>'av-flex-cells',
											__('Cells appear beside each other, just like on large screens' , 'avia_framework' ) =>'av-fixed-cells',
									)
				    ),
				    
				    array(	"name" 	=> __("For Developers: Section ID", 'avia_framework' ),
							"desc" 	=> __("Apply a custom ID Attribute to the section, so you can apply a unique style via CSS. This option is also helpful if you want to use anchor links to scroll to a sections when a link is clicked", 'avia_framework' )."<br/><br/>".
									   __("Use with caution and make sure to only use allowed characters. No special characters can be used.", 'avia_framework' ),
				            "id" 	=> "id",
				            "type" 	=> "input",
				            "std" => ""),
				    
                );
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
				avia_sc_grid_row::$count++;
			    $atts = shortcode_atts(array(
				'color'			=> 'main_color',
				'border'		=> '',
				'min_height'	=> '0',
				'mobile'		=> 'av-flex-cells',
				'id'			=> ''
				
				), $atts, $this->config['shortcode']);
				
				extract($atts);
				$output  	= "";
				
				
				$params['class'] = "av-layout-grid-container entry-content-wrapper {$color} {$mobile} {$border}".$meta['el_class'];
				$params['open_structure'] = false; 
				$params['id'] = !empty($id) ? $id : "av-layout-grid-".avia_sc_grid_row::$count;
				$params['custom_markup'] = $meta['custom_markup'];
				
				//we dont need a closing structure if the element is the first one or if a previous fullwidth element was displayed before
				if(isset($meta['index']) && $meta['index'] == 0) $params['close'] = false;
				if(!empty($meta['siblings']['prev']['tag']) && in_array($meta['siblings']['prev']['tag'], AviaBuilder::$full_el_no_section )) $params['close'] = false;
				
				if(isset($meta['index']) && $meta['index'] != 0) $params['class'] .= " submenu-not-first";
				
				
				
				avia_sc_cell::$attr = $atts;
				$output .=  avia_new_section($params);
				$output .=  ShortcodeHelper::avia_remove_autop($content,true) ;
				$output .= avia_section_after_element_content( $meta , 'after_submenu', false);
				
				// added to fix http://www.kriesi.at/support/topic/footer-disseapearing/#post-427764
				avia_sc_section::$close_overlay = "";
				
				
				return $output;
			}
	}
}



