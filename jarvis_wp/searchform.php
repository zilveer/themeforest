<form action="<?php echo home_url(); ?>/" id="searchform" method="get">
  <input type="text" id="s" name="s" value="<?php _e('To search type and hit enter', 'rocknrolla') ?>" onfocus="if(this.value=='<?php _e('To search type and hit enter', 'rocknrolla') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter', 'rocknrolla') ?>';" autocomplete="off" />
  <input type="submit" value="Search" id="searchsubmit" class="hidden" />
</form>
