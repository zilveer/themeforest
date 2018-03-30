<div class="thb-fields-container" id="thb-fields-container-<?php echo $fields_container->getSlug(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h3 class="thb-fields-container-title"><?php echo $fields_container->getTitle(); ?></h3>
	<?php endif; ?>

	<?php echo $container_intro_text; ?>

	<div class="thb-container">
		<?php
			foreach( $fields_container->getFields() as $field ) {
				$field->render();
			}
		?>
	</div>
</div>