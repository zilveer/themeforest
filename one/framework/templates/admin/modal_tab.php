<div class="thb-modal-tab thb-tab-content" id="thb-modal-tab-<?php echo $tab->getSlug(); ?>" data-slug="<?php echo $tab->getSlug(); ?>">
	<?php
		foreach( $tab->getContainers() as $container ) {
			$container->render( $data );
		}
	?>
</div>