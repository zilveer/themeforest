<?php

function import_export(){

    global $options, $wpdb, $blog_id;
    
    if (!isset($blog_id) || $blog_id == 1) {
        $blog = '';
    } else {
        $blog = $blog_id.'_';
    }
    
    $upload_dir = wp_upload_dir();

    if (isset($_GET['page']) && $_GET['page']=='import_export') {
    
        $sidebar_generator_pix = new sidebar_generator_pix(); 
        $sidebars = $sidebar_generator_pix->get_sidebars();
        $sidebars = implode(",", $sidebars);
?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Import/export','geode'); ?></small></h3>

                        
                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <form method="post" class="dynamic_form" action="<?php echo get_template_directory_uri().'/functions/lib/pix_export.php'; ?>">
                            <label><?php _e('Do you want to export all the settings you saved across the custom admin panel?','geode'); ?></label>
                            <div class="tip_info">
                                <?php _e('The settings will be exported in a .txt file. The images you used in this panel won\'t be physically exported, only their path will be exported and the "uploads" directory will be replaced with the new one (if you are moving the site to another domain). So you need to physically move the images by downloading them from the old server and uploading them to the new one if you are moving the site.','geode'); ?>
                            </div><!-- .tip_info -->
                            <input type="hidden" name="export_host" value="<?php echo DB_HOST; ?>">
                            <input type="hidden" name="export_user" value="<?php echo DB_USER; ?>">
                            <input type="hidden" name="export_password" value="<?php echo DB_PASSWORD; ?>">
                            <input type="hidden" name="export_db" value="<?php echo DB_NAME; ?>">
                            <input type="hidden" name="export_table" value="<?php echo $wpdb->base_prefix.$blog.'options'; ?>">
                            <input type="hidden" name="export_upload_dir" value="<?php echo geode_remove_protocol($upload_dir['baseurl']); ?>">
                            <input type="hidden" name="export_theme_dir" value="<?php echo geode_remove_protocol(get_template_directory_uri()); ?>">
                            <input type="hidden" name="export_sidebars" value="<?php echo $sidebars; ?>">
                            <input type="hidden" name="export_panel" value="export_panel">
                            <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>">
                            <button class="pix-save-options pix_button static alignright"><?php _e('Export','geode'); ?><i class="icon-ok-4"></i></button>
                        </form><!-- .dynamic_form -->


                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        <div class="tip_info tip_info_alt">
                            <?php _e('This tool exports strings only: it means it doesn\'t move media attachments from your old media library to the new one. It only replaces the URLs of the images you use as backgrounds, logos etc. by matching the new site URL. Use a plugin like: <a href="http://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">All-in-One WP Migration</a> or similar to fix the URLs in the admin panel that don\'t point to any media.','geode'); ?>
                        </div><!-- .tip_info -->

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <form method="post" class="dynamic_form cf" enctype="multipart/form-data" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
                            <label><?php _e('Do you want to import a .txt file with the saved styles?','geode'); ?></label>
                            <div class="tip_info">
                                <?php _e('<strong>N.B.:</strong> by clicking the button below you will replace all the settings regarding the style (colors, images, fonts... but not, for instance, the logo, if you have one or other customizations regarding the brand) of your admin panel. As many backups as you can are recommended before proceeding.<br>If you want to import only the content for your admin panel (titles, subtitles, logo, SEO...) use the button <strong>"Import skin contents"</strong>.','geode'); ?>
                            </div><!-- .tip_info -->
                            <input type="file" name="file" id="file_style">
                            <input type="hidden" name="geode_set_import" value="import_skin_style">
                            <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>">
                            <button type="submit" class="pix-save-options pix_button static alignright pix_import_skin" data-alert="<?php _e('This operation will replace your current settings. You can\'t restore them if you haven\'t export them before. Are you sure you want to continue?','geode'); ?>"><?php _e('Import skin styles','geode'); ?><i class="icon-ok-4"></i></button>
                            <br>
                            <br>
                            <br>
                        </form>

                        <form method="post" class="dynamic_form cf" enctype="multipart/form-data" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
                            <label><?php _e('Do you want to import a .txt file with the saved contents?','geode'); ?></label>
                            <div class="tip_info">
                                <?php _e('<strong>N.B.:</strong> by clicking the button below you will replace all the settings regarding the content (titles, subtitles, logo, SEO...) of your admin panel. As more backups as you can are recommended before proceeding.<br>If you want to import the styles (colors, images, fonts...) use the button  <strong>"Import skin styles"</strong>.','geode'); ?>
                            </div><!-- .tip_info -->
                            <input type="file" name="file" id="file_content">
                            <input type="hidden" name="geode_set_import" value="import_skin_content">
                            <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>">
                            <button type="submit" class="pix-save-options pix_button static alignright pix_import_skin" data-alert="<?php _e('This operation will replace your current settings. You can\'t restore them if you haven\'t export them before. Are you sure you want to continue?','geode'); ?>"><?php _e('Import skin contents','geode'); ?><i class="icon-ok-4"></i></button>
                        </form>

                   </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <br>
                <br>


            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>