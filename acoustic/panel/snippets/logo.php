<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['logo']   = '';
	$ci_defaults['logox2'] = '';

	if ( apply_filters( 'ci_panel_option_show_site_slogan', true ) ) {
		$ci_defaults['show_site_slogan'] = '';
	}

?>
<?php else: ?>

	<fieldset id="ci-panel-logo" class="set">
		<legend><?php _e( 'Logo', 'ci_theme' ); ?></legend>
		<p class="guide"><?php _e( 'Upload your logo here. It will replace the textual logo (site name) on the header.', 'ci_theme' ); ?></p>
		<?php ci_panel_upload_image( 'logo', __( 'Upload your logo', 'ci_theme' ) ); ?>

		<?php if ( apply_filters( 'ci_panel_option_show_site_slogan', true ) ): ?>
			<p class="guide"><?php _e( "By default, the site tagline appears near the logo (either image or textual). You can choose to show or hide it. This doesn't affect any other usages of the tagline.", 'ci_theme' ); ?></p>
			<?php
				$options = array(
					''    => __( 'Show tagline', 'ci_theme' ),
					'off' => __( 'Hide tagline', 'ci_theme' ),
				);
				ci_panel_dropdown( 'show_site_slogan', $options, __( 'Tagline near the logo:', 'ci_theme' ) );
			?>
		<?php endif; ?>
	</fieldset>

	<?php if( apply_filters('ci_retina_logo', true) ): ?>
		<fieldset id="ci-panel-logo-hires" class="set">
			<legend><?php _e('Hi-Res Logo', 'ci_theme'); ?></legend>
				<p class="guide"><?php _e('You can upload a higher resolution logo image, that will automatically be served to devices with retina (high resolution) displays. The image needs to be exactly twice the width and height of the image above, and have the same filename with a <strong>@2x</strong> appended at the end. For example, if the image above is named <strong>logo.png</strong> then you need to upload a file named <strong>logo@2x.png</strong><br />Please note that the two images need to be in the same folder. Because of that you should upload both images at the same time in order for the retina version to automatically be recognized.', 'ci_theme'); ?></p>
				<?php ci_panel_upload_image('logox2', __('Upload your hi-res logo', 'ci_theme')); ?>
		</fieldset>
	<?php endif; ?>

<?php endif; ?>