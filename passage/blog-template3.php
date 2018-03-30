<?php 
/*
Template Name: Blog Template 3
*/ 
?>
<?php get_header(); ?>
<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = get_post_meta($id, "qode_show-posts-per-page", true);
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
$sidebar = get_post_meta($id, "qode_show-sidebar", true); 

$blog_hide_comments = "";
if (isset($qode_options_passage['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options_passage['blog_hide_comments'];

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
			
	<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
	<div class="title animate <?php if($content_animation == 'no'){ echo 'no_entering_animation '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
		<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
		<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
			<?php if($title_in_grid){ ?>
			<div class="container">
				<div class="container_inner clearfix">
			<?php } ?>
			<h1><?php echo get_the_title($id); ?></h1>
			<?php if($title_in_grid){ ?>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
	</div>
	<?php } ?>
	
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
		<div class="container_inner">
			<div class="container_inner2 clearfix">
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
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
				<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
					<div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
						<div class="column1">
							<div class="column_inner">
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
								</div>
							</div>
							
						</div>
				<?php endif; ?>
		</div>
	</div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>