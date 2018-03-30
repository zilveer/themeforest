<?php do_action('qode_startit_before_mobile_logo'); ?>

<div class="qodef-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php qode_startit_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="mobile-logo"/>
    </a>
</div>

<?php do_action('qode_startit_after_mobile_logo'); ?>