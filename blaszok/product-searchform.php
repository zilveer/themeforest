<?php
/**
 * The Search Form base for MPC Themes
 *
 * Displays searche form.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 * @version 2.5.0
 */

?>

<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<div>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Search...', 'mpcth'); ?>" />
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'mpcth'); ?>"/>
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>
