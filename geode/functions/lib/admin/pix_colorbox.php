<?php

function colorbox_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='colorbox_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Colors and look','geode'); ?>: <small><?php _e('Plugins','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_enable_colorbox"><?php _e('Enable ColorBox plugin','geode'); ?>:
                            <input type="hidden" name="pix_style_enable_colorbox" value="0">
                            <input type="checkbox" id="pix_style_enable_colorbox" name="pix_style_enable_colorbox" value="true" <?php checked( get_option('pix_style_enable_colorbox'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_colorbox_content_bg"><?php _e('Colorbox content background','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_colorbox_content_bg" name="pix_style_colorbox_content_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_colorbox_content_bg')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_colorbox_button"><?php _e('Colorbox button color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_colorbox_button" name="pix_style_colorbox_button" type="text" value="<?php echo esc_attr(get_option('pix_style_colorbox_button')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_colorbox_overlay"><?php _e('Colorbox overlay color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_colorbox_overlay" name="pix_style_colorbox_overlay" type="text" value="<?php echo esc_attr(get_option('pix_style_colorbox_overlay')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_colorbox_color"><?php _e('Colorbox text color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_colorbox_color" name="pix_style_colorbox_color" type="text" value="<?php echo esc_attr(get_option('pix_style_colorbox_color')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                    </div><!-- .pix_column.second -->


                </div><!-- .pix_columns -->

                <hr>

                <div class="clear"></div>

                <div class="pix_columns cf">
                    <!--<div class="pix_column_divider alignleft"></div> .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_enable_filestyle"><?php _e('Enable Bootsrap-Filestyle plugin','geode'); ?>:
                            <input type="hidden" name="pix_style_enable_filestyle" value="0">
                            <input type="checkbox" id="pix_style_enable_filestyle" name="pix_style_enable_filestyle" value="true" <?php checked( get_option('pix_style_enable_filestyle'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_enable_customselect"><?php _e('Enable custom select plugin','geode'); ?>:
                            <input type="hidden" name="pix_style_enable_customselect" value="0">
                            <input type="checkbox" id="pix_style_enable_customselect" name="pix_style_enable_customselect" value="true" <?php checked( get_option('pix_style_enable_customselect'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
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