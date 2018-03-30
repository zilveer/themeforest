<?php

/*
	NEWS TEASER WIDGET
*/

class Artbees_Widget_News_Feed extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_news_feed', 'description' => 'Displays a News posts slider.' );
		WP_Widget::__construct( 'news_feed_widget', THEME_SLUG.' - '.'News Slider', $widget_ops );


	}


	function widget( $args, $instance ) {

		global $mk_options;

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Latest News' : $instance['title'], $instance, $this->id_base ); 

		if ( !$count = (int) $instance['count'] )
			$count = 10;
		else if ( $count < 1 )
				$count = 1;
			else if ( $count > 15 )
					$count = 15;
		$random = uniqid();

		$query = array( 'showposts' => $count, 'post_type' => 'news', 'nopaging' => 0, 'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );

		$r = new WP_Query( $query );



		if ( $r-> have_posts() ) :

			echo $before_widget;
			

		if ( $title ) echo $before_title . $title . $after_title; ?>


       <div class="news-widget-slider mk-flexslider js-flexslider clearfix" id="slider_<?php echo $random; ?>">
       		<ul class="mk-flex-slides">

				<?php while ( $r-> have_posts() ) : $r -> the_post();

					?>
					<li>
					<?php if ( has_post_thumbnail() ) : ?>
			        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>" class="news-widget-thumbnail">
			        <?php		
							$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'crop', 500, 250, $crop = true, $dummy = true);

						?><img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?> width="500" height="250" />
					</a>
					<?php endif; ?>

					<h4 class="news-widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="news-widget-excerpt"><?php the_excerpt(); ?></div>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="mk-read-more"><?php _e('Read more' , 'mk_framework'); ?></a>
					</li>
				<?php endwhile;  ?>
       		 </ul>
        <?php if(isset($mk_options['news_page']) && !empty($mk_options['news_page'])) : ?>
				<a class="mk-button mk-skin-button three-dimension small" href="<?php echo esc_url( get_permalink( $mk_options['news_page'] ) ); ?>"><?php _e('Back to News', 'mk_framework'); ?></a>
		<?php endif; ?>

		</div>
        <?php
		

		wp_reset_query();

		echo $after_widget;

		endif;
	

		}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['count'] = (int)$new_instance['count'];
	

		return $instance;
	}



	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;


?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of News', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>"  name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" />
	</p>

	<?php
	}
}

register_widget("Artbees_Widget_News_Feed");
