<?php
/*
-----------------------------------------------------------------------------------

	Plugin Name: CT Carousel Widget
	Plugin URI: http://www.color-theme.com
	Description: A widget that show carousel with latest posts.
	Version: 1.0
	Author: ZERGE
	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init','ct_carousel_widget');

function ct_carousel_widget(){
		register_widget("CT_carousel_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_carousel_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_carousel_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'ct-carousel-widget', 'description' => __( 'Carousel widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct-carousel-widget' );
		
		/* Create the widget. */
		parent::__construct( 'ct-carousel-widget', __( 'CT: Carousel Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = apply_filters ('widget_title', $instance ['title']);
		$categories = $instance['categories'];
		$categories_exclude = $instance['categories_exclude'];
		$num_posts = $instance['num_posts'];
		$num_query_posts = $instance['num_query_posts'];
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$show_random = isset($instance['show_random']) ? 'true' : 'false';
		$background_title = $instance['background_title'];
		?>

		<?php

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START CAROUSEL WIDGET -->\n";
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		} else {
			echo "\n<!-- START CAROUSEL WIDGET -->\n";
		}
		?>

		<?php
		global  $ct_options, $post;
		$time_id = rand();
		$orderby = 'date';
		$extra_class = '';
		
		if ( $show_random == 'true' ) { $orderby = 'rand'; }

		if ( ($show_related == 'true') and !is_author() and !is_search() and !is_page() ) :
			if ( is_category() ) :
				$current_category = single_cat_title('', false);
				$related_category_id = get_cat_ID($current_category);
			else :
				$related_category = get_the_category($post->ID);
				$related_category_id = get_cat_ID( $related_category[0]->cat_name );
			endif;

	  		$recent_posts = new WP_Query(array(	'orderby'			=> $orderby,
	  											'showposts'			=> $num_query_posts,
	  											'post_type'			=> 'post',
	  											'cat'				=> $related_category_id,
	  											'post__not_in'		=> array( $post->ID ),
	  											'ignore_sticky_posts' => 1,
	  											'category__not_in'	=> $categories_exclude
	  										)
	  									);
		else :
	  		$recent_posts = new WP_Query(array(	'orderby'			=> $orderby,
	  											'showposts'			=> $num_query_posts,
	  											'post_type'			=> 'post',
	  											'cat'				=> $categories,
	  											'ignore_sticky_posts' => 1,
	  											'category__not_in'	=> $categories_exclude
	  										)
										);
		endif; 

		if (!$recent_posts->have_posts()) : // not related post were found, display recent posts
			$recent_posts = new WP_Query(array(	'orderby'			=> $orderby,
	  											'showposts'			=> $num_query_posts,
	  											'post_type'			=> 'post',
	  											'cat'				=> $categories,
	  											'ignore_sticky_posts' => 1,
	  											'category__not_in'	=> $categories_exclude
	  										)
										);
			$extra_class = 'ct-no-related-posts';
		endif;

		$recent_posts_count = $recent_posts->found_posts;
		if ( $recent_posts_count == 1 ) : $extra_class = 'ct-one-related-posts'; endif;

		if ( !is_admin() ) {
			/* Flex Slider */
			wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
			wp_enqueue_script('flex-min-jquery',array('jquery'));
		}
		?>


		<?php if ($recent_posts->have_posts()) : ?>
			<script type="text/javascript">
			/* <![CDATA[ */
			jQuery.noConflict()(function($){
				$(document).ready(function() {

					$(".slider-preloader").css("display","none");

					$('#carousel-<?php echo $time_id; ?>').flexslider({
						animation: "slide",
						animationLoop: true,
						itemWidth: 360,
						itemMargin: 30,
						minItems: 2,
						maxItems: 6,
						slideshow: <?php echo $slideshow; ?>,
						controlNav: false
  					});
				});
			});
			/* ]]> */
			</script>

		<div class="slider-preloader" style="text-align: center;"><img src="<?php echo get_template_directory_uri().'/img/slider_preloader.gif'; ?> " alt="preloader"></div>
		<div id="carousel-<?php echo $time_id; ?>" class="flexslider flex-carousel <?php echo $extra_class?>">
			<ul class="slides">
				<?php
				global $post;
				$num_post = 0;
				while($recent_posts->have_posts()): $recent_posts->the_post(); ?>

					<?php if( has_post_thumbnail() ): $num_post++; ?>

						<?php
						$post_bg_color = get_post_meta( $post->ID, 'ct_mb_post_bg_color', true);
						$post_font_color = get_post_meta( $post->ID, 'ct_mb_post_font_color', true);
						$post_color_type = $ct_options['ct_post_color_type'];
						$custom_border_color = '';

						if ( $post_font_color == '' ) : $post_font_color = '#455058'; endif; //set to default color 

						if ( $post_font_color == '#455058' ) : $custom_font_color = '';
						else : $custom_font_color = "style=\"color: $post_font_color;\""; 
						endif;

			if ( $post_color_type == 'category' ) : // Get the custom color for posts from Category settings
				$category = get_the_category(); 
				$cat_color = ct_get_color($category[0]->term_id);
				if ( $cat_color == '') { $cat_color = '#FFFFFF'; }

				if ( $cat_color == '#FFFFFF' ) { $custom_font_color = ''; }
				else {
					if ( $post_font_color == '#455058' ) { $custom_font_color = "style=\"color: #FFFFFF;\""; }
					else { $custom_font_color = "style=\"color: $post_font_color;\""; }
				}
				$post_bg_color = $cat_color;
				$custom_bg_color = "style=\"background-color: $post_bg_color;\"";
				if (is_rtl()) :
					$custom_border_color = "style=\"border-left-color: $post_bg_color;\"";
				else:
					$custom_border_color = "style=\"border-right-color: $post_bg_color;\"";
				endif;
			elseif ( empty($post_bg_color) ) : $custom_bg_color = '';
			else :
				if (is_rtl()) :
					$custom_bg_color = "style=\"background-color: $post_bg_color;\""; $custom_border_color = "style=\"border-left-color: $post_bg_color;\"";
				else :
					$custom_bg_color = "style=\"background-color: $post_bg_color;\""; $custom_border_color = "style=\"border-right-color: $post_bg_color;\"";
				endif;
			endif;

			?>
			<li <?php echo $custom_bg_color; ?>>
				<div class="carousel-thumb">
					<?php $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carousel-thumb'); 
			
					if ( $carousel_image_url[1] == 360 && $carousel_image_url[2] == 203 ) { ?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					<?php } else { 
						$carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					<?php } ?>

					<?php
					if ( has_post_format ( 'video' ) ) :
						ct_get_icon_link();
					elseif ( has_post_format ( 'audio' ) ) :
						$perma_link = get_permalink($post->ID);
						echo '<div class="audio"><a href="' . $perma_link . '" title="'. __('Play Audio','color-theme-framework').'"><i class="icon-music"></i></a></div>';
					endif; // has_post_format ?>

					<div class="<?php if (is_rtl()) : echo 'right-triangle'; else: echo 'left-triangle'; endif; ?>" <?php echo $custom_border_color; ?>></div>
				</div><!-- .carousel-thumb -->

				<h4 class="entry-title">
					<?php if (is_rtl()) : ?>
						<a href="<?php the_permalink(); ?>" <?php echo $custom_font_color; ?>><?php echo strip_tags(mb_substr(the_title('','',false), 0, 75 ) ) . ' &larr;'; ?></a>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" <?php echo $custom_font_color; ?>><?php echo strip_tags(mb_substr(the_title('','',false), 0, 75 ) ) . ' &rarr;'; ?></a>
					<?php endif; ?>
				</h4><!-- .entry-title -->
				<div class="entry-meta" <?php echo $custom_font_color; ?>>
					<?php ct_get_meta_date(); ?>
				</div><!-- .entry-meta -->
			</li>
		<?php endif; ?>
		<?php if ( $num_post == $num_posts ) : break; endif; ?>
		<?php endwhile; ?>

	</ul>
</div> <!-- /flexslider -->

<?php else : echo __('No posts were found for display','color-theme-framework');
endif; ?>

		<?php
		
		// Restor original Query & Post Data
		wp_reset_postdata();
		

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['num_query_posts'] = $new_instance['num_query_posts'];
		$instance['slideshow'] = $new_instance['slideshow'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['show_random'] = $new_instance['show_random'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		$instance['categories_exclude'] = $new_instance['categories_exclude'];

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
		$defaults = array(	'title'					=> __( '', 'color-theme-framework' ), 
							'slideshow'				=> 'off', 
							'categories'			=> 'all', 
							'num_posts'				=> '10',
							'num_query_posts'		=> '20',
							'show_related'			=> 'off', 
							'show_random'			=> 'off',
							'background_title'		=> '#ff0000',
							'categories_exclude'	=> ''
						);
			
		$instance = wp_parse_args((array) $instance, $defaults);
		$background_title = $instance['background_title'];
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
			<label for="<?php echo $this->get_field_id('categories_exclude'); ?>"><?php _e( 'Categories to exclude:' , 'color-theme-framework' ); ?></label> 
			<select size="5" multiple="multiple" id="<?php echo $this->get_field_id('categories_exclude'); ?>" name="<?php echo $this->get_field_name('categories_exclude'); ?>[]" class="widefat" style="width:100%;">
				<?php $cat = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($cat as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ( is_array( $categories_exclude ) && in_array( $category->term_id, $categories_exclude ) ) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Random order' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate carousel automatically' , 'color-theme-framework' ); ?></label>
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
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" />
		</p>

		<?php

	}
}
?>