<?php
/**
 *
 * Search form template
 *
 */
?>
<div class="search-form">
	<form class="search-form" method="get" action="<?php echo home_url(); ?>/">
		<input type="text" placeholder="<?php echo __("Search...", "vivaco"); ?>" id="s" name="s" value="<?php esc_attr(get_search_query()); ?>" />
		<button type="submit" value="Search"><i class="fa fa-search"></i></button>
	</form>
</div>
