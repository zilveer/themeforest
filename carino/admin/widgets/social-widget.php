<?php

/**
  * Social Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_social_init' );

function van_social_init() {
	register_widget( 'van_social_widget' );
}

class van_social_widget extends WP_Widget {

	function van_social_widget() {
		$options = array( 'classname' => 'social-widget','description' => 'Social widget' );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'social-widget' );
		$this->WP_Widget( 'social-widget','( ' .THEME_NAME .' ) - Social widget', $options, $control );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title   = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
	 	if( $title ){ echo $before_title . $title . $after_title;}
		
		?>
		<div class="social-icons widget-social">
			<?php van_social_networks(); ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']         = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Social networks' , 'van'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","") ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
		<p><small style="color:red;">You need to insert your social links in</small> <strong>Appearance > <?php echo THEME_NAME; ?> Settings > "social networks" tab</strong></p>

	<?php
	}
}