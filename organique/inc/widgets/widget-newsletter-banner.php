<?php
/**
 * Newsletter form widget
 * ====================
 * Mostly to be used in the page builder on front page
 *
 * @package Organique
 */

class Widget_Newsletter_Banner extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Newsletter Banner', 'backend', 'organique_wp' ), // Name
			array(
				'description' => _x( 'Mostly to be used in the page builder on front page', 'backend', 'organique_wp' )
			),
			array( 'width' => 400 )
		);

		// color picker needed
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
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
		?>

		<?php echo $before_widget; ?>
		<div class="banners-big  banners-big--newsletter">
			<div class="row">
				<div class="col-xs-12  col-md-7">
					<div class="banners-big__text">
						<?php echo $instance['title']; ?>
					</div>
				</div>
				<div class="col-xs-12  col-md-5">
					<div class="banners-big__form">
						<?php echo $instance['form']; ?>
					</div>
				</div>
			</div>
		</div>
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
		$instance['form']       = balanceTags( $new_instance['form'] );
		// $instance['text_color'] = esc_html( $new_instance['text_color'] );
		// $instance['bg_color']   = esc_html( $new_instance['bg_color'] );


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
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Sign up on newsletter for more information about ProteusThemes';
		$form  = isset( $instance['form'] ) ? $instance['form'] : '<form action="http://proteusthemes.us4.list-manage.com/subscribe/post?u=ea0786485977f5ec8c9283d5c&amp;id=5dad3f35e9" method="post" name="mc-embedded-subscribe-form" role="form" target="_blank">
	<div class="form-group  form-group--form">
		<input type="email" name="EMAIL" class="form-control  form-control--form" placeholder="Enter your E-mail address" required>
		<button class="btn  btn-primary" type="submit">Sign up now</button>
	</div>
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
	<div style="position: absolute; left: -5000px;"><input type="text" name="b_ea0786485977f5ec8c9283d5c_5dad3f35e9" value=""></div>
</form>';
		// $text_color = isset( $instance['text_color'] ) ? $instance['text_color'] : '#ffffff';
		// $bg_color   = isset( $instance['bg_color'] ) ? $instance['bg_color'] : '#413c35';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'backend', 'organique_wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<script type="text/javascript">
			jQuery('document').ready(function ($) {
				$('.js--attach-color-picker').wpColorPicker();
			});
		</script>

		<?php if ( false ): ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _ex( 'Text Color:', 'backend', 'organique_wp' ); ?></label> <br>
			<input class="js--attach-color-picker" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" type="text" value="<?php echo esc_attr( $text_color ); ?>" data-default-color="<?php echo esc_attr( $text_color ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _ex( 'Background Color:', 'backend', 'organique_wp' ); ?></label> <br>
			<input class="js--attach-color-picker" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" type="text" value="<?php echo esc_attr( $bg_color ); ?>" data-default-color="<?php echo esc_attr( $bg_color ); ?>" />
		</p>
		<?php endif ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'form' ); ?>"><?php _ex( 'Form HTML code:', 'backend', 'organique_wp' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>"><?php echo $form; ?></textarea>
		</p>

		<?php
	}

} // class Widget_Newsletter_Banner
add_action( 'widgets_init', create_function( '', 'register_widget( "Widget_Newsletter_Banner" );' ) );
