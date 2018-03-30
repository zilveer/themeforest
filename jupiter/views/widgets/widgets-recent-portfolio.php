<?php
class Artbees_Widget_Recent_Portfolio extends WP_Widget {

	function __construct() {
		$widget_ops = array( "classname" => "widget_recent_portfolio", "description" => "Displays the Recent Portfolio items" );
		WP_Widget::__construct( "recent_portfolio", THEME_SLUG . " - Recent Portfolios", $widget_ops );
		$this-> alt_option_name = "widget_recent_portfolio";

		add_action( "save_post", array( &$this, "flush_widget_cache" ) );
		add_action( "deleted_post", array( &$this, "flush_widget_cache" ) );
		add_action( "switch_theme", array( &$this, "flush_widget_cache" ) );
	}


	function widget( $args, $instance ) {

		$cache = wp_cache_get( "Artbees_Widget_Recent_Portfolio", "widget" );
		$id = mt_rand(99,999);

		global $post;

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );


		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Recent Works' : $instance['title'], $instance, $this->id_base );
		if ( !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 10;
		else if ( $posts_number < 1 )
				$posts_number = 1;
			else if ( $posts_number > 15 )
					$posts_number = 15;
		



		$query = array( 'showposts' => $posts_number, 'post_type' => 'portfolio', 'nopaging' => 0, 'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );

		$recent = new WP_Query( $query );

		if ( $recent-> have_posts() ) :

			echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul>

		<?php

		while ( $recent-> have_posts() ) : $recent -> the_post();

		$terms = get_the_terms( get_the_id(), 'portfolio_category' );
		$terms_slug = array();
		$terms_name = array();
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$terms_slug[] = $term->slug;
				$terms_name[] = $term->name;
			}
		}
		 ?>



        <li>

        <?php if(has_post_thumbnail()) { ?>
	        <span class="portfolio-widget-thumb">
		        <?php	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail', true );	
		        		$image_src = $image_src_array[0];
		        		$image_width = $image_src_array[1];
		        		$image_height = $image_src_array[2];
				 ?>
				 <?php 
				 	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
				 	$video_type_website = get_post_meta( $post->ID, '_single_video_site', true );
				 	$video_type_video_id = get_post_meta( $post->ID, '_single_video_id', true );
				 	$post_type_link = '';

				 	if($post_type == 'video'){
				 		if($video_type_website == 'youtube'){
				 			$post_type_link = 'http'.( is_ssl() ? 's' : '' ).'://www.youtube.com/watch?v='.$video_type_video_id;
				 		}else if($video_type_website == 'vimeo'){
				 			$post_type_link = 'http'.( is_ssl() ? 's' : '' ).'://vimeo.com/'.$video_type_video_id;
				 		}else{
				 			$post_type_link = 'http'.( is_ssl() ? 's' : '' ).'://www.dailymotion.com/video/'.$video_type_video_id;
				 		}
				 	}else{
				 		$post_type_link_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				 		$post_type_link = $post_type_link_array[0];
				 	}
				 ?>
				 <img src="<?php echo $image_src; ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>"/>
				 <span class="widget-portfolio-overlay"></span>
				 <a class="mk-lightbox portfolio-widget-lightbox" title="<?php the_title_attribute(); ?>" data-fancybox-group="blog-widget-recent-portfolio" href="<?php echo $post_type_link; ?>">						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-left'); ?>
					 <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-zoom-in'); ?>
				 </a>
				 <a class="portfolio-widget-permalink" href="<?php the_permalink(); ?>"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-link'); ?></a>
			 </span>
		<?php } // condition for has_post_thumbnail() ?>


        <div class="portfolio-widget-info">
       	<span class="portfolio-widget-title"><?php the_title_attribute(); ?></span>
       	<div class="clearboth"></div>
       	<div class="portfolio-widget-cats"><?php echo implode( ' ', $terms_name ); ?></div>
       </div>

       <div class="clearboth"></div>
       </li>
        
        <?php endwhile;  ?>

        </ul>
        <div class="clearboth"></div>
        <?php
		echo $after_widget;

		wp_reset_query();


		endif;


		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'Artbees_Widget_Recent_Portfolio', $cache, 'widget' );


	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance["title"] = strip_tags( $new_instance["title"] );
		$instance["posts_number"] = (int) $new_instance["posts_number"];
		$this-> flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['Artbees_Widget_Recent_Portfolio'] ) )
			delete_option( 'Artbees_Widget_Recent_Portfolio' );

		return $instance;
	}



	function flush_widget_cache() {
		wp_cache_delete( 'Artbees_Widget_Recent_Portfolio', 'widget' );
	}





	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 4;


?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e('Number of posts:', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" class="widefat" /></p>
<?php


	}
}
register_widget("Artbees_Widget_Recent_Portfolio");