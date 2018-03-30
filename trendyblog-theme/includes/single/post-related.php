<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	if(df_option_compare('similar_posts','similar_posts',$post->ID)==true &&  !is_attachment() && get_post_type() == "post") {
	
		wp_reset_query();
		$categories = get_the_category($post->ID);
	    $catCount = count($categories);
	    //select a random category id
	    $id = rand(0,$catCount-1);
	    //cat id
	    $catId = $categories[$id]->term_id;
	    $count = df_get_option(THEME_NAME.'_similar_post_count');
	    if(!$count) $count = 3;

		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=> $count,
				'ignore_sticky_posts'=>1,
				'orderby' => 'rand'
			);

			$my_query = new wp_query($args);
			$postCount = $my_query->post_count;
			$counter = 1;
?>
    <!-- You might also like -->
    <div class="panel_title">
        <div>
            <h4><?php esc_html_e("You might also like", THEME_NAME);?></h4>
        </div>
    </div>
    <div class="row">
		<?php
			wp_reset_query();
			if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) {
					$my_query->the_post();

					//categories
					$categories = get_the_category($my_query->post->ID);
				    $catCount = count($categories);
				    //select a random category id
				    $id = rand(0,$catCount-1);
					$titleColor = df_title_color($categories[$id]->term_id, "category", false);


					$image = get_post_thumb($post->ID,500,500); 
		?>
	        <div class="col col_4_of_12">
	            <!-- Layout post 1 -->
	            <div class="layout_post_1">
	                <div class="item_thumb">
	                    <div class="thumb_icon">
	                        <a href="<?php the_permalink();?>" style="background-color: <?php echo esc_attr__($titleColor);?>"><i class="fa fa-copy"></i></a>
	                    </div>
	                    <?php
	                    	if(df_get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true) {
						?>
						    <div class="thumb_hover">
						        <a href="<?php the_permalink();?>">
						        	<?php echo df_image_html($my_query->post->ID,500,500);?>
						        </a>
						    </div>

						<?php } ?>
	                    <div class="thumb_meta">
							<?php 
								if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {

							?>
								<span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>">
									<?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
								</span>
							<?php } ?>
							<?php if(df_option_compare("postComments","postComments", $my_query->post->ID)==true && comments_open()) { ?>
								<span class="comments">
									<a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1Comments', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a>
								</span>
							<?php } ?>
	                    </div>
	                </div>
	                <div class="item_content">
	                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<?php 
							if(df_get_option(THEME_NAME.'_similar_post_excerpt') != "off") {
								add_filter('excerpt_length', 'df_new_excerpt_length_30');
								the_excerpt();
								remove_filter('excerpt_length', 'df_new_excerpt_length_30');
							}
						?>

	                </div>
	            </div><!-- End Layout post 1 -->
	        </div>
             <?php 
                if($counter%3==0 && $counter!=$my_query->post_count) { ?>
                </div>
                <div class="row">
            <?php } ?>

		<?php
			$counter++;
				}
			} else { 
				esc_html_e('Sorry, no posts were found.' , THEME_NAME ); 
			}
		?>
    </div><!-- End You might also like -->

	<?php } ?>
<?php } ?>

<?php wp_reset_query();  ?>
