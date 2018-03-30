<?php
/**
 * The template for displaying search forms in Theme
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'color-theme-framework' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'color-theme-framework' ); ?>" />
		<button type="submit" class="submit btn" name="submit" id="searchsubmit"><i class="icon-search"></i></button>
	</form>
