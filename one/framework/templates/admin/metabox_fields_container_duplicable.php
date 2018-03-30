<?php
	$fields = $fields_container->getItems();

	$metabox_classes = array();

	if ( $fields_container->isSortable() ) {
		$metabox_classes[] = 'sortable';
	}

	if ( $fields_container->hasHandle() ) {
		$metabox_classes[] = 'withHandle';
	}

	if ( $fields_container->isPrependable() ) {
		$metabox_classes[] = 'prependable';
	}

	if ( count( $fields ) == 0 ) {
		$metabox_classes[] = 'no-fields';
	}
?>

<div class="thb-fields-container duplicable <?php echo implode( ' ', $metabox_classes ); ?>" id="thb-fields-container-<?php echo $fields_container->getSlug(); ?>" data-slug="<?php echo $fields_container->getSlug(); ?>" data-field-key="<?php echo $fields_container->getField()->getName(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h4 class="thb-fields-container-title"><?php echo $fields_container->getTitle(); ?></h4>
	<?php endif; ?>

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

	<?php foreach( $fields_container->getControls() as $id => $control ) : ?>
		<?php
			$ctn_field = $fields_container->getField();
			$tpl_key = $ctn_field->getName() . '_' . $id;
			$ctn_field->reset();
			$ctn_field->setMetaKey('subtemplate', $id == 'new' ? '' : $id);
		?>
		<script type="text/template" data-tpl="<?php echo $tpl_key; ?>">
			<?php
				$ctn_field->render();
			?>
		</script>
	<?php endforeach; ?>

	<?php if ( $container_intro_text != '' ) : ?>
		<div class="thb-no-fields">
			<?php echo $container_intro_text; ?>
		</div>
	<?php endif; ?>

	<div class="thb-container">
		<?php
			foreach( $fields as $field ) {
				$field->render();
			}
		?>
	</div>
</div>