<div class="mkdf-title <?php echo hashmag_mikado_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
    <div class="mkdf-title-holder" <?php hashmag_mikado_inline_style($title_holder_height); ?>>
        <div class="mkdf-breadcrumbs-holder"><div class="mkdf-breadcrumbs-holder-inner"><?php hashmag_mikado_custom_breadcrumbs(); ?></div></div>
    </div>
</div>