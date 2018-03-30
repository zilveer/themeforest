<form method="get" id="searchform" action="<?php echo esc_url( home_url( '' ) ); ?>/">
	<input type="text" name="s" id="s" value="<?php _e( 'Type search term and press enter', 'mvp-text' ); ?>" onfocus='if (this.value == "<?php _e( 'Type search term and press enter', 'mvp-text' ); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e( 'Type search term and press enter', 'mvp-text' ); ?>"; }' />
	<input type="hidden" id="searchsubmit" value="Search" />
</form>