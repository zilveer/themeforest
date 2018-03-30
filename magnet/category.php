<?php get_header(); ?>
<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();

$sidebar = $qode_options_magnet['category_blog_sidebar'];
?>
			
	<div class="container">
		<div class="container_inner clearfix">
			<div class="title">	
				<h1><?php single_cat_title(''); ?></h1>
			</div>
		</div>
	</div>
	
	<?php if($qode_options_magnet['show_back_button'] == "yes") { ?>
		<a id='back_to_top' href='#'>
			<span class='back_to_top_inner'>
				<span>&nbsp;</span>
			</span>
		</a>
	<?php } ?>

	<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){
			echo do_shortcode($revslider);
		}
	?>
	<div class="container">
		<div class="container_inner clearfix">
		<?php if(($sidebar == "default")||($sidebar == "")) : ?>
				<?php switch ($qode_options_magnet['blog_style']) {
									case 1: ?>
										<div class="posts_holder">
				
											<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php post_class(); ?>>
												<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
													<div class="image">
													
													<?php echo slider_blog(get_the_ID());?>	
													</div>
													<?php } else {?>
													<?php if ( has_post_thumbnail() ) { ?>
													<div class="image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
																<?php the_post_thumbnail('blog-type-1-big'); ?>
														</a>
													</div>
													<?php } } ?>
												<div class="text <?php if (!has_post_thumbnail()){ echo 'no_image'; }?>">
													<div class="text_inner">
														
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<p><?php the_excerpt(); ?></p>
														<a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a>
														<div class="info">
															<span class="left"><?php the_time('d M Y'); ?> <?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
															<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
														</div>
													</div>
												</div>
											</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
											<?php wp_reset_query(); ?>
										</div>
									 <?php	break;
									case 2: ?>
										<div class="blog_holder3">
											<div class="blog_holder3_inner">
												<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
													<article <?php post_class(); ?>>
														
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
														<div class="image">
														
														<?php echo slider_blog(get_the_ID());?>	
														</div>
														<?php } else {?>
														<?php if ( has_post_thumbnail() ) { ?>
														<div class="image">
															<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															
																	<?php	the_post_thumbnail('full'); ?>
															</a>
														</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<div class="text">
															<div class="text_inner">
																
																<span class="button">
																	<span><?php the_time('d M, Y'); ?></span>
																</span>
																
																<?php the_excerpt(); ?>
																
																<div class="info">
																	<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																	<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
																</div>
															
															</div>
														</div>
														
													</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									</div>
									<?php	break;
									case 3: ?>
										<div class="posts_holder1 clearfix">
											<?php $post_count = 0; ?>
											<?php if(have_posts()) : ?>
												<div class="clearfix">
												<?php while ( have_posts() ) : the_post(); ?>
												<?php if ((($post_count%3)==0) && ($post_count > 0)) { ?>
												</div><div class="clearfix">
												<?php } ?>
												<article <?php post_class(); ?>>
													<div class="article_inner">
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
															<div class="image">
																<?php echo slider_blog(get_the_ID());?>	
															</div>
														<?php } else {?>
															<?php if ( has_post_thumbnail() ) { ?>
																	<div class="image">
																		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
																		
																				<?php	the_post_thumbnail('blog-type-3-big'); ?>
																		</a>
																	</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														
														<div class="text">
															<div class="text_inner">
																<span><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																<p><?php the_excerpt(); ?></p>
															</div>
														</div>
														<div class="info">
															<span class="left"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
															<span class="right"> <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
														</div>
													</div>
												</article>
												<?php $post_count++; ?>
												<?php endwhile; ?>
												</div>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									
									
									<?php	break;
									case 4: ?>
										<div class="posts_holder1 posts_holder1_v2 clearfix">
											<?php $post_count = 0; ?>
											<?php if(have_posts()) : ?>
												<div class="clearfix">
												<?php while ( have_posts() ) : the_post(); ?>
												<?php if ((($post_count%2)==0) && ($post_count > 0)) { ?>
												</div><div class="clearfix">
												<?php } ?>
												<article <?php post_class(); ?>>
													<div class="article_inner">
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
															<div class="image">
																<?php echo slider_blog(get_the_ID());?>	
															</div>
														<?php } else {?>
															<?php if ( has_post_thumbnail() ) { ?>
																	<div class="image">
																		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
																		
																				<?php	the_post_thumbnail('blog-type-4-big'); ?>
																		</a>
																	</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														
														<div class="text">
															<div class="text_inner">
																<span><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																<p><?php the_excerpt(); ?></p>
															</div>
														</div>
														<div class="info">
															<span class="left"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
															<span class="right"> <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
														</div>
													</div>
												</article>
												<?php $post_count++; ?>
												<?php endwhile; ?>
												</div>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									<?php	break;
									case 5: ?>
										<div class="blog_holder3">
											<div class="blog_holder3_inner">
											<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
												<article <?php post_class(); ?>>
													
													<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
													<div class="image">
													
													<?php echo slider_blog(get_the_ID());?>	
													</div>
													<?php } else {?>
													<?php if ( has_post_thumbnail() ) { ?>
													<div class="image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
																<?php	the_post_thumbnail('full'); ?>
														</a>
													</div>
													<?php } } ?>
													<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
													<div class="text">
															<div class="text_inner">
																
																<span class="button">
																	<span><?php the_time('d M, Y'); ?></span>
																</span>
																
																<?php the_content(); ?>
																
																<div class="info">
																	<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																	<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
																</div>
															
															</div>
														</div>
													
												</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php	break;
									
							}
							
							?>
		<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
			<div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> clearfix">
						<div class="column1">
							<div class="column_inner">
									<?php switch ($qode_options_magnet['blog_style']) {
									case 1: ?>
										<div class="posts_holder">
				
											<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php post_class(); ?>>
												<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
													<div class="image">
													
													<?php echo slider_blog(get_the_ID());?>	
													</div>
													<?php } else {?>
													<?php if ( has_post_thumbnail() ) { ?>
													<div class="image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
																<?php the_post_thumbnail('blog-type-1-big'); ?>
														</a>
													</div>
													<?php } } ?>
												<div class="text <?php if (!has_post_thumbnail()){ echo 'no_image'; }?>">
													<div class="text_inner">
														
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<p><?php the_excerpt(); ?></p>
														<a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a>
														<div class="info">
															<span class="left"><?php the_time('d M Y'); ?> <?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
															<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
														</div>
													</div>
												</div>
											</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
											<?php wp_reset_query(); ?>
										</div>
									 <?php	break;
									case 2: ?>
										<div class="blog_holder3">
											<div class="blog_holder3_inner">
												<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
													<article <?php post_class(); ?>>
														
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
														<div class="image">
														
														<?php echo slider_blog(get_the_ID());?>	
														</div>
														<?php } else {?>
														<?php if ( has_post_thumbnail() ) { ?>
														<div class="image">
															<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															
																	<?php	the_post_thumbnail('full'); ?>
															</a>
														</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<div class="text">
															<div class="text_inner">
																
																<span class="button">
																	<span><?php the_time('d M, Y'); ?></span>
																</span>
																
																<?php the_excerpt(); ?>
																
																<div class="info">
																	<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																	<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
																</div>
															
															</div>
														</div>
														
													</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									</div>
									<?php	break;
									case 3: ?>
										<div class="posts_holder1 clearfix">
											<?php $post_count = 0; ?>
											<?php if(have_posts()) : ?>
												<div class="clearfix">
												<?php while ( have_posts() ) : the_post(); ?>
												<?php if ((($post_count%3)==0) && ($post_count > 0)) { ?>
												</div><div class="clearfix">
												<?php } ?>
												<article <?php post_class(); ?>>
													<div class="article_inner">
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
															<div class="image">
																<?php echo slider_blog(get_the_ID());?>	
															</div>
														<?php } else {?>
															<?php if ( has_post_thumbnail() ) { ?>
																	<div class="image">
																		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
																		
																				<?php	the_post_thumbnail('blog-type-3-big'); ?>
																		</a>
																	</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														
														<div class="text">
															<div class="text_inner">
																<span><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																<p><?php the_excerpt(); ?></p>
															</div>
														</div>
														<div class="info">
															<span class="left"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
															<span class="right"> <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
														</div>
													</div>
												</article>
												<?php $post_count++; ?>
												<?php endwhile; ?>
												</div>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									
									
									<?php	break;
									case 4: ?>
										<div class="posts_holder1 posts_holder1_v2 clearfix">
											<?php $post_count = 0; ?>
											<?php if(have_posts()) : ?>
												<div class="clearfix">
												<?php while ( have_posts() ) : the_post(); ?>
												<?php if ((($post_count%2)==0) && ($post_count > 0)) { ?>
												</div><div class="clearfix">
												<?php } ?>
												<article <?php post_class(); ?>>
													<div class="article_inner">
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
															<div class="image">
																<?php echo slider_blog(get_the_ID());?>	
															</div>
														<?php } else {?>
															<?php if ( has_post_thumbnail() ) { ?>
																	<div class="image">
																		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
																		
																				<?php	the_post_thumbnail('blog-type-4-big'); ?>
																		</a>
																	</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														
														<div class="text">
															<div class="text_inner">
																<span><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																<p><?php the_excerpt(); ?></p>
															</div>
														</div>
														<div class="info">
															<span class="left"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
															<span class="right"> <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
														</div>
													</div>
												</article>
												<?php $post_count++; ?>
												<?php endwhile; ?>
												</div>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									<?php	break;
									case 5: ?>
										<div class="blog_holder3">
											<div class="blog_holder3_inner">
											<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
												<article <?php post_class(); ?>>
													
													<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
													<div class="image">
													
													<?php echo slider_blog(get_the_ID());?>	
													</div>
													<?php } else {?>
													<?php if ( has_post_thumbnail() ) { ?>
													<div class="image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
																<?php	the_post_thumbnail('full'); ?>
														</a>
													</div>
													<?php } } ?>
													<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
													<div class="text">
															<div class="text_inner">
																
																<span class="button">
																	<span><?php the_time('d M, Y'); ?></span>
																</span>
																
																<?php the_content(); ?>
																
																<div class="info">
																	<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																	<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
																</div>
															
															</div>
														</div>
													
												</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php	break;
									
							}
							
							?>		
							</div>
						</div>
						<div class="column2">
						<?php get_sidebar(); ?>	
						</div>
					</div>
		<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
			<div class="<?php if($sidebar == "3"):?>two_columns_33_66<?php elseif($sidebar == "4") : ?>two_columns_25_75<?php endif; ?> clearfix">
						<div class="column1">
						<?php get_sidebar(); ?>	
						</div>
						<div class="column2">
							<div class="column_inner">
									<?php switch ($qode_options_magnet['blog_style']) {
									case 1: ?>
										<div class="posts_holder">
				
											<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php post_class(); ?>>
												<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
													<div class="image">
													
													<?php echo slider_blog(get_the_ID());?>	
													</div>
													<?php } else {?>
													<?php if ( has_post_thumbnail() ) { ?>
													<div class="image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
																<?php the_post_thumbnail('blog-type-1-big'); ?>
														</a>
													</div>
													<?php } } ?>
												<div class="text <?php if (!has_post_thumbnail()){ echo 'no_image'; }?>">
													<div class="text_inner">
														
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<p><?php the_excerpt(); ?></p>
														<a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a>
														<div class="info">
															<span class="left"><?php the_time('d M Y'); ?> <?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
															<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
														</div>
													</div>
												</div>
											</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
											<?php wp_reset_query(); ?>
										</div>
									 <?php	break;
									case 2: ?>
										<div class="blog_holder3">
											<div class="blog_holder3_inner">
												<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
													<article <?php post_class(); ?>>
														
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
														<div class="image">
														
														<?php echo slider_blog(get_the_ID());?>	
														</div>
														<?php } else {?>
														<?php if ( has_post_thumbnail() ) { ?>
														<div class="image">
															<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															
																	<?php	the_post_thumbnail('full'); ?>
															</a>
														</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<div class="text">
															<div class="text_inner">
																
																<span class="button">
																	<span><?php the_time('d M, Y'); ?></span>
																</span>
																
																<?php the_excerpt(); ?>
																
																<div class="info">
																	<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																	<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
																</div>
															
															</div>
														</div>
														
													</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									</div>
									<?php	break;
									case 3: ?>
										<div class="posts_holder1 clearfix">
											<?php $post_count = 0; ?>
											<?php if(have_posts()) : ?>
												<div class="clearfix">
												<?php while ( have_posts() ) : the_post(); ?>
												<?php if ((($post_count%3)==0) && ($post_count > 0)) { ?>
												</div><div class="clearfix">
												<?php } ?>
												<article <?php post_class(); ?>>
													<div class="article_inner">
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
															<div class="image">
																<?php echo slider_blog(get_the_ID());?>	
															</div>
														<?php } else {?>
															<?php if ( has_post_thumbnail() ) { ?>
																	<div class="image">
																		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
																		
																				<?php	the_post_thumbnail('blog-type-3-big'); ?>
																		</a>
																	</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														
														<div class="text">
															<div class="text_inner">
																<span><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																<p><?php the_excerpt(); ?></p>
															</div>
														</div>
														<div class="info">
															<span class="left"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
															<span class="right"> <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
														</div>
													</div>
												</article>
												<?php $post_count++; ?>
												<?php endwhile; ?>
												</div>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									
									<?php	break;
									case 4: ?>
										<div class="posts_holder1 posts_holder1_v2 clearfix">
											<?php $post_count = 0; ?>
											<?php if(have_posts()) : ?>
												<div class="clearfix">
												<?php while ( have_posts() ) : the_post(); ?>
												<?php if ((($post_count%2)==0) && ($post_count > 0)) { ?>
												</div><div class="clearfix">
												<?php } ?>
												<article <?php post_class(); ?>>
													<div class="article_inner">
														<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
															<div class="image">
																<?php echo slider_blog(get_the_ID());?>	
															</div>
														<?php } else {?>
															<?php if ( has_post_thumbnail() ) { ?>
																	<div class="image">
																		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
																		
																				<?php	the_post_thumbnail('blog-type-4-big'); ?>
																		</a>
																	</div>
														<?php } } ?>
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														
														<div class="text">
															<div class="text_inner">
																<span><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																<p><?php the_excerpt(); ?></p>
															</div>
														</div>
														<div class="info">
															<span class="left"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
															<span class="right"> <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
														</div>
													</div>
												</article>
												<?php $post_count++; ?>
												<?php endwhile; ?>
												</div>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									<?php	break;
									case 5: ?>
										<div class="blog_holder3">
											<div class="blog_holder3_inner">
											<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
												<article <?php post_class(); ?>>
													
													<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
													<div class="image">
													
													<?php echo slider_blog(get_the_ID());?>	
													</div>
													<?php } else {?>
													<?php if ( has_post_thumbnail() ) { ?>
													<div class="image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														
																<?php	the_post_thumbnail('full'); ?>
														</a>
													</div>
													<?php } } ?>
													<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
													<div class="text">
															<div class="text_inner">
																
																<span class="button">
																	<span><?php the_time('d M, Y'); ?></span>
																</span>
																
																<?php the_content(); ?>
																
																<div class="info">
																	<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
																	<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
																</div>
															
															</div>
														</div>
													
												</article>
												<?php endwhile; ?>
												<?php if(true) : ?>
												<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
												<?php endif; ?>
											<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php	break;
									
							}
							
							?>		
							</div>
						</div>
						
					</div>
		<?php endif; ?>
	
		</div>			
	</div>
<?php get_footer(); ?>