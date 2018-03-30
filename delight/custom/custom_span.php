<div class="my_meta_control meta_hidden" id="span_generator">

    <div class="block_separator shortcode_selector">
            <?php $mb->the_field('spancode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" value="" />
                <br>
				<?php $mb->the_field('class'); ?>
                <label for="<?php $mb->the_name(); ?>">Class:</label>
                <input type="text" class="span_class" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
                <br>
				<?php $mb->the_field('id'); ?>
                <label for="<?php $mb->the_name(); ?>">ID:</label>
                <input type="text" class="span_id" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
                <br>
    </div><!-- .block_separator -->    
    <input type="button" class="button-primary alignright" value="Insert shortcode" />

</div><!-- .my_meta_control -->
