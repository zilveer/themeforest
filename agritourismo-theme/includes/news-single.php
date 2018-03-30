<?php
	wp_reset_query();
?>

				<?php get_template_part(THEME_LOOP."loop","start"); ?>
					<?php ot_get_sidebar($post->ID, 'left'); ?>		
						<!-- BEGIN .content-main -->
						<div class="content-main alternate <?php OT_content_class($post->ID);?>">

							<?php if (have_posts()) : ?>

								<div class="article-header">
									<?php get_template_part(THEME_SINGLE."image"); ?>
									<h2><?php the_title();?></h2>
									<div class="article-icons">
										<?php echo the_author_posts_link();?>
										<span class="article-icon">
											<span class="icon-text">&#59148;</span>
											<?php 
												$postCategories = wp_get_post_categories( $post->ID );
												$catCount = count($postCategories);
												$i=1;
												foreach($postCategories as $c){
													$cat = get_category( $c );
													$link = get_category_link($cat->term_id);
												?>
													<a href="<?php echo $link;?>">
														<?php echo $cat->name;?>
													</a>
													<?php if($catCount!=$i) { echo ", "; } ?> 
												<?php
													$i++;
												}
											?>
										</span>
										<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" class="article-icon"><span class="icon-text">&#128340;</span><?php the_time("F j, Y");?></a>
										<?php if ( comments_open() ) : ?>
											<a href="<?php the_permalink();?>#comments" class="article-icon">
												<span class="icon-text">&#59160;</span>
												<?php comments_number(__("0 comments",THEME_NAME),__("1 comment",THEME_NAME),__("% comments",THEME_NAME)); ?>
											</a>
										<?php endif;?>
									</div>
								</div>
								<?php the_content();?>
								<?php 
									$args = array(
										'before'           => '<div class="post-pages"><p>' . __('Pages:', THEME_NAME),
										'after'            => '</p></div>',
										'link_before'      => '',
										'link_after'       => '',
										'next_or_number'   => 'number',
										'nextpagelink'     => __('Next page', THEME_NAME),
										'previouspagelink' => __('Previous page', THEME_NAME),
										'pagelink'         => '%',
										'echo'             => 1
									);

									wp_link_pages($args); 
								?>
								

								<div class="split-line-1"></div>

								<?php get_template_part(THEME_SINGLE."share"); ?>

							<?php get_template_part(THEME_SINGLE."post", "tags"); ?>

							<?php get_template_part(THEME_SINGLE."about", "author"); ?>

							<?php wp_reset_query(); ?>
							<?php if ( comments_open() ) : ?>
								<?php comments_template(); // Get comments.php template ?>
							<?php endif; ?>

						<?php else: ?>
							<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
						<?php endif; ?>
						<!-- END .content-main -->
						</div>

						<?php ot_get_sidebar($post->ID, 'right'); ?>	
				<?php get_template_part(THEME_LOOP."loop","end"); ?>
					
