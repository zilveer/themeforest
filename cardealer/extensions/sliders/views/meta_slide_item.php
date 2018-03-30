<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $unique_id = uniqid() ?>
<?php
$google_fonts = TMM_HelperFonts::get_google_fonts();
$content_fonts = TMM_HelperFonts::get_content_fonts();
$fonts = array_merge($content_fonts, $google_fonts);
$fonts = array_merge(array("" => ""), $fonts);
?>
<div class="slide-item" id="slide_item_<?php echo $unique_id ?>">

	<div class="slide-dragger"></div>

    <div class="slide-thumb">
		<img src="<?php echo TMM_Helper::resize_image($group['imgurl'], '180*130') ?>" alt="slide" />
		<input type="hidden" name="slides_group[<?php echo $unique_id ?>][imgurl]" value="<?php echo $group['imgurl'] ?>" />
		<a href="#" class="button js_edit_slide" data-slide-id="<?php echo $unique_id ?>"><?php _e('Edit Image', 'cardealer'); ?></a>
	</div>

    <a href="#" class="js_delete_slide" slide-id="<?php echo $unique_id ?>" title="<?php _e('Delete Slide', 'cardealer'); ?>"><?php _e('Delete Slide', 'cardealer'); ?></a>

	<?php if (!empty(TMM_Ext_Sliders::$slider_options)): ?>

		<div id="slide_options_<?php echo $unique_id ?>" class="slide-options-dialog" dialog-id="<?php echo $unique_id ?>">
			<?php foreach (TMM_Ext_Sliders::$slider_options as $slider_key => $slider) : ?>

				<?php
				if ($slider_key == 'layerslider') {
					continue;
				}
				?>

				<h3 class="attr_title"><?php echo $slider['name']; ?></h3>

				<div class="attr_wrapper_options">
					<?php if (!empty($slider['fields'])): ?>
						<?php foreach ($slider['fields'] as $field_key => $field) : ?>

							<div class="slide-attr">

								<?php if ($field['type'] == 'textinput'): ?>
									<h4><?php echo $field['name'] ?>:</h4>
									<input type="text" class="left wide" name="slides_group[<?php echo $unique_id ?>][<?php echo $slider_key ?>][<?php echo $field_key ?>]" value="<?php echo @$group[$slider_key][$field_key] ?>" />
								<?php endif; ?>

								<?php if ($field['type'] == 'textarea'): ?>
									<h4><?php echo $field['name'] ?>:</h4>
									<textarea name="slides_group[<?php echo $unique_id ?>][<?php echo $slider_key ?>][<?php echo $field_key ?>]"><?php echo @$group[$slider_key][$field_key] ?></textarea>
								<?php endif; ?>

								<?php if ($field['type'] == 'checkbox'): ?>
									<?php $label_id = uniqid() ?>
									<input id="<?php echo $label_id ?>" type="checkbox" <?php if (@$group[$slider_key][$field_key]): ?>checked<?php endif; ?> class="option_checkbox" name="slides_group[<?php echo $unique_id ?>][<?php echo $slider_key ?>][<?php echo $field_key ?>]" value="<?php echo (int) @$group[$slider_key][$field_key] ?>" />
									<label for="<?php echo $label_id ?>"><?php echo $field['name'] ?></label>
								<?php endif; ?>

								<?php if (!empty($field['field_options'])): ?>
									<div class="attr-options">
										<?php foreach ($field['field_options'] as $option_key => $option_name) : ?>
											<div class="option">
												<?php
												$option_value = @$group[$slider_key]["field_values"][$field_key][$option_key];
												if (empty($option_value)) {
													$option_value = $field['field_options_defaults'][$option_key];
												}
												?>

												<?php if ($option_key == 'font_family'): ?>
													<div class="sel"><select name="slides_group[<?php echo $unique_id ?>][<?php echo $slider_key ?>][field_values][<?php echo $field_key ?>][<?php echo $option_key ?>]">

															<?php foreach ($fonts as $font_name) : ?>
																<?php
																$font_clean_name = explode(":", $font_name);
																$font_clean_name = $font_clean_name[0];
																?>
																<option <?php echo ($font_clean_name == $option_value ? "selected" : "") ?> value="<?php echo $font_clean_name; ?>"><?php echo $font_name; ?></option>
															<?php endforeach; ?>
														</select></div>
												<?php endif; ?>

												<?php if ($option_key == 'font_size'): ?>
													<?php
													$font_sizes = array();
													for ($i = 8; $i <= 32; $i++) {
														$font_sizes[] = $i;
													}
													?>
													<div class="sel"><select name="slides_group[<?php echo $unique_id ?>][<?php echo $slider_key ?>][field_values][<?php echo $field_key ?>][<?php echo $option_key ?>]">
															<option value=""></option>
															<?php foreach ($font_sizes as $size) : ?>
																<option <?php echo ($size == $option_value ? "selected" : "") ?> value="<?php echo $size; ?>"><?php echo $size; ?></option>
															<?php endforeach; ?>
														</select></div>
												<?php endif; ?>

												<?php if ($option_key == 'font_color'): ?>
													<div style="background-color: <?php echo $option_value ?>;" class="bgpicker"></div>
													<input type="text" name="slides_group[<?php echo $unique_id ?>][<?php echo $slider_key ?>][field_values][<?php echo $field_key ?>][<?php echo $option_key ?>]" value="<?php echo $option_value ?>" class="bg_hex_color small left">
												<?php endif; ?>

											</div>
										<?php endforeach; ?>
									</div>
									<div class="clear"></div>
								<?php endif; ?>

							</div>

						<?php endforeach; ?>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="clear"></div>
	<?php endif; ?>

</div>
<script type="text/javascript">
	// Slide Options Toggler
	jQuery('div.attr_wrapper_options').addClass('hide');
	jQuery('.slide-options-dialog').on('click', 'h3.attr_title', function() {
		jQuery(this)
				.addClass('active')
				.siblings('h3.attr_title')
					.removeClass('active');
		jQuery(this)
			.next()
				.slideDown('300')
				.siblings('div.attr_wrapper_options')
					.slideUp('300');
	});
</script>