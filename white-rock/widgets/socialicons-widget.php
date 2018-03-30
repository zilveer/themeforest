<?php
add_action('widgets_init', 'socialicons_load_widgets');

function socialicons_load_widgets()
{
	register_widget('Socialicons_Widget');
}

class Socialicons_Widget extends WP_Widget {
	
	function Socialicons_Widget()
	{
		$widget_ops = array('classname' => 'socialicons', 'description' => '');

		$control_ops = array('id_base' => 'socialicons-widget');

		parent::__construct('socialicons-widget', 'Progression: Social Icons', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
		<div class="social-icons">
				<?php if(of_get_option('rss_link_widget')): ?>
				<a class="rss" href="<?php echo of_get_option('rss_link_widget'); ?>" target="_blank">r</a>
				<?php endif; ?>
				<?php if(of_get_option('facebook_link_widget')): ?>
				<a class="facebook" href="<?php echo of_get_option('facebook_link_widget'); ?>" target="_blank">F</a>
				<?php endif; ?>
				<?php if(of_get_option('twitter_link_widget')): ?>
				<a class="twitter" href="<?php echo of_get_option('twitter_link_widget'); ?>" target="_blank">t</a>
				<?php endif; ?>
				<?php if(of_get_option('skype_link_widget')): ?>
				<a class="skype" href="<?php echo of_get_option('skype_link_widget'); ?>" target="_blank">s</a>
				<?php endif; ?>
				<?php if(of_get_option('vimeo_link_widget')): ?>
				<a class="vimeo" href="<?php echo of_get_option('vimeo_link_widget'); ?>" target="_blank">v</a>
				<?php endif; ?>
				<?php if(of_get_option('linkedin_link_widget')): ?>
				<a class="linkedin" href="<?php echo of_get_option('linkedin_link_widget'); ?>" target="_blank">l</a>
				<?php endif; ?>
				<?php if(of_get_option('dribbble_link_widget')): ?>
				<a class="dribbble" href="<?php echo of_get_option('dribbble_link_widget'); ?>" target="_blank">d</a>
				<?php endif; ?>
				<?php if(of_get_option('forrst_link_widget')): ?>
				<a class="forrst" href="<?php echo of_get_option('forrst_link_widget'); ?>" target="_blank">f</a>
				<?php endif; ?>
				<?php if(of_get_option('flickr_link_widget')): ?>
				<a class="flickr" href="<?php echo of_get_option('flickr_link_widget'); ?>" target="_blank">n</a>
				<?php endif; ?>
				<?php if(of_get_option('google_link_widget')): ?>
				<a class="google" href="<?php echo of_get_option('google_link_widget'); ?>" target="_blank">g</a>
				<?php endif; ?>
				<?php if(of_get_option('youtube_link_widget')): ?>
				<a class="youtube" href="<?php echo of_get_option('youtube_link_widget'); ?>" target="_blank">y</a>
				<?php endif; ?>
				<div class="clearfix"></div>
		</div><!-- close .social-icons -->

		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Social Icons');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php
	}
}
?>