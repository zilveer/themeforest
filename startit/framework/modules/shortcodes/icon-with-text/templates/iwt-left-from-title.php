<div <?php qode_startit_class_attribute($holder_classes); ?>>
    <div class="qodef-iwt-content-holder">
        <div class="qodef-iwt-icon-title-holder">
            <div class="qodef-iwt-icon-holder">
                <?php if(!empty($custom_icon)) : ?>
                    <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                <?php else: ?>
                    <?php echo qode_startit_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
                <?php endif; ?>
            </div>
            <?php if($title != '') { ?>
                <div class="qodef-iwt-title-holder">
                    <<?php echo esc_attr($title_tag); ?> <?php qode_startit_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                 </div>
            <?php } ?>
        </div>
        <div class="qodef-iwt-text-holder">
            <p <?php qode_startit_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>

            <?php if(!empty($link) && !empty($link_text)) : ?>
                <a class="qodef-iwt-link" href="<?php echo esc_attr($link); ?>" <?php qode_startit_inline_attr($target, 'target'); ?>><?php echo esc_html($link_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>