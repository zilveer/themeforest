<?php
	/*	
	*	Goodlayers Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls page builder  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('gdlr_page_options') ){
		
		class gdlr_page_options{

			public $setting;
			public $option;
		
			function __construct($setting = array(), $option = array()){
				
				$default_setting = array(
					'post_type' => array('page'),
					'meta_title' => __('Goodlayers Page Option', 'gdlr_translate'),
					'meta_slug' => 'goodlayers-page-option',
					'option_name' => 'post-option',
					'position' => 'side',
					'priority' => 'high',
				);
				
				$this->setting = wp_parse_args($setting, $default_setting);
				$this->option = $option;
				
				// send the hook to create custom meta box
				add_action('add_meta_boxes', array(&$this, 'add_page_option_meta'));

				// add hook to save page options
				add_action('pre_post_update', array(&$this, 'save_page_option'));
			}			
			
			// load the necessary script for the page builder item
			function load_admin_script(){

				add_action('admin_enqueue_scripts', array(&$this, 'enqueue_wp_media') );
			
				// include the sidebar generator style
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('gdlr-alert-box', GDLR_PATH . '/framework/stylesheet/gdlr-alert-box.css');	
				wp_enqueue_style('gdlr-page-option', GDLR_PATH . '/framework/stylesheet/gdlr-page-option.css');
				wp_enqueue_style('gdlr-admin-panel-html', GDLR_PATH . '/framework/stylesheet/gdlr-admin-panel-html.css');	
				wp_enqueue_style('gdlr-edit-box', GDLR_PATH . '/framework/stylesheet/gdlr-edit-box.css');				
				wp_enqueue_style('gdlr-date-picker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');				

				// include the sidebar generator script
				wp_enqueue_script('wp-color-picker');
				wp_enqueue_script('gdlr-utility', GDLR_PATH . '/framework/javascript/gdlr-utility.js');	
				wp_enqueue_script('gdlr-alert-box', GDLR_PATH . '/framework/javascript/gdlr-alert-box.js');
				wp_enqueue_script('gdlr-page-option', GDLR_PATH . '/framework/javascript/gdlr-page-option.js');
				wp_enqueue_script('gdlr-admin-panel-html', GDLR_PATH . '/framework/javascript/gdlr-admin-panel-html.js');
				wp_enqueue_script('gdlr-edit-box', GDLR_PATH . '/framework/javascript/gdlr-edit-box.js');	
				wp_enqueue_script('gdlr-slider-selection', GDLR_PATH . '/framework/javascript/gdlr-slider-selection.js');					
				wp_enqueue_script('jquery-ui-datepicker');					
			}			
			function enqueue_wp_media(){
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
			}
			
			// create the page builder meta at the add_meta_boxes hook
			function add_page_option_meta(){
				global $post;
				
				if( in_array($post->post_type, $this->setting['post_type']) ){
					$this->load_admin_script();
				
					foreach( $this->setting['post_type'] as $post_type ){
						add_meta_box(
							$this->setting['meta_slug'],
							$this->setting['meta_title'],
							array(&$this, 'create_page_option_elements'),
							$post_type,
							$this->setting['position'],
							$this->setting['priority']
						);			
					}
				}
				
			}
		
			// start creating the page builder element
			function create_page_option_elements(){
				global $post;

				$option_value = gdlr_decode_preventslashes(get_post_meta( $post->ID, $this->setting['option_name'], true ));
				if( !empty($option_value) ){
					$option_value = json_decode( $option_value, true );					
				}
	
				$option_generator = new gdlr_admin_option_html();
				
				echo '<div class="gdlr-page-option-wrapper position-' . $this->setting['position'] . '" >';
				
				foreach( $this->option as $option_section ){
					echo '<div class="gdlr-page-option">';
					echo '<div class="gdlr-page-option-title">' . $option_section['title'] . '</div>';
					echo '<div class="gdlr-page-option-input-wrapper">';
					
					foreach ( $option_section['options'] as $option_slug => $option ){
						$option['slug'] = $option_slug;
						$option['name'] = '';
						if( !empty($option_value) && isset($option_value[$option_slug]) ){
							$option['value'] = $option_value[$option_slug];
						}
						
						$option_generator->generate_admin_option( $option );
					}
					
					echo '</div>'; // page-option-input-wrapper
					echo '</div>'; // page-option-title
					
					
				}
				echo '<textarea class="gdlr-input-hidden" name="' . $this->setting['option_name'] . '"></textarea>';
				echo '</div>'; // gdlr-page-option-wrapper
			}
			
			// save page option setting
			function save_page_option( $post_id ){
				if( isset($_POST[$this->setting['option_name']]) ){
					update_post_meta($post_id, $this->setting['option_name'], gdlr_preventslashes($_POST[$this->setting['option_name']]));
				}
			}
			
		}
		
		
	}

?>