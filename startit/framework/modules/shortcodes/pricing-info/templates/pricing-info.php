<div class="qodef-pricing-info <?php  echo esc_attr($pricing_info_classes)?>">
    <div class="qodef-pricing-info-inner">
        <?php if($active == 'yes'){ ?>
            <div class="qodef-active-text">
				<span>
					<span><span><span><span><span><span><span><span><span class="qodef-active-text-inner"><?php echo esc_html($active_text) ?></span></span></span></span></span></span></span></span></span>
				</span>
            </div>
        <?php } ?>
        <<?php echo esc_attr($title_tag); ?> class="qodef-pricing-info-title">
            <?php echo esc_html($title); ?>
        </<?php echo esc_attr($title_tag)?>>
        <div class="qodef-pricing-info-description">
            <?php print $description; ?>
        </div>
        <div class="qodef-pricing-info-pricing">
            <span class="qodef-value"><?php echo esc_html($currency) ?></span>
            <span class="qodef-price"><?php echo esc_html($price)?></span>
            <span class="qodef-mark"><?php echo esc_html($price_period)?></span>
        </div>
        <?php
        if($show_button == "yes" && $button_text !== ''){ ?>
            <div class="qodef-pricing-info-button">
                <?php echo qode_startit_get_button_html(array(
                    'link' => $link,
                    'text' => $button_text,
                    'size' => 'large'
                )); ?>
            </div>
        <?php } ?>
    </div>
</div>