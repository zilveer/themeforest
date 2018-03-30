<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			404.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>
<?php get_header(); ?>

<!-- ############ PAGE ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix error-page">
		<div class="row">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/404.png' ) ?>" alt="<?php echo esc_attr( __( 'Error 404', SPECTRA_THEME ) ); ?>" class="aligncenter">
		</div>
		<hr class="divider">
		<div class="col-1-2">
			<h1 class="content-title"><?php _e( 'Not Found', SPECTRA_THEME ); ?></h1>
        	<span class="sub-heading"><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', SPECTRA_THEME ); ?></span>
		</div>
		<div id="search-404" class="col-1-2 last">
			<?php get_search_form(); ?>
		</div>
		<hr class="divider">
	</div>
    <!-- /container -->
</div>
<!-- /page -->

<?php get_footer(); ?>