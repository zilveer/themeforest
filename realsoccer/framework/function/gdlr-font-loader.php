<?php
	/*	
	*	Goodlayers Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you controls the font settings
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('gdlr_font_loader') ){	
		class gdlr_font_loader{
			
			public $font_location = array();
			
			public $custom_font_list = array();
			public $safe_font_list = array(
				'Georgia, serif',
				'"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'"Times New Roman", Times, serif',
				'Arial, Helvetica, sans-serif',
				'"Arial Black", Gadget, sans-serif',
				'"Comic Sans MS", cursive, sans-serif',
				'Impact, Charcoal, sans-serif',
				'"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'Tahoma, Geneva, sans-serif',
				'"Trebuchet MS", Helvetica, sans-serif',
				'Verdana, Geneva, sans-serif',
				'"Courier New", Courier, monospace',
				'"Lucida Console", Monaco, monospace'
			);
			public $google_font_list = array();
			
			// initiate the font 
			function __construct( $custom_font ){
				$this->set_google_font_list();
				$this->set_custom_font_list($custom_font);
				
				// add filter to include font into the theme
				add_filter('gdlr_enqueue_scripts', array(&$this, 'include_google_font'));
				add_filter('gdlr_style_custom_end', array(&$this, 'add_custom_style'), 1, 2);

				add_action('gdlr_print_all_font_list', array(&$this, 'print_all_font_list'));
			}
			
			// get the custom font list to array
			function set_custom_font_list($custom_fonts){
				$this->custom_font_list = array(
					'Dejavu Sans Condense' => array(
						'ttf' => GDLR_PATH . '/stylesheet/DejaVuSansCondensed.ttf',
						'eot' => GDLR_PATH . '/stylesheet/DejaVuSansCondensed.eot'
					)
				);
			
				if( !empty($custom_fonts) ){
					foreach( $custom_fonts as $custom_font ){
						$ttf_font = ''; $eot_font = '';
						$this->custom_font_list[$custom_font['font-name']] = array(
							'ttf' => $custom_font['font-ttf'],
							'eot' => $custom_font['font-eot']
						);
					}
				}
			}
			
			// get the google font list to the array
			function set_google_font_list(){
				if( is_admin() ){
					$google_font_file = apply_filters('gdlr_google_font_file', GDLR_LOCAL_PATH . '/framework/function/gdlr-google-font.txt');
					$google_fonts = json_decode(file_get_contents($google_font_file), true);
					
					foreach( $google_fonts['items'] as $google_font ){
						$this->google_font_list[$google_font['family']] = array(
							'subsets' => $google_font['subsets'],
							'variants' => $google_font['variants']
						);
					}
				}else{
					$this->google_font_list = get_option(THEME_SHORT_NAME . '_google_font_list');			
				}
			}
			
			// get all font list to admin panel area
			function print_all_font_list( $selected_font ){
				// custom font section
				echo '<option disabled >------- ' . __('Custom Font' ,'gdlr_translate') . ' -------</option>';
				foreach( $this->custom_font_list as $font_family => $font ){
					if( !empty($font_family) ){
						echo '<option data-type="custom-font" ';
						if( !empty($font['ttf']) && is_numeric($font['ttf']) ){
							echo 'data-ttf="' . wp_get_attachment_url($font['ttf']) . '" ';				
						}else if( !empty($font['ttf']) ){
							echo 'data-ttf="' . $font['ttf'] . '" ';
						}
						if( !empty($font['eot']) && is_numeric($font['eot']) ){
							echo 'data-eot="' . wp_get_attachment_url($font['eot']) . '" ';	
						}else if( !empty($font['eot']) ){
							echo 'data-eot="' . $font['eot'] . '" ';
						}		
						
						echo ($font_family == $selected_font)? 'selected >': '>';
						echo $font_family . '</option>';
					}
				}					

				// safe font section
				echo '<option disabled >------ ' . __('Web Safe Font' ,'gdlr_translate') . ' ------</option>';
				foreach( $this->safe_font_list as $font ){
					echo '<option data-type="web-safe-font" ';
					echo ($font == $selected_font)? 'selected >': '>';
					echo $font . '</option>';
				}
				
				// google font section
				echo '<option disabled >------- ' . __('Google Font' ,'gdlr_translate') . ' -------</option>';
				foreach( $this->google_font_list as $font_family => $font ){
					echo '<option data-type="google-font" ';
					echo 'data-url="' . $this->get_google_font_url($font_family) . '" ';
					echo ($font_family == $selected_font)? 'selected >': '>';
					echo $font_family . '</option>';
				}							
			}
			
			// return a link to get the google font
			function get_google_font_url( $font_family ){
				if( !empty($font_family) && !empty($this->google_font_list[$font_family]) ){
					$google_font = $this->google_font_list[$font_family];
					$temp_font_name  = str_replace(' ', '+' , $font_family) . ':';
					$temp_font_name .= apply_filters('gdlr_google_font_weight', implode(',', $google_font['variants'])) . '&subset='; 
					$temp_font_name .= apply_filters('gdlr_google_font_subset', implode(',', $google_font['subsets'])); 
					
					return GDLR_HTTP . 'fonts.googleapis.com/css?family=' . $temp_font_name;
				} 
				return '';
			}
			
			// add the css to embed custom font at the end of style-custom.css file.
			function add_custom_style($value, $theme_option){
				$used_font = array();
				foreach( $this->font_location as $location ){
					$current_font = $theme_option[$location];
					if( !empty($this->custom_font_list[$current_font]) && !in_array($current_font, $used_font) ){
						array_push($used_font, $current_font);
					}
				}
					
					
				$ret = '';
				foreach( $used_font as $font_name  ){
					$ttf_font = ''; $eot_font = '';
					if( !empty($this->custom_font_list[$font_name]['ttf']) && is_numeric($this->custom_font_list[$font_name]['ttf']) ){
						$ttf_font = wp_get_attachment_url($this->custom_font_list[$font_name]['ttf']);				
					}else if( !empty($this->custom_font_list[$font_name]['ttf']) ){
						$ttf_font = $this->custom_font_list[$font_name]['ttf'];
					}
					if( !empty($this->custom_font_list[$font_name]['eot']) && is_numeric($this->custom_font_list[$font_name]['eot']) ){
						$eot_font = wp_get_attachment_url($this->custom_font_list[$font_name]['eot']);	
					}else if( !empty($this->custom_font_list[$font_name]['eot']) ){
						$eot_font = $this->custom_font_list[$font_name]['eot'];
					}							
					
					$ret .= '@font-face {' . "\r\n";
					$ret .= 'font-family: "' . $font_name . '";' . "\r\n";
					$ret .= 'src: url("' . $eot_font . '");' . "\r\n";
					$ret .= 'src: url("' . $eot_font . '?#iefix") format("embedded-opentype"), ' . "\r\n";
					$ret .= 'url("' . $ttf_font . '") format("truetype");' . "\r\n";
					$ret .= '}' . "\r\n";	
				}
				
				return $value . $ret;
			}
			
			// add the action to include the google font when necessary
			function include_google_font( $array ){
				global $theme_option;

				$used_font = array();
				foreach( $this->font_location as $location ){
					$current_font = $theme_option[$location];
					if( empty($this->custom_font_list[$current_font]) && !in_array($current_font, $this->safe_font_list) ){
						array_push($used_font, $current_font);
					}
				}
				
				foreach( $used_font as $font_name ){
					$font_id = str_replace( ' ', '-', $font_name );
					$array['style'][$font_id . '-google-font'] = $this->get_google_font_url($font_name);
				}	
				
				return $array;
			}
			

			
		}
	}