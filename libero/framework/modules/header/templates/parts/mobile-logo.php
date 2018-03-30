<?php do_action('libero_mikado_before_mobile_logo'); ?>

<div class="mkd-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php libero_mikado_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile logo','libero' ); ?>"/>
    </a>
</div>

<?php do_action('libero_mikado_after_mobile_logo'); ?>