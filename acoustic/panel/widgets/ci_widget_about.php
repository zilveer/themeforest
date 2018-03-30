<?php 
if( !class_exists('CI_About') ):

class CI_About extends WP_Widget {

	function __construct(){
		$widget_ops  = array( 'description' => __( 'About me widget', 'ci_theme' ) );
		$control_ops = array(/*'width' => 300, 'height' => 400*/ );
		parent::__construct( 'ci_about_widget', $name = __( '-= CI About Me =-', 'ci_theme' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$ci_title = apply_filters( 'widget_title', empty( $instance['ci_title'] ) ? '' : $instance['ci_title'], $instance, $this->id_base );
		$ci_title = ci_get_string_translation( 'About Me - Title', $ci_title, 'Widgets' );

		$ci_image = $instance['ci_image'];
		$ci_align = $instance['ci_align'];
		$ci_about = ci_get_string_translation( 'About Me - Text', $instance['ci_about'], 'Widgets' );

		echo $before_widget;

		if ( $ci_title ) {
			echo $before_title . $ci_title . $after_title;
		}

		echo '<div class="widget_about group">';

			if ( $ci_image ) {
				echo '<img src="' . esc_url( $ci_image ) . '" class="' . esc_attr( $ci_align ) . '" alt="' . esc_attr( $ci_title ) . '" />';
			}
	
			echo $ci_about;

		echo '</div>';

		echo $after_widget;
	} // widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['ci_title'] = sanitize_text_field( $new_instance['ci_title'] );
		$instance['ci_image'] = esc_url_raw( $new_instance['ci_image'] );
		$instance['ci_align'] = sanitize_key( $new_instance['ci_align'] );
		$instance['ci_about'] = wp_kses( $new_instance['ci_about'], wp_kses_allowed_html( 'post' ) );

		ci_register_string_translation( 'About Me - Title', $instance['ci_title'], 'Widgets' );
		ci_register_string_translation( 'About Me - Text', $instance['ci_about'], 'Widgets' );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'ci_title' => '',
			'ci_image' => '',
			'ci_about' => '',
			'ci_align' => 'alignleft'
		) );
		$ci_title = $instance['ci_title'];
		$ci_image = $instance['ci_image'];
		$ci_align = $instance['ci_align'];
		$ci_about = $instance['ci_about'];
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_title' ) ) . '">' . __( 'Title:', 'ci_theme' ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_title' ) ) . '" type="text" value="' . esc_attr( $ci_title ) . '" class="widefat" /></p>';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_image' ) ) . '">' . __( 'Image:', 'ci_theme' ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_image' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_image' ) ) . '" type="text" value="' . esc_url( $ci_image ) . '" class="widefat" /></p>';

		?>
		<p>
			<label for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'ci_align' ) ) ); ?>"><?php __( 'Image alignment:', 'ci_theme' ); ?></label>
			<select name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'ci_align' ) ) ); ?>" class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'ci_align' ) ) ); ?>">
				<option value="alignnone" <?php selected( $ci_align, 'alignnone' ); ?>><?php _ex( 'None', 'alignment', 'ci_theme' ); ?></option>
				<option value="alignleft" <?php selected( $ci_align, 'alignleft' ); ?>><?php _ex( 'Left', 'alignment', 'ci_theme' ); ?></option>
				<option value="alignright" <?php selected( $ci_align, 'alignright' ); ?>><?php _ex( 'Right', 'alignment', 'ci_theme' ); ?></option>
			</select>
		</p>
		<?php

		echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_about' ) ) . '">' . __( 'About text:', 'ci_theme' ) . '</label><textarea rows="10" id="' . esc_attr( $this->get_field_id( 'ci_about' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_about' ) ) . '" class="widefat" >' . esc_textarea( $ci_about ) . '</textarea></p>';
	} // form

} // class

register_widget( 'CI_About' );

endif; //class_exists
