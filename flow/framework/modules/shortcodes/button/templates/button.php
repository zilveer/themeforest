<button type="submit" <?php flow_elated_inline_style($button_styles); ?> <?php flow_elated_class_attribute($button_classes); ?> <?php echo flow_elated_get_inline_attrs($button_data); ?> <?php echo flow_elated_get_inline_attrs($button_custom_attrs); ?>>
    <span class="eltd-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo flow_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>