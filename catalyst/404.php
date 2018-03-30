<?php
/*
Catalyst 404 Pages
*/
?>
 
<?php get_header(); ?>

<div class="contents-wrap float-left two-column">
		<h1 class="entry-title">
			<?php _e( '404 Page not found', 'mthemelocal' ); ?>
		</h1>
	<div class="entry-content clearfix">
		<h4><?php _e( 'Try searching...', 'mthemelocal' ); ?></h4>
			<?php get_search_form(); ?>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>