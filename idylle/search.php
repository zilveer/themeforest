<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Idylle
 */

get_header(); ?>


<!-- No Slider -->
<!--Intro-->
<section class="idy_noslider idy_box idy_image_bck idy_white_txt idy_fixed" data-stellar-background-ratio="0.4" data-color="#ec0201" data-image="<?php echo esc_attr($noslider_image); ?>" >


<div class="container">
    <h1 data-0="opacity:1; top:0px" data-top-bottom="opacity:0; top:100px"><?php printf( esc_html__( 'Search: %s', 'idylle' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

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
