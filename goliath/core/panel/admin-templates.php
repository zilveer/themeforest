<?php

function plsh_sidebar()
{
    plsh_get_admin_template('sidebar');
}

function plsh_option_list()
{
    plsh_get_admin_template('option-list');
}

function plsh_sidebar_manager()
{
    plsh_get_admin_template('sidebar-manager');
}

function plsh_ads_manager() {
    
    plsh_get_admin_template('ads-manager');
}

function plsh_admin()
{
    plsh_get_admin_template('admin-layout');
}

function plsh_backup_reset()
{
    plsh_get_admin_template('backup-reset');
}

function plsh_support_iframe()
{
    ?>
        <iframe class="support-iframe" src="<?php echo plsh_gs('support_url') ?>" height="100%" border="none"></iframe>
    <?php
}

function plsh_google_fonts()
{
	plsh_get_admin_template('google-fonts');
}
?>