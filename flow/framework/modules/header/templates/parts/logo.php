<?php do_action('flow_elated_before_site_logo'); ?>

<div class="eltd-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php flow_elated_inline_style($logo_styles); ?>>
        <img class="eltd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('Logo','flow'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="eltd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('Dark logo','flow'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="eltd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('Light logo','flow'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('flow_elated_after_site_logo'); ?>