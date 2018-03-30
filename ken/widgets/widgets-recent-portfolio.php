<?php

/*
	RECENT POSTS
*/

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
		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );


		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 10;
		else if ( $posts_number < 1 )
				$posts_number = 1;
			else if ( $posts_number > 15 )
					$posts_number = 15;




			$query = array( 'showposts' => $posts_number, 'post_type' => 'portfolio', 'nopaging' => 0, 'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );

			$cats = $instance["cats"];

			if ( $cats != '' ) {
					$query['tax_query'] = array(
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => $cats
						)
					);
			}


			$recent = new WP_Query( $query );

		if ( $recent-> have_posts() ) :

			echo $before_widget;


		if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul>

		<?php

		while ( $recent-> have_posts() ) : $recent -> the_post();
?>

        <li>
        	<div class="item-holder">
		        <div class="featured-image">
		        <?php $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
				$image_src = bfi_thumb( $image_src_array[ 0 ], array('width' => 300, 'height' => 300, 'crop'=>true));
		?>
					 <img alt="<?php the_title(); ?>" width="300" height="300" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo mk_thumbnail_image_gen($image_src, 300, 300); ?>"  />
					<div class="hover-overlay"></div>
					<div class="portfolio-meta">
						<a class="mk-lightbox portfolio-plus-icon" rel="portfolio-widget" title="<?php the_title(); ?>" href="<?php echo $image_src_array[0]; ?>"><i class="mk-theme-icon-plus"></i></a>
						<a class="portfolio-permalink" href="<?php echo get_permalink(); ?>"><i class="mk-theme-icon-next-big"></i></a>
						</div>
		       	<div class="clearboth"></div>
       		</div>
       		</div>
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
		$instance["cats"] = $new_instance["cats"];
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
		$cats = isset( $instance['cats'] ) ? $instance['cats'] : array();

		if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 4;

		$terms = get_terms( 'portfolio_category', 'hide_empty=1' );



?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">Number of posts:</label>
		<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id( 'cats' ); ?>">Which Categories to show?</label>
			<select style="height:150px" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" class="widefat" multiple="multiple">
				<?php
				if ( is_array( $terms ) && !empty( $terms ) ) {
				 	foreach ( $terms as $term ):?>
					<option value="<?php echo $term->slug;?>"<?php echo in_array( $term->slug, $cats )? ' selected="selected"':'';?>><?php echo $term->name;?></option>
				<?php endforeach;
				}
				?>
			</select>
		</p>
<?php


	}
}

/***************************************************/
