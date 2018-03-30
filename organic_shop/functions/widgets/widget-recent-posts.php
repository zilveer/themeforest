<?php

// Widget Class
class qns_recent_posts_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_recent_posts_widget() {
		$widget_ops = array( 'classname' => 'recent_posts_widget', 'description' => __('Display Recent Posts', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 300, 'id_base' => 'recent_posts_widget' );
		parent::__construct( 'recent_posts_widget', __('Custom Recent Posts Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$post_limit = $instance['post_limit'];

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>

			<?php // Set News Limit
			if ( $instance['post_limit'] ) : 
				$news_limit = $instance['post_limit'];
			elseif ( !is_numeric ( $instance['post_limit'] ) )	:
				$news_limit = '3';
			else :
				$news_limit = '3';
			endif;
			?>
			
			<ul class="latest-posts-list clearfix">
			
			<?php // Begin News Query
			
			$args = array(
                'posts_per_page' => $news_limit,
                'ignore_sticky_posts' => 1,
                'post_type' => 'post',
                'order' => 'DESC',
                'orderby' => 'date'
            );
			
			$post_query = new WP_Query( $args );
			
			if( $post_query->have_posts() ) : while( $post_query->have_posts() ) : $post_query->the_post(); ?>
	
					<li class="clearfix">
						<div class="lpl-img">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark">
							
							<?php // Display Thumbnail
							if( has_post_thumbnail() ) :
								the_post_thumbnail( 'recent-posts-widget' );
							else :
								echo '<img src="' . get_template_directory_uri() . '/images/noimage2.png" alt="" />';
							endif; 
							?>

							</a>
						</div>
						<div class="lpl-content">
							<h6><a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a> <span> <?php _e('Posted','qns'); ?> <?php the_time('M d, Y'); ?> <?php _e('By', 'qns'); ?> <?php the_author(); ?></span></h6>
						</div>
					</li>	

				<?php endwhile; endif; ?>			
			
			</ul>
			
		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_limit'] = strip_tags( $new_instance['post_limit'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Recent Posts',
		'post_limit' => '3'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'post_limit' ); ?>"><?php _e('Post Limit:', 'qns') ?></label>
			<input type="text" size="3" id="<?php echo $this->get_field_id('post_limit'); ?>" name="<?php echo $this->get_field_name('post_limit'); ?>" value="<?php echo $instance['post_limit']; ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_recent_posts_widget' );

// Register Widget
function qns_recent_posts_widget() {
	register_widget( 'qns_recent_posts_widget' );
}