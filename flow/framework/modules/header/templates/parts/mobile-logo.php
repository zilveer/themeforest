<?php do_action('flow_elated_before_mobile_logo'); ?>

<div class="eltd-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php flow_elated_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('Mobile logo','flow'); ?>"/>
    </a>
</div>

<?php do_action('flow_elated_after_mobile_logo'); ?>