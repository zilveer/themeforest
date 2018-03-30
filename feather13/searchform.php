<form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div>
		<input type="text" id="s" name="s" onblur="if(this.value=='')this.value='<?php _e('Enter your search...','feather'); ?>';" onfocus="if(this.value=='<?php _e('Enter your search...','feather'); ?>')this.value='';" value="<?php _e('Enter your search...','feather'); ?>" />
	</div>
</form>