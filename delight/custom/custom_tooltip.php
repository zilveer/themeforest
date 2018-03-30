<div class="my_meta_control meta_hidden" id="tooltip_generator">

    <div class="block_separator multifields shortcode_selector">
    
            <?php $mb->the_field('tooltipcode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" value="" />
			<?php $mb->the_field('content'); ?>
            <label for="<?php $mb->the_name(); ?>">Text of the link:</label>
            <textarea name="<?php $mb->the_name(); ?>" style="width:98%"></textarea>
			<?php $mb->the_field('href'); ?>
            <label for="<?php $mb->the_name(); ?>">Destination (href):</label>
            <input type="text" name="<?php $mb->the_name(); ?>"  style="width:98%" value="" />
			<?php $mb->the_field('width'); ?>
            <label for="<?php $mb->the_name(); ?>">Width:</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="275" />
			<?php $mb->the_field('height'); ?>
            <label for="<?php $mb->the_name(); ?>">Height:</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="auto" />
			<?php $mb->the_field('tooltip'); ?>
            <label for="<?php $mb->the_name(); ?>">Content of the tooltip:</label>
            <select name="<?php $mb->the_name(); ?>" class="toggler" id="source_selector" style="width:98%">
                <option value="local"<?php $mb->the_select_state('local'); ?>>Local</option>
                <option value="external"<?php $mb->the_select_state('external'); ?>>External</option>
            </select>
            
            <div class="toggle source_selector" data-type="local">
				<?php $mb->the_field('local'); ?>
                <label for="<?php $mb->the_name(); ?>">The text you want to display in the tooltip:</label>
                <textarea name="<?php $mb->the_name(); ?>" style="width:98%"></textarea>
            </div><!-- .toggle -->
            <div class="toggle source_selector" data-type="external">
				<?php $mb->the_field('external'); ?>
                <label for="<?php $mb->the_name(); ?>">The URL of the page  you want to display in the tooltip:</label>
                <input type="text" name="<?php $mb->the_name(); ?>" style="width:98%" value="">
                <small><strong>N.B.:</strong> use a page from your domain</small>
            </div><!-- .toggle -->
                        
    </div><!-- .block_separator -->    
    <input type="button" class="button-primary alignright" value="Insert shortcode" />

</div><!-- .my_meta_control -->
