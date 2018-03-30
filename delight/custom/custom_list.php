<div class="my_meta_control meta_hidden">

    <div id="list_generator">
    
            <?php $mb->the_field('listcode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" id="listcode" value="" />

            <label>Select your list type:</label>
            <div class="boxIcon">
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/listicon-check.png" id="pix_check">
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/listicon-arrow.png" id="pix_arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/listicon-plus.png" id="pix_plus">
            </div><!-- .imgGrid -->
            
                <div class="clear" style="height:20px"></div>
    <input type="button" class="button-primary alignright" value="Insert the list" />
    </div>

</div><!-- .my_meta_control -->
