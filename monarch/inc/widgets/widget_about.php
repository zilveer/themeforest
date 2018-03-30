<?php 
/**
 * Monarch Widget About
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

class widget_about extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'about', // Base ID
			esc_html__( 'Monarch About Us', 'monarch' ), // Name
			array( 'description' => esc_html__( 'A widget that displays About Information', 'monarch' ), ) // Args
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
	public function widget( $args, $instance ) {
    	extract($args);
		//Our variables from the widget settings.
	    $title = apply_filters('widget_title', $instance['title']);
	    $image = $instance['image'];
	    $text  = $instance['text'];
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
?>

<div class="aboutwidget">
    <?php if($image) : ?>
    <div class="image"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></div>
    <?php endif; ?>
    <p><?php if($text) : ?><?php echo $text; ?><?php endif; ?></p>
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
		    //Set up some default widget settings.
		    $defaults = array(
		        'title' => 'About Us',
		        'image' => 'http://lorempixel.com/g/400/200',
		        'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis purus quis felis eleifend auctor. Nunc auctor vitae enim nec hendrerit. Vestibulum ut mattis tortor..'
		    );
		    $instance = wp_parse_args((array) $instance, $defaults);
		?>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'monarch'); ?></label>
	        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e('Image URL:', 'monarch'); ?></label>
	        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" /><br />
	        <small><?php esc_html_e('Insert your image URL. Your image should be at least 300px wide for best result.', 'monarch'); ?></small>
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e('About me text:', 'monarch'); ?></label>
	        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
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
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';

		return $instance;
	}

} // class widget_about
?>