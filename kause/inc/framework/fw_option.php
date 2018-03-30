<?php

/////////////////////////////////

// INDEX
//
// COLOR
// NUMBER
// CHECKBOX
// UPLOAD
// TEXT
// TEXTAREA
// SELECT
// FONT
// HIDDEN

/////////////////////////////////





	function fw_option ($params) {

		extract($params);

		// general vars
		$id = $slug;
		$name = $options_name . "[" . $slug . "]";
		$options = get_option($options_name);
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

					<th scope='row'><?php echo $title; ?></th>

					<td>
						<input type="text" id="<?php echo $id; ?>" name="<?php echo $name ?>" value="<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>" />    
					</td>

					<td>
						<div class="colorSelectorBox" id="<?php echo $colorselector_id; ?>">
							<div style="background-color: <?php if (isset($options[$slug])) echo $options[$slug]; ?>"></div>
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
			?>

			<!-- FW OPTION: NUMBER-->

				<tr valign='top'>
					<th scope='row'><?php echo $title; ?></th>
					<td<?php if (!empty($colspan_str)) { echo $colspan_str;} ?>>
						<input 
							type='number' 
							id= <?php echo $id; ?>
							name= <?php echo $name; ?>
							<?php if (isset($min)) { echo "min=" . $min; } ?>
							<?php if (isset($max)) { echo "max=" . $max; } ?>
							<?php if (isset($step)) { echo "step=" . $step; } ?>
							<?php if (isset($width_px)) { echo "style=" . $style_width; } ?>
							value='<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>'
						> <?php if (isset($postfix)) { echo $postfix; } ?>
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
					<th scope='row'><?php echo $title; ?></th>
					<td<?php if (!empty($colspan_str)) { echo $colspan_str;} ?>>
						<input type="hidden" name="<?php echo $name; ?>" value="unchecked" />
						<input class="checkbox" type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="checked" <?php if (isset($options[$slug])) { checked($options[$slug] == "checked"); } ?>/> <?php if (isset($postfix)) { echo $postfix; } ?>
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
					<th scope='row'><?php echo $title; ?></th>
					<td>
						<input type='text' id='<?php echo $id; ?>' name='<?php echo $name; ?>' class='url' value='<?php if (isset($options[$slug])) echo esc_url($options[$slug]); ?>'>
						<input type="button" class="upload button upload_button" value="<?php echo $btn_text; ?>" />
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
					<th scope='row'><?php echo $title; ?></th>
					<td<?php if (!empty($colspan_str)) { echo $colspan_str;} ?>>
						<input type='text' name='<?php echo $name; ?>' class="<?php echo $final_class; ?>" value="<?php if (isset($options[$slug])) echo htmlspecialchars($options[$slug]); ?>">
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
					<th scope='row'><?php echo $title; ?></th>

					<td<?php if (!empty($colspan_str)) { echo $colspan_str;} ?>>

						<textarea 
							id='<?php echo $id; ?>' 
							name='<?php echo $name; ?>' 
							class="<?php echo $final_class; ?>" 
							<?php if (isset($cols)) { echo "cols=" . $cols; } ?>
							<?php if (isset($rows)) { echo "rows=" . $rows; } ?>
						><?php if (isset($options[$slug])) echo $options[$slug]; ?></textarea>

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

					<th scope='row'><?php echo $title; ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo $colspan_str;} ?>>
					
						<select id="<?php echo $id; ?>" name="<?php echo $name; ?>"> 

							<?php 

								foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo $key; ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo $value; ?></option> 
								<?php		
								}


							?>
			     	
						</select> 
					
					</td>
				
				</tr>


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

				<tr id='<?php echo $id; ?>' valign='top' class='canon_webfonts_controller'>
					<th scope='row'><?php echo $title; ?></th>

					<td>
						<select id="font_main_family" name="<?php echo $name; ?>[0]" class="canon_font_family" data-selected="<?php if (isset($options[$slug][0])) echo $options[$slug][0]; ?>"> 
							<option value="canon_default" <?php if (isset($options[$slug][0])) {if ($options[$slug][0] == "canon_default") echo "selected='selected'";} ?>><?php _e("Theme default", "loc_canon"); ?></option> 
							<option value="canon_default">----</option> 
						</select> 
					</td>

					<td>
						<select id="font_main_variant" name="<?php echo $name; ?>[1]" class="canon_font_variant" data-selected="<?php if (isset($options[$slug][1])) echo $options[$slug][1]; ?>"> 
						</select> 
					</td>

					<td>
						<select id="font_main_subset" name="<?php echo $name; ?>[2]" class="canon_font_subset" data-selected="<?php if (isset($options[$slug][2])) echo $options[$slug][2]; ?>"> 
						</select> 
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

				<input type="hidden" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $options[$slug]; ?>">

			<?php

			return true;		
				
		}



// END OF MAIN FUNCTION

		return false;

	} // end function fw_option
