<?php get_header(); ?>
	<div class="content">
	
		<?php tie_breadcrumbs(); ?>

		<div class="page-head">
			<h2 class="page-title">
				<?php if ( have_posts() ) : ?>
				<?php printf( __ti( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?>
				<?php else : ?>
				<?php _eti( 'Nothing Found' ); ?>
				<?php endif; ?>
			</h2>
			<div class="stripe-line"></div>
		</div>
		
		<?php if ( have_posts() ) : ?>
		
			<?php $loop_layout = tie_get_option( 'search_layout' );	?>

			<?php get_template_part( 'loop' );	?>
			
			<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
			
		<?php else : ?>
			<div id="post-0" class="post not-found post-listing">
				<div class="entry">
					<p><?php _eti( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
