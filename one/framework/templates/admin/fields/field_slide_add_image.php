<?php

thb_partial_upload(array(
	'thumb'       => 'upload_field_slide',
	'field_name'  => $field_name_id,
	'field_value' => $field_value_id,
	'field_label' => $field_label,
	'field_target' => '[data-name=id]'
));

?>

<a class="thb-btn-edit" data-key="<?php echo $field->getName(); ?>" data-subtype="image" title="<?php _e( 'Edit', 'thb_text_domain' ) ?>"><?php _e( 'Edit', 'thb_text_domain' ) ?></a>
<a class="thb-btn-clone" title="<?php _e( 'Clone', 'thb_text_domain' ) ?>"><?php _e( 'Clone', 'thb_text_domain' ) ?></a>