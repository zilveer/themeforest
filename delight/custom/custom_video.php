<div class="my_meta_control meta_hidden">

<div id="video_generator">
	<?php $mb->the_field('video_code'); ?>
    <input type="hidden" name="<?php $mb->the_name(); ?>" id="video_code" value='<?php $metabox->the_value(); ?>' />

    <div class="block_separator">
        <label>Source</label>
		<?php $mb->the_field('source'); ?>
        <select name="<?php $mb->the_name(); ?>" class="toggler" id="custom_video_source">
            <option value="externally"<?php $mb->the_select_state('externally'); ?>>Externally hosted video</option>
            <option value="self"<?php $mb->the_select_state('self'); ?>>Self hosted video</option>
        </select>
    </div><!-- .block_separator -->

    <div class="toggle custom_video_source" data-type="externally">
        <div class="block_separator">
        <?php $mb->the_field('ext_video'); ?>
            <label for="<?php $mb->the_name(); ?>">Your video</label>
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%" /><br>
                <div class="clear"><br><small>paste here the URL of the page hosting the video</small></div>
        </div><!-- .block_separator -->
    </div><!-- .externally -->
    
    <div class="toggle custom_video_source" data-type="self">
        <div class="block_separator">
        <?php $mb->the_field('video'); ?>
            <label for="<?php $mb->the_name(); ?>">Your video</label>
            <div class="rm_upload_video">
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%" /><br>
                <input id="<?php $mb->the_id(); ?>_button" class="button-secondary no_overlay" type="button" value="Upload Video" />
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
        
    </div><!-- .self -->

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
    
</div><!-- #video_generator -->
</div><!-- .my_meta_control -->
