<?php function create_form($input, $counter, $label_class = "") { ?>
	<?php if($label_class !== "") : ?>
		<div class="<?php echo $label_class; ?>">
	<?php endif; ?>
		<?php // Set the input value to default or get_option()
		if(!get_option($input["name"])) :
			if(isset($input["default"]) && $input["default"] != "") :
				$input_value = $input["default"];
			endif;
		else :
			$input_value = get_option($input["name"]);
		endif;
		// This denotes that we're using the wp-categories instead of set options
		if((isset($input["options"]) && $input["options"] == "loop_categories") || (isset($input["options"]) && $input["options"] == "multi_categories")) :
			$category_args = array('hide_empty' => false);
			$option_loop = get_categories($category_args);
		elseif(isset($input["options"]) && $input["options"] == "loop_pages") :
			$option_loop = get_pages();
		elseif (isset($input["options"]) && $input["options"] == "loop_galleries") :
			$option_loop = list_ocmx_galleries();
		elseif(isset($input["options"]) && is_array($input["options"])) :
			//$values =  array_values($input["options"]);
			$option_loop = $input["options"];
		else :
			$option_loop = false;
		endif;

		if(isset($input["id"]) && $input["id"] != "") :
			$inputid = "id=\"".$input["id"]."\"";
		else :
			$inputid = "";
		endif;

		//Switch through the input_type
		switch($input["input_type"]) :
			case 'select';
				if(isset($input['linked'])) : ?>
					<select size="1" name="<?php echo $input["name"]; ?>" <?php echo $inputid; ?> onchange="javacript: check_linked('<?php echo $input['id'];?>', '<?php echo $input['linked'];?>')">
				<?php else : ?>
					<select size="1" name="<?php echo $input["name"]; ?>" <?php echo $inputid; ?> <?php if(isset($input["prefix"])): ?>rel="<?php echo $input["prefix"]; ?>"<?php endif; ?>>
				<?php endif;
					// Tiny little hack.. if we've set the options to loop through the categories, we must have an "All" option
					if ($input["options"] == "loop_galleries") : ?>
						<option <?php if($input_value == 0){echo "selected=\"selected\"";} ?> value="0"><?php if(isset($input["zero_wording"])) : echo $input["zero_wording"]; else : _e("All",'ocmx'); endif; ?></option>
				<?php elseif ($input["options"] == "loop_categories") : ?>
						<option <?php if($input_value == 0){echo "selected=\"selected\"";} ?> value="0"><?php if(isset($input["zero_wording"])) : echo $input["zero_wording"]; else : _e("All",'ocmx'); endif; ?></option>
				<?php elseif($input["options"] == "loop_pages" && ($input["linked"])) : ?>
						<option <?php if($input_value == 0){echo "selected=\"selected\"";} ?> value="0"><?php if(isset($input["zero_wording"])) : echo $input["zero_wording"]; else : _e("Use a Custom Description",'ocmx'); endif; ?></option>
				<?php endif;
					foreach($option_loop as $option_label => $value) :
						// Set the $value and $label for the options
						if($input["options"] == "loop_categories") :
							$use_value =  $value->slug;
							$label =  $value->cat_name;
						elseif($input["options"] == "loop_pages") :
							$use_value =  $value->ID;
							$label =  $value->post_title;
						elseif ($input["options"] == "loop_galleries") :
							$use_value =  $value->menuId;
							$label =  $value->GalleryTitle;
						else :
							$use_value  =  $value;
							$label =  $option_label;
						endif;

						//If this option == the value we set above, select it
						if($use_value == $input_value) :
							$selected = " selected='selected' ";
						else :
							$selected = " ";
						endif; ?>
						<option value="<?php echo $use_value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
					<?php endforeach;  ?>
				</select>
			<?php  break; case 'checkbox' : ?>
				<?php if(is_array($option_loop)): ?>
					<ul class="form-options contained-forms">`
						<?php foreach($option_loop as $option_label => $value) :
							// Set the $value and $label for the options
							if($input["options"] == "loop_categories" || $input["options"] == "multi_categories") :
								$use_value =  $value->slug;
								$label =  $value->cat_name;
							elseif($input["options"] == "loop_pages") :
								$use_value =  $value->ID;
								$label =  $value->post_title;
							else :
								$use_value  =  $value;
								$label =  $option_label;
							endif;
							if($use_value == $input_value):
								$selected = " checked='checkeds' ";
							else :
								$selected = " ";
							endif;
							?>
							<li><input type="checkbox" name="<?php echo $input["name"]."_".$counter; ?>" value="<?php echo $use_value; ?>" /> <?php echo $label; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
				   <input type="checkbox" name="<?php echo $input["name"]; ?>" <?php if($input_value == "true") : ?>checked="checked"<?php endif; ?>  /> <?php if(isset($label)) : echo $label; endif; ?>
				<?php endif;?>
			<?php  break; case 'radio' :?>
				<ul class="form-options contained-forms">
					<?php foreach($option_loop as $option_label => $value) :
						// Check whether we must loop through the categories for the options
						if($input["options"] == "loop_categories") :
							$use_value =  $value->slug;
							$label =  $value->cat_name;
						else :
							$use_value  =  $value;
							$label =  $option_label;
						endif;
						if($use_value == $input_value) :
							$selected = " selected='selected' ";
						else :
							$selected = " ";
						endif; ?>
						<li><input type="radio" name="<?php echo $input["name"]; ?>" value="<?php echo $use_value; ?>" />&nbsp;<?php echo $option_label; ?> </li>
					<?php endforeach; ?>
				</ul>
			<?php break; case 'memo':
				if(isset($input["linked"])) :
					if((get_option($input['linked'])) && get_option($input['linked']) !== "0") :
						$disabled_element = "disabled=\"disabled\"";
					else :
						$disabled_element = "";
					endif;
				else :
					$disabled_element = "";
				endif; ?>
				<textarea name="<?php echo $input["name"]; ?>" <?php echo $inputid; ?> <?php echo $disabled_element; ?> class="site-tracking"><?php if(isset($input_value)) : echo stripslashes($input_value); endif; ?></textarea>
			<?php	break; case 'file': ?>
				<?php if(isset($input["sub_title"])) : $meta_key = $input["sub_title"]; else : $meta_key = "logo"; endif; ?>

				<label><?php ucfirst($meta_key); ?></label>
				<input type="text"  name="<?php echo $input["name"]; ?>" id="<?php echo $input["id"]; ?>_text" value="<?php if(isset($input_value)) : echo $input_value; endif; ?>" />
				<input type="button"name="<?php echo $input["name"]; ?>_file" <?php echo $inputid; ?> value="<?php _e("Browse","ocmx"); ?>" class="button" />
				<input type="button" id="clear_<?php echo $input["id"]; ?>" value="<?php _e("Clear",'ocmx'); ?>" class="button" />


				<span class="tooltip"><?php echo __("Your ", 'ocmx') . $meta_key . __( " will not be automatically resized." , 'ocmx' ); ?></span>

				<div class="logo-display">
					<a href="<?php echo $input_value; ?>" class="std_link" rel="lightbox" target="_blank" id="<?php echo $input["id"]; ?>_href" style="background: url('<?php echo $input_value; ?>') no-repeat center;"></a>
				</div>

				<?php $args = array("post_type" => "attachment", "meta_key" => "obox-".$meta_key, "meta_value" => 1, "showposts" => -1);
					$attachments = $attachments = get_posts($args);
				if ($attachments) : ?><h4><?php _e("Select from previously uploaded ", "ocmx").$meta_key._e("'s", "ocmx"); ?></h4><?php endif;?>
				<ul class="previous-logos">
					<?php if ($attachments) :
						foreach ($attachments as $post) :
							$attach_data = get_post_meta($post->ID, "obox-".$meta_key);
							$attachment_src = wp_get_attachment_image_src($post->ID); ?>
							<li>
								<a href="" class="image" id="<?php echo $post->ID; ?>">
									<img src="<?php echo $attachment_src[0]; ?>" width="100" />
								</a>
								<a href="" class="remove">Delete</a>
							</li>
					<?php  endforeach;
					endif;
					if(isset($input["sub_title"])) : ?>
						<li id="new-upload-<?php echo $meta_key; ?>" style="display: none;">
							<a href="" class="image"></a>
						</li>
					<?php else : ?>
						<li id="new-upload" style="display: none;">
							<a href="" class="image"></a>
						</li>
					<?php endif; ?>
				</ul>
			<?php break; case 'icon': ?>
			   <?php if(isset($input["sub_title"])) : $meta_key = $input["sub_title"]; else : $meta_key = "icon"; endif; ?>

				<div class="iconize">
					<a href="<?php echo $input_value; ?>" class="std_link iconfinder" rel="lightbox" target="_blank" id="<?php echo $input["id"]; ?>_href" style="background: url('<?php echo $input["icon"];?>') no-repeat center;"><span><?php _e('Default Icon', 'ocmx'); ?></span></a>
					<input type="button" id="clear_<?php echo $input["id"]; ?>" value="<?php _e("Clear Icon",'ocmx'); ?>" class="button iconremove" />
				</div>

					<label><?php echo $input["label"];?></label> <br />
					<input type="text"  name="<?php echo $input["name"]; ?>" id="<?php echo $input["id"]; ?>_text" value="<?php echo $input_value; ?>" />
					<input type="button"name="<?php echo $input["name"]; ?>_file" <?php echo $inputid; ?> value="<?php _e("Browse", 'ocmx'); ?>" class="button" />


			<?php break; case 'field': ?>
			   <?php if(isset($input["sub_title"])) : $meta_key = $input["sub_title"]; else : $meta_key = "icon"; endif; ?>

				<label><?php $input["label"];?></label> <br />
				<input type="text"  name="<?php echo $input["name"]; ?>" id="<?php echo $input["id"]; ?>_text" value="<?php echo $input_value; ?>" />

			<?php break; case 'colour':
				$color_id = $input["id"]."_color";
				if(get_option($color_id) == "" || !get_option($color_id)){$color_value = $input["default"];} else {$color_value = get_option($color_id);}; ?>
				<div class="color_container">
					<!-- COLOR PICKER -->
					<div id="<?php echo $input["id"]; ?>_color_picker" class="color-picker-box">
						<div style="background-color: <?php echo $color_value; ?>"></div>
					</div>
					<input type="text" name="<?php echo $input["name"]; ?>_color" id="<?php echo $input["id"]; ?>_color" value="<?php echo $color_value; ?>" class="color-picker" maxlength="7" />
					<input type="hidden" id="<?php echo $input["id"]; ?>_default" value="<?php echo $input["default"]; ?>" />
				</div>

			<?php break; case 'font':
					$size_id = $input["id"]."_size";
					if(get_option($size_id) == "" || !get_option($size_id)){$size_option = $size_id."_default";} else {$size_option = $size_id;}
			?>
				<!-- RESET -->
				<li>
					<input type="button" id="<?php echo $input["id"]; ?>_color_clear" value="Clear" class="button" />
				</li>
				<!-- FONT SIZE PICKER -->
				<li class="slider_container">
					<a class="minus"></a>
					<a class="add"></a>
					<div id="<?php echo $input["id"]; ?>_size_picker" class="slider_bar">
					  <div id="<?php echo $input["id"]; ?>_size_caption"></div>
					  <div id="<?php echo $input["id"]; ?>_size_handle" class="slider_handle"></div>
					</div>
					<input type="text" name="<?php echo $input["id"]; ?>_size" id="<?php echo $size_id; ?>" value="<?php echo get_option($size_option); ?>" class="color-picker" maxlength="3" />
				</li>
			<?php break; case 'button': ?>
				<input type="button" name="<?php echo $input["name"]; ?>" <?php echo $inputid; ?> value="<?php echo $input["name"]; ?>" class="button" <?php if(isset($input["rel"])) : ?>rel="<?php echo $input["rel"]; ?>"<?php endif; ?> />
			<?php break; case 'hidden': ?>
				<input type="hidden" name="<?php echo $input["name"]; ?>" <?php echo $inputid; ?> value="<?php echo $input_value; ?>" />
			<?php  break; default :
				if(isset($input['linked'])) :
					if((get_option($input['linked'])) && get_option($input['linked']) !== "0") :
						$disabled_element = "disabled=\"disabled\"";
					else :
						$disabled_element = "";
					endif;
				else :
					$disabled_element = "";
				endif; ?>
				<input type="text" name="<?php echo $input["name"]; ?>" <?php echo $inputid; ?> value="<?php if(isset($input_value)) : echo $input_value; endif; ?>" <?php echo $disabled_element; ?> />
			<?php break;
		endswitch; ?>
	<?php if($label_class !== "") : ?>
		</div>
	<?php endif; ?>
<?php } ?>