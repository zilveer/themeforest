<?php
	$fields = $fields_container->getItems();
?>

<div class="thb-fields-container duplicable <?php echo $fields_container->isSortable() ? 'sortable' : ''; ?> <?php echo count($fields) == 0 ? 'no-fields' : ''; ?>" id="thb-fields-container-<?php echo $fields_container->getSlug(); ?>" data-slug="<?php echo $fields_container->getSlug(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h3 class="thb-fields-container-title"><?php echo $fields_container->getTitle(); ?></h3>
	<?php endif; ?>
	
	<?php echo $container_intro_text; ?>

	<div class="thb-controls">
		<?php foreach( $fields_container->getControls() as $id => $control ) : ?>
			<?php
				thb_system_button($control['label'], '#', array(
					'class' => 'thb-btn-' . $id,
					'data' => $control['data'],
					'icon' => $control['icon']
				));
			?>
		<?php endforeach; ?>
	</div>

	<?php foreach( $fields_container->getControls() as $id => $control ) : ?>
		<script type="text/template" data-tpl="<?php echo $id; ?>">
			<?php
				$ctn_field = $fields_container->getField();
				$ctn_field->reset();
				$ctn_field->setMetaKey('subtemplate', $id == 'new' ? '' : $id);
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