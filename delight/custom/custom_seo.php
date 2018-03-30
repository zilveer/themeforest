<div class="my_meta_control">
 
		<?php $mb->the_field('title'); ?>
        <label for="<?php $mb->the_name(); ?>">Page title</label>
        <input id="<?php $mb->the_id(); ?>" class="pix_title_seo" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="width:100%" />
        <p></p>

		<?php $mb->the_field('description'); ?>
        <label for="<?php $mb->the_name(); ?>">Meta description</label>
        <textarea id="<?php $mb->the_id(); ?>" class="pix_desc_seo" name="<?php $mb->the_name(); ?>"style="width:100%"><?php $metabox->the_value(); ?></textarea>
        <p></p>

		<?php $mb->the_field('keywords'); ?>
        <label for="<?php $mb->the_name(); ?>">Meta keywords</label>
        <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="width:100%" />

</div>