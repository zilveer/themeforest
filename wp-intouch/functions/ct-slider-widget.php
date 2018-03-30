<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Flex Slider Widget
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

add_action('widgets_init','ct_slider_widget');

function ct_slider_widget(){
		register_widget("CT_slider_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_slider_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_slider_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname'	=> 'ct-slider-widget',
							 'description'	=> __( 'Flex Slider' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array( 'width'		=> 255,
							  'height'		=> 350,
							  'id_base'		=> 'ct-slider-widget'
							);
		
		/* Create the widget. */
		parent::__construct( 'ct-slider-widget', __( 'CT: Slider Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		$title = apply_filters ('widget_title', $instance ['title']);
		$categories = $instance['categories'];
		$categories_exclude = $instance['categories_exclude'];
		$num_posts = $instance['num_posts'];
		$num_query_posts = $instance['num_query_posts'];
		$show_random = isset($instance['show_random']) ? 'true' : 'false';
		$animation_speed = $instance['animation_speed'];
		$slideshow_speed = $instance['slideshow_speed'];
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$carousel = isset($instance['carousel']) ? 'true' : 'false';
		$position_nav = $instance['position_nav'];
		$animation_type = $instance['animation_type'];
		$background_title = $instance['background_title'];
		$show_post_title = isset($instance['show_post_title']) ? '1' : '0';
		$show_post_text = isset($instance['show_post_text']) ? '1' : '0';
		$show_video_player = isset($instance['show_video_player']) ? '1' : '0';
		$show_control_nav = isset($instance['show_control_nav']) ? 'true' : 'false';
		$show_direction_nav = isset($instance['show_direction_nav']) ? 'true' : 'false';
		$background_controlnav = $instance['background_controlnav'];
		$background_content = $instance['background_content'];
		$font_color = $instance['font_color'];
		$excerpt_lenght = $instance['excerpt_lenght'];
		$load_method = $instance['load_method'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		echo "\n<!-- START SLIDER WIDGET -->\n";

		if ( $title ) :
			if ( $categories != 'all' ):
				$category_title_link = get_category_link( $categories );
				echo '<h3 class="widget-title" style="background:'.$background_title.';"><a href="'.$category_title_link.'" title="'.__('View all posts in ','color-theme-framework').$title.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			else :
				echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
			endif;	
		endif;
		?>
		
		<?php
		global $post;

		$time_id = rand();
		$orderby = 'date';
		if ( $show_random == 'true' ) { $orderby = 'rand'; }

			$slider_posts = new WP_Query( array(	'orderby'			=> $orderby,
													'showposts'			=> $num_query_posts,
													'post_type'			=> 'post',
													'ignore_sticky_posts'	=> 1,
													'cat'				=> $categories,
													'category__not_in'	=> $categories_exclude
												));

			$carousel_posts = new WP_Query( array(	'orderby'			=> $orderby,
													'showposts'			=> $num_query_posts,
													'post_type'			=> 'post',
													'ignore_sticky_posts'	=> 1,
													'cat'				=> $categories,
													'category__not_in'	=> $categories_exclude
												));

	if ( $slider_posts->have_posts() ) :
		if ( !is_admin() ) {
			/* Flex Slider */
			wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
			wp_enqueue_script('flex-min-jquery',array('jquery'));
		}
		?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery.noConflict()(function($){
			<?php if ( $load_method == 'document_ready' ) : ?>
				$(document).ready(function() {
			<?php else : ?>
				$(window).load(function() {
			<?php endif; ?>

				$(".slider-preloader").css("display","none");

				<?php if ( $carousel == 'true') : ?>
				$('#carousel-<?php echo $time_id; ?>').flexslider({
					animation: "slide",
					animationLoop: true,
					itemWidth: 212,
					itemMargin: 1,
					slideshow: false,
					controlNav: false,
					asNavFor: '#slider-<?php echo $time_id; ?>'
				});
				<?php endif; ?>

				$('#slider-<?php echo $time_id; ?>').flexslider({
					animation: "<?php echo $animation_type; ?>",
					controlNav: <?php echo $show_control_nav; ?>,
					directionNav: <?php echo $show_direction_nav; ?>,
					animationLoop: true,
					video: true,
					slideshow: <?php echo $slideshow; ?>,
					smoothHeight: true,
					slideshowSpeed: <?php echo $slideshow_speed; ?>,
					animationSpeed: <?php echo $animation_speed; ?>,
					<?php if ( $carousel == 'true') : ?>
						sync: "#carousel-<?php echo $time_id; ?>"
					<?php endif; ?>
				});

				$(".flex-big-slider .flex-control-nav").css("background-color","<?php echo $background_controlnav; ?>");
				$( ".flex-big-slider .flex-control-nav" ).append( "<div class=\"bottom-triangle\"></div>" );
				$(".ct-slider-widget .flex-control-nav .bottom-triangle").css("border-top-color","<?php echo $background_controlnav; ?>");
				$(".flex-big-slider .slides > li").css("background-color","<?php echo $background_content; ?>");

				<?php if ( $show_control_nav == 'false' ) : ?>
					$(".flex-big-slider .entry-content").css("padding-top","20px");
					$(".flex-big-slider .entry-content").css("margin-top","0");
				<?php endif; ?>

				<?php if ( $position_nav == 'Bottom' ) : ?>
					$(".flex-big-slider .flex-control-nav").css({"top": "inherit", "bottom":0});
					$(".flex-big-slider .entry-content").css({"padding-top":20, "margin-top":0});
					$(".ct-slider-widget .flex-control-nav .bottom-triangle").css("top","-10px");
					$(".ct-slider-widget .flex-control-nav .bottom-triangle").css("border-color","transparent transparent <?php echo $background_controlnav; ?> transparent");
					$(".ct-slider-widget .flex-control-nav .bottom-triangle").css("border-width","0 8.5px 10px 8.5px");
				<?php endif; ?>

			});
		});
		/* ]]> */
		</script>

		<!-- SLIDER -->
		<div class="slider-preloader" style="text-align: center;"><img src="<?php echo get_template_directory_uri().'/img/slider_preloader.gif'; ?> " alt="preloader"></div>
		<div id="slider-<?php echo $time_id; ?>" class="flexslider flex-big-slider">
			<ul class="slides">
				<?php $num_post = 0; ?>
				<?php while($slider_posts->have_posts()): $slider_posts->the_post(); ?>
					<?php if( has_post_thumbnail() ):
						$num_post++;
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-thumb');
						$text_color = "style=\"color: $font_color\" "; ?>
						<li style="<?php echo $background_content; ?>">
							<div class="entry-content">
								<?php if ( $show_post_title ) : ?>
									<h4 class="entry-title">
										<a href="<?php the_permalink(); ?>" <?php echo $text_color; ?> title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php echo the_title(); ?></a>
									</h4>
			  					<?php endif; ?>
			  					<?php if ( $show_post_text ) : ?>
			  						<div class="entry-text" <?php echo $text_color; ?>>
			  							<p><?php ct_get_post_excerpt($excerpt_lenght); //$post_excerpt = get_the_excerpt(); echo strip_tags(mb_substr($post_excerpt, 0, $excerpt_lenght ) ) . ' ...'; ?></p>
									</div><!-- .entry-text -->
								<?php endif; ?>
								<?php ct_get_readmore(); ?>
							</div><!-- .entry-content -->

	    					<div class="entry-thumb">
	    						<?php if ( has_post_format ( 'video' ) and $show_video_player ) :
									ct_get_video_player(); ?>
	    						<?php else: ?>
		    						<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>" /></a>
	    						<?php endif; ?>
							</div><!-- .entry-thumb -->
						</li>
					<?php endif; ?>
					<?php if ( $num_post == $num_posts ) : break; endif; ?>
				<?php endwhile; ?>
			</ul><!-- slides -->
		</div><!-- .flexslider -->

			<!-- CAROUSEL -->
			<div id="carousel-<?php echo $time_id; ?>" class="flexslider flex-carousel">
				<ul class="slides">
				<?php $num_post = 0; ?>

				<?php while($carousel_posts->have_posts()): $carousel_posts->the_post(); ?>
					<?php if( has_post_thumbnail() ): $num_post++; ?>
						<li>
							<div class="carousel-thumb">
								<?php $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carousel-thumb'); 
								if ( $carousel_image_url[1] == 360 && $carousel_image_url[2] == 203 ) : ?>
									<img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>" />
								<?php else :
									$carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');?>
									<img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>" />
								<?php endif; ?>

								<?php if ( has_post_format ( 'video' ) ) :
									ct_get_video_icon();
								elseif ( has_post_format ( 'audio' ) ) :
									$perma_link = get_permalink($post->ID);
									echo '<div class="audio"><a href="' . $perma_link . '" title="'. __('Play Audio','color-theme-framework').'"><i class="icon-music"></i></a></div>';
								endif; // has_post_format ?>
							</div><!-- /carousel-thumb -->
						</li>
					<?php endif; ?>
					<?php if ( $num_post == $num_posts ) : break; endif; ?>
				<?php endwhile; ?>
				</ul>
			</div> <!-- .flexslider -->

	<?php else : echo '<div style="padding: 20px;">'.__('No posts were found for display','color-theme-framework').'</div>';
	endif; ?>

	<?php
	  // Restor original Query & Post Data
	  wp_reset_postdata();


		/* After widget (defined by themes). */
		echo "\n<!-- END SLIDER WIDGET -->\n";
		echo $after_widget;
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
		$instance['show_random'] = $new_instance['show_random'];
		$instance['animation_speed'] = $new_instance['animation_speed'];
		$instance['slideshow_speed'] = $new_instance['slideshow_speed'];
		$instance['slideshow'] = $new_instance['slideshow'];
		$instance['carousel'] = $new_instance['carousel'];
		$instance['position_nav'] = $new_instance['position_nav'];
		$instance['animation_type'] = $new_instance['animation_type'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		$instance['show_post_title'] = $new_instance['show_post_title'];
		$instance['show_post_text'] = $new_instance['show_post_text'];
		$instance['show_video_player'] = $new_instance['show_video_player'];
		$instance['show_control_nav'] = $new_instance['show_control_nav'];
		$instance['show_direction_nav'] = $new_instance['show_direction_nav'];
		$instance['background_controlnav'] = strip_tags($new_instance['background_controlnav']);
		$instance['background_content'] = strip_tags($new_instance['background_content']);
		$instance['font_color'] = strip_tags($new_instance['font_color']);
		$instance['excerpt_lenght'] = $new_instance['excerpt_lenght'];
		$instance['load_method'] = $new_instance['load_method'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){ ?>
		<?php
		$defaults = array(	'title'					=> __( '', 'color-theme-framework' ), 
							'slideshow'				=> 'off', 
							'carousel'				=> 'off', 
							'categories'			=> 'all',
							'categories_exclude'	=> '',
							'num_posts'				=> '5',
							'num_query_posts'		=> '10',
							'show_random'			=> 'off',
							'position_nav'			=> 'Top',
							'show_post_title'		=> 'on',
							'show_post_text'		=> 'on',
							'animation_speed'		=> '600',
							'slideshow_speed'		=> '7000',
							'animation_type'		=> 'fade',
							'background_title'		=> '#ff0000',
							'background_controlnav' => '#434d54',
							'background_content'	=> '#3c95ba',
							'font_color'			=> '#FFFFFF',
							'excerpt_lenght'		=> '100',
							'show_control_nav'		=> 'on',
							'show_direction_nav'	=> 'on',
							'show_video_player'		=> 'on',
							'load_method'			=> 'window_load'
						);
				
		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = $instance['background_title'];
		$background_controlnav = $instance['background_controlnav'];
		$background_content = $instance['background_content'];
		$font_color = $instance['font_color'];
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
			<input class="checkbox" type="checkbox" <?php checked($instance['carousel'], 'on'); ?> id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>" /> 
			<label for="<?php echo $this->get_field_id('carousel'); ?>"><?php _e( 'Show carousel' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_post_title'], 'on'); ?> id="<?php echo $this->get_field_id('show_post_title'); ?>" name="<?php echo $this->get_field_name('show_post_title'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_post_title'); ?>"><?php _e( 'Show post title' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_post_text'], 'on'); ?> id="<?php echo $this->get_field_id('show_post_text'); ?>" name="<?php echo $this->get_field_name('show_post_text'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_post_text'); ?>"><?php _e( 'Show post text' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_video_player'], 'on'); ?> id="<?php echo $this->get_field_id('show_video_player'); ?>" name="<?php echo $this->get_field_name('show_video_player'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_video_player'); ?>"><?php _e( 'Show video player (iframe)' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_control_nav'], 'on'); ?> id="<?php echo $this->get_field_id('show_control_nav'); ?>" name="<?php echo $this->get_field_name('show_control_nav'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_control_nav'); ?>"><?php _e( 'Show navigation for paging control' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_direction_nav'], 'on'); ?> id="<?php echo $this->get_field_id('show_direction_nav'); ?>" name="<?php echo $this->get_field_name('show_direction_nav'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_direction_nav'); ?>"><?php _e( 'Show previous/next navigation' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Random order' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate slider automatically' , 'color-theme-framework' ); ?></label>
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
			<label for="<?php echo $this->get_field_id('excerpt_lenght'); ?>"><?php _e( 'Length of post excerpt (chars):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="500" class="widefat" id="<?php echo $this->get_field_id('excerpt_lenght'); ?>" name="<?php echo $this->get_field_name('excerpt_lenght'); ?>" value="<?php echo $instance['excerpt_lenght']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'load_method' ); ?>"><?php _e('Slider load method:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'load_method' ); ?>" name="<?php echo $this->get_field_name( 'load_method' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'document_ready' == $instance['load_method'] ) echo 'selected="selected"'; ?>>document_ready</option>
				<option <?php if ( 'window_load' == $instance['load_method'] ) echo 'selected="selected"'; ?>>window_load</option>
			</select>
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
			<label for="<?php echo $this->get_field_id( 'position_nav' ); ?>"><?php _e('Position of navigation for paging control:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'position_nav' ); ?>" name="<?php echo $this->get_field_name( 'position_nav' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Top' == $instance['position_nav'] ) echo 'selected="selected"'; ?>>Top</option>
				<option <?php if ( 'Bottom' == $instance['position_nav'] ) echo 'selected="selected"'; ?>>Bottom</option>
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
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_controlnav'); ?>" style="display:block;"><?php _e('ControlNav Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_controlnav' ); ?>" name="<?php echo $this->get_field_name( 'background_controlnav' ); ?>" value="<?php echo esc_attr( $instance['background_controlnav'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_content'); ?>" style="display:block;"><?php _e('Content Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_content' ); ?>" name="<?php echo $this->get_field_name( 'background_content' ); ?>" value="<?php echo esc_attr( $instance['background_content'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('font_color'); ?>" style="display:block;"><?php _e('Content Font color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'font_color' ); ?> ct-color-picker" name="<?php echo $this->get_field_name( 'font_color' ); ?>" value="<?php echo esc_attr( $instance['font_color'] ); ?>" />
		</p>
		<?php

	}
}
?>