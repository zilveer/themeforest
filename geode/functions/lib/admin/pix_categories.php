<?php

function categories_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='categories_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Blog','geode'); ?>: <small><?php _e('Categories and archives','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_archive_layout" class="for_select"><?php _e('Layout','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_layout" name="pix_style_archive_layout">
                                    <option value="standard" <?php selected(get_option('pix_style_archive_layout'),'standard'); ?>><?php _e( 'Standard blog', 'geode' ); ?></option>
                                    <option value="masonry" <?php selected(get_option('pix_style_archive_layout'),'masonry'); ?>><?php _e( 'Masonry grid', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_archive_gutter" class="for_select"><?php _e('Gutter (%)','geode'); ?>:</label>
                        <div class="slider_div percent">
                            <input id="pix_style_archive_gutter" name="pix_style_archive_gutter" type="text" value="<?php echo esc_attr(get_option('pix_style_archive_gutter')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>
                        
                        <label for="pix_style_archive_bg" class="for_select"><?php _e('Background','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_bg" name="pix_style_archive_bg">
                                    <option value="" <?php selected(get_option('pix_style_archive_bg'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_archive_bg'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_archive_bg'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_archive_bg_img"><?php _e('Upload a body background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_archive_bg_img'); ?>" name="pix_style_archive_bg_img" id="pix_style_archive_bg_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_archive_order" class="for_select"><?php _e('Order','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_order" name="pix_style_archive_order">
                                    <option value="" <?php selected(get_option('pix_style_archive_order'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="DESC" <?php selected(get_option('pix_style_archive_order'),'DESC'); ?>><?php _e( 'DESC', 'geode' ); ?></option>
                                    <option value="ASC" <?php selected(get_option('pix_style_archive_order'),'ASC'); ?>><?php _e( 'ASC', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_archive_orderby" class="for_select"><?php _e('Order by','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_orderby" name="pix_style_archive_orderby">
                                    <option value="" <?php selected(get_option('pix_style_archive_orderby'),''); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="ID" <?php selected(get_option('pix_style_archive_orderby'),'ID'); ?>><?php _e( 'ID', 'geode' ); ?></option>
                                    <option value="title" <?php selected(get_option('pix_style_archive_orderby'),'title'); ?>><?php _e( 'title', 'geode' ); ?></option>
                                    <option value="name" <?php selected(get_option('pix_style_archive_orderby'),'name'); ?>><?php _e( 'name', 'geode' ); ?></option>
                                    <option value="date" <?php selected(get_option('pix_style_archive_orderby'),'date'); ?>><?php _e( 'date', 'geode' ); ?></option>
                                    <option value="rand" <?php selected(get_option('pix_style_archive_orderby'),'rand'); ?>><?php _e( 'random', 'geode' ); ?></option>
                                    <option value="menu_order" <?php selected(get_option('pix_style_archive_orderby'),'menu_order'); ?>><?php _e( 'menu_order', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_archive_columns" class="for_select"><?php _e('Grid','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_columns" name="pix_style_archive_columns">
                                    <option value="2" <?php selected(get_option('pix_style_archive_columns'),'2'); ?>><?php _e( '2 columns', 'geode' ); ?></option>
                                    <option value="3" <?php selected(get_option('pix_style_archive_columns'),'3'); ?>><?php _e( '3 columns', 'geode' ); ?></option>
                                    <option value="4" <?php selected(get_option('pix_style_archive_columns'),'4'); ?>><?php _e( '4 columns', 'geode' ); ?></option>
                                    <option value="5" <?php selected(get_option('pix_style_archive_columns'),'5'); ?>><?php _e( '5 columns', 'geode' ); ?></option>
                                    <option value="6" <?php selected(get_option('pix_style_archive_columns'),'6'); ?>><?php _e( '6 columns', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_archive_template" class="for_select"><?php _e('Page template','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_template" name="pix_style_archive_template">
                                    <option value='default' <?php selected(get_option('pix_style_archive_template'),'default'); ?>><?php _e('Default Template','geode'); ?></option>
                                    <option value='templates/wide-page.php' <?php selected(get_option('pix_style_archive_template'),'templates/wide-page.php'); ?>><?php _e('Wide Page Template','geode'); ?></option>
                                    <option value='templates/double-side-page.php' <?php selected(get_option('pix_style_archive_template'),'templates/double-side-page.php'); ?>><?php _e('Double sidebar Page Template','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_archive_title_color"><?php _e('Text color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_archive_title_color" type="text" value="<?php echo esc_attr(get_option('pix_style_archive_title_color')); ?>" name="pix_style_archive_title_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_archive_bg_title" class="for_select"><?php _e('Background of the title section','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_archive_bg_title" name="pix_style_archive_bg_title">
                                    <option value="" <?php selected(get_option('pix_style_archive_bg_title'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_archive_bg_title'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_archive_bg_title'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_archive_bg_title_img"><?php _e('Upload a title background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_archive_bg_title_img'); ?>" name="pix_style_archive_bg_title_img" id="pix_style_archive_bg_title_img">
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