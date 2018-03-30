<?php

/*

Plugin Name: Testimonials
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display testimonials.
Version: 1.0
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'pr_widget_testimonials' );

/* Function that registers our widget. */
function pr_widget_testimonials() {
	register_widget( 'PR_Widget_Testimonials' );
}

// Widget class.
class PR_Widget_Testimonials extends WP_Widget {


	function PR_Widget_Testimonials() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'pr_widget_testimonials', 'description' => 'Display Testimonials' );

		/* Create the widget. */
		$this->WP_Widget( 'pr_widget_testimonials', '(C) Testimonials', $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		$order = $instance['order'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display name from widget settings. */
		?>
        
         <div class="testimonials"><?php
			query_posts('post_type=testimonials&orderby='.$order.'&order=ASC&posts_per_page='.$number); if (have_posts()) : while (have_posts()) : the_post();
			global $post;
			?>
			
			<div class="testimonial-holder">
				<div class="testimonial-content">
					<span class="testimonial-quote">,,</span>
					<?php echo get_post_meta($post->ID, 'testimonial_content', true); ?>
					<span class="testimonial-arrow"></span>
				</div>
				<div class="testimonial-author">
					<?php $company = get_post_meta($post->ID, 'company_name', true); ?>
					<span><?php echo get_post_meta($post->ID, 'testimonial_author', true); if($company) echo ", "; ?></span>
					<?php			
					if($company){
						echo '<a href="'.get_post_meta($post->ID, "company_url", true).'">'.$company.'</a>';
					}
					?>
				</div>
			</div>
				
			<?php endwhile; endif; wp_reset_query(); ?>
          </div>
                        	                            
                        
        <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['order'] = strip_tags( $new_instance['order'] );

		return $instance;
	}
	
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Testimonials', 'number' => '1', 'order' => 'rand' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>   
        
        <p>
        <label for="<?php echo $this->get_field_id('number'); ?>">Number of Testimonials:</label><br />
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id('order'); ?>">Order:</label><br />
        <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
        	<option value="rand" <?php if($instance['order'] !== "menu_order") echo "selected" ?>>Random</option>
            <option value="menu_order"<?php if($instance['order'] == "menu_order") echo "selected" ?>>Custom Order</option>
        </select>		
        </p>
        
        
        <?php
	}
}

	
