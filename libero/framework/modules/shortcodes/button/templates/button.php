<button type="submit" <?php libero_mikado_inline_style($button_styles); ?> <?php libero_mikado_class_attribute($button_classes); ?> <?php echo libero_mikado_get_inline_attrs($button_data); ?> <?php echo libero_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkd-btn-text" <?php libero_mikado_inline_style($text_holder_styles); ?>><?php echo esc_html($text); ?></span><?php if($show_icon) : ?><span class="mkd-btn-icon-holder">
            <?php echo libero_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
                'icon_attributes' => array(
                    'class' => 'mkd-btn-icon-elem'
                )
            )); ?>
            <?php echo libero_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
                'icon_attributes' => array(
                    'class' => 'mkd-btn-icon-elem'
                )
            )); ?>
        </span>
    <?php endif; ?>
</button>