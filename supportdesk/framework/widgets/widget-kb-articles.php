<?php

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'st_kb_articles_widget' );


// Register widget.
function st_kb_articles_widget() {
	register_widget( 'st_kb_articles_widget' );
}

// Widget class.
class st_kb_articles_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function st_kb_articles_widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'st_kb_articles_widget', 'description' => __('A widget to display knowledge base articles', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'st_kb_articles_widget' );

		/* Create the widget. */
		parent::__construct( 'st_kb_articles_widget', __('Knowledge Base Articles', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$number = $instance['number'];
		$order = $instance['order'];	
		$order_by = (isset($instance['order_by']) ? $instance['order_by'] : null);

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;

				?>
                            
                <ul class="clearfix">
                
					<?php 
					if ($order_by == 'popularity') {
						$args = array( 
							'posts_per_page' => $number, 
							'post_type'  => 'st_kb',
							'orderby' => 'meta_value_num',
							'order'	=>	$order,
							'meta_key' => '_st_post_views_count'
						);
					} else  {
						$args = array( 
							'posts_per_page' => $number, 
							'post_type'  => 'st_kb',
							'orderby' => $order_by,
							'order'	=>	$order,
						);
					}
                    $query = new WP_Query($args);
					if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
                    <?php endwhile; endif; ?>
                    
                    <?php wp_reset_query(); ?>

                </ul>
		
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
		$instance['order'] = $new_instance['order'];
		$instance['order_by'] = $new_instance['order_by'];

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Knowledge Base Articles',
		'number' => 4,
		'order' => 'ASC',
		'order_by' => 'name'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of articles to show:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
        
        <p>

            
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Order:', 'framework') ?></label> 
			<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'ASC' == $instance['order'] ) echo 'selected="selected"'; ?>>ASC</option>
				<option <?php if ( 'DESC' == $instance['order'] ) echo 'selected="selected"'; ?>>DESC</option>
			</select>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'order_by' ); ?>"><?php _e('Order By:', 'framework') ?></label>
            <select id="<?php echo $this->get_field_id( 'order_by' ); ?>" name="<?php echo $this->get_field_name( 'order_by' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'name' == $instance['order_by'] ) echo 'selected="selected"'; ?>>name</option>
				<option <?php if ( 'date' == $instance['order_by'] ) echo 'selected="selected"'; ?>>date</option>
                <option <?php if ( 'rand' == $instance['order_by'] ) echo 'selected="selected"'; ?>>rand</option>
                <option <?php if ( 'popularity' == $instance['order_by'] ) echo 'selected="selected"'; ?>>popularity</option>
                <option <?php if ( 'comments' == $instance['order_by'] ) echo 'selected="selected"'; ?>>comment_count</option>
			</select>
		</p>

	
	<?php
	}
}
?>