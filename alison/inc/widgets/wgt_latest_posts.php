<?php

// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'widgets_init', 'gorilla_latest_news_load_widget' );

function gorilla_latest_news_load_widget() {
	register_widget( 'gorilla_latest_news_widget' );
}

class gorilla_latest_news_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'gorilla_latest_news_widget', // Base ID
			__( 'Alison - Latest Posts w/ Image', 'alison' ), // Name
			array(
				'description' => __( 'A widget that displays your latest posts w/ Image', 'alison' ), 
				'classname' => 'gorilla_latest_news_widget',
				'width' => 250,
		    	'height' => 350
			) 
		);
	}

	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		if(empty($instance)){
			$instance = array( 'title' => 'Hand Picked Posts', 'number' => 5, 'categories' => '');
		}

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$number = $instance['number'];

		
		// $query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories);
		
		$query = array(
		  'posts_per_page' => $number,
		  'nopaging' => 0,
		  'cat' => $categories,
		  'post_status' => 'publish',
		  'ignore_sticky_posts' => 1,
		  'tax_query' => array(
		    array(
		      'taxonomy' => 'post_format',
		      'field' => 'slug',
		      'terms' => array('post-format-link', 'post-format-quote' ),
		      'operator' => 'NOT IN'
		    )
		  )
		);

		$loop = new WP_Query($query);
		if ($loop->have_posts()) :

		global $post;
		
		/* Before widget (defined by themes). */
		echo wp_kses($before_widget, wp_kses_allowed_html( 'post' ));

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo wp_kses($before_title, wp_kses_allowed_html( 'post' )) . wp_kses($title, wp_kses_allowed_html( 'post' )) . wp_kses($after_title, wp_kses_allowed_html( 'post' ));

		?>
			<ul class="side-newsfeed">
			
			<?php  while ($loop->have_posts()) : $loop->the_post();

				$latest_posts_categories = get_the_category();
				$latest_posts_separator = ', ';
				$latest_posts_output = '';
				if($latest_posts_categories){
					foreach($latest_posts_categories as $latest_posts_category) {
						$latest_posts_output .= $latest_posts_category->cat_name.$latest_posts_separator;
					}
				}
				$post_id = $post->id;

			?>
			
				<li>
				
					<div class="side-item">
											
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
						<div class="side-image">
							<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
								<?php gorilla_format_icon($post_id); ?>
								<?php the_post_thumbnail('thumbnail-masonry', array('class' => 'side-item-thumb')); ?>

								<?php if($latest_posts_categories){ ?>
								<span class="side-item-category"><span class="side-item-category-inner"><?php echo trim($latest_posts_output, $latest_posts_separator); ?></span></span>
								<?php } ?>
							</a>
						</div>
						<?php endif; ?>
						<div class="side-item-text">
							<h4><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h4>
							<span class="side-item-meta"><?php the_time( get_option('date_format') ); ?></span>
						</div>
					</div>
				
				</li>
			
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			
			</ul>
			
		<?php

		/* After widget (defined by themes). */
		echo wp_kses($after_widget, wp_kses_allowed_html( 'post' ));
	}

	/**
	 * Update the widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}

	/**
	 * form in widget update area
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Hand Picked Posts', 'number' => 5, 'categories' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'alison'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  />
		</p>
		
		<!-- Category -->
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">Filter by Category:</label> 
		<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
			<option value='' <?php if ('' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
			<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
			<?php foreach($categories as $category) { ?>
			<option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Number of posts -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e('Number of posts to show:', 'alison'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
		</p>


	<?php
	}
}

?>