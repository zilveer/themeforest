<?php
/**
 * The Template for displaying an attachment.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php 
	if ( have_posts() ) {
		while ( have_posts() ) { the_post();
			if ( wp_attachment_is_image() ) {
                // Display the original image
				echo wp_get_attachment_image( $post->ID, 'full' );
			}
			the_content();
		}
	}
?>