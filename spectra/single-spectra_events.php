<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			single-spectra_events.php
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

	// Get coundown header
	$countdown = get_post_meta( $wp_query->post->ID, '_countdown', true );
	$event_type = get_the_terms( $wp_query->post->ID, 'spectra_event_type' );

	if ( has_term( 'future-events', 'spectra_event_type', $wp_query->post->ID ) && $countdown === 'on' ) {
		$countdown = true;
	} else {
		$countdown = false;
	}

	// Intro Title
   	$intro_title = get_post_meta( $wp_query->post->ID, '_intro_type', true );
	if ( $intro_title === 'intro_page_title' ) {
		$intro_title = true;
   	} else {
   		$intro_title = false;
   	}

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

	// Get Event Countdown
	if ( $countdown && function_exists( 'spectra_event_countdown' ) ) {
		echo spectra_event_countdown( array( 'event_id' => $wp_query->post->ID ) );
	}

?>

<!-- ############ PAGE ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">
		<?php if ( ! $countdown && ! $intro_title ) : ?>
		<!-- ############ CONTENT HEADER ############ -->
	    <header class="content-header">
	        <h1 class="content-title anim-css" data-delay="0"><?php the_title(); ?></h1>
	        <span class="sub-heading anim-css" data-delay="100"><?php echo get_the_term_list( $wp_query->post->ID, 'spectra_event_categories', '', ' / ', '' ); ?></span>
	        <hr class="content-line anim-css" data-delay="200">
	    </header>
	    <!-- /content header -->
		<?php endif; ?>
		<div id="main" role="main" class="<?php echo esc_attr( $spectra_layout ) ?>">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'event' );

				endwhile;
			?>
		</div>
		<!-- /main -->
		<?php if ( $spectra_layout !== 'wide' ) : ?>
			<?php get_sidebar(); ?>
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