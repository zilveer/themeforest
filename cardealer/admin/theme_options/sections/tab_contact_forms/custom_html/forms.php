<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="js_contact_forms_panel">

	<div class="option option-add-form">

		<h4 class="option-title"><?php _e('Add New Form', 'cardealer'); ?></h4>

		<div class="controls">
			<input type="text" value="" placeholder="<?php _e("type title here", 'cardealer') ?>" id="new_contact_form_name" />
			<div class="add-button js_add_form"></div>
		</div><!--/ .controls-->
		<div class="explain"></div>

	</div><!--/ .option-->

	<hr />

	<ul class="groups contact_forms_groups_list">
		<?php
		if (isset($contact_forms['__INIQUE_ID__'])) {
			unset($contact_forms['__INIQUE_ID__']);
		}
		?>
		<?php if (!empty($contact_forms) AND is_array($contact_forms)): ?>
			<?php foreach ($contact_forms as $contact_form_id => $contact_form) : ?>				
				<li>
					<a data-id="contact_form_<?php echo $contact_form_id ?>" class="js_edit_contact_form" href="#"><?php echo @$contact_form['title']; ?></a>
					<a href="#" title="<?php _e("Delete", 'cardealer') ?>" class="remove delete_contact_form" data-id="contact_form_<?php echo $contact_form_id ?>"></a>
					<a data-id="contact_form_<?php echo $contact_form_id ?>" href="#" title="<?php _e("Edit", 'cardealer') ?>" class="edit js_edit_contact_form"></a>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li class="js_no_one_item_else"><span><?php _e('You have not created any group yet. Please create one using the form above.', 'cardealer'); ?></span></li>
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

	<a href="#" class="admin-button button-gray js_back_to_forms_list"><?php _e('Back to forms list', 'cardealer'); ?></a>

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
					<input type="checkbox" id="form-captcha" class="form_captcha option_checkbox" />
					<label for="form-captcha"><span></span><?php _e('Enable Captcha', 'cardealer'); ?></label>
					<input type="hidden" name="contact_form_index" value="__INIQUE_ID__" />
				</div><!--/ .switch-->		
			
			</div>

			<a href="#" class="add-drag-holder add-button add_contact_field_button" form-id="__INIQUE_ID__"></a>
			<a href="#" class="remove-drag-holder delete_contact_form" data-id="__INIQUE_ID__"></a><br />

			<div class="admin-drag-holder clearfix">

				<div class="contact_form_submit_button option option-select">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][submit_button]",
						'title' => __('Select Submit Button Color', 'cardealer'),
						'type' => 'select',
						'values' => TMM_OptionsHelper::get_theme_buttons(),
						'value' => '',
						'show_title' => true,
						'css_class' => '',
						'description' => '',
					));
					?>				
				</div>

				<div class="option option-text">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][recepient_email]",
						'title' => __('Recipient\'s E-mail Field:', 'cardealer'),
						'type' => 'text',
						'value' => "",
						'css_class' => '',
						'description' => ''
					));
					?>
				</div>


				<div class="option option-text">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][submit_button_text]",
						'title' => __('Submit Button Text', 'cardealer'),
						'type' => 'text',
						'value' => __('Send Email', 'cardealer'),
						'css_class' => '',
						'description' => ''
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
						'title' => __('Choose Field Type', 'cardealer'),
						'type' => 'select',
						'values' => TMM_Contact_Form::$types,
						'value' => '',
						'show_title' => true,
						'css_class' => 'options_type_select',
						'description' => ''
					));
					?>

					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][inputs][0][label]",
						'title' => __('Field Label', 'cardealer'),
						'type' => 'text',
						'value' => "",
						'css_class' => 'label',
						'description' => ""
					));
					?>

					<div class="select_options" style="display: none;">

						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[__INIQUE_ID__][inputs][0][options]",
							'title' => __('Options (comma separated)', 'cardealer'),
							'type' => 'text',
							'value' => '',
							'css_class' => 'options',
							'description' => ""
						));
						?>
					</div>

					<label class="with-check">
						<?php
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "contact_form[__INIQUE_ID__][inputs][0][is_required]",
							'title' => __('Additional Options', 'cardealer'),
							'type' => 'checkbox',
							'default_value' => 0,
							'title' => __('Required Field', 'cardealer'),
							'description' => '',
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
			'title' => __('Choose Field Type', 'cardealer'),
			'type' => 'select',
			'values' => TMM_Contact_Form::$types,
			'value' => '',
			'show_title' => true,
			'css_class' => 'options_type_select',
			'description' => ''
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][label]",
			'title' => __('Field Label', 'cardealer'),
			'type' => 'text',
			'value' => "",
			'css_class' => 'label',
			'description' => ""
		));
		?>

		<div class="select_options" style="display: none;">

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][options]",
				'title' => __('Options (comma separated)', 'cardealer'),
				'type' => 'text',
				'value' => '',
				'css_class' => 'options',
				'description' => ""
			));
			?>

		</div>

		<label class="with-check">
			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][is_required]",
				'title' => __('Additional Options', 'cardealer'),
				'type' => 'checkbox',
				'default_value' => 0,
				'title' => __('Required Field', 'cardealer'),
				'description' => '',
				'css_class' => 'form_required',
				'value' => 0,
				'id' => ''
			));
			?>
		</label>

	</li><!--/ .admin-drag-holder-->

</div>


