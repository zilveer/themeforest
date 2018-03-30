<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//braking slider		
	$breakingSlider = df_get_option(THEME_NAME.'_breaking_slider');
	

?>
	<?php
		if(is_category()) {
			$catId = get_cat_id( single_cat_title("",false) );
			$category_in = $catId;
		} else {
			$category_in = $breakingSlider;
		}

		$args=array(
			'category__in' => $category_in,
			'posts_per_page' => 6,
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_breaking_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);
		$the_query = new WP_Query($args);
	?>


					<!-- BEGIN .breaking-news -->
					<div class="breaking-news">
						<div class="container">
							<div class="breaking-title">
								<h3><?php esc_html_e("Breaking News", THEME_NAME);?></h3>
							</div>
							<div class="breaking-block">
								<ul>
									<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<?php
					                    //get all post categories
					                    $categories = get_the_category($the_query->post->ID);
					                    $catCount = count($categories);
					                    //select a random category id
					                    $id = rand(0,$catCount-1);
					                    //cat id
					                    $catId = $categories[$id]->term_id;		
										//post details
										$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true );
										$postCommentsSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_post_comments_single", true );		
					                   ?>
									<li>
										<?php if(count(get_the_category($the_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $the_query->post->ID)==true) { ?>
											<a href="<?php echo get_category_link($catId);?>" class="break-category" style="background-color: <?php df_title_color($catId, 'category', true);?>;"><?php echo get_cat_name($catId);?></a>
										<?php } ?>
										<h4>
											<a href="<?php the_permalink();?>"><?php the_title();?></a>
										</h4>
										<?php if(df_option_compare("postComments","postComments", $the_query->post->ID)==true && comments_open()) { ?>
											<a href="<?php the_permalink();?>#comments" class="comment-link">
												<i class="fa fa-comment-o"></i><?php comments_number('0','1','%'); ?>
											</a>
										<?php } ?>
									</li>
									<?php endwhile; else: ?>
										<li><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></li>
									<?php endif; ?>

								</ul>
							</div>
						
						</div>
					<!-- END .breaking-news -->
					</div>

<?php wp_reset_query();  ?>