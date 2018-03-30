<form role="search" method="get" id="main-search-form" action="<?php echo esc_url(home_url( '/'  )); ?>">
	<?php $value = __( 'Search&hellip;', 'onioneye' ); ?>
	<input type="text" name="s" id="main-search-field" value="<?php echo esc_attr($value); ?>" onfocus="if (this.value == '<?php echo esc_js($value); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_js($value); ?>';}" />
	<input type="submit" id="main-search-submit" value="" />
</form>
