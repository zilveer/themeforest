<?php do_action('hashmag_mikado_before_site_logo');?>

<div class="mkdf-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php hashmag_mikado_inline_style($logo_styles); ?>>
        <img class="mkdf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','hashmag'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="mkdf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo','hashmag'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="mkdf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo','hashmag'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_transparent)){ ?><img class="mkdf-transparent-logo" src="<?php echo esc_url($logo_image_transparent); ?>" alt="<?php esc_html_e('transparent logo','hashmag'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('hashmag_mikado_after_site_logo'); ?>