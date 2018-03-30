<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			taxonomy-spectra_portfolio_cats.php
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

<!-- ############ PORTFOLIO ############ -->
<div id="page">
	
    <?php 
    global $spectra_opts, $wp_query, $post;

    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

    // Date format
    $date_format = 'd/m/y';
    if ( $spectra_opts->get_option( 'custom_date' ) ) {
        $date_format = $spectra_opts->get_option( 'custom_date' );
    }

    ?>

	<!--############ Portfolio taxonomies ############ -->
	<div id="portfolio-items" class="fullwidth items clearfix">
		
	
	 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php

            // Thumb subtitle
            $thumb_subtitle = get_post_meta( $wp_query->post->ID, '_thumb_subtitle', true );

            // Generate thumbnail class
            $thumb_class = 'thumb project-thumb';
                
        ?>

		<?php if ( has_post_thumbnail() ) : ?>
		<!-- item -->
		<div class="item">
			<a href="<?php echo esc_url( get_permalink() )?>" class="<?php echo esc_attr( $thumb_class ) ?>">
				<!-- title and opacity mask -->
				<div class="inner">
					<h6><?php 
						the_title(); 
						if ( $thumb_subtitle && $thumb_subtitle !== '' ) {
							echo '<span>' . esc_attr( $thumb_subtitle ) . '</span>';
						}
						?>
					</h6>
				</div>
				<!-- /title and opacity mask -->
				<!-- image -->
				<img src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) ?>" alt="<?php echo esc_attr( __( 'Porfolio thumbnail', SPECTRA_THEME ) ); ?>">
			</a>
		</div>
		<!-- /item -->
		<?php endif; // End has thumbnail ?>
		<?php endwhile; // End Loop ?>
	</div>
    <div class="clear"></div>
    <?php spectra_paging_nav(); ?>
    <?php endif; ?>
			
</div>
<!-- /page -->
<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>