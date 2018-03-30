<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php qode_startit_inline_style($button_styles); ?> <?php qode_startit_class_attribute($button_classes); ?> <?php echo qode_startit_get_inline_attrs($button_data); ?> <?php echo qode_startit_get_inline_attrs($button_custom_attrs); ?>>
    <?php if($params['hover_animation']!=''){ ?>
        <span  <?php qode_startit_inline_style($button_animation_styles); ?>  class="qodef-animation-overlay"></span>
    <?php }?>
    <span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <span class="qodef-btn-text-icon"><?php echo qode_startit_icon_collections()->renderIcon($icon, $icon_pack); ?></span>
</a>