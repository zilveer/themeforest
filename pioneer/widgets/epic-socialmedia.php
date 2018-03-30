<?php
/**
 * Plugin Name: Epic Socialize
 * Plugin URI: http://epicthemes.net
 * Description: Displays icons and links to social media.
 * Version: 1.0
 * Author: Epic Media Labs Ltd.
 * Author URI: http://epicmedialab.com 
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'epic_portfolio_load_widgets' );

/**
 * Register our widget.
 * 'epic_Latestposts_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function epic_portfolio_load_widgets() {
	register_widget( 'Epic_Socialmedia_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Epic_Socialmedia_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Epic_Socialmedia_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'epic', 'description' => __('Displays social media icons and links that have been inserted in epic options', 'epic') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 240, 'height' => 350, 'id_base' => 'epic-socialmedia-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'epic-socialmedia-widget', __('Epic - Socialize', 'epic'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$mypages = $instance['mypages'];
		
		echo $before_widget;
		
		if($title != ''){
		echo $before_title;
		echo $title;
		echo $after_title;
		}
		
		

		/* Before widget (defined by themes). */
		
		
		// SOCIABLES - PULLED FROM THEME ADMIN
		
		$smi_image_1=get_option('epic_smi_image_1');
		$smi_url_1=get_option('epic_smi_url_1');
		$smi_text_1=get_option('epic_smi_text_1');

		$smi_image_2=get_option('epic_smi_image_2');
		$smi_url_2=get_option('epic_smi_url_2');
		$smi_text_2=get_option('epic_smi_text_2');

		$smi_image_3=get_option('epic_smi_image_3');
		$smi_url_3=get_option('epic_smi_url_3');
		$smi_text_3=get_option('epic_smi_text_3');
		
		$smi_image_4=get_option('epic_smi_image_4');
		$smi_url_4=get_option('epic_smi_url_4');
		$smi_text_4=get_option('epic_smi_text_4');
		
		$smi_image_5=get_option('epic_smi_image_5');
		$smi_url_5=get_option('epic_smi_url_5');
		$smi_text_5=get_option('epic_smi_text_5');
		
		$smi_image_6=get_option('epic_smi_image_6');
		$smi_url_6=get_option('epic_smi_url_6');
		$smi_text_6=get_option('epic_smi_text_6');
		
		$smi_image_7=get_option('epic_smi_image_7');
		$smi_url_7=get_option('epic_smi_url_7');
		$smi_text_7=get_option('epic_smi_text_7');
		
		$smi_image_8=get_option('epic_smi_image_8');
		$smi_url_8=get_option('epic_smi_url_8');
		$smi_text_8=get_option('epic_smi_text_8');
		
		$smi_image_9=get_option('epic_smi_image_9');
		$smi_url_9=get_option('epic_smi_url_9');
		$smi_text_9=get_option('epic_smi_text_9');
		
		$smi_image_10=get_option('epic_smi_image_10');
		$smi_url_10=get_option('epic_smi_url_10');
		$smi_text_10=get_option('epic_smi_text_10');
		
		?>

		<ul class="epic_socialmedia">
				
			<?php if ($smi_image_1==true and $smi_url_1==true):?>
			<li><a href="<?php echo $smi_url_1;?>" title="<?php echo $smi_text_1;?>" rel="external"><img src="<?php echo $smi_image_1;?>" class="clearborder" alt="<?php echo $smi_text_1;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_2==true and $smi_url_2==true):?>
			<li><a href="<?php echo $smi_url_2;?>" title="<?php echo $smi_text_2;?>" rel="external"><img src="<?php echo $smi_image_2;?>" class="clearborder" alt="<?php echo $smi_text_2;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_3==true and $smi_url_3==true):?>
			<li><a href="<?php echo $smi_url_3;?>" title="<?php echo $smi_text_3;?>" rel="external"><img src="<?php echo $smi_image_3;?>" class="clearborder" alt="<?php echo $smi_text_3;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_4==true and $smi_url_4==true):?>
			<li><a href="<?php echo $smi_url_4;?>" title="<?php echo $smi_text_4;?>" rel="external"><img src="<?php echo $smi_image_4;?>" class="clearborder" alt="<?php echo $smi_text_4;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_5==true and $smi_url_5==true):?>
			<li><a href="<?php echo $smi_url_5;?>" title="<?php echo $smi_text_5;?>" rel="external"><img src="<?php echo $smi_image_5;?>" class="clearborder" alt="<?php echo $smi_text_5;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_6==true and $smi_url_6==true):?>
			<li><a href="<?php echo $smi_url_6;?>" title="<?php echo $smi_text_6;?>" rel="external"><img src="<?php echo $smi_image_6;?>" class="clearborder" alt="<?php echo $smi_text_6;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_7==true and $smi_url_7==true):?>
			<li><a href="<?php echo $smi_url_7;?>" title="<?php echo $smi_text_7;?>" rel="external"><img src="<?php echo $smi_image_7;?>" class="clearborder" alt="<?php echo $smi_text_7;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_8==true and $smi_url_8==true):?>
			<li><a href="<?php echo $smi_url_8;?>" title="<?php echo $smi_text_8;?>" rel="external"><img src="<?php echo $smi_image_8;?>" class="clearborder" alt="<?php echo $smi_text_8;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_9==true and $smi_url_9==true):?>
			<li><a href="<?php echo $smi_url_9;?>" title="<?php echo $smi_text_9;?>" rel="external"><img src="<?php echo $smi_image_9;?>" class="clearborder" alt="<?php echo $smi_text_9;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_10==true and $smi_url_10==true):?>
			<li><a href="<?php echo $smi_url_10;?>" title="<?php echo $smi_text_10;?>" rel="external"><img src="<?php echo $smi_image_10;?>" class="clearborder" alt="<?php echo $smi_text_10;?>" /></a></li>
			<?php endif;?>
				</ul>
				
				<?php	
		
		wp_reset_query();
  	   echo $after_widget;
		 }

	/**
	 * Update the widget settings.
	 */
		function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['mypages'] = $new_instance['mypages'];
		
					
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		
		$defaults = array( 'title' => __('Page title', 'epic') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
?>
<!-- Widget Title: Text Input -->
<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
						<?php _e('Title:', 'epic'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:200px;" />
</p>

			
			





<?php
	}
}

?>
