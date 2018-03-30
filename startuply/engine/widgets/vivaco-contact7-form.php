<?php

/** Vivaco Recent posts widget **/

class VSC_Widget_CF7 extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_cf7', 'description' => __( "Widget for Contact Form 7", 'vivaco' ) );

		parent::__construct(
			'cf7_sply_widget', // Base ID
			__('Contact Form 7 Widget' , 'vivaco'),
			$widget_ops // Args
		);

		$this->alt_option_name = 'widget_cf7';
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
		<div class="container-cf7">
			<?php
				$widget_text = empty($instance['form']) ? '' : stripslashes($instance['form']);
				echo apply_filters('widget_text','[contact-form-7 id="' . $widget_text . '"]');
			?>
		</div>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['form'] = strip_tags( $new_instance['form'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => false,
				'form' => ''
			)
		);
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'vivaco') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('form'); ?>"><?php _e('Form:', 'vivaco') ?></label>
	<?php $cf7posts = new WP_Query( array( 'post_type' => 'wpcf7_contact_form' ));
		if ( $cf7posts->have_posts() ) { ?>
			<select class="widefat" name="<?php echo $this->get_field_name('form'); ?>" id="<?php echo $this->get_field_id('form'); ?>">

		<?php while( $cf7posts->have_posts() ) : $cf7posts->the_post(); ?>
			<option value="<?php the_id(); ?>"<?php selected(get_the_id(), $instance['form']); ?>><?php the_title(); ?></option>

		<?php endwhile;

		} else {?>
			<select class="widefat" disabled>
			<option disabled="disabled">No Forms Found</option> <?php
		} ?>
			</select>
	</p>

	<?php }
} // class VSC_Widget_CF7
