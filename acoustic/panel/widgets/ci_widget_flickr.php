<?php
if( !class_exists('CI_Flickr') ):
class CI_Flickr extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( 'FlickR Widget', 'ci_theme' ) );
		$control_ops = array(/*'width' => 200*/);
		parent::__construct( 'ci_flickr_widget', __( '-= CI Flickr Widget =-', 'ci_theme' ), $widget_ops, $control_ops );

		// These are needed for compatibility with older versions where the title field was named title
		add_filter( 'widget_display_callback', array( $this, '_rename_old_title_field' ), 10, 2 );
		add_filter( 'widget_form_callback', array( $this, '_rename_old_title_field' ), 10, 2 );
	}

	// This is needed for compatibility with older versions where the title field was named title
	function _rename_old_title_field($instance, $_this) {
		$old_field = 'ci_title';
		$class     = get_class( $this );

		if ( get_class($_this) == $class && ! isset( $instance['title'] ) && isset( $instance[ $old_field ] ) ) {
			$instance['title'] = $instance[ $old_field ];
			unset( $instance[ $old_field ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/*
		 * While we've renamed ci_title to title, we can't remove the ci_get_string_translation()
		 * and ci_register_string_translation() calls, so that we won't break any existing installations
		 * with titles translated.
		 * Titles translated with the old method will continue to work. If a new translation exists via
		 * the 'widget_title' filter, then ci_get_string_translation() will not match anything, so the new
		 * translation will be used, as expected.
		 */
		$title = ci_get_string_translation( 'Flickr - Title', $title, 'Widgets' );

		$ci_id      = $instance['ci_id'];
		$ci_number  = $instance['ci_number'];
		$ci_type    = $instance['ci_type'];
		$ci_sorting = $instance['ci_sorting'];

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$url = add_query_arg( array(
			'count'   => $ci_number,
			'display' => $ci_sorting,
			'source'  => $ci_type,
			$ci_type  => $ci_id,
			'layout'  => 'x',
			'size'    => 's',
		), 'https://www.flickr.com/badge_code_v2.gne' );
		?><div class="f group"><script type="text/javascript" src="<?php echo esc_url( $url ); ?>"></script></div><?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['ci_id']      = sanitize_text_field( $new_instance['ci_id'] );
		$instance['ci_number']  = absint( $new_instance['ci_number'] );
		$instance['ci_type']    = sanitize_key( $new_instance['ci_type'] );
		$instance['ci_sorting'] = sanitize_key( $new_instance['ci_sorting'] );

		$instance['title'] = ci_register_string_translation( 'Flickr - Title', $instance['title'], 'Widgets' );

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'      => '',
			'ci_id'      => '',
			'ci_number'  => '',
			'ci_type'    => '',
			'ci_sorting' => '',
			'ci_size'    => ''
		) );

		$title      = $instance['title'];
		$ci_id      = $instance['ci_id'];
		$ci_number  = $instance['ci_number'];
		$ci_type    = $instance['ci_type'];
		$ci_sorting = $instance['ci_sorting'];
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'ci_theme' ); ?></label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
		</p>
		<p><?php echo sprintf( __( 'You need to provide your Flickr ID, which usually is <strong>different</strong> from your username. It usually consists of mostly numeric digits. You can find you Flickr ID easily by using <a href="%s" target="_blank">this tool</a>.', 'ci_theme' ), 'http://idgettr.com/' ); ?></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ci_id' ) ); ?>"><span style="color:#0063DC; font-weight:bold;">Flick<i style="font-style:normal;color:#FF0084">r</i></span> ID:</label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'ci_id' ) ); ?>" value="<?php echo esc_attr( $ci_id ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ci_id' ) ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ci_type' ) ); ?>"><?php _e( 'Account Type:', 'ci_theme' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'ci_type' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ci_type' ) ); ?>">
				<option value="user" <?php selected( $ci_type, 'user' ); ?>><?php _e( 'User', 'ci_theme' ); ?></option>
				<option value="group" <?php selected( $ci_type, 'group' ); ?>><?php _e( 'Group', 'ci_theme' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ci_number' ) ); ?>"><?php _e( 'Number of photos:', 'ci_theme' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'ci_number' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ci_number' ) ); ?>">
				<?php for ( $i = 1; $i <= 9; $i += 1 ): ?>
					<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $ci_number, $i ); ?>><?php echo esc_html( $i ); ?></option>
				<?php endfor; ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ci_sorting' ) ); ?>"><?php _e( 'Sorting:', 'ci_theme' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'ci_sorting' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ci_sorting' ) ); ?>">
				<option value="latest" <?php selected( $ci_sorting, 'latest' ); ?>><?php _e( 'Latest', 'ci_theme' ); ?></option>
				<option value="random" <?php selected( $ci_sorting, 'random' ); ?>><?php _e( 'Random', 'ci_theme' ); ?></option>
			</select>
		</p>
		<?php
	}
}


register_widget( 'CI_Flickr' );

endif; //class_exists
