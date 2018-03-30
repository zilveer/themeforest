<div class="fieldset">
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<input type="text" id="<?php echo $var[0].'-'.$var[2]; ?>" name="shortcode-<?php echo $var[0]; ?>" value="<?php echo $var[1]['std']; ?>" />
	<?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?> 
		<span class="description"><?php echo $var[1]['description']; ?></span>
	<?php endif; ?>
</div>