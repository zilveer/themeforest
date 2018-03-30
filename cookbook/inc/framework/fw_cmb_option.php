<?php

/////////////////////////////////

// INDEX
//
// CHECKBOX
// CHECKBOX MULTIPLE
// TEXT
// SELECT
// TEXTAREA
// NUMBER

/////////////////////////////////





	function fw_cmb_option ($params) {

		extract($params);

		// general vars
		if (isset($slug)) {
			
			$id = $slug;
			$name = $slug;

			// check if slug is array
			if (strpos($slug, '[') !== FALSE) {
				$slug_array = explode('[', $slug);
				$option_array = get_post_meta($post_id, $slug_array[0], true);

				for ($i = 1; $i < count($slug_array); $i++) {  
					$slug_array[$i] = substr($slug_array[$i], 0, strlen($slug_array[$i])-1);
				}

				// 1 dimensional array
				if (count($slug_array) === 2) {
					$option = $option_array[$slug_array[1]];
				}

			} else {

				$option = get_post_meta($post_id, $slug, true);

			}
				
		}

// CHECKBOX
//
// Usage:
//
// fw_cmb_option(array(
// 	'type'					=> 'checkbox',
// 	'title' 				=> __('Display quote as a tweet', 'loc_nosh_core_plugin'),
// 	'slug' 					=> 'cmb_quote_is_tweet',
// 	'post_id'				=> $post->ID,
// )); 


		if ($type == "checkbox") {
			?>

			<!-- FW CMB OPTION: CHECKBOX-->

				<div class="option_item">
					<input type="hidden" name="<?php echo esc_attr($name); ?>" value="unchecked" />
					<input type='checkbox' id='<?php echo esc_attr($id); ?>' name='<?php echo esc_attr($name); ?>' value='checked' <?php if(!empty($option)) { checked($option == "checked"); } ?>>
					<label for='<?php echo esc_attr($id); ?>'><?php echo wp_kses_post($title); ?></label><br>
				</div>

			<?php

			return true;		
				
		}


// CHECKBOX MULTIPLE
//
// Usage:
//
// fw_cmb_option(array(
// 	'type'					=> 'checkbox_multiple',
// 	'title' 				=> __('Display quote as a tweet', 'loc_nosh_core_plugin'),
// 	'slug' 					=> 'cmb_quote_is_tweet',
// 	'checkboxes'			=> array(
// 		'cmb_hide_from_archive'		=> __('Hide from blog', 'loc_nosh_core_plugin'),
// 		'cmb_hide_from_gallery'		=> __('Hide from gallery', 'loc_nosh_core_plugin'),
// 		'cmb_hide_from_popular'		=> __('Hide from popular lists', 'loc_nosh_core_plugin'),
// 	),
// 	'post_id'				=> $post->ID,
// )); 


		if ($type == "checkbox_multiple") {
			?>

			<!-- FW CMB OPTION: CHECKBOX-->

				<div class="option_item">

					<?php
						
						foreach($checkboxes as $key => $value) {
							$this_option = get_post_meta($post_id, $key, true);

						?>
							<input type="hidden" name="<?php echo esc_attr($key); ?>" value="unchecked" />
							<input type='checkbox' id='<?php echo esc_attr($key); ?>' name='<?php echo esc_attr($key); ?>' value='checked' <?php if(!empty($this_option)) { checked($this_option == "checked"); } ?>>
							<label for='<?php echo esc_attr($key); ?>'><?php echo esc_attr($value); ?></label><br>
						<?php	
						}
					
					?>
				</div>

			<?php

			return true;		
				
		}


// TEXT
//
// Usage:
//
// fw_cmb_option(array(
// 	'type'					=> 'text',
// 	'title' 				=> __('Use text as logo', 'loc_canon'),
// 	'slug' 					=> 'logo_text',
// 	'class'					=> 'widefat',
// 	'post_id'				=> $post->ID,
// )); 


		if ($type == "text") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW CMB OPTION: TEXT-->

				<div class="option_item">
					<label for='<?php echo esc_attr($id); ?>'><?php echo wp_kses_post($title); ?></label><br>
					<input type='text' id='<?php echo esc_attr($id); ?>' name='<?php echo esc_attr($name); ?>' class='<?php echo esc_attr($final_class); ?>' value="<?php if (!empty($option)) { echo htmlspecialchars($option); } ?>">
				</div>

			<?php

			return true;		
				
		}



