<?php
/**
 * The template for displaying search forms 
 *
 */
?>

<form method="get" id="searchform" class="hide-input" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" />
    <input type="hidden" name="post_type" value="post" />
    <input type="submit" value="<?php esc_attr_e( 'Go', ETHEME_DOMAIN ); ?>" class="button" />
    <div class="clear"></div>
</form>