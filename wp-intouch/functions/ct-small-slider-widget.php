<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Small Flex Slider Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show slider with latest posts.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','ct_small_slider_widget');

function ct_small_slider_widget() {
		register_widget("CT_Small_Slider_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Small_Slider_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_Small_Slider_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array(	'classname'		=> 'ct-small-slider-widget',
								'description'	=> __( 'Small Flex Slider widget' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-small-slider-widget'
							);
		
		/* Create the widget. */
		parent::__construct( 'ct-small-slider-widget', __( 'CT: Small Slider Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		global $post;

		$title = $instance['title'];
		$categories = $instance['categories'];
		$categories_exclude = $instance['categories_exclude'];
		$num_posts = $instance['num_posts'];
		$num_query_posts = $instance['num_query_posts'];
		$excerpt_lenght = $instance['excerpt_lenght'];
		$show_views = isset($instance['show_views']) ? '1' : '0';
		$show_likes = isset($instance['show_likes']) ? '1' : '0';
		$show_date = isset($instance['show_date']) ? '1' : '0';
		$show_author = isset($instance['show_author']) ? '1' : '0';
		$show_comments = isset($instance['show_comments']) ? '1' : '0';
		$show_category = isset($instance['show_category']) ? '1' : '0';	
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$show_random = isset($instance['show_random']) ? 'true' : 'false';
		$animation_speed = $instance['animation_speed'];
		$slideshow_speed = $instance['slideshow_speed'];
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$animation_type = $instance['animation_type'];
		$background_title = $instance['background_title'];
		?>

		<?php

		echo "\n<!-- START SMALL SLIDER WIDGET -->\n";
		echo $before_widget;
		
		/* Before widget (defined by themes). */
		if ( $title ) :
			if ( $categories != 'all' ):
				$category_title_link = get_category_link( $categories );
				echo '<h3 class="widget-title" style="background:'.$background_title.';"><a href="'.$category_title_link.'" title="'.__('View all posts in ','color-theme-framework').$title.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			else :
				echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			endif;	
		endif;
		
		/* Display the widget title if one was input (before and after defined by themes). */ ?>
		
		<?php
		$time_id = rand();
		$orderby = 'date';
		if ( $show_random == 'true' ) { $orderby = 'rand'; }

		if ( $show_related == 'true' ) { //show related category
			$related_category = get_the_category($post->ID);
			$related_category_id = get_cat_ID( $related_category[0]->cat_name );
			$slider_posts = new WP_Query(array(	'orderby'			=> $orderby,
												'showposts'			=> $num_query_posts,
												'post_type'			=> 'post',
												'ignore_sticky_posts'	=> 1,
												'cat'				=> $related_category_id,
												'category__not_in'	=> $categories_exclude,
												'post__not_in'		=> array( $post->ID )
											));
		}

		else {	
			$slider_posts = new WP_Query(array(	'orderby'			=> $orderby,
												'showposts'			=> $num_query_posts,
												'post_type'			=> 'post',
												'ignore_sticky_posts'	=> 1,
												'cat'				=> $categories,
												'category__not_in'	=> $categories_exclude
											));
		}


		if ( $slider_posts->have_posts() ) :

			if ( !is_admin() ) {
				/* Flex Slider */
				wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
				wp_enqueue_script('flex-min-jquery',array('jquery'));
			} ?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery.noConflict()(function($){
			$(window).load(function() {

				$(".slider-preloader").css("display","none");

  	  			$('#slider-<?php echo $time_id; ?>').flexslider({
    				animation: "<?php echo $animation_type; ?>",
    				controlNav: false,
    				animationLoop: true,
    				slideshow: <?php echo $slideshow; ?>,
					smoothHeight: true,
					slideshowSpeed: <?php echo $slideshow_speed; ?>,
					animationSpeed: <?php echo $animation_speed; ?>,
  	  			});
			});
		});
		/* ]]> */
		</script>

		<!-- [InTouch] -->
		<div class="slider-preloader" style="text-align: center;"><img src="<?php echo get_template_directory_uri().'/img/slider_preloader.gif'; ?> " alt="preloader"></div>
		<div id="slider-<?php echo $time_id; ?>" class="flexslider flex-small-slider">
			<div class="slider-preloader"></div>
				<ul class="slides">
					<?php $num_post = 0; ?>
					<?php while($slider_posts->have_posts()): $slider_posts->the_post(); ?>
		  				<?php if( has_post_thumbnail() ): $num_post++; ?>
							<li>
								<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-thumb'); 
								if ( $image[1] == 560 && $image[2] == 316 ) : //if has generated thumb ?>
									<div class="entry-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" /></a>
								<?php else : // else use standard 150x150 thumb
									$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
									<div class="entry-thumb">
										<a href='<?php the_permalink(); ?>' title='<?php the_title_attribute(); ?>'><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" /></a>
								<?php endif;

								if ( has_post_format ( 'video' ) ) :
									ct_get_video_icon();
								elseif ( has_post_format ( 'audio' ) ) :
									ct_get_audio_icon();
								endif; // has_post_format ?>

								</div><!-- .entry-thumb -->

								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __('Permalink to ','color-theme-framework') ) ); ?>"><?php the_title(); ?></a>
								</h4><!-- .entry-title -->

								<?php if ( $excerpt_lenght != 0 ) : ?>
									<div class="entry-content">
										<?php ct_get_post_excerpt($excerpt_lenght); //$post_excerpt = get_the_excerpt(); echo strip_tags(mb_substr($post_excerpt, 0, $excerpt_lenght ) ) . ' ...'; ?>
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
						<?php endif; //has_post_thumbnail ?>
						<?php if ( $num_post == $num_posts ) : break; endif; ?>
					<?php endwhile; ?>
				</ul><!-- slides -->
			</div><!-- slider -->
		<?php
		else :
			echo __( 'No related posts were found','color-theme-framework' );
		endif;

	  	// Restor original Query & Post Data
	  	wp_reset_postdata();


		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END SMALL SLIDER WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['categories_exclude'] = $new_instance['categories_exclude'];
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['num_query_posts'] = $new_instance['num_query_posts'];
		$instance['excerpt_lenght'] = $new_instance['excerpt_lenght'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_views'] = $new_instance['show_views'];
		$instance['show_likes'] = $new_instance['show_likes'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_author'] = $new_instance['show_author'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['show_random'] = $new_instance['show_random'];
		$instance['animation_speed'] = $new_instance['animation_speed'];
		$instance['slideshow_speed'] = $new_instance['slideshow_speed'];
		$instance['slideshow'] = $new_instance['slideshow'];
		$instance['animation_type'] = $new_instance['animation_type'];
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
			$defaults = array( 
				'title' => __( 'Featured Slider', 'color-theme-framework' ), 
				'slideshow' => 'off', 
							'categories'			=> 'all',
							'categories_exclude'	=> '',
							'num_posts'				=> '5',
							'num_query_posts'		=> '10',
							'excerpt_lenght' 	=> '0',
							'show_views'		=> 'on',
							'show_likes'		=> 'on',
							'show_date'			=> 'off',
							'show_author'		=> 'off',
							'show_comments'		=> 'off',
							'show_category'		=> 'off',
				'show_related' => 'off',
				'show_random' => 'off',
				'animation_speed' => '600',
				'slideshow_speed' => '7000',
				'animation_type' => 'slide',
				'background_title' => '#ff0000'
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
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate slider automatically' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts (for posts, category pages, etc.)' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Random order' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts to display:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
			<i style=" font-size: 11px; color: #777; ">Will display only posts with Featured images</i>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_query_posts'); ?>"><?php _e( 'Number of posts in query:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_query_posts'); ?>" name="<?php echo $this->get_field_name('num_query_posts'); ?>" value="<?php echo $instance['num_query_posts']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('slideshow_speed'); ?>"><?php _e( 'Slideshow speed, in millisec:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100000" class="widefat" id="<?php echo $this->get_field_id('slideshow_speed'); ?>" name="<?php echo $this->get_field_name('slideshow_speed'); ?>" value="<?php echo $instance['slideshow_speed']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('animation_speed'); ?>"><?php _e( 'Animation speed, in millisec:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100000"class="widefat" id="<?php echo $this->get_field_id('animation_speed'); ?>" name="<?php echo $this->get_field_name('animation_speed'); ?>" value="<?php echo $instance['animation_speed']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'animation_type' ); ?>"><?php _e('Animation type:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'animation_type' ); ?>" name="<?php echo $this->get_field_name( 'animation_type' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'fade' == $instance['animation_type'] ) echo 'selected="selected"'; ?>>fade</option>
				<option <?php if ( 'slide' == $instance['animation_type'] ) echo 'selected="selected"'; ?>>slide</option>
			</select>
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
			<label for="<?php echo $this->get_field_id('excerpt_lenght'); ?>"><?php _e( 'Length of post excerpt (chars):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="500" class="widefat" id="<?php echo $this->get_field_id('excerpt_lenght'); ?>" name="<?php echo $this->get_field_name('excerpt_lenght'); ?>" value="<?php echo $instance['excerpt_lenght']; ?>" />
		</p>

		<p style="margin-top: 20px;">
			<label style="font-weight: bold;"><?php _e( 'Post meta info' , 'color-theme-framework' ); ?></label>
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
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" />
		</p>

		<?php

	}
}
?>