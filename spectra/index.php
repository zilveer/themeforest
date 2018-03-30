<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			index.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>
<?php get_header(); ?>

<?php 
   	global $spectra_opts, $wp_query, $post, $spectra_layout, $more;

	// Get layout
	$spectra_layout = 'main-left';

	$more = 0;

?>

<?php 
	// Get Category Intro Section
	// get_template_part( 'inc/tag-intro' );

?>

<!-- ############ TAG ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">

		<div id="main" role="main" class="<?php echo esc_attr( $spectra_layout ) ?>">
		<?php
		

			if ( have_posts() ) :

				// Start the Loop.
				while ( have_posts() ) : the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile; ?>
				<div class="clear"></div>
    			<?php spectra_paging_nav(); ?>

			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SPECTRA_THEME ); ?></p>

			<?php endif; // have_posts() ?>
			
		</div>
		<!-- /main -->
		<?php get_sidebar(); ?>
	</div>
    <!-- /container -->
</div>
<!-- /page -->
<?php get_footer(); ?>