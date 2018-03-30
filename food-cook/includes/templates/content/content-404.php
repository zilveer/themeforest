<?php
/**
 * Error Content Template
 *
 * This template is the content template for error screens. It is used to display a message
 * to the viewer when no appropriate page can be found by WordPress.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */
global $woo_options;

$title_before 	= '<h1 class="title-404">';
$title_after 	= '</h1>';
$page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );
$error_img = $html = '';
 
woo_post_before(); ?>

<div>
<?php
	woo_post_inside_before();	

	if( isset( $woo_options['woo_content_error_image'] ) && $woo_options['woo_content_error_image'] ) :
		$error_img .= '<img src="' . esc_url( $woo_options['woo_content_error_image'] ) . '"/>';
	else :
		$error_img .= '<img src="' . get_template_directory_uri() . '/includes/assets/images/404.png"/>';
	endif;

	echo $title_before . apply_filters( 'woo_404_title', $error_img, 'woothemes' ) . $title_after;
?>
	<div class="entry">
	    <?php
	    	if ( isset( $woo_options['woo_content_error_page'] ) && $woo_options['woo_content_error_page'] ) :
		   		$html .= esc_attr( stripslashes( $woo_options['woo_content_error_page'] ) );
		   	else :
		   		$html .= 'The page you are trying to reach does not exist, or has been moved. Return To the <a href=' . esc_url( home_url( '/' ) ) . ' style="font-weight:700;">Homepage</a>.';
			endif;
			
			echo apply_filters( 'woo_404_content', $html, 'woothemes' );

			echo do_shortcode( '[divider]' );

	    	if ( isset( $woo_options['woo_search_error_page'] ) && $woo_options['woo_search_error_page'] == 'true') :
				the_widget( 'Woo_Search', 'title=Please use the search box to find what you are looking for.', 'before_title=<p>&after_title=</p>' ); 
	    	endif;

	    	if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' || is_singular() ) : 
	    		wp_link_pages( $page_link_args );
	    	endif;
	    ?>
	</div><!-- /.entry -->

	<?php woo_post_inside_after(); ?>

</div><!-- /.post -->

<?php woo_post_after(); ?>