<?php

function woo_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='woo_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('WooCommerce','geode'); ?>: <small><?php _e('Product archives','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_woo_quick_view"><?php _e('Enable quick view','geode'); ?>:
                            <input type="hidden" name="pix_style_woo_quick_view" value="0">
                            <input type="checkbox" id="pix_style_woo_quick_view" name="pix_style_woo_quick_view" value="true" <?php checked( get_option('pix_style_woo_quick_view'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_woo_list_layout" class="for_select"><?php _e('Layout','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_woo_list_layout" name="pix_style_woo_list_layout">
                                    <option value="1:1" <?php selected(get_option('pix_style_woo_list_layout'),'1:1'); ?>><?php _e( 'Grid of square thumbs', 'geode' ); ?></option>
                                    <option value="4:3" <?php selected(get_option('pix_style_woo_list_layout'),'4:3'); ?>><?php _e( 'Grid of 4:3 thumbs', 'geode' ); ?></option>
                                    <option value="16:9" <?php selected(get_option('pix_style_woo_list_layout'),'16:9'); ?>><?php _e( 'Grid of 16:9 thumbs', 'geode' ); ?></option>
                                    <option value="grid" <?php selected(get_option('pix_style_woo_list_layout'),'grid'); ?>><?php _e( 'Grid of original ratio thumbs', 'geode' ); ?></option>
                                    <option value="masonry" <?php selected(get_option('pix_style_woo_list_layout'),'masonry'); ?>><?php _e( 'Masonry grid (original ratio)', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_content_woo_list_sidebar" class="for_select"><?php _e('Sidebar (primary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_woo_list_sidebar" name="pix_content_woo_list_sidebar">
                                    <option value="" <?php selected(get_option('pix_content_woo_list_sidebar'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_woo_list_sidebar'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_content_woo_list_sidebar_2" class="for_select"><?php _e('Sidebar (secondary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_woo_list_sidebar_2" name="pix_content_woo_list_sidebar_2">
                                    <option value="" <?php selected(get_option('pix_content_woo_list_sidebar_2'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_woo_list_sidebar_2'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_woo_list_bg" class="for_select"><?php _e('Background','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_woo_list_bg" name="pix_style_woo_list_bg">
                                    <option value="" <?php selected(get_option('pix_style_woo_list_bg'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_woo_list_bg'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_woo_list_bg'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_woo_list_bg_img"><?php _e('Upload a body background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_woo_list_bg_img'); ?>" name="pix_style_woo_list_bg_img" id="pix_style_woo_list_bg_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_shop_onsale_color"><?php _e('Onsale label text color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_shop_onsale_color" type="text" value="<?php echo esc_attr(get_option('pix_style_shop_onsale_color')); ?>" name="pix_style_shop_onsale_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_woo_ppp" class="for_select"><?php _e('Posts per page','geode'); ?>:</label>
                        <div class="slider_div percent">
                            <input id="pix_style_woo_ppp" name="pix_style_woo_ppp" type="text" value="<?php echo esc_attr(get_option('pix_style_woo_ppp')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>
                        
                        <label for="pix_style_woo_list_columns" class="for_select"><?php _e('Grid','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_woo_list_columns" name="pix_style_woo_list_columns">
                                    <option value="2" <?php selected(get_option('pix_style_woo_list_columns'),'2'); ?>><?php _e( '2 columns', 'geode' ); ?></option>
                                    <option value="3" <?php selected(get_option('pix_style_woo_list_columns'),'3'); ?>><?php _e( '3 columns', 'geode' ); ?></option>
                                    <option value="4" <?php selected(get_option('pix_style_woo_list_columns'),'4'); ?>><?php _e( '4 columns', 'geode' ); ?></option>
                                    <option value="5" <?php selected(get_option('pix_style_woo_list_columns'),'5'); ?>><?php _e( '5 columns', 'geode' ); ?></option>
                                    <option value="6" <?php selected(get_option('pix_style_woo_list_columns'),'6'); ?>><?php _e( '6 columns', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_woo_template" class="for_select"><?php _e('Page template','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_woo_template" name="pix_style_woo_template">
                                    <option value='default' <?php selected(get_option('pix_style_woo_template'),'default'); ?>><?php _e('Default Template','geode'); ?></option>
                                    <option value='templates/wide-page.php' <?php selected(get_option('pix_style_woo_template'),'templates/wide-page.php'); ?>><?php _e('Wide Page Template','geode'); ?></option>
                                    <option value='templates/double-side-page.php' <?php selected(get_option('pix_style_woo_template'),'templates/double-side-page.php'); ?>><?php _e('Double sidebar Page Template','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_woo_title_color"><?php _e('Text color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_woo_title_color" type="text" value="<?php echo esc_attr(get_option('pix_style_woo_title_color')); ?>" name="pix_style_woo_title_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_woo_list_bg_title" class="for_select"><?php _e('Background of the title section','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_woo_list_bg_title" name="pix_style_woo_list_bg_title">
                                    <option value="" <?php selected(get_option('pix_style_woo_list_bg_title'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_woo_list_bg_title'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_woo_list_bg_title'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_woo_list_bg_title_img"><?php _e('Upload a title background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_woo_list_bg_title_img'); ?>" name="pix_style_woo_list_bg_title_img" id="pix_style_woo_list_bg_title_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_shop_onsale_bg"><?php _e('Onsale label text color','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_shop_onsale_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_shop_onsale_bg')); ?>" name="pix_style_shop_onsale_bg" >
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