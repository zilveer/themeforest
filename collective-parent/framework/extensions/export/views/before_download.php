<img class="tfuse_install_icon" src="<?php echo TFUSE_ADMIN_IMAGES . '/export.png' ?> " width="32" height="32" />
<h3><?php _e('Export Content and Theme Options', 'tfuse'); ?></h3>
<p><?php echo sprintf( __('When you click the button below WordPress will create a folder on your server that will %s contain your posts, pages, comments, custom fields, categories, tags and theme options.', 'tfuse'), '<br />'); ?><br />
</p>
<br />
<form action="" method="get" id="export-filters">
    <input type="hidden" name="download" value="true" />
    <input type="hidden" name="page" value="tf_export" />
    <p class="submit"><input type="submit" class="button" id="submit" class="button-secondary" value="&nbsp <?php _e('Export Content', 'tfuse'); ?> &nbsp"></p>
</form>