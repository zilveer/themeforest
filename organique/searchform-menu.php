<?php
/**
 * Search form for the top menu
 *
 * @package Organique
 */
?>
<form role="search" class="navbar-form pull-right" action="<?php echo home_url( '/' ); ?>" method="get">
	<button type="submit"><i class="fa fa-search"></i></button>
	<input type="text" class="span1 js-nav-search" name="s">
</form>