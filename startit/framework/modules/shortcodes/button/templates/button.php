<button type="submit" <?php qode_startit_inline_style($button_styles); ?> <?php qode_startit_class_attribute($button_classes); ?> <?php echo qode_startit_get_inline_attrs($button_data); ?> <?php echo qode_startit_get_inline_attrs($button_custom_attrs); ?>>
    <span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo qode_startit_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>