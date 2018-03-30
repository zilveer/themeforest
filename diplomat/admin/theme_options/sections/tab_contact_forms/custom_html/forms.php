<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="js_contact_forms_panel">

	<div class="option option-add-form">

		<h4 class="option-title"><?php _e('Add New Form', 'diplomat'); ?></h4>

		<div class="controls">
			<input type="text" value="" placeholder="<?php _e("type title here", 'diplomat') ?>" id="new_contact_form_name" />
			<div class="add-button js_add_form"></div>
		</div><!--/ .controls-->
		<div class="explain"></div>

	</div><!--/ .option-->

	<hr />

	<ul class="groups contact_forms_groups_list">
		<?php unset($contact_forms['__INIQUE_ID__']); ?>
		<?php if (!empty($contact_forms) AND is_array($contact_forms)): ?>
			<?php foreach ($contact_forms as $contact_form_id => $contact_form) : ?>				
				<li>
					<a data-id="contact_form_<?php echo $contact_form_id ?>" class="js_edit_contact_form" href="#"><?php echo esc_attr($contact_form['title']); ?></a>
					<a href="#" title="<?php _e("Delete", 'diplomat') ?>" class="remove delete_contact_form" data-id="contact_form_<?php echo $contact_form_id ?>"></a>
					<a data-id="contact_form_<?php echo $contact_form_id ?>" href="#" title="<?php _e("Edit", 'diplomat') ?>" class="edit js_edit_contact_form"></a>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li class="js_no_one_item_else"><span><?php _e('You have not created any group yet. Please create one using the form above.', 'diplomat'); ?></span></li>
		<?php endif; ?>
	</ul>
<br />
</div>

<input type="hidden" name="contact_form[]" value="" />
<ul id="contact_forms_list">
	<?php if (!empty($contact_forms) AND is_array($contact_forms)): ?>
		<?php foreach ($contact_forms as $contact_form_id => $contact_form) : ?>
			<?php
			if ($contact_form_id == '__INIQUE_ID__') {
				continue;
			}
			?>
			<li style="display: none;" id="contact_form_<?php echo $contact_form_id ?>">
				<?php echo TMM::draw_free_page($custom_html_pagepath . 'form.php', array('contact_form' => $contact_form)); ?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>



