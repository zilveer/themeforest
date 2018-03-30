<?php if ( $title_position == 'label' || $title_position == 'both' ) : ?>
<label><?php echo stripslashes_deep( $field['title'], 'highlight-text' ) ?></label>
<?php
endif;
?>
<select name="yit_contact[<?php echo $field['data_name'] ?>]" id=" <?php echo $field['data_name'] . '-' . $form_name ?>" class=" <?php echo implode( $input_class, ' ' ) ?>">

<?php
// options
foreach( $field['options'] as $id => $option ){
    $selected = '';
    if( isset($field['option_selected']) && $field['option_selected'] == $id ){
        $selected = ' selected="selected"';
    }

    if( $id === 'the-form-label' ) {
        ?><option value=""<?php echo $selected ?> > <?php echo $option ?> </option>
    <?php } else {
        ?><option value="<?php echo $option ?>" <?php echo $selected ?>> <?php echo $option ?> </option>
    <?php }
} ?>

</select>