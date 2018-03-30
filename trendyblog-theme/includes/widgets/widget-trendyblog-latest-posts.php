<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_cat_posts");'));

class DF_cat_posts extends WP_Widget {
	function DF_cat_posts() {
		parent::__construct (false, $name = THEME_FULL_NAME.' '.esc_html__("Latests News", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Latests News", THEME_NAME),
			'subtitle' => '',
			'cat' => '',
			'count' => '3',
			'images' => 'show',
			'style' => '1',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$cat = $instance['cat'];
		$count = $instance['count'];
		$images = $instance['images'];
		$style = $instance['style'];
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
			<select name="<?php echo esc_attr($this->get_field_name('cat')); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value=""><?php esc_html_e("Latest News", THEME_NAME);?></option>
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo esc_attr($ar->term_id); ?>" <?php if($ar->term_id==$cat)  {echo 'selected="selected"';} ?>><?php echo esc_html__($ar->cat_name); ?></option>
				<?php } ?>
			</select>
			
			</label></p>			
			<p><label for="<?php echo esc_attr($this->get_field_id('images')); ?>"><?php esc_html_e( 'Images:' , THEME_NAME );?>
			<select name="<?php echo esc_attr($this->get_field_name('images')); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value="show" <?php if("show"==$images)  {echo 'selected="selected"';} ?>><?php esc_html_e("Show", THEME_NAME);?></option>
				<option value="hide" <?php if("hide"==$images)  {echo 'selected="selected"';} ?>><?php esc_html_e("Hide", THEME_NAME);?></option>
			</select>
			
			</label></p>			
			<p><label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php esc_html_e( 'Style:' , THEME_NAME );?>
			<select name="<?php echo esc_attr($this->get_field_name('style')); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value="1" <?php if("1"==$style)  {echo 'selected="selected"';} ?>><?php esc_html_e("Small Images", THEME_NAME);?></option>
				<option value="2" <?php if("2"==$style)  {echo 'selected="selected"';} ?>><?php esc_html_e("Large Images", THEME_NAME);?></option>
				<option value="3" <?php if("3"==$style)  {echo 'selected="selected"';} ?>><?php esc_html_e("Large Images With Borders", THEME_NAME);?></option>
			</select>
			
			</label></p>
			<p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Post count:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('count')); ?>" name="<?php echo esc_attr__($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr__($count); ?>" /></label></p>

			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['images'] = strip_tags($new_instance['images']);
		$instance['style'] = strip_tags($new_instance['style']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$count = $instance['count'];
		$cat = $instance['cat'];
		$images = $instance['images'];
		$style = $instance['style'];
		if(!isset($style)) $style = false; 

	
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
		<?php if($style=="2") { ?>
			<div class="tb_widget_overlay_list clearfix">
		<?php  } else if($style=="3") { ?>
			<div class="tb_widget_border_list clearfix">
		<?php } else { ?>
			<div class="<?php if($images!="hide") { ?>tb_widget_recent_list <?php } else { ?>tb_widget_posts_big <?php } ?>clearfix">

		<?php } ?>
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php

                //categories
                $categories = get_the_category(get_the_ID());
                $catCount = count($categories);
                //select a random category id
                $id = rand(0,$catCount-1);
                if(isset($categories[$id]->term_id)) {
                    $titleColor = df_title_color($categories[$id]->term_id, "category", false); 
                } else {
                    $titleColor = df_get_option(THEME_NAME."_pageColorScheme");
                }
			?>
				<?php if($style=="2") { ?>

			        <!-- Post item -->
			        <div class="item clearfix">
			            <div class="item_thumb">
			                <div class="thumb_hover">
			                    <a href="<?php the_permalink();?>">
			                    	<?php echo df_image_html($the_query->post->ID,500,500,"visible animated");?>
			                    </a>
			                </div>
			                <div class="inner_content">
	                            <?php 
	                                if(count(get_the_category(get_the_ID()))>=1 && df_option_compare("postCategory","postCategory", get_the_ID())==true) {
	                            ?>
	                                <div class="thumb_meta">
                                        <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>" style="background-color: <?php echo esc_attr__($titleColor);?>">
                                            <span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>"> 
                                             	<?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
                                        	</span>
                                        </a>
	                                    
	                                </div>
	                            <?php } ?>
			                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
			                </div>
			            </div>
			        </div><!-- End Post item -->
				<?php } elseif($style=="3") { ?>
			        <!-- Post item -->
			        <div class="item clearfix">
			            <div class="item_thumb">
			                <div class="thumb_hover">
			                    <a href="<?php the_permalink();?>">
			                    	<?php echo df_image_html($the_query->post->ID,500,300,"visible animated");?>
			                    </a>
			                </div>
			                <div class="inner_content">
	                            <?php 
	                                if(count(get_the_category(get_the_ID()))>=1 && df_option_compare("postCategory","postCategory", get_the_ID())==true) {
	                            ?>
	                                <div class="thumb_meta">
                                        <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>" style="background-color: <?php echo esc_attr__($titleColor);?>">
                                            <span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>"> 
                                             	<?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
                                        	</span>
                                        </a>
	                                    
	                                </div>
	                            <?php } ?>
			                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
			             	</div>
			            </div>
			        </div><!-- End Post item -->

				<?php } else { ?>
					<?php if($images!="hide") { ?>
		                <!-- Post item -->
		                <div class="item clearfix">
		                    <div class="item_thumb">
		                        <?php if(df_option_compare("showTumbIcon","showTumbIcon", $the_query->post->ID)==true) { ?>
		                            <div class="thumb_icon">
		                                <a href="<?php the_permalink();?>" style="background-color: <?php echo esc_attr__($titleColor);?>"><?php df_image_icons($the_query->post->ID);?></a>
		                            </div>
		                        <?php } ?>
		                        <div class="thumb_hover">
		                            <a href="<?php the_permalink();?>">
		                            	<?php echo df_image_html($the_query->post->ID,500,500,"visible animated");?>
		                            </a>
		                        </div>
		                    </div>
		                    <div class="item_content">
		                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
		                        <div class="item_meta clearfix">
		                            <?php if(df_option_compare('postDate','postDate',$the_query->post->ID)==true) { ?>
		                                <span class="meta_date">
		                                    <a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
		                                        <?php the_time(get_option('date_format'));?>
		                                    </a>
		                                </span>
		                            <?php } ?>
		                            <?php if(df_option_compare('showLikes','showLikes',$the_query->post->ID)==true) { ?>
		                                <span class="meta_likes">
		                                    <a href="<?php the_permalink();?>"><?php echo intval(get_post_meta( $the_query->post->ID, "_".THEME_NAME."_total_votes", true ));?></a>
		                                </span>
		                            <?php } ?>
		                        </div>
		                    </div>
		                </div><!-- End Post item -->
		                <?php } else { ?>
	                        <!-- Post item -->
	                        <div class="item clearfix">
	                            <div class="item_content">
	                                <h4>
	                                	<a href="<?php the_permalink();?>">
			                            <?php 
			                                if(count(get_the_category($the_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $the_query->post->ID)==true) {
			                            ?>
			                                <span class="format" style="background-color: <?php echo esc_attr__($titleColor);?>">
			                                    <?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
			                                </span>
			                            <?php } ?>
	                                		<?php the_title();?>
	                                	</a>
	                                </h4>
		                            <?php 
		                                add_filter('excerpt_length', 'df_new_excerpt_length_10');
		                                the_excerpt();
		                                remove_filter('excerpt_length', 'df_new_excerpt_length_10');
		                            ?>
	                                <div class="item_meta clearfix">
				                        <?php if(df_option_compare('postDate','postDate',$the_query->post->ID)==true) { ?>
				                            <span class="meta_date">
				                                <a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
				                                    <?php the_time(get_option('date_format'));?>
				                                </a>
				                            </span>
				                        <?php } ?>
				                        <?php if(df_option_compare("postComments","postComments", $the_query->post->ID)==true && comments_open()) { ?>
				                            <span class="meta_comments">
				                                <a href="<?php the_permalink();?>#comment">
				                                    <?php comments_number('0','1','%'); ?>
				                                </a>
				                            </span>
				                        <?php } ?>
				                        <?php if(df_option_compare('showLikes','showLikes',$the_query->post->ID)==true) { ?>
				                            <span class="meta_likes">
				                                <a href="<?php the_permalink();?>"><?php echo intval(get_post_meta( $the_query->post->ID, "_".THEME_NAME."_total_votes", true ));?></a>
				                            </span>
				                        <?php } ?>
	                                </div>
	                            </div>
	                        </div><!-- End Post item -->
		                <?php } ?>
		            <?php } ?>

			<?php endwhile; else: ?>
				<p><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></p>
			<?php endif; ?>
		</div>

	<?php echo balanceTags($after_widget); ?>

      <?php
	}
}
?>