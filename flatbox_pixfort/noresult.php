<?php
/**
 * The template part used for displaying an error message when no result are found
 */
?>
		<div class="grid12 col">
			<h3><?php _e( 'Nothing Found', 'flatbox' ); ?></h3>
			<p><?php _e( 'Apologies, but no results were found for the requested page. Perhaps searching will help find a related item.', 'flatbox' ); ?></p>
			<?php get_search_form(); ?>

		</div>