<?php
/**
 * Monarch Widget Banner
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

class widget_banner extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'banner', // Base ID
			esc_html__( 'Monarch Banner', 'monarch' ), // Name
			array( 'description' => esc_html__( 'A widget that displays a banner', 'monarch' ), ) // Args
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
	    $title = apply_filters('widget_title', $instance['title']);
	    $image = $instance['image'];
	    $link  = $instance['link'];
	    $box   = $instance['box'];
	    echo $args['before_widget'];

	    ?>

	    <?php if($image) : ?>
	        <a <?php if($box == 'on') { ?> target="blank" <?php } ?> class="banner" href="<?php if($link) : ?><?php echo $link; ?><?php endif; ?>"><img src="<?php echo $image; ?>" title="<?php echo $title; ?>" /></a>
	    <?php endif; ?>

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
	    $defaults = array(
	        'title' => 'Banner Title',
	        'image' => 'http://lorempixel.com/g/400/200',
	        'link'  => 'http://themeforest.net/',
	        'box'   => 'on'
	    );
	    $instance = wp_parse_args((array) $instance, $defaults);
		?>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Image Title:', 'monarch'); ?></label>
	        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e('Image URL:', 'monarch'); ?></label>
	        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" /><br />
	        <small><?php esc_html_e('Insert your image URL. Your image should be at least 300px wide for best result.', 'monarch'); ?></small>
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php esc_html_e('Link:', 'monarch'); ?></label>
	        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
	    </p>
	    <p>
	        <input class="checkbox" type="checkbox" <?php checked( $instance['box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'box' ); ?>" name="<?php echo $this->get_field_name( 'box' ); ?>" />
	        <label for="<?php echo $this->get_field_id( 'box' ); ?>"><?php esc_html_e('Open in new tab', 'monarch'); ?></label>
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['link']  = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		$instance['box']   = ( ! empty( $new_instance['box'] ) ) ? strip_tags( $new_instance['box'] ) : '';

		return $instance;
	}

} // class widget_banner
?>