<?php

function header_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='header_panel') {
    
    $selected_font = get_option('pix_style_fonts_w_variants');
?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Header','geode'); ?></small></h3>

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

                        <label for="pix_style_header_style" class="for_select"><?php _e('Header style','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_header_style" name="pix_style_header_style">
                                     <option value="floating" <?php selected(get_option('pix_style_header_style'),'floating'); ?>>floating</option>
                                     <option value="centered" <?php selected(get_option('pix_style_header_style'),'centered'); ?>>centered</option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_header_height"><?php _e('Height of the header (in pixels)', 'geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_header_height" name="pix_style_header_height" type="text" value="<?php echo esc_attr(get_option('pix_style_header_height')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_content_header_logo"><?php _e('Upload a logo','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_content_header_logo'); ?>" name="pix_content_header_logo" id="pix_content_header_logo">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_header_bgcolor"><?php _e('Background color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_header_bgcolor" name="pix_style_header_bgcolor" type="text" value="<?php echo esc_attr(get_option('pix_style_header_bgcolor')); ?>" data-name="color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_header_opacity"><?php _e('Background opacity', 'geode'); ?>:</label>
                        <div class="slider_div opacity">
                            <input id="pix_style_header_opacity" name="pix_style_header_opacity" type="text" value="<?php echo esc_attr(get_option('pix_style_header_opacity')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_sticky_header"><?php _e('Sticky header','geode'); ?>:
                            <input type="hidden" name="pix_style_sticky_header" value="0">
                            <input type="checkbox" id="pix_style_sticky_header" name="pix_style_sticky_header" value="true" <?php checked( get_option('pix_style_sticky_header'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_wide_header"><?php _e('Wide header','geode'); ?>:
                            <input type="hidden" name="pix_style_wide_header" value="0">
                            <input type="checkbox" id="pix_style_wide_header" name="pix_style_wide_header" value="true" <?php checked( get_option('pix_style_wide_header'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br><small><em><?php _e('Available for full-width layout only','geode'); ?></em></small>
                        <br>
                        <br>

                        <label for="pix_style_header_scroll"><?php _e('Resize the header on scroll','geode'); ?>:
                            <input type="hidden" name="pix_style_header_scroll" value="0">
                            <input type="checkbox" id="pix_style_header_scroll" name="pix_style_header_scroll" value="true" <?php checked( get_option('pix_style_header_scroll'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_header_hover"><?php _e('Restore the header height on hover','geode'); ?>:
                            <input type="hidden" name="pix_style_header_hover" value="0">
                            <input type="checkbox" id="pix_style_header_hover" name="pix_style_header_hover" value="true" <?php checked( get_option('pix_style_header_hover'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_header_height_scrolled"><?php _e('Height of the scrolled header (in pixels)', 'geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_header_height_scrolled" name="pix_style_header_height_scrolled" type="text" value="<?php echo esc_attr(get_option('pix_style_header_height_scrolled')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_sitedescription_fromleft"><?php _e('Site description from left (in pixels)', 'geode'); ?> <small><a href="#" data-dialog="<?php _e('Since the site description has &quot;position:absolute&quot;, if you use an image as logo, you need to move the site description to the right manually by adding some pixels','geode'); ?>"><?php _e('more info','geode'); ?></a></small>:</label>
                        <div class="slider_div">
                            <input id="pix_style_sitedescription_fromleft" name="pix_style_sitedescription_fromleft" type="text" value="<?php echo esc_attr(get_option('pix_style_sitedescription_fromleft')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_sitedescription_frombottom"><?php _e('Site description from bottom (in pixels)', 'geode'); ?> <small><a href="#" data-dialog="<?php _e('Since the site description has &quot;position:absolute&quot; and aligned to the bottom of the header, you need to move it to top manually by adding some pixels','geode'); ?>"><?php _e('more info','geode'); ?></a></small>:</label>
                        <div class="slider_div">
                            <input id="pix_style_sitedescription_frombottom" name="pix_style_sitedescription_frombottom" type="text" value="<?php echo esc_attr(get_option('pix_style_sitedescription_frombottom')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_sitetitle_display"><?php _e('Display the site description','geode'); ?>:
                            <input type="hidden" name="pix_style_sitetitle_display" value="0">
                            <input type="checkbox" id="pix_style_sitetitle_display" name="pix_style_sitetitle_display" value="true" <?php checked( get_option('pix_style_sitetitle_display'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->

                    <div class="clear"></div>

                    <div class="pix_column alignleft">

                        <label><?php _e('Site title font','geode'); ?>:</label>
                        <div class="pix_group">
                            <label><?php _e('Preview','geode'); ?>:</label>
                            <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                            <label for="pix_style_sitetitle_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                <span class="for_select">
                                    <select id="pix_style_sitetitle_fontfamily" name="pix_style_sitetitle_fontfamily">
                                        <option value="" <?php selected(get_option('pix_style_sitetitle_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                        <?php
                                            foreach ( $selected_font as $fontfamily => $value )
                                            { ?>
                                            <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_sitetitle_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </span>
                            </label>
                            <label for="pix_style_sitetitle_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                <span class="for_select">
                                    <select id="pix_style_sitetitle_fontvariant" name="pix_style_sitetitle_fontvariant">
                                        <?php
                                            foreach ( $selected_font[get_option('pix_style_sitetitle_fontfamily')]['variants'] as $fontvariant )
                                            { ?>
                                            <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_sitetitle_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </span>
                            </label>
                            <label for="pix_style_sitetitle_fontsize"><?php _e('Font size (in pixels)', 'geode'); ?>:</label>
                            <div class="slider_div">
                                <input id="pix_style_sitetitle_fontsize" name="pix_style_sitetitle_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_sitetitle_fontsize')); ?>">
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->

                        </div><!-- .pix_group -->

                        <label for="pix_style_sitetitle_color"><?php _e('Site title color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_sitetitle_color" name="pix_style_sitetitle_color" type="text" value="<?php echo esc_attr(get_option('pix_style_sitetitle_color')); ?>" data-name="color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_sitetitle_padding"><?php _e('Site title horizontal padding', 'geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_sitetitle_padding" name="pix_style_sitetitle_padding" type="text" value="<?php echo esc_attr(get_option('pix_style_sitetitle_padding')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label><?php _e('Site description font','geode'); ?>:</label>
                        <div class="pix_group">
                            <label><?php _e('Preview','geode'); ?>:</label>
                            <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                            <label for="pix_style_sitedescription_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                <span class="for_select">
                                    <select id="pix_style_sitedescription_fontfamily" name="pix_style_sitedescription_fontfamily">
                                        <option value="" <?php selected(get_option('pix_style_sitedescription_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                        <?php
                                            foreach ( $selected_font as $fontfamily => $value )
                                            { ?>
                                            <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_sitedescription_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </span>
                            </label>
                            <label for="pix_style_sitedescription_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                <span class="for_select">
                                    <select id="pix_style_sitedescription_fontvariant" name="pix_style_sitedescription_fontvariant">
                                        <?php
                                            foreach ( $selected_font[get_option('pix_style_sitedescription_fontfamily')]['variants'] as $fontvariant )
                                            { ?>
                                            <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_sitedescription_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </span>
                            </label>
                            <label for="pix_style_sitedescription_fontsize"><?php _e('Font size (in pixels)', 'geode'); ?>:</label>
                            <div class="slider_div">
                                <input id="pix_style_sitedescription_fontsize" name="pix_style_sitedescription_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_sitedescription_fontsize')); ?>">
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->

                        </div><!-- .pix_group -->

                        <label for="pix_style_sitedescription_color"><?php _e('Site description color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_sitedescription_color" name="pix_style_sitedescription_color" type="text" value="<?php echo esc_attr(get_option('pix_style_sitedescription_color')); ?>" data-name="color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_logo_bg"><?php _e('Logo background color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_logo_bg" name="pix_style_logo_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_logo_bg')); ?>" data-name="color" >
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