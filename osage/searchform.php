<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" name="s" id="s" value="<?php _e( 'Search', 'mvp-text' ); ?>" onfocus='if (this.value == "<?php _e( 'Search', 'mvp-text' ); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e( 'Search', 'mvp-text' ); ?>"; }' />
	<input type="hidden" id="searchsubmit" value="Search" />
</form>