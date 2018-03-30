<?php

function admin_panel(){

	global $options;

    if (isset($_GET['page']) && $_GET['page']=='admin_panel') {
	
?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Very general','geode'); ?></small></h3>

            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            
                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_content_admin_page_title"><?php _e('Text on the admin menu label','geode'); ?>:</label>
                        <input type="text" value="<?php echo get_option('pix_content_admin_page_title'); ?>" name="pix_content_admin_page_title" id="pix_content_admin_page_title">
                        <br>

                        <label for="pix_content_css_inline"><?php _e('Put your custom CSS inline','geode'); ?> <small>(<a href="#" data-dialog="<?php _e('If you switch this button on, the options you have saved in this admin panel will be written directly on the head section of your pages.<br>In this way the performance of your site could be a little slower, so I recommend to leave this button off if you don\'t have more important reasons to switch it on.','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:
                            <input type="hidden" name="pix_content_css_inline" value="0">
                            <input type="checkbox" id="pix_content_css_inline" name="pix_content_css_inline" value="true" <?php checked( get_option('pix_content_css_inline'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_login_logo"><?php _e('Login logo','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_content_login_logo'); ?>" name="pix_content_login_logo" id="pix_content_login_logo">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_content_allow_ajax"><?php _e('Enable ajax to save data','geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Where available (not on this page, for instance) your options will be saved without refreshing the page.<br>If you encounter any problem just switch this field off.','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:
                            <input type="hidden" name="pix_content_allow_ajax" value="0">
                            <input type="checkbox" id="pix_content_allow_ajax" name="pix_content_allow_ajax" value="true" <?php checked( get_option('pix_content_allow_ajax'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="action" value="data_save" />
                <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','geode'); ?><i class="icon-ok-4"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','geode'); ?><i class="icon-ok-4"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','geode'); ?><i class="icon-ok-4"></i></button>
                <div id="gradient-save-button"></div>

            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>