<?php
/**
 * Monarch Widget Facebook
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

class widget_facebook extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'facebook', // Base ID
			esc_html__( 'Monarch Facebook', 'monarch' ), // Name
			array( 'description' => esc_html__( 'A widget that displays a Facebook Like Box', 'monarch' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		extract($args);
		//Our variables from the widget settings.
		$title    = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		$faces    = $instance['faces'];
		$cover    = $instance['cover'];
		$stream   = $instance['stream'];
		$header   = $instance['header'];
		$width    = $instance['width'];
		$height   = $instance['height'];
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=224751940937018"; fjs.parentNode.insertBefore(js, fjs); }(document, "script", "facebook-jssdk"));</script>
		<div class="fb-page" data-href="<?php echo $page_url; ?>" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" data-small-header="<?php if($header) { echo 'true'; } else { echo 'false'; } ?>" data-adapt-container-width="true" data-hide-cover="<?php if($cover) { echo 'true'; } else { echo 'false'; } ?>" data-show-facepile="<?php if($faces) { echo 'true'; } else { echo 'false'; } ?>" data-show-posts="<?php if($stream) { echo 'true'; } else { echo 'false'; } ?>">
			<div class="fb-xfbml-parse-ignore"></div>
		</div>
	<?php
	echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		//Set up some default widget settings
		$defaults = array(
			'title'    => 'Facebook',
			'width'    => '',
			'height'   => '',
			'header'   => false,
			'faces'    => 'on',
			'cover'    => false,
			'page_url' => 'http://www.facebook.com/envato',
			'stream'   => false
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'monarch'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:96%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>"><?php esc_html_e('Facebook Page URL:', 'monarch'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" style="width:96%;" />
			<small><?php esc_html_e('EG. http://www.facebook.com/envato', 'monarch'); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'faces' ); ?>"><?php esc_html_e('Show Facepile:', 'monarch'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'faces' ); ?>" name="<?php echo $this->get_field_name( 'faces' ); ?>" <?php checked( (bool) $instance['faces'], true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cover' ); ?>"><?php esc_html_e('Hide Cover Photo:', 'monarch'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'cover' ); ?>" name="<?php echo $this->get_field_name( 'cover' ); ?>" <?php checked( (bool) $instance['cover'], true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'stream' ); ?>"><?php esc_html_e('Show Page Posts:', 'monarch'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'stream' ); ?>" name="<?php echo $this->get_field_name( 'stream' ); ?>" <?php checked( (bool) $instance['stream'], true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php esc_html_e('Use Small Header:', 'monarch'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" <?php checked( (bool) $instance['header'], true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php esc_html_e('Width:', 'monarch'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:20%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php esc_html_e('Height:', 'monarch'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:20%;" />
			<small><?php esc_html_e('Note: If you are showing the stream the height should be around 500.', 'monarch'); ?></small>
		</p>
		<?php 
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
		$instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['page_url'] = ( ! empty( $new_instance['page_url'] ) ) ? strip_tags( $new_instance['page_url'] ) : '';
		$instance['faces']    = ( ! empty( $new_instance['faces'] ) ) ? strip_tags( $new_instance['faces'] ) : '';
		$instance['cover']    = ( ! empty( $new_instance['cover'] ) ) ? strip_tags( $new_instance['cover'] ) : '';
		$instance['stream']   = ( ! empty( $new_instance['stream'] ) ) ? strip_tags( $new_instance['stream'] ) : '';
		$instance['header']   = ( ! empty( $new_instance['header'] ) ) ? strip_tags( $new_instance['header'] ) : '';
		$instance['width']    = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height']   = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';

		return $instance;
	}

} // class widget_facebook
?>