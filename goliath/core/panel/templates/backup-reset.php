<div class="section-item clearfix" id="backup_settings">
    <h3><?php _e('Backup Settings', 'goliath'); ?></h3>
    <?php
    plsh_output_theme_setting(array(
            'slug'        => 'settings_export',
            'title'       => 'Exported settings',
            'type'        => 'textarea',
            'value'       => Plsh_Settings::export_settings(),
            'description' => '',
            'warning'     => 'Copy & save these settings to your computer. You can later import them back using the form below.'
        ));
    ?>
</div>

<div class="section-item clearfix" id="import_settings">
    <h3><?php _e('Import Settings', 'goliath'); ?></h3>
    <form name="import-settings" class="no-submit">
        <?php
        plsh_output_theme_setting(array(
                'slug'        => 'settings_export',
                'title'       => 'Settings for import',
                'type'        => 'textarea',
                'value'       => '',
                'description' => '',
                'warning'     => 'Paste here the settings that you previously exported/backed up from this theme. If the import fails, reset the settings using the button below.'
            ));
        ?>
        <div class="row">
            <a href="#" id="import-settings" class="button-1"><?php _e('Import', 'goliath') ?></a>
        </div>
    </form>
</div>

<div class="section-item clearfix" id="reset_settings">
    <h3><?php _e('Reset Settings', 'goliath'); ?></h3>
    <div class="row">
        <a href="#" id="reset-theme" class="button-1"><?php _e('Reset Theme', 'goliath') ?></a>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('#import-settings').click(function(){
            var result = jQuery('form[name=import-settings]').serialize();

            var admin_ajax = '<?php echo site_url().'/wp-admin/admin-ajax.php'; ?>';
            var nonce = '<?php echo wp_create_nonce('plsh_import_settings') ?>';
            var data = { action: 'plsh_import_settings', _ajax_nonce: nonce, data: result};

            jQuery.post(admin_ajax,data,function(msg){
                admin.show_save_result(msg);
            }, 'json');

            return false;
        });

        jQuery('#reset-theme').click(function(){
            var c = confirm('Are you sure? By reseting theme You will permanently delete all you settings!');
            if(c === true )
            {
                var admin_ajax = '<?php echo site_url().'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_reset_settings') ?>';
                var data = { action: 'plsh_reset_settings', _ajax_nonce: nonce};

                jQuery.post(admin_ajax,data,function(msg){
                    location.reload();
                });
            }
            return false;
        });
    });
</script>