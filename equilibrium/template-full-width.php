<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<section>
			<?php the_content(); ?>
		</section>
		
	<?php endwhile; ?>

<?php get_footer(); ?>
	