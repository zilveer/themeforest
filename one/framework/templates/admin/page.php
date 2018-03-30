<?php
	thb_flash_message();

	$tabs = $page->getTabs();
?>

<div id="thb-page-<?php echo $page->getSlug(); ?>" class="<?php echo count($tabs) == 1 ? 'thb-no-tabs' : ''; ?> thb-page thb">

	<div class="thb-page-header">
		<h2><?php echo $page->getTitle(); ?></h2>

		<div class="thb-theme-info">
			<p class="thb-logo"><span>THB</span> THEMES</p>
			<p class="thb-theme-name"><?php if( thb_system_is_development() ) { echo THB_THEME_NAME; } ?></p>
			<p class="thb-theme-version"><?php _e('v.', 'thb_text_domain'); ?> <span><?php echo THB_THEME_VERSION; ?></span>

				<?php if ( thb_theme()->getAdmin()->checkForUpdates() ) : ?>
					<a href="<?php echo thb_system_admin_url( 'thb-changelog' ); ?>" class="update-available"><?php _e('Update available', 'thb_text_domain'); ?></a>
				<?php endif; ?>

			</p>

			<?php if ( thb_system_is_development() ) : ?>
				<a class="thb-theme-changelog" href="<?php echo thb_system_admin_url( 'thb-changelog' ); ?>">
					<?php _e('Changelog', 'thb_text_domain'); ?>
				</a>
				<a class="thb-theme-help" href="<?php echo thb_system_admin_url( 'thb-help' ); ?>">
					<?php _e('Need help?', 'thb_text_domain'); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

	<?php foreach ( thb_system_get_messages() as $key => $message ) : ?>
		<div class="thb-message" data-message-key="<?php echo $key; ?>" data-nonce="<?php echo wp_create_nonce('THB_discard_message'); ?>">
			<a href="#" class="thb-discard-message">&times;</a>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>

	<div class="thb-page-content">
		<?php echo $page->getContent(); ?>

		<?php if( count( $tabs ) > 0 ) : ?>
			<div class="thb-page-tabs">
				<?php if( count( $tabs ) > 1 ) : ?>
					<div class="thb-page-tabs-nav">
						<ul>
							<?php
								$page_slug = thb_input_get( 'page', 'string', '' );
								$tab_slug = thb_input_get( 'tab', 'string', '' );
								$tab_active_index = 0;

								foreach ( $tabs as $tab ) {
									if ( $tab->getSlug() != $tab_slug ) {
										$tab_active_index++;
									}
									else {
										break;
									}
								}
							?>
							<?php $i=0; foreach( $tabs as $tab ) : ?>
								<li class="<?php echo ($i == $tab_active_index) || ($tab_slug == '' && $i == 0) ? 'active' : ''; ?>">
									<?php
										$tab_url = thb_system_admin_url( $page_slug, array( 'tab' => $tab->getSlug() ) );
									?>
									<a href="<?php echo $tab_url; ?>" data-href="thb-page-tab-<?php echo $tab->getSlug(); ?>">
										<?php echo $tab->getTitle(); ?>
									</a>
								</li>
							<?php $i++; endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="thb-page-tabs-container">
					<?php
						$i=0;

						foreach( $tabs as $tab ) {
							$tab->setIndex($i);
							$tab_slug = thb_input_get( 'tab', 'string', '' );

							if ( $tab->getSlug() == $tab_slug || ($tab_slug == '' && $i == 0) ) {
								$tab->setActive();
							}

							$tab->render();

							$i++;
						}
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>

</div>