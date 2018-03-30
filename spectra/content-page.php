<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			content-page.php
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

 	<!-- ############ PAGE FOOTER ############ -->
     <footer class="page-footer anim-css" data-delay="0">
        <!-- ############ PAGE SOCIAL ############ -->
        <div class="social-wrap">
            <div class="page-social">
                <!-- Facebook -->
                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( get_permalink( $post->ID ) ) ?>" class="facebook-share"><span class="icon icon-facebook"></span></a>
                <!-- Twitter -->
                <a target="_blank" href="http://twitter.com/share?url=<?php echo esc_url( get_permalink( $post->ID ) ) ?>" class="twitter-share"><span class="icon icon-twitter"></span></a>
                 <!-- G+ -->
                <a target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink( $post->ID ) ) ?>" class="googleplus-share"><span class="icon icon-googleplus"></span></a>
            </div>
        </div>
        <!-- /page social -->
    </footer>
    <!-- /page footer -->
</article>