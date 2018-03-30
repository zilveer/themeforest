<?php do_action('libero_mikado_before_site_logo'); ?>

<div class="mkd-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php libero_mikado_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','libero' ); ?>"/>
    </a>
</div>

<?php do_action('libero_mikado_after_site_logo'); ?>