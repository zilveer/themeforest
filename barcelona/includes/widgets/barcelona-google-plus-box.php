<?php
/*
 * Google Plus Box Widget
 */

if ( ! class_exists( 'Barcelona_Widget_Google_Plus_Box' ) ) {
	class Barcelona_Widget_Google_Plus_Box extends WP_Widget {

		public function __construct() {

			$widget_opts = array(
				'classname'   => 'barcelona-widget-google-plus-box',
				'description' => esc_html_x( 'Google Plus Follow Box', 'Google+ Box widget description', 'barcelona' )
			);

			parent::__construct( 'barcelona-gplus-box', sprintf( esc_html_x( '%s Google+ Box', 'Google+ Box widget name', 'barcelona' ), BARCELONA_THEME_NAME ), $widget_opts );

		}

		public function widget( $args, $instance ) {

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
			}

			$barcelona_params = array(
				'href'              => esc_url( $instance['href'] ),
				'layout'            => empty( $instance['layout'] ) ? 'landscape' : esc_attr( $instance['layout'] ),
				'theme'             => empty( $instance['theme'] ) ? 'light' : esc_attr( $instance['theme'] ),
				'showcoverphoto'    => ( isset( $instance['showcoverphoto'] ) && ! $instance['showcoverphoto'] ) ? 'false' : 'true',
				'showtagline'       => ( isset( $instance['showtagline'] ) && ! $instance['showtagline'] ) ? 'false' : 'true',
				'width'             => 336
			);

			$barcelona_atts = array();
			foreach( $barcelona_params as $k => $v ) {
				$barcelona_atts[] = ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"';
			}

			echo '<div class="g-page-wrapper">';
			foreach( array( 'person', 'page', 'community' ) as $k ) {
				echo '<div class="g-'. sanitize_html_class( $k ) .'"'. implode( $barcelona_atts ) .'></div>';
			}
			echo '</div>';

			echo wp_kses_post( $args['after_widget'] );

		}

		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']          = strip_tags( $new_instance['title'] );
			$instance['href']           = esc_url_raw( $new_instance['href'] );
			$instance['layout']         = strip_tags( $new_instance['layout'] );
			$instance['theme']          = strip_tags( $new_instance['theme'] );
			$instance['showcoverphoto'] = isset( $new_instance['showcoverphoto'] ) ? (bool) $new_instance['showcoverphoto'] : false;
			$instance['showtagline']    = isset( $new_instance['showtagline'] ) ? (bool) $new_instance['showtagline'] : false;

			return $instance;

		}

		public function form( $instance ) {

			$barcelona_title            = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$barcelona_href             = ( ! empty( $instance['href'] ) ) ? $instance['href'] : '';
			$barcelona_layout           = ( ! empty( $instance['layout'] ) ) ? sanitize_key( $instance['layout'] ) : 'landscape';
			$barcelona_theme            = ( ! empty( $instance['theme'] ) ) ? sanitize_key( $instance['theme'] ) : 'light';
			$barcelona_showcoverphoto   = isset( $instance['showcoverphoto'] ) ? (bool) $instance['showcoverphoto'] : false;
			$barcelona_showtagline      = isset( $instance['showtagline'] ) ? (bool) $instance['showtagline'] : false;

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>"><?php esc_html_e( 'Google+ Page URL:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'href' ) ); ?>" type="text" value="<?php echo esc_url( $barcelona_href ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout:', 'barcelona' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" class="barcelona-g-layout-selector">
					<option value="landscape"><?php esc_html_e( 'Landscape', 'barcelona' ); ?></option>
					<option value="portrait"<?php echo ( $barcelona_layout == 'portrait' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Portrait', 'barcelona' ); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>"><?php esc_html_e( 'Theme:', 'barcelona' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'theme' ) ); ?>">
					<option value="light"><?php esc_html_e( 'Light', 'barcelona' ); ?></option>
					<option value="dark"<?php echo ( $barcelona_theme == 'dark' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Dark', 'barcelona' ); ?></option>
				</select>
			</p>

			<p class="barcelona-g-cover-photo"<?php echo ( $barcelona_layout == 'landscape' ) ? ' style="display: none;"' : ''; ?>>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_showcoverphoto ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showcoverphoto' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showcoverphoto' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'showcoverphoto' ) ); ?>"><?php esc_html_e( 'Show Cover Photo', 'barcelona' ); ?></label>
			</p>

			<p class="barcelona-g-tagline"<?php echo ( $barcelona_layout == 'landscape' ) ? ' style="display: none;"' : ''; ?>>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_showtagline ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showtagline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showtagline' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'showtagline' ) ); ?>"><?php esc_html_e( 'Show Tagline', 'barcelona' ); ?></label>
			</p>
			<?php

		}

	}
}