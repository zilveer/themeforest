<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Idylle
 */

get_header(); 
?>


<!-- No Slider -->
<!--Intro-->
<section class="idy_noslider idy_box idy_image_bck idy_white_txt idy_fixed <?php if( is_category() ){echo('idy_category');} ?>" data-stellar-background-ratio="0.4">


<div class="container">
		<?php
			the_archive_title( '<h1 data-0="opacity:1" data-top-bottom="opacity:0">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
    <div class="idy_breadcrumbs"><?php if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs('/'); } ?></div>
</div>        
</section>
<!-- Intro End -->
<!-- No Slider End-->


<section class="idy_box">
	<div class="container">

		<?php get_sidebar(); ?>
		<div class="idy_main_sidebar">
		<?php
		if ( have_posts() ) : ?>


			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
		</div>


	</div>
</section>

<?php
get_footer();
