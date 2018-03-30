<?php

function products_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='products_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('WooCommerce','geode'); ?>: <small><?php _e('Single product pages','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_product_template" class="for_select"><?php _e('Page template','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_product_template" name="pix_style_product_template">
                                    <option value='default' <?php selected(get_option('pix_style_product_template'),'default'); ?>><?php _e('Default Template','geode'); ?></option>
                                    <option value='templates/wide-page.php' <?php selected(get_option('pix_style_product_template'),'templates/wide-page.php'); ?>><?php _e('Wide Page Template','geode'); ?></option>
                                    <option value='templates/double-side-page.php' <?php selected(get_option('pix_style_product_template'),'templates/double-side-page.php'); ?>><?php _e('Double sidebar Page Template','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_content_product_sidebar_2" class="for_select"><?php _e('Sidebar (secondary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_product_sidebar_2" name="pix_content_product_sidebar_2">
                                    <option value="" <?php selected(get_option('pix_content_product_sidebar_2'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_product_sidebar_2'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_product_bg" class="for_select"><?php _e('Background','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_product_bg" name="pix_style_product_bg">
                                    <option value="" <?php selected(get_option('pix_style_product_bg'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_product_bg'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_product_bg'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_product_bg_img"><?php _e('Upload a body background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_product_bg_img'); ?>" name="pix_style_product_bg_img" id="pix_style_product_bg_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_related_products"><?php _e('Hide related products','geode'); ?>:
                            <input type="hidden" name="pix_style_related_products" value="0">
                            <input type="checkbox" id="pix_style_related_products" name="pix_style_related_products" value="true" <?php checked( get_option('pix_style_related_products'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_product_sidebar" class="for_select"><?php _e('Sidebar (primary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_product_sidebar" name="pix_content_product_sidebar">
                                    <option value="" <?php selected(get_option('pix_content_product_sidebar'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_product_sidebar'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_product_color"><?php _e('Text color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_product_color" type="text" value="<?php echo esc_attr(get_option('pix_style_product_color')); ?>" name="pix_style_product_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_product_bg_title" class="for_select"><?php _e('Background of the title section','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_product_bg_title" name="pix_style_product_bg_title">
                                    <option value="" <?php selected(get_option('pix_style_product_bg_title'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_product_bg_title'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_product_bg_title'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_product_bg_title_img"><?php _e('Upload a title background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_product_bg_title_img'); ?>" name="pix_style_product_bg_title_img" id="pix_style_product_bg_title_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_disable_product_zoom"><?php _e('Disable zoom effect over the main image','geode'); ?>:
                            <input type="hidden" name="pix_style_disable_product_zoom" value="0">
                            <input type="checkbox" id="pix_style_disable_product_zoom" name="pix_style_disable_product_zoom" value="true" <?php checked( get_option('pix_style_disable_product_zoom'), 'true' ); ?>>
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