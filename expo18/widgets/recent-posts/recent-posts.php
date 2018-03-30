<?php

function om_widget_recent_posts_init() {
	register_widget( 'om_widget_recent_posts' );
}
add_action( 'widgets_init', 'om_widget_recent_posts_init' );

/* Widget Class */

class om_widget_recent_posts extends WP_Widget {

	function __construct() {
	
		parent::__construct(
			'om_widget_recent_posts',
			__('Custom Recent Posts','om_theme'),
			array(
				'classname' => 'om_widget_recent_posts',
				'description' => __('The most recent posts on your site with or without thumbnails', 'om_theme')
			)
		);
	}

	/* Front-end display of widget. */
		
	function widget( $args, $instance ) {
		extract( $args );
	
		$title = apply_filters('widget_title', $instance['title'] );
		$instance['postcount'] = intval($instance['postcount']);
	
		echo $before_widget;
	
		if ( $title )
			echo $before_title . $title . $after_title;
	
		$args=array(
			'posts_per_page' => $instance['postcount'],
			'ignore_sticky_posts' => 1,
			'tax_query' => array(
				array (
				    'taxonomy' => 'post_format',
				    'field' => 'slug',
				    'terms' => array( 'post-format-aside', 'post-format-link', 'post-format-quote' ),
				    'operator' => 'NOT IN'
				),
			)
		);
		if($instance['category'] != 0)
			$args['category__in']=array($instance['category']);
		$query = new WP_Query($args);
		
    if ($query->have_posts()) {
    	echo '<ul class="posts-list-small">';
    	
    	while ($query->have_posts()) {
    		$query->the_post();
				?>
					<li>
						<?php if($instance['show_thumb'] == 'true' && has_post_thumbnail()) { ?>
							<div class="pic"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
						<?php } ?>
						<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
						<div class="text text-content">
							<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<?php the_excerpt(); ?>
						</div>
						<div class="clear"></div>
					</li>
				<?php
      }
      echo '</ul>';
    }
	
		wp_reset_query();
	
		echo $after_widget;
	
	}


	/* Sanitize widget form values as they are saved. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		$instance['title'] = strip_tags( $new_instance['title'] );
	
		$instance['postcount'] = $new_instance['postcount'];
		$instance['category'] = $new_instance['category'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['thumb_pos'] = $new_instance['thumb_pos'];
			
		return $instance;
	}


	/* Back-end widget form. */
		 
	function form( $instance ) {
	
		// Set up some default widget settings
		$defaults = array(
			'title' => 'Recent Posts',
			'postcount' => '2',
			'category' => 0,
			'show_thumb' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'om_theme') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of posts', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>

		<!-- Category: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Posts category:', 'om_theme') ?></label>
			<?php
				$args = array(
					'show_option_all'    => __('All Categories', 'om_theme'),
					'show_option_none'   => __('No Categories', 'om_theme'),
					'hide_empty'         => 0, 
					'echo'               => 1,
					'selected'           => $instance['category'],
					'hierarchical'       => 0, 
					'name'               => $this->get_field_name( 'category' ),
					'id'         		     => $this->get_field_id( 'category' ),
					'class'              => 'widefat',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'category',
					'hide_if_empty'      => false 	
				);
		
				wp_dropdown_categories( $args );

			?>
			<?php/*<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
				<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
				<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
			</select>*/?>
		</p>
		
		<!-- Show Thumb: Check Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e('Show thumbnails', 'om_theme') ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" value="true" <?php if( $instance['show_thumb'] == 'true') echo 'checked="checked"'; ?> />
		</p>
		
					
	<?php
	}
}
?>