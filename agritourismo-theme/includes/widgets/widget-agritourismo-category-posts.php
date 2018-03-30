<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_cat_posts");'));

class OT_cat_posts extends WP_Widget {
	function OT_cat_posts() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Latest Category Posts');	
	}

	function form($instance) {
		 $cat = esc_attr($instance['cat']);
		 $count = esc_attr($instance['count']);
        ?>
         
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php printf ( __( 'Category:' , THEME_NAME ));?>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<select name="<?php echo $this->get_field_name('cat'); ?>" style="width: 100%; clear: both; margin: 0;">
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo $ar->cat_name; ?>" <?php if($ar->cat_name==$cat)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
				<?php } ?>
			</select>
			
			</label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$count = $instance['count'];
		$cat = $instance['cat'];



	$category_id = get_cat_ID($cat);
	$category_link = get_category_link( $category_id );
	$categoryName = get_category($category_id)->name ;

	
	$args=array(
		'cat'=> $category_id,
		'posts_per_page'=> $count
	);
	
	$the_query = new WP_Query($args);
		$counter = 1;

	$blogID = get_option('page_for_posts');

?>	
	<?php echo $before_widget; ?>
		<?php if($categoryName) echo $before_title.$categoryName.$after_title; ?>
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php 
				$image = get_post_thumb($the_query->post->ID,78,78); 
			?>
				<div class="widget-article <?php if($image['show']!=true) { ?> without-photo<?php } ?>">
					<?php if($image['show']==true) { ?>
						<div class="article-photo">
							<a href="<?php the_permalink();?>" class="photo-border-1">
								<img src="<?php echo $image["src"];?>" alt="<?php the_title();?>" />
							</a>
						</div>
					<?php } ?>
					<div class="article-content">
						<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<div class="article-icons">
							<?php if ( comments_open() ) { ?>
								<a href="<?php the_permalink();?>#comments" class="article-icon">
									<span class="icon-text">&#59160;</span><?php comments_number("0","1","%"); ?>
								</a>
							<?php } ?>
							<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" class="article-icon">
								<span class="icon-text">&#128340;</span><?php the_time("F d, Y");?>
							</a>
						</div>
						<a href="<?php the_permalink();?>" class="button-link"><?php _e("Read More", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
					</div>
				</div>
			<?php endwhile; else: ?>
				<p><?php  _e( 'No posts where found' , THEME_NAME);?></p>
			<?php endif; ?>

	
	<?php echo $after_widget; ?>

      <?php
	}
}
?>