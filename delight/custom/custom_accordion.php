<div class="my_meta_control meta_hidden" id="accordion_generator">

    <div class="block_separator multifields shortcode_selector">
            <?php $mb->the_field('accordion_code'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" id="accordion_code" value='<?php $metabox->the_value(); ?>' />
			<?php $mb->the_field('title'); ?>
            <label for="<?php $mb->the_name(); ?>" style="padding:7px 0 5px!important;">Active tab</label><br>
            <input type="text" class="accordion_active" name="<?php $mb->the_name(); ?>" style="display:block; clear:both; width:100px!important"" value="1"<?php if (!$metabox->get_the_value()){ echo '1';} else { $metabox->the_value(); } ?>/><br>
            <small>Type here above the number of the element you want to be open on page loading. Type 0 if you want all elements are closed</small><br>
            <div class="sorting">      
            <a href="#" class="docopy-accordion pix_add_image_event" id="add_a_slider">&nbsp;</a>
            <?php while($mb->have_fields_and_multi('accordion')): ?>
            <?php $mb->the_group_open(); ?>
         

           <div class="rm_upload_image">
                <div class="handle"></div>
                <div class="image_block" style="margin-bottom:5px; float:left; width:395px">
					<?php $mb->the_field('title'); ?>
                        <label for="<?php $mb->the_name(); ?>" style="padding:7px 0 5px!important;">Title</label><br>
                        <input type="text" class="accordion_title_generated" name="<?php $mb->the_name(); ?>" style="display:block; clear:both; width:98%!important"" value="<?php $metabox->the_value(); ?>" />
					<?php $mb->the_field('content'); ?>
                        <label for="<?php $mb->the_name(); ?>" style="padding:7px 0!important;">Content</label><br>
                        <textarea name="<?php $mb->the_name(); ?>" class="accordion_content_generated" style="margin: 5px 0; height:50px!important; display:block; clear:both; width:98%!important"><?php $metabox->the_value(); ?></textarea>
                        <div>
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
