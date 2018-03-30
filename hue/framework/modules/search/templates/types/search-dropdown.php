<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-dropdown-holder" method="get">
	<div class="form-inner">
		<input type="text" placeholder="<?php esc_attr_e('Search...', 'hue'); ?>" name="s" class="mkd-search-field" autocomplete="off"/>
		<input value="<?php esc_attr_e('Search', 'hue'); ?>" type="submit" class="mkd-btn mkd-btn-solid mkd-btn-small">
	</div>
</form>