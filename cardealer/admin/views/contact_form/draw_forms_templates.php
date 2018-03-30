<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div style="display: none;" id="contact_form_template">
	<?php $contact_form_object = new TMM_Contact_Form("xxx") ?>
	<div class="form-holder">

		<input type="hidden" name="contact_form[__INIQUE_ID__][inique_id]" value="__INIQUE_ID__" />
		<span class="form-group-title"><input type="text" class="form_name" value="__FORM_NAME__" name="contact_form[__INIQUE_ID__][title]"></span>

		<div class="switch">
			<input type="hidden" name="contact_form[__INIQUE_ID__][has_capture]" value="0" />
			<input type="checkbox" id="form-captcha" class="form_captcha option_checkbox" />
			<label for="form-captcha"><span></span><?php _e('Enable Captcha', 'cardealer'); ?></label>
			<input type="hidden" name="contact_form_index" value="__INIQUE_ID__" />
		</div><!--/ .switch-->

		<a href="#" class="add-button add_contact_field_button add-slider-group" form-id="__INIQUE_ID__"></a>
		<a href="#" class="delete_contact_form remove-button remove-slider-group" form-list-index="__INIQUE_ID__"></a><br />

		<div class="admin-drag-holder clearfix">

			<h4><?php _e('Select submit button', 'cardealer'); ?></h4>
			<div class="contact_form_submit_button">
				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[__INIQUE_ID__][submit_button]",
					'type' => 'select',
					'values' => TMM_OptionsHelper::get_theme_buttons(),
					'value' => '',
					'css_class' => '',
					'description' => __('Select Submit Button\'s color', 'cardealer'),					
				));
				?>				
			</div>

			<h4><?php _e('Recipient\'s e-mail field:', 'cardealer'); ?></h4>
				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[__INIQUE_ID__][recepient_email]",
					'type' => 'text',
					'value' => "",
					'css_class' => '',
					'description' => ''
				));
				?>
		</div>

		<ul class="drag_contact_form_list">

			<li class="admin-drag-holder clearfix">

				<a href="#" class="delete_contact_field_button close-drag-holder"></a>

				<h4><?php _e('Choose Field Type', 'cardealer'); ?></h4>
				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[__INIQUE_ID__][inputs][0][type]",
					'type' => 'select',
					'values' => $contact_form_object->types,
					'value' => '',
					
					'css_class' => 'options_type_select',
					'description' => ''
				));
				?>

				<h4><?php _e('Field Label', 'cardealer'); ?></h4>
				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[__INIQUE_ID__][inputs][0][label]",
					'type' => 'text',
					'value' => "",
					'css_class' => 'label',
					'description' => ""
				));
				?>

				<div class="select_options" style="display: none;">
					<h4><?php _e('Options (comma separated)', 'cardealer'); ?></h4>
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][inputs][0][options]",
						'type' => 'text',
						'value' => '',
						'css_class' => 'options',
						'description' => ""
					));
					?>
				</div>
				
				<h4><?php _e('Placeholder Icon', 'cardealer'); ?></h4>
				<?php
				TMM_OptionsHelper::draw_theme_option(array(
					'name' => "contact_form[__INIQUE_ID__][inputs][0][placeholder_icon]",
					'type' => 'select',
					'values' => TMM_OptionsHelper::get_contacts_placeholder_icons(),
					'value' => 0,
					'css_class' => 'options_type_select',
					'description' => ''
				));
				?>

				<h4><?php _e('Additional Options', 'cardealer'); ?></h4>
				<label class="with-check">
					<?php
					TMM_OptionsHelper::draw_theme_option(array(
						'name' => "contact_form[__INIQUE_ID__][inputs][0][is_required]",
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
</div>

<div style="display: none;" id="contact_form_field_template">

	<li class="admin-drag-holder clearfix">

		<a href="#" class="delete_contact_field_button close-drag-holder"></a>

		<h4><?php _e('Choose Field Type', 'cardealer'); ?></h4>
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][type]",
			'type' => 'select',
			'values' => $contact_form_object->types,
			'value' => '',
			'css_class' => 'options_type_select',
			'description' => ''
		));
		?>

		<h4><?php _e('Field Label', 'cardealer'); ?></h4>
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][label]",
			'type' => 'text',
			'value' => "",
			'css_class' => 'label',
			'description' => ""
		));
		?>

		<div class="select_options" style="display: none;">
			<h4><?php _e('Options (comma separated)', 'cardealer'); ?></h4>
			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][options]",
				'type' => 'text',
				'value' => '',
				'css_class' => 'options',
				'description' => ""
			));
			?>
		</div>
		
		<h4><?php _e('Placeholder Icon', 'cardealer'); ?></h4>
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][placeholder_icon]",
			'type' => 'select',
			'values' => TMM_OptionsHelper::get_contacts_placeholder_icons(),
			'value' => 0,
			'css_class' => 'options_type_select',
			'description' => ''
		));
		?>

		<h4><?php _e('Additional Options', 'cardealer'); ?></h4>
		<label class="with-check">
			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "contact_form[__INDEX__][inputs][__INPUTINDEX__][is_required]",
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