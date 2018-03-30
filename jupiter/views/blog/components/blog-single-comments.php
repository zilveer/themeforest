<?php

/**
 * template part for blog single content single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

global $mk_options;


if($mk_options['blog_single_comments'] == 'true') :

	if ( get_post_meta( $post->ID, '_disable_comments', true ) != 'false' ) {
		comments_template( '', true );
	}

endif;