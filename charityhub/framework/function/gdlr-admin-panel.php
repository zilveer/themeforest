<?php
	/*	
	*	Goodlayers Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls admin  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('gdlr_admin_option') ){
		
		class gdlr_admin_option{
			
			public $setting;
			public $option;		
			public $value;
			
			function __construct($setting = array(), $option = array(), $value = array()){
				
				$default_setting = array(
					'page_title' => __('Custom Option', 'gdlr_translate'),
					'menu_title' => __('Custom Menu', 'gdlr_translate'),
					'menu_slug' => 'custom-menu',
					'save_option' => 'gdlr_admin_option',
					'role' => 'edit_theme_options',
					'icon_url' => '',
					'position' => 82
				);
				
				$this->setting = wp_parse_args($setting, $default_setting);
				$this->option = $option;
				$this->value = $value;

				new gdlr_theme_customizer($option);
				
				// send the hook to create the admin menu
				add_action('admin_menu', array(&$this, 'register_main_admin_option'));
				
				// set the hook for saving the admin menu
				add_action('wp_ajax_gdlr_save_admin_panel', array(&$this, 'gdlr_save_admin_panel'));
			}
			
			// create the admin menu
			function register_main_admin_option(){
				
				// add the hook to create admin option
				$page = add_menu_page($this->setting['page_title'], $this->setting['menu_title'], 
					$this->setting['role'], $this->setting['menu_slug'], 
					array(&$this, 'create_admin_option'), 
					$this->setting['icon_url'], $this->setting['position']); 

				// include the script to admin option
				add_action('admin_print_styles-' . $page, array(&$this, 'register_admin_option_style'));	
				add_action('admin_print_scripts-' . $page, array(&$this, 'register_admin_option_script'));			
			}
			
			// include script and style when you're on admin option
			function register_admin_option_style(){
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('gdlr-alert-box', GDLR_PATH . '/framework/stylesheet/gdlr-alert-box.css');						
				wp_enqueue_style('gdlr-admin-panel', GDLR_PATH . '/framework/stylesheet/gdlr-admin-panel.css');						
				wp_enqueue_style('gdlr-admin-panel-html', GDLR_PATH . '/framework/stylesheet/gdlr-admin-panel-html.css');
				wp_enqueue_style('gdlr-date-picker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');				
			}
			function register_admin_option_script(){
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
				
				wp_enqueue_script('jquery-ui-datepicker');	
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('jquery-ui-slider');
				wp_enqueue_script('wp-color-picker');			
				wp_enqueue_script('gdlr-alert-box', GDLR_PATH . '/framework/javascript/gdlr-alert-box.js');
				wp_enqueue_script('gdlr-admin-panel', GDLR_PATH . '/framework/javascript/gdlr-admin-panel.js');
				wp_enqueue_script('gdlr-admin-panel-html', GDLR_PATH . '/framework/javascript/gdlr-admin-panel-html.js');
			}
			
			// saving admin option
			function gdlr_save_admin_panel(){
				if( !check_ajax_referer(THEME_SHORT_NAME . '-create-nonce', 'security', false) ){
					die(json_encode(array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . __('Invalid Nonce', 'gdlr_translate') . '</span> ' .
							__('Please refresh the page and try this again.' ,'gdlr_translate')
					)));
				}
				
				if( isset($_POST['option']) ){		
					parse_str(gdlr_stripslashes($_POST['option']), $option ); 
					$option = gdlr_stripslashes($option);
					
					$old_option = get_option($this->setting['save_option']);
					  
					if($old_option == $option || update_option($this->setting['save_option'], $option)){
						$ret = array(
							'status'=> 'success', 
							'message'=> '<span class="head">' . __('Save Options Complete' ,'gdlr_translate') . '</span> '
						);		
					}else{
						$ret = array(
							'status'=> 'failed', 
							'message'=> '<span class="head">' . __('Save Options Failed', 'gdlr_translate') . '</span> ' .
							__('Please refresh the page and try this again.' ,'gdlr_translate')
						);					
					}
				}else{
					$ret = array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . __('Cannot Retrieve Options', 'gdlr_translate') . '</span> ' .
							__('Please refresh the page and try this again.' ,'gdlr_translate')
					);	
				}
				
				do_action('gdlr_save_' . $this->setting['menu_slug'], $this->option);
				
				die(json_encode($ret));
			}
			
			// creating the content of the admin option
			function create_admin_option(){
				echo '<div class="gdlr-admin-panel-wrapper">';

				echo '<form action="#" method="POST" id="gdlr-admin-form" data-action="gdlr_save_admin_panel" ';
				echo 'data-ajax="' . AJAX_URL . '" ';
				echo 'data-security="' . wp_create_nonce(THEME_SHORT_NAME . '-create-nonce') . '" >';
				
				// print navigation section
				$this->print_admin_nav();
				
				// print content section
				$this->print_admin_content();
				
				echo '<div class="clear"></div>';
				echo '</form>';	

				echo '</div>'; // gdlr-admin-panel-wrapper
			}	

			function print_admin_nav(){
				
				// admin navigation
				echo '<div class="gdlr-admin-nav-wrapper" id="gdlr-admin-nav" >';
				echo '<div class="gdlr-admin-head">';
				echo '<img src="' . GDLR_PATH . '/framework/images/admin-panel/admin-logo.png" alt="admin logo" />';
				echo '<div class="gdlr-admin-head-gimmick"></div>';
				echo '</div>';
				
				$is_first = 'active';
				
				echo '<ul class="admin-menu" >';
				foreach( $this->option as $menu_slug => $menu_settings ){
					echo '<li class="' . $menu_slug . '-wrapper admin-menu-list">';
					
					echo '<div class="menu-title">';
					echo '<img src="' . $menu_settings['icon'] . '" alt="' . $menu_settings['title'] . '" />';
					echo '<span>' . $menu_settings['title'] . '</span>';
					echo '<div class="menu-title-gimmick"></div>';
					echo '</div>';
					
					echo '<ul class="admin-sub-menu">';
					foreach( $menu_settings['options'] as $sub_menu_slug => $sub_menu_settings ){
						if( !empty($sub_menu_settings) ){
							echo '<li class="' . $sub_menu_slug . '-wrapper ' . $is_first . ' admin-sub-menu-list" data-id="' . $sub_menu_slug . '" >';
							echo '<div class="sub-menu-title">';
							echo $sub_menu_settings['title'];
							echo '</div>';
							echo '</li>';
							
							$is_first = '';
						}
					}
					echo '</ul>';
					
					echo '</li>';
				}
				echo '</ul>';
				
				echo '</div>'; // gdlr-admin-nav-wrapper				
			}
			
			function print_admin_content(){
			
				$option_generator = new gdlr_admin_option_html();

				// admin content
				echo '<div class="gdlr-admin-content-wrapper" id="gdlr-admin-content">';
				
				echo '<div class="gdlr-admin-head">';
				echo '<div class="gdlr-save-button">';
				echo '<img class="now-loading" src="' . GDLR_PATH . '/framework/images/admin-panel/loading.gif" alt="loading" />';				
				echo '<input value="' . __('Save Changes', 'gdlr_translate') . '" type="submit" class="gdl-button" />';
				echo '</div>'; 
				
				echo '<div class="gdlr-admin-head-gimmick"></div>';
				
				echo '<div class="clear"></div>';
				echo '</div>'; // gdlr-admin-head
				
				echo '<div class="gdlr-content-group">';
				foreach( $this->option as $menu_slug => $menu_settings ){
					foreach( $menu_settings['options'] as $sub_menu_slug => $sub_menu_settings ){
						if( !empty($sub_menu_settings) ){
							echo '<div class="gdlr-content-section" id="' . $sub_menu_slug . '" >';
							foreach( $sub_menu_settings['options'] as $option_slug => $option_settings ){
								$option_settings['slug'] = $option_slug;
								$option_settings['name'] = $option_slug;
								if( isset($this->value[$option_slug]) ){
									$option_settings['value'] = $this->value[$option_slug];
								}
								
								$option_generator->generate_admin_option($option_settings);
							}
							echo '</div>'; // gdlr-content-section
						}
					}
				}								
				echo '</div>'; // gdlr-content-group

				echo '<div class="gdlr-admin-footer">';
				echo '<div class="gdlr-save-button">';
				echo '<img class="now-loading" src="' . GDLR_PATH . '/framework/images/admin-panel/loading.gif" alt="loading" />';
				echo '<input value="' . __('Save Changes', 'gdlr_translate') . '" type="submit" class="gdl-button" />';
				echo '</div>';
				
				echo '<div class="clear"></div>';
				echo '</div>'; // gdlr-admin-footer
				
				echo '</div>'; // gdlr-admin-content-wrapper
			
			}
			
		}
		
	}	

?>