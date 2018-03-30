<?php

/////////////////////////////////

// INDEX
//
// COLOR
// NUMBER
// CHECKBOX
// UPLOAD
// UPLOAD MEDIA
// TEXT
// TEXTAREA
// SELECT
// SELECT ONLY
// FONT
// SEPARATOR
// HIDDEN

/////////////////////////////////





	function fw_option ($params) {

		extract($params);

		// general vars
		if (isset($slug )) { $id = $slug; }
		if (isset($options_name) && isset($slug)) { $name = $options_name . "[" . $slug . "]"; }
		if (isset($options_name)) { $options = get_option($options_name); }
		$colspan_str = (isset($colspan)) ? " colspan='".$colspan."'" : "";


// COLOR
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'color',
// 	'title' 				=> __('Example Color', 'loc_canon'),
// 	'slug' 					=> 'color_example',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "color") {

			// specific vars
			$colorselector_id = "colorSelector_" . $slug;

			?>

			<!-- FW OPTION: COLOR-->

				<tr valign='top'>

					<th scope='row'><?php echo esc_attr($title); ?></th>

					<td>
						<input type="text" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>" />    
						<div class="colorSelectorBox" id="<?php echo esc_attr($colorselector_id); ?>">
							<div style="background-color: <?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>"></div>
						</div>
					</td>

				</tr>

			<?php

			return true;		
				
		}


// NUMBER
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'number',
// 	'title' 				=> __('Example opacity', 'loc_canon'),
// 	'slug' 					=> 'example_opacity',
// 	'listen_to'				=> '#blog_style',							// optional
// 	'listen_for'			=> 'tiled',									// optional
// 	'min'					=> '0',										// optional
// 	'max'					=> '1',										// optional
// 	'step'					=> '0.1',									// optional
// 	'width_px'				=> '60',									// optional
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'colspan'				=> '2',										// optional
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "number") {

			// specific vars
			if (isset($width_px)) { $style_width = 'width:' . $width_px . 'px;'; };

			// dynamic option
			$dynamic_option_string = "";
			if(isset($listen_to) && isset($listen_for)) { 
				$dynamic_option_string .= " class='dynamic_option'"; 
				$dynamic_option_string .= " data-listen_to='$listen_to'";
				$dynamic_option_string .= " data-listen_for='$listen_for'";
			} 
			?>

			<!-- FW OPTION: NUMBER-->

				<tr valign='top'<?php echo esc_attr($dynamic_option_string); ?>>
					<th scope='row'><?php echo esc_attr($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input 
							type='number' 
							id=<?php echo esc_attr($id); ?>
							name=<?php echo esc_attr($name); ?>
							<?php if (isset($min)) { echo "min=" . $min; } ?>
							<?php if (isset($max)) { echo "max=" . $max; } ?>
							<?php if (isset($step)) { echo "step=" . $step; } ?>
							<?php if (isset($width_px)) { echo "style=" . $style_width; } ?>
							value='<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } ?>
					</td>
				</tr>

			<?php

			return true;		
				
		}


// CHECKBOX
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'checkbox',
// 	'title' 				=> __('Slideshow', 'loc_canon'),
// 	'slug' 					=> 'anim_slider',
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'colspan'				=> '2',										// optional
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "checkbox") {
			?>

			<!-- FW OPTION: CHECKBOX-->

				<tr valign='top'>
					<th scope='row'><?php echo esc_attr($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input type="hidden" name="<?php echo esc_attr($name); ?>" value="unchecked" />
						<input class="checkbox" type="checkbox" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="checked" <?php if (isset($options[$slug])) { checked($options[$slug] == "checked"); } ?>/> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } ?>
					</td>
				</tr>

			<?php

			return true;		
				
		}


// UPLOAD
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'upload',
// 	'title' 				=> __('Logo URL', 'loc_canon'),
// 	'slug' 					=> 'logo_url',
// 	'btn_text'				=> __('Upload logo', 'loc_canon'),
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "upload") {

			// specific vars
			?>

			<!-- FW OPTION: UPLOAD-->

				<tr valign='top'>
					<th scope='row'><?php echo esc_attr($title); ?></th>
					<td>
						<input type='text' id='<?php echo esc_attr($id); ?>' name='<?php echo esc_attr($name); ?>' class='url' value='<?php if (isset($options[$slug])) echo esc_url($options[$slug]); ?>'>
						<input type="button" class="upload button upload_button" value="<?php echo esc_attr($btn_text); ?>" />
					</td>
				</tr>

			<?php

			return true;		
				
		}

// UPLOAD MEDIA
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'upload_media',
// 	'title' 				=> __('My mp3 File', 'loc_canon'),
// 	'slug' 					=> 'mp3_url',
// 	'btn_text'				=> __('Upload mp3 file', 'loc_canon'),
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "upload_media") {

			// specific vars
			?>

			<!-- FW OPTION: UPLOAD-->

				<tr valign='top'>
					<th scope='row'><?php echo esc_attr($title); ?></th>
					<td>
						<input type='text' id='<?php echo esc_attr($id); ?>' name='<?php echo esc_attr($name); ?>' class='url' value='<?php if (isset($options[$slug])) echo esc_url($options[$slug]); ?>'>
						<input type="button" class="upload button upload_media_button" value="<?php echo esc_attr($btn_text); ?>" />
					</td>
				</tr>

			<?php

			return true;		
				
		}

