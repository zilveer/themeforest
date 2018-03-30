	<form id="searchform" method="get" action="<?php echo home_url() ?>/">
		<div>
			<input type="text" name="s" id="searchinput" value="<?php esc_attr_e('Search here...', 'wizedesign') ?>" onblur="if (this.value == '') {this.value = '<?php esc_html_e('Search here...', 'wizedesign') ?>';}" onfocus="if (this.value == '<?php esc_html_e('Search here...', 'wizedesign') ?>') {this.value = '';}"/>
			<input type="submit" class="button1" id="search-button" value="<?php esc_attr_e('', 'wizedesign') ?>" />                         
		</div>
	</form>