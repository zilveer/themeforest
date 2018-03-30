<form action='' method="post" id='tf_cf_form_setup' name='tf_cf_form_setup'>
    <?php wp_nonce_field('form_setup_nonce_action','form_setup_nonce'); ?>
    <?php do_action('tf_cf_form_content'); ?>
</form>