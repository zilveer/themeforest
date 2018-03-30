<?php

function custom_css_admin(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='custom_css_admin') {
    ?>

        <section id="pix_content_loaded">
            <h3><?php _e('Styles','geode'); ?>: <small><?php _e('Custom CSS','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <label for="pix_style_custom_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                    <textarea name="pix_style_custom_css" id="pix_style_custom_css" class="codemirror" data-height="420"><?php echo esc_attr(stripslashes(get_option('pix_style_custom_css'))); ?></textarea>

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