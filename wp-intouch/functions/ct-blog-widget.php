<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Blog Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent posts as Blog.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','ct_blog_widget');


function ct_blog_widget(){
		register_widget("CT_Blog_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Blog_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_Blog_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array(	'classname'		=> 'ct-blog-widget',
								'description'	=> __( 'Blog Widget' , 'color-theme-framework' )
						);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-blog-widget'
							);

		/* Create the widget. */
		parent::__construct( 'ct-blog-widget', __( 'CT: Blog Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);	

		global $ct_options, $post, $wp_query, $query, $paged;

		$ct_num_blog_posts = $instance['ct_num_blog_posts'];

		$title = apply_filters ('widget_title', $instance ['title']);
		$title_url = $instance['title_url'];
		$categories = $instance['categories'];
		$categories_exclude = $instance['categories_exclude'];
		$pagination_type = $instance['pagination_type'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_likes = isset($instance['show_likes']) ? '1' : '0';
		$show_comments = isset($instance['show_comments']) ? '1' : '0';
		$show_views = isset($instance['show_views']) ? '1' : '0';
		$show_date = isset($instance['show_date']) ? '1' : '0';
		$show_category = isset($instance['show_category']) ? '1' : '0';
		$show_author = isset($instance['show_author']) ? '1' : '0';
		$show_share = isset($instance['show_share']) ? '1' : '0';
		$show_readmore = isset($instance['show_readmore']) ? '1' : '0';
		$excerpt_lenght = $instance['excerpt_lenght'];
		$background_title = $instance['background_title'];
		$show_iframe = isset($instance['show_iframe']) ? '1' : '0';

		// Get number of posts to display from Theme Options
		$blog_num_posts = stripslashes( $ct_options['ct_blog_num_posts'] );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START BLOG WIDGET -->\n";
			if ( !empty($title_url) ) :
					echo '<h3 class="widget-title" style="background:'.$background_title.';"><a title="'.__('Read the Blog','color-theme-framework').'" href="'.$title_url.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
				else :
					echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
				endif;
		} else {
			echo "\n<!-- START BLOG WIDGET -->\n";
		}
				
		?>

		<?php

		if ( get_query_var('paged') ) {
      		$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
	  		$paged = get_query_var('page');
		} else {
	  		$paged = 1;
		}

		$recent_posts = new WP_Query(array(	'posts_per_page'		=> $blog_num_posts,
											'paged'					=> $paged,
											'post_type'				=> 'post',
											'post_status'			=> 'publish',
											'cat'					=> $categories,
											'category__not_in'		=> $categories_exclude
									));

		$max = 0;
		//$count_posts = wp_count_posts();
		//$ct_post_count = $count_posts->publish;
		$ct_post_count = $recent_posts->found_posts;
		$max = ceil ($ct_post_count / $blog_num_posts);


		if ( !function_exists( 'ct_blog_pagination' ) ) {
    		function ct_blog_pagination($pages = '', $range = 2)
    		{  
        		$showitems = ($range * 2)+1;  
 
		        global $paged;
		        if(empty($paged)) $paged = 1;

		        if($pages == '')
			    {
		            global $wp_query;
            		$pages = $wp_query->max_num_pages;
            		if(!$pages)
            		{
                		$pages = 1;
            		}
        		}   
 
		if(1 != $pages)
		{
			echo "<div class=\"pagination clearfix\" role=\"navigation\"><span>".__('Page ','color-theme-framework').$paged." ".__('of','color-theme-framework')." ".$pages."</span>";

			if (is_rtl()) {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-right\"></i> ".__('First','color-theme-framework')."</a>";
			} else {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-left\"></i> ".__('First','color-theme-framework')."</a>";
			}


			if (is_rtl()) {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-right\"></i> ".__('Previous','color-theme-framework')."</a>";
			} else {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-left\"></i> ".__('Previous','color-theme-framework')."</a>";
			}
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if (is_rtl()) {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-left\"></i></a>";  
			} else {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-right\"></i></a>";
			}

			if (is_rtl()) {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-left\"></i></a>";
			} else {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-right\"></i></a>";
			}

			echo "</div>\n";
		}
    }
}


		// Check if Load More Button
		if ( $pagination_type == 'load_more' ) :
 			wp_enqueue_script(
	 			'pbd-alp-load-posts',
 				get_template_directory_uri() . '/js/load-posts.js',
 				array('jquery'),
 				'1.0',
 				true
 			);

 			// Add some parameters for the JS.
 			wp_localize_script(
	 			'pbd-alp-load-posts',
 				'pbd_alp',
 				array(
	 				'startPage' => $paged,
 					'maxPages' => $max,
 					'nextLink' => next_posts($max, false)
 				)
 			);

 			/* Localization JS */
    		$ct_blog_array = array(	'show_more'			=> __('Show More Posts', 'color-theme-framework'),
									'loading_posts' 	=> __('Loading Posts...', 'color-theme-framework'),
									'no_posts' 			=> __('No More Posts to Show', 'color-theme-framework')
							);
			wp_localize_script( 'pbd-alp-load-posts', 'ct_blog_localization', $ct_blog_array );
		endif;
		?>


		<!-- START #ENTRY-BLOG -->
		<div id="entry-blog">

		<?php if ( $recent_posts->have_posts() ) : while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
			<?php
			// Retrieve the color of category
			//$category = get_the_category(); 
			//$cat_color = ct_get_color($category[0]->term_id);
			//if ( $cat_color == '') { $cat_color = '#000'; }

			//Get post type: standard post or review
			//$post_type = get_post_meta($post->ID, 'ct_mb_post_type', true);
			//if( $post_type == '' ) $post_type = 'standard_post';
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  >

				<?php 
				// if post has Feature image
				if(has_post_thumbnail()) : ?>
					<div class="entry-thumb">
						<?php
						if ( has_post_format ( 'video' ) ) :
							if ( $show_iframe ) :
								ct_get_video_player();
							else :
								echo ct_get_big_thumb();
								ct_get_video_icon();
							endif;
						elseif ( has_post_format ( 'audio' ) ) :
							if ( $show_iframe ) :
								ct_get_audio_player();
							else :
								echo ct_get_big_thumb();
								ct_get_audio_icon();
							endif;
	    				else:
	    					echo ct_get_big_thumb(); ?>
	    				<?php endif; ?>
					</div><!-- .entry-thumb -->
				<?php endif; //has_post_thumbnail ?>

				<h4 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
				</h4><!-- .entry-title -->

				<?php if ( $excerpt_lenght != 0 ) : ?>
					<div class="entry-content">
						<?php ct_get_post_excerpt($excerpt_lenght); //$post_excerpt = get_the_excerpt(); echo strip_tags(mb_substr($post_excerpt, 0, $excerpt_lenght ) ) . ' ...'; ?>
					</div><!-- .entry-content -->
				<?php endif; ?>

				<div class="entry-meta clearfix ct-google-font">
					<?php if ( $show_author ) :
						ct_get_meta_author();
					endif; ?>

					<?php if ( $show_views ) :
						ct_get_meta_views();
					endif; ?>

					<?php if ( $show_likes ) :
						ct_get_meta_likes();
					endif; ?>

					<?php if ( $show_date ) :
						ct_get_meta_date();
					endif; ?>

					<?php if ( $show_category ) :
						ct_get_meta_category();
					endif; ?>

					<?php if ( $show_comments and comments_open() ) :
						ct_get_meta_comments();
					endif; ?>

					<?php if ( $show_share ) :
						echo ct_get_meta_share();
					endif; ?>

					<?php if ( $show_readmore ) : ?>
						<div class="meta-readmore">
							<?php ct_get_readmore(); ?>
						</div><!-- .meta-readmore -->
					<?php endif; ?>
				</div><!-- .entry-meta -->
			</article> <!-- /post ID -->
		<?php endwhile; endif; ?>
		</div><!-- entry-blog -->
		

	    <!-- Begin Navigation -->
		<?php if ( $max > 1 ) : ?>
		  <div class="blog-navigation clearfix" role="navigation">
			<?php if(function_exists('ct_blog_pagination')) { ct_blog_pagination($max); } ?>
		  </div> <!-- blog-navigation -->
		<?php endif; ?>
		<!-- End Navigation -->

		<?php echo $after_widget; 

		// Restor original Query & Post Data
		wp_reset_postdata();

		$ct_ppp = '0';
		?>
		
<?php } 

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['ct_num_blog_posts'] = $new_instance['ct_num_blog_posts'];
		$instance['categories'] = $new_instance['categories'];
		$instance['categories_exclude'] = $new_instance['categories_exclude'];
		$instance['title'] = $new_instance['title'];
		$instance['title_url'] = strip_tags($new_instance['title_url']);
		$instance['pagination_type'] = $new_instance['pagination_type'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_likes'] = $new_instance['show_likes'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_views'] = $new_instance['show_views'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['show_author'] = $new_instance['show_author'];
		$instance['show_share'] = $new_instance['show_share'];
		$instance['show_readmore'] = $new_instance['show_readmore'];
		$instance['excerpt_lenght'] = $new_instance['excerpt_lenght'];		
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		$instance['show_iframe'] = $new_instance['show_iframe'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){ 

		global $ct_options;
		$blog_num_posts = stripslashes( $ct_options['ct_blog_num_posts'] );

		$defaults = array(	'title'					=> __( 'Latest Posts', 'color-theme-framework' ),
							'title_url'				=> '',
							'categories'			=> 'all',
							'categories_exclude'	=> '',
							'ct_num_blog_posts'		=> $blog_num_posts, 
							'pagination_type'		=> 'load_more',
							'show_image'			=> 'on', 
							'show_likes'			=> 'on',
							'show_comments'			=> 'off',
							'show_views'			=> 'off',
							'show_date'				=> 'on',
							'show_author'			=> 'on',
							'show_category'			=> 'off',
							'show_share'			=> 'on',
							'show_readmore'			=>	'on',
							'background_title'		=> '#ff0000',
							'excerpt_lenght'		=> '170',
							'show_iframe'			=> 'on'
						);

		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = esc_attr($instance['background_title']); 
		$categories_exclude = $instance['categories_exclude'];
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
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title_url'); ?>"><?php _e( 'URL for Title:' , 'color-theme-framework' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title_url'); ?>" name="<?php echo $this->get_field_name('title_url'); ?>" value="<?php echo $instance['title_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('ct_num_blog_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<br/><em>Specified in the Theme Options -> Blog Settings</em>
			<input disabled type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('ct_num_blog_posts'); ?>" name="<?php echo $this->get_field_name('ct_num_blog_posts'); ?>" value="<?php echo $instance['ct_num_blog_posts']; ?>" />
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
			<label for="<?php echo $this->get_field_id('categories_exclude'); ?>"><?php _e( 'Categories to exclude:' , 'color-theme-framework' ); ?></label> 
			<select size="5" multiple="multiple" id="<?php echo $this->get_field_id('categories_exclude'); ?>" name="<?php echo $this->get_field_name('categories_exclude'); ?>[]" class="widefat" style="width:100%;">
				<?php $cat = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($cat as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ( is_array( $categories_exclude ) && in_array( $category->term_id, $categories_exclude ) ) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_iframe'], 'on'); ?> id="<?php echo $this->get_field_id('show_iframe'); ?>" name="<?php echo $this->get_field_name('show_iframe'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_iframe'); ?>"><?php _e( 'Show iframe player for audio & video posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p style="margin-top: 20px;">
			<label style="font-weight: bold;"><?php _e( 'Post meta info' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_author'], 'on'); ?> id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show author' , 'color-theme-framework' ); ?></label>
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
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show category' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php _e( 'Show comments' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_share'], 'on'); ?> id="<?php echo $this->get_field_id('show_share'); ?>" name="<?php echo $this->get_field_name('show_share'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_share'); ?>"><?php _e( 'Show share' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_readmore'], 'on'); ?> id="<?php echo $this->get_field_id('show_readmore'); ?>" name="<?php echo $this->get_field_name('show_readmore'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_readmore'); ?>"><?php _e( 'Show read more' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'pagination_type' ); ?>"><?php _e('Type of Pagination:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'pagination_type' ); ?>" name="<?php echo $this->get_field_name( 'pagination_type' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'load_more' == $instance['pagination_type'] ) echo 'selected="selected"'; ?>>load_more</option>
				<option <?php if ( 'standard_numeric' == $instance['pagination_type'] ) echo 'selected="selected"'; ?>>standard_numeric</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('excerpt_lenght'); ?>"><?php _e( 'Length of post excerpt (chars):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="500" class="widefat" id="<?php echo $this->get_field_id('excerpt_lenght'); ?>" name="<?php echo $this->get_field_name('excerpt_lenght'); ?>" value="<?php echo $instance['excerpt_lenght']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Background Title color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#ff0000" />
		</p>

		<?php

	}
}
?>