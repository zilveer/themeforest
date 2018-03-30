<?php

function google_fonts(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='google_fonts') {
    
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Typography','geode'); ?>: <small><?php _e('Google fonts','geode'); ?></small></h3>

            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
                        
<?php
$json = get_google_font_list();
$decoded = json_decode($json);
?>

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_enable_google_fonts"><?php _e('Enable Google fonts','geode'); ?>:
                            <input type="hidden" name="pix_style_enable_google_fonts" value="0">
                            <input type="checkbox" id="pix_style_enable_google_fonts" name="pix_style_enable_google_fonts" value="true" <?php checked( get_option('pix_style_enable_google_fonts'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <hr>
                        <a href="#" class="pix_button refresh_font_list"><i class="scicon-entypo-arrows-ccw"></i> Refresh the font list</a>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <?php if(get_option('pix_style_enable_google_fonts')=='true') { ?>
                            <label for="pix_style_enable_google_fonts"><?php _e('Find a font','geode'); ?>:</label>
                            <input type="text" id="pix_font_finder" value="" placeholder="<?php _e('type something', 'geode'); ?>">
                            
                            <br>
                            <br>

                        <?php } ?>

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <div class="pix_columns cf">
                    <label for="pix_content_google_api_key">
                        <?php _e('If you have any problem by retrieving the Google font list or if the amount of available fonts is 0 (also after refreshing the list), try to register your own API key. Follow the instructions here:', 'geode'); ?>
                        <br><a href="https://developers.google.com/fonts/docs/developer_api#APIKey" target="_blank">https://developers.google.com/fonts/docs/developer_api#APIKey</a>
                        <input id="pix_content_google_api_key" name="pix_content_google_api_key" type="text" value="<?php echo esc_attr(get_option('pix_content_google_api_key')); ?>" placeholder="<?php _e('Enter API key (if necessary... read above)', 'geode'); ?>">
                        <br>
                    </label>

                <?php if(get_option('pix_style_enable_google_fonts')=='true') { ?>

                    <div class="pix_columns cf">

                        <small class='alignright'><em><?php printf( __( '%d fonts available', 'geode' ), count($decoded->items) ); ?></em></small>
                        <div class="clear"></div>
                        <input type="hidden" name="pix_style_select_fonts" value="">
                        <?php
                            foreach ( $decoded->items as $item )
                            { ?>
                            <div class="checkboxes_font" data-search="<?php echo sanitize_title($item->family); ?>">
                                <div class="alignleft">
                                    <label for="google_font_<?php echo sanitize_title($item->family); ?>">
                                        <input type="checkbox" id="google_font_<?php echo sanitize_title($item->family); ?>" name="pix_style_select_fonts[]" value="<?php echo $item->family; ?>" <?php if (is_array(get_option('pix_style_select_fonts')) && in_array($item->family,get_option('pix_style_select_fonts'))) { echo ' checked="checked"'; } ?>>
                                        <span></span>
                                    </label>
                                </div>
                                <div class="alignleft font_preview select_font_family" data-font="<?php echo $item->family; ?>" data-webfont="<?php echo str_replace(' ','+',$item->family); ?>"> <?php echo $item->family; ?></div>
                                <a href="#" class="preview_font_list alignright">preview</a>
                            </div>
                            <?php }
                        ?>
                    </div><!-- .pix_columns -->

                <?php } ?>

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