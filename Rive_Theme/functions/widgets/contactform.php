<?php
/*
* Contact form
*/

class ch_contactform extends WP_Widget {
	function ch_contactform() {
		$widget_options = array(
			'classname'   => 'ch_contactform',
			'description' => __('Displays a contact form.', 'ch')
		);
		parent::__construct('ch_contactform', __('Believe - Contact Form', 'ch') , $widget_options);
	}

	function widget($args, $instance) {

		// Vars
		global $ch_is_in_sidebar;

		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Email Us', 'ch') : $instance['title'], $instance, $this->id_base);
		$email = $instance['email'];

		echo $before_widget;

		$form_class = 'gray-form';
		if ($ch_is_in_sidebar === true) {
			$form_class = '';
		}

		if ($title)
			echo $before_title . $title . $after_title;
		?>

		<p style="display:none;" id="success">
			<?php _e('Your message was successfully sent. <strong>Thank You!</strong>', 'ch'); ?>
		</p>
		<p style="display:none;" id="error">
			<?php _e('An error occurred. Try again later.', 'ch'); ?>
		</p>

		<form class="content-form <?php echo $form_class; ?>" action="#" name="contact_form" id="contact_form" method="post">
			<input type="hidden" value="<?php echo $email; ?>" name="contact_to"/>
			<div>
				<input type="text" required="required" id="contact_name" name="contact_name" class="text_input input-block-level" size="22" tabindex="5" onclick="clearInput(this, 'Name (required)');" value="<?php _e('Name (required)', 'ch'); ?>" />
			</div>
			<div>
				<input type="email" required="required" id="contact_email" name="contact_email" class="text_input input-block-level" size="22" tabindex="6" onclick="clearInput(this, 'Email (required)');" value="<?php _e('Email (required)', 'ch'); ?>" />
			</div>
			<div class="input-textarea">
				<textarea required="required" name="contact_content" class="textarea input-block-level" tabindex="7" rows="4"></textarea>
				<span class="submitButton">
					<input type="submit" name="submit" class="btn btn-primary strong" value="<?php _e('Submit', 'ch'); ?>" />
				</span>
			</div>
		</form>

		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		return $instance;
	}

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : get_bloginfo('admin_email');

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Send emails to:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
		</p>
		<?php
	}
}

register_widget('ch_contactform');