// TEXT
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'text',
// 	'title' 				=> __('Use text as logo', 'loc_canon'),
// 	'slug' 					=> 'logo_text',
// 	'class'					=> 'widefat',
// 	'colspan'				=> '2',
// 	'options_name'			=> 'canon_options',
// )); 


		if ($type == "text") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW OPTION: TEXT-->

				<tr valign='top'>
					<th scope='row'><?php echo esc_attr($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input type='text' name='<?php echo esc_attr($name); ?>' class="<?php echo esc_attr($final_class); ?>" value="<?php if (isset($options[$slug])) echo htmlspecialchars($options[$slug]); ?>">
					</td>
				</tr>

			<?php

			return true;		
				
		}


// TEXTAREA
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'textarea',
// 	'title' 				=> __('Footer text', 'loc_canon'),
// 	'slug' 					=> 'footer_text',
// 	'cols'					=> '100',
// 	'rows'					=> '5',
// 	'colspan'				=> '2',
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "textarea") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW OPTION: TEXTAREA-->

				<tr valign='top'>
					<th scope='row'><?php echo esc_attr($title); ?></th>

					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>

						<textarea 
							id='<?php echo esc_attr($id); ?>' 
							name='<?php echo esc_attr($name); ?>' 
							class="<?php echo esc_attr($final_class); ?>" 
							<?php if (isset($cols)) { echo "cols=" . $cols; } ?>
							<?php if (isset($rows)) { echo "rows=" . $rows; } ?>
						><?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?></textarea>

					</td>
				</tr>

			<?php

			return true;		
				
		}


// SELECT
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'select',
// 	'title' 				=> __('Homepage Blog Style', 'loc_canon'),
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> __('Full width', 'loc_canon'),
// 		'sidebar'				=> __('With sidebar', 'loc_canon')
// 	),
// 	'colspan'				=> '2',
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select") {

			?>

			<!-- FW OPTION: SELECT-->

				<tr valign='top'>

					<th scope='row'><?php echo esc_attr($title); ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
					
						<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

							<?php 

								foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo esc_attr($value); ?></option> 
								<?php		
								}


							?>
			     	
						</select> 
					
					</td>
				
				</tr>


			<?php

			return true;		
				
		}

// SELECT ONLY
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'select_only',
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> __('Full width', 'loc_canon'),
// 		'sidebar'				=> __('With sidebar', 'loc_canon')
// 	),
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select_only") {

			?>

			<!-- FW OPTION: SELECT ONLY-->

					
				<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

					<?php 

						foreach ($select_options as $key => $value) {
						?>
	     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
						<?php		
						}


					?>
	     	
				</select> 
					
			<?php

			return true;		
				
		}


// FONT
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'font',
// 	'title' 				=> __('Body text', 'loc_canon'),
// 	'slug' 					=> 'font_main',
// 	'options_name'			=> 'canon_options_appearance',
// )); 




		if ($type == "font") {

			?>

			<!-- FW OPTION: FONT-->

				<tr id='<?php echo esc_attr($id); ?>' valign='top' class='canon_webfonts_controller'>
					<th scope='row'><?php echo esc_attr($title); ?></th>

					<td>
						<select id="font_main_family" name="<?php echo esc_attr($name); ?>[0]" class="canon_font_family" data-selected="<?php if (isset($options[$slug][0])) echo esc_attr($options[$slug][0]); ?>"> 
							<option value="canon_default" <?php if (isset($options[$slug][0])) {if ($options[$slug][0] == "canon_default") echo "selected='selected'";} ?>><?php _e("Theme default", "loc_canon"); ?></option> 
							<option value="canon_default">----</option> 
						</select> 
					</td>

					<td>
						<select id="font_main_variant" name="<?php echo esc_attr($name); ?>[1]" class="canon_font_variant" data-selected="<?php if (isset($options[$slug][1])) echo esc_attr($options[$slug][1]); ?>"> 
						</select> 
					</td>

					<td>
						<select id="font_main_subset" name="<?php echo esc_attr($name); ?>[2]" class="canon_font_subset" data-selected="<?php if (isset($options[$slug][2])) echo esc_attr($options[$slug][2]); ?>"> 
						</select> 
					</td>
				</tr>


			<?php

			return true;		
				
		}

// SEPARATOR
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'separator',
// 	'colspan'				=> '2',
// )); 


		if ($type == "separator") {

			?>

			<!-- FW OPTION: TEXT-->

				<tr valign='top'>
					<td <?php echo esc_attr($colspan_str); ?>>
						<hr>
					</td>
				</tr>

			<?php

			return true;		
				
		}



// HIDDEN
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'hidden',
// 	'slug' 					=> 'body_skin_class',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "hidden") {

			?>

			<!-- FW OPTION: HIDDEN-->

				<input type="hidden" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($options[$slug]); ?>">

			<?php

			return true;		
				
		}



// END OF MAIN FUNCTION

		return false;

	} // end function fw_option
