<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			sidebar.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>

<?php 
   global $spectra_opts, $wp_query, $post;

   // Get custom sidebar
   $custom_sidebar = get_post_meta( $wp_query->post->ID, '_custom_sidebar', true );

   // Get layout
   $spectra_layout = get_post_meta( $wp_query->post->ID, '_layout', true );
   $spectra_layout = isset( $spectra_layout ) && $spectra_layout != '' ? $spectra_layout = $spectra_layout : $spectra_layout = 'wide';
?>
	
<!-- Sidebar -->
<aside class="sidebar <?php echo esc_attr( $spectra_layout ) ?>">
	<?php if ( $custom_sidebar === '' || $custom_sidebar === '_default' ) : ?>
	<?php if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar( 'primary-sidebar' ) ) ?>
	<?php else : ?>
	<?php if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar( sanitize_title_with_dashes( $custom_sidebar ) ) ) ?> 
	<?php endif; ?>
</aside>
<!-- /sidebar -->