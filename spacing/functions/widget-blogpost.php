<?php

/*

Plugin Name: Recent Blog Posts
Plugin URI: http://themeforest.net/user/Tauris/
Description: The most recent posts on your site with an image.
Version: 1.1
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'pr_widget_blogpost' );

/* Function that registers our widget. */
function pr_widget_blogpost() {
	register_widget( 'PR_Widget_Blogpost' );
}

// Widget class.
class PR_Widget_Blogpost extends WP_Widget {


	function PR_Widget_Blogpost() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'pr_widget_blogpost', 'description' => 'The most recent posts on your site with an image.' );

		/* Create the widget. */
		$this->WP_Widget( 'pr_widget_blogpost', '(C) Recent Posts', $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display name from widget settings. */
		?>
        
        <ul id="widget"  class="widget-recent-posts">         
        	<?php query_posts('posts_per_page='.$number); if (have_posts()) : while (have_posts()) : the_post();	?>
            <li class="clearfix"> 
                <a class="rp-holder clearfix" href="<?php the_permalink(); ?>"> 
                	<div class="rp-thumbnail">
                    	<?php if(has_post_thumbnail()){ ?>
                    	<?php the_post_thumbnail(); ?>
                        <?php }else{ echo '<img src="'.get_template_directory_uri().'/img/no-thumb.png" alt>'; } ?>
                    </div>
                    <div class="rp-title"> 
                        <span><?php the_title(); ?></span>
                        <p class="classic-meta-section"><?php the_time('M d, Y'); ?></p>
                    </div> 
                </a> 
            </li> 
            <?php endwhile; endif; wp_reset_query(); ?>
         </ul>
                        	                            
                        
        <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}
	
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Recent Posts', 'number' => '4' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>   
        
        <p>
        <label for="<?php echo $this->get_field_id('number'); ?>">Number of posts to show:</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" />
        </p>
        
        
        <?php
	}
}

	
