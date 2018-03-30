<!-- START #search-form -->
<form method="get" class="search-form" action="<?php bloginfo( 'url' ); ?>">
    <fieldset>
    	<?php $value = __( 'Search...', 'onioneye' ); ?>
    	<input type="text" class="field" name="s" id="s"  value="<?php echo $value; ?>" onfocus="if (this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
	</fieldset>
</form>
<!-- END #search-form -->
