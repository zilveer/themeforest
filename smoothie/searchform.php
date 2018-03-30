<form action="<?php echo home_url( '/' ); ?>" class="search-form clearfix">
	<fieldset>
		
		<input type="submit" value="Go" class="submit" />
		<i class="fa fa-search"></i>
		<input type="text"  class="search-form-input text" name="s" onfocus="if (this.value == '<?php _e('Search','cr'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search','cr'); ?>';}" value="<?php _e('Search','cr'); ?>"/>
		
	</fieldset>
</form>
