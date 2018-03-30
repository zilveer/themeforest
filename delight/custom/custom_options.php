<div class="my_meta_control">
 
    <div class="block_separator">
        <label>Background</label>
		<?php $mb->the_field('background'); ?>
        <select name="<?php $mb->the_name(); ?>" class="toggler" id="custom_background_page">
            <option value="default"<?php $mb->the_select_state('default'); ?>>Default background</option>
            <option value="singleimage"<?php $mb->the_select_state('singleimage'); ?>>Single wide image</option>
            <option value="slideshow"<?php $mb->the_select_state('slideshow'); ?>>Slideshow</option>
            <option value="video"<?php $mb->the_select_state('video'); ?>>Video</option>
            <option value="googlemap"<?php $mb->the_select_state('googlemap'); ?>>Google Map</option>
            <option value="none"<?php $mb->the_select_state('none'); ?>>None</option>
        </select>

        <div class="toggle custom_background_page" id="custom_background_page" data-type="singleimage">
            <br>
			<?php $mb->the_field('single_image'); ?>
            <div class="rm_upload_image">
                <div class="image_thumb"><img src="<?php echo get_pix_thumb($metabox->get_the_value(), 'exTh'); ?>" alt="Preview" <?php if($metabox->get_the_value()=='') { ?> style="display: none"<?php } ?> /></div>
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0;" /><br>
                <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
            </div><!-- .rm_upload_image -->
        </div><!-- .toggle -->
    
        <div class="toggle custom_background_page" id="custom_background_page" data-type="slideshow">
			<br>
            <div class="sorting">      
            <a href="#" class="docopy-slideshow pix_add_image_event" id="add_a_slider">&nbsp;</a>
            <?php while($mb->have_fields_and_multi('slideshow')): ?>
            <?php $mb->the_group_open(); ?>
         
            <div class="rm_upload_image">
                <?php $mb->the_field('link'); ?>
                <div class="handle"></div>
                <div class="image_block">
                <div class="image_thumb"><img src="<?php echo get_pix_thumb($metabox->get_the_value(), 'exTh'); ?>" alt="Preview" <?php if($metabox->get_the_value()=='') { ?> style="display: none"<?php } ?> /></div>
         
                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0;" /><br>
                        <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        <a href="#" class="dodelete button-secondary">Remove</a>
                </div><!-- .image_block -->
         
            <?php $mb->the_group_close(); ?>
            </div><!-- .rm_upload_image -->
            <?php endwhile; ?>
            </div><!-- .sorting -->
         
        </div><!-- .toggle -->
    
        <div class="toggle custom_background_page" id="custom_background_page" data-type="video">
            <?php $mb->the_field('video'); ?>
            <div class="rm_upload_video">
                <input id="<?php $mb->the_id(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%" /><br>
                <input id="<?php $mb->the_id(); ?>_button" class="button-secondary" type="button" value="Upload Video" />
                <div class="clear"></div>
                <div style="float:left; margin-right:10px">
					<?php $mb->the_field('video_start'); ?>
                        <label for="<?php $mb->the_name(); ?>">Auto start</label>
                        <input type="checkbox" name="<?php $metabox->the_name(); ?>" value="true"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/>
                </div>
                <div style="float:left;">
					<?php $mb->the_field('video_loop'); ?>
                        <label for="<?php $mb->the_name(); ?>">Loop video</label>
                        <input type="checkbox" name="<?php $metabox->the_name(); ?>" value="true"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/>
                </div>
            </div>
        </div><!-- .toggle -->
        
        
        <div class="toggle custom_background_page" id="custom_background_page" data-type="googlemap">
			<?php $mb->the_field('googlemap'); ?>
            <label for="<?php $mb->the_name(); ?>">
                Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php?TB_iframe=true&width=600&height=550" class="thickbox">how can I get them?</a>)</small>
            </label>
            
            <input name="<?php $mb->the_name(); ?>" type="text" value="<?php $metabox->the_value(); ?>" style="margin: 5px 0; width:98%">
            
            <div class="clear"></div>

            <div class="slider_div letmebe googlemap">
				<?php $mb->the_field('zoom'); ?>
                <label for="<?php $mb->the_name(); ?>">Zoom</label>
                <input type="text" id="<?php $mb->the_id(); ?>" name="<?php $mb->the_name(); ?>" class="slider_input" value="<?php if (!$metabox->get_the_value()){ echo '17';} else { $metabox->the_value(); } ?>" />
                <div class="clear"></div>
                <div class="slider_cursor" style="margin-left:10px"></div>
            </div><!-- slider_div letmebe -->

            <div class="clear"></div>

			<?php $mb->the_field('indications'); ?>
            <label for="<?php $mb->the_name(); ?>">Indications</label>
            <textarea name="<?php $mb->the_name(); ?>" id="<?php $mb->the_id(); ?>"><?php $metabox->the_value(); ?></textarea>
            <div class="clear"></div>


			<?php $mb->the_field('type'); ?>
            <label for="<?php $mb->the_name(); ?>">Type</label>
            <select id="<?php $mb->the_id(); ?>" name="<?php $mb->the_name(); ?>">
                <option value="HYBRID"<?php $mb->the_select_state('HYBRID'); ?>>hybrid</option>
                <option value="SATELLITE"<?php $mb->the_select_state('SATELLITE'); ?>>satellite</option>
                <option value="ROADMAP"<?php $mb->the_select_state('ROADMAP'); ?>>road map</option>
                <option value="TERRAIN"<?php $mb->the_select_state('TERRAIN'); ?>>terrain</option>
            </select>
            <div class="clear"></div>
        </div><!-- .toggle -->


	</div><!-- .block_separator -->

    <div class="block_separator">
       <label>Sliding page</label>
		<?php $mb->the_field('sliding_page'); ?>
        <select name="<?php $mb->the_name(); ?>" class="toggler" id="custom_sliding_page">
            <option value="default"<?php $mb->the_select_state('default'); ?>>Default</option>
            <option value="open"<?php $mb->the_select_state('open'); ?>>Open on load</option>
            <option value="closed"<?php $mb->the_select_state('closed'); ?>>Closed on load</option>
            <option value="always"<?php $mb->the_select_state('always'); ?>>Always open</option>
            <?php global $post_type; 
			if ($post_type== 'page') { ?>
            <option value="never"<?php $mb->the_select_state('never'); ?>>Hide content</option>
			<?php } ?>
        </select>
	</div><!-- .block_separator -->

    <div class="block_separator">
        <label>Sidebar position</label>
		<?php $mb->the_field('sidebar_position'); ?>
        <select name="<?php $mb->the_name(); ?>" class="toggler" id="custom_sidebar_position">
            <option value="default"<?php $mb->the_select_state('default'); ?>>Default</option>
            <option value="right"<?php $mb->the_select_state('right'); ?>>Sidebar on the right</option>
            <option value="left"<?php $mb->the_select_state('left'); ?>>Sidebar on the left</option>
            <option value="nosidebar"<?php $mb->the_select_state('nosidebar'); ?>>Hide sidebar</option>
        </select>
        <div class="toggle custom_sidebar_position" id="custom_sidebar_position" data-type="nosidebar">
            <label>Main column width and position</label>
            <?php $mb->the_field('main_column'); ?>
            <select name="<?php $mb->the_name(); ?>" class="toggler" id="custom_main_column">
                <option value="left"<?php $mb->the_select_state('left'); ?>>Narrow left column</option>
                <option value="right"<?php $mb->the_select_state('right'); ?>>Narrow right column</option>
                <option value="wide"<?php $mb->the_select_state('wide'); ?>>Wide column</option>
            </select>
        </div><!-- .toggle -->

	</div><!-- .block_separator -->
</div>