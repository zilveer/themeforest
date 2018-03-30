<?php

function footer_colors(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='footer_colors') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Colors and look','geode'); ?>: <small><?php _e('Footer colors','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_footer_bg"><?php _e('Footer background color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_bg" name="pix_style_footer_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_bg')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_link"><?php _e('Link color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_link" name="pix_style_footer_link" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_link')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_featured_footer"><?php _e('Featured color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_featured_footer" name="pix_style_featured_footer" type="text" value="<?php echo esc_attr(get_option('pix_style_featured_footer')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_error"><?php _e('Error color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_error" name="pix_style_footer_error" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_error')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_border"><?php _e('Border color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_border" name="pix_style_footer_border" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_border')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_alternative_border"><?php _e('Alternative border color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_alternative_border" name="pix_style_footer_alternative_border" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_alternative_border')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_footer_color"><?php _e('Footer text color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_color" name="pix_style_footer_color" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_color')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_hover"><?php _e('Link color, hover state','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_hover" name="pix_style_footer_hover" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_hover')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_featured_footer_alt"><?php _e('Featured color alternative','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_featured_footer_alt" name="pix_style_featured_footer_alt" type="text" value="<?php echo esc_attr(get_option('pix_style_featured_footer_alt')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_tiny"><?php _e('Color for tiny or less evident texts','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_tiny" name="pix_style_footer_tiny" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_tiny')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_footer_input"><?php _e('Background of input fields, textareas etc.','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_footer_input" name="pix_style_footer_input" type="text" value="<?php echo esc_attr(get_option('pix_style_footer_input')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
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