<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php get_template_part( 'page-parts/page-title' ); ?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

	<div id="posts" class="small-thumbs">

	<?php if ( have_posts() ) : ?>

	<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */

				get_template_part( 'page-parts/post-content-small' );

			endwhile;

			// page navigation.
			kleo_pagination( 'pagination pag-type-1' );

		endif;
	?>

	</div>

</div>

<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>