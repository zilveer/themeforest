<?php
/**
 * Fullwidth Slider shortcode template
 */
?>

<div class="mkd-fullwidth-slider-item" <?php echo libero_mikado_get_inline_style($slide_holder_style); ?>>
    <div class="mkd-fullwidth-slider-item-image-holder-wrapper">
        <span class="mkd-fullwidth-slider-item-image-holder">
            <?php echo wp_get_attachment_image($image,'full'); ?>
        </span>
    </div>
    <div class="mkd-fullwidth-slider-item-content-holder">
        <div class="mkd-fullwidth-slider-item-content-holder-inner">
            <div class="mkd-fullwidth-slider-item-content-wrapper">
                <div class="mkd-fullwidth-slider-item-wrapper-inner">
                    <div class="mkd-fullwidth-slider-item-elements-holder">
                        <div class="mkd-fullwidth-slider-item-title">
                            <<?php echo esc_attr($title_tag); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                        </div>
                        <div class="mkd-fullwidth-slider-item-text">
                            <h3><?php echo esc_html($text); ?></h3>
                        </div>
                        <?php if($show_button == 'yes') { ?>
                            <div class="mkd-fullwidth-slider-item-button">
                                <?php echo libero_mikado_get_button_html($button_parameters); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>