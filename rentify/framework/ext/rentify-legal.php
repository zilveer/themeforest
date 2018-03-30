<?php 


/**
 * Text widget class
 *
 * @since 2.8.0
 */
class Rentify_Legal extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'sb_widget_restaurant_legal', 'description' => esc_html__('Arbitrary text or HTML.','rentify'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('sb_restaurant_legal', esc_html__('Rentify Legal ','rentify'), $widget_ops, $control_ops);
	}



	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );


		$story = apply_filters( 'widget_title', empty( $instance['story'] ) ? '' : $instance['story'], $instance, $this->id_base );

		$mission = apply_filters( 'widget_title', empty( $instance['mission'] ) ? '' : $instance['mission'], $instance, $this->id_base );


		$journal = apply_filters( 'widget_title', empty( $instance['journal'] ) ? '' : $instance['journal'], $instance, $this->id_base );


		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */


		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );		
		
		
		echo apply_filters( 'Social_before',  $args['before_widget'] );
		?>

	<!-- <div class="col-sm-4"> -->

		<?php if ( ! empty( $title ) ) {?>

			<?php echo apply_filters('Social_before_title',$args['before_title']). esc_attr($title) . apply_filters('Social_after_title',$args['after_title']);
				?>
			
			<?php } ?>

		<ul class="links">

			<?php 

			

			if ( ! empty( $story ) ) {

				echo '<li><a href="'.$story.'">Privacy Policy</a></li>';

			} 

			if ( ! empty( $mission ) ) {

				echo '<li><a href="'.$mission.'">Terms &amp; Conditions</a></li>';

			} 

			if ( ! empty( $journal ) ) {

				echo '<li><a href="'.$journal.'">Secure Payments</a></li>';

			} 


			?>

		</ul>
	<!-- </div> -->



		<!-- <P class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></P> -->
		
		<?php

		echo apply_filters( 'Social_after',  $args['after_widget'] );

				

	}


	public function form( $instance ) {


		$instance = wp_parse_args( (array) $instance, array( 'title' => '','story' => '', 'mission' => '', 'journal' => '','text' => '' ) );
		$title = strip_tags($instance['title']);
		$story = strip_tags($instance['story']);
		$mission = strip_tags($instance['mission']);
		$journal = strip_tags($instance['journal']);
		

		// $text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('story')); ?>"><?php esc_html_e('Our Privacy & Policy Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('story')); ?>" name="<?php echo esc_attr($this->get_field_name('story')); ?>" type="text" value="<?php echo esc_attr($story); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('mission')); ?>"><?php esc_html_e('Terms & Conditions Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('mission')); ?>" name="<?php echo esc_attr($this->get_field_name('mission')); ?>" type="text" value="<?php echo esc_attr($mission); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('journal')); ?>"><?php esc_html_e('Secure Payments Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('journal')); ?>" name="<?php echo esc_attr($this->get_field_name('journal')); ?>" type="text" value="<?php echo esc_attr($journal); ?>" /></p>


		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php esc_html_e('Automatically add paragraphs','rentify'); ?></label></p>
<?php

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['story'] = strip_tags($new_instance['story']);
		$instance['mission'] = strip_tags($new_instance['mission']);
		$instance['journal'] = strip_tags($new_instance['journal']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;

	}

}



add_action('widgets_init', 'rentify_legal');

function rentify_legal(){

    register_widget('Rentify_Legal');

}