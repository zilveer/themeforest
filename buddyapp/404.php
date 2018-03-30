<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header();

//Make the layout full(no sidebar)
kleo_switch_layout( 'full' );

?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php //get_template_part( 'page-parts/page-title' ); ?>

<div class="main-content page-404 <?php echo Kleo::get_config('container_class'); ?>">
	<div class="entry-content">
		<div class="no-result-page-wrapper">
			<div class="row">
				<div class="col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-1 col-sm-10 col-xs-offset-0 col-xs-12">

					<?php
					// Display SVG
					echo buddyapp_sad_search_svg();
					?>

					<h1><?php esc_html_e( "404 ERROR, NOT FOUND!", "buddyapp" ); ?></h1>
					<p><?php esc_html_e( "It looks like nothing was found at this location. Maybe try a search?", "buddyapp" ); ?></p>
					<?php get_search_form(); ?>

					<a href="<?php echo home_url(); ?>"><?php esc_html_e("return to homepage", "buddyapp");?></a>

				</div>
			</div>
		</div>
		
	</div>
</div>


<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>