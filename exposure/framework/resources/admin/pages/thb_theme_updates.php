<div id="thb-page-thb_theme_updates" class="thb-page thb">

	<div class="thb-page-header">
		<div id="icon-themes" class="icon32"><br></div>
		<h2><?php echo 'thb_text_domain'; ?></h2>
		<p><?php _e('Version', 'thb_text_domain'); ?> <?php echo THB_THEME_VERSION; ?></p>
		<?php if( is_child_theme() ) : ?>
			<p><?php _e('Parent theme version', 'thb_text_domain'); ?> <?php echo THB_PARENT_THEME_VERSION; ?></p>
		<?php endif; ?>
	</div>

	<?php echo thb_translated_admin_resource('messages/update'); ?>

	<div class="thb-page-content">
		<?php
			$installationDetails = thb_theme()->getAdmin()->getInstallationDetails();
			$changelog = $installationDetails['updates']['changelog'];

			$theme_changelog = new THB_Template(THB_RESOURCES_DIR . '/admin/pages/thb_theme_changelog', array(
				'changelog' => $changelog
			));

			$theme_changelog->render();
		?>
	</div>

</div>