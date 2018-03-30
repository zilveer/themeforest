<?php class FlickrWidget extends WP_Widget
{
	var $excertp_length;

	function FlickrWidget(){
		$widget_opts = array('classname' => 'widget_flickr', 'description' => __('A widget that displays your Flickr photos.', TEMPLATENAME));
		parent::WP_Widget(false, __('Flickr +', TEMPLATENAME), $widget_opts);
	}

  /* Displays the Widget in the front-end */
	function widget($args, $instance){
		extract($args);
		$title = strip_tags($instance['title']);
		$photos_count = $instance['photos_count'];
		$user = $instance['user'];
		$display = $instance['display'];
		$source = $instance['source'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;

?>
<div class="flickr">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $photos_count; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=h&amp;source=<?php echo $source; ?>&amp;<?php echo $source; ?>=<?php echo $user; ?>"></script>
	<div class="clear"></div>
</div>
		<?php
		echo $after_widget;
	}

  /*Saves the settings. */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['photos_count'] = (int) $new_instance['photos_count'];
		$instance['user'] = $new_instance['user'];
		$instance['display'] = $new_instance['display'];
		$instance['source'] = $new_instance['source'];
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
	function form($instance){
		$instance = wp_parse_args((array) $instance, array(
			'title' => __('Flickr Photos', TEMPLATENAME),
			'photos_count' => 9,
			'user' => '',
			'display' => 'random',
			'source' => 'user',
		));

		$title = strip_tags($instance['title']);
		$photos_count = $instance['photos_count'];
		$user = $instance['user'];
		$display = $instance['display'];
		$source = $instance['source'];
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('user'); ?>"><?php echo __('Flickr ID:', TEMPLATENAME).' (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):'; ?></label><input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $user; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('photos_count'); ?>"><?php _e('Number of photos to show:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('photos_count'); ?>" name="<?php echo $this->get_field_name('photos_count'); ?>" type="text" value="<?php echo $photos_count; ?>" /></p>
		<p>
		<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display type:', TEMPLATENAME); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
			<option value="random"<?php selected('random', $display); ?>><?php _e('Random', TEMPLATENAME); ?></option>
			<option value="latest"<?php selected('latest', $display); ?>><?php _e('Latest', TEMPLATENAME); ?></option>
		</select></p>
		<p>
		<label for="<?php echo $this->get_field_id('source'); ?>"><?php _e('Where the photos are pulled from:', TEMPLATENAME); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>">
			<option value="user"<?php selected('user', $source); ?>><?php _e('user', TEMPLATENAME); ?></option>
			<option value="group"<?php selected('group', $source); ?>><?php _e('group', TEMPLATENAME); ?></option>
		</select></p>
		<?php
	}

}// end FlickrWidget class

function FlickrWidgetInit() {
  register_widget('FlickrWidget');
}

add_action('widgets_init', 'FlickrWidgetInit');

?>