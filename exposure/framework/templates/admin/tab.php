<div class="thb-page-tab <?php echo ( $tab->getIndex() == 0 ) ? 'thb-first' : ''; ?>" id="thb-page-tab-<?php echo $tab->getSlug(); ?>" data-slug="<?php echo $tab->getSlug(); ?>" data-page="<?php echo $_GET['page']; ?>">
	<form method="post" action="<?php echo admin_url('/admin-ajax.php'); ?>" class="thb-ajax">
		<input type="hidden" name="THB_nonce" value="<?php echo wp_create_nonce('THB_tab'); ?>" />
		<input type="hidden" name="action" value="thb_save_tab">
		<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
		<input type="hidden" name="tab" value="<?php echo $tab->getSlug(); ?>" />

		<?php
			foreach( $tab->getContainers() as $container ) {
				$container->render();
			}
		?>

		<input type="submit" value="<?php _e('Save changes', 'thb_text_domain'); ?>" class="thb-btn thb-btn-save">
	</form>
</div>