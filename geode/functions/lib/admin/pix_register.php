<?php

function register_theme(){

	global $options;

    if (isset($_GET['page']) && $_GET['page']=='register_theme') {
	
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Unlock','geode'); ?>: <small><?php _e('Register','geode'); ?></small></h3>

            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            
                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_content_geode_user_name"><?php _e( 'Your Envato user name', 'geode' ); ?> <small>(<a href="http://www.pixedelic.com/envato-assets/pixgridder/username.jpg" class="pix-iframe"><?php _e('what\'s that','geode'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pix_content_geode_user_name'))); ?>" name="pix_content_geode_user_name" id="pix_content_geode_user_name">
                        <br>
                        <br>
                        <br>

                        <div id="check_license_message" class="hidden"></div>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_geode_license_key"><?php _e( 'Your Item Purchase Code', 'geode' ); ?> <small>(<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-can-I-find-my-Purchase-Code-" class="pix-iframe"><?php _e('where to find it','geode'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pix_content_geode_license_key'))); ?>" name="pix_content_geode_license_key" id="pix_content_geode_license_key">
                        <br>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->

                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="register_license_details" value="register_license_details" />
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