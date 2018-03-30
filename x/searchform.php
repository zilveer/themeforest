<?php

// =============================================================================
// SEARCHFORM.PHP
// -----------------------------------------------------------------------------
// Template for displaying search forms in X.
// =============================================================================

?>

<form method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label for="s" class="visually-hidden"><?php _e( 'Search', '__x__' ); ?></label>
  <input type="text" id="s" class="search-query" name="s" placeholder="<?php esc_attr_e( 'Search', '__x__' ); ?>" />
</form>