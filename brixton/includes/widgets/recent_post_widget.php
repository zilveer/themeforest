<?php
/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'recent_post_widget' );
/* Function that registers our widget. */
function recent_post_widget() {
	register_widget( 'recent_posts' );
}
class recent_posts extends WP_Widget {
	function recent_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'recent_posts', 'description' => 'Displays the post image and title.' );
		/* Create the widget. */
		parent::__construct( 'recent_posts-widget','Brixton - Premium Recent Posts', $widget_ops, '' );
	}
	function widget( $args, $instance ) {
		global $pmc_data;
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		// to sure the number of posts displayed isn't negative or more than 10
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
		
		//the query that will get post from a specific category. 
		//Wr slug the category because you actualy need the slug and not the name
		$pc = new WP_Query(array('orderby'=>'date','post_type' => 'post' , 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 ,'tax_query' => array(
                    array(
                        'taxonomy' => 'post_format',
                        'field' => 'slug',
                        'terms' => array('post-format-link','post-format-quote'),
                        'operator' => 'NOT IN'
                    )
                )));
		echo $before_widget;
		//display the posts title as a link
		if ($pc->have_posts()) :  
		
				if ( $title ) echo $before_title . $title . $after_title; 
		?>
		
		
		<?php  while ($pc->have_posts()) : $pc->the_post();  
		if(!has_post_format( 'quote' , get_the_id()) && !has_post_format( 'link' , get_the_id())) {	?>
		<div class="widgett">		
    <?php
			$image=$comment_0=$comment_1=$comment_2= '';

		
		
	?>			<div class="imgholder">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
						<?php if (has_post_thumbnail( get_the_ID() )) echo pmc_getImage(get_the_id(),'widget') ;?>	
					</a>
				</div>
				<div class="wttitle"><h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4></div>
		</div>	
			
		<?php } endwhile; ?>
		
		
		
	<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
			endif;
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Recent Posts', 'number' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of posts to show:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
			<br /><small>(at most 10)</small>
		</p>
		<?php
	}
	function slug($string)
	{
		$slug = trim($string);
		$slug= preg_replace('/[^a-zA-Z0-9 -]/','', $slug); // only take alphanumerical characters, but keep the spaces and dashes too...
		$slug= str_replace(' ','-', $slug); // replace spaces by dashes
		$slug= strtolower($slug); // make it lowercase
		return $slug;
	}
}
?>
