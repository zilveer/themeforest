<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_reviews");'));

class DF_reviews extends WP_Widget {
	function DF_reviews() {
		parent::__construct (false, $name = THEME_FULL_NAME.' '.esc_html__("Reviews", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Reviews", THEME_NAME),
			'subtitle' => '',
			'count' => '3',
			'cat' => '',
			'type' => 'latest',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$cat = $instance['cat'];
		$count = $instance['count'];
		$type = $instance['type'];

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
			<p><label for="<?php echo esc_attr__($this->get_field_id('type')); ?>"><?php esc_html_e( 'Type:' , THEME_NAME );?>
				<select name="<?php echo esc_attr__($this->get_field_name('type')); ?>" style="width: 100%; clear: both; margin: 0;">
					<option value="latest" <?php if($type=="latest")  {echo 'selected="selected"';} ?>><?php esc_html_e("Latest Reviews", THEME_NAME);?></option>
					<option value="top" <?php if($type=="top")  {echo 'selected="selected"';} ?>><?php esc_html_e("Top Reviews", THEME_NAME);?></option>
				</select>
			
			</label></p>
			<p><label for="<?php echo esc_attr__($this->get_field_id('count')); ?>"><?php esc_html_e( 'Post count:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('count')); ?>" name="<?php echo esc_attr__($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr__($count); ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['type'] = strip_tags($new_instance['type']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $subtitle = apply_filters('widget_title', $instance['subtitle']);
		$count = $instance['count'];
		$cat = $instance['cat'];
		$type = $instance['type'];

		if($type=="top") {
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'order' => 'DESC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> "_".THEME_NAME.'_ratings_average'
			);
		} else {
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'order' => 'DESC',
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'meta_query' => array(
				    array(
				        'key' => "_".THEME_NAME.'_ratings_average',
				        'value'   => '0',
				        'compare' => '>='
				    )
				)
			);	
		}


		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		

		$postDate = get_option(THEME_NAME."_post_date");
		$postComments = get_option(THEME_NAME."_post_comment");
?>		
	<?php echo balanceTags($before_widget); ?>
		<?php 
			if($title) { 
				echo balanceTags($before_title);
				echo esc_html__($title);
				echo balanceTags($after_title);
			}
		?>

		<div class="<?php if($type=="top") { ?>tb_widget_top_rated<?php } else { ?>tb_widget_latest_reviews<?php } ?> clearfix">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php
					$averageRate = df_avarage_rating($the_query->post->ID);
						if($averageRate) {

				?>
	                    <!-- Post item -->
	                    <div class="item clearfix">
	                        <div class="item_thumb clearfix">
	                            <a href="<?php the_permalink();?>">
	                            	<?php echo df_image_html($the_query->post->ID,500,500,"visible animated");?>
	                            </a>
	                        </div>
	                        <div class="item_content">
	                            <div class="item_meta clearfix">
	                                <span class="meta_rating" title="<?php echo esc_attr__($averageRate[1]);?><?php esc_html_e(" out of 5", THEME_NAME);?>">
	                                    <span style="width: <?php echo floatval($averageRate[0]);?>%">
	                                        <strong><?php echo floatval($averageRate[1]);?></strong>
	                                    </span>
	                                </span>
	                            </div>
	                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	                        </div>
	                        <?php if($type=="top") { ?>
	                        	<div class="order"><?php echo intval($counter);?></div>
	                        <?php } ?>
	                    </div><!-- End Post item -->
	                    <?php $counter++;?>
                    <?php } ?>
					<?php endwhile; else: ?>
						<p><?php esc_html_e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>
			</div>
	<?php echo balanceTags($after_widget); ?>
		
	
      <?php
	}
}
?>