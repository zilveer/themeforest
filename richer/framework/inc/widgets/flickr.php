<?php

class widget_flickr extends WP_Widget { 
	
	// Widget Settings
	function widget_flickr() {
		$widget_ops = array('description' => __('Display your latest Flickr Photos', 'richer') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr' );
		$this->__construct( 'flickr', __('richer-Flickr', 'richer'), $widget_ops, $control_ops );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance) {		
	extract( $args );
	$title = apply_filters('widget_title', $instance['title']);
	$username = apply_filters('username', $instance['username']);
	$pics = apply_filters('pics', $instance['pics']);
	$pic_size = apply_filters('pic_size', $instance['pic_size']);
	static $suf=0;
	$suf++;	
	switch ($pic_size) {
		case '1':
			$image_size = 'image_s';
			break;
		case '2':
			$image_size = 'image_t';
			break;
		case '3':
			$image_size = 'image_q';
			break;
		case '4':
			$image_size = 'image_m';
			break;
		case '5':
			$image_size = 'image';
			break;
		default:
			$image_size = 'image_s';
			break;
	}
	echo $before_widget; 
	if ( $title !='' )	echo $before_title . $title . $after_title; ?>
	<div id="flickr<?php echo $suf; ?>" class="flickr-list"></div>
	<script type="text/javascript">
	    jQuery(document).ready(function() {
			jQuery('#flickr<?php echo $suf; ?>').jflickrfeed({
				limit: <?php echo $pics ?>,
				qstrings: {
			  		id: '<?php echo $username ?>'
				},
			itemTemplate: '<div class="flickr-item span4"><a class="thumbnail" rel="prettyPhoto[flickr<?php echo $suf; ?>]" href="{{image_b}}" title="{{title}}"><img class="flickr-img" src="{{<?php echo $image_size; ?>}}" alt="" /><div class="overlay"></div></a></div>'
			}, function(data) {
			jQuery(".flickr-item a").hover(function(){
				jQuery(this).find('.overlay').stop().animate({opacity : '1'}, 300);
			}, function(){
				jQuery(this).find('.overlay').stop().animate({opacity : '0'}, 300);
			});
			jQuery('.flickr-item a').prettyPhoto({
				animation_speed:'normal',
				slideshow:5000,
				social_tools:false,
				autoplay_slideshow: false,
				overlay_gallery: false
			});
			jQuery(".flickr_li:nth-child(5n)").addClass("no-margin");
		  });
		});
	</script>

	<?php wp_reset_postdata();

	echo $after_widget; 
	}
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['pics'] = strip_tags( $new_instance['pics'] );
		$instance['pic_size'] = strip_tags( $new_instance['pic_size'] );
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array( 'title' => 'Flickr Widget', 'pics' => '6', 'username' => '52914122@N05' ); // Default Values
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">Widget Title:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>">Flickr ID:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>" value="<?php echo esc_attr($instance['username']); ?>" /><br /><?php _e('You can get flickr ID at','richer'); ?> http://idgettr.com/
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pics' )); ?>">Number of Photos:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pics' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pics' )); ?>" value="<?php echo esc_attr($instance['pics']); ?>" />
		</p>

		<p>
			<?php
			$selected1 = '';
			$selected2 = '';
			$selected3 = '';
			$selected4 = '';
			$selected5 = '';
			if(isset($instance['pic_size'])){
				switch ($instance['pic_size']) {
					case '1':
						$selected1 = 'selected="selected"';
						break;
					case '2':
						$selected2 = 'selected="selected"';
						break;
					case '3':
						$selected3 = 'selected="selected"';
						break;
					case '4':
						$selected4 = 'selected="selected"';
						break;
					case '5':
						$selected5 = 'selected="selected"';
						break;
					default:
						$selected1 = '';
						$selected2 = '';
						$selected3 = '';
						$selected4 = '';
						$selected5 = '';
						break;
				}
			} else {
				$selected1 = '';
				$selected2 = '';
				$selected3 = '';
				$selected4 = '';
				$selected5 = '';
			}
				?>
			<label for="<?php echo esc_attr($this->get_field_id( 'pic_size' )); ?>">Select thumbnail size:</label>
			<select id="<?php echo esc_attr($this->get_field_id( 'pic_size' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'pic_size' )); ?>">
			  <option value="1" <?php echo $selected1; ?>>Square (75x75)</option>
			  <option value="2" <?php echo $selected2; ?>>Thumbnail (100x75)</option>
			  <option value="3" <?php echo $selected3; ?>>Large Square (150x150)</option>
			  <option value="4" <?php echo $selected4; ?>>Small (240x180)</option>
			  <option value="5" <?php echo $selected5; ?>>Medium (500x375)</option>
			</select>
		</p>
    <?php }
}

// Add Widget
function widget_flickr_init() {
	register_widget('widget_flickr');
	wp_register_script('FlickrFeed', get_template_directory_uri() . '/framework/js/jflickrfeed.js', 'jquery', '1.0', TRUE);
	wp_enqueue_script('FlickrFeed');
}
add_action('widgets_init', 'widget_flickr_init');

?>