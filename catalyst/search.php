<?php
/*
* Catalyst Search Page
*/
?>
 
<?php get_header(); ?>

<div class="contents-wrap float-left two-column">
	<?php if ( have_posts() ) : ?>
		<h1 class="entry-title">
			<?php printf( __( 'Search Results for: %s', 'mthemelocal' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
		<?php
			get_template_part( 'loop', 'search' );
		?>
	<?php else : ?>

			<h1 class="entry-title">
				<?php printf( __( 'Search Results for: %s', 'mthemelocal' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
			<h2 class="entry-title"><?php _e( 'Nothing Found', 'mthtme_local' ); ?></h2>
			<div class="entry-content">
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mthemelocal' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>