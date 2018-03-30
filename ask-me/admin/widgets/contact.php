<?php
/* Contact */
add_action( 'widgets_init', 'widget_contact_widget' );
function widget_contact_widget() {
	register_widget( 'Widget_Contact' );
}
class Widget_Contact extends WP_Widget {

	function Widget_Contact() {
		$widget_ops = array( 'classname' => 'contact-widget'  );
		$control_ops = array( 'id_base' => 'contact-widget' );
		parent::__construct( 'contact-widget','Ask me - contact', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title  = apply_filters('widget_title', $instance['title'] );
		$text_1	= esc_attr($instance['text_1']);
		$text_2	= esc_attr($instance['text_2']);
		$text_3	= esc_attr($instance['text_3']);
		$text_4	= esc_attr($instance['text_4']);

		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
	
			<div class="widget_contact">
				<p><?php echo $text_1?></p>
				<ul>
					<li><span><?php _e("Address :","vbegy");?></span><?php echo $text_2?></li>
					<li><span><?php _e("Support :","vbegy");?></span><?php echo $text_3?></li>
					<li><?php echo $text_4?></li>
				</ul>
			</div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance			= $old_instance;
		$instance['title']	= strip_tags( $new_instance['title'] );
		$instance['text_1'] = $new_instance['text_1'];
		$instance['text_2'] = $new_instance['text_2'];
		$instance['text_3']	= $new_instance['text_3'];
		$instance['text_4'] = $new_instance['text_4'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Where We Are ?');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):"");?>" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_1' ); ?>">Content : </label>
			<textarea id="<?php echo $this->get_field_id( 'text_1' ); ?>" name="<?php echo $this->get_field_name( 'text_1' ); ?>" class="widefat"><?php echo (isset($instance['text_1'])?esc_attr($instance['text_1']):"");?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_2' ); ?>">Address : </label>
			<input id="<?php echo $this->get_field_id( 'text_2' ); ?>" name="<?php echo $this->get_field_name( 'text_2' ); ?>" value="<?php echo (isset($instance['text_2'])?esc_attr($instance['text_2']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_3' ); ?>">Support line 1 : </label>
			<input id="<?php echo $this->get_field_id( 'text_3' ); ?>" name="<?php echo $this->get_field_name( 'text_3' ); ?>" value="<?php echo (isset($instance['text_3'])?esc_attr($instance['text_3']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_4' ); ?>">Support line 2 : </label>
			<input id="<?php echo $this->get_field_id( 'text_4' ); ?>" name="<?php echo $this->get_field_name( 'text_4' ); ?>" value="<?php echo (isset($instance['text_4'])?esc_attr($instance['text_4']):"");?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>