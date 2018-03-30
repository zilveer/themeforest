<?php
/**
 * Search form
 *
 * @package Organique
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="form">
	<input name="s" class="form-control  form-control--search" id="appendedInputButton" type="text" placeholder="<?php _e( 'Search ...', 'organique_wp' ); ?>" />
  <button type="submit" class="btn  btn-primary  pull-right">
    <span class="glyphicon  glyphicon-search"></span>
  </button>
</form>