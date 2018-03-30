<?php

function sidebar_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='sidebar_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Sidebar section','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_content_primary_sidebar" class="for_select"><?php _e('Sidebar (primary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_primary_sidebar" name="pix_content_primary_sidebar">
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_primary_sidebar'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_main_sidebar_position" class="for_select"><?php _e('Position of the primary sidebar','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_main_sidebar_position" name="pix_style_main_sidebar_position">
                                    <option value="right" <?php echo selected(get_option('pix_style_main_sidebar_position'),'right'); ?>><?php _e('Right','geode'); ?></option>
                                    <option value="left" <?php echo selected(get_option('pix_style_main_sidebar_position'),'left'); ?>><?php _e('Left','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_secondary_sidebar" class="for_select"><?php _e('Sidebar (secondary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_secondary_sidebar" name="pix_content_secondary_sidebar">
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_secondary_sidebar'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
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