<?php

function title_section_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='title_section_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Colors and look','geode'); ?>: <small><?php _e('Title section','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_title_color"><?php _e('Text color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_title_color" type="text" value="<?php echo esc_attr(get_option('pix_style_title_color')); ?>" name="pix_style_title_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_title_bgcolor"><?php _e('Background color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_title_bgcolor" type="text" value="<?php echo esc_attr(get_option('pix_style_title_bgcolor')); ?>" name="pix_style_title_bgcolor" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_bg_title_img"><?php _e('Upload a title background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_bg_title_img'); ?>" name="pix_style_bg_title_img" id="pix_style_bg_title_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
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