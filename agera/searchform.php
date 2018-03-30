<?php
/**
 * The template for displaying search forms in Agera
 *
 * @package WordPress
 * @subpackage Agera
 * @since Agera 1.0
 */
?>

	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" value="<?php _e( 'Search', 'agera' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php _e( 'Search', 'agera' ); ?>"/>
	</form>
