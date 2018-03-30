<div class="my_meta_control meta_hidden" id="googlemap_generator">

    <div class="block_separator multifields shortcode_selector">
            <?php $mb->the_field('googlemapcode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" value="" />
                <br>
				<?php $mb->the_field('width'); ?>
                <label for="<?php $mb->the_name(); ?>">Width:</label>
                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php if (!$metabox->get_the_value()){ echo '427';} else { $metabox->the_value(); } ?>" />
                <small>Narrow column is 427 pixels wide, wide column is 708 pixels.</small>
                <br>
				<?php $mb->the_field('height'); ?>
                <label for="<?php $mb->the_name(); ?>">Height:</label>
                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php if (!$metabox->get_the_value()){ echo '300';} else { $metabox->the_value(); } ?>" />
                <small></small>
                <br>
				<?php $mb->the_field('url'); ?>
                <label for="<?php $mb->the_name(); ?>">Google map URL: <a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-url.php?TB_iframe=true&width=600&height=550" class="info_icon thickbox">&nbsp;</a></label>
                <input type="text" name="<?php $mb->the_name(); ?>" style="width:98%" value="" />
    </div><!-- .block_separator -->    
    <input type="button" class="button-primary alignright" value="Insert shortcode" />

</div><!-- .my_meta_control -->
