<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Campaign Builder Widget
	Plugin URI: http://www.icypixels.com/
	Version: 1.0
	Author: Paul | Icy Pixels
	Author URI: http://www.icypixels.com/

-----------------------------------------------------------------------------------*/

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'icy_campaignbuilder_widgets' );

// Register widget.
function icy_campaignbuilder_widgets() {
	register_widget( 'ICY_CampaignBuilder_Widget' );
}

// Widget class.
class icy_campaignbuilder_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function ICY_CampaignBuilder_Widget() {
		$widget_ops = array('classname' => 'widget_campaign_builder', 'description' => __('Drop in a big campaign widget which fits best in large areas (2/3 Homepage preferred).', 'framework'));

		$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'icy_campaignbuilder_widget');
		
		$this->WP_Widget( 'icy_campaignbuilder_widget', __('Custom Campaign Builder Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget 
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {

		extract($args);
		
		$title = apply_filters('widget_title', $instance['title'] );

		$title1 = $instance['action1title'];
		$icon1 = $instance['action1img'];
		$link1 = $instance['action1link'];
		
		$title2 = $instance['action2title'];
		$icon2 = $instance['action2img'];
		$link2 = $instance['action2link'];

		$title3 = $instance['action3title'];
		$icon3 = $instance['action3img'];
		$link3 = $instance['action3link'];

		$title4 = $instance['action4title'];
		$icon4 = $instance['action4img'];
		$link4 = $instance['action4link'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>
		
			<?php if(!empty ($link1) ) { ?>
				<a href="<?php echo $link1 ?>" title="<?php if(!empty($title1)) echo $title1 ?>"> 
					<div class="campaign-block">
						
							<?php if ( !empty( $icon1 ) ) { ?>

								<img src="<?php echo $icon1 ?>" alt="<?php echo $title1 ?>" />
							<?php } else { ?>

								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-volunteer.png" alt="<?php echo $title1; ?>"/>
							<?php } ?>
							<?php if ( !empty( $title1 ) ) { ?> 

								<h3><?php echo $title1; ?></h3> 
							<?php } ?>

					</div>	
				</a>
			<?php } else { ?>
				<div class="campaign-block">
				
					<?php if ( !empty( $icon1 ) ) { ?>

						<img src="<?php echo $icon1 ?>" alt="<?php echo $title1 ?>" />
					<?php } else { ?>

						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-volunteer.png" alt="<?php echo $title1; ?>"/>
					<?php } ?>
					<?php if ( !empty( $title1 ) ) { ?> 

						<h3><?php echo $title1; ?></h3> 
					<?php } ?>

				</div>	
			<?php } ?>
			
			<?php if(!empty ($link2) ) { ?>
				<a href="<?php echo $link2 ?>" title="<?php if(!empty($title2)) echo $title2 ?>"> 
					<div class="campaign-block">

							<?php if ( !empty( $icon2 ) ) { ?>

								<img src="<?php echo $icon2 ?>" alt="<?php echo $title2 ?>" />				
							<?php } else { ?>

								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-host.png" alt="<?php echo $title2; ?>"/>				
							<?php } ?>
							<?php if ( !empty( $title2 ) ) { ?> 

								<h3><?php echo $title2; ?></h3> 
							<?php } ?>

					</div>
				</a>
			<?php } else { ?>
				<div class="campaign-block">

						<?php if ( !empty( $icon2 ) ) { ?>

							<img src="<?php echo $icon2 ?>" alt="<?php echo $title2 ?>" />				
						<?php } else { ?>

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-host.png" alt="<?php echo $title2; ?>"/>				
						<?php } ?>
						<?php if ( !empty( $title2 ) ) { ?> 

							<h3><?php echo $title2; ?></h3> 
						<?php } ?>

				</div>
			<?php } ?>

			<?php if(!empty ($link3) ) { ?>
				<a href="<?php echo $link3 ?>" title="<?php if(!empty($title3)) echo $title3 ?>"> 
					<div class="campaign-block">

							<?php if ( !empty( $icon3 ) ) { ?>

								<img src="<?php echo $icon3 ?>" alt="<?php echo $title3 ?>" />				
							<?php } else { ?>

								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-attend.png" alt="<?php echo $title3; ?>"/>				
							<?php } ?>
							<?php if ( !empty( $title3 ) ) { ?> 

								<h3><?php echo $title3; ?></h3> 
							<?php } ?>

					</div>	
				</a>
			<?php } else { ?>
				<div class="campaign-block">

						<?php if ( !empty( $icon3 ) ) { ?>

							<img src="<?php echo $icon3 ?>" alt="<?php echo $title3 ?>" />				
						<?php } else { ?>

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-attend.png" alt="<?php echo $title3; ?>"/>				
						<?php } ?>
						<?php if ( !empty( $title3 ) ) { ?> 

							<h3><?php echo $title3; ?></h3> 
						<?php } ?>

				</div>				
			<?php } ?>

			<?php if(!empty ($link4) ) { ?>
				<a href="<?php echo $link4 ?>" title="<?php if(!empty($title4)) echo $title4 ?>"> 
					<div class="campaign-block">

							<?php if ( !empty( $icon4 ) ) { ?>

								<img src="<?php echo $icon4 ?>" alt="<?php echo $title4 ?>" />				
							<?php } else { ?>

								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-donate.png" alt="<?php echo $title4; ?>"/>			
							<?php } ?>
							<?php if ( !empty( $title4 ) ) { ?> 

								<h3><?php echo $title4; ?></h3> 
							<?php } ?>

					</div>
				</a>
			<?php } else { ?>
				<div class="campaign-block">

						<?php if ( !empty( $icon4 ) ) { ?>

							<img src="<?php echo $icon4 ?>" alt="<?php echo $title4 ?>" />				
						<?php } else { ?>

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/light/campaign-host.png" alt="<?php echo $title4; ?>"/>			
						<?php } ?>
						<?php if ( !empty( $title4 ) ) { ?> 

							<h3><?php echo $title4; ?></h3> 
						<?php } ?>

				</div>
			<?php } ?>	
		
		<?php

		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['action1title'] = strip_tags( $new_instance['action1title'] );
		$instance['action2title'] = strip_tags( $new_instance['action2title'] );
		$instance['action3title'] = strip_tags( $new_instance['action3title'] );
		$instance['action4title'] = strip_tags( $new_instance['action4title'] );

		$instance['action1link'] = strip_tags( $new_instance['action1link'] );
		$instance['action2link'] = strip_tags( $new_instance['action2link'] );
		$instance['action3link'] = strip_tags( $new_instance['action3link'] );
		$instance['action4link'] = strip_tags( $new_instance['action4link'] );

		$instance['action1img'] = strip_tags( $new_instance['action1img'] );
		$instance['action2img'] = strip_tags( $new_instance['action2img'] );
		$instance['action3img'] = strip_tags( $new_instance['action3img'] );
		$instance['action4img'] = strip_tags( $new_instance['action4img'] );
		/* No need to strip tags for.. */

		return $instance;

	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'action1title' => 'volunteer',
		'action2title' => 'host events', 
		'action3title' => 'attend event',
		'action4title' => 'donate',
		'action1link'  => '',
		'action2link'  => '',
		'action3link'  => '',
		'action4link'  => '',
		'action1img'   => '',
		'action2img'   => '', 
		'action3img'   => '',
		'action4img'   => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<hr />

		<!-- Widget Action 1 - Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action1title' ); ?>"><?php _e('Action 1 - Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action1title' ); ?>" name="<?php echo $this->get_field_name( 'action1title' ); ?>" value="<?php echo $instance['action1title']; ?>" />
		</p>

		<!-- Widget Action 1 - Link: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action1link' ); ?>"><?php _e('Action 1 - Link:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action1link' ); ?>" name="<?php echo $this->get_field_name( 'action1link' ); ?>" value="<?php echo $instance['action1link']; ?>" />
		</p>
    
       	<!-- Widget Action 1 - Image: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action1img' ); ?>"><?php _e('Action 1 - Image:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action1img' ); ?>" name="<?php echo $this->get_field_name( 'action1img' ); ?>" value="<?php echo $instance['action1img']; ?>" />
		</p>

		<hr />

		<!-- Widget Action 2 - Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action2title' ); ?>"><?php _e('Action 2 - Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action2title' ); ?>" name="<?php echo $this->get_field_name( 'action2title' ); ?>" value="<?php echo $instance['action2title']; ?>" />
		</p>

		<!-- Widget Action 2 - Link: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action2link' ); ?>"><?php _e('Action 2 - Link:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action2link' ); ?>" name="<?php echo $this->get_field_name( 'action2link' ); ?>" value="<?php echo $instance['action2link']; ?>" />
		</p>
    
       	<!-- Widget Action 2 - Image: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action2img' ); ?>"><?php _e('Action 2 - Image:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action2img' ); ?>" name="<?php echo $this->get_field_name( 'action2img' ); ?>" value="<?php echo $instance['action2img']; ?>" />
		</p>

		<hr />

		<!-- Widget Action 3 - Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action3title' ); ?>"><?php _e('Action 3 - Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action3title' ); ?>" name="<?php echo $this->get_field_name( 'action3title' ); ?>" value="<?php echo $instance['action3title']; ?>" />
		</p>

		<!-- Widget Action 3 - Link: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action3link' ); ?>"><?php _e('Action 3 - Link:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action3link' ); ?>" name="<?php echo $this->get_field_name( 'action3link' ); ?>" value="<?php echo $instance['action3link']; ?>" />
		</p>
    
       	<!-- Widget Action 3 - Image: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action3img' ); ?>"><?php _e('Action 3 - Image:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action3img' ); ?>" name="<?php echo $this->get_field_name( 'action3img' ); ?>" value="<?php echo $instance['action3img']; ?>" />
		</p>

		<hr />					
   
		<!-- Widget Action 4 - Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action4title' ); ?>"><?php _e('Action 4 - Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action4title' ); ?>" name="<?php echo $this->get_field_name( 'action4title' ); ?>" value="<?php echo $instance['action4title']; ?>" />
		</p>

		<!-- Widget Action 4 - Link: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action4link' ); ?>"><?php _e('Action 4 - Link:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action4link' ); ?>" name="<?php echo $this->get_field_name( 'action4link' ); ?>" value="<?php echo $instance['action4link']; ?>" />
		</p>
    
       	<!-- Widget Action 4 - Image: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action4img' ); ?>"><?php _e('Action 4 - Image:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'action4img' ); ?>" name="<?php echo $this->get_field_name( 'action4img' ); ?>" value="<?php echo $instance['action4img']; ?>" />
		</p>

		<hr />		   
	<?php
	}
}
?>