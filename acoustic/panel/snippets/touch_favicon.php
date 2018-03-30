<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['touch_favicon']         = get_child_or_parent_file_uri( '/panel/img/apple-touch-icon.png' );
	$ci_defaults['touch_favicon_pre']     = 'disabled';
	$ci_defaults['touch_favicon_72']      = get_child_or_parent_file_uri( '/panel/img/apple-touch-icon-72x72.png' );
	$ci_defaults['touch_favicon_72_pre']  = 'disabled';
	$ci_defaults['touch_favicon_114']     = get_child_or_parent_file_uri( '/panel/img/apple-touch-icon-114x114.png' );
	$ci_defaults['touch_favicon_114_pre'] = 'disabled';

	add_action( 'wp_head', 'ci_touch_favicon' );
	if ( ! function_exists( 'ci_touch_favicon' ) ):
	function ci_touch_favicon() {
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
			return;
		}

		if ( ci_setting( 'touch_favicon' ) ) {
			?><link rel="apple-touch-icon<?php echo( ci_setting( 'touch_favicon_pre' ) == 'enabled' ? '-precomposed' : '' ); ?>" href="<?php echo esc_attr( ci_setting( 'touch_favicon' ) ); ?>" /><?php
		}
		if ( ci_setting( 'touch_favicon_72' ) ) {
			?><link rel="apple-touch-icon<?php echo( ci_setting( 'touch_favicon_72_pre' ) == 'enabled' ? '-precomposed' : '' ); ?>" sizes="72x72" href="<?php echo esc_attr( ci_setting( 'touch_favicon_72' ) ); ?>" /><?php
		}
		if ( ci_setting( 'touch_favicon_114' ) ) {
			?><link rel="apple-touch-icon<?php echo( ci_setting( 'touch_favicon_114_pre' ) == 'enabled' ? '-precomposed' : '' ); ?>" sizes="114x114" href="<?php echo esc_attr( ci_setting( 'touch_favicon_72' ) ); ?>" /><?php
		}
	}
	endif;

?>
<?php else: ?>
	<fieldset id="ci-panel-touch-favicon" class="set">
		<legend><?php _e( 'Touch Icons', 'ci_theme' ); ?></legend>
		<p class="guide"><?php _e( 'As of WordPress v4.3, the Customizer (<em>Appearance &rarr; Customize</em>) provides support for a <strong>Site Icon</strong>. You are strongly adviced to use the Site Icon feature instead of the options below, as they will be removed in theme updates released after WordPress v4.4 is out.', 'ci_theme' ); ?></p>
		<?php
			if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
				?><p class="guide"><?php _e( 'It looks like you have already set a <strong>Site Icon</strong> in <em>Appearance &rarr; Customize</em>. The options below will be ignored.', 'ci_theme' ); ?></p><?php
			}
		?>
		<p class="guide"><?php _e( 'Touch Icons are the icons used in mobiles devices such as iOS and Android phones and tablets. You can upload images optimized for each category of devices. The images should be in PNG format. You can set each image as "precomposed" so that the mobile devices will not apply any visual effects to the icons.', 'ci_theme' ); ?></p>

		<fieldset>
			<?php ci_panel_upload_image( 'touch_favicon', __( 'Upload your touch icon (57x57px, non-Retina iPhone, iPod Touch, Android 2.1+)', 'ci_theme' ) ); ?>
			<?php ci_panel_checkbox( 'touch_favicon_pre', 'enabled', __( 'Precomposed', 'ci_theme' ) ); ?>
		</fieldset>

		<fieldset>
			<?php ci_panel_upload_image( 'touch_favicon_72', __( 'Upload your touch icon (72x72px, 1st generation iPad)', 'ci_theme' ) ); ?>
			<?php ci_panel_checkbox( 'touch_favicon_72_pre', 'enabled', __( 'Precomposed', 'ci_theme' ) ); ?>
		</fieldset>

		<fieldset>
			<?php ci_panel_upload_image( 'touch_favicon_114', __( 'Upload your touch icon (114x114px, iPhone 4+, Retina display)', 'ci_theme' ) ); ?>
			<?php ci_panel_checkbox( 'touch_favicon_114_pre', 'enabled', __( 'Precomposed', 'ci_theme' ) ); ?>
		</fieldset>

	</fieldset>
<?php endif; ?>