<?php
/**
 * The template for displaying search forms in Skylab
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s"></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php _e( 'Search', 'mega' ) ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mega' ); ?>" />
		<input type="hidden" name="post_type" value="post" />
	</form>
