<?php 
/*
Template Name: Blog Small Image
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

$sidebar = get_post_meta($id, "qode_show-sidebar", true); 

$blog_hide_comments = "";
if (isset($qode_options_theme13['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options_theme13['blog_hide_comments'];

	
if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

if(isset($qode_options_theme13['blog_page_range']) && $qode_options_theme13['blog_page_range'] != ""){
	$blog_page_range = $qode_options_theme13['blog_page_range'];
} else{
	$blog_page_range = $wp_query->max_num_pages;
}

if(isset($qode_options_theme13['number_of_chars_small_image']) && $qode_options_theme13['number_of_chars_small_image'] != "") {
	qode_set_blog_word_count($qode_options_theme13['number_of_chars_small_image']);
}

?>
	<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
			</script>
		<?php } ?>
			<?php get_template_part( 'title' ); ?>
	
	<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){ ?>
			<div class="q_slider"><div class="q_slider_inner">
			<?php echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		}
		?>
	<?php 
		query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
		if(isset($qode_options_theme13['blog_page_range']) && $qode_options_theme13['blog_page_range'] != ""){
			$blog_page_range = $qode_options_theme13['blog_page_range'];
		} else{
			$blog_page_range = $wp_query->max_num_pages;
		}
	?>
	<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<div class="container_inner">
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
					<div class="blog_holder blog_small_image">
						<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
								<?php 
									get_template_part('blog_small_image', 'loop');
								?>
						
					
						<?php endwhile; ?>
						<?php if($qode_options_theme13['pagination'] != "0") : ?>
							<?php pagination($wp_query->max_num_pages, $blog_page_range, $paged); ?>
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
								<div class="blog_holder blog_small_image">
									<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
										<?php 
											get_template_part('blog_small_image', 'loop');
										?>
									<?php endwhile; ?>
									<?php if($qode_options_theme13['pagination'] != "0") : ?>
										<?php pagination($wp_query->max_num_pages, $blog_page_range, $paged); ?>
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
									<div class="blog_holder blog_small_image">
										<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
												<?php 
													get_template_part('blog_small_image', 'loop');
												?>
										<?php endwhile; ?>
										<?php if($qode_options_theme13['pagination'] != "0") : ?>
											<?php pagination($wp_query->max_num_pages, $blog_page_range, $paged); ?>
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
<?php wp_reset_query(); ?>
<?php get_footer(); ?>