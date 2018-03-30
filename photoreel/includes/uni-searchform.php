<form class="searchform" method="get" action="<?php  echo home_url(); ?>">
<input type="text" name="s" class="s" size="30" value="<?php _e('Search website...','themnific');?>" onfocus="if (this.value = '') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search website...','themnific');?>';}" /><input type="submit" class="searchSubmit" value="" />
</form>