<div style="display: none;" id="contact_form_template">

	<a href="#" class="admin-button button-gray js_back_to_forms_list"><?php _e('Back to forms list', 'diplomat'); ?></a>

	<br />
	<br />
	<br />

	<div class="section">

		<div class="form-holder">	

			<input type="hidden" name="contact_form[__INIQUE_ID__][inique_id]" value="__INIQUE_ID__" />

			<div class="form-group-title">
				<input type="text" class="form_name" value="__FORM_NAME__" name="contact_form[__INIQUE_ID__][title]">
			</div>
			
			<div class="option">
				
				<div class="switch">
					<input type="hidden" name="contact_form[__INIQUE_ID__][has_capture]" value="0" />
					<input type="checkbox" class="form_captcha option_checkbox" />
					<label for="form-captcha"><span></span><?php _e('Enable Captcha', 'diplomat'); ?></label>
					<input type="hidden" name="contact_form_index" value="__INIQUE_ID__" />
				</div>
			
			</div>

			<a href="#" class="add-drag-holder add-button add_contact_field_button" form-id="__INIQUE_ID__"></a>
			<a href="#" class="remove-drag-holder delete_contact_form" data-id="__INIQUE_ID__"></a><br />

			<div class="admin-drag-holder clearfix">

				<div class="option option-select contact_form_submit_button">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][submit_button]",
						'title' => __('Select submit button', 'diplomat'),
						'type' => 'select',
						'values' => TMM_OptionsHelper::get_theme_buttons(),
						'value' => '',
						'css_class' => '',
						'description' => __('Button color', 'diplomat'),
					));
					?>				
				</div>

				<div class="option option-text">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][submit_button_text]",
						'title' => __('Submit button text', 'diplomat'),
						'type' => 'text',
						'value' => __('Submit', 'diplomat'),
						'css_class' => '',
						'description' => __('Button text', 'diplomat')
					));
					?>
				</div>

				<div class="option option-text">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][recepient_email]",
						'title' => __('Alternative recipients', 'diplomat'),
						'type' => 'text',
						'value' => "",
						'css_class' => '',
						'description' => __('Normally site admin gets notifications from all form submitters. Please type here an alternative email address if you want to receive form submission to other mailbox.', 'diplomat')
					));
					?>
				</div>

			</div>

			<ul class="drag_contact_form_list">

				<li class="admin-drag-holder clearfix">

					<a href="#" class="delete_contact_field_button close"></a>

					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][inputs][0][type]",
						'title' => __('Choose Field Type', 'diplomat'),
						'type' => 'select',
						'values' => TMM_Contact_Form::$types,
						'value' => '',
						'css_class' => 'options_type_select',
						'description' => __('Please determine a field type here.', 'diplomat')
					));
					?>

					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][inputs][0][label]",
						'title' => __('Field Label / Placeholder', 'diplomat'),
						'type' => 'text',
						'value' => '',
						'css_class' => 'label',
						'description' => __('To name your field element or group of elements (only for checkbox/radio elements) type the label here.', 'diplomat')
					));
					?>

					<div class="select_options" style="display: none;">

						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[__INIQUE_ID__][inputs][0][options]",
							'title' => __('Options (comma separated)', 'diplomat'),
							'type' => 'text',
							'value' => '',
							'css_class' => 'options',
							'description' => __('Type the field options in this field, use commas to split every new option.', 'diplomat')
						));
						?>
					</div>

					<div class="optional_field" style="display: none;">
						<label>
						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[__INIQUE_ID__][inputs][0][optional_field]",
							'type' => 'checkbox',
							'default_value' => 0,
							'title' => __('Display Textarea Field', 'diplomat'),
							'description' => __('If enabled, a new textarea will appear next to current option set, whether for comments or typing a new custom option by user.', 'diplomat'),
							'css_class' => '',
							'value' => 0,
							'id' => ''
						));
						?>
						</label>
					</div>


					<label class="with-check">
						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[__INIQUE_ID__][inputs][0][is_required]",
							'type' => 'checkbox',
							'default_value' => 0,
							'title' => __('Required Field', 'diplomat'),
							'description' => __('If enabled, it is mandatory field to be filled in.', 'diplomat'),
							'css_class' => 'form_required',
							'value' => 0,
							'id' => ''
						));
						?>
					</label>

				</li><!--/ .admin-drag-holder-->

			</ul>

		</div><!--/ .form-holder-->	

	</div><!--/ .section-->

</div>

<div style="display: none;" id="contact_form_field_template">

	<li class="admin-drag-holder clearfix">

		<a href="#" class="delete_contact_field_button close"></a>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][type]",
			'title' => __('Choose Field Type', 'diplomat'),
			'type' => 'select',
			'values' => TMM_Contact_Form::$types,
			'value' => '',
			'css_class' => 'options_type_select',
			'description' => __('Please determine a field type here.', 'diplomat')
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][label]",
			'title' => __('Field Label / Placeholder', 'diplomat'),
			'type' => 'text',
			'value' => "",
			'css_class' => 'label',
			'description' => __('To name your field element or group of elements (only for checkbox/radio elements) type the label here.', 'diplomat')
		));
		?>

		<div class="select_options" style="display: none;">

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][options]",
				'title' => __('Options (comma separated)', 'diplomat'),
				'type' => 'text',
				'value' => '',
				'css_class' => 'options',
				'description' => __('Type the field options in this field, use commas to split every new option.', 'diplomat')
			));
			?>

		</div>

		<div class="title_options" style="display: none;">

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][title_heading]",
				'title' => __('Title Heading', 'diplomat'),
				'type' => 'select',
				'values' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'value' => '',
				'css_class' => 'options',
				'description' => __('Choose the necessary heading title to determine a group of elements below.', 'diplomat')
			));
			?>

		</div>

		<label class="with-check">
			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][is_required]",
				'type' => 'checkbox',
				'default_value' => 0,
				'title' => __('Required Field', 'diplomat'),
				'description' => __('If enabled, it is mandatory field to be filled in.', 'diplomat'),
				'css_class' => 'form_required',
				'value' => 0,
				'id' => ''
			));
			?>
		</label>

	</li><!--/ .admin-drag-holder-->

</div>