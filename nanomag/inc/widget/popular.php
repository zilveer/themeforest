<?php
add_action( 'widgets_init', 'popular_widgets' );

function popular_widgets() {
	register_widget( 'popular_widget' );
}


class popular_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function  __construct() {
		$widget_ops = array( 'classname' => 'post_list_widget', 'description' => esc_attr__( 'Display a list of popular posts', 'nanomag' ) );
		parent::__construct('popular_widget', esc_attr__('jellywp: popular post', 'nanomag'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('Popular Posts', $instance['title'] );
		$num_posts = $instance['num_posts'];
		echo $before_widget;
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}

			$recent_posts = new WP_Query(array(
				'showposts' => $num_posts,
				'orderby' => 'comment_count',
				'ignore_sticky_posts' => 1
			));
			
			?>
				<div class="widget_container">
				<ul class="feature-post-list popular-post-widget">
			<?php while($recent_posts->have_posts()){ 
			$recent_posts->the_post();
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID()); 
			?>

                         <li>
<a  href="<?php the_permalink(); ?>" class="feature-image-link image_post" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('small-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/small-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
  <div class="item-details">
  	<?php  if(of_get_option('disable_post_category') !=1){
          if ($categories) {
            echo '<span class="meta-category-small">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $titleColor = jelly_categorys_title_color($tag->term_id, "category", false);
             echo '<a class="post-category-color-text" style="color:'.esc_attr($titleColor).'" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';          
            }
            echo "</span>";
            }
       }?>
<?php echo jelly_total_score_post_front_small_list(get_the_ID());?>
   <h3 class="feature-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
   <?php echo jelly_post_meta(get_the_ID()); ?>
   </div>
   <div class="clearfix"></div>
   </li>
            

		<?php } ?>
</ul>		
</div>			
<?php
		echo $after_widget;
	}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		return $instance;
	}


	function form($instance)
	{
		$defaults = array('title' => esc_attr__( 'Popular Posts', 'nanomag' ) , 'num_posts' => 4, 'show_comments' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e( 'Title:', 'nanomag' ) ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('num_posts')); ?>"><?php esc_attr_e( 'Number of posts:', 'nanomag' ); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('num_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('num_posts')); ?>" type="text" value="<?php echo esc_attr($instance['num_posts']); ?>" />
		</p>		
	<?php 
	}
}
?>