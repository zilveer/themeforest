<?php if ( isset( $block['data'] ) ) : ?>
	<?php
		$block['data']['_block_data'] = $block['data'];

		$block_object = thb_builder_instance()->getBlock( $block['type'] );
		$id = sprintf( 'thb-section-%s-row-%s-column-%s-block-%s', $section_index, $row_index, $column_index, $index );

		$block['data']['block_id'] = $id;

		$template = new THB_Template( $block_object->getTemplatePath(), $block['data'] );

		$classes = array(
			'thb-section-column-block-' . $block['type']
		);

		$classes = array_merge( $classes, $block_object->blockClasses( $block['data'] ) );

		$is_title = isset( $block['data']['is_title'] ) && $block['data']['is_title'] == '1';
		$has_title = isset( $block['data']['title'] ) && $block['data']['title'] != '';

		$block_tag = 'div';

		if ( $has_title && ! $is_title ) {
			$block_tag = 'section';
		}

		$data_attrs = array(
			'section' => $section_index,
			'row'     => $row_index,
			'column'  => $column_index,
			'index'   => $index
		);
	?>

	<<?php echo $block_tag; ?> id="<?php echo $id; ?>" class="thb-section-column-block <?php echo implode( ' ', $classes ); ?>" <?php thb_data_attributes( $data_attrs ) ?>>
		<?php
			$template->render();
		?>
	</<?php echo $block_tag; ?>>
<?php endif; ?>