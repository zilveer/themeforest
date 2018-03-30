<?php

/*add_action( 'widgets_init', 'lp_load_widgets' );

function lp_load_widgets() {

	register_widget( 'lp_conversion_area_widget' );

}

class lp_conversion_area_widget extends WP_Widget
{

	function lp_conversion_area_widget() {

		$widget_ops = array( 'classname' => 'class_lp_conversion_area_widget', 'description' => __( 'Use this widget on your landing page sidebar. This sidebar replaces the normal sidebar while using your default theme as a template, or other inactive themes as landing page templates.', 'lp_sidebar_widget' ) );

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'id_lp_conversion_area_widget' );

		parent::__construct( 'id_lp_conversion_area_widget', __( 'Landing Pages: Conversion Area Widget', 'lp_sidebar_widget' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $wp_query;
		$this_id = $wp_query->post->ID;
		$this_type = $wp_query->post->post_type;

		if ( $this_type=='landing-page' ) {
			extract( $args );

			$position = $_SESSION['lp_conversion_area_position'];

			if ( $position=='widget' ) {
				$title = apply_filters( 'widget_title', $instance['title'] );

				$conversion_area = do_shortcode( get_post_meta( $this_id, 'lp-conversion-area', true ) );
				$standardize_form = get_option( 'main-landing-page-auto-format-forms' , 1 ); // conditional to check for options
				if ( $standardize_form ) {
					$wrapper_class = lp_discover_important_wrappers( $conversion_area );
					$conversion_area = lp_rebuild_attributes( $conversion_area );
				}
				//echo $conversion_area;exit;
				$conversion_area = "<div id='lp_container' class='$wrapper_class'>".$conversion_area."</div>";

				echo $before_widget;

				if ( $title ) {
					echo $before_title . $title . $after_title;
				}

				echo $conversion_area;

				echo $after_widget;
			}
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => __( 'Conversion Area Title', 'example' ) );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'hybrid' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}*/
