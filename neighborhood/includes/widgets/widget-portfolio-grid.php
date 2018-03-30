<?php

	/*
	*
	*	Custom Portfolio Widget
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	// Register widget
	add_action( 'widgets_init', 'init_sf_portfolio_grid' );
	function init_sf_portfolio_grid() { return register_widget('sf_portfolio_grid'); }
	
	class sf_portfolio_grid extends WP_Widget {
	
		function __construct() {
			parent::__construct( 'sf_custom_portfolio_grid', $name = 'Swift Framework Portfolio Grid' );
		}
	
		function widget( $args, $instance ) {
			global $post;
			extract($args);
	
			// Widget Options
			$title 	 = apply_filters('widget_title', $instance['title'] ); // Title		
			$number	 = $instance['number']; // Number of posts to show
			
			echo $before_widget;
			
		    if ( $title ) echo $before_title . $title . $after_title;
				
			$recent_portfolio = new WP_Query(
				array(
					'post_type' => 'portfolio',
					'posts_per_page' => $number
					)
			);
			
			$count = 0;
			
			if( $recent_portfolio->have_posts() ) : 
			
			?>
			
			<ul class="portfolio-grid">
				
				<?php while( $recent_portfolio->have_posts()) : $recent_portfolio->the_post();
				
				$post_title = get_the_title();
				$post_permalink = get_permalink();
				
				$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				foreach ($thumb_image as $detail_image) {
					$thumb_img_url = $detail_image['url'];
					break;
				}
				
				if (!$thumb_image) {
					$thumb_image = get_post_thumbnail_id();
					$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
				}
				
				$image = aq_resize( $thumb_img_url, 85, 85, true, false);
				?>
				<?php if ($image) { ?>
				<li class="grid-item-<?php echo $count; ?>">
					<a href="<?php echo $post_permalink; ?>" class="grid-image">
						<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $post_title; ?>" />
						<span class="tooltip"><?php echo $post_title; ?><span class="arrow"></span></span>
					</a>
				</li>
				<?php } ?>
				
				<?php $count++; wp_reset_query(); endwhile; ?>
			</ul>
				
			<?php endif; ?>			
			
			<?php
			
			echo $after_widget;
		}
	
		/* Widget control update */
		function update( $new_instance, $old_instance ) {
			$instance    = $old_instance;
				
			$instance['title']  = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags( $new_instance['number'] );
			return $instance;
		}
		
		/* Widget settings */
		function form( $instance ) {	
		
			    // Set defaults if instance doesn't already exist
			    if ( $instance ) {
					$title  = $instance['title'];
			        $number = $instance['number'];
			    } else {
				    // Defaults
					$title  = '';
			        $number = '6';
			    }
				
				// The widget form
				?>
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:' ); ?></label>
					<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('number'); ?>"><?php echo __( 'Number of items to show:' ); ?></label>
					<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
				</p>
		<?php 
		}
	
	}

?>