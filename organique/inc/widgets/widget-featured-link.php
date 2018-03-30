<?php
/**
 * Featured link widget
 * ====================
 * Featured links are used at the top of the front page
 *
 * @package Organique
 */

class Featured_Link_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Featured Link', 'backend', 'organique_wp' ), // Name
			array(
				'description' => _x( 'Featured links usually used on the front page', 'backend', 'organique_wp' )
			)
		);

		// color picker needed
		if( is_admin() ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
		}
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		?>

		<?php echo $before_widget; ?>
			<a href="<?php echo $instance['link']; ?>">
				<div class="banners-medium" style="color: <?php echo $instance['text_color']; ?>; background-color: <?php echo $instance['bg_color']; ?>;">
					<span class="banners-text"><?php echo $title; ?></span>
					<span class="glyphicon  glyphicon-circle  glyphicon-chevron-right" style="border-color: <?php echo $instance['text_color']; ?>;"></span>
				</div>
			</a>
		<?php echo $after_widget; ?>

		<?php

		// echo $out;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']      = wp_kses_post( $new_instance['title'] );
		$instance['link']       = esc_url( $new_instance['link'] );
		$instance['text_color'] = esc_html( $new_instance['text_color'] );
		$instance['bg_color']   = esc_html( $new_instance['bg_color'] );


		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title      = isset( $instance['title'] ) ? $instance['title'] : 'Up to 35% off the Sandwiches category';
		$link       = isset( $instance['link'] ) ? $instance['link'] : 'http://www.proteusthemes.com';
		$text_color = isset( $instance['text_color'] ) ? $instance['text_color'] : '#ffffff';
		$bg_color   = isset( $instance['bg_color'] ) ? $instance['bg_color'] : '#413c35';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'backend', 'organique_wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _ex( 'Link:', 'backend', 'organique_wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
		</p>

		<script type="text/javascript">
			jQuery('document').ready(function ($) {
				$('.js--attach-color-picker').wpColorPicker();
			});
		</script>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _ex( 'Text Color:', 'backend', 'organique_wp' ); ?></label> <br>
			<input class="js--attach-color-picker" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" type="text" value="<?php echo esc_attr( $text_color ); ?>" data-default-color="<?php echo esc_attr( $text_color ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _ex( 'Background Color:', 'backend', 'organique_wp' ); ?></label> <br>
			<input class="js--attach-color-picker" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" type="text" value="<?php echo esc_attr( $bg_color ); ?>" data-default-color="<?php echo esc_attr( $bg_color ); ?>" />
		</p>

		<?php
	}

} // class Featured_Link_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Featured_Link_Widget" );' ) );
