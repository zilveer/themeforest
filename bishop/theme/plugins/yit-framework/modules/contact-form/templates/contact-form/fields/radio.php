<?php
foreach( $field['options'] as $i => $option ){
    $selected = '';
    if( isset($field['option_selected']) && $field['option_selected'] == $i )
    $selected = ' checked=""';

    ?>
    <input type="radio" name="yit_contact[<?php echo $field['data_name'] ?>]" id="<?php echo $field['data_name'].'-'. $form_name .'-' . $i ?>" value="<?php echo $option ?>"<?php echo $selected ?>/>
    <label for="<?php echo $field['data_name'] . '-' . $form_name . $i ?>"><?php echo $option ?></label>
<?php
}
?>

<div class="clear"></div>
