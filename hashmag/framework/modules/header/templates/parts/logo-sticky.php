<?php do_action('hashmag_mikado_before_site_logo'); ?>

<div class="mkdf-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php hashmag_mikado_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','hashmag' ); ?>"/>
    </a>
</div>

<?php do_action('hashmag_mikado_after_site_logo'); ?>