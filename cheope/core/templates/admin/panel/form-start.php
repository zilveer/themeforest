<?php
/**
 * Start of the form of the panel
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */
?>
<div id="yit-content">
	<form id="yit_<?php echo $var['id']; ?>" action="<?php echo admin_url( 'admin.php?page=yit_'.$var['action'] ) ?>" method="post"<?php if( isset( $enctype ) && $enctype ): ?> enctype="multipart/form-data"<?php endif ?>>

	<?php do_action('yit-panel-message') ?>
	
        <span class="submit top"><input type="submit" value="<?php _e('Save options', 'yit') ?>" class="button-secondary" /></span>
        <div class="clear-right"></div>
        <input type="hidden" name="yit-subpage" value="<?php echo $var['subpage']; ?>" />
        <input type="hidden" name="yit-action" value="save-options" />
        <?php wp_nonce_field( 'yit-theme-options', '_yit_theme_options_nonce' ); ?> 
