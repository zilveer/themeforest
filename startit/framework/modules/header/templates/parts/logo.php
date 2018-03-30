<?php do_action('qode_startit_before_site_logo'); ?>

<div class="qodef-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php qode_startit_inline_style($logo_styles); ?>>
        <img class="qodef-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="logo"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="qodef-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="dark logo"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="qodef-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="light logo"/><?php } ?>
    </a>
</div>

<?php do_action('qode_startit_after_site_logo'); ?>