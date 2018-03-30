<!-- SEARCH FORM -->
<div class="search">
	<form action="<?php print site_url(); ?>/" method="get" accept-charset="utf-8">
		<input type="text" class="input-text" name="s" value="<?php _e('Type a keyword...', 'ingrid'); ?>" onfocus="if(this.value=='<?php _e('Type a keyword...', 'ingrid'); ?>'){this.value=''};" onblur="if(this.value==''){this.value='<?php _e('Type a keyword...', 'ingrid'); ?>'}" />
		<button type="submit"><i class="fa fa-search"></i></button>		
	</form>
</div>