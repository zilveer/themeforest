<div class="my_meta_control">
 
            <p class="howto">If you want to show a video when you click the image in the taxonomy page, use the field below <span style="font-weight:normal">(upload your self-hosted video or paste here only the &quot;src&quot;... read the documentation for more info)</span></p>
            <?php $mb->the_field('featured_video'); ?>
            <div class="rm_upload_video">
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%" /><br>
                <input id="<?php $mb->the_id(); ?>_button" class="button-secondary" type="button" value="Upload Video" />
                <div class="clear"></div>
            </div>

</div>