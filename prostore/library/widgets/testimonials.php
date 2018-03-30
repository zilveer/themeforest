<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/widgets/testimonials.php
 * @file	 	1.0
 */
?>
<?php

// Widget class.
class Widget_Testimonials extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function Widget_Testimonials () {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_testimonials', 'description' => __('A widget that displays up to three testimonials.', 'prostore-theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget_testimonials' );

		/* Create the widget. */
		$this->WP_Widget( 'Widget_Testimonials', __('proStore - Testimonials', 'prostore-theme'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$name1 = $instance['name'] ;
		$company1 = $instance['company'] ;
		$site1 = $instance['site'] ;
		$image1 = $instance['image'] ;
		$desc1 = $instance['desc'] ;

		$name2 = $instance['name2'] ;
		$company2 = $instance['company2'] ;
		$site2 = $instance['site2'] ;
		$image2 = $instance['image2'] ;
		$desc2 = $instance['desc2'] ;

		$name3 = $instance['name3'] ;
		$company3 = $instance['company3'] ;
		$site3 = $instance['site3'] ;
		$image3 = $instance['image3'] ;
		$desc3 = $instance['desc3'] ;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?>
        <?php /* Display the widget title if one was input (before and after defined by themes). */
			if ( $title ) echo $before_title . $title . $after_title;
		?>
		<div class="flexslider">
			<ul class="slides">
               	<?php
               		for($i=1;$i<4;$i++) {
                		if(${'name'.$i} !='') {
                ?>
							<li>
		                    	<div class="row">
		                    		<div class="twelve columns entry-content">
		                    			 <blockquote><?php echo ${'desc'.$i}; ?></blockquote>
		                    		</div>
		                    		<div class="four columns mobile-one text-right">
		                    			<img src="<?php echo ${'image'.$i}; ?>" alt="<?php echo ${'name'.$i}; ?> from <?php echo ${'company'.$i}; ?>">
		                    		</div>
		                    		<div class="eight columns mobile-three">
		                    			<span class="testimonial-meta"><?php echo ${'name'.$i}; ?>, <a href="<?php echo ${'link'.$i}; ?>" title="<?php echo ${'company'.$i}; ?>"><?php echo ${'company'.$i}; ?></a></span>
		                    		</div>
		                    	</div>
		                       <div class="clear"></div>

		                    </li>
                <?php
                		}
                	}
                ?>


                </ul>
                </div>

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
		$instance['company'] = strip_tags( $new_instance['company'] );
		$instance['site'] = strip_tags( $new_instance['site'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );

		$instance['name2'] = strip_tags( $new_instance['name2'] );
		$instance['company2'] = strip_tags( $new_instance['company2'] );
		$instance['site2'] = strip_tags( $new_instance['site2'] );
		$instance['image2'] = strip_tags( $new_instance['image2'] );
		$instance['desc2'] = stripslashes( $new_instance['desc2'] );

		$instance['name3'] = strip_tags( $new_instance['name3'] );
		$instance['company3'] = strip_tags( $new_instance['company3'] );
		$instance['site3'] = strip_tags( $new_instance['site3'] );
		$instance['image3'] = strip_tags( $new_instance['image3'] );
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
		'company' => '',
		'site' => '',
		'image' => get_template_directory_uri().'/img/avatar.png',
		'desc' => '',

		'name2' => '',
		'company2' => '',
		'site2' => '',
		'image2' => get_template_directory_uri().'/img/avatar.png',
		'desc2' => '',

		'name3' => '',
		'company3' => '',
		'site3' => '',
		'image3' => get_template_directory_uri().'/img/avatar.png',
		'desc3' => '',


		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p><!-- Widget Title: Text Input -->
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'prostore-theme') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

    <br>
	<p><strong>Testimonial 1 here:</strong></p>

        <p><!-- Name 1: Text Input -->
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Name:', 'prostore-theme') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" />
		</p>

        <p><!-- Company 1: Text Input -->
        	<label for="<?php echo $this->get_field_id( 'company' ); ?>"><?php _e('Company:', 'prostore-theme') ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id( 'company' ); ?>" name="<?php echo $this->get_field_name( 'company' ); ?>" value="<?php echo $instance['company']; ?>" />
        </p>

        <p><!-- Website 1: Text Input -->
			<label for="<?php echo $this->get_field_id( 'site' ); ?>"><?php _e('Company Website:', 'prostore-theme') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'site' ); ?>" name="<?php echo $this->get_field_name( 'site' ); ?>" value="<?php echo $instance['site']; ?>" />
		</p>

        <p><!-- Image 1: Text Input (HTML Link) -->
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image URL (30 x 30px):', 'prostore-theme') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
		</p>

        <p><!-- Testimonial 1: Text Input -->
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Testimonial (15-25 words suggested):', 'prostore-theme') ?></label>
		 	<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
		</p>

		<br>
   		<p><strong>Testimonial 2 here:</strong></p>

        <p><!-- Name 2: Text Input -->
    		<label for="<?php echo $this->get_field_id( 'name2' ); ?>"><?php _e('Name:', 'prostore-theme') ?></label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'name2' ); ?>" name="<?php echo $this->get_field_name( 'name2' ); ?>" value="<?php echo $instance['name2']; ?>" />
    	</p>

