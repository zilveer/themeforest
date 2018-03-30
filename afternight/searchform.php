<?php
	global $is_for_backend;
	if( isset( $is_for_backend ) && $is_for_backend ){
		$tag = 'div';
	}else{
		$tag = 'form';
	}
?>
<<?php echo $tag;?> action="<?php echo home_url(); ?>/" method="get" id="searchform">
    <fieldset>
        <input class="input" name="s" type="text" id="keywords" value="<?php _e('to search, type and hit enter','cosmotheme') ?>" onfocus="if (this.value == '<?php _e('to search, type and hit enter','cosmotheme') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('to search, type and hit enter','cosmotheme') ?>';}">
        <input type="submit"  class="button" value="<?php _e('Search','cosmotheme') ?>">
	</fieldset>
</<?php echo $tag;?>>