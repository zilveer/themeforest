<?php
/**
 * Shows the search form
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<form action="<?php echo esc_url(home_url("/")); ?>" id="searchform" method="get" role="search">
	<input name="s" type="text" class="search" placeholder="<?php echo esc_attr( __( 'Type and hit enter..' ,'Pixelentity Theme/Plugin') ); ?>" value="<?php echo get_search_query() ? get_search_query() : ""; ?>"/>
	<button class="icon-search" type="submit"></button>
	<a href="#"><b class="icon-search"></b></a>
</form>
