<?php
/*
-----------------------------------------------------------------------------------

	Plugin Name: CT Popular Posts Widget
	Plugin URI: http://www.color-theme.com
	Description: A widget that show popular posts( Specified by cat-id ).
	Version: 1.0
	Author: ZERGE
	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/



/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'ct_popular_post_widget' );

function ct_popular_post_widget() {
	register_widget( 'CT_Popular_Post' );
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Popular_Post extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CT_Popular_Post() {
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-popularpost-widget',
								'description'	=> __( 'A sidebar widget that shows popular posts' , 'color-theme-framework' )
					);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-popularpost-widget'
						);

		/* Create the widget. */
		parent::__construct( 'ct-popularpost-widget', __('CT: Popular Posts', 'color-theme-framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		
		global $wpdb, $period_posts;
		$time_id = rand();

		/* Our variables from the widget settings. */
		$title = apply_filters ('widget_title', $instance ['title']);
		$num_posts = $instance['num_posts'];
		$period_posts = $instance['period_posts'];
		$categories = $instance['categories'];
		$categories_exclude = $instance['categories_exclude'];
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$theme_orderby = $instance['theme_orderby'];
		$background_title = $instance['background_title'];
		$excerpt_lenght = $instance['excerpt_lenght'];
		$show_image = isset($instance['show_image']) ? '1' : '0';
		$show_views = isset($instance['show_views']) ? '1' : '0';
		$show_likes = isset($instance['show_likes']) ? '1' : '0';
		$show_date = isset($instance['show_date']) ? '1' : '0';
		$show_author = isset($instance['show_author']) ? '1' : '0';
		$show_comments = isset($instance['show_comments']) ? '1' : '0';
		$show_category = isset($instance['show_category']) ? '1' : '0';		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START POPULAR POSTS WIDGET -->\n";
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		} else {
			echo "\n<!-- START POPULAR POSTS WIDGET -->\n";
		}
		?>

		<?php 
		global $post;

		if ( $period_posts > 0 ) :
			// Create a new filtering function that will add our where clause to the query
		if ( !function_exists( 'ct_filter_where' ) ) {
			function ct_filter_where( $where = '' ) {
				global $period_posts;
				// posts in the last N days
				$ct_days = '-'.$period_posts.' days';
				$where .= " AND post_date > '" . date('Y-m-d', strtotime($ct_days)) . "'";
				return $where;
			}
		}

		if ( !function_exists( 'ct_filter_orderby' ) ) {
			function ct_filter_orderby( $orderby = '' ) {
				$orderby .= ", post_date DESC";
				return $orderby;
			}
		}
			add_filter('posts_orderby', 'ct_filter_orderby');
			add_filter( 'posts_where', 'ct_filter_where' );
		endif;

		if ( $show_related == 'true' ) { //show related category
			if ( is_category() ) :
				$current_category = single_cat_title('', false);
				$related_category_id = get_cat_ID($current_category);
			else :
				$related_category = get_the_category($post->ID);
				$related_category_id = get_cat_ID( $related_category[0]->cat_name );
			endif;			

			if ($theme_orderby == 'comments') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'orderby'		=> 'comment_count',
						'cat'			=> $related_category_id,
						'category__not_in'	=> $categories_exclude,
						'post__not_in'	=> array( $post->ID ),
						'ignore_sticky_posts'	=> 1
					));
			}
			else if ($theme_orderby == 'likes') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'votes_count',
						'cat'			=> $related_category_id,
						'category__not_in'	=> $categories_exclude,
						'post__not_in'	=> array( $post->ID ),
						'ignore_sticky_posts'	=> 1
					));
			}
			else if ($theme_orderby == 'views') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'post_views_count',
						'cat'			=> $related_category_id,
						'category__not_in'	=> $categories_exclude,
						'post__not_in'	=> array( $post->ID ),
						'ignore_sticky_posts'	=> 1
					));
				}}
		else { // show not related posts

			if ($theme_orderby == 'comments') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'cat'			=> $categories,
						'category__not_in'	=> $categories_exclude,
						'orderby'		=> 'comment_count',
						'ignore_sticky_posts'	=> 1
					));
				}
				else if ($theme_orderby == 'likes') {
					$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'cat'			=> $categories,
						'category__not_in'	=> $categories_exclude,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'votes_count',
						'ignore_sticky_posts'	=> 1
					));
				}
				else if ($theme_orderby == 'views') {
					$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'cat'			=> $categories,
						'category__not_in'	=> $categories_exclude,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'post_views_count',
						'ignore_sticky_posts'	=> 1
					));
				}
			}

		if ( $period_posts > 0 ) :
			remove_filter('posts_orderby', 'ct_filter_orderby');
			remove_filter( 'posts_where', 'ct_filter_where' );
		endif;
		?>

		<ul>
			<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
				<li class="clearfix">
					<?php
					if( $show_image ):
						if(has_post_thumbnail()):
							$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'carousel-thumb'); 
							if ( $image[1] == 360 && $image[2] == 203 ) : //if has generated thumb ?>
								<div class="entry-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" /></a>
							<?php 
							else : // else use standard 150x150 thumb
								$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
								<div class="entry-thumb">
									<a href='<?php the_permalink(); ?>' title='<?php the_title_attribute(); ?>'><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" /></a>
							<?php
							endif;


							if ( has_post_format ( 'video' ) ) :
								ct_get_video_icon();
							elseif ( has_post_format ( 'audio' ) ) :
								ct_get_audio_icon();
							endif; // has_post_format ?>

								</div><!-- .entry-thumb -->

						<?php endif; //has_post_thumbnail
					endif; //show_image ?>

					<h4 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __('Permalink to ','color-theme-framework') ) ); ?>"><?php the_title(); ?></a>
					</h4><!-- .entry-title -->

					<?php if ( $excerpt_lenght != 0 ) : ?>
						<div class="entry-content">
							<?php ct_get_post_excerpt($excerpt_lenght); ?>
						</div><!-- .entry-content -->
					<?php endif; ?>

					<div class="entry-meta clearfix ct-google-font">
						<?php if ( $show_views ) :
							ct_get_meta_views();
						endif;

						if ( $show_likes ) :
							ct_get_meta_likes();
						endif;

						if ( $show_date ) :
							ct_get_meta_date();
						endif;

						if ( $show_author ) :
							ct_get_meta_author();
						endif;

						if ( $show_comments and comments_open() ) :
							ct_get_meta_comments();
						endif;

						if ( $show_category ) :
							ct_get_meta_category();
						endif; ?>
					</div><!-- .entry-meta -->
				</li>	
			<?php endwhile; ?>
		</ul>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END POPULAR POSTS WIDGET -->\n";

		// Restor original Query & Post Data
		wp_reset_postdata();
		}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['period_posts'] = $new_instance['period_posts'];
		$instance['categories'] = $new_instance['categories'];
		$instance['categories_exclude'] = $new_instance['categories_exclude'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['theme_orderby'] = $new_instance['theme_orderby'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		$instance['excerpt_lenght'] = $new_instance['excerpt_lenght'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_views'] = $new_instance['show_views'];
		$instance['show_likes'] = $new_instance['show_likes'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_author'] = $new_instance['show_author'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_category'] = $new_instance['show_category'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'				=> __( 'Most Popular' , 'color-theme-framework' ),
							'num_posts'			=> 3,
							'period_posts'		=> 0,
							'categories'		=> 'all',
							'categories_exclude'	=> '',
							'show_related'		=> 'off',
							'theme_orderby'		=> 'comments',
							'background_title' 	=> '#32ad55',
							'excerpt_lenght' 	=> '0',
							'show_image'		=> 'on',
							'show_views'		=> 'on',
							'show_likes'		=> 'on',
							'show_date'			=> 'off',
							'show_author'		=> 'off',
							'show_comments'		=> 'off',
							'show_category'		=> 'off'
					);

		$instance = wp_parse_args((array) $instance, $defaults);
		$categories_exclude = $instance['categories_exclude'];
		$background_title = esc_attr($instance['background_title']); ?>

		<script type="text/javascript">
			//<![CDATA[
            jQuery(document).ready(function($) {  
                $('.ct-color-picker').wpColorPicker();  
            });  
			//]]>   
		</script>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts to display:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('period_posts'); ?>"><?php _e( 'Show popular posts from the last N days (default 0 - show all):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="0" max="999" class="widefat" id="<?php echo $this->get_field_id('period_posts'); ?>" name="<?php echo $this->get_field_name('period_posts'); ?>" value="<?php echo $instance['period_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_orderby' ); ?>"><?php _e('Order by:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_orderby' ); ?>" name="<?php echo $this->get_field_name( 'theme_orderby' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'comments' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>comments</option>
				<option <?php if ( 'likes' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>likes</option>
				<option <?php if ( 'views' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>views</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ( 'all' == $instance['categories'] ) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
				<?php foreach( $categories as $category ) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories_exclude'); ?>"><?php _e( 'Categories to exclude:' , 'color-theme-framework' ); ?></label> 
			<select size="5" multiple="multiple" id="<?php echo $this->get_field_id('categories_exclude'); ?>" name="<?php echo $this->get_field_name('categories_exclude'); ?>[]" class="widefat" style="width:100%;">
				<?php $cat = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($cat as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ( is_array( $categories_exclude ) && in_array( $category->term_id, $categories_exclude ) ) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('excerpt_lenght'); ?>"><?php _e( 'Length of post excerpt (chars):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="500" class="widefat" id="<?php echo $this->get_field_id('excerpt_lenght'); ?>" name="<?php echo $this->get_field_name('excerpt_lenght'); ?>" value="<?php echo $instance['excerpt_lenght']; ?>" />
		</p>

		<p style="margin-top: 20px;">
			<label style="font-weight: bold;"><?php _e( 'Post meta info' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show image' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_views'], 'on'); ?> id="<?php echo $this->get_field_id('show_views'); ?>" name="<?php echo $this->get_field_name('show_views'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_views'); ?>"><?php _e( 'Show views' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_likes'], 'on'); ?> id="<?php echo $this->get_field_id('show_likes'); ?>" name="<?php echo $this->get_field_name('show_likes'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_likes'); ?>"><?php _e( 'Show likes' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_author'], 'on'); ?> id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show author' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php _e( 'Show comments' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show category' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" />
		</p>

	<?php 
	}
}

?>