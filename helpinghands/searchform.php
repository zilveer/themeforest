<?php
/**
 * Theme Search Form
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
?>

<div class="sd-search">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
		<input class="sd-search-input" name="s" type="text" size="25"  maxlength="128" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search', 'sd-framework' ); ?>" />
		<button class="sd-search-button"><i class="fa fa-search"></i></button>
	</form>
</div>