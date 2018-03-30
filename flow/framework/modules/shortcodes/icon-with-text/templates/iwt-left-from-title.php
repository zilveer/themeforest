<div <?php flow_elated_class_attribute($holder_classes); ?>>
    <div class="eltd-iwt-content-holder">
        <div class="eltd-iwt-icon-title-holder">
            <div class="eltd-iwt-icon-holder">
                <?php echo flow_elated_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
            </div>
            <div class="eltd-iwt-title-holder">
                <<?php echo esc_attr($title_tag); ?> <?php flow_elated_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
            </div>
        </div>
        <div class="eltd-iwt-text-holder">
            <p <?php flow_elated_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>

            <?php if(!empty($link) && !empty($link_text)) : ?>
                <a class="eltd-iwt-link" href="<?php echo esc_attr($link); ?>" <?php flow_elated_inline_attr($target, 'target'); ?>><?php echo esc_html($link_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>