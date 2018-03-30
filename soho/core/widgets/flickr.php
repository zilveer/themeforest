<?php

class flickr extends WP_Widget {

	function flickr() {
		parent::__construct( false, 'Flickr (current theme)' );
	}

	function widget( $args, $instance ) {
		extract($args);

		echo $before_widget; 
		echo $before_title;
        echo $instance['widget_title'];
		echo $after_title;

        echo '<div class="flickr_widget_wrapper"><script src="http://www.flickr.com/badge_code_v2.gne?count='.$instance['flickr_widget_number'].'&display=latest&size=s&layout=x&source=user&user='.$instance['flickr_widget_id'].'"></script></div>';

		echo $after_widget; 
	}

	function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr( $new_instance['widget_title'] );
        $instance['flickr_widget_number'] = absint( $new_instance['flickr_widget_number'] );
        $instance['flickr_widget_id'] = esc_attr( $new_instance['flickr_widget_id'] );

        return $instance;
	}

	function form($instance) {
        $defaultValues = array(
            'widget_title' => 'Flickr Photostream',
            'flickr_widget_number' => '8',
            'flickr_widget_id' => '92335820@N08'
        );
        $instance = wp_parse_args((array) $instance, $defaultValues);


	?>
		<table class="fullwidth">
			<tr>
				<td>Title:</td>
				<td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'widget_title' ); ?>' value='<?php echo $instance['widget_title']; ?>'/></td>
			</tr>
			<tr>
				<td>Flickr ID:</td>
				<td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'flickr_widget_id' ); ?>' value='<?php echo $instance['flickr_widget_id']; ?>'/></td>
			</tr>
			<tr>
				<td>Number:</td>
				<td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'flickr_widget_number' ); ?>' value='<?php echo $instance['flickr_widget_number']; ?>'/></td>
			</tr>
		</table>
	<?php
	}
}

function flickr_register_widgets() { register_widget( 'flickr' ); } 
add_action( 'widgets_init', 'flickr_register_widgets' );

?>