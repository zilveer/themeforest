<?php
add_action('widgets_init', 'flickr_load_widgets');

function flickr_load_widgets()
{
	register_widget('Flickr_Widget');
}

class Flickr_Widget extends WP_Widget {
	
	function Flickr_Widget()
	{
		$widget_ops = array('classname' => 'flickr', 'description' => 'The most recent photos from flickr.');

		$control_ops = array('id_base' => 'flickr-widget');

		parent::__construct('flickr-widget', 'Progression: Flickr Widget', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$screen_name = $instance['screen_name'];
		$number = $instance['number'];
		
		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		}
		
		if($screen_name) { ?>
			<script type="text/javascript">
			//Flickr Widget in Sidebar			
			jQuery(document).ready(function($) {	 			   
				// Our very special jQuery JSON fucntion call to Flickr, gets details of the most recent images			   
				$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=<?php echo esc_attr( $screen_name); ?>&lang=en-us&format=json&jsoncallback=?", displayImages);  //YOUR IDGETTR GOES HERE
				function displayImages(data){																															   
					// Randomly choose where to start. A random number between 0 and the number of photos we grabbed (20) minus  7 (we are displaying 7 photos).
					var iStart = Math.floor(Math.random()*(0));	
					
					// Reset our counter to 0
					var iCount = 1;								
					
					// Start putting together the HTML string
					var htmlString = "<ul>";					
					
					// Now start cycling through our array of Flickr photo details
					$.each(data.items, function(i,item){
												
						// Let's only display 6 photos (a 2x3 grid), starting from a the first point in the feed				
						if (iCount > iStart && iCount < (iStart + <?php echo esc_attr( $number + 1); ?>)) {
							
							// I only want the ickle square thumbnails
							var sourceSquare = (item.media.m).replace("_m.jpg", "_s.jpg");		
							
							// Here's where we piece together the HTML
							htmlString += '<li><a href="' + item.link + '" target="_blank">';
							htmlString += '<img src="' + sourceSquare + '" alt="' + item.title + '" title="' + item.title + '"/>';
							htmlString += '</a></li>';
						}
						// Increase our counter by 1
						iCount++;
					});		
					
				// Pop our HTML in the #images DIV	
				$('.<?php echo esc_attr(  $args['widget_id'] ); ?>').html(htmlString + "</ul>");
				
				// Close down the JSON function call
				}
				
			// The end of our jQuery function	
			});
			</script>
			<div class="flickr-widget <?php echo esc_attr(  $args['widget_id'] ); ?>"></div>
		<?php }
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['screen_name'] = $new_instance['screen_name'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Photos from Flickr', 'screen_name' => '', 'number' => 6);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'progression' ); ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('screen_name'); ?>"><?php _e( 'Flickr ID: (Find from', 'progression' ); ?> <a href='http://idgettr.com'>http://idgettr.com</a>)</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" value="<?php echo $instance['screen_name']; ?>" />
		</p>
		
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of flickr image to show', 'progression' ); ?>:</label>
				<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
			</p>
		
	<?php
	}
}
?>