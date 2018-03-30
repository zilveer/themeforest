<?php

function portfolio_items(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='portfolio_items') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Portfolio','geode'); ?>: <small><?php _e('Single portfolio pages','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_single_portfolio_template" class="for_select"><?php _e('Page template','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_single_portfolio_template" name="pix_style_single_portfolio_template">
                                    <option value='default' <?php selected(get_option('pix_style_single_portfolio_template'),'default'); ?>><?php _e('Default Template','geode'); ?></option>
                                    <option value='templates/wide-page.php' <?php selected(get_option('pix_style_single_portfolio_template'),'templates/wide-page.php'); ?>><?php _e('Wide Page Template','geode'); ?></option>
                                    <option value='templates/double-side-page.php' <?php selected(get_option('pix_style_single_portfolio_template'),'templates/double-side-page.php'); ?>><?php _e('Double sidebar Page Template','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_content_single_portfolio_sidebar_2" class="for_select"><?php _e('Sidebar (secondary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_single_portfolio_sidebar_2" name="pix_content_single_portfolio_sidebar_2">
                                    <option value="" <?php selected(get_option('pix_content_single_portfolio_sidebar_2'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_single_portfolio_sidebar_2'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_single_portfolio_bg" class="for_select"><?php _e('Background','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_single_portfolio_bg" name="pix_style_single_portfolio_bg">
                                    <option value="" <?php selected(get_option('pix_style_single_portfolio_bg'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_single_portfolio_bg'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_single_portfolio_bg'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_single_portfolio_bg_img"><?php _e('Upload a body background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_single_portfolio_bg_img'); ?>" name="pix_style_single_portfolio_bg_img" id="pix_style_single_portfolio_bg_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_disable_colorbox_portfolio_items"><?php _e('Disable ColorBox on featured images','geode'); ?>:
                            <input type="hidden" name="pix_style_disable_colorbox_portfolio_items" value="0">
                            <input type="checkbox" id="pix_style_disable_colorbox_portfolio_items" name="pix_style_disable_colorbox_portfolio_items" value="true" <?php checked( get_option('pix_style_disable_colorbox_portfolio_items'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_single_portfolio_sidebar" class="for_select"><?php _e('Sidebar (primary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_single_portfolio_sidebar" name="pix_content_single_portfolio_sidebar">
                                    <option value="" <?php selected(get_option('pix_content_single_portfolio_sidebar'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_single_portfolio_sidebar'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_single_portfolio_color"><?php _e('Text color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_single_portfolio_color" type="text" value="<?php echo esc_attr(get_option('pix_style_single_portfolio_color')); ?>" name="pix_style_single_portfolio_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_single_portfolio_bg_title" class="for_select"><?php _e('Background of the title section','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_single_portfolio_bg_title" name="pix_style_single_portfolio_bg_title">
                                    <option value="" <?php selected(get_option('pix_style_single_portfolio_bg_title'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_single_portfolio_bg_title'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_single_portfolio_bg_title'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_single_portfolio_bg_title_img"><?php _e('Upload a title background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_single_portfolio_bg_title_img'); ?>" name="pix_style_single_portfolio_bg_title_img" id="pix_style_single_portfolio_bg_title_img">
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