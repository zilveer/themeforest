<?php 
/**
* 
* The template for displaying Search Results pages.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
get_header(); 

$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>

<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

	<div class="page-header">

			<div class="page-title">
				<h1>
					<?php if ( have_posts() ): ?>
						<?php printf( __( 'Search Results for: %s', 'van' ), '<span>' . get_search_query() . '</span>' ); ?>
					<?php endif ?>
				</h1>
			</div>
		
	</div><!-- .page-head -->

	<?php if ( have_posts() ) : ?>

		<div id="posts-outer">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', get_post_format() );  ?>

			<?php endwhile;?>

		</div><!-- #posts-outer -->

		<?php van_get_pagination(); ?>

	<?php else: ?>

		<?php get_template_part( 'partials/content', 'none' ); ?>

	<?php endif; ?>

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>