<?php 
add_action('widgets_init', 'unik_flickr_func');

function unik_flickr_func(){
	register_widget('unik_flickr');
}

class unik_flickr extends WP_Widget {
	
	function unik_flickr()
	{
		$widget_ops = array('classname' => 'flickr', 'description' => 'Display latest photos your flickr account.');
		$control_ops = array('id_base' => 'flickr-widget');
		parent::__construct('flickr-widget', 'Flickr (Unik)', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$screen_name = $instance['screen_name'];
		$number = $instance['number'];
		$width = $instance['width'];
		$height = $instance['height'];
		
		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		if($screen_name && $number) {
			$api_key = 'd348e6e1216a46f2a4c9e28f93d75a48';
			
			@$person = wp_remote_get('http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key='.$api_key.'&username='.urlencode($screen_name).'&format=json');

			@$person = trim($person['body'], 'jsonFlickrApi()');
			@$person = json_decode($person);
			
			if($person->user->id) {
				$photos_url = wp_remote_get('http://api.flickr.com/services/rest/?method=flickr.urls.getUserPhotos&api_key='.$api_key.'&user_id='.$person->user->id.'&format=json');
				$photos_url = trim($photos_url['body'], 'jsonFlickrApi()');
				$photos_url = json_decode($photos_url);
				
				$photos = wp_remote_get('http://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key='.$api_key.'&user_id='.$person->user->id.'&per_page='.$number.'&format=json');
				$photos = trim($photos['body'], 'jsonFlickrApi()');
				$photos = json_decode($photos);
				?>
                <div class="flickr">
				<ul class='list-unstyled flickr clearfix'>
					<?php foreach($photos->photos->photo as $photo): $photo = (array) $photo; ?>
					<?php	$url = "http://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['secret'] . '_s' . ".jpg";
					 ?>
					<li>
						<a href='<?php echo $photos_url->user->url; ?><?php echo $photo['id']; ?>' target='_blank'>
							<span class="hover-border-wrap"><img src='<?php  echo $url; ?>' alt='<?php echo $photo['title']; ?>' />
							<span class="hover-border"></span></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
                </div>
				<?php
			} else {
				echo '<p>Invalid flickr username.</p>';
			}
		}
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['screen_name'] = $new_instance['screen_name'];
		$instance['number'] = $new_instance['number'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Photos from Flickr', 'screen_name' => '', 'number' => 9, 'width' => 150, 'height' => 150,);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('screen_name'); ?>">Screen name:</label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" value="<?php echo $instance['screen_name']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Number of images to show:</label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
					
		
	<?php
	}
}
?>