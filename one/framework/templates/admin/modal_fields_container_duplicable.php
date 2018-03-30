<?php
	$fields = array();

	if ( isset( $data[$fields_container->getField()->getName()] ) ) {
		$fields = $fields_container->getItems( $data[$fields_container->getField()->getName()] );
	}

	$modal_classes = array();

	if ( $fields_container->isSortable() ) {
		$modal_classes[] = 'sortable';
	}

	if ( $fields_container->hasHandle() ) {
		$modal_classes[] = 'withHandle';
	}

	if ( $fields_container->isPrependable() ) {
		$modal_classes[] = 'prependable';
	}

	if ( count( $fields ) == 0 ) {
		$modal_classes[] = 'no-fields';
	}
?>

<div class="thb-modal-fields-container thb-fields-container duplicable <?php echo implode( ' ', $modal_classes ); ?>" id="thb-modal-fields-container-<?php echo $fields_container->getSlug(); ?>" data-slug="<?php echo $fields_container->getSlug(); ?>" data-field-key="<?php echo $fields_container->getField()->getName(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h3 class="thb-modal-fields-container-title thb-fields-container-title"><?php echo $fields_container->getTitle(); ?></h3>
	<?php endif; ?>

	<?php echo $container_intro_text; ?>

	<div class="thb-controls">
		<?php foreach( $fields_container->getControls() as $id => $control ) : ?>
			<?php
				$control['data']['tpl'] = $fields_container->getField()->getName() . '_' . $id;
				$control['data']['key'] = $fields_container->getField()->getName();

				thb_system_button($control['label'], '#', array(
					'class' => 'thb-btn-' . $id,
					'data' => $control['data'],
					'icon' => $control['icon']
				));
			?>
		<?php endforeach; ?>

		<?php
			thb_system_button(__( 'Remove all', 'thb_text_domain' ), '#', array(
				'class' => 'thb-btn-remove-all',
				'data' => array( 'action' => 'thb_remove_all_duplicable_items' )
			));
		?>
	</div>

	<div class="thb-container">
		<?php
			foreach( $fields as $field ) {
				$field->render();
			}
		?>
	</div>

</div>