<form action='' method="post" id='tf_rf_form_setup' name='tf_rf_form_setup'>
    <?php wp_nonce_field('resform_setup_nonce_action','resform_setup_nonce'); ?>
<?php do_action('tf_rf_form_content'); ?>
</form>