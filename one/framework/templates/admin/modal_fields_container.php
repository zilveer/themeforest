<div class="thb-modal-fields-container thb-fields-container" id="thb-modal-fields-container-<?php echo $fields_container->getSlug(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h3 class="thb-modal-fields-container-title thb-fields-container-title"><?php echo $fields_container->getTitle(); ?></h3>
	<?php endif; ?>

	<?php echo $container_intro_text; ?>

	<div class="thb-container">
		<?php
			foreach( $fields_container->getFields() as $field ) {
				if ( isset( $data[$field->getName()] ) ) {
					$field->setValue( $data[$field->getName()] );
				}

				$field->render();
			}
		?>
	</div>
</div>