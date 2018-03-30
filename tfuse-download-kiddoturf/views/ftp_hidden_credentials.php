<?php if( isset( $_POST['hostname'] ) ): /* is FTP Credentials */ 
    foreach( array('hostname', 'username', 'password', 'connection_type') as $field_name ){ ?>
            <input type="hidden" name="<?php print($field_name); ?>" value="<?php print( htmlentities(@$_POST[$field_name], ENT_QUOTES, 'UTF-8') ); ?>">
<?php } endif; ?>