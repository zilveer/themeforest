<div class="thb-fields-container" id="thb-fields-container-<?php echo $fields_container->getSlug(); ?>">
	<?php if( $fields_container->getTitle() != '' ) : ?>
		<h4><?php echo $fields_container->getTitle(); ?></h4>
	<?php endif; ?>

	<?php echo $container_intro_text; ?>

	<?php
		global $post;

		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : $post->ID;

		foreach( $fields_container->getFields() as $field ) {
			if( $field->isComplex() ) {
				$value = array();
				foreach( $field->getSubkeys() as $subKey ) {
					$value[$subKey] = thb_get_post_meta($post_id, $field->getName() . '_' . $subKey);
				}
			}
			else {
				$value = thb_get_post_meta($post_id, $field->getName());
			}

			$field->setValue($value);
			$field->render();
		}
	?>
</div>