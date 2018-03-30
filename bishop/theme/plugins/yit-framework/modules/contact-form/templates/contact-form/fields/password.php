<label><?php echo stripslashes_deep( $field['title'], 'highlight-text' ) ?></label>
<input type="password" name="yit_contact[{<?php echo $field['data_name'] ?> }]" id="{<?php echo $field['data_name'] . '}-' . $form_name ?>" class="<?php echo implode( $input_class, ' ' ) ?>" value="<?php echo $value ?>" />
