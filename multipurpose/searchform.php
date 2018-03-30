<form method="get" class="searchform" action="<?php echo home_url(); ?>">
<fieldset>
	<input type="text" value="<?php the_search_query(); ?>" name="s" placeholder="<?php esc_attr_e('Search', 'multipurpose') ?>" /><button type="submit" name="searchsubmit" value="<?php esc_attr_e('Search', 'multipurpose') ?>"><span><span class="button-text"><?php esc_attr_e('Search', 'multipurpose'); ?></span></span></button>
</fieldset>
</form>