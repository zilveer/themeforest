<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	This template comes with an excerpt instead of a whole post.
	Post formats compatible.

*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post-template post-t3'); ?>>

	<?php

		global
			$st_Options,
			$st_Settings;

			// Post format
			$st_['format'] = ( get_post_format( $post->ID ) && $st_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard';

			// Is title disabled?
			$st_['title_disabled'] = st_get_post_meta( $post->ID, 'disable_title_value', true, 0 );

			include( locate_template( '/includes/posts/formats/' . $st_['format'] . '.php' ) );
	
			echo '<div class="clear"><!-- --></div>';


			// Title and Excerpt
			if ( $st_['format'] == 'standard' ) {} ?>
		
				<div class="t3-right">
			
					<?php

						if ( !empty($st_['title_disabled']) != 1 ) {
							echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'; }
			
						if ( get_the_excerpt() ) {

							echo wpautop( do_shortcode( get_the_excerpt() ) );

							echo '<a class="button" href="' . get_permalink() . '"><span>' . __( 'Continue', 'strictthemes' ) . '</span></a>';

						}
		
					?>
			
				</div>
			
				<?php
		
			


			// Meta
			if ( !empty( $st_Settings['post_meta'] ) && $st_Settings['post_meta'] == 'yes' ) { ?>

				<div class="t3-left<?php echo $st_['title_disabled'] ? ' t3-left-alt' : ''; ?>"><?php
	
					st_post_meta();	?>
	
				</div><?php
	
			}


	?>

	<div class="clear"><!-- --></div>

</div><!-- .post-template -->