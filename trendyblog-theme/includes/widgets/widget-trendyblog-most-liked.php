<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_most_liked");'));

class DF_most_liked extends WP_Widget {
	function DF_most_liked() {
		parent::__construct (false, $name = THEME_FULL_NAME.' '.esc_html__("Most Liked Posts", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Most Liked Posts", THEME_NAME),
			'count' => '3',
			'cat' => '',
			'images' => 'show',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$cat = $instance['cat'];
		$count = $instance['count'];
		$images = $instance['images'];
        ?>
            <p><label for="<?php echo esc_attr__($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('title')); ?>" name="<?php echo esc_attr__($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr__($title); ?>" /></label></p>
			<p><label for="<?php echo esc_attr__($this->get_field_id('cat')); ?>"><?php esc_html_e( 'Category:' , THEME_NAME );?>
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
			<select name="<?php echo esc_attr__($this->get_field_name('cat')); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value=""><?php esc_html_e("Latest News", THEME_NAME);?></option>
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo esc_attr__($ar->term_id); ?>" <?php if($ar->term_id==$cat)  {echo 'selected="selected"';} ?>><?php echo esc_html__($ar->cat_name); ?></option>
				<?php } ?>
			</select>
			
			</label></p>

			<p><label for="<?php echo esc_attr__($this->get_field_id('count')); ?>"><?php esc_html_e( 'Post count:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('count')); ?>" name="<?php echo esc_attr__($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr__($count); ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$cat = $instance['cat'];

		$args=array(
			'posts_per_page' => $count,
			'order' => 'DESC',
			'cat' => $cat,
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> "_".THEME_NAME.'_total_votes',
			'post_type'=> 'post',
			'ignore_sticky_posts' => true
		);



		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		
		if($cat) {
			$link = get_category_link( $cat );
		} else {
			$link = get_page_link($blogID);
		}

?>		
	<?php echo balanceTags($before_widget); ?>
		<?php 
			if($title) { 
				echo balanceTags($before_title);
				echo esc_html__($title);
				echo balanceTags($after_title);
			}
		?>

		<div class="tb_widget_most_liked clearfix">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

	                    <!-- Post item -->
	                    <div class="item clearfix">
	                        <div class="item_thumb clearfix">
	                            <a href="<?php the_permalink();?>">
	                            	<?php echo df_image_html($the_query->post->ID,500,500,"visible animated");?>
	                            </a>
	                        </div>
				            <div class="item_content">
				                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				                <div class="item_meta clearfix">
				                    <span class="meta_likes"><a href="<?php the_permalink();?>"><?php echo intval(get_post_meta( $the_query->post->ID, "_".THEME_NAME."_total_votes", true ));?></a></span>
				                </div>
				            </div>

	                        <div class="order"><?php echo intval($counter);?></div>
	                    </div><!-- End Post item -->
	                    <?php $counter++;?>

					<?php endwhile; else: ?>
						<p><?php esc_html_e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>
			</div>
	<?php echo balanceTags($after_widget); ?>

    <?php
	}
}
?>