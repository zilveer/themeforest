<form role="search" method="get" class="searchform" action="<?php echo home_url(); ?>" >
	<div>
		<label class="screen-reader-text" for="s"><?php _e('Search for:', 'basil'); ?></label>
		<input type="text" placeholder="<?php _e('Search here...', 'basil'); ?>" name="s" class="field" />
		<input type="submit" class="searchsubmit" value="<?php _e('Search', 'basil'); ?>" />
	</div>
</form>