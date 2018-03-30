<?php
/**
* The template for displaying Category pages.
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

		<div class="page-title">

			<h2><?php printf( __( 'Category Archives: %s', 'van' ), '<span>' . single_cat_title( '', false ) . '</span>' );?></h2>
		
		</div>

		<?php van_archives_rss(); ?>

		<?php if( van_get_option('cat_desc') ): $cat_desc = category_description(); ?>

			<?php if ( !empty($cat_desc) ): ?>

				<div class="page-desc"><?php echo $cat_desc; ?></div>

			<?php endif; ?>

		<?php endif; ?>

	</div><!-- .page-header -->

	<?php if ( have_posts() ) : ?>

		<div id="posts-outer">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', get_post_format() );  ?>

			<?php endwhile;?>

		</div><!-- #posts-outer-->

		<?php van_get_pagination(); ?>

	<?php else: ?>
		<?php get_template_part( 'partials/content', 'none' ); ?>
	<?php endif; ?>

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>