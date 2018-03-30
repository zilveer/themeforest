<?php

// Latest Tweets
class TB_Twitter_Activity extends WP_Widget {
	
	function TB_Twitter_Activity() {
		$widget_ops = array('classname' => 'tb_twitter_activity', 'description' => __( 'Twitter Activity', 'the-cause') );		
		$this->WP_Widget('TB_Twitter_Activity', __('TB Twitter Activity', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Twitter Activity', 'the-cause') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		$before_title = str_replace('h4', 'h4 class="twitter"', $before_title);
		
		if ( $title ) echo $before_title . $title . $after_title;

		?>

		<div id="twitter_update_list"></div>
        
        <?php $tweetsNumber = (int)(empty($instance['tweetsNumber']) ? '3' : $instance['tweetsNumber']); ?>
        <?php $twitterID = get_option('tb_twitter_id'); ?>
        
        <script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $twitterID; ?>.json?callback=twitterCallback2&count=<?php echo $tweetsNumber; ?>"></script>
        
    	<?php
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		$instance['tweetsNumber'] = (int) strip_tags($new_instance['tweetsNumber']);
		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'tweetsNumber' => 3, 'title' => 'Twitter Activity' ) );
		$tweetsNumber = (int) strip_tags($instance['tweetsNumber']);
		$title = strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id('tweetsNumber'); ?>"><?php _e('Number of Tweets:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('tweetsNumber'); ?>" name="<?php echo $this->get_field_name('tweetsNumber'); ?>" type="text" value="<?php echo absint($tweetsNumber); ?>" />
        </p>
            
	<?php
	}
}

function tb_register_twitter_widget() {
	
	register_widget('TB_Twitter_Activity');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_twitter_widget', 1);

?>