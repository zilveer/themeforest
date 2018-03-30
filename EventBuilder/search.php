<?php
/**
 * Search page
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<div id="page-title">

			<div class="content page-title-container">

				<div class="container box">

					<div class="row">

						<div class="col-sm-12">

							<?php themesdojo_breadcrumb(); ?>

							<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php _e( 'Search results for: ', 'themesdojo' ); ?><?php the_search_query(); ?></h1>

						</div>

					</div>

				</div>

			</div>

			<div class="page-title-bg">

					<?php if(has_post_thumbnail()) { ?>

						<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($image_src[0]); ?>" alt="" />

					<?php } elseif(!empty($redux_default_img_bg)) { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($redux_default_img_bg); ?>" alt="" />

					<?php } else { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo get_template_directory_uri(); ?>/images/title-bg.jpg" alt="" />

					<?php } ?>

				</div>

		</div>

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-8">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php if (get_post_type($post) == 'page') { ?>

						<div class="post"> 

							<div class="row">

								<div class="col-sm-3">



								</div>

								<div class="col-sm-9">

									<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-3">

									<span class="post-info">
										<i class="fa fa-file-text-o"></i><?php _e( 'Page', 'themesdojo' ); ?>
									</span>
									<span class="post-info">
										<i class="fa fa-user"></i><?php the_author_posts_link(); ?> 
									</span>
									<span class="post-info">
										<i class="fa fa-clock-o"></i><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('M j, Y') ?></a>
									</span>

								</div>

								<div class="col-sm-9">

									<span class="post-excerpt">
										<?php
											$content = get_the_content();
											echo wp_trim_words( $content , '50' ); 
										?>
									</span>

									<a class="read-more" href="<?php the_permalink() ?>"><?php _e( 'View Page', 'themesdojo' ); ?></a>

								</div>

							</div>

						</div>

						<?php } else { ?>

						<div class="post"> 

							<div class="row">

								<div class="col-sm-3">



								</div>

								<div class="col-sm-9">

									<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-3">

									<span class="post-info sticky-post-icon">
										<i class="fa fa-thumb-tack"></i><?php _e( 'Sticky', 'themesdojo' ); ?>
									</span>
									<span class="post-info">
										<i class="fa fa-user"></i><?php the_author_posts_link(); ?> 
									</span>
									<span class="post-info">
										<i class="fa fa-clock-o"></i><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('M j, Y') ?></a>
									</span>
									<span class="post-info">
										<i class="fa fa-folder"></i><?php the_category(', '); ?>
									</span> 
									<span class="post-info">
										<i class="fa fa-comment"></i><a href="<?php comments_link(); ?>"><?php $my_comments = get_comments_number( $post->ID ); echo esc_attr($my_comments); ?></a>
									</span>

								</div>

								<div class="col-sm-9">

									<?php if(function_exists('get_post_format') && 'image' == get_post_format($post->ID)) : ?>

										<a class="image-block" href="<?php the_permalink() ?>">
														
											<?php the_post_thumbnail('blog_post_image'); ?>
														
										</a>

									<?php elseif(function_exists('get_post_format') && 'video' == get_post_format($post->ID)) : ?>

										<div class="video-post">
											<?php 
												$embed = get_post_meta($post->ID, '_td_video_embed_code', true);
															       
												echo stripslashes(htmlspecialchars_decode($embed));
											?>
										</div>

									<?php elseif(function_exists('get_post_format') && 'quote' == get_post_format($post->ID)) : ?>

										<div class="quote-post">
											<?php 
												$quote = get_post_meta($post->ID, '_td_quote', true);
												$quote_author = get_post_meta($post->ID, '_td_quote_author', true);
											?>
											<h4><?php echo esc_attr($quote); ?></h4>
											<cite><?php echo esc_attr($quote_author); ?></cite>
										</div>

									<?php elseif(function_exists('get_post_format') && 'gallery' == get_post_format($post->ID)) : ?>

										<?php

					                        /* add javascript */
					                        wp_enqueue_script( 'td-flexslider' );
					                                                                
					                    ?>

				                        <script type='text/javascript'>
				                            jQuery(function() {
				                                jQuery('.flexslider').flexslider( {
				                                    slideshowSpeed: 4200,   
				                                    animationSpeed: 500, 
				                                });
				                            });
				                        </script>

										<div class="flexslider">
											<ul class="slides">

												<?php
													$attachments = get_children(array('post_parent' => $post->ID,
																					'post_status' => 'inherit',
																					'post_type' => 'attachment',
																					'post_mime_type' => 'image',
																					'order' => 'ASC',
																					'orderby' => 'menu_order ID'));

													foreach($attachments as $att_id => $attachment) {
                                                            
                                    				$medium_img_urls = wp_get_attachment_image_src( $attachment->ID, 'featured_list_image' );
												?>

													<?php get_template_part( 'inc/BFI_Thumb' ); ?>

                                        			<?php $params = array( 'width' => 1000, 'height' => 600, 'crop' => true ); ?>

													<li><img src="<?php echo esc_url( bfi_thumb( "$medium_img_urls[0]", $params ) ); ?>" alt="<?php echo esc_attr($attachment->post_title); ?>" /></li>

												<?php
													}
												?>
											</ul>
										</div>

									<?php elseif(function_exists('get_post_format') && 'link' == get_post_format($post->ID)) : ?>

										<div class="link-post">
											<?php 
												$link = get_post_meta($post->ID, '_td_link_url', true);
											?>
											<h3><a href="<?php echo esc_url($link); ?>"><?php echo esc_url($link); ?></a></h3>
										</div>

									<?php else : ?>

										<?php if (has_post_thumbnail() ) { ?>

											<a class="image-block" href="<?php the_permalink() ?>">
															
												<?php the_post_thumbnail('blog_post_image'); ?>
															
											</a>

										<?php } ?>

									<?php endif; ?>

									<span class="post-excerpt">
										<?php
											$content = get_the_content();
											echo wp_trim_words( $content , '50' ); 
										?>
									</span>

									<a class="read-more" href="<?php the_permalink() ?>"><?php _e( 'Read More', 'themesdojo' ); ?></a>

								</div>

							</div>

						</div>

						<?php } ?>
								
						<?php endwhile; ?>

						<?php get_template_part('pagination'); ?>

						<?php else: ?>

							<div class="full post">
								<p><strong><?php _e('Nothing Found', 'themesdojo'); ?></strong><br/>
									<?php _e('Sorry, no posts matched your criteria. Try another search?', 'themesdojo'); ?>
								</p>
											
								<?php _e('You might want to consider some of our suggestions to get better results:', 'themesdojo'); ?></p>
								<ul>
									<li><?php _e('Check your spelling.', 'themesdojo'); ?></li>
									<li><?php _e('Try a similar keyword, for example: tablet instead of laptop.', 'themesdojo'); ?></li>
									<li><?php _e('Try using more than one keyword.', 'themesdojo'); ?></li>
								</ul>

							</div>

						<?php endif; ?>

					</div>

					<div class="col-sm-4">

						<?php get_sidebar('blog'); ?>

					</div>

				</section>

			</div>

		</div>

<?php get_footer(); ?>