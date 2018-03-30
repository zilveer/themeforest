<?php

function append_scripts(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='append_scripts') {
    ?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Append scripts','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <label for="pix_style_header"><?php _e( 'Append javascript code to the head', 'shortcodelic' ); ?> <small>(<a href="#" data-dialog="<?php _e('You don\'t need to include your code into &lt; script &gt; tag, just type your code like in the example','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                    <textarea name="pix_style_header" id="pix_style_header" class="jsmirror" data-height="180"><?php echo esc_attr(stripslashes(get_option('pix_style_header'))); ?></textarea>

                    <hr>

                    <label for="pix_style_footer"><?php _e( 'Append javascript code to the footer', 'shortcodelic' ); ?> <small>(<a href="#" data-dialog="<?php _e('You don\'t need to include your code into &lt; script &gt; tag, just type your code like in the example','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:</label>
                    <textarea name="pix_style_footer" id="pix_style_footer" class="jsmirror" data-height="180"><?php echo esc_attr(stripslashes(get_option('pix_style_footer'))); ?></textarea>

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