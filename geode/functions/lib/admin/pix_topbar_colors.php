<?php

function top_bar_colors(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='top_bar_colors') {
    
?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Top bar','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        
                <div class="pix_columns cf">
                    <div class="tip_info large">
                        <?php _e('What is the top bar?','geode'); ?> <a href="#" data-dialog="<?php _e('Where available (not on this page, for instance) your options will be saved without refreshing the page.<br>If you encounter any problem just switch this field off.','geode'); ?>"><?php _e('More info','geode'); ?></a>
                    </div><!-- .tip_info -->
                    <br>

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_topbar_color"><?php _e('Text color','geode'); ?> <small>(<a href="#" data-dialog="<?php _e('It is the default value, but each element can have a custom color (add elements here below)','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_topbar_color" name="pix_style_topbar_color" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_color')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_topbar_border"><?php _e('Border color','geode'); ?> <small>(<a href="#" data-dialog="<?php _e('The border color will be also the background color on hover state. If you want to remove the border around the elements on the top bar, or to change its thickness, or to customize some other property, I recommend to write some lines off CSS code into Geode &rarr; Styles','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_topbar_border" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_border')); ?>" name="pix_style_topbar_border" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>


                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_topbar_bgcolor"><?php _e('Background color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_topbar_bgcolor" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_bgcolor')); ?>" name="pix_style_topbar_bgcolor" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_topbar_opacity"><?php _e('Background opacity', 'geode'); ?>:</label>
                        <div class="slider_div opacity">
                            <input id="pix_style_topbar_opacity" name="pix_style_topbar_opacity" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_opacity')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="action" value="data_save" />
                <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <div id="gradient-save-button"></div>

            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>