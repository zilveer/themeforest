<?php
/**
 * Banner Widget
 *
 * @package BuildPress
 */

if ( ! class_exists( 'PT_Banner' ) ) {
	class PT_Banner extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				false, // ID, auto generate when false
				_x( 'ProteusThemes: Banner' , 'backend', 'buildpress_wp'), // Name
				array(
					'description' => _x( 'Banner for Page Builder.', 'backend', 'buildpress_wp'),
					'classname'   => 'widget-banner',
				)
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			$text     = empty( $instance['text'] ) ? '' : $instance['text'];
			$textarea = empty( $instance['textarea'] ) ? '' : $instance['textarea'];

			echo $args['before_widget'];
			?>
				<div class="banner__text">
					<?php echo $text; ?>
				</div>
				<div class="banner__buttons">
					<?php echo do_shortcode( $textarea ); ?>
				</div>
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['text'] = wp_kses_post( $new_instance['text'] );
			$instance['textarea'] = wp_kses_post( $new_instance['textarea'] );

			return $instance;
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$text = empty( $instance['text'] ) ? '' : $instance['text'];
			$textarea = empty( $instance['textarea'] ) ? '' : $instance['textarea'];

			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _ex( 'Text:', 'backend', 'buildpress_wp'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _ex( 'Button Area:', 'backend', 'buildpress_wp'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>" type="text" value="<?php echo esc_attr( $textarea ); ?>" /><br><br>
				<span class="button-shortcodes">
					For adding buttons you must use button shortcode which looks like that: <b>[button]Text[/button]</b>.<br>
					There is more option with different attributes - <b>text</b>, <b>style</b>, <b>href</b>, <b>target</b>.<br>
					<b>Text</b>: You can change the text of the button. Example: <b>[button]New Text[/button]</b>.<br>
					<b>Style</b>: You can choose betwen few styles - <b>primary</b>, <b>default</b>, <b>success</b>, <b>info</b>, <b>warning</b> or <b>danger</b>. Example: <b>[button style="default"]Text[/button]</b>.<br>
					<b>Href</b>: You can add any URL to the button. Example: <b>[button href="http://www.proteusthemes.com"]Text[/button]</b>.<br>
					<b>Target</b>: You can choose if you want to open link in same (<b>_self</b>) or new (<b>_blank</b>) window. Example: <b>[button target="_blank"]Text[/button]</b>.<br>
				</span>
			</p>

			<?php
		}

	}
	add_action( 'widgets_init', create_function( '', 'register_widget( "PT_Banner" );' ) );
}