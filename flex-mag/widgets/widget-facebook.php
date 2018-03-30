<?php
/**
 * Plugin Name: Facebook Widget
 */

add_action( 'widgets_init', 'mvp_facebook_load_widgets' );

function mvp_facebook_load_widgets() {
	register_widget( 'mvp_facebook_widget' );
}

class mvp_facebook_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_facebook_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_facebook_widget', 'description' => __('A widget that displays a Facebook Like Box.', 'mvp-text') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_facebook_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_facebook_widget', __('Flex Mag: Facebook Widget', 'mvp-text'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];
		$faces = $instance['faces'];
		$stream = $instance['stream'];
		$header = $instance['header'];
		$cover = $instance['cover'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<div class="fb-page" data-href="<?php echo esc_url( $page_url ); ?>" data-small-header="<?php if($header) { echo 'true'; } else { echo 'false'; } ?>" data-adapt-container-width="true" data-hide-cover="<?php if($faces) { echo 'false'; } else { echo 'true'; } ?>" data-show-facepile="<?php if($faces) { echo 'true'; } else { echo 'false'; } ?>" data-show-posts="<?php if($stream) { echo 'true'; } else { echo 'false'; } ?>"><div class="fb-xfbml-parse-ignore"></div></div>
			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = $new_instance['page_url'];
		$instance['faces'] = $new_instance['faces'];
		$instance['stream'] = $new_instance['stream'];
		$instance['header'] = $new_instance['header'];
		$instance['cover'] = $new_instance['cover'];

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Facebook', 'page_url' => 'http://www.facebook.com/envato', 'faces' => 'on', 'cover' => 'on', 'stream' => 'off', 'header' => 'off' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Page URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Facebook Page URL:</label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" style="width:90%;" />
			<small>Example: http://www.facebook.com/envato</small>
		</p>

		<!-- Faces -->
		<p>
			<label for="<?php echo $this->get_field_id( 'faces' ); ?>">Show Faces:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'faces' ); ?>" name="<?php echo $this->get_field_name( 'faces' ); ?>" <?php checked( (bool) $instance['faces'], true ); ?> />
		</p>

		<!-- Stream -->
		<p>
			<label for="<?php echo $this->get_field_id( 'stream' ); ?>">Show Posts:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'stream' ); ?>" name="<?php echo $this->get_field_name( 'stream' ); ?>" <?php checked( (bool) $instance['stream'], true ); ?> />
		</p>

		<!-- Header -->
		<p>
			<label for="<?php echo $this->get_field_id( 'header' ); ?>">Show Header:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" <?php checked( (bool) $instance['header'], true ); ?> />
		</p>

		<!-- Cover -->
		<p>
			<label for="<?php echo $this->get_field_id( 'cover' ); ?>">Show Cover:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'cover' ); ?>" name="<?php echo $this->get_field_name( 'cover' ); ?>" <?php checked( (bool) $instance['cover'], true ); ?> />
		</p>


	<?php
	}
}

?>