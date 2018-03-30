<?php

// get flickr images
class TB_Flickr extends WP_Widget {
	
	function TB_Flickr() {
		$widget_ops = array('classname' => 'tb_flickr',	'description' => __( 'Displays images from your Flickr account.', 'the-cause') );
		$this->WP_Widget('TB_Flickr', __('TB Flickr', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Flickr Photo Stream', 'the-cause') : $instance['title'], $instance, $this->id_base);
	  	$number = (int) strip_tags($instance['number']);
	  	
		$display = (int) strip_tags($instance['display']);
		if ($display) {$display = 'random';} else {$display = 'latest';}
		
	  	$id = strip_tags($instance['id']);
	  	$url = strip_tags($instance['url']);
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		?>
        <div class="flickrWidget">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
            <div class="clear"></div>
        
		<?php
		
		if (!empty($url)) { ?>        	            
        	<a href="<?php echo $url; ?>" target="_blank">view more &raquo;</a>        
        <?php
		} else { ?>
	        <a href="http://www.flickr.com/photos/<?php echo $id; ?>/sets" target="_blank">view more &raquo;</a>
        <?php } ?>
		
        </div>
		
		<?php
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['display'] = (int) strip_tags($new_instance['display']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'number' => 9, 'title'=>'Flickr Photo Stream', 'display' => 0, 'id' => '' ) );
		$number = (int) strip_tags($instance['number']);
		$display =  (int) strip_tags($instance['display']);
		$title =  strip_tags($instance['title']);
		$id =  strip_tags($instance['id']);
		$url =  strip_tags($instance['url']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID:', 'the-cause'); ?> (<a href="http://www.idgettr.com" target="_blank">idGettr</a>)</label>
	        <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr($id); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Flickr URL:', 'the-cause'); ?> (leave blank if you want to show photosets of user with above entered id)</label>
	        <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" />
        </p>
            
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>"<?php checked( $display ); ?> value="1" />
            <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e( 'Random order', 'the-cause' ); ?></label></p>
        </p>
	<?php
	}
}

function tb_register_flickr() {

	register_widget('TB_Flickr');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_flickr', 1);

?>