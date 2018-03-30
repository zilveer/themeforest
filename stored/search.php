<?php get_header(); ?>
<div id="archive_grid_wrap">
	<h2 class="post_title">	
		<?php /* Search Count */
		if ( class_exists('Cart66_Cloud') ) {
			$allsearch = new WP_Query("s=$s&showposts=-1&post_type=cc_product");
		} else {
			$allsearch = new WP_Query("s=$s&showposts=-1&post_type=products");
		}
		$count = $allsearch->post_count;
		if ('1' == $count) {
			$string = sprintf( __('1 Result for %2$s', 'designcrumbs'), $count, get_search_query() );
		} else {
			$string = sprintf( __('%1$s Results for %2$s', 'designcrumbs'), $count, get_search_query() );
		}
		echo $string;
		?>
	</h2>
	<div id="archive_grid">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php get_template_part( 'loop', 'gridproduct' ); ?>
        
		<?php endwhile; ?>
        
		<div class="navigation">
			<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'designcrumbs')) ?></div>
			<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'designcrumbs')) ?></div>
			<div class="clear"></div>
		</div>

	<?php else : ?>

	<h2><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
	<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p>
        
	<?php endif; ?>
	</div><!-- end #archive_grid -->
</div><!-- end #archive_grid_wrap -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>