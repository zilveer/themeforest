<?php
class Artbees_Widget_Popular_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array( "classname" => "widget_posts_lists", "description" => "Displays the Popular posts" );
		WP_Widget::__construct( "popular_posts", THEME_SLUG . " - Popular Posts", $widget_ops );
		$this-> alt_option_name = "widget_popular_posts";

		add_action( "save_post", array( &$this, "flush_widget_cache" ) );
		add_action( "deleted_post", array( &$this, "flush_widget_cache" ) );
		add_action( "switch_theme", array( &$this, "flush_widget_cache" ) );
	}


	function widget( $args, $instance ) {

		$cache = wp_cache_get( "Artbees_Widget_Popular_Posts", "widget" );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );


		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Popular Posts' : $instance['title'], $instance, $this->id_base );
		if ( !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 10;
		else if ( $posts_number < 1 )
				$posts_number = 1;
			else if ( $posts_number > 15 )
					$posts_number = 15;

			$disable_time = $instance["disable_time"] ? "1" : "0";
		



		$query = array( 'showposts' => $posts_number, 'nopaging' => 0, "orderby" => "comment_count", "order" => "DSC", 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
		if ( !empty( $instance["cats"] ) ) {
			$query["cat"] = implode( ",", $instance["cats"] );
		}

		$recent = new WP_Query( $query );

		if ( $recent-> have_posts() ) :

			echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul>

		<?php

		$no_thumb_css = '';

		while ( $recent-> have_posts() ) : $recent -> the_post();

		global $post;
		$post_type = get_post_meta( $post->ID, '_single_post_type', true );
		 ?>

        <li class="post-list-<?php echo $post_type; ?>">
		<?php 
	    if ( has_post_thumbnail() ) :
	    ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>" class="post-list-thumb">
		        <?php	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail', true );	
		        		$image_src = $image_src_array[0];
		        		$image_width = $image_src_array[1];
		        		$image_height = $image_src_array[2];
				 ?>
				 <img src="<?php echo $image_src; ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>"/>
			</a>
		<?php else:
			$no_thumb_css = 'posts-no-thumb';
			endif;
		 ?>
        <div class="post-list-info <?php echo $no_thumb_css; ?>">
        <a href="<?php the_permalink(); ?>" class="post-list-title"><?php the_title(); ?></a>
        <div class="post-list-meta">
	       <?php if($disable_time == true) {  ?>
	       <time datetime="<?php the_date('Y-m-d') ?>"><?php echo get_the_date(); ?></time>
	       <?php } ?>
   	   </div>	
       </div>

       <div class="clearboth"></div>
       </li>
        
        <?php endwhile;  ?>

        </ul>
        <?php
		echo $after_widget;

		wp_reset_query();


		endif;


		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'Artbees_Widget_Popular_Posts', $cache, 'widget' );


	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance["title"] = strip_tags( $new_instance["title"] );
		$instance["posts_number"] = (int) $new_instance["posts_number"];
		$instance["disable_time"] = !empty( $new_instance["disable_time"] ) ? 1 : 0;
		$instance["cats"] = $new_instance["cats"];

		$this-> flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['Artbees_Widget_Popular_Posts'] ) )
			delete_option( 'Artbees_Widget_Popular_Posts' );

		return $instance;
	}



	function flush_widget_cache() {
		wp_cache_delete( 'Artbees_Widget_Popular_Posts', 'widget' );
	}





	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		$disable_time = isset( $instance["disable_time"] ) ? (bool) $instance["disable_time"] : true;
		$cats = isset( $instance['cats'] ) ? $instance['cats'] : array();

		if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 3;


		$categories = get_categories( 'orderby=name&hide_empty=0' );


?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e('Number of posts:', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" class="widefat" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_time' ); ?>" name="<?php echo $this->get_field_name( 'disable_time' ); ?>"<?php checked( $disable_time ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_time' ); ?>"><?php _e('Show Date', 'mk_framework'); ?></label></p>

	
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Which Categories to show?', 'mk_framework'); ?></label>
			<select style="height:15em" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" class="widefat" multiple="multiple">
				<?php foreach ( $categories as $category ):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array( $category->term_id, $cats )? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php


	}
}

register_widget("Artbees_Widget_Popular_Posts");