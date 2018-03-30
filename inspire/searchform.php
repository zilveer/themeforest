<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
		<input type="text" value="<?php _e('Search here...', 'loc_inspire'); ?>" name="s" id="s" onfocus="if(this.value == this.defaultValue) this.value = ''"/>
		<input type="submit" id="searchsubmit" value="" />
	 </div>
</form>