<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset>
		<input placeholder="<?php _e('Search', 'diplomat') ?>" type="text" name="s" autocomplete="off" value="<?php echo get_search_query(); ?>" />
		<button type="submit" class="submit-search"><?php _e('Search', 'diplomat') ?></button>
	</fieldset>
</form>

