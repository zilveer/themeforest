<div class="my_meta_control meta_hidden">

    <div id="button_generator">
    		<p class="howto">You will can add content after inserting the code</p>
    
            <?php $mb->the_field('buttoncode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" id="buttoncode" value="" />
            
				<?php $mb->the_field('text'); ?>
                <label for="<?php $mb->the_name(); ?>">Text of the button:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="text_button" type="text" value="<?php $metabox->the_value(); ?>" style="width:98%" />
                <div class="clear"></div>

            <div class="pix_color">
				<?php $mb->the_field('bg'); ?>
                <label for="<?php $mb->the_name(); ?>">Background color:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="button_bg" type="text" value="<?php if (!$metabox->get_the_value()){ echo '#888888';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="pix_color">
				<?php $mb->the_field('hover'); ?>
                <label for="<?php $mb->the_name(); ?>">Background on mouse over:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="hover_bg" type="text" value="<?php if (!$metabox->get_the_value()){ echo '#666666';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="pix_color">
				<?php $mb->the_field('color'); ?>
            <label for="<?php $mb->the_name(); ?>">Color of the text:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="button_color" type="text"  value="<?php if (!$metabox->get_the_value()){ echo '#ffffff';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="pix_color">
				<?php $mb->the_field('border_color'); ?>
                <label for="<?php $mb->the_name(); ?>">Border color:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="button_border_color" type="text" value="<?php if (!$metabox->get_the_value()){ echo '#666666';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="slider_div letmebe border">
				<?php $mb->the_field('border_size'); ?>
                <label for="<?php $mb->the_name(); ?>">Border size:</label>
                <input type="text" id="button_border_size" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '0';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
			<?php $mb->the_field('button_size'); ?>
            <label for="<?php $mb->the_name(); ?>">Size:</label>
            <select name="<?php $mb->the_name(); ?>" id="button_size" style="width:98%">
                <option value="medium"<?php $mb->the_select_state('medium'); ?>>Medium</option>
                <option value="small"<?php $mb->the_select_state('small'); ?>>Small</option>
                <option value="large"<?php $mb->the_select_state('large'); ?>>Large</option>
            </select>
    
                <div class="clear" style="height:20px"></div>
    <input type="button" class="button-primary alignright" value="Insert shortcode" />
    </div>

</div><!-- .my_meta_control -->
