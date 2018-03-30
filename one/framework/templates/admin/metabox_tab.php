<div class="thb-metabox-tab thb-tab-content" id="thb-metabox-tab-<?php echo $tab->getSlug(); ?>" data-slug="<?php echo $tab->getSlug(); ?>">
	<?php
		foreach( $tab->getContainers() as $container ) {
			$container->render();
		}
	?>
</div>