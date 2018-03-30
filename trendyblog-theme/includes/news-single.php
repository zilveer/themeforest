<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
	$slider = get_post_meta( $post->ID, THEME_NAME."_gallery_images", true );
	$audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );
	$image = get_post_thumb($post->ID,0,0); 
	$votes = get_post_meta( $post->ID, "_".THEME_NAME."_total_votes", true );

	if(isset($_COOKIE[THEME_NAME.'_rating_'.$post->ID])) {
		$voteCookie = $_COOKIE[THEME_NAME.'_rating_'.$post->ID];	
	} else {
		$voteCookie = null;
	}
?>

	<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $ratingsAverage = df_avarage_rating( $post->ID); ?>
            <!-- Post -->
            <article <?php post_class('post'); ?>>
				<?php get_template_part(THEME_SINGLE."image");?>
				<div class="shortcode-content">
					<?php if((df_option_compare('postDate','postDate',$post->ID)==true) || (df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) || ($ratingsAverage) || df_option_compare("postAuthor","postAuthor", $post->ID)==true || (df_option_compare('showLikes','showLikes',$post->ID)==true && ($video || $audio || $slider || df_option_compare('show_single_thumb','show_single_thumb',$post->ID)!=true && $image['show']!=true))) { ?>
	                    <?php $full_meta = true;?>
	                    <!-- Full meta -->
	                    <div class="full_meta clearfix">
	                        <span class="meta_format"><?php df_image_icons($post->ID);?></span>
							<?php if(df_option_compare('postDate','postDate',$post->ID)==true) { ?>
								<span class="meta_date date updated">
									<a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
										<?php the_time(get_option('date_format'));?>
									</a>
								</span>
							<?php } ?>
	                        <?php if(df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) { ?>
	                            <span class="meta_comments"><a href="<?php the_permalink();?>#comments"><?php comments_number(esc_html__('Comments 0', THEME_NAME), esc_html__('Comments 1', THEME_NAME), esc_html__('Comments %', THEME_NAME)); ?></a></span>
	                        <?php } ?>
	                        <?php if(df_option_compare("postAuthor","postAuthor", $post->ID)==true) { ?>
	                            <span class="meta_author">
	                            	<?php echo the_author_posts_link();?>
	                            </span>
	                        <?php } ?>
	                        <?php if(df_option_compare('showLikes','showLikes',$post->ID)==true && ($video || $audio || $slider || df_option_compare('show_single_thumb','show_single_thumb',$post->ID)!=true || $image['show']!=true)) { ?>
						        <span class="meta_likes">
						        	<a href="javascript:void(0);" data-heart="<?php echo intval($votes);?> <?php if($votes==1) { esc_attr_e("like", THEME_NAME); } else { esc_attr_e("likes", THEME_NAME); }?>" data-id="<?php echo intval($post->ID);?>"<?php if(isset($voteCookie)) { ?> class="voted"<?php } ?>><?php echo intval($votes);?></a>
						        </span>
	                        <?php } ?>
	                        <?php if(df_option_compare('postViews','postViews',$post->ID)==true) { ?>
								<span class="meta_views"><?php echo DF_getPostViews($post->ID);?> <?php if(DF_getPostViews($post->ID)==1) { esc_html_e("View", THEME_NAME); } else { esc_html_e("Views", THEME_NAME); } ?></span>
	                        <?php } ?>
	                        <?php if($ratingsAverage) { ?>
		                        <span class="meta_rating" title="<?php esc_html_e("Rated", THEME_NAME);?> <?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?>">
		                            <span style="width: <?php echo floatval($ratingsAverage[0]);?>%">
		                                <strong><?php echo floatval($ratingsAverage[1]);?></strong>
		                            </span>
		                        </span>
	                        <?php } ?>

	                    </div><!-- End Full meta -->
                    <?php 
                		} else { 
                    		$full_meta = false; 
                    	}
                    ?>
                    <!-- Entry content -->
                    <div class="entry_content"<?php if($full_meta==false) { ?> style="padding:0px;"<?php } ?>>
						<?php get_template_part(THEME_SINGLE."post-title"); ?>
							<?php wp_reset_query();?>		
							<?php the_content();?>	
							<?php 
								$args = array(
									'before'           => '<div class="post-pages"><p>' . esc_html__('Pages:', THEME_NAME),
									'after'            => '</p></div>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'nextpagelink'     => esc_html__('Next page', THEME_NAME),
									'previouspagelink' => esc_html__('Previous page', THEME_NAME),
									'pagelink'         => '%',
									'echo'             => 1
								);

								wp_link_pages($args); 
							?>
					</div>
					<?php get_template_part(THEME_SINGLE."post-nav"); ?>	
					<!-- End Entry content -->
					<?php get_template_part(THEME_SINGLE."post-tags-categories"); ?>	
					<?php get_template_part(THEME_SINGLE."post-share"); ?>	
					
					<?php get_template_part(THEME_SINGLE."about-author"); ?>
					<?php get_template_part(THEME_SINGLE."post-ratings"); ?>
				 </article>
				<?php get_template_part(THEME_SINGLE."post-related"); ?>


				
				
			<?php endwhile; else: ?>
				<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			<?php if ( comments_open() ) : ?>
				<?php comments_template(); // Get comments.php template ?>
			<?php endif; ?>
	<?php get_template_part(THEME_LOOP."loop-end"); ?>