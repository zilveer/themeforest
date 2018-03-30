<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//main slider
	$mainSlider = get_post_meta ( DF_page_id(), "_".THEME_NAME."_main_slider", true ); 

	//slide counter
	$counter = 1;
	$totalCounter = 0;
	if((is_array($mainSlider) && !empty($mainSlider) && !in_array("slider_off",$mainSlider)) || (is_category() && $mainSlider=="on")) { 
		$args=array(
			'category__in' => $mainSlider,
			'showposts' => df_get_option(THEME_NAME."_main_slider_count"),
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_main_slider_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);


		$the_query = new WP_Query($args);
?>
    <!-- Content slider -->
    <div class="content_slider">
        <ul>
        	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        		<?php 
        			$image = get_post_thumb($the_query->post->ID,1170,579,THEME_NAME.'_homepage_image');  

					//categories
					$categories = get_the_category($post->ID);
				    $catCount = count($categories);
				    //select a random category id
				    $id = rand(0,$catCount-1);
				    if(isset($categories[$id]->term_id)) {
						$titleColor = df_title_color($categories[$id]->term_id, "category", false);	
				    } else {
				    	$titleColor = df_get_option(THEME_NAME."_pageColorScheme");
				    }
        		?>
	            <!-- Item -->
	            <li>
	                <a href="<?php the_permalink();?>">
	                	<img src="<?php echo esc_url($image['src']);?>" alt="<?php esc_attr_e(get_the_title());?>">
	                </a>
	                <div class="slider_caption">
	                    <div class="thumb_meta">
							<?php 
								if(count(get_the_category($the_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $the_query->post->ID)==true) {
							?>
								<a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
									<span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>">
										<?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
									</span>
								</a>
							<?php } ?>
							<?php if(df_option_compare("postComments","postComments", $the_query->post->ID)==true && comments_open()) { ?>
								<span class="comments">
									<a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1Comments', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a>
								</span>
							<?php } ?>
	                    </div>
	                    <div class="thumb_link">
	                        <h3>
	                        	<a href="<?php the_permalink();?>"><?php the_title();?></a>
	                        </h3>
	                    </div>
	                </div>
	            </li><!-- End Item -->
			<?php endwhile; else: ?>
				<p><?php  esc_html_e('No posts where found, please edit a post and set it as main slider post.', THEME_NAME); ?></p>
			<?php endif; ?>
        </ul>
    </div><!-- End Content slider -->
	<?php } ?>
<?php wp_reset_query();  ?>