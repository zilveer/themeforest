<div class="fieldset">
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<div class="select_wrapper">
		<select id="<?php echo $var[0].'-'.$var[2]; ?>" name="shortcode-<?php echo $var[0]; ?>">
			<?php if ($var[1]['std'] == '') : ?>
				<option value=""><?php _e('Choose your option' , 'yit'); ?></option>
			<?php endif ?>
			<?php foreach ( $var[1]['options'] as $key => $value) : ?>
				<option <?php if (strcmp($var[1]['std'], $key) == 0) : ?> selected="selected" <?php endif ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?> 
		<span class="description"><?php echo $var[1]['description']; ?></span>
	<?php endif; ?>
</div>