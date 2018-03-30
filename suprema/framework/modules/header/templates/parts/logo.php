<?php do_action('suprema_qodef_before_site_logo'); ?>

<div class="qodef-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php suprema_qodef_inline_style($logo_styles); ?>>
        <img class="qodef-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','suprema'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="qodef-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo','suprema'); ?>o"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="qodef-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo','suprema'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('suprema_qodef_after_site_logo'); ?>