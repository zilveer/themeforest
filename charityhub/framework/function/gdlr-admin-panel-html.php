<?php
	/*	
	*	Goodlayers Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls admin  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('gdlr_admin_option_html') ){
		
		class gdlr_admin_option_html{
			
			// decide to generate each option by type
			function generate_admin_option($settings = array()){
				echo '<div class="gdlr-option-wrapper ';
				echo (isset($settings['wrapper-class']))? $settings['wrapper-class'] : '';
				echo '">';
				
				$description_class = empty($settings['description'])? '': 'with-description';
				echo '<div class="gdlr-option ' . $description_class . '">';
				
				// option title
				if( !empty($settings['title']) ){
					echo '<div class="gdlr-option-title">' . $settings['title'] . '</div>';
				}
				
				// input option
				switch ($settings['type']){
					case 'text': $this->print_text_input($settings); break;
					case 'textarea': $this->print_textarea($settings); break;
					case 'combobox': $this->print_combobox($settings); break;
					case 'font-combobox': $this->print_font_combobox($settings); break;
					case 'multi-combobox': $this->print_multi_combobox($settings); break;
					case 'checkbox': $this->print_checkbox($settings); break;
					case 'radioimage': $this->print_radio_image($settings); break;
					case 'colorpicker': $this->print_color_picker($settings); break;
					case 'skin-settings': $this->print_skin_settings($settings); break;
					case 'sliderbar': $this->print_slider_bar($settings); break;
					case 'slider': $this->print_slider($settings); break;
					case 'upload': $this->print_upload_box($settings); break;
					case 'uploadfont': $this->print_upload_font($settings); break;
					case 'custom': $this->print_custom_option($settings); break;
					case 'date-picker': $this->print_date_picker($settings); break;
				}
				
				// input descirption
				if( !empty($settings['description']) ){
					echo '<div class="gdlr-input-description"><span>' . $settings['description'] . '<span></div>';
					echo '<div class="clear"></div>';
				}
				
				echo '</div>'; // gdlr-option
				echo '</div>'; // gdlr-option-wrapper				
			}

			// print custom option
			function print_custom_option($settings = array()){
				echo '<div class="gdlr-option-input">';
				echo $settings['option'];
				echo '</div>';
			}
			
			// print the input text
			function print_text_input($settings = array()){
				echo '<div class="gdlr-option-input">';
				echo '<input type="text" class="gdl-text-input" name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" ';
				if( isset($settings['value']) ){
					echo 'value="' . esc_attr($settings['value']) . '" ';
				}else if( !empty($settings['default']) ){
					echo 'value="' . esc_attr($settings['default']) . '" ';
				}
				echo '/>';
				echo '</div>';
			}
			
			// print the date picker
			function print_date_picker($settings = array()){
				echo '<div class="gdlr-option-input">';
				echo '<input type="text" class="gdl-text-input gdlr-date-picker" name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" ';
				if( isset($settings['value']) ){
					echo 'value="' . esc_attr($settings['value']) . '" ';
				}else if( !empty($settings['default']) ){
					echo 'value="' . esc_attr($settings['default']) . '" ';
				}
				echo '/>';
				echo '</div>';
			}			
			
			// print the textarea
			function print_textarea($settings = array()){
				echo '<div class="gdlr-option-input ';
				echo (!empty($settings['class']))? $settings['class']: '';
				echo '">';
				
				echo '<textarea name="' . $settings['slug'] . '" data-slug="' . $settings['slug'] . '" ';
				echo (!empty($settings['class']))? 'class="' . $settings['class'] . '"': '';
				echo '>';
				if( isset($settings['value']) ){
					echo $settings['value'];
				}else if( !empty($settings['default']) ){
					echo $settings['default'];
				}
				echo '</textarea>';
				echo '</div>';
			}		

			// print the combobox
			function print_combobox($settings = array()){
				echo '<div class="gdlr-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				echo '<div class="gdlr-combobox-wrapper">';
				echo '<select name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" >';
				foreach($settings['options'] as $slug => $name ){
					echo '<option value="' . $slug . '" ';
					echo ($value == $slug)? 'selected ': '';
					echo '>' . $name . '</option>';
				
				}
				echo '</select>';
				echo '</div>'; // gdlr-combobox-wrapper
				
				echo '</div>';
			}	

		
			// print the font combobox
			function print_font_combobox($settings = array()){
				echo '<div class="gdlr-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				echo '<input class="gdlr-sample-font" ';
				echo 'value="' . esc_attr( __('Sample Font', 'gdlr_translate') ) . '" ';
				echo (!empty($value))? 'style="font-family: ' . $value . ';" />' : '/>';
				
				echo '<div class="gdlr-combobox-wrapper">';
				echo '<select name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" class="gdlr-font-combobox" >';
				do_action('gdlr_print_all_font_list', $value);
				echo '</select>';
				echo '</div>'; // gdlr-combobox-wrapper
				
				echo '</div>';
			}	
			
			// print the combobox
			function print_multi_combobox($settings = array()){
				echo '<div class="gdlr-option-input">';

				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}else{
					$value = array();
				}

				echo '<div class="gdlr-multi-combobox-wrapper">';
				echo '<select name="' . $settings['name'] . '[]" data-slug="' . $settings['slug'] . '" multiple >';
				foreach($settings['options'] as $slug => $name ){
					echo '<option value="' . $slug . '" ';
					echo (in_array($slug, $value))? 'selected ': '';
					echo '>' . $name . '</option>';
				
				}
				echo '</select>';
				echo '</div>'; // gdlr-combobox-wrapper
				
				echo '</div>';
			}			

			
			// print the checkbox ( enable / disable )
			function print_checkbox($settings = array()){
				echo '<div class="gdlr-option-input">';
				
				$value = 'enable';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				echo '<label for="' . $settings['slug'] . '-id" class="checkbox-wrapper">';
				echo '<div class="checkbox-appearance ' . $value . '" > </div>';
				
				echo '<input type="hidden" name="' . $settings['name'] . '" value="disable" />';
				echo '<input type="checkbox" name="' . $settings['name'] . '" id="' . $settings['slug'] . '-id" data-slug="' . $settings['slug'] . '" ';
				echo ($value == 'enable')? 'checked': '';
				echo ' value="enable" />';	
				
				echo '</label>';		
				
				echo '</div>';
			}		

			// print the radio image
			function print_radio_image($settings = array()){
				echo '<div class="gdlr-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				$i = 0;
				foreach($settings['options'] as $slug => $name ){
					echo '<label for="' . $settings['slug'] . '-id' . $i . '" class="radio-image-wrapper ';
					echo ($value == $slug)? 'active ': '';
					echo '">';
					echo '<img src="' . $name . '" alt="" />';
					echo '<div class="selected-radio"></div>';

					echo '<input type="radio" name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" ';
					echo 'id="' . $settings['slug'] . '-id' . $i . '" value="' . $slug . '" ';
					echo ($value == $slug)? 'checked ': '';
					echo ' />';
					
					echo '</label>';
					
					$i++;
				}
				
				echo '<div class="clear"></div>';
				echo '</div>';
			}

			// print color picker
			function print_color_picker($settings = array()){
				echo '<div class="gdlr-option-input">';
				
				echo '<input type="text" class="wp-color-picker" name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" ';
				if( !empty($settings['value']) ){
					echo 'value="' . $settings['value'] . '" ';
				}else if( !empty($settings['default']) ){
					echo 'value="' . $settings['default'] . '" ';
				}
				
				if( !empty($settings['default']) ){
					echo 'data-default-color="' . $settings['default'] . '" ';
				}
				echo '/>';
				
				echo '</div>';
			}	
			
			// print skin settings
			function print_skin_settings($settings = array()){
				echo '<div class="gdlr-option-input" id="skin-setting-wrapper">';	

				// head section
				echo '<div class="gdlr-add-skin-wrapper">';
				echo '<input type="text" class="gdl-text-input" />';				
				echo '<div class="gdlr-add-more-skin"></div>';
				echo '<div class="gdlr-default-skin">';
				echo json_encode($settings['options']);
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '</div>';
				
				echo '<div class="gdlr-add-skin-description">';
				echo __('The skin you created can be used in Color / Background Wrapper Section', 'gdlr_translate');
				echo '</div>';
				echo '<div class="clear"></div>';
				
				// container section
				echo '<div class="gdlr-skin-container" ></div>';
				
				// input section
				echo '<textarea class="gdlr-skin-input" name="' . $settings['name'] . '">';
				echo !empty($settings['value'])? $settings['value']: '';
				echo '</textarea>';
				
				echo '</div>';		
			}			

			// print slider bar
			function print_slider_bar($settings = array()){
				echo '<div class="gdlr-option-input">';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				// create a blank box for javascript
				echo '<div class="gdlr-sliderbar" data-value="' . $value . '" ></div>';
				
				echo '<input type="text" class="gdlr-sliderbar-text-hidden" name="' . $settings['name'] . '" ';
				echo 'data-slug="' . $settings['slug'] . '" value="' . $value . '" />';
				
				// this will be the box that shows the value
				echo '<div class="gdlr-sliderbar-text">' . $value . 'px</div>';
				
				echo '<div class="clear"></div>';
				echo '</div>';			
			}

			// print slider
			function print_slider($settings = array()){
				echo '<div class="gdlr-option-input ';
				echo (!empty($settings['class']))? $settings['class']: '';
				echo '">';
				
				echo '<textarea name="' . $settings['slug'] . '" data-slug="' . $settings['slug'] . '" ';
				echo 'class="gdlr-input-hidden gdlr-slider-selection" data-overlay="true" data-caption="true" >';
				if( isset($settings['value']) ){
					echo $settings['value'];
				}else if( !empty($settings['default']) ){
					echo $settings['default'];
				}
				echo '</textarea>';
				echo '</div>';
			}				
			
			// print upload box
			function print_upload_box($settings = array()){
				echo '<div class="gdlr-option-input">';
				
				$value = ''; $file_url = '';
				$settings['data-type'] = empty($settings['data-type'])? 'image': $settings['data-type'];
				$settings['data-type'] = ($settings['data-type']=='upload')? 'image': $settings['data-type'];
				
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				if( is_numeric($value) ){ 
					$file_url = wp_get_attachment_url($value);
				}else{
					$file_url = $value;
				}
				
				// example image url
				echo '<img class="gdlr-upload-img-sample ';
				echo (empty($file_url) || $settings['data-type'] != 'image')? 'blank': '';
				echo '" ';
				echo (!empty($file_url) && $settings['data-type'] == 'image')? 'src="' . $file_url . '" ': ''; 
				echo '/>';
				echo '<div class="clear"></div>';
				
				// input link url
				echo '<input type="text" class="gdlr-upload-box-input" value="' . $file_url . '" />';					
				
				// hidden input
				echo '<input type="hidden" class="gdlr-upload-box-hidden" ';
				echo 'name="' . $settings['name'] . '" data-slug="' . $settings['slug'] . '" ';
				echo 'value="' . $value . '" />';
				
				// upload button
				echo '<input type="button" class="gdlr-upload-box-button gdl-button" ';
				echo 'data-title="' . $settings['title'] . '" ';
				echo 'data-type="' . $settings['data-type'] . '" ';				
				echo 'data-button="';
				echo (empty($settings['button']))? __('Insert Image', 'gdlr_translate'):$settings['button'];
				echo '" ';
				echo 'value="' . __('Upload', 'gdlr_translate') . '"/>';
				
				echo '<div class="clear"></div>';
				echo '</div>';
			}			

			// print upload font
			function print_upload_font($settings = array()){
				echo '<div class="gdlr-option-input" id="upload-font-wrapper">';	
				
				// head section
				echo '<div class="gdlr-upload-font-title-wrapper">';
				echo '<div class="gdlr-upload-font-title">' . __('Upload font', 'gdlr_translate') . '</div>';
				echo '<div class="gdlr-add-more-font"></div>';
				$this->print_font_item();
				echo '<div class="clear"></div>';
				echo '</div>';
				
				// container section
				echo '<div class="gdlr-upload-font-container" >';
				if( isset( $settings['value'] ) ){
					$font_list = json_decode($settings['value'], true);
					if( !empty($font_list) ){
						foreach( $font_list as $font_item ){
							$this->print_font_item( $font_item ); 
						}
					}
				}
				echo '</div>';
				
				// input section
				echo '<textarea class="gdlr-upload-font-input" name="' . $settings['name'] . '">';
				echo !empty($settings['value'])? $settings['value']: '';
				echo '</textarea>';
				
				echo '</div>';
			}
			function print_font_item($value = array()){
				echo '<div class="gdlr-font-item-wrapper">';
				
				// font name section
				echo '<div class="gdlr-font-item">';
				echo '<span class="gdlr-font-input-label" >' . __('Font Name', 'gdlr_translate') . '</span>';
				echo '<input class="gdlr-font-input" data-type="font-name" type="text" ';
				echo (!empty($value['font-name']))? 'value="' . $value['font-name'] . '" ' : '';
				echo '/>';
				echo '<div class="clear"></div>';
				echo '</div>';				
				
				// eot type
				echo '<div class="gdlr-font-item">';
				echo '<span class="gdlr-font-input-label" >' . __('EOT Font', 'gdlr_translate') . '</span>';
				echo '<input class="gdlr-font-input" data-type="font-eot" type="text" ';
				if( !empty($value['font-eot']) ){
					if( is_numeric($value['font-eot']) ){
						echo 'value="' . wp_get_attachment_url($value['font-eot']) . '" ';				
					}else{
						echo 'value="' . $value['font-eot'] . '" ';
					}
				}
				echo '/>';
				echo '<input class="gdlr-upload-font-button gdl-button" type="button" value="' . __('Upload', 'gdlr_translate') . '" />';
				echo '<div class="clear"></div>';
				echo '</div>';
				
				// ttf format
				echo '<div class="gdlr-font-item last">';
				echo '<span class="gdlr-font-input-label" >' . __('TTF Font', 'gdlr_translate') . '</span>';
				echo '<input class="gdlr-font-input" data-type="font-ttf" type="text" ';
				if( !empty($value['font-ttf']) ){
					if( is_numeric($value['font-ttf']) ){
						echo 'value="' . wp_get_attachment_url($value['font-ttf']) . '" ';
					}else{
						echo 'value="' . $value['font-ttf'] . '" ';
					}
				}
				echo '/>';
				echo '<input class="gdlr-upload-font-button gdl-button" type="button" value="' . __('Upload', 'gdlr_translate') . '" />';
				echo '<div class="clear"></div>';
				echo '</div>';
				
				// delete font button
				echo '<div class="gdlr-delete-font-item"></div>';
				echo '<div class="clear"></div>';
				echo '</div>'; // gdlr-font-item-wrapper
			
			}
			
		}

	}
		
?>