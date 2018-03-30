<div class="my_meta_control">
 
            <p class="howto">If you want to link your image (in the gallery page) to an external URL, type it here below. Otherwise leave the field empty, it will link to the post itself.</span></p>
            <?php $mb->the_field('featured_url'); ?>
            <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%" />
            <div class="clear"></div>
            <?php $mb->the_field('featured_target'); ?>
            <select name="<?php $mb->the_name(); ?>" id="box_border_style" style="width:98%">
                <option value="_blank"<?php $mb->the_select_state('_blank'); ?>>Open the link in a new window</option>
                <option value="_self"<?php $mb->the_select_state('_self'); ?>>Open the link in the same window</option>
                <option value="colorbox"<?php $mb->the_select_state('colorbox'); ?>>Open the link in the ColorBox</option>
            </select>

</div>