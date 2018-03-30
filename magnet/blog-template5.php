<?php 
/*
Template Name: Blog Template 5
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
?>
			
	<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
	<div class="container">
		<div class="container_inner clearfix">
			<div class="title">	
				<h1><?php echo get_the_title($id); ?></h1>
				<?php if(get_post_meta($id, "qode_page-subtitle", true)) { ?><span><?php echo get_post_meta($id, "qode_page-subtitle", true) ?></span><?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>

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
											<span><?php the_time('d M, Y'); ?>
												<span></span>
											</span>
										</span>
										
										<?php the_content(); ?>
										
										<div class="info">
											<span class="left"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></span>
											<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('No Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('Read More', 'qode'); ?></a></span>
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
	
		</div>
	</div>
<?php get_footer(); ?>