<div <?php hue_mikado_class_attribute($process_item_classes); ?>>
    <?php if($link != '') { ?>
        <a href="<?php echo esc_url($link); ?>" target="<?php esc_attr($target);  ?>"></a>
    <?php } ?>
    <div class="mkd-pi-front">
        <div class="mkd-pi-holder-inner" <?php hue_mikado_inline_style($process_item_styles); ?>>

            <?php if(!empty($number)) : ?>
                <div class="mkd-number-holder-inner <?php echo esc_attr($number_gradient_style); ?>">
                    <span><?php echo esc_html($number); ?></span>
                    <div class="mkd-border"></div>
                </div>
            <?php endif; ?>

            <div class="mkd-pi-content-holder">
                <?php if(!empty($title)) : ?>
                    <div class="mkd-pi-title-holder">
                        <h5 class="mkd-pi-title" <?php echo hue_mikado_inline_style('color: '.$title_color);  ?>><?php echo esc_html($title); ?></h5>
                    </div>
                <?php endif; ?>

                <?php if(!empty($text)) : ?>
                    <div class="mkd-pi-text-holder">
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ($flip_on_hover == 'yes') { ?>
        <div class="mkd-pi-back" <?php hue_mikado_inline_style($process_item_back_side_styles); ?>>
            <div class="mkd-pi-back-table">
                <div class="mkd-pi-back-cell">
                    <?php if ($process_list == 'yes') { ?>
                        <ul>
                            <?php if ($process_list_item_1 != '') { ?>
                                <li class="mkd-pi-process-list-item"><?php echo esc_attr($process_list_item_1); ?></li>
                            <?php } ?>
                            <?php if ($process_list_item_2 != '') { ?>
                                <li class="mkd-pi-process-list-item"><?php echo esc_attr($process_list_item_2); ?></li>
                            <?php } ?>
                            <?php if ($process_list_item_3 != '') { ?>
                                <li class="mkd-pi-process-list-item"><?php echo esc_attr($process_list_item_3); ?></li>
                            <?php } ?>
                            <?php if ($process_list_item_4 != '') { ?>
                                <li class="mkd-pi-process-list-item"><?php echo esc_attr($process_list_item_4); ?></li>
                            <?php } ?>
                            <?php if ($process_list_item_5 != '') { ?>
                                <li class="mkd-pi-process-list-item"><?php echo esc_attr($process_list_item_5); ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>