<?php

// Latest Tweets
class TB_Twitter_Activity extends WP_Widget {
	
	function TB_Twitter_Activity() {
		$widget_ops = array('classname' => 'tb_twitter_activity', 'description' => __( 'Twitter Activity', 'grace') );		
		$this->WP_Widget('TB_Twitter_Activity', __('ThemeBlossom: Twitter Activity', 'grace'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Twitter Activity', 'grace') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		?>
        
        <?php $tweetsNumber = (int)(empty($instance['tweetsNumber']) ? '3' : $instance['tweetsNumber']); ?>
        <?php $username = (empty($instance['username'])) ? 'themeblossom' : $instance['username']; ?>
        
		
        <a class="twitter-timeline" href="https://twitter.com/<?php echo $username; ?>" data-screen-name="<?php echo $username; ?>" data-widget-id="346699208553820160" data-chrome="transparent noborder noheader nofooter noscrollbar" data-tweet-limit="<?php echo $tweetsNumber; ?>" data-link-color="#3c95a5"><?php echo __('Tweets by', 'grace'); ?> @<?php echo $username; ?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        
    	<?php
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);

		$instance['tweetsNumber'] = (int) strip_tags($new_instance['tweetsNumber']);
		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'tweetsNumber' => 3, 'title' => __('Twitter Activity', 'grace'), 'username' => 'themeblossom' ) );
		$tweetsNumber = (int) strip_tags($instance['tweetsNumber']);
		$title = strip_tags($instance['title']);
		$username = strip_tags($instance['username']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id('tweetsNumber'); ?>"><?php _e('Number of Tweets:', 'grace'); ?></label>
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