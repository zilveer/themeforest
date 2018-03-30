<?php get_header(); ?>
<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

$sidebar = $qode_options_passage['category_blog_sidebar'];

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_passage['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_passage['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_passage['title_image'];
}

$blog_hide_comments = "";
if (isset($qode_options_passage['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options_passage['blog_hide_comments'];

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if(get_post_meta($id, "qode_content-animation", true) != ""){
 $content_animation = get_post_meta($id, "qode_content-animation", true);
}else{
	if(isset($qode_options_passage['content_animation'])){
		$content_animation = $qode_options_passage['content_animation'];
	}else{
		$content_animation = 'yes';
	}
}

?>
	<div class="title animate <?php if($content_animation == 'no'){ echo 'no_entering_animation '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
			<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
			<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
				<?php if($title_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
				<?php } ?>
				<h1><?php single_cat_title(''); ?></h1>
				<?php if($title_in_grid){ ?>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
	</div>
	
	<?php if($qode_options_passage['show_back_button'] == "yes") { ?>
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
	
		<div class="container top_move <?php if($content_animation == 'no'){ echo 'no_entering_animation'; }  ?>">
		<div class="container_inner clearfix">
			<div class="container_inner2 clearfix">
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
				<?php switch ($qode_options_passage['blog_style']) {
					case 1: ?>
							<div class="blog_holder">
								<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
									<article <?php if ( !has_post_thumbnail() ) { echo "class='no_image'"; } ?>>
										<?php if ( has_post_thumbnail() ) { ?>
											<div class="post_image">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<?php the_post_thumbnail('blog-type-1'); ?>
												</a>
											</div>
										<?php } ?>
										<div class="post_text_holder">
											<div class="post_text_inner">
												<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
												<span class="create">
													<span class="date"><?php the_time('d.m.Y'); ?></span>
													<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
												</span>
												<?php the_excerpt(); ?>
												<span class="info">
													 <?php if($blog_hide_comments != "yes"){ ?>
														 <span class="left">
																<a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a>
														 </span>
													<?php } ?>
													<span class="right"><a href="<?php the_permalink(); ?>" class="read_more"></a></span>
												</span>
											</div>
										</div>	
									</article>
								<?php endwhile; ?>
								<?php if($qode_options_passage['pagination'] != "0") : ?>
									<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
								<?php endif; ?>
								<?php else: //If no posts are present ?>
									<div class="entry">                        
											<p><?php _e('No posts were found.', 'qode'); ?></p>    
									</div>
								<?php endif; ?>
							</div>
					 <?php	break;
					case 2: ?>
						<div class="blog_holder2">
							<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
								<article <?php post_class(); ?>>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post_image">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_post_thumbnail('blog-type-2'); ?>
											</a>
										</div>
									<?php } ?>
									<div class="post_text_holder">
										<div class="post_text_inner">
											<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
											<span class="create">
												<span class="date"><?php the_time('d.m.Y'); ?></span>
												<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
											</span>
											<?php the_excerpt(); ?>
											<span class="info">
												<?php if($blog_hide_comments != "yes"){ ?>
													<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
												<?php } ?>	
												<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
											</span>
										</div>
									</div>
								</article>
							<?php endwhile; ?>
							<?php if($qode_options_passage['pagination'] != "0") : ?>
								<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
							<?php endif; ?>
							<?php else: //If no posts are present ?>
									<div class="entry">                        
											<p><?php _e('No posts were found.', 'qode'); ?></p>    
									</div>
							<?php endif; ?>
						</div>
					<?php	break;
					case 3: ?>
						<div class="blog_holder_list">
							<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
								<article class="mix">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post_image">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_post_thumbnail('blog-type-3'); ?>
											</a>
										</div>
									<?php } ?>
									<div class="post_text_holder">
										<div class="post_text_inner">
											<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
											<span class="create">
												<span class="date"><?php the_time('d.m.Y'); ?></span>
												<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
											</span>
											<?php the_excerpt(); ?>
											<span class="info">
												<?php if($blog_hide_comments != "yes"){ ?>
													<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
												<?php } ?>	
												<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
											</span>
										</div>
									</div>
								</article>
							<?php endwhile; ?>
							<?php if($qode_options_passage['pagination'] != "0") : ?>
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
						<div class="blog_holder2">
							<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
								<article <?php post_class(); ?>>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post_image">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_post_thumbnail('blog-type-2'); ?>
											</a>
										</div>
									<?php } ?>
									<div class="post_text_holder">
										<div class="post_text_inner">
											<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
											<span class="create">
												<span class="date"><?php the_time('d.m.Y'); ?></span>
												<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
											</span>
											<?php the_content(); ?>
											<span class="info">
												<?php if($blog_hide_comments != "yes"){ ?>
													<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
												<?php } ?>	
												<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
											</span>
										</div>
									</div>
								</article>
							<?php endwhile; ?>
							<?php if($qode_options_passage['pagination'] != "0") : ?>
								<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
							<?php endif; ?>
							<?php else: //If no posts are present ?>
							<div class="entry">                        
									<p><?php _e('No posts were found.', 'qode'); ?></p>    
							</div>
							<?php endif; ?>
						</div>
				<?php break;
				} ?>
			<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
				<div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
					<div class="column1">
						<div class="column_inner">
							<?php switch ($qode_options_passage['blog_style']) {
							case 1: ?>
								<div class="blog_holder">
									<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
										<article <?php if ( !has_post_thumbnail() ) { echo "class='no_image'"; } ?>>
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="post_image">
													<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<?php the_post_thumbnail('blog-type-1'); ?>
													</a>
												</div>
											<?php } ?>
											<div class="post_text_holder">
												<div class="post_text_inner">
													<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
													<span class="create">
														<span class="date"><?php the_time('d.m.Y'); ?></span>
														<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
													</span>
													<?php the_excerpt(); ?>
													<span class="info">
														 <?php if($blog_hide_comments != "yes"){ ?>
															 <span class="left">
																	<a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a>
															 </span>
														<?php } ?>
														<span class="right"><a href="<?php the_permalink(); ?>" class="read_more"></a></span>
													</span>
												</div>
											</div>	
										</article>
									<?php endwhile; ?>
									<?php else: //If no posts are present ?>
										<div class="entry">                        
												<p><?php _e('No posts were found.', 'qode'); ?></p>    
										</div>
									<?php endif; ?>
									<?php if($qode_options_passage['pagination'] != "0") : ?>
										<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
									<?php endif; ?>
								</div>
							<?php	break;
							case 2: ?>
									<div class="blog_holder2">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php post_class(); ?>>
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="post_image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('blog-type-2'); ?>
														</a>
													</div>
												<?php } ?>
												<div class="post_text_holder">
													<div class="post_text_inner">
														<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
														<span class="create">
															<span class="date"><?php the_time('d.m.Y'); ?></span>
															<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
														</span>
														<?php the_excerpt(); ?>
														<span class="info">
															<?php if($blog_hide_comments != "yes"){ ?>
																<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
															<?php } ?>	
															<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
														</span>
													</div>
												</div>
											</article>
										<?php endwhile; ?>
										<?php if($qode_options_passage['pagination'] != "0") : ?>
											<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
										<?php endif; ?>
										<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
										<?php endif; ?>
									</div>
								<?php	break;
							case 3: ?>
									<div class="blog_holder_list">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article class="mix">
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="post_image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('blog-type-3'); ?>
														</a>
													</div>
												<?php } ?>
												<div class="post_text_holder">
													<div class="post_text_inner">
														<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
														<span class="create">
															<span class="date"><?php the_time('d.m.Y'); ?></span>
															<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
														</span>
														<?php the_excerpt(); ?>
														<span class="info">
															<?php if($blog_hide_comments != "yes"){ ?>
																<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
															<?php } ?>	
															<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
														</span>
													</div>
												</div>
											</article>
										<?php endwhile; ?>
										<?php if($qode_options_passage['pagination'] != "0") : ?>
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
								<div class="blog_holder2">
									<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
										<article <?php post_class(); ?>>
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="post_image">
													<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<?php the_post_thumbnail('blog-type-2'); ?>
													</a>
												</div>
											<?php } ?>
											<div class="post_text_holder">
												<div class="post_text_inner">
													<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
													<span class="create">
														<span class="date"><?php the_time('d.m.Y'); ?></span>
														<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
													</span>
													<?php the_content(); ?>
													<span class="info">
														<?php if($blog_hide_comments != "yes"){ ?>
															<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
														<?php } ?>	
														<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
													</span>
												</div>
											</div>
										</article>
									<?php endwhile; ?>
									<?php if($qode_options_passage['pagination'] != "0") : ?>
										<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
									<?php endif; ?>
									<?php else: //If no posts are present ?>
									<div class="entry">                        
											<p><?php _e('No posts were found.', 'qode'); ?></p>    
									</div>
									<?php endif; ?>
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
				<div class="<?php if($sidebar == "3"):?>two_columns_33_66<?php elseif($sidebar == "4") : ?>two_columns_25_75<?php endif; ?> background_color_sidebar grid2 clearfix">
					<div class="column1">
					<?php get_sidebar(); ?>	
					</div>
					<div class="column2">
						<div class="column_inner">
								<?php switch ($qode_options_passage['blog_style']) {
								case 1: ?>
									<div class="blog_holder">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php if ( !has_post_thumbnail() ) { echo "class='no_image'"; } ?>>
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="post_image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('blog-type-1'); ?>
														</a>
													</div>
												<?php } ?>
												<div class="post_text_holder">
													<div class="post_text_inner">
														<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
														<span class="create">
															<span class="date"><?php the_time('d.m.Y'); ?></span>
															<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
														</span>
														<?php the_excerpt(); ?>
														<span class="info">
															 <?php if($blog_hide_comments != "yes"){ ?>
																 <span class="left">
																		<a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a>
																 </span>
															<?php } ?>
															<span class="right"><a href="<?php the_permalink(); ?>" class="read_more"></a></span>
														</span>
													</div>
												</div>	
											</article>
										<?php endwhile; ?>
										<?php else: //If no posts are present ?>
											<div class="entry">                        
													<p><?php _e('No posts were found.', 'qode'); ?></p>    
											</div>
										<?php endif; ?>
										<?php if($qode_options_passage['pagination'] != "0") : ?>
											<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
										<?php endif; ?>
									</div>
								 <?php	break;
								case 2: ?>
									<div class="blog_holder2">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php post_class(); ?>>
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="post_image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('blog-type-2'); ?>
														</a>
													</div>
												<?php } ?>
												<div class="post_text_holder">
													<div class="post_text_inner">
														<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
														<span class="create">
															<span class="date"><?php the_time('d.m.Y'); ?></span>
															<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
														</span>
														<?php the_excerpt(); ?>
														<span class="info">
															<?php if($blog_hide_comments != "yes"){ ?>
																<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
															<?php } ?>	
															<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
														</span>
													</div>
												</div>
											</article>
										<?php endwhile; ?>
										<?php if($qode_options_passage['pagination'] != "0") : ?>
											<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
										<?php endif; ?>
										<?php else: //If no posts are present ?>
												<div class="entry">                        
														<p><?php _e('No posts were found.', 'qode'); ?></p>    
												</div>
										<?php endif; ?>
									</div>
								<?php	break;
								case 3: ?>
									<div class="blog_holder_list">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article class="mix">
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="post_image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('blog-type-3'); ?>
														</a>
													</div>
												<?php } ?>
												<div class="post_text_holder">
													<div class="post_text_inner">
														<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
														<span class="create">
															<span class="date"><?php the_time('d.m.Y'); ?></span>
															<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
														</span>
														<?php the_excerpt(); ?>
														<span class="info">
															<?php if($blog_hide_comments != "yes"){ ?>
																<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
															<?php } ?>	
															<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
														</span>
													</div>
												</div>
											</article>
										<?php endwhile; ?>
										<?php if($qode_options_passage['pagination'] != "0") : ?>
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
									<div class="blog_holder2">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
											<article <?php post_class(); ?>>
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="post_image">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('blog-type-2'); ?>
														</a>
													</div>
												<?php } ?>
												<div class="post_text_holder">
													<div class="post_text_inner">
														<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
														<span class="create">
															<span class="date"><?php the_time('d.m.Y'); ?></span>
															<?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span>
														</span>
														<?php the_content(); ?>
														<span class="info">
															<?php if($blog_hide_comments != "yes"){ ?>
																<span class="left"><a  class="comments" href="<?php comments_link(); ?>"><?php comments_number( __('no comment','qode'), '1 '.__('comment','qode'), '% '.__('comment','qode') ); ?></a></span>
															<?php } ?>	
															<span class="right"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read_more"></a></span>
														</span>
													</div>
												</div>
											</article>
										<?php endwhile; ?>
										<?php if($qode_options_passage['pagination'] != "0") : ?>
											<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
										<?php endif; ?>
										<?php else: //If no posts are present ?>
										<div class="entry">                        
												<p><?php _e('No posts were found.', 'qode'); ?></p>    
										</div>
										<?php endif; ?>
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
	</div>
	
<?php get_footer(); ?>