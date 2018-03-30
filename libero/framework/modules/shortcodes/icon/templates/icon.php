<?php if($icon_animation_holder) : ?>
    <span class="mkd-icon-animation-holder" <?php libero_mikado_inline_style($icon_animation_holder_styles); ?>>
<?php endif; ?>

    <span <?php libero_mikado_class_attribute($icon_holder_classes); ?> <?php libero_mikado_inline_style($icon_holder_styles); ?> <?php echo libero_mikado_get_inline_attrs($icon_holder_data); ?>>
        <?php if($link !== '') : ?>
            <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>

        <?php echo libero_mikado_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>

        <?php if($link !== '') : ?>
            </a>
        <?php endif; ?>
        <span <?php libero_mikado_inline_style($icon_background_styles); ?> class="mkd-background"></span>
    </span>

<?php if($icon_animation_holder) : ?>
    </span>
<?php endif; ?>
