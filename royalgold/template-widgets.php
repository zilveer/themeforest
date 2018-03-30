<?php
/**
 *	Template Name: Page with footer widgets
 *
 *	The template for displaying normal pages with widgets in the bottom of the page
 */

get_header();
the_post();
?>

	<section id="main">
		<div class="wrapper">
			<h2><?php the_title(); ?></h2>
			<?php
				the_content();
				get_sidebar();
			?>

<?php if ( comments_open() ) : ?>
			<div class="sep"><span></span></div>
			<?php comments_template( '', true ); ?>
<?php endif; ?>
		</div>
	</section>

<?php get_footer(); ?>