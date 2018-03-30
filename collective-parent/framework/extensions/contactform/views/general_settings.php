<form method="post" action="" id="tf_cf_gensett_form">
    <?php wp_nonce_field('form_gensett_nonce_action','form_gensett_nonce'); ?>
    <?php do_action('gen_options_form'); ?>
</form>