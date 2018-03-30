<?php

function shop_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='shop_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('WooCommerce','geode'); ?>: <small><?php _e('Main shop page','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_shop_list_template" class="for_select"><?php _e('Layout','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_shop_list_template" name="pix_style_shop_list_template">
                                    <option value="" <?php selected(get_option('pix_style_shop_list_template'),''); ?>><?php _e( 'Inherit', 'geode' ); ?></option>
                                    <option value="1:1" <?php selected(get_option('pix_style_shop_list_template'),'1:1'); ?>><?php _e( 'Grid of square thumbs', 'geode' ); ?></option>
                                    <option value="4:3" <?php selected(get_option('pix_style_shop_list_template'),'4:3'); ?>><?php _e( 'Grid of 4:3 thumbs', 'geode' ); ?></option>
                                    <option value="16:9" <?php selected(get_option('pix_style_shop_list_template'),'16:9'); ?>><?php _e( 'Grid of 16:9 thumbs', 'geode' ); ?></option>
                                    <option value="grid" <?php selected(get_option('pix_style_shop_list_template'),'grid'); ?>><?php _e( 'Grid of original ratio thumbs', 'geode' ); ?></option>
                                    <option value="masonry" <?php selected(get_option('pix_style_shop_list_template'),'masonry'); ?>><?php _e( 'Masonry grid (original ratio)', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_shop_list_columns" class="for_select"><?php _e('Grid','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_shop_list_columns" name="pix_style_shop_list_columns">
                                    <option value="" <?php selected(get_option('pix_style_shop_list_columns'),''); ?>><?php _e( 'Inherit', 'geode' ); ?></option>
                                    <option value="2" <?php selected(get_option('pix_style_shop_list_columns'),'2'); ?>><?php _e( '2 columns', 'geode' ); ?></option>
                                    <option value="3" <?php selected(get_option('pix_style_shop_list_columns'),'3'); ?>><?php _e( '3 columns', 'geode' ); ?></option>
                                    <option value="4" <?php selected(get_option('pix_style_shop_list_columns'),'4'); ?>><?php _e( '4 columns', 'geode' ); ?></option>
                                    <option value="5" <?php selected(get_option('pix_style_shop_list_columns'),'5'); ?>><?php _e( '5 columns', 'geode' ); ?></option>
                                    <option value="6" <?php selected(get_option('pix_style_shop_list_columns'),'6'); ?>><?php _e( '6 columns', 'geode' ); ?></option>
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