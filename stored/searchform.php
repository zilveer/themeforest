<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<div>
		<input type="text" class="search_input" value="<?php _e('To search, type and hit enter', 'designcrumbs'); ?>" name="s" id="s" onfocus="if (this.value == '<?php _e('To search, type and hit enter', 'designcrumbs'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('To search, type and hit enter', 'designcrumbs'); ?>';}" />
		<input type="hidden" id="searchsubmit" value="Search" />
		<input type="hidden" name="post_type" value="products" />
	</div>
</form>