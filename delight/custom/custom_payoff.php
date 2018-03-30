<div class="my_meta_control">
 
		<?php $mb->the_field('payoff'); ?>
        <label for="<?php $mb->the_name(); ?>">Payoff</label>
        <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="width:100%" />

		<?php $mb->the_field('subtitle'); ?>
        <label for="<?php $mb->the_name(); ?>">Subtitle</label>
        <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="width:100%" />

</div>