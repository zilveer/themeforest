<?php 


/**
 * Text widget class
 *
 * @since 2.8.0
 */
class Rentify_Social extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'sb_widget_restaurant_social', 'description' => esc_html__('Arbitrary text or HTML.','rentify'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('sb_restaurant_social', esc_html__('Rentify Social ','rentify'), $widget_ops, $control_ops);
	}



	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );


		$facebook = apply_filters( 'widget_title', empty( $instance['facebook'] ) ? '' : $instance['facebook'], $instance, $this->id_base );

		$twitter = apply_filters( 'widget_title', empty( $instance['twitter'] ) ? '' : $instance['twitter'], $instance, $this->id_base );


		$linkedin = apply_filters( 'widget_title', empty( $instance['linkedin'] ) ? '' : $instance['linkedin'], $instance, $this->id_base );

		$googleplus = apply_filters( 'widget_title', empty( $instance['googleplus'] ) ? '' : $instance['googleplus'], $instance, $this->id_base );

		$pinterest = apply_filters( 'widget_title', empty( $instance['pinterest'] ) ? '' : $instance['pinterest'], $instance, $this->id_base );


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

			

			if ( ! empty( $facebook ) ) {

				echo '<li><a href="'.$facebook.'">Facebook</a></li>';

			} 

			if ( ! empty( $twitter ) ) {

				echo '<li><a href="'.$twitter.'">Twitter</a></li>';

			} 

			if ( ! empty( $linkedin ) ) {

				echo '<li><a href="'.$linkedin.'">Linkedin</a></li>';

			} 

			if ( ! empty( $googleplus ) ) {

				echo '<li><a href="'.$googleplus.'">GooglePlus</a></li>';

			}

			if ( ! empty( $pinterest ) ) {

				echo '<li><a href="'.$pinterest.'">Pinterest</a></li>';

			}





			?>

		</ul>
	<!-- </div> -->



		<!-- <P class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></P> -->
		
		<?php

		echo apply_filters( 'Social_after',  $args['after_widget'] );

				

	}




	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','facebook' => '', 'twitter' => '', 'linkedin' => '','googleplus' => '','pinterest' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$facebook = strip_tags($instance['facebook']);
		$twitter = strip_tags($instance['twitter']);
		$linkedin = strip_tags($instance['linkedin']);
		$googleplus = strip_tags($instance['googleplus']);
		$pinterest = strip_tags($instance['pinterest']);

		// $text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook Profile Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter Profile Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin Profile Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php esc_html_e('GooglePlus Profile Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest Profile Link:','rentify'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" /></p>		


		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php esc_html_e('Automatically add paragraphs','rentify'); ?></label></p>
<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['googleplus'] = strip_tags($new_instance['googleplus']);
		$instance['pinterest'] = strip_tags($new_instance['pinterest']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
}


add_action('widgets_init', 'rentify_social');

function rentify_social(){
    register_widget('Rentify_Social');
}

