<div class="wrap">
    <?php screen_icon('tools'); ?>
    <h2><?php _e('ThemeFuse Updates', 'tfuse'); ?></h2>

    <p>
        <?php printf(__('Last checked on %1$s at %2$s.', 'tfuse'), date_i18n(get_option('date_format'), $updates->last_checked), date_i18n(get_option('time_format'), $updates->last_checked)); ?>
        &nbsp; <a class="button" href="<?php echo esc_url(self_admin_url('admin.php?page=tfupdates&action=checkagain')); ?>"><?php echo __('Check Again', 'tfuse'); ?></a>
    </p>
    <?php
    if (!isset($response)) {
        ?>
        <h3>
            <?php printf(__('You have the latest version of %s.', 'tfuse'), esc_html($this->theme->theme_name)); ?>
        </h3>

        <p>
            <?php printf(__('You have the latest version of %s. You do not need to update. However, if you want to re-install current version, you can do so automatically.', 'tfuse'), esc_html($this->theme->theme_name)); ?>
        </p>

        <p>
            <?php printf(__('Upgrading %1$s will overwrite the current installed version of this theme. We recommend backing up your theme files before reinstalling the %1$s.', 'tfuse'), esc_html($this->theme->theme_name)) ?>
        </p>

        <?php
        $submit = __('Re-install Now', 'tfuse');
        $form_action = 'admin.php?page=tfupdates&action=tf-do-reinstall';
    } else {
        ?>
        <div class="updated inline"><p style="color:red">
                <?php _e('<strong>Important:</strong> before updating, please <a href="http://codex.wordpress.org/WordPress_Backups" target="_blank">back up your database and files</a>. For help with updates, visit the <a href="http://codex.wordpress.org/Updating_WordPress" target="_blank">Updating WordPress</a> Codex page.'); ?>
            </p></div>

        <h3 class="response">
            <?php printf(__('An updated version of %s is available.', 'tfuse'), esc_html($this->theme->theme_name)); ?>
        </h3>

        <?php
        $submit = __('Update Now', 'tfuse');
        $form_action = 'admin.php?page=tfupdates&action=tf-do-upgrade';
    }
    ?>
    <ul class="core-updates">

        <li>
            Framework <b><?php echo $this->theme->framework_version ?></b>
            <?php
            if (!empty($updates->response[TF_THEME_PREFIX]['Framework']['new_version']) &&
                    version_compare($this->theme->framework_version, $updates->response[TF_THEME_PREFIX]['Framework']['new_version'], '<')) {
                ?>
                | <span style="color:red;"><?php echo $updates->response[TF_THEME_PREFIX]['Framework']['new_version'] ?></span>
            <?php } ?>
        </li>

        <li>
            ThemeMods <b><?php echo $this->theme->mods_version ?></b>
            <?php
            if (!empty($updates->response[TF_THEME_PREFIX]['ThemeMods']['new_version']) &&
                    version_compare($this->theme->mods_version, $updates->response[TF_THEME_PREFIX]['ThemeMods']['new_version'], '<')) {
                ?>
                | <span style="color:red;"><?php echo $updates->response[TF_THEME_PREFIX]['ThemeMods']['new_version'] ?></span>
            <?php } ?>
        </li>

        <li>
            Templates <b><?php echo $this->theme->theme_version ?></b>
            <?php
            if (!empty($updates->response[TF_THEME_PREFIX]['Templates']['new_version']) &&
                    version_compare($this->theme->theme_version, $updates->response[TF_THEME_PREFIX]['Templates']['new_version'], '<')) {
                ?>
                | <span style="color:red;"><?php echo $updates->response[TF_THEME_PREFIX]['Templates']['new_version'] ?></span>
            <?php } ?>
        </li>

    </ul>

    <form method="post" action="<?php echo $form_action ?>" name="upgrade" class="upgrade">
        <?php wp_nonce_field('themefuse-bulk-update') ?>

        <p style="color:red">
            <?php printf(__('<strong>Please Note:</strong> Any customizations you have made to theme files will be lost. Please consider using <a href="http://codex.wordpress.org/Child_Themes">child themes</a> for modifications.', 'tfuse')); ?>
        </p>

        <?php submit_button($submit, 'button', 'upgrade', false); ?>
    </form>

    <p><?php echo __('While your site is being updated, it will be in maintenance mode. As soon as your updates are complete, your site will return to normal.', 'tfuse') ?></p>

</div>