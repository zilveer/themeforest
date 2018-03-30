<?php
$checked = '';

if( $value != '' AND $value )
    $checked = ' checked="checked"';
else if( isset($field['already_checked']) && intval( $field['already_checked'] ) )
    $checked = ' checked="checked"';
?>
<input type="checkbox" name="yit_contact[<?php echo $field['data_name'] ?>]" id="<?php echo $field['data_name'] . '-' . $form_name ?>" value="1" class="<?php echo implode( $input_class, ' ' ) ?>" <?php echo $checked ?> />
<?php
if ( isset( $field['title'] ) )
?>
<span><?php echo $field['title'] ?></span>
