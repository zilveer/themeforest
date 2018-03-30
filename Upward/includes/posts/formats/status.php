<div class="st-format-status-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Status
	
	*/


		$st_['user_id'] = get_the_author_meta( 'ID' );
		$st_['upic'] = get_avatar( get_the_author_meta( 'user_email' ), '60' );												
		$st_['name'] = get_the_author_meta( 'display_name' );
	
	
		/*--- Status -----------------------------*/
	
		$st_['status'] = st_get_post_meta( $post->ID, 'status_value', true, '' );
	
		if ( $st_['status'] ) {
	
			echo "\n" .
				'<div class="status-header">' . $st_['upic'] . '<a href="' . get_author_posts_url( $st_['user_id'] ) . '">' . $st_['name'] . '</a><div class="clear"><!-- --></div></div>' .
				'<div class="status-content">' . wpautop( $st_['status'] ) . '<div class="clear"><!-- --></div></div>';

		}


	?>

</div>