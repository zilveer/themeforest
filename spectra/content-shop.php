<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			content-shop.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>

<?php 
   global $spectra_opts, $wp_query, $post; 
?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php the_content( __( '...View the rest of this post', SPECTRA_THEME ) ); ?>
	
	<div class="clear"></div>

	<?php
		wp_link_pages( array(
			'before' 	=> '<div class="page-links">' . __( 'Jump to Page', SPECTRA_THEME ),
			'after' 	=> '</div>',
		) );
	?>
    
</article>