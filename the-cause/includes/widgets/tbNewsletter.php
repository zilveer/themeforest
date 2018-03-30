<?php

class TB_Newsletter extends WP_Widget {
	
	function TB_Newsletter() {
		$widget_ops = array('classname' => 'tb_newsletter', 'description' => __( 'Adds a newsletter sign-up form.', 'the-cause') );
		$this->WP_Widget('TB_Newsletter', __('TB Newsletter', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		global $post;
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Sign Up', 'the-cause') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		?>
		
		<div id="signUpSuccess"></div>
		
		<form id="newsletterForm" action="<?php echo get_permalink($post->ID); ?>" method="post">
			<p><input type="text" value="First Name" onfocus="if (this.value == 'First Name') {this.value = '';}" onblur="if (this.value == '') {this.value = 'First Name';}" id="fname" name="fname" class="left">
			<input type="text" value="Last Name" onfocus="if (this.value == 'Last Name') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Last Name';}" id="lname" name="lname" class="right"></p>
			<p>
			<input type="text" value="Email" onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email';}" id="email" name="email">
    		<span class="sendingError">Valid Email Required!</span>
			</p>
			
			<input type="hidden" name="tbSignUp" value="1">
			
			<p class="center"><input type="submit" class="tinyButton" value="Sign Up"></p>
		</form>
		
		<?php
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title'=>'Sign Up' ) );
		$title =  strip_tags($instance['title']);

	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
	<?php
	}
}

function tb_register_newsletter() {

	register_widget('TB_Newsletter');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_newsletter', 1);

?>