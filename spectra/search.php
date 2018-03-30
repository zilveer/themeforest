<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			search.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>
<?php get_header(); ?>

<?php 
	// Get Category Intro Section
	get_template_part( 'inc/tag-intro' );

?>

<!-- ############ SEARCH ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">

		<div id="main" role="main" class="wide">
		<?php
		

			if ( have_posts() ) :

				// Start the Loop.
				while ( have_posts() ) : the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', 'search' );

				endwhile;

			else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', SPECTRA_THEME ); ?></p>

			<?php endif; // have_posts() ?>
			<div class="clear"></div>
    		<?php spectra_paging_nav(); ?>
		</div>
		<!-- /main -->
	</div>
    <!-- /container -->
</div>
<!-- /page -->
<?php get_footer(); ?>