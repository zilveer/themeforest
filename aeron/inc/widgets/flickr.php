<?php
class ABdev_aeron_flickr_stream extends WP_Widget {
	
	function ABdev_aeron_flickr_stream(){
		$widget_ops = array(
			'classname' => 'flickr-stream', 
			'description' => __('Photostream from Flickr.', 'ABdev_aeron'),
		);
		$control_ops = array(
			'id_base' => 'flickr-stream',
		);
		parent::__construct('flickr-stream', __('Flickr stream', 'ABdev_aeron' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$flickr_username = $instance['flickr_username'];
		$number = $instance['number'];
		
		echo $before_widget;

		if($title){
			echo $before_title.$title.$after_title;
		}
		
		if($flickr_username && $number) {
			@$stream = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=aaa33cb7f8c8ce2af498adf57da90a17&username='.urlencode($flickr_username).'&format=json');
			@$stream = trim($stream['body'], 'jsonFlickrApi()');
			@$stream = json_decode($stream);
			
			if(is_object($stream) && isset($stream->user->id)) {
				$photos_url = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.urls.getUserPhotos&api_key=aaa33cb7f8c8ce2af498adf57da90a17&user_id='.$stream->user->id.'&format=json');
				$photos_url = trim($photos_url['body'], 'jsonFlickrApi()');
				$photos_url = json_decode($photos_url);
				
				$photos = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=aaa33cb7f8c8ce2af498adf57da90a17&user_id='.$stream->user->id.'&per_page='.$number.'&format=json');
				$photos = trim($photos['body'], 'jsonFlickrApi()');
				$photos = json_decode($photos);
				?>
				<div class='flickr-stream clearfix'>
					<?php foreach($photos->photos->photo as $photo): $photo = (array) $photo; ?>
							<a class="link-middle-image" href="<?php echo $photos_url->user->url; ?><?php echo $photo['id']; ?>" target='_blank'>
							<img src="<?php $url = "https://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['secret'] . '_s' . ".jpg"; echo $url; ?>" alt="">
							</a>
					<?php endforeach; ?>
				</div>
				<?php
			} else {
				echo '<p>'.__('Invalid flickr username or connection error.', 'ABdev_aeron').'</p>';
			}
		}
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_username'] = strip_tags($new_instance['flickr_username']);
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}

	
	function form($instance){
		$defaults = array('title' => __('Photos from Flickr', 'ABdev_aeron'), 'flickr_username' => '', 'number' => 9);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr_username'); ?>"><?php _e('Flickr username:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('flickr_username'); ?>" name="<?php echo $this->get_field_name('flickr_username'); ?>" value="<?php echo $instance['flickr_username']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('No. of images:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
	<?php
	}
}


function ABdev_aeron_flickr_stream_widget(){
	register_widget('ABdev_aeron_flickr_stream');
}

add_action('widgets_init', 'ABdev_aeron_flickr_stream_widget');