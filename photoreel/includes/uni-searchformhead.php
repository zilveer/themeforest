<div id="searchelement">
<form class="searchformhead" method="get" action="<?php  echo home_url(); ?>">
<input type="text" name="s" class="s rad" size="30" value="<?php _e('Search website...','themnific');?>" onfocus="if (this.value = '') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}" /><input type="submit" class="searchSubmit" value="" />
</form>
<p><?php bloginfo('description'); ?></p>
</div>