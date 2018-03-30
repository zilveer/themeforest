<?php
	$column_id = sprintf( 'thb-section-%s-row-%s-column-%s', $section_index, $row_index, $index );

	$attributes = array(
		'id' => $column_id,
		'class' => sprintf( 'thb-section-column thb-section-column-size-%s thb-section-column-index-%s', $column['size'], $index ),
	);

	$background_color = thb_isset( $column['appearance'], 'background_color', '' );
	$padding_top      = thb_isset( $column['appearance'], 'padding_top', '' );
	$padding_right    = thb_isset( $column['appearance'], 'padding_right', '' );
	$padding_bottom   = thb_isset( $column['appearance'], 'padding_bottom', '' );
	$padding_left     = thb_isset( $column['appearance'], 'padding_left', '' );

	$attributes['style'] = '';

	if ( ! empty( $background_color ) ) {
		$attributes['style'] .= sprintf( 'background-color:%s;', $background_color );
		$attributes['class'] .= ' thb-skin-' . thb_color_get_opposite_skin( $background_color );
	}

	if ( ! empty( $padding_top ) ) {
		if ( is_numeric( $padding_top ) ) {
			$padding_top .= 'px';
		}

		$attributes['style'] .= sprintf( 'padding-top:%s;', $padding_top );
	}

	if ( ! empty( $padding_right ) ) {
		if ( is_numeric( $padding_right ) ) {
			$padding_right .= 'px';
		}

		$attributes['style'] .= sprintf( 'padding-right:%s;', $padding_right );
	}

	if ( ! empty( $padding_bottom ) ) {
		if ( is_numeric( $padding_bottom ) ) {
			$padding_bottom .= 'px';
		}

		$attributes['style'] .= sprintf( 'padding-bottom:%s;', $padding_bottom );
	}

	if ( ! empty( $padding_left ) ) {
		if ( is_numeric( $padding_left ) ) {
			$padding_left .= 'px';
		}

		$attributes['style'] .= sprintf( 'padding-left:%s;', $padding_left );
	}

	$attributes['class'] .= ' ' . thb_isset( $column['appearance'], 'class', '' );

	$carousel = thb_isset( $column['appearance'], 'carousel', 0 );

	if ( $carousel == '1' ) {
		$attributes['class'] .= ' thb-carousel';

		$attributes = array_merge( thb_get_carousel_attributes( $column['appearance'] ), $attributes );
	}

	$attributes['style'] = apply_filters( 'thb_column_style', $attributes['style'], $column );
	$attributes = apply_filters( 'thb_column_attrs', $attributes, $column );
?>

<div <?php thb_attributes( $attributes ); ?>>
	<?php do_action( 'thb_column_pre_wrapper', $column ); ?>

	<div class="thb-section-column-inner-wrapper">
		<?php
			if ( isset( $column['blocks'] ) && ! empty( $column['blocks'] ) ) {
				foreach ( $column['blocks'] as $idx => $block ) {
					$block_object = thb_builder_instance()->getBlock( $block['type'] );

					if ( $block_object !== false ) {
						thb_get_module_template_part( 'backpack/builder', 'block', array(
							'column_index'  => $index,
							'section_index' => $section_index,
							'row_index'     => $row_index,
							'block'         => $block,
							'index'         => $idx,
						) );
					}
				}
			}
		?>
	</div>
</div>