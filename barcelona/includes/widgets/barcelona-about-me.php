<?php
/*
 * About Me Widget
 */

if ( ! class_exists( 'Barcelona_Widget_About_Me' ) ) {
	class Barcelona_Widget_About_Me extends WP_Widget {

		public function __construct() {

			$widget_ops = array(
				'classname'   => 'barcelona-widget-about-me',
				'description' => esc_html_x( 'A short description about you.', 'About Me widget description', 'barcelona' )
			);

			parent::__construct( 'barcelona-about-me', sprintf( esc_html_x( '%s About Me', 'About Me widget name', 'barcelona' ), BARCELONA_THEME_NAME ), $widget_ops );

		}

		public function widget( $args, $instance ) {

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
			}

			$barcelona_image = is_numeric( $instance['image'] ) ? barcelona_get_thumbnail_url( 'barcelona-sq', $instance['image'], true, true ) : '';

			?>
			<div class="about-me">

				<?php

				if( ! empty( $barcelona_image ) ) {
					echo '<p class="about-image"><img src="'. esc_url( $barcelona_image[0] ) .'" alt="'. esc_attr( $instance['name'] ) .'" /></p>';
				}

				if( ! empty( $instance['name'] ) ) {
					echo '<h2 class="about-name">'. esc_html( $instance['name'] ) .'</h2>';
				}

				if( ! empty( $instance['job_title'] ) ) {
					echo '<h4 class="about-job-title">'. esc_html( $instance['job_title'] ) .'</h4>';
				}

				?>
				<p class="description">
					<?php echo wp_kses( nl2br( $instance['description'] ), array( 'br' => array() ) ); ?>
				</p>

			</div>
			<?php

			echo wp_kses_post( $args['after_widget'] );

		}

		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']          = strip_tags( $new_instance['title'] );
			$instance['image']          = intval( $new_instance['image'] );
			$instance['name']           = strip_tags( $new_instance['name'] );
			$instance['job_title']      = strip_tags( $new_instance['job_title'] );
			$instance['description']    = strip_tags( $new_instance['description'] );

			return $instance;

		}

		public function form( $instance ) {

			$barcelona_title        = isset( $instance['title'] ) ? $instance['title'] : '';
			$barcelona_name         = isset( $instance['name'] ) ? $instance['name'] : '';
			$barcelona_job_title    = isset( $instance['job_title'] ) ? $instance['job_title'] : '';
			$barcelona_description  = isset( $instance['description'] ) ? $instance['description'] : '';

			$barcelona_image = '';
			if ( array_key_exists( 'image', $instance ) && is_numeric( $instance['image'] ) ) {
				$barcelona_image = barcelona_get_thumbnail_url( 'barcelona-sq', $instance['image'], true, true );
			}

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_name ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'job_title' ) ); ?>"><?php esc_html_e( 'Job Title:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'job_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'job_title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_job_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Profile Picture:', 'barcelona' ); ?></label>
				<input type="hidden" class="barcelona-media-val" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"<?php if ( array_key_exists( 'image', $instance ) && is_numeric( $instance['image'] ) ) { echo ' value="'. esc_attr( $instance['image'] ) .'"'; } ?> />
				<span class="barcelona-media-placeholder">
					<?php echo empty( $barcelona_image ) ? '' : '<img src="'. esc_url( $barcelona_image[0] ) .'" />'; ?>
				</span>
				<button type="button" class="barcelona-media button<?php echo empty( $barcelona_image ) ? '' : ' barcelona-hide'; ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" data-return="id"><?php esc_html_e( 'Select Image', 'barcelona' ); ?></button>
				<button type="button" class="barcelona-media-remove button<?php echo empty( $barcelona_image ) ? ' barcelona-hide' : ''; ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Remove Image', 'barcelona' ); ?></button>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'About Text:', 'barcelona' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" rows="16" cols="20"><?php echo esc_textarea( $barcelona_description ); ?></textarea>
			</p>
			<?php

		}

	}
}