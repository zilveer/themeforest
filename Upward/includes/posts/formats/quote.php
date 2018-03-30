<div class="st-format-quote-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Quote
	
	*/


		/*--- Quote -----------------------------*/
	
		$st_['quote'] = st_get_post_meta( $post->ID, 'quote_value', true, '' );
	
		if ( $st_['quote'] ) {
			echo '<blockquote><p>' . $st_['quote'] . '</p></blockquote>'; }

	
	?>

</div>