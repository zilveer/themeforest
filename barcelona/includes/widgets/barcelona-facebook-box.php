<?php
/*
 * Facebook Box Widget
 */

if ( ! class_exists( 'Barcelona_Widget_Facebook_Box' ) ) {
	class Barcelona_Widget_Facebook_Box extends WP_Widget {

		public function __construct() {

			$widget_ops = array(
				'classname'   => 'barcelona-widget-facebook-box',
				'description' => esc_html_x( 'Facebook Page Box', 'Facebook Box widget description', 'barcelona' )
			);

			parent::__construct( 'barcelona-facebook-box', sprintf( esc_html_x( '%s Facebook Box', 'Facebook Box widget name', 'barcelona' ), BARCELONA_THEME_NAME ), $widget_ops );

		}

		public function widget( $args, $instance ) {

			if ( empty( $instance['href'] ) ) {
				return false;
			}

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
			}

			$barcelona_params = array(
				'href'          => esc_url( $instance['href'] ),
				'hide-cover'    => ( isset( $instance['hide_cover'] ) && ! $instance['hide_cover'] ) ? 'false' : 'true',
				'show-facepile' => ( isset( $instance['show_facepile'] ) && ! $instance['show_facepile'] ) ? 'false' : 'true',
				'show-posts'    => ( isset( $instance['show_posts'] ) && ! $instance['show_posts'] ) ? 'false' : 'true',
			    'small-header'  => ( isset( $instance['small_header'] ) && ! $instance['small_header'] ) ? 'false' : 'true',
				'width'         => 336
			);

			$barcelona_atts = array();
			foreach( $barcelona_params as $k => $v ) {
				$barcelona_atts[] = ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"';
			}

			echo '<div class="fb-page-wrapper"><div class="fb-page"'. implode( $barcelona_atts ) .'></div></div>';

			echo wp_kses_post( $args['after_widget'] );

		}

		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']          = strip_tags( $new_instance['title'] );
			$instance['href']           = esc_url_raw( $new_instance['href'] );
			$instance['hide_cover']     = isset( $new_instance['hide_cover'] ) ? (bool) $new_instance['hide_cover'] : false;
			$instance['show_facepile']  = isset( $new_instance['show_facepile'] ) ? (bool) $new_instance['show_facepile'] : false;
			$instance['show_posts']     = isset( $new_instance['show_posts'] ) ? (bool) $new_instance['show_posts'] : false;
			$instance['small_header']   = isset( $new_instance['small_header'] ) ? (bool) $new_instance['small_header'] : false;

			return $instance;

		}

		public function form( $instance ) {

			$barcelona_title            = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$barcelona_href             = ( ! empty( $instance['href'] ) ) ? $instance['href'] : '';
			$barcelona_hide_cover       = isset( $instance['hide_cover'] ) ? (bool) $instance['hide_cover'] : false;
			$barcelona_show_facepile    = isset( $instance['show_facepile'] ) ? (bool) $instance['show_facepile'] : true;
			$barcelona_show_posts       = isset( $instance['show_posts'] ) ? (bool) $instance['show_posts'] : false;
			$barcelona_small_header     = isset( $instance['small_header'] ) ? (bool) $instance['small_header'] : false;

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $barcelona_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>"><?php esc_html_e( 'Facebook Page URL:', 'barcelona' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'href' ) ); ?>" type="text" value="<?php echo esc_url( $barcelona_href ); ?>" />
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_small_header ); ?> id="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'small_header' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>"><?php esc_html_e( 'Use Small Header', 'barcelona' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_hide_cover ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_cover' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>"><?php esc_html_e( 'Hide Cover Photo', 'barcelona' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_show_posts ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_posts' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_posts' ) ); ?>"><?php esc_html_e( 'Show Page Posts', 'barcelona' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $barcelona_show_facepile ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_facepile' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>"><?php esc_html_e( 'Show Friend\'s Faces', 'barcelona' ); ?></label>
			</p>
			<?php

		}

	}
}