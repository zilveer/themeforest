<?php
	$fields = $fields_container->getItems();

	$tab_container_classes = array();

	if ( $fields_container->isSortable() ) {
		$tab_container_classes[] = 'sortable';
	}

	if ( $fields_container->hasHandle() ) {
		$tab_container_classes[] = 'withHandle';
	}

	if ( count( $fields ) == 0 ) {
		$tab_container_classes[] = 'no-fields';
	}
?>

<div class="thb-fields-container duplicable <?php echo implode( ' ', $tab_container_classes ); ?>" id="thb-fields-container-<?php echo $fields_container->getSlug(); ?>" data-slug="<?php echo $fields_container->getSlug(); ?>" data-field-key="<?php echo $fields_container->getField()->getName(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h3 class="thb-fields-container-title"><?php echo $fields_container->getTitle(); ?></h3>
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

	<div class="thb-container">
		<?php
			foreach( $fields as $field ) {
				$field->render();
			}
		?>
	</div>

</div>