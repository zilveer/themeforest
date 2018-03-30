<?php if($icon_animation_holder) : ?>
    <span class="qodef-icon-animation-holder" <?php qode_startit_inline_style($icon_animation_holder_styles); ?>>
<?php endif; ?>

    <span <?php qode_startit_class_attribute($icon_holder_classes); ?> <?php qode_startit_inline_style($icon_holder_styles); ?> <?php echo qode_startit_get_inline_attrs($icon_holder_data); ?>>
        <?php if($link !== '') : ?>
             <a class="<?php echo esc_attr($link_class) ?>"  href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>

        <?php echo qode_startit_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>

        <?php if($link !== '') : ?>
            </a>
        <?php endif; ?>
    </span>

<?php if($icon_animation_holder) : ?>
    </span>
<?php endif; ?>
