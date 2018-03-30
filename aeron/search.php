<?php 
get_header();

get_template_part('title_breadcrumb_bar');
?>
	
	<section>
		<div class="container">
			<h2><?php _e('Showing Results for: ', 'ABdev_aeron');?> <?php the_search_query(); ?> (<?php echo $wp_query->found_posts; ?>)</h2>
			<div class="row">
				<div class="span9 content_with_right_sidebar">
					<?php if (have_posts()) : 
						$i = (((get_query_var('paged')) ? get_query_var('paged') : 1) - 1 ) * get_option('posts_per_page');
						while (have_posts()) : the_post(); 
							$i++; ?>

						<div class="search_results_content_item">
							<h4><a href="<?php the_permalink(); ?>"><?php ABdev_aeron_search_title_highlight(); ?></a></h4>
							<span class="search_resuls_number"><?php echo $i; ?>.</span>
							<p><?php ABdev_aeron_search_content_highlight(); ?></p>
						</div>

					<?php endwhile; ?>
					<?php else: ?>
						<?php _e('Sorry, your search query yielded no results.', 'ABdev_aeron'); ?>
					<?php endif;?>
				</div>
				<aside class="span3 sidebar">
					<?php dynamic_sidebar(__( 'Search Results Sidebar', 'ABdev_aeron' )); ?>
				</aside>
			</div>
		</div>
	</section>


<?php get_template_part( 'pagination-search' ); ?>


<?php get_footer();