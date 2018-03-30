<?php
/*
 * Instagram Feed Widget
 */

if ( ! class_exists( 'Barcelona_Widget_Instagram_Feed' ) ) {
	class Barcelona_Widget_Instagram_Feed extends WP_Widget {

		function __construct() {

			$widget_opts = array(
				'classname'   => 'barcelona-widget-instagram-feed',
				'description' => esc_html_x( 'Displays the instagram images', 'Instagram Feed widget description', 'barcelona' )
			);

			parent::__construct( 'barcelona-instagram-feed', sprintf( esc_html_x( '%s Instagram Feed', 'Instagram Feed widget name', 'barcelona' ), BARCELONA_THEME_NAME ), $widget_opts );

		}

		function widget( $args, $instance ) {

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
			}

			if ( ! is_numeric( $instance['number'] ) ) {
				$instance['number'] = 5;
			}

			$barcelona_data = $this->fetch_feed( $instance['username'], $instance['number'] );

			if ( is_wp_error( $barcelona_data ) ) {

				echo '<span class="widget-error-text">'. esc_html( $barcelona_data->get_error_message() ) .'</span>';

			} else { ?>

				<ul class="instagram-images clearfix">
				<?php foreach ( $barcelona_data as $k => $v ): ?>
					<li>
						<a href="<?php echo esc_url( 'https://instagram.com/p/'. $v['code'] .'/' ); ?>" target="_blank" rel="nofollow">
							<img src="<?php echo esc_url( preg_replace( '#\/s[0-9]+x[0-9]+\/#', '/s200x200/', $v['thumbnail_src'] ) ); ?>" width="50" height="50" class="trs" alt="" />
						</a>
					</li>
				<?php endforeach; ?>
				</ul>

			<?php }

			echo wp_kses_post( $args['after_widget'] );

		}

		function fetch_feed( $username, $slice = 8 ) {

			$barcelona_remote_url = esc_url( 'http://instagram.com/'. trim( strtolower( $username ) ) );
			$barcelona_transient_key = 'barcelona_instagram_feed_'. sanitize_title_with_dashes( $username );
			$slice = absint( $slice );

			if ( false === ( $barcelona_result_data = get_transient( $barcelona_transient_key ) ) ) {

				$barcelona_remote = wp_remote_get( $barcelona_remote_url );

				if ( is_wp_error( $barcelona_remote ) || 200 != wp_remote_retrieve_response_code( $barcelona_remote ) ) {
					return new WP_Error( 'not-connected', esc_html__( 'Unable to communicate with Instagram.', 'barcelona' ) );
				}

				preg_match( '#window\.\_sharedData\s\=\s(.*?)\;\<\/script\>#', $barcelona_remote['body'], $barcelona_match );

				if ( ! empty( $barcelona_match ) ) {

					$barcelona_data = json_decode( end( $barcelona_match ), true );

					if ( is_array( $barcelona_data ) && isset ( $barcelona_data['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
						$barcelona_result_data = $barcelona_data['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
					}

				}

				if ( is_array( $barcelona_result_data ) ) {
					set_transient( $barcelona_transient_key, $barcelona_result_data, 60 * 60 * 2 );
				}

			}

			if ( empty( $barcelona_result_data ) ) {
				return new WP_Error( 'no-images', esc_html__( 'Instagram did not return any images.', 'barcelona' ) );
			}

			return array_slice( $barcelona_result_data, 0, $slice );

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']      = strip_tags( $new_instance['title'] );
			$instance['username']   = strip_tags( $new_instance['username'] );
			$instance['number']     = absint( $new_instance['number'] );

			return $instance;

		}

		function form( $instance ) {

			$barcelona_title    = isset( $instance['title'] ) ? $instance['title'] : '';
			$barcelona_username = isset( $instance['username'] ) ? $instance['username'] : '';
			$barcelona_number   = isset( $instance['number'] ) ? $instance['number'] : 5;

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_username ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of items:', 'barcelona' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo absint( $barcelona_number ); ?>" size="3" />
			</p>
			<?php

		}

	}
}