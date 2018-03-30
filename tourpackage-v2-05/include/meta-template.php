<?php

	/*	
	*	Goodlayers Meta Template File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the template of meta box for each input type.
	* 	The framework will use it when create meta box for each post_type.
	*	---------------------------------------------------------------------
	*/
	
	// decide to print each meta box type
	function print_meta($meta_box){
	
		if(empty($meta_box['default'])) $meta_box['default'] = '';
		if(empty($meta_box['meta_body'])) $meta_box['meta_body'] = '';
		
		switch($meta_box['type']){
		
			case "open" : print_meta_open_div($meta_box); break;
			case "close" : print_meta_close_div($meta_box); break;
			case "header": print_meta_header($meta_box); break;
			case "text": print_meta_text($meta_box); break;
			case "description": print_description($meta_box); break;
			case "inputtext": print_meta_input_text($meta_box); break;
			case "upload": print_meta_upload($meta_box); break;
			case "media-upload": print_meta_media_upload($meta_box); break;
			case "textarea": print_meta_input_textarea($meta_box); break;
			case "checkbox": print_meta_input_checkbox($meta_box); break;
			case "combobox": print_meta_input_combobox($meta_box); break;
			case "radioenabled": print_meta_input_radioenabled($meta_box); break;
			case "radioimage": print_meta_input_radioimage($meta_box); break;
			case "imagepicker": print_image_picker($meta_box); break;
			case "datepicker": print_date_picker($meta_box); break;
		}
		
	}
	
	// nonce Verification	
	function set_nonce(){
	
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename');
		
	}
	
	// header => name, title
	function print_meta_header($args){
	
		extract($args);
		$meta_id = (isset($meta_id))? $meta_id : '';
		
		?>	
			
			<div id="meta-header" class="<?php echo $meta_id; ?>">
				<h2><?php _e($title, 'gdl_back_office'); ?></h2>
			</div>
			
		<?php 
		
	}

	// text => name, text
	function print_meta_text($args){
	
		extract($args); 
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title pb10">
					<?php _e($title, 'gdl_back_office'); ?>
				</div>
			</div>
			
		<?php 
		
	}
	
	// text => name, title, value, default
	function print_meta_input_text($args){
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
						?>" />
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"> <?php _e($description, 'gdl_back_office'); ?> </div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}

	// text => name, title, value, default
	function print_description($args){
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="only-description"> <?php _e($description, 'gdl_back_office'); ?> </div>
				<br class=clear>
			</div>
			
		<?php
		
	}	
		
	// text => name, title, value
	function print_meta_upload($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="meta-input-example-image" id="meta-input-example-image">
					
					<?php 
					
						$image_src = '';
						
						if(!empty($value)){
						
							$image_src = wp_get_attachment_image_src( $value, 'full' );
							$thumb_src_preview = wp_get_attachment_image_src( $value, 'thumbnail');
							echo '<img src="' . $thumb_src_preview[0] . '" />';
							
						} 
						
					?>		
					
					</div>
					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
												
						echo (empty($value))? esc_html($default): esc_html($value);
						
					?>" />
					<input id="upload_image_text_meta" class="upload_image_text_meta" type="text" value="<?php echo (empty($image_src[0]))? '': $image_src[0]; ?>" />
					<input class="upload_image_button_meta" type="button" value="Upload" />
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}
	
	// text => name, title, value
	function print_meta_media_upload($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<input name="<?php echo $name; ?>" type="text" id="upload_media_text_meta" value="<?php 
												
						echo (empty($value))? esc_html($default): esc_html($value);
						
					?>" />
					<input class="upload_media_button_meta" type="button" value="Upload" />
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}	
	
	// textarea => name, title, value, default
	function print_meta_input_textarea($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo str_replace('[]','',$name); ?>-wrapper <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="<?php echo str_replace('[]','',$name); ?>"><?php
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
				
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// checkbox => name, title, value
	function print_meta_input_checkbox($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					Not yet implement
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
	}	
	
	// combobox => name, title, value, options[]
	function print_meta_input_combobox($args){
	
		extract($args);
		
		$value = (empty($value))? $default: $value;
		
		?>
			
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="combobox">
						<select name="<?php echo $name; ?>" id="<?php echo str_replace('[]', '', $name); ?>">
						
							<?php foreach($options as $option){ ?>
							
								<option rel="<?php echo $option ; ?>" <?php if( $option==esc_html($value) ){ echo 'selected'; }?> ><?php echo $option ; ?></option>
						
							<?php } ?>
							
						</select>
					</div>
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}	
	
	// radioenabled => name, title, value
	function print_meta_input_radioenabled($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="radio" name="<?php echo $name; ?>" value="enabled" <?php if($value=='enabled' || $value=='') echo 'checked'; ?>> Enable &nbsp&nbsp&nbsp
					<input type="radio" name="<?php echo $name; ?>" value="disable" <?php if($value=='disable') echo 'checked'; ?>> Disable
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}	

	
	// radioimage => name, title, type, value, option=>array(value, image)
	function print_meta_input_radioimage($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
				
					<?php foreach( $options as $option ){ ?>
					
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo GOODLAYERS_PATH.$option['image']?> alt=<?php echo $name;?>>
								<div id="check-list"></div>
							</label>
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value'];?>" <?php 
								
								if($value == $option['value']){
								
									echo 'checked';
									
								}else if($value == '' && $default == $option['value']){
								
									echo 'checked';
									
								}
								
							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>" > 
						</div>
						
					<?php } ?>
					<br class=clear>
				</div>
				<br class=clear>
			</div>
		<?php
	}	
	
	// text => name, title, value, default
	function print_date_picker($args){
		extract($args);
		
		?>
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="text" class="gdl-date-picker" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 		
						echo ($value == '')? esc_html($default): esc_html($value);
						?>" />
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"> <?php _e($description, 'gdl_back_office'); ?> </div>		
				<?php } ?>
				
				<br class=clear>
			</div>
		<?php
	}			
	
	// imagepicker => title, name=>array(num,image,title,caption,link)
	function print_image_picker($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo $meta_body; ?>">
				<div class="meta-input-slider">
					<div class="image-picker" id="image-picker">
						<input type='hidden' class="slider-num" id="slider-num" name='<?php 
						
							echo (isset($name['slider-num']))? $name['slider-num'] . '[]' : '' ; 
						
						?>' value=<?php 
							
							echo empty($value)? 0: $value->childNodes->length;
							
						?> />
						<div class="selected-image" id="selected-image">
							<div id="selected-image-none"></div>
							<ul>
								<li id="default" class="default">
									<div class="selected-image-wrapper">
										<img src="" alt="" />
										<div class="selected-image-element">
											<div id="edit-image" class="edit-image"></div>
											<div id="unpick-image" class="unpick-image"></div>
											<br class="clear">
										</div>
									</div>
									<input type="hidden" class='slider-image-url' id='<?php echo $name['image']; ?>' />
									<div id="slider-detail-wrapper" class="slider-detail-wrapper">
									<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php _e('SLIDER TITLE', 'gdl_back_office'); ?></div> 
										<div class="meta-detail-input meta-input"><input type="text" id='<?php echo $name['title']; ?>' /></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php _e('SLIDER CAPTION', 'gdl_back_office'); ?></div>
										<div class="meta-detail-input meta-input"><textarea id='<?php echo $name['caption']; ?>' ></textarea></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php _e('LINK TYPE', 'gdl_back_office'); ?></div> 
										<div class="meta-input meta-detail-input">
											<div class="combobox">
												<select id='<?php echo $name['linktype']; ?>'>
													<option selected >No Link</option>
													<option>Lightbox</option>
													<option>Link to URL</option>	
													<option>Link to Video</option>
												</select>
											</div>
											<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php _e('URL PATH', 'gdl_back_office'); ?></div> 
											<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php _e('VIDEO PATH', 'gdl_back_office'); ?></div> 
											<div><input class="mt10" type="text"  id='<?php echo $name['link']; ?>' /></div>
										</div>
										<br class="clear">
										<div class="meta-detail-done-wrapper">
											<input type="button" id="gdl-detail-edit-done" class="gdl-button" value="Done" /><br class="clear">
										</div>
									</div>
									</div>
								</li>
								
								<?php 
								
									if(!empty($value)){
										
										foreach ($value->childNodes as $slider){ ?> 
										
											<li class="slider-image-init">
												<div class="selected-image-wrapper">
													<img src="<?php 
													
														$thumb_src_preview = wp_get_attachment_image_src( find_xml_value($slider, 'image'), 'thumbnail');
														echo $thumb_src_preview[0]; 
														
													?>"/>
													<div class="selected-image-element">
														<div id="edit-image" class="edit-image"></div>
														<div id="unpick-image" class="unpick-image"></div>
														<br class="clear">
													</div>
												</div>
												<input type="hidden" class='slider-image-url' name='<?php echo $name['image']; ?>[]' id='<?php echo $name['image']; ?>[]' value="<?php echo find_xml_value($slider, 'image'); ?>" /> 
												<div id="slider-detail-wrapper" class="slider-detail-wrapper">
												<div id="slider-detail" class="slider-detail">								
													<div class="meta-title meta-detail-title"><?php _e('SLIDER TITLE', 'gdl_back_office'); ?></div> 
													<div class="meta-detail-input meta-input"><input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>[]' value="<?php echo find_xml_value($slider, 'title'); ?>" /></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php _e('SLIDER CAPTION', 'gdl_back_office'); ?></div>
													<div class="meta-detail-input meta-input"><textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>[]' ><?php echo find_xml_value($slider, 'caption'); ?></textarea></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php _e('LINK TYPE', 'gdl_back_office'); ?></div>
													<div class="meta-input meta-detail-input">
														<div class="combobox">
															<?php $linktype_val =  find_xml_value($slider, 'linktype'); ?>
															<select name='<?php echo $name['linktype']; ?>[]' id='<?php echo $name['linktype']; ?>' >
																<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> >No Link</option>
																<option <?php echo ($linktype_val == 'Lightbox')? "selected" : ''; ?>>Lightbox</option>
																<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>>Link to URL</option>
																<option <?php echo ($linktype_val == 'Link to Video')?  "selected" : ''; ?>>Link to Video</option>
															</select>
														</div>
														<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php _e('URL PATH', 'gdl_back_office'); ?></div> 
														<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php _e('VIDEO PATH', 'gdl_back_office'); ?></div> 
														<div><input class="mt10" type="text" name='<?php echo $name['link']; ?>[]' id='<?php echo $name['link']; ?>[]' value="<?php echo find_xml_value($slider, 'link'); ?>" /></div>
													</div>
													<br class="clear">
													<div class="meta-detail-done-wrapper">
														<input type="button" id="gdl-detail-edit-done" class="gdl-button" value="Done" /><br class="clear">
													</div>
												</div>
												</div>
												</li> 
												
											<?php
											
										}
										
									}
									
								?>	
								
							</ul>
							<br class=clear>
							<div id="show-media" class="show-media">
								<span id="show-media-text"></span>
								<div id="show-media-image"></div>
							</div>
						</div>
						<div class="media-image-gallery-wrapper">
							<div class="media-image-gallery" id="media-image-gallery">
								<?php get_media_image(); ?>
							</div>
						</div>
					</div>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}
	
	// open => id
	function print_meta_open_div($args){
	
		extract($args);
		
		?>
			<div id="<?php echo $id; ?>" class="<?php echo $id; ?>" >
		<?php
		
	}
	
	// close
	function print_meta_close_div($args){
	
		?>
		
			</div>
			
		<?php
		
	}
	
	// save option function that trigger when saveing each post
	add_action('save_post','save_option_meta');
	function save_option_meta($post_id){
	
		// Verification
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		if(!isset($_POST['myplugin_noncename'])) return;
		if(!wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename( __FILE__ ))) return;
		
		// Save data of page
		if('page' == $_POST['post_type']){
		
			if(!current_user_can('edit_page', $post_id)) return;
			
			save_page_option_meta($post_id);
			
		// Save data of post
		}else if('post' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_post_option_meta($post_id);
			
		}else if('portfolio' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_portfolio_option_meta($post_id);
			
		}else if('testimonial' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_testimonial_option_meta($post_id);
			
		}else if('price_table' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_price_table_option_meta($post_id);
			
		}else if('personnal' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_personnal_option_meta($post_id);
			
		}else if('package' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_package_option_meta($post_id);
			
		}else if('gdl-gallery' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_gallery_option_meta($post_id);
					
		}
	}
	
	// function that save the meta to database if new data is exists and is not equals to old one
	function save_meta_data($post_id, $new_data, $old_data, $name){

		if($new_data == $old_data){
		
			add_post_meta($post_id, $name, $new_data, true);
			
		}else if(!$new_data){
		
			delete_post_meta($post_id, $name, $old_data);
			
		}else if($new_data != $old_data){

			update_post_meta($post_id, $name, $new_data, $old_data);
			
		}
	}
?>