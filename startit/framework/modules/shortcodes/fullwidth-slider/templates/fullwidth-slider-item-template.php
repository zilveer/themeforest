<?php
/**
 * Fullwidth Slider shortcode template
 */
?>

<div class="qodef-fullwidth-slider-item" <?php echo qode_startit_get_inline_style($slide_holder_style); ?>>
    <div class="qodef-fullwidth-slider-item-image-holder-wrapper">
        <span class="qodef-fullwidth-slider-item-image-holder">
            <img src="<?php print $image; ?>" alt="qodef-fullwidth-slider"/>
        </span>
    </div>
    <div class="qodef-fullwidth-slider-item-content-holder">
        <div class="qodef-fullwidth-slider-item-content-holder-inner">
            <div class="qodef-fullwidth-slider-item-content-wrapper">
                <div class="qodef-fullwidth-slider-item-wrapper-inner">
                    <div class="qodef-fullwidth-slider-item-elements-holder">
                        <div class="qodef-fullwidth-slider-item-title">
                            <<?php echo esc_attr($title_tag); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                        </div>
                        <div class="qodef-fullwidth-slider-item-subtitle">
                            <<?php echo esc_attr($subtitle_tag); ?>><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
                        </div>
                        <div class="qodef-fullwidth-slider-item-text">
                            <p><?php echo esc_html($text); ?></p>
                        </div>
                        <?php if($show_button == 'yes') { ?>
                            <div class="qodef-fullwidth-slider-item-button">
                                <?php echo qode_startit_get_button_html($button_parameters); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>