<?php
/**
 * The template for displaying a "No posts found" message
 */
?>

<h2 class="info-title"><?php _e( 'Nothing Found', 'diplomat' ); ?></h2>

<p>

	<?php
	if ( is_search() ) {
		_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'diplomat' );
	} else {
		_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'diplomat' );
	}

	get_search_form();
	?>

</p>
