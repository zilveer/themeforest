<?php
	/*	
	*	Goodlayers Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls page builder  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('gdlr_page_builder') ){
		
		class gdlr_page_builder{

			public $setting;
			public $option;
		
			function __construct($setting = array(), $option = array()){
				
				$default_setting = array(
					'post_type' => array('page'),
					'meta_title' => __('Page Builder Options', 'gdlr_translate'),
					'meta_slug' => 'page-builder',
					'position' => 'normal',
					'priority' => 'high',
					'section' => array(
						'above-sidebar' => array( 
							'title' => __('Above Sidebar Section', 'gdlr_translate'),
							'class' => 'above-sidebar-section',
						),
						'content-with-sidebar' => array( 
							'title' => __('Content ( With Sidebar ) Section', 'gdlr_translate'),
							'class' => 'with-sidebar-section',
						),
						'below-sidebar' => array( 
							'title' => __('Below Sidebar Section', 'gdlr_translate'),
							'class' => 'below-sidebar-section',
						)					
					)
				);
				
				$this->setting = wp_parse_args($setting, $default_setting);
				$this->option = $option;
				
				// send the hook to create custom meta box
				add_action('add_meta_boxes', array(&$this, 'add_page_builder_meta'));
				
				// add hook to save the page builder option
				add_action('pre_post_update', array(&$this, 'save_page_builder'));
				
				// add action for ajax call to print the tiny mce editor
				add_action('wp_ajax_gdlr_print_tinymce_editor', array(&$this, 'gdlr_print_tinymce_editor'));					
			}		
			
			// load the necessary script for the page builder item
			function load_admin_script(){
			
				add_action('admin_enqueue_scripts', array(&$this, 'enqueue_wp_media') );
			
				// include the sidebar generator style
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('gdlr-size-controls', GDLR_PATH . '/framework/stylesheet/gdlr-size-controls.css');	
				wp_enqueue_style('gdlr-alert-box', GDLR_PATH . '/framework/stylesheet/gdlr-alert-box.css');	
				wp_enqueue_style('gdlr-edit-box', GDLR_PATH . '/framework/stylesheet/gdlr-edit-box.css');	
				wp_enqueue_style('gdlr-page-builder', GDLR_PATH . '/framework/stylesheet/gdlr-page-builder.css');					
				
				wp_enqueue_script('wp-color-picker');
				wp_enqueue_script('gdlr-utility', GDLR_PATH . '/framework/javascript/gdlr-utility.js');	
				wp_enqueue_script('gdlr-alert-box', GDLR_PATH . '/framework/javascript/gdlr-alert-box.js');
				wp_enqueue_script('gdlr-edit-box', GDLR_PATH . '/framework/javascript/gdlr-edit-box.js');
				wp_enqueue_script('gdlr-edit-box-tab', GDLR_PATH . '/framework/javascript/gdlr-edit-box-tab.js');
				wp_enqueue_script('gdlr-slider-selection', GDLR_PATH . '/framework/javascript/gdlr-slider-selection.js');
				wp_enqueue_script('gdlr-page-builder', GDLR_PATH . '/framework/javascript/gdlr-page-builder.js');
				
				wp_localize_script( 'gdlr-edit-box', 'GDLR', array('ajax_url'=>AJAX_URL) );
			}	
			function enqueue_wp_media(){
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
			}			
			
			// create the page builder meta at the add_meta_boxes hook
			function add_page_builder_meta(){
				global $post; 
				
				if( in_array($post->post_type, $this->setting['post_type']) ){
					$this->load_admin_script();
					
					foreach( $this->setting['post_type'] as $post_type ){
						add_meta_box(
							$this->setting['meta_slug'],
							$this->setting['meta_title'],
							array(&$this, 'create_page_builder_elements'),
							$post_type,
							$this->setting['position'],
							$this->setting['priority']
						);			
					}
				}
				
			}
		
			// start creating the page builder element
			function create_page_builder_elements(){		
				echo '<div class="gdlr-page-builder" id="gdlr-page-builder">';
				
				echo '<div id="page-builder-add-item" class="page-builder-creator-wrapper">';
				$this->print_page_builder_creator();
				echo '</div>';
				
				echo '<div id="page-builder-default-item">';
				$this->print_page_builder_default_item();
				echo '</div>';
				
				echo '<div id="page-builder-content-item" class="page-builder-content-wrapper">';
				$this->print_page_builder_content();
				echo '</div>';
				
				echo '</div>'; // gdlr-page-builder
			}
			
			// add page builder section
			function print_page_builder_creator(){
				
				// head section
				echo '<div class="page-builder-head-wrapper">';
				echo '<h4 class="page-builder-head add-content">' . __('Add Content Item', 'gdlr_translate') . '</h4>';
				echo '</div>';
				
				echo '<div class="page-builder-creator">';
				foreach( $this->option as $add_item_slug => $add_item_wrapper ){
					echo '<div class="item-selector-wrapper">';
					echo '<h5 class="item-selector-header">' . $add_item_wrapper['title'] . '</h5>'; 
					
					echo '<div class="gdlr-combobox-wrapper" >';
					echo '<select class="content-item-selector" >';
					echo '<option>' . $add_item_wrapper['blank_option'] . '</option>';
					foreach( $add_item_wrapper['options'] as $item_slug => $item_wrapper ){
						if( !empty($item_wrapper) ){
							echo '<option value="' . $item_slug . '" >';
							echo (!empty($item_wrapper['size']))? $item_wrapper['size'] . ' ': '';
							echo $item_wrapper['title'] . '</option>';
						}
					}
					echo '</select>';
					echo '</div>'; // gdlr-combobox-wrapper
					
					echo '<input class="gdl-add-item" type="button" value="+" />';
					echo '</div>'; // item selector wrapper
				}
				
				echo '<div class="clear"></div>';
				echo '</div>';
			
			}
			
			// print default item to be a prototype
			function print_page_builder_default_item(){
				$page_builder_html = new gdlr_page_builder_html();
			
				foreach( $this->option as $add_item_slug => $add_item_wrapper ){
					foreach( $add_item_wrapper['options'] as $item_slug => $item_wrapper ){
						echo '<div id="' . $item_slug . '-default" >';

						// dragable section
						$item_wrapper['slug'] = $item_slug; 
						if( $item_wrapper['type'] == 'wrapper' ){
							$page_builder_html->print_draggable_wrapper($item_wrapper);
						}else{
							$page_builder_html->print_draggable_item($item_wrapper);
						}

						echo '</div>';
					}
				}
			}
			
			// merge all options to use in html section
			function merge_page_builder_items(){
				$all_items = array();
				
				foreach( $this->option as $items ){
					if( !empty($items['options']) ){
						$all_items = array_merge($all_items, $items['options']);
					}
				}
				
				return $all_items;
			}
			
			// page builder content section
			function print_page_builder_content(){
				global $post;
				
				$page_builder_html = new gdlr_page_builder_html( $this->merge_page_builder_items() );
				
				// head section
				echo '<div class="page-builder-head-wrapper">';
				echo '<h4 class="page-builder-head page-builder">' . __('Page Builder Section', 'gdlr_translate') . '</h4>';
				
				echo '<div class="command-button-wrapper">';
				echo '<input class="undo-button" type="button" value="' . __('Undo', 'gdlr_translate') . '" />';
				echo '<input class="redo-button" type="button" value="' . __('Redo', 'gdlr_translate') . '" />';
				echo '</div>';	
				echo '</div>'; // page-builder-head-wrapper
				
				echo '<div class="page-builder-content">';
				
				foreach( $this->setting['section'] as $section_slug => $section ){
					$value = gdlr_decode_preventslashes(get_post_meta($post->ID, $section_slug, true));
					$array_value = json_decode( $value, true );
					
					echo '<div class="content-section-wrapper ' . $section['class'] . '">';
					echo '<div class="content-section-head-wrapper active">';
					echo '<h6 class="content-section-head">' . $section['title'] . '</h6>';
					echo '</div>';
					
					echo '<div class="gdlr-sortable-wrapper" data-type="' . $section['class'] . '" >';
					echo '<div class="page-builder-item-area gdlr-sortable clear-fix row ';
					echo (!empty($array_value))? '': 'blank';
					echo '" >';
					$page_builder_html->print_page_builder( $array_value );	
					echo '</div>';
					echo '</div>'; // gdlr-sortable-wrapper
					
					echo '<textarea class="gdlr-input-hidden" name="' . $section_slug . '" >' . esc_textarea($value) . '</textarea>';
					echo '</div>'; // content-section-wrapper
					
					echo '<div class="clear"></div>';
				}
				echo '</div>'; // page-builder-content
			
			}
			
			// function to allow printing the editor on ajax call
			function gdlr_print_tinymce_editor(){
				wp_editor( gdlr_stripslashes($_POST['content']), 
					$_POST['id'], array('textarea_name'=> $_POST['name']) );			
				die();
			}	
			
			// save page builder setting
			function save_page_builder( $post_id ){
				foreach( $this->setting['section'] as $section_slug => $section ){
					if( isset($_POST[$section_slug]) ){
						update_post_meta($post_id, $section_slug, gdlr_preventslashes($_POST[$section_slug]));
					}
				}
			}
			
		}
		
		
	}

?>