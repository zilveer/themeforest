<div class="my_meta_control meta_hidden">

    <div id="dropcap_generator">
    
            <?php $mb->the_field('dropcapcode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" id="dropcapcode" value="" />

            
			<?php $mb->the_field('border'); ?>
            <label for="<?php $mb->the_name(); ?>">Shape:</label>
            <select name="<?php $mb->the_name(); ?>" id="border_shape" style="width:98%">
                <option value="square"<?php $mb->the_select_state('square'); ?>>Square</option>
                <option value="disc"<?php $mb->the_select_state('disc'); ?>>Disc</option>
            </select>
                <div class="clear"></div>
                
            <div class="pix_color">
				<?php $mb->the_field('color'); ?>
            <label for="<?php $mb->the_name(); ?>">Color of the text:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="cap_color" type="text"  value="<?php if (!$metabox->get_the_value()){ echo '#ffffff';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="pix_color">
				<?php $mb->the_field('bg'); ?>
                <label for="<?php $mb->the_name(); ?>">Background color:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="cap_bg" type="text" value="<?php if (!$metabox->get_the_value()){ echo '#dddddd';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="slider_div letmebe">
				<?php $mb->the_field('height'); ?>
                <label for="<?php $mb->the_name(); ?>">Height:</label>
                <input type="text" id="height" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '36';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
            <div class="slider_div letmebe">
				<?php $mb->the_field('line_height'); ?>
                <label for="<?php $mb->the_name(); ?>">Line height:</label>
                <input type="text" id="line_height" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '36';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
            <div class="slider_div letmebe">
				<?php $mb->the_field('width'); ?>
                <label for="<?php $mb->the_name(); ?>">Width:</label>
                <input type="text" id="width" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '36';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
            <div class="slider_div letmebe">
				<?php $mb->the_field('font_size'); ?>
                <label for="<?php $mb->the_name(); ?>">Font size:</label>
                <input type="text" id="font_size" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '33';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
                <div class="clear" style="height:20px"></div>
            <div class="slider_div letmebe">
				<?php $mb->the_field('margin_top'); ?>
                <label for="<?php $mb->the_name(); ?>">Margin top:</label>
                <input type="text" id="margin_top" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '0';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
            <div class="slider_div letmebe">
				<?php $mb->the_field('margin_right'); ?>
                <label for="<?php $mb->the_name(); ?>">Margin right:</label>
                <input type="text" id="margin_right" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '5';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
                <div class="clear" style="height:20px"></div>
    <input type="button" class="button-primary alignright" value="Insert the drop cap" />
    </div>

</div><!-- .my_meta_control -->
