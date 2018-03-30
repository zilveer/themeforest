<form method="post" action='' id="tf_rf_gensett_form">
    <?php wp_nonce_field('res_form_gensett_nonce_action','res_form_gensett_nonce'); ?>
    <?php do_action('resform_gen_options'); ?>
</form>