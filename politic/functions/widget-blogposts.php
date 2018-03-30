<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Blog Widget
	Description: A widget that allows the display of blog posts.

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'icy_blog_widgets' );


// Register widget.
function icy_blog_widgets() {
	register_widget( 'icy_Blog_Widget' );
}

// Widget class.
class icy_blog_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function icy_Blog_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'icy_blog_widget', 'description' => __('A widget that displays your latest posts with a short excerpt.', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'icy_blog_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'icy_blog_widget', __('Custom Recent Posts Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>
			<div class="icy-blog-widget">
                
					<?php 
                    $query = new WP_Query();
                    $query->query( array(
                        'posts_per_page' => $number,
                        'ignore_sticky_posts' => 1,
                        ));
                    ?>

                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    
                    <article class="widget-blog-article">
                        
	                	<!-- BEGIN .entry-title -->		
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> 
								<?php the_title(); ?>
							</a>
						<!-- END .entry-title -->
						</h1>                        
                        
                        <div class="two columns alpha no-bottom">
	                        <?php /* if the post has a WP 2.9+ Thumbnail */
								if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
										
										<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('thumbnail-archive-small'); /* post thumbnail settings configured in functions.php */ ?>
										</a>
							<?php } ?>
						</div>
                        
                        <!--BEGIN .entry-content -->
                        <div class="entry-content four columns omega no-bottom">
                            <?php the_excerpt(); ?>
                        <!--END .entry-content -->
                        </div>

                        <!--BEGIN .entry-meta -->
                        <div class="entry-meta">
                        
								<p class="no-bottom"><?php _e('On', 'framework') ?> <?php the_time( get_option('date_format') ); ?>
	                            <?php _e('With', 'framework') ?> <?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?> <?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></p>                            
                        <!--END .entry-meta -->
                        </div>

                    </article>
				
                
                    <?php endwhile; endif; ?>
                    
                    <?php wp_reset_query(); ?>
                
            </div><!--blog_widget-->
		
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
		$instance['number'] = strip_tags( $new_instance['number'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Latest Posts.',
		
		'number' => 2
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Amount to show:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

	
	<?php
	}
}
?>