<?php
/*

	This is standard template for archives.
	Post formats compatible.

*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post-template post-default'); ?>>


	<?php

		global
			$st_Options;

			// More tag
			$more = 0;

			// Post format
			$st_['format'] = ( get_post_format( $post->ID ) && $st_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard';

			if ( !empty($st_['title_disabled']) != 1 ) {
				echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'; }

			include( locate_template( '/includes/posts/formats/' . $st_['format'] . '.php' ) );
	
			// Content
			echo '<div id="content-data" class="post-format-' . $st_['format'] . '-content">'; the_content(); echo '</div><div class="clear"><!-- --></div>';
	
			// Pagination
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'strictthemes' ), 'after' => '</div>' ) );

			// Meta
			st_post_meta();

	?>

	<div class="clear"><!-- --></div>

</div><!-- .post-template -->