// SELECT
//
// Usage:
//
// fw_cmb_option(array(
// 	'type'					=> 'select',
// 	'title' 				=> __('Post style', 'loc_nosh_core_plugin'),
// 	'slug' 					=> 'cmb_single_style',
// 	'select_options'		=> array(
// 		'full'				=> __('Featured full width (standard)', 'loc_canon'),
// 		'boxed'				=> __('Featured boxed', 'loc_canon'),
// 		'compact'			=> __('Featured compact', 'loc_canon'),
// 		'project'			=> __('Project post', 'loc_canon'),
// 		'multi'				=> __('Multi post', 'loc_canon'),
// 	),
// 	'post_id'				=> $post->ID,
// )); 




		if ($type == "select") {

			?>

			<!-- FW CMB OPTION: SELECT-->

				<div class="option_item">

					<label for='<?php echo esc_attr($id); ?>'><?php echo wp_kses_post($title); ?></label><br>
					<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 
						<?php 

							foreach ($select_options as $key => $value) {
							?>
		     					<option value="<?php echo esc_attr($key); ?>" <?php if (!empty($option)) {if ($option == $key) echo "selected='selected'";} ?>><?php echo esc_attr($value); ?></option> 
							<?php		
							}

						?>
					</select> 

				</div>


			<?php

			return true;		
				
		}

// TEXTAREA
//
// Usage:
//
// fw_cmb_option(array(
// 	'type'					=> 'textarea',
// 	'title' 				=> __('Footer text', 'loc_canon'),
// 	'slug' 					=> 'footer_text',
// 	'cols'					=> '100',
// 	'rows'					=> '5',
//	'hint'					=> __('Optional. HTML allowed.', 'loc_canon'), ,
// 	'class'					=> 'widefat',
// 	'post_id'				=> $post->ID,
// )); 



		if ($type == "textarea") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW CMB OPTION: TEXTAREA-->

				<div class="option_item clearfix">
					<label for='<?php echo esc_attr($id); ?>'><?php echo wp_kses_post($title); ?></label><br>
					<textarea 
						id='<?php echo esc_attr($id); ?>' 
						name='<?php echo esc_attr($name); ?>' 
						class="<?php echo esc_attr($final_class); ?>" 
						<?php if (isset($cols)) { echo "cols=" . $cols; } ?>
						<?php if (isset($rows)) { echo "rows=" . $rows; } ?>
					><?php if (!empty($option)) echo esc_attr($option); ?></textarea>
					<?php if (isset($hint)) { printf('<span class="item_hint float_right">%s</span>', esc_attr($hint)); } ?>
				</div>

			<?php

			return true;		
				
		}


// NUMBER
//
// Usage:
//
// fw_cmb_option(array(
// 	'type'					=> 'number',
// 	'title' 				=> __('Posts per page', 'loc_canon'),
// 	'slug' 					=> 'cmb_timeline_posts_per_page',
// 	'min'					=> '1',										// optional
// 	'max'					=> '10000',									// optional
// 	'step'					=> '1',										// optional
// 	'width_px'				=> '60',									// optional
// 	'post_id'				=> $post->ID,
// )); 


		if ($type == "number") {

			// specific vars
			if (isset($width_px)) { $style_width = 'width:' . $width_px . 'px;'; };
			?>

			<!-- FW OPTION: NUMBER-->

				<div class="option_item">

					<input 
						type='number' 
						id= <?php echo esc_attr($id); ?>
						name= <?php echo esc_attr($name); ?>
						<?php if (isset($min)) { echo "min=" . $min; } ?>
						<?php if (isset($max)) { echo "max=" . $max; } ?>
						<?php if (isset($step)) { echo "step=" . $step; } ?>
						<?php if (isset($width_px)) { echo "style=" . $style_width; } ?>
						value='<?php if (isset($option)) echo esc_attr($option); ?>'
					>
					<?php echo wp_kses_post($title); ?>

				</div>

			<?php

			return true;		
				
		}













		return false;

	} // end function fw_cmb_option



