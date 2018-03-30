<?php
	/**
	 * 	Contains methods for customizing the theme customization screen.
	 * 
	 * 	@link http://codex.wordpress.org/Theme_Customization_API
	 */
if( !class_exists('gdlr_theme_customizer') ){
	class gdlr_theme_customizer{
		
		public $admin_option;
		
		function __construct($admin_option){
			$this->admin_option = $admin_option;
			
			// call this to add it to customizer.js file
			// $this->print_color_variable(); 
			
			// add action to set the theme customizer
			add_action('customize_register', array(&$this, 'register_option'));
			add_action('customize_save_after', array(&$this, 'sync_theme_option')); 
		}
		
		function register_option($wp_customize){
			$theme_option = get_option(THEME_SHORT_NAME . '_admin_option', array());
			
			$priority = 1000;
			foreach($this->admin_option as $tabs){
				foreach($tabs['options'] as $section_slug => $section){
				
					// check whether there're color option in this section
					$has_option = false;
					if( !empty($section['options']) ){
						foreach($section['options'] as $option){
							if($option['type'] == 'colorpicker'){
								$has_option = true; continue;
							}
						}
					}
					
					// create option
					if( !$has_option ) continue;
					$wp_customize->add_section($section_slug, array(
						'title' => __('Color :', 'gdlr_translate') . ' ' . $section['title'], 
						'priority' => $priority, 
						'capability' => 'edit_theme_options'));
					foreach($section['options'] as $option_slug => $option){
						if($option['type'] != 'colorpicker') continue;

						$wp_customize->add_setting('gdlr_customizer[' . $option_slug . ']', array(
							'default' => $theme_option[$option_slug],
							'type' => 'option',
							'capability' => 'edit_theme_options',
							'transport' => 'postMessage',
						)); 					
						$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $option_slug,
							array(
								'label' => __('Color :', 'gdlr_translate') . ' ' . $option['title'],
								'section' => $section_slug,
								'settings' => 'gdlr_customizer[' . $option_slug . ']',
								'priority' => $priority,
							) 
						));
						$priority++;
					}
					
					$wp_customize->get_setting('blogname')->transport = 'postMessage';
					$wp_customize->get_setting('blogdescription')->transport = 'postMessage';				
					
				}

			}
		}
		
		// sync the color option with theme option
		function sync_theme_option(){
			$theme_option = get_option(THEME_SHORT_NAME . '_admin_option', array());
			$customizer_option = get_option('gdlr_customizer', array());
			
			foreach( $customizer_option as $option_slug => $option_val ){
				$theme_option[$option_slug] = $option_val;
			}
			
			update_option(THEME_SHORT_NAME . '_admin_option', $theme_option);
			delete_option('gdlr_customizer');
			
			gdlr_generate_style_custom($this->admin_option);
		}
		
		// print the variable to use in gdlr-customer.js file.
		function print_color_variable(){
			echo 'var color_option = [<br>';
			foreach($this->admin_option as $tabs){
				foreach($tabs['options'] as $section){
					foreach($section['options'] as $option_slug => $option){
						if($option['type'] == 'colorpicker'){
							echo '{name: "' . $option_slug . '", selector: "' . str_replace('"', '\"', $option['selector']) . '"},<br>';
						}
					}
				}
			}
			echo '];';
		}
	}
}

add_action('customize_preview_init' , 'gdlr_register_customizer_script');
if( !function_exists('gdlr_register_customizer_script')){
	function gdlr_register_customizer_script(){
		wp_enqueue_script('gdlr-customize', GDLR_PATH . '/framework/javascript/gdlr-customizer.js', array(), '', true);	
	}
}