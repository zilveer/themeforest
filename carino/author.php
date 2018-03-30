<?php
/**
* The template for displaying Author Archive pages.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

get_header(); 

$van_page_type = van_page_type(); 
?>
<?php van_breadcrumb(); ?>

<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

	<div class="page-header clearfix">	

		<?php if ( have_posts() ): ?>

			<div class="	page-title">

				<h1><?php printf( __( 'Author Archives: <span>%s</span>', 'van' ),  get_the_author() ); ?></h1>
			
			</div>

			<?php van_archives_rss(); ?>

			<?php if(van_get_option('author_bio')) : ?> 

				<div id="author-box" class="author-page">

					<?php van_author_box(); ?>

				</div>

			<?php endif; ?> 

		<?php endif; ?> 
		
	</div><!-- page-head -->

	<?php if ( have_posts() ) : ?>

		<div id="posts-outer">

			<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', get_post_format() ); ?>

			<?php endwhile;?>

		</div><!-- posts-outer -->

		<?php van_get_pagination(); ?>

	<?php else: ?>
		<?php get_template_part( 'partials/content', 'none' ); ?>
	<?php endif; ?>

</div><!-- #main-content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>