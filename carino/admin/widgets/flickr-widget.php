<?php

/**
  * Flickr Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_flickr_widget_init' );
function van_flickr_widget_init() {
	register_widget( 'van_flickr_widget' );
}
class van_flickr_widget extends WP_Widget {

	function van_flickr_widget() {
		$options = array( 'classname' => 'flickr-widget' );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'flickr-widget' );
		$this->WP_Widget( 'flickr-widget','( '.THEME_NAME .' ) - Flickr', $options, $control );
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title     = apply_filters('widget_title', $instance['title'] );
		$number    = $instance['number'];
		$flickr_id = $instance['flickr_id'];
		$orderby   = $instance['orderby'];
		echo "<div class=\"skip-content\">";
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			?>
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;orderby=<?php echo $orderby; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>        
				<div class="clear"></div>
			<?php 
			echo $after_widget;
		echo "</div><!--.skip-content-->";
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['number']    = strip_tags( $new_instance['number'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['orderby']   = strip_tags( $new_instance['orderby'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Flickr' , 'van'), 'number' => '6' , 'orderby' => 'latest' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","van");  ?></label>
			<input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>">Flickr ID: </label>
			<input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php if( isset( $instance['flickr_id'] ) ){ echo esc_attr( $instance['flickr_id'] ); } ?>" />
			<small>(You can get it from <a href="<?php echo esc_url('http://www.idgettr.com'); ?>">idGettr</a>)</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of photos to show: </label>
			<input  type="text" width="35px;" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order By: </label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" >
				<option <?php if( $instance['orderby'] == 'latest' ) {echo "selected=\"selected\"";}else {echo "";} ?> value="latest"  >Most recent</option>
				<option <?php if( $instance['orderby'] == 'random' ) {echo "selected=\"selected\"";}else {echo "";} ?> value="random"  >Random</option>
			</select>
		</p>

	<?php
	}
}