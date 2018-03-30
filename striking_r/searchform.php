<?php
/**
 * The template for displaying search forms
 */
?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>">
	<input type="text" class="text_input" value="<?php _e('Search..', 'striking-r');?>" name="s" id="s" onfocus="if(this.value == '<?php _e('Search..', 'striking-r');?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search..', 'striking-r');?>';}" />
	<button type="submit" class="<?php echo apply_filters( 'theme_css_class', 'button' );?> gray"><span><?php _e('Search', 'striking-r');?></span></button>
</form>
