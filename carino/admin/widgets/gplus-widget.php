<?php

/**
  * Google Plus Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_gplus_widget_init' );

function van_gplus_widget_init() {

	register_widget( 'van_gplus_widget' );

}

class van_gplus_widget extends WP_Widget {

	function van_gplus_widget() {

		$options = array( 'classname' => 'gplus-widget','description' => 'Google+ page Widget' );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'gplus-widget' );
		$this->WP_Widget( 'gplus-widget','( '.THEME_NAME .' ) - Google+ Page', $options, $control );
	
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];
		
		echo "<div class=\"skip-content\">";
		echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			?>
				<div class="google-box" style="width:100%; margin:0 auto;">
					<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
					<div class="g-page" data-width="292" data-href="<?php echo esc_url( $page_url ); ?>" data-layout="landscape" data-rel="publisher"></div>
				</div>
			<?php 
			echo $after_widget;
		echo "</div><!--.skip-content-->";
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Follow us on Google+' , 'van') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","van") ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Page url : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( isset( $instance['page_url'] ) ){ echo esc_attr( $instance['page_url'] ); } ?>" />
		</p>


	<?php
	}
}