<div class="my_meta_control meta_hidden">

<div id="audio_generator">
	<?php $mb->the_field('audio_code'); ?>
    <input type="hidden" name="<?php $mb->the_name(); ?>" id="audio_code" value='<?php $metabox->the_value(); ?>' />

        <div class="block_separator">
        <?php $mb->the_field('audio'); ?>
            <label for="<?php $mb->the_name(); ?>">Your MP3</label>
            <div class="rm_upload_audio">
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%" /><br>
                <input id="<?php $mb->the_id(); ?>_button" class="button-secondary no_overlay" type="button" value="Upload MP3" />
                <div class="clear"></div>
            </div>
        </div><!-- .block_separator -->
    
        <div class="block_separator">
            <?php $mb->the_field('poster'); ?>
            <label for="<?php $mb->the_name(); ?>">Poster image</label>
            <div class="rm_upload_image">
                <div class="image_thumb no_overlay"><img src="<?php echo get_pix_thumb($metabox->get_the_value(), 'exTh'); ?>" alt="Preview" <?php if($metabox->get_the_value()=='') { ?> style="display: none"<?php } ?> /></div>
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0;" /><br>
                <a class="button-secondary pix_upload_image_button no_overlay" href="#">Upload Image</a>
            </div><!-- .rm_upload_image -->
        </div><!-- .block_separator -->
        
        
        <div class="block_separator">
		<?php $mb->the_field('audio_start'); ?>
            <label for="<?php $mb->the_name(); ?>">Auto start</label>
            <input type="checkbox" name="<?php $metabox->the_name(); ?>" value="true"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/>
        </div><!-- .block_separator -->

        

    <div class="block_separator">
        <div style="float: left">
            <?php $mb->the_field('width'); ?>
            <label for="<?php $mb->the_name(); ?>">Width (only numbers, no measurement units)</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php if (!$metabox->get_the_value()){ echo '429';} else { $metabox->the_value(); } ?>" />
        </div>
        <div style="float: left">
            <?php $mb->the_field('height'); ?>
            <label for="<?php $mb->the_name(); ?>">Height (only numbers, no measurement units)</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php if (!$metabox->get_the_value()){ echo '241';} else { $metabox->the_value(); } ?>" />
        </div>
        <div class="clear"><br><small>Remember: the width of a wide column is 710 pixels, of a narrow column is 429 pixels</small></div>
    </div><!-- .block_separator -->

    <input type="button" class="button-primary alignright" value="Insert shortcode" />
    
</div><!-- #audio_generator -->
</div><!-- .my_meta_control -->
