<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			single.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>
<?php get_header(); ?>


<?php 
   global $spectra_opts, $wp_query, $post;

   // Get layout
   $spectra_layout = get_post_meta( $wp_query->post->ID, '_layout', true );
   $spectra_layout = isset( $spectra_layout ) && $spectra_layout != '' ? $spectra_layout = $spectra_layout : $spectra_layout = 'wide';

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ PAGE ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">
		
		<!-- ############ Main ############ -->
		<div id="main" role="main" class="<?php echo esc_attr( $spectra_layout ) ?>">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', get_post_format() );

				endwhile;
			?>
		</div>
		<!-- /main -->
		<?php if ( $spectra_layout !== 'wide' ) : ?>
			<?php get_sidebar( 'custom' ); ?>
		<?php endif; ?>
	</div>
    <!-- /container -->
</div>
<!-- /page -->

<!-- Comments -->
<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) {
	$disqus = $spectra_opts->get_option( 'disqus_comments' );
	$disqus_shortname = $spectra_opts->get_option( 'disqus_shortname' );

	if ( ( $disqus && $disqus == 'on' ) && ( $disqus_shortname && $disqus_shortname != '' ) ) {
		get_template_part( 'inc/disqus' );

	} else {
		comments_template();
	}
}
?>
<!-- /comments -->

<?php get_footer(); ?>