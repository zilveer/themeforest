<?php
	$attributes = array(
		'id' => sprintf( 'thb-section-%s-row-%s', $section_index, $index ),
		'class' => 'thb-section-row',
	);
?>

<div <?php thb_attributes( $attributes ); ?>>
	<div class="thb-section-row-inner-wrapper">
		<?php
			foreach ( $row['columns'] as $column_index => $column ) {
				thb_get_module_template_part( 'backpack/builder', 'column', array(
					'column'        => $column,
					'index'         => $column_index,
					'section_index' => $section_index,
					'row_index'     => $index
				) );
			}
		?>
	</div>
</div>