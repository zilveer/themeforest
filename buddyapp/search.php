<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php
/* Show title section only if we have results */
if ( sq_search_has_results() ) {
	get_template_part('page-parts/page-title');
}

?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

	<div id="posts" class="small-thumbs">

	<?php if ( have_posts() ) :

		// Start the Loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */

			get_template_part( 'page-parts/post-content-small' );


		endwhile;
		?>
		
		<?php
		// Previous/next post navigation.
		kleo_pagination( 'pagination pag-type-1' );
		?>
		
	<?php else: ?>

	<div class="no-result-page-wrapper">
		<div class="row">
			<div class="col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-1 col-sm-10 col-xs-offset-0 col-xs-12">

				<?php
				// Display SVG
				echo buddyapp_sad_search_svg();
				?>

				<h1><?php esc_html_e( "SAD, NO RESULT!", "buddyapp" ); ?></h1>
				<p><?php esc_html_e("We cannot find the item you are searching for, maybe a little spelling mistake?", "buddyapp"); ?></p>
				<?php get_search_form(); ?>
				
				<a href=""><?php esc_html_e("return to homepage", "buddyapp");?></a>
				
			</div>
		</div>
	</div>



	<?php endif; ?>

	</div>

</div>

<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>