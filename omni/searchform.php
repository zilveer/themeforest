<?php
/**
 * The template for displaying the search form
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
<form role="search" method="get" id="search_form" class="search-form"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label class="screen-reader-text hide" for="s"><?php esc_html_e( 'Search for:', 'omni' ); ?></label>
	<input type="search" value="<?php get_search_query(); ?>" name="s"
	       placeholder="<?php echo esc_attr__( 'Search', 'omni' ); ?>"/>
	<div class="search-submit"><span aria-hidden="true" class="glyphicon glyphicon-search"></span><input type="submit" /></div>

</form>
