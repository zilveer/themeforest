<?php
/**
 * Template Name: Blog
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

	// Cats
	$blog_cats = get_post_meta( $wp_query->post->ID, 'blog_cats_ids', true );

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ BLOG LIST ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">

		<div id="main" role="main" class="<?php echo esc_attr( $spectra_layout ) ?>">
		<?php
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}
			$args = array(
				'showposts'=> 6,
				'paged' => $paged
            );

            if ( $blog_cats != '' ) {
            	$args['cat'] = $blog_cats;
            }

			$wp_query = new WP_Query();
			$wp_query->query($args);

			if ( have_posts() ) :

				// Start the Loop.
				while ( have_posts() ) : the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;

			else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SPECTRA_THEME ); ?></p>

			<?php endif; // have_posts() ?>
			<div class="clear"></div>
    		<?php spectra_paging_nav(); ?>
		</div>
		<!-- /main -->
		<?php
		   // Get orginal query
		   $post = $temp_post;
		   $wp_query = $query_temp;
		?>
		<?php if ( $spectra_layout !== 'wide' ) : ?>
			<?php get_sidebar( 'custom' ); ?>
		<?php endif; ?>
	</div>
    <!-- /container -->
</div>
<!-- /page -->
<?php get_footer(); ?>