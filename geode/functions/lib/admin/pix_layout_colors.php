<?php

function layout_colors_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='layout_colors_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Colors and look','geode'); ?>: <small><?php _e('Body and page wrap','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_body_img"><?php _e('Body background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_body_img'); ?>" name="pix_style_body_img" id="pix_style_body_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_body_repeat"><?php _e('Body background repeat','geode'); ?>:
                            <input type="hidden" name="pix_style_body_repeat" value="0">
                            <input type="checkbox" id="pix_style_body_repeat" name="pix_style_body_repeat" value="true" <?php checked( get_option('pix_style_body_repeat'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_body_bg_color"><?php _e('Body background color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_body_bg_color" name="pix_style_body_bg_color" type="text" value="<?php echo esc_attr(get_option('pix_style_body_bg_color')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_body_size" class="for_select"><?php _e('Body background size','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_body_size" name="pix_style_body_size">
                                    <option value="cover" <?php selected(get_option('pix_style_body_size'),'cover'); ?>>cover</option>
                                    <option value="contain" <?php selected(get_option('pix_style_body_size'),'contain'); ?>>contain</option>
                                    <option value="auto" <?php selected(get_option('pix_style_body_size'),'auto'); ?>>auto</option>
                                </select>
                            </span>
                        </label>
                        <br>

                        <label for="pix_style_body_position" class="for_select"><?php _e('Body background position','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_body_position" name="pix_style_body_position">
                                     <option value="top left" <?php selected(get_option('pix_style_body_position'),'top left'); ?>>top left</option>
                                     <option value="top" <?php selected(get_option('pix_style_body_position'),'top'); ?>>top</option>
                                     <option value="top right" <?php selected(get_option('pix_style_body_position'),'top right'); ?>>top right</option>
                                     <option value="left" <?php selected(get_option('pix_style_body_position'),'left'); ?>>left</option>
                                     <option value="center" <?php selected(get_option('pix_style_body_position'),'center'); ?>>center</option>
                                     <option value="right" <?php selected(get_option('pix_style_body_position'),'right'); ?>>right</option>
                                     <option value="bottom left" <?php selected(get_option('pix_style_body_position'),'bottom left'); ?>>bottom left</option>
                                     <option value="bottom" <?php selected(get_option('pix_style_body_position'),'bottom'); ?>>bottom</option>
                                     <option value="bottom right" <?php selected(get_option('pix_style_body_position'),'bottom right'); ?>>bottom right</option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->

                </div><!-- .pix_columns -->

                <hr>

                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_page_bg_color"><?php _e('Page background color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_page_bg_color" name="pix_style_page_bg_color" type="text" value="<?php echo esc_attr(get_option('pix_style_page_bg_color')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_page_shadow_opacity"><?php _e('Opacity of the shadow', 'geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Unfortunately, even if very cool sometimes, box shadows slown down the browser performance dramatically, so pay attention if you want to use this feature and make tests especially with Chrome on big monitors ','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                        <div class="slider_div opacity">
                            <input id="pix_style_page_shadow_opacity" name="pix_style_page_shadow_opacity" type="text" value="<?php echo esc_attr(get_option('pix_style_page_shadow_opacity')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_page_shadow_color"><?php _e('Page shadow color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_page_shadow_color" name="pix_style_page_shadow_color" type="text" value="<?php echo esc_attr(get_option('pix_style_page_shadow_color')); ?>">
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_page_shadow_size"><?php _e('Size of the shadow (in pixels)','geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Unfortunately, even if very cool sometimes, box shadows slown down the browser performance dramatically, so pay attention if you want to use this feature and make tests especially with Chrome on big monitors ','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                        <div class="slider_div">
                            <input id="pix_style_page_shadow_size" name="pix_style_page_shadow_size" type="text" value="<?php echo esc_attr(get_option('pix_style_page_shadow_size')); ?>">
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