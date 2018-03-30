<?php // if(!function_exists("post_type_meta_panel")) {
	function post_type_meta_panel($pId, $posttype = "post") {
		$posttypedetails = get_post_type_object($posttype);

		$input = get_post_meta($pId,$posttype,true);
		$cat_list = get_terms("$posttype-category", "orderby=count&hide_empty=0"); ?>
		<div class="inside clearfix">
			<div id="taxonomy-<?php echo $posttype; ?>-category" class="categorydiv">
				<p style="text-align: right;">Add, edit and delete <?php echo $posttypedetails->labels->name; ?> via the <a href="<?php echo home_url(); ?>/wp-admin/edit.php?post_type=<?php echo $posttype; ?>"><?php echo $posttypedetails->labels->name; ?> Panel</a> </p>
				<ul id="<?php echo $posttype; ?>-category-tabs" class="category-tabs clearfix">
					<li <?php if($i == 1) : ?>class="tabs"<?php endif; ?>><a href="#<?php echo $posttype; ?>-category-all">All</a></li>
					<?php  $i=1; foreach($cat_list as $tax) :
						if($tax->parent == 0) :
					?>
						<li <?php if($i == 1) : ?>class="tabs"<?php endif; ?>><a href="#<?php echo $posttype; ?>-category-<?php echo $tax->slug; ?>" tabindex="3"><?php echo $tax->name; ?></a></li>
					<?php  $i++;
						endif;
					endforeach; ?>
				</ul>
				<?php $i=1; $ocmx_posts = new WP_Query("post_type=".$posttype."&posts_per_page=-1"); ?>
				<div id="<?php echo $posttype; ?>-category-all" class="tabs-panel" <?php if($i != 1) : ?>style="display: none;"<?php endif; ?>>
					 <?php if ($ocmx_posts->have_posts()) :
						while ($ocmx_posts->have_posts()) :	$ocmx_posts->the_post();
							if(is_array($input) && in_array(get_the_ID(), $input)) : $checked = "checked=\"checked\""; else : $checked = ""; endif; ?>
							<p><label class="selectit">
								<input type="checkbox" name="<?php echo $posttype; ?>[]" value="<?php echo get_the_ID(); ?>" <?php echo $checked; ?> />&nbsp;<?php the_title(); ?>
							</label></p>
						<?php endwhile;
						$i++;
					endif; ?>
				</div>
				 <?php  foreach($cat_list as $tax) :
					if($tax->parent == 0) :
						$ocmx_posts = new WP_Query("post_type=$posttype&$posttype-category=$tax->slug&posts_per_page=-1"); ?>
					<div id="<?php echo $posttype; ?>-category-<?php echo $tax->slug; ?>" class="tabs-panel" <?php if($i != 1) : ?>style="display: none;"<?php endif; ?>>
						 <?php if ($ocmx_posts->have_posts()) :
							while ($ocmx_posts->have_posts()) :	$ocmx_posts->the_post();
								if(is_array($input) && in_array(get_the_ID(), $input)) : $checked = "checked=\"checked\""; else : $checked = ""; endif; ?>
								<p><label class="selectit">
									<input type="checkbox" name="<?php echo $posttype; ?>[]" value="<?php echo get_the_ID(); ?>" <?php echo $checked; ?> />&nbsp;<?php the_title(); ?>
								</label></p>
							<?php endwhile;
						endif; ?>
					</div>
				<?php $i++; endif;
				endforeach; ?>
			</div>
		</div>
	<?php }

	function post_type_meta_update($postId, $posttype = "post") {
		foreach($_POST as $key => $value) :
			if($key == $posttype) :
				delete_post_meta($postId,$posttype);
				$metalist = array();
				foreach($value as $val) :
					if(!in_array($val, $metalist))
						$metalist[] = $val;
				endforeach;
				add_post_meta($postId,$key,$metalist,true) or update_post_meta($postId,$key,$metalist);
			endif;
		endforeach;
	}

	function post_meta_panel($postId, $postmeta) {
		global $blog_id, $post;
		wp_reset_postdata(); ?>
		<table class="obox_metaboxes_table">
			<?php foreach ($postmeta as $metabox) :
				$metabox_value = get_post_meta($postId, $metabox["name"],true);

				if ($metabox_value == "" || !isset($metabox_value)) :
					$metabox_value = $metabox['default'];
				endif; ?>
				<tr>
					<td width="20%" valign="top" class="obox_label">
						<label for="<?php echo $metabox; ?>"><?php echo $metabox["label"]; ?></label>
						<p><?php echo $metabox["desc"] ?></p>
					</td>
					<td colspan="3">
						<?php if($metabox["input_type"] == "image") : ?>
							<div class="clearfix"><input type="file" name="<?php echo "obox_".$metabox["name"]."_file"; ?>" /></div>
							<div class="clearfix">
								<label>Image Path</label>
								<?php if(empty($obox_metabox_value)) : ?>
									<input class="obox_input_text" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" size="<?php echo $metabox["input_size"] ?>" />
								<?php else : ?>
									<input class="obox_input_text" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" />
								<?php endif; ?>
							</div>
						<?php elseif($metabox["input_type"] == "background") : ?>
								<?php
									$meta_attributes_form_item = "obox_".$metabox["name"]."_attributes";
									$meta_attributes = get_post_meta($postId, $metabox["name"]."_attributes",true);
								?>
							<div class="background-position-selectors">
								<fieldset class="obox-background-options">
									 <h4><?php _e('Background Color', 'ocmx'); ?></h4>
									<input class="obox_metabox_fields" type="text" name="<?php echo $meta_attributes_form_item ; ?>[colour]" id="<?php echo $meta_attributes_form_item ; ?>[colour]" value="<?php if(isset($meta_attributes["colour"])) echo $meta_attributes["colour"]; ?>" <?php if(isset($metabox['default_colour'])) : ?>data-default-color="#<?php $metabox['default_colour']; ?>"<?php endif; ?> />
								</fieldset>
								<fieldset class="obox-background-options">
									 <h4><?php _e('Background Image', 'ocmx'); ?></h4>
									<div class="clearfix"><input type="file" name="<?php echo "obox_".$metabox["name"]."_file"; ?>" /></div>
									<div class="clearfix">
										<label>Image Path</label>
										<?php if(empty($obox_metabox_value)) : ?>
											<input class="obox_input_text" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" size="<?php echo $metabox["input_size"] ?>" />
										<?php else : ?>
											<input class="obox_input_text" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" />
										<?php endif; ?>
									</div>
								</fieldset>
								<fieldset class="obox-background-options">
									<h4><?php _e('Position', 'ocmx'); ?></h4>
									<legend class="screen-reader-text"><span><?php _e('Background Position', 'ocmx'); ?></span></legend>
									<label>
										<input name="<?php echo $meta_attributes_form_item ; ?>[position]" type="radio" value="left" <?php if(isset($meta_attributes["position"]) && $meta_attributes["position"] == 'left') : ?>checked="checked"<?php endif; ?>>
										<?php _e('Left', 'ocmx'); ?>
									</label>
									<label>
										<input name="<?php echo $meta_attributes_form_item; ?>[position]" type="radio" value="center" <?php if(isset($meta_attributes["position"]) && $meta_attributes["position"] == 'center') : ?>checked="checked"<?php endif; ?>>
										<?php _e('Center', 'ocmx'); ?>
									</label>
									<label>
										<input name="<?php echo $meta_attributes_form_item; ?>[position]" type="radio" value="right" <?php if(isset($meta_attributes["position"]) && $meta_attributes["position"] == 'right') : ?>checked="checked"<?php endif; ?>>
										<?php _e('Right', 'ocmx'); ?>
									</label>
								</fieldset>

								<fieldset class="obox-background-options">
									<h4><?php _e('Repeat', 'ocmx'); ?></h4>
									<legend class="screen-reader-text"><span><?php _e('Background Repeat', 'ocmx'); ?></span></legend>
									<label><input type="radio" name="<?php echo $meta_attributes_form_item; ?>[repeat]" value="no-repeat" <?php if(isset($meta_attributes["repeat"]) && $meta_attributes["repeat"] == 'no-repeat') : ?>checked="checked"<?php endif; ?>> No Repeat</label>
									<label><input type="radio" name="<?php echo $meta_attributes_form_item; ?>[repeat]" value="repeat" <?php if(isset($meta_attributes["repeat"]) && $meta_attributes["repeat"] == 'repeat') : ?>checked="checked"<?php endif; ?>> Tile</label>
									<label><input type="radio" name="<?php echo $meta_attributes_form_item; ?>[repeat]" value="repeat-x" <?php if(isset($meta_attributes["repeat"]) && $meta_attributes["repeat"] == 'repeat-x') : ?>checked="checked"<?php endif; ?>> Tile Horizontally</label>
									<label><input type="radio" name="<?php echo $meta_attributes_form_item; ?>[repeat]" value="repeat-y" <?php if(isset($meta_attributes["repeat"]) && $meta_attributes["repeat"] == 'repeat-y') : ?>checked="checked"<?php endif; ?>> Tile Vertically</label>
								</fieldset>

							</div>
						<?php elseif($metabox["input_type"] == "image-select") :
							foreach($metabox["options"] as $option) :
										if($option == $metabox_value) :
											$suffix = "-on";
										else :
											$suffix = "-off";
										endif;
								?>
									<label for="<?php echo $option; ?>" class="image-select">
										<img src="<?php echo get_template_directory_uri().$metabox["image-folder"].$option.$suffix.".png"; ?>" />
										<input type="radio" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo $option; ?>" value="<?php echo $option; ?>"/>
									</label>
								<?php endforeach; ?>
						<?php elseif($metabox["input_type"] == "select") : ?>
							<select name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>">
								<?php foreach($metabox["options"] as $option => $value) : ?>
									<option <?php if($metabox_value == $value) : ?>selected="selected"<?php endif; ?> value="<?php echo $value; ?>"><?php echo $option; ?></option>
								<?php endforeach; ?>
							</select>
						<?php elseif($metabox["input_type"] == "radio") :
							foreach($metabox["options"] as $option => $value) : ?>
								<label for="<?php echo "obox_".$metabox["name"]; ?>_<?php echo $value; ?>">
									<input type="radio" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>_<?php echo $value; ?>" <?php if( $metabox_value == $value ) : ?>checked="checked"<?php endif; ?> value="<?php echo $value; ?>"> <?php echo $option; ?> &nbsp;
								</label>
							<?php endforeach;

						elseif($metabox["input_type"] == "selfhosted") :
							$mp4_value = get_post_meta($postId, $metabox["name"]."_mp4", true);
							$ogv_value = get_post_meta($postId, $metabox["name"]."_ogv", true);  ?>
							<input class="obox_metabox_fields" type="hidden" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" />
							<div class="background-position-selectors">
								<fieldset class="obox-background-options">
									<h4><?php _e('.mp4', 'ocmx'); ?></h4>
									<input class="obox_metabox_fields" type="text" name="<?php echo "obox_".$metabox["name"]."_mp4"; ?>" id="<?php echo "obox_".$metabox["name"]."_mp4"; ?>" value="<?php echo $mp4_value; ?>" />
								</fieldset>
								<fieldset class="obox-background-options">
									<h4><?php _e('.ogv', 'ocmx'); ?></h4>
									<input class="obox_metabox_fields" type="text" name="<?php echo "obox_".$metabox["name"]."_ogv"; ?>" id="<?php echo "obox_".$metabox["name"]."_ogv"; ?>" value="<?php echo $ogv_value; ?>" />
								</fieldset>
							</div>

						<?php elseif($metabox["input_type"] == "textarea") : ?>
							<textarea class="obox_metabox_fields" style="width: 70%;" rows="8" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>"><?php echo $metabox_value; ?></textarea>

						<?php elseif($metabox["input_type"] == "color") : ?>
							<input class="obox_metabox_fields" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" data-default-color="#<?php $metabox['default']; ?>" />

						<?php else : ?>
							<input class="obox_metabox_fields" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" />
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<?php }
	function ocmx_change_metatype(){
	?>
		<script type="text/javascript">
		/* <![CDATA[ */
			jQuery(window).load(function(){
				jQuery('form#post').attr('enctype','multipart/form-data');
			});
		/* ]]> */
		</script>
	<?php
		wp_enqueue_style( 'post-meta', get_template_directory_uri().'/ocmx/post-meta.css');
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
	}

	function post_meta_update($postId, $postmeta){
		foreach ($postmeta as $metabox) {
			$var = "obox_".$metabox["name"];
			if (isset($_POST[$var])) :
				if($metabox["input_type"] == "image" || $metabox["input_type"] == "background" || $metabox["input_type"] == "selfhosted") :
					$use_file_field = $var."_file";

					// Upload files
					if($_FILES[$use_file_field]["name"] != "") :
						$id = media_handle_upload($use_file_field, $postId);
						if($metabox["name"] == "other_media") :
							set_post_thumbnail($postId, $id);
						endif;
						$attachment = wp_get_attachment_url( $id );
						//Update Post Meta
						add_post_meta($postId, $metabox["name"], $attachment,true) or update_post_meta($postId,  $metabox["name"], $attachment);
					else :
						//Update Post Meta
						add_post_meta($postId,$metabox["name"],$_POST[$var],true) or update_post_meta($postId,$metabox["name"], $_POST[$var]);
					endif;

					// Custom Background
					if($metabox["input_type"] == "background") :
						add_post_meta($postId,$metabox["name"]."_attributes",$_POST[$var."_attributes"],true) or update_post_meta($postId,$metabox["name"]."_attributes", $_POST[$var."_attributes"]);
					endif;

					// Self Hosted Videos
					if($metabox["input_type"] == "selfhosted") :
						add_post_meta($postId,$metabox["name"]."_mp4",$_POST[$var."_mp4"],true) or update_post_meta($postId,$metabox["name"]."_mp4", $_POST[$var."_mp4"]);
						add_post_meta($postId,$metabox["name"]."_ogv",$_POST[$var."_ogv"],true) or update_post_meta($postId,$metabox["name"]."_ogv", $_POST[$var."_ogv"]);
					endif;
				else :
					add_post_meta($postId,$metabox["name"],$_POST[$var],true) or update_post_meta($postId,$metabox["name"],$_POST[$var]);
					// If this is the oEmbed field, let's look for the thumbnail related to the video
					if($metabox["name"] == "video_link") :
						if( strpos($_POST[$var],'vimeo') || strpos($_POST[$var],'youtube') ) :
							$video_info = video_info($_POST[$var]);
							try{
								if(is_array($video_info) && isset($video_info['thumb_large'])) :
									add_post_meta($postId,"oembed_info",$video_info,true) or update_post_meta($postId,"oembed_info",$video_info);
								endif;
							}catch (Exception $e) {}
						endif;
					endif;
				endif;
			endif;
		}
	}
//};