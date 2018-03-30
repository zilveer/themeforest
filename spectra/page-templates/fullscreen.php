<?php
/**
 * Template Name: Fullscreen
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


?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>