<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Testimonials
	Plugin URI: http://www.zenthemes.net
	Version: 1.0
	Author: Chris Paul
	Author URI: http://www.zenthemes.net

-----------------------------------------------------------------------------------*/

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'zen_testimonials_widgets' );

// Register widget.
function zen_testimonials_widgets() {
	register_widget( 'ZEN_Testimonials_Widget' );
}

// Widget class.
class zen_testimonials_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function ZEN_Testimonials_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'zen_testimonials_widget', 'description' => __('A widget that displays two testimonials.', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'zen_testimonials_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'zen_testimonials_widget', __('Custom Testimonials Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget 
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
	
		$name = $instance['name'];
		$desc = $instance['desc'];
		
		$name2 = $instance['name2'];
		$desc2 = $instance['desc2'];

		$name3 = $instance['name3'];
		$desc3 = $instance['desc3'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>

        <div class="testimonial-car-controls">
            <a class="testimonial-car-prev"><div class="work-car-prev-ico"></div></a>
            <a class="testimonial-car-next"><div class="work-car-next-ico"></div></a>
        </div>
			<div class="zen-testimonials">
                        
                <ul class="clearfix">
                
                    <li class="clearfix">
                        
                        <p>"<?php echo $desc; ?>"</p>

                        <div class="entry-meta">
                        
                            <span class="name"><?php echo $name; ?></span>

                        </div>
                        
                    </li>
                    
                    <?php if($name2 != '') : ?>
                    <li class="clearfix">
                                                
                        <p>"<?php echo $desc2; ?>"</p>
                        <div class="entry-meta">
                        
                            <span class="name"><?php echo $name2; ?></span>

                        </div>
                        
                    </li>
                    <?php endif; ?>

                    <?php if($name3 != '') : ?>
                    <li class="clearfix">
                                                
                        <p>"<?php echo $desc3; ?>"</p>
                        <div class="entry-meta">
                        
                            <span class="name"><?php echo $name3; ?></span>

                        </div>
                        
                    </li>
                    <?php endif; ?>
                
                </ul>
            
            </div><!--testimonials_wodget-->
		
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );
		
		$instance['name2'] = strip_tags( $new_instance['name2'] );
		$instance['desc2'] = stripslashes( $new_instance['desc2'] );

		$instance['name3'] = strip_tags( $new_instance['name3'] );
		$instance['desc3'] = stripslashes( $new_instance['desc3'] );

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
		
		'name' => '',
		'desc' => '',
		
		'name2' => '',
		'desc2' => '',
		
		'name3' => '',
		'desc3' => '',

		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
        <hr>
        
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('URL:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Name:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" />
		</p>
       
        <p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Text:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $instance['desc']; ?>" />
		</p>
        
       	<hr>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'name2' ); ?>"><?php _e('Name:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name2' ); ?>" name="<?php echo $this->get_field_name( 'name2' ); ?>" value="<?php echo $instance['name2']; ?>" />
		</p>
                
        <p>
			<label for="<?php echo $this->get_field_id( 'desc2' ); ?>"><?php _e('Text:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'desc2' ); ?>" name="<?php echo $this->get_field_name( 'desc2' ); ?>" value="<?php echo $instance['desc2']; ?>" />
		</p>

		<hr>
                
        <p>
			<label for="<?php echo $this->get_field_id( 'name3' ); ?>"><?php _e('Name:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name3' ); ?>" name="<?php echo $this->get_field_name( 'name3' ); ?>" value="<?php echo $instance['name3']; ?>" />
		</p>
                
        <p>
			<label for="<?php echo $this->get_field_id( 'desc3' ); ?>"><?php _e('Text:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'desc3' ); ?>" name="<?php echo $this->get_field_name( 'desc3' ); ?>" value="<?php echo $instance['desc3']; ?>" />
		</p>
	
	<?php
	}
}
?>