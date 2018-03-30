<form action="<?php echo esc_url(home_url( '/' )); ?>" class="searchform" method="get">
        <input type="text" name="s" class="s"  onclick="this.value='';" value="<?php __('Search...', 'bw_themes');?>" />
		<input type="submit" class="headersearch" value="" />
</form>