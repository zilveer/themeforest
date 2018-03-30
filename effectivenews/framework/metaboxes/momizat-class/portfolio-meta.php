<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
<?php $mb->the_field('client'); ?>
<p>
<?php $mb->the_field('hide_cat'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Hide Category/s', 'framework') ?></label>
<select name="<?php $mb->the_name(); ?>">
<option value="" <?php $mb->the_select_state(''); ?>><?php _e('No', 'theme'); ?></option>
<option value="yes" <?php $mb->the_select_state('yes'); ?>><?php _e('Yes', 'theme'); ?></option>
</select>
</p>

<p>
<?php $mb->the_field('skills'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Skills Nedded', 'framework') ?></label>
<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
<span class="description"><?php _e('Separate each skill with comma', 'framework'); ?></span>
</p>

<p>
<?php $mb->the_field('url'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Project Url', 'framework') ?></label>
<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
</p>

<p>
<?php $mb->the_field('copyrights'); ?>
<label for="<?php $mb->the_name(); ?>"><?php _e('Copyrights', 'framework') ?></label>
<textarea type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" /><?php $mb->the_value(); ?></textarea>
</p>
</div>