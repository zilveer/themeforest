<form method="get" class="search-form" action="<?php echo home_url(); ?>">
	<?php $value = __( 'Search&hellip;', 'onioneye' ); ?>
	<input type="text" class="search-field" name="s" id="s"  value="<?php echo esc_attr($value); ?>" onfocus="if (this.value == '<?php echo esc_js($value); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_js($value); ?>';}" />
</form><!-- /.search-form -->

