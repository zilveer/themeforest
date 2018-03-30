<?php
	/**
	 * searchform.php
	 * The theme searchform
	 * @author TommusRhodus
	 * @package loom
	 * @since 1.0.0
	 */
?>

<form class="searchform" method="get" id="searchform" action="<?php echo home_url(); ?>">
	<div class="input-group">
		<input class="form-control" placeholder="<?php _e('Search', 'flair'); ?>" name="s" id="s" type="text">
	</div>
</form>