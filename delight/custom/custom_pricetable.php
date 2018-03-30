<div class="my_meta_control meta_hidden" id="pricetable_generator">

    <div class="block_separator shortcode_selector">
    
            <div style="display:none" id="pricetablecode"></div>

            
            <div class="sorting">   
            	<div style="height:40px; overflow:hidden">   
                    <a href="#" class="docopy-pricetable pix_add_image_event" id="add_a_slider">&nbsp;</a>
                    <p id="cant" style="display:none" class="howto">You can't add more than five columns in a row</p>
                </div>
					<?php $mb->the_field('id'); ?>
                    <div style="float:left; width:150px">
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding-top:5px!important;">Table ID</label>
                        <input type="text" name="<?php $mb->the_name(); ?>" class="pricetable_id" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:138px!important" />
                    </div>
            <?php while($mb->have_fields_and_multi('pricetable')): ?>
            <?php $mb->the_group_open(); ?>
         

           <div class="rm_upload_image">
                <div class="handle"></div>
                <div class="image_block" style="margin-bottom:5px">
					<?php $mb->the_field('class'); ?>
                    <div style="float:left; width:150px">
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding-top:5px!important;">Column class</label>
                        <input type="text" name="<?php $mb->the_name(); ?>" class="pricetable_class" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:138px!important" />
                    </div>
					<?php $mb->the_field('highlighted'); ?>
                    <div style="float:left; width:170px">
                        <label for="<?php $mb->the_name(); ?>" style="float:left; padding-top:5px!important;">Highlighted</label>
                        <select name="<?php $mb->the_name(); ?>" class="pricetable_hl" style="width:98%">
                            <option value="no"<?php $mb->the_select_state('no'); ?>>Not highlighted</option>
                            <option value="yes"<?php $mb->the_select_state('yes'); ?>>Highlighted</option>
                        </select>
                    </div>
                        <div>
                            <a href="#" class="dodelete button-secondary" style="float:right; margin-top:24px">Remove</a>
                        </div>
                </div><!-- .image_block -->
                        
         
            <?php $mb->the_group_close(); ?>
            </div><!-- .rm_upload_image -->
            <?php endwhile; ?>
            </div><!-- .sorting -->

    
                <div class="clear" style="height:20px"></div>
    <input type="button" class="button-primary alignright" value="Insert table" />
    </div>

</div><!-- .my_meta_control -->
