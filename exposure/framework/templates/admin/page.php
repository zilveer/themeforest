<?php thb_flash_message(); ?>

<div id="thb-page-<?php echo $page->getSlug(); ?>" class="<?php echo count($page->getTabs()) == 1 ? 'thb-no-tabs' : ''; ?> thb-page thb">

	<div class="thb-page-header">
		<div id="icon-themes" class="icon32"><br></div>
		<h2><?php echo $page->getTitle(); ?></h2>
		<p>
			<?php if( thb_system_is_development() ) { echo '"' . THB_THEME_NAME . '", '; } ?>
			<?php _e('Version', 'thb_text_domain'); ?> <?php echo THB_THEME_VERSION; ?>
		</p>
	</div>

	<?php foreach( $theme->getAdmin()->getMessages() as $message ) : ?>
		<?php echo thb_translated_admin_resource('messages/' . $message); ?>
	<?php endforeach; ?>

	<div class="thb-page-content">
		<?php echo $page->getContent(); ?>

		<?php if( count($page->getTabs()) > 0 ) : ?>
			<div class="thb-page-tabs">
				<?php if( count($page->getTabs()) > 1 ) : ?>
					<div class="thb-page-tabs-nav">
						<ul>
							<?php $i=0; foreach( $page->getTabs() as $tab ) : ?>
								<li class="<?php echo $i == 0 ? 'active' : ''; ?>">
									<a href="#thb-page-tab-<?php echo $tab->getSlug(); ?>">
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
						foreach( $page->getTabs() as $tab ) {
							$tab->setIndex($i);
							$tab->render();
							$i++;
						}
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>

</div>