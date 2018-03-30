<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<input type="text" value="<?php _e('Search', 'mthemelocal');?>" name="s" id="s" class="right" onfocus="if(this.value == '<?php _e('Search', 'mthemelocal');?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search', 'mthemelocal');?>';}" />
<button id="searchbutton" title="<?php _e('Search','mthemelocal');?>" type="submit"></button>
</form>