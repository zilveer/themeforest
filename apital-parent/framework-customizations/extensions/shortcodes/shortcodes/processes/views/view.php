<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

?>
<?php if(!empty($atts['title'])):?>
    <div class="procces-text-wrapper">
        <div class="w-container">
            <div class="tittle-wrapper">
                <h3 class="blue"><?php echo fw_theme_translate(esc_html($atts['title'])); ?></h3>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty($atts['box'])):?>
    <div class="process-work <?php echo esc_attr($atts['class']);?>">
        <?php foreach($atts['box'] as $box): ?>
            <?php
                //get box type
                $box_class = ($box['box_type']['message_type'] == 'custom') ? '' : $box['box_type']['message_type'];

                //custom type colors
                $bg_color = empty($box_class) ? 'style="background-color:'.$box['box_type']['custom']['bg_color'].';"' : '';
                $text_color = empty($box_class) ? 'style="color:'.$box['box_type']['custom']['text_color'].'"' : '';

                //get arrow type
                if($box_class == 'color-2')
                    $arrow = '<div class="arrow-proccess"></div>';
                elseif($box_class == 'color-3')
                    $arrow = '<div class="arrow-proccess color-2"></div>';
                elseif($box_class == 'color-4')
                    $arrow = '<div class="arrow-proccess color-3"></div>';
                else
                    $arrow = '';

                //get icon
                $icon = ($box['icon_box']['icon_type'] == 'awesome') ? $box['icon_box']['awesome']['icon'] : $box['icon_box']['custom']['icon'];
            ?>
            <div class="procces-wrapper <?php echo esc_attr($box_class);?>" data-ix="process-effect" <?php echo ($bg_color);?>>
                <?php echo do_shortcode($arrow); ?>
                <div>

                    <?php if(!empty($icon)) : ?>
                        <div class="procc-ico" data-ix="move-titte-procces" <?php echo ($text_color);?>>
                            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                            </div>
                        </div>
                    <?php endif;?>

                    <?php if(!empty($box['title'])):?>
                        <div class="process-title" data-ix="move-titte-procces">
                            <h4 class="h-process" <?php echo ($text_color);?>><?php echo fw_theme_translate(esc_html($box['title']));?></h4>
                        </div>
                    <?php endif;?>

                    <?php if(!empty($box['desc'])):?>
                        <div class="sp-process" data-ix="move-process-text">
                            <p class="white" <?php echo ($text_color);?>><?php echo fw_theme_translate(esc_html($box['desc']));?></p>
                        </div>
                    <?php endif;?>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;?>
