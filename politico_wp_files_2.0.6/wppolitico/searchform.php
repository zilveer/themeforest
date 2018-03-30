<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<div class="slider">
		<label for="s"><?php _e('Search','themolitor');?></label>
		<input type="text" value="" onfocus="this.value=''; this.onfocus=null;" name="s" id="s" />
    </div>
        <input type="submit" id="searchsubmit" value="GO!" />
</form>