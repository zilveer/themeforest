<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php suprema_qodef_inline_style($button_styles); ?> <?php suprema_qodef_class_attribute($button_classes); ?> <?php echo suprema_qodef_get_inline_attrs($button_data); ?> <?php echo suprema_qodef_get_inline_attrs($button_custom_attrs); ?>>
    <span <?php suprema_qodef_inline_style($button_icon_styles); ?> class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo suprema_qodef_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>