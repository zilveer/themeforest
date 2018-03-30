<?php
/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'category_select_slider_post_widget' );
/* Function that registers our widget. */
function category_select_slider_post_widget() {
	register_widget( 'category_select_slider_posts' );
}
class category_select_slider_posts extends WP_Widget {
	function category_select_slider_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'category_select_slider_posts', 'description' => 'Displays the post in slider from a selected category' );
		/* Create the widget. */
		parent::__construct( 'category_select_slider_posts-widget', 'Brixton - Premium Posts with slider', $widget_ops, '' );
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
		$args = array(
					'showposts' => $number,
					'post_status' => 'publish',
					'cat' => esc_attr($instance['category'] ),
					'post_type' => 'post',
					'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field'    => 'slug',						
							'terms'    => array( 'post-format-quote'),
							'operator' => 'NOT IN'
						)
					),					
				);
	
		$pc = new WP_Query($args);
	
		echo $before_widget; 
		//display the posts title as a link
		if ($pc->have_posts()) : 
		
		
				if ( $title ) echo $before_title . $title . $after_title; 
		?>
		<div class="<?php echo $this->id ?>" style="float:left;">
			<script>
			jQuery( document ).ready(function() {
				var width = jQuery('.<?php echo $this->id ?>').closest('.category_select_slider_posts').width();
				width = width / <?php echo $instance['slider'] ?>;
				jQuery('.bxslider-<?php echo $this->id; ?>').bxSlider({
					minSlides: <?php echo $instance['slider'] ?>,
					maxSlides: <?php echo $instance['slider'] ?>,
					slideWidth: width,
					easing : 'easeInOutQuint',
					prevText : '<i class="fa fa-chevron-left"></i>',
					nextText : '<i class="fa fa-chevron-right"></i>',
					pager :false,
					speed :800				
				});
			});
			</script>		
			<ul class="bxslider-<?php echo $this->id ?>">		
			<?php  while ($pc->have_posts()) : $pc->the_post();  ?>				
			<li>
				<div class="widgett">		
					<?php
					$image=$comment_0=$comment_1=$comment_2= '';
					if ( has_post_thumbnail() ){
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'widget', false);
						$image = $image[0];}	
					?>			
					<div class="imgholder">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
							<?php if (has_post_thumbnail( get_the_ID() )) echo pmc_getImage(get_the_id(),'widget') ;?>		
						</a>
					</div>
					<div class="wttitle"><h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4></div>
					<?php if(!empty($instance['excerpt']) && !(has_post_format( 'link' , get_the_id()))) { ?>
					<div class="pmc-excerpt"><?php echo wp_trim_words(get_the_excerpt(), $instance['n_excerpt'],'...')  ?></div>
					<?php } ?>
				</div>	
			</li>
				
			<?php  endwhile; ?>
			</ul>
		</div>

		
		
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
		$instance['category'] = $new_instance['category'];		
		$instance['slider'] = $new_instance['slider'];			
		$instance['excerpt'] = $new_instance['excerpt'];	
		$instance['n_excerpt'] = $new_instance['n_excerpt'];			
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Brixton Post slider', 'number' => 3, 'slider' => 2, 'excerpt' => 0, 'n_excerpt' => 10,'category' =>'');
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
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['excerpt'] ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>">Show excpert?</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id( 'n_excerpt' ); ?>">Number of words to show in excpert:</label>
			<input id="<?php echo $this->get_field_id( 'n_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'n_excerpt' ); ?>" value="<?php echo esc_attr($instance['n_excerpt']); ?>" size="3" />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'slider' ); ?>">Number of posts to show in slider:</label>
			<input id="<?php echo $this->get_field_id( 'slider' ); ?>" name="<?php echo $this->get_field_name( 'slider' ); ?>" value="<?php echo esc_attr($instance['slider']); ?>" size="3" />
			<br /><small>(at most 4 for fullwidth slider and 2 for smaller slider)</small>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Category to display</label>
			<?php $args = array(
							'name' => $this->get_field_name( 'category' ),
							'id' => $this->get_field_id( 'category' ),
							'selected' => esc_attr($instance['category'] ),
							'show_count' => 1,
							'value_field'	     => 'term_id'
						);
			?>
			<?php wp_dropdown_categories($args); ?>
			<br /><small>(select category to display)</small>
		</p>
		</p>
		<br /><small>Note: Quote post will not be displayed.</small>	
		<br />
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
