<?php
/**
 * Search form
 *
 * Provides contents of get_search_form()
 */
?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="assistive-text"><?php _e( 'Search', 'risen' ); ?></label>
	<input type="text" name="s" class="search-term input-small" />
	<a href="#" class="search-button button button-small"><?php _ex( 'Search', 'search button', 'risen' ); ?></a>
</form>