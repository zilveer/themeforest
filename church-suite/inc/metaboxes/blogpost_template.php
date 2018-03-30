<div>

	<p>
		<?php $mb->the_field('style_type'); ?>
		<select name="<?php $mb->the_name(); ?>">
		    <option value="default"<?php if ($metabox->get_the_value() == 'default') echo 'selected'; ?>>Default</option>
			<option value="postshow1"<?php if ($metabox->get_the_value() == 'postshow1') echo 'selected'; ?>>Postshow1</option>
			<option value="postshow2"<?php if ($metabox->get_the_value() == 'postshow2') echo 'selected'; ?>>Postshow2</option>
		</select>
		
	</p>
	<input type="submit" class="button-primary" name="save" value="Save">

</div>