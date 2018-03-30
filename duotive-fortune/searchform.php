<form method="get" id="searchform" action="<?php echo site_url(); ?>">
	<input class="inputbox" type="text" name="s" onfocus="if(this.value=='<?php echo dt_SearchInputBox; ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo dt_SearchInputBox; ?>';" value="<?php echo dt_SearchInputBox; ?>" size="20" maxlength="20">
    <input class="search" type="submit" value="" />
</form>