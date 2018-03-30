<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}
?>
<?php if(!empty($atts['toggle'])):?>
    <?php
        if($atts['toggle_type'] == 'first-style' || $atts['toggle_type'] == 'second-style')
            $color_toggle = '';
        elseif($atts['toggle_type'] == 'fourth-style')
            $color_toggle = 'blue-color';
        else
            $color_toggle = 'dark-color';
    ?>

    <div class="<?php echo esc_attr($atts['class']);?>">
        <?php foreach($atts['toggle'] as $toggle): ?>
            <?php $icon = ($toggle['icon_box']['icon_type'] == 'awesome') ? $toggle['icon_box']['awesome']['icon'] : $toggle['icon_box']['custom']['icon']; ?>

            <div class="toggle-wrapper" data-toggle="open">
                <a class="w-clearfix w-inline-block toggle-header <?php echo esc_attr($atts['toggle_type']);?>" href="#">
                    <?php if(!empty($icon)): ?>
                        <div class="remove-alert">
                            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="toggle-ico">
                        <div class="toggle-line <?php echo ($color_toggle); ?>"></div>
                        <div class="toggle-line-2 <?php echo ($color_toggle); ?>"></div>
                    </div>
                    <div><?php echo fw_theme_translate(esc_html($toggle['title']));?></div>
                </a>
                <div class="toggle-content">
                    <div class="toggle-space">
                        <span><?php echo fw_theme_translate(do_shortcode($toggle['desc']));?></span>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>