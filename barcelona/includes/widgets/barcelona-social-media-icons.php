<?php
/*
 * Social Media Icons Widget
 */

if ( ! class_exists( 'Barcelona_Widget_Social_Media_Icons' ) ) {
	class Barcelona_Widget_Social_Media_Icons extends WP_Widget {

		function __construct() {

			$widget_opts = array(
				'classname'   => 'barcelona-widget-social-media-icons',
				'description' => esc_html_x( 'Displays the social media icons', 'Social Media Icons widget description', 'barcelona' )
			);

			parent::__construct( 'barcelona-social-media-icons', sprintf( esc_html_x( '%s Social Media Icons', 'Social Media Icons widget name', 'barcelona' ), BARCELONA_THEME_NAME ), $widget_opts );

		}

		function widget( $args, $instance ) {

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
			}

			if ( array_key_exists( 'social_url', $instance ) && ! is_array( $instance['social_url'] ) ) {
				$instance['social_url'] = array();
			}

			if ( ! empty( $instance['social'] ) ): ?>
			<ul class="social-icons clearfix <?php echo sanitize_html_class( $instance['icon_type'] ); ?>">
				<?php foreach ( $instance['social'] as $k => $v ): ?>
				<li><a href="<?php echo esc_url( $v['url'] ); ?>" target="_blank"><span class="fa fa-<?php echo sanitize_html_class( $v['icon'] ); ?>"></span></a></li>
				<?php endforeach; ?>
			</ul>
			<?php
			endif;

			echo wp_kses_post( $args['after_widget'] );

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']      = strip_tags( $new_instance['title'] );
			$instance['icon_type']  = sanitize_key( $new_instance['icon_type'] );
			$instance['social']     = array();

			if ( is_array( $new_instance['social_url'] ) ) {

				foreach ( $new_instance['social_url'] as $k => $v ) {

					if ( ! empty( $v ) ) {

						$instance['social'][] = array(
							'icon' => sanitize_key( $new_instance['social_icon'][ $k ] ),
							'url'  => esc_url_raw( $v )
						);

					}

				}

			}

			return $instance;

		}

		function form( $instance ) {

			$barcelona_title        = isset( $instance['title'] ) ? $instance['title'] : '';
			$barcelona_icon_type    = isset( $instance['icon_type'] ) ? sanitize_key( $instance['icon_type'] ) : 'square';

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_type' ) ); ?>"><?php esc_html_e( 'Icon Type:', 'barcelona' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'icon_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_type' ) ); ?>">
					<?php foreach ( array( 'square' => esc_html__( 'Square', 'barcelona' ), 'circle' => esc_html__( 'Circle', 'barcelona' ) ) as $k => $v ): ?>
					<option value="<?php echo esc_attr( $k ); ?>"<?php echo ( $k == $barcelona_icon_type ) ? ' selected' : ''; ?>><?php echo esc_html( $v ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<strong><?php esc_html_e( 'Social Icons', 'barcelona' ); ?></strong>
			</p>

			<?php
			if ( array_key_exists( 'social', $instance ) && is_array( $instance['social'] ) ) {
				foreach ( $instance['social'] as $k => $v ) {
					$this->social_icon_row( $v['icon'], $v['url'] );
				}
			}
			?>

			<p>
				<a href="#" class="barcelona-add-social-icon-btn button"><?php esc_html_e( 'Add Icon', 'barcelona' ); ?></a>
			</p>

			<div id="barcelona-social-icon-row-instance" style="display:none;">
				<?php $this->social_icon_row(); ?>
			</div>
			<?php

		}

		function social_icon_row( $selected='', $value='' ) {

			$barcelona_social = $this->get_social();

			?>
			<div class="barcelona-social-icon-row">
				<p>
					<label><?php esc_html_e( 'Icon', 'barcelona' ); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_icon' ) ); ?>[]">
						<?php foreach ( $barcelona_social as $k => $v ): ?>
						<option value="<?php echo esc_attr( $k ); ?>"<?php echo ( $k == $selected ) ? ' selected' : ''; ?>><?php echo esc_html( $v ); ?></option>
						<?php endforeach; ?>
					</select>
					<a href="#" class="barcelona-social-icon-row-rm">&times;</a>
				</p>
				<p>
					<label><?php esc_html_e( 'Url:', 'barcelona' ); ?></label>
					<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_url' ) ); ?>[]" type="text" value="<?php echo esc_attr( $value ); ?>" />
				</p>
			</div>
			<?php

		}

		function get_social() {

			$barcelona_social = array(
				'500px' => '500px',
				'android' => 'Android',
				'apple' => 'Apple',
				'behance' => 'Behance',
				'codepen' => 'Codepen',
				'delicious' => 'Delicious',
				'deviantart' => 'Deviantart',
				'digg' => 'Digg',
				'dribbble' => 'Dribble',
				'dropbox' => 'Dropbox',
				'facebook' => 'Facebook',
				'flickr' => 'Flickr',
				'foursquare' => 'Foursquare',
				'github' => 'Github',
				'google-plus' => 'Google Plus',
				'instagram' => 'Instagram',
				'lastfm' => 'Last FM',
				'linkedin' => 'Linkedin',
				'medium' => 'Medium',
				'odnoklassniki' => 'Odnoklassniki',
				'pinterest' => 'Pinterest',
				'reddit' => 'Reddit',
				'rss' => 'RSS',
				'skype' => 'Skype',
				'slideshare' => 'Slideshare',
				'strava' => 'Strava',
				'soundcloud' => 'Soundcloud',
				'spotify' => 'Spotify',
				'stumbleupon' => 'Stumbleupon',
				'tumblr' => 'Tumblr',
				'twitter' => 'Twitter',
				'vimeo' => 'Vimeo',
				'vine' => 'Vine',
				'vk' => 'VKontakte',
				'whatsapp' => 'Whatsapp',
				'wordpress' => 'Wordpress',
				'xing' => 'Xing',
				'yelp' => 'Yelp',
				'youtube' => 'Youtube'
			);

			return $barcelona_social;

		}

	}
}