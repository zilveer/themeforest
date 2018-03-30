<?php
/*
 * Plugin Name: Custom 250x250 Ad Unit
 * Plugin URI: http://www.ormanclark.com
 * Description: A widget that allows the selection and configuration of a single 250x250 Banner
 * Version: 1.0
 * Author: Orman Clark; edited by different-themes.com
 * Author URI: http://www.ormanclark.com & http://www.different-themes.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'tz_ad300_widgets' );

/*
 * Register widget.
 */
function tz_ad300_widgets() {
	register_widget( 'TZ_Ad300_Widget' );
}

/*
 * Widget class.
 */
class tz_ad300_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function TZ_Ad300_Widget() {
	
		/* Widget settings */
		$widget_ops = array( 'classname' => 'tz_ad300_widget', 'description' => esc_html__('A widget that allows the display and configuration of of a single 300x250 Banner.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 300, 'height' => 250, 'id_base' => 'tz_ad300_widget' );

		/* Create the widget */
		parent::__construct ( 'tz_ad300_widget', esc_html__(THEME_FULL_NAME.' Custom 300x250 Ad', 'framework'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$ad = $instance['ad'];
		$link = $instance['link'];


		/* Before widget (defined by themes). */
		echo balanceTags($before_widget);
		//if($title) echo balanceTags($before_title.$title.$after_title,true);

		$contactID = df_get_page("contact");
									

		if($title) { 
			echo balanceTags($before_title);
			echo esc_html__($title);
			echo balanceTags($after_title);
		}


		echo '<div class="tb_widget_banner_300 clearfix">';
			/* Display Ad */
			if ( $link ) {
				echo '<a href="'.esc_url($link).'" target="_blank"><img src="'.esc_attr__($ad).'" alt="Banner"/></a>';
			} elseif ( $ad ) {
				echo '<img src="'.esc_url($ad).'" alt="Banner"/>';
			}
			if($contactID) {
				//echo '<a href="'.esc_url(get_page_link($contactID[0])).'" class="banner-meta">'.esc_html__("Contact us about advert spaces", THEME_NAME).'<i class="fa fa-angle-double-up"></i></a>';
			}

		echo '</div>';
		/* After widget (defined by themes). */
		echo balanceTags($after_widget);
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['ad'] = $new_instance['ad'];
		$instance['link'] = $new_instance['link'];

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'subtitle' => '',
		'subtitle_link' => '',
		'ad' => get_template_directory_uri()."/images/300x250.gif",
		'link' => 'http://www.different-themes.com',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr__($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', THEME_NAME) ?></label>
			<input class="widefat" id="<?php echo esc_attr__($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr__($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr__($instance['title']); ?>" />
		</p>
		<!-- Ad image url: Text Input -->
		<p>
			<label for="<?php echo esc_attr__($this->get_field_id( 'ad' )); ?>"><?php esc_html_e('Ad image url:', THEME_NAME) ?></label>
			<input class="widefat" id="<?php echo esc_attr__($this->get_field_id( 'ad' )); ?>" name="<?php echo esc_attr__($this->get_field_name( 'ad' )); ?>" value="<?php echo esc_attr__($instance['ad']); ?>" />
		</p>
		
		<!-- Ad link url: Text Input -->
		<p>
			<label for="<?php echo esc_attr__($this->get_field_id( 'link' )); ?>"><?php esc_html_e('Ad link url:', THEME_NAME) ?></label>
			<input class="widefat" id="<?php echo esc_attr__($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr__($this->get_field_name( 'link' )); ?>" value="<?php echo esc_attr__($instance['link']); ?>" />
		</p>
		
	<?php
	}
}
?>