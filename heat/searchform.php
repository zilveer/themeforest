<?php
/**
 * The template for displaying search forms in Heat
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s"></label>
		<input type="text" class="field" name="s" id="s" value="<?php _e('search', 'mega') ?>" onfocus="if(this.value=='<?php _e('search', 'mega') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('search', 'mega') ?>';" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Start searching', 'mega' ); ?>" />
	</form>
