<?php
	$placeholder = $field_value_type != '' ? $field_value_type : __( 'Item (click to edit)', 'thb_text_domain' );
?>

<div class="pricingtable-item-placeholder"><?php echo $placeholder; ?></div>
<div class="pricingtable-item">
	<?php
		thb_input_text( $field_name_featured, __( 'Featured reason', 'thb_text_domain' ), $field_value_featured, array(
			'help' => __( 'Highlighted text at the top', 'thb_text_domain' )
		) );
		thb_input_text( $field_name_type, __( 'Type', 'thb_text_domain' ), $field_value_type );
		thb_input_text( $field_name_price, __( 'Price', 'thb_text_domain' ), $field_value_price );
		thb_input_text( $field_name_currency, __( 'Currency Prefix', 'thb_text_domain' ), $field_value_currency );
		thb_input_text( $field_name_currency_after, __( 'Currency Suffix', 'thb_text_domain' ), $field_value_currency_after );
		thb_input_text( $field_name_validity, __( 'Validity', 'thb_text_domain' ), $field_value_validity );
		thb_input_text( $field_name_description, __( 'Description', 'thb_text_domain' ), $field_value_description );
		thb_input_textarea( $field_name_features, __( 'Features', 'thb_text_domain' ), $field_value_features, array(
			'help' => __( 'A list of features, one per line.', 'thb_text_domain' )
		) );
		thb_input_text( $field_name_action_url, __( 'Action URL', 'thb_text_domain' ), $field_value_action_url );
		thb_input_text( $field_name_action_label, __( 'Action Label', 'thb_text_domain' ), $field_value_action_label );
	?>
</div>