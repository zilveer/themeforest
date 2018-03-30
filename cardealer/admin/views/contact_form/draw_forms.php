<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="contact_forms">
	<?php
	if (is_string($contact_forms) AND !empty($contact_forms)) {
		$contact_forms = unserialize($contact_forms);
	}
	?>


	<?php if (!empty($contact_forms) AND is_array($contact_forms)) : ?>
		<?php $counter = 0; ?>
		<?php foreach ($contact_forms as $contact_form) : ?>
			<div id="contact_form_<?php echo $counter ?>" class="tab-content" style="display: none">
				<?php
				$form_index = 0;
				if (isset($contact_form['inique_id'])) {
					$form_index = $contact_form['inique_id'];
				} else {
					$form_index = uniqid();
				}
				?>

				<input type="hidden" name="contact_form[<?php echo $form_index; ?>][inique_id]" value="<?php echo $form_index ?>" />

				<div class="form-holder">

					<span class="form-group-title"><input type="text" class="form_name" value="<?php echo $contact_form['title'] ?>" name="contact_form[<?php echo $form_index; ?>][title]"></span>

					<div class="switch">
						<input type="hidden" name="contact_form[<?php echo $form_index; ?>][has_capture]" value="<?php echo($contact_form['has_capture'] ? 1 : 0) ?>" />
						<input type="checkbox" id="form-captcha" <?php echo($contact_form['has_capture'] ? "checked" : "") ?> class="form_captcha option_checkbox" />
						<label for="form-captcha"><span></span><?php _e('Enable Captcha', 'cardealer'); ?></label>
						<input type="hidden" name="contact_form_index" value="<?php echo $form_index; ?>" />
					</div>

					<a href="#" class="add-button add_contact_field_button add-slider-group" form-id="<?php echo $form_index ?>"></a>
					<a href="#" class="delete_contact_form remove-button remove-slider-group" form-list-index="<?php echo $counter ?>"></a><br />

					<div class="admin-drag-holder clearfix">

						<h4><?php _e('Select submit button', 'cardealer'); ?></h4>

						<div class="contact_form_submit_button">
							<?php
							TMM_OptionsHelper::draw_theme_option(array(
								'name' => "contact_form[" . $form_index . "][submit_button]",
								'type' => 'select',
								'values' => TMM_OptionsHelper::get_theme_buttons(),
								'value' => @$contact_form['submit_button'],
								'css_class' => '',
								'description' => __('Button color', 'cardealer')
							));
							?>
						</div>


						<h4><?php _e('Recipient\'s e-mail field:', 'cardealer'); ?></h4>
						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[" . $form_index . "][recepient_email]",
							'type' => 'text',
							'value' => @$contact_form['recepient_email'],
							'css_class' => '',
							'description' => ''
						));
						?>

					</div>

					<?php $contact_form_object = new TMM_Contact_Form("xxx") ?>
					<ul class="drag_contact_form_list">
						<?php if (!empty($contact_form['inputs'])) : ?>
							<?php foreach ($contact_form['inputs'] as $key_input => $input) : ?>
								<?php $key_input = uniqid(); ?>
								<li class="admin-drag-holder clearfix">

									<a href="#" class="delete_contact_field_button close-drag-holder"></a>

									<h4><?php _e('Choose Field Type', 'cardealer'); ?></h4>
									<?php
									TMM_OptionsHelper::draw_theme_option(array(
										'name' => "contact_form[$form_index][inputs][$key_input][type]",
										'type' => 'select',
										'values' => $contact_form_object->types,
										'value' => $input['type'],
										'css_class' => 'options_type_select',
										'description' => ''
									));
									?>

									<h4><?php _e('Field Label', 'cardealer'); ?></h4>
									<?php
									TMM_OptionsHelper::draw_theme_option(array(
										'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][label]",
										'type' => 'text',
										'value' => $input['label'],
										'css_class' => 'label',
										'description' => ""
									));
									?>

									<div class="select_options" style="display: <?php echo($input['type'] == "select" ? "block" : "none") ?>;">
										<h4><?php _e('Options (comma separated)', 'cardealer'); ?></h4>
										<?php
										TMM_OptionsHelper::draw_theme_option(array(
											'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][options]",
											'type' => 'text',
											'value' => $input['options'],
											'css_class' => 'options',
											'description' => ""
										));
										?>
									</div>

									<h4><?php _e('Additional Options', 'cardealer'); ?></h4>
									<label class="with-check">
										<?php
										TMM_OptionsHelper::draw_theme_option(array(
											'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][is_required]",
											'type' => 'checkbox',
											'default_value' => 0,
											'title' => __('Required Field', 'cardealer'),
											'description' => '',
											'css_class' => 'form_required',
											'value' => $input['is_required'],
											'id' => ''
										));
										?>
									</label>

								</li><!--/ .admin-drag-holder-->

							<?php endforeach; ?>
						<?php endif; ?>
					</ul>

				</div><!--/ .form-holder-->
			</div>
			<?php $counter++; ?>
		<?php endforeach; ?>
	<?php endif; ?>

</div>