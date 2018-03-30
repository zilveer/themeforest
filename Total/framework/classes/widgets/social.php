<?php
/**
 * Image social widget
 *
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 * @package Total WordPress Theme
 * @subpackage Widgets
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'WPEX_Social_Widget' ) ) {

	class WPEX_Social_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Define widget
			$branding = wpex_get_theme_branding();
			$branding = $branding ? $branding . ' - ' : '';
			parent::__construct(
				'wpex_social_widget',
				$branding . esc_attr__( 'Image Icons Social Widget', 'total' )
			);

			// Load scripts
			if ( is_admin() ) {
				add_action( 'admin_enqueue_scripts', array( 'WPEX_Social_Widget', 'scripts' ) );
			}

		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 * @since 1.0.0
		 *
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {

			// Get social services and return nothing if none are defined
			$social_services = isset( $instance['social_services'] ) ? $instance['social_services'] : '';
			if ( ! $social_services ) {
				return;
			}

			// Define vars
			$title        = isset( $instance['title'] ) ? $instance['title'] : '';
			$style        = isset( $instance['style'] ) ? $instance['style'] : '';
			$target       = isset( $instance['target'] ) ? $instance['target'] : '';
			$size         = isset( $instance['size'] ) ? $instance['size'] : '';
			$img_location = get_template_directory_uri() .'/images/social/';
			
			// Sanitize vars
			$target = 'blank' == $target ? ' target="_blank"' : '';
			$size   = $size ? intval( $size ) : '';

			// Apply filters
			$title        = apply_filters( 'widget_title', $title );
			$img_location = apply_filters( 'wpex_social_widget_img_dir', $img_location ); ?>

			<?php
			// Before widget WP hook
			echo $args['before_widget']; ?>

			<?php
			// Display widget title if defined
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>

			<ul class="wpex-social-widget-output">
				<?php foreach( $social_services as $key => $service ) { ?>
					<?php $link = ! empty( $service['url'] ) ? $service['url'] : null; ?>
					<?php $name = $service['name']; ?>
					<?php if ( $link ) { ?>
						<?php echo '<li><a href="'. esc_url( $link ) .'" title="'. esc_attr( $name ) .'"'. $target .'><img src="'. esc_url( $img_location . strtolower ( $name ) ) .'.png" alt="'. esc_attr( $name ) .'" height="'. esc_attr( intval( $size ) ) .'" width="'. esc_attr( intval( $size ) ) .'" /></a></li>'; ?>
					<?php } ?>
				<?php } ?>
			</ul><!-- .wpex-social-widget-output -->

			<?php
			// After widget WP hook
			echo $args['after_widget']; ?>

		<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 * @since 1.0.0
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new, $old ) {
			$instance = $old;
			$instance['title']           = ! empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;
			$instance['style']           = ! empty( $new['style'] ) ? strip_tags( $new['style'] ) : 'color-square';
			$instance['target']          = ! empty( $new['target'] ) ? strip_tags( $new['target'] ) : 'blank';
			$instance['size']            = ! empty( $new['size'] ) ? strip_tags( $new['size'] ) : '32px';
			$instance['social_services'] = $new['social_services'];
			return $instance;
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 * @since 1.0.0
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$defaults =  array(
				'title'           => esc_attr__( 'Follow Us', 'total' ),
				'style'           => 'color-square',
				'target'          => 'blank',
				'size'            => '30px',
				'social_services' => array(
					'twitter' => array(
						'name' => 'Twitter',
						'url'  => '',
					),
					'facebook' => array(
						'name' => 'Facebook',
						'url'  => '',
					),
					'instagram' => array(
						'name' => 'Instagram',
						'url'  => '',
					),
					'linkedin' => array(
						'name' => 'LinkedIn',
						'url'  => '',
					),
					'pinterest' => array(
						'name' => 'Pinterest',
						'url'  => '',
					),
					'googleplus' => array(
						'name' => 'GooglePlus',
						'url'  => '',
					),
					'rss' => array(
						'name' => 'RSS',
						'url'  => '',
					),
					'dribbble' => array(
						'name' => 'Dribbble',
						'url'  => '',
					),
					
					'flickr' => array(
						'name' => 'Flickr',
						'url'  => '',
					),
					'forrst' => array(
						'name' => 'Forrst',
						'url'  => '',
					),
					'github' => array(
						'name' => 'GitHub',
						'url'  => '',
					),
					'tumblr' => array(
						'name' => 'Tumblr',
						'url'  => '',
					),
					'vimeo' => array(
						'name' => 'Vimeo',
						'url'  => '',
					),
					'youtube' => array(
						'name' => 'Youtube',
						'url'  => '',
					),
				),
			);
			
			$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title', 'total' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_attr_e( 'Link Target:', 'total' ); ?></label>
				<br />
				<select class='wpex-widget-select' name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
					<option value="blank" <?php if($instance['target'] == 'blank' ) { ?>selected="selected"<?php } ?>><?php esc_attr_e( 'Blank', 'total' ); ?></option>
					<option value="self" <?php if($instance['target'] == 'self' ) { ?>selected="selected"<?php } ?>><?php esc_attr_e( 'Self', 'total' ); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_attr_e( 'Size', 'total' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['size'] ); ?>" />
				<small><?php esc_attr_e( 'Size in pixels. Icon images are 36px.', 'total' ); ?></small>
			</p>

			<?php
			$field_id_services   = $this->get_field_id( 'social_services' );
			$field_name_services = $this->get_field_name( 'social_services' ); ?>
			<h3 style="margin-top:20px;margin-bottom:0;"><?php esc_attr_e( 'Social Links', 'total' ); ?></h3>  
			<ul id="<?php echo esc_attr( $field_id_services ); ?>" class="wpex-social-widget-services-list">
				<input type="hidden" id="<?php echo esc_attr( $field_name_services ); ?>" value="<?php echo esc_attr( $field_name_services ); ?>">
				<input type="hidden" id="<?php echo esc_attr( wp_create_nonce( 'wpex_fontawesome_social_widget_nonce' ) ); ?>">
				<?php
				$display_services = isset ( $instance['social_services'] ) ? $instance['social_services']: '';
				if ( ! empty( $display_services ) ) {
					foreach( $display_services as $key => $service ) {
						$url  = isset( $service['url'] ) ? $service['url'] : 0;
						$name = isset( $service['name'] )  ? $service['name'] : ''; ?>
						<li id="<?php echo esc_attr( $field_id_services ); ?>_0<?php echo esc_attr( $key ); ?>">
							<p>
								<label for="<?php echo esc_attr( $field_id_services ); ?>-<?php echo esc_attr( $key ); ?>-name"><?php echo strip_tags( $name ); ?>:</label>
								<input type="hidden" id="<?php echo esc_attr( $field_id_services ); ?>-<?php echo esc_attr( $key ); ?>-url" name="<?php echo esc_attr( $field_name_services .'['.$key.'][name]' ); ?>" value="<?php echo esc_attr( $name ); ?>">
								<input type="url" class="widefat" id="<?php echo esc_attr( $field_id_services ); ?>-<?php echo esc_attr( $key ); ?>-url" name="<?php echo esc_attr( $field_name_services .'['.$key.'][url]' ); ?>" value="<?php echo esc_attr( $url ); ?>" />
							</p>
						</li>
					<?php }
				} ?>
			</ul>
		<?php
		}

		/**
		 * Load scripts for this widget
		 *
		 */
		public static function scripts( $hook ) {

			if ( $hook != 'widgets.php' ) {
				return;
			}

			$dir = get_template_directory_uri() .'/framework/classes/widgets/assets/';

			wp_enqueue_style( 'total-social-widget', $dir .'total-social-widget.css' );
			wp_enqueue_script( 'total-social-widget', $dir .'total-social-widget.js', array( 'jquery' ), false, true );

		}

	}

}

// Register the widget
register_widget( 'WPEX_Social_Widget' );