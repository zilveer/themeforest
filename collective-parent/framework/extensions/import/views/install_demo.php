<div class="install">
    <div style="clear:both;height:5px;"></div>

    <div class="demoinstall">

        <div class="tfuse_install_submit">
            <form method="post" action="<?php echo admin_url( 'admin.php?page=tf_import' ) ?>">
            <?php wp_nonce_field( 'themefuse-import-wordpress' ); ?>
            <input type="hidden" name="step" value="2" />
            <input type="hidden" name="install_demo" value="yes" />
            <input type="hidden" name="import_id" value="<?php echo $id; ?>" />
            <input type="hidden" name="fetch_attachments" value="1" />
            <p class="submit"><input type="submit" class="button" id="install_btn" value="&nbsp Import Content &nbsp" /></p>
            </form>
        </div>

        <img class="tfuse_install_icon" src="<?php echo TFUSE_ADMIN_IMAGES . '/auto_install_icon.png' ?>" width="33" height="33" />

        <h3><?php _e('Import Content', 'tfuse'); ?></h3>
        <p><?php echo sprintf( __('Install is not necessary but will help you to get the core pages, categories,
        and meta setup correctly and let you see how the pages/posts work. WARNING: IF YOU ALREADY HAVE POSTS, PAGES, AND CATEGORIES SETUP IN YOUR WORDPRESS DO NOT INSTALL THIS.
        IT WILL MOST CERTAINLY DESTROY YOUR PAST WORK.', 'tfuse'), '<br /><br /><span>');?></span></p>

    </div>

    <div class="skipinstall">

        <div class="tfuse_install_submit">
            <form method="post" action="<?php echo admin_url( 'admin.php?page=themefuse' ) ?>">
            <input type="hidden" name="install_demo" value="no" />
            <p class="submit"><input name="skip_installation" type="submit" value="&nbsp Skip Import &nbsp" /></p>
            </form>
        </div>

        <img class="tfuse_install_icon" src="<?php echo TFUSE_ADMIN_IMAGES . '/skip_install_icon.png' ?>" width="33" height="33" />

        <h3><?php _e('Skip Import', 'tfuse'); ?></h3>
        <p><?php echo sprintf( __('Skipping the instalation will not install the core pages and categories. Further more the meta setup and all the settings will be done manually.
        NOTE: WE RECOMMEND SKIPPING THE INSTALL ONLY IF YOU HAVE WORDPRESS SKILLS  AND KNOW HOW TO MANUALLY INSTALL THE TEMPLATE', 'tfuse'), '<br /><br /><span>'); ?></span></p>

    </div>

    <div class="install_loading">
        <div style="text-align:center">
            <br />
            <img src="<?php echo TFUSE_ADMIN_IMAGES . '/loading.gif' ?>" />
            <br /><p><?php _e('Importing ...', 'tfuse'); ?> </p><br />
        </div>
    </div>

</div>