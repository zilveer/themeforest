<div class="st-format-link-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Link
	
	*/

	
		/*--- Link -----------------------------*/
	
		$st_['link'] = st_get_post_meta( $post->ID, 'link_value', true, '' );
	
		if ( $st_['link'] ) {
	
			if ( st_get_post_meta( $post->ID, 'link_redirect_value', true, '' ) ) {
				$st_['link'] = st_get_redirect_page_url() . $st_['link']; }
	
			$st_['link_title'] = st_get_post_meta( $post->ID, 'link_title_value', true, $st_['link'] );
	
			echo '<a target="_blank" href="' . $st_['link'] . '">' . st_get_post_meta( $post->ID, 'link_title_value', true, $st_['link'] ) . '</a>';

		}


	?>

</div>