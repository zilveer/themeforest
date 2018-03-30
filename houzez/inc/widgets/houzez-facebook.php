<?php
/*
 * Widget Name: Facebook Feeds
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */

class houzez_facebook_like extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'houzez_facebook', // Base ID
			esc_html__( 'HOUZEZ: Facebook', 'houzez' ), // Name
			array( 'description' => esc_html__( 'Adds support for Facebook Like Box.', 'houzez' ), ) // Args
		);

	}

	function widget($args, $instance)
	{

		extract($args);

		$allowed_html_array = array(
			'div' => array(
				'id' => array(),
				'class' => array()
			),
			'h3' => array(
				'class' => array()
			)
		);

		$title = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		$width = $instance['width'];
		$fb_height = $instance['fb_height'];
		$use_small_header = isset($instance['use_small_header']) ? 'true' : 'false';
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$show_posts = isset($instance['show_posts']) ? 'true' : 'false';
		$adapt_width = isset($instance['adapt_width']) ? 'true' : 'false';
		$hide_title = isset($instance['hide_title']) ? 'true' : 'false';

		echo wp_kses( $before_widget, $allowed_html_array );

		if ( ! empty( $title ) && $hide_title != "true" ) {
			echo wp_kses( $before_title, $allowed_html_array ) . $title . wp_kses( $after_title, $allowed_html_array );
		}

		if( $adapt_width =="true" ){
			$width = '';
			$fb_height = '';
		}

		if($page_url): ?>
		<div class="fb-page"
		     data-href="<?php echo esc_url($page_url); ?>"
		     data-width="<?php echo esc_attr( $width ); ?>"
		     data-height="<?php echo esc_attr( $fb_height ); ?>"
		     data-small-header="<?php echo esc_attr( $use_small_header ); ?>"
		     data-adapt-container-width="<?php echo esc_attr( $adapt_width ); ?>"
		     data-hide-cover="false"
		     data-show-facepile="<?php echo esc_attr( $show_faces ); ?>"
		     data-show-posts="<?php echo esc_attr( $show_posts ); ?>">
			<div class="fb-xfbml-parse-ignore">
			</div>
		</div>

		<?php endif;

		echo wp_kses( $after_widget, $allowed_html_array );

	}


	function update($new_instance, $old_instance)
	{

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['page_url'] = $new_instance['page_url'];
		$instance['width'] = $new_instance['width'];
		$instance['fb_height'] = $new_instance['fb_height'];
		$instance['use_small_header'] = $new_instance['use_small_header'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_posts'] = $new_instance['show_posts'];
		$instance['adapt_width'] = $new_instance['adapt_width'];
		$instance['hide_title'] = $new_instance['hide_title'];

		return $instance;
	}


	function form($instance)
	{

		$defaults = array('title' => 'Find us on Facebook', 'page_url' => 'https://www.facebook.com/Favethemes/', 'width' => '', 'fb_height' => '', 'use_small_header' => false, 'show_faces' => 'on', 'show_posts' => false, 'adapt_width' => 'on', 'hide_title' => 'on' );
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'houzez' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('page_url') ); ?>"><?php esc_html_e( 'Facebook Page URL:', 'houzez' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('page_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('page_url') ); ?>" value="<?php echo esc_url( $instance['page_url'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('width')); ?>"><?php esc_html_e( 'Width:', 'houzez' ); ?></label>
			<input class="small-text" id="<?php echo esc_attr( $this->get_field_id('width')); ?>" name="<?php echo esc_attr( $this->get_field_name('width') ); ?>" value="<?php echo esc_attr( $instance['width'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('fb_height')); ?>"><?php esc_html_e( 'Height:', 'houzez' ); ?></label>
			<input class="small-text" id="<?php echo esc_attr( $this->get_field_id('fb_height')); ?>" name="<?php echo esc_attr( $this->get_field_name('fb_height')); ?>" value="<?php echo esc_attr( $instance['fb_height']); ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['adapt_width'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('adapt_width')); ?>" name="<?php echo esc_attr( $this->get_field_name('adapt_width')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('adapt_width')); ?>"><?php esc_html_e( 'Adapt to container width', 'houzez' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['use_small_header'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('use_small_header')); ?>" name="<?php echo esc_attr( $this->get_field_name('use_small_header')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('use_small_header')); ?>"><?php esc_html_e( 'Use Small Header', 'houzez' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_faces')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_faces')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_faces')); ?>"><?php esc_html_e( "Show Friend's faces", 'houzez' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_posts'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_posts')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_posts')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_posts')); ?>"><?php esc_html_e( 'Show Page Posts', 'houzez' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['hide_title'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('hide_title')); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_title')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('hide_title')); ?>"><?php esc_html_e( 'Hide Widget Title', 'houzez' ); ?></label>
		</p>


	<?php
	}
}


if ( ! function_exists( 'houzez_facebook_loader' ) ) {
	function houzez_facebook_loader (){
		register_widget( 'houzez_facebook_like' );
	}
	add_action( 'widgets_init', 'houzez_facebook_loader' );
}

?>