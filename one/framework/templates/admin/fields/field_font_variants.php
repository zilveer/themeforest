<?php

	$variants_options = array();
	foreach ( explode( ',', $variants ) as $variant ) {
		$variants_options[$variant] = $variant;
	}

	$subsets_options = array();
	foreach ( explode( ',', $subsets ) as $subset ) {
		$subsets_options[$subset] = $subset;
	}

	if ( ! empty( $variants ) && count( $variants_options ) > 1 ) {
		if ( empty( $field_value_variants ) ) {
			$field_value_variants = implode( ',', $default_variants );
		}

		printf( '<span class="thb-field-multiple-label">%s</span>', __( 'Variants', 'thb_text_domain' ) );
		thb_input_selectize( $field_name_variants, $variants_options, $field_value_variants );
	}
	else {
		printf( '<input type="hidden" name="%s" value="">', $field_name_variants );
	}

	if ( ! empty( $subsets ) && count( $subsets_options ) > 1 ) {
		if ( empty( $field_value_subsets ) ) {
			$field_value_subsets = implode( ',', $default_subsets );
		}

		printf( '<span class="thb-field-multiple-label">%s</span>', __( 'Subsets', 'thb_text_domain' ) );
		thb_input_selectize( $field_name_subsets, $subsets_options, $field_value_subsets );
	}
	else {
		printf( '<input type="hidden" name="%s" value="">', $field_name_subsets );
	}

	echo '<span class="thb-field-multiple-label">' . __( 'CSS selectors', 'thb_text_domain' ) . '</span>';
	echo '<span class="thb-autoselect">' . $selector . '</span>';

?>
