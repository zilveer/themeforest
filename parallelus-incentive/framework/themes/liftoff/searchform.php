<?php global $s;
/**
 * The template for the search widget
 */

// The value of the field
$inputValue = ($s) ? $s : __('Search...', 'liftoff');

?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="searchFormContainer">
		<input type="text" name="s" id="s" value="<?php echo $inputValue; ?>" onfocus="if (this.value == '<?php _e('Search...', 'liftoff');?>')this.value = '';" onblur="if (this.value == '')this.value = '<?php _e('Search...', 'liftoff');?>';" />
	</div>
</form>

