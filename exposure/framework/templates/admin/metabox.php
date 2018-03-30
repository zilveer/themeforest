<?php

if( !empty($showing_conditions) ) {
	echo $showing_conditions;
}

?>

<div class="thb-metabox" id="thb-metabox-<?php echo $metabox->getSlug(); ?>" data-slug="<?php echo $metabox->getSlug(); ?>" data-post-type="<?php echo $metabox->getPostType(); ?>">
	<?php
		foreach( $metabox->getContainers() as $container ) {
			$container->render();
		}
	?>
</div>