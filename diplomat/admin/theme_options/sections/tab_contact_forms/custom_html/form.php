<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
$form_index = 0;
if (isset($contact_form['inique_id'])) {
	$form_index = $contact_form['inique_id'];
} else {
	$form_index = uniqid();
}
?>

<a href="#" class="admin-button button-gray js_back_to_forms_list"><?php _e('Back to forms list', 'diplomat'); ?></a>

<br />

<input type="hidden" name="contact_form[<?php echo $form_index; ?>][inique_id]" value="<?php echo $form_index ?>" />

<div class="section">

	<div class="form-holder">

		<div class="form-group-title">
			<input type="text" class="form_name" value="<?php echo esc_attr($contact_form['title']); ?>" name="contact_form[<?php echo $form_index; ?>][title]">
		</div><!--/ .form-group-title-->

		<div class="option">

			<div class="switch">
				<input type="hidden" name="contact_form[<?php echo $form_index; ?>][has_capture]" value="<?php echo($contact_form['has_capture'] ? 1 : 0) ?>" />
				<input type="checkbox" <?php echo($contact_form['has_capture'] ? "checked" : "") ?> class="form_captcha option_checkbox" />
				<label for="form-captcha"><span></span><?php _e('Enable Captcha', 'diplomat'); ?></label>
				<input type="hidden" name="contact_form_index" value="<?php echo $form_index; ?>" />
			</div><!--/ .switch-->

		</div>

		<a href="#" class="add-drag-holder add-button add_contact_field_button" form-id="<?php echo $form_index ?>"></a>

		<div class="admin-drag-holder clearfix">

			<div class="option option-select">

				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[" . $form_index . "][submit_button]",
					'title' => __('Select Submit Button', 'diplomat'),
					'type' => 'select',
					'values' => TMM_OptionsHelper::get_theme_buttons(),
					'value' => isset($contact_form['submit_button']) ? $contact_form['submit_button'] : 'default-blue',
					'css_class' => '',
					'description' => __('Button color', 'diplomat')
				));
				?>

			</div><!--/ .option-->

			<div class="option option-text">

				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[" . $form_index . "][submit_button_text]",
					'title' => __('Submit Button Text', 'diplomat'),
					'type' => 'text',
					'value' => __('Submit', 'diplomat'),
					'css_class' => '',
					'description' => __('Button text', 'diplomat')
				));
				?>

			</div><!--/ .option-->

			<div class="option option-text">

				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[" . $form_index . "][recepient_email]",
					'title' => __('Alternative recipients', 'diplomat'),
					'type' => 'text',
					'value' => @$contact_form['recepient_email'],
					'css_class' => '',
					'description' => __('Normally site admin gets notifications from all form submitters. Please type here an alternative email address if you want to receive form submission to other mailbox.', 'diplomat')
				));
				?>

			</div><!--/ .option-->

		</div>

		<ul class="drag_contact_form_list">

			<?php if (!empty($contact_form['inputs'])) : ?>
				<?php foreach ($contact_form['inputs'] as $key_input => $input) : ?>
					<?php $key_input = uniqid(); ?>

					<li class="admin-drag-holder clearfix">

						<a href="#" class="delete_contact_field_button close"></a>

						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[$form_index][inputs][$key_input][type]",
							'title' => __('Choose Field Type', 'diplomat'),
							'type' => 'select',
							'values' => TMM_Contact_Form::$types,
							'value' => $input['type'],
							'css_class' => 'options_type_select',
							'description' => __('Please determine a field type here.', 'diplomat')
						));
						?>

						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][label]",
							'title' => __('Field Label/Placeholder', 'diplomat'),
							'type' => 'text',
							'value' => $input['label'],
							'css_class' => 'label',
							'description' => __('To name your field element or group of elements (only for checkbox/radio elements) type the label here.', 'diplomat')
						));
						?>
                        
						<div class="select_options" style="display: <?php echo ($input['type'] == "select" || $input['type'] == "radio" || $input['type'] == "checkbox") ? "block" : "none" ?>;">

							<?php
							TMM_OptionsHelper::draw_theme_option(array(
								'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][options]",
								'title' => __('Options (comma separated)', 'diplomat'),
								'type' => 'text',
								'value' => $input['options'],
								'css_class' => 'options',
								'description' => __('Type the field options in this field, use commas to split every new option.', 'diplomat')
							));
							?>

						</div>

						<div class="title_options" style="display: <?php echo $input['type'] == "title" ? "block" : "none" ?>;">

							<?php
							TMM_OptionsHelper::draw_theme_option(array(
								'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][title_heading]",
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
								'value' => $input['title_heading'],
								'css_class' => 'options',
								'description' => __('Choose the necessary heading title to determine a group of elements below.', 'diplomat')
							));
							?>

						</div>

						<div class="optional_field" style="display: <?php echo $input['type'] == "checkbox" ? 'block' : 'none' ?>;">
							<label>
							<?php
							TMM_OptionsHelper::draw_theme_option(array(
								'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][optional_field]",
								'type' => 'checkbox',
								'default_value' => 0,
								'title' => __('Display Textarea Field', 'diplomat'),
								'description' => __('If enabled, a new textarea will appear next to current option set, whether for comments or typing a new custom option by user.', 'diplomat'),
								'css_class' => '',
								'value' => $input['optional_field'],
								'id' => ''
							));
							?>
								<label>
						</div>

						<label class="with-check" style="display: <?php echo $input['type'] == 'title' ? 'none' : 'block' ?>;">

							<?php
							TMM_OptionsHelper::draw_theme_option(array(
								'name' => "contact_form[" . $form_index . "][inputs][" . $key_input . "][is_required]",
								'type' => 'checkbox',
								'default_value' => 0,
								'title' => __('Required Field', 'diplomat'),
								'description' => __('If enabled, it is mandatory field to be filled in.', 'diplomat'),
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

		<a href="#" class="add-drag-holder add-button add_contact_field_button" form-id="<?php echo $form_index ?>" style="bottom: -15px;top: auto;"></a>

	</div><!--/ .form-holder-->

</div><!--/ .section-->