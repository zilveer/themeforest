<?php
/*
 *
 */

$title = stripslashes_deep( $field['title'], 'highlight-text' );

if ( $title_position == 'label' || $title_position == 'both' ) : ?>
    <label for="<?php echo $field['data_name'].'-'.$form_name ?>"><?php echo $title ?></label>
<?php
endif;
?>

<textarea name="yit_contact[<?php echo $field['data_name'] ?>]" id="<?php echo $field['data_name'] . '-' . $form_name ?>" rows="8" cols="<?php apply_filters('yit_contact_form_cols', 30, $form_name) ?>" class="<?php echo implode( $input_class, ' ' ) ?>" <?php if ( $title_position == 'placeholder' || $title_position == 'both' ) : ?> placeholder="<?php echo $title ?>"<?php endif;?>><?php echo $value ?></textarea>
