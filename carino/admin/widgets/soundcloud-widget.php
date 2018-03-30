<?php
/**
  * SoundCloud Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_soundcloud_widget_init' );

function van_soundcloud_widget_init(){
	register_widget( 'van_soundcloud_widget' );
}

class van_soundcloud_widget extends WP_Widget {
	function van_soundcloud_widget() {
		$options = array( 'classname' => 'soundcloud-widget' );
		$this->WP_Widget( 'soundcloud-widget','( '. THEME_NAME .' ) - Soundcloud Widget', $options );
	}
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$url   = $instance['url'];
		$auto_play = $instance['autoplay'] ? true : false;

		echo "<div class=\"skip-content\">";
		echo $before_widget;
		if( $title ){ echo $before_title . $title . $after_title;}
		?>
		<div class="soundcloud-widget">
			<?php  van_soundcloud_embed( $url, $auto_play ); ?>
		</div>
		<?php
	 	 echo $after_widget;
	 	 echo "</div><!--.skip-content-->";
		
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['url']         = strip_tags( $new_instance['url'] );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('SoundCloud' ,'van') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>">URL :</label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php if( isset( $instance['url'] ) ){ echo esc_attr( $instance['url'] ); } ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">Autoplay :</label>
			<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( isset($instance['autoplay']) && $instance['autoplay'] ){ echo 'checked="checked"';} ?> type="checkbox" />
		</p>
	<?php
	}
}