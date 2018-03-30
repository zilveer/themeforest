<?php get_header(); ?>

<?php $sidebar_disabled = intval( of_get_option( 'blog_page_sidebar_disabled' ) ); ?>
	
	<!-- START #search-results -->
	<div id="search-results" class="<?php echo $grid = ( $sidebar_disabled) ? '' : 'page-content grid_8 alpha'; ?> group">
		
		<h1 class="page-name"><?php printf( __( 'Search Results for &ldquo;%s&rdquo;', 'onioneye' ), get_search_query()); ?></h1>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div class="blog-post">
				<h2 class="post-title"><a href="<?php the_permalink(); ?>" class="post-title" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'onioneye' ), get_the_title() ); ?>"><?php the_title(); ?></a></h2>
				<?php wpe_excerpt( 'wpe_excerptlength_index', 'new_excerpt_more' ); ?> 
			</div>
		
		<?php endwhile; ?>
		
		<?php else: ?>
	
			<h2><?php _e( 'Nothing Found.', 'onioneye' ); ?></h2>
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'onioneye' ); ?></p>
			<?php get_search_form(); ?>
			
		<?php endif; ?>
		
		<!-- START .blog-pagination -->
		<section class="blog-pagination group alpha">
			<p>
				<?php next_posts_link( __('&laquo; Older Entries', 'onioneye' ) ); ?>
				<?php previous_posts_link( __( 'Newer Entries &raquo;', 'onioneye' ) ); ?>
			</p>
		</section>
		<!-- END .blog-pagination -->
	</div>
	<!-- END #search-results -->

	<?php if( ! $sidebar_disabled ) { ?>
		
		<?php get_sidebar( 'blog' ); ?>
	
	<?php } ?>
	
<?php get_footer(); ?>