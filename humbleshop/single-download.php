<?php
/**
 * Single download pages
 */
	
get_header(); ?>

<?php do_action( 'edd_before_download_content' ); ?>

<section id="primary" class="content-area container">
	<main id="main" class="site-main row" role="main">
	<?php do_action( 'humbleshop_single_download_primary_start' ); ?>

	<?php do_action( 'humbleshop_the_title' ); // The humbleshop_render_the_title() function is loaded on this hook ?>

	<?php do_action( 'humbleshop_single_download_image' ); // The single download image is loaded on this hook ?>

	<?php do_action( 'humbleshop_single_download_content_before' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'download' ); ?>

		<?php do_action( 'humbleshop_single_download_content_after' ); ?>

	<?php endwhile; // end of the loop. ?>

	<?php do_action( 'humbleshop_single_download_primary_end' ); ?>
	</main>
	
	<?php 
	$inst = array( 
	    'title' => 'You May Also Like',
	    'number' => 3,
	    'taxcat' => true,
	);
	$args = array(
	    'before_widget' => '<div id="isa-related-downloads" class="widget row"><hr>',// make it grid-style
	    'after_widget' => '</div>',
	);
	the_widget('edd_related_downloads_widget', $inst, $args);
	?>

	<?php //comments_template( '', true );  ?>
</section>

<?php do_action( 'humbleshop_single_download_end' ); ?>

<?php get_footer(); ?>