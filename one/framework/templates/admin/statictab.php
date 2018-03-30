<div class="thb-page-tab <?php echo ( $tab->isActive() ) ? 'thb-active' : ''; ?> <?php echo ( $tab->getIndex() == 0 ) ? 'thb-first' : ''; ?>" id="thb-page-tab-<?php echo $tab->getSlug(); ?>-id" data-slug="<?php echo $tab->getSlug(); ?>" data-page="<?php echo $_GET['page']; ?>">

	<form method="post" action="<?php echo thb_system_admin_url($_GET['page']); ?>" enctype="multipart/form-data">
		<input type="hidden" name="action" value="<?php echo $tab->getAction(); ?>" />
		<input type="hidden" name="THB_nonce" value="<?php echo wp_create_nonce('THB_tab'); ?>" />
		<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />

		<?php
			foreach( $tab->getContainers() as $container ) {
				$container->render();
			}
		?>

		<input type="submit" value="<?php echo $tab->getSubmitLabel(); ?>" class="thb-btn thb-btn-save">
	</form>

</div>