<div class="qodef-pricing-slider" <?php echo qode_startit_get_inline_attrs($slider_data); ?>>
    <div class="qodef-pricing-slider-inner">
        <div class="qodef-pricing-slider-button-holder">
            <?php
            if($price_period !== ''){ ?>
                <span class="qodef-pricing-slider-button <?php print $extra_initially_active != 'yes' ? 'active' : '' ?>" <?php echo qode_startit_get_inline_attrs($button_value); ?>>
                    <?php echo qode_startit_get_button_html(array(
                        'link' => 'javascript:void(0)',
                        'text' => $price_period,
                        'size' => 'small',
                        'custom_class' => 'button_first_period',
                        'html_type' => 'input',
                        'color' => $button_text_color
                    )); ?>
                </span>
            <?php } ?>
            <?php
            if($extra_period === 'yes' && $price_period_extra !== ''){ ?>
                <span class="qodef-pricing-slider-button-extra <?php print $extra_initially_active == 'yes' ? 'active' : '' ?>" <?php echo qode_startit_get_inline_attrs($button_value_extra); ?>>
                    <?php echo qode_startit_get_button_html(array(
                        'link' => 'javascript:void(0)',
                        'text' => $price_period_extra,
                        'size' => 'small',
                        'custom_class' => 'button_second_period',
                        'html_type' => 'input',
                        'color' => $button_text_color
                    )); ?>
                </span>
            <?php } ?>
        </div>
        <div class="qodef-pricing-slider-bar-holder">
            <div class="qodef-pricing-slider-bar" style="width: 0">
                <span class="qodef-pricing-slider-drag">
                    <i class="fa fa-chevron-left"></i>
                    <i class="fa fa-chevron-right"></i>
                    <span class="qodef-pricing-slider-value-holder">
                        <span class="qodef-pricing-slider-value" <?php echo qode_startit_get_inline_style($unit_text_style); ?>>0 <?php echo esc_attr($unit_name) . 's'; ?></span>
                    </span>
                </span>
            </div>
        </div>
        <div class="qodef-pricing-slider-info-holder">
            <?php
                print do_shortcode('[qodef_pricing_info ' . $pricing_info_params . ']');
            ?>
        </div>
    </div>
</div>