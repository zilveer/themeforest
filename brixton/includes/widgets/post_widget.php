<?php
/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'category_select_post_widget' );
/* Function that registers our widget. */
function category_select_post_widget() {
	register_widget( 'category_select_posts' );
}
class category_select_posts extends WP_Widget {
	function category_select_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'category_select_posts', 'description' => 'Displays the post image and excerpt from a selected category' );
		/* Create the widget. */
		parent::__construct( 'category_select_posts-widget', 'Brixton - Premium Posts', $widget_ops, '' );
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
				
		if($instance['post'] != 'none'){
			$args = array(
						'showposts' => $number,
						'post_status' => 'publish',
						'p' => esc_attr($instance['post'] ),
						'post_type' => 'post',				
					);		
		
		}
	
		$pc = new WP_Query($args);
		echo $before_widget; 
		//display the posts title as a link
		if ($pc->have_posts()) : 
		
				if ( $title ) echo $before_title . $title . $after_title; 
		?>
		
		
		<?php  while ($pc->have_posts()) : $pc->the_post();  
		$postmeta = get_post_custom(get_the_id());
		?>
				
			
				
	
		<div class="widgett <?php if ( has_post_format( 'quote' , get_the_id())) echo 'quote-widget';?> <?php if ( has_post_format( 'link' , get_the_id())) echo 'link-widget';?>">		
			<?php if ( has_post_format( 'quote' , get_the_id())){ ?>
				<?php get_template_part('includes/boxes/loopBlogQuote'); ?>	
			<?php } ?>
			<?php if ( has_post_format( 'video' , get_the_id())) {?>
				
				<?php  
					if(!empty($postmeta["video_post_url"][0])) {
						$embed_code = wp_oembed_get(esc_url($postmeta["video_post_url"][0]));
						echo $embed_code ; ?>
					<div class="wttitle"><h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4></div>
					<?php if(!empty($instance['excerpt']) && !(has_post_format( 'link' , get_the_id()))) { ?>
					<div class="pmc-excerpt"><?php echo wp_trim_words(get_the_excerpt(), $instance['n_excerpt'],'...')  ?></div>
					<?php } 						
					}
				?>
			<?php }		
			if ( has_post_format( 'link' , get_the_id())) {
			$postmeta = get_post_custom(get_the_id()); 
			if(isset($postmeta["link_post_url"][0])){
				$link = $postmeta["link_post_url"][0];
			} else {
				$link = "#";
			}			
			?>
			<div class="link-category">
				<div class="blogpostcategory">
					<div class="topBlog">	
						<h2 class="title"><a href="<?php echo esc_url($link) ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					</div>			
					<?php if(pmc_getImage(get_the_id(), 'blog') != '') { ?>	

					<a class="overdefultlink" href="<?php echo esc_url($link) ?>">
					<div class="overdefult">
					</div>
					</a>

					<div class="blogimage">		
						<a href="<?php echo esc_url($link) ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo pmc_getImage(get_the_id(), 'blog'); ?></a>
					</div>
					<?php } ?>												
				</div>
			</div>
			
			<?php 
			} 				
			if ( !get_post_format() ) {
				$image=$comment_0=$comment_1=$comment_2= '';
				if ( has_post_thumbnail() ){
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
					$image = $image[0];}	
					?>			

					<div class="imgholder">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
							<?php if (has_post_thumbnail( get_the_ID() )) echo '<img src = "'.$image.'" alt = "'.get_the_title().'">' ?>		
						</a>
					</div>
					<div class="wttitle"><h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4></div>
					<?php if(!empty($instance['excerpt']) && !(has_post_format( 'link' , get_the_id()))) { ?>
					<div class="pmc-excerpt"><?php echo wp_trim_words(get_the_excerpt(), $instance['n_excerpt'],'...')  ?></div>
					<?php } ?>	
			<?php } ?>
		</div>	
			
		<?php  endwhile; ?>
	
		
		
		
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
		$instance['excerpt'] = $new_instance['excerpt'];	
		$instance['n_excerpt'] = $new_instance['n_excerpt'];		
		$instance['post'] = $new_instance['post'];		
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Post Widget', 'number' => 3, 'excerpt' => 0, 'n_excerpt' => 10,'post' => 'none','category' => '');
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
		<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['excerpt']); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>">Show excpert?</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id( 'n_excerpt' ); ?>">Number of words to show in excpert:</label>
			<input id="<?php echo $this->get_field_id( 'n_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'n_excerpt' ); ?>" value="<?php echo esc_attr($instance['n_excerpt']); ?>" size="3" />
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
		<p>
		<label for="<?php echo $this->get_field_id( 'post' ); ?>">Post to display</label>
		<select name="<?php echo $this->get_field_name( 'post' ); ?>" id="<?php echo $this->get_field_id( 'post' ); ?>"> <option <?php selected( $instance['post'], 'none'); ?>value="none">Display more then one post</option><?php global $post; $args = array( 'numberposts' => -1); $posts = get_posts($args); foreach( $posts as $post ) : setup_postdata($post); ?><option <?php selected( $instance['post'], $post->ID); ?>value="<? echo $post->ID; ?>"><?php the_title(); ?></option> <?php endforeach; ?> </select> 		
		</p>
		<p>
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
