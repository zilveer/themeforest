<?php
	$placeholder = $field_value_title != '' ? $field_value_title : __( 'Item (click to edit)', 'thb_text_domain' );
?>

<div class="tab-item-placeholder handle"><?php echo $placeholder; ?></div>
<div class="tab-item">
	<?php
		thb_input_icon( $field_name_icon, __( 'Icon', 'thb_text_domain' ), $field_value_icon );
		thb_input_color( $field_name_color, __( 'Color', 'thb_text_domain' ), $field_value_color );
		thb_input_text( $field_name_title, __( 'Title', 'thb_text_domain' ), $field_value_title );
		thb_input_textarea( $field_name_content, __( 'Content', 'thb_text_domain' ), $field_value_content );
	?>
</div>