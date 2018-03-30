<div class="fieldset checklist-height" id="<?php echo $var[0].'-'.$var[2]; ?>">
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<div class="checklist">
		<?php foreach ( $var[1]['options'] as $key => $value) : ?>
			<label class="radio-inline"><input type="checkbox" name="list-<?php echo $var[0]; ?>" value="<?php echo $key; ?>" /><?php echo $value; ?></label>
		<?php endforeach; ?>
	</div>
	<div class="clear"></div>
</div>