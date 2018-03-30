<?php
	/**
	 * The template for the panel header area.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 	Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.4.4
	 */

$tip_title  = __('Developer Mode Enabled', 'redux-framework');
/*
if ($this->parent->dev_mode_forced) {
    $is_debug       = false;
    $is_localhost   = false;
    
    $debug_bit = '';
    if (Redux_Helpers::isWpDebug ()) {
        $is_debug = true;
        $debug_bit = __('WP_DEBUG is enabled', 'redux-framework');
    }
    
    $localhost_bit = '';
    if (Redux_Helpers::isLocalHost ()) {
        $is_localhost = true;
        $localhost_bit = __('you are working in a localhost environment', 'redux-framework');
    }
    
    $conjunction_bit = '';
    if ($is_localhost && $is_debug) {
        $conjunction_bit = ' ' . __('and', 'redux-framework') . ' ';
    }
    
    $tip_msg    = __('Redux has enabled developer mode because', 'redux-framework') . ' ' . $debug_bit . $conjunction_bit . $localhost_bit . '.';
} else {
    $tip_msg    = __('If you are not a developer, your theme/plugin author shipped with developer mode enabled. Contact them directly to fix it.', 'redux-framework');
}
*/
?>
<div id="redux-header">
	<?php if ( ! empty( $this->parent->args['display_name'] ) ) { ?>
		<div class="display_header">

			<?php /*if ( isset( $this->parent->args['dev_mode'] ) && $this->parent->args['dev_mode'] ) { ?>
				<div class="redux-dev-mode-notice-container redux-dev-qtip" qtip-title="<?php echo $tip_title; ?>" qtip-content="<?php echo $tip_msg; ?>">
					<span class="redux-dev-mode-notice"><?php _e( 'Developer Mode Enabled', 'redux-framework' ); ?></span>
				</div>
			<?php }*/ ?>

			<h2>
				<?php echo $this->parent->args['display_name']; ?>
				<?php if ( ! empty( $this->parent->args['display_version'] ) ) { ?>
					<span><?php _e('Ver', 'dfd') ?>. <?php echo $this->parent->args['display_version']; ?></span>
				<?php } ?>
			</h2>
			
			<p class="clearfix">
				<?php _e('Any questions you can send to our','dfd') ?> <a href="http://themeforest.net/user/dfdevelopment#contact" title="<?php _e('Profile contact form') ?>"><?php _e('PM on Themeforest', 'dfd') ?></a>, <?php _e('via','dfd') ?> <a href="mailto:dynamicframeworks@gmail.com" title="<?php _e('email') ?>">dynamicframeworks@gmail.com</a>,  <?php _e('email','dfd') ?> <?php _e('or on our','dfd') ?> <a href="http://support.dfd.name/" title="<?php _e('Support forum') ?>"><?php _e('Support Forum','dfd') ?></a>
				<a class="docs-icon" href="http://rnbtheme.com/theme_documentation/" title="<?php _e('Theme documentation','dfd') ?>"><?php _e('Ronneby theme documentation','dfd') ?> <i class="crdash-document"></i></a>
			</p>

		</div>
	<?php } ?>

	<div class="clear"></div>
</div>