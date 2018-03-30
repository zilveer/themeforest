<form method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div><label class="screen-reader-text" for="s">Search for:</label>
		<input type="text" value="" placeholder="<?php esc_html_e('Search', 'flow'); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="&#xf002;" />
	</div>
</form>