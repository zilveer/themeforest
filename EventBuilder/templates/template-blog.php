<?php
/**
 * Template name: Blog
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<?php if(!is_front_page()) { ?>

			<div id="page-title">

				<div class="content page-title-container">

					<div class="container box">

						<div class="row">

							<div class="col-sm-12">

								<?php themesdojo_breadcrumb(); ?>

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php the_title(); ?></h1>

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

		<?php } ?>

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-8">

						<?php

							global $paged, $wp_query, $wp;

							$args = wp_parse_args($wp->matched_query);

							if ( !empty ( $args['paged'] ) && 0 == $paged ) {

								$wp_query->set('paged', $args['paged']);

								$paged = $args['paged'];

							}

							$temp = $wp_query;

							$wp_query = null;

							$wp_query = new WP_Query();

							$wp_query->query('post_type=post&paged='.$paged);

						?>

						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

						<div <?php post_class(); ?>> 

							<div class="row">

								<div class="col-sm-12">

									<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-12">

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

								<div class="col-sm-12">

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
											<h5><a href="<?php echo esc_url($link); ?>"><?php echo esc_url($link); ?></a></h5>
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

						<?php endwhile; ?>
								
						<?php get_template_part('pagination'); ?>
										
						<?php $wp_query = null; $wp_query = $temp;?>

						<?php wp_reset_postdata(); ?>

					</div>

					<div class="col-sm-4">

						<?php get_sidebar('blog'); ?>

					</div>

				</section>

			</div>

		</div>

<?php get_footer(); ?>