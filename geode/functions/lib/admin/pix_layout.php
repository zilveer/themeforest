<?php

function layout_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='layout_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Layout','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_layout_style" class="for_select"><?php _e('Layout style', 'geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_layout_style" name="pix_style_layout_style">
                                    <option value="fullwidth" <?php selected(get_option('pix_style_layout_style'),'fullwidth'); ?>>full width</option>
                                    <option value="boxed" <?php selected(get_option('pix_style_layout_style'),'boxed'); ?>>boxed</option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_page_margin_bottom"><?php _e('Margin bottom','geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_page_margin_bottom" name="pix_style_page_margin_bottom" type="text" value="<?php echo esc_attr(get_option('pix_style_page_margin_bottom')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_page_margin_left"><?php _e('Margin left','geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_page_margin_left" name="pix_style_page_margin_left" type="text" value="<?php echo esc_attr(get_option('pix_style_page_margin_left')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_layout_width"><?php _e('Layout width','geode'); ?>:</label>
                        <input id="pix_style_layout_width" name="pix_style_layout_width" type="text" value="<?php echo esc_attr(get_option('pix_style_layout_width')); ?>" placeholder="device-width">
                        <br>

                        <label for="pix_style_demo_panel"><?php _e('Display the demo panel','geode'); ?>:
                            <input type="hidden" name="pix_style_demo_panel" value="0">
                            <input type="checkbox" id="pix_style_demo_panel" name="pix_style_demo_panel" value="true" <?php checked( get_option('pix_style_demo_panel'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_favicon"><?php _e('Front end favicon','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_content_favicon'); ?>" name="pix_content_favicon" id="pix_content_favicon">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_query_loader"><?php _e('Fade in page on dom ready','geode'); ?>:
                            <input type="hidden" name="pix_style_query_loader" value="0">
                            <input type="checkbox" id="pix_style_query_loader" name="pix_style_query_loader" value="true" <?php checked( get_option('pix_style_query_loader'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_page_margin_top"><?php _e('Margin top','geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_page_margin_top" name="pix_style_page_margin_top" type="text" value="<?php echo esc_attr(get_option('pix_style_page_margin_top')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_page_margin_right"><?php _e('Margin right','geode'); ?>:</label>
                        <div class="slider_div">
                            <input id="pix_style_page_margin_right" name="pix_style_page_margin_right" type="text" value="<?php echo esc_attr(get_option('pix_style_page_margin_right')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_page_radius"><?php _e('Border radius','geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Unfortunately, even if very cool sometimes, rounded corners slown down the browser performance dramatically, so pay attention if you want to use this feature and make tests especially with Chrome on big monitors and they are not compatible with transparent headers and slideshows or videos','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                        <div class="slider_div">
                            <input id="pix_style_page_radius" name="pix_style_page_radius" type="text" value="<?php echo esc_attr(get_option('pix_style_page_radius')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_scroll_button"><?php _e('Display scroll-up button','geode'); ?>:
                            <input type="hidden" name="pix_style_scroll_button" value="0">
                            <input type="checkbox" id="pix_style_scroll_button" name="pix_style_scroll_button" value="true" <?php checked( get_option('pix_style_scroll_button'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->

                </div><!-- .pix_columns -->

                <hr>

                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_fx_title" class="for_select"><?php _e('Define an effect when page titles are revealed (on window scroll or load). Requires PixGridder Pro', 'geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_fx_title" name="pix_style_fx_title">
                                    <option value="none" <?php selected( get_option('pix_style_fx_title'), 'none' ); ?>>none</option>
                                    <option value="pix-fadeIn" <?php selected( get_option('pix_style_fx_title'), 'pix-fadeIn' ); ?>>pix-fadeIn</option>
                                    <option value="pix-fadeDown" <?php selected( get_option('pix_style_fx_title'), 'pix-fadeDown' ); ?>>pix-fadeDown</option>
                                    <option value="pix-fadeUp" <?php selected( get_option('pix_style_fx_title'), 'pix-fadeUp' ); ?>>pix-fadeUp</option>
                                    <option value="pix-fadeLeft" <?php selected( get_option('pix_style_fx_title'), 'pix-fadeLeft' ); ?>>pix-fadeLeft</option>
                                    <option value="pix-fadeRight" <?php selected( get_option('pix_style_fx_title'), 'pix-fadeRight' ); ?>>pix-fadeRight</option>
                                    <option value="pix-zoomIn" <?php selected( get_option('pix_style_fx_title'), 'pix-zoomIn' ); ?>>pix-zoomIn</option>
                                    <option value="pix-zoomOut" <?php selected( get_option('pix_style_fx_title'), 'pix-zoomOut' ); ?>>pix-zoomOut</option>
                                    <option value="pix-rotateIn" <?php selected( get_option('pix_style_fx_title'), 'pix-rotateIn' ); ?>>pix-rotateIn</option>
                                    <option value="pix-rotateOut" <?php selected( get_option('pix_style_fx_title'), 'pix-rotateOut' ); ?>>pix-rotateOut</option>
                                    <option value="pix-flipClock" <?php selected( get_option('pix_style_fx_title'), 'pix-flipClock' ); ?>>pix-flipClock</option>
                                    <option value="pix-swing" <?php selected( get_option('pix_style_fx_title'), 'pix-swing' ); ?>>pix-swing</option>
                                    <option value="pix-turnForward" <?php selected( get_option('pix_style_fx_title'), 'pix-turnForward' ); ?>>pix-turnForward</option>
                                    <option value="pix-turnBackward" <?php selected( get_option('pix_style_fx_title'), 'pix-turnBackward' ); ?>>pix-turnBackward</option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_fx_onscroll" class="for_select"><?php _e('Define an effect when other elements are revealed (on window scroll or load). Requires PixGridder Pro', 'geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_fx_onscroll" name="pix_style_fx_onscroll">
                                    <option value="none" <?php selected( get_option('pix_style_fx_onscroll'), 'none' ); ?>>none</option>
                                    <option value="pix-fadeIn" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-fadeIn' ); ?>>pix-fadeIn</option>
                                    <option value="pix-fadeDown" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-fadeDown' ); ?>>pix-fadeDown</option>
                                    <option value="pix-fadeUp" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-fadeUp' ); ?>>pix-fadeUp</option>
                                    <option value="pix-fadeLeft" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-fadeLeft' ); ?>>pix-fadeLeft</option>
                                    <option value="pix-fadeRight" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-fadeRight' ); ?>>pix-fadeRight</option>
                                    <option value="pix-zoomIn" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-zoomIn' ); ?>>pix-zoomIn</option>
                                    <option value="pix-zoomOut" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-zoomOut' ); ?>>pix-zoomOut</option>
                                    <option value="pix-rotateIn" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-rotateIn' ); ?>>pix-rotateIn</option>
                                    <option value="pix-rotateOut" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-rotateOut' ); ?>>pix-rotateOut</option>
                                    <option value="pix-flipClock" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-flipClock' ); ?>>pix-flipClock</option>
                                    <option value="pix-swing" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-swing' ); ?>>pix-swing</option>
                                    <option value="pix-turnForward" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-turnForward' ); ?>>pix-turnForward</option>
                                    <option value="pix-turnBackward" <?php selected( get_option('pix_style_fx_onscroll'), 'pix-turnBackward' ); ?>>pix-turnBackward</option>
                                </select>
                            </span>
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