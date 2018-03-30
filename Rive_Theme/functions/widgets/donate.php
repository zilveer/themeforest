<?php
/*
* donation widget
*/

class DonationWidget extends WP_Widget {

	function DonationWidget() {
		$widget_ops = array('classname' => 'donate_widget', 'description' => __('Displays a donation form.', 'ch'));
		parent::__construct('donations', __('Believe - Donation', 'ch'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title            = apply_filters('widget_title', empty($instance['title']) ? __('Donate', 'ch') : $instance['title'], $instance, $this->id_base);
		$page_id          = $instance['page_id'];
		$text_under_input = $instance['text_under_input'];
		$currency_sign    = get_option('ch_currency_sign') ? get_option('ch_currency_sign') : '$';
		echo $before_widget;

		// Show title
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		?>
		<form action="#" method="post" class="donate_form">
			<div class="input-prepend input-append">
				<span class="add-on strong"><?php echo $currency_sign; ?></span>
				<input id="appendedPrependedDropdownButton" class="donate-input-text donation-amount span14" name="amount" type="text" placeholder="">
				<input type="submit" class="btn btn-primary strong" value="<?php _e( 'Donate', 'ch' ); ?>" type="submit">
			</div>
		</form>
		<p><?php echo $text_under_input; ?></p>
		<script type="text/javascript">
		jQuery('.donate_form').submit(function(e) {
			e.preventDefault();
			window.location = '<?php echo get_permalink($page_id); ?>?amount=' + jQuery('.donation-amount').val();
		});
		</script>
		<div class="clearfix"></div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance                     = $old_instance;
		$instance['page_id']          = (int)$new_instance['page_id'];
		$instance['title']            = strip_tags($new_instance['title']);
		$instance['text_under_input'] = strip_tags($new_instance['text_under_input']);

		return $instance;
	}

	function form($instance) {
		$instance         = wp_parse_args((array) $instance, array('title' => '', 'text' => '', 'title_link' => ''));
		$page_id          = $instance['page_id'];
		$title            = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$text_under_input = isset($instance['text_under_input']) ? esc_attr($instance['text_under_input']) : '';
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('text_under_input'); ?>"><?php _e('Text under input box:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text_under_input'); ?>" name="<?php echo $this->get_field_name('text_under_input'); ?>" type="text" value="<?php echo esc_attr($text_under_input); ?>" />
		</p>
		<p style="color:#999;">
			<em>Enter text which will appear under input box.</em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Page id:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('page_id'); ?>" name="<?php echo $this->get_field_name('page_id'); ?>" type="text" value="<?php echo esc_attr($page_id); ?>" />
		</p>
		<p style="color:#999;">
			<em>Enter page id to which user should be redirected after hitting Donate button.</em>
		</p>
<?php
	}
}

register_widget('DonationWidget');