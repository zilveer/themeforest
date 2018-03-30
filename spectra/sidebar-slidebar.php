<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			sidebar-slidebar.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>

<?php 
   global $spectra_opts, $wp_query, $post;
?>
	
<!-- Sidebar -->
<aside class="sidebar slidebar">
	<?php if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar( 'slidebar-sidebar' ) ) ?>
</aside>
<!-- /sidebar -->