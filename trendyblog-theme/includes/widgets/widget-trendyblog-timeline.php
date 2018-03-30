<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_timeline");'));

class DF_timeline extends WP_Widget {
	function DF_timeline() {
		parent::__construct (false, $name = THEME_FULL_NAME.' '.esc_html__("Timeline", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Timeline", THEME_NAME),
			'cat' => '',
			'count' => '10',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$cat = $instance['cat'];
		$count = $instance['count'];
        ?>
         	<p><label for="<?php echo esc_attr__($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('title')); ?>" name="<?php echo esc_attr__($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr__($title); ?>" /></label></p>
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
		$title = $instance['title'];
		$count = $instance['count'];
		$cat = $instance['cat'];


	
	$args=array(
		'cat'=> $cat,
		'posts_per_page'=> $count,
		'ignore_sticky_posts' => true
	);
	
	$the_query = new WP_Query($args);
		$counter = 1;

	$blogID = get_option('page_for_posts');

	if($cat) {
		$link = get_category_link( $cat );
		$color = df_title_color($cat, 'category', false);
	} else {
		$link = get_page_link($blogID);
		$color = df_title_color($blogID, 'page', false);
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
		<div class="tb_widget_timeline clearfix">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php

                //categories
                $categories = get_the_category($the_query->post->ID);
                $catCount = count($categories);
                //select a random category id
                $id = rand(0,$catCount-1);
                if(isset($categories[$id]->term_id)) {
                    $titleColor = df_title_color($categories[$id]->term_id, "category", false); 
                } else {
                    $titleColor = df_get_option(THEME_NAME."_pageColorScheme");
                }

			?>
                <!-- Article -->
                <article>
                    <span class="date"><?php the_time("d/m/Y");?></span>
                    <span class="time"><?php the_time("H:i");?></span>
                    <div class="timeline_content">
                        <i class="fa fa-clock-o" style="color: <?php echo esc_attr__($titleColor);?>"></i>
                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    </div>
                </article><!-- End Article -->
			<?php endwhile; else: ?>
				<p><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></p>
			<?php endif; ?>
		</div>

	<?php echo balanceTags($after_widget); ?>

      <?php
	}
}
?>