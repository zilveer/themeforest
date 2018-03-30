<div class="my_meta_control meta_hidden" id="slideshow_generator">

    <div class="block_separator multifields shortcode_selector">
            <?php $mb->the_field('slideshow_code'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" id="slideshow_code" value='<?php $metabox->the_value(); ?>' />
			<div class="slider_div letmebe milliseconds" style="clear:both; overflow:auto">
                <br>
				<?php $mb->the_field('timeout'); ?>
                <label for="<?php $mb->the_name(); ?>">Milliseconds between slide transitions</label>
                <input type="text" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '7000';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor" style="display:block!important; clear:both!important; margin: 10px 0"></div>
            </div>
            <br>
            
			<div style="clear:both; overflow:auto; margin-bottom:10px" class="radio_size">
				<?php $mb->the_field('slideshow_size'); ?>
                <label>Size of the slideshow</label>
                <input type="radio" name="<?php $mb->the_name(); ?>" value="427x240" checked="checked" /> 427x240 (narrow column)
                <input type="radio" name="<?php $mb->the_name(); ?>" value="708x398"<?php echo $mb->is_value('708x398')?' checked="checked"':''; ?>/> 708x398 (wide column)
                <input type="radio" name="<?php $mb->the_name(); ?>" value="custom"<?php echo $mb->is_value('custom')?' checked="checked"':''; ?>/> Custom size
				<?php $mb->the_field('slideshow_custom_size'); ?>
                <input type="text" name="<?php $mb->the_name(); ?>" id="custom_size" value="<?php if (!$metabox->get_the_value()){ echo '300x200';} else { $metabox->the_value(); } ?>" style="width:100px!important;" />
            </div>


            <div class="sorting">      
            <a href="#" class="docopy-slideshow pix_add_image_event" id="add_a_slider">&nbsp;</a>
            <?php while($mb->have_fields_and_multi('slideshow')): ?>
            <?php $mb->the_group_open(); ?>
         

           <div class="rm_upload_image">
                <div class="handle"></div>
                <div class="image_block" style="margin-bottom:5px">
					<?php $mb->the_field('image'); if (get_pix_thumb($metabox->get_the_value(), 'exTh')){ $file =  get_pix_thumb($metabox->get_the_value(), 'exTh'); } else { $file = get_pix_thumb(str_replace('-'.reduce_string('-','.',$metabox->get_the_value()),'',$metabox->get_the_value()), 'exTh'); } ?>
                    <div style="float:left; width:225px">
                        <div class="image_thumb no_overlay"><img src="<?php echo $file; ?>" alt="Preview" <?php if($metabox->get_the_value()=='') { ?> style="display: none"<?php } ?> /></div>
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding-top:7px!important;">Your image</label>
                        <a class="button-secondary pix_upload_image_button no_overlay" href="#" style="margin-bottom:2px!important">Upload</a>
                        <input type="text" name="<?php $mb->the_name(); ?>" class="slideshow_image" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:163px!important" /><br>
                    </div>
					<?php $mb->the_field('link'); ?>
                    <div style="float:left; width:170px">
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding:7px 0 5px!important;">Link to</label>
                        <input type="text" name="<?php $mb->the_name(); ?>" class="secondtype slideshow_href" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width: 170px!important" />
                    </div>
					<?php $mb->the_field('caption'); ?>
                    <div style="float:left; width:225px">
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding:7px 0!important;">Caption</label>
                        <textarea type="text" name="<?php $mb->the_name(); ?>" class="secondtype slideshow_caption" style="margin: 5px 0; height:56px!important; width: 220px!important"><?php $metabox->the_value(); ?></textarea>
                    </div>
					<?php $mb->the_field('button'); ?>
                    <div style="float:left; width:170px">
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding:7px 0!important;">Button text</label>
                        <input type="text" name="<?php $mb->the_name(); ?>" class="secondtype slideshow_button" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width: 170px!important" />
                        <a href="#" class="dodelete button-secondary" style="float:right; margin-top:4px">Remove</a>
                    </div>
                </div><!-- .image_block -->
                        
         
            <?php $mb->the_group_close(); ?>
            </div><!-- .rm_upload_image -->
            <?php endwhile; ?>
            </div><!-- .sorting -->

    </div><!-- .block_separator -->
    <input type="button" class="button-primary alignright" value="Insert shortcode" />
    
    
</div><!-- .my_meta_control -->
