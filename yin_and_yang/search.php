<?php get_header(); ?>

	<section class="page-content the-content group">

		<h1 class="item-title"><?php echo esc_html( sprintf( __( 'Search Results for &ldquo;%s&rdquo;', 'onioneye' ), get_search_query() ) ); ?></h1>
		
		<div class="search-results group">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<h2 class="search-post-title post-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
			
			<?php endwhile; ?>
			
			<?php else: ?>
		
				<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'onioneye' ); ?></p>
				
			<?php endif; ?>
			
		</div><!-- /.search-results -->
	
	</section><!-- /.page-content -->
	
<?php get_footer(); ?>