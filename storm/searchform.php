<form method="get" id="search-form" action="<?php echo home_url(); ?>">
	<input type="text" name="s" id="s" value="<?php _e( 'Search', 'bkninja' ); ?>" onfocus='if (this.value == "<?php _e( 'Search', 'bkninja' ); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e( 'Search', 'bkninja' ); ?>"; }' />
	<div class="search-icon">
        <i class="fa fa-search"></i>
    </div>
</form>