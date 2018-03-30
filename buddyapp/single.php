<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php get_template_part( 'page-parts/general-before-wrap' );?>

<?php get_template_part( 'page-parts/page-title' ); ?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content' ); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
		comments_template();
		endif;
		?>

		<?php
		// Previous/next post navigation.
		kleo_post_nav();
		?>

	<?php endwhile; ?>

</div>

<?php get_template_part('page-parts/general-after-wrap');?>

<?php get_footer(); ?>