        <p><!-- Company 2: Text Input -->
        	<label for="<?php echo $this->get_field_id( 'company2' ); ?>"><?php _e('Company:', 'prostore-theme') ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id( 'company2' ); ?>" name="<?php echo $this->get_field_name( 'company2' ); ?>" value="<?php echo $instance['company2']; ?>" />
        </p>

        <p><!-- Website 2: Text Input -->
    		<label for="<?php echo $this->get_field_id( 'site2' ); ?>"><?php _e('Company Website:', 'prostore-theme') ?></label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'site2' ); ?>" name="<?php echo $this->get_field_name( 'site2' ); ?>" value="<?php echo $instance['site2']; ?>" />
    	</p>

        <p><!-- Image 2: Text Input (HTML Link) -->
    		<label for="<?php echo $this->get_field_id( 'image2' ); ?>"><?php _e('Image URL (30 x 30px):', 'prostore-theme') ?></label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" value="<?php echo $instance['image2']; ?>" />
    	</p>

        <p><!-- Testimonail: Text Input -->
    		<label for="<?php echo $this->get_field_id( 'desc2' ); ?>"><?php _e('Testimonial (15-25 words suggested):', 'prostore-theme') ?></label>
    	 	<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc2' ); ?>" name="<?php echo $this->get_field_name( 'desc2' ); ?>"><?php echo $instance['desc2']; ?></textarea>
    	</p>

     <br>
     <p><strong>Testimonial 3 here:</strong></p>

         <p><!-- Name 2: Text Input -->
     		<label for="<?php echo $this->get_field_id( 'name3' ); ?>"><?php _e('Name:', 'prostore-theme') ?></label>
     		<input class="widefat" id="<?php echo $this->get_field_id( 'name3' ); ?>" name="<?php echo $this->get_field_name( 'name3' ); ?>" value="<?php echo $instance['name3']; ?>" />
     	</p>

         <p><!-- Company 2: Text Input -->
         	<label for="<?php echo $this->get_field_id( 'company3' ); ?>"><?php _e('Company:', 'prostore-theme') ?></label>
         	<input class="widefat" id="<?php echo $this->get_field_id( 'company3' ); ?>" name="<?php echo $this->get_field_name( 'company3' ); ?>" value="<?php echo $instance['company3']; ?>" />
         </p>

         <p><!-- Website 2: Text Input -->
     		<label for="<?php echo $this->get_field_id( 'site3' ); ?>"><?php _e('Company Website:', 'prostore-theme') ?></label>
     		<input class="widefat" id="<?php echo $this->get_field_id( 'site3' ); ?>" name="<?php echo $this->get_field_name( 'site3' ); ?>" value="<?php echo $instance['site3']; ?>" />
     	</p>

         <p><!-- Image 2: Text Input (HTML Link) -->
     		<label for="<?php echo $this->get_field_id( 'image3' ); ?>"><?php _e('Image URL (30 x 30px):', 'prostore-theme') ?></label>
     		<input class="widefat" id="<?php echo $this->get_field_id( 'image3' ); ?>" name="<?php echo $this->get_field_name( 'image3' ); ?>" value="<?php echo $instance['image3']; ?>" />
     	</p>

         <p><!-- Testimonail: Text Input -->
     		<label for="<?php echo $this->get_field_id( 'desc3' ); ?>"><?php _e('Testimonial (15-25 words suggested):', 'prostore-theme') ?></label>
     	 	<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc3' ); ?>" name="<?php echo $this->get_field_name( 'desc3' ); ?>"><?php echo $instance['desc3']; ?></textarea>
     	</p>

	<?php
	}
}

register_widget( 'Widget_Testimonials' );