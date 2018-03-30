<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			sidebar-category.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>

<?php 
   global $spectra_opts, $wp_query, $post;

   $spectra_layout = 'main-left';
?>
	
<!-- Sidebar -->
<aside class="sidebar <?php echo esc_attr( $spectra_layout ) ?>">
	<?php if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar( 'category-sidebar' ) ) ?>
</aside>
<!-- /sidebar -->