<div class="my_meta_control meta_hidden">

    <div id="box_generator">
    		<p class="howto">You will can add content after inserting the code</p>
    
            <?php $mb->the_field('boxcode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" id="boxcode" value="" />
            
            <label>Icon:</label>
            <div class="boxIcon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/box-no-icon.png" id="none">
                <img src="<?php echo get_template_directory_uri(); ?>/images/box-quote.png" id="quotes">
                <img src="<?php echo get_template_directory_uri(); ?>/images/box-balloon.png" id="balloon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/box-info.png" id="info">
                <img src="<?php echo get_template_directory_uri(); ?>/images/box-arrow.png" id="arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/images/box-question.png" id="question">
            </div><!-- .imgGrid -->
            
            <div class="clear"></div>

            <div class="pix_color">
				<?php $mb->the_field('bg'); ?>
                <label for="<?php $mb->the_name(); ?>">Background color:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="box_bg" type="text" value="<?php if (!$metabox->get_the_value()){ echo '#eeeeee';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="pix_color">
				<?php $mb->the_field('color'); ?>
            <label for="<?php $mb->the_name(); ?>">Color of the text:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="box_color" type="text"  value="<?php if (!$metabox->get_the_value()){ echo '#222222';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="pix_color">
				<?php $mb->the_field('border_color'); ?>
                <label for="<?php $mb->the_name(); ?>">Border color:</label>
                <div class="clear"></div>
                <input name="<?php $mb->the_name(); ?>" id="box_border_color" type="text" value="<?php if (!$metabox->get_the_value()){ echo '#dddddd';} else { $metabox->the_value(); } ?>" style="float:left; width:230px" />
                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:2px 0 0 1px" class="a_palette" />
                <div class="colorpicker"></div>
                <div class="clear"></div>
            </div>

            <div class="slider_div letmebe border">
				<?php $mb->the_field('border_size'); ?>
                <label for="<?php $mb->the_name(); ?>">Border size:</label>
                <input type="text" id="box_border_size" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '2';} else { $metabox->the_value(); } ?>" />
                <div class="slider_cursor"></div>
                <div class="clear"></div>
            </div><!-- .slider_div letmebe -->
    
			<?php $mb->the_field('border_style'); ?>
            <label for="<?php $mb->the_name(); ?>">Border style:</label>
            <select name="<?php $mb->the_name(); ?>" id="box_border_style" style="width:98%">
                <option value="none"<?php $mb->the_select_state('none'); ?>>None</option>
                <option value="hidden"<?php $mb->the_select_state('hidden'); ?>>Hidden</option>
                <option value="dotted"<?php $mb->the_select_state('dotted'); ?>>Dotted</option>
                <option value="dashed"<?php $mb->the_select_state('dashed'); ?>>Dashed</option>
                <option value="solid"<?php $mb->the_select_state('solid'); ?>>Solid</option>
                <option value="double"<?php $mb->the_select_state('double'); ?>>Double</option>
                <option value="groove"<?php $mb->the_select_state('groove'); ?>>Groove</option>
                <option value="ridge"<?php $mb->the_select_state('ridge'); ?>>Ridge</option>
                <option value="inset"<?php $mb->the_select_state('inset'); ?>>Inset</option>
                <option value="outset"<?php $mb->the_select_state('outset'); ?>>Outset</option>
            </select>
    
                <div class="clear" style="height:20px"></div>
    <input type="button" class="button-primary alignright" value="Insert shortcode" />
    </div>

</div><!-- .my_meta_control -->
