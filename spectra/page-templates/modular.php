<?php
/**
 * Template Name: Modular Page for VC
 *
 * @package spectra
 * @since 1.0.0
 */

get_header(); ?>

<?php 
   	global $spectra_opts, $wp_query, $post, $spectra_layout, $more;

	// Copy query
	$temp_post = $post;
	$query_temp = $wp_query;

	// Get layout
	$spectra_layout = get_post_meta( $wp_query->post->ID, '_layout', true );
	$spectra_layout = isset( $spectra_layout ) && $spectra_layout != '' ? $spectra_layout = $spectra_layout : $spectra_layout = 'wide';

	$more = 0;

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ MODULAR PAGE ############ -->
<div id="page" class="no-margin">
<?php if ( have_posts() ) :

	// Start the Loop.
	while ( have_posts() ) : the_post();
		the_content( __( 'Continue reading ', SPECTRA_THEME ) . '<span class="meta-nav">&rarr;</span>' );
	endwhile;
	else : ?>
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SPECTRA_THEME ); ?></p>

<?php endif; // have_posts() ?>
	
</div>

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>