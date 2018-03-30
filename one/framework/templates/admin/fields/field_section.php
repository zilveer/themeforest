<span class="thb-section-label"><?php _e( 'Section', 'thb_text_domain' ); ?></span>
<a href="#" class="thb-section-add-section"><?php _e( 'Add section', 'thb_text_domain' ) ?></a>
<a href="#" class="thb-section-add-row"><?php _e( 'Add row', 'thb_text_domain' ) ?></a>
<a href="#" class="thb-section-appearance"><?php _e( 'Section appearance', 'thb_text_domain' ) ?></a>

<?php
	$decoded_field_value = html_entity_decode( $field_value, ENT_QUOTES );
	parse_str( $decoded_field_value, $section );

	$section = stripslashes_deep( $section );

	$appearance = '';

	if ( isset( $section['appearance'] ) ) {
		$appearance = htmlentities( json_encode( $section['appearance'] ), ENT_QUOTES );
	}
	else {
		$appearance = htmlentities( json_encode( array( 'width' => 'boxed', 'class' => '' ) ), ENT_QUOTES );
	}
?>

<div class="thb-rows-container">
	<?php
		if ( ! empty( $section['rows'] ) ) {
			foreach ( $section['rows'] as $row ) {
				thb_get_framework_template_part( '/admin/fields/partials/builder/row', array(
					'row' => $row
				) );
			}
		}
	?>
</div>

<input type="hidden" name="<?php echo $field_name; ?>" value="<?php echo $field_value; ?>" class="thb-section-data" data-appearance="<?php echo $appearance; ?>">
