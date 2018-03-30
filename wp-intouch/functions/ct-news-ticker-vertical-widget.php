<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT News Ticker Vertical
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that display news/post from a specific category.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','ct_v_newsticker_widget');

function ct_v_newsticker_widget(){
		register_widget("CT_Vertical_Newsticker");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Vertical_Newsticker extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_Vertical_Newsticker(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname'	=> 'ct-v-newsticker-widget',
							 'description'	=> __( 'News Ticker Vertical' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array( 'width'		=> 255,
							  'height'		=> 350,
							  'id_base'		=> 'ct-v-newsticker-widget'
							);
		
		/* Create the widget. */
		parent::__construct( 'ct-v-newsticker-widget', __( 'CT: News Ticker Vertical' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		global $period_posts;

		if ( !is_admin() ) {
			/* Vertical News Ticker */
			wp_register_script('v-news-ticker',get_template_directory_uri().'/js/jquery.easy-ticker.min.js', false, null , true);
			wp_enqueue_script('v-news-ticker', array('jquery'));
		}

		$title = apply_filters ('widget_title', $instance ['title']);
		$categories = $instance['categories'];
		$num_posts = $instance['num_posts'];
		$period_posts = $instance['period_posts'];
		$news = $instance['news'];
		$speed = $instance['speed'];
		$interval = $instance['interval'];
		$min_height = $instance['min_height'];
		$show_meta = $instance['show_meta'];
		$theme_orderby = $instance['theme_orderby'];
		$show_date = isset($instance['show_date']) ? '1' : '0';
		$show_number = isset($instance['show_number']) ? '1' : '0';
		$show_popular = isset($instance['show_popular']) ? '1' : '0';
		$auto_height = isset($instance['auto_height']) ? '1' : '0';
		$background_title = $instance['background_title'];
		
		/* Before widget (defined by themes). */
		echo "\n<!-- START NEWS TICKER VERTICAL WIDGET -->\n";
		echo $before_widget;

		if ( $title ) :
			if ( $categories != 'all' ):
				$category_title_link = get_category_link( $categories );
				echo '<h3 class="widget-title" style="background:'.$background_title.';"><a href="'.$category_title_link.'" title="'.__('View all posts in ','color-theme-framework').$title.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			else :
				echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			endif;	
		endif;

		global $post;
		$time_id = rand();
		$i = 0;

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

		// SHOW POPULAR
		if ( $show_popular ) :
			if ($theme_orderby == 'comments') {
				$news_posts = new WP_Query( array(	'showposts'		=> $num_posts,
													'cat'			=> $categories,
													'orderby'		=> 'comment_count',
													'ignore_sticky_posts'	=> 1
												));
			}
			else if ($theme_orderby == 'likes') {
				$news_posts = new WP_Query( array(	'showposts'		=> $num_posts,
													'cat'			=> $categories,
													'orderby'		=> 'meta_value_num',
													'meta_key'		=> 'votes_count',
													'ignore_sticky_posts'	=> 1
												));
			}
			else {
				$news_posts = new WP_Query( array(	'showposts'		=> $num_posts,
													'cat'			=> $categories,
													'orderby'		=> 'meta_value_num',
													'meta_key'		=> 'post_views_count',
													'ignore_sticky_posts'	=> 1
												));
			}
		// SHOW RECENT
		else :
			$news_posts = new WP_Query( array(	'showposts'	=> $num_posts,
												'post_type'	=> 'post',
												'cat'		=> $categories,
												'ignore_sticky_posts'	=> 1
											));

		endif;

		if ( $period_posts > 0 ) :
			remove_filter('posts_orderby', 'ct_filter_orderby');
			remove_filter( 'posts_where', 'ct_filter_where' );
		endif;
		?>

		<script type="text/javascript">
		/* <![CDATA[ */
			jQuery.noConflict()(function($){
				"use strict";
				$(document).ready(function(){

					jQuery('#v-newsticker-<?php echo $time_id; ?>').easyTicker({
						direction: 'up',
						visible:<?php echo $news; ?>,
						speed:<?php echo $speed; ?>,
						interval:<?php echo $interval; ?>
					});

					$('.ct-v-newsticker-widget').css("max-height","inherit");

					<?php if ( !$auto_height ) : ?>
						$('#v-newsticker-<?php echo $time_id; ?>').css("max-height","<?php echo $min_height.'px'; ?>");
						$('#v-newsticker-<?php echo $time_id; ?>').css("min-height","<?php echo $min_height.'px'; ?>");
					<?php endif; ?>

				});
			});
		/* ]]> */
		</script>

		<div id="v-newsticker-<?php echo $time_id; ?>" class="no-translatez">
			<ul>
				<?php while($news_posts->have_posts()): $news_posts->the_post();
					$i++;
				?>
					<li class="ct-border-bottom clearfix">
						<?php if ($show_number) : ?>
							<div class="entry-thumb">
								<span class="circle-number"><?php echo $i; ?></span>
							</div><!-- .entry-thumb -->
						<?php endif; ?>

						<?php if ($show_number) : ?>
							<div class="entry-news">
						<?php else : ?>
							<div class="entry-news" style="padding-left: 0;">
						<?php endif; ?>
							<h4 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php echo the_title(); ?></a>
							</h4>

							<div class="entry-meta ct-google-font">
								<?php if ( $show_date ) : ?>
									<?php ct_get_meta_date(); ?>
								<?php endif; ?>

								<?php if ( ( $show_meta == 'comments' ) and comments_open() ) : ?>
									<span class="meta-comments">
										<?php comments_popup_link(__('no comments','color-theme-framework'),__('1 comment','color-theme-framework'),__('% comments','color-theme-framework')); ?>
									</span><!-- .meta-comments -->
								<?php elseif ( $show_meta == 'likes' )  : ?>
									<span class="meta-likes">
										<?php getPostLikeLink($post->ID); _e(' likes','color-theme-framework'); ?>
									</span><!-- .meta-likes -->
								<?php elseif ( $show_meta == 'views' )  : ?>
									<span class="meta-views">
										<?php echo getPostViews($post->ID).__(' views','color-theme-framework'); ?>
									</span><!-- .meta-views -->
								<?php elseif ( $show_meta == 'author' )  : ?>
									<?php
									$author = sprintf( '<span class="author vcard">%4$s<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
											esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
											esc_attr( sprintf( __( 'View all posts by %s', 'color-theme-framework' ), get_the_author() ) ),
											get_the_author(),
											''
									); ?>
									<span class="meta-author" title="<?php _e('Author','color-theme-framework'); ?>">
										<i class="icon-user"></i>
										<?php printf( $author ); ?>
									</span><!-- .meta-author -->
								<?php elseif ($show_meta == 'category')  : ?>
									<span class="meta-category">
										<i class="icon-tag"></i>
										<?php echo get_the_category_list(', '); ?>
									</span><!-- .meta-category -->
								<?php else : ?>
									<!-- no meta -->
								<?php endif; ?>
							</div><!-- .entry-meta -->
						</div><!-- .entry-news -->
					</li>
				<?php endwhile; ?>
			</ul>
		</div><!-- #v-newsticker -->

		<?php
		// Restore original Query & Post Data
		wp_reset_postdata();
	  
		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END NEWS TICKER VERTICAL WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['period_posts'] = $new_instance['period_posts'];
		$instance['news'] = $new_instance['news'];
		$instance['speed'] = $new_instance['speed'];
		$instance['interval'] = $new_instance['interval'];
		$instance['min_height'] = $new_instance['min_height'];
		$instance['theme_orderby'] = $new_instance['theme_orderby'];
		$instance['show_meta'] = $new_instance['show_meta'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_number'] = $new_instance['show_number'];
		$instance['show_popular'] = $new_instance['show_popular'];
		$instance['auto_height'] = $new_instance['auto_height'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
		$defaults = array(	'title'				=> __( 'Hot News', 'color-theme-framework' ), 
							'categories'		=> 'all', 
							'num_posts'			=> '10',
							'news'				=> '4',
							'speed'				=> '500',
							'interval'			=> '3000',
							'min_height'		=> '305',
							'background_title'	=> '#FF0000',
							'show_meta'			=> 'comments',
							'theme_orderby'		=> 'comments',
							'period_posts'		=> '0',
							'show_number'		=> 'on',
							'show_date'			=> 'on',
							'show_popular'		=> 'off',
							'auto_height'		=> 'on'
						);

			$instance = wp_parse_args((array) $instance, $defaults); 
			$background_title = esc_attr($instance['background_title']);
		?>

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
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_popular'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular'); ?>" name="<?php echo $this->get_field_name('show_popular'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_popular'); ?>"><?php _e( 'Show popular' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_orderby' ); ?>"><?php _e('Order popular posts by:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_orderby' ); ?>" name="<?php echo $this->get_field_name( 'theme_orderby' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'comments' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>comments</option>
				<option <?php if ( 'likes' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>likes</option>
				<option <?php if ( 'views' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>views</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('period_posts'); ?>"><?php _e( 'Show popular posts from the last N days (default 0 - show all):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="0" max="999" class="widefat" id="<?php echo $this->get_field_id('period_posts'); ?>" name="<?php echo $this->get_field_name('period_posts'); ?>" value="<?php echo $instance['period_posts']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of news to query:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('news'); ?>"><?php _e( 'Number of visible news:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="30" class="widefat" id="<?php echo $this->get_field_id('news'); ?>" name="<?php echo $this->get_field_name('news'); ?>" value="<?php echo $instance['news']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('min_height'); ?>"><?php _e( 'Min/Max Height of widget (px):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="500" class="widefat" id="<?php echo $this->get_field_id('min_height'); ?>" name="<?php echo $this->get_field_name('min_height'); ?>" value="<?php echo $instance['min_height']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['auto_height'], 'on'); ?> id="<?php echo $this->get_field_id('auto_height'); ?>" name="<?php echo $this->get_field_name('auto_height'); ?>" /> 
			<label for="<?php echo $this->get_field_id('auto_height'); ?>"><?php _e( 'Auto height' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Speed, in milliseconds:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100000" class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" value="<?php echo $instance['speed']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('interval'); ?>"><?php _e( 'Interval, in milliseconds:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100000" class="widefat" id="<?php echo $this->get_field_id('interval'); ?>" name="<?php echo $this->get_field_name('interval'); ?>" value="<?php echo $instance['interval']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_meta' ); ?>"><?php _e('Show meta:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'show_meta' ); ?>" name="<?php echo $this->get_field_name( 'show_meta' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'comments' == $instance['show_meta'] ) echo 'selected="selected"'; ?>>comments</option>
				<option <?php if ( 'likes' == $instance['show_meta'] ) echo 'selected="selected"'; ?>>likes</option>
				<option <?php if ( 'views' == $instance['show_meta'] ) echo 'selected="selected"'; ?>>views</option>
				<option <?php if ( 'author' == $instance['show_meta'] ) echo 'selected="selected"'; ?>>author</option>
				<option <?php if ( 'category' == $instance['show_meta'] ) echo 'selected="selected"'; ?>>category</option>
				<option <?php if ( 'none' == $instance['show_meta'] ) echo 'selected="selected"'; ?>>none</option>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_number'], 'on'); ?> id="<?php echo $this->get_field_id('show_number'); ?>" name="<?php echo $this->get_field_name('show_number'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_number'); ?>"><?php _e( 'Show numbers' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" />
		</p>

		<?php

	}
}
?>